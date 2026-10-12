@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Attendance History & Performance — Wake Up ICT')
@section('page_title', 'Attendance History')
@section('page_crumb', 'Class Attendance Log')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-check-square-o text-brand-primary"></i>
                <span>Attendance History &amp; Analytics</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Monitor your daily session attendance, classroom participation, and cumulative eligibility rate.
            </p>
        </div>
        <a href="{{ route('student.schedule.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-calendar"></i>
            <span>View Class Schedule</span>
        </a>
    </div>

    <!-- Attendance KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 font-mono">
        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Attendance Rate</span>
            <span class="text-3xl font-black {{ $attendancePercentage >= 80 ? 'text-brand-primary' : ($attendancePercentage >= 60 ? 'text-amber-400' : 'text-rose-400') }}">
                {{ $attendancePercentage }}%
            </span>
            <span class="text-[11px] text-slate-500 block mt-1">{{ $attendancePercentage >= 75 ? 'Eligibility met' : 'Below 75% target' }}</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Present</span>
            <span class="text-3xl font-black text-emerald-400">{{ $presentDays }}</span>
            <span class="text-[11px] text-slate-500 block mt-1">Full sessions attended</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Late</span>
            <span class="text-3xl font-black text-amber-400">{{ $lateDays }}</span>
            <span class="text-[11px] text-slate-500 block mt-1">Joined after start</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Absent</span>
            <span class="text-3xl font-black text-rose-400">{{ $absentDays }}</span>
            <span class="text-[11px] text-slate-500 block mt-1">Missed sessions</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Total Days</span>
            <span class="text-3xl font-black text-white">{{ $totalDays }}</span>
            <span class="text-[11px] text-slate-500 block mt-1">Sessions recorded</span>
        </div>
    </div>

    <!-- Attendance Log Table -->
    @if($attendances->count() > 0)
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden backdrop-blur-xl shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-mono">
                    <thead class="bg-slate-950/80 text-slate-400 uppercase text-[10px] border-b border-slate-800">
                        <tr>
                            <th class="p-4">Date</th>
                            <th class="p-4">Course Program</th>
                            <th class="p-4">Class Topic</th>
                            <th class="p-4">Attendance Status</th>
                            <th class="p-4">Remarks</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-slate-300">
                        @foreach($attendances as $att)
                            <tr class="hover:bg-slate-850/40 transition-colors">
                                <td class="p-4 font-bold text-white">
                                    {{ $att->attendance_date ? $att->attendance_date->format('M d, Y') : '-' }}
                                </td>
                                <td class="p-4 text-slate-300">
                                    {{ $att->course ? $att->course->course_title : 'General' }}
                                </td>
                                <td class="p-4 text-slate-400">
                                    {{ $att->schedule ? $att->schedule->title : 'Regular Class Lecture' }}
                                </td>
                                <td class="p-4">
                                    @if($att->status === 'present')
                                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold">
                                            <i class="fa fa-check mr-1"></i> Present
                                        </span>
                                    @elseif($att->status === 'late')
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-[10px] font-bold">
                                            <i class="fa fa-clock-o mr-1"></i> Late
                                        </span>
                                    @elseif($att->status === 'excused')
                                        <span class="px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan text-[10px] font-bold">
                                            <i class="fa fa-info-circle mr-1"></i> Excused
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-[10px] font-bold">
                                            <i class="fa fa-times mr-1"></i> Absent
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-slate-500">
                                    {{ $att->remarks ?: 'Recorded by Instructor' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-800/60">
                {{ $attendances->links() }}
            </div>
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-calendar-check-o"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Attendance Records Yet</h3>
            <p class="text-xs text-slate-400">Your attendance logs will appear here as course sessions commence.</p>
        </div>
    @endif

</div>
@endsection
