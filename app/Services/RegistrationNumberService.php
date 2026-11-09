<?php

namespace App\Services;

use App\model\RegistrationSequence;
use App\model\StudentAccount;
use App\model\Student;
use Illuminate\Support\Facades\DB;
use Exception;

class RegistrationNumberService
{
    /**
     * Generate an automatic, globally unique, concurrency-locked Registration Number.
     * Format: YYYYBBCCNNNN (e.g. 202605010001)
     * - YYYY = Academic Year (4 digits)
     * - BB   = Batch Code (2 digits)
     * - CC   = Course Code (2 digits)
     * - NNNN = 4-digit Sequential number for this (Year + Batch + Course)
     *
     * @param string|int $academicYear
     * @param string|int $batchCode
     * @param string|int $courseCode
     * @return string
     * @throws Exception
     */
    public static function generate($academicYear, $batchCode, $courseCode)
    {
        $year = !empty($academicYear) ? (string)preg_replace('/[^0-9]/', '', (string)$academicYear) : date('Y');
        if (strlen($year) < 4) {
            $year = date('Y');
        } else {
            $year = substr($year, 0, 4);
        }

        $cleanBatchCode = preg_replace('/[^0-9a-zA-Z]/', '', (string)$batchCode);
        $batchFormatted = !empty($cleanBatchCode) ? (strlen($cleanBatchCode) < 2 ? str_pad($cleanBatchCode, 2, '0', STR_PAD_LEFT) : $cleanBatchCode) : '01';

        $cleanCourseCode = preg_replace('/[^0-9a-zA-Z]/', '', (string)$courseCode);
        $courseFormatted = !empty($cleanCourseCode) ? (strlen($cleanCourseCode) < 2 ? str_pad($cleanCourseCode, 2, '0', STR_PAD_LEFT) : $cleanCourseCode) : '01';

        return DB::transaction(function () use ($year, $batchFormatted, $courseFormatted) {
            // 1. Ensure sequence record exists (concurrency-safe)
            $existing = DB::table('registration_sequences')
                ->where('academic_year', $year)
                ->where('batch_code', $batchFormatted)
                ->where('course_code', $courseFormatted)
                ->first();

            if (!$existing) {
                try {
                    DB::table('registration_sequences')->insert([
                        'academic_year' => $year,
                        'batch_code' => $batchFormatted,
                        'course_code' => $courseFormatted,
                        'last_serial' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } catch (\Exception $e) {
                    // In case another simultaneous worker inserted it
                }
            }

            // 2. Lock sequence row for exclusive update
            $sequence = DB::table('registration_sequences')
                ->where('academic_year', $year)
                ->where('batch_code', $batchFormatted)
                ->where('course_code', $courseFormatted)
                ->lockForUpdate()
                ->first();

            $nextSerial = ($sequence ? (int)$sequence->last_serial : 0) + 1;

            // 3. Collision-safe verification against existing records in student_accounts & students
            do {
                $registrationNumber = sprintf('%s%s%s%04d', $year, $batchFormatted, $courseFormatted, $nextSerial);

                $takenInAccounts = DB::table('student_accounts')
                    ->where('registration_number', $registrationNumber)
                    ->exists();

                $takenInStudents = DB::table('students')
                    ->where('registration_number', $registrationNumber)
                    ->exists();

                if (!$takenInAccounts && !$takenInStudents) {
                    break;
                }

                $nextSerial++;
            } while (true);

            // 4. Update sequence counter atomically
            DB::table('registration_sequences')
                ->where('academic_year', $year)
                ->where('batch_code', $batchFormatted)
                ->where('course_code', $courseFormatted)
                ->update([
                    'last_serial' => $nextSerial,
                    'updated_at' => now(),
                ]);

            return $registrationNumber;
        });
    }
}

