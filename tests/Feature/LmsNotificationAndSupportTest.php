<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\StudentAccount;
use App\model\LmsNotification;
use App\model\LmsSupportTicket;
use App\model\LmsTicketReply;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LmsNotificationAndSupportTest extends TestCase
{
    protected $student;
    protected $notification;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'Notification Support Test Student',
            'phone' => '01799' . rand(100000, 999999),
            'email' => 'notiftest_' . rand(1000, 9999) . '@wakeupict.test',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);

        $this->notification = LmsNotification::create([
            'student_account_id' => $this->student->id,
            'title' => 'Test Notification For Unit Test',
            'message' => 'Your test message content here for notification verification.',
            'type' => 'info',
            'action_url' => '/student/courses/my',
            'is_read' => false,
        ]);
    }

    protected function tearDown(): void
    {
        if ($this->student) {
            $tickets = LmsSupportTicket::where('student_account_id', $this->student->id)->get();
            foreach ($tickets as $t) {
                LmsTicketReply::where('ticket_id', $t->id)->delete();
                $t->delete();
            }
            LmsNotification::where('student_account_id', $this->student->id)->delete();
            $this->student->delete();
        }

        parent::tearDown();
    }

    /**
     * Unauthenticated student cannot access notifications
     */
    public function test_notifications_index_requires_student_auth()
    {
        $response = $this->get(route('student.notifications.index'));
        $response->assertRedirect(route('student.login'));
    }

    /**
     * Authenticated student can view notifications index
     */
    public function test_authenticated_student_can_view_notifications()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.notifications.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Notification For Unit Test');
    }

    /**
     * Student can mark single notification as read via AJAX
     */
    public function test_student_can_mark_single_notification_as_read()
    {
        $response = $this->actingAs($this->student, 'student')
            ->postJson(route('student.notifications.mark-read', $this->notification->id));

        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('lms_notifications', [
            'id' => $this->notification->id,
            'is_read' => 1,
        ]);
    }

    /**
     * Student can mark all notifications as read
     */
    public function test_student_can_mark_all_notifications_as_read()
    {
        $response = $this->actingAs($this->student, 'student')
            ->post(route('student.notifications.mark-all-read'));

        $response->assertRedirect();

        $this->assertDatabaseHas('lms_notifications', [
            'id' => $this->notification->id,
            'is_read' => 1,
        ]);
    }

    /**
     * Support index requires auth
     */
    public function test_support_index_requires_auth()
    {
        $response = $this->get(route('student.support.index'));
        $response->assertRedirect(route('student.login'));
    }

    /**
     * Student can view support center and create ticket form
     */
    public function test_student_can_view_support_tickets_and_create_form()
    {
        $response = $this->actingAs($this->student, 'student')
            ->get(route('student.support.index'));
        $response->assertStatus(200);

        $createResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.support.create'));
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Open New Support Ticket');
    }

    /**
     * Student can create a support ticket with initial message
     */
    public function test_student_can_create_new_support_ticket()
    {
        $response = $this->actingAs($this->student, 'student')
            ->post(route('student.support.store'), [
                'subject' => 'Issue with Web Development Assignment 2',
                'category' => 'academic',
                'priority' => 'high',
                'message' => 'I cannot submit my project zip file because of a connection timeout.',
            ]);

        $this->assertDatabaseHas('lms_support_tickets', [
            'student_account_id' => $this->student->id,
            'subject' => 'Issue with Web Development Assignment 2',
            'category' => 'academic',
            'priority' => 'high',
            'status' => 'open',
        ]);

        $ticket = LmsSupportTicket::where('student_account_id', $this->student->id)
            ->where('subject', 'Issue with Web Development Assignment 2')
            ->first();

        $this->assertNotNull($ticket);
        $response->assertRedirect(route('student.support.show', $ticket->id));

        $this->assertDatabaseHas('lms_ticket_replies', [
            'ticket_id' => $ticket->id,
            'student_account_id' => $this->student->id,
            'message' => 'I cannot submit my project zip file because of a connection timeout.',
        ]);
    }

    /**
     * Student can view ticket thread and post reply
     */
    public function test_student_can_view_ticket_and_reply()
    {
        $ticket = LmsSupportTicket::create([
            'student_account_id' => $this->student->id,
            'ticket_number' => LmsSupportTicket::generateTicketNumber(),
            'subject' => 'Fees Verification Inquiry',
            'category' => 'fees_payment',
            'priority' => 'medium',
            'status' => 'open',
            'last_reply_at' => Carbon::now(),
        ]);

        LmsTicketReply::create([
            'ticket_id' => $ticket->id,
            'student_account_id' => $this->student->id,
            'message' => 'Initial message about fee payment.',
        ]);

        $showResponse = $this->actingAs($this->student, 'student')
            ->get(route('student.support.show', $ticket->id));

        $showResponse->assertStatus(200);
        $showResponse->assertSee('Fees Verification Inquiry');
        $showResponse->assertSee('Initial message about fee payment.');

        // Post reply
        $replyResponse = $this->actingAs($this->student, 'student')
            ->post(route('student.support.reply', $ticket->id), [
                'message' => 'Follow up: I have verified via bKash statement.',
            ]);

        $replyResponse->assertRedirect(route('student.support.show', $ticket->id));

        $this->assertDatabaseHas('lms_ticket_replies', [
            'ticket_id' => $ticket->id,
            'student_account_id' => $this->student->id,
            'message' => 'Follow up: I have verified via bKash statement.',
        ]);
    }
}
