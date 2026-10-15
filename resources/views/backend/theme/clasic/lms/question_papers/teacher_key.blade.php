<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $paper->title }} — শিক্ষক মূল্যায়ন নির্দেশিকা ও উত্তরপত্র</title>
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
            font-family: my_kalpurush, 'Noto Sans Bengali', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #0f172a;
            background: #f1f5f9;
            padding: 20px 0;
        }

        .paper-container {
            max-width: 210mm;
            margin: 0 auto;
            background: #ffffff;
            padding: 15mm 18mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .teacher-badge {
            background: #dc2626;
            color: #ffffff;
            display: inline-block;
            padding: 3px 12px;
            border-radius: 4px;
            font-size: 11pt;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .header-title {
            text-align: center;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }

        .key-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11pt;
        }

        .key-table th, .key-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            vertical-align: top;
        }

        .key-table th {
            background: #f8fafc;
            font-weight: 700;
            color: #1e293b;
        }

        .correct-choice {
            color: #047857;
            font-weight: 800;
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
        }

        @media print {
            body { background: #ffffff !important; padding: 0 !important; }
            .paper-container { box-shadow: none !important; max-width: 100% !important; padding: 0 !important; }
            .print-toolbar { display: none !important; }
            @page { size: A4 portrait; margin: 12mm 15mm; }
        }
    </style>
</head>
<body>

    <div class="print-toolbar">
        <span><i class="fas fa-key text-warning mr-1"></i> শিক্ষক মূল্যায়ন নির্দেশিকা</span>
        <button onclick="window.print()"><i class="fas fa-print mr-1"></i> প্রিন্ট / PDF সংরক্ষণ</button>
        <button onclick="window.close()" style="background: #475569;">বন্ধ করুন</button>
    </div>

    <div class="paper-container">
        <div class="header-title">
            <span class="teacher-badge"><i class="fas fa-lock mr-1"></i> গোপনীয় — শুধুমাত্র শিক্ষকদের জন্য (Answer Key & Scoring Rubric)</span>
            <h2 style="font-size: 16pt; font-weight: 800;">{{ $paper->board_name }}</h2>
            <h3 style="font-size: 13.5pt; font-weight: 700;">{{ $paper->exam_name }}</h3>
            <h4 style="font-size: 12pt; font-weight: 600; color: #0284c7;">{{ $paper->subject_name }} — {{ \App\model\LmsQuestionPaper::getBengaliSetCode($paper->paper_set) }}</h4>
            <div style="font-size: 10.5pt; font-weight: bold; margin-top: 4px;">
                বিষয় কোড: {{ \App\model\LmsQuiz::toBengaliNumber($paper->subject_code) }} | পূর্ণমান: {{ \App\model\LmsQuiz::toBengaliNumber($paper->total_marks) }}
            </div>
        </div>

        <table class="key-table">
            <thead>
                <tr>
                    <th style="width: 50px;" class="text-center">ক্র.নং</th>
                    <th>প্রশ্নের সারাংশ</th>
                    <th style="width: 140px;">সঠিক উত্তর</th>
                    <th style="width: 70px;" class="text-center">নম্বর</th>
                    <th>ব্যাখ্যা / মূল্যায়ন নির্দেশিকা</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 0; @endphp
                @foreach($paper->sections as $sec)
                    <tr style="background: #e2e8f0; font-weight: bold;">
                        <td colspan="5">{{ $sec->title }}</td>
                    </tr>
                    @foreach($sec->items as $item)
                        @php
                            $counter++;
                            $opts = $item->getQuestionOptions();
                            $correctOptText = 'N/A';
                            $correctLetter = '';
                            foreach($opts as $optIdx => $o) {
                                $isCor = is_array($o) ? !empty($o['is_correct']) : !empty($o->is_correct);
                                if ($isCor) {
                                    $correctLetter = '(' . \App\model\LmsQuestion::getBengaliOptionLetter($optIdx) . ') ';
                                    $correctOptText = is_array($o) ? $o['option_text'] : $o->option_text;
                                    break;
                                }
                            }
                        @endphp
                        <tr>
                            <td class="text-center font-weight-bold">{{ \App\model\LmsQuiz::toBengaliNumber($counter) }}</td>
                            <td>
                                <strong>{{ $item->getQuestionText() }}</strong>
                            </td>
                            <td>
                                <span class="correct-choice">{{ $correctLetter }}{{ $correctOptText }}</span>
                            </td>
                            <td class="text-center font-weight-bold">
                                {{ \App\model\LmsQuiz::toBengaliNumber($item->marks) }}
                            </td>
                            <td>
                                {{ $item->getExplanation() ?: 'কোনো বিশেষ ব্যাখ্যা সংরক্ষিত নেই।' }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 40px; display: flex; justify-content: space-between; font-size: 11pt; font-weight: bold; padding: 0 20px;">
            <div>পরীক্ষকের স্বাক্ষর: ..............................</div>
            <div>প্রধান পরীক্ষকের প্রতিস্বাক্ষর: ..............................</div>
        </div>
    </div>

</body>
</html>
