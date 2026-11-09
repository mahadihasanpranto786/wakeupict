<?php

namespace App\Http\Controllers\backend\theme\clasic\lms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\model\Course;
use App\Services\QuizExcelImportService;
use App\Services\PracticeQuestionRotationService;
use Illuminate\Support\Facades\DB;

class AdminQuizController extends Controller
{
    protected $importService;

    public function __construct(QuizExcelImportService $importService)
    {
        $this->middleware('auth');
        $this->importService = $importService;
    }

    /**
     * Display all quizzes with Course/Category filters and Excel import controls
     */
    public function index(Request $request)
    {
        $query = LmsQuiz::with(['course'])->withCount(['questions', 'attempts'])->latest();

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by quiz type
        if ($request->filled('quiz_type')) {
            $query->where('quiz_type', $request->quiz_type);
        }

        // Search by title
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $quizzes = $query->paginate(20)->appends($request->all());

        // Stats
        $totalQuizzes = LmsQuiz::count();
        $totalQuestions = LmsQuestion::count();
        $publishedQuizzes = LmsQuiz::where('is_published', true)->count();

        // Dropdown Courses
        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();

        // Question Library Categories
        $categories = LmsQuestion::whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category')->sort()->values();
        $totalLibraryQuestions = LmsQuestion::whereNull('quiz_id')->orWhere('quiz_id', 0)->count();
        $questionPapers = \App\model\LmsQuestionPaper::withCount('items')->latest()->get();
        $practiceSettings = PracticeQuestionRotationService::getSettings();

        return view('backend.theme.clasic.lms.quizzes.index', compact(
            'quizzes', 'courses', 'totalQuizzes', 'totalQuestions', 'publishedQuizzes', 'categories', 'totalLibraryQuestions', 'questionPapers', 'practiceSettings'
        ));
    }

