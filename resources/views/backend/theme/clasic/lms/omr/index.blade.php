@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'বিটিইবি ওএমআর শিট ও লিথু কোড বিল্ডার — Admin Console')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_bteb_omr_active', 'active')

@push('css')
<style>
    /* Admin OMR Builder CSS */
    .bteb-builder-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    .btn-mode {
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .btn-mode.active {
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    /* Print Optimization */
    @media print {
        body, .main-sidebar, .main-header, .content-header, .control-panel-card, .main-footer, .no-print {
            display: none !important;
        }
        .content-wrapper, .content {
            padding: 0 !important;
            margin: 0 !important;
            background: #ffffff !important;
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
        }
        .omr-sheet-box {
            box-shadow: none !important;
            border: 2px solid #c2185b !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        @page {
            size: {{ $pageSize ?? 'a4' }} portrait;
            margin: 8mm 6mm;
        }
    }
</style>
@endpush

@section('maincontant')
<div class="content-header p-0 mb-3 no-print">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.5rem;">
                    <i class="fas fa-id-card text-danger mr-2"></i> বিটিইবি ওএমআর শিট ও লিথু কোড বিল্ডার
                </h1>
                <p class="text-muted text-sm mb-0">
                    বাংলাদেশ কারিগরি শিক্ষা বোর্ড (BTEB) এর ওএমআর টপ শিট প্রস্তুত, লিথু কোড জেনারেশন, ব্ল্যাঙ্ক প্র্যাকটিস ও মাল্টি-সাইজ প্রিন্ট টুল।
                </p>
            </div>
            <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                <ol class="breadcrumb float-sm-right bg-transparent p-0 mb-0 text-sm">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="fas fa-home"></i> Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.quizzes.index') }}">LMS & Exam</a></li>
                    <li class="breadcrumb-item active">BTEB OMR Sheet</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- =========================================================================
         TOP CONTROL PANEL & INTERACTIVE BUILDER TOOLBAR
         ========================================================================= -->
    <div class="card card-outline card-danger shadow-sm mb-4 control-panel-card no-print">
        <div class="card-body p-3">
            
            <!-- Top Action Row -->
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3 border-bottom">
                <div>
                    <span class="badge badge-danger px-2 py-1 mr-1 text-uppercase" style="font-size: 10px; font-weight: 800;">BTEB OFFICIAL STANDARD</span>
                    <span class="text-xs font-weight-bold text-muted">বাংলাদেশ কারিগরি শিক্ষা বোর্ড • পরীক্ষা ওএমআর টপ শিট</span>
                </div>

                <!-- Primary Action Buttons -->
                <div class="d-flex flex-wrap align-items-center mt-2 mt-md-0" style="gap: 8px;">
                    <!-- Paper Size Selector -->
                    <div class="input-group input-group-sm" style="width: 175px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light text-xs font-weight-bold"><i class="fas fa-file mr-1"></i>সাইজ:</span>
                        </div>
                        <select id="builder-page-size" class="form-control form-control-sm text-xs font-weight-bold" onchange="updatePageSizePreference(this.value)">
                            <option value="a4" {{ ($pageSize ?? 'a4') == 'a4' ? 'selected' : '' }}>A4 (210×297 mm)</option>
                            <option value="legal" {{ ($pageSize ?? 'a4') == 'legal' ? 'selected' : '' }}>Legal (8.5×14 in)</option>
                            <option value="letter" {{ ($pageSize ?? 'a4') == 'letter' ? 'selected' : '' }}>Letter (8.5×11 in)</option>
                        </select>
                    </div>

                    <!-- Auto-Generate Litho Code Button -->
                    <button type="button" id="btn-quick-generate" 
                        class="btn btn-sm btn-primary font-weight-bold shadow-sm"
                        style="background-color: #4f46e5; border-color: #4338ca;">
                        <i class="fas fa-random mr-1"></i>
                        <span>অটো লিথু কোড</span>
                    </button>

                    <!-- Batch Print Trigger Modal -->
                    <button type="button" id="btn-open-batch-modal" onclick="openBatchModal()"
                        class="btn btn-sm btn-outline-secondary font-weight-bold shadow-sm">
                        <i class="fas fa-clone mr-1"></i>
                        <span>ব্যাচ প্রিন্ট (একাধিক শিট)</span>
                    </button>

                    <!-- Direct Clean Print Button -->
                    <button type="button" id="btn-single-print" onclick="openSinglePrint()" 
                        class="btn btn-sm btn-success font-weight-bold shadow-sm">
                        <i class="fas fa-print mr-1"></i>
                        <span>প্রিন্ট ওএমআর শিট</span>
                    </button>
                </div>
            </div>

            <!-- Mode Selector & Live Dynamic Configurator -->
            <div class="row">
                <!-- Left: Mode Switcher -->
                <div class="col-lg-5 mb-3 mb-lg-0">
                    <label class="d-block text-xs font-weight-bold text-muted text-uppercase mb-2">
                        <i class="fas fa-sliders-h mr-1 text-primary"></i> প্রদর্শন ও প্রিন্ট মোড নির্বাচন করুন
                    </label>
                    <div class="btn-group w-100 mb-2">
                        <!-- 1. Guide Mode -->
                        <button type="button" onclick="switchMode('guide')" 
                            class="btn btn-sm btn-mode flex-fill {{ $mode === 'guide' ? 'btn-danger font-weight-bold active' : 'btn-outline-secondary' }}"
                            id="mode-btn-guide">
                            <i class="fas fa-info-circle d-block mb-1"></i>
                            <span class="text-xs">নির্দেশনা গাইড</span>
                        </button>

                        <!-- 2. Blank Mode -->
                        <button type="button" onclick="switchMode('blank')" 
                            class="btn btn-sm btn-mode flex-fill {{ $mode === 'blank' ? 'btn-success font-weight-bold active' : 'btn-outline-secondary' }}"
                            id="mode-btn-blank">
                            <i class="fas fa-pen-alt d-block mb-1"></i>
                            <span class="text-xs">ব্ল্যাঙ্ক প্র্যাকটিস</span>
                        </button>

                        <!-- 3. Personalized Mode -->
                        <button type="button" onclick="switchMode('student')" 
                            class="btn btn-sm btn-mode flex-fill {{ $mode === 'student' ? 'btn-primary font-weight-bold active' : 'btn-outline-secondary' }}"
                            id="mode-btn-student">
                            <i class="fas fa-user-graduate d-block mb-1"></i>
                            <span class="text-xs">ব্যক্তিগত শিট</span>
                        </button>
                    </div>

                    <!-- Mode Descriptions -->
                    <div class="p-2 bg-light border rounded text-xs text-muted">
                        <div id="mode-desc-guide" class="{{ $mode === 'guide' ? '' : 'd-none' }}">
                            💡 <strong class="text-danger">নির্দেশনা গাইড:</strong> ছবির মতো নির্দেশক ব্যানার ও রোল/রেজিস্ট্রেশন লেখার নিয়ম সহ দেখাবে। শিক্ষার্থীদের ডেমো খাতা পূরণের নিয়ম শেখার জন্য উপযোগী। সমস্ত বৃত্ত খালি থাকবে যাতে শিক্ষার্থীরা পূরণ করতে পারে।
                        </div>
                        <div id="mode-desc-blank" class="{{ $mode === 'blank' ? '' : 'd-none' }}">
                            ✍️ <strong class="text-success">ব্ল্যাঙ্ক প্র্যাকটিস:</strong> সমস্ত বৃত্ত ও কোড বক্স সম্পূর্ণ খালি (Blank) থাকবে এবং নির্দেশক ব্যানার লুকানো থাকবে, যাতে শিক্ষার্থীরা পরীক্ষার পূর্বে নিজ হাতে বল-পয়েন্ট কলম দিয়ে প্র্যাকটিস করতে পারে।
                        </div>
                        <div id="mode-desc-student" class="{{ $mode === 'student' ? '' : 'd-none' }}">
                            🎓 <strong class="text-primary">ব্যক্তিগত শিট:</strong> নির্দিষ্ট শিক্ষার্থীর রোল ও রেজিস্ট্রেশন নম্বর সহ পূরণকৃত প্রিভিউ ও প্রিন্ট।
                        </div>
                    </div>
                </div>

                <!-- Right: Form Data Controls -->
                <div class="col-lg-7">
                    <form id="omr-builder-form" method="GET" action="{{ route('admin.bteb-omr.index') }}">
                        <input type="hidden" name="mode" id="input-mode" value="{{ $mode }}">
                        <input type="hidden" name="page_size" id="input-page-size" value="{{ $pageSize ?? 'a4' }}">

                        <!-- Litho Code Row -->
                        <div class="p-2 mb-2 bg-light border rounded d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center mr-2">
                                <i class="fas fa-barcode text-primary mr-2" style="font-size: 1.3rem;"></i>
                                <div>
                                    <label class="d-block text-xs font-weight-bold text-muted text-uppercase mb-0">
                                        লিথু কোড (Litho Code - ১০ ডিজিট)
                                    </label>
                                    <div class="input-group input-group-sm mt-1" style="width: 220px;">
                                        <input type="text" name="litho_code" id="input-litho-code" value="{{ $lithoCode }}" 
                                            maxlength="10" required
                                            class="form-control font-weight-bold font-monospace text-center text-sm">
                                        <div class="input-group-append">
                                            <button type="button" onclick="copyLithoCode()" class="btn btn-outline-secondary" title="কপি করুন">
                                                <i class="far fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="btn-submit-form" class="btn btn-sm btn-dark font-weight-bold mt-2 mt-sm-0">
                                <i class="fas fa-check text-success mr-1"></i> প্রয়োগ করুন
                            </button>
                        </div>

                        <!-- 7 Board Fields Grid -->
                        <div class="row">
                            <div class="col-3 col-sm-2 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">কারিকুলাম</label>
                                <input type="text" name="curriculum_code" value="{{ $curriculumCode }}" maxlength="2" 
                                    class="form-control form-control-sm text-center font-weight-bold">
                            </div>
                            <div class="col-3 col-sm-2 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">ট্রেড কোড</label>
                                <input type="text" name="trade_code" value="{{ $tradeCode }}" maxlength="2" 
                                    class="form-control form-control-sm text-center font-weight-bold">
                            </div>
                            <div class="col-3 col-sm-2 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">সেশন</label>
                                <input type="text" name="session" value="{{ $session }}" maxlength="4" 
                                    class="form-control form-control-sm text-center font-weight-bold">
                            </div>
                            <div class="col-3 col-sm-2 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">বিষয় কোড</label>
                                <input type="text" name="subject_code" value="{{ $subjectCode }}" maxlength="5" 
                                    class="form-control form-control-sm text-center font-weight-bold">
                            </div>
                            <div class="col-6 col-sm-2 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">রোল নম্বর</label>
                                <input type="text" name="roll" value="{{ $roll }}" maxlength="6" 
                                    placeholder="ঐচ্ছিক"
                                    class="form-control form-control-sm text-center font-weight-bold">
                            </div>
                            <div class="col-6 col-sm-2 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">পর্ব/বর্ষ</label>
                                <select name="semester" class="form-control form-control-sm font-weight-bold text-center">
                                    @for($i = 1; $i <= 8; $i++)
                                        @php $bn = \App\Services\OmrService::toBengaliDigits($i); @endphp
                                        <option value="{{ $i }}" {{ (string)$semester === (string)$i ? 'selected' : '' }}>
                                            {{ $bn }}ম পর্ব
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12 col-sm-8 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">রেজিস্ট্রেশন নম্বর (১১ ডিজিট)</label>
                                <input type="text" name="registration" value="{{ $registration }}" maxlength="11" 
                                    placeholder="শিক্ষার্থীর রেজিস্ট্রেশন নম্বর (খালি রাখলে ব্ল্যাঙ্ক থাকবে)"
                                    class="form-control form-control-sm font-weight-bold">
                            </div>
                            <div class="col-12 col-sm-4 mb-2">
                                <label class="text-xs text-muted mb-0 font-weight-bold">পরীক্ষার বছর</label>
                                <input type="text" name="exam_year" value="{{ $examYear }}" maxlength="4" 
                                    class="form-control form-control-sm text-center font-weight-bold">
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- =========================================================================
         LIVE OMR SHEET DISPLAY CANVAS
         ========================================================================= -->
    <div class="omr-canvas-wrapper py-3 d-flex justify-content-center">
        @include('backend.theme.clasic.lms.omr.sheet_component')
    </div>

</div>

<!-- =========================================================================
     BATCH PRINT MODAL DIALOG
     ========================================================================= -->
<div class="modal fade" id="batchPrintModal" tabindex="-1" role="dialog" aria-labelledby="batchPrintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title font-weight-bold" id="batchPrintModalLabel">
                    <i class="fas fa-clone text-info mr-2"></i> একাধিক ওএমআর শিট ব্যাচ প্রিন্ট
                </h5>
                <button type="button" class="close text-white" onclick="closeBatchModal()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('admin.bteb-omr.print') }}" method="GET" target="_blank" class="p-3">
                <input type="hidden" name="curriculum_code" value="{{ $curriculumCode }}">
                <input type="hidden" name="trade_code" value="{{ $tradeCode }}">
                <input type="hidden" name="registration" value="{{ $registration }}">
                <input type="hidden" name="roll" value="{{ $roll }}">
                <input type="hidden" name="session" value="{{ $session }}">
                <input type="hidden" name="subject_code" value="{{ $subjectCode }}">
                <input type="hidden" name="semester" value="{{ $semester }}">
                <input type="hidden" name="exam_year" value="{{ $examYear }}">

                <div class="form-group mb-3">
                    <label class="text-xs font-weight-bold text-dark mb-1">
                        প্রিন্ট মোড (Print Mode)
                    </label>
                    <select name="mode" class="form-control form-control-sm font-weight-bold">
                        <option value="guide" {{ $mode === 'guide' ? 'selected' : '' }}>নির্দেশনা গাইড (Guidance Sheet with Advice)</option>
                        <option value="blank" {{ $mode === 'blank' ? 'selected' : '' }}>ব্ল্যাঙ্ক প্র্যাকটিস (Blank Practice Sheet - খালি বৃত্ত)</option>
                        <option value="student" {{ $mode === 'student' ? 'selected' : '' }}>ব্যক্তিগত শিট (Personalized Sheet)</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="text-xs font-weight-bold text-dark mb-1">
                        কাগজের সাইজ (Paper / Variant Page Size)
                    </label>
                    <select name="page_size" id="modal-page-size" class="form-control form-control-sm font-weight-bold">
                        <option value="a4" {{ ($pageSize ?? 'a4') == 'a4' ? 'selected' : '' }}>A4 (210 × 297 mm) — Standard Exam</option>
                        <option value="legal" {{ ($pageSize ?? 'a4') == 'legal' ? 'selected' : '' }}>Legal (8.5 × 14 in) — Extra Margins</option>
                        <option value="letter" {{ ($pageSize ?? 'a4') == 'letter' ? 'selected' : '' }}>Letter (8.5 × 11 in) — Standard Letter</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="text-xs font-weight-bold text-dark mb-1">
                        শুরুর লিথু কোড (Starting Litho Code)
                    </label>
                    <input type="text" name="start_litho" id="batch-start-litho" value="{{ $lithoCode }}" maxlength="10" required
                        class="form-control form-control-sm font-monospace font-weight-bold text-center">
                    <small class="form-text text-muted">প্রতিটি শিটে ধারাবাহিক ক্রমিক অনুযায়ী ইউনিক লিথু কোড তৈরি হবে।</small>
                </div>

                <div class="form-group mb-3">
                    <label class="text-xs font-weight-bold text-dark mb-1">
                        কপির সংখ্যা (Number of Sheets: 1 – 50)
                    </label>
                    <select name="count" class="form-control form-control-sm font-weight-bold">
                        <option value="1">১টি শিট</option>
                        <option value="5" selected>৫টি শিট (ধারাবাহিক লিথু কোড)</option>
                        <option value="10">১০টি শিট</option>
                        <option value="20">২০টি শিট</option>
                        <option value="30">৩০টি শিট</option>
                        <option value="50">৫০টি শিট</option>
                    </select>
                </div>

                <div class="modal-footer px-0 pb-0">
                    <button type="button" class="btn btn-sm btn-secondary" onclick="closeBatchModal()" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-sm btn-success font-weight-bold">
                        <i class="fas fa-print mr-1"></i> ব্যাচ প্রিন্ট উইন্ডো খুলুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Quick Auto-Generate Litho Code via AJAX (Instant In-Place DOM Update)
    document.addEventListener('DOMContentLoaded', function() {
        var generateBtn = document.getElementById('btn-quick-generate');
        if (generateBtn) {
            generateBtn.addEventListener('click', function() {
                var btn = this;
                var oldHtml = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> জেনারেট হচ্ছে...';
                btn.disabled = true;

                fetch("{{ route('admin.bteb-omr.generate') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action: 'single', prefix: '20' })
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    btn.innerHTML = oldHtml;
                    btn.disabled = false;
                    if (data.success && data.litho_code) {
                        applyNewLithoCode(data.litho_code, data.qr_svg);
                    }
                })
                .catch(function(err) {
                    btn.innerHTML = oldHtml;
                    btn.disabled = false;
                    // Reliable local fallback
                    var randomCode = '20' + Math.floor(10000000 + Math.random() * 90000000);
                    applyNewLithoCode(randomCode);
                });
            });
        }
    });

    function applyNewLithoCode(code, qrSvg) {
        // 1. Update form inputs
        var inputLitho = document.getElementById('input-litho-code');
        if (inputLitho) inputLitho.value = code;

        var batchInput = document.getElementById('batch-start-litho');
        if (batchInput) batchInput.value = code;

        // 2. Update sheet visual displays
        var displayNum = document.querySelector('.litho-display-number');
        if (displayNum) displayNum.textContent = code;

        var sheetVal = document.querySelector('.sheet-litho-val');
        if (sheetVal) sheetVal.textContent = code;

        if (qrSvg) {
            var qrWrap = document.querySelector('.qr-svg-wrapper');
            if (qrWrap) qrWrap.innerHTML = qrSvg;
        }

        // 3. User feedback
        if (window.toastr) {
            toastr.success('নতুন লিথু কোড ' + code + ' তৈরি হয়েছে!');
        } else {
            alert('নতুন লিথু কোড ' + code + ' তৈরি হয়েছে!');
        }
    }

    // Switch Display Mode
    function switchMode(newMode) {
        var inputMode = document.getElementById('input-mode');
        if (inputMode) {
            inputMode.value = newMode;
        }
        var form = document.getElementById('omr-builder-form');
        if (form) {
            form.submit();
        }
    }

    // Page Size Update
    function updatePageSizePreference(size) {
        var inputPageSize = document.getElementById('input-page-size');
        if (inputPageSize) inputPageSize.value = size;

        var modalSelect = document.getElementById('modal-page-size');
        if (modalSelect) modalSelect.value = size;
    }

    // Open Single Sheet Print in New Tab with selected Page Size
    function openSinglePrint() {
        var form = document.getElementById('omr-builder-form');
        if (!form) return;
        var formData = new FormData(form);
        var params = new URLSearchParams(formData);
        params.set('count', '1');
        var printUrl = "{{ route('admin.bteb-omr.print') }}?" + params.toString();
        window.open(printUrl, '_blank');
    }

    // Copy Litho Code
    function copyLithoCode() {
        var input = document.getElementById('input-litho-code');
        if (!input) return;
        var code = input.value;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(code);
            if (window.toastr) toastr.success('লিথু কোড ' + code + ' কপি করা হয়েছে!');
            else alert('লিথু কোড ' + code + ' কপি করা হয়েছে!');
        }
    }

    // Batch Print Modal Trigger (Supports Bootstrap jQuery & Vanilla fallback)
    function openBatchModal() {
        if (window.jQuery && typeof jQuery.fn.modal === 'function') {
            $('#batchPrintModal').modal('show');
        } else {
            var modal = document.getElementById('batchPrintModal');
            if (modal) {
                modal.classList.add('show');
                modal.style.display = 'block';
                document.body.classList.add('modal-open');
            }
        }
    }

    function closeBatchModal() {
        if (window.jQuery && typeof jQuery.fn.modal === 'function') {
            $('#batchPrintModal').modal('hide');
        } else {
            var modal = document.getElementById('batchPrintModal');
            if (modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        }
    }
</script>
@endsection
