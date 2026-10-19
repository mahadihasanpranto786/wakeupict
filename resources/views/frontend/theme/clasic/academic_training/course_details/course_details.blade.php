@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-50 dark:bg-slate-950 min-h-screen pt-28 pb-24">

    <!-- Course Title & Overview Hero -->
    <section class="relative py-14 border-b border-slate-200 dark:border-slate-800/80 bg-slate-100/90 dark:bg-gradient-to-b dark:from-slate-900/60 dark:to-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-2.5 mb-5">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100 border border-emerald-300 text-emerald-900 dark:bg-emerald-500/10 dark:border-emerald-500/20 dark:text-emerald-400 text-xs font-mono tracking-wider uppercase font-bold shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-600 dark:bg-emerald-400"></span>
                    <span>{{ __('frontend.academic.course_blueprint') }}</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-rose-100 border border-rose-300 text-rose-900 dark:bg-rose-500/10 dark:border-rose-500/20 dark:text-rose-400 text-xs font-mono tracking-wider font-bold shadow-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 dark:bg-rose-500 animate-pulse"></span>
                    <span>অফলাইন ল্যাব ব্যাচ</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-teal-100 border border-teal-300 text-teal-900 dark:bg-teal-500/10 dark:border-teal-500/20 dark:text-teal-400 text-xs font-mono tracking-wider font-bold shadow-xs">
                    <i class="fa fa-desktop text-[11px]"></i>
                    <span>আধুনিক কম্পিউটার ল্যাব</span>
                </span>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-amber-100 border border-amber-300 text-amber-900 dark:bg-amber-500/10 dark:border-amber-500/20 dark:text-amber-400 text-xs font-mono tracking-wider font-bold shadow-xs">
                    <i class="fa fa-certificate text-[11px]"></i>
                    <span>ভেরিফায়েড সার্টিফিকেট</span>
                </span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-slate-900 dark:text-white mb-6 leading-tight">
                {{ $courses->course_title }}
            </h1>
            <div class="text-slate-700 dark:text-slate-300 text-base sm:text-lg leading-relaxed max-w-4xl">
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
                    <div class="p-8 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800/80 shadow-sm hover-card-lift backdrop-blur-md">
                        <div class="flex items-center gap-3.5 mb-5">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 border border-emerald-300 dark:bg-emerald-500/10 dark:border-emerald-500/20 flex items-center justify-center text-emerald-700 dark:text-emerald-400 shadow-xs flex-shrink-0">
                                <i class="fa fa-crosshairs text-lg"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">{{ __('frontend.academic.why_important') }}</h3>
                        </div>
                        <div class="text-slate-700 dark:text-slate-300 text-base leading-relaxed">
                            {!! $courses->importents !!}
                        </div>
                    </div>

                    <!-- Curriculum Accordion -->
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('frontend.academic.curriculum_title') }}</h3>
                            <span class="text-xs font-mono font-bold text-emerald-800 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 px-3 py-1 rounded-full uppercase tracking-wider">{{ count($Courseitem) }} {{ __('frontend.academic.modules') }}</span>
                        </div>

                        <div class="space-y-4" id="curriculum-accordion">
                            @foreach ($Courseitem as $item)
                                @php
                                    $isFirst = ($item->course_order == 1);
                                @endphp
                                <div class="accordion-item rounded-2xl bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800/80 overflow-hidden transition-all duration-300 hover:border-emerald-500/40 shadow-xs hover:shadow-md {{ $isFirst ? 'ring-2 ring-emerald-500/20 border-emerald-500/30' : '' }}">
                                    <button type="button" class="accordion-toggle group w-full flex items-center justify-between p-5 sm:p-6 text-left hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors focus:outline-none" onclick="toggleAccordion('item-{{ $item->id }}')">
                                        <div class="flex items-center gap-4">
                                            <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 dark:bg-slate-800 dark:text-emerald-400 dark:border-slate-700 flex items-center justify-center text-xs font-mono font-bold flex-shrink-0 transition-transform group-hover:scale-105">
                                                {{ sprintf('%02d', $loop->iteration) }}
                                            </span>
                                            <span class="accordion-title text-base sm:text-lg font-bold text-slate-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
                                                {{ $item->item_title }}
                                            </span>
                                        </div>
                                        <i class="fa fa-chevron-down text-xs text-slate-500 dark:text-slate-400 transition-transform duration-300 accordion-icon-item-{{ $item->id }} {{ $isFirst ? 'rotate-180' : '' }}"></i>
                                    </button>

                                    <div id="content-item-{{ $item->id }}" class="{{ $isFirst ? 'block' : 'hidden' }} px-6 pb-6 pt-3 border-t border-slate-100 dark:border-slate-800/50 text-slate-700 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                                        {!! $item->description !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Post-Course Career Potential & Impact -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="p-8 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800/80 shadow-sm hover-card-lift backdrop-blur-md">
                            <h4 class="text-lg font-bold text-emerald-800 dark:text-emerald-400 mb-3">{{ __('frontend.academic.career_scope') }}</h4>
                            <div class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">
                                {!! $courses->future_of_this_course !!}
                            </div>
                        </div>

                        <div class="p-8 rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800/80 shadow-sm hover-card-lift backdrop-blur-md">
                            <h4 class="text-lg font-bold text-cyan-800 dark:text-cyan-400 mb-3">{{ $courses->course_title }} {{ __('frontend.academic.future_scope') }}</h4>
                            <div class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">
                                {!! $courses->possibilities_of_this_course !!}
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right 4 Columns: Sticky Enrollment Card -->
                <div class="lg:col-span-4 sticky top-28">
                    <div class="rounded-2xl bg-white dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800 backdrop-blur-xl shadow-xl p-6 sm:p-8 overflow-hidden hover-card-lift">
                        
                        <!-- Course Image Preview -->
                        <div class="relative w-full h-48 rounded-xl overflow-hidden mb-6 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
                            <img src="{{ URL::asset($courses->image) }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" alt="{{ $courses->course_title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent pointer-events-none"></div>
                            <div class="absolute bottom-3 left-3">
                                <span class="px-2.5 py-1 rounded-md bg-emerald-600 text-white font-mono font-bold text-xs shadow-sm">
                                    {{ __('frontend.academic.admissions_open') }}
                                </span>
                            </div>
                        </div>

                        <!-- Price Highlight -->
                        <div class="mb-6 pb-6 border-b border-slate-200 dark:border-slate-800">
                            <span class="text-xs font-mono uppercase tracking-wider text-slate-500 dark:text-slate-400 block font-semibold">{{ __('frontend.academic.tuition_fee') }}</span>
                            <div class="text-3xl font-black font-mono text-slate-900 dark:text-white tracking-tight mt-1">
                                ৳ {{ $courses->price }} <span class="text-sm font-bold text-emerald-700 dark:text-emerald-400">BDT</span>
                            </div>
                        </div>

                        <!-- Course Metadata List -->
                        <ul class="space-y-4 text-sm mb-8">
                            <li class="flex items-center justify-between text-slate-700 dark:text-slate-300">
                                <span class="flex items-center gap-2 text-slate-500 dark:text-slate-400 font-medium">
                                    <i class="fa fa-calendar text-emerald-600 dark:text-emerald-400"></i> {{ __('frontend.academic.duration') }}:
                                </span>
                                <span class="font-bold text-slate-900 dark:text-white font-mono">{{ $courses->time_line }}</span>
                            </li>
                            <li class="flex items-center justify-between text-slate-700 dark:text-slate-300">
                                <span class="flex items-center gap-2 text-slate-500 dark:text-slate-400 font-medium">
                                    <i class="fa fa-users text-emerald-600 dark:text-emerald-400"></i> {{ __('frontend.academic.students_per_batch') }}:
                                </span>
                                <span class="font-bold text-slate-900 dark:text-white font-mono">{{ Str::contains($courses->student_quantity, ['জন', 'Students']) ? $courses->student_quantity : ($courses->student_quantity . ' ' . __('frontend.academic.persons')) }}</span>
                            </li>

                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($course_members as $member)
                                <li class="flex items-center justify-between text-slate-700 dark:text-slate-300">
                                    <span class="flex items-center gap-2 text-slate-500 dark:text-slate-400 font-medium">
                                        <i class="fa fa-user-circle text-emerald-600 dark:text-emerald-400"></i> {{ __('frontend.academic.instructors') }}:
                                    </span>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ App\User::find($member->member_id)->name }}</span>
                                </li>
                            @endforeach

                            @foreach ($course_fassilities as $item)
                                <li class="flex items-center gap-2 text-slate-700 dark:text-slate-400 text-xs">
                                    <i class="fa fa-check text-emerald-600 dark:text-emerald-400"></i>
                                    <span>{{ $item->title }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Direct Enrollment CTA Button with Shimmer -->
                        <a href="{{ url('training/' . $courses->course_slug . '/student-registration') }}" class="btn-shimmer flex items-center justify-center gap-3 w-full py-4 px-6 rounded-xl font-bold text-sm tracking-wider uppercase bg-emerald-600 hover:bg-emerald-700 text-white dark:bg-emerald-500 dark:hover:bg-emerald-400 dark:text-slate-950 transition-all duration-300 shadow-md hover:-translate-y-1">
                            <i class="fa fa-graduation-cap"></i>
                            <span>{{ __('frontend.academic.register_btn') }}</span>
                        </a>

                        <!-- 10MS Offline Campus Hotline & Counseling -->
                        <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-800 text-center space-y-2">
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">ক্যাম্পাসে এসে সরাসরি কথা বলতে কল করুন:</p>
                            <a href="tel:{{ app_setting('contact_phone', '01791612121') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl font-bold text-xs bg-slate-100 hover:bg-slate-200 text-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 transition-all">
                                <i class="fa fa-phone text-emerald-600 dark:text-emerald-400"></i>
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
        <section class="py-16 border-t border-slate-200 dark:border-slate-800/80 bg-slate-100/70 dark:bg-slate-900/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <div class="text-xs font-mono uppercase tracking-widest text-emerald-800 dark:text-emerald-400 font-bold mb-2">{{ __('frontend.academic.explore_next') }}</div>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white">{{ __('frontend.academic.other_courses') }}</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($moreCourses as $course)
                        <a href="{{ url('training/' . $course->course_slug) }}" class="group block rounded-2xl bg-white dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800/80 hover:border-emerald-500/50 overflow-hidden transition-all duration-300 hover:-translate-y-1 shadow-sm hover:shadow-lg">
                            <div class="h-48 overflow-hidden bg-slate-100 dark:bg-slate-950">
                                <img src="{{ URL::asset($course->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $course->course_title }}">
                            </div>
                            <div class="p-6">
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors mb-2">
                                    {{ $course->course_title }}
                                </h4>
                                <div class="text-slate-600 dark:text-slate-400 text-xs line-clamp-2">
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
        const item = content ? content.closest('.accordion-item') : null;
        
        if (!content) return;
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            content.style.maxHeight = '0px';
            content.style.opacity = '0';
            content.style.overflow = 'hidden';
            content.style.transition = 'max-height 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease';
            
            requestAnimationFrame(() => {
                content.style.maxHeight = (content.scrollHeight + 40) + 'px';
                content.style.opacity = '1';
            });
            
            if (icon) icon.classList.add('rotate-180');
            if (item) {
                item.classList.add('ring-2', 'ring-emerald-500/20', 'border-emerald-500/40');
            }
        } else {
            content.style.maxHeight = '0px';
            content.style.opacity = '0';
            
            setTimeout(() => {
                content.classList.add('hidden');
                content.style.maxHeight = '';
                content.style.opacity = '';
                content.style.overflow = '';
            }, 300);
            
            if (icon) icon.classList.remove('rotate-180');
            if (item) {
                item.classList.remove('ring-2', 'ring-emerald-500/20', 'border-emerald-500/40');
            }
        }
    }
</script>
@endsection
