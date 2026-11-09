<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddPlainPasswordAndPopulateCourseCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Add plain_password column to student_accounts table
        if (Schema::hasTable('student_accounts') && !Schema::hasColumn('student_accounts', 'plain_password')) {
            Schema::table('student_accounts', function (Blueprint $table) {
                $table->string('plain_password', 255)->nullable()->after('password');
            });
        }

        // 2. Populate plain_password for existing student accounts
        if (Schema::hasTable('student_accounts') && Schema::hasColumn('student_accounts', 'plain_password')) {
            $accounts = DB::table('student_accounts')->whereNull('plain_password')->get();
            foreach ($accounts as $acc) {
                $cleanPhone = preg_replace('/[^0-9]/', '', (string)$acc->phone);
                $pass = strlen($cleanPhone) >= 6 ? substr($cleanPhone, -6) : '123456';
                DB::table('student_accounts')->where('id', $acc->id)->update([
                    'plain_password' => $pass,
                ]);
            }
        }

        // 3. Assign unique zero-padded 2-digit course codes to courses
        if (Schema::hasTable('courses') && Schema::hasColumn('courses', 'course_code')) {
            $predefined = [
                1  => '01', // গ্রাফিক্স ডিজাইন কোর্স
                2  => '02', // ডিজিটাল মার্কেটিং কোর্স
                3  => '03', // ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স
                4  => '04', // অ্যাডভান্স গ্রাফিক ডিজাইন কোর্স
                6  => '05', // এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স
                10 => '06', // Microsoft Office Applications (BTEB Certified)
                11 => '07', // Artificial Intelligence & Modern Tools (AI)
                12 => '08', // Academic ICT (Classes 6–10 NCTB Curriculum)
                13 => '09', // Microsoft Office Applications (General Practical Course)
            ];

            foreach ($predefined as $courseId => $code) {
                DB::table('courses')
                    ->where('id', $courseId)
                    ->where(function ($query) {
                        $query->whereNull('course_code')
                              ->orWhere('course_code', '');
                    })
                    ->update(['course_code' => $code]);
            }

            // Fallback for any other remaining course without a code
            $usedCodes = DB::table('courses')
                ->whereNotNull('course_code')
                ->where('course_code', '!=', '')
                ->pluck('course_code')
                ->toArray();

            $remainingCourses = DB::table('courses')
                ->where(function ($query) {
                    $query->whereNull('course_code')
                          ->orWhere('course_code', '');
                })
                ->orderBy('id', 'asc')
                ->get();

            $nextCode = 1;
            foreach ($remainingCourses as $rc) {
                while (in_array(str_pad((string)$nextCode, 2, '0', STR_PAD_LEFT), $usedCodes)) {
                    $nextCode++;
                }
                $assignedCode = str_pad((string)$nextCode, 2, '0', STR_PAD_LEFT);
                $usedCodes[] = $assignedCode;
                DB::table('courses')->where('id', $rc->id)->update(['course_code' => $assignedCode]);
                $nextCode++;
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('student_accounts') && Schema::hasColumn('student_accounts', 'plain_password')) {
            Schema::table('student_accounts', function (Blueprint $table) {
                $table->dropColumn('plain_password');
            });
        }
    }
}

