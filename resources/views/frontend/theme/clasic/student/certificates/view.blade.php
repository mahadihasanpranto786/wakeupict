<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate {{ $certificate->certificate_code }} — {{ $student->name }} — Wake Up ICT</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800;900&family=Great+Vibes&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: #1e293b; padding: 40px 20px; display: flex; flex-direction: column; align-items: center; min-height: 100vh; }
        .action-bar { width: 100%; max-width: 1000px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .btn-print { background: #10b981; color: #022c22; font-weight: 800; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 28px; border-radius: 12px; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; box-shadow: 0 4px 14px rgba(16,185,129,0.3); }
        .btn-print:hover { background: #34d399; transform: translateY(-1px); }
        .btn-back { color: #94a3b8; font-size: 13px; text-decoration: none; font-weight: 600; }
        .btn-back:hover { color: #ffffff; }

        /* Certificate Frame */
        .cert-container { width: 1000px; height: 700px; background: #ffffff; border: 12px solid #0f172a; outline: 3px solid #d97706; padding: 48px; position: relative; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); text-align: center; display: flex; flex-direction: column; justify-content: space-between; }
        .inner-border { position: absolute; inset: 16px; border: 2px solid #e2e8f0; pointer-events: none; }
        .corner-ornament { position: absolute; width: 48px; height: 48px; border: 3px solid #d97706; }
        .top-left { top: 22px; left: 22px; border-right: none; border-bottom: none; }
        .top-right { top: 22px; right: 22px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: 22px; left: 22px; border-right: none; border-top: none; }
        .bottom-right { bottom: 22px; right: 22px; border-left: none; border-top: none; }

        .cert-header h2 { font-family: 'Cinzel', serif; font-size: 26px; font-weight: 800; letter-spacing: 4px; color: #0f172a; text-transform: uppercase; margin-bottom: 4px; }
        .cert-header p { font-size: 11px; text-transform: uppercase; letter-spacing: 3px; color: #d97706; font-weight: 700; }
        .cert-title { font-family: 'Cinzel', serif; font-size: 38px; font-weight: 900; color: #0f172a; margin: 16px 0 8px; letter-spacing: 2px; }
        .cert-subtitle { font-size: 13px; color: #64748b; letter-spacing: 1px; text-transform: uppercase; font-weight: 500; }
        .student-name { font-family: 'Great Vibes', cursive; font-size: 56px; color: #0f172a; margin: 12px 0 6px; line-height: 1.1; }
        .underline-name { width: 360px; height: 1.5px; background: linear-gradient(to right, transparent, #d97706, transparent); margin: 0 auto 16px; }
        .cert-statement { font-size: 14px; color: #334155; max-width: 720px; margin: 0 auto; line-height: 1.6; }
        .course-highlight { font-family: 'Cinzel', serif; font-size: 20px; font-weight: 800; color: #10b981; display: block; margin-top: 6px; }

        .cert-footer { display: flex; justify-content: space-between; align-items: flex-end; padding-top: 24px; border-top: 1px solid #f1f5f9; }
        .sig-col { width: 220px; text-align: center; }
        .sig-line { border-bottom: 1.5px solid #0f172a; padding-bottom: 6px; font-family: 'Great Vibes', cursive; font-size: 26px; color: #0f172a; }
        .sig-title { font-size: 11px; font-family: 'Cinzel', serif; font-weight: 700; color: #475569; text-transform: uppercase; margin-top: 4px; letter-spacing: 1px; }

        .meta-col { text-align: center; font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #64748b; }
        .meta-badge { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 14px; display: inline-block; margin-bottom: 4px; color: #0f172a; font-weight: 700; }

        @media print {
            body { background: #ffffff; padding: 0; }
            .action-bar { display: none; }
            .cert-container { border: 12px solid #0f172a; box-shadow: none; width: 100%; height: 100vh; }
        }
    </style>
</head>
<body>

    <div class="action-bar">
        <a href="{{ route('student.certificates.index') }}" class="btn-back">
            &larr; Back to Certificates Portal
        </a>
        <button class="btn-print" onclick="window.print()">
            Print Official Certificate
        </button>
    </div>

    <div class="cert-container">
        <div class="inner-border"></div>
        <div class="corner-ornament top-left"></div>
        <div class="corner-ornament top-right"></div>
        <div class="corner-ornament bottom-left"></div>
        <div class="corner-ornament bottom-right"></div>

        <!-- Top Header -->
        <div class="cert-header">
            <h2>Wake Up ICT Institute of Technology</h2>
            <p>Center for Computer Training &amp; Advanced Skills</p>
            <div class="cert-title">Certificate of Completion</div>
            <div class="cert-subtitle">This is to officially certify that</div>
        </div>

        <!-- Student Name & Course -->
        <div>
            <div class="student-name">{{ $student->name }}</div>
            <div class="underline-name"></div>
            <div class="cert-statement">
                has successfully completed all prescribed theoretical lessons, practical assignments, and final examinations for the professional training program in
                <span class="course-highlight">{{ $certificate->course ? $certificate->course->course_title : $certificate->title }}</span>
            </div>
        </div>

        <!-- Signatures & Verification Meta -->
        <div class="cert-footer">
            <div class="sig-col">
                <div class="sig-line">M. H. Pranto</div>
                <div class="sig-title">Lead Instructor &amp; Director</div>
            </div>

            <div class="meta-col">
                <div class="meta-badge">{{ $certificate->certificate_code }}</div>
                <div>Issue Date: {{ $certificate->issue_date->format('F d, Y') }}</div>
                <div style="font-size: 9px; margin-top: 2px; color: #94a3b8;">Verify: {{ route('certificates.verify', $certificate->verification_hash) }}</div>
            </div>

            <div class="sig-col">
                <div class="sig-line">Executive Board</div>
                <div class="sig-title">Academic Examination Council</div>
            </div>
        </div>
    </div>

</body>
</html>
