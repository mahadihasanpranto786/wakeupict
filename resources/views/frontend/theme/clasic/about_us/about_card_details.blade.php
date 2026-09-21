@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen pt-32 pb-24">
    
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Member Profile Header Card -->
        <div class="rounded-3xl bg-slate-900/80 border border-slate-800/90 p-8 sm:p-12 backdrop-blur-xl shadow-2xl mb-12">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left: Profile Photo & Tech Stacks (Cols 5) -->
                <div class="md:col-span-5 flex flex-col">
                    <div class="rounded-2xl overflow-hidden bg-slate-950 border-2 border-slate-800 shadow-xl mb-8 aspect-square">
                        <img class="w-full h-full object-cover filter contrast-105" src="{{ asset($about->image) }}" alt="{{ $about->name }}">
                    </div>

                    @if (!empty($about->assign_stacks) && count($about->assign_stacks) > 0)
                        <div class="p-5 rounded-2xl bg-slate-950/60 border border-slate-800/80">
                            <h4 class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-4">
                                Technology Stack & Specialization:
                            </h4>
                            <ul class="flex flex-wrap gap-2.5">
                                @foreach ($about->assign_stacks as $stack)
                                    <li class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-700/80 text-xs font-mono text-slate-200">
                                        <img width="20" height="20" class="object-contain" src="{{ asset($stack->stack->logo) }}" alt="{{ $stack->stack->name }}">
                                        <span>{{ $stack->stack->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Right: Bio & Designation (Cols 7) -->
                <div class="md:col-span-7 flex flex-col">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-4 w-fit">
                        <span>Verified Specialist</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mb-2 leading-tight">
                        {{ $about->name }}
                    </h1>
                    <p class="text-lg font-mono text-emerald-400 font-semibold mb-6">
                        {{ $about->designation }}
                    </p>

                    @php
                        if ($about->singleAboutDetail) {
                            $joining_date = $about->singleAboutDetail ? \Carbon\Carbon::parse($about->singleAboutDetail->joining_date)->format('F Y') : null;
                            $end_date = $about->singleAboutDetail ? \Carbon\Carbon::parse($about->singleAboutDetail->end_date)->format('F Y') : null;
                        }
                    @endphp

                    @if ($about->singleAboutDetail)
                        <div class="flex items-center gap-3 text-xs font-mono text-slate-400 mb-8 p-3 rounded-xl bg-slate-950/50 border border-slate-800 w-fit">
                            <i class="fa fa-calendar text-emerald-400"></i>
                            <span>{{ $about->singleAboutDetail->employee_type }} : {{ $joining_date }} - {{ $about->singleAboutDetail->currently_working_status == 1 ? 'Present' : $end_date }}</span>
                        </div>

                        <div class="border-t border-slate-800/80 pt-6">
                            <h3 class="text-xs font-mono uppercase tracking-widest text-slate-400 font-semibold mb-3">Executive Summary</h3>
                            <div class="text-slate-300 text-sm sm:text-base leading-relaxed space-y-4">
                                {!! $about->singleAboutDetail->description !!}
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- Projects Timeline / Portfolio Section -->
        @if (count($about->projects) > 0)
            <div class="rounded-3xl bg-slate-900/60 border border-slate-800/80 p-8 sm:p-12 backdrop-blur-xl">
                <h2 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
                    <i class="fa fa-code-fork text-emerald-400"></i>
                    <span>Key Engineering Projects</span>
                </h2>

                <div class="space-y-6">
                    @foreach ($about->projects as $project)
                        @php
                            $start_date = $project ? \Carbon\Carbon::parse($project->start_date)->format('M Y') : '';
                            $end_date = $project ? \Carbon\Carbon::parse($project->end_date)->format('M Y') : '';
                            $is_checked = $project->currently_working_status;
                        @endphp
                        <div class="p-6 rounded-2xl bg-slate-950/70 border border-slate-800/80 hover:border-emerald-500/30 transition-all">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                <h3 class="text-lg font-bold text-white">{{ $project->project_title }}</h3>
                                <span class="text-xs font-mono text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md border border-emerald-500/20 w-fit">
                                    {{ $start_date }} to {{ $is_checked == 1 ? 'Present' : $end_date }}
                                </span>
                            </div>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                {{ $project->short_description }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

</div>
@endsection