    /**
     * Create a new Quiz
     */
    public function updatePracticeSettings(Request $request)
    {
        // 1. Sanitize all incoming numbers from Bengali numerals to pure English ASCII digits
        $inputs = $request->all();
        foreach (['tier_questions', 'tier_durations', 'tier_pass_marks', 'question_count', 'duration_minutes', 'max_attempts', 'mark_per_question', 'pass_percentage', 'negative_mark_value'] as $numKey) {
            if (isset($inputs[$numKey])) {
                $inputs[$numKey] = PracticeQuestionRotationService::toEnglishDigits($inputs[$numKey]);
            }
        }
        $request->merge($inputs);

        $request->validate([
            'question_count'        => 'nullable|integer|min:1|max:100',
            'duration_minutes'      => 'nullable|integer|min:1|max:300',
            'tier_questions'        => 'nullable|array',
            'tier_questions.*'      => 'nullable|integer|min:1|max:200',
            'tier_durations'        => 'nullable|array',
            'tier_durations.*'      => 'nullable|integer|min:1|max:300',
            'tier_pass_marks'       => 'nullable|array',
            'tier_pass_marks.*'     => 'nullable|numeric|min:0|max:200',
            'tier_labels'           => 'nullable|array',
            'view_mode'             => 'required|in:all_questions,one_by_one,student_choice',
            'attempt_limit_type'    => 'required|in:unlimited,single,custom',
            'max_attempts'          => 'nullable|integer|min:1|max:100',
            'allow_category_choice' => 'nullable|boolean',
            'mark_per_question'     => 'nullable|numeric|min:0.1|max:50',
            'pass_percentage'          => 'nullable|numeric|min:1|max:100',
            'negative_marking_enabled' => 'nullable|boolean',
            'negative_mark_value'      => 'nullable|numeric|min:0|max:10',
        ]);

        $attemptLimitType = $request->input('attempt_limit_type', 'unlimited');
        $maxAttempts = 0;
        if ($attemptLimitType === 'single') {
            $maxAttempts = 1;
        } elseif ($attemptLimitType === 'custom') {
            $maxAttempts = max(1, (int) $request->input('max_attempts', 1));
        }

        $tiers = [];
        if ($request->has('tier_questions') && is_array($request->tier_questions)) {
            foreach ($request->tier_questions as $idx => $qVal) {
                $q = (int)PracticeQuestionRotationService::toEnglishDigits($qVal);
                $d = isset($request->tier_durations[$idx]) ? (int)PracticeQuestionRotationService::toEnglishDigits($request->tier_durations[$idx]) : max(5, $q);
                $p = isset($request->tier_pass_marks[$idx]) ? (float)PracticeQuestionRotationService::toEnglishDigits($request->tier_pass_marks[$idx]) : round($q * 0.4, 1);
                $lbl = isset($request->tier_labels[$idx]) && trim($request->tier_labels[$idx]) !== ''
                    ? trim($request->tier_labels[$idx])
                    : "{$q} টি প্রশ্ন ({$d} মিনিট — পাস: {$p})";
                $lbl = PracticeQuestionRotationService::toEnglishDigits($lbl);
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

        // Fallback for single inputs or tests
        if (empty($tiers) && $request->filled('question_count')) {
            $q = (int)$request->input('question_count', 20);
            $d = (int)$request->input('duration_minutes', 20);
            $tiers[] = [
                'questions' => $q,
                'duration'  => $d,
                'label'     => "{$q} টি প্রশ্ন ({$d} মিনিট)",
            ];
        }

        $dataToSave = [
            'view_mode'             => $request->input('view_mode', 'all_questions'),
            'attempt_limit_type'    => $attemptLimitType,
            'max_attempts'          => $maxAttempts,
            'allow_category_choice' => $request->has('allow_category_choice') ? 1 : 0,
            'mark_per_question'     => $request->filled('mark_per_question') ? (float)$request->input('mark_per_question') : 1.0,
            'pass_percentage'          => $request->filled('pass_percentage') ? (float)$request->input('pass_percentage') : 40.0,
            'negative_marking_enabled' => $request->has('negative_marking_enabled') ? 1 : 0,
            'negative_mark_value'      => $request->filled('negative_mark_value') ? (float)$request->input('negative_mark_value') : 0.25,
        ];

        if (!empty($tiers)) {
            $dataToSave['tiers'] = $tiers;
            $dataToSave['question_count'] = $tiers[0]['questions'];
            $dataToSave['duration_minutes'] = $tiers[0]['duration'];
        } elseif ($request->filled('question_count')) {
            $dataToSave['question_count'] = (int) $request->input('question_count', 20);
            $dataToSave['duration_minutes'] = (int) $request->input('duration_minutes', 20);
        }

        PracticeQuestionRotationService::saveSettings($dataToSave);

        return redirect()->back()->with('success', 'অনুশীলন পরীক্ষা সেটিংস সফলভাবে সংরক্ষিত ও আপডেট হয়েছে।');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'title'            => 'required|string|max:191',
            'description'      => 'nullable|string',
            'quiz_type'        => 'required|in:practice,exam,class_test',
            'duration_minutes' => 'required|integer|min:1|max:300',
            'pass_marks'       => 'nullable|numeric|min:0',
            'is_published'     => 'nullable|boolean',
            'view_mode'        => 'nullable|in:all_questions,one_by_one',
            'subject_code'     => 'nullable|string|max:20',
            'board_name'       => 'nullable|string|max:100',
            'question_set'     => 'nullable|string|max:20',
            'negative_marks'   => 'nullable|numeric|min:0',
            'max_attempts'     => 'nullable|integer|min:0|max:100',
            'shuffle_questions'=> 'nullable|boolean',
            'shuffle_options'  => 'nullable|boolean',
            'start_time'       => 'nullable|date',
            'end_time'         => 'nullable|date',
            'result_release_policy' => 'nullable|in:immediate,after_deadline,admin_publish',
            'locking_policy'   => 'nullable|in:mode_default,instant_lock,confirm_lock',
        ]);

        $quiz = LmsQuiz::create([
            'course_id'             => $request->course_id,
            'title'                 => $request->title,
            'description'           => $request->description,
            'quiz_type'             => $request->quiz_type,
            'duration_minutes'      => (int)$request->duration_minutes,
            'total_marks'           => 0, // auto-calculated from questions
            'pass_marks'            => $request->pass_marks ?: 5.0,
            'shuffle_questions'     => $request->has('shuffle_questions') ? (bool)$request->shuffle_questions : true,
            'shuffle_options'       => $request->has('shuffle_options') ? (bool)$request->shuffle_options : true,
            'max_attempts'          => (int)$request->input('max_attempts', 0), // 0 = unlimited
            'is_published'          => $request->has('is_published') ? (bool)$request->is_published : true,
            'view_mode'             => $request->input('view_mode', 'all_questions'),
            'subject_code'          => $request->input('subject_code', '101'),
            'board_name'            => $request->input('board_name', 'ঢাকা শিক্ষা বোর্ড'),
            'question_set'          => $request->input('question_set', 'Set A'),
            'negative_marks'        => (float)$request->input('negative_marks', 0.0),
            'result_release_policy' => $request->input('result_release_policy', 'immediate'),
            'locking_policy'        => $request->input('locking_policy', 'mode_default'),
            'allow_question_flagging' => true,
            'start_time'            => $this->parseDateTimeInput($request->input('start_time')),
            'end_time'              => $this->parseDateTimeInput($request->input('end_time')),
        ]);

        return redirect()->back()->with('success', "Quiz '{$quiz->title}' created successfully! You can now import MCQs via Excel.");
    }

