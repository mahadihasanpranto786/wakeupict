<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $paper->title }} — বোর্ড পরীক্ষার প্রশ্নপত্র</title>
    <!-- fab icon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('frontend/image/wakeupict-fabicon.png') }}" />
    
    <!-- Enterprise Fonts & Kalpurush -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />

    <style>
        @font-face {
            font-family: 'my_kalpurush';
            font-display: swap;
            font-style: normal;
            font-weight: 100 900;
            src: local('my_kalpurush'), local('Kalpurush'), local('Kalpurush ANSI'),
                 url('{{ asset('frontend/fonts/Kalpurush.woff2') }}') format('woff2'),
                 url('{{ asset('frontend/fonts/Kalpurush.ttf') }}') format('truetype');
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: my_kalpurush, 'Noto Sans Bengali', 'SolaimanLipi', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 13pt;
            line-height: 1.35;
            color: #000000;
            background: #e2e8f0;
            padding: 20px 0;
        }

        .paper-container {
            max-width: 210mm;
            margin: 0 auto;
            background: #ffffff;
            padding: 15mm 18mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        /* Board Paper Header Styles */
        .board-header {
            text-align: center;
            border-bottom: 2px solid #000000;
            padding-bottom: 12px;
            margin-bottom: 16px;
            position: relative;
        }

        .board-name {
            font-size: 16pt;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .exam-title {
            font-size: 14pt;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .subject-title {
            font-size: 13.5pt;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .meta-strip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11.5pt;
            font-weight: 700;
            border-top: 1px dashed #64748b;
            padding-top: 6px;
            margin-top: 6px;
        }

        .set-badge {
            display: inline-block;
            border: 2px solid #000000;
            padding: 2px 10px;
            font-size: 12pt;
            font-weight: 800;
            border-radius: 4px;
        }

        .instruction-box {
            font-size: 10.5pt;
            font-style: italic;
            text-align: justify;
            margin-bottom: 16px;
            padding: 6px 10px;
            border: 1px solid #94a3b8;
            background: #f8fafc;
        }

        .section-header {
            text-align: center;
            font-weight: 800;
            font-size: 12.5pt;
            margin: 16px 0 10px 0;
            padding: 4px;
            background: #f1f5f9;
            border: 1px solid #000000;
            text-transform: uppercase;
        }

        .section-instructions {
            text-align: center;
            font-size: 10.5pt;
            font-weight: 600;
            margin-bottom: 12px;
        }

        /* 2-Column Board Question Grid */
        .questions-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 22px;
            row-gap: 12px;
        }

        .question-item {
            page-break-inside: avoid;
            break-inside: avoid;
            font-size: 11.5pt;
            line-height: 1.3;
        }

        .q-text {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .q-stimulus {
            font-size: 10pt;
            font-style: italic;
            background: #f1f5f9;
            padding: 4px 6px;
            margin-bottom: 4px;
            border-left: 3px solid #000000;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 8px;
            row-gap: 2px;
            margin-top: 4px;
            font-size: 10.5pt;
        }

        .opt-choice {
            display: flex;
            align-items: baseline;
        }

        .opt-letter {
            font-weight: 700;
            margin-right: 4px;
        }

        .print-toolbar {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background: #1e293b;
            color: #ffffff;
            padding: 10px 16px;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 9999;
        }

        .print-toolbar button {
            background: #10b981;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .print-toolbar button:hover {
            background: #059669;
            transform: scale(1.05);
        }

        /* Pure CSS Print Rules */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
            }
            .paper-container {
                box-shadow: none !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .print-toolbar {
                display: none !important;
            }
            @page {
                size: A4 portrait;
                margin: 12mm 15mm;
            }
            .question-item {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
            .section-header {
                page-break-after: avoid;
            }
        }
    </style>
</head>
<body>

    <!-- Print Floating Toolbar -->
    <div class="print-toolbar">
        <span><i class="fas fa-file-pdf text-warning mr-1"></i> A4 বোর্ড প্রিন্ট</span>
        <button onclick="window.print()"><i class="fas fa-print mr-1"></i> প্রিন্ট / PDF সংরক্ষণ</button>
        <button onclick="window.close()" style="background: #475569;">বন্ধ করুন</button>
    </div>

    <!-- Paper Container -->
    <div class="paper-container">

        <!-- Board Header -->
        <div class="board-header">
            <div class="board-name">{{ $paper->board_name }}</div>
            <div class="exam-title">{{ $paper->exam_name }}</div>
            <div class="subject-title">
                {{ $paper->subject_name }}
                @if($paper->class_level)
                    ({{ $paper->class_level }})
                @endif
            </div>

            <div class="meta-strip">
                <div>বিষয় কোড: <strong>{{ \App\model\LmsQuiz::toBengaliNumber($paper->subject_code) }}</strong></div>
                <div class="set-badge">{{ \App\model\LmsQuestionPaper::getBengaliSetCode($paper->paper_set) }}</div>
                <div>সময়: <strong>{{ \App\model\LmsQuiz::toBengaliNumber($paper->duration_minutes) }} মিনিট</strong></div>
                <div>পূর্ণমান: <strong>{{ \App\model\LmsQuiz::toBengaliNumber($paper->total_marks) }}</strong></div>
            </div>
        </div>

        <!-- Instructions -->
        @if($paper->instructions)
            <div class="instruction-box">
                {!! nl2br(e($paper->instructions)) !!}
            </div>
        @endif

        <!-- Sections and Questions -->
        @php
            $globalCounter = 0;
        @endphp

        @foreach($paper->sections as $sec)
            <div class="section-block">
                <div class="section-header">
                    {{ $sec->title }}
                </div>

                @if($sec->instructions)
                    <div class="section-instructions">
                        [{{ $sec->instructions }}]
                    </div>
                @endif

                <div class="questions-layout">
                    @foreach($sec->items as $item)
                        @php
                            $globalCounter++;
                            $opts = $item->getQuestionOptions();
                        @endphp
                        <div class="question-item">
                            @if($item->getStimulus())
                                <div class="q-stimulus">
                                    [উদ্দীপক: {{ $item->getStimulus() }}]
                                </div>
                            @endif

                            <div class="q-text">
                                {{ \App\model\LmsQuiz::toBengaliNumber($globalCounter) }}. {!! nl2br(e($item->getQuestionText())) !!}
                            </div>

                            @if(!empty($opts))
                                <div class="options-grid">
                                    @foreach($opts as $optIdx => $opt)
                                        @php
                                            $optText = is_array($opt) ? (isset($opt['option_text']) ? $opt['option_text'] : '') : (isset($opt->option_text) ? $opt->option_text : '');
                                        @endphp
                                        <div class="opt-choice">
                                            <span class="opt-letter">({{ \App\model\LmsQuestion::getBengaliOptionLetter($optIdx) }})</span>
                                            <span>{{ $optText }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>

</body>
</html>
