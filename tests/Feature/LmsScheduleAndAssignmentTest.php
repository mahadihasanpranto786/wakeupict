<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\Course;
use App\model\LmsClassSchedule;
use App\model\LmsAttendance;
use App\model\LmsAssignment;
use App\model\LmsAssignmentSubmission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class LmsScheduleAndAssignmentTest extends TestCase
{
    protected $student;
    protected $course;
    protected $schedule;
    protected $assignment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'Schedule Unit Test Student',
            'phone' => '01733' . rand(100000, 999999),
            'email' => 'scheduletest_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);

        $this->course = Course::first();

        // Create schedule
        $this->schedule = LmsClassSchedule::create([
            'course_id' => $this->course->id,
            'title' => 'Unit Test Live Workshop',
            'description' => 'Automated test suite schedule item.',
            'class_type' => 'live_online',
            'meeting_platform' => 'zoom',
            'meeting_link' => 'https://zoom.us/test',
            'class_date' => Carbon::today()->addDay(),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
        ]);

        // Create attendance record
        LmsAttendance::create([
            'schedule_id' => $this->schedule->id,
            'student_account_id' => $this->student->id,
            'course_id' => $this->course->id,
            'attendance_date' => Carbon::today(),
            'status' => 'present',
            'remarks' => 'Automated test present',
        ]);

        // Create assignment
        $this->assignment = LmsAssignment::create([
            'course_id' => $this->course->id,
            'title' => 'Unit Test Practical Assignment',
            'description' => 'Test assignment requirements and submission flow.',
            'assignment_type' => 'project',
            'total_marks' => 50.00,
            'pass_marks' => 25.00,
            'due_date' => Carbon::now()->addDays(7),
            'allowed_file_types' => 'pdf,zip,txt',
            'max_file_size_mb' => 10,
            'is_published' => true,
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->student) {
            LmsAssignmentSubmission::where('student_account_id', $this->student->id)->delete();
            LmsAttendance::where('student_account_id', $this->student->id)->delete();
            $this->student->delete();
        }

        if ($this->schedule) {
            $this->schedule->delete();
        }

        if ($this->assignment) {
            $this->assignment->delete();
        }

        parent::tearDown();
    }

    /**
     * Test class schedule and timetable views
     */
    public function testStudentCanViewClassSchedules()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.schedule.index'));

        $response->assertStatus(200);
        $response->assertSee('Class Schedule');
        $response->assertSee(e($this->schedule->title));

        // Live classes view
        $liveResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.live.index'));
        $liveResponse->assertStatus(200);
        $liveResponse->assertSee('Live Interactive Class Sessions');

        // Recorded classes view
        $recordedResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.recorded.index'));
        $recordedResponse->assertStatus(200);
        $recordedResponse->assertSee('Recorded Class Replays Archive');
    }

    /**
     * Test attendance history view and percentage calculation
     */
    public function testStudentCanViewAttendanceAnalytics()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.attendance.index'));

        $response->assertStatus(200);
        $response->assertSee('Attendance History');
        $response->assertSee('Present');
        $response->assertSee('100%'); // 1 present out of 1
    }

    /**
     * Test assignment viewing, submission form, and file upload
     */
    public function testStudentCanViewAndSubmitAssignment()
    {
        // 1. Assignments list
        $listResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.assignments.index'));
        $listResponse->assertStatus(200);
        $listResponse->assertSee(e($this->assignment->title));

        // 2. Submit page
        $submitPageResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.assignments.submit.id', $this->assignment->id));
        $submitPageResponse->assertStatus(200);
        $submitPageResponse->assertSee(e($this->assignment->title));
        $submitPageResponse->assertSee('Submit Your Work');

        // 3. Post submission
        $file = UploadedFile::fake()->create('project_test.pdf', 500, 'application/pdf');

        $storeResponse = $this->actingAs($this->student, 'student')
            ->post(route('student.assignments.store', $this->assignment->id), [
                'submission_text' => 'https://github.com/test/repo',
                'submitted_file' => $file,
            ]);

        $storeResponse->assertRedirect(route('student.assignments.index'));

        $this->assertDatabaseHas('lms_assignment_submissions', [
            'assignment_id' => $this->assignment->id,
            'student_account_id' => $this->student->id,
            'status' => 'submitted',
        ]);

        // 4. Term projects and teacher feedback views
        $projectsResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.projects.index'));
        $projectsResponse->assertStatus(200);
        $projectsResponse->assertSee('Capstone Term Projects');

        $feedbackResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.assignments.feedback'));
        $feedbackResponse->assertStatus(200);
    }
}
