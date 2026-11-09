<?php

namespace App\Services;

use App\model\Batch;
use App\model\Course;
use App\model\Student;
use App\model\StudentAccount;
use App\model\RegistrationVerification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistrationVerificationService
{
    /**
     * Max allowed automatic verification attempts before blocking and requiring admin approval
     */
    const MAX_ATTEMPTS = 3;

    /**
     * Time window in minutes to evaluate attempts
     */
    const ATTEMPTS_WINDOW_MINUTES = 1440; // 24 hours

    /**
     * Process a student's verification request for a forgotten registration number
     *
     * @param string $phone
     * @param string $batchIdentifier Batch Code or Batch Number
     * @param string $ipAddress
     * @param string|null $userAgent
     * @return array
     */
    public static function processVerification($phone, $batchIdentifier, $ipAddress, $userAgent = null)
    {
        $cleanPhone = StudentEnrollmentService::normalizePhone($phone);
        $cleanBatch = trim($batchIdentifier);
        $windowStart = Carbon::now()->subMinutes(self::ATTEMPTS_WINDOW_MINUTES);

        // 1. Check existing audit logs for rate limiting & blocking
        $existingLogs = RegistrationVerification::where(function ($q) use ($cleanPhone, $ipAddress) {
                $q->where('phone', $cleanPhone)
                  ->orWhere('ip_address', $ipAddress);
            })
            ->where('created_at', '>=', $windowStart)
            ->orderBy('id', 'desc')
            ->get();

        // Check if there is an explicit Admin Approved entry
        $adminApprovedEntry = $existingLogs->first(function ($item) {
            return $item->status === 'admin_approved';
        });

        // Total failed or blocked attempts in this window
        $failedAttempts = $existingLogs->filter(function ($item) {
            return in_array($item->status, ['failed', 'blocked']);
        })->sum('attempts_count');

        // Check if blocked
        $isBlocked = ($failedAttempts >= self::MAX_ATTEMPTS) && !$adminApprovedEntry;

        if ($isBlocked) {
            // Log this blocked attempt
            RegistrationVerification::create([
                'student_account_id' => null,
                'phone' => $cleanPhone ?: $phone,
                'batch_code' => $cleanBatch,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'attempts_count' => 1,
                'status' => 'blocked',
            ]);

            return [
                'status' => 'blocked',
                'is_blocked' => true,
                'message' => 'নিরাপত্তাজনিত কারণে আপনার তথ্য যাচাইয়ের সুযোগ সাময়িকভাবে স্থগিত করা হয়েছে, কারণ সর্বোচ্চ ৩ বার ভুল/অতিরিক্ত প্রচেষ্টা সম্পন্ন হয়েছে। আপনার আবেদনটি অ্যাডমিন অনুমোদনের জন্য প্রেরণ করা হয়েছে। অনুমোদনের পর আপনি রেজিস্ট্রেশন নম্বর দেখতে পাবেন। সহায়তার জন্য হেল্পলাইন 01791612121 নম্বরে যোগাযোগ করুন।',
                'student' => null,
            ];
        }

        // 2. Locate batch by batch_code or batch_number or id
        $batch = Batch::where('batch_code', $cleanBatch)
            ->orWhere('batch_number', $cleanBatch)
            ->orWhere('id', is_numeric($cleanBatch) ? (int)$cleanBatch : 0)
            ->first();

        // 3. Locate student by phone and batch
        $studentAccount = null;
        $parentStudent = null;

        if ($batch) {
            // Check student_accounts
            $studentAccount = StudentAccount::where(function ($q) use ($cleanPhone, $phone) {
                    $q->where('phone', $cleanPhone)
                      ->orWhere('phone', $phone)
                      ->orWhere('phone', 'LIKE', '%' . substr($cleanPhone, -10));
                })
                ->where(function ($q) use ($batch) {
                    $q->whereHas('admitedStudent', function ($sub) use ($batch) {
                        $sub->where('batch_id', $batch->id);
                    })
                    ->orWhereHas('enrollments', function ($sub) use ($batch) {
                        $sub->where('batch_id', $batch->id);
                    })
                    ->orWhereHas('student', function ($sub) use ($batch) {
                        $sub->where('batch_id', $batch->id);
                    });
                })
                ->first();

            // Also check parent students table
            if (!$studentAccount) {
                $parentStudent = Student::where(function ($q) use ($cleanPhone, $phone) {
                        $q->where('personal_call_no', $cleanPhone)
                          ->orWhere('personal_call_no', $phone)
                          ->orWhere('personal_call_no', 'LIKE', '%' . substr($cleanPhone, -10));
                    })
                    ->where('batch_id', $batch->id)
                    ->first();

                if ($parentStudent && $parentStudent->account) {
                    $studentAccount = $parentStudent->account;
                }
            }
        }

        // If not matched or no valid registration number found
        $regNumber = $studentAccount ? ($studentAccount->registration_number ?: $studentAccount->student_id_code) : ($parentStudent ? $parentStudent->registration_number : null);

        if (!$batch || (!$studentAccount && !$parentStudent) || empty($regNumber)) {
            // Increment failed attempt in log
            $newFailedTotal = $failedAttempts + 1;
            $newStatus = $newFailedTotal >= self::MAX_ATTEMPTS ? 'blocked' : 'failed';

            RegistrationVerification::create([
                'student_account_id' => null,
                'phone' => $cleanPhone ?: $phone,
                'batch_code' => $cleanBatch,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'attempts_count' => 1,
                'status' => $newStatus,
            ]);

            $remaining = max(0, self::MAX_ATTEMPTS - $newFailedTotal);

            if ($newStatus === 'blocked') {
                return [
                    'status' => 'blocked',
                    'is_blocked' => true,
                    'message' => 'আপনি সর্বোচ্চ ৩ বার ভুল তথ্য প্রদান করেছেন। নিরাপত্তার স্বার্থে স্বয়ংক্রিয় ভেরিফিকেশন ব্লক করা হয়েছে এবং অ্যাডমিন পর্যালোচনার জন্য জমা হয়েছে। অনুগ্রহ করে হেল্পলাইনে (01791612121) যোগাযোগ করুন।',
                    'student' => null,
                ];
            }

            return [
                'status' => 'failed',
                'is_blocked' => false,
                'remaining_attempts' => $remaining,
                'message' => 'আপনার প্রদত্ত মোবাইল নম্বর ও ব্যাচ কোডের সাথে আমাদের ডাটাবেজে সংরক্ষিত তথ্যের মিল পাওয়া যায়নি। অনুগ্রহ করে সঠিক তথ্য প্রদান করুন। অবশিষ্ট প্রচেষ্টা: ' . $remaining . ' বার।',
                'student' => null,
            ];
        }

        // 4. Verification matched!
        // Check if OTP verification is configured ON
        $otpEnabled = config('services.registration.otp_enabled', env('REGISTRATION_OTP_ENABLED', false));

        if ($otpEnabled && !$adminApprovedEntry) {
            $otpCode = (string)rand(100000, 999999);
            $otpExpiresAt = Carbon::now()->addMinutes(10);

            $verification = RegistrationVerification::create([
                'student_account_id' => $studentAccount ? $studentAccount->id : null,
                'phone' => $cleanPhone,
                'batch_code' => $batch->batch_code ?: $cleanBatch,
                'ip_address' => $ipAddress,
                'user_agent' => $userAgent,
                'attempts_count' => 1,
                'status' => 'pending',
                'otp_code' => $otpCode,
                'otp_expires_at' => $otpExpiresAt,
                'is_otp_verified' => false,
            ]);

            return [
                'status' => 'otp_required',
                'verification_id' => $verification->id,
                'masked_phone' => static::maskPhone($cleanPhone),
                'message' => 'আপনার নিবন্ধিত মোবাইল নম্বরে (' . static::maskPhone($cleanPhone) . ') ৬ ডিজিটের একটি ওটিপি কোড পাঠানো হয়েছে। কোডটি নিশ্চিত করুন।',
            ];
        }

        // OTP is disabled or Admin approved: Log success & return details
        RegistrationVerification::create([
            'student_account_id' => $studentAccount ? $studentAccount->id : null,
            'phone' => $cleanPhone,
            'batch_code' => $batch->batch_code ?: $cleanBatch,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'attempts_count' => 1,
            'status' => 'success',
            'action_at' => Carbon::now(),
        ]);

        $courseName = $studentAccount && $studentAccount->course ? $studentAccount->course->course_title : ($parentStudent && $parentStudent->course ? $parentStudent->course->course_title : ($batch->course ? $batch->course->course_title : 'N/A'));
        $studentName = $studentAccount ? $studentAccount->name : ($parentStudent ? $parentStudent->student_name : 'Registered Student');
        $regStatus = $studentAccount ? $studentAccount->registration_status : ($parentStudent ? $parentStudent->registration_status : 'pending');

        return [
            'status' => 'success',
            'is_blocked' => false,
            'student' => [
                'name' => $studentName,
                'registration_number' => $regNumber,
                'phone_masked' => static::maskPhone($cleanPhone),
                'batch_number' => $batch->batch_number,
                'batch_code' => $batch->batch_code,
                'course_title' => $courseName,
                'registration_status' => $regStatus ?: 'pending',
            ],
            'message' => 'ভেরিফিকেশন সফল হয়েছে। আপনার রেজিস্ট্রেশন বিবরণ নিচে প্রদর্শিত হলো।',
        ];
    }

    /**
     * Mask phone number for privacy (e.g. 01712345678 -> 017****5678)
     */
    public static function maskPhone($phone)
    {
        $len = strlen($phone);
        if ($len <= 6) {
            return $phone;
        }
        return substr($phone, 0, 3) . str_repeat('*', $len - 7) . substr($phone, -4);
    }
}

