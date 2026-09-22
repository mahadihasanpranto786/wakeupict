@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen">

    <!--========================== Hero Banner ============================-->
    @if (!empty($banner->image))
        <section class="relative min-h-[55vh] sm:min-h-[65vh] flex items-center justify-center pt-32 pb-20 overflow-hidden bg-grid-mesh border-b border-slate-800/80">
            <!-- Ambient Lighting -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-emerald-500/10 blur-[130px] pointer-events-none rounded-full"></div>

            <!-- Background Image Texture -->
            <div class="absolute inset-0 z-0 opacity-15 mix-blend-luminosity overflow-hidden pointer-events-none">
                <img src="{{ URL::asset($banner->image) }}" class="w-full h-full object-cover filter grayscale" alt="Academic Banner">
            </div>

            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-emerald-500/30 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-6 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>{{ __('frontend.academic.curriculum_badge') }}</span>
                </div>
                
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
                    {{ $banner->banner_title }}
                </h1>
                
                <div class="max-w-3xl mx-auto text-lg sm:text-xl text-slate-300 font-normal leading-relaxed">
                    {!! $banner->banner_description !!}
                </div>
            </div>
        </section>

        <!-- Academic Methodology & Value Statement -->
        @if (!empty($banner->body_title))
            <section class="py-16 sm:py-20 relative border-b border-slate-800/80 bg-slate-900/30">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
                    <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">{{ __('frontend.academic.pedagogy_badge') }}</div>
                    <h2 class="text-2xl sm:text-4xl font-bold text-white mb-6">
                        {{ $banner->body_title }}
                    </h2>
                    <div class="text-slate-400 text-base sm:text-lg leading-relaxed">
                        {!! $banner->body_description !!}
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!--========================== Interactive Filter Bar & Course Matrix ============================-->
    <section class="py-20 sm:py-28 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dynamic Filter Pills -->
            <div class="flex items-center justify-start sm:justify-center gap-2 sm:gap-3 overflow-x-auto pb-6 mb-12 sm:mb-16 scrollbar-none">
                <button type="button" data-filter="all" class="course-filter-btn active px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase font-semibold transition-all flex items-center gap-2 border">
                    <span>{{ __('frontend.academic.filter_all') }}</span>
                    <span class="filter-count text-[11px] px-2 py-0.5 rounded-full bg-slate-950/20 text-current font-bold">{{ count($courseData) }}</span>
                </button>
                <button type="button" data-filter="engineering" class="course-filter-btn px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase font-semibold transition-all flex items-center gap-2 border">
                    <span>{{ __('frontend.academic.filter_engineering') }}</span>
                    <span class="filter-count text-[11px] px-2 py-0.5 rounded-full bg-slate-800/80 text-current font-bold">2</span>
                </button>
                <button type="button" data-filter="product" class="course-filter-btn px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase font-semibold transition-all flex items-center gap-2 border">
                    <span>{{ __('frontend.academic.filter_product') }}</span>
                    <span class="filter-count text-[11px] px-2 py-0.5 rounded-full bg-slate-800/80 text-current font-bold">2</span>
                </button>
                <button type="button" data-filter="cloud" class="course-filter-btn px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase font-semibold transition-all flex items-center gap-2 border">
                    <span>{{ __('frontend.academic.filter_cloud') }}</span>
                    <span class="filter-count text-[11px] px-2 py-0.5 rounded-full bg-slate-800/80 text-current font-bold">2</span>
                </button>
            </div>

            <!-- Asymmetric Modern Course Grid -->
            <div id="course-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 items-start">
                @foreach ($courseData as $index => $content)
                    @php
                        // First item or every 4th item gets featured width (col-span-8)
                        $isFeatured = ($index % 3 == 0);

                        $slug = strtolower($content->course_slug ?? '');
                        $title = strtolower($content->course_title ?? '');
                        
                        $cats = ['all'];
                        $trackNameEn = 'Core Track';
                        $trackNameBn = 'কোর ট্র্যাক';

                        if (Str::contains($slug, ['web', 'dev']) || Str::contains($title, ['ওয়েব', 'ডেভেলপমেন্ট', 'web', 'dev'])) {
                            $cats[] = 'engineering';
                            $trackNameEn = 'Web & Engineering';
                            $trackNameBn = 'ইঞ্জিনিয়ারিং';
                        } elseif (Str::contains($slug, ['graphic', 'ui', 'photoshop']) || Str::contains($title, ['গ্রাফিক', 'গ্রাফিক্স', 'graphic'])) {
                            $cats[] = 'product';
                            $trackNameEn = 'Product & UI';
                            $trackNameBn = 'প্রোডাক্ট ও ইউআই';
                        } elseif (Str::contains($slug, ['marketing', 'digital', 'office', 'cloud', 'cyber']) || Str::contains($title, ['মার্কেটিং', 'ডিজিটাল', 'অফিস', 'marketing', 'office'])) {
                            $cats[] = 'cloud';
                            $trackNameEn = 'Digital & Cloud';
                            $trackNameBn = 'ক্লাউড ও সাইবার';
                        } else {
                            $cats[] = 'engineering';
                        }
                        $categoryString = implode(' ', $cats);
                    @endphp
                    
                    <div class="course-item-card {{ $isFeatured ? 'lg:col-span-8' : 'lg:col-span-4' }} group reveal-on-scroll stagger-{{ ($index % 3) + 1 }}" data-category="{{ $categoryString }}">
                        <a href="{{ url('training/' . $content->course_slug) }}" class="flex flex-col h-full rounded-2xl bg-slate-900/70 border border-slate-800/80 hover:border-emerald-500/40 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark card-interactive-glow">
                            
                            <!-- Course Preview Image -->
                            <div class="relative w-full {{ $isFeatured ? 'h-64 sm:h-80' : 'h-52' }} overflow-hidden bg-slate-950">
                                <img src="{{ URL::asset($content->image) }}" alt="{{ $content->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-95 group-hover:brightness-100">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                                
                                <div class="absolute top-4 left-4 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-950/80 border border-emerald-500/30 text-xs font-mono text-emerald-400 backdrop-blur-md">
                                        <span>{{ __('frontend.academic.track') }} {{ sprintf('%02d', $index + 1) }}</span>
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-[11px] font-mono text-emerald-300 backdrop-blur-md">
                                        {{ App::getLocale() == 'bn' ? $trackNameBn : $trackNameEn }}
                                    </span>
                                </div>
                            </div>

                            <!-- Course Details Body -->
                            <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-2">
                                    {{ __('frontend.academic.academic_training') }}
                                </div>

                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors leading-snug">
                                    {{ $content->course_title }}
                                </h3>

                                <div class="text-slate-400 text-sm leading-relaxed mb-8 flex-grow">
                                    {!! Str::limit(strip_tags($content->short_description), $isFeatured ? 150 : 90) !!}
                                </div>

                                <!-- Card Footer: Fee & Action -->
                                <div class="pt-6 border-t border-slate-800/80 flex items-center justify-between mt-auto">
                                    <div>
                                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 block">{{ __('frontend.academic.tuition_fee') }}</span>
                                        <div class="text-lg sm:text-xl font-bold font-mono text-white tracking-tight">
                                            {{ $content->price }} <span class="text-xs font-normal text-emerald-400">BDT</span>
                                        </div>
                                    </div>

                                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold tracking-wider uppercase bg-slate-800/80 group-hover:bg-emerald-500 text-slate-200 group-hover:text-slate-950 border border-slate-700/80 group-hover:border-emerald-500 transition-all duration-300">
                                        <span>{{ __('frontend.academic.view_syllabus') }}</span>
                                        <i class="fa fa-arrow-right text-[10px]"></i>
                                    </div>
                                </div>

                            </div>

                        </a>
                    </div>
                @endforeach

                <!-- Empty State if no courses match -->
                <div id="course-empty-state" class="hidden col-span-12 py-20 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 text-2xl">
                        <i class="fa fa-search"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2">{{ App::getLocale() == 'bn' ? 'কোনো কোর্স পাওয়া যায়নি' : 'No Courses Found' }}</h4>
                    <p class="text-slate-400 text-sm mb-6">{{ App::getLocale() == 'bn' ? 'এই ট্র্যাকে বর্তমানে কোনো লাইভ কোর্স নেই।' : 'No live courses available in this track at the moment.' }}</p>
                    <button type="button" onclick="document.querySelector('[data-filter=\'all\']').click()" class="px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-bold font-mono text-xs uppercase tracking-wider transition-colors shadow-lg shadow-emerald-500/20">
                        {{ App::getLocale() == 'bn' ? 'সবগুলো কোর্স দেখুন' : 'View All Tracks' }}
                    </button>
                </div>
            </div>

        </div>
    </section>

