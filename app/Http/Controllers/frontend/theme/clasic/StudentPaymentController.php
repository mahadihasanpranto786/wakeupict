<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\Course;
use App\model\StudentPayment;
use App\model\LmsPaymentSubmission;
use App\model\LmsFeeInstallment;
use App\model\LmsEnrollment;
use Carbon\Carbon;

class StudentPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Course Fees Breakdown & Payment Submission
     */
    public function fees()
    {
        $student = Auth::guard('student')->user();
        $admited = $student->admitedStudent;

        // Calculate fees from admitted student profile or enrolled courses
        $totalCourseFee = 0;
        $totalDiscount = 0;
        $courseTitle = 'Professional ICT Training Program';

        if ($admited) {
            $course = $admited->course;
            $courseTitle = $course ? $course->course_title : $courseTitle;
            $totalCourseFee = $admited->course_after_discount + $admited->discount_amount;
            $totalDiscount = $admited->discount_amount;
        } else {
            $enrollments = LmsEnrollment::where('student_account_id', $student->id)->with('course')->get();
            foreach ($enrollments as $enr) {
                if ($enr->course) {
                    $totalCourseFee += (float) ($enr->course->course_fee ?: 5000);
                    $courseTitle = $enr->course->course_title;
                }
            }
        }

        $payableAmount = max(0, $totalCourseFee - $totalDiscount);

        // Calculate verified payments
        $legacyPaid = $admited 
            ? StudentPayment::where('student_id', $admited->id)->where('status', 1)->sum('paid') 
            : 0;

        $onlinePaid = LmsPaymentSubmission::where('student_account_id', $student->id)
            ->where('status', 'verified')
            ->sum('amount');

        $totalPaid = (float) ($legacyPaid + $onlinePaid);
        $totalDue = max(0, $payableAmount - $totalPaid);

        // Installment schedules
        $installments = LmsFeeInstallment::where('student_account_id', $student->id)
            ->orderBy('installment_number', 'asc')
            ->get();

        // Enrolled courses for payment form
        $courses = Course::where('status', 1)->get();

        return view('frontend.theme.clasic.student.payments.fees', compact(
            'student', 'courseTitle', 'totalCourseFee', 'totalDiscount', 'payableAmount',
            'totalPaid', 'totalDue', 'installments', 'courses'
        ));
    }

    /**
     * Submit online payment notification (bKash, Nagad, Rocket, Bank)
     */
    public function submitPayment(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'course_id' => 'required',
            'payment_method' => 'required|string',
            'transaction_id' => 'required|string|max:100',
            'sender_number' => 'required|string|max:50',
            'amount' => 'required|numeric|min:10',
            'payment_proof_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'student_note' => 'nullable|string|max:500',
        ]);

        $filePath = null;
        if ($request->hasFile('payment_proof_file')) {
            $file = $request->file('payment_proof_file');
            $filename = 'proof_' . $student->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/lms_payments'), $filename);
            $filePath = 'uploads/lms_payments/' . $filename;
        }

        $receiptNo = LmsPaymentSubmission::generateReceiptNumber();

        LmsPaymentSubmission::create([
            'student_account_id' => $student->id,
            'course_id' => $request->course_id,
            'batch_id' => $student->admitedStudent ? $student->admitedStudent->batch_id : null,
            'payment_method' => $request->payment_method,
            'transaction_id' => trim($request->transaction_id),
            'sender_number' => trim($request->sender_number),
            'amount' => (float) $request->amount,
            'payment_proof_file' => $filePath,
            'student_note' => $request->student_note,
            'status' => 'pending',
            'receipt_number' => $receiptNo,
        ]);

        return redirect()->route('student.payments.history')->with([
            'success' => 'Payment notification submitted successfully! Receipt code: ' . $receiptNo . '. Accounts desk will verify within 2-4 hours.',
        ]);
    }

    /**
     * Comprehensive Payment History
     */
    public function paymentHistory()
    {
        $student = Auth::guard('student')->user();
        $admited = $student->admitedStudent;

        $onlinePayments = LmsPaymentSubmission::where('student_account_id', $student->id)
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->get();

        $legacyPayments = $admited 
            ? StudentPayment::where('student_id', $admited->id)->orderBy('id', 'desc')->get() 
            : collect([]);

        return view('frontend.theme.clasic.student.payments.history', compact(
            'student', 'onlinePayments', 'legacyPayments'
        ));
    }

    /**
     * Outstanding Dues Summary
     */
    public function outstandingDues()
    {
        return $this->fees();
    }

    /**
     * Receipts Catalog
     */
    public function receipts()
    {
        $student = Auth::guard('student')->user();

        $receipts = LmsPaymentSubmission::where('student_account_id', $student->id)
            ->where('status', 'verified')
            ->with(['course', 'verifier'])
            ->orderBy('verified_at', 'desc')
            ->get();

        return view('frontend.theme.clasic.student.payments.receipts', compact('student', 'receipts'));
    }

    /**
     * Printable Official Money Receipt
     */
    public function printReceipt($receiptNumber)
    {
        $student = Auth::guard('student')->user();

        $payment = LmsPaymentSubmission::where('receipt_number', $receiptNumber)
            ->where('student_account_id', $student->id)
            ->with(['course', 'verifier'])
            ->firstOrFail();

        return view('frontend.theme.clasic.student.payments.receipt_print', compact('student', 'payment'));
    }
}
