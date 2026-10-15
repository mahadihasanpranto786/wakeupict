<?php

namespace App\Http\Controllers\backend\theme\clasic\lms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\LmsQuestionPaper;
use App\model\LmsQuestionPaperSection;
use App\model\LmsQuestionPaperItem;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuiz;
use App\model\Course;
use Illuminate\Support\Facades\DB;
use Exception;

class QuestionPaperBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all Question Papers
     */
    public function index(Request $request)
    {
        $query = LmsQuestionPaper::with(['course', 'sections', 'items'])->latest('id');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('paper_code', 'like', "%{$search}%")
                  ->orWhere('subject_name', 'like', "%{$search}%")
                  ->orWhere('exam_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('paper_set')) {
            $query->where('paper_set', $request->paper_set);
        }

        $papers = $query->paginate(15)->appends($request->all());

        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();

        $stats = [
            'total'     => LmsQuestionPaper::count(),
            'published' => LmsQuestionPaper::where('status', 'published')->count(),
            'approved'  => LmsQuestionPaper::where('status', 'approved')->count(),
            'draft'     => LmsQuestionPaper::where('status', 'draft')->count(),
        ];

        return view('backend.theme.clasic.lms.question_papers.index', compact('papers', 'courses', 'stats'));
    }

    /**
     * Store new Question Paper & redirect to builder studio
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:191',
            'course_id'        => 'nullable|exists:courses,id',
            'class_level'      => 'nullable|string|max:60',
            'exam_name'        => 'required|string|max:150',
            'subject_name'     => 'required|string|max:150',
            'subject_code'     => 'required|string|max:20',
            'academic_year'    => 'required|string|max:20',
            'duration_minutes' => 'required|integer|min:5|max:360',
            'total_marks'      => 'required|numeric|min:1',
            'pass_marks'       => 'nullable|numeric|min:0',
            'paper_set'        => 'nullable|string|max:20',
            'layout_type'      => 'nullable|string|max:40',
        ]);

        DB::beginTransaction();
        try {
            $paperCode = LmsQuestionPaper::generatePaperCode($request->subject_code, $request->academic_year);

            $paper = LmsQuestionPaper::create([
                'paper_code'       => $paperCode,
                'title'            => $request->title,
                'course_id'        => $request->course_id,
                'class_level'      => $request->input('class_level', 'Class 9-10'),
                'institution_name' => $request->input('institution_name', 'Wake Up ICT Academy & Laboratory'),
                'board_name'       => $request->input('board_name', 'Wake Up ICT Technical & Educational Board'),
                'exam_name'        => $request->exam_name,
                'subject_name'     => $request->subject_name,
                'subject_code'     => $request->subject_code,
                'academic_year'    => $request->academic_year,
                'duration_minutes' => (int)$request->duration_minutes,
                'total_marks'      => (float)$request->total_marks,
                'pass_marks'       => (float)($request->pass_marks ?: 40.0),
                'negative_marks'   => (float)$request->input('negative_marks', 0.0),
                'instructions'     => $request->input('instructions', "১. প্রতিটি প্রশ্নের মান সমান।\n২. সকল প্রশ্নের উত্তর দেওয়া আবশ্যক।\n৩. বলপয়েন্ট কলম দিয়ে বৃত্ত ভরাট করুন।"),
                'status'           => 'draft',
                'layout_type'      => $request->input('layout_type', 'standard_board'),
                'paper_set'        => $request->input('paper_set', 'Set A'),
                'version'          => 1,
                'created_by'       => auth()->id(),
            ]);

            // Create initial default Section A: MCQ
            LmsQuestionPaperSection::create([
                'paper_id'           => $paper->id,
                'title'              => 'Section A: Multiple Choice Questions (বহুনির্বাচনি অভীক্ষা)',
                'instructions'       => 'সবগুলো প্রশ্নের উত্তর দাও। প্রতিটি প্রশ্নের মান ১।',
                'section_code'       => 'A',
                'order_index'        => 1,
                'marks_per_question' => 1.00,
                'total_marks'        => 0.00,
            ]);

            DB::commit();

            return redirect()->route('admin.question-papers.builder', $paper->id)
                ->with('success', "প্রশ্নপত্র '{$paper->title}' তৈরি হয়েছে! এখন ড্র্যাগ-অ্যান্ড-ড্রপ করে প্রশ্ন সাজান।");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'প্রশ্নপত্র তৈরিতে ত্রুটি: ' . $e->getMessage()]);
        }
    }

    /**
     * Visual Drag-and-Drop Question Paper Builder Studio
     */
    public function builder(Request $request, $id)
    {
        $paper = LmsQuestionPaper::with([
            'course',
            'sections.items.masterQuestion.options',
            'items.masterQuestion.options'
        ])->findOrFail($id);

        // Fetch question library for left panel
        $qQuery = LmsQuestion::with('options')->where('is_archived', false);

        if ($paper->course_id) {
            $qQuery->where(function ($q) use ($paper) {
                $q->where('course_id', $paper->course_id)->orWhereNull('course_id');
            });
        }

        if ($request->filled('library_search')) {
            $s = trim($request->library_search);
            $qQuery->where(function ($q) use ($s) {
                $q->where('question_text', 'like', "%{$s}%")
                  ->orWhere('category', 'like', "%{$s}%")
                  ->orWhere('chapter', 'like', "%{$s}%");
            });
        }

        if ($request->filled('library_category')) {
            $qQuery->where('category', $request->library_category);
        }

        if ($request->filled('library_type')) {
            $qQuery->where('question_type', $request->library_type);
        }

        if ($request->filled('library_difficulty')) {
            $qQuery->where('difficulty', $request->library_difficulty);
        }

        $libraryQuestions = $qQuery->latest('id')->paginate(30)->appends($request->all());

        // Category & chapter lists for filters and auto-pick
        $categories = LmsQuestion::whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category')->sort()->values();
        $chapters = LmsQuestion::whereNotNull('chapter')->where('chapter', '!=', '')->distinct()->pluck('chapter')->sort()->values();

        // Calculate summary
        $totalQuestionsCount = $paper->items->count();
        $calculatedMarks = $paper->items->sum('marks');

        return view('backend.theme.clasic.lms.question_papers.builder', compact(
            'paper', 'libraryQuestions', 'categories', 'chapters', 'totalQuestionsCount', 'calculatedMarks'
        ));
    }

    /**
     * AJAX Save Draft / Drag-and-Drop State
     */
    public function saveDraft(Request $request, $id)
    {
        $paper = LmsQuestionPaper::findOrFail($id);
        $payload = $request->input('sections', []);

        DB::beginTransaction();
        try {
            $globalItemOrder = 0;

            foreach ($payload as $secIndex => $secData) {
                $secId = isset($secData['id']) ? $secData['id'] : null;
                $section = LmsQuestionPaperSection::where('paper_id', $paper->id)->where('id', $secId)->first();

                if ($section) {
                    $section->update([
                        'order_index' => $secIndex + 1,
                        'title'       => isset($secData['title']) ? $secData['title'] : $section->title,
                    ]);
                }

                $items = isset($secData['items']) && is_array($secData['items']) ? $secData['items'] : [];
                foreach ($items as $itemIndex => $itemData) {
                    $globalItemOrder++;
                    $itemId = isset($itemData['id']) ? $itemData['id'] : null;
                    $item = LmsQuestionPaperItem::where('paper_id', $paper->id)->where('id', $itemId)->first();

                    if ($item) {
                        $item->update([
                            'section_id'  => $section ? $section->id : null,
                            'order_index' => $globalItemOrder,
                            'marks'       => isset($itemData['marks']) && is_numeric($itemData['marks']) ? (float)$itemData['marks'] : $item->marks,
                        ]);
                    }
                }
            }

            $calculatedMarks = $paper->recalculateTotals();

            DB::commit();

            return response()->json([
                'success'         => true,
                'message'         => 'প্রশ্নপত্রের ড্রাফট সফলভাবে সংরক্ষিত হয়েছে!',
                'total_marks'     => $calculatedMarks,
                'total_questions' => $paper->items()->count(),
                'updated_at'      => now()->toTimeString(),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'সংরক্ষণ ব্যর্থ: ' . $e->getMessage()], 500);
        }
    }

    /**
     * AJAX Library Questions for Left Panel (Instant search & filter without page reload)
     */
    public function libraryQuestions(Request $request, $id)
    {
        $paper = LmsQuestionPaper::findOrFail($id);

        $qQuery = LmsQuestion::with('options')->where('is_archived', false);

        if ($paper->course_id) {
            $qQuery->where(function ($q) use ($paper) {
                $q->where('course_id', $paper->course_id)->orWhereNull('course_id');
            });
        }

        if ($request->filled('search')) {
            $s = trim($request->search);
            $qQuery->where(function ($q) use ($s) {
                $q->where('question_text', 'like', "%{$s}%")
                  ->orWhere('category', 'like', "%{$s}%")
                  ->orWhere('chapter', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category')) {
            $qQuery->where('category', $request->category);
        }

        if ($request->filled('question_type')) {
            $qQuery->where('question_type', $request->question_type);
        }

        if ($request->filled('difficulty')) {
            $qQuery->where('difficulty', $request->difficulty);
        }

        $questions = $qQuery->latest('id')->limit(50)->get();

        $mapped = $questions->map(function ($q) {
            return [
                'id'            => $q->id,
                'question_text' => $q->question_text,
                'question_type' => $q->getTypeLabel(),
                'marks'         => (float)$q->marks,
                'marks_bn'      => LmsQuiz::toBengaliNumber($q->marks),
                'difficulty'    => $q->difficulty,
                'category'      => $q->category ?: 'General',
                'chapter'       => $q->chapter,
                'stimulus'      => $q->stimulus,
                'options_count' => $q->options->count(),
            ];
        });

        return response()->json([
            'success'   => true,
            'total'     => $mapped->count(),
            'questions' => $mapped,
        ]);
    }

    /**
     * Add single Question into Paper Section (Zero Reload)
     */
    public function addItem(Request $request, $id)
    {
        $paper = LmsQuestionPaper::findOrFail($id);
        $questionId = $request->input('question_id');
        $sectionId = $request->input('section_id');

        $question = LmsQuestion::with('options')->findOrFail($questionId);

        // Check if section belongs to paper
        $section = LmsQuestionPaperSection::where('paper_id', $paper->id)->find($sectionId);
        if (!$section) {
            $section = $paper->sections()->first();
        }

        // Check duplicate
        $existing = LmsQuestionPaperItem::where('paper_id', $paper->id)->where('question_id', $questionId)->first();
        if ($existing && !$request->boolean('allow_duplicate')) {
            return response()->json([
                'success' => false,
                'is_duplicate' => true,
                'message' => 'এই প্রশ্নটি ইতিমধ্যে এই প্রশ্নপত্রে যুক্ত আছে। আপনি কি পুনরায় যুক্ত করতে চান?'
            ], 422);
        }

        $nextOrder = ($paper->items()->max('order_index') ?: 0) + 1;
        $marks = $request->filled('marks') ? (float)$request->marks : ($question->marks ?: 1.00);

        $item = LmsQuestionPaperItem::create([
            'paper_id'       => $paper->id,
            'section_id'     => $section ? $section->id : null,
            'question_id'    => $question->id,
            'order_index'    => $nextOrder,
            'marks'          => $marks,
            'negative_marks' => $question->negative_marks ?: 0.00,
        ]);

        $item->freezeSnapshot();
        $paper->recalculateTotals();

        return response()->json([
            'success'         => true,
            'message'         => 'প্রশ্নটি প্রশ্নপত্রে সফলভাবে যোগ করা হয়েছে!',
            'item_id'         => $item->id,
            'section_id'      => $section ? $section->id : null,
            'total_marks'     => (float)$paper->total_marks,
            'total_marks_bn'  => LmsQuiz::toBengaliNumber($paper->total_marks),
            'total_questions' => $paper->items()->count(),
            'total_questions_bn' => LmsQuiz::toBengaliNumber($paper->items()->count()),
            'item' => [
                'id'            => $item->id,
                'question_id'   => $question->id,
                'question_text' => $question->question_text,
                'question_type' => $question->getTypeLabel(),
                'marks'         => (float)$item->marks,
                'stimulus'      => $question->stimulus,
                'options'       => $question->options->map(function ($o, $idx) {
                    return [
                        'letter'     => LmsQuestion::getBengaliOptionLetter($idx),
                        'text'       => $o->option_text,
                        'is_correct' => (bool)$o->is_correct,
                    ];
                }),
            ]
        ]);
    }

    /**
     * Remove Item from Paper (Zero Reload)
     */
    public function removeItem($id, $itemId)
    {
        $paper = LmsQuestionPaper::findOrFail($id);
        $item = LmsQuestionPaperItem::where('paper_id', $paper->id)->findOrFail($itemId);
        $item->delete();

        $paper->recalculateTotals();

        return response()->json([
            'success'         => true,
            'message'         => 'প্রশ্নটি অপসারিত হয়েছে!',
            'total_marks'     => (float)$paper->total_marks,
            'total_marks_bn'  => LmsQuiz::toBengaliNumber($paper->total_marks),
            'total_questions' => $paper->items()->count(),
            'total_questions_bn' => LmsQuiz::toBengaliNumber($paper->items()->count()),
        ]);
    }

    /**
     * Add Section to Paper (Zero Reload Supported)
     */
    public function addSection(Request $request, $id)
    {
        $paper = LmsQuestionPaper::findOrFail($id);

        $request->validate([
            'title'              => 'required|string|max:150',
            'instructions'       => 'nullable|string',
            'section_code'       => 'required|string|max:20',
            'marks_per_question' => 'nullable|numeric|min:0.5',
        ]);

        $nextOrder = ($paper->sections()->max('order_index') ?: 0) + 1;

        $section = LmsQuestionPaperSection::create([
            'paper_id'           => $paper->id,
            'title'              => $request->title,
            'instructions'       => $request->instructions,
            'section_code'       => strtoupper(trim($request->section_code)),
            'order_index'        => $nextOrder,
            'marks_per_question' => $request->marks_per_question ? (float)$request->marks_per_question : 1.00,
            'total_marks'        => 0.00,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "নতুন সেকশন '{$section->title}' তৈরি হয়েছে!",
                'section' => [
                    'id'           => $section->id,
                    'section_code' => $section->section_code,
                    'title'        => $section->title,
                    'instructions' => $section->instructions,
                    'order_index'  => $section->order_index,
                ]
            ]);
        }

        return redirect()->back()->with('success', "নতুন সেকশন '{$section->title}' তৈরি হয়েছে!");
    }

    /**
     * Delete Section (Zero Reload Supported)
     */
    public function deleteSection($id, $sectionId)
    {
        $paper = LmsQuestionPaper::findOrFail($id);
        $section = LmsQuestionPaperSection::where('paper_id', $paper->id)->findOrFail($sectionId);

        // Delete items in this section
        $section->items()->delete();
        $section->delete();

        $paper->recalculateTotals();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success'         => true,
                'message'         => 'সেকশন ও এর অন্তর্গত প্রশ্নসমূহ অপসারিত হয়েছে!',
                'total_marks'     => (float)$paper->total_marks,
                'total_marks_bn'  => LmsQuiz::toBengaliNumber($paper->total_marks),
                'total_questions' => $paper->items()->count(),
                'total_questions_bn' => LmsQuiz::toBengaliNumber($paper->items()->count()),
            ]);
        }

        return redirect()->back()->with('success', 'সেকশন ও এর অন্তর্গত প্রশ্নসমূহ অপসারিত হয়েছে!');
    }

    /**
     * Rule-Based / Random Auto Question Picker (Zero Reload Supported)
     */
    public function autoSelectQuestions(Request $request, $id)
    {
        $paper = LmsQuestionPaper::findOrFail($id);

        $request->validate([
            'section_id' => 'required|exists:lms_question_paper_sections,id',
            'count'      => 'required|integer|min:1|max:100',
        ]);

        $section = LmsQuestionPaperSection::where('paper_id', $paper->id)->findOrFail($request->section_id);

        $query = LmsQuestion::with('options')->where('is_archived', false);

        if ($paper->course_id) {
            $query->where(function ($q) use ($paper) {
                $q->where('course_id', $paper->course_id)->orWhereNull('course_id');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('chapter')) {
            $query->where('chapter', $request->chapter);
        }

        if ($request->filled('question_type')) {
            $query->where('question_type', $request->question_type);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Exclude questions already in this paper
        $existingQIds = $paper->items()->pluck('question_id')->filter()->toArray();
        if (!empty($existingQIds)) {
            $query->whereNotIn('id', $existingQIds);
        }

        $count = (int)$request->count;
        $matchedQuestions = $query->inRandomOrder()->limit($count)->get();

        if ($matchedQuestions->isEmpty()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'নির্দিষ্ট ফিল্টারে কোনো নতুন উপযুক্ত প্রশ্ন পাওয়া যায়নি।'], 422);
            }
            return redirect()->back()->withErrors(['error' => 'নির্দিষ্ট ফিল্টারে কোনো নতুন উপযুক্ত প্রশ্ন পাওয়া যায়নি।']);
        }

        DB::beginTransaction();
        try {
            $currOrder = ($paper->items()->max('order_index') ?: 0);
            $added = 0;
            $addedList = [];

            foreach ($matchedQuestions as $q) {
                $currOrder++;
                $marks = $section->marks_per_question ?: ($q->marks ?: 1.00);

                $item = LmsQuestionPaperItem::create([
                    'paper_id'       => $paper->id,
                    'section_id'     => $section->id,
                    'question_id'    => $q->id,
                    'order_index'    => $currOrder,
                    'marks'          => $marks,
                    'negative_marks' => $q->negative_marks ?: 0.00,
                ]);

                $item->freezeSnapshot();
                $added++;

                $addedList[] = [
                    'id'            => $item->id,
                    'question_id'   => $q->id,
                    'section_id'    => $section->id,
                    'question_text' => $q->question_text,
                    'question_type' => $q->getTypeLabel(),
                    'marks'         => (float)$item->marks,
                    'stimulus'      => $q->stimulus,
                    'options'       => $q->options->map(function ($o, $idx) {
                        return [
                            'letter'     => LmsQuestion::getBengaliOptionLetter($idx),
                            'text'       => $o->option_text,
                            'is_correct' => (bool)$o->is_correct,
                        ];
                    }),
                ];
            }

            $paper->recalculateTotals();

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success'            => true,
                    'message'            => "স্বয়ংক্রিয়ভাবে {$added}টি প্রশ্ন '{$section->title}' সেকশনে যুক্ত হয়েছে!",
                    'added_count'        => $added,
                    'section_id'         => $section->id,
                    'items'              => $addedList,
                    'total_marks'        => (float)$paper->total_marks,
                    'total_marks_bn'     => LmsQuiz::toBengaliNumber($paper->total_marks),
                    'total_questions'    => $paper->items()->count(),
                    'total_questions_bn' => LmsQuiz::toBengaliNumber($paper->items()->count()),
                ]);
            }

            return redirect()->back()->with('success', "স্বয়ংক্রিয়ভাবে {$added}টি প্রশ্ন '{$section->title}' সেকশনে যুক্ত হয়েছে!");
        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'স্বয়ংক্রিয় প্রশ্ন বাছাই ব্যর্থ: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->withErrors(['error' => 'স্বয়ংক্রিয় প্রশ্ন বাছাই ব্যর্থ: ' . $e->getMessage()]);
        }
    }

    /**
     * Offline Board Print Preview
     */
    public function printBoard($id)
    {
        $paper = LmsQuestionPaper::with([
            'sections.items.masterQuestion.options',
            'items.masterQuestion.options'
        ])->findOrFail($id);

        return view('backend.theme.clasic.lms.question_papers.print_board', compact('paper'));
    }

    /**
     * Teacher Answer Key & Marking Scheme View
     */
    public function teacherKey($id)
    {
        $paper = LmsQuestionPaper::with([
            'sections.items.masterQuestion.options',
            'items.masterQuestion.options'
        ])->findOrFail($id);

        return view('backend.theme.clasic.lms.question_papers.teacher_key', compact('paper'));
    }

    /**
     * Generate Variant Sets (Set A -> Set B, Set C, Set D)
     */
    public function generateVariantSets(Request $request, $id)
    {
        $paper = LmsQuestionPaper::with(['sections.items'])->findOrFail($id);
        $targetSet = $request->input('target_set', 'Set B');

        $exists = LmsQuestionPaper::where('master_paper_id', $paper->id)->where('paper_set', $targetSet)->first();
        if ($exists) {
            return redirect()->back()->withErrors(['error' => "{$targetSet} সেটটি ইতিমধ্যে বিদ্যমান আছে।"]);
        }

        DB::beginTransaction();
        try {
            $clonedCode = $paper->paper_code . '-' . str_replace(' ', '', $targetSet);

            $clonedPaper = $paper->replicate();
            $clonedPaper->paper_code = $clonedCode;
            $clonedPaper->title = $paper->title . " ({$targetSet})";
            $clonedPaper->paper_set = $targetSet;
            $clonedPaper->master_paper_id = $paper->id;
            $clonedPaper->status = 'draft';
            $clonedPaper->save();

            // Clone sections and shuffle questions within sections
            foreach ($paper->sections as $sec) {
                $clonedSec = $sec->replicate();
                $clonedSec->paper_id = $clonedPaper->id;
                $clonedSec->save();

                $items = $sec->items;
                $shuffledItems = $items->shuffle();

                $order = 0;
                foreach ($shuffledItems as $it) {
                    $order++;
                    $clonedIt = $it->replicate();
                    $clonedIt->paper_id = $clonedPaper->id;
                    $clonedIt->section_id = $clonedSec->id;
                    $clonedIt->order_index = $order;
                    $clonedIt->save();
                    $clonedIt->freezeSnapshot();
                }
            }

            $clonedPaper->recalculateTotals();

            DB::commit();

            return redirect()->route('admin.question-papers.builder', $clonedPaper->id)
                ->with('success', "সফলভাবে নতুন সেট '{$clonedPaper->title}' তৈরি হয়েছে!");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'সেট তৈরি ব্যর্থ: ' . $e->getMessage()]);
        }
    }

    /**
     * Publish Paper directly as an Online Exam in LMS Quizzes
     */
    public function publishOnline($id)
    {
        $paper = LmsQuestionPaper::with(['items.masterQuestion.options'])->findOrFail($id);

        if ($paper->items->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'প্রশ্নপত্রটি খালি। অন্তত একটি প্রশ্ন যুক্ত করুন।']);
        }

        DB::beginTransaction();
        try {
            // Find or create linked LmsQuiz
            $quiz = $paper->linkedQuiz ?: new LmsQuiz();
            $quiz->course_id             = $paper->course_id;
            $quiz->title                 = $paper->title;
            $quiz->description           = $paper->instructions;
            $quiz->quiz_type             = 'exam';
            $quiz->class_level           = $paper->class_level;
            $quiz->duration_minutes      = $paper->duration_minutes;
            $quiz->total_marks           = $paper->total_marks;
            $quiz->pass_marks            = $paper->pass_marks;
            $quiz->negative_marks        = $paper->negative_marks;
            $quiz->subject_code          = $paper->subject_code;
            $quiz->board_name            = $paper->board_name;
            $quiz->question_set          = $paper->paper_set;
            $quiz->is_published          = true;
            $quiz->save();

            // Link existing questions or clone if necessary
            $currOrder = 0;
            $unsupportedTypes = [];

            foreach ($paper->items as $it) {
                $currOrder++;
                $q = $it->masterQuestion;
                if ($q) {
                    if (!$q->quiz_id) {
                        $q->update(['quiz_id' => $quiz->id, 'order_index' => $currOrder]);
                    }

                    if (!in_array($q->question_type, ['mcq_single', 'mcq_multi', 'true_false'])) {
                        $unsupportedTypes[] = $q->getTypeLabel();
                    }
                }
            }

            $paper->update([
                'status'         => 'published',
                'linked_quiz_id' => $quiz->id,
            ]);

            DB::commit();

            $warning = '';
            if (!empty($unsupportedTypes)) {
                $typesList = implode(', ', array_unique($unsupportedTypes));
                $warning = " দ্রষ্টব্য: কিছু প্রশ্ন ({$typesList}) অনলাইনে হস্তচালিত গ্রেডিং (Manual Grading) প্রয়োজন হবে।";
            }

            return redirect()->back()->with('success', "প্রশ্নপত্রটি সফলভাবে অনলাইন পরীক্ষা হিসেবে প্রকাশিত হয়েছে! কুইজ আইডি: #{$quiz->id}.{$warning}");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'অনলাইন প্রকাশনা ব্যর্থ হয়েছে: ' . $e->getMessage()]);
        }
    }

    /**
     * Update Paper Settings
     */
    public function updateSettings(Request $request, $id)
    {
        $paper = LmsQuestionPaper::findOrFail($id);

        $request->validate([
            'title'            => 'required|string|max:191',
            'duration_minutes' => 'required|integer|min:5|max:360',
            'pass_marks'       => 'nullable|numeric|min:0',
            'negative_marks'   => 'nullable|numeric|min:0',
            'status'           => 'required|in:draft,review,approved,published,archived',
            'layout_type'      => 'nullable|string|max:40',
            'instructions'     => 'nullable|string',
        ]);

        $paper->update([
            'title'            => $request->title,
            'duration_minutes' => (int)$request->duration_minutes,
            'pass_marks'       => (float)($request->pass_marks ?: 40.0),
            'negative_marks'   => (float)$request->input('negative_marks', 0.0),
            'status'           => $request->status,
            'layout_type'      => $request->input('layout_type', 'standard_board'),
            'instructions'     => $request->instructions,
        ]);

        return redirect()->back()->with('success', 'প্রশ্নপত্রের সেটিংস সফলভাবে হালনাগাদ করা হয়েছে!');
    }

    /**
     * Delete Question Paper
     */
    public function destroy($id)
    {
        $paper = LmsQuestionPaper::findOrFail($id);
        $paper->items()->delete();
        $paper->sections()->delete();
        $paper->delete();

        return redirect()->route('admin.question-papers.index')
            ->with('success', 'প্রশ্নপত্রটি সফলভাবে মুছে ফেলা হয়েছে!');
    }
}
