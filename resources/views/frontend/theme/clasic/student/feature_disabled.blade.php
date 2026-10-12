@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Feature Temporarily Unavailable — Wake Up ICT')
@section('page_title', 'Module Status')
@section('page_crumb', 'Notice')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 text-center">
    <div class="p-8 sm:p-12 rounded-3xl bg-slate-900/80 border border-slate-800 backdrop-blur-2xl shadow-2xl">
        <div class="w-20 h-20 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fa fa-lock"></i>
        </div>

        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-mono uppercase tracking-wider mb-4">
            <span>Maintenance & Configuration</span>
        </div>

        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3">
            This module is temporarily unavailable
        </h2>
        <p class="text-sm sm:text-base text-slate-300 mb-8 leading-relaxed">
            The administrator has temporarily paused access to this feature. Please rest assured that all your personal records, submissions, and course history remain completely safe and intact.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('student.dashboard') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-wider bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all shadow-glow-emerald flex items-center justify-center gap-2">
                <i class="fa fa-arrow-left"></i>
                <span>Return to Dashboard</span>
            </a>
            <a href="{{ route('student.profile.index') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-wider bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 transition-all flex items-center justify-center gap-2">
                <i class="fa fa-user-circle"></i>
                <span>View My Profile</span>
            </a>
        </div>
    </div>
</div>
@endsection
