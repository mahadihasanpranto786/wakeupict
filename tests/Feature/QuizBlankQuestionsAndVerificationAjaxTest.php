<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuizAttempt;
use App\model\LmsQuizAnswer;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class QuizBlankQuestionsAndVerificationAjaxTest extends TestCase
{
    protected $createdStudentIds = [];
    protected $createdQuizIds = [];
    protected $createdQuestionIds = [];
    protected $createdAttemptIds = [];
    protected $createdUserIds = [];

    protected function tearDown(): void
    {
        if (!empty($this->createdAttemptIds)) {
            LmsQuizAttempt::deleteWithRelated($this->createdAttemptIds);
        }
        if (!empty($this->createdQuestionIds)) {
            LmsQuestionOption::whereIn('question_id', $this->createdQuestionIds)->delete();
            LmsQuestion::whereIn('id', $this->createdQuestionIds)->delete();
        }
        if (!empty($this->createdQuizIds)) {
            LmsQuiz::whereIn('id', $this->createdQuizIds)->delete();
        }
        if (!empty($this->createdStudentIds)) {
            StudentAccount::whereIn('id', $this->createdStudentIds)->delete();
        }
        if (!empty($this->createdUserIds)) {
            User::whereIn('id', $this->createdUserIds)->delete();
        }

        parent::tearDown();
    }

    public function test_take_quiz_self_heals_empty_questions_snapshot_and_invalid_view_mode()
    {
        $student = StudentAccount::create([
            'name'     => 'Snapshot Heal Student',
            'phone'    => '01788' . rand(100000, 999999),
            'email'    => 'heal_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('password123'),
            'status'   => 1,
        ]);
        $this->createdStudentIds[] = $student->id;

        $quiz = LmsQuiz::create([
            'title'            => 'Group-A Test Exam ' . rand(100, 999),
            'quiz_type'        => 'exam',
            'duration_minutes' => 15,
            'total_marks'      => 2,
            'pass_marks'       => 1,
            'is_published'     => true,
            'view_mode'        => 'all_questions',
            'question_set'     => 'Set A',
        ]);
        $this->createdQuizIds[] = $quiz->id;

        for ($i = 1; $i <= 2; $i++) {
            $q = LmsQuestion::create([
                'quiz_id'       => $quiz->id,
                'question_text' => "Heal Test Question {$i}",
                'question_type' => 'mcq_single',
                'marks'         => 1,
                'is_active'     => true,
                'is_archived'   => false,
            ]);
            $this->createdQuestionIds[] = $q->id;

            LmsQuestionOption::create([
                'question_id' => $q->id,
                'option_text' => "Option A {$i}",
                'is_correct'  => true,
                'order_index' => 0,
            ]);
            LmsQuestionOption::create([
                'question_id' => $q->id,
                'option_text' => "Option B {$i}",
                'is_correct'  => false,
                'order_index' => 1,
            ]);
        }

        // Simulate an in-progress attempt that was created with an empty snapshot and non-standard view_mode
        $attempt = LmsQuizAttempt::create([
            'quiz_id'              => $quiz->id,
            'student_account_id'   => $student->id,
            'attempt_number'       => 1,
            'started_at'           => Carbon::now(),
            'total_marks'          => 2,
            'pass_marks'           => 1,
            'status'               => 'in_progress',
            'view_mode'            => 'student_choice',
            'question_set'         => 'Set A',
            'questions_snapshot'   => [],
            'flagged_question_ids' => [],
        ]);
        $this->createdAttemptIds[] = $attempt->id;

        $response = $this->actingAs($student, 'student')
            ->get(route('student.quiz.take', $attempt->id));

        $response->assertStatus(200);
        $response->assertSee('Heal Test Question 1');
        $response->assertSee('Heal Test Question 2');

        $attempt->refresh();
        $this->assertIsArray($attempt->questions_snapshot);
        $this->assertCount(2, $attempt->questions_snapshot);
    }

    public function test_registration_verifications_supports_ajax_live_search()
    {
        $admin = User::first();
        if (!$admin) {
            $admin = User::create([
                'name'        => 'Ajax Test Admin',
                'email'       => 'ajax_admin_' . rand(1000, 9999) . '@wakeupict.test',
                'password'    => Hash::make('password123'),
                'excess_type' => 1,
            ]);
            $this->createdUserIds[] = $admin->id;
        }

        $uniqueTag = 'AjaxSearchStudent' . rand(10000, 99999);
        $s1 = StudentAccount::create([
            'name'                => $uniqueTag . ' Alpha',
            'phone'               => '01777' . rand(100000, 999999),
            'registration_number' => 'REG-' . rand(100000, 999999),
            'registration_status' => 'pending',
            'status'              => 0,
            'password'            => Hash::make('123456'),
        ]);
        $s2 = StudentAccount::create([
            'name'                => 'OtherPerson' . rand(10000, 99999),
            'phone'               => '01766' . rand(100000, 999999),
            'registration_number' => 'REG-' . rand(100000, 999999),
            'registration_status' => 'approved',
            'status'              => 1,
            'password'            => Hash::make('123456'),
        ]);
        $this->createdStudentIds[] = $s1->id;
        $this->createdStudentIds[] = $s2->id;

        $response = $this->actingAs($admin)
            ->get(route('admin.registration.verifications', [
                'search' => $uniqueTag,
                'ajax'   => 1,
            ]), ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'total', 'html']);
        $payload = $response->json();
        $this->assertEquals('success', $payload['status']);
        $this->assertEquals(1, $payload['total']);
        $this->assertStringContainsString($s1->name, $payload['html']);
        $this->assertStringNotContainsString($s2->name, $payload['html']);
    }

    public function test_retake_breakdown_and_admin_live_exam_parent_child_diagram_render()
    {
        $admin = User::first();
        if (!$admin) {
            $admin = User::create([
                'name'        => 'Diagram Test Admin',
                'email'       => 'diag_admin_' . rand(1000, 9999) . '@wakeupict.test',
                'password'    => Hash::make('password123'),
                'excess_type' => 1,
            ]);
            $this->createdUserIds[] = $admin->id;
        }

        $student = StudentAccount::create([
            'name'     => 'Diagram Student ' . rand(1000, 9999),
            'phone'    => '01755' . rand(100000, 999999),
            'email'    => 'diag_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('password123'),
            'status'   => 1,
        ]);
        $this->createdStudentIds[] = $student->id;

        $exam = LmsQuiz::create([
            'title'            => 'Live Exam Diagram ' . rand(100, 999),
            'quiz_type'        => 'exam',
            'duration_minutes' => 15,
            'total_marks'      => 2,
            'pass_marks'       => 2,
            'is_published'     => true,
            'question_set'     => 'Set A',
        ]);
        $this->createdQuizIds[] = $exam->id;

        $q1 = LmsQuestion::create([
            'quiz_id'       => $exam->id,
            'question_text' => 'Diagram Q1',
            'question_type' => 'mcq_single',
            'marks'         => 1,
            'is_active'     => true,
        ]);
        $q2 = LmsQuestion::create([
            'quiz_id'       => $exam->id,
            'question_text' => 'Diagram Q2',
            'question_type' => 'mcq_single',
            'marks'         => 1,
            'is_active'     => true,
        ]);
        $this->createdQuestionIds[] = $q1->id;
        $this->createdQuestionIds[] = $q2->id;

        $parentAttempt = LmsQuizAttempt::create([
            'quiz_id'            => $exam->id,
            'student_account_id' => $student->id,
            'attempt_number'     => 1,
            'started_at'         => Carbon::now()->subMinutes(10),
            'submitted_at'       => Carbon::now()->subMinutes(8),
            'score'              => 1,
            'total_marks'        => 2,
            'pass_marks'         => 2,
            'percentage'         => 50,
            'status'             => 'graded',
            'questions_snapshot' => [['id' => $q1->id], ['id' => $q2->id]],
        ]);
        $this->createdAttemptIds[] = $parentAttempt->id;

        LmsQuizAnswer::create([
            'attempt_id'          => $parentAttempt->id,
            'question_id'         => $q1->id,
            'selected_option_ids' => json_encode([1]),
            'is_correct'          => true,
            'marks_obtained'      => 1,
        ]);
        LmsQuizAnswer::create([
            'attempt_id'          => $parentAttempt->id,
            'question_id'         => $q2->id,
            'selected_option_ids' => json_encode([2]),
            'is_correct'          => false,
            'marks_obtained'      => 0,
        ]);

        $childRetake = LmsQuizAttempt::create([
            'quiz_id'            => $exam->id,
            'student_account_id' => $student->id,
            'parent_attempt_id'  => $parentAttempt->id,
            'attempt_number'     => 2,
            'started_at'         => Carbon::now()->subMinutes(5),
            'submitted_at'       => Carbon::now()->subMinutes(2),
            'score'              => 2,
            'total_marks'        => 2,
            'pass_marks'         => 2,
            'percentage'         => 100,
            'status'             => 'graded',
            'questions_snapshot' => [['id' => $q1->id], ['id' => $q2->id]],
        ]);
        $this->createdAttemptIds[] = $childRetake->id;

        LmsQuizAnswer::create([
            'attempt_id'          => $childRetake->id,
            'question_id'         => $q1->id,
            'selected_option_ids' => json_encode([1]),
            'is_correct'          => true,
            'marks_obtained'      => 1,
        ]);
        LmsQuizAnswer::create([
            'attempt_id'          => $childRetake->id,
            'question_id'         => $q2->id,
            'selected_option_ids' => json_encode([3]),
            'is_correct'          => true,
            'marks_obtained'      => 1,
        ]);

        // 1. Student history should show retake breakdown (answered/correct/wrong/unanswered)
        $historyRes = $this->actingAs($student, 'student')
            ->get(route('student.exams.history'));
        $historyRes->assertStatus(200);
        $historyRes->assertSee('সঠিক: 2');
        $historyRes->assertSee('ভুল: 1');

        // 2. Admin reports should show Live Exam Diagram Card, Summary, and Parent-Child Retake Tree (student shown once)
        $reportRes = $this->actingAs($admin)
            ->get(route('admin.quizzes.reports', ['quiz_id' => $exam->id]));
        $reportRes->assertStatus(200);
        $reportRes->assertSee('live-exam-diagram-section');
        $reportRes->assertSee($exam->title);
        $reportRes->assertSee($student->name);
        $reportRes->assertSee('Exam Tree View');
        $reportRes->assertSee('Retake #1');
        $reportRes->assertSee('Fail ➔ Pass');
        $reportRes->assertSee('সঠিক: 2');

        // 3. Practice vs Live Exam separation in Admin Reports & Student History
        $practiceQuiz = LmsQuiz::create([
            'title'            => 'Practice Drill Separation ' . rand(100, 999),
            'quiz_type'        => 'practice',
            'duration_minutes' => 10,
            'total_marks'      => 1,
            'pass_marks'       => 1,
            'is_published'     => true,
        ]);
        $this->createdQuizIds[] = $practiceQuiz->id;

        $practiceAttempt = LmsQuizAttempt::create([
            'quiz_id'            => $practiceQuiz->id,
            'student_account_id' => $student->id,
            'attempt_number'     => 1,
            'started_at'         => Carbon::now()->subMinutes(4),
            'submitted_at'       => Carbon::now()->subMinutes(2),
            'score'              => 1,
            'total_marks'        => 1,
            'pass_marks'         => 1,
            'percentage'         => 100,
            'status'             => 'graded',
        ]);
        $this->createdAttemptIds[] = $practiceAttempt->id;

        // Admin: tab=practice shows practiceQuiz in User-Based Practice Tree (student shown once), not exam; tab=exams shows exam, not practiceQuiz
        $practiceAttempt2 = LmsQuizAttempt::create([
            'quiz_id'            => $practiceQuiz->id,
            'student_account_id' => $student->id,
            'attempt_number'     => 2,
            'started_at'         => Carbon::now()->subMinutes(2),
            'submitted_at'       => Carbon::now()->subMinute(),
            'score'              => 1,
            'total_marks'        => 1,
            'pass_marks'         => 1,
            'percentage'         => 100,
            'status'             => 'graded',
        ]);
        $this->createdAttemptIds[] = $practiceAttempt2->id;

        $adminPracticeRes = $this->actingAs($admin)
            ->get(route('admin.quizzes.reports', ['tab' => 'practice', 'search' => $student->phone]));
        $adminPracticeRes->assertStatus(200);
        $adminPracticeRes->assertSee('practice-user-tree-section');
        $adminPracticeRes->assertSee('মোট অনুশীলন: 2 বার');
        $adminPracticeRes->assertSee('প্র্যাকটিস #1 (মূল)');
        $adminPracticeRes->assertSee('প্র্যাকটিস #2');
        $adminPracticeRes->assertSee($practiceQuiz->title);
        $adminPracticeRes->assertDontSee($exam->title);

        // AJAX live search on reports
        $ajaxReportsRes = $this->actingAs($admin)
            ->get(route('admin.quizzes.reports', ['tab' => 'practice', 'search' => $student->phone, 'ajax' => 1]), [
                'X-Requested-With' => 'XMLHttpRequest',
            ]);
        $ajaxReportsRes->assertStatus(200);
        $ajaxPayload = $ajaxReportsRes->json();
        $this->assertEquals('success', $ajaxPayload['status']);
        $this->assertStringContainsString($student->name, $ajaxPayload['html']);

        // Student Full Result Tree route
        $studentTreeRes = $this->actingAs($admin)
            ->get(route('admin.quizzes.reports.student-tree', $student->id));
        $studentTreeRes->assertStatus(200);
        $studentTreeRes->assertSee($student->name);
        $studentTreeRes->assertSee($exam->title);
        $studentTreeRes->assertSee($practiceQuiz->title);

        $adminExamsRes = $this->actingAs($admin)
            ->get(route('admin.quizzes.reports', ['tab' => 'exams', 'search' => $student->phone]));
        $adminExamsRes->assertStatus(200);
        $adminExamsRes->assertSee($exam->title);
        $adminExamsRes->assertDontSee($practiceQuiz->title);

        // Student: type=practice shows practiceQuiz, not exam; type=exam shows exam, not practiceQuiz
        $studentPracticeRes = $this->actingAs($student, 'student')
            ->get(route('student.exams.history', ['type' => 'practice']));
        $studentPracticeRes->assertStatus(200);
        $studentPracticeRes->assertSee($practiceQuiz->title);
        $studentPracticeRes->assertDontSee($exam->title);

        $studentExamRes = $this->actingAs($student, 'student')
            ->get(route('student.exams.history', ['type' => 'exam']));
        $studentExamRes->assertStatus(200);
        $studentExamRes->assertSee($exam->title);
        $studentExamRes->assertDontSee($practiceQuiz->title);
    }
}
