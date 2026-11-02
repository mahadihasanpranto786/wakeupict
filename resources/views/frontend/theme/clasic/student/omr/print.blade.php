<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বিটিইবি ওএমআর শিট প্রিন্ট (কপি: {{ $count }}) — বাংলাদেশ কারিগরি শিক্ষা বোর্ড</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('frontend/image/wakeupict-fabicon.png') }}" />
    
    <!-- Bengali & Global Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Tailwind CSS CDN for utility classes -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Bengali', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            background-color: #e2e8f0;
            color: #000000;
            padding: 20px 0;
        }

        .sheet-container-wrapper {
            max-width: 200mm;
            width: 100%;
            margin: 0 auto 20px auto;
            background: #ffffff;
            padding: 8mm 10mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            page-break-after: always;
            position: relative;
            box-sizing: border-box;
        }

        .sheet-container-wrapper:last-child {
            page-break-after: auto;
        }

        /* Border & Colors */
        .border-magenta { border-color: #c2185b !important; }
        .text-magenta { color: #c2185b !important; }
        .bg-magenta-light { background-color: #fce4ec !important; }

        /* Timing Marks */
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

        /* Print Controls Floating Bar */
        .print-floating-bar {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background: #0f172a;
            color: #ffffff;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .print-floating-bar {
                display: none !important;
            }
            .sheet-container-wrapper {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }
            @page {
                size: A4 portrait;
                margin: 8mm 6mm;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Print Control Bar (Screen only) -->
    <div class="print-floating-bar">
        <div class="text-xs">
            <span class="font-bold text-emerald-400">মোট শিট:</span> 
            <span class="font-mono font-bold">{{ $count }} টি</span>
        </div>
        <button type="button" onclick="window.print()" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-black text-xs rounded-lg flex items-center gap-2 shadow">
            <i class="fa fa-print"></i>
            <span>প্রিন্ট করুন</span>
        </button>
        <button type="button" onclick="window.close()" class="px-3 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs rounded-lg">
            বন্ধ করুন
        </button>
    </div>

    <!-- Loop Through Each Sheet (Multi-page batch or single) -->
    @foreach($sheets as $sheet)
        <div class="sheet-container-wrapper">
            @include('frontend.theme.clasic.student.omr.sheet_component', ['sheet' => $sheet])
        </div>
    @endforeach

</body>
</html>
