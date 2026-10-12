@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen pt-28 pb-24">

    <!-- Course Title & Overview Hero -->
    <section class="relative py-12 border-b border-slate-800/80 bg-gradient-to-b from-slate-900/60 to-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-2.5 mb-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono tracking-wider uppercase font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>{{ __('frontend.academic.course_blueprint') }}</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-mono tracking-wider font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                    <span>অফলাইন ল্যাব ব্যাচ</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-400 text-xs font-mono tracking-wider font-semibold">
                    <i class="fa fa-desktop text-[11px]"></i>
                    <span>আধুনিক কম্পিউটার ল্যাব</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-mono tracking-wider font-semibold">
                    <i class="fa fa-certificate text-[11px]"></i>
                    <span>ভেরিফায়েড সার্টিফিকেট</span>
                </span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                {{ $courses->course_title }}
            </h1>
            <div class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-4xl">
                {!! $courses->long_description !!}
            </div>
        </div>
    </section>

    <!-- Main Course Grid: 8-Column Curriculum / 4-Column Sticky Enrollment Card -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Left 8 Columns: Deep Curriculum & Details -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Why this course is important -->
                    <div class="p-8 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-md">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                                <i class="fa fa-crosshairs text-base"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white">{{ __('frontend.academic.why_important') }}</h3>
                        </div>
                        <div class="text-slate-300 text-base leading-relaxed">
                            {!! $courses->importents !!}
                        </div>
                    </div>

                    <!-- Curriculum Accordion -->
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-white">{{ __('frontend.academic.curriculum_title') }}</h3>
                            <span class="text-xs font-mono text-emerald-400 uppercase tracking-wider">{{ count($Courseitem) }} {{ __('frontend.academic.modules') }}</span>
                        </div>

                        <div class="space-y-4" id="curriculum-accordion">
                            @foreach ($Courseitem as $item)
                                @php
                                    $isFirst = ($item->course_order == 1);
                                @endphp
                                <div class="accordion-item rounded-2xl bg-slate-900/70 border border-slate-800/80 overflow-hidden transition-all duration-200">
                                    <button type="button" class="accordion-toggle w-full flex items-center justify-between p-6 text-left hover:bg-slate-800/40 transition-colors focus:outline-none" onclick="toggleAccordion('item-{{ $item->id }}')">
                                        <div class="flex items-center gap-4">
                                            <span class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-xs font-mono text-emerald-400 font-semibold flex-shrink-0">
                                                {{ sprintf('%02d', $loop->iteration) }}
                                            </span>
                                            <span class="text-base sm:text-lg font-semibold text-white">
                                                {{ $item->item_title }}
                                            </span>
                                        </div>
                                        <i class="fa fa-chevron-down text-xs text-slate-400 transition-transform duration-300 accordion-icon-item-{{ $item->id }} {{ $isFirst ? 'rotate-180' : '' }}"></i>
                                    </button>

                                    <div id="content-item-{{ $item->id }}" class="{{ $isFirst ? 'block' : 'hidden' }} px-6 pb-6 pt-2 border-t border-slate-800/50 text-slate-300 text-sm leading-relaxed">
                                        {!! $item->description !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Post-Course Career Potential & Impact -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="p-8 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-md">
                            <h4 class="text-lg font-bold text-white mb-3 text-emerald-400">{{ __('frontend.academic.career_scope') }}</h4>
                            <div class="text-slate-400 text-sm leading-relaxed">
                                {!! $courses->future_of_this_course !!}
                            </div>
                        </div>

                        <div class="p-8 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-md">
                            <h4 class="text-lg font-bold text-white mb-3 text-cyan-400">{{ $courses->course_title }} {{ __('frontend.academic.future_scope') }}</h4>
                            <div class="text-slate-400 text-sm leading-relaxed">
                                {!! $courses->possibilities_of_this_course !!}
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right 4 Columns: Sticky Enrollment Card -->
                <div class="lg:col-span-4 sticky top-28">
                    <div class="rounded-2xl bg-slate-900/90 border border-slate-800 backdrop-blur-xl shadow-2xl p-6 sm:p-8 overflow-hidden">
                        
                        <!-- Course Image Preview -->
                        <div class="relative w-full h-48 rounded-xl overflow-hidden mb-6 bg-slate-950">
                            <img src="{{ URL::asset($courses->image) }}" class="w-full h-full object-cover" alt="{{ $courses->course_title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3">
                                <span class="px-2.5 py-1 rounded-md bg-emerald-500/90 text-slate-950 font-mono font-bold text-xs">
                                    {{ __('frontend.academic.admissions_open') }}
                                </span>
                            </div>
                        </div>

                        <!-- Price Highlight -->
                        <div class="mb-6 pb-6 border-b border-slate-800">
                            <span class="text-xs font-mono uppercase tracking-wider text-slate-400 block">{{ __('frontend.academic.tuition_fee') }}</span>
                            <div class="text-3xl font-extrabold font-mono text-white tracking-tight mt-1">
                                ৳ {{ $courses->price }} <span class="text-sm font-normal text-emerald-400">BDT</span>
                            </div>
                        </div>

                        <!-- Course Metadata List -->
                        <ul class="space-y-4 text-sm mb-8">
                            <li class="flex items-center justify-between text-slate-300">
                                <span class="flex items-center gap-2 text-slate-400">
                                    <i class="fa fa-calendar text-emerald-400"></i> {{ __('frontend.academic.duration') }}:
                                </span>
                                <span class="font-semibold text-white font-mono">{{ $courses->time_line }}</span>
                            </li>
                            <li class="flex items-center justify-between text-slate-300">
                                <span class="flex items-center gap-2 text-slate-400">
                                    <i class="fa fa-users text-emerald-400"></i> {{ __('frontend.academic.students_per_batch') }}:
                                </span>
                                <span class="font-semibold text-white font-mono">{{ $courses->student_quantity }} {{ __('frontend.academic.persons') }}</span>
                            </li>

                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($course_members as $member)
                                <li class="flex items-center justify-between text-slate-300">
                                    <span class="flex items-center gap-2 text-slate-400">
                                        <i class="fa fa-user-circle text-emerald-400"></i> {{ __('frontend.academic.instructors') }}:
                                    </span>
                                    <span class="font-semibold text-white">{{ App\User::find($member->member_id)->name }}</span>
                                </li>
                            @endforeach

                            @foreach ($course_fassilities as $item)
                                <li class="flex items-center gap-2 text-slate-400 text-xs">
                                    <i class="fa fa-check text-emerald-400"></i>
                                    <span>{{ $item->title }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Direct Enrollment CTA Button -->
                        <a href="{{ url('training/' . $courses->course_slug . '/student-registration') }}" class="flex items-center justify-center gap-3 w-full py-4 px-6 rounded-xl font-bold text-sm tracking-wider uppercase bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                            <i class="fa fa-graduation-cap"></i>
                            <span>{{ __('frontend.academic.register_btn') }}</span>
                        </a>

                        <!-- 10MS Offline Campus Hotline & Counseling -->
                        <div class="mt-4 pt-4 border-t border-slate-800 text-center space-y-2">
                            <p class="text-xs text-slate-400">ক্যাম্পাসে এসে সরাসরি কথা বলতে কল করুন:</p>
                            <a href="tel:{{ app_setting('contact_phone', '01791612121') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl font-bold text-xs bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition-all">
                                <i class="fa fa-phone text-emerald-400"></i>
                                <span>{{ app_setting('contact_phone', '01791-612121') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--========================== Related Courses Matrix ============================-->
    @if (!empty($moreCourses))
        <section class="py-16 border-t border-slate-800/80 bg-slate-900/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-2">{{ __('frontend.academic.explore_next') }}</div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">{{ __('frontend.academic.other_courses') }}</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($moreCourses as $course)
                        <a href="{{ url('training/' . $course->course_slug) }}" class="group block rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-emerald-500/40 overflow-hidden transition-all duration-300 hover:-translate-y-1">
                            <div class="h-48 overflow-hidden bg-slate-950">
                                <img src="{{ URL::asset($course->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $course->course_title }}">
                            </div>
                            <div class="p-6">
                                <h4 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors mb-2">
                                    {{ $course->course_title }}
                                </h4>
                                <div class="text-slate-400 text-xs line-clamp-2">
                                    {!! strip_tags($course->short_description) !!}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</div>

<script>
    function toggleAccordion(id) {
        const content = document.getElementById('content-' + id);
        const icon = document.querySelector('.accordion-icon-' + id);
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            content.classList.add('block');
            if (icon) icon.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            content.classList.remove('block');
            if (icon) icon.classList.remove('rotate-180');
        }
    }
</script>
@endsection