    /**
     * Import Questions into Quiz via Excel or CSV file
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|max:10240', // 10MB max
            'quiz_id'    => 'nullable|exists:lms_quizzes,id',
            'course_id'  => 'required_without:quiz_id|nullable|exists:courses,id',
            'new_quiz_title' => 'required_without:quiz_id|nullable|string|max:191',
        ]);

        $file = $request->file('excel_file');
        $ext = strtolower($file->getClientOriginalExtension());

        if (!in_array($ext, ['xlsx', 'xls', 'csv', 'txt'])) {
            return redirect()->back()->withErrors(['excel_file' => 'Only .xlsx, .xls, and .csv spreadsheet files are allowed.']);
        }

        // Target Quiz resolution
        if ($request->filled('quiz_id')) {
            $quiz = LmsQuiz::findOrFail($request->quiz_id);
        } else {
            // Auto-create new Quiz for the selected Course/Category
            $course = Course::findOrFail($request->course_id);
            $quizTitle = $request->new_quiz_title ?: ('Offline MCQ Assessment: ' . $course->course_title);

            $quiz = LmsQuiz::create([
                'course_id'         => $course->id,
                'title'             => $quizTitle,
                'description'       => 'Imported from Excel spreadsheet for ' . $course->course_title,
                'quiz_type'         => $request->input('quiz_type', 'practice'),
                'duration_minutes'  => (int)$request->input('duration_minutes', 20),
                'total_marks'       => 0,
                'pass_marks'        => 5.0,
                'shuffle_questions' => true,
                'shuffle_options'   => true,
                'max_attempts'      => 0,
                'is_published'      => true,
            ]);
        }

        $result = $this->importService->importFromFile($file->getRealPath(), $quiz->id);

        if (!$result['success'] || $result['imported_count'] === 0) {
            $errMsg = !empty($result['errors']) ? implode(' ', $result['errors']) : 'Failed to import questions from Excel.';
            return redirect()->back()->withErrors(['excel_file' => $errMsg]);
        }

        $msg = "Excel Import Successful! Imported {$result['imported_count']} MCQ questions into '{$quiz->title}'. Total Quiz Marks: {$result['total_marks']}.";
        if (!empty($result['errors'])) {
            $msg .= ' (Note: ' . count($result['errors']) . ' row(s) had warnings).';
        }

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Download Sample Excel/CSV Template with bilingual instructions and sample rows
     */
    public function downloadSample()
    {
        $csvContent = $this->importService->generateSampleCsv();

        return response($csvContent, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="WakeUpICT_Quiz_MCQ_Sample_Template.csv"',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
        ]);
    }

    /**
     * Toggle Quiz Published status
     */
    public function togglePublish($id)
    {
        $quiz = LmsQuiz::findOrFail($id);
        $quiz->is_published = !$quiz->is_published;
        $quiz->save();

        $status = $quiz->is_published ? 'PUBLISHED' : 'UNPUBLISHED (Draft)';
        return redirect()->back()->with('success', "Quiz '{$quiz->title}' is now {$status}.");
    }

    /**
     * Delete Quiz and all its questions
     */
    /**
     * Update an existing Quiz (Title, Course, Duration, Pass Marks, etc.)
     */
    public function update(Request $request, $id)
    {
        $quiz = LmsQuiz::findOrFail($id);

        $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'title'            => 'required|string|max:191',
            'description'      => 'nullable|string',
            'quiz_type'        => 'required|in:practice,exam,class_test',
            'duration_minutes' => 'required|integer|min:1|max:300',
            'pass_marks'       => 'nullable|numeric|min:0',
            'negative_marks'   => 'nullable|numeric|min:0',
            'question_set'     => 'nullable|string|max:20',
            'view_mode'        => 'nullable|in:all_questions,one_by_one',
            'max_attempts'     => 'nullable|integer|min:0|max:100',
            'shuffle_questions'=> 'nullable|boolean',
            'shuffle_options'  => 'nullable|boolean',
            'start_time'       => 'nullable|date',
            'end_time'         => 'nullable|date',
        ]);

        $quiz->update([
            'course_id'        => $request->course_id,
            'title'            => $request->title,
            'description'      => $request->description,
            'quiz_type'        => $request->quiz_type,
            'duration_minutes' => (int)$request->duration_minutes,
            'pass_marks'       => $request->pass_marks ?: 5.0,
            'negative_marks'   => $request->input('negative_marks', 0.0),
            'question_set'     => $request->input('question_set', 'Set A'),
            'view_mode'        => $request->input('view_mode', 'all_questions'),
            'max_attempts'     => (int)$request->input('max_attempts', 0),
            'shuffle_questions'=> $request->has('shuffle_questions') ? (bool)$request->shuffle_questions : false,
            'shuffle_options'  => $request->has('shuffle_options') ? (bool)$request->shuffle_options : false,
            'start_time'       => $this->parseDateTimeInput($request->input('start_time')),
            'end_time'         => $this->parseDateTimeInput($request->input('end_time')),
        ]);

        return redirect()->back()->with('success', "কুইজ '{$quiz->title}' এর তথ্য সফলভাবে হালনাগাদ করা হয়েছে!");
    }

    /**
     * Safely parse datetime string from HTML5 datetime-local inputs
     */
    protected function parseDateTimeInput($value)
    {
        if (empty($value) || (is_string($value) && trim($value) === '')) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Import / Attach Questions to Quiz directly from Library (No file required)
     */
        public function importFromLibrary(Request $request, $id)
    {
        $quiz = LmsQuiz::findOrFail($id);

        $request->validate([
            'source_mode'   => 'required|in:all,category,random,type,paper',
            'count'         => 'nullable|integer|min:1|max:200',
            'category'      => 'nullable|string',
            'question_type' => 'nullable|string',
            'paper_id'      => 'nullable|integer',
        ]);

        $order = LmsQuestion::where('quiz_id', $quiz->id)->max('order_index') ?: 0;
        $added = 0;
        $targetSet = $quiz->question_set ?: 'Set A';

        DB::beginTransaction();
        try {
            // MODE 1: Paper Builder Import
            if ($request->source_mode === 'paper' && $request->filled('paper_id')) {
                $paper = \App\model\LmsQuestionPaper::with(['items.masterQuestion.options'])->findOrFail($request->paper_id);

                foreach ($paper->items as $item) {
                    $sq = $item->masterQuestion;
                    if (!$sq) continue;

                    $order++;
                    $newQ = $sq->replicate();
                    $newQ->quiz_id = $quiz->id;
                    $newQ->course_id = $quiz->course_id;
                    $newQ->parent_question_id = $sq->id;
                    $newQ->set_code = $targetSet;
                    $newQ->order_index = $order;
                    $newQ->marks = $item->marks ?: ($sq->marks ?: 1.0);
                    $newQ->negative_marks = $item->negative_marks !== null ? $item->negative_marks : ($sq->negative_marks ?: 0.0);
                    $newQ->question_text = $item->getQuestionText();
                    $newQ->question_type = $item->getQuestionType();
                    $newQ->is_active = true;
                    $newQ->is_archived = false;
                    $newQ->save();

                    $options = $item->getQuestionOptions();
                    if (!empty($options)) {
                        foreach ($options as $opt) {
                            $optText = is_array($opt) ? $opt['option_text'] : (isset($opt->option_text) ? $opt->option_text : '');
                            $isCorrect = is_array($opt) ? (!empty($opt['is_correct'])) : (!empty($opt->is_correct));
                            $optOrder = is_array($opt) ? (isset($opt['order_index']) ? $opt['order_index'] : 0) : (isset($opt->order_index) ? $opt->order_index : 0);
                            $newQ->options()->create([
                                'option_text' => $optText,
                                'is_correct'  => $isCorrect,
                                'order_index' => $optOrder,
                            ]);
                        }
                    } elseif ($sq->options->count() > 0) {
                        foreach ($sq->options as $opt) {
                            $newOpt = $opt->replicate();
                            $newOpt->question_id = $newQ->id;
                            $newOpt->save();
                        }
                    }

                    $added++;
                }

                // Also associate quiz with this paper
                $quiz->update(['paper_id' => $paper->id]);
            } else {
                // MODE 2: Question Library (Category, Type, Random, All)
                $query = LmsQuestion::with('options')->where('is_archived', false);

                if ($request->filled('category')) {
                    $query->where('category', $request->category);
                }

                if ($request->filled('question_type')) {
                    $qType = trim($request->question_type);
                    if ($qType === 'mcq' || $qType === 'mcq_single') {
                        $query->whereIn('question_type', ['mcq', 'mcq_single']);
                    } elseif ($qType === 'fill_blank' || $qType === 'fill_blanks') {
                        $query->whereIn('question_type', ['fill_blank', 'fill_blanks']);
                    } elseif ($qType === 'creative' || $qType === 'creative_cq' || $qType === 'cq') {
                        $query->whereIn('question_type', ['creative', 'creative_cq', 'cq']);
                    } elseif ($qType === 'short_answer' || $qType === 'short_question') {
                        $query->whereIn('question_type', ['short_answer', 'short_question']);
                    } else {
                        $query->where('question_type', $qType);
                    }
                }

                if ($request->source_mode === 'random' && $request->filled('count')) {
                    $query->inRandomOrder()->take((int)$request->count);
                } elseif ($request->filled('count')) {
                    $query->take((int)$request->count);
                }

                $sourceQuestions = $query->get();

                if ($sourceQuestions->isEmpty()) {
                    DB::rollBack();
                    return redirect()->back()->withErrors(['error' => 'লাইব্রেরিতে এই ফিল্টার অনুযায়ী কোনো প্রশ্ন পাওয়া যায়নি।']);
                }

                $existingQuizHashes = \App\model\LmsQuestion::where('quiz_id', $quiz->id)
                    ->whereNotNull('question_hash')
                    ->pluck('question_hash')
                    ->flip()
                    ->toArray();

                foreach ($sourceQuestions as $sq) {
                    $h = $sq->question_hash ?: \App\model\LmsQuestion::hashText($sq->question_text);
                    if ($h && isset($existingQuizHashes[$h])) {
                        continue; // Skip duplicate question in this quiz
                    }
                    if ($h) {
                        $existingQuizHashes[$h] = true;
                    }
                    $order++;
                    $newQ = $sq->replicate();
                    $newQ->quiz_id = $quiz->id;
                    $newQ->course_id = $quiz->course_id;
                    $newQ->parent_question_id = $sq->id;
                    $newQ->set_code = $targetSet;
                    $newQ->order_index = $order;
                    $newQ->is_active = true;
                    $newQ->is_archived = false;
                    $newQ->save();

                    foreach ($sq->options as $opt) {
                        $newOpt = $opt->replicate();
                        $newOpt->question_id = $newQ->id;
                        $newOpt->save();
                    }
                    $added++;
                }
            }

            // Recalculate quiz total marks
            $totalMarks = LmsQuestion::where('quiz_id', $quiz->id)->sum('marks');
            $quiz->update(['total_marks' => $totalMarks]);

            DB::commit();

            return redirect()->back()->with('success', "সফলভাবে {$added}টি প্রশ্ন '{$quiz->title}' কুইজে যুক্ত করা হয়েছে!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'প্রশ্ন যুক্ত করতে সমস্যা হয়েছে: ' . $e->getMessage()]);
        }
    }

    public function manageQuestions($id)
    {
        $quiz = LmsQuiz::with(['course'])->findOrFail($id);
        $questions = LmsQuestion::with('options')
            ->where('quiz_id', $quiz->id)
            ->orderBy('order_index', 'asc')
            ->paginate(30);

        return view('backend.theme.clasic.lms.quizzes.questions', compact('quiz', 'questions'));
    }

    /**
     * Delete an individual question from a Quiz
     */
    public function deleteQuestion($quizId, $questionId)
    {
        $quiz = LmsQuiz::findOrFail($quizId);
        $question = LmsQuestion::where('quiz_id', $quiz->id)->findOrFail($questionId);

        DB::transaction(function () use ($quiz, $question) {
            $question->options()->delete();
            $question->answers()->delete();
            $question->delete();

            // Recalculate quiz total marks
            $totalMarks = LmsQuestion::where('quiz_id', $quiz->id)->sum('marks');
            $quiz->update(['total_marks' => $totalMarks]);
        });

        return redirect()->back()->with('success', 'প্রশ্নটি কুইজ থেকে মুছে ফেলা হয়েছে এবং মোট নম্বর হালনাগাদ করা হয়েছে!');
    }

        /**
     * Bulk delete multiple questions from a Quiz
     */
    public function bulkDeleteQuestions(Request $request, $quizId)
    {
        $quiz = LmsQuiz::findOrFail($quizId);

        if ($request->isMethod('get')) {
            return redirect()->route('admin.quizzes.questions', $quiz->id);
        }

        $request->validate([
            'question_ids' => 'required|array|min:1',
            'question_ids.*' => 'integer|exists:lms_questions,id',
        ]);

        $ids = $request->input('question_ids', []);
        $count = count($ids);

        DB::transaction(function () use ($quiz, $ids) {
            \App\model\LmsQuestionOption::whereIn('question_id', $ids)->delete();
            \App\model\LmsQuizAnswer::whereIn('question_id', $ids)->delete();
            LmsQuestion::where('quiz_id', $quiz->id)->whereIn('id', $ids)->delete();

            // Recalculate marks
            $totalMarks = LmsQuestion::where('quiz_id', $quiz->id)->sum('marks');
            $quiz->update(['total_marks' => $totalMarks]);
        });

        return redirect()->back()->with('success', "নির্বাচিত {$count}টি প্রশ্ন কুইজ থেকে সফলভাবে মুছে ফেলা হয়েছে!");
    }
    public function destroy($id)
    {
        $quiz = LmsQuiz::findOrFail($id);
        $title = $quiz->title;

        DB::transaction(function () use ($quiz) {
            // Delete child attempts & answers if any
            $attemptIds = \App\model\LmsQuizAttempt::where('quiz_id', $quiz->id)->pluck('id')->toArray();
            if (!empty($attemptIds)) {
                \App\model\LmsQuizAnswer::whereIn('attempt_id', $attemptIds)->delete();
                \App\model\LmsQuizAttempt::whereIn('id', $attemptIds)->delete();
            }

            // Delete child questions options & questions
            $questions = LmsQuestion::where('quiz_id', $quiz->id)->get();
            foreach ($questions as $q) {
                $q->options()->delete();
                $q->answers()->delete();
                $q->delete();
            }
            $quiz->delete();
        });

        return redirect()->back()->with('success', "Quiz '{$title}' and its questions were deleted successfully.");
    }

    /**
     * Generate / Distribute Question Sets (Set A, Set B, Set C, Set D)
     */
    public function generateSets(Request $request, $id)
    {
        $quiz = LmsQuiz::findOrFail($id);
        $baseQuestions = LmsQuestion::where('quiz_id', $quiz->id)->with('options')->get();

        if ($baseQuestions->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'কুইজে কোনো প্রশ্ন নেই। প্রথমে এক্সেল থেকে প্রশ্ন আপলোড করুন।']);
        }

        $targetSets = $request->input('sets', ['Set A', 'Set B', 'Set C', 'Set D']);
        if (!is_array($targetSets)) {
            $targetSets = ['Set A', 'Set B', 'Set C', 'Set D'];
        }

        DB::beginTransaction();
        try {
            // Assign existing questions to Set A if not set
            foreach ($baseQuestions as $idx => $q) {
                if (empty($q->set_code) || $q->set_code === 'Set A') {
                    $q->update(['set_code' => 'Set A']);
                }
            }

            // Create variations for Set B, Set C, etc. with shuffled option order
            $currentOrder = LmsQuestion::where('quiz_id', $quiz->id)->max('order_index') ?: 0;
            foreach ($targetSets as $set) {
                if ($set === 'Set A') continue;

                // Check if this set already has questions
                $existingCount = LmsQuestion::where('quiz_id', $quiz->id)->where('set_code', $set)->count();
                if ($existingCount > 0) continue;

                $shuffledQuestions = $baseQuestions->shuffle();
                foreach ($shuffledQuestions as $bq) {
                    $currentOrder++;
                    $newQ = LmsQuestion::create([
                        'quiz_id'        => $quiz->id,
                        'question_text'  => $bq->question_text,
                        'question_type'  => $bq->question_type,
                        'marks'          => $bq->marks,
                        'negative_marks' => $bq->negative_marks,
                        'set_code'       => $set,
                        'category'       => $bq->category,
                        'chapter'        => $bq->chapter,
                        'topic'          => $bq->topic,
                        'difficulty'     => $bq->difficulty,
                        'stimulus'       => $bq->stimulus,
                        'explanation'    => $bq->explanation,
                        'order_index'    => $currentOrder,
                        'is_active'      => true,
                    ]);

                    // Shuffle options for this set
                    $opts = $bq->options->shuffle();
                    foreach ($opts as $oIdx => $opt) {
                        \App\model\LmsQuestionOption::create([
                            'question_id' => $newQ->id,
                            'option_text' => $opt->option_text,
                            'is_correct'  => $opt->is_correct,
                            'order_index' => $oIdx + 1,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('success', "সফলভাবে সেট " . implode(', ', $targetSets) . " তৈরি ও অপশন শাফলিং সম্পন্ন হয়েছে!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'সেট তৈরিতে সমস্যা হয়েছে: ' . $e->getMessage()]);
        }
    }

    /**
     * Admin Assessment Performance & Exam Reports
     */
    public function reports(Request $request)
    {
        // Auto-finalize & grade any expired in-progress attempts older than duration + 2 min grace
        $staleAttempts = \App\model\LmsQuizAttempt::where('status', 'in_progress')
            ->with(['quiz', 'student'])
            ->get();

        $gradingController = new \App\Http\Controllers\frontend\theme\clasic\StudentQuizController();

        foreach ($staleAttempts as $stale) {
            $duration = $stale->quiz ? ($stale->quiz->duration_minutes ?: 30) : 30;
            $startTime = $stale->started_at ? \Carbon\Carbon::parse($stale->started_at) : ($stale->created_at ? \Carbon\Carbon::parse($stale->created_at) : null);
            if ($startTime && \Carbon\Carbon::now()->greaterThan($startTime->copy()->addMinutes($duration + 2))) {
                try {
                    $gradingController->finalizeGrading($stale);
                    $stale->refresh();
                    if ($stale->status === 'in_progress') {
                        $stale->update(['status' => 'timed_out']);
                    }
                } catch (\Exception $e) {
                    $stale->update(['status' => 'timed_out']);
                }
            }
        }

        $query = \App\model\LmsQuizAttempt::whereNull('parent_attempt_id')
            ->with(['quiz.course', 'student', 'retakes' => function ($rq) {
                $rq->with(['quiz.course', 'student'])->orderBy('id', 'asc');
            }])
            ->orderBy('id', 'desc');

        if ($request->filled('quiz_id')) {
            $query->where('quiz_id', $request->quiz_id);
        }

        if ($request->filled('course_id')) {
            $query->whereHas('quiz', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('set')) {
            $query->where('question_set', $request->set);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->whereHas('student', function ($sq) use ($search) {
                $sq->where('name', 'like', "%{$search}%")
                   ->orWhere('phone', 'like', "%{$search}%")
                   ->orWhere('student_id_code', 'like', "%{$search}%");
            });
        }

        $attempts = $query->paginate(25)->appends($request->all());
        $quizzes = LmsQuiz::with('course')->orderBy('title', 'asc')->get();
        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();

        // High-level KPI Stats for quick glance (100% Pass requirement)
        $totalAttempts = \App\model\LmsQuizAttempt::count();
        $passedAttempts = \App\model\LmsQuizAttempt::where('status', 'graded')
            ->whereRaw('score >= total_marks AND total_marks > 0')
            ->count();
        $failedAttempts = \App\model\LmsQuizAttempt::where('status', 'graded')
            ->whereRaw('score < total_marks OR total_marks = 0')
            ->count();
        $avgScore = round(\App\model\LmsQuizAttempt::where('status', 'graded')->avg('percentage') ?: 0, 1);

        // -------------------------------------------------------------
        // Parent Question Tracking & Cross-Attempt Analytics
        // -------------------------------------------------------------
        $activeTab = $request->input('tab', 'attempts');

        $pqRaw = DB::table('lms_quiz_answers')
            ->join('lms_questions', 'lms_quiz_answers.question_id', '=', 'lms_questions.id')
            ->select(
                DB::raw('COALESCE(lms_questions.parent_question_id, lms_questions.id) as master_question_id'),
                DB::raw('COUNT(lms_quiz_answers.id) as total_answers_count'),
                DB::raw('COUNT(DISTINCT lms_quiz_answers.attempt_id) as total_attempts_count'),
                DB::raw('SUM(CASE WHEN lms_quiz_answers.is_correct = 1 THEN 1 ELSE 0 END) as correct_count'),
                DB::raw('SUM(CASE WHEN lms_quiz_answers.is_correct = 0 THEN 1 ELSE 0 END) as incorrect_count')
            )
            ->groupBy(DB::raw('COALESCE(lms_questions.parent_question_id, lms_questions.id)'))
            ->orderByDesc('total_answers_count');

        if ($request->filled('q_search')) {
            $qs = trim($request->q_search);
            $pqRaw->where('lms_questions.question_text', 'like', "%{$qs}%");
        }

        $pqStats = $pqRaw->paginate(20, ['*'], 'q_page')->appends($request->all());

        // Eager load master questions
        $masterIds = collect($pqStats->items())->pluck('master_question_id')->filter()->unique()->toArray();
        $masterQuestionsMap = LmsQuestion::with('options')->whereIn('id', $masterIds)->get()->keyBy('id');

        foreach ($pqStats as $item) {
            $item->parent_question = $masterQuestionsMap[$item->master_question_id] ?? null;
            $item->accuracy_rate = $item->total_answers_count > 0 
                ? round(($item->correct_count / $item->total_answers_count) * 100, 1) 
                : 0;
        }

        return view('backend.theme.clasic.lms.quizzes.reports', compact(
            'attempts', 'quizzes', 'courses', 'totalAttempts', 'passedAttempts', 'failedAttempts', 'avgScore',
            'pqStats', 'activeTab'
        ));
    }

    /**
     * AJAX endpoint: Retrieve full attempt history grouped under a parent question
     */
    public function parentQuestionHistory($id)
    {
        $parentQuestion = LmsQuestion::with('options')->findOrFail($id);

        // Find all question IDs (root question + all variant children)
        $allQuestionIds = LmsQuestion::where('id', $id)
            ->orWhere('parent_question_id', $id)
            ->pluck('id')
            ->toArray();

        // Query all student answers for this question family
        $answers = \App\model\LmsQuizAnswer::with([
                'attempt.student',
                'attempt.quiz'
            ])
            ->whereIn('question_id', $allQuestionIds)
            ->latest('id')
            ->limit(100)
            ->get();

        $history = $answers->map(function ($ans) {
            $student = $ans->attempt ? $ans->attempt->student : null;
            $quiz = $ans->attempt ? $ans->attempt->quiz : null;
            return [
                'attempt_id'      => $ans->attempt_id,
                'student_name'    => $student ? $student->name : 'N/A',
                'student_id_code' => $student ? ($student->student_id_code ?: '—') : '—',
                'quiz_title'      => $quiz ? $quiz->title : 'পরীক্ষা',
                'set'             => $ans->attempt ? ($ans->attempt->question_set ?: 'Set A') : 'Set A',
                'is_correct'      => (bool)$ans->is_correct,
                'marks_obtained'  => (float)$ans->marks_obtained,
                'time'            => $ans->created_at ? $ans->created_at->format('d M, Y h:i A') : '—',
            ];
        });

        return response()->json([
            'success' => true,
            'parent_question' => [
                'id'            => $parentQuestion->id,
                'question_text' => $parentQuestion->question_text,
                'category'      => $parentQuestion->category ?: 'General',
                'question_type' => $parentQuestion->getTypeLabel(),
                'difficulty'    => $parentQuestion->difficulty ?: 'medium',
                'marks'         => (float)$parentQuestion->marks,
                'options'       => $parentQuestion->options->map(function ($opt) {
                    return [
                        'option_text' => $opt->option_text,
                        'is_correct'  => (bool)$opt->is_correct,
                    ];
                }),
                'variants_count' => count($allQuestionIds) - 1,
            ],
            'total_appearances' => $answers->count(),
            'correct_count'     => $answers->where('is_correct', true)->count(),
            'incorrect_count'   => $answers->where('is_correct', false)->count(),
            'history'           => $history,
        ]);
    }

    /**
     * Admin View of a Single Student's Complete Answer Sheet & Educational Breakdown
     */
    public function attemptDetail($id)
    {
        $attempt = \App\model\LmsQuizAttempt::with(['quiz.course', 'student', 'answers.question.options'])
            ->findOrFail($id);

        $quiz = $attempt->quiz;

        $questions = collect();

        if (!empty($attempt->questions_snapshot) && is_array($attempt->questions_snapshot)) {
            $snapshotQIds = collect($attempt->questions_snapshot)->pluck('id')->toArray();
            $snapshotMap = collect($attempt->questions_snapshot)->keyBy('id');
            $questions = LmsQuestion::with(['options', 'parentQuestion', 'derivedQuestions'])
                ->whereIn('id', $snapshotQIds)
                ->get()
                ->sortBy(function ($q) use ($snapshotQIds) {
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
                }
            }

            if ($questions->isEmpty()) {
                if ($quiz) {
                    $questions = $quiz->getExamQuestions();
                } else {
                    // Reconstruct from attempt questions snapshot
                    $questions = collect($attempt->questions_snapshot)->map(function ($snap) {
                        $q = new LmsQuestion();
                        $q->id = isset($snap['id']) ? $snap['id'] : 0;
                        $q->question_text = isset($snap['question_text']) ? $snap['question_text'] : '';
                        $q->question_type = isset($snap['question_type']) ? $snap['question_type'] : 'mcq';
                        $q->marks = isset($snap['marks']) ? $snap['marks'] : 1;
                        $q->negative_marks = isset($snap['negative_marks']) ? $snap['negative_marks'] : 0;
                        $q->explanation = isset($snap['explanation']) ? $snap['explanation'] : null;
                        $q->correct_answer_text = isset($snap['correct_answer_text']) ? $snap['correct_answer_text'] : null;

                        $optionsList = collect(isset($snap['options']) ? $snap['options'] : [])->map(function ($opt) {
                            $o = new \App\model\LmsQuestionOption();
                            $o->id = isset($opt['id']) ? $opt['id'] : 0;
                            $o->option_text = isset($opt['text']) ? $opt['text'] : (isset($opt['option_text']) ? $opt['option_text'] : '');
                            $o->is_correct = !empty($opt['is_correct']);
                            return $o;
                        });
                        $q->setRelation('options', $optionsList);
                        return $q;
                    });
                }
            }
        } elseif ($quiz) {
            $questions = $quiz->getExamQuestions();
        } else {
            // Quiz was deleted and no snapshot: load question models through answers relation
            $questions = $attempt->answers->map(function ($ans) {
                return $ans->question;
            })->filter()->values();
        }

        $answers = $attempt->answers->keyBy('question_id');

        $dbViolationsCount = $attempt->violations()->count();
        if ($dbViolationsCount > 0) {
            $totalViolations = $dbViolationsCount;
            $initialViolations = $attempt->violations()->oldest('id')->take(10)->get();
        } elseif (!empty($attempt->security_violations_log) && is_array($attempt->security_violations_log)) {
            $allLogs = collect($attempt->security_violations_log);
            $totalViolations = $allLogs->count();
            $initialViolations = $allLogs->take(10);
        } else {
            $totalViolations = 0;
            $initialViolations = collect();
        }
        $hasMoreViolations = $totalViolations > 10;

        return view('backend.theme.clasic.lms.quizzes.attempt_detail', compact(
            'attempt', 'quiz', 'questions', 'answers', 'initialViolations', 'totalViolations', 'hasMoreViolations'
        ));
    }

    /**
     * AJAX endpoint for on-scroll pagination of security violations (10 per page)
     */
    public function attemptViolationsJson(Request $request, $id)
    {
        $attempt = \App\model\LmsQuizAttempt::findOrFail($id);
        $page = max(1, (int)$request->input('page', 1));
        $perPage = 10;

        $dbViolationsCount = $attempt->violations()->count();

        if ($dbViolationsCount > 0) {
            $total = $dbViolationsCount;
            $items = $attempt->violations()
                ->oldest('id')
                ->forPage($page, $perPage)
                ->get()
                ->map(function ($v, $idx) use ($page, $perPage) {
                    return [
                        'serial' => ($page - 1) * $perPage + $idx + 1,
                        'warning_count' => (int)$v->warning_count,
                        'title' => $v->violation_title,
                        'details' => $v->details ?: 'অননুমোদিত কার্যকলাপ সনাক্ত',
                        'ip_address' => $v->ip_address ?: '—',
                        'timestamp' => $v->created_at ? $v->created_at->format('d M, Y h:i:s A') : '—',
                        'type' => $v->violation_type,
                    ];
                });
        } elseif (!empty($attempt->security_violations_log) && is_array($attempt->security_violations_log)) {
            $all = collect($attempt->security_violations_log);
            $total = $all->count();
            $items = $all->slice(($page - 1) * $perPage, $perPage)->values()->map(function ($vlog, $idx) use ($page, $perPage) {
                return [
                    'serial' => ($page - 1) * $perPage + $idx + 1,
                    'warning_count' => (int)($vlog['warning_number'] ?? (($page - 1) * $perPage + $idx + 1)),
                    'title' => $vlog['title'] ?? ($vlog['violation_type'] ?? 'নিরাপত্তা লঙ্ঘন'),
                    'details' => $vlog['details'] ?? '—',
                    'ip_address' => '—',
                    'timestamp' => $vlog['time'] ?? '—',
                    'type' => $vlog['violation_type'] ?? 'security',
                ];
            });
        } else {
            $items = collect();
            $total = 0;
        }

        return response()->json([
            'status' => 'success',
            'data' => $items,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'has_more' => ($page * $perPage) < $total,
        ]);
    }

    /**
     * Delete a single quiz attempt/result
     */

    /**
     * Permanent reset of security violations for a single attempt
     */
    public function resetAttemptViolations($id)
    {
        $attempt = \App\model\LmsQuizAttempt::findOrFail($id);
        $attempt->update([
            'security_violations_count' => 0,
            'security_violations_log' => null,
        ]);

        \App\model\LmsExamViolation::where('attempt_id', $attempt->id)->delete();

        return redirect()->back()->with('success', "অ্যাটেম্পট #{$attempt->id} এর সকল নিরাপত্তা লঙ্ঘন স্থায়ীভাবে রিসেট ও মুছে ফেলা হয়েছে।");
    }

    /**
     * Bulk permanent reset of security violations for selected attempts
     */
    public function bulkResetViolations(Request $request)
    {
        $ids = $request->input('attempt_ids', []);
        if (empty($ids) || !is_array($ids)) {
            return redirect()->back()->withErrors(['error' => 'অনুগ্রহ করে কমপক্ষে একটি ফলাফল নির্বাচন করুন।']);
        }

        \App\model\LmsQuizAttempt::whereIn('id', $ids)->update([
            'security_violations_count' => 0,
            'security_violations_log' => null,
        ]);

        \App\model\LmsExamViolation::whereIn('attempt_id', $ids)->delete();

        return redirect()->back()->with('success', 'নির্বাচিত ' . count($ids) . 'টি ফলাফলের নিরাপত্তা লঙ্ঘন সফলভাবে রিসেট ও মুছে ফেলা হয়েছে।');
    }
    public function destroyAttempt($id)
    {
        $attempt = \App\model\LmsQuizAttempt::findOrFail($id);

        \Illuminate\Support\Facades\DB::transaction(function () use ($attempt) {
            $attempt->answers()->delete();
            $attempt->delete();
        });

        return redirect()->back()->with('success', 'পরীক্ষার ফলাফলটি সফলভাবে মুছে ফেলা হয়েছে!');
    }

    /**
     * Bulk delete multiple quiz attempts/results
     */
    public function bulkDestroyAttempts(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('admin.quizzes.reports');
        }

        $request->validate([
            'attempt_ids' => 'required|array|min:1',
            'attempt_ids.*' => 'integer|exists:lms_quiz_attempts,id',
        ]);

        $ids = $request->input('attempt_ids', []);
        $count = count($ids);

        \Illuminate\Support\Facades\DB::transaction(function () use ($ids) {
            \App\model\LmsQuizAnswer::whereIn('attempt_id', $ids)->delete();
            \App\model\LmsQuizAttempt::whereIn('id', $ids)->delete();
        });

        return redirect()->back()->with('success', "নির্বাচিত {$count}টি পরীক্ষার ফলাফল সফলভাবে মুছে ফেলা হয়েছে!");
    }

    /**
     * Bulk delete multiple quizzes and all associated questions & attempts
     */
    public function bulkDestroyQuizzes(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('admin.quizzes.index');
        }

        $request->validate([
            'quiz_ids'   => 'required|array|min:1',
            'quiz_ids.*' => 'integer|exists:lms_quizzes,id',
        ]);

        $ids = $request->input('quiz_ids', []);
        $count = count($ids);

        \Illuminate\Support\Facades\DB::transaction(function () use ($ids) {
            // 1. Delete quiz attempts and student answers
            $attempts = \App\model\LmsQuizAttempt::whereIn('quiz_id', $ids)->get();
            $attemptIds = $attempts->pluck('id')->toArray();
            if (!empty($attemptIds)) {
                \App\model\LmsQuizAnswer::whereIn('attempt_id', $attemptIds)->delete();
                \App\model\LmsQuizAttempt::whereIn('id', $attemptIds)->delete();
            }

            // 2. Delete questions, options & student answers
            $questions = LmsQuestion::whereIn('quiz_id', $ids)->get();
            $questionIds = $questions->pluck('id')->toArray();
            if (!empty($questionIds)) {
                \App\model\LmsQuestionOption::whereIn('question_id', $questionIds)->delete();
                \App\model\LmsQuizAnswer::whereIn('question_id', $questionIds)->delete();
                LmsQuestion::whereIn('id', $questionIds)->delete();
            }

            // 3. Delete quizzes
            LmsQuiz::whereIn('id', $ids)->delete();
        });

        return redirect()->route('admin.quizzes.index')->with('success', "নির্বাচিত {$count}টি কুইজ এবং সংশ্লিষ্ট সকল প্রশ্ন সফলভাবে মুছে ফেলা হয়েছে!");
    }
}
