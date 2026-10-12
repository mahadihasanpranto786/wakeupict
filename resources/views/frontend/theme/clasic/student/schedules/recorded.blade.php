@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Recorded Classes & Video Replays — Wake Up ICT')
@section('page_title', 'Recorded Classes')
@section('page_crumb', 'Lecture Replays')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-play-circle text-brand-primary"></i>
                <span>Recorded Class Replays Archive</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Catch up on missed lectures and review detailed technical recordings on-demand.
            </p>
        </div>
        <a href="{{ route('student.schedule.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-calendar"></i>
            <span>Class Timetable</span>
        </a>
    </div>

    @if($recordedClasses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recordedClasses as $rec)
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all group backdrop-blur-xl space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[11px] font-bold">
                                {{ $rec->course ? $rec->course->course_title : 'General Training' }}
                            </span>
                            <span class="text-[11px] font-mono text-slate-500">
                                {{ $rec->class_date->format('M d, Y') }}
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-white group-hover:text-brand-primary transition-colors line-clamp-2 leading-snug">
                            {{ $rec->title }}
                        </h3>

                        <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $rec->description ?: 'Full video recording and workshop review.' }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-800/80">
                        @if($rec->recording_url)
                            <a href="{{ $rec->recording_url }}" target="_blank" class="w-full justify-center px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                                <i class="fa fa-play"></i>
                                <span>Watch Video Replay</span>
                            </a>
                        @else
                            <button disabled class="w-full justify-center px-4 py-2.5 rounded-xl bg-slate-800 text-slate-500 font-bold text-xs uppercase tracking-wider cursor-not-allowed flex items-center gap-2">
                                <i class="fa fa-clock-o"></i>
                                <span>Processing Recording</span>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $recordedClasses->links() }}
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-film"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Recorded Replays Yet</h3>
            <p class="text-xs text-slate-400">Class video recordings will appear here after sessions conclude.</p>
        </div>
    @endif

</div>
@endsection
