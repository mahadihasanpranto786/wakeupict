<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\Student;
use App\model\AdmitedStudent;
use App\model\Course;
use App\model\Batch;
use Illuminate\Support\Facades\Hash;

class StudentProfileUpdateWorkflowTest extends TestCase
{
    public function testStudentCanViewAndEditOthersInformationFromProfile()
    {
        $uniquePhone = '0178' . rand(1000000, 9999999);
        $uniqueEmail = 'student_' . rand(10000, 99999) . '@test.com';

        // 1. Create student account
        $account = StudentAccount::create([
            'student_id_code' => 'WUICT-' . rand(1000, 9999),
            'registration_number' => '2026' . rand(10000000, 99999999),
            'name' => 'Original Name',
            'email' => $uniqueEmail,
            'phone' => $uniquePhone,
            'password' => Hash::make('password123'),
            'registration_status' => 'approved',
            'status' => 1,
        ]);

        // 2. Create linked Student master record
        $studentMaster = Student::create([
            'student_name' => 'Original Name',
            'personal_call_no' => $uniquePhone,
            'email' => $uniqueEmail,
            'course_id' => 1,
            'batch_id' => 1,
            'registration_number' => $account->registration_number,
            'course_fee' => '5000',
            'status' => 1,
            'gander' => 'other',
            'fathers_name' => '',
            'mothers_name' => '',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '',
            'present_address' => '',
            'permanent_address' => '',
            'religion' => 'Islam',
            'occupation' => 'student',
            'age' => '',
            'educational_qualification' => '',
            'result' => '',
            'passing_year' => '',
        ]);

        $account->update(['student_id' => $studentMaster->id]);

        // 3. Authenticate as student and view edit profile page
        $this->actingAs($account, 'student');
        $response = $this->get(route('student.profile.edit'));
        $response->assertStatus(200);
        $response->assertSee('Personal &amp; Family Information');
        $response->assertSee('Father\'s Name');
        $response->assertSee('Educational Qualification');

        // 4. Submit update with additional background details
        $updatePayload = [
            'name' => 'Updated Student Name',
            'phone' => $uniquePhone,
            'email' => $uniqueEmail,
            'fathers_name' => 'Md. Rafiqul Islam',
            'mothers_name' => 'Mst. Rokeya Begum',
            'gander' => 'male',
            'nationality' => 'Bangladeshi',
            'national_id_no' => '1998521478965',
            'age' => '24 Years',
            'religion' => 'Islam',
            'occupation' => 'Freelancer',
            'educational_qualification' => 'B.Sc in CSE',
            'result' => 'CGPA 3.75',
            'passing_year' => '2025',
            'present_address' => 'Mirpur-10, Dhaka-1216',
            'permanent_address' => 'Station Road, Bogura Sadar, Bogura',
        ];

        $postResponse = $this->post(route('student.profile.update'), $updatePayload);
        $postResponse->assertRedirect(route('student.profile.index'));
        $postResponse->assertSessionHas('success');

        // 5. Verify StudentAccount meta was saved
        $account->refresh();
        $this->assertEquals('Updated Student Name', $account->name);
        $this->assertEquals('Md. Rafiqul Islam', $account->getProfileDetail('fathers_name'));
        $this->assertEquals('Mst. Rokeya Begum', $account->getProfileDetail('mothers_name'));
        $this->assertEquals('1998521478965', $account->getProfileDetail('national_id_no'));
        $this->assertEquals('B.Sc in CSE', $account->getProfileDetail('educational_qualification'));

        // 6. Verify sync to parent Student master record
        $studentMaster->refresh();
        $this->assertEquals('Updated Student Name', $studentMaster->student_name);
        $this->assertEquals('Md. Rafiqul Islam', $studentMaster->fathers_name);
        $this->assertEquals('Mst. Rokeya Begum', $studentMaster->mothers_name);
        $this->assertEquals('male', $studentMaster->gander);
        $this->assertEquals('1998521478965', $studentMaster->national_id_no);
        $this->assertEquals('B.Sc in CSE', $studentMaster->educational_qualification);
        $this->assertEquals('Mirpur-10, Dhaka-1216', $studentMaster->present_address);

        // 7. Verify profile index page displays updated details
        $profileIndexResponse = $this->get(route('student.profile.index'));
        $profileIndexResponse->assertStatus(200);
        $profileIndexResponse->assertSee('Md. Rafiqul Islam');
        $profileIndexResponse->assertSee('Mst. Rokeya Begum');
        $profileIndexResponse->assertSee('1998521478965');
        $profileIndexResponse->assertSee('B.Sc in CSE');
        $profileIndexResponse->assertSee('Mirpur-10, Dhaka-1216');
    }
}

