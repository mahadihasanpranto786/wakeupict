@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen pt-32 pb-24">

    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-4">
            <span>{{ __('frontend.blog.badge') }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-4 leading-tight">
            {{ __('frontend.blog.title') }}
        </h1>
        <p class="text-slate-400 text-base sm:text-lg max-w-2xl">
            {{ __('frontend.blog.sub') }}
        </p>
    </div>

    <!-- Main Editorial 8-Col / 4-Col Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left 8 Columns: Magazine 1+3 Layout -->
            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($blogs as $index => $blog)
                        @if ($index % 4 == 0)
                            <!-- 1: Featured Hero Post (Spans 3 Columns) -->
                            <div class="col-span-1 md:col-span-3 group">
                                <a href="{{ url('our-blogs/' . $blog->slug_title) }}" class="flex flex-col rounded-2xl bg-slate-900/70 border border-slate-800/80 hover:border-emerald-500/40 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                                    <div class="relative w-full h-72 sm:h-96 overflow-hidden bg-slate-950">
                                        <img src="{{ URL::asset($blog->blog_image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-95 group-hover:brightness-100" alt="{{ $blog->image_alt }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                                        <div class="absolute top-4 left-4">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500 text-slate-950 text-xs font-mono font-bold tracking-wider uppercase">
                                                {{ __('frontend.blog.featured_insight') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                        <div class="flex items-center gap-4 text-xs font-mono text-slate-400 mb-3">
                                            <span class="flex items-center gap-1.5"><i class="fa fa-calendar text-emerald-400"></i> {{ $blog->update_time }}</span>
                                            <span>•</span>
                                            <span class="flex items-center gap-1.5"><i class="fa fa-user-circle text-emerald-400"></i> {{ $blog->creator_name }}</span>
                                        </div>
                                        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4 group-hover:text-emerald-400 transition-colors leading-snug">
                                            {{ $blog->blog_title }}
                                        </h2>
                                        <div class="text-slate-300 text-sm sm:text-base leading-relaxed mb-6">
                                            {!! Str::limit(strip_tags($blog->short_description), 160) !!}
                                        </div>
                                        <div class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-emerald-400 font-semibold group-hover:translate-x-1 transition-transform">
                                            <span>{{ __('frontend.blog.read_full_story') }}</span>
                                            <i class="fa fa-arrow-right text-[10px]"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <!-- +3: Subsequent Editorial Cards (Spans 1 Column each) -->
                            <div class="col-span-1 group">
                                <a href="{{ url('our-blogs/' . $blog->slug_title) }}" class="flex flex-col h-full rounded-2xl bg-slate-900/50 border border-slate-800/80 hover:border-emerald-500/40 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                                    <div class="relative w-full h-44 overflow-hidden bg-slate-950">
                                        <img src="{{ URL::asset($blog->blog_image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $blog->image_alt }}">
                                    </div>
                                    <div class="p-5 flex flex-col flex-grow">
                                        <div class="text-[11px] font-mono text-slate-400 mb-2 flex items-center gap-1">
                                            <i class="fa fa-calendar text-emerald-400"></i> {{ $blog->update_time }}
                                        </div>
                                        <h3 class="text-base font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                                            {{ $blog->blog_title }}
                                        </h3>
                                        <div class="text-slate-400 text-xs leading-relaxed mb-4 flex-grow line-clamp-3">
                                            {!! Str::limit(strip_tags($blog->short_description), 80) !!}
                                        </div>
                                        <div class="inline-flex items-center gap-1.5 text-[11px] font-mono uppercase tracking-wider text-emerald-400 font-semibold mt-auto">
                                            <span>{{ __('frontend.blog.read') }}</span>
                                            <i class="fa fa-arrow-right text-[9px]"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Custom Styled Pagination Container -->
                <div class="mt-12 flex justify-center py-6 border-t border-slate-800/80">
                    <div class="dark-pagination">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>

            <!-- Right 4 Columns: Sidebar -->
            <div class="lg:col-span-4 lg:sticky lg:top-32 space-y-8">
                @include('frontend.theme.clasic.our_blogs.blog_sidebar')
            </div>

        </div>
    </div>

</div>

<style>
    /* Pagination dark style override */
    .dark-pagination .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .dark-pagination .page-item .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        background-color: #0f172a;
        border: 1px solid #1e293b;
        color: #cbd5e1;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    .dark-pagination .page-item.active .page-link {
        background-color: #10b981;
        color: #030712;
        border-color: #10b981;
        font-weight: bold;
    }
    .dark-pagination .page-item .page-link:hover {
        border-color: #10b981;
        color: #10b981;
    }

    /* Light Mode Pagination */
    html.light .dark-pagination .page-item .page-link {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        color: #334155;
    }
    html.light .dark-pagination .page-item.active .page-link {
        background-color: #10b981;
        color: #ffffff;
        border-color: #10b981;
    }
    html.light .dark-pagination .page-item .page-link:hover {
        border-color: #10b981;
        color: #10b981;
        background-color: #f8fafc;
    }
</style>
@endsection
