<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsQuestionPapersAndBookTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Upgrade lms_questions to support Question Book library attributes
        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_questions', 'course_id')) {
                    $table->unsignedBigInteger('course_id')->nullable()->index()->after('quiz_id');
                }
                if (!Schema::hasColumn('lms_questions', 'academic_level')) {
                    $table->string('academic_level', 60)->nullable()->after('course_id');
                }
                if (!Schema::hasColumn('lms_questions', 'year')) {
                    $table->string('year', 20)->nullable()->after('topic');
                }
                if (!Schema::hasColumn('lms_questions', 'tags')) {
                    $table->text('tags')->nullable()->after('year');
                }
                if (!Schema::hasColumn('lms_questions', 'image_url')) {
                    $table->string('image_url', 255)->nullable()->after('tags');
                }
                if (!Schema::hasColumn('lms_questions', 'is_archived')) {
                    $table->boolean('is_archived')->default(false)->after('is_active');
                }
            });

            // Make quiz_id nullable if possible
            try {
                // In MySQL, modifying column requires doctrine/dbal or raw statement
                \DB::statement('ALTER TABLE `lms_questions` MODIFY `quiz_id` BIGINT UNSIGNED NULL');
            } catch (\Exception $e) {
                // If already nullable or DB engine doesn't allow raw statement, continue safely
            }
        }

        // 2. Question Papers Metadata Table
        if (!Schema::hasTable('lms_question_papers')) {
            Schema::create('lms_question_papers', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('paper_code', 50)->unique();
                $table->string('title', 200);
                $table->unsignedBigInteger('course_id')->nullable()->index();
                $table->string('class_level', 60)->nullable()->default('Class 9-10');
                $table->string('institution_name', 150)->default('Wake Up ICT Academy & Laboratory');
                $table->string('board_name', 100)->default('Wake Up ICT Technical & Educational Board');
                $table->string('exam_name', 150)->default('Annual Final Examination 2026');
                $table->string('subject_name', 150)->default('Information & Communication Technology');
                $table->string('subject_code', 20)->default('154');
                $table->string('academic_year', 20)->default('2026');
                $table->date('exam_date')->nullable();
                $table->integer('duration_minutes')->default(60);
                $table->decimal('total_marks', 8, 2)->default(100.00);
                $table->decimal('pass_marks', 8, 2)->default(40.00);
                $table->decimal('negative_marks', 8, 2)->default(0.00);
                $table->text('instructions')->nullable();
                $table->string('status', 30)->default('draft')->comment('draft, review, approved, published, archived');
                $table->string('layout_type', 40)->default('standard_board')->comment('standard_board, two_column, compact, creative_cq');
                $table->string('paper_set', 20)->default('Set A')->comment('Set A, Set B, Set C, Set D');
                $table->integer('version')->default(1);
                $table->unsignedBigInteger('master_paper_id')->nullable()->index()->comment('Parent paper if this is a variant/clone');
                $table->unsignedBigInteger('linked_quiz_id')->nullable()->index()->comment('Linked online quiz in lms_quizzes');
                $table->unsignedBigInteger('created_by')->nullable()->index();
                $table->timestamps();
            });
        }

        // 3. Question Paper Sections Table
        if (!Schema::hasTable('lms_question_paper_sections')) {
            Schema::create('lms_question_paper_sections', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('paper_id')->index();
                $table->string('title', 150)->default('Section A: Multiple Choice Questions (বহুনির্বাচনি অভীক্ষা)');
                $table->text('instructions')->nullable();
                $table->string('section_code', 20)->default('A');
                $table->integer('order_index')->default(1);
                $table->decimal('marks_per_question', 8, 2)->nullable();
                $table->decimal('total_marks', 8, 2)->default(0.00);
                $table->integer('required_questions_count')->nullable()->comment('For rules like Answer any 5 of 8');
                $table->timestamps();

                $table->foreign('paper_id')->references('id')->on('lms_question_papers')->onDelete('cascade');
            });
        }

        // 4. Question Paper Items (Ordered questions in paper with snapshot freezing)
        if (!Schema::hasTable('lms_question_paper_items')) {
            Schema::create('lms_question_paper_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('paper_id')->index();
                $table->unsignedBigInteger('section_id')->nullable()->index();
                $table->unsignedBigInteger('question_id')->nullable()->index()->comment('Master Question ID');
                $table->string('custom_question_number', 20)->nullable();
                $table->integer('order_index')->default(1);
                $table->decimal('marks', 8, 2)->default(1.00);
                $table->decimal('negative_marks', 8, 2)->default(0.00);
                $table->text('custom_instructions')->nullable();
                $table->longText('snapshot_data')->nullable()->comment('Immutable frozen JSON snapshot of question & options');
                $table->timestamps();

                $table->foreign('paper_id')->references('id')->on('lms_question_papers')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lms_question_paper_items');
        Schema::dropIfExists('lms_question_paper_sections');
        Schema::dropIfExists('lms_question_papers');

        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                $cols = ['course_id', 'academic_level', 'year', 'tags', 'image_url', 'is_archived'];
                foreach ($cols as $c) {
                    if (Schema::hasColumn('lms_questions', $c)) {
                        $table->dropColumn($c);
                    }
                }
            });
        }
    }
}
