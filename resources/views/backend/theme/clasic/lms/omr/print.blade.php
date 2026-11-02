<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বিটিইবি ওএমআর শিট প্রিন্ট (কপি: {{ $count }}, সাইজ: {{ strtoupper($pageSize ?? 'A4') }}) — বাংলাদেশ কারিগরি শিক্ষা বোর্ড</title>
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

    @php
        $selectedSize = strtolower($pageSize ?? 'a4');
        if (!in_array($selectedSize, ['a4', 'legal', 'letter'])) {
            $selectedSize = 'a4';
        }
    @endphp

    <style id="page-size-style">
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Bengali', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            background-color: #f1f5f9;
            color: #000000;
            padding: 30px 0;
        }

        .sheet-container-wrapper {
            width: 100%;
            margin: 0 auto 30px auto;
            background: #ffffff;
            padding: 8mm 10mm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            page-break-after: always;
            position: relative;
            box-sizing: border-box;
            border-radius: 4px;
        }

        /* Default Max Width based on Page Size */
        .size-a4 .sheet-container-wrapper { max-width: 200mm; }
        .size-legal .sheet-container-wrapper { max-width: 210mm; }
        .size-letter .sheet-container-wrapper { max-width: 210mm; }

        .sheet-container-wrapper:last-child {
            page-break-after: auto;
        }

        /* Border & Colors */
        .border-magenta { border-color: #c2185b !important; }
        .text-magenta { color: #c2185b !important; }
        .bg-magenta-light { background-color: #fce4ec !important; }

        /* Floating Screen Controls Bar */
        .print-floating-bar {
            position: fixed;
            top: 16px;
            right: 20px;
            z-index: 99999;
            background: #0f172a;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #334155;
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
                border-radius: 0 !important;
            }
            @page {
                size: {{ $selectedSize }} portrait;
                margin: 8mm 6mm;
            }
        }
    </style>
</head>
<body class="size-{{ $selectedSize }}">

    <!-- Floating Print Control Bar (Screen only) -->
    <div class="print-floating-bar no-print">
        <div class="text-xs">
            <span class="font-bold text-slate-300">মোট শিট:</span> 
            <span class="font-mono font-extrabold text-emerald-400 bg-emerald-950/60 px-2 py-0.5 rounded border border-emerald-800">{{ $count }} টি</span>
        </div>

        <!-- Variant Page Size Selector -->
        <div class="flex items-center gap-1.5 text-xs">
            <label for="paperSizeSelect" class="text-slate-300 font-semibold"><i class="fa fa-file-text-o mr-1"></i>সাইজ:</label>
            <select id="paperSizeSelect" onchange="changePaperSize(this.value)" class="bg-slate-800 text-white text-xs px-2.5 py-1.5 rounded-lg border border-slate-600 font-bold focus:outline-none focus:border-emerald-400">
                <option value="a4" {{ $selectedSize === 'a4' ? 'selected' : '' }}>A4 (210 × 297 mm)</option>
                <option value="legal" {{ $selectedSize === 'legal' ? 'selected' : '' }}>Legal (8.5 × 14 in)</option>
                <option value="letter" {{ $selectedSize === 'letter' ? 'selected' : '' }}>Letter (8.5 × 11 in)</option>
            </select>
        </div>

        <button type="button" onclick="window.print()" class="px-4 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-black text-xs rounded-lg flex items-center gap-1.5 shadow active:scale-95 transition-all">
            <i class="fa fa-print"></i>
            <span>প্রিন্ট করুন</span>
        </button>

        <button type="button" onclick="window.close()" class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs rounded-lg border border-slate-700">
            বন্ধ করুন
        </button>
    </div>

    <!-- Loop Through Each Sheet (Multi-page batch or single) -->
    <div id="sheets-wrapper">
        @foreach($sheets as $sheet)
            <div class="sheet-container-wrapper">
                @include('backend.theme.clasic.lms.omr.sheet_component', ['sheet' => $sheet])
            </div>
        @endforeach
    </div>

    <script>
        function changePaperSize(size) {
            document.body.className = 'size-' + size;
            var styleEl = document.getElementById('dynamic-print-rule');
            if (!styleEl) {
                styleEl = document.createElement('style');
                styleEl.id = 'dynamic-print-rule';
                document.head.appendChild(styleEl);
            }
            styleEl.innerHTML = '@media print { @page { size: ' + size + ' portrait !important; margin: 8mm 6mm !important; } }';
        }
    </script>

</body>
</html>
