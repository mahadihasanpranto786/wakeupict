@php
    $sheetLitho = isset($sheet['litho_code']) ? $sheet['litho_code'] : (isset($lithoCode) ? $lithoCode : '2058770651');
    $sheetLithoBn = isset($sheet['litho_code_bn']) ? $sheet['litho_code_bn'] : \App\Services\OmrService::toBengaliDigits($sheetLitho);
    $sheetMode = isset($sheet['mode']) ? $sheet['mode'] : (isset($mode) ? $mode : 'guide');
    $sheetCurriculum = isset($sheet['curriculum_code']) ? $sheet['curriculum_code'] : (isset($curriculumCode) ? $curriculumCode : '30');
    $sheetTrade = isset($sheet['trade_code']) ? $sheet['trade_code'] : (isset($tradeCode) ? $tradeCode : '76');
    $sheetSemester = isset($sheet['semester']) ? $sheet['semester'] : (isset($semester) ? $semester : '1');
    $sheetRoll = isset($sheet['roll']) ? $sheet['roll'] : (isset($roll) ? $roll : '');
    $sheetReg = isset($sheet['registration']) ? $sheet['registration'] : (isset($registration) ? $registration : '');
    $sheetSession = isset($sheet['session']) ? $sheet['session'] : (isset($session) ? $session : '0022');
    $sheetSubject = isset($sheet['subject_code']) ? $sheet['subject_code'] : (isset($subjectCode) ? $subjectCode : '00076');
    $sheetYear = isset($sheet['exam_year']) ? $sheet['exam_year'] : (isset($examYear) ? $examYear : '2026');
    $sheetYearBn = isset($sheet['exam_year_bn']) ? $sheet['exam_year_bn'] : \App\Services\OmrService::toBengaliDigits($sheetYear);

    $sheetBarcode = isset($sheet['barcode_svg']) ? $sheet['barcode_svg'] : (isset($barcodeSvg) ? $barcodeSvg : \App\Services\OmrService::generateBarcodeSvg($sheetLitho, 200, 46));
    $sheetQr = isset($sheet['qr_svg']) ? $sheet['qr_svg'] : (isset($qrSvg) ? $qrSvg : \App\Services\OmrService::generateQrSvg("BTEB-OMR|LITHO:{$sheetLitho}", 68));

    $isGuide = ($sheetMode === 'guide');
    $isBlank = ($sheetMode === 'blank');
    $isStudent = ($sheetMode === 'student');

    // 1. Curriculum (2 digits)
    $cleanCurr = preg_replace('/[^0-9]/', '', (string)$sheetCurriculum);
    $curriculumDigits = $isBlank ? ['', ''] : str_split(str_pad(substr($cleanCurr, 0, 2), 2, '0', STR_PAD_LEFT));

    // 2. Trade (2 digits)
    $cleanTrade = preg_replace('/[^0-9]/', '', (string)$sheetTrade);
    $tradeDigits = $isBlank ? ['', ''] : str_split(str_pad(substr($cleanTrade, 0, 2), 2, '0', STR_PAD_LEFT));

    // 3. Roll (6 digits) - Always blank boxes for students to write in exam
    $cleanRoll = preg_replace('/[^0-9]/', '', (string)$sheetRoll);
    if ($isBlank || $isGuide || empty($cleanRoll)) {
        $rollDigits = array_fill(0, 6, '');
    } else {
        $rollDigits = str_split(str_pad(substr($cleanRoll, 0, 6), 6, '0', STR_PAD_LEFT));
    }

    // 4. Registration (11 digits) - Always blank boxes for students to write in exam
    $cleanReg = preg_replace('/[^0-9]/', '', (string)$sheetReg);
    if ($isBlank || $isGuide || empty($cleanReg)) {
        $regDigits = array_fill(0, 11, '');
    } else {
        $regDigits = str_split(str_pad(substr($cleanReg, 0, 11), 11, '0', STR_PAD_LEFT));
    }

    // 5. Session (4 digits)
    $cleanSession = preg_replace('/[^0-9]/', '', (string)$sheetSession);
    $sessionDigits = $isBlank ? ['', '', '', ''] : str_split(str_pad(substr($cleanSession, 0, 4), 4, '0', STR_PAD_LEFT));

    // 6. Subject (5 digits)
    $cleanSub = preg_replace('/[^0-9]/', '', (string)$sheetSubject);
    $subjectDigits = $isBlank ? ['', '', '', '', ''] : str_split(str_pad(substr($cleanSub, 0, 5), 5, '0', STR_PAD_LEFT));

    $semesters = [
        '1' => '১ম', '2' => '২য়', '3' => '৩য়', '4' => '৪র্থ',
        '5' => '৫ম', '6' => '৬ষ্ঠ', '7' => '৭ম', '8' => '৮ম'
    ];
    $activeSemKey = (string)$sheetSemester;
    if (!isset($semesters[$activeSemKey])) {
        $activeSemKey = '1';
    }
