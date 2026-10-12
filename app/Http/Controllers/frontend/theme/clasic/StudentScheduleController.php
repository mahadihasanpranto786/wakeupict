<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\LmsClassSchedule;
use App\model\LmsAttendance;
use App\model\LmsEnrollment;
use Carbon\Carbon;

class StudentScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Weekly Class Schedule & Calendar View
     */
    public function schedule()
    {
        $student = Auth::guard('student')->user();
        $enrolledCourseIds = LmsEnrollment::where('student_account_id', $student->id)
            ->where('status', 'active')
            ->pluck('course_id')
            ->toArray();

        // If not enrolled in specific courses yet, show general schedules
        $query = LmsClassSchedule::with(['course', 'batch']);
        if (!empty($enrolledCourseIds)) {
            $query->whereIn('course_id', $enrolledCourseIds);
        }

        $schedules = $query->orderBy('class_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('frontend.theme.clasic.student.schedules.schedule', compact('student', 'schedules'));
    }

    /**
     * Attendance History and Percentage Analytics
     */
    public function attendance()
    {
        $student = Auth::guard('student')->user();

        $attendances = LmsAttendance::where('student_account_id', $student->id)
            ->with(['course', 'schedule'])
            ->orderBy('attendance_date', 'desc')
            ->paginate(15);

        $totalDays = LmsAttendance::where('student_account_id', $student->id)->count();
        $presentDays = LmsAttendance::where('student_account_id', $student->id)->where('status', 'present')->count();
        $lateDays = LmsAttendance::where('student_account_id', $student->id)->where('status', 'late')->count();
        $absentDays = LmsAttendance::where('student_account_id', $student->id)->where('status', 'absent')->count();

        $attendancePercentage = $totalDays > 0 ? (int) round((($presentDays + ($lateDays * 0.5)) / $totalDays) * 100) : 100;

        return view('frontend.theme.clasic.student.schedules.attendance', compact(
            'student', 'attendances', 'totalDays', 'presentDays', 'lateDays', 'absentDays', 'attendancePercentage'
        ));
    }

    /**
     * Live Online Classes Hub
     */
    public function liveClasses()
    {
        $student = Auth::guard('student')->user();
        $today = Carbon::today();

        $liveClasses = LmsClassSchedule::where('class_type', 'live_online')
            ->where('class_date', '>=', $today)
            ->where('is_cancelled', false)
            ->with(['course', 'batch'])
            ->orderBy('class_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('frontend.theme.clasic.student.schedules.live', compact('student', 'liveClasses'));
    }

    /**
     * Recorded Class Lectures Archive
     */
    public function recordedClasses()
    {
        $student = Auth::guard('student')->user();

        $recordedClasses = LmsClassSchedule::where(function ($q) {
                $q->where('class_type', 'recorded')
                  ->orWhereNotNull('recording_url');
            })
            ->with(['course', 'batch'])
            ->orderBy('class_date', 'desc')
            ->paginate(9);

        return view('frontend.theme.clasic.student.schedules.recorded', compact('student', 'recordedClasses'));
    }
}
