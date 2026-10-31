<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuizAttempt;
use App\model\LmsQuizAnswer;
use Carbon\Carbon;

class StudentQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * List all online quizzes and assessments
     */
    public function onlineQuiz(Request $request)
    {
        $student = Auth::guard('student')->user();
        $query = LmsQuiz::where('is_published', true)->with(['course', 'questions']);

        if ($request->filled('type')) {
            $query->where('quiz_type', $request->type);
        }

        if ($request->filled('class')) {
            $query->where('class_level', $request->class);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $quizzes = $query->orderBy('id', 'desc')->paginate(9);

        // Map student attempt statistics for each quiz
        $attemptStats = [];
        foreach ($quizzes as $quiz) {
            $attempts = LmsQuizAttempt::where('quiz_id', $quiz->id)
                ->where('student_account_id', $student->id)
                ->whereIn('status', ['submitted', 'graded'])
                ->get();

            $attemptStats[$quiz->id] = [
                'count' => $attempts->count(),
                'best_score' => $attempts->max('score'),
                'passed' => $attempts->where('score', '>=', $quiz->pass_marks)->count() > 0,
            ];
        }

        return view('frontend.theme.clasic.student.quiz.index', compact('student', 'quizzes', 'attemptStats'));
    }

    /**
     * List upcoming formal exams
     */
    public function upcomingExams()
    {
        $student = Auth::guard('student')->user();
        $exams = LmsQuiz::where('is_published', true)
            ->where('quiz_type', 'exam')
            ->with(['course', 'questions'])
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.theme.clasic.student.quiz.upcoming', compact('student', 'exams'));
    }

    /**
     * Practice tests list
     */
    public function practiceTests()
    {
        $student = Auth::guard('student')->user();
        $quizzes = LmsQuiz::where('is_published', true)
            ->where(function ($q) {
                $q->where('quiz_type', 'practice')
                  ->orWhere('max_attempts', 0);
            })
            ->with(['course', 'questions'])
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('frontend.theme.clasic.student.quiz.practice', compact('student', 'quizzes'));
    }

    /**
     * Pre-exam lobby and instructions
     */
    public function lobby($id)
    {
        $student = Auth::guard('student')->user();
        $quiz = LmsQuiz::with(['course', 'questions'])->findOrFail($id);

        $attempts = LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $canAttempt = $quiz->canAttempt($student->id);
        $activeAttempt = LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $student->id)
            ->where('status', 'in_progress')
            ->first();

        return view('frontend.theme.clasic.student.quiz.lobby', compact(
            'student', 'quiz', 'attempts', 'canAttempt', 'activeAttempt'
        ));
    }

    /**
     * Initiate or resume quiz attempt with question snapshot
     */
    public function startQuiz(Request $request, $id)
    {
        $student = Auth::guard('student')->user();
        $quiz = LmsQuiz::findOrFail($id);

        // Check if existing in-progress attempt is valid
        $activeAttempt = LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $student->id)
            ->where('status', 'in_progress')
            ->first();

        if ($activeAttempt) {
            // Check if timed out
            $now = Carbon::now();
            $maxTime = $activeAttempt->started_at->copy()->addMinutes($quiz->duration_minutes + 2); // 2 mins buffer

            if ($now->greaterThan($maxTime)) {
                $this->finalizeGrading($activeAttempt);
                return redirect()->route('student.quiz.results', $activeAttempt->id)->with([
                    'warning' => 'Your previous attempt timed out and was automatically submitted.',
                ]);
            }

            return redirect()->route('student.quiz.take', $activeAttempt->id);
        }

        if (!$quiz->canAttempt($student->id)) {
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => 'You have reached the maximum allowed attempts for this assessment.',
            ]);
        }

        $attemptNumber = LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $student->id)
            ->count() + 1;

        // Determine question set
        $assignedSet = $request->input('question_set', $quiz->question_set ?: 'Set A');

        // Fetch questions for this attempt and freeze a snapshot
        $snapshot = [];

        // Check if quiz is linked to a structured Question Paper with sections
        if ($quiz->paper_id && $quiz->paper && $quiz->paper->items()->exists()) {
            $paperItems = $quiz->paper->items()
                ->with(['masterQuestion.options', 'section'])
                ->orderBy('order_index', 'asc')
                ->get();

            if ($quiz->shuffle_questions) {
                $paperItems = $paperItems->shuffle()->values();
            }

            foreach ($paperItems as $it) {
                $q = $it->masterQuestion;
                if (!$q) continue;

                $opts = $q->options;
                if ($quiz->shuffle_options) {
                    $opts = $opts->shuffle()->values();
                }

                $optsArray = [];
                $optIdx = 0;
                foreach ($opts as $o) {
                    $optsArray[] = [
                        'id' => $o->id,
                        'text' => $o->option_text,
                        'order' => $optIdx++,
                    ];
                }

                $snapshot[] = [
                    'id'                   => $q->id,
                    'paper_item_id'        => $it->id,
                    'section_id'           => $it->section_id,
                    'section_title'        => $it->section ? $it->section->title : null,
                    'section_instructions' => $it->section ? $it->section->instructions : null,
                    'section_code'         => $it->section ? $it->section->section_code : null,
                    'question_text'        => $it->getQuestionText(),
                    'question_type'        => $it->getQuestionType(),
                    'marks'                => (float)$it->marks,
                    'negative_marks'       => $it->negative_marks !== null ? (float)$it->negative_marks : null,
                    'set_code'             => $q->set_code,
                    'category'             => $q->category,
                    'chapter'              => $q->chapter,
                    'topic'                => $q->topic,
                    'stimulus'             => $it->getStimulus(),
                    'hints'                => $it->getHints(),
                    'cq_subquestions'      => $it->getCqSubquestions(),
                    'matching_pairs'       => $it->getMatchingPairs(),
                    'options'              => $optsArray,
                ];
            }
        } else {
            // Standard Quiz question retrieval
            $questionsQuery = $quiz->activeQuestions()->with('options');
            $availableSets = $quiz->getAvailableSets();
            if (count($availableSets) > 1 && $assignedSet) {
                $equivalents = \App\model\LmsQuiz::getEquivalentSetCodes($assignedSet);
                $questionsQuery->where(function($q) use ($equivalents) {
                    $q->whereIn('set_code', $equivalents)
                      ->orWhereNull('set_code')
                      ->orWhere('set_code', '');
                });
            }
            $rawQuestions = $questionsQuery->get();
            if ($rawQuestions->isEmpty()) {
                $rawQuestions = $quiz->activeQuestions()->with('options')->get();
            }

            if ($quiz->shuffle_questions) {
                $rawQuestions = $rawQuestions->shuffle()->values();
            }

            foreach ($rawQuestions as $q) {
                $opts = $q->options;
                if ($quiz->shuffle_options) {
                    $opts = $opts->shuffle()->values();
                }

                $optsArray = [];
                $optIdx = 0;
                foreach ($opts as $o) {
                    $optsArray[] = [
                        'id' => $o->id,
                        'text' => $o->option_text,
                        'order' => $optIdx++,
                    ];
                }

                $snapshot[] = [
                    'id'              => $q->id,
                    'section_id'      => null,
                    'section_title'   => null,
                    'question_text'   => $q->question_text,
                    'question_type'   => $q->question_type,
                    'marks'           => (float)$q->marks,
                    'negative_marks'  => $q->negative_marks !== null ? (float)$q->negative_marks : null,
                    'set_code'        => $q->set_code,
                    'category'        => $q->category,
                    'chapter'         => $q->chapter,
                    'topic'           => $q->topic,
                    'stimulus'        => $q->stimulus,
                    'hints'           => $q->hints,
                    'cq_subquestions' => $q->cq_subquestions_decoded,
                    'matching_pairs'  => $q->matching_pairs_decoded,
                    'options'         => $optsArray,
                ];
            }
        }

        $viewMode = $request->input('view_mode', $quiz->view_mode ?: 'all_questions');

        $newAttempt = LmsQuizAttempt::create([
            'quiz_id' => $quiz->id,
            'student_account_id' => $student->id,
            'attempt_number' => $attemptNumber,
            'started_at' => Carbon::now(),
            'total_marks' => $quiz->total_marks,
            'status' => 'in_progress',
            'view_mode' => $viewMode,
            'question_set' => $assignedSet,
            'questions_snapshot' => $snapshot,
            'flagged_question_ids' => [],
        ]);

        return redirect()->route('student.quiz.take', $newAttempt->id);
    }

    /**
     * Live exam taking interface
     */
    public function takeQuiz($attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);
        $quiz = $attempt->quiz;

        if ($attempt->status !== 'in_progress') {
            return redirect()->route('student.quiz.results', $attempt->id);
        }

        // Calculate time remaining in seconds (authoritative server timer)
        $endTime = $attempt->started_at->copy()->addMinutes($quiz->duration_minutes);
        $now = Carbon::now();
        $secondsRemaining = $now->diffInSeconds($endTime, false);

        if ($secondsRemaining <= 0) {
            $this->finalizeGrading($attempt);
            return redirect()->route('student.quiz.results', $attempt->id)->with([
                'warning' => 'Time expired! Your exam was automatically submitted and graded.',
            ]);
        }

        // Load questions: prefer frozen attempt snapshot, fallback to active questions
        if (!empty($attempt->questions_snapshot) && is_array($attempt->questions_snapshot)) {
            $questions = collect($attempt->questions_snapshot)->map(function($qItem) {
                $obj = (object)$qItem;
                $obj->options = collect($qItem['options'])->map(function($opt) {
                    return (object)[
                        'id' => $opt['id'],
                        'option_text' => $opt['text'],
                        'order_index' => $opt['order'],
                    ];
                });
                return $obj;
            });
        } else {
            $questions = $quiz->activeQuestions()->with('options')->get();
            if ($quiz->shuffle_questions) {
                $questions = $questions->shuffle();
            }
        }

        // Load existing answers for this attempt
        $existingAnswers = LmsQuizAnswer::where('attempt_id', $attempt->id)
            ->get()
            ->keyBy('question_id');

        // Flagged question IDs
        $flaggedQuestionIds = $attempt->flagged_ids_array;

        return view('frontend.theme.clasic.student.quiz.take', compact(
            'student', 'quiz', 'attempt', 'questions', 'secondsRemaining', 'existingAnswers', 'flaggedQuestionIds'
        ));
    }

    /**
     * Save question answer via AJAX with strict server-enforced locking
     */
    public function saveAnswer(Request $request, $attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);

        if ($attempt->status !== 'in_progress') {
            return response()->json([
                'status' => 'error',
                'code' => 'NOT_ACTIVE',
                'message' => 'Attempt is no longer active'
            ], 400);
        }

        // Check server-side deadline
        $quiz = $attempt->quiz;
        $endTime = $attempt->started_at->copy()->addMinutes($quiz->duration_minutes);
        if (Carbon::now()->greaterThan($endTime->copy()->addMinutes(1))) {
            $this->finalizeGrading($attempt);
            return response()->json([
                'status' => 'error',
                'code' => 'EXPIRED',
                'message' => 'পরীক্ষার নির্ধারিত সময় শেষ হয়ে গেছে। উত্তরপত্র স্বয়ংক্রিয়ভাবে জমা হয়েছে।'
            ], 403);
        }

        $questionId = (int)$request->input('question_id');
        $selectedOptionIds = $request->input('selected_option_ids');
        $textAnswer = $request->input('text_answer');
        $cqAnswers = $request->input('cq_answers');
        $action = $request->input('action', 'save'); // 'save', 'finalize'

        // Check if question exists in bank or snapshot
        $question = LmsQuestion::find($questionId);
        if (!$question && empty($attempt->questions_snapshot)) {
            return response()->json(['status' => 'error', 'message' => 'Question not found'], 404);
        }

        // Check if this question is already finalized and locked!
        $existingAnswer = LmsQuizAnswer::where('attempt_id', $attempt->id)
            ->where('question_id', $questionId)
            ->first();

        if ($existingAnswer && $existingAnswer->is_finalized) {
            return response()->json([
                'status' => 'error',
                'code' => 'LOCKED',
                'message' => 'এই প্রশ্নের উত্তর ইতিমধ্যে সাবমিট ও লক করা হয়েছে। এটি আর পরিবর্তন করা যাবে না।'
            ], 422);
        }

        // Format selected option IDs
        if (is_array($selectedOptionIds)) {
            $selectedOptionIdsJson = json_encode(array_values(array_map('intval', $selectedOptionIds)));
        } elseif (is_numeric($selectedOptionIds)) {
            $selectedOptionIdsJson = json_encode([(int)$selectedOptionIds]);
        } else {
            $selectedOptionIdsJson = null;
        }

        // Determine locking behavior per mode and quiz policy:
        $currentViewMode = $request->input('view_mode') ?: ($attempt->view_mode ?: ($quiz->view_mode ?: 'all_questions'));

        $shouldFinalize = false;
        if ($quiz->locking_policy === 'instant_lock') {
            $shouldFinalize = true;
        } elseif ($quiz->locking_policy === 'confirm_lock') {
            $shouldFinalize = ($action === 'finalize' || $request->input('finalize') == true);
        } else {
            if ($currentViewMode === 'all_questions') {
                if ($textAnswer !== null || $cqAnswers !== null) {
                    $shouldFinalize = ($action === 'finalize' || $request->input('finalize') == true);
                } else {
                    $shouldFinalize = true; // All questions view: instant lock for option clicks
                }
            } else {
                $shouldFinalize = ($action === 'finalize' || $request->input('finalize') == true);
            }
        }

        // Safe DB transaction to prevent race conditions
        $answer = \Illuminate\Support\Facades\DB::transaction(function () use ($attempt, $questionId, $selectedOptionIdsJson, $textAnswer, $cqAnswers, $shouldFinalize) {
            $ans = LmsQuizAnswer::lockForUpdate()->firstOrNew([
                'attempt_id' => $attempt->id,
                'question_id' => $questionId,
            ]);

            if ($ans->is_finalized) {
                return false; // Already finalized
            }

            $ans->selected_option_ids = $selectedOptionIdsJson;
            if ($textAnswer !== null) {
                $ans->text_answer = $textAnswer;
            }
            if ($cqAnswers !== null) {
                $ans->cq_answers = is_array($cqAnswers) ? json_encode($cqAnswers, JSON_UNESCAPED_UNICODE) : (string)$cqAnswers;
            }

            if ($shouldFinalize) {
                $ans->is_finalized = true;
                $ans->finalized_at = Carbon::now();
            }
            $ans->save();
            return $ans;
        });

        if ($answer === false) {
            return response()->json([
                'status' => 'error',
                'code' => 'LOCKED',
                'message' => 'এই প্রশ্নের উত্তর ইতিমধ্যে সাবমিট ও লক করা হয়েছে।'
            ], 422);
        }

        if ($request->has('time_spent_seconds')) {
            $attempt->time_spent_seconds = (int)$request->input('time_spent_seconds');
            $attempt->save();
        }

        return response()->json([
            'status' => 'success',
            'question_id' => $questionId,
            'is_finalized' => (bool)$answer->is_finalized,
            'state' => $answer->is_finalized ? 'finalized' : 'draft',
            'message' => $answer->is_finalized ? 'উত্তর সফলভাবে লক ও সংরক্ষিত হয়েছে' : 'ড্রাফট হিসেবে সংরক্ষিত হয়েছে'
        ]);
    }

    /**
     * Bookmark / Flag question for later review
     */
    public function toggleFlag(Request $request, $attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);
        $questionId = (int)$request->input('question_id');

        $flagged = $attempt->flagged_ids_array;
        if (in_array($questionId, $flagged)) {
            $flagged = array_values(array_diff($flagged, [$questionId]));
            $isFlagged = false;
        } else {
            $flagged[] = $questionId;
            $isFlagged = true;
        }

        $attempt->flagged_question_ids = $flagged;
        $attempt->save();

        return response()->json([
            'status' => 'success',
            'question_id' => $questionId,
            'is_flagged' => $isFlagged,
            'flagged_count' => count($flagged),
        ]);
    }

    /**
     * Switch view mode between 'all_questions' and 'one_by_one'
     */
    public function switchViewMode(Request $request, $attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);

        $mode = $request->input('view_mode');
        if (in_array($mode, ['all_questions', 'one_by_one'])) {
            $attempt->view_mode = $mode;
            $attempt->save();
        }

        return response()->json(['status' => 'success', 'view_mode' => $attempt->view_mode]);
    }

    /**
     * Submit and grade completed quiz attempt
     */
    public function submitQuiz(Request $request, $attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);

        if ($attempt->status === 'in_progress') {
            // Save any final posted answers if submitted via form POST
            if ($request->has('answers') && is_array($request->answers)) {
                foreach ($request->answers as $qId => $optVal) {
                    $selectedIds = is_array($optVal) ? json_encode(array_values(array_map('intval', $optVal))) : json_encode([(int)$optVal]);
                    $existing = LmsQuizAnswer::where('attempt_id', $attempt->id)->where('question_id', $qId)->first();
                    if (!$existing || !$existing->is_finalized) {
                        LmsQuizAnswer::updateOrCreate([
                            'attempt_id' => $attempt->id,
                            'question_id' => $qId,
                        ], [
                            'selected_option_ids' => $selectedIds,
                            'is_finalized' => true,
                            'finalized_at' => Carbon::now(),
                        ]);
                    }
                }
            }

            // Save text answers if posted (Fill in blanks, short questions, translation)
            if ($request->has('text_answers') && is_array($request->text_answers)) {
                foreach ($request->text_answers as $qId => $textVal) {
                    $existing = LmsQuizAnswer::where('attempt_id', $attempt->id)->where('question_id', $qId)->first();
                    if (!$existing || !$existing->is_finalized) {
                        LmsQuizAnswer::updateOrCreate([
                            'attempt_id' => $attempt->id,
                            'question_id' => $qId,
                        ], [
                            'text_answer' => trim($textVal),
                            'is_finalized' => true,
                            'finalized_at' => Carbon::now(),
                        ]);
                    }
                }
            }

            // Save CQ answers if posted
            if ($request->has('cq_answers') && is_array($request->cq_answers)) {
                foreach ($request->cq_answers as $qId => $cqVal) {
                    $existing = LmsQuizAnswer::where('attempt_id', $attempt->id)->where('question_id', $qId)->first();
                    if (!$existing || !$existing->is_finalized) {
                        LmsQuizAnswer::updateOrCreate([
                            'attempt_id' => $attempt->id,
                            'question_id' => $qId,
                        ], [
                            'cq_answers' => json_encode($cqVal, JSON_UNESCAPED_UNICODE),
                            'is_finalized' => true,
                            'finalized_at' => Carbon::now(),
                        ]);
                    }
                }
            }

            if ($request->has('time_spent_seconds')) {
                $attempt->time_spent_seconds = (int)$request->time_spent_seconds;
            }

            $this->finalizeGrading($attempt);
        }

        return redirect()->route('student.quiz.results', $attempt->id)->with([
            'success' => 'Exam submitted successfully! Review your score breakdown below.',
        ]);
    }

    /**
     * Detailed Results & Performance Review
     */
    public function quizResults($attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)
            ->with(['quiz.course', 'answers.question.options'])
            ->findOrFail($attemptId);

        $quiz = $attempt->quiz;

        // Check result release policy
        $now = Carbon::now();
        $resultsLocked = false;
        $resultsLockedMessage = '';

        if ($quiz->result_release_policy === 'admin_publish') {
            $resultsLocked = true;
            $resultsLockedMessage = 'পরীক্ষার ফলাফল পর্যালোচনার জন্য কর্তৃপক্ষের অনুমোদনের অপেক্ষায় রয়েছে। ফলাফল প্রকাশিত হলে সম্পূর্ণ উত্তরপত্র দেখতে পাবেন।';
        } elseif ($quiz->result_release_policy === 'after_deadline' && $quiz->end_time && $now->lessThan($quiz->end_time)) {
            $resultsLocked = true;
            $resultsLockedMessage = 'পরীক্ষার নির্ধারিত সমাপ্তি সময় (' . $quiz->end_time->format('d M, Y h:i A') . ') এর পর সম্পূর্ণ ব্যাখ্যা ও ফলাফল দেখতে পাবেন।';
        }

        if (!empty($attempt->questions_snapshot) && is_array($attempt->questions_snapshot)) {
            $snapshotQIds = collect($attempt->questions_snapshot)->pluck('id')->toArray();
            $snapshotMap = collect($attempt->questions_snapshot)->keyBy('id');
            $questions = LmsQuestion::with(['options', 'parentQuestion', 'derivedQuestions'])
                ->whereIn('id', $snapshotQIds)
                ->get()
                ->sortBy(function($q) use ($snapshotQIds) {
                    return array_search($q->id, $snapshotQIds);
                })->values();

            foreach ($questions as $q) {
                if (isset($snapshotMap[$q->id])) {
                    $snap = $snapshotMap[$q->id];
                    if (isset($snap['section_title'])) {
                        $q->section_title = $snap['section_title'];
                    }
                    if (isset($snap['section_instructions'])) {
                        $q->section_instructions = $snap['section_instructions'];
                    }
                    if (!empty($snap['options']) && is_array($snap['options'])) {
                        $optOrderIds = array_column($snap['options'], 'id');
                        $sortedOpts = $q->options->sortBy(function($opt) use ($optOrderIds) {
                            $idx = array_search($opt->id, $optOrderIds);
                            return $idx !== false ? $idx : 999;
                        })->values();
                        $q->setRelation('options', $sortedOpts);
                    }
                }
            }

            if ($questions->isEmpty()) {
                $questions = $quiz->getExamQuestions();
            }
        } else {
            $questions = $quiz->getExamQuestions();
        }

        $answers = $attempt->answers->keyBy('question_id');

        return view('frontend.theme.clasic.student.quiz.result', compact(
            'student', 'quiz', 'attempt', 'questions', 'answers', 'resultsLocked', 'resultsLockedMessage'
        ));
    }

    /**
     * Full Results History
     */
    public function allResults()
    {
        $student = Auth::guard('student')->user();
        $attempts = LmsQuizAttempt::where('student_account_id', $student->id)
            ->whereIn('status', ['submitted', 'graded', 'timed_out'])
            ->with(['quiz.course'])
            ->orderBy('submitted_at', 'desc')
            ->paginate(12);

        return view('frontend.theme.clasic.student.quiz.history', compact('student', 'attempts'));
    }

    /**
     * Exam History Archive
     */
    public function examHistory()
    {
        return $this->allResults();
    }

    /**
     * Auto-grading calculation engine with positive and negative marking
     */
    protected function finalizeGrading(LmsQuizAttempt $attempt)
    {
        if ($attempt->status === 'graded') {
            return; // Idempotent: already graded
        }

        $quiz = $attempt->quiz;
        $questions = $quiz->getExamQuestions();
        if ($questions->isEmpty()) {
            $questions = $quiz->questions()->with('options')->get();
        }

        $totalMarksObtained = 0.0;
        $totalNegativeDeducted = 0.0;

        foreach ($questions as $question) {
            $answer = LmsQuizAnswer::where('attempt_id', $attempt->id)
                ->where('question_id', $question->id)
                ->first();

            if (!$answer) {
                continue;
            }

            // Ensure answer is marked finalized upon grading
            $answer->is_finalized = true;
            if (!$answer->finalized_at) {
                $answer->finalized_at = Carbon::now();
            }

            $correctOptionIds = $question->options->where('is_correct', true)->pluck('id')->toArray();
            $studentOptionIds = [];

            if (!empty($answer->selected_option_ids)) {
                $decoded = json_decode($answer->selected_option_ids, true);
                $studentOptionIds = is_array($decoded) ? array_map('intval', $decoded) : [(int)$answer->selected_option_ids];
            }

            $qType = $question->question_type;

            // 1. MCQ Single / Multiple Select / Objective
            if ($qType === 'mcq_single' || $qType === 'mcq' || $qType === 'mcq_multi' || ($qType === 'true_false' && count($correctOptionIds) > 0)) {
                if (empty($studentOptionIds)) {
                    $answer->is_correct = null;
                    $answer->marks_obtained = 0.0;
                    $answer->grading_status = 'auto_graded';
                    $answer->save();
                    continue;
                }

                $isCorrect = false;
                if ($qType === 'mcq_multi') {
                    sort($correctOptionIds);
                    sort($studentOptionIds);
                    $isCorrect = ($correctOptionIds === $studentOptionIds);
                } else {
                    $isCorrect = (count($studentOptionIds) === 1 && in_array($studentOptionIds[0], $correctOptionIds));
                }

                if ($isCorrect) {
                    $marks = (float)$question->marks;
                    $totalMarksObtained += $marks;
                } else {
                    $negMark = $question->negative_marks !== null
                        ? abs((float)$question->negative_marks)
                        : abs((float)($quiz->negative_marks ?: 0.0));
                    $marks = -$negMark;
                    $totalNegativeDeducted += $negMark;
                    $totalMarksObtained += $marks;
                }

                $answer->is_correct = $isCorrect;
                $answer->marks_obtained = $marks;
                $answer->grading_status = 'auto_graded';
                $answer->save();
            }
            // 2. True / False with text answer (e.g. 'true'/'false' or 'স'/'মি')
            elseif ($qType === 'true_false') {
                $studentText = trim(mb_strtolower((string)$answer->text_answer, 'UTF-8'));
                $expected = trim(mb_strtolower((string)$question->correct_answer_text, 'UTF-8'));

                if ($studentText === '') {
                    $answer->is_correct = null;
                    $answer->marks_obtained = 0.0;
                    $answer->grading_status = 'auto_graded';
                    $answer->save();
                    continue;
                }

                $isTrueStudent = in_array($studentText, ['true', '1', 'স', 'সত্য', 't', 'yes']);
                $isTrueExpected = in_array($expected, ['true', '1', 'স', 'সত্য', 't', 'yes']);
                $isCorrect = ($isTrueStudent === $isTrueExpected);

                if ($isCorrect) {
                    $marks = (float)$question->marks;
                    $totalMarksObtained += $marks;
                } else {
                    $negMark = $question->negative_marks !== null ? abs((float)$question->negative_marks) : 0.0;
                    $marks = -$negMark;
                    $totalNegativeDeducted += $negMark;
                    $totalMarksObtained += $marks;
                }

                $answer->is_correct = $isCorrect;
                $answer->marks_obtained = $marks;
                $answer->grading_status = 'auto_graded';
                $answer->save();
            }
            // 3. Fill in the Blanks (Intelligent matching against expected answer alternatives)
            elseif ($qType === 'fill_blanks') {
                $studentText = trim((string)$answer->text_answer);
                $expectedRaw = (string)$question->correct_answer_text;

                if ($studentText === '') {
                    $answer->is_correct = null;
                    $answer->marks_obtained = 0.0;
                    $answer->grading_status = 'auto_graded';
                    $answer->save();
                    continue;
                }

                // Strip punctuation & lowercase for fuzzy Bengali and English matching
                $cleanStudent = trim(mb_strtolower(str_replace(['।', '.', ',', ';', '"', "'", '!', ' '], '', $studentText), 'UTF-8'));
                $alternatives = preg_split('/[,\|\/]/', $expectedRaw);
                $isCorrect = false;

                foreach ($alternatives as $alt) {
                    $cleanAlt = trim(mb_strtolower(str_replace(['।', '.', ',', ';', '"', "'", '!', ' '], '', $alt), 'UTF-8'));
                    if ($cleanAlt !== '' && $cleanStudent === $cleanAlt) {
                        $isCorrect = true;
                        break;
                    }
                }

                if ($isCorrect) {
                    $marks = (float)$question->marks;
                    $totalMarksObtained += $marks;
                } else {
                    $negMark = $question->negative_marks !== null ? abs((float)$question->negative_marks) : 0.0;
                    $marks = -$negMark;
                    $totalNegativeDeducted += $negMark;
                    $totalMarksObtained += $marks;
                }

                $answer->is_correct = $isCorrect;
                $answer->marks_obtained = $marks;
                $answer->grading_status = 'auto_graded';
                $answer->save();
            }
            // 4. Subjective Questions: Short Answer, Translation, Descriptive, Creative (CQ)
            else {
                $hasContent = !empty($answer->text_answer) || !empty($answer->cq_answers);
                if ($hasContent) {
                    $answer->grading_status = 'pending_review';
                    // If teacher already assigned manual marks, preserve them
                    if ($answer->marks_obtained > 0) {
                        $totalMarksObtained += $answer->marks_obtained;
                    }
                } else {
                    $answer->is_correct = null;
                    $answer->marks_obtained = 0.0;
                    $answer->grading_status = 'not_answered';
                }
                $answer->save();
            }
        }

        // Clamp final score to minimum 0
        $finalScore = max(0.0, $totalMarksObtained);

        $attempt->score = $finalScore;
        $attempt->negative_marks_deducted = $totalNegativeDeducted;
        $attempt->percentage = $quiz->total_marks > 0 
            ? round(($finalScore / $quiz->total_marks) * 100, 2) 
            : 0;
        $attempt->status = 'graded';
        $attempt->submitted_at = Carbon::now();

        if ($attempt->time_spent_seconds <= 0 && $attempt->started_at) {
            $attempt->time_spent_seconds = min(
                $quiz->duration_minutes * 60,
                $attempt->submitted_at->diffInSeconds($attempt->started_at)
            );
        }

        $attempt->save();
    }
}