@endphp

<style>
    /* Reset and Scoped Typography for BTEB OMR Sheet */
    .bteb-omr-page {
        width: 100%;
        max-width: 760px;
        margin: 0 auto;
        background: transparent;
        font-family: 'Noto Sans Bengali', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif !important;
        color: #000000 !important;
    }

    .bteb-omr-page * {
        box-sizing: border-box !important;
    }

    .bteb-omr-page .border-magenta { border-color: #c2185b !important; }
    .bteb-omr-page .text-magenta { color: #c2185b !important; }
    .bteb-omr-page .bg-magenta-light { background-color: #fce4ec !important; }

    /* Outer Sheet Box */
    .bteb-omr-page .omr-sheet-box {
        position: relative;
        background-color: #ffffff !important;
        border: 2px solid #c2185b !important;
        width: 100% !important;
        padding: 12px 14px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-radius: 4px;
        margin: 0 auto !important;
    }

    /* 100% Full Width OMR Columns Grid Table */
    .bteb-omr-page .omr-columns-grid {
        display: flex !important;
        width: 100% !important;
        border: 2px solid #c2185b !important;
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Column Header Cells */
    .bteb-omr-page .omr-header-cell {
        height: 52px !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        text-align: center !important;
        background-color: #fce4ec !important;
        border-bottom: 1.2px solid #c2185b !important;
        padding: 2px !important;
        overflow: hidden !important;
        width: 100% !important;
    }

    .bteb-omr-page .omr-header-cell .hdr-main {
        font-size: 8.5px !important;
        font-weight: 800 !important;
        color: #c2185b !important;
        line-height: 1.15 !important;
        white-space: nowrap !important;
    }

    .bteb-omr-page .omr-header-cell .hdr-sub {
        font-size: 7px !important;
        font-weight: 700 !important;
        color: #334155 !important;
        line-height: 1.15 !important;
        white-space: nowrap !important;
    }

    /* Unified Vertical Sub-Column: Digit Box sits directly on top of its bubble column! */
    .bteb-omr-page .omr-sub-col {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: flex-start !important;
        height: 100% !important;
    }

    /* Digit Box Cell inside each Sub-Column */
    .bteb-omr-page .digit-box-cell {
        height: 26px !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-bottom: 1.2px solid #c2185b !important;
        background-color: #ffffff !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .bteb-omr-page .digit-box {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 14px !important;
        height: 17px !important;
        border: 1.2px solid #c2185b !important;
        background-color: #ffffff !important;
        color: #000000 !important;
        font-weight: 800 !important;
        font-size: 9.5px !important;
        font-family: monospace, sans-serif !important;
        border-radius: 1px !important;
        line-height: 1 !important;
        margin: 0 auto !important;
    }

    /* Bubble Cells & Circles */
    .bteb-omr-page .bubble-cell {
        height: 19px !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .bteb-omr-page .bubble-circle {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 14px !important;
        height: 14px !important;
        border: 1.2px solid #c2185b !important;
        background-color: #ffffff !important;
        color: #c2185b !important;
        border-radius: 50% !important;
        font-size: 8px !important;
        font-weight: 700 !important;
        line-height: 1 !important;
        margin: 0 auto !important;
        user-select: none !important;
    }

    /* Filled Bubble: Only active when student demo is explicitly selected */
    .bteb-omr-page .bubble-circle.bubble-filled {
        background-color: #000000 !important;
        border-color: #000000 !important;
        color: #ffffff !important;
        font-weight: 800 !important;
    }

    /* Timing Track Marks */
    .bteb-omr-page .timing-block-h {
        width: 11px !important;
        height: 7px !important;
        background-color: #000000 !important;
        border-radius: 1px !important;
    }

    .bteb-omr-page .timing-block-v {
        width: 6px !important;
        height: 12px !important;
        background-color: #000000 !important;
        border-radius: 1px !important;
    }
</style>

<div class="bteb-omr-page omr-mode-{{ $sheetMode }}" id="omr-sheet-{{ $sheetLitho }}">
    
    <!-- =========================================================================
         1. STUDENT ADVISORY / GUIDANCE NOTICE HEADER (Only in Guide Mode)
         ========================================================================= -->
    <div class="guide-advice-banner text-center mb-3 {{ $isGuide ? '' : 'd-none hidden' }}">
        <h2 class="advice-title font-extrabold text-xl sm:text-2xl tracking-tight text-rose-600 mb-1" style="color: #c2185b !important; font-weight: 800; font-size: 1.4rem; margin-bottom: 4px;">
            এইটা সবার ফোনে সেভ করে রাখবেন
        </h2>
        <p class="advice-subtitle font-bold text-sm sm:text-base text-blue-700 mb-2 flex items-center justify-center gap-1.5" style="color: #1d4ed8 !important; font-weight: 700; font-size: 0.95rem; margin-bottom: 8px;">
            <span style="color: #1e3a8a; font-weight: 900;">(লিথু কোড)</span> 
            <span>এই কোড খাতায় লিখবেন। প্রত্যেকের কোড আলাদা হবে।</span>
        </p>
        <div style="display: inline-flex; align-items: center; justify-content: center; border: 2px solid #1e40af; background: #eff6ff; padding: 4px 22px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <span class="litho-display-number" style="color: #0f172a !important; font-weight: 900; font-size: 1.55rem; letter-spacing: 0.12em; font-family: monospace;">
                {{ $sheetLitho }}
            </span>
        </div>
    </div>

    <!-- =========================================================================
         2. BTEB AUTHENTIC OMR ANSWER SHEET CONTAINER
         ========================================================================= -->
    <div class="omr-sheet-box">
        
        <!-- Four Corner Timing Marks (Solid Black Squares 12x12px) -->
        <div class="timing-corner timing-tl" style="position: absolute; top: 5px; left: 5px; width: 12px; height: 12px; background: #000;"></div>
        <div class="timing-corner timing-tr" style="position: absolute; top: 5px; right: 5px; width: 12px; height: 12px; background: #000;"></div>
        <div class="timing-corner timing-bl" style="position: absolute; bottom: 5px; left: 5px; width: 12px; height: 12px; background: #000;"></div>
        <div class="timing-corner timing-br" style="position: absolute; bottom: 5px; right: 5px; width: 12px; height: 12px; background: #000;"></div>

        <!-- Top Alignment Sensor Track -->
        <div class="timing-track-horizontal timing-top" style="display: flex; justify-content: space-between; align-items: center; padding: 0 16px; margin-bottom: 8px;">
            @for($t = 0; $t < 28; $t++)
                <div class="timing-block-h"></div>
            @endfor
        </div>

        <!-- Board Header Row -->
        <div class="board-header-row" style="display: flex; align-items: center; justify-content: space-between; border-bottom: 2px solid #c2185b; padding-bottom: 8px; margin-bottom: 8px;">
            <!-- Left: Board Name -->
            <div class="board-name-col">
                <h1 style="font-weight: 900; font-size: 1.18rem; margin: 0; color: #000; letter-spacing: 0.02em;">
                    বাংলাদেশ কারিগরি শিক্ষা বোর্ড
                </h1>
            </div>

            <!-- Center: Warning Box -->
            <div style="border: 1px solid #c2185b; background-color: #fdf2f8; padding: 3px 10px; border-radius: 4px; text-align: center;">
                <span style="color: #c2185b; font-size: 11px; font-weight: 800; white-space: nowrap;">
                    এই বক্সের মধ্যে কোন দাগ দেয়া সম্পূর্ণ নিষিদ্ধ
                </span>
            </div>

            <!-- Right: Exam Year & QR Code -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="text-align: right;">
                    <span style="font-size: 10.5px; font-weight: 700; display: block; line-height: 1.1; color: #000;">বর্ষ/পর্ব সমাপনী পরীক্ষা</span>
                    <span style="border: 1px solid #c2185b; padding: 2px 8px; border-radius: 3px; font-weight: 800; font-size: 12px; display: inline-block; margin-top: 2px; color: #000; background: #fff;">
                        {{ $sheetYearBn }}
                    </span>
                </div>
                <div style="padding: 2px; border: 1px solid #000; background: #fff; display: inline-block;">
                    <div class="qr-svg-wrapper">
                        {!! $sheetQr !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Litho Code Strip & Notice -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 5px 12px; margin-bottom: 8px; background-color: #fdf2f8; border: 1px solid #f472b6; border-radius: 4px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="color: #c2185b; font-weight: 800; font-size: 11px;">লিথু কোড (Litho Code):</span>
                <span class="sheet-litho-val" style="border: 1px solid #c2185b; padding: 2px 8px; font-weight: 900; font-family: monospace; letter-spacing: 0.06em; background: #fff; font-size: 12px; color: #000;">
                    {{ $sheetLitho }}
                </span>
            </div>
            <div style="font-size: 10px; color: #475569; font-style: italic;">
                (লিথু কোড ওএমআর সিটের বৃত্তের ঘরে কোথাও লেখা নিষিদ্ধ)
            </div>
        </div>

        <!-- =========================================================================
             3. MAIN OMR GRID (100% Full Width Table, Perfectly Column-Aligned)
             ========================================================================= -->
        <div style="width: 100%; overflow: hidden; margin-bottom: 8px;">
            <div class="omr-columns-grid">

                <!-- 1. Column: পরীক্ষার্থীর অংশ / পর্ব (Width: 7.5%) -->
                <div style="width: 7.5%; border-right: 1px solid #c2185b; flex-shrink: 0; display: flex; flex-direction: column;">
                    <div class="omr-header-cell">
                        <span class="hdr-main">পরীক্ষার্থীর অংশ</span>
                        <span class="hdr-sub">(বল-পয়েন্ট কলম)</span>
                        <span style="font-size: 7.5px; font-weight: 800; color: #000; line-height: 1.1; margin-top: 1px; white-space: nowrap;">পর্ব/বর্ষ</span>
                    </div>
                    <!-- Single Column: Digit Box sits directly on top of bubbles -->
                    <div class="omr-sub-col" style="width: 100%;">
                        <div class="digit-box-cell">
                            <span class="digit-box">{{ $isBlank ? '' : $semesters[$activeSemKey] }}</span>
                        </div>
                        <div style="width: 100%; padding: 2px 0;">
                            @foreach($semesters as $sKey => $sLabel)
                                @php 
                                    $semFilled = ($isStudent && (string)$sKey === (string)$activeSemKey); 
                                @endphp
                                <div class="bubble-cell">
                                    <span class="bubble-circle {{ $semFilled ? 'bubble-filled' : '' }}" title="{{ $sLabel }}">
                                        {{ $sLabel }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 2. Column: কারিকুলাম কোড (2 digits, Width: 6.5%) -->
                <div style="width: 6.5%; border-right: 1px solid #c2185b; flex-shrink: 0; display: flex; flex-direction: column;">
                    <div class="omr-header-cell">
                        <span class="hdr-main">কারিকুলাম</span>
                        <span class="hdr-main">কোড</span>
                    </div>
                    <div style="display: flex; width: 100%; flex: 1;">
                        @foreach($curriculumDigits as $colIdx => $targetDigit)
                            <!-- Vertical Sub-Column: Digit Box directly above its bubbles -->
                            <div class="omr-sub-col" style="width: 50%;">
                                <div class="digit-box-cell">
                                    <span class="digit-box">{{ $targetDigit }}</span>
                                </div>
                                <div style="width: 100%; padding: 2px 0;">
                                    @for($n = 0; $n <= 9; $n++)
                                        @php $isFilled = ($isStudent && $targetDigit !== '' && (string)$n === (string)$targetDigit); @endphp
                                        <div class="bubble-cell">
                                            <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. Column: ট্রেড/পেশা/টেকনোলজি (2 digits, Width: 6.8%) -->
                <div style="width: 6.8%; border-right: 1px solid #c2185b; flex-shrink: 0; display: flex; flex-direction: column;">
                    <div class="omr-header-cell">
                        <span class="hdr-main" style="font-size: 7.8px !important;">ট্রেড/পেশা-</span>
                        <span class="hdr-main" style="font-size: 7.2px !important;">টেকনোলজি</span>
                    </div>
                    <div style="display: flex; width: 100%; flex: 1;">
                        @foreach($tradeDigits as $colIdx => $targetDigit)
                            <!-- Vertical Sub-Column: Digit Box directly above its bubbles -->
                            <div class="omr-sub-col" style="width: 50%;">
                                <div class="digit-box-cell">
                                    <span class="digit-box">{{ $targetDigit }}</span>
                                </div>
                                <div style="width: 100%; padding: 2px 0;">
                                    @for($n = 0; $n <= 9; $n++)
                                        @php $isFilled = ($isStudent && $targetDigit !== '' && (string)$n === (string)$targetDigit); @endphp
                                        <div class="bubble-cell">
                                            <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4 & 5. Combined Group: Roll Number (6 cols) & Registration Number (11 cols) (Width: 47%) -->
                <div style="width: 47%; border-right: 1px solid #c2185b; flex-shrink: 0; display: flex; flex-direction: column;">
                    <!-- Top Spanning Banner -->
                    <div style="height: 18px; line-height: 18px; background-color: #fce4ec; border-bottom: 1.2px solid #c2185b; color: #c2185b; font-size: 9px; font-weight: 900; text-align: center; white-space: nowrap;">
                        অবশ্যই বল-পয়েন্ট কলম দিয়ে পূরণ করতে হবে
                    </div>
                    
                    <div style="display: flex; flex: 1;">
                        
                        <!-- 4. Column: রোল নম্বর (6 digits, Width: 35.294%) -->
                        <div style="width: 35.294%; border-right: 1.2px solid #c2185b; display: flex; flex-direction: column;">
                            <div class="omr-header-cell" style="height: 34px !important;">
                                <span style="color: #c2185b; font-weight: 800; font-size: 9.5px; white-space: nowrap;">রোল নম্বর</span>
                            </div>
                            <div style="display: flex; width: 100%; flex: 1;">
                                @for($colIdx = 0; $colIdx < 6; $colIdx++)
                                    @php 
                                        $targetDigit = $rollDigits[$colIdx] ?? '';
                                        $isColFilled = ($isStudent && $targetDigit !== '');
                                    @endphp
                                    <!-- Vertical Sub-Column: Each digit box sits directly above its bubble column! -->
                                    <div class="omr-sub-col" style="width: 16.666%;">
                                        <div class="digit-box-cell">
                                            <span class="digit-box">{{ $targetDigit }}</span>
                                        </div>
                                        <div style="width: 100%; padding: 2px 0;">
                                            @for($n = 0; $n <= 9; $n++)
                                                @php $isFilled = ($isColFilled && (string)$n === (string)$targetDigit); @endphp
                                                <div class="bubble-cell">
                                                    <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- 5. Column: রেজিস্ট্রেশন নম্বর (11 digits, Width: 64.706%) -->
                        <div style="width: 64.706%; display: flex; flex-direction: column;">
                            <div class="omr-header-cell" style="height: 34px !important; padding: 0 4px !important;">
                                <span style="color: #c2185b; font-weight: 800; font-size: 9.5px; white-space: nowrap;">রেজিস্ট্রেশন নম্বর</span>
                                <span style="font-size: 7px; color: #334155; font-weight: 700; white-space: nowrap;">(শ্রেণি ৮ উত্তীর্ণের হলে বামে ২টি '০০' বসাতে হবে)</span>
                            </div>
                            <div style="display: flex; width: 100%; flex: 1;">
                                @for($colIdx = 0; $colIdx < 11; $colIdx++)
                                    @php 
                                        $targetDigit = $regDigits[$colIdx] ?? '';
                                        $isColFilled = ($isStudent && $targetDigit !== '');
                                        $tint = ($colIdx % 2 === 0) ? 'background-color: rgba(252, 231, 243, 0.45);' : '';
                                    @endphp
                                    <!-- Vertical Sub-Column: Each digit box sits directly above its bubble column! -->
                                    <div class="omr-sub-col" style="width: 9.0909%; {{ $tint }}">
                                        <div class="digit-box-cell" style="{{ $tint }}">
                                            <span class="digit-box">{{ $targetDigit }}</span>
                                        </div>
                                        <div style="width: 100%; padding: 2px 0;">
                                            @for($n = 0; $n <= 9; $n++)
                                                @php $isFilled = ($isColFilled && (string)$n === (string)$targetDigit); @endphp
                                                <div class="bubble-cell">
                                                    <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 6. Column: সেশন (4 digits, Width: 11%) -->
                <div style="width: 11%; border-right: 1px solid #c2185b; flex-shrink: 0; display: flex; flex-direction: column;">
                    <div class="omr-header-cell">
                        <span class="hdr-main">সেশন</span>
                    </div>
                    <div style="display: flex; width: 100%; flex: 1;">
                        @foreach($sessionDigits as $colIdx => $targetDigit)
                            <!-- Vertical Sub-Column: Digit Box directly above its bubbles -->
                            <div class="omr-sub-col" style="width: 25%;">
                                <div class="digit-box-cell">
                                    <span class="digit-box">{{ $targetDigit }}</span>
                                </div>
                                <div style="width: 100%; padding: 2px 0;">
                                    @for($n = 0; $n <= 9; $n++)
                                        @php $isFilled = ($isStudent && $targetDigit !== '' && (string)$n === (string)$targetDigit); @endphp
                                        <div class="bubble-cell">
                                            <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 7. Column: বিষয় কোড (5 digits, Width: 13.5%) -->
                <div style="width: 13.5%; border-right: 1px solid #c2185b; flex-shrink: 0; display: flex; flex-direction: column;">
                    <div class="omr-header-cell">
                        <span class="hdr-main">বিষয় কোড</span>
                    </div>
                    <div style="display: flex; width: 100%; flex: 1;">
                        @foreach($subjectDigits as $colIdx => $targetDigit)
                            <!-- Vertical Sub-Column: Digit Box directly above its bubbles -->
                            <div class="omr-sub-col" style="width: 20%;">
                                <div class="digit-box-cell">
                                    <span class="digit-box">{{ $targetDigit }}</span>
                                </div>
                                <div style="width: 100%; padding: 2px 0;">
                                    @for($n = 0; $n <= 9; $n++)
                                        @php $isFilled = ($isStudent && $targetDigit !== '' && (string)$n === (string)$targetDigit); @endphp
                                        <div class="bubble-cell">
                                            <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 8. Rightmost Signature & Warning Strip (Width: 7.7%) -->
                <div style="width: 7.7%; flex-shrink: 0; background-color: rgba(253, 242, 248, 0.45); padding: 4px 2px; display: flex; flex-direction: column; justify-content: space-between; text-align: center;">
                    <div style="writing-mode: vertical-rl; transform: rotate(180deg); margin: 0 auto; font-size: 7.5px; font-weight: 800; color: #1e293b; line-height: 1.1; letter-spacing: -0.02em;">
                        (বৃত্ত পূরণ ছাড়া অন্য কোন প্রকার দাগ দেওয়া সম্পূর্ণ নিষিদ্ধ)
                    </div>
                    <div style="margin-top: 6px; padding-top: 6px; border-top: 1px dashed #c2185b; text-align: center;">
                        <span style="font-size: 8px; font-weight: 800; color: #000; display: block; line-height: 1;">তারিখ</span>
                        <div style="height: 15px; border-bottom: 1px solid #000;"></div>
                        <span style="font-size: 7.5px; font-weight: 800; color: #000; display: block; margin-top: 6px; line-height: 1.1;">ইনভিজিলেটর স্বাক্ষর</span>
                        <div style="height: 22px; border-bottom: 1px solid #000;"></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- =========================================================================
             4. BOTTOM SECTION (Extra Scripts & Prohibited Warning Line)
             ========================================================================= -->
        <div style="margin-top: 8px; padding: 5px 8px; border: 1.2px solid #c2185b; border-radius: 4px; display: flex; align-items: center; justify-content: space-between; font-size: 11px; background-color: #fffafc;">
            <div style="color: #c2185b; font-size: 9.5px; font-weight: 800; flex-shrink: 0; margin-right: 8px;">অতিরিক্ত খাতার সংখ্যা:</div>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; flex: 1; padding: 0 4px;">
                @for($e = 1; $e <= 8; $e++)
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <span style="font-size: 8.5px; font-weight: 800;">({{ \App\Services\OmrService::toBengaliDigits($e) }})</span>
                        <div style="width: 26px; height: 13px; border: 1px solid #000; background: #fff;"></div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Warning Bottom Separator -->
        <div style="margin: 8px 0; text-align: center; font-size: 9px; font-weight: 900; color: #c2185b;">
            <span style="display: inline-block; padding: 0 8px; background: #fff;">
                ─── এই দাগের নিচে পরীক্ষার্থীর কোন কিছু লেখা বা দাগ দেওয়া সম্পূর্ণ নিষিদ্ধ ───
            </span>
        </div>

        <!-- Bottom OMR Timing Track Bars -->
        <div style="display: flex; justify-content: space-between; padding: 2px 16px 0 16px;">
            @for($b = 0; $b < 40; $b++)
                <div class="timing-block-v"></div>
            @endfor
        </div>

    </div>

    <!-- =========================================================================
         5. BOTTOM SPECIMEN NOTICE (Only in Guide Mode)
         ========================================================================= -->
    <div class="guide-bottom-banner text-center mt-3 mb-1 {{ $isGuide ? '' : 'd-none hidden' }}">
        <p style="color: #c2185b !important; font-family: 'Noto Sans Bengali', system-ui, sans-serif; font-weight: 900; font-size: 1.2rem; margin-top: 10px;">
            রেজিস্ট্রেশন নম্বর নিজেরটা লিখবেন। (ডানদিক থেকে লিখবেন)
        </p>
    </div>

</div>
