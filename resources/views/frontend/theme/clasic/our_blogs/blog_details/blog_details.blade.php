@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen pt-32 pb-24">

    <!-- Article Header -->
    <header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-6">
            <span>Engineering Insights</span>
        </div>
        
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white mb-6 leading-tight">
            {{ $blog->blog_title }}
        </h1>

        <div class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto">
            {!! $blog->short_description !!}
        </div>
    </header>

    <!-- Main Header Image -->
    @if (!empty($blog->header_image))
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="rounded-2xl overflow-hidden bg-slate-900 border border-slate-800 shadow-2xl aspect-[16/9] sm:aspect-[21/9]">
                <img src="{{ asset($blog->header_image) }}" alt="{{ $blog->image_alt }}" class="w-full h-full object-cover">
            </div>
        </div>
    @endif

    <!-- Dynamic Structured Article Content -->
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-slate-300 leading-relaxed space-y-12">
        
        @if (!empty($blog->footer_title))
            <h2 class="text-2xl sm:text-3xl font-bold text-white text-center pt-6 border-t border-slate-800/80">
                {{ $blog->footer_title }}
            </h2>
        @endif

        @foreach ($blogContent as $content)
            <div class="my-8">
                @if ($content->content_design == 'Left side')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div>
                            @if ($content->title)
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 text-emerald-400">{{ $content->title }}</h3>
                            @endif
                            <div class="text-slate-300 text-base leading-relaxed">
                                {!! $content->short_description !!}
                            </div>
                        </div>
                        <div class="rounded-xl overflow-hidden border border-slate-800">
                            <a href="{{ URL::asset($content->file) }}">
                                <img src="{{ asset($content->file) }}" class="w-full h-auto object-cover" alt="{{ $content->image_alt }}">
                            </a>
                        </div>
                    </div>

                @elseif ($content->content_design == 'Right side')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="rounded-xl overflow-hidden border border-slate-800 order-2 md:order-1">
                            <a href="{{ URL::asset($content->file) }}">
                                <img src="{{ asset($content->file) }}" class="w-full h-auto object-cover" alt="{{ $content->image_alt }}">
                            </a>
                        </div>
                        <div class="order-1 md:order-2">
                            @if ($content->title)
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 text-emerald-400">{{ $content->title }}</h3>
                            @endif
                            <div class="text-slate-300 text-base leading-relaxed">
                                {!! $content->short_description !!}
                            </div>
                        </div>
                    </div>

                @elseif ($content->content_design == 'Middle')
                    <div class="space-y-6 text-center">
                        <div class="max-w-2xl mx-auto rounded-xl overflow-hidden border border-slate-800">
                            <a href="{{ URL::asset($content->file) }}">
                                <img src="{{ asset($content->file) }}" class="w-full h-auto object-cover mx-auto" alt="{{ $content->image_alt }}">
                            </a>
                        </div>
                        <div>
                            @if ($content->title)
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 text-emerald-400">{{ $content->title }}</h3>
                            @endif
                            <div class="text-slate-300 text-base leading-relaxed text-left">
                                {!! $content->short_description !!}
                            </div>
                        </div>
                    </div>

                @elseif ($content->content_design == 'Top Three')
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @if ($content->file)
                                <div class="rounded-xl overflow-hidden border border-slate-800">
                                    <a href="{{ URL::asset($content->file) }}"><img src="{{ asset($content->file) }}" class="w-full h-44 object-cover" alt="{{ $content->image_alt }}"></a>
                                </div>
                            @endif
                            @if ($content->file_1)
                                <div class="rounded-xl overflow-hidden border border-slate-800">
                                    <a href="{{ URL::asset($content->file_1) }}"><img src="{{ asset($content->file_1) }}" class="w-full h-44 object-cover" alt="{{ $content->image_alt }}"></a>
                                </div>
                            @endif
                            @if ($content->file_2)
                                <div class="rounded-xl overflow-hidden border border-slate-800">
                                    <a href="{{ URL::asset($content->file_2) }}"><img src="{{ asset($content->file_2) }}" class="w-full h-44 object-cover" alt="{{ $content->image_alt }}"></a>
                                </div>
                            @endif
                        </div>
                        @if ($content->title)
                            <h3 class="text-xl sm:text-2xl font-bold text-white mb-2 text-emerald-400">{{ $content->title }}</h3>
                        @endif
                        <div class="text-slate-300 text-base leading-relaxed">
                            {!! $content->short_description !!}
                        </div>
                    </div>

                @elseif ($content->content_design == 'Right Three')
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                        <div class="md:col-span-5">
                            @if ($content->title)
                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 text-emerald-400">{{ $content->title }}</h3>
                            @endif
                            <div class="text-slate-300 text-base leading-relaxed">
                                {!! $content->short_description !!}
                            </div>
                        </div>
                        <div class="md:col-span-7 grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @if ($content->file)
                                <div class="rounded-xl overflow-hidden border border-slate-800">
                                    <a href="{{ URL::asset($content->file) }}"><img src="{{ asset($content->file) }}" class="w-full h-32 object-cover" alt="{{ $content->image_alt }}"></a>
                                </div>
                            @endif
                            @if ($content->file_1)
                                <div class="rounded-xl overflow-hidden border border-slate-800">
                                    <a href="{{ URL::asset($content->file_1) }}"><img src="{{ asset($content->file_1) }}" class="w-full h-32 object-cover" alt="{{ $content->image_alt }}"></a>
                                </div>
                            @endif
                            @if ($content->file_2)
                                <div class="rounded-xl overflow-hidden border border-slate-800">
                                    <a href="{{ URL::asset($content->file_2) }}"><img src="{{ asset($content->file_2) }}" class="w-full h-32 object-cover" alt="{{ $content->image_alt }}"></a>
                                </div>
                            @endif
                        </div>
                    </div>

                @elseif ($content->content_design == 'Only Text')
                    <div class="my-6">
                        @if ($content->title)
                            <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 text-emerald-400">{{ $content->title }}</h3>
                        @endif
                        <div class="text-slate-300 text-base leading-relaxed">
                            {!! $content->short_description !!}
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

        <!-- Social Share Bar -->
        <div class="pt-8 mt-12 border-t border-slate-800 flex flex-wrap items-center justify-between gap-4">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Share this publication</span>
            <div class="flex items-center gap-3">
                <a href="https://www.facebook.com/wakeupict" target="_blank" class="px-4 py-2 rounded-xl bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-300 hover:text-white text-xs font-mono flex items-center gap-2">
                    <i class="fa fa-facebook text-blue-400"></i> Facebook
                </a>
                <a href="https://www.linkedin.com/company/wakeupict/mycompany/" target="_blank" class="px-4 py-2 rounded-xl bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-300 hover:text-white text-xs font-mono flex items-center gap-2">
                    <i class="fa fa-linkedin text-cyan-400"></i> LinkedIn
                </a>
                <a href="https://twitter.com/wakeupict" target="_blank" class="px-4 py-2 rounded-xl bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-300 hover:text-white text-xs font-mono flex items-center gap-2">
                    <i class="fa fa-twitter text-sky-400"></i> Twitter
                </a>
            </div>
        </div>

    </article>

    <!-- More Blogs Section -->
    @if (!empty($MoreBlog))
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 pt-16 border-t border-slate-800/80">
            <h3 class="text-2xl font-bold text-white mb-8">Related Publications</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($MoreBlog as $blog)
                    <a href="{{ url('our-blogs/' . $blog->slug_title) }}" class="group block rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-emerald-500/40 overflow-hidden transition-all duration-300 hover:-translate-y-1">
                        <div class="h-44 overflow-hidden bg-slate-950">
                            <img src="{{ asset($blog->blog_image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $blog->image_alt }}">
                        </div>
                        <div class="p-5">
                            <span class="text-[11px] font-mono text-slate-400 mb-2 block">{{ $blog->update_time }}</span>
                            <h4 class="text-base font-bold text-white group-hover:text-emerald-400 transition-colors mb-2 line-clamp-2">
                                {{ $blog->blog_title }}
                            </h4>
                            <div class="text-slate-400 text-xs line-clamp-2">
                                {!! strip_tags($blog->short_description) !!}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection
