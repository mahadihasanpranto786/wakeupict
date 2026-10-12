@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Ticket #' . $ticket->ticket_number . ' — Wake Up ICT')
@section('page_title', 'Support Conversation')
@section('page_crumb', 'Ticket #' . $ticket->ticket_number)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation & Action -->
    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
        <a href="{{ route('student.support.index') }}" class="px-3.5 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-300 hover:text-white transition-colors flex items-center gap-1.5">
            <i class="fa fa-arrow-left"></i>
            <span>Back to All Tickets</span>
        </a>
        <div class="flex items-center gap-2">
            @php
                $statusBadge = 'bg-slate-800 text-slate-400 border-slate-700';
                if ($ticket->status === 'open') $statusBadge = 'bg-amber-500/10 text-amber-400 border-amber-500/30';
                elseif ($ticket->status === 'in_progress') $statusBadge = 'bg-blue-500/10 text-blue-400 border-blue-500/30';
                elseif ($ticket->status === 'answered') $statusBadge = 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30';
            @endphp
            <span class="px-3 py-1 rounded-full border text-xs font-mono font-bold uppercase {{ $statusBadge }}">
                Status: {{ str_replace('_', ' ', $ticket->status) }}
            </span>
        </div>
    </div>

    <!-- Ticket Details Card -->
    <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl shadow-2xl relative overflow-hidden">
        <div class="space-y-4">
            <div class="flex flex-wrap items-center gap-2 font-mono text-xs">
                <span class="text-brand-primary font-bold">{{ $ticket->ticket_number }}</span>
                <span class="text-slate-600">•</span>
                <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-300 uppercase text-[10px]">
                    {{ str_replace('_', ' ', $ticket->category) }}
                </span>
                <span class="text-slate-600">•</span>
                <span class="uppercase text-[10px] {{ $ticket->priority === 'urgent' ? 'text-rose-400 font-bold' : ($ticket->priority === 'high' ? 'text-amber-400 font-bold' : 'text-slate-400') }}">
                    Priority: {{ $ticket->priority }}
                </span>
                <span class="text-slate-600">•</span>
                <span class="text-slate-400">Opened: {{ $ticket->created_at->format('M d, Y h:i A') }}</span>
            </div>

            <h1 class="text-lg sm:text-2xl font-black text-white leading-snug">
                {{ $ticket->subject }}
            </h1>
        </div>
    </div>

    <!-- Conversation Stream -->
    <div class="space-y-4">
        <h2 class="text-sm font-mono uppercase text-slate-400 tracking-wider flex items-center gap-2 px-1">
            <i class="fa fa-comments text-brand-primary"></i>
            <span>Conversation Thread ({{ $ticket->replies->count() }} {{ Str::plural('message', $ticket->replies->count()) }})</span>
        </h2>

        @foreach($ticket->replies as $reply)
            @php
                $isStaff = !is_null($reply->user_id);
            @endphp
            <div class="student-card rounded-3xl p-6 sm:p-7 backdrop-blur-xl border transition-all {{ $isStaff ? 'bg-gradient-to-r from-slate-900/95 to-blue-950/40 border-blue-500/30 shadow-xl' : 'bg-slate-900/80 border-slate-800' }}">
                <div class="flex items-start gap-4">
                    <!-- Avatar -->
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl flex items-center justify-center flex-shrink-0 font-bold text-sm {{ $isStaff ? 'bg-brand-primary text-slate-950 shadow-glow-emerald' : 'bg-slate-800 text-slate-300' }}">
                        @if($isStaff)
                            <i class="fa fa-shield-alt"></i>
                        @else
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-1 space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-sm sm:text-base text-white">
                                    {{ $isStaff ? ($reply->user ? $reply->user->name : 'Wake Up ICT Support') : $student->name }}
                                </span>
                                @if($isStaff)
                                    <span class="px-2 py-0.5 rounded-full bg-blue-500/20 border border-blue-500/30 text-blue-300 font-mono text-[10px] font-bold uppercase">
                                        Faculty Staff
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full bg-slate-800 border border-slate-700 text-slate-400 font-mono text-[10px]">
                                        Student
                                    </span>
                                @endif
                            </div>
                            <span class="text-slate-400 font-mono text-xs flex items-center gap-1">
                                <i class="fa fa-clock text-[10px]"></i>
                                {{ $reply->created_at->diffForHumans() }} ({{ $reply->created_at->format('h:i A') }})
                            </span>
                        </div>

                        <!-- Message Body -->
                        <div class="text-xs sm:text-sm text-slate-200 leading-relaxed font-sans whitespace-pre-line">
                            {{ $reply->message }}
                        </div>

                        <!-- Attachment -->
                        @if($reply->attachment_file)
                            <div class="pt-2">
                                <a href="{{ asset('storage/' . $reply->attachment_file) }}" target="_blank"
                                   class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-950/80 border border-slate-800 text-brand-primary hover:text-white text-xs font-mono transition-colors">
                                    <i class="fa fa-paperclip"></i>
                                    <span>Download Attachment</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Reply Box -->
    <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl shadow-2xl space-y-4">
        <h3 class="text-base font-bold text-white flex items-center gap-2">
            <i class="fa fa-reply text-brand-primary"></i>
            <span>Post a Response</span>
        </h3>

        @if($ticket->status === 'closed')
            <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-300 text-xs flex items-center gap-2">
                <i class="fa fa-info-circle"></i>
                <span>This ticket is currently resolved. Posting a reply will automatically reopen it for our support advisors.</span>
            </div>
        @endif

        <form action="{{ route('student.support.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <textarea name="message" rows="4" required minlength="3"
                          placeholder="Type your reply here..."
                          class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 focus:border-brand-primary text-white text-xs sm:text-sm focus:outline-none focus:ring-1 focus:ring-brand-primary transition-all">{{ old('message') }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="w-full sm:w-auto">
                    <input type="file" name="attachment"
                           class="w-full text-xs text-slate-400 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                </div>

                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all shadow-glow-emerald flex items-center justify-center gap-2">
                    <i class="fa fa-paper-plane"></i>
                    <span>Send Reply</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
