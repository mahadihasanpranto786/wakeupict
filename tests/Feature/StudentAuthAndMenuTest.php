<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\StudentPanelMenu;
use App\Services\StudentMenuService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentAuthAndMenuTest extends TestCase
{
    /**
     * Test unique Student ID generation format and uniqueness
     */
    public function testUniqueStudentIdGeneration()
    {
        $year = date('Y');
        $id1 = StudentAccount::generateUniqueStudentId();
        $this->assertRegExp("/^WUICT-{$year}-\d{4}$/", $id1);

        // Create temporary account with id1
        $account = StudentAccount::create([
            'student_id_code' => $id1,
            'name' => 'Test Unit Student',
            'phone' => '01700' . rand(100000, 999999),
            'email' => 'unittest_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('password123'),
            'status' => 1,
        ]);

        $id2 = StudentAccount::generateUniqueStudentId();
        $this->assertNotEquals($id1, $id2);
        $this->assertRegExp("/^WUICT-{$year}-\d{4}$/", $id2);

        $account->delete();
    }

    /**
     * Test dynamic student menu service and defaults
     */
    public function testDynamicStudentMenuService()
    {
        StudentMenuService::resetDefaults();
        $tree = StudentMenuService::getTree();

        $this->assertCount(10, $tree);

        // Check required menus exist
        $keys = $tree->pluck('menu_key')->toArray();
        $this->assertContains('dashboard', $keys);
        $this->assertContains('my_learning', $keys);
        $this->assertContains('classes_attendance', $keys);
        $this->assertContains('quiz_examination', $keys);
        $this->assertContains('assignments_projects', $keys);
        $this->assertContains('fees_payments', $keys);
        $this->assertContains('certificates_achievements', $keys);
        $this->assertContains('notifications_announcements', $keys);
        $this->assertContains('support_communication', $keys);
        $this->assertContains('profile_settings', $keys);

        // Test toggle feature active check
        $this->assertTrue(StudentMenuService::isFeatureEnabled('dashboard'));
        $dash = StudentPanelMenu::where('menu_key', 'dashboard')->first();
        $dash->update(['is_active' => false]);
        StudentMenuService::clearCache();

        $this->assertFalse(StudentMenuService::isFeatureEnabled('dashboard'));

        // Restore
        $dash->update(['is_active' => true]);
        StudentMenuService::clearCache();
        $this->assertTrue(StudentMenuService::isFeatureEnabled('dashboard'));
    }

    /**
     * Test guest access to student auth routes
     */
    public function testGuestStudentAuthRoutes()
    {
        $response = $this->get('/student/login');
        $response->assertStatus(200);
        $response->assertSee('Student Login');

        $response = $this->get('/student/register');
        $response->assertStatus(200);
        $response->assertSee('Create Student Account');
    }

    /**
     * Test protected student dashboard requires authentication
     */
    public function testUnauthenticatedStudentRedirected()
    {
        $response = $this->get('/student/dashboard');
        $response->assertRedirect('/student/login');
    }

    /**
     * Test authenticated student dashboard and profile access
     */
    public function testAuthenticatedStudentAccess()
    {
        $student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'Authenticated Test Student',
            'phone' => '01800' . rand(100000, 999999),
            'email' => 'auth_student_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);

        // Access dashboard as authenticated student
        $response = $this->actingAs($student, 'student')->get('/student/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Authenticated Test Student');
        $response->assertSee($student->student_id_code);

        // Access profile as authenticated student
        $response = $this->actingAs($student, 'student')->get('/student/profile');
        $response->assertStatus(200);
        $response->assertSee('Student Profile');

        $student->delete();
    }

    /**
     * Test feature authorization middleware blocks disabled modules
     */
    public function testFeatureMiddlewareEnforcement()
    {
        $student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'Middleware Test Student',
            'phone' => '01900' . rand(100000, 999999),
            'email' => 'feature_student_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);

        // Disable 'online_quiz'
        $quizMenu = StudentPanelMenu::where('menu_key', 'online_quiz')->first();
        if ($quizMenu) {
            $quizMenu->update(['is_active' => false]);
            StudentMenuService::clearCache();

            // Attempt accessing quiz route
            $response = $this->actingAs($student, 'student')->get('/student/quiz');
            $response->assertStatus(403);
            $response->assertSee('This module is temporarily unavailable');

            // Re-enable 'online_quiz'
            $quizMenu->update(['is_active' => true]);
            StudentMenuService::clearCache();

            $response = $this->actingAs($student, 'student')->get('/student/quiz');
            $response->assertStatus(200);
        }

        $student->delete();
    }
}
