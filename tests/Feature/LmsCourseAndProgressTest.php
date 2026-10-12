<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\Course;
use App\model\LmsChapter;
use App\model\LmsLesson;
use App\model\LmsEnrollment;
use App\model\LmsLessonProgress;
use Illuminate\Support\Facades\Hash;

class LmsCourseAndProgressTest extends TestCase
{
    protected $student;
    protected $course;
    protected $chapter;
    protected $lesson;

    protected function setUp(): void
    {
        parent::setUp();

        // Create or find a test student
        $this->student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'LMS Unit Test Student',
            'phone' => '01711' . rand(100000, 999999),
            'email' => 'lmstest_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);

        // Get an existing course or create one
        $this->course = Course::first();
        if (!$this->course) {
            $this->course = Course::create([
                'course_title' => 'Test LMS Course',
                'course_slug' => 'test-lms-course',
                'course_fee' => 5000,
                'status' => 1,
                'importents' => 'Important points',
                'future_of_this_course' => 'Future scope',
                'possibilities_of_this_course' => 'Possibilities',
                'student_quantity' => 30,
            ]);
        }

        // Ensure at least one chapter and lesson exist for this course
        $this->chapter = LmsChapter::firstOrCreate([
            'course_id' => $this->course->id,
            'title' => 'Module 1: Getting Started',
        ], [
            'description' => 'Introduction to the curriculum',
            'order_index' => 1,
            'status' => 1,
        ]);

        $this->lesson = LmsLesson::firstOrCreate([
            'course_id' => $this->course->id,
            'chapter_id' => $this->chapter->id,
            'title' => 'Lesson 1.1: Core Fundamentals',
        ], [
            'lesson_type' => 'video',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'content' => '<p>Test lesson notes and curriculum.</p>',
            'order_index' => 1,
            'status' => 1,
            'is_free_preview' => 1,
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->student) {
            LmsLessonProgress::where('student_account_id', $this->student->id)->delete();
            LmsEnrollment::where('student_account_id', $this->student->id)->delete();
            $this->student->delete();
        }

        parent::tearDown();
    }

    /**
     * Test browsing available courses
     */
    public function testStudentCanBrowseCourses()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.courses.browse'));

        $response->assertStatus(200);
        $response->assertSee('Explore Training Programs');
        $response->assertSee(e($this->course->course_title));
    }

    /**
     * Test viewing course curriculum and syllabus
     */
    public function testStudentCanViewCourseDetails()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.courses.details', $this->course->id));

        $response->assertStatus(200);
        $response->assertSee(e($this->course->course_title));
        $response->assertSee('Curriculum Syllabus');
        $response->assertSee(e($this->chapter->chapter_name));
        $response->assertSee(e($this->lesson->lesson_title));
    }

    /**
     * Test course enrollment and redirect to lesson player
     */
    public function testStudentCanEnrollInCourse()
    {
        $response = $this->actingAs($this->student, 'student')
            ->post(route('student.courses.enroll', $this->course->id));

        $response->assertRedirect(route('student.courses.learn', $this->course->id));

        $this->assertDatabaseHas('lms_enrollments', [
            'student_account_id' => $this->student->id,
            'course_id' => $this->course->id,
            'status' => 'active',
        ]);
    }

    /**
     * Test LMS Interactive Lesson Player
     */
    public function testStudentCanAccessInteractiveLessonPlayer()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.courses.learn', [$this->course->id, $this->lesson->id]));

        $response->assertStatus(200);
        $response->assertSee('Course Player');
        $response->assertSee(e($this->lesson->lesson_title));
        $response->assertSee('Mark as Completed');
    }

    /**
     * Test AJAX toggling of lesson completion
     */
    public function testAjaxToggleLessonCompletion()
    {
        $response = $this->actingAs($this->student, 'student')
            ->postJson(route('student.courses.toggle-lesson', $this->lesson->id));

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
            'is_completed' => true,
        ]);

        $this->assertDatabaseHas('lms_lesson_progress', [
            'student_account_id' => $this->student->id,
            'lesson_id' => $this->lesson->id,
            'is_completed' => true,
        ]);

        // Toggle again to unmark
        $response2 = $this->actingAs($this->student, 'student')
            ->postJson(route('student.courses.toggle-lesson', $this->lesson->id));

        $response2->assertStatus(200);
        $response2->assertJson([
            'status' => 'success',
            'is_completed' => false,
        ]);
    }

    /**
     * Test viewing student materials and progress pages
     */
    public function testStudentCanViewMaterialsAndProgressPages()
    {
        $materialsResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.materials.index'));
        $materialsResponse->assertStatus(200);
        $materialsResponse->assertSee('Lecture Notes');

        $progressResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.progress.index'));
        $progressResponse->assertStatus(200);
        $progressResponse->assertSee('Learning Progress');
    }
}
