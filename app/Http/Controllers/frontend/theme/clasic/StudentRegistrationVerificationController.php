<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Batch;
use App\model\RegistrationVerification;
use App\Services\RegistrationVerificationService;
use App\Services\StudentEnrollmentService;
use Carbon\Carbon;

class StudentRegistrationVerificationController extends Controller
{
    /**
     * Check if a client IP address has exceeded 3 failed verification attempts
     */
    protected function checkIpBlocked($ip)
    {
        $windowStart = Carbon::now()->subMinutes(RegistrationVerificationService::ATTEMPTS_WINDOW_MINUTES);

        $failedAttempts = RegistrationVerification::where('ip_address', $ip)
            ->where('created_at', '>=', $windowStart)
            ->whereIn('status', ['failed', 'blocked'])
            ->sum('attempts_count');

        $hasAdminApproval = RegistrationVerification::where('ip_address', $ip)
            ->where('created_at', '>=', $windowStart)
            ->where('status', 'admin_approved')
            ->exists();

        return ($failedAttempts >= RegistrationVerificationService::MAX_ATTEMPTS) && !$hasAdminApproval;
    }

    /**
     * Show the public Registration Verification & Forgot Registration Number page
     */
    public function showVerificationForm(Request $request)
    {
        $isIpBlocked = $this->checkIpBlocked($request->ip());

        $activeBatches = Batch::where('status', 1)
            ->where('active_batch', 1)
            ->with('course')
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.theme.clasic.student.auth.verification', compact('activeBatches', 'isIpBlocked'));
    }

    /**
     * Process verification submission
     */
    public function verify(Request $request)
    {
        $ip = $request->ip();
        $isIpBlocked = $this->checkIpBlocked($ip);

        if ($isIpBlocked) {
            $result = [
                'status' => 'blocked',
                'is_blocked' => true,
                'message' => 'নিরাপত্তাজনিত কারণে এই ডিভাইস/আইপি (IP) থেকে সর্বোচ্চ ৩ বার চেষ্টার পর ভেরিফিকেশন বাটনটি নিষ্ক্রিয় করা হয়েছে। অ্যাডমিন পর্যালোচনার পর এটি সক্রিয় করা হবে। তাৎক্ষণিক সহায়তার জন্য হেল্পলাইন 01791612121 নম্বরে যোগাযোগ করুন।',
                'student' => null,
            ];

            $activeBatches = Batch::where('status', 1)
                ->where('active_batch', 1)
                ->with('course')
                ->orderBy('id', 'desc')
                ->get();

            return view('frontend.theme.clasic.student.auth.verification', compact('activeBatches', 'result', 'isIpBlocked'));
        }

        $request->validate([
            'phone' => 'required|string|max:30',
            'batch_code' => 'required|string|max:50',
        ], [
            'phone.required' => 'অনুগ্রহ করে নিবন্ধিত মোবাইল নম্বর দিন।',
            'batch_code.required' => 'অনুগ্রহ করে ব্যাচ কোড বা ব্যাচ নম্বর নির্বাচন করুন।',
        ]);

        $phone = $request->input('phone');
        $batchCode = $request->input('batch_code');
        $userAgent = $request->userAgent();

        $result = RegistrationVerificationService::processVerification($phone, $batchCode, $ip, $userAgent);
        $isIpBlocked = $this->checkIpBlocked($ip) || ($result['is_blocked'] ?? false);

        $activeBatches = Batch::where('status', 1)
            ->where('active_batch', 1)
            ->with('course')
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.theme.clasic.student.auth.verification', compact('activeBatches', 'result', 'isIpBlocked'));
    }

    /**
     * Verify OTP (if OTP verification is enabled)
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'verification_id' => 'required|integer|exists:registration_verifications,id',
            'otp_code' => 'required|string|size:6',
        ], [
            'otp_code.required' => 'অনুগ্রহ করে ৬ ডিজিটের ওটিপি লিখুন।',
            'otp_code.size' => 'ওটিপি কোড অবশ্যই ৬ ডিজিটের হতে হবে।',
        ]);

        $verification = RegistrationVerification::with('studentAccount')->findOrFail($request->verification_id);

        if ($verification->is_otp_verified) {
            return redirect()->route('student.registration.verification');
        }

        if (Carbon::now()->gt($verification->otp_expires_at)) {
            return back()->withErrors(['otp_code' => 'আপনার ওটিপি কোডের মেয়াদ শেষ হয়ে গেছে। অনুগ্রহ করে নতুন করে চেষ্টা করুন।']);
        }

        if ($verification->otp_code !== trim($request->otp_code)) {
            return back()->withErrors(['otp_code' => 'ভুল ওটিপি কোড। অনুগ্রহ করে সঠিক কোড দিন।']);
        }

        // Mark OTP as verified
        $verification->update([
            'is_otp_verified' => true,
            'status' => 'success',
            'action_at' => Carbon::now(),
        ]);

        $studentAccount = $verification->studentAccount;
        $batch = Batch::where('batch_code', $verification->batch_code)->first();

        $result = [
            'status' => 'success',
            'is_blocked' => false,
            'student' => [
                'name' => $studentAccount ? $studentAccount->name : 'Registered Student',
                'registration_number' => $studentAccount ? ($studentAccount->registration_number ?: $studentAccount->student_id_code) : 'N/A',
                'phone_masked' => RegistrationVerificationService::maskPhone($verification->phone),
                'batch_number' => $batch ? $batch->batch_number : $verification->batch_code,
                'batch_code' => $verification->batch_code,
                'course_title' => $studentAccount && $studentAccount->course ? $studentAccount->course->course_title : 'N/A',
                'registration_status' => $studentAccount ? $studentAccount->registration_status : 'pending',
            ],
            'message' => 'ওটিপি ভেরিফিকেশন সফল হয়েছে। আপনার রেজিস্ট্রেশন নম্বর নিচে প্রদর্শিত হলো।',
        ];

        $activeBatches = Batch::where('status', 1)->where('active_batch', 1)->get();

        return view('frontend.theme.clasic.student.auth.verification', compact('activeBatches', 'result'));
    }
}

