@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('title', __('frontend.nav.facebook_posts') . ' — ' . app_setting('site_title', 'Wake Up ICT'))

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 pt-28 pb-24">

    <!-- Ambient Glowing Backdrops -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[500px] bg-gradient-to-tr from-brand-primary/15 via-brand-cyan/10 to-blue-600/10 blur-[140px] pointer-events-none rounded-full"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="max-w-3xl mb-14">
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-blue-500/30 text-blue-400 text-xs font-mono tracking-wider uppercase mb-5 backdrop-blur-md shadow-sm">
                <i class="fa fa-facebook-square text-sm text-blue-400"></i>
                <span>Official Social Stream</span>
            </div>
            
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.12] mb-5">
                {{ app_setting('fb_feed_title', App::getLocale() == 'bn' ? 'ফেসবুক আপডেট ও টেক নিউজ' : 'Social Broadcasts & Engineering Updates') }}
            </h1>
            
            <p class="text-base sm:text-lg text-slate-300 font-normal leading-relaxed">
                {{ app_setting('fb_feed_sub', App::getLocale() == 'bn' ? 'ওয়েক আপ আইসিটির অফিসিয়াল ফেসবুক পেজ থেকে সর্বশেষ খবর, কারিগরি কর্মশালা ও গুরুত্বপূর্ণ ঘোষণা।' : 'Live announcements, technological breakthroughs, curriculum cohorts, and community updates straight from our verified page.') }}
            </p>
        </div>

        @if(!$isConfigured)
            <!-- Notice for Administrator -->
            <div class="mb-10 p-4 rounded-xl bg-slate-900/80 border border-blue-500/30 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-400 animate-pulse"></span>
                    <span class="text-xs font-mono text-slate-300">
                        <strong>Preview Mode:</strong> Connect your Facebook Page ID and Page Access Token in <em>Admin → Appearance → Global Brand</em> for live synchronization.
                    </span>
                </div>
                @auth
                    <a href="{{ route('appearance.global') }}" class="px-3 py-1.5 rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-mono text-xs transition-colors flex-shrink-0">
                        Configure Token &rarr;
                    </a>
                @endauth
            </div>
        @endif

        @if(isset($apiError) && !empty($apiError))
            <div class="mb-8 p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-mono">
                <i class="fa fa-exclamation-triangle mr-1.5"></i> Graph API Notice: {{ $apiError }}
            </div>
        @endif

        <!-- Facebook Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts as $post)
                @php
                    $created = isset($post['created_time']) ? Carbon\Carbon::parse($post['created_time']) : Carbon\Carbon::now();
                    $message = $post['message'] ?? ($post['story'] ?? '');
                    $reactions = $post['reactions']['summary']['total_count'] ?? 0;
                    $comments = $post['comments']['summary']['total_count'] ?? 0;
                    $shares = $post['shares']['count'] ?? 0;
                    $permalink = $post['permalink_url'] ?? 'https://facebook.com/' . $pageId;
                @endphp

                <article class="group flex flex-col h-full rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-brand-primary/40 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                    
                    <!-- Card Top Header -->
                    <div class="p-5 pb-3 flex items-center justify-between border-b border-slate-800/50">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-600/20 border border-blue-500/40 flex items-center justify-center text-blue-400 font-bold text-sm">
                                <i class="fa fa-facebook"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white leading-tight flex items-center gap-1.5">
                                    <span>{{ $pageName }}</span>
                                    <i class="fa fa-check-circle text-blue-400 text-xs" title="Verified Page"></i>
                                </h4>
                                <time datetime="{{ $created->toIso8601String() }}" class="text-[11px] font-mono text-slate-400">
                                    {{ $created->diffForHumans() }}
                                </time>
                            </div>
                        </div>

                        <a href="{{ $permalink }}" target="_blank" rel="noopener noreferrer" class="text-slate-500 hover:text-blue-400 transition-colors" title="Open on Facebook">
                            <i class="fa fa-external-link text-xs"></i>
                        </a>
                    </div>

                    <!-- Post Body (Message) -->
                    <div class="p-5 flex-grow">
                        <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">
                            {!! Str::limit(e($message), 280) !!}
                        </p>
                    </div>

                    <!-- Post Media Image (if available) -->
                    @if(!empty($post['full_picture']))
                        <div class="relative w-full h-56 sm:h-64 bg-slate-950 overflow-hidden">
                            <a href="{{ $permalink }}" target="_blank" rel="noopener noreferrer" class="block w-full h-full">
                                <img src="{{ safe_asset($post['full_picture']) }}" alt="Facebook Post Media" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-95 group-hover:brightness-100">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60"></div>
                            </a>
                        </div>
                    @endif

                    <!-- Card Bottom Metrics & Action -->
                    <div class="p-4 px-5 bg-slate-950/60 border-t border-slate-800/60 flex items-center justify-between text-xs font-mono text-slate-400">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1.5 text-slate-400 group-hover:text-blue-400 transition-colors">
                                <i class="fa fa-thumbs-up text-blue-400"></i>
                                <span>{{ number_format($reactions) }}</span>
                            </span>
                            <span class="flex items-center gap-1.5 text-slate-400">
                                <i class="fa fa-comment-o"></i>
                                <span>{{ number_format($comments) }}</span>
                            </span>
                            @if($shares > 0)
                                <span class="flex items-center gap-1.5 text-slate-400">
                                    <i class="fa fa-share"></i>
                                    <span>{{ number_format($shares) }}</span>
                                </span>
                            @endif
                        </div>

                        <a href="{{ $permalink }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 font-semibold text-brand-primary hover:text-brand-accent transition-colors uppercase tracking-wider text-[11px]">
                            <span>{{ App::getLocale() == 'bn' ? 'ফেসবুকে দেখুন' : 'View Post' }}</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </article>
            @endforeach
        </div>

        <!-- Callout Banner to Official Page -->
        <div class="mt-16 text-center">
            <a href="https://facebook.com/{{ $pageId }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 px-8 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-blue-600 hover:bg-blue-500 text-white transition-all duration-300 shadow-lg hover:-translate-y-0.5">
                <i class="fa fa-facebook-official text-base"></i>
                <span>{{ App::getLocale() == 'bn' ? 'অফিসিয়াল ফেসবুক পেজে যুক্ত হন' : 'Join Our Official Facebook Page' }}</span>
                <i class="fa fa-arrow-right text-xs ml-1"></i>
            </a>
        </div>

    </div>
</div>
@endsection
