@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Exam in Progress: ' . $quiz->title . ' — Wake Up ICT')
@section('page_title', 'Live Assessment')
@section('page_crumb', 'Exam in Progress')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Sticky Exam HUD Bar -->
    <div class="student-card rounded-2xl bg-slate-900/95 border border-slate-800 p-4 sticky top-16 z-30 backdrop-blur-xl shadow-2xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-emerald-500 animate-ping"></span>
                <div>
                    <h1 class="text-sm sm:text-base font-bold text-white truncate max-w-md">
                        {{ $quiz->title }}
                    </h1>
                    <span class="text-[11px] font-mono text-slate-400">
                        Attempt #{{ $attempt->attempt_number }} &bull; Total: {{ $questions->count() }} Questions
                    </span>
                </div>
            </div>

            <!-- Timer & Action -->
            <div class="flex items-center gap-4 shrink-0">
                <!-- Live Autosave Status Indicator -->
                <div id="autosave-status" class="hidden sm:flex items-center gap-1.5 text-xs font-mono text-emerald-400">
                    <i class="fa fa-cloud text-[11px]"></i>
                    <span>All changes saved</span>
                </div>

                <!-- Live Countdown Timer -->
                <div class="px-4 py-2 rounded-xl bg-slate-950 border border-slate-800 font-mono text-sm sm:text-base font-black flex items-center gap-2 text-white">
                    <i class="fa fa-clock-o text-brand-primary"></i>
                    <span id="exam-timer">--:--</span>
                </div>

                <!-- Submit Button -->
                <button type="button" onclick="confirmSubmitExam()" class="px-5 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-1.5">
                    <i class="fa fa-check"></i>
                    <span>Submit Exam</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Exam Content Form -->
    <form id="exam-form" action="{{ route('student.quiz.submit', $attempt->id) }}" method="POST">
        @csrf
        <input type="hidden" name="time_spent_seconds" id="input-time-spent" value="{{ $attempt->time_spent_seconds }}">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- Left: Questions Stream (8 cols) -->
            <div class="lg:col-span-8 space-y-6">
                @foreach($questions as $index => $q)
                    @php
                        $savedAns = isset($existingAnswers[$q->id]) ? $existingAnswers[$q->id] : null;
                        $savedOptionIds = $savedAns ? $savedAns->selected_option_ids_array : [];
                        $isAnswered = !empty($savedOptionIds);
                    @endphp

                    <div id="question-card-{{ $q->id }}" class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-7 backdrop-blur-xl transition-all space-y-5 scroll-mt-36">
                        
                        <!-- Question Header -->
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-slate-800 border border-slate-700 text-brand-primary font-mono text-xs font-bold flex items-center justify-center shrink-0">
                                    Q{{ $index + 1 }}
                                </span>
                                <span class="text-xs font-mono text-slate-400">
                                    {{ $q->question_type == 'mcq_multi' ? 'Multiple Selection' : ($q->question_type == 'true_false' ? 'True / False' : 'Single Choice') }}
                                </span>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-slate-950 border border-slate-800 text-brand-primary font-mono text-xs font-bold">
                                {{ (int)$q->marks }} Mark{{ $q->marks > 1 ? 's' : '' }}
                            </span>
                        </div>

                        <!-- Question Prompt -->
                        <div class="text-sm sm:text-base font-semibold text-white leading-relaxed">
                            {!! nl2br(e($q->question_text)) !!}
                        </div>

                        <!-- Options List -->
                        <div class="space-y-2.5 pt-2">
                            @foreach($q->options as $opt)
                                @php
                                    $isSelected = in_array($opt->id, $savedOptionIds);
                                    $inputType = $q->question_type == 'mcq_multi' ? 'checkbox' : 'radio';
                                @endphp

                                <label class="flex items-start gap-3 p-3.5 sm:p-4 rounded-2xl bg-slate-950/60 border border-slate-800/80 hover:border-slate-700 cursor-pointer transition-all option-label group">
                                    <input 
                                        type="{{ $inputType }}" 
                                        name="answers[{{ $q->id }}]{{ $inputType == 'checkbox' ? '[]' : '' }}" 
                                        value="{{ $opt->id }}"
                                        {{ $isSelected ? 'checked' : '' }}
                                        onchange="handleOptionChange({{ $q->id }}, this)"
                                        class="mt-1 text-brand-primary focus:ring-brand-primary focus:ring-offset-slate-900 rounded bg-slate-900 border-slate-700">

                                    <div class="text-xs sm:text-sm text-slate-300 group-hover:text-white transition-colors flex-1 select-none">
                                        {{ $opt->option_text }}
                                    </div>
                                </label>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Right: Question Palette & Navigation (4 cols) -->
            <div class="lg:col-span-4 space-y-4">
                <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-5 backdrop-blur-xl shadow-xl sticky top-36 space-y-5">
                    
                    <div>
                        <h3 class="text-sm font-bold text-white flex items-center justify-between">
                            <span>Question Palette</span>
                            <span id="answered-counter" class="text-xs font-mono text-brand-primary font-bold">
                                0 / {{ $questions->count() }} Answered
                            </span>
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Click any number to jump directly to that question.</p>
                    </div>

                    <!-- Number Grid -->
                    <div class="grid grid-cols-5 gap-2 font-mono text-xs">
                        @foreach($questions as $idx => $q)
                            @php
                                $savedAns = isset($existingAnswers[$q->id]) ? $existingAnswers[$q->id] : null;
                                $isAnswered = $savedAns && !empty($savedAns->selected_option_ids_array);
                            @endphp
                            <a 
                                href="#question-card-{{ $q->id }}" 
                                id="palette-btn-{{ $q->id }}"
                                class="h-9 rounded-xl flex items-center justify-center font-bold transition-all {{ $isAnswered ? 'bg-brand-primary text-slate-950 shadow-glow-emerald' : 'bg-slate-950 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700' }}">
                                {{ $idx + 1 }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Legend -->
                    <div class="pt-3 border-t border-slate-800/80 flex items-center justify-between text-[11px] font-mono text-slate-400">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-brand-primary"></span>
                            <span>Answered</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-slate-800 border border-slate-700"></span>
                            <span>Unanswered</span>
                        </div>
                    </div>

                    <!-- Submit Action in Sidebar -->
                    <div class="pt-3 border-t border-slate-800/80">
                        <button type="button" onclick="confirmSubmitExam()" class="w-full py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center justify-center gap-2">
                            <i class="fa fa-flag-checkered"></i>
                            <span>Complete & Submit</span>
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </form>

</div>

<!-- Submission Confirmation Modal -->
<div id="submit-modal" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="student-card rounded-3xl bg-slate-900 border border-slate-800 p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-5 text-center">
        <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary border border-brand-primary/20 flex items-center justify-center mx-auto text-2xl">
            <i class="fa fa-question-circle"></i>
        </div>
        <div>
            <h3 class="text-lg font-bold text-white">Ready to Submit Exam?</h3>
            <p id="modal-answered-summary" class="text-xs text-slate-300 mt-2 leading-relaxed">
                You have answered questions. Once submitted, your answers will be automatically graded and cannot be changed.
            </p>
        </div>
        <div class="flex items-center justify-center gap-3 pt-2">
            <button type="button" onclick="closeSubmitModal()" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs transition-colors">
                Return to Exam
            </button>
            <button type="button" onclick="document.getElementById('exam-form').submit()" class="px-6 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald">
                Confirm Submit
            </button>
        </div>
    </div>
</div>

<!-- Exam Controller Script -->
<script>
    var remainingSeconds = {{ $secondsRemaining }};
    var timerElement = document.getElementById('exam-timer');
    var autosaveStatus = document.getElementById('autosave-status');
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var saveUrl = "{{ route('student.quiz.save-answer', $attempt->id) }}";
    var totalQuestions = {{ $questions->count() }};
    var secondsElapsed = 0;

    // 1. Live Countdown Timer
    function updateTimer() {
        if (remainingSeconds <= 0) {
            timerElement.innerText = "00:00";
            timerElement.className = "px-4 py-2 rounded-xl bg-rose-500/20 border border-rose-500 text-rose-400 font-mono text-sm sm:text-base font-black flex items-center gap-2";
            document.getElementById('exam-form').submit();
            return;
        }

        var hours = Math.floor(remainingSeconds / 3600);
        var minutes = Math.floor((remainingSeconds % 3600) / 60);
        var seconds = remainingSeconds % 60;

        var display = (hours > 0 ? (hours < 10 ? "0" + hours : hours) + ":" : "") + 
                      (minutes < 10 ? "0" + minutes : minutes) + ":" + 
                      (seconds < 10 ? "0" + seconds : seconds);

        timerElement.innerText = display;

        if (remainingSeconds < 300) { // < 5 mins warning
            timerElement.className = "px-4 py-2 rounded-xl bg-rose-500/20 border border-rose-500/40 text-rose-400 font-mono text-sm sm:text-base font-black flex items-center gap-2 animate-pulse";
        }

        remainingSeconds--;
        secondsElapsed++;
        document.getElementById('input-time-spent').value = secondsElapsed;
    }

    setInterval(updateTimer, 1000);
    updateTimer();

    // 2. Option Change & Real-Time Autosave
    function handleOptionChange(questionId, inputEl) {
        var card = document.getElementById('question-card-' + questionId);
        var checkedInputs = card.querySelectorAll('input:checked');
        var selectedValues = [];

        checkedInputs.forEach(function(inp) {
            selectedValues.push(inp.value);
        });

        // Update palette button
        var palBtn = document.getElementById('palette-btn-' + questionId);
        if (palBtn) {
            if (selectedValues.length > 0) {
                palBtn.className = "h-9 rounded-xl flex items-center justify-center font-bold transition-all bg-brand-primary text-slate-950 shadow-glow-emerald";
            } else {
                palBtn.className = "h-9 rounded-xl flex items-center justify-center font-bold transition-all bg-slate-950 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-700";
            }
        }

        updatePaletteCounter();

        // Autosave via AJAX
        if (autosaveStatus) {
            autosaveStatus.innerHTML = '<i class="fa fa-spinner fa-spin text-[11px]"></i> <span>Saving...</span>';
            autosaveStatus.className = 'hidden sm:flex items-center gap-1.5 text-xs font-mono text-amber-400';
        }

        fetch(saveUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                question_id: questionId,
                selected_option_ids: selectedValues,
                time_spent_seconds: secondsElapsed
            })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (autosaveStatus) {
                autosaveStatus.innerHTML = '<i class="fa fa-cloud text-[11px]"></i> <span>All changes saved</span>';
                autosaveStatus.className = 'hidden sm:flex items-center gap-1.5 text-xs font-mono text-emerald-400';
            }
        })
        .catch(function(err) {
            console.error('Autosave error:', err);
        });
    }

    function updatePaletteCounter() {
        var answered = 0;
        for (var i = 1; i <= totalQuestions; i++) {
            // Find palette button
            var btns = document.querySelectorAll('[id^="palette-btn-"]');
            answered = Array.from(btns).filter(function(b) {
                return b.classList.contains('bg-brand-primary');
            }).length;
        }

        var counter = document.getElementById('answered-counter');
        if (counter) {
            counter.innerText = answered + " / " + totalQuestions + " Answered";
        }
    }

    updatePaletteCounter();

    // 3. Modal Confirm Submit
    function confirmSubmitExam() {
        var modal = document.getElementById('submit-modal');
        var answered = Array.from(document.querySelectorAll('[id^="palette-btn-"]')).filter(function(b) {
            return b.classList.contains('bg-brand-primary');
        }).length;

        var summary = document.getElementById('modal-answered-summary');
        if (summary) {
            summary.innerText = "You have answered " + answered + " of " + totalQuestions + " questions. Once submitted, your exam will be finalized and graded.";
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeSubmitModal() {
        var modal = document.getElementById('submit-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // 4. Tab Blur Proctoring Warning
    var blurCount = 0;
    window.addEventListener('blur', function() {
        blurCount++;
        if (blurCount <= 3 && typeof toastr !== 'undefined') {
            toastr.warning('Please remain on the exam tab. Tab switching activity is tracked.', 'Exam Integrity Alert');
        }
    });
</script>
@endsection
