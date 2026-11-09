<?php

namespace App\Services;

use App\model\LmsQuestion;
use App\model\LmsQuiz;
use App\model\LmsQuizAttempt;
use App\model\LmsQuizAnswer;
use App\model\LmsStudentQuestionHistory;
use App\model\AppearanceSetting;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PracticeQuestionRotationService
{
    /**
     * Default question count and duration tiers
     *
     * @return array
     */
    /**
     * Convert Bengali numerals (০-৯) to standard English ASCII digits (0-9)
     *
     * @param mixed $value
     * @return mixed
     */
    public static function toEnglishDigits($value)
    {
        if ($value === null || $value === '') {
            return $value;
        }
        if (is_array($value)) {
            return array_map([self::class, 'toEnglishDigits'], $value);
        }
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($bn, $en, (string)$value);
    }

    public static function getDefaultTiers()
    {
        return [
            ['questions' => 10, 'duration' => 10, 'pass_marks' => 4,  'label' => '১০ টি প্রশ্ন (১০ মিনিট — পাস: ৪)'],
            ['questions' => 15, 'duration' => 15, 'pass_marks' => 6,  'label' => '১৫ টি প্রশ্ন (১৫ মিনিট — পাস: ৬)'],
            ['questions' => 20, 'duration' => 20, 'pass_marks' => 8,  'label' => '২০ টি প্রশ্ন (২০ মিনিট — স্ট্যান্ডার্ড, পাস: ৮)'],
            ['questions' => 25, 'duration' => 25, 'pass_marks' => 10, 'label' => '২৫ টি প্রশ্ন (২৫ মিনিট — বোর্ড স্ট্যান্ডার্ড, পাস: ১০)'],
            ['questions' => 30, 'duration' => 30, 'pass_marks' => 12, 'label' => '৩০ টি প্রশ্ন (৩০ মিনিট — পাস: ১২)'],
            ['questions' => 50, 'duration' => 45, 'pass_marks' => 20, 'label' => '৫০ টি প্রশ্ন (৪৫ মিনিট — ম্যারাথন প্র্যাকটিস, পাস: ২০)'],
        ];
    }

    /**
     * Retrieve practice exam system settings configured by Admin
     *
     * @return array
     */
    public static function getSettings()
    {
        $attemptLimitType = AppearanceSetting::getVal('practice_exam_attempt_limit_type', 'unlimited');
        $maxAttempts = (int) AppearanceSetting::getVal('practice_exam_max_attempts', 0);
        
        if ($attemptLimitType === 'single') {
            $maxAttempts = 1;
        } elseif ($attemptLimitType === 'unlimited') {
            $maxAttempts = 0;
        }

        $rawTiers = AppearanceSetting::getVal('practice_exam_tiers');
        $tiers = [];
        if (!empty($rawTiers)) {
            $decoded = is_string($rawTiers) ? json_decode($rawTiers, true) : $rawTiers;
            if (is_array($decoded) && !empty($decoded)) {
                $tiers = [];
                foreach ($decoded as $dec) {
                    $q = (int)self::toEnglishDigits($dec['questions'] ?? 0);
                    $d = (int)self::toEnglishDigits($dec['duration'] ?? 0);
                    $p = isset($dec['pass_marks']) ? (float)self::toEnglishDigits($dec['pass_marks']) : round($q * 0.4, 1);
                    $lbl = $dec['label'] ?? "{$q} টি প্রশ্ন ({$d} মিনিট)";
                    if ($q > 0 && $d > 0) {
                        $tiers[] = [
                            'questions'  => $q,
                            'duration'   => $d,
                            'pass_marks' => $p,
                            'label'      => $lbl,
                        ];
                    }
                }
            }
        }
        if (empty($tiers)) {
            $tiers = self::getDefaultTiers();
        }

        $defaultQuestionCount = (int) AppearanceSetting::getVal('practice_exam_question_count', 0);
        $defaultDuration = (int) AppearanceSetting::getVal('practice_exam_duration_minutes', 0);

        if ($defaultQuestionCount <= 0 && !empty($tiers)) {
            $defaultQuestionCount = (int)$tiers[0]['questions'];
            $defaultDuration = (int)$tiers[0]['duration'];
        } elseif ($defaultQuestionCount <= 0) {
            $defaultQuestionCount = 20;
            $defaultDuration = 20;
        }

        $markPerQuestion = (float) AppearanceSetting::getVal('practice_exam_mark_per_question', 1.0);
        $passPercentage = (float) AppearanceSetting::getVal('practice_exam_pass_percentage', 40.0);
        $negMarkingEnabled = (bool) AppearanceSetting::getVal('practice_exam_negative_marking_enabled', 0);
        $negMarkValue = (float) AppearanceSetting::getVal('practice_exam_negative_mark_value', 0.25);

        return [
            'question_count'           => $defaultQuestionCount,
            'duration_minutes'         => $defaultDuration > 0 ? $defaultDuration : 20,
            'tiers'                    => $tiers,
            'view_mode'                => AppearanceSetting::getVal('practice_exam_view_mode', 'all_questions'),
            'attempt_limit_type'       => $attemptLimitType,
            'max_attempts'             => $maxAttempts,
            'allow_category_choice'    => (bool) AppearanceSetting::getVal('practice_exam_allow_category_choice', 1),
            'mark_per_question'        => $markPerQuestion > 0 ? $markPerQuestion : 1.0,
            'pass_percentage'          => $passPercentage > 0 ? $passPercentage : 40.0,
            'negative_marking_enabled' => $negMarkingEnabled,
            'negative_mark_value'      => $negMarkValue >= 0 ? $negMarkValue : 0.25,
        ];
    }

    /**
     * Save practice exam system settings
     *
     * @param array $data
     * @return void
     */
    public static function saveSettings(array $data)
    {
        if (isset($data['tiers']) && is_array($data['tiers'])) {
            $cleanTiers = [];
            foreach ($data['tiers'] as $t) {
                $q = isset($t['questions']) ? (int)self::toEnglishDigits($t['questions']) : 0;
                $d = isset($t['duration']) ? (int)self::toEnglishDigits($t['duration']) : 0;
                $p = isset($t['pass_marks']) ? (float)self::toEnglishDigits($t['pass_marks']) : round($q * 0.4, 1);
                $lbl = isset($t['label']) && trim($t['label']) !== '' ? trim($t['label']) : "{$q} টি প্রশ্ন ({$d} মিনিট — পাস: {$p})";
                if ($q > 0 && $d > 0) {
                    $cleanTiers[] = [
                        'questions'  => $q,
                        'duration'   => $d,
                        'pass_marks' => $p,
                        'label'      => $lbl,
                    ];
                }
            }
            if (!empty($cleanTiers)) {
                $json = json_encode($cleanTiers, JSON_UNESCAPED_UNICODE);
                AppearanceSetting::setVal('practice_exam_tiers', $json, $json, 'practice_exam');
                if (!isset($data['question_count'])) {
                    $data['question_count'] = $cleanTiers[0]['questions'];
                }
                if (!isset($data['duration_minutes'])) {
                    $data['duration_minutes'] = $cleanTiers[0]['duration'];
                }
            }
        }
        if (isset($data['question_count'])) {
            AppearanceSetting::setVal('practice_exam_question_count', (int) $data['question_count'], (int) $data['question_count'], 'practice_exam');
        }
        if (isset($data['duration_minutes'])) {
            AppearanceSetting::setVal('practice_exam_duration_minutes', (int) $data['duration_minutes'], (int) $data['duration_minutes'], 'practice_exam');
        }
        if (isset($data['view_mode'])) {
            AppearanceSetting::setVal('practice_exam_view_mode', $data['view_mode'], $data['view_mode'], 'practice_exam');
        }
        if (isset($data['attempt_limit_type'])) {
            AppearanceSetting::setVal('practice_exam_attempt_limit_type', $data['attempt_limit_type'], $data['attempt_limit_type'], 'practice_exam');
        }
        if (isset($data['max_attempts'])) {
            AppearanceSetting::setVal('practice_exam_max_attempts', (int) $data['max_attempts'], (int) $data['max_attempts'], 'practice_exam');
        }
        if (isset($data['allow_category_choice'])) {
            AppearanceSetting::setVal('practice_exam_allow_category_choice', (int) $data['allow_category_choice'], (int) $data['allow_category_choice'], 'practice_exam');
        }
        if (isset($data['mark_per_question'])) {
            AppearanceSetting::setVal('practice_exam_mark_per_question', (float) $data['mark_per_question'], (float) $data['mark_per_question'], 'practice_exam');
        }
        if (isset($data['pass_percentage'])) {
            AppearanceSetting::setVal('practice_exam_pass_percentage', (float) $data['pass_percentage'], (float) $data['pass_percentage'], 'practice_exam');
        }
        if (isset($data['negative_marking_enabled'])) {
            AppearanceSetting::setVal('practice_exam_negative_marking_enabled', (int) $data['negative_marking_enabled'], (int) $data['negative_marking_enabled'], 'practice_exam');
        }
        if (isset($data['negative_mark_value'])) {
            AppearanceSetting::setVal('practice_exam_negative_mark_value', (float) $data['negative_mark_value'], (float) $data['negative_mark_value'], 'practice_exam');
        }
    }

    /**
     * Scope query to only include MCQ format questions with options
     * (Non-MCQ types like short_answer, fill_blanks, creative, descriptive are excluded)
     */
    public static function applyMcqConstraint($query)
    {
        return $query->where('is_active', true)
            ->where('is_archived', false)
            ->whereIn('question_type', ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice'])
            ->has('options', '>=', 2);
    }

    /**
     * Get comprehensive Question Bank practice progress and metrics for a student
     *
     * @param int $studentId
     * @param string|null $category
     * @return array
     */
    public function getStudentProgress($studentId, $category = null)
    {
        // 1. Total active questions in question bank (strictly MCQ format)
        $qQuery = self::applyMcqConstraint(LmsQuestion::query());
        if ($category) {
            $qQuery->where('category', $category);
        }
        $totalQuestions = $qQuery->count();

        // 2. Determine current active rotation cycle
        $hQuery = LmsStudentQuestionHistory::where('student_account_id', $studentId);
        if ($category) {
            $hQuery->where('category', $category);
        }
        $maxCycleRecorded = (int)($hQuery->max('rotation_cycle') ?: 1);

        // Count distinct questions attempted by student in the latest cycle
        $attemptedInCurrentCycle = (clone $hQuery)
            ->where('rotation_cycle', $maxCycleRecorded)
            ->distinct('question_id')
            ->count('question_id');

        $activeCycle = $maxCycleRecorded;

        // If student finished 100% of questions in this cycle, current active cycle moves to next
        if ($totalQuestions > 0 && $attemptedInCurrentCycle >= $totalQuestions) {
            $activeCycle = $maxCycleRecorded + 1;
            $attemptedInCurrentCycle = 0;
        }

        $remainingInCurrentCycle = max(0, $totalQuestions - $attemptedInCurrentCycle);
        $coveragePct = $totalQuestions > 0 
            ? round(($attemptedInCurrentCycle / $totalQuestions) * 100, 1) 
            : 0;

        // 3. Overall question metrics across all cycles
        $totalAttemptsCount = LmsQuizAttempt::where('student_account_id', $studentId)
            ->whereHas('quiz', function($q) {
                $q->where('quiz_type', 'practice');
            })
            ->whereIn('status', ['submitted', 'graded', 'timed_out'])
            ->count();

        $allHistories = LmsStudentQuestionHistory::where('student_account_id', $studentId);
        if ($category) {
            $allHistories->where('category', $category);
        }

        $correctCount = (clone $allHistories)->where('is_correct', true)->count();
        $incorrectCount = (clone $allHistories)->where('is_correct', false)->count();
        $totalAnswered = $correctCount + $incorrectCount;
        $accuracyPct = $totalAnswered > 0 
            ? round(($correctCount / $totalAnswered) * 100, 1) 
            : 0;

        // 4. Categories breakdown with progress per category (strictly MCQ format)
        $categoriesData = [];
        $rawCategories = self::applyMcqConstraint(LmsQuestion::query())
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        foreach ($rawCategories as $rc) {
            $catName = $rc->category;
            $catTotal = (int)$rc->total;

            $catCycle = (int)(LmsStudentQuestionHistory::where('student_account_id', $studentId)
                ->where('category', $catName)
                ->max('rotation_cycle') ?: 1);

            $catAttempted = LmsStudentQuestionHistory::where('student_account_id', $studentId)
                ->where('category', $catName)
                ->where('rotation_cycle', $catCycle)
                ->distinct('question_id')
                ->count('question_id');

            if ($catTotal > 0 && $catAttempted >= $catTotal) {
                $catCycle++;
                $catAttempted = 0;
            }

            $catRemaining = max(0, $catTotal - $catAttempted);
            $catPct = $catTotal > 0 ? round(($catAttempted / $catTotal) * 100, 1) : 0;

            $categoriesData[] = [
                'name'             => $catName,
                'total'            => $catTotal,
                'attempted'        => $catAttempted,
                'remaining'        => $catRemaining,
                'coverage_pct'     => $catPct,
                'cycle'            => $catCycle,
            ];
        }

        return [
            'total_questions'          => $totalQuestions,
            'attempted_questions'      => $attemptedInCurrentCycle,
            'remaining_questions'      => $remainingInCurrentCycle,
            'coverage_pct'             => $coveragePct,
            'current_cycle'            => $activeCycle,
            'total_exams_completed'    => $totalAttemptsCount,
            'correct_count'            => $correctCount,
            'incorrect_count'          => $incorrectCount,
            'accuracy_pct'             => $accuracyPct,
            'categories'               => $categoriesData,
            'active_category'          => $category,
        ];
    }

    /**
     * Select a fresh, smart rotated set of questions for a student
     * Prioritizes unseen questions in current cycle; resets cycle automatically when pool exhausted.
     *
     * @param int $studentId
     * @param string|null $category
     * @param int $questionCount
     * @return array
     */
    public function selectQuestionsForNewAttempt($studentId, $category = null, $questionCount = 20)
    {
        $questionCount = max(1, min(100, (int)$questionCount));

        // 1. Determine active rotation cycle
        $hQuery = LmsStudentQuestionHistory::where('student_account_id', $studentId);
        if ($category) {
            $hQuery->where('category', $category);
        }
        $currentCycle = (int)($hQuery->max('rotation_cycle') ?: 1);

        // IDs attempted in this cycle
        $attemptedIds = (clone $hQuery)
            ->where('rotation_cycle', $currentCycle)
            ->pluck('question_id')
            ->toArray();

        // 2. Query unseen questions in current cycle (strictly MCQ format)
        $unseenQuery = self::applyMcqConstraint(LmsQuestion::with('options'))
            ->whereNotIn('id', $attemptedIds);

        if ($category) {
            $unseenQuery->where('category', $category);
        }

        $unseenCount = (clone $unseenQuery)->count();
        $isNewCycle = false;
        $chosenQuestions = collect();

        if ($unseenCount >= $questionCount) {
            // Case A: Plenty of fresh unseen questions in current cycle
            $chosenQuestions = $unseenQuery->inRandomOrder()->take($questionCount)->get();
            $effectiveCycle = $currentCycle;
        } elseif ($unseenCount > 0) {
            // Case B: Some unseen questions remain, but fewer than requested batch
            // Pick ALL remaining unseen questions to complete the cycle
            $chosenQuestions = $unseenQuery->inRandomOrder()->get();
            $neededMore = $questionCount - $unseenCount;

            // Advance to next rotation cycle
            $nextCycle = $currentCycle + 1;
            $isNewCycle = true;
            $effectiveCycle = $nextCycle;

            // Pick remaining questions from the entire bank for the next cycle
            $poolQuery = self::applyMcqConstraint(LmsQuestion::with('options'))
                ->whereNotIn('id', $chosenQuestions->pluck('id')->toArray());

            if ($category) {
                $poolQuery->where('category', $category);
            }

            $moreQuestions = $poolQuery->inRandomOrder()->take($neededMore)->get();
            $chosenQuestions = $chosenQuestions->concat($moreQuestions);
        } else {
            // Case C: 0 unseen questions left in current cycle -> All completed!
            // Start brand new cycle automatically
            $nextCycle = $currentCycle + 1;
            $isNewCycle = true;
            $effectiveCycle = $nextCycle;

            $poolQuery = self::applyMcqConstraint(LmsQuestion::with('options'));

            if ($category) {
                $poolQuery->where('category', $category);
            }

            $chosenQuestions = $poolQuery->inRandomOrder()->take($questionCount)->get();
        }

        // Guarantee distinct questions within this single exam (no duplicate question texts or hashes)
        $distinctQuestions = collect();
        $seenHashes = [];
        foreach ($chosenQuestions as $q) {
            $h = $q->question_hash ?: LmsQuestion::hashText($q->question_text);
            if ($h && !isset($seenHashes[$h])) {
                $seenHashes[$h] = true;
                $distinctQuestions->push($q);
            }
        }

        // If duplicate filtering dropped count below requested questionCount, replenish with more unique questions
        if ($distinctQuestions->count() < $questionCount) {
            $shortage = $questionCount - $distinctQuestions->count();
            $morePool = self::applyMcqConstraint(LmsQuestion::with('options'))
                ->whereNotIn('id', $distinctQuestions->pluck('id')->toArray());
            if ($category) {
                $morePool->where('category', $category);
            }
            $candidates = $morePool->inRandomOrder()->take($shortage * 3)->get();
            foreach ($candidates as $cand) {
                $ch = $cand->question_hash ?: LmsQuestion::hashText($cand->question_text);
                if ($ch && !isset($seenHashes[$ch])) {
                    $seenHashes[$ch] = true;
                    $distinctQuestions->push($cand);
                    if ($distinctQuestions->count() >= $questionCount) {
                        break;
                    }
                }
            }
        }

        // Randomize order so question positions change
        $chosenQuestions = $distinctQuestions->shuffle()->values();

        return [
            'questions'     => $chosenQuestions,
            'cycle'         => $effectiveCycle,
            'is_new_cycle'  => $isNewCycle,
            'unseen_picked' => min($questionCount, $unseenCount),
        ];
    }

    /**
     * Record questions presented in an attempt immediately into student question history
     * Ensures questions are marked as attempted even if student leaves mid-exam.
     *
     * @param LmsQuizAttempt $attempt
     * @param Collection $questions
     * @param int $studentId
     * @param int $cycle
     * @return void
     */
    public function recordAttemptQuestions(LmsQuizAttempt $attempt, $questions, $studentId, $cycle)
    {
        $now = Carbon::now();

        foreach ($questions as $q) {
            LmsStudentQuestionHistory::updateOrCreate([
                'student_account_id' => $studentId,
                'question_id'        => $q->id,
                'rotation_cycle'     => $cycle,
            ], [
                'attempt_id'         => $attempt->id,
                'category'           => $q->category,
                'course_id'          => $q->course_id,
                'last_attempted_at'  => $now,
            ]);
        }
    }

    /**
     * Update student question history outcomes after exam grading
     *
     * @param int $attemptId
     * @return void
     */
    public function updateQuestionOutcomes($attemptId)
    {
        $attempt = LmsQuizAttempt::with('answers')->find($attemptId);
        if (!$attempt) {
            return;
        }

        foreach ($attempt->answers as $ans) {
            LmsStudentQuestionHistory::where('attempt_id', $attempt->id)
                ->where('question_id', $ans->question_id)
                ->update([
                    'is_correct'          => $ans->is_correct,
                    'selected_option_ids' => $ans->selected_option_ids,
                    'updated_at'          => Carbon::now(),
                ]);
        }
    }

    /**
     * Find or create a dedicated system practice quiz instance for practice mode
     *
     * @param string|null $category
     * @param int $questionCount
     * @param int|null $durationMinutes
     * @return LmsQuiz
     */
    public function getOrCreatePracticeQuiz($category = null, $questionCount = null, $durationMinutes = null, $passMarksCustom = null)
    {
        $settings = self::getSettings();
        $count = $questionCount ? (int)self::toEnglishDigits($questionCount) : ($settings['question_count'] ?: 20);
        $duration = $durationMinutes 
            ? (int)self::toEnglishDigits($durationMinutes) 
            : ($settings['duration_minutes'] ?: max(10, min(120, (int)($count * 1.5))));

        $title = $category 
            ? "Question Bank Practice: {$category}" 
            : "Question Bank Unlimited Practice Drill";

        $markPerQ = isset($settings['mark_per_question']) && (float)$settings['mark_per_question'] > 0 ? (float)$settings['mark_per_question'] : 1.0;
        $totalMarks = round($count * $markPerQ, 2);

        // Calculate pass mark: prioritize custom pass marks from selected tier, fallback to tier setting, fallback to %
        if ($passMarksCustom !== null && (float)$passMarksCustom > 0) {
            $passMarks = (float)$passMarksCustom;
        } else {
            // Look up matching tier pass marks
            $matchedTier = collect($settings['tiers'])->first(function($t) use ($count) {
                return (int)self::toEnglishDigits($t['questions']) === (int)$count;
            });
            if ($matchedTier && isset($matchedTier['pass_marks'])) {
                $passMarks = (float)self::toEnglishDigits($matchedTier['pass_marks']);
            } else {
                $passPct = isset($settings['pass_percentage']) && (float)$settings['pass_percentage'] > 0 ? (float)$settings['pass_percentage'] : 40.0;
                $passMarks = round($totalMarks * ($passPct / 100), 2);
            }
        }

        $viewMode = in_array($settings['view_mode'], ['all_questions', 'one_by_one']) ? $settings['view_mode'] : 'all_questions';

        $quiz = LmsQuiz::firstOrCreate([
            'title'     => $title,
            'quiz_type' => 'practice',
        ], [
            'description'           => 'স্মার্ট কোয়েশ্চেন রোটেশনভিত্তিক সেলফ-পেসড অনুশীলন পরীক্ষা।',
            'duration_minutes'      => $duration,
            'total_marks'           => $totalMarks,
            'pass_marks'            => $passMarks,
            'shuffle_questions'     => 1,
            'shuffle_options'       => 1,
            'max_attempts'          => $settings['max_attempts'],
            'is_published'          => 1,
            'view_mode'             => $viewMode,
            'locking_policy'        => 'instant_lock',
            'result_release_policy' => 'immediate',
        ]);

        // Always ensure duration, view_mode, attempts and marks reflect configured settings
        $quiz->duration_minutes = $duration;
        $quiz->total_marks = $totalMarks;
        $quiz->pass_marks = $passMarks;
        $quiz->max_attempts = $settings['max_attempts'];
        $quiz->view_mode = $viewMode;
        $quiz->is_published = 1;
        $quiz->save();

        return $quiz;
    }
}
