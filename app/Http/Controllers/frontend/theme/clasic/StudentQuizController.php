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
use App\Services\PracticeQuestionRotationService;
use Carbon\Carbon;

class StudentQuizController extends Controller
{
    protected $rotationService;

    public function __construct(PracticeQuestionRotationService $rotationService = null)
    {
        $this->middleware('auth:student');
        $this->rotationService = $rotationService ?: app(PracticeQuestionRotationService::class);
    }

    /**
     * List all online quizzes and assessments
     */
    public function onlineQuiz(Request $request)
    {
        $student = Auth::guard('student')->user();
        // Live exams (quiz_type = 'exam') are excluded from Online Quizzes overview and only shown in Upcoming Exams
        $query = LmsQuiz::where('is_published', true)
            ->where('quiz_type', '!=', 'exam')
            ->with(['course', 'questions']);

        if ($request->filled('type') && $request->type !== 'exam') {
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

        // Count active published live exams to guide students
        $liveExamsCount = LmsQuiz::where('is_published', true)
            ->where('quiz_type', 'exam')
            ->count();

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
                'passed' => $attempts->contains(function ($att) {
                    return $att->isPassed();
                }),
            ];
        }

        return view('frontend.theme.clasic.student.quiz.index', compact('student', 'quizzes', 'attemptStats', 'liveExamsCount'));
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
    /**
     * Question Bank-based Unlimited Practice Dashboard
     */
    public function practiceTests(Request $request)
    {
        $student = Auth::guard('student')->user();
        $selectedCategory = $request->filled('category') ? trim($request->input('category')) : null;
        
        // 1. Comprehensive Question Bank Rotation Progress
        $progress = $this->rotationService->getStudentProgress($student->id, $selectedCategory);

        // 2. Recent practice attempts taken by student
        $recentAttempts = LmsQuizAttempt::where('student_account_id', $student->id)
            ->whereHas('quiz', function ($q) {
                $q->where('quiz_type', 'practice');
            })
            ->with(['quiz'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        // 3. Active in-progress attempt if any
        $activePracticeAttempt = LmsQuizAttempt::where('student_account_id', $student->id)
            ->where('status', 'in_progress')
            ->whereHas('quiz', function ($q) {
                $q->where('quiz_type', 'practice');
            })
            ->first();

        // 4. Practice settings and student attempt limits
        $practiceSettings = PracticeQuestionRotationService::getSettings();
        $completedPracticeAttempts = LmsQuizAttempt::where('student_account_id', $student->id)
            ->whereHas('quiz', function ($q) {
                $q->where('quiz_type', 'practice');
            })
            ->whereIn('status', ['submitted', 'graded', 'timed_out'])
            ->count();

        $isAttemptLimitReached = false;
        if ($practiceSettings['attempt_limit_type'] === 'single' && $completedPracticeAttempts >= 1) {
            $isAttemptLimitReached = true;
        } elseif ($practiceSettings['attempt_limit_type'] === 'custom' && $practiceSettings['max_attempts'] > 0 && $completedPracticeAttempts >= $practiceSettings['max_attempts']) {
            $isAttemptLimitReached = true;
        }

        return view('frontend.theme.clasic.student.quiz.practice', compact(
            'student', 'progress', 'recentAttempts', 'selectedCategory', 'activePracticeAttempt',
            'practiceSettings', 'completedPracticeAttempts', 'isAttemptLimitReached'
        ));
    }

    /**
     * Start a new unlimited Question Bank practice exam with automatic question rotation
     */
    public function startPracticeExam(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        $practiceSettings = PracticeQuestionRotationService::getSettings();

        // Enforce admin attempt limits
        $completedPracticeAttempts = LmsQuizAttempt::where('student_account_id', $student->id)
            ->whereHas('quiz', function ($q) {
                $q->where('quiz_type', 'practice');
            })
            ->whereIn('status', ['submitted', 'graded', 'timed_out'])
            ->count();

        if ($practiceSettings['attempt_limit_type'] === 'single' && $completedPracticeAttempts >= 1) {
            return redirect()->route('student.practice.index')->with([
                'error' => 'আপনি ইতিমধ্যে আপনার নির্ধারিত একক (Single) অনুশীলন পরীক্ষা সম্পন্ন করেছেন। অ্যাডমিন কর্তৃক পুনরায় অনুমতি না দেওয়া পর্যন্ত নতুন পরীক্ষা শুরু করা যাবে না।',
            ]);
        }

        if ($practiceSettings['attempt_limit_type'] === 'custom' && $practiceSettings['max_attempts'] > 0 && $completedPracticeAttempts >= $practiceSettings['max_attempts']) {
            return redirect()->route('student.practice.index')->with([
                'error' => "আপনি ইতিমধ্যে সর্বোচ্চ {$practiceSettings['max_attempts']} টি নির্ধারিত অনুশীলন পরীক্ষা সম্পন্ন করেছেন।",
            ]);
        }

        // Apply admin configured parameters with tier synchronization
        $rawCount = $request->input('question_count') ?: $request->input('tier_selection');
        $requestedCount = $rawCount 
            ? max(1, min(100, (int)PracticeQuestionRotationService::toEnglishDigits($rawCount)))
            : ($practiceSettings['question_count'] > 0 ? (int)$practiceSettings['question_count'] : 20);

        $matchedDuration = null;
        $matchedPassMarks = null;
        if (!empty($practiceSettings['tiers'])) {
            foreach ($practiceSettings['tiers'] as $tier) {
                if ((int)PracticeQuestionRotationService::toEnglishDigits($tier['questions']) === $requestedCount) {
                    $matchedDuration = (int)PracticeQuestionRotationService::toEnglishDigits($tier['duration']);
                    if (isset($tier['pass_marks'])) {
                        $matchedPassMarks = (float)PracticeQuestionRotationService::toEnglishDigits($tier['pass_marks']);
                    }
                    break;
                }
            }
        }

        $durationMinutes = $matchedDuration 
            ?: ($request->filled('duration_minutes') 
                ? max(1, min(300, (int)$request->input('duration_minutes'))) 
                : ($practiceSettings['duration_minutes'] > 0 ? (int)$practiceSettings['duration_minutes'] : 20));

        $questionCount = $requestedCount;

        // Apply admin configured layout/interface mode
        if ($practiceSettings['view_mode'] === 'student_choice') {
            $viewMode = $request->input('view_mode', 'all_questions');
            if (!in_array($viewMode, ['all_questions', 'one_by_one'])) {
                $viewMode = 'all_questions';
            }
        } else {
            $viewMode = in_array($practiceSettings['view_mode'], ['all_questions', 'one_by_one']) ? $practiceSettings['view_mode'] : 'all_questions';
        }

        $category = null;
        if ($practiceSettings['allow_category_choice'] && $request->filled('category')) {
            $category = trim($request->input('category'));
        }

        // Check if existing in-progress attempt exists
        $activeAttempt = LmsQuizAttempt::where('student_account_id', $student->id)
            ->where('status', 'in_progress')
            ->whereHas('quiz', function($q) {
                $q->where('quiz_type', 'practice');
            })
            ->first();

        if ($activeAttempt) {
            $quiz = $activeAttempt->quiz;
            $now = Carbon::now();
            $maxTime = $activeAttempt->started_at->copy()->addMinutes(($quiz ? $quiz->duration_minutes : 30) + 2);

            $existingCount = !empty($activeAttempt->questions_snapshot) ? count($activeAttempt->questions_snapshot) : 0;
            // If time expired OR student starts a newly selected drill with different count:
            if ($now->greaterThan($maxTime) || $existingCount !== $questionCount) {
                $this->finalizeGrading($activeAttempt);
            } else {
                return redirect()->route('student.quiz.take', $activeAttempt->id)->with([
                    'info' => 'আপনার একটি চলমান অনুশীলন পরীক্ষা রয়েছে। সেটি সম্পন্ন করুন।',
                ]);
            }
        }

        // 1. Select rotated questions prioritizing unattempted questions
        $selection = $this->rotationService->selectQuestionsForNewAttempt($student->id, $category, $questionCount);
        $questions = $selection['questions'];
        $cycle = $selection['cycle'];
        $isNewCycle = $selection['is_new_cycle'];

        if ($questions->isEmpty()) {
            return redirect()->route('student.practice.index')->with([
                'error' => 'অনুশীলনের জন্য প্রশ্ন ব্যাংকে কোনো সক্রিয় প্রশ্ন পাওয়া যায়নি।',
            ]);
        }

        // 2. Freeze snapshot of questions and options (guaranteeing 0 duplicate questions in single exam)
        $snapshot = [];
        $seenSnapshotHashes = [];
        foreach ($questions as $q) {
            $h = $q->question_hash ?: \App\model\LmsQuestion::hashText($q->question_text);
            if ($h && isset($seenSnapshotHashes[$h])) {
                continue; // Prevent same question from appearing more than once
            }
            if ($h) {
                $seenSnapshotHashes[$h] = true;
            }
            $opts = $q->options->shuffle()->values();
            $optsArray = [];
            $optIdx = 0;
            foreach ($opts as $o) {
                $optsArray[] = [
                    'id'    => $o->id,
                    'text'  => $o->option_text,
                    'order' => $optIdx++,
                ];
            }

            $markPerQ = isset($practiceSettings['mark_per_question']) && (float)$practiceSettings['mark_per_question'] > 0
                ? (float)$practiceSettings['mark_per_question']
                : 1.0;

            $snapshot[] = [
                'id'              => $q->id,
                'section_id'      => null,
                'section_title'   => null,
                'question_text'   => $q->question_text,
                'question_type'   => $q->question_type,
                'marks'           => $markPerQ,
                'negative_marks'  => $q->negative_marks !== null ? (float)$q->negative_marks : 0.0,
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

        // 3. Resolve or create system practice quiz with custom pass mark
        $passMarksReq = $matchedPassMarks !== null
            ? $matchedPassMarks
            : ($request->filled('pass_marks') ? (float)$this->rotationService->toEnglishDigits($request->input('pass_marks')) : null);
        $quiz = $this->rotationService->getOrCreatePracticeQuiz($category, count($questions), $durationMinutes, $passMarksReq);

        $attemptNumber = LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $student->id)
            ->count() + 1;

        $totalMarks = round(count($questions) * $markPerQ, 2);
        $finalPassMarks = $passMarksReq !== null ? (float)$passMarksReq : (float)$quiz->pass_marks;

        $newAttempt = LmsQuizAttempt::create([
            'quiz_id'              => $quiz->id,
            'student_account_id'   => $student->id,
            'attempt_number'       => $attemptNumber,
            'started_at'           => Carbon::now(),
            'total_marks'          => $totalMarks,
            'pass_marks'           => $finalPassMarks,
            'status'               => 'in_progress',
            'view_mode'            => $viewMode,
            'question_set'         => "Cycle {$cycle}",
            'questions_snapshot'   => $snapshot,
            'flagged_question_ids' => [],
        ]);

        // 4. Immediately record in student question history
        $this->rotationService->recordAttemptQuestions($newAttempt, $questions, $student->id, $cycle);

        $msg = $isNewCycle 
            ? "🎉 অভিনন্দন! আপনি প্রশ্ন ব্যাংকের সকল প্রশ্ন অনুশীলন করেছেন। নতুন প্র্যাকটিস সাইকেল (Cycle {$cycle}) শুরু হয়েছে!"
            : "আপনার নতুন অনুশীলন পরীক্ষা তৈরি হয়েছে। সম্পূর্ণ নতুন প্রশ্ন নিয়ে অনুশীলন শুরু করুন!";

        return redirect()->route('student.quiz.take', $newAttempt->id)->with([
            'success' => $msg,
        ]);
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

        if ($quiz->isUpcoming()) {
            $formattedStart = $quiz->getFormattedStartTime();
            $remaining = $quiz->getRemainingTimeForHumans();
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => "এই পরীক্ষাটি এখনও শুরু হয়নি। পরীক্ষা শুরু হবে {$formattedStart} তারিখে ({$remaining})।",
            ]);
        }

        if ($quiz->isExpired()) {
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => 'এই পরীক্ষার নির্ধারিত সময়সীমা সমাপ্ত হয়েছে। নতুন করে পরীক্ষায় অংশগ্রহণ করা যাবে না।',
            ]);
        }

