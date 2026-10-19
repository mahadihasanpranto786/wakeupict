<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpgradeStudentsRegistrationFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('gander');
            }
            if (!Schema::hasColumn('students', 'guardian_call_no')) {
                $table->string('guardian_call_no', 50)->nullable()->after('personal_call_no');
            }
            if (!Schema::hasColumn('students', 'selected_courses')) {
                $table->text('selected_courses')->nullable()->after('course_fee');
            }
            if (!Schema::hasColumn('students', 'qualifications_data')) {
                $table->text('qualifications_data')->nullable()->after('passing_year');
            }
            if (!Schema::hasColumn('students', 'attachments_data')) {
                $table->text('attachments_data')->nullable()->after('student_photo');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'guardian_call_no',
                'selected_courses',
                'qualifications_data',
                'attachments_data',
            ]);
        });
    }
}
