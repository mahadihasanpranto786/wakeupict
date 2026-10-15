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
use Illuminate\Support\Facades\DB;
use Exception;

class QuestionBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the Question Book Library
     */
    public function index(Request $request)
    {
        $query = LmsQuestion::with(['options', 'course', 'quiz'])
            ->where('is_archived', $request->has('archived') ? true : false);

        // Search text
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('question_text', 'like', "%{$search}%")
                  ->orWhere('stimulus', 'like', "%{$search}%")
                  ->orWhere('explanation', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
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
            $query->where('question_type', $request->question_type);
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

        // Aggregate statistics
        $stats = [
            'total'       => LmsQuestion::where('is_archived', false)->count(),
            'mcq'         => LmsQuestion::where('is_archived', false)->whereIn('question_type', ['mcq_single', 'mcq_multi'])->count(),
            'creative'    => LmsQuestion::where('is_archived', false)->whereIn('question_type', ['creative', 'descriptive', 'short_answer'])->count(),
            'archived'    => LmsQuestion::where('is_archived', true)->count(),
        ];

        // Dropdown data
        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();
        $categories = LmsQuestion::whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category')->sort()->values();
        $chapters = LmsQuestion::whereNotNull('chapter')->where('chapter', '!=', '')->distinct()->pluck('chapter')->sort()->values();
        $papers = LmsQuestionPaper::whereIn('status', ['draft', 'review', 'approved'])->orderBy('title', 'asc')->get();

        $viewStyle = $request->input('view', 'book'); // 'book' or 'list'

        return view('backend.theme.clasic.lms.question_book.index', compact(
            'questions', 'stats', 'courses', 'categories', 'chapters', 'papers', 'viewStyle'
        ));
    }

    /**
     * AJAX Question Preview
     */
    public function preview($id)
    {
        $question = LmsQuestion::with(['options', 'course', 'quiz'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'question' => [
                'id'            => $question->id,
                'question_text' => $question->question_text,
                'question_type' => $question->question_type,
                'type_label'    => $question->getTypeLabel(),
                'marks'         => (float)$question->marks,
                'negative_marks'=> (float)$question->negative_marks,
                'difficulty'    => $question->difficulty,
                'difficulty_badge' => $question->getDifficultyBadge(),
                'category'      => $question->category,
                'chapter'       => $question->chapter,
                'topic'         => $question->topic,
                'set_code'      => $question->set_code,
                'stimulus'      => $question->stimulus,
                'explanation'   => $question->explanation,
                'course_title'  => $question->course ? $question->course->course_title : 'General Bank',
                'options'       => $question->options->map(function ($opt, $idx) {
                    return [
                        'letter'     => LmsQuestion::getBengaliOptionLetter($idx),
                        'text'       => $opt->option_text,
                        'is_correct' => (bool)$opt->is_correct,
                    ];
                }),
            ]
        ]);
    }

    /**
     * Store new Question into Question Library
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_text'  => 'required|string',
            'question_type'  => 'required|string|in:mcq_single,mcq_multi,true_false,short_answer,descriptive,fill_blanks,creative',
            'marks'          => 'required|numeric|min:0.5',
            'negative_marks' => 'nullable|numeric|min:0',
            'course_id'      => 'nullable|exists:courses,id',
            'category'       => 'nullable|string|max:100',
            'chapter'        => 'nullable|string|max:150',
            'topic'          => 'nullable|string|max:150',
            'difficulty'     => 'required|in:easy,medium,hard',
            'stimulus'       => 'nullable|string',
            'explanation'    => 'nullable|string',
            'options'        => 'nullable|array',
            'correct_option' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $question = LmsQuestion::create([
                'course_id'      => $request->course_id,
                'question_text'  => $request->question_text,
                'question_type'  => $request->question_type,
                'marks'          => (float)$request->marks,
                'negative_marks' => $request->negative_marks ? (float)$request->negative_marks : 0.00,
                'category'       => $request->category,
                'chapter'        => $request->chapter,
                'topic'          => $request->topic,
                'difficulty'     => $request->difficulty,
                'stimulus'       => $request->stimulus,
                'explanation'    => $request->explanation,
                'set_code'       => $request->input('set_code', 'Set A'),
                'is_active'      => true,
            ]);

            // If options provided
            if (is_array($request->options) && in_array($question->question_type, ['mcq_single', 'mcq_multi', 'true_false'])) {
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

            DB::commit();
            return redirect()->back()->with('success', 'প্রশ্নটি সফলভাবে প্রশ্ন ব্যাংকে সংরক্ষণ করা হয়েছে!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'প্রশ্ন সংরক্ষণ ব্যর্থ হয়েছে: ' . $e->getMessage()]);
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
}
