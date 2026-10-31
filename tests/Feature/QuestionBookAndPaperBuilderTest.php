<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\model\StudentAccount;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuestionPaper;
use App\model\LmsQuestionPaperSection;
use App\model\LmsQuestionPaperItem;
use App\model\LmsQuiz;
use App\model\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class QuestionBookAndPaperBuilderTest extends TestCase
{
    protected $adminUser;
    protected $student;
    protected $course;
    protected $sampleQuestion;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Authenticated Admin User
        $this->adminUser = User::first() ?: User::create([
            'name'        => 'Paper Builder Admin',
            'email'       => 'admin_test_paper_' . rand(1000, 9999) . '@wakeupict.test',
            'password'    => Hash::make('password123'),
            'excess_type' => 'admin',
        ]);

        // 2. Student User
        $this->student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name'     => 'Exam Student Test',
            'phone'    => '01711' . rand(100000, 999999),
            'email'    => 'student_paper_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status'   => 1,
        ]);

        // 3. Sample Course
        $this->course = Course::where('status', 1)->first() ?: Course::create([
            'course_title' => 'Advanced ICT & Programming',
            'course_slug'  => 'advanced-ict-' . rand(100, 999),
            'time_line'    => '3 Months',
            'price'        => 5000,
            'status'       => 1,
        ]);

        // 4. Sample Library Question
        $this->sampleQuestion = LmsQuestion::create([
            'course_id'     => $this->course->id,
            'question_text' => 'What is the full form of HTML in web technology?',
            'question_type' => 'mcq_single',
            'marks'         => 1.00,
            'negative_marks'=> 0.25,
            'category'      => 'Web Development',
            'chapter'       => 'Chapter 1: Internet & HTML',
            'topic'         => 'HTML Fundamentals',
            'difficulty'    => 'easy',
            'explanation'   => 'HTML stands for HyperText Markup Language.',
            'is_active'     => true,
            'is_archived'   => false,
        ]);

        LmsQuestionOption::create([
            'question_id' => $this->sampleQuestion->id,
            'option_text' => 'HyperText Markup Language',
            'is_correct'  => true,
            'order_index' => 1,
        ]);

        LmsQuestionOption::create([
            'question_id' => $this->sampleQuestion->id,
            'option_text' => 'HighText Machine Language',
            'is_correct'  => false,
            'order_index' => 2,
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->sampleQuestion) {
            $this->sampleQuestion->options()->delete();
            $this->sampleQuestion->delete();
        }

        if ($this->student) {
            $this->student->delete();
        }

        parent::tearDown();
    }

    /**
     * Test 1: Question Book Index and Filters
     */
    public function test_question_book_index_loads_with_filters()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.question-book.index', [
                'course_id'  => $this->course->id,
                'category'   => 'Web Development',
                'difficulty' => 'easy',
            ]));

        $response->assertStatus(200);
        $response->assertSee('ডিজিটাল প্রশ্ন বই ও প্রশ্ন লাইব্রেরি');
        $response->assertSee('What is the full form of HTML');
    }

    /**
     * Test 2: AJAX Question Preview
     */
    public function test_ajax_question_preview_returns_json()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.question-book.preview', $this->sampleQuestion->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'question' => [
                'id'            => $this->sampleQuestion->id,
                'question_text' => 'What is the full form of HTML in web technology?',
                'category'      => 'Web Development',
            ]
        ]);
    }

    /**
     * Test 3: Question Creation & Duplication in Question Book
     */
    public function test_question_can_be_created_and_duplicated()
    {
        // Store
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.question-book.store'), [
                'question_text' => 'Which memory is non-volatile?',
                'question_type' => 'mcq_single',
                'marks'         => 1.0,
                'difficulty'    => 'medium',
                'course_id'     => $this->course->id,
                'options'       => ['ROM', 'RAM'],
                'correct_option'=> 0,
            ]);

        $response->assertSessionHas('success');
        $newQ = LmsQuestion::where('question_text', 'Which memory is non-volatile?')->first();
        $this->assertNotNull($newQ);
        $this->assertCount(2, $newQ->options);

        // Duplicate
        $dupResponse = $this->actingAs($this->adminUser)
            ->post(route('admin.question-book.duplicate', $newQ->id));

        $dupResponse->assertSessionHas('success');
        $this->assertDatabaseHas('lms_questions', [
            'question_text' => 'Which memory is non-volatile? (Copy)',
        ]);

        // Clean up
        LmsQuestionOption::where('question_id', $newQ->id)->delete();
        $newQ->delete();
        $dup = LmsQuestion::where('question_text', 'Which memory is non-volatile? (Copy)')->first();
        if ($dup) {
            $dup->options()->delete();
            $dup->delete();
        }
    }

    /**
     * Test 4: Question Paper Creation and Studio Access
     */
    public function test_question_paper_creation_and_builder_access()
    {
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.question-papers.store'), [
                'title'            => 'Final Exam ICT 2026',
                'course_id'        => $this->course->id,
                'exam_name'        => 'Annual Final Exam',
                'subject_name'     => 'Information Technology',
                'subject_code'     => '154',
                'academic_year'    => '2026',
                'duration_minutes' => 60,
                'total_marks'      => 50.0,
                'paper_set'        => 'Set A',
            ]);

        $paper = LmsQuestionPaper::where('title', 'Final Exam ICT 2026')->first();
        $this->assertNotNull($paper);
        $this->assertEquals('Set A', $paper->paper_set);

        // Verify default Section A was created
        $this->assertCount(1, $paper->sections);
        $this->assertEquals('A', $paper->sections->first()->section_code);

        // Access Builder Studio
        $builderResponse = $this->actingAs($this->adminUser)
            ->get(route('admin.question-papers.builder', $paper->id));

        $builderResponse->assertStatus(200);
        $builderResponse->assertSee('Final Exam ICT 2026');
        $builderResponse->assertSee('প্রশ্ন লাইব্রেরি');

        // Clean up
        $paper->sections()->delete();
        $paper->delete();
    }

    /**
     * Test 5: Add Question to Paper, Freeze Snapshot, and Save Draft
     */
    public function test_drag_and_drop_add_item_and_save_draft()
    {
        $paper = LmsQuestionPaper::create([
            'paper_code'       => 'QP-TEST-001',
            'title'            => 'Test Paper Snapshot',
            'course_id'        => $this->course->id,
            'exam_name'        => 'Term Exam',
            'subject_name'     => 'ICT',
            'subject_code'     => '154',
            'academic_year'    => '2026',
            'duration_minutes' => 45,
            'total_marks'      => 10.0,
            'status'           => 'draft',
            'paper_set'        => 'Set A',
        ]);

        $section = LmsQuestionPaperSection::create([
            'paper_id'     => $paper->id,
            'title'        => 'Section A: MCQ',
            'section_code' => 'A',
            'order_index'  => 1,
        ]);

        // Add Item
        $addResponse = $this->actingAs($this->adminUser)
            ->postJson(route('admin.question-papers.add-item', $paper->id), [
                'question_id' => $this->sampleQuestion->id,
                'section_id'  => $section->id,
                'marks'       => 2.0,
            ]);

        $addResponse->assertStatus(200);
        $addResponse->assertJson(['success' => true]);

        $item = LmsQuestionPaperItem::where('paper_id', $paper->id)->first();
        $this->assertNotNull($item);
        $this->assertEquals(2.0, $item->marks);

        // Verify Immutable Snapshot was saved
        $snapshot = $item->snapshot;
        $this->assertNotNull($snapshot);
        $this->assertEquals('What is the full form of HTML in web technology?', $snapshot['question_text']);
        $this->assertCount(2, $snapshot['options']);

        // Test saveDraft API
        $draftResponse = $this->actingAs($this->adminUser)
            ->postJson(route('admin.question-papers.save-draft', $paper->id), [
                'sections' => [
                    [
                        'id' => $section->id,
                        'items' => [
                            ['id' => $item->id, 'marks' => 3.5]
                        ]
                    ]
                ]
            ]);

        $draftResponse->assertStatus(200);
        $draftResponse->assertJson(['success' => true]);

        $item->refresh();
        $this->assertEquals(3.5, $item->marks);

        // Clean up
        $paper->items()->delete();
        $paper->sections()->delete();
        $paper->delete();
    }

    /**
     * Test 6: Board Print and Teacher Answer Key Views
     */
    public function test_board_print_and_teacher_answer_key_views()
    {
        $paper = LmsQuestionPaper::create([
            'paper_code'       => 'QP-TEST-PRINT',
            'title'            => 'Board Print Test Paper',
            'course_id'        => $this->course->id,
            'exam_name'        => 'Final Board Assessment',
            'subject_name'     => 'Information & Communication Technology',
            'subject_code'     => '154',
            'academic_year'    => '2026',
            'duration_minutes' => 60,
            'total_marks'      => 20.0,
            'status'           => 'approved',
            'paper_set'        => 'Set A',
        ]);

        $section = LmsQuestionPaperSection::create([
            'paper_id'     => $paper->id,
            'title'        => 'ক-বিভাগ: বহুনির্বাচনি অভীক্ষা',
            'section_code' => 'ক',
            'order_index'  => 1,
        ]);

        $item = LmsQuestionPaperItem::create([
            'paper_id'    => $paper->id,
            'section_id'  => $section->id,
            'question_id' => $this->sampleQuestion->id,
            'order_index' => 1,
            'marks'       => 1.0,
        ]);
        $item->freezeSnapshot();

        // 1. Board Print View
        $printResponse = $this->actingAs($this->adminUser)
            ->get(route('admin.question-papers.print-board', $paper->id));

        $printResponse->assertStatus(200);
        $printResponse->assertSee('Final Board Assessment');
        $printResponse->assertSee('ক-বিভাগ: বহুনির্বাচনি অভীক্ষা');
        $printResponse->assertSee('What is the full form of HTML');

        // 2. Teacher Answer Key View
        $keyResponse = $this->actingAs($this->adminUser)
            ->get(route('admin.question-papers.teacher-key', $paper->id));

        $keyResponse->assertStatus(200);
        $keyResponse->assertSee('শিক্ষক মূল্যায়ন নির্দেশিকা');
        $keyResponse->assertSee('HyperText Markup Language');
        $keyResponse->assertSee('HTML stands for HyperText Markup Language.');

        // Clean up
        $paper->items()->delete();
        $paper->sections()->delete();
        $paper->delete();
    }

    /**
     * Test 7: Variant Set Generation (Set A -> Set B)
     */
    public function test_variant_set_generation()
    {
        $paper = LmsQuestionPaper::create([
            'paper_code'       => 'QP-TEST-VARIANT',
            'title'            => 'Master Assessment',
            'course_id'        => $this->course->id,
            'exam_name'        => 'Term 1',
            'subject_name'     => 'ICT',
            'subject_code'     => '154',
            'academic_year'    => '2026',
            'duration_minutes' => 30,
            'total_marks'      => 10.0,
            'status'           => 'approved',
            'paper_set'        => 'Set A',
        ]);

        $section = LmsQuestionPaperSection::create([
            'paper_id'     => $paper->id,
            'title'        => 'Section A: MCQ',
            'section_code' => 'A',
            'order_index'  => 1,
        ]);

        $item = LmsQuestionPaperItem::create([
            'paper_id'    => $paper->id,
            'section_id'  => $section->id,
            'question_id' => $this->sampleQuestion->id,
            'order_index' => 1,
            'marks'       => 1.0,
        ]);
        $item->freezeSnapshot();

        // Clone to Set B
        $cloneResponse = $this->actingAs($this->adminUser)
            ->post(route('admin.question-papers.generate-variants', $paper->id), [
                'target_set' => 'Set B',
            ]);

        $cloneResponse->assertSessionHas('success');

        $clonedPaper = LmsQuestionPaper::where('master_paper_id', $paper->id)->where('paper_set', 'Set B')->first();
        $this->assertNotNull($clonedPaper);
        $this->assertEquals('Set B', $clonedPaper->paper_set);
        $this->assertCount(1, $clonedPaper->items);

        // Clean up
        $clonedPaper->items()->delete();
        $clonedPaper->sections()->delete();
        $clonedPaper->delete();

        $paper->items()->delete();
        $paper->sections()->delete();
        $paper->delete();
    }

    /**
     * Test 8: One-Click Publish to Online Quiz System
     */
    public function test_publish_paper_to_online_quiz_system()
    {
        $paper = LmsQuestionPaper::create([
            'paper_code'       => 'QP-TEST-ONLINE',
            'title'            => 'Annual Live Online Quiz 2026',
            'course_id'        => $this->course->id,
            'exam_name'        => 'Online Exam',
            'subject_name'     => 'ICT',
            'subject_code'     => '154',
            'academic_year'    => '2026',
            'duration_minutes' => 45,
            'total_marks'      => 20.0,
            'status'           => 'approved',
            'paper_set'        => 'Set A',
        ]);

        $section = LmsQuestionPaperSection::create([
            'paper_id'     => $paper->id,
            'title'        => 'Section A: MCQ',
            'section_code' => 'A',
            'order_index'  => 1,
        ]);

        $item = LmsQuestionPaperItem::create([
            'paper_id'    => $paper->id,
            'section_id'  => $section->id,
            'question_id' => $this->sampleQuestion->id,
            'order_index' => 1,
            'marks'       => 1.0,
        ]);
        $item->freezeSnapshot();

        // Publish Online
        $publishResponse = $this->actingAs($this->adminUser)
            ->post(route('admin.question-papers.publish-online', $paper->id));

        $publishResponse->assertSessionHas('success');

        $paper->refresh();
        $this->assertEquals('published', $paper->status);
        $this->assertNotNull($paper->linked_quiz_id);

        // Verify linked LmsQuiz was created and exists in database
        $linkedQuiz = LmsQuiz::find($paper->linked_quiz_id);
        $this->assertNotNull($linkedQuiz);
        $this->assertEquals('Annual Live Online Quiz 2026', $linkedQuiz->title);
        $this->assertTrue($linkedQuiz->is_published);

        // Clean up
        $linkedQuiz->delete();
        $paper->items()->delete();
        $paper->sections()->delete();
        $paper->delete();
    }

    /**
     * Test 9: Security - Unauthenticated User Redirected
     */
    public function test_unauthenticated_user_cannot_access_builder_or_teacher_key()
    {
        $paper = LmsQuestionPaper::create([
            'paper_code'       => 'QP-TEST-AUTH',
            'title'            => 'Confidential Exam',
            'exam_name'        => 'Board Exam',
            'subject_name'     => 'ICT',
            'subject_code'     => '154',
            'academic_year'    => '2026',
            'duration_minutes' => 60,
            'total_marks'      => 100.0,
            'status'           => 'draft',
        ]);

        $response = $this->get(route('admin.question-papers.teacher-key', $paper->id));
        $response->assertRedirect('/login');

        $builderResponse = $this->get(route('admin.question-papers.builder', $paper->id));
        $builderResponse->assertRedirect('/login');

        $paper->delete();
    }

    /**
     * Test 10: Admin can import MCQ questions into Question Book directly via CSV/Excel
     */
    public function test_admin_can_import_questions_into_question_book_via_csv()
    {
        $csvData = "question_text,option_a,option_b,option_c,option_d,correct_option,marks,explanation\n";
        $csvData .= "\"What does CSS stand for in web styling?\",\"Cascading Style Sheets\",\"Creative Style System\",\"Computer Styling Sheet\",\"Colorful Style Source\",\"A\",\"1.0\",\"CSS stands for Cascading Style Sheets.\"\n";
        $csvData .= "\"Which protocol is used to browse websites?\",\"FTP\",\"HTTP\",\"SMTP\",\"SSH\",\"B\",\"1.0\",\"HTTP is the protocol for web communication.\"\n";

        $tempPath = tempnam(sys_get_temp_dir(), 'qb_import_') . '.csv';
        file_put_contents($tempPath, $csvData);

        $uploadedFile = new UploadedFile(
            $tempPath,
            'qb_test_import.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.question-book.import'), [
                'import_mode'      => 'library',
                'course_id'        => $this->course->id,
                'default_category' => 'Web Development',
                'default_chapter'  => 'Chapter 2: CSS Basics',
                'excel_file'       => $uploadedFile,
            ]);

        $response->assertRedirect(route('admin.question-book.index'));
        $response->assertSessionHas('success');

        // Verify questions created in DB
        $q1 = LmsQuestion::where('question_text', 'What does CSS stand for in web styling?')->first();
        $this->assertNotNull($q1);
        $this->assertEquals($this->course->id, $q1->course_id);
        $this->assertEquals('Web Development', $q1->category);
        $this->assertEquals('Chapter 2: CSS Basics', $q1->chapter);
        $this->assertCount(4, $q1->options);
        $this->assertTrue((bool)$q1->options[0]->is_correct);

        $q2 = LmsQuestion::where('question_text', 'Which protocol is used to browse websites?')->first();
        $this->assertNotNull($q2);
        $this->assertEquals('HTTP', $q2->options[1]->option_text);
        $this->assertTrue((bool)$q2->options[1]->is_correct);

        // Clean up
        if ($q1) {
            $q1->options()->delete();
            $q1->delete();
        }
        if ($q2) {
            $q2->options()->delete();
            $q2->delete();
        }
    }

    /**
     * Test 11: Admin can import into a new quiz created directly from Question Book
     */
    public function test_admin_can_import_into_new_quiz_from_question_book()
    {
        $csvData = "question_text,option_a,option_b,option_c,option_d,correct_option,marks,explanation\n";
        $csvData .= "\"What is binary value of decimal 2?\",\"00\",\"10\",\"01\",\"11\",\"B\",\"2.0\",\"Decimal 2 equals 10 in binary.\"\n";

        $tempPath = tempnam(sys_get_temp_dir(), 'qb_newquiz_') . '.csv';
        file_put_contents($tempPath, $csvData);

        $uploadedFile = new UploadedFile(
            $tempPath,
            'qb_newquiz.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.question-book.import'), [
                'import_mode'      => 'new_quiz',
                'course_id'        => $this->course->id,
                'new_quiz_title'   => 'Imported Digital Number System Test',
                'quiz_type'        => 'exam',
                'duration_minutes' => 30,
                'excel_file'       => $uploadedFile,
            ]);

        $response->assertRedirect(route('admin.question-book.index'));
        $response->assertSessionHas('success');

        $quiz = LmsQuiz::where('title', 'Imported Digital Number System Test')->first();
        $this->assertNotNull($quiz);
        $this->assertEquals(2.0, $quiz->total_marks);

        $q = LmsQuestion::where('quiz_id', $quiz->id)->first();
        $this->assertNotNull($q);
        $this->assertEquals('What is binary value of decimal 2?', $q->question_text);

        // Clean up
        if ($q) {
            $q->options()->delete();
            $q->delete();
        }
        $quiz->delete();
    }

    /**
     * Test Auto-Pick Rule-Based Generator filtered by Question Type (e.g. fill_blanks)
     */
    public function test_auto_pick_questions_filtered_by_question_type()
    {
        $paper = LmsQuestionPaper::create([
            'paper_code'       => 'QP-AUTOPICK-' . uniqid(),
            'title'            => 'Auto-Pick Filter Test',
            'course_id'        => $this->course->id,
            'exam_name'        => 'Auto-Pick Test',
            'subject_name'     => 'ICT',
            'subject_code'     => '154',
            'academic_year'    => '2026',
            'duration_minutes' => 30,
            'total_marks'      => 10.0,
            'status'           => 'draft',
        ]);

        $section = LmsQuestionPaperSection::create([
            'paper_id'     => $paper->id,
            'title'        => 'Fill in the blanks Section',
            'section_code' => 'B',
            'order_index'  => 1,
        ]);

        // Create 2 Fill in the Blanks questions and 2 MCQ questions
        $fillBlankQ1 = LmsQuestion::create([
            'course_id'      => $this->course->id,
            'question_text'  => '৮ বিট সমান ______ বাইট।',
            'question_type'  => 'fill_blanks',
            'marks'          => 1.0,
            'difficulty'     => 'easy',
            'is_active'      => true,
        ]);
        $fillBlankQ2 = LmsQuestion::create([
            'course_id'      => $this->course->id,
            'question_text'  => 'কম্পিউটারের জনক হলেন ______।',
            'question_type'  => 'fill_blanks',
            'marks'          => 1.0,
            'difficulty'     => 'medium',
            'is_active'      => true,
        ]);
        $mcqQ1 = LmsQuestion::create([
            'course_id'      => $this->course->id,
            'question_text'  => 'র‍্যাম কোন ধরনের মেমরি?',
            'question_type'  => 'mcq_single',
            'marks'          => 1.0,
            'difficulty'     => 'easy',
            'is_active'      => true,
        ]);

        // Request auto-pick with question_type = 'fill_blanks'
        $response = $this->actingAs($this->adminUser)
            ->postJson(route('admin.question-papers.auto-select', $paper->id), [
                'section_id'    => $section->id,
                'question_type' => 'fill_blanks',
                'count'         => 2,
            ]);

        $response->assertJson([
            'success' => true,
        ]);

        $json = $response->json();
        $this->assertEquals(2, $json['added_count']);

        // Verify that only the fill_blanks questions were added
        $items = LmsQuestionPaperItem::where('paper_id', $paper->id)->where('section_id', $section->id)->get();
        $this->assertCount(2, $items);
        foreach ($items as $item) {
            $this->assertEquals('fill_blanks', $item->masterQuestion->question_type);
        }

        // Clean up
        $paper->items()->delete();
        $paper->sections()->delete();
        $paper->delete();

        $fillBlankQ1->delete();
        $fillBlankQ2->delete();
        $mcqQ1->delete();
    }

    /**
     * Test adding section with Bengali UTF-8 section_code and Bengali numerals in marks
     */
    public function test_admin_can_add_section_with_bengali_characters_and_numerals()
    {
        $paper = LmsQuestionPaper::create([
            'paper_code'    => 'QP-BN-TEST-' . rand(1000, 9999) . '-' . time(),
            'title'         => 'Bengali Section Test Paper',
            'course_id'     => $this->course->id,
            'total_marks'   => 10.00,
            'status'        => 'draft',
        ]);

        $response = $this->actingAs($this->adminUser)
            ->postJson(route('admin.question-papers.add-section', $paper->id), [
                'section_code'       => 'বহুনির্বাচনী (MCQ)',
                'title'              => 'সংক্ষিপ্ত প্রশ্ন',
                'marks_per_question' => '১.৫',
                'instructions'       => 'যেকোনো ১০টি প্রশ্নের উত্তর দাও',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $json = $response->json();
        $this->assertTrue(mb_check_encoding($json['section']['section_code'], 'UTF-8'));
        $this->assertEquals('বহুনির্বাচনী (MCQ)', $json['section']['section_code']);

        $section = LmsQuestionPaperSection::where('paper_id', $paper->id)->first();
        $this->assertNotNull($section);
        $this->assertEquals('বহুনির্বাচনী (MCQ)', $section->section_code);
        $this->assertEquals(1.5, (float)$section->marks_per_question);

        // Clean up
        $paper->sections()->delete();
        $paper->delete();
    }
}

