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
     * - NNNN = 4-digit Sequential number globally unique across ALL students
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
            // Global sequence tracker for this academic year across all batches and courses
            $globalKeyBatch = 'GLOBAL';
            $globalKeyCourse = 'ALL';

            $existing = DB::table('registration_sequences')
                ->where('academic_year', $year)
                ->where('batch_code', $globalKeyBatch)
                ->where('course_code', $globalKeyCourse)
                ->first();

            if (!$existing) {
                // Determine base starting serial from total existing students
                $totalExisting = DB::table('student_accounts')->count() + DB::table('students')->count();
                try {
                    DB::table('registration_sequences')->insert([
                        'academic_year' => $year,
                        'batch_code'    => $globalKeyBatch,
                        'course_code'   => $globalKeyCourse,
                        'last_serial'   => $totalExisting,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                } catch (\Exception $e) {
                    // Handled if concurrent insert
                }
            }

            // Lock global sequence row
            $sequence = DB::table('registration_sequences')
                ->where('academic_year', $year)
                ->where('batch_code', $globalKeyBatch)
                ->where('course_code', $globalKeyCourse)
                ->lockForUpdate()
                ->first();

            $nextSerial = ($sequence ? (int)$sequence->last_serial : 0) + 1;

            // Ensure uniqueness across the entire system: no two students share the same sequential suffix or registration number
            do {
                $suffix = sprintf('%04d', $nextSerial);
                $registrationNumber = sprintf('%s%s%s%s', $year, $batchFormatted, $courseFormatted, $suffix);

                $takenInAccounts = DB::table('student_accounts')
                    ->where('registration_number', $registrationNumber)
                    ->orWhere('registration_number', 'LIKE', '%' . $suffix)
                    ->exists();

                $takenInStudents = DB::table('students')
                    ->where('registration_number', $registrationNumber)
                    ->orWhere('registration_number', 'LIKE', '%' . $suffix)
                    ->exists();

                if (!$takenInAccounts && !$takenInStudents) {
                    break;
                }

                $nextSerial++;
            } while (true);

            // Update atomic sequence counter
            DB::table('registration_sequences')
                ->where('academic_year', $year)
                ->where('batch_code', $globalKeyBatch)
                ->where('course_code', $globalKeyCourse)
                ->update([
                    'last_serial' => $nextSerial,
                    'updated_at'  => now(),
                ]);

            return $registrationNumber;
        });
    }
}
