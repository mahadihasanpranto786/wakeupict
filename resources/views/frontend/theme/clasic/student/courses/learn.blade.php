@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', ($currentLesson ? $currentLesson->lesson_title . ' — ' : '') . $course->course_title . ' — Wake Up ICT')
@section('page_title', 'Learning Center')
@section('page_crumb', $course->course_title)

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6">

    <!-- Top Learning Header & Progress Bar -->
    <div class="student-card rounded-2xl bg-slate-900/90 border border-slate-800 p-4 sm:p-5 backdrop-blur-xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <a href="{{ route('student.courses.my') }}" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors shrink-0" title="Back to My Courses">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <div class="truncate">
                    <span class="text-[11px] font-mono text-brand-primary uppercase tracking-wider block">Course Player</span>
                    <h1 class="text-base sm:text-lg font-bold text-white truncate">
                        {{ $course->course_title }}
                    </h1>
                </div>
            </div>

            <!-- Course Progress Bar & Metrics -->
            <div class="flex items-center gap-4 shrink-0">
                <div class="w-48 sm:w-64 space-y-1.5">
                    <div class="flex justify-between text-xs font-mono">
                        <span class="text-slate-400">Course Progress</span>
                        <span id="header-progress-text" class="text-brand-primary font-bold">{{ $progressPercent }}%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-800 overflow-hidden">
                        <div id="header-progress-bar" class="h-full rounded-full bg-gradient-to-r from-brand-primary to-brand-cyan transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
                    </div>
                </div>

                <a href="{{ route('student.courses.details', $course->id) }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-medium border border-slate-700 transition-colors">
                    <i class="fa fa-info-circle"></i>
                    <span>Syllabus</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Learning Grid: Player (8 cols) + Playlist Sidebar (4 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- Left Column: Video Player & Lesson Content (lg:col-span-8) -->
        <div class="lg:col-span-8 space-y-6">

            @if($currentLesson)
                @php
                    $isCompleted = in_array($currentLesson->id, $completedLessonIds);
                @endphp

                <!-- Media Player Container -->
                <div class="student-card rounded-3xl bg-slate-950 border border-slate-800 overflow-hidden shadow-2xl relative">
                    @if($currentLesson->embed_video_url)
                        <div class="relative w-full pb-[56.25%] bg-black">
                            <iframe 
                                id="lms-video-player"
                                src="{{ $currentLesson->embed_video_url }}" 
                                class="absolute top-0 left-0 w-full h-full border-0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <!-- No Video / Document Only Placeholder -->
                        <div class="p-12 sm:p-16 text-center space-y-4 bg-gradient-to-b from-slate-900 to-slate-950">
                            <div class="w-20 h-20 rounded-3xl bg-brand-primary/10 text-brand-primary border border-brand-primary/20 flex items-center justify-center mx-auto text-3xl shadow-glow-emerald">
                                <i class="fa {{ $currentLesson->pdf_file ? 'fa-file-pdf-o' : 'fa-book' }}"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-white max-w-md mx-auto">
                                {{ $currentLesson->lesson_title }}
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-400 max-w-md mx-auto">
                                This lesson focuses on reading, documentation, and practical exercises. Review the notes and downloadable resources below.
                            </p>
                            @if($currentLesson->pdf_file)
                                <a href="{{ safe_asset($currentLesson->pdf_file) }}" target="_blank" download class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-cyan/20 border border-brand-cyan/40 text-brand-cyan hover:bg-brand-cyan hover:text-slate-950 font-semibold text-xs transition-all">
                                    <i class="fa fa-download"></i>
                                    <span>Download Lesson PDF Resource</span>
                                </a>
                            @endif
                        </div>
                    @endif

                    <!-- Lesson Action Bar Below Player -->
                    <div class="p-4 sm:p-6 bg-slate-900/90 border-t border-slate-800/80 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-1">
                                    <span class="text-brand-primary font-semibold">{{ $currentLesson->chapter ? $currentLesson->chapter->chapter_name : 'Module' }}</span>
                                    <span>&bull;</span>
                                    <span><i class="fa fa-clock-o mr-1"></i> {{ $currentLesson->formatted_duration }}</span>
                                </div>
                                <h2 class="text-lg sm:text-xl font-extrabold text-white">
                                    {{ $currentLesson->lesson_title }}
                                </h2>
                            </div>

                            <!-- Mark Complete AJAX Toggle Button -->
                            <div class="flex items-center gap-2">
                                <button 
                                    id="btn-toggle-complete"
                                    type="button" 
                                    onclick="toggleLessonComplete({{ $currentLesson->id }})"
                                    class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2 {{ $isCompleted ? 'bg-brand-primary text-slate-950 shadow-glow-emerald' : 'bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700' }}">
                                    <i id="btn-toggle-icon" class="fa {{ $isCompleted ? 'fa-check-circle' : 'fa-circle-o' }}"></i>
                                    <span id="btn-toggle-text">{{ $isCompleted ? 'Completed' : 'Mark as Completed' }}</span>
                                </button>
                            </div>
                        </div>

                        <!-- Prev / Next Lesson Navigation & Resources -->
                        <div class="pt-4 border-t border-slate-800/60 flex flex-wrap items-center justify-between gap-3">
                            <div class="flex items-center gap-2">
                                @if($prevLesson)
                                    <a href="{{ route('student.courses.learn', [$course->id, $prevLesson->id]) }}" class="px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white text-xs font-medium border border-slate-700 transition-colors flex items-center gap-1.5">
                                        <i class="fa fa-chevron-left"></i>
                                        <span>Previous Lesson</span>
                                    </a>
                                @else
                                    <span class="px-3.5 py-2 rounded-xl bg-slate-850/50 text-slate-600 text-xs font-medium border border-slate-800 cursor-not-allowed">
                                        <i class="fa fa-chevron-left mr-1"></i> Start of Course
                                    </span>
                                @endif

                                @if($nextLesson)
                                    <a href="{{ route('student.courses.learn', [$course->id, $nextLesson->id]) }}" class="px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white text-xs font-medium border border-slate-700 transition-colors flex items-center gap-1.5">
                                        <span>Next Lesson</span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span class="px-3.5 py-2 rounded-xl bg-slate-850/50 text-slate-600 text-xs font-medium border border-slate-800 cursor-not-allowed">
                                        End of Course <i class="fa fa-check ml-1"></i>
                                    </span>
                                @endif
                            </div>

                            @if($currentLesson->pdf_file)
                                <a href="{{ safe_asset($currentLesson->pdf_file) }}" target="_blank" download class="px-3.5 py-2 rounded-xl bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan hover:bg-brand-cyan hover:text-slate-950 text-xs font-semibold transition-all flex items-center gap-1.5">
                                    <i class="fa fa-file-pdf-o"></i>
                                    <span>Download Lecture Notes (PDF)</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Lesson Notes & Study Content -->
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-4">
                    <h3 class="text-base font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                        <i class="fa fa-file-text-o text-brand-primary"></i>
                        <span>Lesson Overview & Instructions</span>
                    </h3>

                    @if($currentLesson->content)
                        <div class="text-sm text-slate-300 leading-relaxed prose prose-invert max-w-none">
                            {!! $currentLesson->content !!}
                        </div>
                    @else
                        <p class="text-xs text-slate-400">
                            Watch the lecture and complete the hands-on practice. Reach out via the student support portal if you need mentorship assistance with this topic.
                        </p>
                    @endif
                </div>

            @else
                <!-- No lessons in course -->
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center text-slate-400">
                    <i class="fa fa-film text-3xl text-slate-600 mb-3 block"></i>
                    <h3 class="text-base font-bold text-white mb-1">No Lessons Available Yet</h3>
                    <p class="text-xs">Lessons for this curriculum are scheduled to be published soon.</p>
                </div>
            @endif

        </div>

        <!-- Right Column: Course Playlist & Modules (lg:col-span-4) -->
        <div class="lg:col-span-4 space-y-4">
            <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 overflow-hidden backdrop-blur-xl shadow-xl sticky top-20">

                <!-- Sidebar Header -->
                <div class="p-4 sm:p-5 bg-slate-850/80 border-b border-slate-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-white flex items-center gap-2">
                            <i class="fa fa-th-list text-brand-primary"></i>
                            <span>Course Curriculum</span>
                        </h3>
                        <span id="playlist-completed-badge" class="px-2.5 py-0.5 rounded-full bg-slate-800 border border-slate-700 text-brand-primary font-mono text-[11px] font-semibold">
                            {{ count($completedLessonIds) }} Done
                        </span>
                    </div>
                </div>

                <!-- Chapters & Lessons Accordion List -->
                <div class="max-h-[calc(100vh-250px)] overflow-y-auto divide-y divide-slate-800/60 custom-scrollbar">
                    @forelse($chapters as $chIdx => $chapter)
                        <div class="p-0">
                            <!-- Chapter Title Banner -->
                            <div class="px-4 py-3 bg-slate-950/60 flex items-center justify-between text-xs font-semibold text-slate-300 border-b border-slate-800/40">
                                <span class="truncate">
                                    <span class="text-brand-primary font-mono mr-1">Ch {{ $chIdx + 1 }}:</span>
                                    {{ $chapter->chapter_name }}
                                </span>
                                <span class="text-[10px] font-mono text-slate-500 shrink-0 ml-2">
                                    {{ $chapter->activeLessons->count() }}
                                </span>
                            </div>

                            <!-- Chapter Lessons -->
                            <div class="divide-y divide-slate-800/30">
                                @foreach($chapter->activeLessons as $lsn)
                                    @php
                                        $isActive = $currentLesson && ($currentLesson->id == $lsn->id);
                                        $isDone = in_array($lsn->id, $completedLessonIds);
                                    @endphp
                                    <a 
                                        href="{{ route('student.courses.learn', [$course->id, $lsn->id]) }}"
                                        class="flex items-center justify-between p-3.5 transition-colors group {{ $isActive ? 'bg-brand-primary/10 border-l-4 border-brand-primary text-white' : 'hover:bg-slate-800/40 text-slate-400' }}">
                                        
                                        <div class="flex items-center gap-3 min-w-0 pr-2">
                                            <!-- Checkmark / Play indicator -->
                                            <span 
                                                id="playlist-icon-{{ $lsn->id }}"
                                                class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] shrink-0 {{ $isDone ? 'bg-brand-primary text-slate-950 font-bold' : ($isActive ? 'bg-brand-primary/20 text-brand-primary border border-brand-primary/40' : 'bg-slate-800 text-slate-500') }}">
                                                <i class="fa {{ $isDone ? 'fa-check' : ($isActive ? 'fa-play' : 'fa-play-circle-o') }}"></i>
                                            </span>

                                            <div class="truncate">
                                                <p class="text-xs font-medium truncate {{ $isActive ? 'text-brand-primary font-bold' : 'group-hover:text-slate-200' }}">
                                                    {{ $lsn->lesson_title }}
                                                </p>
                                                <span class="text-[10px] font-mono text-slate-500 block mt-0.5">
                                                    {{ $lsn->formatted_duration }}
                                                    @if($lsn->pdf_file)
                                                        &bull; <i class="fa fa-file-pdf-o text-brand-cyan"></i>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        @if($isActive)
                                            <span class="px-2 py-0.5 rounded bg-brand-primary/20 text-brand-primary font-mono text-[9px] font-bold uppercase shrink-0">
                                                Playing
                                            </span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-xs text-slate-500">
                            No modules configured yet.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>

