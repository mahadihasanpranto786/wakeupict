<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\model\Course;
use App\model\StudentAccount;
use App\model\LmsCertificate;
use App\model\LmsEnrollment;
use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\Services\QuizExcelImportService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class AdminCertificateAndQuizImportTest extends TestCase
{
    protected $adminUser;
    protected $student;
    protected $course;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::first() ?: User::create([
            'name' => 'Admin Test User',
            'email' => 'admin_lms_test_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
        ]);

        $this->course = Course::where('status', 1)->first() ?: Course::create([
            'course_title' => 'Web Development Offline Lab',
            'course_slug' => 'web-dev-lab-' . rand(100, 999),
            'time_line' => '3 Months',
            'price' => 6000,
            'short_description' => 'Hands-on offline campus web programming lab.',
            'status' => 1,
        ]);

        $this->student = StudentAccount::where('status', 1)->first() ?: StudentAccount::create([
            'name' => 'Campus Student ' . rand(100, 999),
            'phone' => '017' . rand(10000000, 99999999),
            'password' => Hash::make('password123'),
            'status' => 1,
        ]);
    }

    /**
     * Unauthenticated user cannot access admin certificate or quiz routes
     */
    public function test_unauthenticated_user_cannot_access_admin_lms()
    {
        $res1 = $this->get(route('admin.certificates.index'));
        $res1->assertRedirect(route('login'));

        $res2 = $this->get(route('admin.quizzes.index'));
        $res2->assertRedirect(route('login'));
    }

    /**
     * Admin can view certificate management center
     */
    public function test_admin_can_view_certificate_management_center()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.certificates.index'));

        $response->assertStatus(200);
        $response->assertSee('সার্টিফিকেট ম্যানেজমেন্ট ও প্রকাশনা');
        $response->assertSee('নতুন সার্টিফিকেট ইস্যু / প্রকাশ করুন');
    }

    /**
     * Admin can issue and publish a certificate
     */
    public function test_admin_can_issue_and_publish_certificate()
    {
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.certificates.store'), [
                'student_account_id' => $this->student->id,
                'course_id'          => $this->course->id,
                'title'              => 'Certificate of Offline Lab Excellence',
                'grade'              => 'A+',
                'score_percentage'   => 96.5,
                'issue_date'         => Carbon::today()->format('Y-m-d'),
                'status'             => 'issued',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('lms_certificates', [
            'student_account_id' => $this->student->id,
            'course_id'          => $this->course->id,
            'grade'              => 'A+',
            'status'             => 'issued',
        ]);
    }

    /**
     * Admin can toggle certificate publication status
     */
    public function test_admin_can_toggle_certificate_publishing_status()
    {
        $cert = LmsCertificate::create([
            'student_account_id' => $this->student->id,
            'course_id'          => $this->course->id,
            'certificate_code'   => LmsCertificate::generateCertificateCode(),
            'title'              => 'Test Certificate',
            'grade'              => 'A',
            'score_percentage'   => 90.0,
            'issue_date'         => Carbon::today(),
            'status'             => 'issued',
            'verification_hash'  => LmsCertificate::generateVerificationHash(),
        ]);

        // Toggle from issued to pending
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.certificates.toggle', $cert->id));

        $response->assertRedirect();
        $cert->refresh();
        $this->assertEquals('pending', $cert->status);

        // Toggle back from pending to issued
        $response2 = $this->actingAs($this->adminUser)
            ->post(route('admin.certificates.toggle', $cert->id));

        $response2->assertRedirect();
        $cert->refresh();
        $this->assertEquals('issued', $cert->status);
    }

    /**
     * Student only sees certificates when status = 'issued' by admin
     */
    public function test_student_only_sees_certificate_when_published_by_admin()
    {
        $isolatedStudent = StudentAccount::create([
            'name' => 'Isolated Test Student ' . rand(1000, 9999),
            'student_id_code' => 'WUICT-' . rand(10000, 99999) . '-' . time(),
            'phone' => '018' . rand(10000000, 99999999),
            'password' => Hash::make('password123'),
            'status' => 1,
        ]);

        $isolatedCourse = $this->course;

        // 1. Ensure student is enrolled with active status
        LmsEnrollment::create([
            'student_account_id' => $isolatedStudent->id,
            'course_id'          => $isolatedCourse->id,
            'status'             => 'active',
            'enrollment_type'    => 'regular',
        ]);

        $certCode = LmsCertificate::generateCertificateCode();

        // Create a PENDING certificate (Admin hasn't published it yet)
        $cert = LmsCertificate::create([
            'student_account_id' => $isolatedStudent->id,
            'course_id'          => $isolatedCourse->id,
            'certificate_code'   => $certCode,
            'title'              => 'Pending Campus Certificate',
            'grade'              => 'A',
            'score_percentage'   => 88.0,
            'issue_date'         => Carbon::today(),
            'status'             => 'pending',
            'verification_hash'  => LmsCertificate::generateVerificationHash(),
        ]);

        // Act as student
        $studentResponse = $this->actingAs($isolatedStudent, 'student')
            ->get(route('student.certificates.index'));

        $studentResponse->assertStatus(200);
        // Should NOT see the certificate code in the issued gallery
        $studentResponse->assertDontSee($certCode);
        // Should see that admin evaluation is pending / in progress
        $studentResponse->assertSee('অ্যাডমিন রিভিউ ও অনুমোদনাধীন');

        // 2. Now Admin PUBLISHES the certificate
        $cert->update(['status' => 'issued']);

        $studentResponsePublished = $this->actingAs($isolatedStudent, 'student')
            ->get(route('student.certificates.index'));

        $studentResponsePublished->assertStatus(200);
        $studentResponsePublished->assertSee($certCode);
        $studentResponsePublished->assertSee('সার্টিফিকেট প্রকাশিত');
    }

    /**
     * Admin can download sample CSV quiz template
     */
    public function test_admin_can_download_sample_excel_quiz_template()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.quizzes.sample'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('question_text', $response->getContent());
        $this->assertStringContainsString('option_a', $response->getContent());
        $this->assertStringContainsString('correct_option', $response->getContent());
    }

    /**
     * Admin can import quiz questions from CSV file
     */
    public function test_admin_can_import_quiz_questions_from_csv()
    {
        $quiz = LmsQuiz::create([
            'course_id'         => $this->course->id,
            'title'             => 'Sample Offline Lab Quiz ' . rand(100, 999),
            'quiz_type'         => 'practice',
            'duration_minutes'  => 15,
            'total_marks'       => 0,
            'pass_marks'        => 5.0,
            'is_published'      => true,
        ]);

        $csvData = "question_text,option_a,option_b,option_c,option_d,correct_option,marks,explanation\n";
        $csvData .= "\"What is CPU?\",\"Central Processing Unit\",\"Computer Personal Unit\",\"Central Public Unit\",\"Control Processing Unit\",\"A\",\"2\",\"Central processing unit executes instructions.\"\n";
        $csvData .= "\"Which tag is used for image in HTML?\",\"<picture>\",\"<img>\",\"<image>\",\"<src>\",\"B\",\"1.5\",\"The <img> tag embeds images in HTML.\"\n";

        $tempPath = tempnam(sys_get_temp_dir(), 'quiz_') . '.csv';
        file_put_contents($tempPath, $csvData);

        $uploadedFile = new UploadedFile(
            $tempPath,
            'quiz_test.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.quizzes.import'), [
                'quiz_id'    => $quiz->id,
                'excel_file' => $uploadedFile,
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Verify questions created in DB
        $this->assertDatabaseHas('lms_questions', [
            'quiz_id'       => $quiz->id,
            'question_text' => 'What is CPU?',
            'marks'         => 2.0,
        ]);

        $this->assertDatabaseHas('lms_questions', [
            'quiz_id'       => $quiz->id,
            'question_text' => 'Which tag is used for image in HTML?',
            'marks'         => 1.5,
        ]);

        // Verify options created
        $this->assertDatabaseHas('lms_question_options', [
            'option_text' => 'Central Processing Unit',
            'is_correct'  => 1,
        ]);

        $quiz->refresh();
        $this->assertEquals(3.5, $quiz->total_marks);

        @unlink($tempPath);
    }

    /**
     * Admin can toggle quiz published status
     */
    public function test_admin_can_toggle_quiz_publish()
    {
        $quiz = LmsQuiz::create([
            'course_id'         => $this->course->id,
            'title'             => 'Toggle Test Quiz',
            'quiz_type'         => 'practice',
            'duration_minutes'  => 15,
            'total_marks'       => 10,
            'pass_marks'        => 5.0,
            'is_published'      => true,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.quizzes.toggle', $quiz->id));

        $response->assertRedirect();
        $quiz->refresh();
        $this->assertFalse((bool)$quiz->is_published);
    }

    /**
     * Admin can set retake max attempts and shuffling, and student retakes get randomized sequences
     */
    public function test_quiz_retake_limit_and_shuffling_on_retake()
    {
        $quiz = LmsQuiz::create([
            'course_id'         => $this->course->id,
            'title'             => 'Retake & Shuffling Test Quiz',
            'quiz_type'         => 'practice',
            'duration_minutes'  => 15,
            'total_marks'       => 2,
            'pass_marks'        => 1.0,
            'max_attempts'      => 2,
            'shuffle_questions' => true,
            'shuffle_options'   => true,
            'is_published'      => true,
        ]);

        $q1 = LmsQuestion::create([
            'course_id' => $this->course->id,
            'quiz_id' => $quiz->id,
            'question_text' => 'Alpha Question 1?',
            'question_type' => 'mcq_single',
            'marks' => 1.0,
            'is_active' => true,
            'order_index' => 1,
        ]);
        $q1->options()->create(['option_text' => 'A1', 'is_correct' => true, 'order_index' => 1]);
        $q1->options()->create(['option_text' => 'B1', 'is_correct' => false, 'order_index' => 2]);

        $q2 = LmsQuestion::create([
            'course_id' => $this->course->id,
            'quiz_id' => $quiz->id,
            'question_text' => 'Beta Question 2?',
            'question_type' => 'mcq_single',
            'marks' => 1.0,
            'is_active' => true,
            'order_index' => 2,
        ]);
        $q2->options()->create(['option_text' => 'A2', 'is_correct' => true, 'order_index' => 1]);
        $q2->options()->create(['option_text' => 'B2', 'is_correct' => false, 'order_index' => 2]);

        // Verify Admin update endpoint updates max_attempts and shuffling
        $updateRes = $this->actingAs($this->adminUser)
            ->put(route('admin.quizzes.update', $quiz->id), [
                'course_id' => $this->course->id,
                'title' => 'Updated Retake Quiz Title',
                'quiz_type' => 'exam',
                'duration_minutes' => 25,
                'pass_marks' => 2.0,
                'max_attempts' => 2,
                'shuffle_questions' => 1,
                'shuffle_options' => 1,
            ]);
        $updateRes->assertRedirect();
        $quiz->refresh();
        $this->assertEquals(2, $quiz->max_attempts);
        $this->assertTrue((bool)$quiz->shuffle_questions);
        $this->assertTrue((bool)$quiz->shuffle_options);
        $this->assertEquals('Updated Retake Quiz Title', $quiz->title);

        // Student can attempt initially (attempt 1)
        $this->assertTrue($quiz->canAttempt($this->student->id));

        // Start Attempt 1
        $startRes1 = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $quiz->id));
        $startRes1->assertRedirect();
        $att1 = \App\model\LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $this->student->id)
            ->first();
        $this->assertNotNull($att1);
        $this->assertEquals(1, $att1->attempt_number);
        $this->assertNotEmpty($att1->questions_snapshot);

        // Submit attempt 1
        $att1->status = 'graded';
        $att1->save();

        // Student can take attempt 2 (retake 1) since max_attempts is 2
        $this->assertTrue($quiz->canAttempt($this->student->id));

        // Start Attempt 2 (Retake)
        $startRes2 = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $quiz->id));
        $startRes2->assertRedirect();
        $att2 = \App\model\LmsQuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_account_id', $this->student->id)
            ->where('attempt_number', 2)
            ->first();
        $this->assertNotNull($att2);
        $this->assertEquals(2, $att2->attempt_number);
        $this->assertNotEmpty($att2->questions_snapshot);

        // Submit attempt 2
        $att2->status = 'graded';
        $att2->save();

        // Now student has used all 2 attempts; canAttempt should be false!
        $this->assertFalse($quiz->canAttempt($this->student->id));

        // If student tries to start again, should be redirected with error
        $blockedRes = $this->actingAs($this->student, 'student')
            ->post(route('student.quiz.start', $quiz->id));
        $blockedRes->assertRedirect(route('student.quiz.lobby', $quiz->id));
        $blockedRes->assertSessionHas('error');
    }

    /**
     * Admin can delete student quiz results individually and in bulk
     */
    public function test_admin_can_delete_single_and_multiple_quiz_results()
    {
        $quiz = LmsQuiz::create([
            'course_id'        => $this->course->id,
            'title'            => 'Results Deletion Test Quiz',
            'quiz_type'        => 'exam',
            'duration_minutes' => 20,
            'total_marks'      => 10,
            'pass_marks'       => 5,
            'is_published'     => true,
        ]);

        // Create 3 attempts
        $att1 = \App\model\LmsQuizAttempt::create([
            'quiz_id'            => $quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number'     => 1,
            'score'              => 8,
            'total_marks'        => 10,
            'percentage'         => 80,
            'status'             => 'graded',
            'started_at'         => now(),
            'submitted_at'       => now(),
        ]);
        $att1->answers()->create([
            'question_id'        => 1,
            'marks_obtained'     => 1,
            'is_correct'         => true,
        ]);

        $att2 = \App\model\LmsQuizAttempt::create([
            'quiz_id'            => $quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number'     => 2,
            'score'              => 6,
            'total_marks'        => 10,
            'percentage'         => 60,
            'status'             => 'graded',
            'started_at'         => now(),
            'submitted_at'       => now(),
        ]);

        $att3 = \App\model\LmsQuizAttempt::create([
            'quiz_id'            => $quiz->id,
            'student_account_id' => $this->student->id,
            'attempt_number'     => 3,
            'score'              => 4,
            'total_marks'        => 10,
            'percentage'         => 40,
            'status'             => 'graded',
            'started_at'         => now(),
            'submitted_at'       => now(),
        ]);

        // 1. Single delete: delete att1
        $delRes = $this->actingAs($this->adminUser)
            ->delete(route('admin.quizzes.attempt.destroy', $att1->id));
        $delRes->assertRedirect();
        $this->assertDatabaseMissing('lms_quiz_attempts', ['id' => $att1->id]);
        $this->assertDatabaseMissing('lms_quiz_answers', ['attempt_id' => $att1->id]);

        // 2. Bulk delete: delete att2 and att3 together
        $bulkRes = $this->actingAs($this->adminUser)
            ->post(route('admin.quizzes.reports.bulk-delete'), [
                'attempt_ids' => [$att2->id, $att3->id],
            ]);
        $bulkRes->assertRedirect();
        $this->assertDatabaseMissing('lms_quiz_attempts', ['id' => $att2->id]);
        $this->assertDatabaseMissing('lms_quiz_attempts', ['id' => $att3->id]);
    }

    /**
     * Test admin can import questions by question_type and from Paper Builder into quiz
     */
    public function test_import_from_library_by_question_type_and_from_paper_builder()
    {
        $quiz = LmsQuiz::create([
            'course_id'        => $this->course->id,
            'title'            => 'Type & Paper Import Quiz',
            'quiz_type'        => 'exam',
            'duration_minutes' => 20,
            'total_marks'      => 0,
            'pass_marks'       => 5,
            'is_published'     => true,
        ]);

        // Create specific question types in library
        $tfQ = LmsQuestion::create([
            'course_id'     => $this->course->id,
            'quiz_id'       => null,
            'question_text' => 'RAM is non-volatile memory?',
            'question_type' => 'true_false',
            'marks'         => 1.0,
            'is_active'     => true,
        ]);
        $tfQ->options()->create(['option_text' => 'False', 'is_correct' => true, 'order_index' => 1]);

        // 1. Import by question_type = true_false
        $resType = $this->actingAs($this->adminUser)
            ->post(route('admin.quizzes.import-from-library', $quiz->id), [
                'source_mode'   => 'type',
                'question_type' => 'true_false',
                'count'         => 5,
            ]);
        $resType->assertRedirect();
        $this->assertDatabaseHas('lms_questions', [
            'quiz_id'       => $quiz->id,
            'question_type' => 'true_false',
        ]);

        // 2. Import from a Paper Builder question paper
        $paper = \App\model\LmsQuestionPaper::create([
            'course_id'        => $this->course->id,
            'title'            => 'Final Exam Lab Paper 2026',
            'paper_code'       => 'QP-2026-TEST-' . rand(1000, 9999) . '-' . time(),
            'duration_minutes' => 30,
            'total_marks'      => 5,
            'pass_marks'       => 2,
        ]);

        $itemQ = LmsQuestion::create([
            'course_id'     => $this->course->id,
            'quiz_id'       => null,
            'question_text' => 'What is an IP address?',
            'question_type' => 'short_answer',
            'marks'         => 2.0,
            'is_active'     => true,
        ]);

        $paper->items()->create([
            'question_id' => $itemQ->id,
            'marks'       => 2.0,
            'order_index' => 1,
        ]);

        $resPaper = $this->actingAs($this->adminUser)
            ->post(route('admin.quizzes.import-from-library', $quiz->id), [
                'source_mode' => 'paper',
                'paper_id'    => $paper->id,
            ]);
        $resPaper->assertRedirect();
        $quiz->refresh();
        $this->assertEquals($paper->id, $quiz->paper_id);
        $this->assertDatabaseHas('lms_questions', [
            'quiz_id'       => $quiz->id,
            'question_text' => 'What is an IP address?',
        ]);
    }

    /**
     * Test admin can bulk delete questions from a quiz
     */
    public function test_admin_can_bulk_delete_questions_from_quiz()
    {
        $quiz = LmsQuiz::create([
            'course_id'        => $this->course->id,
            'title'            => 'Quiz for Bulk Question Deletion',
            'quiz_type'        => 'exam',
            'duration_minutes' => 20,
            'total_marks'      => 4.0,
            'pass_marks'       => 2,
            'is_published'     => true,
        ]);

        $q1 = LmsQuestion::create([
            'course_id'     => $this->course->id,
            'quiz_id'       => $quiz->id,
            'question_text' => 'Bulk Q1 to delete?',
            'question_type' => 'mcq_single',
            'marks'         => 2.0,
            'is_active'     => true,
        ]);
        $q1->options()->create(['option_text' => 'Opt 1', 'is_correct' => true, 'order_index' => 1]);

        $q2 = LmsQuestion::create([
            'course_id'     => $this->course->id,
            'quiz_id'       => $quiz->id,
            'question_text' => 'Bulk Q2 to delete?',
            'question_type' => 'mcq_single',
            'marks'         => 2.0,
            'is_active'     => true,
        ]);
        $q2->options()->create(['option_text' => 'Opt 2', 'is_correct' => true, 'order_index' => 1]);

        // Bulk delete both questions
        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.quizzes.questions.bulk-delete', $quiz->id), [
                'question_ids' => [$q1->id, $q2->id],
            ]);

        $response->assertRedirect();
        $this->assertDatabaseMissing('lms_questions', ['id' => $q1->id]);
        $this->assertDatabaseMissing('lms_questions', ['id' => $q2->id]);

        $quiz->refresh();
        $this->assertEquals(0, (float)$quiz->total_marks);

        // Verify GET request also redirects gracefully without 404
        $getRes = $this->actingAs($this->adminUser)
            ->get(route('admin.quizzes.questions.bulk-delete', $quiz->id));
        $getRes->assertRedirect(route('admin.quizzes.questions', $quiz->id));
    }
}
