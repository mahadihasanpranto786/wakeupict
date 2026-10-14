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
            'question_type' => 'true_false',
            'marks' => 10.00,
            'explanation' => 'RAM requires power to maintain its state.',
            'order_index' => 2,
            'is_active' => true,
        ]);

        $this->q2CorrectOpt = LmsQuestionOption::firstOrCreate([
            'question_id' => $this->q2->id,
            'option_text' => 'True',
        ], [
            'is_correct' => true,
            'order_index' => 1,
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
}
