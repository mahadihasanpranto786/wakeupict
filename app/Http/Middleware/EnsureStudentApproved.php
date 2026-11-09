<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureStudentApproved
{
    /**
     * Handle an incoming request.
     * Enforces that only verified, administrator-approved students can access the student portal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $student = Auth::guard('student')->user();

        if ($student) {
            // Check registration approval status
            if ($student->registration_status === 'pending') {
                Auth::guard('student')->logout();
                return redirect()->route('student.login')->withErrors([
                    'login_id' => 'আপনার রেজিস্ট্রেশনটি বর্তমানে অ্যাডমিন ভেরিফিকেশনের জন্য অপেক্ষমাণ (Pending) রয়েছে। অ্যাডমিন অনুমোদন করার পর স্টুডেন্ট পোর্টাল অ্যাক্সেস সক্রিয় হবে। অনুগ্রহ করে অপেক্ষা করুন অথবা 01791612121 নম্বরে যোগাযোগ করুন।',
                ]);
            }

            if ($student->registration_status === 'rejected') {
                $reason = !empty($student->rejection_reason) ? ' (কারণ: ' . $student->rejection_reason . ')' : '';
                Auth::guard('student')->logout();
                return redirect()->route('student.login')->withErrors([
                    'login_id' => 'আপনার রেজিস্ট্রেশন আবেদনটি অ্যাডমিন কর্তৃক বাতিল (Rejected) করা হয়েছে' . $reason . '। স্টুডেন্ট পোর্টাল অ্যাক্সেস বন্ধ রয়েছে।',
                ]);
            }

            // Check batch duration expiration (End Date Over -> Close Access)
            $batch = $student->batch;
            if ($batch && $batch->end_date && \Carbon\Carbon::parse($batch->end_date)->endOfDay()->isPast()) {
                $batchName = $batch->batch_number ?: 'ব্যাচ';
                $endDateStr = \Carbon\Carbon::parse($batch->end_date)->format('d M, Y');
                Auth::guard('student')->logout();
                return redirect()->route('student.login')->withErrors([
                    'login_id' => "আপনার {$batchName}-এর নির্ধারিত মেয়াদ ({$endDateStr}) সমাপ্ত হয়েছে। স্টুডেন্ট পোর্টাল অ্যাক্সেস বন্ধ রয়েছে। বিস্তারিত তথ্যের জন্য হেল্পলাইন 01791612121 নম্বরে যোগাযোগ করুন।",
                ]);
            }

            if ($student->status != 1) {
                Auth::guard('student')->logout();
                return redirect()->route('student.login')->withErrors([
                    'login_id' => 'আপনার স্টুডেন্ট অ্যাকাউন্টটি সাময়িকভাবে স্থগিত রয়েছে। সহায়তার জন্য অ্যাডমিনের সাথে যোগাযোগ করুন।',
                ]);
            }
        }

        return $next($request);
    }
}

