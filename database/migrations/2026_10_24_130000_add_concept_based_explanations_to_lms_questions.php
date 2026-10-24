<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConceptBasedExplanationsToLmsQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_questions', 'concept_title')) {
                    $table->string('concept_title', 255)->nullable()->index()->after('topic');
                }
                if (!Schema::hasColumn('lms_questions', 'concept_explanation')) {
                    $table->mediumText('concept_explanation')->nullable()->after('explanation');
                }
                if (!Schema::hasColumn('lms_questions', 'step_by_step_solution')) {
                    $table->text('step_by_step_solution')->nullable()->after('concept_explanation');
                }
                if (!Schema::hasColumn('lms_questions', 'important_rules')) {
                    $table->text('important_rules')->nullable()->after('step_by_step_solution');
                }
                if (!Schema::hasColumn('lms_questions', 'why_other_options_wrong')) {
                    $table->text('why_other_options_wrong')->nullable()->after('important_rules');
                }
                if (!Schema::hasColumn('lms_questions', 'common_mistakes')) {
                    $table->text('common_mistakes')->nullable()->after('why_other_options_wrong');
                }
                if (!Schema::hasColumn('lms_questions', 'memory_aid')) {
                    $table->text('memory_aid')->nullable()->after('common_mistakes');
                }
                if (!Schema::hasColumn('lms_questions', 'explanation_status')) {
                    $table->string('explanation_status', 30)->default('verified')->after('memory_aid');
                }
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
        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                $cols = [
                    'concept_title',
                    'concept_explanation',
                    'step_by_step_solution',
                    'important_rules',
                    'why_other_options_wrong',
                    'common_mistakes',
                    'memory_aid',
                    'explanation_status'
                ];
                foreach ($cols as $c) {
                    if (Schema::hasColumn('lms_questions', $c)) {
                        $table->dropColumn($c);
                    }
                }
            });
        }
    }
}