</div>

<style>
    /* Course Filter Tabs Styling */
    .course-filter-btn {
        background-color: rgba(15, 23, 42, 0.85);
        color: #94a3b8;
        border-color: #1e293b;
        cursor: pointer;
        user-select: none;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .course-filter-btn:hover {
        background-color: #1e293b;
        color: #f1f5f9;
        border-color: #334155;
    }
    .course-filter-btn.active {
        background-color: #10b981 !important;
        color: #030712 !important;
        border-color: #10b981 !important;
        font-weight: 700;
        box-shadow: 0 8px 20px -4px rgba(16, 185, 129, 0.35);
    }
    .course-filter-btn.active .filter-count {
        background-color: rgba(3, 7, 18, 0.25);
        color: #030712;
    }

    /* Light Mode Filter Tabs */
    html.light .course-filter-btn {
        background-color: #ffffff !important;
        color: #475569 !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    html.light .course-filter-btn:hover {
        background-color: #f8fafc !important;
        color: #0f172a !important;
        border-color: #cbd5e1 !important;
    }
    html.light .course-filter-btn.active {
        background-color: #10b981 !important;
        color: #ffffff !important;
        border-color: #10b981 !important;
        box-shadow: 0 6px 16px -2px rgba(16, 185, 129, 0.3);
    }
    html.light .course-filter-btn.active .filter-count {
        background-color: rgba(255, 255, 255, 0.25);
        color: #ffffff;
    }

    /* Course Card Smooth Filtering Animation */
    .course-item-card {
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .course-item-card.is-hidden {
        display: none !important;
    }
    .course-item-card.is-filtering-out {
        opacity: 0;
        transform: scale(0.96) translateY(10px);
        pointer-events: none;
    }
    .course-item-card.is-filtering-in {
        opacity: 1;
        transform: scale(1) translateY(0);
        pointer-events: auto;
    }
</style>

<script>
    (function() {
        function initCourseTabs() {
            var buttons = document.querySelectorAll('.course-filter-btn');
            var cards = document.querySelectorAll('.course-item-card');
            var emptyState = document.getElementById('course-empty-state');

            if (!buttons.length || !cards.length) return;

            buttons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    var selectedFilter = this.getAttribute('data-filter') || 'all';

                    // Update active button state
                    buttons.forEach(function(btn) {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');

                    var visibleCount = 0;

                    cards.forEach(function(card) {
                        var catAttr = card.getAttribute('data-category') || '';
                        var categories = catAttr.split(/\s+/);
                        var isMatch = (selectedFilter === 'all' || categories.indexOf(selectedFilter) !== -1);

                        if (isMatch) {
                            visibleCount++;
                            card.classList.remove('is-hidden');
                            card.classList.remove('is-filtering-out');
                            // Small timeout to allow display transition to animate
                            setTimeout(function() {
                                card.classList.add('is-filtering-in');
                            }, 20);
                        } else {
                            card.classList.remove('is-filtering-in');
                            card.classList.add('is-filtering-out');
                            setTimeout(function() {
                                if (card.classList.contains('is-filtering-out')) {
                                    card.classList.add('is-hidden');
                                }
                            }, 280);
                        }
                    });

                    if (emptyState) {
                        if (visibleCount === 0) {
                            emptyState.classList.remove('hidden');
                        } else {
                            emptyState.classList.add('hidden');
                        }
                    }
                });
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCourseTabs);
        } else {
            initCourseTabs();
        }
    })();
</script>
@endsection
