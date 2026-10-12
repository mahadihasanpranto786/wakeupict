<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\LmsNotification;
use Carbon\Carbon;

class StudentNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Notifications & Broadcast Announcements Center
     */
    public function index(Request $request)
    {
        $student = Auth::guard('student')->user();

        $query = LmsNotification::where(function ($q) use ($student) {
                $q->where('student_account_id', $student->id)
                  ->orWhereNull('student_account_id');
            })
            ->with('course');

        if ($request->filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($request->filter === 'announcements') {
            $query->whereNull('student_account_id');
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(15);

        $unreadCount = LmsNotification::where(function ($q) use ($student) {
                $q->where('student_account_id', $student->id)
                  ->orWhereNull('student_account_id');
            })
            ->where('is_read', false)
            ->count();

        return view('frontend.theme.clasic.student.notifications.index', compact(
            'student', 'notifications', 'unreadCount'
        ));
    }

    /**
     * Mark single notification as read via AJAX
     */
    public function markAsRead(Request $request, $id)
    {
        $student = Auth::guard('student')->user();
        $notif = LmsNotification::where(function ($q) use ($student) {
                $q->where('student_account_id', $student->id)
                  ->orWhereNull('student_account_id');
            })
            ->findOrFail($id);

        $notif->is_read = true;
        $notif->read_at = Carbon::now();
        $notif->save();

        return response()->json(['status' => 'success']);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllRead()
    {
        $student = Auth::guard('student')->user();

        LmsNotification::where('student_account_id', $student->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => Carbon::now(),
            ]);

        return redirect()->route('student.notifications.index')->with([
            'success' => 'All notifications marked as read.',
        ]);
    }
}
