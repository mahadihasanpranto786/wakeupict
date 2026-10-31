<?php

namespace App\Http\Controllers\backend\theme\clasic\lms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuestionPaper;
use App\model\LmsQuestionPaperItem;
use App\model\Course;
use App\model\LmsQuiz;
use App\Services\QuizExcelImportService;
use Illuminate\Support\Facades\DB;
use Exception;

class QuestionBookController extends Controller
{
    protected $importService;

    public function __construct(QuizExcelImportService $importService)
    {
        $this->middleware('auth');
        $this->importService = $importService;
    }

    /**
     * Display the Question Book Library
     */
    public function index(Request $request)
    {
        $query = LmsQuestion::with(['options', 'course', 'quiz', 'parentQuestion', 'derivedQuestions'])
            ->where('is_archived', $request->has('archived') ? true : false);

        // Search text
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('question_text', 'like', "%{$search}%")
                  ->orWhere('stimulus', 'like', "%{$search}%")
                  ->orWhere('correct_answer_text', 'like', "%{$search}%")
                  ->orWhere('explanation', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%")
                  ->orWhere('id', $search);
            });
        }

        // Filter Course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter Category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter Chapter
        if ($request->filled('chapter')) {
            $query->where('chapter', $request->chapter);
        }

        // Filter Question Type
        if ($request->filled('question_type')) {
            $type = $request->question_type;
            if ($type === 'mcq') {
                $query->whereIn('question_type', ['mcq_single', 'mcq_multi', 'mcq']);
            } elseif ($type === 'descriptive') {
                $query->whereIn('question_type', ['descriptive', 'translation']);
            } else {
                $query->where('question_type', $type);
            }
        }

        // Filter Relation Status (Original vs Derived)
        if ($request->filled('relation_status')) {
            if ($request->relation_status === 'original') {
                $query->whereNull('parent_question_id');
            } elseif ($request->relation_status === 'derived') {
                $query->whereNotNull('parent_question_id');
            }
        }

        // Filter Difficulty
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Filter Set Code
        if ($request->filled('set_code')) {
            $query->where('set_code', $request->set_code);
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest('id');
        } elseif ($sort === 'marks_high') {
            $query->orderBy('marks', 'desc');
        } elseif ($sort === 'marks_low') {
            $query->orderBy('marks', 'asc');
        } else {
            $query->latest('id');
        }

        // Pagination
        $perPage = (int)$request->input('per_page', 15);
        $questions = $query->paginate($perPage)->appends($request->all());

        // Aggregate statistics across categories & types
        $stats = [
            'total'          => LmsQuestion::where('is_archived', false)->count(),
            'mcq'            => LmsQuestion::where('is_archived', false)->whereIn('question_type', ['mcq_single', 'mcq_multi', 'mcq'])->count(),
            'true_false'     => LmsQuestion::where('is_archived', false)->where('question_type', 'true_false')->count(),
            'fill_blanks'    => LmsQuestion::where('is_archived', false)->where('question_type', 'fill_blanks')->count(),
            'short_answer'   => LmsQuestion::where('is_archived', false)->where('question_type', 'short_answer')->count(),
            'creative'       => LmsQuestion::where('is_archived', false)->where('question_type', 'creative')->count(),
            'descriptive'    => LmsQuestion::where('is_archived', false)->whereIn('question_type', ['descriptive', 'translation'])->count(),
            'matching'       => LmsQuestion::where('is_archived', false)->where('question_type', 'matching')->count(),
            'original_count' => LmsQuestion::where('is_archived', false)->whereNull('parent_question_id')->count(),
            'derived_count'  => LmsQuestion::where('is_archived', false)->whereNotNull('parent_question_id')->count(),
            'archived'       => LmsQuestion::where('is_archived', true)->count(),
        ];

        // Dropdown data
        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();
        $categories = LmsQuestion::whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category')->sort()->values();
        $chapters = LmsQuestion::whereNotNull('chapter')->where('chapter', '!=', '')->distinct()->pluck('chapter')->sort()->values();
        $papers = LmsQuestionPaper::whereIn('status', ['draft', 'review', 'approved'])->orderBy('title', 'asc')->get();
        $quizzes = LmsQuiz::with('course')->withCount('questions')->latest('id')->get();

        $viewStyle = $request->input('view', 'book'); // 'book' or 'list'

        return view('backend.theme.clasic.lms.question_book.index', compact(
            'questions', 'stats', 'courses', 'categories', 'chapters', 'papers', 'quizzes', 'viewStyle'
        ));
    }

    /**
     * AJAX Question Preview
     */
    public function preview($id)
    {
        $question = LmsQuestion::with(['options', 'course', 'quiz', 'parentQuestion', 'derivedQuestions'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'question' => [
                'id'                  => $question->id,
                'parent_question_id'  => $question->parent_question_id,
                'is_derived'          => $question->isDerived(),
                'parent_title'        => $question->parentQuestion ? $question->parentQuestion->question_text : null,
                'derived_count'       => $question->derivedQuestions->count(),
                'question_text'       => $question->question_text,
                'question_type'       => $question->question_type,
                'type_label'          => $question->getTypeLabel(),
                'marks'               => (float)$question->marks,
                'negative_marks'      => (float)$question->negative_marks,
                'difficulty'          => $question->difficulty,
                'difficulty_badge'    => $question->getDifficultyBadge(),
                'category'            => $question->category,
                'chapter'             => $question->chapter,
                'topic'               => $question->topic,
                'set_code'            => $question->set_code,
                'stimulus'            => $question->stimulus,
                'correct_answer_text' => $question->correct_answer_text,
                'hints'               => $question->hints,
                'source_reference'    => $question->source_reference,
                'cq_subquestions'     => $question->cq_subquestions_decoded,
                'matching_pairs'      => $question->matching_pairs_decoded,
                'explanation'         => $question->explanation,
                'concept_title'       => $question->getEffectiveConceptTitle(),
                'concept_explanation' => $question->getEffectiveConceptExplanation(),
                'step_by_step_solution' => $question->getEffectiveStepByStepSolution(),
                'important_rules'     => $question->getEffectiveImportantRules(),
                'why_other_options_wrong' => $question->getEffectiveWhyOtherOptionsWrong(),
                'common_mistakes'     => $question->getEffectiveCommonMistakes(),
                'memory_aid'          => $question->getEffectiveMemoryAid(),
                'explanation_status'  => $question->explanation_status ?: 'verified',
                'explanation_status_badge' => $question->getExplanationStatusBadge(),
                'has_educational_explanation' => $question->hasEducationalExplanation(),
                'course_title'        => $question->course ? $question->course->course_title : 'General Bank',
                'related_concept_questions' => $question->getRelatedConceptQuestions(6)->map(function($rq) {
                    return [
                        'id' => $rq->id,
                        'question_text' => $rq->question_text,
                        'question_type' => $rq->getTypeLabel(),
                        'marks' => (float)$rq->marks,
                        'correct_answer' => $rq->correct_answer_text ?: ($rq->options->where('is_correct', true)->first() ? $rq->options->where('is_correct', true)->first()->option_text : 'N/A'),
                    ];
                }),
                'options'             => $question->options->map(function ($opt, $idx) {
                    return [
                        'id'         => $opt->id,
                        'letter'     => LmsQuestion::getBengaliOptionLetter($idx),
                        'text'       => $opt->option_text,
                        'is_correct' => (bool)$opt->is_correct,
                    ];
                }),
                'derived_versions'    => $question->derivedQuestions->map(function ($d) {
                    return [
                        'id'            => $d->id,
                        'type_label'    => $d->getTypeLabel(),
                        'question_type' => $d->question_type,
                        'text'          => $d->question_text,
                        'marks'         => (float)$d->marks,
                    ];
                }),
            ]
        ]);
    }

    /**
     * Get related questions for visual inspection
     */
    public function related($id)
    {
        $question = LmsQuestion::with(['parentQuestion.derivedQuestions.options', 'derivedQuestions.options', 'options'])->findOrFail($id);

        $root = $question->parentQuestion ?: $question;
        $allVariants = LmsQuestion::where('parent_question_id', $root->id)
            ->orWhere('id', $root->id)
            ->with(['options'])
            ->get();

        return response()->json([
            'success'       => true,
            'root_question' => [
                'id'            => $root->id,
                'question_text' => $root->question_text,
                'question_type' => $root->getTypeLabel(),
                'marks'         => (float)$root->marks,
            ],
            'variants'      => $allVariants->map(function ($v) use ($question) {
                return [
                    'id'            => $v->id,
                    'is_current'    => ($v->id === $question->id),
                    'is_root'       => is_null($v->parent_question_id),
                    'question_text' => $v->question_text,
                    'question_type' => $v->getTypeLabel(),
                    'raw_type'      => $v->question_type,
                    'marks'         => (float)$v->marks,
                    'correct_answer'=> $v->correct_answer_text ?: ($v->options->where('is_correct', true)->first() ? $v->options->where('is_correct', true)->first()->option_text : 'N/A'),
                    'difficulty'    => $v->difficulty,
                ];
            }),
        ]);
    }

    /**
     * Store new Question into Question Library
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_text'  => 'required|string',
            'question_type'  => 'required|string|in:mcq_single,mcq_multi,true_false,short_answer,descriptive,fill_blanks,creative,translation,matching',
            'marks'          => 'required|numeric|min:0.25',
            'negative_marks' => 'nullable|numeric|min:0',
            'course_id'      => 'nullable|exists:courses,id',
            'category'       => 'nullable|string|max:100',
            'chapter'        => 'nullable|string|max:150',
            'topic'          => 'nullable|string|max:150',
            'difficulty'     => 'required|in:easy,medium,hard',
            'stimulus'       => 'nullable|string',
            'explanation'    => 'nullable|string',
            'concept_title'  => 'nullable|string|max:255',
            'concept_explanation' => 'nullable|string',
            'step_by_step_solution' => 'nullable|string',
            'important_rules' => 'nullable|string',
            'why_other_options_wrong' => 'nullable|string',
            'common_mistakes' => 'nullable|string',
            'memory_aid'     => 'nullable|string',
            'explanation_status' => 'nullable|in:draft,pending_review,verified',
            'parent_question_id' => 'nullable|exists:lms_questions,id',
            'correct_answer_text' => 'nullable|string',
            'hints'          => 'nullable|string',
            'source_reference' => 'nullable|string|max:150',
        ]);

        DB::beginTransaction();
        try {
            $cqSubquestions = null;
            if ($request->question_type === 'creative' && $request->has('cq_subquestions')) {
                $cqSub = $request->input('cq_subquestions');
                $cqSubquestions = is_array($cqSub) ? json_encode($cqSub, JSON_UNESCAPED_UNICODE) : $cqSub;
            }

            $matchingPairs = null;
            if ($request->question_type === 'matching' && $request->has('matching_pairs')) {
                $pairs = $request->input('matching_pairs');
                $matchingPairs = is_array($pairs) ? json_encode($pairs, JSON_UNESCAPED_UNICODE) : $pairs;
            }

            $question = LmsQuestion::create([
                'parent_question_id'  => $request->parent_question_id ?: null,
                'course_id'           => $request->course_id,
                'question_text'       => $request->question_text,
                'question_type'       => $request->question_type,
                'marks'               => (float)$request->marks,
                'negative_marks'      => $request->negative_marks ? (float)$request->negative_marks : 0.00,
                'category'            => $request->category,
                'chapter'             => $request->chapter,
                'topic'               => $request->topic,
                'concept_title'       => $request->concept_title,
                'difficulty'          => $request->difficulty,
                'stimulus'            => $request->stimulus,
                'explanation'         => $request->explanation,
                'concept_explanation' => $request->concept_explanation,
                'step_by_step_solution' => $request->step_by_step_solution,
                'important_rules'     => $request->important_rules,
                'why_other_options_wrong' => $request->why_other_options_wrong,
                'common_mistakes'     => $request->common_mistakes,
                'memory_aid'          => $request->memory_aid,
                'explanation_status'  => $request->explanation_status ?: 'verified',
                'correct_answer_text' => $request->correct_answer_text,
                'cq_subquestions'     => $cqSubquestions,
                'matching_pairs'      => $matchingPairs,
                'hints'               => $request->hints,
                'source_reference'    => $request->source_reference,
                'set_code'            => $request->input('set_code', 'Set A'),
                'is_active'           => true,
            ]);

            // If MCQ options provided
            if (is_array($request->options) && in_array($question->question_type, ['mcq_single', 'mcq_multi'])) {
                $correct = $request->input('correct_option');
                foreach ($request->options as $index => $optText) {
                    if (trim($optText) === '') continue;
                    $isCorrect = false;
                    if (is_array($correct)) {
                        $isCorrect = in_array((string)$index, $correct);
                    } else {
                        $isCorrect = ((string)$correct === (string)$index);
                    }

                    LmsQuestionOption::create([
                        'question_id' => $question->id,
                        'option_text' => trim($optText),
                        'is_correct'  => $isCorrect,
                        'order_index' => $index + 1,
                    ]);
                }
            }
            // If True / False question
            elseif ($question->question_type === 'true_false') {
                $isTrue = ($request->input('tf_correct') === 'true' || $request->input('tf_correct') === '1' || $request->input('correct_answer_text') === 'true');
                LmsQuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => 'সত্য',
                    'is_correct'  => $isTrue,
                    'order_index' => 1,
                ]);
                LmsQuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => 'মিথ্যা',
                    'is_correct'  => !$isTrue,
                    'order_index' => 2,
                ]);
                $question->update(['correct_answer_text' => $isTrue ? 'true' : 'false']);
            }

            DB::commit();
            return redirect()->back()->with('success', 'প্রশ্নটি সফলভাবে প্রশ্ন ব্যাংকে সংরক্ষণ করা হয়েছে!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'প্রশ্ন সংরক্ষণ ব্যর্থ হয়েছে: ' . $e->getMessage()]);
        }
    }

    /**
     * Derive a new question from an existing question (Relation establishment)
     */
    public function derive(Request $request, $id)
    {
        $sourceQuestion = LmsQuestion::with('options')->findOrFail($id);

        $request->validate([
            'target_type'         => 'required|in:mcq_single,mcq_multi,true_false,fill_blanks,short_answer,creative,descriptive,translation,matching',
            'question_text'       => 'required|string',
            'marks'               => 'required|numeric|min:0.25',
            'negative_marks'      => 'nullable|numeric|min:0',
            'correct_answer_text' => 'nullable|string',
            'difficulty'          => 'required|in:easy,medium,hard',
            'hints'               => 'nullable|string',
            'stimulus'            => 'nullable|string',
            'explanation'         => 'nullable|string',
            'concept_title'       => 'nullable|string|max:255',
            'concept_explanation' => 'nullable|string',
            'step_by_step_solution' => 'nullable|string',
            'important_rules'     => 'nullable|string',
            'why_other_options_wrong' => 'nullable|string',
            'common_mistakes'     => 'nullable|string',
            'memory_aid'          => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Determine parent: If source is already derived, link to the root parent, otherwise link to source!
            $parentId = $sourceQuestion->parent_question_id ?: $sourceQuestion->id;

            $derived = LmsQuestion::create([
                'parent_question_id'  => $parentId,
                'course_id'           => $sourceQuestion->course_id,
                'category'            => $sourceQuestion->category,
                'chapter'             => $sourceQuestion->chapter,
                'topic'               => $sourceQuestion->topic,
                'concept_title'       => $request->concept_title ?: $sourceQuestion->concept_title,
                'question_text'       => $request->question_text,
                'question_type'       => $request->target_type,
                'marks'               => (float)$request->marks,
                'negative_marks'      => $request->negative_marks ? (float)$request->negative_marks : 0.00,
                'difficulty'          => $request->difficulty,
                'stimulus'            => $request->input('stimulus', $sourceQuestion->stimulus),
                'explanation'         => $request->explanation ?: $sourceQuestion->explanation,
                'concept_explanation' => $request->concept_explanation ?: $sourceQuestion->concept_explanation,
                'step_by_step_solution' => $request->step_by_step_solution ?: $sourceQuestion->step_by_step_solution,
                'important_rules'     => $request->important_rules ?: $sourceQuestion->important_rules,
                'why_other_options_wrong' => $request->why_other_options_wrong ?: $sourceQuestion->why_other_options_wrong,
                'common_mistakes'     => $request->common_mistakes ?: $sourceQuestion->common_mistakes,
                'memory_aid'          => $request->memory_aid ?: $sourceQuestion->memory_aid,
                'explanation_status'  => 'verified',
                'correct_answer_text' => $request->correct_answer_text,
                'hints'               => $request->hints,
                'source_reference'    => "Derived from #{$sourceQuestion->id}",
                'set_code'            => $sourceQuestion->set_code ?: 'Set A',
                'is_active'           => true,
            ]);

            // Options for MCQ or True/False
            if (in_array($request->target_type, ['mcq_single', 'mcq_multi']) && is_array($request->options)) {
                $correct = $request->input('correct_option');
                foreach ($request->options as $index => $optText) {
                    if (trim($optText) === '') continue;
                    $isCorrect = false;
                    if (is_array($correct)) {
                        $isCorrect = in_array((string)$index, $correct);
                    } else {
                        $isCorrect = ((string)$correct === (string)$index);
                    }

                    LmsQuestionOption::create([
                        'question_id' => $derived->id,
                        'option_text' => trim($optText),
                        'is_correct'  => $isCorrect,
                        'order_index' => $index + 1,
                    ]);
                }
            } elseif ($request->target_type === 'true_false') {
                $isTrue = ($request->input('tf_correct') === 'true' || $request->input('tf_correct') === '1' || $request->input('correct_answer_text') === 'true');
                LmsQuestionOption::create([
                    'question_id' => $derived->id,
                    'option_text' => 'সত্য',
                    'is_correct'  => $isTrue,
                    'order_index' => 1,
                ]);
                LmsQuestionOption::create([
                    'question_id' => $derived->id,
                    'option_text' => 'মিথ্যা',
                    'is_correct'  => !$isTrue,
                    'order_index' => 2,
                ]);
                $derived->update(['correct_answer_text' => $isTrue ? 'true' : 'false']);
            }

            DB::commit();

            return redirect()->back()->with('success', "প্রশ্ন #{$sourceQuestion->id} থেকে সফলভাবে নতুন {$derived->getTypeLabel()} প্রশ্ন তৈরি ও সংযুক্ত হয়েছে!");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'সম্পর্কিত প্রশ্ন তৈরি ব্যর্থ হয়েছে: ' . $e->getMessage()]);
        }
    }

    /**
     * Update an existing question in the bank
     */
    public function update(Request $request, $id)
    {
        $question = LmsQuestion::with('options')->findOrFail($id);

        $request->validate([
            'question_text'  => 'required|string',
            'question_type'  => 'required|string|in:mcq_single,mcq_multi,true_false,short_answer,descriptive,fill_blanks,creative,translation,matching',
            'marks'          => 'required|numeric|min:0.25',
            'negative_marks' => 'nullable|numeric|min:0',
            'course_id'      => 'nullable|exists:courses,id',
            'category'       => 'nullable|string|max:100',
            'chapter'        => 'nullable|string|max:150',
            'topic'          => 'nullable|string|max:150',
            'concept_title'  => 'nullable|string|max:255',
            'difficulty'     => 'required|in:easy,medium,hard',
            'stimulus'       => 'nullable|string',
            'explanation'    => 'nullable|string',
            'concept_explanation' => 'nullable|string',
            'step_by_step_solution' => 'nullable|string',
            'important_rules' => 'nullable|string',
            'why_other_options_wrong' => 'nullable|string',
            'common_mistakes' => 'nullable|string',
            'memory_aid'     => 'nullable|string',
            'explanation_status' => 'nullable|in:draft,pending_review,verified',
            'correct_answer_text' => 'nullable|string',
            'hints'          => 'nullable|string',
            'source_reference' => 'nullable|string|max:150',
        ]);

        DB::beginTransaction();
        try {
            $cqSubquestions = $question->cq_subquestions;
            if ($request->question_type === 'creative' && $request->has('cq_subquestions')) {
                $cqSub = $request->input('cq_subquestions');
                $cqSubquestions = is_array($cqSub) ? json_encode($cqSub, JSON_UNESCAPED_UNICODE) : $cqSub;
            }

            $question->update([
                'course_id'           => $request->course_id,
                'question_text'       => $request->question_text,
                'question_type'       => $request->question_type,
                'marks'               => (float)$request->marks,
                'negative_marks'      => $request->negative_marks !== null ? (float)$request->negative_marks : 0.00,
                'category'            => $request->category,
                'chapter'             => $request->chapter,
                'topic'               => $request->topic,
                'concept_title'       => $request->concept_title,
                'difficulty'          => $request->difficulty,
                'stimulus'            => $request->stimulus,
                'explanation'         => $request->explanation,
                'concept_explanation' => $request->concept_explanation,
                'step_by_step_solution' => $request->step_by_step_solution,
                'important_rules'     => $request->important_rules,
                'why_other_options_wrong' => $request->why_other_options_wrong,
                'common_mistakes'     => $request->common_mistakes,
                'memory_aid'          => $request->memory_aid,
                'explanation_status'  => $request->explanation_status ?: ($question->explanation_status ?: 'verified'),
                'correct_answer_text' => $request->correct_answer_text,
                'cq_subquestions'     => $cqSubquestions,
                'hints'               => $request->hints,
                'source_reference'    => $request->source_reference,
            ]);

            // Update options if MCQ
            if (in_array($question->question_type, ['mcq_single', 'mcq_multi']) && is_array($request->options)) {
                $question->options()->delete();
                $correct = $request->input('correct_option');
                foreach ($request->options as $index => $optText) {
                    if (trim($optText) === '') continue;
                    $isCorrect = false;
                    if (is_array($correct)) {
                        $isCorrect = in_array((string)$index, $correct);
                    } else {
                        $isCorrect = ((string)$correct === (string)$index);
                    }

                    LmsQuestionOption::create([
                        'question_id' => $question->id,
                        'option_text' => trim($optText),
                        'is_correct'  => $isCorrect,
                        'order_index' => $index + 1,
                    ]);
                }
            } elseif ($question->question_type === 'true_false') {
                $question->options()->delete();
                $isTrue = ($request->input('tf_correct') === 'true' || $request->input('tf_correct') === '1' || $request->input('correct_answer_text') === 'true');
                LmsQuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => 'সত্য',
                    'is_correct'  => $isTrue,
                    'order_index' => 1,
                ]);
                LmsQuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => 'মিথ্যা',
                    'is_correct'  => !$isTrue,
                    'order_index' => 2,
                ]);
                $question->update(['correct_answer_text' => $isTrue ? 'true' : 'false']);
            }

            DB::commit();
            return redirect()->back()->with('success', "প্রশ্ন #{$question->id} সফলভাবে হালনাগাদ করা হয়েছে!");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'প্রশ্ন হালনাগাদ ব্যর্থ হয়েছে: ' . $e->getMessage()]);
        }
    }

    /**
     * Duplicate Question
     */
    public function duplicate($id)
    {
        $original = LmsQuestion::with('options')->findOrFail($id);

        DB::beginTransaction();
        try {
            $cloned = $original->replicate();
            $cloned->question_text = $original->question_text . ' (Copy)';
            $cloned->save();

            foreach ($original->options as $opt) {
                $clonedOpt = $opt->replicate();
                $clonedOpt->question_id = $cloned->id;
                $clonedOpt->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'প্রশ্নটির হুবহু অনুলিপি (Duplicate) তৈরি হয়েছে!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'কপি তৈরি করা যায়নি: ' . $e->getMessage()]);
        }
    }

    /**
     * Archive/Unarchive Toggle
     */
    public function archiveToggle($id)
    {
        $question = LmsQuestion::findOrFail($id);
        $question->is_archived = !$question->is_archived;
        $question->save();

        $msg = $question->is_archived ? 'প্রশ্নটি আর্কাইভ করা হয়েছে।' : 'প্রশ্নটি সফলভাবে রিস্টোর করা হয়েছে।';
        return redirect()->back()->with('success', $msg);
    }

    /**
     * Delete Question
     */
    public function destroy($id)
    {
        $question = LmsQuestion::findOrFail($id);
        $question->options()->delete();
        $question->delete();

        return redirect()->back()->with('success', 'প্রশ্নটি স্থায়ীভাবে মুছে ফেলা হয়েছে!');
    }

    /**
     * Bulk Action Handler (Bulk Add to Paper, Bulk Categorize, Bulk Export CSV)
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $selectedIds = $request->input('selected_ids', []);

        if (empty($selectedIds) || !is_array($selectedIds)) {
            return redirect()->back()->withErrors(['error' => 'অনুগ্রহ করে অন্তত একটি প্রশ্ন নির্বাচন করুন।']);
        }

        if ($action === 'add_to_quiz') {
            $quizId = $request->input('target_quiz_id');
            $quiz = LmsQuiz::findOrFail($quizId);
            $order = LmsQuestion::where('quiz_id', $quiz->id)->max('order_index') ?: 0;
            $added = 0;

            foreach ($selectedIds as $qId) {
                $q = LmsQuestion::with('options')->find($qId);
                if ($q) {
                    $order++;
                    // Duplicate or attach question directly to this quiz
                    $newQ = $q->replicate();
                    $newQ->quiz_id = $quiz->id;
                    $newQ->course_id = $quiz->course_id;
                    $newQ->parent_question_id = $q->id; // Link to master question in library
                    $newQ->order_index = $order;
                    $newQ->is_active = true;
                    $newQ->is_archived = false;
                    $newQ->save();

                    foreach ($q->options as $opt) {
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

            return redirect()->route('admin.quizzes.index')
                ->with('success', "নির্বাচিত {$added}টি প্রশ্ন সফলভাবে কুইজ '{$quiz->title}' এ সেট করা হয়েছে!");
        }

        if ($action === 'add_to_paper') {
            $paperId = $request->input('target_paper_id');
            $paper = LmsQuestionPaper::findOrFail($paperId);
            $defaultSection = $paper->sections()->first();

            $order = $paper->items()->max('order_index') ?: 0;
            $added = 0;

            foreach ($selectedIds as $qId) {
                $exists = LmsQuestionPaperItem::where('paper_id', $paper->id)->where('question_id', $qId)->exists();
                if (!$exists) {
                    $q = LmsQuestion::find($qId);
                    if ($q) {
                        $order++;
                        $item = LmsQuestionPaperItem::create([
                            'paper_id'    => $paper->id,
                            'section_id'  => $defaultSection ? $defaultSection->id : null,
                            'question_id' => $q->id,
                            'order_index' => $order,
                            'marks'       => $q->marks ?: 1.00,
                            'negative_marks' => $q->negative_marks ?: 0.00,
                        ]);
                        $item->freezeSnapshot();
                        $added++;
                    }
                }
            }

            $paper->recalculateTotals();

            return redirect()->route('admin.question-papers.builder', $paper->id)
                ->with('success', "নির্বাচিত {$added}টি প্রশ্ন সফলভাবে প্রশ্নপত্রে যুক্ত করা হয়েছে!");
        }

        if ($action === 'categorize') {
            $newCat = trim($request->input('bulk_category'));
            if ($newCat !== '') {
                LmsQuestion::whereIn('id', $selectedIds)->update(['category' => $newCat]);
                return redirect()->back()->with('success', 'নির্বাচিত প্রশ্নসমূহের ক্যাটাগরি সফলভাবে হালনাগাদ হয়েছে!');
            }
        }

        if ($action === 'archive') {
            LmsQuestion::whereIn('id', $selectedIds)->update(['is_archived' => true]);
            return redirect()->back()->with('success', 'নির্বাচিত প্রশ্নসমূহ আর্কাইভে সরানো হয়েছে!');
        }

        if ($action === 'export_csv') {
            $questions = LmsQuestion::with('options')->whereIn('id', $selectedIds)->get();
            $filename = "questions_export_" . date('Y-m-d_His') . ".csv";
            
            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ];

            $callback = function () use ($questions) {
                $f = fopen('php://output', 'w');
                fputs($f, "\xEF\xBB\xBF"); // UTF-8 BOM
                fputcsv($f, ['ID', 'Question', 'Type', 'Option A', 'Option B', 'Option C', 'Option D', 'Correct Answer', 'Marks', 'Category', 'Chapter', 'Difficulty', 'Explanation']);

                foreach ($questions as $q) {
                    $opts = $q->options->values();
                    $optA = isset($opts[0]) ? $opts[0]->option_text : '';
                    $optB = isset($opts[1]) ? $opts[1]->option_text : '';
                    $optC = isset($opts[2]) ? $opts[2]->option_text : '';
                    $optD = isset($opts[3]) ? $opts[3]->option_text : '';

                    $correctAns = 'N/A';
                    foreach ($opts as $idx => $o) {
                        if ($o->is_correct) {
                            $correctAns = LmsQuestion::getBengaliOptionLetter($idx) . ' (' . $o->option_text . ')';
                            break;
                        }
                    }

                    fputcsv($f, [
                        $q->id,
                        $q->question_text,
                        $q->question_type,
                        $optA,
                        $optB,
                        $optC,
                        $optD,
                        $correctAns,
                        $q->marks,
                        $q->category,
                        $q->chapter,
                        $q->difficulty,
                        $q->explanation
                    ]);
                }
                fclose($f);
            };

            return response()->stream($callback, 200, $headers);
        }

        return redirect()->back()->with('info', 'কোনো কার্যকর অ্যাকশন সম্পাদিত হয়নি।');
    }

    /**
     * Bulk Import Questions from Excel/CSV directly into Question Book / Quiz
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file'     => 'required|file|max:10240', // 10MB max
            'import_mode'    => 'required|in:library,existing_quiz,new_quiz',
            'course_id'      => 'nullable|exists:courses,id',
            'quiz_id'        => 'nullable|exists:lms_quizzes,id',
            'new_quiz_title' => 'nullable|string|max:191',
        ]);

        $file = $request->file('excel_file');
        $ext = strtolower($file->getClientOriginalExtension());

        if (!in_array($ext, ['xlsx', 'xls', 'csv', 'txt'])) {
            return redirect()->back()->withErrors(['excel_file' => 'শুধুমাত্র .xlsx, .xls এবং .csv স্প্রেডশিট ফাইল অনুমোদিত।']);
        }

        $quiz = null;
        $courseId = $request->course_id ?: null;
        $mode = $request->input('import_mode', 'library');

        if ($mode === 'existing_quiz') {
            if (!$request->filled('quiz_id')) {
                return redirect()->back()->withErrors(['quiz_id' => 'অনুগ্রহ করে একটি বিদ্যমান কুইজ নির্বাচন করুন।']);
            }
            $quiz = LmsQuiz::findOrFail($request->quiz_id);
            $courseId = $quiz->course_id;
        } elseif ($mode === 'new_quiz') {
            if (!$request->filled('course_id')) {
                return redirect()->back()->withErrors(['course_id' => 'নতুন কুইজের জন্য একটি কোর্স নির্বাচন আবশ্যক।']);
            }
            $course = Course::findOrFail($request->course_id);
            $quizTitle = $request->new_quiz_title ?: ('Offline MCQ Assessment: ' . $course->course_title);

            $quiz = LmsQuiz::create([
                'course_id'        => $course->id,
                'title'            => $quizTitle,
                'description'      => 'Imported from Excel into Question Library for ' . $course->course_title,
                'quiz_type'        => $request->input('quiz_type', 'practice'),
                'duration_minutes' => (int)$request->input('duration_minutes', 20),
                'total_marks'      => 0,
                'pass_marks'       => 5.0,
                'shuffle_questions'=> true,
                'shuffle_options'  => true,
                'max_attempts'     => 0,
                'is_published'     => true,
            ]);
            $courseId = $course->id;
        }

        $defaults = [
            'category' => $request->input('default_category'),
            'chapter'  => $request->input('default_chapter'),
            'set_code' => $request->input('default_set_code', 'Set A'),
        ];

        $result = $this->importService->importFromFile($file->getRealPath(), $quiz ? $quiz->id : null, $courseId, $defaults);

        if (!$result['success'] || $result['imported_count'] === 0) {
            $errMsg = !empty($result['errors']) ? implode(' ', $result['errors']) : 'এক্সেল ফাইল থেকে প্রশ্ন ইমপোর্ট করা যায়নি।';
            return redirect()->back()->withErrors(['excel_file' => $errMsg]);
        }

        $msg = "এক্সেল থেকে সফলভাবে {$result['imported_count']} টি বহুনির্বাচনি (MCQ) প্রশ্ন প্রশ্ন লাইব্রেরিতে যুক্ত হয়েছে!";
        if ($quiz) {
            $msg .= " (কুইজ: '{$quiz->title}', মোট নম্বর: {$result['total_marks']})";
        }
        if (!empty($result['errors'])) {
            $msg .= " [সতর্কবার্তা: " . count($result['errors']) . " টি রো সতর্কবার্তা রয়েছে]";
        }

        return redirect()->route('admin.question-book.index')->with('success', $msg);
    }

    /**
     * AJAX Single Question Assign to Quiz
     */
    public function assignToQuiz(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:lms_questions,id',
            'quiz_id'     => 'required|exists:lms_quizzes,id',
        ]);

        $q = LmsQuestion::with('options')->findOrFail($request->question_id);
        $quiz = LmsQuiz::findOrFail($request->quiz_id);

        $order = LmsQuestion::where('quiz_id', $quiz->id)->max('order_index') ?: 0;
        $order++;

        $newQ = $q->replicate();
        $newQ->quiz_id = $quiz->id;
        $newQ->course_id = $quiz->course_id;
        $newQ->parent_question_id = $q->id;
        $newQ->order_index = $order;
        $newQ->is_active = true;
        $newQ->is_archived = false;
        $newQ->save();

        foreach ($q->options as $opt) {
            $newOpt = $opt->replicate();
            $newOpt->question_id = $newQ->id;
            $newOpt->save();
        }

        $totalMarks = LmsQuestion::where('quiz_id', $quiz->id)->sum('marks');
        $quiz->update(['total_marks' => $totalMarks]);
        $newCount = LmsQuestion::where('quiz_id', $quiz->id)->count();

        return response()->json([
            'success' => true,
            'message' => "প্রশ্নটি সফলভাবে কুইজ '{$quiz->title}' এ যুক্ত হয়েছে!",
            'total_questions' => $newCount,
        ]);
    }
}
