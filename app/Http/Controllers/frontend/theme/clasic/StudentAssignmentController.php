<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\LmsAssignment;
use App\model\LmsAssignmentSubmission;
use App\model\LmsEnrollment;
use Carbon\Carbon;

class StudentAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Active & Pending Course Assignments
     */
    public function assignments()
    {
        $student = Auth::guard('student')->user();
        $assignments = LmsAssignment::where('is_published', true)
            ->with(['course', 'submissions' => function ($q) use ($student) {
                $q->where('student_account_id', $student->id);
            }])
            ->orderBy('due_date', 'asc')
            ->paginate(9);

        return view('frontend.theme.clasic.student.assignments.index', compact('student', 'assignments'));
    }

    /**
     * Submit Assignment Form / Dropzone
     */
    public function showSubmit($id = null)
    {
        $student = Auth::guard('student')->user();

        if ($id) {
            $assignment = LmsAssignment::with('course')->findOrFail($id);
            $submission = LmsAssignmentSubmission::where('assignment_id', $assignment->id)
                ->where('student_account_id', $student->id)
                ->first();
            return view('frontend.theme.clasic.student.assignments.submit', compact('student', 'assignment', 'submission'));
        }

        // List assignments ready for submission
        $pendingAssignments = LmsAssignment::where('is_published', true)
            ->with('course')
            ->orderBy('due_date', 'asc')
            ->get();

        return view('frontend.theme.clasic.student.assignments.submit_select', compact('student', 'pendingAssignments'));
    }

    /**
     * Store Assignment Submission
     */
    public function storeSubmission(Request $request, $id)
    {
        $student = Auth::guard('student')->user();
        $assignment = LmsAssignment::findOrFail($id);

        $request->validate([
            'submission_text' => 'nullable|string|max:5000',
            'submitted_file' => 'nullable|file|max:25600', // 25MB max
        ]);

        $filePath = null;
        if ($request->hasFile('submitted_file')) {
            $file = $request->file('submitted_file');
            $filename = 'submission_' . $student->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/lms_assignments'), $filename);
            $filePath = 'uploads/lms_assignments/' . $filename;
        }

        $submission = LmsAssignmentSubmission::firstOrNew([
            'assignment_id' => $assignment->id,
            'student_account_id' => $student->id,
        ]);

        if ($filePath) {
            $submission->submitted_file = $filePath;
        }

        if ($request->filled('submission_text')) {
            $submission->submission_text = $request->submission_text;
        }

        $submission->submitted_at = Carbon::now();
        $submission->status = 'submitted';
        $submission->save();

        return redirect()->route('student.assignments.index')->with([
            'success' => 'Your assignment was uploaded and submitted successfully! Instructor will review shortly.',
        ]);
    }

    /**
     * Major Term Projects & Capstones
     */
    public function projects()
    {
        $student = Auth::guard('student')->user();
        $projects = LmsAssignment::where('is_published', true)
            ->where('assignment_type', 'project')
            ->with(['course', 'submissions' => function ($q) use ($student) {
                $q->where('student_account_id', $student->id);
            }])
            ->orderBy('due_date', 'desc')
            ->paginate(9);

        return view('frontend.theme.clasic.student.assignments.projects', compact('student', 'projects'));
    }

    /**
     * Instructor Feedback & Grading Remarks
     */
    public function feedback()
    {
        $student = Auth::guard('student')->user();
        $gradedSubmissions = LmsAssignmentSubmission::where('student_account_id', $student->id)
            ->with(['assignment.course', 'grader'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('frontend.theme.clasic.student.assignments.feedback', compact('student', 'gradedSubmissions'));
    }
}