        if (!$quiz->canAttempt($student->id)) {
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => 'You have reached the maximum allowed attempts for this assessment.',
            ]);
        }

        if ($quiz->questions()->count() === 0 && (!$quiz->paper_id || !$quiz->paper || !$quiz->paper->items()->exists())) {
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => 'এই কুইজে এখনো কোনো প্রশ্ন যোগ করা হয়নি। অনুগ্রহ করে পরবর্তীতে চেষ্টা করুন।',
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

            $seenAttemptHashes = [];
            foreach ($paperItems as $it) {
                $q = $it->masterQuestion;
                if (!$q) continue;

                $qText = $it->getQuestionText() ?: $q->question_text;
                $h = $q->question_hash ?: \App\model\LmsQuestion::hashText($qText);
                if ($h && isset($seenAttemptHashes[$h])) {
                    continue; // Skip duplicate question within the same exam
                }
                if ($h) {
                    $seenAttemptHashes[$h] = true;
                }

                $type = $it->getQuestionType() ?: $q->question_type;
                $isMcqFormat = in_array($type, ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice']);
                // Strict MCQ constraint: non-MCQ formats are not allowed for student panel examinations
                if (!$isMcqFormat || !$q->options || $q->options->count() < 2) {
                    continue;
                }

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
            // Standard Quiz question retrieval (strictly MCQ format with options)
            $questionsQuery = $quiz->activeQuestions()
                ->whereIn('question_type', ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice'])
                ->has('options', '>=', 2)
                ->with('options');
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
                $rawQuestions = $quiz->activeQuestions()
                    ->whereIn('question_type', ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice'])
                    ->has('options', '>=', 2)
                    ->with('options')
                    ->get();
            }

            if ($quiz->shuffle_questions) {
                $rawQuestions = $rawQuestions->shuffle()->values();
            }

            $seenRawHashes = [];
            foreach ($rawQuestions as $q) {
                $h = $q->question_hash ?: \App\model\LmsQuestion::hashText($q->question_text);
                if ($h && isset($seenRawHashes[$h])) {
                    continue; // Skip duplicate question within the same exam
                }
                if ($h) {
                    $seenRawHashes[$h] = true;
                }
                $opts = $q->options;
                if (!$opts || $opts->count() < 2) {
                    continue;
                }
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

        if ($attemptNumber > 1 && ($quiz->shuffle_questions || $quiz->shuffle_options)) {
            $lastAttempt = LmsQuizAttempt::where('quiz_id', $quiz->id)
                ->where('student_account_id', $student->id)
                ->orderBy('id', 'desc')
                ->first();
            $prevSnapshot = ($lastAttempt && is_array($lastAttempt->questions_snapshot))
                ? $lastAttempt->questions_snapshot
                : [];
            $snapshot = $this->shuffleSnapshotItems(
                $snapshot,
                $prevSnapshot,
                (bool)$quiz->shuffle_questions,
                (bool)$quiz->shuffle_options
            );
        }

        $viewMode = $request->input('view_mode', $quiz->view_mode ?: 'all_questions');

        $newAttempt = LmsQuizAttempt::create([
            'quiz_id' => $quiz->id,
            'student_account_id' => $student->id,
            'attempt_number' => $attemptNumber,
            'started_at' => Carbon::now(),
            'total_marks' => $quiz->total_marks,
            'pass_marks' => (float)$quiz->pass_marks,
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

        // Guarantee no duplicate question appears in exam interface
        $seenExamHashes = [];
        $questions = $questions->filter(function($q) use (&$seenExamHashes) {
            $text = isset($q->question_text) ? $q->question_text : '';
            $h = !empty($q->question_hash) ? $q->question_hash : \App\model\LmsQuestion::hashText($text);
            if ($h && isset($seenExamHashes[$h])) {
                return false;
            }
            if ($h) {
                $seenExamHashes[$h] = true;
            }
            return true;
        })->values();

        // Load existing answers for this attempt
        $existingAnswers = LmsQuizAnswer::where('attempt_id', $attempt->id)
            ->get()
            ->keyBy('question_id');

        // Flagged question IDs
        $flaggedQuestionIds = $attempt->flagged_ids_array;

        return response()
            ->view('frontend.theme.clasic.student.quiz.take', compact(
                'student', 'quiz', 'attempt', 'questions', 'secondsRemaining', 'existingAnswers', 'flaggedQuestionIds'
            ))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
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

        // Fallback for null or deleted quiz
        if (!$quiz) {
            $quiz = new \App\model\LmsQuiz([
                'title'                 => 'Assessment #' . ($attempt->quiz_id ?: $attempt->id),
                'quiz_type'              => 'practice',
                'duration_minutes'       => 30,
                'total_marks'            => $attempt->total_marks ?: 10,
                'pass_marks'             => $attempt->pass_marks ?: 10,
                'result_release_policy'  => 'immediate',
            ]);
            $quiz->id = $attempt->quiz_id ?: 0;
        }

        // Check result release policy
        $now = Carbon::now();
        $resultsLocked = false;
        $resultsLockedMessage = '';

        if ($quiz->result_release_policy === 'admin_publish') {
            $resultsLocked = true;
            $resultsLockedMessage = 'পরীক্ষার ফলাফল পর্যালোচনার জন্য কর্তৃপক্ষের অনুমোদনের অপেক্ষায় রয়েছে। ফলাফল প্রকাশিত হলে সম্পূর্ণ উত্তরপত্র দেখতে পাবেন।';
        } elseif ($quiz->result_release_policy === 'after_deadline' && $quiz->end_time && $now->lessThan($quiz->end_time)) {
            $endTimeFormatted = $quiz->end_time instanceof Carbon ? $quiz->end_time->format('d M, Y h:i A') : date('d M, Y h:i A', strtotime($quiz->end_time));
            $resultsLocked = true;
            $resultsLockedMessage = 'পরীক্ষার নির্ধারিত সমাপ্তি সময় (' . $endTimeFormatted . ') এর পর সম্পূর্ণ ব্যাখ্যা ও ফলাফল দেখতে পাবেন।';
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
                    if (isset($snap['marks'])) {
                        $q->marks = (float)$snap['marks'];
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
                $questions = method_exists($quiz, 'getExamQuestions') ? $quiz->getExamQuestions() : collect();
            }
        } else {
            $questions = method_exists($quiz, 'getExamQuestions') ? $quiz->getExamQuestions() : collect();
        }

        $answers = $attempt->answers->keyBy('question_id');

        $attemptTotalMarks = $attempt->total_marks > 0 ? (float)$attempt->total_marks : (float)($quiz ? $quiz->total_marks : 0);
        $attemptPassMarks = $attempt->pass_marks;
        $markPerQuestion = $questions->count() > 0 ? round($attemptTotalMarks / $questions->count(), 2) : 1.0;

        return view('frontend.theme.clasic.student.quiz.result', compact(
            'student', 'quiz', 'attempt', 'questions', 'answers', 'resultsLocked', 'resultsLockedMessage',
            'attemptTotalMarks', 'attemptPassMarks', 'markPerQuestion'
        ));
    }

    /**
     * Full Results History
     */
    /**
     * Retake an exam using the EXACT questions from a previously submitted attempt
     */
    /**
     * Record an anti-cheating security violation (Tab switch, copy, cut, right-click, shortcuts)
     * NOTE: Strictly adheres to user directive: Never automatically terminate, cancel or interrupt exam.
     */
    public function recordViolation(Request $request, $attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);

        $request->validate([
            'violation_type' => 'required|string|max:60',
            'details'        => 'nullable|string|max:500',
        ]);

        $violationType = $request->input('violation_type');
        $details = $request->input('details');

        if ($attempt->status === 'in_progress') {
            $newCount = ($attempt->security_violations_count ?: 0) + 1;

            // 1. Create permanent audit record
            \App\model\LmsExamViolation::create([
                'attempt_id'         => $attempt->id,
                'quiz_id'            => $attempt->quiz_id,
                'student_account_id' => $student->id,
                'violation_type'     => $violationType,
                'warning_count'      => $newCount,
                'details'            => $details,
                'ip_address'         => $request->ip(),
            ]);

            // 2. Append to attempt log array
            $currentLog = is_array($attempt->security_violations_log) ? $attempt->security_violations_log : [];
            $currentLog[] = [
                'warning_number' => $newCount,
                'violation_type' => $violationType,
                'title'          => \App\model\LmsExamViolation::translateViolationType($violationType),
                'details'        => $details,
                'time'           => Carbon::now()->toDateTimeString(),
            ];

            $attempt->update([
                'security_violations_count' => $newCount,
                'security_violations_log'   => $currentLog,
            ]);

            return response()->json([
                'success'        => true,
                'warning_count'  => $newCount,
                'violation_type' => $violationType,
                'title'          => \App\model\LmsExamViolation::translateViolationType($violationType),
                'message'        => 'নিরাপত্তা লঙ্ঘন রেকর্ড করা হয়েছে।',
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Exam is not in progress.'], 400);
    }

    public function retakeAttempt(Request $request, $attemptId)
    {
        $student = Auth::guard('student')->user();
        $previousAttempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);
        $quiz = $previousAttempt->quiz;

        // If student already has an active in-progress attempt for this quiz, check if still valid
        $activeAttempt = LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $student->id)
            ->where('status', 'in_progress')
            ->first();

        if ($activeAttempt) {
            $now = Carbon::now();
            $maxTime = $activeAttempt->started_at->copy()->addMinutes($quiz->duration_minutes + 2);
            if ($now->lessThanOrEqualTo($maxTime)) {
                return redirect()->route('student.quiz.take', $activeAttempt->id)->with([
                    'info' => 'আপনার এই কুইজের একটি চলমান পরীক্ষা চালু রয়েছে।',
                ]);
            } else {
                $this->finalizeGrading($activeAttempt);
            }
        }

        if ($quiz->isUpcoming()) {
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => 'এই পরীক্ষাটি এখনও শুরু হয়নি।',
            ]);
        }

        if ($quiz->isExpired()) {
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => 'এই পরীক্ষার নির্ধারিত সময়সীমা সমাপ্ত হয়েছে।',
            ]);
        }

        // Check attempt limit
        if ($quiz->max_attempts > 0) {
            $finishedCount = LmsQuizAttempt::where('quiz_id', $quiz->id)
                ->where('student_account_id', $student->id)
                ->whereIn('status', ['submitted', 'graded', 'timed_out'])
                ->count();

            if ($finishedCount >= $quiz->max_attempts) {
                return redirect()->route('student.quiz.results', $previousAttempt->id)->with([
                    'error' => 'আপনি এই কুইজের জন্য নির্ধারিত সর্বোচ্চ পরীক্ষার সীমা (' . $quiz->max_attempts . ' বার) অতিক্রম করেছেন।',
                ]);
            }
        }

        // Extract submitted questions snapshot from previous attempt
        $snapshot = $previousAttempt->questions_snapshot;

        // Fallback if snapshot was somehow empty
        if (empty($snapshot) || !is_array($snapshot) || count($snapshot) === 0) {
            if ($quiz->paper_id && $quiz->paper && $quiz->paper->items()->exists()) {
                $paperItems = $quiz->paper->items()->with(['masterQuestion.options', 'section'])->orderBy('order_index', 'asc')->get();
                $snapshot = [];
                foreach ($paperItems as $it) {
                    $q = $it->masterQuestion;
                    if (!$q) continue;
                    $optsArray = [];
                    $optIdx = 0;
                    foreach ($q->options as $o) {
                        $optsArray[] = ['id' => $o->id, 'text' => $o->option_text, 'order' => $optIdx++];
                    }
                    $snapshot[] = [
                        'id' => $q->id,
                        'paper_item_id' => $it->id,
                        'question_text' => $it->getQuestionText() ?: $q->question_text,
                        'question_type' => $it->getQuestionType() ?: $q->question_type,
                        'marks' => (float)$it->marks,
                        'negative_marks' => $it->negative_marks !== null ? (float)$it->negative_marks : null,
                        'options' => $optsArray,
                    ];
                }
            } elseif ($quiz->questions()->count() > 0) {
                $rawQuestions = $quiz->activeQuestions()->with('options')->get();
                $snapshot = [];
                foreach ($rawQuestions as $q) {
                    $optsArray = [];
                    $optIdx = 0;
                    foreach ($q->options as $o) {
                        $optsArray[] = ['id' => $o->id, 'text' => $o->option_text, 'order' => $optIdx++];
                    }
                    $snapshot[] = [
                        'id' => $q->id,
                        'question_text' => $q->question_text,
                        'question_type' => $q->question_type,
                        'marks' => (float)$q->marks,
                        'negative_marks' => $q->negative_marks !== null ? (float)$q->negative_marks : null,
                        'options' => $optsArray,
                    ];
                }
            } elseif ($quiz->quiz_type === 'practice') {
                if (!$request->filled('question_count')) {
                    $prevQCount = !empty($previousAttempt->questions_snapshot) && is_array($previousAttempt->questions_snapshot)
                        ? count($previousAttempt->questions_snapshot)
                        : ($quiz->questions()->count() ?: (int)$previousAttempt->total_marks);
                    $mergeData = ['question_count' => $prevQCount];
                    if ($previousAttempt->pass_marks !== null) {
                        $mergeData['pass_marks'] = (float)$previousAttempt->pass_marks;
                    }
                    if (!$request->filled('category') && $quiz->title && strpos($quiz->title, 'Question Bank Practice: ') === 0) {
                        $mergeData['category'] = trim(substr($quiz->title, strlen('Question Bank Practice: ')));
                    }
                    $request->merge($mergeData);
                }
                return $this->startPracticeExam($request);
            }
        }

        if (empty($snapshot) || count($snapshot) === 0) {
            return redirect()->route('student.quiz.lobby', $quiz->id)->with([
                'error' => 'পুনরায় পরীক্ষা দেওয়ার জন্য কোনো প্রশ্ন খুঁজে পাওয়া যায়নি।',
            ]);
        }

        $rootParentId = $previousAttempt->parent_attempt_id ?: $previousAttempt->id;
        $retakesSoFar = LmsQuizAttempt::where('parent_attempt_id', $rootParentId)->count();
        $nextNumber = $retakesSoFar + 2; // Original is 1, next is 2, 3...

        // Compare against the latest attempt in this retake chain so every retake re-shuffles
        // both question serial order and option answer positions distinctly.
        $latestInChain = LmsQuizAttempt::where(function ($q) use ($rootParentId) {
                $q->where('id', $rootParentId)
                  ->orWhere('parent_attempt_id', $rootParentId);
            })
            ->where('student_account_id', $student->id)
            ->orderBy('id', 'desc')
            ->first();

        $referenceSnapshot = ($latestInChain && is_array($latestInChain->questions_snapshot) && !empty($latestInChain->questions_snapshot))
            ? $latestInChain->questions_snapshot
            : (is_array($previousAttempt->questions_snapshot) ? $previousAttempt->questions_snapshot : []);

        $snapshot = $this->shuffleSnapshotItems($snapshot, $referenceSnapshot, true, true);

        $attemptTotalMarks = $previousAttempt->total_marks ?: $quiz->total_marks;
        $resolvedPassMarks = is_numeric($quiz->pass_marks)
            ? (float)$quiz->pass_marks
            : (float)$previousAttempt->pass_marks;
        if ($quiz->total_marks > 0 && $attemptTotalMarks > 0 && (float)$attemptTotalMarks !== (float)$quiz->total_marks && is_numeric($quiz->pass_marks)) {
            $resolvedPassMarks = round($attemptTotalMarks * ((float)$quiz->pass_marks / (float)$quiz->total_marks), 2);
        }

        $newAttempt = LmsQuizAttempt::create([
            'quiz_id'              => $quiz->id,
            'student_account_id'   => $student->id,
            'parent_attempt_id'    => $rootParentId,
            'attempt_number'       => $nextNumber,
            'started_at'           => Carbon::now('Asia/Dhaka'),
            'total_marks'          => $attemptTotalMarks,
            'pass_marks'           => $resolvedPassMarks,
            'status'               => 'in_progress',
            'view_mode'            => $previousAttempt->view_mode ?: ($quiz->view_mode ?: 'all_questions'),
            'question_set'         => $previousAttempt->question_set ?: 'Cycle 1',
            'questions_snapshot'   => $snapshot,
            'flagged_question_ids' => [],
        ]);

        return redirect()->route('student.quiz.take', $newAttempt->id)->with([
            'success' => 'পুনরায় পরীক্ষা শুরু হয়েছে! পূর্ববর্তী সেটের প্রশ্নগুলো নতুন ক্রম ও অপশন বিন্যাসে সাজানো হয়েছে।',
        ]);
    }

    /**
     * Re-shuffle question serial order and each question's option order for retakes,
     * ensuring every retake gets a randomized sequence distinct from the previous attempt.
     */
    protected function shuffleSnapshotItems(
        array $snapshot,
        array $previousSnapshot = [],
        bool $shuffleQuestions = true,
        bool $shuffleOptions = true
    ): array {
        $items = array_values($snapshot);
        if (empty($items)) {
            return [];
        }

        $prevQuestionIds = array_column($previousSnapshot, 'id');
        if (empty($prevQuestionIds)) {
            $prevQuestionIds = array_column($items, 'id');
        }

        if ($shuffleQuestions && count($items) > 1 && count(array_unique(array_column($items, 'id'))) > 1) {
            for ($try = 0; $try < 10; $try++) {
                shuffle($items);
                if (array_column($items, 'id') !== $prevQuestionIds) {
                    break;
                }
            }
            if (array_column($items, 'id') === $prevQuestionIds) {
                $firstId = $items[0]['id'] ?? null;
                $swapCandidates = [];
                for ($i = 1; $i < count($items); $i++) {
                    if (($items[$i]['id'] ?? null) !== $firstId) {
                        $swapCandidates[] = $i;
                    }
                }
                if (!empty($swapCandidates)) {
                    $swapIdx = $swapCandidates[array_rand($swapCandidates)];
                    $tmp = $items[0];
                    $items[0] = $items[$swapIdx];
                    $items[$swapIdx] = $tmp;
                }
            }
        }

        if (!$shuffleOptions) {
            return array_values($items);
        }

        // Load correct option IDs so answer positions also shift to a different option letter when possible
        $questionIds = array_values(array_filter(array_column($items, 'id')));
        $correctOptionsByQuestion = [];
        if (!empty($questionIds)) {
            $correctRows = LmsQuestionOption::whereIn('question_id', $questionIds)
                ->where('is_correct', true)
                ->get(['question_id', 'id']);
            foreach ($correctRows as $row) {
                $correctOptionsByQuestion[(int)$row->question_id][] = (int)$row->id;
            }
        }

        $prevOptionsByQuestion = [];
        foreach ($previousSnapshot as $prevQ) {
            if (isset($prevQ['id']) && !empty($prevQ['options']) && is_array($prevQ['options'])) {
                $prevOptionsByQuestion[(int)$prevQ['id']] = array_values($prevQ['options']);
            }
        }

        foreach ($items as &$qItem) {
            if (empty($qItem['options']) || !is_array($qItem['options'])) {
                continue;
            }

            $qId = isset($qItem['id']) ? (int)$qItem['id'] : 0;
            $opts = array_values($qItem['options']);
            $prevOpts = ($qId > 0 && isset($prevOptionsByQuestion[$qId])) ? $prevOptionsByQuestion[$qId] : $opts;
            $prevOptIds = array_column($prevOpts, 'id');

            $correctIds = isset($correctOptionsByQuestion[$qId]) ? $correctOptionsByQuestion[$qId] : [];
            $prevCorrectIndices = [];
            if (!empty($correctIds)) {
                foreach ($prevOpts as $pIdx => $pOpt) {
                    if (isset($pOpt['id']) && in_array((int)$pOpt['id'], $correctIds, true)) {
                        $prevCorrectIndices[] = $pIdx;
                    }
                }
            }

            $hasMultipleDistinctOptions = count($opts) > 1 && count(array_unique(array_column($opts, 'id'))) > 1;
            $shouldShiftCorrectPos = $hasMultipleDistinctOptions
                && !empty($prevCorrectIndices)
                && count($correctIds) < count($opts);

            if ($hasMultipleDistinctOptions) {
                for ($try = 0; $try < 10; $try++) {
                    shuffle($opts);
                    if (array_column($opts, 'id') === $prevOptIds) {
                        continue;
                    }
                    if ($shouldShiftCorrectPos && $this->getCorrectOptionIndices($opts, $correctIds) === $prevCorrectIndices) {
                        continue;
                    }
                    break;
                }

                if (array_column($opts, 'id') === $prevOptIds) {
                    $firstOptId = $opts[0]['id'] ?? null;
                    for ($i = 1; $i < count($opts); $i++) {
                        if (($opts[$i]['id'] ?? null) !== $firstOptId) {
                            $tmp = $opts[0];
                            $opts[0] = $opts[$i];
                            $opts[$i] = $tmp;
                            break;
                        }
                    }
                }

                if ($shouldShiftCorrectPos && $this->getCorrectOptionIndices($opts, $correctIds) === $prevCorrectIndices) {
                    $curCorrectIndices = $this->getCorrectOptionIndices($opts, $correctIds);
                    $nonCorrectIndices = [];
                    foreach ($opts as $cIdx => $cOpt) {
                        if (!isset($cOpt['id']) || !in_array((int)$cOpt['id'], $correctIds, true)) {
                            $nonCorrectIndices[] = $cIdx;
                        }
                    }
                    if (!empty($curCorrectIndices) && !empty($nonCorrectIndices)) {
                        $fromIdx = $curCorrectIndices[0];
                        $toIdx = $nonCorrectIndices[array_rand($nonCorrectIndices)];
                        $tmp = $opts[$fromIdx];
                        $opts[$fromIdx] = $opts[$toIdx];
                        $opts[$toIdx] = $tmp;
                    }
                }
            }

            foreach ($opts as $optIdx => &$opt) {
                $opt['order'] = $optIdx;
            }
            unset($opt);

            $qItem['options'] = array_values($opts);
        }
        unset($qItem);

        return array_values($items);
    }

    /**
     * Collect indices of correct option IDs within an ordered options array.
     */
    protected function getCorrectOptionIndices(array $options, array $correctIds): array
    {
        $indices = [];
        foreach ($options as $idx => $opt) {
            if (isset($opt['id']) && in_array((int)$opt['id'], $correctIds, true)) {
                $indices[] = $idx;
            }
        }
        return $indices;
    }

    public function allResults(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        // Load root attempts (attempts without a parent) with all nested retakes
        $query = LmsQuizAttempt::where('student_account_id', $student->id)
            ->whereNull('parent_attempt_id')
            ->whereIn('status', ['submitted', 'graded', 'timed_out'])
            ->with(['quiz.course', 'retakes' => function($q) {
                $q->whereIn('status', ['submitted', 'graded', 'timed_out'])->orderBy('id', 'asc');
            }])
            ->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($subQ) use ($search) {
                $subQ->whereHas('quiz', function($quizQ) use ($search) {
                    $quizQ->where('title', 'like', "%{$search}%")
                          ->orWhere('class_level', 'like', "%{$search}%")
                          ->orWhereHas('course', function($cQ) use ($search) {
                              $cQ->where('course_title', 'like', "%{$search}%");
                          });
                })->orWhere('id', 'like', "%{$search}%")
                  ->orWhere('question_set', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $outerPassExpr = 'COALESCE(lms_quiz_attempts.pass_marks, (SELECT q.pass_marks FROM lms_quizzes q WHERE q.id = lms_quiz_attempts.quiz_id LIMIT 1), 0)';
            $retakePassedExists = "EXISTS (SELECT 1 FROM lms_quiz_attempts r WHERE r.parent_attempt_id = lms_quiz_attempts.id AND r.status IN ('submitted', 'graded', 'timed_out') AND r.score >= COALESCE(r.pass_marks, (SELECT q.pass_marks FROM lms_quizzes q WHERE q.id = r.quiz_id LIMIT 1), 0))";

            if ($request->status === 'passed') {
                $query->whereRaw("(lms_quiz_attempts.score >= {$outerPassExpr} OR {$retakePassedExists})");
            } elseif ($request->status === 'failed') {
                $query->whereRaw("(lms_quiz_attempts.score < {$outerPassExpr} AND NOT {$retakePassedExists})");
            }
        }

        $attempts = $query->paginate(10)->appends($request->all());

        // Global stats for KPI cards across all attempts
        $allAttempts = LmsQuizAttempt::where('student_account_id', $student->id)
            ->whereIn('status', ['submitted', 'graded', 'timed_out'])
            ->get();

        $totalAttemptsCount = $allAttempts->count();
        $passedAttemptsCount = $allAttempts->filter(function($a) { return $a->isPassed(); })->count();
        $avgPctVal = (int) round($allAttempts->avg('percentage') ?: 0);
        $maxScoreVal = $allAttempts->max('score') ?: 0;

        return view('frontend.theme.clasic.student.quiz.history', compact('student', 'attempts', 'totalAttemptsCount', 'passedAttemptsCount', 'avgPctVal', 'maxScoreVal'));
    }

    /**
     * Exam History Archive
     */
    public function examHistory(Request $request)
    {
        return $this->allResults($request);
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
        if (!empty($attempt->questions_snapshot) && is_array($attempt->questions_snapshot)) {
            $snapshotQIds = collect($attempt->questions_snapshot)->pluck('id')->toArray();
            $snapshotMap = collect($attempt->questions_snapshot)->keyBy('id');
            $questionsDb = \App\model\LmsQuestion::with('options')
                ->whereIn('id', $snapshotQIds)
                ->get();
            $questions = collect();
            foreach ($snapshotQIds as $sId) {
                $q = $questionsDb->firstWhere('id', $sId);
                if ($q) {
                    $snap = $snapshotMap->get($sId);
                    if ($snap && isset($snap['marks'])) {
                        $q->marks = (float)$snap['marks'];
                    }
                    $questions->push($q);
                }
            }
        } else {
            $questions = $quiz ? $quiz->getExamQuestions() : collect();
            if ($questions->isEmpty() && $quiz) {
                $questions = $quiz->questions()->with('options')->get();
            }
        }

        $totalMarksObtained = 0.0;
        $totalNegativeDeducted = 0.0;

        // Determine whether negative marking is active for this assessment
        $isNegActive = false;
        $defaultNegValue = 0.0;
        if ($quiz && $quiz->quiz_type === 'practice') {
            $pSettings = \App\Services\PracticeQuestionRotationService::getSettings();
            if (!empty($pSettings['negative_marking_enabled'])) {
                $isNegActive = true;
                $defaultNegValue = (float)($pSettings['negative_mark_value'] ?? 0.25);
            }
        } else {
            // Formal Exam / Assessment: active ONLY if quiz explicitly has negative_marks > 0
            if ($quiz && (float)$quiz->negative_marks > 0) {
                $isNegActive = true;
                $defaultNegValue = (float)$quiz->negative_marks;
            }
        }

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
                    $negMark = 0.0;
                    if ($isNegActive) {
                        $negMark = ($question->negative_marks !== null && (float)$question->negative_marks > 0)
                            ? abs((float)$question->negative_marks)
                            : abs((float)$defaultNegValue);
                    }
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
                    $negMark = 0.0;
                    if ($isNegActive) {
                        $negMark = ($question->negative_marks !== null && (float)$question->negative_marks > 0)
                            ? abs((float)$question->negative_marks)
                            : abs((float)$defaultNegValue);
                    }
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
                    $negMark = 0.0;
                    if ($isNegActive) {
                        $negMark = ($question->negative_marks !== null && (float)$question->negative_marks > 0)
                            ? abs((float)$question->negative_marks)
                            : abs((float)$defaultNegValue);
                    }
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

        $attemptTotalMarks = $attempt->total_marks > 0 ? (float)$attempt->total_marks : (float)($quiz ? $quiz->total_marks : 0);
        $attempt->score = $finalScore;
        $attempt->negative_marks_deducted = $totalNegativeDeducted;
        $attempt->percentage = $attemptTotalMarks > 0 
            ? round(($finalScore / $attemptTotalMarks) * 100, 2) 
            : 0;
        $attempt->status = 'graded';
        $attempt->submitted_at = Carbon::now('Asia/Dhaka');

        if ($attempt->time_spent_seconds <= 0 && $attempt->started_at) {
            $attempt->time_spent_seconds = min(
                $quiz->duration_minutes * 60,
                $attempt->submitted_at->diffInSeconds($attempt->started_at)
            );
        }

        $attempt->save();
    }
}

