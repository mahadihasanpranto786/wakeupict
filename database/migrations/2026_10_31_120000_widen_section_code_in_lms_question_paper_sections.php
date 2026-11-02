<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class WidenSectionCodeInLmsQuestionPaperSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('lms_question_paper_sections')) {
            try {
                DB::statement('ALTER TABLE lms_question_paper_sections MODIFY COLUMN section_code VARCHAR(100) NOT NULL DEFAULT "A"');
            } catch (\Exception $e) {
                // Fallback if sqlite or other driver
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
        if (Schema::hasTable('lms_question_paper_sections')) {
            try {
                DB::statement('ALTER TABLE lms_question_paper_sections MODIFY COLUMN section_code VARCHAR(20) NOT NULL DEFAULT "A"');
            } catch (\Exception $e) {
            }
        }
    }
}

