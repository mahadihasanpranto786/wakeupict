<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuiz;
use App\model\LmsQuizAttempt;
use App\model\LmsStudentQuestionHistory;
use App\Services\PracticeQuestionRotationService;
use App\User;
use Illuminate\Support\Facades\Hash;

class PracticeQuestionRotationSystemTest extends TestCase
{
    protected $student;
    protected $testQuestions = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = StudentAccount::create([
            'name'     => 'Rotation Test Student',
            'phone'    => '01799' . rand(100000, 999999),
            'email'    => 'rot_student_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('password123'),
            'status'   => 1,
        ]);

        // Create a specific isolated category with 5 questions for predictable testing
        $category = 'UnitTestCategory_' . rand(1000, 9999);
        for ($i = 1; $i <= 5; $i++) {
            $q = LmsQuestion::create([
                'question_text' => "Unit Test Rotation Question {$i} ({$category})",
                'question_type' => 'mcq_single',
                'category'      => $category,
                'difficulty'    => 'medium',
                'marks'         => 1.00,
                'is_active'     => true,
                'is_archived'   => false,
            ]);

            for ($opt = 1; $opt <= 4; $opt++) {
                LmsQuestionOption::create([
                    'question_id' => $q->id,
                    'option_text' => "Option {$opt} for {$q->id}",
                    'is_correct'  => ($opt === 1),
                    'order_index' => $opt,
                ]);
            }

            $this->testQuestions[] = $q;
        }
    }

    protected function tearDown(): void
    {
        if ($this->student) {
            LmsStudentQuestionHistory::where('student_account_id', $this->student->id)->delete();
            $attemptIds = LmsQuizAttempt::where('student_account_id', $this->student->id)->pluck('id');
            LmsQuizAttempt::whereIn('id', $attemptIds)->delete();
            $this->student->delete();
        }

        foreach ($this->testQuestions as $q) {
            LmsQuestionOption::where('question_id', $q->id)->delete();
            $q->delete();
        }

        parent::tearDown();
    }

    /**
     * Test practice dashboard view & HUD metrics
     */
    public function testPracticeDashboardRendersHUDMetricsAndCategories()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.practice.index'));

        $response->assertStatus(200);
        $response->assertSee('স্মার্ট প্রশ্ন ব্যাংক প্র্যাকটিস ও রোটেশন');
        $response->assertSee('মোট প্রশ্ন');
        $response->assertSee('অনুশীলনকৃত');
        $response->assertSee('অবশিষ্ট প্রশ্ন');
        $response->assertSee('পরীক্ষা সম্পন্ন');
    }

    /**
     * Test starting practice exam creates attempt, snapshots questions and records history
     */
    public function testStartPracticeExamCreatesAttemptAndRecordsHistory()
    {
        $category = $this->testQuestions[0]->category;

        $response = $this->actingAs($this->student, 'student')
            ->post(route('student.practice.start'), [
                'category'       => $category,
                'question_count' => 3,
                'view_mode'      => 'all_questions',
            ]);

        $attempt = LmsQuizAttempt::where('student_account_id', $this->student->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($attempt);
        $response->assertRedirect(route('student.quiz.take', $attempt->id));
        $this->assertEquals(3, $attempt->total_questions);

        // Check history records
        $histories = LmsStudentQuestionHistory::where('student_account_id', $this->student->id)
            ->where('attempt_id', $attempt->id)
            ->get();

        $this->assertCount(3, $histories);
        $this->assertEquals(1, $histories->first()->rotation_cycle);
    }

    /**
     * Test automatic rotation selects fresh questions without repeating until exhausted
     */
    public function testAutomaticRotationSelectsUnseenQuestionsFirst()
    {
        $category = $this->testQuestions[0]->category;
        $service = app(PracticeQuestionRotationService::class);

        // Batch 1: Select 3 questions
        $batch1 = $service->selectQuestionsForNewAttempt($this->student->id, $category, 3);
        $q1Ids = $batch1['questions']->pluck('id')->all();
        $this->assertCount(3, $q1Ids);

        $attempt1 = new LmsQuizAttempt(['student_account_id' => $this->student->id]);
        $attempt1->id = 8888801;
        $service->recordAttemptQuestions($attempt1, $batch1['questions'], $this->student->id, $batch1['cycle']);

        // Batch 2: Select next 2 questions from the 5 total
        $batch2 = $service->selectQuestionsForNewAttempt($this->student->id, $category, 2);
        $q2Ids = $batch2['questions']->pluck('id')->all();
        $this->assertCount(2, $q2Ids);

        // Overlap must be ZERO
        $overlap = array_intersect($q1Ids, $q2Ids);
        $this->assertEmpty($overlap, 'No questions should repeat while unseen questions exist.');
    }

    /**
     * Test rotation cycle rollover when all questions in pool are exhausted
     */
    public function testCycleRolloverOccursWhenAllQuestionsAreCovered()
    {
        $category = $this->testQuestions[0]->category;
        $service = app(PracticeQuestionRotationService::class);

        // Record all 5 questions as attempted in cycle 1
        $attempt1 = new LmsQuizAttempt(['student_account_id' => $this->student->id]);
        $attempt1->id = 8888802;
        $service->recordAttemptQuestions($attempt1, collect($this->testQuestions), $this->student->id, 1);

        // Progress check
        $progress = $service->getStudentProgress($this->student->id, $category);
        $this->assertEquals(2, $progress['current_cycle']);
        $this->assertEquals(0, $progress['attempted_questions']);
        $this->assertEquals(5, $progress['remaining_questions']);

        // Next selection should be cycle 2
        $nextBatch = $service->selectQuestionsForNewAttempt($this->student->id, $category, 3);
        $this->assertEquals(2, $nextBatch['cycle']);
        $this->assertTrue($nextBatch['is_new_cycle']);
        $this->assertCount(3, $nextBatch['questions']);
    }

    /**
     * Test non-MCQ questions (fill_blanks, short_answer) and questions without options are strictly excluded
     */
    public function testNonMcqQuestionsAreExcludedFromPracticeAndStudentExams()
    {
        $category = $this->testQuestions[0]->category;

        // Add non-MCQ questions to the same category
        $fillBlank = LmsQuestion::create([
            'question_text' => 'Non-MCQ Fill blank question',
            'question_type' => 'fill_blanks',
            'category'      => $category,
            'is_active'     => true,
            'is_archived'   => false,
        ]);
        $shortAns = LmsQuestion::create([
            'question_text' => 'Non-MCQ Short answer question',
            'question_type' => 'short_answer',
            'category'      => $category,
            'is_active'     => true,
            'is_archived'   => false,
        ]);
        $mcqNoOptions = LmsQuestion::create([
            'question_text' => 'MCQ without options question',
            'question_type' => 'mcq_single',
            'category'      => $category,
            'is_active'     => true,
            'is_archived'   => false,
        ]);

        $service = app(PracticeQuestionRotationService::class);
        $progress = $service->getStudentProgress($this->student->id, $category);

        // Progress total questions must only count MCQs with options (5 original)
        $this->assertEquals(5, $progress['total_questions']);

        // Selection must only pick MCQs with options
        $selection = $service->selectQuestionsForNewAttempt($this->student->id, $category, 10);
        $selectedIds = $selection['questions']->pluck('id')->all();

        $this->assertNotContains($fillBlank->id, $selectedIds);
        $this->assertNotContains($shortAns->id, $selectedIds);
        $this->assertNotContains($mcqNoOptions->id, $selectedIds);

        foreach ($selection['questions'] as $q) {
            $this->assertContains($q->question_type, ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice']);
            $this->assertGreaterThanOrEqual(2, $q->options->count(), 'Every question selected for exam must have at least 2 options');
        }

        // Clean up
        $fillBlank->delete();
        $shortAns->delete();
        $mcqNoOptions->delete();
    }

    /**
     * Test admin can update practice exam configuration and settings persist
     */
    public function testAdminCanUpdatePracticeSettingsAndPersistConfig()
    {
        $admin = User::first() ?: User::create([
            'name'     => 'Practice Admin',
            'email'    => 'admin_practice_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->actingAs($admin)
            ->post(route('admin.quizzes.practice-settings.update'), [
                'question_count'     => 25,
                'duration_minutes'   => 30,
                'view_mode'          => 'one_by_one',
                'attempt_limit_type' => 'single',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $settings = PracticeQuestionRotationService::getSettings();
        $this->assertEquals(25, $settings['question_count']);
        $this->assertEquals(30, $settings['duration_minutes']);
        $this->assertEquals('one_by_one', $settings['view_mode']);
        $this->assertEquals('single', $settings['attempt_limit_type']);
        $this->assertEquals(1, $settings['max_attempts']);

        // Check Admin Quizzes page shows configured values
        $indexRes = $this->actingAs($admin)->get(route('admin.quizzes.index'));
        $indexRes->assertStatus(200);
        $indexRes->assertSee('25 টি');
        $indexRes->assertSee('30 মিনিট');
        $indexRes->assertSee('একটি করে প্রশ্ন (Focus Mode)');
        $indexRes->assertSee('একক পরীক্ষা (Single Attempt)');
    }

    /**
     * Test single attempt policy strictly blocks second attempt by student
     */
    public function testSingleAttemptPolicyBlocksSecondAttempt()
    {
        // 1. Set to single attempt
        PracticeQuestionRotationService::saveSettings([
            'question_count'     => 20,
            'duration_minutes'   => 20,
            'view_mode'          => 'all_questions',
            'attempt_limit_type' => 'single',
            'max_attempts'       => 1,
        ]);

        // 2. Student completes 1 attempt
        $quiz = app(PracticeQuestionRotationService::class)->getOrCreatePracticeQuiz();
        LmsQuizAttempt::create([
            'quiz_id'            => $quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number'     => 1,
            'started_at'         => now()->subMinutes(15),
            'submitted_at'       => now(),
            'status'             => 'submitted',
            'score'              => 15,
            'total_marks'        => 20,
        ]);

        // 3. Student visits practice index -> Should see limit reached notice
        $pageRes = $this->actingAs($this->student, 'student')
            ->get(route('student.practice.index'));
        $pageRes->assertStatus(200);
        $pageRes->assertSee('অনুশীলন পরীক্ষার নির্ধারিত সীমা সম্পন্ন হয়েছে');
        $pageRes->assertSee('একক পরীক্ষা (Single Attempt — ১ বার)');

        // 4. Student tries to start a 2nd practice exam -> Must be blocked and redirected
        $startRes = $this->actingAs($this->student, 'student')
            ->post(route('student.practice.start'), []);

        $startRes->assertRedirect(route('student.practice.index'));
        $startRes->assertSessionHas('error');

        // Reset to unlimited for test purity
        PracticeQuestionRotationService::saveSettings([
            'question_count'     => 20,
            'duration_minutes'   => 20,
            'view_mode'          => 'all_questions',
            'attempt_limit_type' => 'unlimited',
            'max_attempts'       => 0,
        ]);
    }

    /**
     * Test admin configured layout view_mode is enforced on created practice attempt
     */
    public function testAdminConfiguredViewModeEnforcedOnExamAttempt()
    {
        PracticeQuestionRotationService::saveSettings([
            'question_count'     => 20,
            'duration_minutes'   => 20,
            'view_mode'          => 'one_by_one',
            'attempt_limit_type' => 'unlimited',
            'max_attempts'       => 0,
        ]);

        $response = $this->actingAs($this->student, 'student')
            ->post(route('student.practice.start'), [
                'question_count' => 2,
            ]);

        $attempt = LmsQuizAttempt::where('student_account_id', $this->student->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($attempt);
        $this->assertEquals('one_by_one', $attempt->view_mode);

        // Reset settings
        PracticeQuestionRotationService::saveSettings([
            'question_count'     => 20,
            'duration_minutes'   => 20,
            'view_mode'          => 'all_questions',
            'attempt_limit_type' => 'unlimited',
            'max_attempts'       => 0,
        ]);
    }

    /**
     * Test admin can configure multiple tiers and interface layout is hidden from student when locked
     */
    public function testAdminCanConfigureMultipleTiersAndInterfaceModeHiddenFromStudent()
    {
        $admin = User::first() ?: User::create([
            'name'     => 'Tier Admin',
            'email'    => 'admin_tier_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->actingAs($admin)
            ->post(route('admin.quizzes.practice-settings.update'), [
                'tier_questions'        => [10, 25, 50],
                'tier_durations'        => [10, 25, 45],
                'tier_labels'           => ['10 টি প্রশ্ন (10 মিনিট)', '25 টি প্রশ্ন (25 মিনিট)', '50 টি প্রশ্ন (45 মিনিট)'],
                'view_mode'             => 'all_questions', // Locked by admin
                'attempt_limit_type'    => 'unlimited',
                'allow_category_choice' => 1,
            ]);

        $response->assertRedirect();
        $settings = PracticeQuestionRotationService::getSettings();
        $this->assertCount(3, $settings['tiers']);
        $this->assertEquals(25, $settings['tiers'][1]['questions']);
        $this->assertEquals(25, $settings['tiers'][1]['duration']);

        // When view_mode is locked ('all_questions'), student practice page must NOT show interface mode selector
        $studentRes = $this->actingAs($this->student, 'student')
            ->get(route('student.practice.index'));
        $studentRes->assertStatus(200);
        $studentRes->assertDontSee('৩. ইন্টারফেস মোড');
        $studentRes->assertSee('25 টি প্রশ্ন (25 মিনিট)');

        // Now set view_mode to student_choice -> Must be visible
        $this->actingAs($admin)
            ->post(route('admin.quizzes.practice-settings.update'), [
                'tier_questions'        => [10, 25],
                'tier_durations'        => [10, 25],
                'tier_labels'           => ['10 টি প্রশ্ন (10 মিনিট)', '25 টি প্রশ্ন (25 মিনিট)'],
                'view_mode'             => 'student_choice',
                'attempt_limit_type'    => 'unlimited',
            ]);

        $studentResChoice = $this->actingAs($this->student, 'student')
            ->get(route('student.practice.index'));
        $studentResChoice->assertStatus(200);
        $studentResChoice->assertSee('৩. ইন্টারফেস মোড');

        // Reset settings back to locked all_questions
        PracticeQuestionRotationService::saveSettings([
            'view_mode'          => 'all_questions',
            'attempt_limit_type' => 'unlimited',
            'max_attempts'       => 0,
            'tiers'              => PracticeQuestionRotationService::getDefaultTiers(),
        ]);
    }

    /**
     * Test configuring mark per question & pass percentage and grading from snapshot
     */
    public function testMarkPerQuestionAndGradingFromSnapshot()
    {
        $admin = User::first() ?: factory(User::class)->create();

        // 1. Admin saves custom mark per question = 2.0 and pass percentage = 50%
        $this->actingAs($admin)
            ->post(route('admin.quizzes.practice-settings.update'), [
                'tier_questions'        => [10],
                'tier_durations'        => [10],
                'tier_pass_marks'       => [4],
                'tier_labels'           => ['১০ টি প্রশ্ন (১০ মিনিট — পাস: ৪)'],
                'view_mode'             => 'all_questions',
                'attempt_limit_type'    => 'unlimited',
                'mark_per_question'     => 2.0,
            ]);

        $settings = PracticeQuestionRotationService::getSettings();
        $this->assertEquals(2.0, $settings['mark_per_question']);
        $this->assertEquals(4.0, $settings['tiers'][0]['pass_marks']);

        // 2. Student starts rotated practice exam
        $startRes = $this->actingAs($this->student, 'student')
            ->post(route('student.practice.start'), [
                'category'       => $this->testQuestions[0]->category,
                'question_count' => 2,
            ]);

        $attempt = LmsQuizAttempt::where('student_account_id', $this->student->id)
            ->orderBy('id', 'desc')
            ->first();

        $this->assertNotNull($attempt);
        $this->assertEquals(4.0, $attempt->total_marks); // 2 questions * 2.0 marks = 4.0

        // 3. Save correct answer for first question in attempt snapshot
        $firstQId = $attempt->questions_snapshot[0]['id'];
        $q1 = LmsQuestion::with('options')->find($firstQId);
        $correctOpt = $q1->options->firstWhere('is_correct', true);

        $this->actingAs($this->student, 'student')
            ->postJson(route('student.quiz.save-answer', $attempt->id), [
                'question_id' => $q1->id,
                'selected_option_ids' => [$correctOpt->id],
                'action' => 'save',
            ]);

        // Submit quiz
        $submitRes = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.submit', $attempt->id));
        $submitRes->assertRedirect(route('student.quiz.results', $attempt->id));

        $attempt->refresh();
        $this->assertEquals('graded', $attempt->status);
        $this->assertEquals(2.0, $attempt->score); // 1 correct = 2.0 marks
        $this->assertEquals(50.0, $attempt->percentage);
        $this->assertTrue($attempt->isPassed()); // 2.0 >= 2.0 (50% of 4.0)

        // Result view check
        $resPage = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.results', $attempt->id));
        $resPage->assertStatus(200);
        $resPage->assertSee('পূর্ণমান (Total Marks):');
        $resPage->assertSee('পাস মার্ক (Pass Mark):');

        // Cleanup
        PracticeQuestionRotationService::saveSettings([
            'mark_per_question' => 1.0,
            'pass_percentage'   => 40.0,
        ]);
    }

    /**
     * Test that sidebar menu remains active when navigating into detail pages (e.g. taking exam, results)
     */
    public function testSidebarMenuItemActiveOnDetailPages()
    {
        // 1. Visit practice index
        $resPractice = $this->actingAs($this->student, 'student')
            ->get(route('student.practice.index'));
        $resPractice->assertStatus(200);
        $resPractice->assertSee('অনুশীলন পরীক্ষা');

        // 2. Start a practice exam to generate an attempt
        $category = $this->testQuestions[0]->category;
        $startRes = $this->actingAs($this->student, 'student')
            ->post(route('student.practice.start'), [
                'category'       => $category,
                'question_count' => 2,
            ]);

        $attempt = LmsQuizAttempt::where('student_account_id', $this->student->id)
            ->orderBy('id', 'desc')
            ->first();

        $this->assertNotNull($attempt);
        $this->assertEquals('practice', $attempt->quiz->quiz_type);

        // 3. Visit the live exam room (detail page of practice exam)
        $resTake = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.take', $attempt->id));
        $resTake->assertStatus(200);

        // Check that practice_tests menu item has the active styling
        $practiceMenu = \App\model\StudentPanelMenu::where('menu_key', 'practice_tests')->first();
        if ($practiceMenu) {
            $this->assertTrue($practiceMenu->isCurrent());
        }

        // 4. Submit and visit results page (detail page of completed practice exam)
        $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.submit', $attempt->id));

        $resResults = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.results', $attempt->id));
        $resResults->assertStatus(200);

        if ($practiceMenu) {
            $this->assertTrue($practiceMenu->isCurrent());
        }

        // 5. Test regular online quiz route distinction
        $onlineMenu = \App\model\StudentPanelMenu::where('menu_key', 'online_quiz')->first();
        $regularQuiz = LmsQuiz::create([
            'title'            => 'Regular Quiz Test',
            'quiz_type'        => 'regular',
            'duration_minutes' => 15,
            'is_published'     => true,
        ]);

        $resLobby = $this->actingAs($this->student, 'student')
            ->get(route('student.quiz.lobby', $regularQuiz->id));
        $resLobby->assertStatus(200);

        if ($onlineMenu && $practiceMenu) {
            $this->assertTrue($onlineMenu->isCurrent());
            $this->assertFalse($practiceMenu->isCurrent());
        }
    }

    /**
     * Test selecting 30 questions generates an attempt with exactly 30 questions
     */
    public function testSelectingThirtyQuestionsCreatesThirtyQuestionAttempt()
    {
        $cat30 = 'Category30Test_' . rand(1000, 9999);
        for ($i = 1; $i <= 35; $i++) {
            $q = LmsQuestion::create([
                'question_text' => "Question {$i} for 30 count test ({$cat30})",
                'question_type' => 'mcq_single',
                'category'      => $cat30,
                'is_active'     => true,
                'is_archived'   => false,
            ]);
            for ($opt = 1; $opt <= 4; $opt++) {
                LmsQuestionOption::create([
                    'question_id' => $q->id,
                    'option_text' => "Opt {$opt} of {$q->id}",
                    'is_correct'  => ($opt === 1),
                ]);
            }
        }

        // Configure tier with 30 questions
        PracticeQuestionRotationService::saveSettings([
            'tiers' => [
                ['questions' => 10, 'duration' => 10, 'pass_marks' => 4, 'label' => '10 টি প্রশ্ন'],
                ['questions' => 20, 'duration' => 20, 'pass_marks' => 8, 'label' => '20 টি প্রশ্ন'],
                ['questions' => 30, 'duration' => 30, 'pass_marks' => 12, 'label' => '30 টি প্রশ্ন (30 মিনিট — পাস: 12)'],
            ],
            'attempt_limit_type'    => 'unlimited',
            'allow_category_choice' => 1,
        ]);

        // Student submits form with question_count = 30
        $res = $this->actingAs($this->student, 'student')
            ->post(route('student.practice.start'), [
                'category'       => $cat30,
                'question_count' => 30,
            ]);

        $attempt = LmsQuizAttempt::where('student_account_id', $this->student->id)
            ->orderBy('id', 'desc')
            ->first();

        $this->assertNotNull($attempt);
        $this->assertEquals(30, count($attempt->questions_snapshot));
        $this->assertEquals(30, $attempt->total_marks);
    }
}
