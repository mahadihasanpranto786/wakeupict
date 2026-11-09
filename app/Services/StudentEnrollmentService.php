<?php

namespace App\Services;

use App\model\Course;
use App\model\Batch;
use App\model\Student;
use App\model\StudentAccount;
use App\model\LmsEnrollment;
use App\model\AdmitedStudent;
use App\Services\RegistrationNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StudentEnrollmentService
{
    /**
     * Standardize phone number for reliable matching (e.g., +88017... / 88017... -> 017...)
     */
    public static function normalizePhone($phone)
    {
        if (empty($phone)) {
            return '';
        }

        // Convert any Bengali numerals to English
        $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $phone = str_replace($banglaDigits, $englishDigits, (string)$phone);

        // Remove whitespace, dashes, parens
        $cleaned = preg_replace('/[^\d+]/', '', trim($phone));

        // Strip leading +880 or 880
        if (strpos($cleaned, '+880') === 0) {
            $cleaned = '0' . substr($cleaned, 4);
        } elseif (strpos($cleaned, '880') === 0) {
            $cleaned = '0' . substr($cleaned, 3);
        } elseif (strpos($cleaned, '+88') === 0) {
            $cleaned = substr($cleaned, 3);
        }

        // Remove any residual + sign
        $digitsOnly = preg_replace('/[^\d]/', '', $cleaned);

        // If 10 digits and starts with 1 (e.g. 17XXXXXXXX), prepend 0
        if (strlen($digitsOnly) === 10 && $digitsOnly[0] === '1') {
            $digitsOnly = '0' . $digitsOnly;
        }

        return $digitsOnly;
    }

    /**
     * Safety Verification: Check if Phone and Email match two DIFFERENT existing accounts.
     * Prevents automatic merging of distinct student records.
     *
     * @return array ['has_conflict' => bool, 'message' => string]
     */
    public static function checkIdentityConflict($rawPhone, $rawEmail)
    {
        $cleanPhone = static::normalizePhone($rawPhone);
        $cleanEmail = !empty($rawEmail) ? trim(strtolower($rawEmail)) : null;

        // 1. Verify in StudentAccount (LMS Account)
        $accountByPhone = null;
        if (!empty($cleanPhone)) {
            $accountByPhone = StudentAccount::where(function ($q) use ($cleanPhone, $rawPhone) {
                $q->where('phone', $cleanPhone)
                  ->orWhere('phone', $rawPhone);
            })->first();
        }

        $accountByEmail = null;
        if (!empty($cleanEmail)) {
            $accountByEmail = StudentAccount::where('email', $cleanEmail)->first();
        }

        if ($accountByPhone && $accountByEmail && $accountByPhone->id !== $accountByEmail->id) {
            return [
                'has_conflict' => true,
                'source' => 'student_account',
                'phone_account_id' => $accountByPhone->id,
                'email_account_id' => $accountByEmail->id,
                'message' => "নিরাপত্তাজনিত সতর্কতা: আপনার মোবাইল নম্বর ({$rawPhone}) এবং ইমেইল ({$rawEmail}) সিস্টেমে দুইটি পৃথক স্টুডেন্ট অ্যাকাউন্টের সাথে যুক্ত রয়েছে। ভুল অ্যাকাউন্ট সংযুক্তিকরণ রোধে স্বয়ংক্রিয়ভাবে অ্যাকাউন্ট যুক্ত করা সম্ভব হচ্ছে না। অনুগ্রহ করে সঠিক তথ্য দিন অথবা অ্যাডমিন ভেরিফিকেশনের জন্য হেল্পলাইনে (01791612121) যোগাযোগ করুন।"
            ];
        }

        // 2. Verify in Student (Applied Records)
        $appliedByPhone = null;
        if (!empty($cleanPhone)) {
            $appliedByPhone = Student::where(function ($q) use ($cleanPhone, $rawPhone) {
                $q->where('personal_call_no', $cleanPhone)
                  ->orWhere('personal_call_no', $rawPhone);
            })->where('status', '!=', 0)->first();
        }

        $appliedByEmail = null;
        if (!empty($cleanEmail)) {
            $appliedByEmail = Student::where('email', $cleanEmail)->where('status', '!=', 0)->first();
        }

        if ($appliedByPhone && $appliedByEmail && $appliedByPhone->id !== $appliedByEmail->id) {
            $p1 = static::normalizePhone($appliedByPhone->personal_call_no);
            $p2 = static::normalizePhone($appliedByEmail->personal_call_no);
            if ($p1 !== $p2) {
                return [
                    'has_conflict' => true,
                    'source' => 'applied_student',
                    'phone_student_id' => $appliedByPhone->id,
                    'email_student_id' => $appliedByEmail->id,
                    'message' => "নিরাপত্তাজনিত সতর্কতা: আপনার মোবাইল নম্বর ({$rawPhone}) এবং ইমেইল ({$rawEmail}) পূর্বের দুইটি ভিন্ন আবেদন রেকর্ডের সাথে যুক্ত রয়েছে। অনুগ্রহ করে সঠিক তথ্য যাচাই করুন অথবা অ্যাডমিন ভেরিফিকেশনের জন্য হেল্পলাইনে (01791612121) যোগাযোগ করুন।"
                ];
            }
        }

        return ['has_conflict' => false];
    }

    /**
     * Locate existing StudentAccount by phone or email without conflict
     */
    public static function findExistingStudentAccount($rawPhone, $rawEmail)
    {
        $cleanPhone = static::normalizePhone($rawPhone);
        $cleanEmail = !empty($rawEmail) ? trim(strtolower($rawEmail)) : null;

        if (!empty($cleanPhone)) {
            $byPhone = StudentAccount::where('phone', $cleanPhone)
                ->orWhere('phone', $rawPhone)
                ->orWhere('phone', 'LIKE', '%' . substr($cleanPhone, -10))
                ->first();
            if ($byPhone) {
                return $byPhone;
            }
        }

        if (!empty($cleanEmail)) {
            $byEmail = StudentAccount::where('email', $cleanEmail)->first();
            if ($byEmail) {
                return $byEmail;
            }
        }

        return null;
    }

    /**
     * Locate existing Student application record by phone or email without conflict
     */
    public static function findExistingStudentRecord($rawPhone, $rawEmail)
    {
        $cleanPhone = static::normalizePhone($rawPhone);
        $cleanEmail = !empty($rawEmail) ? trim(strtolower($rawEmail)) : null;

        if (!empty($cleanPhone)) {
            $byPhone = Student::where(function ($q) use ($cleanPhone, $rawPhone) {
                $q->where('personal_call_no', $cleanPhone)
                  ->orWhere('personal_call_no', $rawPhone);
            })->where('status', '!=', 0)->latest('id')->first();
            if ($byPhone) {
                return $byPhone;
            }
        }

        if (!empty($cleanEmail)) {
            $byEmail = Student::where('email', $cleanEmail)
                ->where('status', '!=', 0)
                ->latest('id')
                ->first();
            if ($byEmail) {
                return $byEmail;
            }
        }

        return null;
    }

    /**
     * Check whether student is already enrolled or applied in a course
     */
    public static function isAlreadyEnrolledInCourse($courseId, $studentAccount = null, $studentRecord = null, $rawPhone = null)
    {
        $courseId = (int)$courseId;
        $cleanPhone = static::normalizePhone($rawPhone);

        // 1. Check LmsEnrollment
        if ($studentAccount) {
            $enrolled = LmsEnrollment::where('student_account_id', $studentAccount->id)
                ->where('course_id', $courseId)
                ->whereIn('status', ['active', 'applied', 'completed'])
                ->exists();
            if ($enrolled) {
                return true;
            }
        }

        // 2. Check AdmitedStudent
        if ($cleanPhone) {
            $admitted = AdmitedStudent::where(function ($q) use ($cleanPhone, $rawPhone) {
                $q->where('personal_call_no', $cleanPhone)
                  ->orWhere('personal_call_no', $rawPhone);
            })->where('course_id', $courseId)->where('status', '!=', 0)->exists();
            if ($admitted) {
                return true;
            }
        }

        // 3. Check Student (Applied) Record
        if ($studentRecord) {
            if ((int)$studentRecord->course_id === $courseId) {
                return true;
            }
            if (!empty($studentRecord->selected_courses)) {
                $sc = is_array($studentRecord->selected_courses) 
                    ? $studentRecord->selected_courses 
                    : json_decode($studentRecord->selected_courses, true);
                if (is_array($sc)) {
                    foreach ($sc as $item) {
                        if (isset($item['id']) && (int)$item['id'] === $courseId) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    /**
     * Process Application with Single Student Account & Multiple Course Enrollments
     * Guaranteed atomic through Database Transaction.
     *
     * @return array [
     *    'success' => bool,
     *    'status' => 'new_account_created' | 'existing_account_course_added' | 'already_enrolled' | 'conflict_error',
     *    'message' => string,
     *    'student_account' => StudentAccount|null,
     *    'student_record' => Student|null,
     *    'enrolled_courses' => array,
     *    'duplicate_courses' => array,
     *    'temp_password' => string|null,
     *    'student_id_code' => string|null,
     * ]
     */
    public static function processAdmissionApplication(array $data, Request $request)
    {
        $rawPhone = trim($data['personal_call_no'] ?? '');
        $rawEmail = trim($data['email'] ?? '');
        $cleanPhone = static::normalizePhone($rawPhone);

        // 1. Check Identity Conflict (Phone belongs to Account A, Email belongs to Account B)
        $conflictCheck = static::checkIdentityConflict($rawPhone, $rawEmail);
        if ($conflictCheck['has_conflict']) {
            return [
                'success' => false,
                'status' => 'conflict_error',
                'message' => $conflictCheck['message'],
            ];
        }

        // 2. Discover Existing Account & Student Record
        $existingAccount = static::findExistingStudentAccount($rawPhone, $rawEmail);
        $existingStudent = static::findExistingStudentRecord($rawPhone, $rawEmail);

        // 3. Collect requested courses
        $requestedCourseIds = $data['selected_course_ids'] ?? [];
        $primaryCourseId = (int)($data['course_id'] ?? 1);
        if (empty($requestedCourseIds)) {
            $requestedCourseIds = [$primaryCourseId];
        } elseif (!in_array($primaryCourseId, $requestedCourseIds)) {
            array_unshift($requestedCourseIds, $primaryCourseId);
        }

        $allCoursesModels = Course::whereIn('id', $requestedCourseIds)->get()->keyBy('id');

        // Check for duplicates
        $newCourseIdsToEnroll = [];
        $alreadyEnrolledCourses = [];

        foreach ($requestedCourseIds as $cId) {
            $isEnrolled = static::isAlreadyEnrolledInCourse(
                $cId, 
                $existingAccount, 
                $existingStudent, 
                $rawPhone
            );

            $courseModel = $allCoursesModels->get($cId);
            $cTitle = $courseModel ? $courseModel->course_title : "Course #{$cId}";

            if ($isEnrolled) {
                $alreadyEnrolledCourses[] = [
                    'id' => $cId,
                    'title' => $cTitle,
                ];
            } else {
                $newCourseIdsToEnroll[] = $cId;
            }
        }

        // If ALL requested courses are already enrolled, prevent duplicate application!
        if (empty($newCourseIdsToEnroll) && !empty($alreadyEnrolledCourses)) {
            $courseNames = implode(', ', array_column($alreadyEnrolledCourses, 'title'));
            return [
                'success' => false,
                'status' => 'already_enrolled',
                'message' => "আপনি ইতিমধ্যে '{$courseNames}' কোর্সে আবেদন/এনরোল করেছেন। একই কোর্সে পুনরায় আবেদন করার প্রয়োজন নেই। আপনি সরাসরি স্টুডেন্ট পোর্টালে লগইন করতে পারেন।",
                'student_account' => $existingAccount,
                'already_enrolled_courses' => $alreadyEnrolledCourses,
            ];
        }

        // 4. Execute atomic Database Transaction
        return DB::transaction(function () use (
            $data, 
            $request, 
            $rawPhone, 
            $cleanPhone, 
            $rawEmail, 
            $existingAccount, 
            $existingStudent, 
            $newCourseIdsToEnroll, 
            $alreadyEnrolledCourses, 
            $allCoursesModels,
            $primaryCourseId
        ) {
            $studentNameUpper = mb_strtoupper(trim($data['student_name']));
            $savePhotoUrl = $data['student_photo'] ?? null;
            $qualifications = $data['qualifications'] ?? [];
            $attachmentsData = $data['attachments_data'] ?? [];

            $primaryDegree = !empty($qualifications) ? $qualifications[0]['degree'] : ($data['educational_qualification'] ?? 'N/A');
            $primaryResult = !empty($qualifications) ? $qualifications[0]['result'] : ($data['result'] ?? 'N/A');
            $primaryYear = !empty($qualifications) ? $qualifications[0]['passing_year'] : ($data['passing_year'] ?? 'N/A');

            // Format selected courses list for storage
            $newCoursesData = [];
            $totalNewFee = 0;
            foreach ($newCourseIdsToEnroll as $cId) {
                $courseModel = $allCoursesModels->get($cId) ?: Course::find($cId);
                if ($courseModel) {
                    $feeVal = is_numeric($courseModel->price) 
                        ? (float)$courseModel->price 
                        : (float)preg_replace('/[^\d.]/', '', (string)$courseModel->price);
                    $totalNewFee += $feeVal;
                    $newCoursesData[] = [
                        'id' => $courseModel->id,
                        'title' => $courseModel->course_title,
                        'price' => $courseModel->price,
                    ];
                }
            }

            // Case A: Existing Student Record in `students` table
            $studentId = null;
            if ($existingStudent) {
                $studentId = $existingStudent->id;
                
                // Merge new courses into existing selected_courses array
                $currentCourses = !empty($existingStudent->selected_courses) 
                    ? (is_array($existingStudent->selected_courses) ? $existingStudent->selected_courses : json_decode($existingStudent->selected_courses, true))
                    : [];

                if (!is_array($currentCourses)) {
                    $currentCourses = [];
                }

                // Ensure primary course was included
                $hasPrimary = false;
                foreach ($currentCourses as $cc) {
                    if (isset($cc['id']) && (int)$cc['id'] === (int)$existingStudent->course_id) {
                        $hasPrimary = true;
                        break;
                    }
                }
                if (!$hasPrimary && $existingStudent->course_id) {
                    $pCourse = Course::find($existingStudent->course_id);
                    if ($pCourse) {
                        array_unshift($currentCourses, [
                            'id' => $pCourse->id,
                            'title' => $pCourse->course_title,
                            'price' => $pCourse->price,
                        ]);
                    }
                }

                // Add newly applied courses
                foreach ($newCoursesData as $ncd) {
                    $existsInList = false;
                    foreach ($currentCourses as $cc) {
                        if (isset($cc['id']) && (int)$cc['id'] === (int)$ncd['id']) {
                            $existsInList = true;
                            break;
                        }
                    }
                    if (!$existsInList) {
                        $currentCourses[] = $ncd;
                    }
                }

                $existingFee = is_numeric($existingStudent->course_fee) 
                    ? (float)$existingStudent->course_fee 
                    : (float)preg_replace('/[^\d.]/', '', (string)$existingStudent->course_fee);
                $updatedTotalFee = (string)($existingFee + $totalNewFee);

                // Non-destructive update: preserve existing student details, update courses and fee
                $existingStudent->selected_courses = json_encode($currentCourses, JSON_UNESCAPED_UNICODE);
                $existingStudent->course_fee = $updatedTotalFee;
                if ($savePhotoUrl && empty($existingStudent->student_photo)) {
                    $existingStudent->student_photo = $savePhotoUrl;
                }
                if (!empty($qualifications) && empty($existingStudent->qualifications_data)) {
                    $existingStudent->qualifications_data = json_encode($qualifications, JSON_UNESCAPED_UNICODE);
                }
                if (!empty($attachmentsData) && empty($existingStudent->attachments_data)) {
                    $existingStudent->attachments_data = json_encode($attachmentsData, JSON_UNESCAPED_UNICODE);
                }
                $existingStudent->save();
                $studentRecord = $existingStudent;
            } else {
                // Resolve Course and Batch for Registration Number generation
                $primaryCourseObj = Course::find($primaryCourseId);
                $courseCode = $primaryCourseObj && $primaryCourseObj->course_code ? $primaryCourseObj->course_code : '01';
                $batchObj = !empty($data['batch_id']) 
                    ? Batch::find($data['batch_id']) 
                    : Batch::where('course_id', $primaryCourseId)->where('status', 1)->where('active_batch', 1)->first();
                $batchCode = $batchObj && $batchObj->batch_code ? $batchObj->batch_code : '01';
                $academicYear = $batchObj && $batchObj->academic_year ? $batchObj->academic_year : date('Y');

                $regNumber = RegistrationNumberService::generate($academicYear, $batchCode, $courseCode);

                // New Student Application Row
                $finalFee = $totalNewFee > 0 ? (string)$totalNewFee : (string)($data['course_fee'] ?? 0);
                $studentId = Student::insertGetId([
                    'course_id' => $primaryCourseId,
                    'batch_id' => $batchObj ? $batchObj->id : null,
                    'registration_number' => $regNumber,
                    'registration_status' => 'pending',
                    'course_fee' => $finalFee,
                    'selected_courses' => !empty($newCoursesData) ? json_encode($newCoursesData, JSON_UNESCAPED_UNICODE) : null,
                    'student_name' => $studentNameUpper,
                    'gander' => $data['gander'] ?? '',
                    'date_of_birth' => !empty($data['date_of_birth']) ? $data['date_of_birth'] : null,
                    'fathers_name' => $data['fathers_name'] ?? '',
                    'mothers_name' => $data['mothers_name'] ?? '',
                    'nationality' => $data['nationality'] ?? 'Bangladeshi',
                    'national_id_no' => (!empty($data['id_type']) ? '[' . $data['id_type'] . '] ' : '') . ($data['national_id_no'] ?? ''),
                    'present_address' => $data['present_address'] ?? '',
                    'permanent_address' => $data['permanent_address'] ?? '',
                    'personal_call_no' => $cleanPhone ?: $rawPhone,
                    'guardian_call_no' => $data['guardian_call_no'] ?? null,
                    'email' => $rawEmail,
                    'religion' => $data['religion'] ?? '',
                    'occupation' => $data['occupation'] ?? '',
                    'age' => $data['age'] ?? '',
                    'educational_qualification' => $primaryDegree,
                    'result' => $primaryResult,
                    'passing_year' => $primaryYear,
                    'qualifications_data' => !empty($qualifications) ? json_encode($qualifications, JSON_UNESCAPED_UNICODE) : null,
                    'student_photo' => $savePhotoUrl,
                    'attachments_data' => !empty($attachmentsData) ? json_encode($attachmentsData, JSON_UNESCAPED_UNICODE) : null,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $studentRecord = Student::find($studentId);
            }

            // 5. Manage StudentAccount (One Account per student)
            $lastDigits = strlen($cleanPhone) >= 6 ? substr($cleanPhone, -6) : '123456';
            $tempPassword = $lastDigits;
            $isNewAccount = false;

            if ($existingAccount) {
                $studentAccount = $existingAccount;
                // Graceful update without resetting existing password
                $updateFields = [];
                if (empty($studentAccount->student_id)) {
                    $updateFields['student_id'] = $studentId;
                }
                if ($savePhotoUrl && empty($studentAccount->avatar)) {
                    $updateFields['avatar'] = $savePhotoUrl;
                }
                if ($rawEmail && empty($studentAccount->email)) {
                    $updateFields['email'] = $rawEmail;
                }
                if (!empty($updateFields)) {
                    $studentAccount->update($updateFields);
                }
            } else {
                $studentAccount = StudentAccount::create([
                    'student_id' => $studentId,
                    'student_id_code' => isset($regNumber) ? $regNumber : StudentAccount::generateUniqueStudentId(),
                    'registration_number' => isset($regNumber) ? $regNumber : null,
                    'registration_status' => 'pending',
                    'name' => $studentNameUpper,
                    'email' => $rawEmail ?: null,
                    'phone' => $cleanPhone ?: $rawPhone,
                    'password' => Hash::make($lastDigits),
                    'avatar' => $savePhotoUrl,
                    'status' => 1,
                    'meta' => [
                        'registered_from' => 'online_admission_form',
                        'student_record_id' => $studentId,
                        'temp_initial_pass' => true,
                    ],
                ]);
                $isNewAccount = true;
            }

            // 6. Create LmsEnrollment for all newly applied courses
            foreach ($newCourseIdsToEnroll as $cId) {
                LmsEnrollment::firstOrCreate([
                    'student_account_id' => $studentAccount->id,
                    'course_id' => $cId,
                ], [
                    'batch_id' => null,
                    'enrollment_type' => 'applied',
                    'status' => 'active',
                ]);
            }

            return [
                'success' => true,
                'status' => $isNewAccount ? 'new_account_created' : 'existing_account_course_added',
                'message' => $isNewAccount 
                    ? "আপনার স্টুডেন্ট অ্যাকাউন্ট ও কোর্স আবেদন সফলভাবে সম্পন্ন হয়েছে।" 
                    : "আপনার বিদ্যমান স্টুডেন্ট অ্যাকাউন্টে নতুন কোর্স সফলভাবে যুক্ত হয়েছে।",
                'is_new_account' => $isNewAccount,
                'student_account' => $studentAccount,
                'student_record' => $studentRecord,
                'enrolled_courses' => $newCoursesData,
                'already_enrolled_courses' => $alreadyEnrolledCourses,
                'temp_password' => $isNewAccount ? $tempPassword : null,
                'student_id_code' => $studentAccount->student_id_code,
            ];
        });
    }
}

