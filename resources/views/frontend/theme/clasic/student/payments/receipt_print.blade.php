<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Receipt {{ $payment->receipt_number }} — Wake Up ICT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #0f172a; padding: 40px 20px; }
        .receipt-card { max-width: 800px; margin: 0 auto; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 48px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); position: relative; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; padding-bottom: 24px; border-bottom: 2px solid #0f172a; }
        .logo-box h1 { font-size: 26px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; }
        .logo-box h1 span { color: #10b981; }
        .logo-box p { font-size: 11px; color: #64748b; margin-top: 4px; line-height: 1.4; }
        .meta-box { text-align: right; font-family: 'JetBrains Mono', monospace; font-size: 12px; }
        .meta-box .receipt-id { font-size: 15px; font-weight: 800; color: #10b981; margin-bottom: 4px; }
        .student-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; padding: 24px 0; border-bottom: 1px solid #e2e8f0; font-size: 12px; }
        .student-grid span { color: #64748b; display: block; font-size: 10px; font-family: 'JetBrains Mono', monospace; text-transform: uppercase; margin-bottom: 2px; }
        .student-grid strong { font-size: 14px; color: #0f172a; }
        table { width: 100%; border-collapse: collapse; margin: 24px 0; font-size: 13px; }
        th { background: #f1f5f9; padding: 12px 16px; text-align: left; font-family: 'JetBrains Mono', monospace; font-size: 11px; text-transform: uppercase; color: #475569; }
        td { padding: 16px; border-bottom: 1px solid #f1f5f9; }
        .total-box { display: flex; justify-content: flex-end; padding-top: 16px; font-family: 'JetBrains Mono', monospace; }
        .total-inner { width: 280px; }
        .total-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 13px; }
        .total-row.grand { font-size: 16px; font-weight: 800; color: #0f172a; border-top: 2px solid #0f172a; padding-top: 10px; margin-top: 6px; }
        .footer-sig { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 60px; padding-top: 20px; font-size: 11px; font-family: 'JetBrains Mono', monospace; color: #64748b; }
        .sig-block { text-align: center; border-top: 1px solid #cbd5e1; width: 180px; padding-top: 8px; }
        .btn-print { display: inline-block; background: #0f172a; color: #ffffff; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none; cursor: pointer; border: none; margin-bottom: 24px; }
        .btn-print:hover { background: #10b981; color: #0f172a; }
        .watermark { position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%) rotate(-30deg); font-size: 72px; font-weight: 900; color: rgba(16, 185, 129, 0.04); text-transform: uppercase; pointer-events: none; }
        @media print {
            body { background: #ffffff; padding: 0; }
            .receipt-card { border: none; box-shadow: none; padding: 0; }
            .btn-print { display: none; }
        }
    </style>
</head>
<body>

    <div style="max-w: 800px; margin: 0 auto; text-align: right;">
        <button class="btn-print" onclick="window.print()">
            Print Money Receipt
        </button>
    </div>

    <div class="receipt-card">
        <div class="watermark">PAID &bull; WUICT</div>

        <!-- Header -->
        <div class="header">
            <div class="logo-box">
                <h1>Wake Up <span>ICT</span></h1>
                <p>Leading ICT & Technology Training Institute<br>Rajbari / Global Online Campus<br>Contact: +880 1790-258055 &bull; info@wakeupict.com</p>
            </div>
            <div class="meta-box">
                <div class="receipt-id">{{ $payment->receipt_number }}</div>
                <div>Date: {{ $payment->verified_at ? $payment->verified_at->format('d M, Y') : $payment->created_at->format('d M, Y') }}</div>
                <div style="color: #10b981; font-weight: 700; margin-top: 4px;">OFFICIAL RECEIPT</div>
            </div>
        </div>

        <!-- Student Info -->
        <div class="student-grid">
            <div>
                <span>Received From (Student Name)</span>
                <strong>{{ $student->name }}</strong>
            </div>
            <div>
                <span>Student ID Code</span>
                <strong style="font-family: 'JetBrains Mono', monospace; color: #10b981;">{{ $student->student_id_code }}</strong>
            </div>
            <div>
                <span>Contact Number</span>
                <strong>{{ $student->phone }}</strong>
            </div>
            <div>
                <span>Course Program</span>
                <strong>{{ $payment->course ? $payment->course->course_title : 'Technology Training Program' }}</strong>
            </div>
        </div>

        <!-- Payment Breakdown -->
        <table>
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Payment Channel</th>
                    <th>Transaction ID</th>
                    <th style="text-align: right;">Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Tuition Fee Payment</strong>
                        <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                            {{ $payment->course ? $payment->course->course_title : 'Course Training Program' }}
                        </div>
                    </td>
                    <td style="font-family: 'JetBrains Mono', monospace; text-transform: uppercase;">
                        {{ $payment->payment_method }}
                    </td>
                    <td style="font-family: 'JetBrains Mono', monospace; color: #475569;">
                        {{ $payment->transaction_id }}
                    </td>
                    <td style="text-align: right; font-family: 'JetBrains Mono', monospace; font-weight: 700;">
                        ৳ {{ number_format($payment->amount, 2) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Total Calculation -->
        <div class="total-box">
            <div class="total-inner">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>৳ {{ number_format($payment->amount, 2) }}</span>
                </div>
                <div class="total-row grand">
                    <span>Net Paid:</span>
                    <span style="color: #10b981;">৳ {{ number_format($payment->amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer Signatures -->
        <div class="footer-sig">
            <div class="sig-block">
                Student Signature
            </div>
            <div class="sig-block">
                Verified by Accounts Desk<br>
                <strong style="color: #0f172a;">Wake Up ICT</strong>
            </div>
        </div>
    </div>

</body>
</html>
