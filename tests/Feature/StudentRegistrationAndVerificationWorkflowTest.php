<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\Course;
use App\model\Batch;
use App\model\Student;
use App\model\StudentAccount;
use App\model\RegistrationVerification;
use App\Services\RegistrationNumberService;
use App\Services\RegistrationVerificationService;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentRegistrationAndVerificationWorkflowTest extends TestCase
{
    /**
     * Test 1: Concurrency-Safe Automatic Registration Number Generation
     * Format: YYYYBBCCNNNN (e.g. 202605010001)
     */
    public function testRegistrationNumberGenerationFormatAndUniqueness()
    {
        $uniqueBatch = (string)rand(30, 69);
        \Illuminate\Support\Facades\DB::table('registration_sequences')->where('academic_year', '2026')->where('batch_code', $uniqueBatch)->delete();
        $reg1 = RegistrationNumberService::generate('2026', $uniqueBatch, '01');
        $this->assertEquals(12, strlen($reg1));
        $this->assertEquals('2026' . $uniqueBatch, substr($reg1, 0, 6));

        $reg2 = RegistrationNumberService::generate('2026', $uniqueBatch, '01');
        $this->assertEquals(12, strlen($reg2));
        $this->assertNotEquals($reg1, $reg2);

        // Different course/batch has independent sequence
        $otherBatch = (string)rand(70, 89);
        \Illuminate\Support\Facades\DB::table('registration_sequences')->where('academic_year', '2026')->where('batch_code', $otherBatch)->delete();
        $reg3 = RegistrationNumberService::generate('2026', $otherBatch, '02');
        $this->assertEquals("2026{$otherBatch}020001", $reg3);
    }

    /**
     * Test 2: Active Batch and Course Selection in Registration
     */
    public function testStudentRegistrationWithActiveBatchAndCourse()
    {
        // Fetch or create an active course and batch
        $course = Course::where('status', 1)->first();
        $this->assertNotNull($course);
        $this->assertNotEmpty($course->course_code);

        $batch = Batch::firstOrCreate([
            'batch_code' => '99',
        ], [
            'batch_number' => 'Batch-99',
            'course_id' => $course->id,
            'academic_year' => '2026',
            'batch_type' => 'Local',
            'title_id' => 1,
            'active_batch' => 1,
            'status' => 1,
        ]);

        $randomPhone = '0179' . rand(1000000, 9999999);
        $response = $this->post(route('student.register.submit'), [
            'name' => 'John Doe',
            'phone' => $randomPhone,
            'email' => 'johndoe_' . rand(1000, 9999) . '@test.com',
            'course_id' => $course->id,
            'batch_id' => $batch->id,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect(route('student.registration.confirmation'));

        // Verify StudentAccount is created with pending status
        $account = StudentAccount::where('phone', $randomPhone)->first();
        $this->assertNotNull($account);
        $this->assertEquals('pending', $account->registration_status);
        $this->assertNotEmpty($account->registration_number);
        $this->assertRegExp('/^202699' . $course->course_code . '\d{4}$/', $account->registration_number);

        // Verify student is NOT logged in automatically
        $this->assertFalse(Auth::guard('student')->check());
    }

    /**
     * Test 3: Inactive Batches Cannot be Submitted
     */
    public function testInactiveBatchRegistrationIsRejected()
    {
        $course = Course::where('status', 1)->first();

        $inactiveBatch = Batch::create([
            'batch_number' => 'Inactive Batch ' . rand(100, 999),
            'batch_code' => 'IB' . rand(1000, 9999),
            'academic_year' => '2026',
            'course_id' => $course->id,
            'batch_type' => 'Local',
            'title_id' => 1,
            'active_batch' => 0, // Inactive
            'status' => 1,
        ]);

        $response = $this->post(route('student.register.submit'), [
            'name' => 'Inactive Batch Student',
            'phone' => '0178' . rand(1000000, 9999999),
            'course_id' => $course->id,
            'batch_id' => $inactiveBatch->id,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertSessionHasErrors('batch_id');
    }

    /**
     * Test 4: Pending Student Portal Access is Blocked by Middleware
     */
    public function testPendingStudentCannotAccessPortal()
    {
        $account = StudentAccount::create([
            'name' => 'Pending Student User',
            'phone' => '0177' . rand(1000000, 9999999),
            'password' => Hash::make('password123'),
            'student_id_code' => 'WUICT-2026-' . rand(1000, 9999),
            'registration_number' => '20260501' . rand(1000, 9999),
            'registration_status' => 'pending',
            'status' => 1,
        ]);

        // Attempt login
        $loginRes = $this->post(route('student.login.submit'), [
            'login_id' => $account->phone,
            'password' => 'password123',
        ]);

        $loginRes->assertSessionHasErrors('login_id');
        $this->assertFalse(Auth::guard('student')->check());

        // Attempt direct access via actingAs
        $portalRes = $this->actingAs($account, 'student')->get(route('student.dashboard'));
        $portalRes->assertRedirect(route('student.login'));
    }

    /**
     * Test 5: Approved Student Can Log In and Access Portal
     */
    public function testApprovedStudentCanAccessPortal()
    {
        $account = StudentAccount::create([
            'name' => 'Approved Student User',
            'phone' => '0176' . rand(1000000, 9999999),
            'password' => Hash::make('password123'),
            'student_id_code' => 'WUICT-2026-' . rand(1000, 9999),
            'registration_number' => '20260501' . rand(1000, 9999),
            'registration_status' => 'approved',
            'status' => 1,
        ]);

        $portalRes = $this->actingAs($account, 'student')->get(route('student.dashboard'));
        $portalRes->assertStatus(200);
    }

    /**
     * Test 6: Rejected Student Remains Blocked
     */
    public function testRejectedStudentIsBlocked()
    {
        $account = StudentAccount::create([
            'name' => 'Rejected Student User',
            'phone' => '0175' . rand(1000000, 9999999),
            'password' => Hash::make('password123'),
            'student_id_code' => 'WUICT-2026-' . rand(1000, 9999),
            'registration_number' => '20260501' . rand(1000, 9999),
            'registration_status' => 'rejected',
            'rejection_reason' => 'Invalid document submissions',
            'status' => 0,
        ]);

        $loginRes = $this->post(route('student.login.submit'), [
            'login_id' => $account->phone,
            'password' => 'password123',
        ]);

        $loginRes->assertSessionHasErrors('login_id');
        $this->assertFalse(Auth::guard('student')->check());
    }

    /**
     * Test 7: Registration Verification & Multi-Dimension Rate Limiting (Exceeding 3 attempts blocks request)
     */
    public function testRegistrationVerificationRateLimitingAndAuditLog()
    {
        $testPhone = '0174' . rand(1000000, 9999999);
        $testBatch = 'NONEXISTENT' . rand(1000, 9999);
        $testIp = '192.168.' . rand(10, 99) . '.' . rand(1, 250);

        // Attempt 1: Failed
        $res1 = RegistrationVerificationService::processVerification($testPhone, $testBatch, $testIp);
        $this->assertEquals('failed', $res1['status']);
        $this->assertEquals(2, $res1['remaining_attempts']);

        // Attempt 2: Failed
        $res2 = RegistrationVerificationService::processVerification($testPhone, $testBatch, $testIp);
        $this->assertEquals('failed', $res2['status']);
        $this->assertEquals(1, $res2['remaining_attempts']);

        // Attempt 3: Blocked (Reached limit)
        $res3 = RegistrationVerificationService::processVerification($testPhone, $testBatch, $testIp);
        $this->assertEquals('blocked', $res3['status']);
        $this->assertTrue($res3['is_blocked']);

        // Attempt 4: Should remain blocked
        $res4 = RegistrationVerificationService::processVerification($testPhone, $testBatch, $testIp);
        $this->assertEquals('blocked', $res4['status']);
        $this->assertTrue($res4['is_blocked']);

        // Verify audit logs recorded
        $logCount = RegistrationVerification::where('phone', $testPhone)->count();
        $this->assertGreaterThanOrEqual(3, $logCount);
    }

    /**
     * Test 8: Admin Approval of Blocked Verification Request
     */
    public function testAdminCanApproveBlockedVerificationRequest()
    {
        $testPhone = '01730005566';
        $log = RegistrationVerification::create([
            'phone' => $testPhone,
            'batch_code' => '99',
            'ip_address' => '127.0.0.1',
            'attempts_count' => 3,
            'status' => 'blocked',
        ]);

        $admin = User::first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin_test@test.com',
                'password' => Hash::make('secret'),
                'type' => 'Admin',
            ]);
        }

        $res = $this->actingAs($admin)->post(route('admin.verification.request.approve', $log->id), [
            'admin_notes' => 'Identity verified manually via phone call',
        ]);

        $res->assertSessionHas('success');
        $log->refresh();
        $this->assertEquals('admin_approved', $log->status);
    }

    /**
     * Test 9: Batch Deletion Prevention when Registered Students Exist
     */
    public function testBatchCannotBeDeletedIfStudentsExist()
    {
        $course = Course::where('status', 1)->first();
        $batch = Batch::create([
            'batch_number' => 'Batch To Test Delete ' . rand(100, 999),
            'batch_code' => 'BD' . rand(1000, 9999),
            'academic_year' => '2026',
            'course_id' => $course->id,
            'batch_type' => 'Local',
            'title_id' => 1,
            'active_batch' => 1,
            'status' => 1,
        ]);

        // Add a registered student to this batch
        $student = Student::create([
            'student_name' => 'Assigned Student',
            'personal_call_no' => '0172' . rand(1000000, 9999999),
            'email' => 'assigned@test.com',
            'course_id' => $course->id,
            'batch_id' => $batch->id,
            'course_fee' => '0',
            'status' => 1,
            'gander' => 'other',
            'fathers_name' => '',
            'mothers_name' => '',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '',
            'present_address' => '',
            'permanent_address' => '',
            'religion' => 'Islam',
            'occupation' => 'student',
            'age' => '',
            'educational_qualification' => '',
            'result' => '',
            'passing_year' => '',
        ]);

        $this->assertTrue($batch->hasStudents());

        $admin = User::first();
        $res = $this->actingAs($admin)->get(url('batch-delete/' . $batch->id));
        $res->assertSessionHas('error');

        // Batch status must still be 1 (not deleted)
        $batch->refresh();
        $this->assertEquals(1, $batch->status);
    }
}
