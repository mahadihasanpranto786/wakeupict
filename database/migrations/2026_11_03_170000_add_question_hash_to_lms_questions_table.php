<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\model\LmsQuestion;
use App\model\LmsQuizAnswer;
use App\model\LmsQuestionOption;
use App\model\LmsQuestionPaperItem;
use App\model\LmsStudentQuestionHistory;

class AddQuestionHashToLmsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('lms_questions') && !Schema::hasColumn('lms_questions', 'question_hash')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                $table->string('question_hash', 64)->nullable()->index()->after('question_text');
            });
        }

        // Backfill hash and clean up duplicate questions across the database
        $this->backfillHashesAndDeduplicate();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('lms_questions') && Schema::hasColumn('lms_questions', 'question_hash')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                $table->dropIndex(['question_hash']);
                $table->dropColumn('question_hash');
            });
        }
    }

    /**
     * Compute hash and merge existing duplicate questions
     */
    protected function backfillHashesAndDeduplicate()
    {
        if (!Schema::hasTable('lms_questions')) {
            return;
        }

        $allQuestions = LmsQuestion::orderBy('id', 'asc')->get();
        $seen = [];
        $duplicatesToDelete = [];

        foreach ($allQuestions as $q) {
            $hash = LmsQuestion::hashText($q->question_text);
            $q->question_hash = $hash;
            $q->save();

            if (isset($seen[$hash])) {
                $primaryId = $seen[$hash]->id;
                $dupId = $q->id;

                // Re-point answers to primary question
                LmsQuizAnswer::where('question_id', $dupId)->update(['question_id' => $primaryId]);

                // Re-point paper items if primary not already in paper
                $paperItems = LmsQuestionPaperItem::where('question_id', $dupId)->get();
                foreach ($paperItems as $pi) {
                    $existsInPaper = LmsQuestionPaperItem::where('paper_id', $pi->paper_id)
                        ->where('question_id', $primaryId)
                        ->exists();
                    if ($existsInPaper) {
                        $pi->delete();
                    } else {
                        $pi->update(['question_id' => $primaryId]);
                    }
                }

                // Re-point or delete student history
                LmsStudentQuestionHistory::where('question_id', $dupId)->delete();

                $duplicatesToDelete[] = $dupId;
            } else {
                $seen[$hash] = $q;
            }
        }

        if (!empty($duplicatesToDelete)) {
            LmsQuestionOption::whereIn('question_id', $duplicatesToDelete)->delete();
            LmsQuestion::whereIn('id', $duplicatesToDelete)->delete();
        }
    }
}

