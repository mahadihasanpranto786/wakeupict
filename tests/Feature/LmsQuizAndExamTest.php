<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuizAttempt;
use App\model\LmsQuizAnswer;
use Illuminate\Support\Facades\Hash;

class LmsQuizAndExamTest extends TestCase
{
    protected $student;
    protected $quiz;
    protected $q1;
    protected $q2;
    protected $q1CorrectOpt;
    protected $q1WrongOpt;
    protected $q2CorrectOpt;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'Quiz Unit Test Student',
            'phone' => '01722' . rand(100000, 999999),
            'email' => 'quiztest_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);

        $this->quiz = LmsQuiz::firstOrCreate([
            'title' => 'Unit Test Assessment for NCTB ICT',
        ], [
            'description' => 'Automated test suite quiz.',
            'quiz_type' => 'practice',
            'class_level' => 'Class 8-10',
            'duration_minutes' => 10,
            'total_marks' => 20.00,
            'pass_marks' => 10.00,
            'max_attempts' => 0,
            'is_published' => true,
        ]);

        $this->q1 = LmsQuestion::firstOrCreate([
            'quiz_id' => $this->quiz->id,
            'question_text' => 'What is the standard unit of computer storage?',
        ], [
            'question_type' => 'mcq_single',
            'marks' => 10.00,
            'explanation' => 'Byte is the fundamental unit of addressable computer storage.',
            'order_index' => 1,
            'is_active' => true,
        ]);

        $this->q1CorrectOpt = LmsQuestionOption::firstOrCreate([
            'question_id' => $this->q1->id,
            'option_text' => 'Byte',
        ], [
            'is_correct' => true,
            'order_index' => 1,
        ]);

        $this->q1WrongOpt = LmsQuestionOption::firstOrCreate([
            'question_id' => $this->q1->id,
            'option_text' => 'Pixel',
        ], [
            'is_correct' => false,
            'order_index' => 2,
        ]);

        $this->q2 = LmsQuestion::firstOrCreate([
            'quiz_id' => $this->quiz->id,
            'question_text' => 'RAM is volatile memory. True or False?',
        ], [
            'question_type' => 'mcq_single',
            'marks' => 10.00,
            'explanation' => 'RAM requires power to maintain its state.',
            'order_index' => 2,
            'is_active' => true,
        ]);
        $this->q2->update(['question_type' => 'mcq_single']);

        $this->q2CorrectOpt = LmsQuestionOption::firstOrCreate([
            'question_id' => $this->q2->id,
            'option_text' => 'True',
        ], [
            'is_correct' => true,
            'order_index' => 1,
        ]);

        LmsQuestionOption::firstOrCreate([
            'question_id' => $this->q2->id,
            'option_text' => 'False',
        ], [
            'is_correct' => false,
            'order_index' => 2,
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->student) {
            $attemptIds = LmsQuizAttempt::where('student_account_id', $this->student->id)->pluck('id');
            LmsQuizAnswer::whereIn('attempt_id', $attemptIds)->delete();
            LmsQuizAttempt::where('student_account_id', $this->student->id)->delete();
            $this->student->delete();
        }

        parent::tearDown();
    }

    /**
     * Test viewing quiz catalog and filtering
     */
    public function testStudentCanViewQuizListAndFilters()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.index', ['search' => 'Unit Test Assessment']));

        $response->assertStatus(200);
        $response->assertSee('Online Quizzes');
        $response->assertSee(e($this->quiz->title));

        // Upcoming exams and practice routes
        $upcomingResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.exams.upcoming'));
        $upcomingResponse->assertStatus(200);

