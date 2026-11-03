<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\Course;
use App\model\Student;
use App\model\StudentAccount;
use App\model\LmsEnrollment;
use App\Services\StudentEnrollmentService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

class StudentMultiCourseEnrollmentTest extends TestCase
{
    use DatabaseTransactions;

    protected $course1;
    protected $course2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->course1 = Course::create([
            'course_title' => 'Web Development Bootcamp',
            'course_slug' => 'web-development-bootcamp-' . uniqid(),
            'price' => '12000',
            'short_description' => 'Fullstack web development',
            'course_content' => 'HTML, CSS, PHP, Laravel',
            'long_description' => 'Detailed curriculum',
            'importents' => 'Career ready',
            'future_of_this_course' => 'High demand',
            'possibilities_of_this_course' => 'Job opportunities',
            'time_line' => '3 months',
            'student_quantity' => '10',
            'image' => 'default.png',
            'image_alt' => 'Web Development Course',
            'status' => 1,
        ]);

        $this->course2 = Course::create([
            'course_title' => 'Graphic Design Professional',
            'course_slug' => 'graphic-design-pro-' . uniqid(),
            'price' => '8000',
            'short_description' => 'UI UX and Graphic Design',
            'course_content' => 'Photoshop, Illustrator',
            'long_description' => 'Detailed graphics curriculum',
            'importents' => 'Creative career',
            'future_of_this_course' => 'Freelancing',
            'possibilities_of_this_course' => 'Global clients',
            'time_line' => '2 months',
            'student_quantity' => '10',
            'image' => 'default.png',
            'image_alt' => 'Web Development Course',
            'status' => 1,
        ]);
    }

    /**
     * Test 1 & 2: First application creates account; Second application with same phone associates new course without creating new account
     */
    public function testFirstApplicationCreatesAccountAndSecondApplicationWithSamePhoneAssociatesNewCourse()
    {
        $phone = '01711' . rand(100000, 999999);
        $email = 'rahim_' . uniqid() . '@example.com';

        // 1. First Application for Web Development
        $data1 = [
            'student_name' => 'Rahim Uddin',
            'gander' => 'Male',
            'date_of_birth' => '2000-01-01',
            'fathers_name' => 'Karim Uddin',
            'mothers_name' => 'Rahima Begum',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '1234567890',
            'present_address' => 'Dhaka',
            'permanent_address' => 'Dhaka',
            'personal_call_no' => $phone,
            'email' => $email,
            'religion' => 'Islam',
            'occupation' => 'Student',
            'age' => '24',
            'educational_qualification' => 'HSC',
            'result' => '5.00',
            'passing_year' => '2019',
            'course_id' => $this->course1->id,
            'selected_course_ids' => [$this->course1->id],
        ];

        $request1 = new Request();
        $res1 = StudentEnrollmentService::processAdmissionApplication($data1, $request1);

        $this->assertTrue($res1['success']);
        $this->assertEquals('new_account_created', $res1['status']);
        $this->assertTrue($res1['is_new_account']);
        $account1 = $res1['student_account'];
        $this->assertInstanceOf(StudentAccount::class, $account1);
        $this->assertEquals($phone, $account1->phone);

        // Check enrollment 1
        $this->assertTrue(LmsEnrollment::where('student_account_id', $account1->id)->where('course_id', $this->course1->id)->exists());

        // 2. Second Application for Graphic Design using SAME Phone Number
        $data2 = [
            'student_name' => 'Rahim Uddin',
            'gander' => 'Male',
            'date_of_birth' => '2000-01-01',
            'fathers_name' => 'Karim Uddin',
            'mothers_name' => 'Rahima Begum',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '1234567890',
            'present_address' => 'Dhaka',
            'permanent_address' => 'Dhaka',
            'personal_call_no' => $phone,
            'email' => $email,
            'religion' => 'Islam',
            'occupation' => 'Student',
            'age' => '24',
            'educational_qualification' => 'HSC',
            'result' => '5.00',
            'passing_year' => '2019',
            'course_id' => $this->course2->id,
            'selected_course_ids' => [$this->course2->id],
        ];

        $request2 = new Request();
        $res2 = StudentEnrollmentService::processAdmissionApplication($data2, $request2);

        $this->assertTrue($res2['success']);
        $this->assertEquals('existing_account_course_added', $res2['status']);
        $this->assertFalse($res2['is_new_account']);
        $account2 = $res2['student_account'];

        // Crucial: Must be the SAME StudentAccount instance ID
        $this->assertEquals($account1->id, $account2->id);

        // Crucial: Must have both courses enrolled
        $this->assertTrue(LmsEnrollment::where('student_account_id', $account1->id)->where('course_id', $this->course1->id)->exists());
        $this->assertTrue(LmsEnrollment::where('student_account_id', $account1->id)->where('course_id', $this->course2->id)->exists());

        // Total accounts for this phone must remain exactly ONE
        $this->assertEquals(1, StudentAccount::where('phone', $phone)->count());

        // Check full courses list accessor
        $account2->refresh();
        $this->assertEquals(2, $account2->full_courses_list->count());
    }

    /**
     * Test 3: Duplicate Course Prevention
     */
    public function testDuplicateCourseEnrollmentIsPrevented()
    {
        $phone = '01811' . rand(100000, 999999);
        $email = 'duplicate_' . uniqid() . '@example.com';

        // 1. First enroll in Course 1
        $data = [
            'student_name' => 'Hasan Ali',
            'gander' => 'Male',
            'fathers_name' => 'Ali',
            'mothers_name' => 'Fatema',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '987654321',
            'present_address' => 'Chittagong',
            'permanent_address' => 'Chittagong',
            'personal_call_no' => $phone,
            'email' => $email,
            'religion' => 'Islam',
            'occupation' => 'Job',
            'age' => '26',
            'course_id' => $this->course1->id,
            'selected_course_ids' => [$this->course1->id],
        ];

        $res1 = StudentEnrollmentService::processAdmissionApplication($data, new Request());
        $this->assertTrue($res1['success']);

        // 2. Attempt to enroll in Course 1 AGAIN with the same phone
        $res2 = StudentEnrollmentService::processAdmissionApplication($data, new Request());
        $this->assertFalse($res2['success']);
        $this->assertEquals('already_enrolled', $res2['status']);
        $this->assertStringContainsString('ইতিমধ্যে', $res2['message']);
    }

    /**
     * Test 4: Safety Check - Conflict when Phone belongs to Account A and Email belongs to Account B
     */
    public function testIdentityConflictPreventsAutoMergeAndRequiresAdminVerification()
    {
        $phoneA = '01911' . rand(100000, 999999);
        $emailA = 'person_a_' . uniqid() . '@example.com';

        $phoneB = '01922' . rand(100000, 999999);
        $emailB = 'person_b_' . uniqid() . '@example.com';

        // Create Account A
        StudentAccount::create([
            'name' => 'Person A',
            'email' => $emailA,
            'phone' => $phoneA,
            'password' => bcrypt('123456'),
            'status' => 1,
        ]);

        // Create Account B
        StudentAccount::create([
            'name' => 'Person B',
            'email' => $emailB,
            'phone' => $phoneB,
            'password' => bcrypt('123456'),
            'status' => 1,
        ]);

        // Now an applicant tries to register with Phone A but Email B (mismatch!)
        $conflictData = [
            'student_name' => 'Conflict Tester',
            'personal_call_no' => $phoneA,
            'email' => $emailB,
            'course_id' => $this->course1->id,
            'selected_course_ids' => [$this->course1->id],
        ];

        $conflictResult = StudentEnrollmentService::processAdmissionApplication($conflictData, new Request());

        $this->assertFalse($conflictResult['success']);
        $this->assertEquals('conflict_error', $conflictResult['status']);
        $this->assertStringContainsString('নিরাপত্তাজনিত সতর্কতা', $conflictResult['message']);
        $this->assertStringContainsString('দুইটি পৃথক', $conflictResult['message']);
    }

    /**
     * Test 5: Phone Normalization (+880, 880, dashes, spaces)
     */
    public function testPhoneNormalizationHandlesVariations()
    {
        $this->assertEquals('01791612121', StudentEnrollmentService::normalizePhone('+8801791612121'));
        $this->assertEquals('01791612121', StudentEnrollmentService::normalizePhone('8801791612121'));
        $this->assertEquals('01791612121', StudentEnrollmentService::normalizePhone('01791-612121'));
        $this->assertEquals('01791612121', StudentEnrollmentService::normalizePhone('01791 612 121'));
        $this->assertEquals('01791612121', StudentEnrollmentService::normalizePhone('০১৭৯১৬১২১২১'));
    }

    /**
     * Test 6: Student Profile Route shows multi-course enrollment info
     */
    public function testStudentProfileDisplaysEnrolledCourses()
    {
        $phone = '01611' . rand(100000, 999999);
        $account = StudentAccount::create([
            'name' => 'Profile Student',
            'email' => 'profile_' . uniqid() . '@example.com',
            'phone' => $phone,
            'password' => bcrypt('123456'),
            'status' => 1,
        ]);

        LmsEnrollment::create([
            'student_account_id' => $account->id,
            'course_id' => $this->course1->id,
            'status' => 'active',
            'enrollment_type' => 'applied',
        ]);

        LmsEnrollment::create([
            'student_account_id' => $account->id,
            'course_id' => $this->course2->id,
            'status' => 'active',
            'enrollment_type' => 'applied',
        ]);

        $response = $this->actingAs($account, 'student')->get(route('student.profile.index'));
        $response->assertStatus(200);
        $response->assertSee('One Student Account');
        $response->assertSee('Web Development Bootcamp');
        $response->assertSee('Graphic Design Professional');
        $response->assertSee('2 Courses Enrolled');
    }

    /**
     * Test 7: Admin Student View Slip Renders Cleanly with High Contrast & Styles
     */
    public function testAdminStudentViewSlipRendersCorrectly()
    {
        $admin = \App\User::first() ?: \App\User::create([
            'name' => 'Admin User',
            'email' => 'admin_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'type' => 'Admin',
        ]);

        $student = Student::create([
            'student_name' => 'HASAN AL MAMUN',
            'gander' => 'male',
            'fathers_name' => 'Karim',
            'mothers_name' => 'Fatema',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '9988776655',
            'present_address' => 'Rajbari',
            'permanent_address' => 'Rajbari',
            'personal_call_no' => '01796297458',
            'email' => 'hasan_' . uniqid() . '@gmail.com',
            'religion' => 'Islam',
            'occupation' => 'student',
            'age' => '22',
            'date_of_birth' => '2004-05-15',
            'educational_qualification' => 'HSC',
            'result' => '5.00',
            'passing_year' => '2022',
            'course_id' => $this->course1->id,
            'course_fee' => '12000',
            'status' => 1,
        ]);

        $response = $this->actingAs($admin)->get('/student-view/' . $student->id);
        $response->assertStatus(200);
        $response->assertSee('Student Slip: #' . (1000 + $student->id));
        $response->assertSee('HASAN AL MAMUN');
        $response->assertSee('Wake Up ICT');
        $response->assertSee('Web Development Bootcamp');
        $response->assertSee('12,000 TK');
    }

    /**
     * Test 8: Portal registration creates a master parent record in students table
     */
    public function testPortalRegistrationCreatesMasterParentStudentRecord()
    {
        $phone = '01722' . rand(100000, 999999);
        $email = 'portal_student_' . uniqid() . '@example.com';

        $response = $this->post('/student/register', [
            'name' => 'Portal Registrant',
            'phone' => $phone,
            'email' => $email,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $response->assertRedirect(route('student.dashboard'));

        // Check master student table has parent record
        $parentStudent = Student::where('personal_call_no', $phone)->first();
        $this->assertNotNull($parentStudent, 'Parent record in students table must be created upon portal registration.');
        $this->assertEquals('Portal Registrant', $parentStudent->student_name);
        $this->assertEquals($email, $parentStudent->email);

        // Check student account is linked to parent student record
        $account = StudentAccount::where('phone', $phone)->first();
        $this->assertNotNull($account);
        $this->assertEquals($parentStudent->id, $account->student_id);
        $this->assertEquals('portal_registration', $account->meta['registration_source'] ?? null);
    }

    /**
     * Test 9: Admin can view student accounts list and toggle account status
     */
    public function testAdminCanViewAndManageStudentAccountsList()
    {
        $admin = \App\User::first() ?: \App\User::create([
            'name' => 'Admin User',
            'email' => 'admin_' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'type' => 'Admin',
        ]);

        $phone = '01733' . rand(100000, 999999);
        $account = StudentAccount::create([
            'name' => 'List Test Student',
            'phone' => $phone,
            'email' => 'list_' . uniqid() . '@example.com',
            'password' => bcrypt('secret123'),
            'status' => 1,
            'meta' => ['registration_source' => 'portal_registration'],
        ]);

        // 1. Visit index page
        $res = $this->actingAs($admin)->get(route('admin.student-accounts.index'));
        $res->assertStatus(200);
        $res->assertSee('List Test Student');
        $res->assertSee($account->student_id_code);
        $res->assertSee('পোর্টাল রেজিস্ট্রেশন');

        // 2. Toggle status
        $toggleRes = $this->actingAs($admin)->post(route('admin.student-accounts.toggle-status', $account->id));
        $toggleRes->assertSessionHas('success');

        $account->refresh();
        $this->assertEquals(0, $account->status);
    }
}
