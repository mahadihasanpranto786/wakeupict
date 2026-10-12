@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Live Online Classes Hub — Wake Up ICT')
@section('page_title', 'Live Classes')
@section('page_crumb', 'Live Online Sessions')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-video-camera text-brand-primary"></i>
                <span>Live Interactive Class Sessions</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Direct live broadcast rooms via Zoom and Google Meet with real-time instructor Q&A.
            </p>
        </div>
        <a href="{{ route('student.schedule.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-calendar"></i>
            <span>Full Schedule</span>
        </a>
    </div>

    @if($liveClasses->count() > 0)
        <div class="space-y-4">
            @foreach($liveClasses as $cls)
                @php
                    $isLive = $cls->isLiveNow();
                @endphp
                <div class="student-card rounded-3xl bg-slate-900/80 border {{ $isLive ? 'border-brand-primary shadow-glow-emerald' : 'border-slate-800' }} p-6 sm:p-7 backdrop-blur-xl hover:border-slate-700 transition-all space-y-5">
                    
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-2">
                                @if($isLive)
                                    <span class="px-3 py-1 rounded-full bg-rose-500 text-white font-mono text-xs font-black uppercase flex items-center gap-2 animate-pulse">
                                        <span class="w-2 h-2 rounded-full bg-white"></span>
                                        <span>Live Now</span>
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-brand-primary font-mono text-xs font-bold">
                                        Scheduled Live
                                    </span>
                                @endif

                                <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-300 font-mono text-xs">
                                    {{ $cls->meeting_platform == 'google_meet' ? 'Google Meet' : 'Zoom Cloud Meeting' }}
                                </span>
                            </div>

                            <h3 class="text-lg sm:text-xl font-bold text-white">
                                {{ $cls->title }}
                            </h3>

                            <p class="text-xs sm:text-sm text-slate-400 max-w-3xl leading-relaxed">
                                {{ $cls->description }}
                            </p>
                        </div>

                        <!-- Big Join Button -->
                        <div class="shrink-0 self-start md:self-auto">
                            @if($cls->meeting_link)
                                <a href="{{ $cls->meeting_link }}" target="_blank" class="px-6 py-3.5 rounded-2xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                                    <i class="fa fa-video-camera"></i>
                                    <span>Launch Live Class</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Meta Details: Date, Time, Meeting ID, Passcode -->
                    <div class="pt-4 border-t border-slate-800/80 grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs font-mono">
                        <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800/80">
                            <span class="text-slate-500 block text-[10px]">Date</span>
                            <span class="font-bold text-white">{{ $cls->class_date->format('M d, Y (D)') }}</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800/80">
                            <span class="text-slate-500 block text-[10px]">Time Slot</span>
                            <span class="font-bold text-brand-primary">{{ $cls->formatted_time }}</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800/80">
                            <span class="text-slate-500 block text-[10px]">Meeting ID</span>
                            <span class="font-bold text-slate-300">{{ $cls->meeting_id ?: 'Direct Link Only' }}</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800/80">
                            <span class="text-slate-500 block text-[10px]">Passcode</span>
                            <span class="font-bold text-slate-300">{{ $cls->meeting_password ?: 'Open Access' }}</span>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-video-camera"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Live Classes Right Now</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                There are no live broadcasts currently active. Check the full timetable to view upcoming scheduled sessions.
            </p>
            <a href="{{ route('student.schedule.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider shadow-glow-emerald">
                <span>View Full Class Schedule</span>
            </a>
        </div>
    @endif

</div>
@endsection
