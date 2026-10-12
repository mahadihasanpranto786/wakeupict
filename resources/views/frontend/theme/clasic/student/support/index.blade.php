@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Helpdesk & Support Tickets — Wake Up ICT')
@section('page_title', 'Helpdesk & Support Communication')
@section('page_crumb', 'Support Tickets')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-headset text-brand-primary"></i>
                <span>Student Support &amp; Helpdesk</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Have questions about your coursework, live classes, exams, or payments? Open a ticket with our support engineers.
            </p>
        </div>
        <div>
            <a href="{{ route('student.support.create') }}" class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all shadow-glow-emerald hover:-translate-y-0.5 flex items-center gap-2">
                <i class="fa fa-plus"></i>
                <span>Open New Ticket</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-4 backdrop-blur-xl">
            <span class="text-xs text-slate-400 block mb-1">Total Tickets</span>
            <span class="text-2xl font-black text-white font-mono">{{ $counts['total'] }}</span>
        </div>
        <div class="student-card rounded-2xl bg-slate-900/80 border border-amber-500/20 p-4 backdrop-blur-xl">
            <span class="text-xs text-amber-400 block mb-1">Open / In Progress</span>
            <span class="text-2xl font-black text-amber-400 font-mono">{{ $counts['open'] }}</span>
        </div>
        <div class="student-card rounded-2xl bg-slate-900/80 border border-emerald-500/20 p-4 backdrop-blur-xl">
            <span class="text-xs text-emerald-400 block mb-1">Answered</span>
            <span class="text-2xl font-black text-emerald-400 font-mono">{{ $counts['answered'] }}</span>
        </div>
        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-4 backdrop-blur-xl">
            <span class="text-xs text-slate-400 block mb-1">Resolved & Closed</span>
            <span class="text-2xl font-black text-slate-400 font-mono">{{ $counts['closed'] }}</span>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap items-center gap-2">
        <a href="{{ route('student.support.index') }}" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ !request('status') ? 'bg-brand-primary text-slate-950 font-bold shadow-glow-emerald' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}">
            All Tickets
        </a>
        <a href="{{ route('student.support.index', ['status' => 'open']) }}" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ request('status') === 'open' ? 'bg-brand-primary text-slate-950 font-bold shadow-glow-emerald' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}">
            Open
        </a>
        <a href="{{ route('student.support.index', ['status' => 'answered']) }}" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ request('status') === 'answered' ? 'bg-brand-primary text-slate-950 font-bold shadow-glow-emerald' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}">
            Answered
        </a>
        <a href="{{ route('student.support.index', ['status' => 'closed']) }}" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ request('status') === 'closed' ? 'bg-brand-primary text-slate-950 font-bold shadow-glow-emerald' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}">
            Closed
        </a>
    </div>

    <!-- Tickets Table / List -->
    @if($tickets->count() > 0)
        <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 overflow-hidden shadow-2xl backdrop-blur-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-800 bg-slate-950/60 font-mono text-slate-400 uppercase text-[10px] tracking-wider">
                            <th class="py-4 px-6">Ticket ID</th>
                            <th class="py-4 px-6">Subject</th>
                            <th class="py-4 px-4">Category</th>
                            <th class="py-4 px-4">Priority</th>
                            <th class="py-4 px-4">Status</th>
                            <th class="py-4 px-4">Last Activity</th>
                            <th class="py-4 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @foreach($tickets as $tkt)
                            @php
                                $statusBadge = 'bg-slate-800 text-slate-400 border-slate-700';
                                if ($tkt->status === 'open') $statusBadge = 'bg-amber-500/10 text-amber-400 border-amber-500/30';
                                elseif ($tkt->status === 'in_progress') $statusBadge = 'bg-blue-500/10 text-blue-400 border-blue-500/30';
                                elseif ($tkt->status === 'answered') $statusBadge = 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30';

                                $prioBadge = 'text-slate-400';
                                if ($tkt->priority === 'urgent') $prioBadge = 'text-rose-400 font-bold';
                                elseif ($tkt->priority === 'high') $prioBadge = 'text-amber-400 font-bold';
                            @endphp
                            <tr class="hover:bg-slate-800/40 transition-colors">
                                <td class="py-4 px-6 font-mono text-brand-primary font-bold">
                                    {{ $tkt->ticket_number }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-white max-w-xs truncate">
                                    <a href="{{ route('student.support.show', $tkt->id) }}" class="hover:text-brand-primary transition-colors">
                                        {{ $tkt->subject }}
                                    </a>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-800 border border-slate-700 text-slate-300 font-mono text-[10px] uppercase">
                                        {{ str_replace('_', ' ', $tkt->category) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 font-mono text-[11px] {{ $prioBadge }} uppercase">
                                    {{ $tkt->priority }}
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-0.5 rounded-full border text-[10px] font-mono font-bold uppercase {{ $statusBadge }}">
                                        {{ str_replace('_', ' ', $tkt->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-slate-400 font-mono text-[11px]">
                                    {{ $tkt->last_reply_at ? $tkt->last_reply_at->diffForHumans() : $tkt->created_at->diffForHumans() }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('student.support.show', $tkt->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition-colors font-semibold">
                                        <span>View</span>
                                        <i class="fa fa-chevron-right text-[10px]"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-slate-800">
                {{ $tickets->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="student-card p-12 text-center rounded-3xl bg-slate-900/60 border border-slate-800 space-y-4">
            <div class="w-16 h-16 rounded-full bg-slate-800 text-slate-500 flex items-center justify-center mx-auto text-2xl">
                <i class="fa fa-ticket-alt"></i>
            </div>
            <h3 class="text-base font-bold text-white">No tickets found</h3>
            <p class="text-xs sm:text-sm text-slate-400 max-w-md mx-auto">
                You haven't opened any support tickets yet or none match your selected status. Click below if you need assistance.
            </p>
            <div>
                <a href="{{ route('student.support.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs uppercase bg-brand-primary text-slate-950">
                    <i class="fa fa-plus"></i>
                    <span>Create Ticket</span>
                </a>
            </div>
        </div>
    @endif

    <!-- Helpline Banner -->
    <div class="rounded-2xl bg-gradient-to-r from-blue-950/40 to-slate-900 border border-blue-500/20 p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa fa-phone-volume"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-white">Need Urgent Immediate Assistance?</h4>
                <p class="text-xs text-slate-400">Our student hotline is available Saturday to Thursday (9:00 AM – 9:00 PM).</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="tel:01700000000" class="px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-bold text-xs transition-colors flex items-center gap-2">
                <i class="fa fa-phone"></i>
                <span>Direct Hotline</span>
            </a>
        </div>
    </div>

</div>
@endsection
