<?php

namespace App\Http\Controllers\backend\theme\clasic\lms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\LmsCertificate;
use App\model\LmsEnrollment;
use App\model\Course;
use App\model\StudentAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all certificates and issuance control center
     */
    public function index(Request $request)
    {
        $query = LmsCertificate::with(['student', 'course'])->latest();

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by publishing status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by student name, roll, phone, or certificate code
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('certificate_code', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhereHas('student', function ($sq) use ($search) {
                      $sq->where('name', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('student_id_code', 'like', "%{$search}%");
                  });
            });
        }

        $certificates = $query->paginate(20)->appends($request->all());

        // Stats
        $totalCerts = LmsCertificate::count();
        $issuedCerts = LmsCertificate::where('status', 'issued')->count();
        $pendingCerts = LmsCertificate::where('status', '!=', 'issued')->count();

        // Dropdown data
        $courses = Course::where('status', 1)->orderBy('course_title', 'asc')->get();
        $students = StudentAccount::with(['enrollments.course'])->latest()->get();

        return view('backend.theme.clasic.lms.certificates.index', compact(
            'certificates', 'courses', 'students', 'totalCerts', 'issuedCerts', 'pendingCerts'
        ));
    }

    /**
     * Issue or publish a new certificate
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_account_id' => 'required|exists:student_accounts,id',
            'course_id'          => 'required|exists:courses,id',
            'title'              => 'nullable|string|max:191',
            'grade'              => 'required|string|max:10',
            'score_percentage'   => 'required|numeric|min:0|max:100',
            'issue_date'         => 'required|date',
            'status'             => 'required|in:issued,pending',
        ]);

        $course = Course::findOrFail($request->course_id);
        $title = $request->title ?: 'Certificate of Professional Completion: ' . $course->course_title;

        // Check if certificate already exists for this student & course
        $existing = LmsCertificate::where('student_account_id', $request->student_account_id)
            ->where('course_id', $request->course_id)
            ->first();

        if ($existing) {
            $existing->update([
                'title'            => $title,
                'grade'            => mb_strtoupper(trim((string)$request->grade), 'UTF-8'),
                'score_percentage' => (float) $request->score_percentage,
                'issue_date'       => Carbon::parse($request->issue_date),
                'status'           => $request->status,
            ]);

            return redirect()->back()->with('success', 'Existing certificate updated successfully with status: ' . ucfirst($request->status));
        }

        LmsCertificate::create([
            'student_account_id' => $request->student_account_id,
            'course_id'          => $request->course_id,
            'certificate_code'   => LmsCertificate::generateCertificateCode(),
            'title'              => $title,
            'grade'              => mb_strtoupper(trim((string)$request->grade), 'UTF-8'),
            'score_percentage'   => (float) $request->score_percentage,
            'issue_date'         => Carbon::parse($request->issue_date),
            'status'             => $request->status,
            'verification_hash'  => LmsCertificate::generateVerificationHash(),
        ]);

        return redirect()->back()->with('success', 'Certificate successfully ' . ($request->status === 'issued' ? 'PUBLISHED and now visible in student portal!' : 'created as DRAFT/PENDING.'));
    }

    /**
     * Toggle publishing status (issued vs pending)
     */
    public function toggle($id)
    {
        $cert = LmsCertificate::findOrFail($id);
        $cert->status = ($cert->status === 'issued') ? 'pending' : 'issued';
        $cert->save();

        $msg = ($cert->status === 'issued')
            ? 'Certificate PUBLISHED! It is now visible to the student in their portal.'
            : 'Certificate UNPUBLISHED/PENDING. It is now hidden from the student portal.';

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Update certificate details
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'            => 'required|string|max:191',
            'grade'            => 'required|string|max:10',
            'score_percentage' => 'required|numeric|min:0|max:100',
            'issue_date'       => 'required|date',
            'status'           => 'required|in:issued,pending',
        ]);

        $cert = LmsCertificate::findOrFail($id);
        $cert->update([
            'title'            => $request->title,
            'grade'            => mb_strtoupper(trim((string)$request->grade), 'UTF-8'),
            'score_percentage' => (float) $request->score_percentage,
            'issue_date'       => Carbon::parse($request->issue_date),
            'status'           => $request->status,
        ]);

        return redirect()->back()->with('success', 'Certificate details updated successfully.');
    }

    /**
     * Delete certificate
     */
    public function destroy($id)
    {
        $cert = LmsCertificate::findOrFail($id);
        $cert->delete();

        return redirect()->back()->with('success', 'Certificate deleted successfully.');
    }
}
