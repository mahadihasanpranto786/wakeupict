<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\Course;
use App\model\LmsPaymentSubmission;
use App\model\LmsFeeInstallment;
use App\model\LmsCertificate;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LmsPaymentAndCertificateTest extends TestCase
{
    protected $student;
    protected $course;
    protected $certificate;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'Payment and Certificate Test Student',
            'phone' => '01744' . rand(100000, 999999),
            'email' => 'paytest_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);

        $this->course = Course::first();

        $this->certificate = LmsCertificate::create([
            'student_account_id' => $this->student->id,
            'course_id' => $this->course->id,
            'certificate_code' => LmsCertificate::generateCertificateCode(),
            'title' => 'Certificate of Unit Test Completion',
            'grade' => 'A+',
            'score_percentage' => 95.00,
            'issue_date' => Carbon::today(),
            'status' => 'issued',
            'verification_hash' => LmsCertificate::generateVerificationHash(),
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->student) {
            LmsPaymentSubmission::where('student_account_id', $this->student->id)->delete();
            LmsFeeInstallment::where('student_account_id', $this->student->id)->delete();
            LmsCertificate::where('student_account_id', $this->student->id)->delete();
            $this->student->delete();
        }

        parent::tearDown();
    }

    /**
     * Test course fees and dues breakdown view
     */
    public function testStudentCanViewFeesAndDues()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.fees.index'));

        $response->assertStatus(200);
        $response->assertSee('Course Fees');
        $response->assertSee('Outstanding Due');
        $response->assertSee('Submit Online Payment Notification');

        $duesResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.dues.index'));
        $duesResponse->assertStatus(200);
    }

    /**
     * Test submitting online payment notification
     */
    public function testStudentCanSubmitPaymentNotification()
    {
        $response = $this->actingAs($this->student, 'student')
            ->post(route('student.payments.submit'), [
                'course_id' => $this->course->id,
                'payment_method' => 'bkash',
                'transaction_id' => 'TRXTEST' . rand(1000, 9999),
                'sender_number' => '01711223344',
                'amount' => 3000,
                'student_note' => 'First installment payment',
            ]);

        $response->assertRedirect(route('student.payments.history'));

        $this->assertDatabaseHas('lms_payment_submissions', [
            'student_account_id' => $this->student->id,
            'payment_method' => 'bkash',
            'amount' => 3000.00,
            'status' => 'pending',
        ]);
    }

    /**
     * Test viewing payment history, receipts, and printable voucher
     */
    public function testStudentCanViewPaymentHistoryAndReceipts()
    {
        $receiptNo = 'REC-TEST-999';
        $verifiedPay = LmsPaymentSubmission::create([
            'student_account_id' => $this->student->id,
            'course_id' => $this->course->id,
            'payment_method' => 'nagad',
            'transaction_id' => 'TRXVERIFIED',
            'sender_number' => '01755667788',
            'amount' => 2500,
            'status' => 'verified',
            'receipt_number' => $receiptNo,
            'verified_at' => Carbon::now(),
        ]);

        $historyResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.payments.history'));
        $historyResponse->assertStatus(200);
        $historyResponse->assertSee('Payment History');
        $historyResponse->assertSee($receiptNo);

        $receiptsResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.receipts.index'));
        $receiptsResponse->assertStatus(200);
        $receiptsResponse->assertSee($receiptNo);

        // Print receipt
        $printResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.receipts.print', $receiptNo));
        $printResponse->assertStatus(200);
        $printResponse->assertSee('OFFICIAL RECEIPT');
        $printResponse->assertSee($receiptNo);
    }

    /**
     * Test certificate viewing and public authenticity verification
     */
    public function testStudentCanViewAndVerifyCertificate()
    {
        $certListResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.certificates.index'));
        $certListResponse->assertStatus(200);
        $certListResponse->assertSee('Official Certificates');
        $certListResponse->assertSee($this->certificate->certificate_code);

        // View certificate
        $viewResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.certificates.view', $this->certificate->certificate_code));
        $viewResponse->assertStatus(200);
        $viewResponse->assertSee('Certificate of Completion');
        $viewResponse->assertSee($this->student->name);
        $viewResponse->assertSee($this->certificate->certificate_code);

        // Public verification (guest accessible)
        $verifyResponse = $this->get(route('certificates.verify', $this->certificate->verification_hash));
        $verifyResponse->assertStatus(200);
        $verifyResponse->assertSee('Official Credential Verified');
        $verifyResponse->assertSee($this->certificate->certificate_code);
    }
}
