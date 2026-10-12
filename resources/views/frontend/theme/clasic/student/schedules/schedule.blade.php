@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Class Schedule & Timetable — Wake Up ICT')
@section('page_title', 'Class Schedule')
@section('page_crumb', 'Weekly Timetable')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-calendar text-brand-primary"></i>
                <span>Weekly Class Schedule &amp; Timetable</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Schedule for live online sessions, interactive lab workshops, and campus classroom lectures.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('student.live.index') }}" class="px-4 py-2 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-1.5">
                <i class="fa fa-video-camera"></i>
                <span>Live Classes</span>
            </a>
            <a href="{{ route('student.attendance.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-xs border border-slate-700 transition-colors flex items-center gap-1.5">
                <i class="fa fa-check-square-o"></i>
                <span>My Attendance</span>
            </a>
        </div>
    </div>

    @if($schedules->count() > 0)
        <!-- Schedule Timeline / Cards -->
        <div class="space-y-4">
            @foreach($schedules as $sched)
                @php
                    $isLive = $sched->isLiveNow();
                    $isPast = Carbon\Carbon::parse($sched->class_date->format('Y-m-d') . ' ' . $sched->end_time)->isPast();
                @endphp
                <div class="student-card rounded-3xl bg-slate-900/80 border {{ $isLive ? 'border-brand-primary shadow-glow-emerald' : 'border-slate-800' }} p-6 backdrop-blur-xl hover:border-slate-700 transition-all">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        
                        <!-- Left Details -->
                        <div class="flex items-start gap-4">
                            <!-- Date Box -->
                            <div class="w-16 h-16 rounded-2xl bg-slate-950 border border-slate-800 flex flex-col items-center justify-center font-mono shrink-0 text-center">
                                <span class="text-[10px] text-brand-primary font-bold uppercase">{{ $sched->class_date->format('M') }}</span>
                                <span class="text-xl font-black text-white leading-none">{{ $sched->class_date->format('d') }}</span>
                                <span class="text-[9px] text-slate-500 uppercase">{{ $sched->class_date->format('D') }}</span>
                            </div>

                            <div class="space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                        {{ $sched->course ? $sched->course->course_title : 'General Training' }}
                                    </span>

                                    @if($isLive)
                                        <span class="px-2.5 py-0.5 rounded-full bg-rose-500 text-white font-mono text-[10px] font-black uppercase flex items-center gap-1.5 animate-pulse">
                                            <span class="w-2 h-2 rounded-full bg-white"></span>
                                            <span>Happening Now</span>
                                        </span>
                                    @elseif($sched->class_type == 'offline_lab')
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 font-mono text-[10px] font-bold">
                                            Campus Lab
                                        </span>
                                    @elseif($sched->class_type == 'recorded')
                                        <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-400 font-mono text-[10px] font-bold">
                                            Recorded Replay
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan font-mono text-[10px] font-bold">
                                            Live Online
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-base font-bold text-white">
                                    {{ $sched->title }}
                                </h3>

                                <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                    {{ $sched->description }}
                                </p>

                                <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-slate-400 pt-1">
                                    <span><i class="fa fa-clock-o text-brand-primary mr-1"></i> {{ $sched->formatted_time }}</span>
                                    @if($sched->room_number)
                                        <span><i class="fa fa-building text-amber-400 mr-1"></i> {{ $sched->room_number }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Action Buttons -->
                        <div class="flex items-center gap-3 self-end md:self-auto shrink-0">
                            @if($sched->class_type == 'live_online' && $sched->meeting_link)
                                <a href="{{ $sched->meeting_link }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                                    <i class="fa fa-video-camera"></i>
                                    <span>Join Session</span>
                                </a>
                            @elseif($sched->recording_url)
                                <a href="{{ $sched->recording_url }}" target="_blank" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-xs border border-slate-700 transition-colors flex items-center gap-1.5">
                                    <i class="fa fa-play"></i>
                                    <span>Watch Replay</span>
                                </a>
                            @else
                                <span class="px-3.5 py-2 rounded-xl bg-slate-950 text-slate-500 font-mono text-xs border border-slate-800">
                                    {{ $sched->room_number ?: 'Scheduled' }}
                                </span>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-calendar-o"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Classes Scheduled</h3>
            <p class="text-xs text-slate-400">Class schedules for your batch will be published here.</p>
        </div>
    @endif

</div>
@endsection
