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

    // 1. Curriculum (2 digits)
    $curriculumDigits = str_split(str_pad(substr(preg_replace('/[^0-9]/', '', (string)$sheetCurriculum), 0, 2), 2, '0', STR_PAD_LEFT));

    // 2. Trade (2 digits)
    $tradeDigits = str_split(str_pad(substr(preg_replace('/[^0-9]/', '', (string)$sheetTrade), 0, 2), 2, '0', STR_PAD_LEFT));

    // 3. Roll (6 digits) - User provides in exam; empty boxes in guide/practice
    $cleanRoll = preg_replace('/[^0-9]/', '', (string)$sheetRoll);
    if ($isGuide || empty($cleanRoll)) {
        $rollDigits = array_fill(0, 6, '');
    } else {
        $rollDigits = str_split(str_pad(substr($cleanRoll, 0, 6), 6, '0', STR_PAD_LEFT));
    }

    // 4. Registration (11 digits) - User provides in exam; empty boxes in guide/practice
    $cleanReg = preg_replace('/[^0-9]/', '', (string)$sheetReg);
    if ($isGuide || empty($cleanReg)) {
        // Boxes are removed/blank so student can write their own
        $regDigits = array_fill(0, 11, '');
    } else {
        $regDigits = str_split(str_pad(substr($cleanReg, 0, 11), 11, '0', STR_PAD_LEFT));
    }

    // 5. Session (4 digits)
    $sessionDigits = str_split(str_pad(substr(preg_replace('/[^0-9]/', '', (string)$sheetSession), 0, 4), 4, '0', STR_PAD_LEFT));

    // 6. Subject (5 digits)
    $subjectDigits = str_split(str_pad(substr(preg_replace('/[^0-9]/', '', (string)$sheetSubject), 0, 5), 5, '0', STR_PAD_LEFT));

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
    .bteb-omr-page .border-magenta { border-color: #c2185b !important; }
    .bteb-omr-page .text-magenta { color: #c2185b !important; }
    .bteb-omr-page .bg-magenta-light { background-color: #fce4ec !important; }

    .bteb-omr-page .omr-header-cell {
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

    .bteb-omr-page .omr-digit-row {
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1.2px solid #c2185b;
        background-color: #ffffff;
        box-sizing: border-box;
    }

    .bteb-omr-page .digit-box {
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
        box-sizing: border-box;
    }

    .bteb-omr-page .bubble-cell {
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }

    .bteb-omr-page .bubble-circle {
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
        box-sizing: border-box;
    }

    .bteb-omr-page .bubble-circle.bubble-filled {
        background-color: #000000 !important;
        border-color: #000000 !important;
        color: #ffffff !important;
        font-weight: 800 !important;
    }
</style>

<div class="bteb-omr-page" id="omr-sheet-{{ $sheetLitho }}">
    
    @if($isGuide)
    <!-- =========================================================================
         1. STUDENT ADVISORY / GUIDANCE NOTICE HEADER (Matching user specimen)
         ========================================================================= -->
    <div class="guide-advice-banner text-center mb-3">
        <h2 class="advice-title font-extrabold text-xl sm:text-2xl tracking-tight text-rose-600 mb-1" style="color: #c2185b !important;">
            এইটা সবার ফোনে সেভ করে রাখবেন
        </h2>
        <p class="advice-subtitle font-bold text-sm sm:text-base text-blue-700 mb-2 flex items-center justify-center gap-1.5" style="color: #1d4ed8 !important;">
            <span class="text-blue-900 font-extrabold">(লিথু কোড)</span> 
            <span>এই কোড খাতায় লিখবেন। প্রত্যেকের কোড আলাদা হবে।</span>
        </p>
        <div class="inline-flex items-center justify-center px-6 py-1.5 rounded-lg border-2 border-blue-800 bg-blue-50/50 shadow-sm">
            <span class="litho-display-number font-mono font-extrabold text-xl sm:text-2xl tracking-widest text-blue-950" style="color: #0f172a !important;">
                {{ $sheetLitho }}
            </span>
        </div>
    </div>
    @endif

    <!-- =========================================================================
         2. BTEB AUTHENTIC OMR ANSWER SHEET CONTAINER
         ========================================================================= -->
    <div class="omr-sheet-box relative bg-white border-2 border-magenta p-3 sm:p-4 text-black font-sans selection:bg-pink-100" style="border-color: #c2185b; background-color: #ffffff; box-sizing: border-box; width: 100%; max-width: 740px; margin: 0 auto;">
        
        <!-- Corner Timing Marks (Solid Black Squares) -->
        <div class="timing-corner timing-tl"></div>
        <div class="timing-corner timing-tr"></div>
        <div class="timing-corner timing-bl"></div>
        <div class="timing-corner timing-br"></div>

        <!-- Top Alignment Sensor Track -->
        <div class="timing-track-horizontal timing-top flex justify-between items-center px-4 mb-2">
            @for($t = 0; $t < 26; $t++)
                <div class="timing-block-h"></div>
            @endfor
        </div>

        <!-- Board Header Row -->
        <div class="board-header-row flex items-center justify-between pb-2 mb-2 border-b-2 border-magenta" style="border-color: #c2185b;">
            <!-- Left: Board Name -->
            <div class="board-name-col">
                <h1 class="board-title font-extrabold text-base sm:text-lg text-black tracking-wide leading-tight">
                    বাংলাদেশ কারিগরি শিক্ষা বোর্ড
                </h1>
            </div>

            <!-- Center: Warning Box -->
            <div class="board-warning-col px-2.5 py-1 border border-magenta rounded text-center" style="border-color: #c2185b; background-color: #fdf2f8;">
                <span class="text-[11px] font-bold text-magenta" style="color: #c2185b;">
                    এই বক্সের মধ্যে কোন দাগ দেয়া সম্পূর্ণ নিষিদ্ধ
                </span>
            </div>

            <!-- Right: Exam Year & QR Code -->
            <div class="board-meta-col flex items-center gap-2.5">
                <div class="text-right">
                    <span class="text-[11px] font-bold block text-black leading-tight">বর্ষ/পর্ব সমাপনী পরীক্ষা</span>
                    <span class="text-xs font-extrabold font-mono text-black border border-magenta px-2 py-0.5 rounded inline-block bg-white mt-0.5" style="border-color: #c2185b;">
                        {{ $sheetYearBn }}
                    </span>
                </div>
                <div class="qr-box p-1 border border-black bg-white inline-block">
                    {!! $sheetQr !!}
                </div>
            </div>
        </div>

        <!-- Litho Code Strip & Notice (Barcode removed as requested) -->
        <div class="litho-strip flex items-center justify-between px-3 py-1.5 mb-2 bg-pink-50/60 border border-magenta/40 rounded text-xs" style="border-color: #f472b6;">
            <div class="flex items-center gap-2">
                <span class="font-bold text-magenta text-[11px]" style="color: #c2185b;">লিথু কোড (Litho Code):</span>
                <span class="font-mono font-extrabold text-black bg-white px-2 py-0.5 border border-magenta/50 rounded text-xs tracking-wider" style="border-color: #c2185b;">
                    {{ $sheetLitho }}
                </span>
            </div>
            <div class="text-[10px] text-slate-700 italic">
                (লিথু কোড ওএমআর সিটের বৃত্তের ঘরে কোথাও লেখা নিষিদ্ধ)
            </div>
        </div>

        <!-- =========================================================================
             3. MAIN OMR GRID (8 Strictly Aligned Columns)
             ========================================================================= -->
        <div class="omr-grid-wrapper w-full overflow-x-auto">
            <div class="omr-columns-grid flex border-2 border-magenta mx-auto" style="border-color: #c2185b; box-sizing: border-box; width: 650px; min-width: 650px;">

                <!-- 1. Column: পরীক্ষার্থীর অংশ / পর্ব (width: 52px) -->
                <div class="omr-col col-semester border-r border-magenta flex-shrink-0" style="border-color: #c2185b; width: 52px;">
                    <div class="omr-header-cell">
                        <span class="text-[9px] font-bold block leading-tight text-magenta">পরীক্ষার্থীর অংশ</span>
                        <span class="text-[7.5px] font-semibold block text-slate-700 leading-tight">(বল-পয়েন্ট কলম)</span>
                        <span class="text-[8.5px] font-bold block text-black leading-tight mt-0.5">পরীক্ষা পর্ব/বর্ষ</span>
                    </div>
                    <div class="omr-digit-row">
                        <span class="digit-box font-bold text-[10px]">
                            {{ $semesters[$activeSemKey] }}
                        </span>
                    </div>
                    <div class="py-1 flex flex-col justify-start">
                        @foreach($semesters as $sKey => $sLabel)
                            @php $semFilled = ($sheetMode === 'student' && (string)$sKey === (string)$activeSemKey); @endphp
                            <div class="bubble-cell">
                                <span class="bubble-circle {{ $semFilled ? 'bubble-filled' : '' }}" title="{{ $sLabel }}">
                                    {{ $sLabel }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 2. Column: কারিকুলাম কোড (2 digits, width: 44px) -->
                <div class="omr-col col-curriculum border-r border-magenta flex-shrink-0" style="border-color: #c2185b; width: 44px;">
                    <div class="omr-header-cell">
                        <span class="text-[9.5px] font-bold block leading-tight text-magenta">কারিকুলাম</span>
                        <span class="text-[9.5px] font-bold block leading-tight text-magenta">কোড</span>
                    </div>
                    <div class="omr-digit-row grid grid-cols-2 w-full">
                        @foreach($curriculumDigits as $d)
                            <div class="flex items-center justify-center">
                                <span class="digit-box font-mono font-bold">{{ $d }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-2 py-1 w-full">
                        @foreach($curriculumDigits as $colIdx => $targetDigit)
                            <div class="flex flex-col items-center">
                                @for($n = 0; $n <= 9; $n++)
                                    @php $isFilled = ($sheetMode === 'student' && (string)$n === (string)$targetDigit); @endphp
                                    <div class="bubble-cell">
                                        <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                    </div>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. Column: ট্রেড/পেশা/টেকনোলজি (2 digits, width: 46px) -->
                <div class="omr-col col-trade border-r border-magenta flex-shrink-0" style="border-color: #c2185b; width: 46px;">
                    <div class="omr-header-cell">
                        <span class="text-[8.5px] font-bold block leading-tight text-magenta">ট্রেড/পেশা-</span>
                        <span class="text-[8px] font-bold block leading-tight text-magenta">টেকনোলজি</span>
                    </div>
                    <div class="omr-digit-row grid grid-cols-2 w-full">
                        @foreach($tradeDigits as $d)
                            <div class="flex items-center justify-center">
                                <span class="digit-box font-mono font-bold">{{ $d }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-2 py-1 w-full">
                        @foreach($tradeDigits as $colIdx => $targetDigit)
                            <div class="flex flex-col items-center">
                                @for($n = 0; $n <= 9; $n++)
                                    @php $isFilled = ($sheetMode === 'student' && (string)$n === (string)$targetDigit); @endphp
                                    <div class="bubble-cell">
                                        <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                    </div>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 4 & 5. Combined Group: Roll Number (6 cols) & Registration Number (11 cols) (width: 304px) -->
                <div class="omr-col-group flex flex-col border-r border-magenta flex-shrink-0" style="border-color: #c2185b; width: 304px;">
                    <!-- Top Spanning Banner -->
                    <div class="spanning-header bg-magenta-light py-0.5 px-1 text-center border-b border-magenta text-[9px] font-extrabold text-magenta" style="height: 18px; line-height: 14px; background-color: #fce4ec; border-color: #c2185b; color: #c2185b;">
                        অবশ্যই বল-পয়েন্ট কলম দিয়ে পূরণ করতে হবে
                    </div>
                    <!-- Sub-headers row (height: 34px) -->
                    <div class="flex border-b border-magenta" style="height: 34px; border-color: #c2185b;">
                        <!-- Roll Header (106px) -->
                        <div class="border-r border-magenta flex flex-col justify-center items-center bg-magenta-light text-center" style="width: 106px; border-color: #c2185b; background-color: #fce4ec;">
                            <span class="text-[10px] font-bold block text-magenta" style="color: #c2185b;">রোল নম্বর</span>
                        </div>
                        <!-- Reg Header (198px) -->
                        <div class="flex-1 flex flex-col justify-center items-center bg-magenta-light text-center px-1" style="width: 198px; background-color: #fce4ec;">
                            <span class="text-[10px] font-bold block text-magenta leading-tight" style="color: #c2185b;">রেজিস্ট্রেশন নম্বর</span>
                            <span class="text-[7px] font-semibold text-slate-700 block leading-tight">(শ্রেণি ৮ উত্তীর্ণের হলে বামে ২টি '০০০০' বসাতে হবে)</span>
                        </div>
                    </div>

                    <!-- Side-by-side Roll and Registration content -->
                    <div class="flex flex-1">
                        <!-- 4. Column: রোল নম্বর (6 digits, width: 106px) - User provides, EMPTY boxes -->
                        <div class="border-r border-magenta flex flex-col" style="width: 106px; border-color: #c2185b;">
                            <div class="omr-digit-row grid grid-cols-6 w-full">
                                @foreach($rollDigits as $d)
                                    <div class="flex items-center justify-center">
                                        <span class="digit-box font-mono font-bold">{{ $d }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="py-1 flex-1">
                                <div class="grid grid-cols-6 w-full">
                                    @for($colIdx = 0; $colIdx < 6; $colIdx++)
                                        @php 
                                            $targetDigit = $rollDigits[$colIdx] ?? '';
                                            $isColFilled = ($sheetMode === 'student' && $targetDigit !== '');
                                        @endphp
                                        <div class="flex flex-col items-center">
                                            @for($n = 0; $n <= 9; $n++)
                                                @php $isFilled = ($isColFilled && (string)$n === (string)$targetDigit); @endphp
                                                <div class="bubble-cell">
                                                    <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                                </div>
                                            @endfor
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- 5. Column: রেজিস্ট্রেশন নম্বর (11 digits, width: 198px) - User provides, EMPTY in Guide mode -->
                        <div class="flex flex-col" style="width: 198px;">
                            <!-- 11 Digit Boxes (EMPTY for user input) -->
                            <div class="omr-digit-row grid grid-cols-11 w-full">
                                @foreach($regDigits as $d)
                                    <div class="flex items-center justify-center">
                                        <span class="digit-box font-mono font-bold">{{ $d }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <!-- 11 Bubble Columns (with authentic pink shading) -->
                            <div class="grid grid-cols-11 py-1 w-full flex-1">
                                @for($colIdx = 0; $colIdx < 11; $colIdx++)
                                    @php 
                                        $targetDigit = $regDigits[$colIdx] ?? '';
                                        $isColFilled = ($sheetMode === 'student' && $targetDigit !== '');
                                        $tint = ($colIdx % 2 === 0) ? 'bg-pink-100/40' : 'bg-transparent';
                                    @endphp
                                    <div class="flex flex-col items-center {{ $tint }}">
                                        @for($n = 0; $n <= 9; $n++)
                                            @php $isFilled = ($isColFilled && (string)$n === (string)$targetDigit); @endphp
                                            <div class="bubble-cell">
                                                <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. Column: সেশন (4 digits, width: 70px) -->
                <div class="omr-col col-session border-r border-magenta flex-shrink-0" style="border-color: #c2185b; width: 70px;">
                    <div class="omr-header-cell">
                        <span class="text-[10px] font-bold block text-magenta">সেশন</span>
                    </div>
                    <div class="omr-digit-row grid grid-cols-4 w-full">
                        @foreach($sessionDigits as $d)
                            <div class="flex items-center justify-center">
                                <span class="digit-box font-mono font-bold">{{ $d }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-4 py-1 w-full">
                        @foreach($sessionDigits as $colIdx => $targetDigit)
                            <div class="flex flex-col items-center">
                                @for($n = 0; $n <= 9; $n++)
                                    @php $isFilled = ($sheetMode === 'student' && (string)$n === (string)$targetDigit); @endphp
                                    <div class="bubble-cell">
                                        <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                    </div>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 7. Column: বিষয় কোড (5 digits, width: 86px) -->
                <div class="omr-col col-subject border-r border-magenta flex-shrink-0" style="border-color: #c2185b; width: 86px;">
                    <div class="omr-header-cell">
                        <span class="text-[10px] font-bold block text-magenta">বিষয় কোড</span>
                    </div>
                    <div class="omr-digit-row grid grid-cols-5 w-full">
                        @foreach($subjectDigits as $d)
                            <div class="flex items-center justify-center">
                                <span class="digit-box font-mono font-bold">{{ $d }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-5 py-1 w-full">
                        @foreach($subjectDigits as $colIdx => $targetDigit)
                            <div class="flex flex-col items-center">
                                @for($n = 0; $n <= 9; $n++)
                                    @php $isFilled = ($sheetMode === 'student' && (string)$n === (string)$targetDigit); @endphp
                                    <div class="bubble-cell">
                                        <div class="bubble-circle {{ $isFilled ? 'bubble-filled' : '' }}">{{ $n }}</div>
                                    </div>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 8. Rightmost Signature & Warning Strip (width: 48px) -->
                <div class="omr-col col-signature flex-shrink-0 bg-pink-50/20 p-1 flex flex-col justify-between text-center" style="width: 48px; box-sizing: border-box;">
                    <div class="writing-mode-vertical text-[8px] font-bold text-slate-800 tracking-tight leading-tight mt-1" style="writing-mode: vertical-rl; transform: rotate(180deg); margin: 0 auto;">
                        (বৃত্ত পূরণ ছাড়া অন্য কোন প্রকার দাগ দেওয়া সম্পূর্ণ নিষিদ্ধ)
                    </div>
                    <div class="mt-2 pt-2 border-t border-dashed border-magenta text-center">
                        <span class="text-[8.5px] font-bold block text-black">তারিখ</span>
                        <div class="h-4 border-b border-black"></div>
                        <span class="text-[8px] font-bold block text-black mt-2 leading-tight">ইনভিজিলেটর স্বাক্ষর</span>
                        <div class="h-6 border-b border-black"></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- =========================================================================
             4. BOTTOM SECTION (Extra Scripts & Prohibited Warning Line)
             ========================================================================= -->
        <div class="extra-scripts-row mt-2 p-1.5 border border-magenta rounded flex items-center justify-between text-xs" style="border-color: #c2185b; background-color: #fffafc;">
            <div class="font-bold text-magenta text-[10px] flex-shrink-0 mr-2" style="color: #c2185b;">অতিরিক্ত খাতার সংখ্যা:</div>
            <div class="grid grid-cols-4 gap-2 flex-1 px-1">
                @for($e = 1; $e <= 8; $e++)
                    <div class="flex items-center gap-1">
                        <span class="text-[9px] font-bold">({{ \App\Services\OmrService::toBengaliDigits($e) }})</span>
                        <div class="w-7 h-3.5 border border-black bg-white"></div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Warning Bottom Separator -->
        <div class="warning-bottom-line text-center my-2 text-[9.5px] font-extrabold tracking-wide text-magenta" style="color: #c2185b;">
            <span class="inline-block px-2 bg-white relative z-10">
                ─── এই দাগের নিচে পরীক্ষার্থীর কোন কিছু লেখা বা দাগ দেওয়া সম্পূর্ণ নিষিদ্ধ ───
            </span>
        </div>

        <!-- Bottom OMR Timing Track Bars -->
        <div class="timing-track-horizontal timing-bottom flex justify-between items-center px-4 pt-0.5">
            @for($b = 0; $b < 38; $b++)
                <div class="timing-block-v"></div>
            @endfor
        </div>

    </div>

    @if($isGuide)
    <!-- =========================================================================
         5. BOTTOM SPECIMEN NOTICE (Matching user specimen in Image 2)
         ========================================================================= -->
    <div class="guide-bottom-banner text-center mt-3 mb-1">
        <p class="font-extrabold text-lg sm:text-xl tracking-wide text-rose-600" style="color: #c2185b !important; font-family: 'Noto Sans Bengali', system-ui, sans-serif;">
            রেজিস্ট্রেশন নম্বর নিজেরটা লিখবেন। (ডানদিক থেকে লিখবেন)
        </p>
    </div>
    @endif

</div>
