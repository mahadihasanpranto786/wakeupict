<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification — Wake Up ICT</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #030712; color: #f8fafc; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card { width: 100%; max-width: 600px; background: rgba(15, 23, 42, 0.8); border: 1px solid #1e293b; border-radius: 24px; padding: 40px; backdrop-filter: blur(16px); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); }
        .header { text-align: center; margin-bottom: 32px; }
        .icon { width: 64px; height: 64px; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px; }
        .icon-valid { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; }
        .icon-invalid { background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); color: #f43f5e; }
        h1 { font-size: 20px; font-weight: 800; color: #ffffff; }
        .subtitle { font-size: 13px; color: #94a3b8; margin-top: 6px; }
        .detail-row { display: flex; justify-content: space-between; padding: 14px 0; border-bottom: 1px solid #1e293b; font-size: 13px; font-family: 'JetBrains Mono', monospace; }
        .detail-label { color: #64748b; }
        .detail-val { color: #ffffff; font-weight: 600; text-align: right; max-width: 320px; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; font-family: 'JetBrains Mono', monospace; text-transform: uppercase; }
        .badge-valid { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
        .footer { text-align: center; margin-top: 32px; font-size: 12px; color: #64748b; }
        .footer a { color: #10b981; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

    <div class="card">
        @if($certificate)
            <div class="header">
                <div class="icon icon-valid">&check;</div>
                <h1>Official Credential Verified</h1>
                <p class="subtitle">This certificate is genuine and officially issued by Wake Up ICT Institute of Technology.</p>
            </div>

            <div class="details">
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="badge badge-valid">Officially Verified &amp; Active</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Certificate ID</span>
                    <span class="detail-val" style="color: #10b981;">{{ $certificate->certificate_code }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Student Name</span>
                    <span class="detail-val">{{ $certificate->student ? $certificate->student->name : 'Registered Student' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Course Title</span>
                    <span class="detail-val">{{ $certificate->course ? $certificate->course->course_title : $certificate->title }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Grade / Performance</span>
                    <span class="detail-val">{{ $certificate->grade ?: 'A+' }} ({{ $certificate->score_percentage }}%)</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date Issued</span>
                    <span class="detail-val">{{ $certificate->issue_date->format('F d, Y') }}</span>
                </div>
            </div>
        @else
            <div class="header">
                <div class="icon icon-invalid">&cross;</div>
                <h1>Certificate Verification Failed</h1>
                <p class="subtitle">No authentic certificate record was found matching the requested verification hash.</p>
            </div>
            <p style="text-align: center; font-size: 13px; color: #94a3b8; line-height: 1.6;">
                The credential may have been revoked, expired, or the verification link is malformed. Contact Wake Up ICT administration at <a href="mailto:info@wakeupict.com" style="color: #10b981;">info@wakeupict.com</a> for manual verification.
            </p>
        @endif

        <div class="footer">
            <p>Verification powered by <a href="{{ url('/') }}">Wake Up ICT</a> &bull; Rajbari, Bangladesh</p>
        </div>
    </div>

</body>
</html>
