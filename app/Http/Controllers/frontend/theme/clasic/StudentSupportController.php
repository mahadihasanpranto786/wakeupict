<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\model\LmsSupportTicket;
use App\model\LmsTicketReply;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StudentSupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Display student support tickets listing
     */
    public function index(Request $request)
    {
        $student = Auth::guard('student')->user();

        $query = LmsSupportTicket::where('student_account_id', $student->id)
            ->withCount('replies');

        if ($request->status && in_array($request->status, ['open', 'in_progress', 'answered', 'closed'])) {
            $query->where('status', $request->status);
        }

        $tickets = $query->orderBy('last_reply_at', 'desc')->paginate(12);

        $counts = [
            'total' => LmsSupportTicket::where('student_account_id', $student->id)->count(),
            'open' => LmsSupportTicket::where('student_account_id', $student->id)->whereIn('status', ['open', 'in_progress'])->count(),
            'answered' => LmsSupportTicket::where('student_account_id', $student->id)->where('status', 'answered')->count(),
            'closed' => LmsSupportTicket::where('student_account_id', $student->id)->where('status', 'closed')->count(),
        ];

        return view('frontend.theme.clasic.student.support.index', compact('student', 'tickets', 'counts'));
    }

    /**
     * Show ticket creation form
     */
    public function create()
    {
        $student = Auth::guard('student')->user();
        return view('frontend.theme.clasic.student.support.create', compact('student'));
    }

    /**
     * Store new support ticket
     */
    public function store(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'subject' => 'required|string|max:191',
            'category' => 'required|in:academic,technical,fees_payment,exam_quiz,general',
            'priority' => 'required|in:low,medium,high,urgent',
            'message' => 'required|string|min:10',
            'attachment' => 'nullable|file|mimes:pdf,png,jpg,jpeg,doc,docx,zip|max:5120',
        ]);

        $ticket = LmsSupportTicket::create([
            'student_account_id' => $student->id,
            'ticket_number' => LmsSupportTicket::generateTicketNumber(),
            'subject' => $request->subject,
            'category' => $request->category,
            'priority' => $request->priority,
            'status' => 'open',
            'last_reply_at' => Carbon::now(),
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('support_attachments', 'public');
        }

        LmsTicketReply::create([
            'ticket_id' => $ticket->id,
            'student_account_id' => $student->id,
            'message' => $request->message,
            'attachment_file' => $attachmentPath,
        ]);

        return redirect()->route('student.support.show', $ticket->id)
            ->with('success', 'Your support ticket has been created successfully. Our team will review and reply shortly.');
    }

    /**
     * View ticket details and thread
     */
    public function show($id)
    {
        $student = Auth::guard('student')->user();

        $ticket = LmsSupportTicket::where('student_account_id', $student->id)
            ->with(['replies' => function ($q) {
                $q->with(['student', 'user'])->orderBy('created_at', 'asc');
            }])
            ->findOrFail($id);

        return view('frontend.theme.clasic.student.support.show', compact('student', 'ticket'));
    }

    /**
     * Post a reply to ticket
     */
    public function reply(Request $request, $id)
    {
        $student = Auth::guard('student')->user();

        $ticket = LmsSupportTicket::where('student_account_id', $student->id)->findOrFail($id);

        $request->validate([
            'message' => 'required|string|min:3',
            'attachment' => 'nullable|file|mimes:pdf,png,jpg,jpeg,doc,docx,zip|max:5120',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('support_attachments', 'public');
        }

        LmsTicketReply::create([
            'ticket_id' => $ticket->id,
            'student_account_id' => $student->id,
            'message' => $request->message,
            'attachment_file' => $attachmentPath,
        ]);

        // If ticket was closed, re-open it
        $ticket->status = 'in_progress';
        $ticket->last_reply_at = Carbon::now();
        $ticket->save();

        return redirect()->route('student.support.show', $ticket->id)
            ->with('success', 'Your reply has been posted successfully.');
    }
}
