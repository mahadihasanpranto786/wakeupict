@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'বিটিইবি ওএমআর শিট ও লিথু কোড — Student Portal')
@section('page_title', 'বিটিইবি ওএমআর শিট ও লিথু কোড')

@push('css')
<style>
    /* =========================================================================
       BTEB OMR AUTHENTIC COLOR SCHEME & STYLING
       ========================================================================= */
    :root {
        --bteb-magenta: #c2185b;
        --bteb-magenta-light: #fce4ec;
        --bteb-magenta-dark: #880e4f;
    }

    .border-magenta {
        border-color: #c2185b !important;
    }
    .text-magenta {
        color: #c2185b !important;
    }
    .bg-magenta-light {
        background-color: #fce4ec !important;
    }

    /* OMR Sheet Box Container */
    .bteb-omr-page {
        max-width: 740px;
        width: 100%;
        margin: 0 auto;
        background: transparent;
    }

    .omr-sheet-box {
        position: relative;
        background-color: #ffffff !important;
        color: #000000 !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-radius: 4px;
        box-sizing: border-box;
        overflow: hidden;
        width: 100%;
        max-width: 740px;
        margin: 0 auto;
    }

    /* Four Corner Timing Marks (Solid Black Squares 12x12px) */
    .timing-corner {
        position: absolute;
        width: 12px;
        height: 12px;
        background-color: #000000;
        z-index: 10;
    }
    .timing-tl { top: 5px; left: 5px; }
    .timing-tr { top: 5px; right: 5px; }
    .timing-bl { bottom: 5px; left: 5px; }
    .timing-br { bottom: 5px; right: 5px; }

    /* Horizontal Timing Tracks */
    .timing-block-h {
        width: 11px;
        height: 7px;
        background-color: #000000;
        border-radius: 1px;
    }
    .timing-block-v {
        width: 6px;
        height: 12px;
        background-color: #000000;
        border-radius: 1px;
    }

    /* Digit Box */
    .digit-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 15px;
        height: 18px;
        border: 1.2px solid #c2185b;
        background-color: #ffffff;
        color: #000000;
        font-weight: 800;
        font-size: 10px;
        border-radius: 1px;
        line-height: 1;
        margin: 0 auto;
    }

    /* OMR Bubbles */
    .bubble-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 15px;
        height: 15px;
        border: 1.2px solid #c2185b !important;
        background-color: #ffffff !important;
        color: #c2185b !important;
        border-radius: 50%;
        font-size: 8px;
        font-weight: 700;
        line-height: 1;
        margin: 0 auto;
        user-select: none;
        transition: none;
        box-sizing: border-box;
    }

    .bubble-circle.bubble-filled {
        background-color: #000000 !important;
        border-color: #000000 !important;
        color: #ffffff !important;
        font-weight: 800 !important;
    }

    .omr-header-cell {
        height: 52px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background-color: #fce4ec;
        border-bottom: 1.2px solid #c2185b;
        box-sizing: border-box;
        padding: 2px;
    }

    .omr-digit-row {
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1.2px solid #c2185b;
        background-color: #ffffff;
        box-sizing: border-box;
    }

    .bubble-cell {
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }

    /* =========================================================================
       PRINT OPTIMIZATION (100% Crisp A4 Print Standard)
       ========================================================================= */
    @media print {
        /* Hide All Non-Print Elements */
        body {
            background: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .student-sidebar,
        .student-header,
        .control-panel-container,
        #mobile-drawer,
        .no-print {
            display: none !important;
        }
        .lg\:pl-72 {
            padding-left: 0 !important;
        }

        .omr-canvas-wrapper {
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
            width: 100% !important;
        }

        .bteb-omr-page {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 auto !important;
            padding: 0 !important;
        }

        .omr-sheet-box {
            box-shadow: none !important;
            border: 2px solid #c2185b !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            margin: 0 auto !important;
            max-width: 100% !important;
            overflow: visible !important;
        }

        /* Ensure Exact Colors on Paper */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @page {
            size: A4 portrait;
            margin: 6mm 6mm;
        }
    }
</style>
@endpush

@section('content')
<div class="px-3 sm:px-6 py-6 max-w-7xl mx-auto space-y-6">

    <!-- =========================================================================
         TOP CONTROL PANEL & INTERACTIVE BUILDER TOOLBAR
         ========================================================================= -->
    <div class="control-panel-container space-y-4">
        
        <!-- Header Banner & Action Buttons -->
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 shadow-xl flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold tracking-wider uppercase bg-brand-primary/20 text-brand-primary border border-brand-primary/30">
                        BTEB Examination Tool
                    </span>
                    <span class="text-xs text-slate-400 font-medium">বাংলাদেশ কারিগরি শিক্ষা বোর্ড</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight flex items-center gap-2">
                    <span>ওএমআর শিট ও লিথু কোড বিল্ডার</span>
                    <i class="fa fa-print text-brand-primary text-lg"></i>
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">
                    বোর্ড পরীক্ষার ওএমআর টপ শিটের খাতা পূরণের ডেমো নির্দেশনা তৈরি, লিথু কোড অটো-জেনারেট ও A4 প্রিন্ট করুন।
                </p>
            </div>

            <!-- Action Controls -->
            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Auto-Generate Litho Code Button -->
                <button type="button" id="btn-quick-generate" 
                    class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs tracking-wide flex items-center gap-2 transition-all shadow-md active:scale-95">
                    <i class="fa fa-random"></i>
                    <span>অটো লিথু কোড</span>
                </button>

                <!-- Batch Print Trigger Modal -->
                <button type="button" onclick="openBatchModal()"
                    class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold text-xs tracking-wide flex items-center gap-2 transition-all">
                    <i class="fa fa-clone"></i>
                    <span>ব্যাচ প্রিন্ট (একাধিক শিট)</span>
                </button>

                <!-- Direct Print Button -->
                <button type="button" onclick="window.print()" 
                    class="px-5 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs tracking-wide flex items-center gap-2 transition-all shadow-glow-emerald active:scale-95">
                    <i class="fa fa-print text-sm"></i>
                    <span>প্রিন্ট ওএমআর শিট</span>
                </button>
            </div>
        </div>

        <!-- Mode Selector & Live Dynamic Configurator -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
            
            <!-- Left: Active Mode Selector Tabs (5 cols) -->
            <div class="lg:col-span-5 p-4 rounded-2xl bg-slate-900 border border-slate-800 flex flex-col justify-between">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">
                        প্রদর্শন ও প্রিন্ট মোড নির্বাচন করুন
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <!-- 1. Guide Mode -->
                        <button type="button" onclick="switchMode('guide')" 
                            class="mode-btn px-3 py-2.5 rounded-xl border text-center transition-all {{ $mode === 'guide' ? 'bg-rose-500/10 border-rose-500/40 text-rose-400 font-bold' : 'bg-slate-800/60 border-slate-700/60 text-slate-400 hover:text-white' }}"
                            data-mode="guide">
                            <i class="fa fa-info-circle block text-sm mb-1"></i>
                            <span class="text-xs block">নির্দেশনা গাইড</span>
                        </button>

                        <!-- 2. Blank Mode -->
                        <button type="button" onclick="switchMode('blank')" 
                            class="mode-btn px-3 py-2.5 rounded-xl border text-center transition-all {{ $mode === 'blank' ? 'bg-brand-primary/10 border-brand-primary/40 text-brand-primary font-bold' : 'bg-slate-800/60 border-slate-700/60 text-slate-400 hover:text-white' }}"
                            data-mode="blank">
                            <i class="fa fa-pencil block text-sm mb-1"></i>
                            <span class="text-xs block">ব্ল্যাঙ্ক প্র্যাকটিস</span>
                        </button>

                        <!-- 3. Personalized Mode -->
                        <button type="button" onclick="switchMode('student')" 
                            class="mode-btn px-3 py-2.5 rounded-xl border text-center transition-all {{ $mode === 'student' ? 'bg-indigo-500/10 border-indigo-500/40 text-indigo-400 font-bold' : 'bg-slate-800/60 border-slate-700/60 text-slate-400 hover:text-white' }}"
                            data-mode="student">
                            <i class="fa fa-user-circle-o block text-sm mb-1"></i>
                            <span class="text-xs block">ব্যক্তিগত শিট</span>
                        </button>
                    </div>
                </div>

                <!-- Mode Description Note -->
                <div class="mt-3 p-2.5 rounded-xl bg-slate-950/60 border border-slate-800/80 text-[11px] text-slate-400 leading-relaxed">
                    <span id="mode-desc-guide" class="{{ $mode === 'guide' ? '' : 'hidden' }}">
                        💡 <strong class="text-rose-400">নির্দেশনা গাইড:</strong> ছবির মতো বৃত্ত ভরাট ও শীর্ষ পরামর্শ ব্যানার সহ দেখাবে। শিক্ষার্থীদের ফোনে সংরক্ষণ বা খাতা পূরণের নিয়ম শেখার জন্য উপযোগী।
                    </span>
                    <span id="mode-desc-blank" class="{{ $mode === 'blank' ? '' : 'hidden' }}">
                        ✍️ <strong class="text-brand-primary">ব্ল্যাঙ্ক প্র্যাকটিস:</strong> খালি বৃত্ত প্রিন্ট হবে, যা শিক্ষার্থীরা পরীক্ষার পূর্বে নিজ হাতে বল-পয়েন্ট কলম দিয়ে প্র্যাকটিস করতে পারবে।
                    </span>
                    <span id="mode-desc-student" class="{{ $mode === 'student' ? '' : 'hidden' }}">
                        🎓 <strong class="text-indigo-400">ব্যক্তিগত শিট:</strong> শিক্ষার্থীর নিজস্ব রেজিস্ট্রেশন ও রোল নম্বর সহ পূরণকৃত প্রিভিউ ও প্রিন্ট।
                    </span>
                </div>
            </div>

            <!-- Right: Dynamic Litho Code & Field Inputs (7 cols) -->
            <div class="lg:col-span-7 p-4 rounded-2xl bg-slate-900 border border-slate-800">
                <form id="omr-builder-form" method="GET" action="{{ route('student.omr.index') }}" class="space-y-3">
                    <input type="hidden" name="mode" id="input-mode" value="{{ $mode }}">

                    <!-- Litho Code Row -->
                    <div class="p-3 rounded-xl bg-slate-950/70 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <i class="fa fa-barcode text-brand-primary text-xl"></i>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                    লিথু কোড (Litho Code)
                                </label>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <input type="text" name="litho_code" id="input-litho-code" value="{{ $lithoCode }}" 
                                        maxlength="10" 
                                        class="w-36 px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-white font-mono font-extrabold text-sm tracking-wider focus:outline-none focus:border-brand-primary">
                                    <button type="button" onclick="copyLithoCode()" class="p-1.5 text-slate-400 hover:text-white" title="কপি করুন">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Update Button -->
                        <div class="flex items-center gap-2">
                            <button type="submit" class="px-3.5 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-bold text-xs flex items-center gap-1.5 transition-colors">
                                <i class="fa fa-check text-brand-primary"></i>
                                <span>প্রয়োগ করুন</span>
                            </button>
                        </div>
                    </div>

                    <!-- Additional Details Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 text-xs">
                        <!-- Curriculum Code -->
                        <div>
                            <label class="block text-[10px] text-slate-400 font-semibold mb-1">কারিকুলাম কোড</label>
                            <input type="text" name="curriculum_code" value="{{ $curriculumCode }}" maxlength="2" 
                                class="w-full px-2 py-1.5 rounded bg-slate-950 border border-slate-800 text-white font-mono font-bold text-center">
                        </div>

                        <!-- Trade Code -->
                        <div>
                            <label class="block text-[10px] text-slate-400 font-semibold mb-1">ট্রেড কোড</label>
                            <input type="text" name="trade_code" value="{{ $tradeCode }}" maxlength="2" 
                                class="w-full px-2 py-1.5 rounded bg-slate-950 border border-slate-800 text-white font-mono font-bold text-center">
                        </div>

                        <!-- Session -->
                        <div>
                            <label class="block text-[10px] text-slate-400 font-semibold mb-1">সেশন</label>
                            <input type="text" name="session" value="{{ $session }}" maxlength="4" 
                                class="w-full px-2 py-1.5 rounded bg-slate-950 border border-slate-800 text-white font-mono font-bold text-center">
                        </div>

                        <!-- Subject Code -->
                        <div>
                            <label class="block text-[10px] text-slate-400 font-semibold mb-1">বিষয় কোড</label>
                            <input type="text" name="subject_code" value="{{ $subjectCode }}" maxlength="5" 
                                class="w-full px-2 py-1.5 rounded bg-slate-950 border border-slate-800 text-white font-mono font-bold text-center">
                        </div>

                        <!-- Registration Number -->
                        <div class="sm:col-span-2">
                            <label class="block text-[10px] text-slate-400 font-semibold mb-1">রেজিস্ট্রেশন নম্বর (১১ ডিজিট)</label>
                            <input type="text" name="registration" value="{{ $registration }}" maxlength="11" 
                                class="w-full px-2 py-1.5 rounded bg-slate-950 border border-slate-800 text-white font-mono font-bold text-center">
                        </div>

                        <!-- Roll Number -->
                        <div>
                            <label class="block text-[10px] text-slate-400 font-semibold mb-1">রোল নম্বর</label>
                            <input type="text" name="roll" value="{{ $roll }}" maxlength="6" 
                                class="w-full px-2 py-1.5 rounded bg-slate-950 border border-slate-800 text-white font-mono font-bold text-center">
                        </div>

                        <!-- Semester -->
                        <div>
                            <label class="block text-[10px] text-slate-400 font-semibold mb-1">পর্ব/বর্ষ</label>
                            <select name="semester" class="w-full px-2 py-1.5 rounded bg-slate-950 border border-slate-800 text-white text-xs font-bold text-center">
                                @for($i = 1; $i <= 8; $i++)
                                    @php $bn = \App\Services\OmrService::toBengaliDigits($i); @endphp
                                    <option value="{{ $i }}" {{ (string)$semester === (string)$i ? 'selected' : '' }}>
                                        {{ $bn }}ম পর্ব
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- =========================================================================
         LIVE OMR SHEET DISPLAY CANVAS
         ========================================================================= -->
    <div class="omr-canvas-wrapper py-4 px-1 flex justify-center">
        @include('frontend.theme.clasic.student.omr.sheet_component')
    </div>

</div>

<!-- =========================================================================
     BATCH PRINT MODAL DIALOG
     ========================================================================= -->
<div id="batchPrintModal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-slate-900 border border-slate-800 rounded-2xl w-full max-w-md p-6 shadow-2xl relative text-left">
        <button type="button" onclick="closeBatchModal()" class="absolute top-4 right-4 text-slate-400 hover:text-white">
            <i class="fa fa-times text-lg"></i>
        </button>

        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                <i class="fa fa-clone text-lg"></i>
            </div>
            <div>
                <h3 class="font-bold text-base text-white">একাধিক ওএমআর শিট ব্যাচ প্রিন্ট</h3>
                <p class="text-xs text-slate-400">ধারাবাহিক অনন্য লিথু কোড সহ একাধিক কপি প্রিন্ট করুন</p>
            </div>
        </div>

        <form action="{{ route('student.omr.print') }}" method="GET" target="_blank" class="space-y-4">
            <input type="hidden" name="mode" value="{{ $mode }}">
            <input type="hidden" name="curriculum_code" value="{{ $curriculumCode }}">
            <input type="hidden" name="trade_code" value="{{ $tradeCode }}">
            <input type="hidden" name="registration" value="{{ $registration }}">
            <input type="hidden" name="session" value="{{ $session }}">
            <input type="hidden" name="subject_code" value="{{ $subjectCode }}">
            <input type="hidden" name="semester" value="{{ $semester }}">

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">
                    শুরুর লিথু কোড (Starting Litho Code)
                </label>
                <input type="text" name="start_litho" id="batch-start-litho" value="{{ $lithoCode }}" maxlength="10" required
                    class="w-full px-3 py-2 rounded-xl bg-slate-950 border border-slate-700 text-white font-mono font-bold text-sm tracking-wider">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">
                    কপির সংখ্যা (Number of Sheets: 1 – 50)
                </label>
                <select name="count" class="w-full px-3 py-2 rounded-xl bg-slate-950 border border-slate-700 text-white text-sm font-bold">
                    <option value="1">১টি শিট</option>
                    <option value="5" selected>৫টি শিট (ধারাবাহিক লিথু কোড)</option>
                    <option value="10">১০টি শিট</option>
                    <option value="20">২০টি শিট</option>
                    <option value="30">৩০টি শিট</option>
                    <option value="50">৫০টি শিট</option>
                </select>
                <p class="text-[11px] text-slate-500 mt-1">
                    প্রতিটি পাতায় আলাদা আলাদা ইউনিক লিথু কোড ও বারকোড সহ A4 পেজে স্বয়ংক্রিয়ভাবে জেনারেট হবে।
                </p>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2">
                <button type="button" onclick="closeBatchModal()" class="px-4 py-2 rounded-xl bg-slate-800 text-slate-300 font-semibold text-xs">
                    বাতিল
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-brand-primary text-slate-950 font-black text-xs flex items-center gap-2">
                    <i class="fa fa-print"></i>
                    <span>ব্যাচ প্রিন্ট প্রিভিউ খুলুন</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('js')
<script>
    // Quick Auto-Generate via AJAX
    document.getElementById('btn-quick-generate').addEventListener('click', function() {
        var btn = this;
        var oldHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> জেনারেট হচ্ছে...';
        btn.disabled = true;

        fetch("{{ route('student.omr.generate') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ action: 'single' })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            btn.innerHTML = oldHtml;
            btn.disabled = false;
            if (data.success && data.litho_code) {
                document.getElementById('input-litho-code').value = data.litho_code;
                document.getElementById('batch-start-litho').value = data.litho_code;
                document.getElementById('omr-builder-form').submit();
            }
        })
        .catch(function(err) {
            btn.innerHTML = oldHtml;
            btn.disabled = false;
            // Fallback random generation
            var randomCode = '20' + Math.floor(10000000 + Math.random() * 90000000);
            document.getElementById('input-litho-code').value = randomCode;
            document.getElementById('omr-builder-form').submit();
        });
    });

    // Switch Display Mode
    function switchMode(newMode) {
        document.getElementById('input-mode').value = newMode;
        document.getElementById('omr-builder-form').submit();
    }

    // Copy Litho Code
    function copyLithoCode() {
        var code = document.getElementById('input-litho-code').value;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(code);
            if (window.toastr) toastr.success('লিথু কোড ' + code + ' কপি করা হয়েছে!');
            else alert('লিথু কোড ' + code + ' কপি করা হয়েছে!');
        }
    }

    // Batch Print Modal
    function openBatchModal() {
        document.getElementById('batchPrintModal').classList.remove('hidden');
    }
    function closeBatchModal() {
        document.getElementById('batchPrintModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
