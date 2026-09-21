<div class="space-y-8">

    <!-- Categories Widget -->
    <div class="rounded-2xl bg-slate-900/70 border border-slate-800/80 p-6 backdrop-blur-md">
        <h4 class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-6 flex items-center gap-2">
            <i class="fa fa-folder-open-o"></i>
            <span>Categories</span>
        </h4>
        <ul class="space-y-3">
            @foreach ($blogCategory as $category)
                @php
                    $cat_slug = str_replace(' ', '-', $category->category_name);
                    $catUnderBlog = countBlogCategry($category->category_name);
                @endphp
                <li>
                    <a href="{{ url('our-blogs/' . $cat_slug) }}" class="group flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-800/60 transition-colors">
                        <span class="text-sm font-medium text-slate-300 group-hover:text-emerald-400 transition-colors">
                            {{ $category->category_name }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-mono bg-slate-800 border border-slate-700 text-slate-400 group-hover:border-emerald-500/40 group-hover:text-emerald-400 transition-all">
                            {{ $catUnderBlog }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Recent Posts Widget -->
    <div class="rounded-2xl bg-slate-900/70 border border-slate-800/80 p-6 backdrop-blur-md">
        <h4 class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-6 flex items-center gap-2">
            <i class="fa fa-clock-o"></i>
            <span>Recent Posts</span>
        </h4>
        <ul class="space-y-4">
            @foreach ($resentBlogs as $blog)
                @php
                    $blog_slug = $blog->slug_title;
                @endphp
                <li>
                    <a href="{{ url('our-blogs/' . $blog_slug) }}" class="group block p-2.5 rounded-xl hover:bg-slate-800/60 transition-colors">
                        <span class="text-sm font-medium text-slate-300 group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                            {{ $blog->blog_title }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Archives Widget -->
    <div class="rounded-2xl bg-slate-900/70 border border-slate-800/80 p-6 backdrop-blur-md">
        <h4 class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-6 flex items-center gap-2">
            <i class="fa fa-archive"></i>
            <span>Archives</span>
        </h4>
        <ul class="space-y-3">
            <li>
                <a href="#" class="group flex items-center justify-between p-2.5 rounded-xl hover:bg-slate-800/60 transition-colors">
                    <span class="text-sm font-medium text-slate-300 group-hover:text-emerald-400 transition-colors">
                        Graphic Design
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-mono bg-slate-800 border border-slate-700 text-slate-400">
                        09
                    </span>
                </a>
            </li>
        </ul>
    </div>

</div>
