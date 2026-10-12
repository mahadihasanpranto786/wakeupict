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
     * Initiate or resume quiz attempt
     */
    public function startQuiz($id)
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

        $newAttempt = LmsQuizAttempt::create([
            'quiz_id' => $quiz->id,
            'student_account_id' => $student->id,
            'attempt_number' => $attemptNumber,
            'started_at' => Carbon::now(),
            'total_marks' => $quiz->total_marks,
            'status' => 'in_progress',
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

        // Calculate time remaining in seconds
        $endTime = $attempt->started_at->copy()->addMinutes($quiz->duration_minutes);
        $now = Carbon::now();
        $secondsRemaining = $now->diffInSeconds($endTime, false);

        if ($secondsRemaining <= 0) {
            $this->finalizeGrading($attempt);
            return redirect()->route('student.quiz.results', $attempt->id)->with([
                'warning' => 'Time expired! Your exam was automatically submitted and graded.',
            ]);
        }

        $questions = $quiz->activeQuestions()->with('options')->get();
        if ($quiz->shuffle_questions) {
            $questions = $questions->shuffle();
        }

        // Eager load current student answers for this attempt
        $existingAnswers = LmsQuizAnswer::where('attempt_id', $attempt->id)
            ->get()
            ->keyBy('question_id');

        return view('frontend.theme.clasic.student.quiz.take', compact(
            'student', 'quiz', 'attempt', 'questions', 'secondsRemaining', 'existingAnswers'
        ));
    }

    /**
     * Autosave question answer via AJAX
     */
    public function saveAnswer(Request $request, $attemptId)
    {
        $student = Auth::guard('student')->user();
        $attempt = LmsQuizAttempt::where('student_account_id', $student->id)->findOrFail($attemptId);

        if ($attempt->status !== 'in_progress') {
            return response()->json(['status' => 'error', 'message' => 'Attempt is no longer active'], 400);
        }

        $questionId = $request->input('question_id');
        $selectedOptionIds = $request->input('selected_option_ids');
        $textAnswer = $request->input('text_answer');

        if (is_array($selectedOptionIds)) {
            $selectedOptionIds = json_encode($selectedOptionIds);
        }

        $answer = LmsQuizAnswer::firstOrNew([
            'attempt_id' => $attempt->id,
            'question_id' => $questionId,
        ]);

        $answer->selected_option_ids = $selectedOptionIds;
        $answer->text_answer = $textAnswer;
        $answer->save();

        if ($request->has('time_spent_seconds')) {
            $attempt->time_spent_seconds = (int) $request->input('time_spent_seconds');
            $attempt->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Answer saved']);
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
                    $selectedIds = is_array($optVal) ? json_encode($optVal) : json_encode([$optVal]);
                    LmsQuizAnswer::updateOrCreate([
                        'attempt_id' => $attempt->id,
                        'question_id' => $qId,
                    ], [
                        'selected_option_ids' => $selectedIds,
                    ]);
                }
            }

            if ($request->has('time_spent_seconds')) {
                $attempt->time_spent_seconds = (int) $request->time_spent_seconds;
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
        $questions = $quiz->questions()->with('options')->get();
        $answers = $attempt->answers->keyBy('question_id');

        return view('frontend.theme.clasic.student.quiz.result', compact(
            'student', 'quiz', 'attempt', 'questions', 'answers'
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
     * Auto-grading calculation engine
     */
    protected function finalizeGrading(LmsQuizAttempt $attempt)
    {
        $quiz = $attempt->quiz;
        $questions = $quiz->questions()->with('options')->get();
        $totalMarksObtained = 0.0;

        foreach ($questions as $question) {
            $answer = LmsQuizAnswer::where('attempt_id', $attempt->id)
                ->where('question_id', $question->id)
                ->first();

            if (!$answer) {
                continue;
            }

            $correctOptionIds = $question->options->where('is_correct', true)->pluck('id')->toArray();
            $studentOptionIds = [];

            if (!empty($answer->selected_option_ids)) {
                $decoded = json_decode($answer->selected_option_ids, true);
                $studentOptionIds = is_array($decoded) ? array_map('intval', $decoded) : [(int) $answer->selected_option_ids];
            }

            $isCorrect = false;

            if ($question->question_type === 'mcq_single' || $question->question_type === 'true_false') {
                $isCorrect = (count($studentOptionIds) === 1 && in_array($studentOptionIds[0], $correctOptionIds));
            } elseif ($question->question_type === 'mcq_multi') {
                sort($correctOptionIds);
                sort($studentOptionIds);
                $isCorrect = ($correctOptionIds === $studentOptionIds);
            }

            $marks = $isCorrect ? (float) $question->marks : 0.0;
            $answer->is_correct = $isCorrect;
            $answer->marks_obtained = $marks;
            $answer->save();

            $totalMarksObtained += $marks;
        }

        $attempt->score = $totalMarksObtained;
        $attempt->percentage = $quiz->total_marks > 0 
            ? round(($totalMarksObtained / $quiz->total_marks) * 100, 2) 
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
