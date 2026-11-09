<?php

namespace App\Services;

use App\model\Student;
use App\model\AdmitedStudent;
use App\model\StudentAccount;
use App\model\StudentPayment;
use App\model\Income;
use App\model\LmsEnrollment;
use App\model\LmsQuizAttempt;
use App\model\LmsQuizAnswer;
use App\model\LmsExamViolation;
use App\model\LmsStudentQuestionHistory;
use App\model\RegistrationVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class StudentDeletionService
{
    /**
     * Soft delete an Applied Student and deactivate related accounts
     */
    public static function softDeleteStudent($studentId)
    {
        $student = Student::findOrFail($studentId);
        $phone = $student->personal_call_no;
        $reg = $student->registration_number;

        // Deactivate Student
        $student->update(['status' => 0]);

        // Deactivate linked Student Accounts
        if (!empty($phone) || !empty($reg)) {
            StudentAccount::where(function ($q) use ($phone, $reg) {
                if ($phone) $q->where('phone', $phone);
                if ($reg) $q->orWhere('registration_number', $reg);
            })->update([
                'status' => 0,
                'registration_status' => 'rejected',
                'rejection_reason' => 'Student record deactivated / soft deleted',
            ]);
        }

        // Deactivate linked Admitted Student
        if (!empty($phone) || !empty($reg)) {
            $admitted = AdmitedStudent::where(function ($q) use ($phone, $reg) {
                if ($phone) $q->where('personal_call_no', $phone);
                if ($reg) $q->orWhere('registration_number', $reg);
            })->get();

            foreach ($admitted as $adm) {
                $adm->update(['status' => 0]);
                // Deactivate payments
                $payments = StudentPayment::where('student_id', $adm->id)->get();
                foreach ($payments as $p) {
                    $p->update(['status' => 0]);
                    if ($p->income_id) {
                        Income::where('id', $p->income_id)->update(['status' => 0]);
                    }
                }
            }
        }

        return true;
    }

    /**
     * Permanently delete an Applied Student and cascade all related data
     */
    public static function permanentDeleteStudent($studentId)
    {
        return DB::transaction(function () use ($studentId) {
            $student = Student::find($studentId);
            if (!$student) {
                return false;
            }

            $phone = $student->personal_call_no;
            $reg = $student->registration_number;

            // 1. Delete associated Student Accounts & LMS history
            if (!empty($phone) || !empty($reg)) {
                $accounts = StudentAccount::where(function ($q) use ($phone, $reg, $studentId) {
                    if ($phone) $q->where('phone', $phone);
                    if ($reg) $q->orWhere('registration_number', $reg);
                    $q->orWhere('student_id', $studentId);
                })->get();

                foreach ($accounts as $acc) {
                    self::cleanAccountLmsData($acc->id);
                    $acc->delete();
                }
            }

            // 2. Delete associated Admitted Students & Payments & Income
            if (!empty($phone) || !empty($reg)) {
                $admitted = AdmitedStudent::where(function ($q) use ($phone, $reg) {
                    if ($phone) $q->where('personal_call_no', $phone);
                    if ($reg) $q->orWhere('registration_number', $reg);
                })->get();

                foreach ($admitted as $adm) {
                    $payments = StudentPayment::where('student_id', $adm->id)->get();
                    foreach ($payments as $p) {
                        if ($p->income_id) {
                            Income::where('id', $p->income_id)->delete();
                        }
                        $p->delete();
                    }
                    $adm->delete();
                }
            }

            // 3. Delete registration verification audit logs
            if (!empty($phone)) {
                RegistrationVerification::where('phone', $phone)->delete();
            }

            // 4. Delete uploaded photo if exists
            if (!empty($student->student_photo) && File::exists(public_path($student->student_photo))) {
                @unlink(public_path($student->student_photo));
            }

            // 5. Delete Student Master Record
            $student->delete();

            return true;
        });
    }

    /**
     * Soft delete an Admitted Student and deactivate related accounts
     */
    public static function softDeleteAdmitedStudent($admittedId)
    {
        $admited = AdmitedStudent::findOrFail($admittedId);
        $phone = $admited->personal_call_no;
        $reg = $admited->registration_number;

        // Deactivate Admitted Student
        $admited->update(['status' => 0]);

        // Deactivate payments & income
        $payments = StudentPayment::where('student_id', $admittedId)->get();
        foreach ($payments as $p) {
            $p->update(['status' => 0]);
            if ($p->income_id) {
                Income::where('id', $p->income_id)->update(['status' => 0]);
            }
        }

        // Deactivate linked Student Accounts
        if (!empty($phone) || !empty($reg)) {
            StudentAccount::where(function ($q) use ($phone, $reg, $admittedId) {
                if ($phone) $q->where('phone', $phone);
                if ($reg) $q->orWhere('registration_number', $reg);
                $q->orWhere('admited_student_id', $admittedId);
            })->update([
                'status' => 0,
                'registration_status' => 'rejected',
                'rejection_reason' => 'Admitted student record deactivated',
            ]);
        }

        // Deactivate applied Student record
        if (!empty($phone) || !empty($reg)) {
            Student::where(function ($q) use ($phone, $reg) {
                if ($phone) $q->where('personal_call_no', $phone);
                if ($reg) $q->orWhere('registration_number', $reg);
            })->update(['status' => 0]);
        }

        return true;
    }

    /**
     * Permanently delete an Admitted Student and cascade all related data
     */
    public static function permanentDeleteAdmitedStudent($admittedId)
    {
        return DB::transaction(function () use ($admittedId) {
            $admited = AdmitedStudent::find($admittedId);
            if (!$admited) {
                return false;
            }

            $phone = $admited->personal_call_no;
            $reg = $admited->registration_number;

            // 1. Delete payments & incomes
            $payments = StudentPayment::where('student_id', $admittedId)->get();
            foreach ($payments as $p) {
                if ($p->income_id) {
                    Income::where('id', $p->income_id)->delete();
                }
                $p->delete();
            }

            // 2. Delete Student Accounts
            if (!empty($phone) || !empty($reg)) {
                $accounts = StudentAccount::where(function ($q) use ($phone, $reg, $admittedId) {
                    if ($phone) $q->where('phone', $phone);
                    if ($reg) $q->orWhere('registration_number', $reg);
                    $q->orWhere('admited_student_id', $admittedId);
                })->get();

                foreach ($accounts as $acc) {
                    self::cleanAccountLmsData($acc->id);
                    $acc->delete();
                }
            }

            // 3. Delete Applied Student
            if (!empty($phone) || !empty($reg)) {
                $students = Student::where(function ($q) use ($phone, $reg) {
                    if ($phone) $q->where('personal_call_no', $phone);
                    if ($reg) $q->orWhere('registration_number', $reg);
                })->get();
                foreach ($students as $st) {
                    $st->delete();
                }
            }

            // 4. Delete registration verifications
            if (!empty($phone)) {
                RegistrationVerification::where('phone', $phone)->delete();
            }

            // 5. Delete Admitted Student Record
            $admited->delete();

            return true;
        });
    }

    /**
     * Soft delete Student Account (deactivate)
     */
    public static function softDeleteStudentAccount($accountId)
    {
        $account = StudentAccount::findOrFail($accountId);
        $account->update([
            'status' => 0,
            'registration_status' => 'rejected',
            'rejection_reason' => 'Account deactivated by admin',
        ]);

        return true;
    }

    /**
     * Permanently delete Student Account and cascade LMS enrollments
     */
    public static function permanentDeleteStudentAccount($accountId, $cascadeMasterRecords = false)
    {
        return DB::transaction(function () use ($accountId, $cascadeMasterRecords) {
            $account = StudentAccount::find($accountId);
            if (!$account) {
                return false;
            }

            $phone = $account->phone;
            $reg = $account->registration_number;

            // Clean up LMS
            self::cleanAccountLmsData($accountId);

            // Clean registration verifications
            if (!empty($phone)) {
                RegistrationVerification::where('phone', $phone)->delete();
            }

            // If user explicitly asks to cascade master records as well
            if ($cascadeMasterRecords) {
                if (!empty($phone) || !empty($reg)) {
                    // Admitted
                    $admitted = AdmitedStudent::where(function ($q) use ($phone, $reg) {
                        if ($phone) $q->where('personal_call_no', $phone);
                        if ($reg) $q->orWhere('registration_number', $reg);
                    })->get();
                    foreach ($admitted as $adm) {
                        $payments = StudentPayment::where('student_id', $adm->id)->get();
                        foreach ($payments as $p) {
                            if ($p->income_id) Income::where('id', $p->income_id)->delete();
                            $p->delete();
                        }
                        $adm->delete();
                    }

                    // Applied Student
                    $students = Student::where(function ($q) use ($phone, $reg) {
                        if ($phone) $q->where('personal_call_no', $phone);
                        if ($reg) $q->orWhere('registration_number', $reg);
                    })->get();
                    foreach ($students as $st) {
                        $st->delete();
                    }
                }
            }

            $account->delete();
            return true;
        });
    }

    /**
     * Helper to clean up LMS enrollments, quiz attempts, and violations
     */
    private static function cleanAccountLmsData($accountId)
    {
        try {
            LmsEnrollment::where('student_id', $accountId)->delete();
            LmsQuizAttempt::where('student_id', $accountId)->delete();
            LmsExamViolation::where('student_id', $accountId)->delete();
            LmsStudentQuestionHistory::where('student_id', $accountId)->delete();
        } catch (\Exception $e) {
            // Keep resilient if table differs
        }
    }

    /**
     * Bulk Soft Delete
     */
    public static function bulkSoftDelete($targetType, array $ids)
    {
        $count = 0;
        foreach ($ids as $id) {
            if ($targetType === 'applied') {
                if (self::softDeleteStudent($id)) $count++;
            } elseif ($targetType === 'admitted') {
                if (self::softDeleteAdmitedStudent($id)) $count++;
            } elseif ($targetType === 'account') {
                if (self::softDeleteStudentAccount($id)) $count++;
            }
        }
        return $count;
    }

    /**
     * Bulk Permanent Delete
     */
    public static function bulkPermanentDelete($targetType, array $ids, $cascadeMaster = true)
    {
        $count = 0;
        foreach ($ids as $id) {
            if ($targetType === 'applied') {
                if (self::permanentDeleteStudent($id)) $count++;
            } elseif ($targetType === 'admitted') {
                if (self::permanentDeleteAdmitedStudent($id)) $count++;
            } elseif ($targetType === 'account') {
                if (self::permanentDeleteStudentAccount($id, $cascadeMaster)) $count++;
            }
        }
        return $count;
    }
}