        $practiceResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.practice.index'));
        $practiceResponse->assertStatus(200);
    }

    /**
     * Test quiz lobby screen
     */
    public function testStudentCanViewQuizLobby()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.lobby', $this->quiz->id));

        $response->assertStatus(200);
        $response->assertSee(e($this->quiz->title));
        $response->assertSee('Important Exam Instructions');
        $response->assertSee('Start Assessment Now');
    }

    /**
     * Test starting quiz, taking exam, autosaving answers, and submitting
     */
    public function testCompleteQuizWorkflowAndAutoGrading()
    {
        // 1. Start quiz
        $startResponse = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $this->quiz->id));

        $attempt = LmsQuizAttempt::where('quiz_id', $this->quiz->id)
            ->where('student_account_id', $this->student->id)
            ->where('status', 'in_progress')
            ->first();

        $this->assertNotNull($attempt);
        $startResponse->assertRedirect(route('student.quiz.take', $attempt->id));

        // 2. View live taking screen
        $takeResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.take', $attempt->id));
        $takeResponse->assertStatus(200);
        $takeResponse->assertSee('Question Palette');
        $takeResponse->assertSee(e($this->q1->question_text));

        // 3. Autosave answer for Q1 via AJAX
        $saveResponse = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q1->id,
                'selected_option_ids' => [$this->q1CorrectOpt->id],
                'time_spent_seconds' => 45,
            ]);

        $saveResponse->assertStatus(200);
        $saveResponse->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('lms_quiz_answers', [
            'attempt_id' => $attempt->id,
            'question_id' => $this->q1->id,
        ]);

        // 4. Submit the exam with answers for Q1 (correct) and Q2 (correct)
        $submitResponse = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.submit', $attempt->id), [
                'answers' => [
                    $this->q1->id => $this->q1CorrectOpt->id,
                    $this->q2->id => $this->q2CorrectOpt->id,
                ],
                'time_spent_seconds' => 120,
            ]);

        $submitResponse->assertRedirect(route('student.quiz.results', $attempt->id));

        // Refresh attempt from DB
        $attempt->refresh();
        $this->assertEquals('graded', $attempt->status);
        $this->assertEquals(20.00, $attempt->score); // 10 + 10 marks
        $this->assertEquals(100.00, $attempt->percentage);
        $this->assertTrue($attempt->isPassed());

        // 5. View Result Scorecard
        $resultsResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.results', $attempt->id));
        $resultsResponse->assertStatus(200);
        $resultsResponse->assertSee('Assessment Passed');
        $resultsResponse->assertSee('Byte');
        $resultsResponse->assertSee('Explanation');
        // Quiz questions & results must never have print or PDF download buttons
        $resultsResponse->assertDontSee('প্রিন্ট / PDF সংরক্ষণ');

        // 6. View All Results History
        $historyResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.results.index'));
        $historyResponse->assertStatus(200);
        $historyResponse->assertSee('Passed');
    }

    /**
     * ALL QUESTIONS VIEW: Selecting an option immediately locks that question
     * while other questions remain answerable. Attempting to change locked answer fails.
     */
    public function testAllQuestionsViewLocksAnswerImmediatelyAndKeepsOtherQuestionsAnswerable()
    {
        // Start quiz in all_questions view mode
        $startResponse = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $this->quiz->id), [
                'view_mode' => 'all_questions',
            ]);

        $attempt = LmsQuizAttempt::where('quiz_id', $this->quiz->id)
            ->where('student_account_id', $this->student->id)
            ->where('status', 'in_progress')
            ->latest()
            ->first();

        $this->assertNotNull($attempt);
        $this->assertEquals('all_questions', $attempt->view_mode);

        // 1. Select answer for Q1 in all_questions mode -> should immediately finalize and lock!
        $res1 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q1->id,
                'selected_option_ids' => [$this->q1CorrectOpt->id],
                'view_mode' => 'all_questions',
                'action' => 'save',
            ]);

        $res1->assertStatus(200);
        $res1->assertJson([
            'status' => 'success',
            'is_finalized' => true,
            'state' => 'finalized',
        ]);

        $q1Answer = LmsQuizAnswer::where('attempt_id', $attempt->id)->where('question_id', $this->q1->id)->first();
        $this->assertNotNull($q1Answer);
        $this->assertTrue((bool)$q1Answer->is_finalized);

        // 2. Try to change Q1 answer to wrong option -> must be rejected by server with 422 LOCKED!
        $res2 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q1->id,
                'selected_option_ids' => [$this->q1WrongOpt->id],
                'view_mode' => 'all_questions',
                'action' => 'save',
            ]);

        $res2->assertStatus(422);
        $res2->assertJson([
            'status' => 'error',
            'code' => 'LOCKED',
        ]);

        // Q1 option must remain untouched (still correct option)
        $q1Answer->refresh();
        $this->assertEquals([$this->q1CorrectOpt->id], $q1Answer->selected_option_ids_array);

        // 3. Q2 is unanswered -> must still be answerable!
        $res3 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q2->id,
                'selected_option_ids' => [$this->q2CorrectOpt->id],
                'view_mode' => 'all_questions',
                'action' => 'save',
            ]);

        $res3->assertStatus(200);
        $res3->assertJson([
            'status' => 'success',
            'is_finalized' => true,
        ]);

        // Clean up attempt
        LmsQuizAnswer::where('attempt_id', $attempt->id)->delete();
        $attempt->delete();
    }

    /**
     * ONE-BY-ONE VIEW: Selecting an option creates a draft that can be changed.
     * Only Submit Answer finalizes and locks the question.
     */
    public function testOneByOneViewAllowsDraftOptionChangeUntilSubmittedAndLocked()
    {
        // Start quiz in one_by_one view mode
        $startResponse = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $this->quiz->id), [
                'view_mode' => 'one_by_one',
            ]);

        $attempt = LmsQuizAttempt::where('quiz_id', $this->quiz->id)
            ->where('student_account_id', $this->student->id)
            ->where('status', 'in_progress')
            ->latest()
            ->first();

        $this->assertNotNull($attempt);

        // 1. Select initial option for Q1 as draft (not finalized)
        $draftRes1 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q1->id,
                'selected_option_ids' => [$this->q1WrongOpt->id],
                'view_mode' => 'one_by_one',
                'action' => 'save',
                'finalize' => false,
            ]);

        $draftRes1->assertStatus(200);
        $draftRes1->assertJson([
            'status' => 'success',
            'is_finalized' => false,
            'state' => 'draft',
        ]);

        $q1Ans = LmsQuizAnswer::where('attempt_id', $attempt->id)->where('question_id', $this->q1->id)->first();
        $this->assertFalse((bool)$q1Ans->is_finalized);
        $this->assertEquals([$this->q1WrongOpt->id], $q1Ans->selected_option_ids_array);

        // 2. Change option before submission -> allowed!
        $draftRes2 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q1->id,
                'selected_option_ids' => [$this->q1CorrectOpt->id],
                'view_mode' => 'one_by_one',
                'action' => 'save',
                'finalize' => false,
            ]);

        $draftRes2->assertStatus(200);
        $draftRes2->assertJson([
            'status' => 'success',
            'is_finalized' => false,
            'state' => 'draft',
        ]);

        $q1Ans->refresh();
        $this->assertFalse((bool)$q1Ans->is_finalized);
        $this->assertEquals([$this->q1CorrectOpt->id], $q1Ans->selected_option_ids_array);

        // 3. Finalize and Submit Answer for Q1 -> locks it!
        $finalizeRes = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q1->id,
                'selected_option_ids' => [$this->q1CorrectOpt->id],
                'view_mode' => 'one_by_one',
                'action' => 'finalize',
                'finalize' => true,
            ]);

        $finalizeRes->assertStatus(200);
        $finalizeRes->assertJson([
            'status' => 'success',
            'is_finalized' => true,
            'state' => 'finalized',
        ]);

        $q1Ans->refresh();
        $this->assertTrue((bool)$q1Ans->is_finalized);

        // 4. Try to change after finalization -> rejected by server with 422 LOCKED!
        $afterLockRes = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $this->q1->id,
                'selected_option_ids' => [$this->q1WrongOpt->id],
                'view_mode' => 'one_by_one',
                'action' => 'save',
            ]);

        $afterLockRes->assertStatus(422);
        $afterLockRes->assertJson([
            'status' => 'error',
            'code' => 'LOCKED',
        ]);

        // Clean up attempt
        LmsQuizAnswer::where('attempt_id', $attempt->id)->delete();
        $attempt->delete();
    }

    /**
     * Test page refresh and reconnection preserves locked states
     */
    public function testRefreshPreservesLockedAnswers()
    {
        $attempt = LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number' => 99,
            'started_at' => \Carbon\Carbon::now(),
            'total_marks' => 20.00,
            'status' => 'in_progress',
            'view_mode' => 'all_questions',
            'question_set' => 'Set A',
        ]);

        LmsQuizAnswer::create([
            'attempt_id' => $attempt->id,
            'question_id' => $this->q1->id,
            'selected_option_ids' => json_encode([$this->q1CorrectOpt->id]),
            'is_finalized' => true,
            'finalized_at' => \Carbon\Carbon::now(),
        ]);

        // Refresh/revisit the take page
        $takeRes = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.take', $attempt->id));

        $takeRes->assertStatus(200);
        // HTML rendered has disabled input and locked badge
        $takeRes->assertSee('disabled');
        $takeRes->assertSee('লকড');

        // Clean up
        LmsQuizAnswer::where('attempt_id', $attempt->id)->delete();
        $attempt->delete();
    }

    /**
     * Test online quiz excludes live exams and handles zero-question protection
     */
    public function test_online_quiz_view_excludes_live_exams_and_prevents_zero_question_starts()
    {
        // 1. Create a live exam (quiz_type = 'exam')
        $liveExam = LmsQuiz::create([
            'title'            => 'Scheduled Final Board Exam ' . rand(100, 999),
            'course_id'        => $this->quiz->course_id,
            'quiz_type'        => 'exam',
            'duration_minutes' => 30,
            'total_marks'      => 20.0,
            'pass_marks'       => 8.0,
            'is_published'     => true,
        ]);

        // 2. Create a practice quiz with 0 questions
        $emptyPracticeQuiz = LmsQuiz::create([
            'title'            => 'Empty Practice Quiz ' . rand(100, 999),
            'course_id'        => $this->quiz->course_id,
            'quiz_type'        => 'practice',
            'duration_minutes' => 15,
            'total_marks'      => 0.0,
            'pass_marks'       => 0.0,
            'is_published'     => true,
        ]);

        // 3. Visit online quiz page (/student/quiz)
        $onlineQuizRes = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.index'));

        $onlineQuizRes->assertStatus(200);
        // Live exam must NOT be displayed on online quiz page
        $onlineQuizRes->assertDontSee($liveExam->title);
        // Empty practice quiz is displayed as card with View Only badge
        $onlineQuizRes->assertSee($emptyPracticeQuiz->title);
        $onlineQuizRes->assertSee('বিবরণ (View Only)');

        // 4. Visit Upcoming Exams page (/student/exams/upcoming)
        $upcomingRes = $this->actingAs($this->student, 'student')
            ->get(route('student.exams.upcoming'));

        $upcomingRes->assertStatus(200);
        $upcomingRes->assertSee($liveExam->title);

        // 5. Try to start empty quiz -> redirected with warning
        $startEmptyRes = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $emptyPracticeQuiz->id));

        $startEmptyRes->assertRedirect(route('student.quiz.lobby', $emptyPracticeQuiz->id));
        $startEmptyRes->assertSessionHas('error');

        // Clean up
        $liveExam->delete();
        $emptyPracticeQuiz->delete();
    }

    /**
     * Test importing questions with formula text (e.g. '=E1/F1 সূত্রে F1 কে কী বলা হয়?') does not crash
     */
    public function testImportQuestionsWithFormulaTextDoesNotCrashFormulaEngine()
    {
        $dummyQuiz = \App\model\LmsQuiz::create([
            'course_id' => $this->quiz->course_id,
            'title' => 'Formula Import Test Quiz ' . uniqid(),
            'quiz_type' => 'practice',
            'duration_minutes' => 15,
            'total_marks' => 0,
            'pass_marks' => 1.0,
            'is_published' => true,
        ]);

        $csvContent = "Question,Option A,Option B,Option C,Option D,Correct Answer,Marks\n";
        $uniqueFormulaQ = "=E1/F1 সূত্রে F1 কে কী বলা হয়? " . uniqid();
        $csvContent .= "\"{$uniqueFormulaQ}\",\"ভাজ্য\",\"ভাগফল\",\"ভাজক\",\"গুণফল\",\"C\",1\n";

        $tempFile = tempnam(sys_get_temp_dir(), 'test_quiz_') . '.csv';
        file_put_contents($tempFile, $csvContent);

        try {
            $importService = new \App\Services\QuizExcelImportService();
            $res = $importService->importFromFile($tempFile, $dummyQuiz->id);

            $this->assertTrue($res['success']);
            $this->assertEquals(1, $res['imported_count']);

            $importedQ = \App\model\LmsQuestion::where('quiz_id', $dummyQuiz->id)
                ->where('question_text', 'like', '%=E1/F1%')
                ->first();

            $this->assertNotNull($importedQ);
            $this->assertStringContainsString('=E1/F1 সূত্রে F1 কে কী বলা হয়?', $importedQ->question_text);
        } finally {
            @unlink($tempFile);
            \App\model\LmsQuestion::where('quiz_id', $dummyQuiz->id)->delete();
            $dummyQuiz->delete();
        }
    }

    /**
     * Test duplicate questions are not inserted even if submitted multiple times at different times
     */
    public function testDuplicateQuestionsAreNotInsertedEvenIfSubmittedMultipleTimes()
    {
        $uniqueText = "What is anti-duplicate system test question " . uniqid() . "?";
        $dummyQuiz1 = \App\model\LmsQuiz::create([
            'course_id' => $this->quiz->course_id,
            'title' => 'Dup Test Quiz 1 ' . uniqid(),
            'quiz_type' => 'practice',
            'duration_minutes' => 10,
            'total_marks' => 0,
            'pass_marks' => 1.0,
            'is_published' => true,
        ]);
        $dummyQuiz2 = \App\model\LmsQuiz::create([
            'course_id' => $this->quiz->course_id,
            'title' => 'Dup Test Quiz 2 ' . uniqid(),
            'quiz_type' => 'practice',
            'duration_minutes' => 10,
            'total_marks' => 0,
            'pass_marks' => 1.0,
            'is_published' => true,
        ]);

        $csv1 = "Question,Option A,Option B,Option C,Option D,Correct Answer,Marks\n";
        $csv1 .= "\"{$uniqueText}\",\"Opt 1\",\"Opt 2\",\"Opt 3\",\"Opt 4\",\"A\",1\n";

        // Batch 2: submitted later, has whitespace/punctuation variations
        $csv2 = "Question,Option A,Option B,Option C,Option D,Correct Answer,Marks\n";
        $csv2 .= "\"  " . strtoupper($uniqueText) . "  \",\"Opt 1\",\"Opt 2\",\"Opt 3\",\"Opt 4\",\"A\",1\n";

        $file1 = tempnam(sys_get_temp_dir(), 'dup_test_1_') . '.csv';
        $file2 = tempnam(sys_get_temp_dir(), 'dup_test_2_') . '.csv';
        file_put_contents($file1, $csv1);
        file_put_contents($file2, $csv2);

        try {
            $importService = new \App\Services\QuizExcelImportService();
            
            // First submission
            $res1 = $importService->importFromFile($file1, $dummyQuiz1->id);
            $this->assertTrue($res1['success']);
            $this->assertEquals(1, $res1['imported_count']);

            // Second submission at different time / different quiz
            $res2 = $importService->importFromFile($file2, $dummyQuiz2->id);
            $this->assertTrue($res2['success']);
            $this->assertEquals(0, $res2['imported_count']);
            $this->assertNotEmpty($res2['errors']);
            $this->assertStringContainsString('Duplicate question detected', $res2['errors'][0]);

            // Total in database must be strictly 1
            $norm = \App\model\LmsQuestion::hashText($uniqueText);
            $totalCount = \App\model\LmsQuestion::where('question_hash', $norm)->count();
            $this->assertEquals(1, $totalCount);
        } finally {
            @unlink($file1);
            @unlink($file2);
            \App\model\LmsQuestion::where('question_hash', \App\model\LmsQuestion::hashText($uniqueText))->delete();
            $dummyQuiz1->delete();
            $dummyQuiz2->delete();
        }
    }

    /**
     * Test single exam attempt strictly prevents same question from appearing more than once
     */
    public function testSingleExamPreventsSameQuestionFromAppearingMoreThanOnce()
    {
        $rotationService = new \App\Services\PracticeQuestionRotationService();
        $result = $rotationService->selectQuestionsForNewAttempt($this->student->id, null, 10);
        $questions = $result['questions'];

        $seenHashes = [];
        foreach ($questions as $q) {
            $h = $q->question_hash ?: \App\model\LmsQuestion::hashText($q->question_text);
            $this->assertArrayNotHasKey($h, $seenHashes, "Question {$q->question_text} appeared more than once in the same exam!");
            $seenHashes[$h] = true;
        }
    }

    /**
     * Test Retake Submitted Attempt Reuses Exact Same Questions
     */
    public function testRetakeSubmittedAttemptReusesExactSameSubmittedQuestions()
    {
        // 1. Create a submitted attempt with a snapshot of questions
        $snapshot = [
            [
                'id' => 991,
                'question_text' => 'What is the capital of Bangladesh?',
                'question_type' => 'mcq_single',
                'marks' => 1.0,
                'options' => [
                    ['id' => 101, 'text' => 'Dhaka', 'order' => 0],
                    ['id' => 102, 'text' => 'Chittagong', 'order' => 1],
                ],
            ],
            [
                'id' => 992,
                'question_text' => 'What is 2 + 2?',
                'question_type' => 'mcq_single',
                'marks' => 1.0,
                'options' => [
                    ['id' => 201, 'text' => '4', 'order' => 0],
                    ['id' => 202, 'text' => '5', 'order' => 1],
                ],
            ],
        ];

        $prevAttempt = \App\model\LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number' => 1,
            'started_at' => \Carbon\Carbon::now()->subMinutes(15),
            'total_marks' => 2.0,
            'status' => 'graded',
            'view_mode' => 'all_questions',
            'question_set' => 'Set A',
            'questions_snapshot' => $snapshot,
        ]);

        // 2. Call retake endpoint
        $response = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.retake', $prevAttempt->id));

        // 3. Must create new attempt with status in_progress and identical questions
        $newAttempt = \App\model\LmsQuizAttempt::where('quiz_id', $this->quiz->id)
            ->where('student_account_id', $this->student->id)
            ->where('id', '!=', $prevAttempt->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($newAttempt);
        $this->assertEquals('in_progress', $newAttempt->status);

        // Exact same set of questions and options must be reused, but re-shuffled
        $newSnapshot = $newAttempt->questions_snapshot;
        $this->assertCount(count($snapshot), $newSnapshot);

        $origQIds = array_column($snapshot, 'id');
        $newQIds = array_column($newSnapshot, 'id');
        $this->assertNotEquals($origQIds, $newQIds);
        sort($origQIds);
        sort($newQIds);
        $this->assertEquals($origQIds, $newQIds);

        $origOptsByQ = collect($snapshot)->keyBy('id');
        foreach ($newSnapshot as $qItem) {
            $origQ = $origOptsByQ->get($qItem['id']);
            $origOptIds = array_column($origQ['options'], 'id');
            $newOptIds = array_column($qItem['options'], 'id');
            $this->assertNotEquals($origOptIds, $newOptIds);
            sort($origOptIds);
            sort($newOptIds);
            $this->assertEquals($origOptIds, $newOptIds);
            $this->assertEquals([0, 1], array_column($qItem['options'], 'order'));
        }

        $response->assertRedirect(route('student.quiz.take', $newAttempt->id));
    }

    /**
     * Test Retake Re-shuffles Question Serial and Correct Answer Option Position Every Time
     */
    public function testRetakeAlwaysReshufflesQuestionSerialAndOptionAnswerPositionsEverytime()
    {
        $extraOptQ1A = LmsQuestionOption::create([
            'question_id' => $this->q1->id,
            'option_text' => 'Kilobyte',
            'is_correct'  => false,
            'order_index' => 3,
        ]);
        $extraOptQ1B = LmsQuestionOption::create([
            'question_id' => $this->q1->id,
            'option_text' => 'Megabyte',
            'is_correct'  => false,
            'order_index' => 4,
        ]);

        $extraOptQ2A = LmsQuestionOption::create([
            'question_id' => $this->q2->id,
            'option_text' => 'Random Access',
            'is_correct'  => false,
            'order_index' => 2,
        ]);
        $extraOptQ2B = LmsQuestionOption::create([
            'question_id' => $this->q2->id,
            'option_text' => 'Optical Drive',
            'is_correct'  => false,
            'order_index' => 3,
        ]);
        $extraOptQ2C = LmsQuestionOption::create([
            'question_id' => $this->q2->id,
            'option_text' => 'Cache Memory',
            'is_correct'  => false,
            'order_index' => 4,
        ]);

        $q3 = LmsQuestion::create([
            'quiz_id'       => $this->quiz->id,
            'question_text' => 'Which protocol transfers web pages?',
            'question_type' => 'mcq_single',
            'marks'         => 10.00,
            'order_index'   => 3,
            'is_active'     => true,
        ]);
        $q3Correct = LmsQuestionOption::create(['question_id' => $q3->id, 'option_text' => 'HTTP', 'is_correct' => true, 'order_index' => 1]);
        $q3W1 = LmsQuestionOption::create(['question_id' => $q3->id, 'option_text' => 'FTP', 'is_correct' => false, 'order_index' => 2]);
        $q3W2 = LmsQuestionOption::create(['question_id' => $q3->id, 'option_text' => 'SMTP', 'is_correct' => false, 'order_index' => 3]);
        $q3W3 = LmsQuestionOption::create(['question_id' => $q3->id, 'option_text' => 'SSH', 'is_correct' => false, 'order_index' => 4]);

        $initialSnapshot = [
            [
                'id' => $this->q1->id,
                'question_text' => $this->q1->question_text,
                'question_type' => 'mcq_single',
                'marks' => 10.0,
                'options' => [
                    ['id' => $this->q1CorrectOpt->id, 'text' => $this->q1CorrectOpt->option_text, 'order' => 0],
                    ['id' => $this->q1WrongOpt->id, 'text' => $this->q1WrongOpt->option_text, 'order' => 1],
                    ['id' => $extraOptQ1A->id, 'text' => $extraOptQ1A->option_text, 'order' => 2],
                    ['id' => $extraOptQ1B->id, 'text' => $extraOptQ1B->option_text, 'order' => 3],
                ],
            ],
            [
                'id' => $this->q2->id,
                'question_text' => $this->q2->question_text,
                'question_type' => 'mcq_single',
                'marks' => 10.0,
                'options' => [
                    ['id' => $this->q2CorrectOpt->id, 'text' => $this->q2CorrectOpt->option_text, 'order' => 0],
                    ['id' => $extraOptQ2A->id, 'text' => $extraOptQ2A->option_text, 'order' => 1],
                    ['id' => $extraOptQ2B->id, 'text' => $extraOptQ2B->option_text, 'order' => 2],
                    ['id' => $extraOptQ2C->id, 'text' => $extraOptQ2C->option_text, 'order' => 3],
                ],
            ],
            [
                'id' => $q3->id,
                'question_text' => $q3->question_text,
                'question_type' => 'mcq_single',
                'marks' => 10.0,
                'options' => [
                    ['id' => $q3Correct->id, 'text' => $q3Correct->option_text, 'order' => 0],
                    ['id' => $q3W1->id, 'text' => $q3W1->option_text, 'order' => 1],
                    ['id' => $q3W2->id, 'text' => $q3W2->option_text, 'order' => 2],
                    ['id' => $q3W3->id, 'text' => $q3W3->option_text, 'order' => 3],
                ],
            ],
        ];

        $correctByQuestion = [
            $this->q1->id => $this->q1CorrectOpt->id,
            $this->q2->id => $this->q2CorrectOpt->id,
            $q3->id       => $q3Correct->id,
        ];

        $previousAttempt = LmsQuizAttempt::create([
            'quiz_id'            => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number'     => 1,
            'started_at'         => \Carbon\Carbon::now()->subMinutes(10),
            'total_marks'        => 30.0,
            'pass_marks'         => 10.0,
            'status'             => 'graded',
            'view_mode'          => 'all_questions',
            'question_set'       => 'Set A',
            'questions_snapshot' => $initialSnapshot,
        ]);

        // Perform 3 consecutive retakes and verify every retake reshuffles both question serial & option answer positions
        for ($retakeRun = 1; $retakeRun <= 3; $retakeRun++) {
            $res = $this->actingAs($this->student, 'student')
                ->post(route('student.quiz.retake', $previousAttempt->id));

            $retakeAttempt = LmsQuizAttempt::where('quiz_id', $this->quiz->id)
                ->where('student_account_id', $this->student->id)
                ->latest('id')
                ->first();

            $this->assertNotNull($retakeAttempt);
            $this->assertNotEquals($previousAttempt->id, $retakeAttempt->id);
            $res->assertRedirect(route('student.quiz.take', $retakeAttempt->id));

            $prevSnap = $previousAttempt->questions_snapshot;
            $curSnap = $retakeAttempt->questions_snapshot;

            // 1. Same questions, different serial order
            $prevQOrder = array_column($prevSnap, 'id');
            $curQOrder = array_column($curSnap, 'id');
            $this->assertNotEquals($prevQOrder, $curQOrder, "Retake #{$retakeRun} must reshuffle question serial order");

            $sortedPrevQ = $prevQOrder;
            $sortedCurQ = $curQOrder;
            sort($sortedPrevQ);
            sort($sortedCurQ);
            $this->assertEquals($sortedPrevQ, $sortedCurQ);

            // 2. For every question, options order and correct option index must shift
            $prevSnapMap = collect($prevSnap)->keyBy('id');
            foreach ($curSnap as $qItem) {
                $qId = $qItem['id'];
                $prevQItem = $prevSnapMap->get($qId);
                $prevOptIds = array_column($prevQItem['options'], 'id');
                $curOptIds = array_column($qItem['options'], 'id');

                $this->assertNotEquals($prevOptIds, $curOptIds, "Retake #{$retakeRun} Q#{$qId} must reshuffle option order");
                $this->assertEquals([0, 1, 2, 3], array_column($qItem['options'], 'order'));

                $correctId = $correctByQuestion[$qId];
                $prevCorrectPos = array_search($correctId, $prevOptIds, true);
                $curCorrectPos = array_search($correctId, $curOptIds, true);
                $this->assertNotEquals($prevCorrectPos, $curCorrectPos, "Retake #{$retakeRun} Q#{$qId} correct option letter/position must shift");
            }

            // 3. Submit retake with correct option IDs and verify grading works regardless of shuffled order
            $submitRes = $this->actingAs($this->student, 'student')
                ->post(route('student.quiz.submit', $retakeAttempt->id), [
                    'answers' => $correctByQuestion,
                ]);
            $submitRes->assertRedirect(route('student.quiz.results', $retakeAttempt->id));

            $retakeAttempt->refresh();
            $this->assertEquals('graded', $retakeAttempt->status);
            $this->assertEquals(30.0, (float)$retakeAttempt->score);

            $previousAttempt = $retakeAttempt;
        }
    }

    /**
     * Test Navigating Back to Submitted Attempt Redirects to Results Without Restarting Exam
     */
    public function testNavigatingBackToSubmittedAttemptRedirectsToResultsWithoutRestartingExam()
    {
        // 1. Create a graded/submitted attempt
        $attempt = \App\model\LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number' => 2,
            'started_at' => \Carbon\Carbon::now()->subMinutes(20),
            'total_marks' => 10.0,
            'status' => 'graded',
            'view_mode' => 'all_questions',
        ]);

        // 2. Student hits Back button (GET request to take route)
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.take', $attempt->id));

        // Must redirect to results page immediately
        $response->assertRedirect(route('student.quiz.results', $attempt->id));
    }

    /**
     * Test Strict Anti-Cheating System: Record security violations, verify warning tiers, and ensure exam is NEVER terminated
     */
    public function testStrictAntiCheatingSecurityViolationsTrackingAndNoAutoTermination()
    {
        // 1. Create an in-progress attempt
        $attempt = \App\model\LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number' => 1,
            'started_at' => \Carbon\Carbon::now(),
            'total_marks' => 20.0,
            'status' => 'in_progress',
            'view_mode' => 'all_questions',
            'security_violations_count' => 0,
        ]);

        // 2. 1st Violation: Tab Switch
        $response1 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.record-violation', $attempt->id), [
                'violation_type' => 'tab_switch',
                'details' => 'ব্রাউজার ট্যাব পরিবর্তন (৪ সেকেন্ড)',
            ]);

        $response1->assertStatus(200);
        $response1->assertJson([
            'success' => true,
            'warning_count' => 1,
            'violation_type' => 'tab_switch',
        ]);

        // Verify DB update
        $attempt->refresh();
        $this->assertEquals(1, $attempt->security_violations_count);
        $this->assertEquals('in_progress', $attempt->status); // NEVER terminated!

        // 3. 2nd Violation: Copy Attempt
        $response2 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.record-violation', $attempt->id), [
                'violation_type' => 'copy_attempt',
                'details' => 'প্রশ্ন টেক্সট কপি করার চেষ্টা',
            ]);

        $response2->assertStatus(200);
        $response2->assertJson([
            'success' => true,
            'warning_count' => 2,
            'violation_type' => 'copy_attempt',
        ]);

        $attempt->refresh();
        $this->assertEquals(2, $attempt->security_violations_count);
        $this->assertEquals('in_progress', $attempt->status); // STILL in progress!

        // 4. 3rd Violation: Restricted Shortcut
        $response3 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.record-violation', $attempt->id), [
                'violation_type' => 'restricted_shortcut',
                'details' => 'Ctrl+U পেজ সোর্স দেখার চেষ্টা',
            ]);

        $response3->assertStatus(200);
        $response3->assertJson([
            'success' => true,
            'warning_count' => 3,
        ]);

        $attempt->refresh();
        $this->assertEquals(3, $attempt->security_violations_count);
        $this->assertEquals('in_progress', $attempt->status); // STAYS IN PROGRESS!
        $this->assertCount(3, $attempt->violations);

        // 5. Verify Admin attempt detail reflects the security audit log
        $admin = \App\User::first() ?: \App\User::create([
            'name' => 'Admin Test',
            'email' => 'admin_test_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
        ]);

        $detailResponse = $this->actingAs($admin)
            ->get(route('admin.quizzes.attempt-detail', $attempt->id));
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('নিরাপত্তা ও অখণ্ডতা নিরীক্ষা');
        $detailResponse->assertSee('মোট নিরাপত্তা লঙ্ঘন: 3টি');
    }

    /**
     * Test Single Student Account: Reuse existing account across registration and course application
     */
    public function testSingleStudentAccountReuseAcrossRegistrationAndCourseApplication()
    {
        $uniquePhone = '01799' . rand(100000, 999999);
        $uniqueEmail = 'student_' . rand(10000, 99999) . '@wakeupict.test';

        // 1. First: Student registers via portal registration
        $regResponse = $this->post(route('student.register.submit'), [
            'name' => 'Single Account Test Student',
            'phone' => $uniquePhone,
            'email' => $uniqueEmail,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $this->assertTrue($regResponse->isRedirect(route('student.registration.confirmation')) || $regResponse->isRedirect(route('student.dashboard')));

        // Verify account exists
        $account = \App\model\StudentAccount::where('phone', $uniquePhone)->first();
        $this->assertNotNull($account);
        $initialAccountId = $account->id;

        // 2. Second: Same student applies for Course 1 via Admission Application
        $course1 = \App\model\Course::first() ?: \App\model\Course::create([
            'course_title' => 'Test Course A',
            'slug' => 'test-course-a-' . rand(100, 999),
            'course_fee' => 3000,
            'status' => 1,
        ]);

        $request = new \Illuminate\Http\Request();
        $applyResult1 = \App\Services\StudentEnrollmentService::processAdmissionApplication([
            'student_name' => 'Single Account Test Student',
            'personal_call_no' => $uniquePhone,
            'email' => $uniqueEmail,
            'course_id' => $course1->id,
            'selected_course_ids' => [$course1->id],
        ], $request);

        $this->assertTrue($applyResult1['success']);
        // Must reuse the SAME StudentAccount
        $this->assertEquals($initialAccountId, $applyResult1['student_account']->id);

        // 3. Third: Same student applies for Course 2
        $course2 = \App\model\Course::where('id', '!=', $course1->id)->first() ?: \App\model\Course::create([
            'course_title' => 'Test Course B',
            'slug' => 'test-course-b-' . rand(100, 999),
            'course_fee' => 4000,
            'status' => 1,
        ]);

        $applyResult2 = \App\Services\StudentEnrollmentService::processAdmissionApplication([
            'student_name' => 'Single Account Test Student',
            'personal_call_no' => $uniquePhone,
            'email' => $uniqueEmail,
            'course_id' => $course2->id,
            'selected_course_ids' => [$course2->id],
        ], $request);

        $this->assertTrue($applyResult2['success']);
        // Must still reuse the SAME StudentAccount
        $this->assertEquals($initialAccountId, $applyResult2['student_account']->id);

        // Verify exactly 1 account exists for this phone in the entire database
        $this->assertEquals(1, \App\model\StudentAccount::where('phone', $uniquePhone)->count());

        // Verify student is enrolled in both courses
        $enrollments = \App\model\LmsEnrollment::where('student_account_id', $initialAccountId)->pluck('course_id')->toArray();
        $this->assertContains($course1->id, $enrollments);
        $this->assertContains($course2->id, $enrollments);

        // 4. Fourth: Student visits register again with the same phone to update credentials
        \Illuminate\Support\Facades\Auth::guard('student')->logout();
        $reRegResponse = $this->post(route('student.register.submit'), [
            'name' => 'Single Account Test Student Updated',
            'phone' => $uniquePhone,
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $this->assertTrue($reRegResponse->isRedirect(route('student.registration.confirmation')) || $reRegResponse->isRedirect(route('student.dashboard')));
        $account->refresh();
        $this->assertEquals($initialAccountId, $account->id);
        $this->assertTrue(Hash::check('newpassword123', $account->password));
    }

    /**
     * Test Parent Question Tracking and History AJAX endpoint in Admin Reports
     */
    public function testParentQuestionTrackingAndHistoryEndpoint()
    {
        $admin = \App\User::first() ?: \App\User::create([
            'name' => 'Admin Test',
            'email' => 'admin_test_pq_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
        ]);

        // Create Parent Question
        $parentQuestion = \App\model\LmsQuestion::create([
            'question_text' => 'What is the main memory of a computer?',
            'category' => 'Hardware',
            'question_type' => 'mcq_single',
            'marks' => 1.0,
            'is_archived' => false,
        ]);

        // Create an attempt answering this question
        $attempt = \App\model\LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number' => 1,
            'started_at' => \Carbon\Carbon::now(),
            'total_marks' => 20.0,
            'status' => 'graded',
            'view_mode' => 'all_questions',
        ]);

        \App\model\LmsQuizAnswer::create([
            'attempt_id' => $attempt->id,
            'question_id' => $parentQuestion->id,
            'is_correct' => true,
            'marks_obtained' => 1.0,
        ]);

        // 1. Visit Reports with tab=questions
        $reportsResponse = $this->actingAs($admin)
            ->get(route('admin.quizzes.reports', ['tab' => 'questions']));
        $reportsResponse->assertStatus(200);
        $reportsResponse->assertSee('প্রশ্ন হিস্ট্রি ও মূল (প্যারেন্ট) প্রশ্ন পারফরম্যান্স বিশ্লেষণ');

        // 2. Fetch Parent Question History AJAX Endpoint
        $historyResponse = $this->actingAs($admin)
            ->getJson(route('admin.quizzes.reports.parent-question-history', $parentQuestion->id));

        $historyResponse->assertStatus(200);
        $historyResponse->assertJson([
            'success' => true,
            'parent_question' => [
                'id' => $parentQuestion->id,
                'question_text' => 'What is the main memory of a computer?',
            ],
            'total_appearances' => 1,
            'correct_count' => 1,
            'incorrect_count' => 0,
        ]);
    }

    /**
     * Test Reset Violations (Single and Bulk) and Descending Order in Admin Reports
     */
    public function testSecurityViolationsResetAndReportsDescOrder()
    {
        $admin = \App\User::first() ?: \App\User::create([
            'name' => 'Admin Reset Test',
            'email' => 'admin_reset_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
        ]);

        // Create 2 attempts with violations
        $attempt1 = \App\model\LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number' => 10,
            'started_at' => \Carbon\Carbon::now()->subMinutes(10),
            'total_marks' => 20.0,
            'status' => 'graded',
            'view_mode' => 'all_questions',
            'security_violations_count' => 3,
            'security_violations_log' => [['warning_number' => 1, 'violation_type' => 'tab_switch', 'time' => '10:00 AM']],
        ]);

        \App\model\LmsExamViolation::create([
            'attempt_id' => $attempt1->id,
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'violation_type' => 'tab_switch',
            'warning_count' => 1,
            'details' => 'Tab switch test',
        ]);

        $attempt2 = \App\model\LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number' => 11,
            'started_at' => \Carbon\Carbon::now()->subMinutes(5),
            'total_marks' => 20.0,
            'status' => 'graded',
            'view_mode' => 'all_questions',
            'security_violations_count' => 5,
            'security_violations_log' => [['warning_number' => 1, 'violation_type' => 'right_click', 'time' => '10:05 AM']],
        ]);

        \App\model\LmsExamViolation::create([
            'attempt_id' => $attempt2->id,
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'violation_type' => 'right_click',
            'warning_count' => 1,
            'details' => 'Right click test',
        ]);

        // 1. Verify reports sorting is strictly DESC by attempt id
        $response = $this->actingAs($admin)->get(route('admin.quizzes.reports'));
        $response->assertStatus(200);
        $attemptsOnPage = $response->viewData('attempts');
        $this->assertTrue($attemptsOnPage->first()->id >= $attemptsOnPage->last()->id);

        // 2. Test Single Attempt Reset Violations
        $resetSingleResponse = $this->actingAs($admin)
            ->post(route('admin.quizzes.attempt.reset-violations', $attempt1->id));
        $resetSingleResponse->assertRedirect();

        $attempt1->refresh();
        $this->assertEquals(0, $attempt1->security_violations_count);
        $this->assertNull($attempt1->security_violations_log);
        $this->assertEquals(0, \App\model\LmsExamViolation::where('attempt_id', $attempt1->id)->count());

        // 3. Test Bulk Reset Violations
        $resetBulkResponse = $this->actingAs($admin)
            ->post(route('admin.quizzes.reports.bulk-reset-violations'), [
                'attempt_ids' => [$attempt2->id],
            ]);
        $resetBulkResponse->assertRedirect();

        $attempt2->refresh();
        $this->assertEquals(0, $attempt2->security_violations_count);
        $this->assertNull($attempt2->security_violations_log);
        $this->assertEquals(0, \App\model\LmsExamViolation::where('attempt_id', $attempt2->id)->count());
    }

    /**
     * Test Attempt Detail Security Violations Compact Notification Feed & On-Scroll Pagination
     */
    public function testAttemptDetailSecurityViolationsOnScrollPagination()
    {
        $admin = \App\User::first();
        if (!$admin) {
            $admin = \App\User::create([
                'name' => 'Admin User',
                'email' => 'admin_vscroll@example.com',
                'password' => bcrypt('password123'),
            ]);
        }

        $attempt = LmsQuizAttempt::create([
            'quiz_id' => $this->quiz->id,
            'student_account_id' => $this->student->id,
            'status' => 'completed',
            'started_at' => \Carbon\Carbon::now()->subMinutes(20),
            'submitted_at' => \Carbon\Carbon::now(),
            'attempt_number' => 15, 'total_marks' => 20.0,
            'percentage' => 80,
            'security_violations_count' => 15,
            'security_violations_log' => null,
        ]);

        // Create 15 violations for this attempt
        for ($i = 1; $i <= 15; $i++) {
            \App\model\LmsExamViolation::create([
                'attempt_id' => $attempt->id,
                'quiz_id' => $this->quiz->id,
                'student_account_id' => $this->student->id,
                'violation_type' => 'right_click',
                'warning_count' => $i,
                'details' => 'Violation test #' . $i,
                'ip_address' => '127.0.0.1',
            ]);
        }

        // 1. Test attempt-detail HTML view
        $viewResponse = $this->actingAs($admin)->get(route('admin.quizzes.attempt-detail', $attempt->id));
        $viewResponse->assertStatus(200);
        $viewResponse->assertViewHas('initialViolations');
        $viewResponse->assertViewHas('totalViolations', 15);
        $viewResponse->assertViewHas('hasMoreViolations', true);
        $this->assertEquals(10, count($viewResponse->viewData('initialViolations')));

        // 2. Test AJAX pagination endpoint page 1
        $apiResponsePage1 = $this->actingAs($admin)->getJson(route('admin.quizzes.attempt.violations-data', $attempt->id) . '?page=1');
        $apiResponsePage1->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'current_page' => 1,
                'per_page' => 10,
                'total' => 15,
                'has_more' => true,
            ]);
        $this->assertCount(10, $apiResponsePage1->json('data'));

        // 3. Test AJAX pagination endpoint page 2 (remaining 5 items)
        $apiResponsePage2 = $this->actingAs($admin)->getJson(route('admin.quizzes.attempt.violations-data', $attempt->id) . '?page=2');
        $apiResponsePage2->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'current_page' => 2,
                'per_page' => 10,
                'total' => 15,
                'has_more' => false,
            ]);
        $this->assertCount(5, $apiResponsePage2->json('data'));
    }

    /**
     * Test scheduled live exam date enforcement and remaining start date display
     */
    public function testScheduledLiveExamDateEnforcementAndRemainingDaysDisplay()
    {
        $futureStartTime = \Carbon\Carbon::now()->addDays(3)->setTime(11, 0, 0);

        // 1. Create a scheduled Live Exam
        $scheduledExam = LmsQuiz::create([
            'course_id'        => $this->quiz->course_id,
            'title'            => 'HSC ICT Final Board Model Exam ' . uniqid(),
            'quiz_type'        => 'exam',
            'duration_minutes' => 30,
            'total_marks'      => 10.0,
            'pass_marks'       => 5.0,
            'max_attempts'     => 1,
            'is_published'     => true,
            'start_time'       => $futureStartTime,
        ]);

        $q = LmsQuestion::create([
            'quiz_id'       => $scheduledExam->id,
            'question_text' => 'What is the full form of HTML?',
            'question_type' => 'mcq_single',
            'marks'         => 10.0,
            'is_active'     => true,
        ]);

        LmsQuestionOption::create([
            'question_id' => $q->id,
            'option_text' => 'HyperText Markup Language',
            'is_correct'  => true,
            'order_index' => 1,
        ]);

        // 2. Model methods validation
        $this->assertTrue($scheduledExam->isLiveExam());
        $this->assertTrue($scheduledExam->isScheduled());
        $this->assertTrue($scheduledExam->isUpcoming());
        $this->assertFalse($scheduledExam->isLiveNow());
        $this->assertFalse($scheduledExam->canAttempt($this->student->id));
        $this->assertGreaterThan(0, $scheduledExam->getRemainingSeconds());
        $this->assertStringContainsString('বাকি', $scheduledExam->getRemainingTimeForHumans());

        // 3. Upcoming exams page should display start date & remaining countdown text
        $upcomingRes = $this->actingAs($this->student, 'student')
            ->get(route('student.exams.upcoming'));

        $upcomingRes->assertStatus(200);
        $upcomingRes->assertSee($scheduledExam->title);
        $upcomingRes->assertSee($futureStartTime->format('d M Y'));
        $upcomingRes->assertSee('শুরু হতে বাকি');
        $upcomingRes->assertSee('Locked');

        // 4. Lobby page should show countdown timer and disabled start
        $lobbyRes = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.lobby', $scheduledExam->id));

        $lobbyRes->assertStatus(200);
        $lobbyRes->assertSee('পরীক্ষা শুরু হতে বাকি');
        $lobbyRes->assertSee('নির্ধারিত লাইভ পরীক্ষা');
        $lobbyRes->assertSee('Locked Until Scheduled Start');

        // 5. Attempting to start the exam before start_time must be rejected
        $startRes = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $scheduledExam->id));

        $startRes->assertRedirect(route('student.quiz.lobby', $scheduledExam->id));
        $startRes->assertSessionHas('error');

        // 6. When exam start date arrives (start_time in the past)
        $scheduledExam->update([
            'start_time' => \Carbon\Carbon::now()->subMinutes(5),
        ]);
        $scheduledExam->refresh();

        $this->assertFalse($scheduledExam->isUpcoming());
        $this->assertTrue($scheduledExam->isLiveNow());
        $this->assertTrue($scheduledExam->canAttempt($this->student->id));

        // 7. Student can now start the exam
        $validStartRes = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $scheduledExam->id));

        $newAttempt = LmsQuizAttempt::where('quiz_id', $scheduledExam->id)
            ->where('student_account_id', $this->student->id)
            ->first();

        $this->assertNotNull($newAttempt);
        $validStartRes->assertRedirect(route('student.quiz.take', $newAttempt->id));

        // Clean up
        $newAttempt->delete();
        $q->options()->delete();
        $q->delete();
        $scheduledExam->delete();
    }
}
