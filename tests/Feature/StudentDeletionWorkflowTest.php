<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\Student;
use App\model\AdmitedStudent;
use App\model\StudentAccount;
use App\model\StudentPayment;
use App\model\Income;
use App\model\Course;
use App\model\Batch;
use App\model\LmsEnrollment;
use App\Services\StudentDeletionService;
use App\User;
use Illuminate\Support\Facades\Hash;

class StudentDeletionWorkflowTest extends TestCase
{
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::where('type', 'Admin')->first();
        if (!$this->adminUser) {
            $this->adminUser = User::create([
                'name' => 'Admin Tester',
                'email' => 'admin_del_test_' . rand(100, 999) . '@wakeupict.test',
                'password' => Hash::make('password123'),
                'type' => 'Admin',
                'status' => 1,
            ]);
        }
    }

    public function testSingleSoftAndPermanentDeleteStudentCascading()
    {
        $phone = '01799' . rand(100000, 999999);
        $reg = '20269999' . rand(1000, 9999);

        // 1. Create applied student
        $student = Student::create([
            'student_name' => 'Deletion Test Student',
            'personal_call_no' => $phone,
            'registration_number' => $reg,
            'email' => 'del_test_' . rand(100, 999) . '@test.com',
            'course_fee' => '5000',
            'course_id' => 1,
            'gander' => 'Male',
            'fathers_name' => 'Father',
            'mothers_name' => 'Mother',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '1234567890',
            'present_address' => 'Dhaka',
            'permanent_address' => 'Dhaka',
            'religion' => 'Islam',
            'occupation' => 'Student',
            'age' => '22',
            'educational_qualification' => 'HSC',
            'result' => '5.00',
            'passing_year' => '2024',
            'status' => 1,
        ]);

        // 2. Create Student Account
        $account = StudentAccount::create([
            'name' => 'Deletion Test Student',
            'phone' => $phone,
            'registration_number' => $reg,
            'student_id' => $student->id,
            'password' => Hash::make('secret123'),
            'status' => 1,
            'registration_status' => 'approved',
        ]);

        // 3. Test Soft Delete
        StudentDeletionService::softDeleteStudent($student->id);
        $this->assertEquals(0, $student->fresh()->status);
        $this->assertEquals(0, $account->fresh()->status);
        $this->assertEquals('rejected', $account->fresh()->registration_status);

        // 4. Test Permanent Delete
        StudentDeletionService::permanentDeleteStudent($student->id);
        $this->assertNull(Student::find($student->id));
        $this->assertNull(StudentAccount::find($account->id));
    }

    public function testBulkSoftAndPermanentDeleteWorkflow()
    {
        $phone1 = '01798' . rand(100000, 999999);
        $phone2 = '01797' . rand(100000, 999999);

        $st1 = Student::create([
            'student_name' => 'Bulk Student 1',
            'personal_call_no' => $phone1,
            'registration_number' => '20268888' . rand(1000, 9999),
            'email' => 'bulk1_' . rand(100, 999) . '@test.com',
            'course_fee' => '5000',
            'course_id' => 1,
            'gander' => 'Male',
            'fathers_name' => 'F1',
            'mothers_name' => 'M1',
            'nationality' => 'BD',
            'national_id_no' => '111',
            'present_address' => 'Dhaka',
            'permanent_address' => 'Dhaka',
            'religion' => 'Islam',
            'occupation' => 'Student',
            'age' => '20',
            'educational_qualification' => 'SSC',
            'result' => '5.00',
            'passing_year' => '2024',
            'status' => 1,
        ]);

        $st2 = Student::create([
            'student_name' => 'Bulk Student 2',
            'personal_call_no' => $phone2,
            'registration_number' => '20268888' . rand(1000, 9999),
            'email' => 'bulk2_' . rand(100, 999) . '@test.com',
            'course_fee' => '5000',
            'course_id' => 1,
            'gander' => 'Female',
            'fathers_name' => 'F2',
            'mothers_name' => 'M2',
            'nationality' => 'BD',
            'national_id_no' => '222',
            'present_address' => 'Dhaka',
            'permanent_address' => 'Dhaka',
            'religion' => 'Islam',
            'occupation' => 'Student',
            'age' => '21',
            'educational_qualification' => 'HSC',
            'result' => '4.50',
            'passing_year' => '2024',
            'status' => 1,
        ]);

        // Bulk soft delete via HTTP endpoint
        $response = $this->from('/students-list')->actingAs($this->adminUser)->post(route('admin.students.bulk-delete'), [
            'ids' => [$st1->id, $st2->id],
            'delete_type' => 'soft',
        ]);
        $response->assertSessionHas('success');
        $this->assertEquals(0, $st1->fresh()->status);
        $this->assertEquals(0, $st2->fresh()->status);

        // Bulk permanent delete via HTTP endpoint
        $response2 = $this->from('/students-list')->actingAs($this->adminUser)->post(route('admin.students.bulk-delete'), [
            'ids' => [$st1->id, $st2->id],
            'delete_type' => 'permanent',
        ]);
        $response2->assertSessionHas('success');
        $this->assertNull(Student::find($st1->id));
        $this->assertNull(Student::find($st2->id));
    }
}