</div>

<!-- Interactive Lesson AJAX Script -->
<script>
    function toggleLessonComplete(lessonId) {
        var btn = document.getElementById('btn-toggle-complete');
        var btnIcon = document.getElementById('btn-toggle-icon');
        var btnText = document.getElementById('btn-toggle-text');
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        btn.disabled = true;
        btn.classList.add('opacity-70');

        fetch("{{ url('/student/courses/lessons') }}/" + lessonId + "/toggle-complete", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
        .then(function(res) {
            return res.json();
        })
        .then(function(data) {
            btn.disabled = false;
            btn.classList.remove('opacity-70');

            if (data.status === 'success') {
                if (data.is_completed) {
                    btn.className = "px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2 bg-brand-primary text-slate-950 shadow-glow-emerald";
                    btnIcon.className = "fa fa-check-circle";
                    btnText.innerText = "Completed";

                    // Update playlist icon
                    var pIcon = document.getElementById('playlist-icon-' + lessonId);
                    if (pIcon) {
                        pIcon.className = "w-5 h-5 rounded-full flex items-center justify-center text-[10px] shrink-0 bg-brand-primary text-slate-950 font-bold";
                        pIcon.innerHTML = '<i class="fa fa-check"></i>';
                    }
                } else {
                    btn.className = "px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider transition-all flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700";
                    btnIcon.className = "fa fa-circle-o";
                    btnText.innerText = "Mark as Completed";

                    // Update playlist icon
                    var pIcon = document.getElementById('playlist-icon-' + lessonId);
                    if (pIcon) {
                        pIcon.className = "w-5 h-5 rounded-full flex items-center justify-center text-[10px] shrink-0 bg-brand-primary/20 text-brand-primary border border-brand-primary/40";
                        pIcon.innerHTML = '<i class="fa fa-play"></i>';
                    }
                }

                // Update Progress bars & texts
                var headerProgressText = document.getElementById('header-progress-text');
                var headerProgressBar = document.getElementById('header-progress-bar');
                var playlistCompletedBadge = document.getElementById('playlist-completed-badge');

                if (headerProgressText) {
                    headerProgressText.innerText = data.progress_percent + "%";
                }
                if (headerProgressBar) {
                    headerProgressBar.style.width = data.progress_percent + "%";
                }
                if (playlistCompletedBadge) {
                    playlistCompletedBadge.innerText = data.completed_count + " Done";
                }
            }
        })
        .catch(function(err) {
            btn.disabled = false;
            btn.classList.remove('opacity-70');
            console.error('Error toggling lesson completion:', err);
        });
    }
</script>
@endsection
