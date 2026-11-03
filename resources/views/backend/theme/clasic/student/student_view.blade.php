<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Admission Slip #{{ 1000 + $student->id }} — {{ $student->student_name }} | Wake Up ICT</title>

    <!-- Bootstrap & Font Awesome via safe_asset -->
    <link rel="stylesheet" href="{{ safe_asset('admin/plugins/print/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ safe_asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <style>
        /* System Default Typography per COMMANDS.md */
        * {
            box-sizing: border-box;
        }
        body {
            background-color: #F1F5F9;
            color: #0F172A;
            font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
            padding: 20px 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .slip-container {
            max-width: 860px;
            margin: 0 auto;
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
            padding: 36px 40px;
        }

        /* Top Action Bar (hidden on print) */
        .action-bar {
            max-width: 860px;
            margin: 0 auto 16px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 700;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        .btn-action-primary {
            background-color: #0F172A;
            color: #FFFFFF !important;
        }
        .btn-action-primary:hover {
            background-color: #1E293B;
            color: #FFFFFF;
        }
        .btn-action-outline {
            background-color: #FFFFFF;
            color: #334155 !important;
            border: 1px solid #CBD5E1;
        }
        .btn-action-outline:hover {
            background-color: #F8FAFC;
            border-color: #94A3B8;
        }

        /* Header Branding */
        .slip-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            border-bottom: 2px solid #0F172A;
            padding-bottom: 18px;
            margin-bottom: 24px;
        }
        .brand-title {
            font-size: 26px;
            font-weight: 900;
            color: #0F172A;
            letter-spacing: -0.5px;
            margin: 0 0 2px 0;
            line-height: 1.1;
        }
        .brand-subtitle {
            font-size: 12px;
            color: #475569;
            font-weight: 600;
            margin: 0 0 4px 0;
        }
        .brand-contact {
            font-size: 12px;
            color: #0F172A;
            font-weight: 700;
            margin: 0;
        }

        .slip-meta-box {
            text-align: right;
        }
        .slip-badge {
            display: inline-block;
            background: #F8FAFC;
            border: 1px solid #CBD5E1;
            color: #0F172A;
            font-size: 12px;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 6px;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
        .slip-date {
            font-size: 12px;
            color: #475569;
            font-weight: 600;
            margin: 0;
        }

        /* Student Hero Card */
        .student-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }
        .student-name {
            font-size: 20px;
            font-weight: 900;
            color: #0F172A;
            margin: 0 0 4px 0;
            letter-spacing: 0.2px;
        }
        .student-meta-line {
            font-size: 12px;
            color: #475569;
            font-weight: 600;
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }
        .student-photo {
            width: 80px;
            height: 95px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #CBD5E1;
            background-color: #FFFFFF;
        }
        .student-photo-placeholder {
            width: 80px;
            height: 95px;
            border-radius: 8px;
            border: 2px dashed #CBD5E1;
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94A3B8;
            font-size: 10px;
            font-weight: 700;
            text-align: center;
        }

        /* Section Headings */
        .section-header {
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0F172A;
            border-bottom: 1.5px solid #CBD5E1;
            padding-bottom: 6px;
            margin: 20px 0 12px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Tables & Grids */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .info-table th, .info-table td {
            padding: 7px 10px;
            font-size: 12.5px;
            border: 1px solid #E2E8F0;
            vertical-align: middle;
        }
        .info-table th {
            background-color: #F8FAFC;
            color: #334155;
            font-weight: 700;
            width: 25%;
        }
        .info-table td {
            color: #0F172A;
            font-weight: 600;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .data-table th, .data-table td {
            padding: 8px 12px;
            font-size: 12.5px;
            border: 1px solid #E2E8F0;
            vertical-align: middle;
        }
        .data-table th {
            background-color: #F1F5F9;
            color: #0F172A;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 11.5px;
            letter-spacing: 0.3px;
        }
        .data-table td {
            color: #1E293B;
            font-weight: 600;
        }

        .badge-pill-custom {
            display: inline-block;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: 800;
            border-radius: 4px;
            background: #E2E8F0;
            color: #0F172A;
        }
        .badge-success-custom {
            background: #DCFCE7;
            color: #15803D;
        }
        .badge-primary-custom {
            background: #DBEAFE;
            color: #1E40AF;
        }

        /* Summary Box */
        .summary-card {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 10px;
            margin-bottom: 24px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
        }
        .summary-row.total {
            border-top: 1.5px dashed #CBD5E1;
            margin-top: 6px;
            padding-top: 8px;
            font-size: 14px;
            font-weight: 900;
            color: #0F172A;
        }

        /* Signatures */
        .signatures-wrap {
            margin-top: 48px;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }
        .sig-box {
            text-align: center;
            width: 200px;
        }
        .sig-line {
            border-top: 1.5px dashed #64748B;
            margin-bottom: 6px;
        }
        .sig-label {
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
        }

        /* Standalone Flex Grid Fallback */
        .row { display: flex; flex-wrap: wrap; margin-right: -10px; margin-left: -10px; }
        .col-6 { flex: 0 0 50%; max-width: 50%; padding-right: 10px; padding-left: 10px; }
        .mr-1 { margin-right: 4px; }
        .mx-2 { margin-left: 8px; margin-right: 8px; }
        .text-primary { color: #2563EB; }
        .text-success { color: #16A34A; }
        .text-dark { color: #0F172A; }

        /* Print Optimization */
        @media print {
            body {
                background: #FFFFFF !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .action-bar {
                display: none !important;
            }
            .slip-container {
                box-shadow: none !important;
                border: none !important;
                padding: 15mm 15mm !important;
                max-width: 100% !important;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: A4 portrait;
                margin: 10mm;
            }
        }
    </style>
</head>
<body>

    <!-- Action Bar (Hidden on print) -->
    <div class="action-bar no-print">
        <a href="{{ route('students-list') }}" class="btn-action btn-action-outline">
            <i class="fas fa-arrow-left"></i>
            <span>আবেদনকারী তালিকায় ফিরুন (Students List)</span>
        </a>
        <div style="display: flex; gap: 8px;">
            <a href="{{ url('student-edit/' . $student->id) }}" class="btn-action btn-action-outline">
                <i class="fas fa-edit"></i>
                <span>তথ্য পরিবর্তন (Edit)</span>
            </a>
            <button onclick="window.print()" class="btn-action btn-action-primary">
                <i class="fas fa-print"></i>
                <span>প্রিন্ট / PDF ডাউনলোড (Print Slip)</span>
            </button>
        </div>
    </div>

    <!-- Main Slip Paper -->
    <div class="slip-container">
        
        <!-- Header Section -->
        <div class="slip-header">
            <div>
                <h1 class="brand-title">Wake Up ICT</h1>
                <p class="brand-subtitle">A Prominent Software Farm &amp; High-Tech Computer Lab at Rajbari</p>
                <p class="brand-contact">
                    <i class="fas fa-phone-alt mr-1"></i> হেল্পলাইন: 01791612121
                    <span class="mx-2">|</span>
                    <i class="fas fa-globe mr-1"></i> www.wakeupict.com
                </p>
            </div>
            <div class="slip-meta-box">
                <div class="slip-badge">
                    Student Slip: #{{ 1000 + $student->id }}
                </div>
                <p class="slip-date">
                    তারিখ: {{ $student->created_at ? Carbon\Carbon::parse($student->created_at)->format('d M, Y') : ($student->date ? Carbon\Carbon::parse($student->date)->format('d M, Y') : date('d M, Y')) }}
                </p>
                @if($student->batch_id)
                    <div style="margin-top: 4px;">
                        <span class="badge-pill-custom badge-success-custom">
                            ব্যাচ: {{ $student->batch ? $student->batch->batch_number : 'Assigned' }}
                        </span>
                    </div>
                @else
                    <div style="margin-top: 4px;">
                        <span class="badge-pill-custom badge-primary-custom">
                            নতুন আবেদনকারী (Applied)
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Student Hero Banner -->
        <div class="student-hero">
            <div>
                <h2 class="student-name">{{ $student->student_name }}</h2>
                <div class="student-meta-line">
                    <span>
                        <strong>মোবাইল:</strong> {{ $student->personal_call_no }}
                    </span>
                    @if($student->email)
                    <span>
                        <strong>ইমেইল:</strong> {{ $student->email }}
                    </span>
                    @endif
                    <span>
                        <strong>লিঙ্গ:</strong> {{ ucfirst($student->gander) }}
                    </span>
                    <span>
                        <strong>বয়স:</strong> {{ !empty($student->age) ? (is_numeric($student->age) ? $student->age . ' Years' : $student->age) : 'N/A' }}
                    </span>
                </div>
            </div>
            <div>
                @if(!empty($student->student_photo))
                    <img src="{{ safe_asset($student->student_photo) }}" alt="{{ $student->student_name }}" class="student-photo">
                @else
                    <div class="student-photo-placeholder">
                        <i class="fas fa-user-graduate fa-2x mb-1"></i>
                        <span>No Photo</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Personal & Guardian Information -->
        <div class="section-header">
            <i class="fas fa-id-card text-primary"></i>
            <span>১. ব্যক্তিগত ও অভিভাবকের বিবরণ (Personal &amp; Family Information)</span>
        </div>

        <table class="info-table">
            <tbody>
                <tr>
                    <th>পিতার নাম (Father's Name)</th>
                    <td>{{ $student->fathers_name ?: 'N/A' }}</td>
                    <th>মাতার নাম (Mother's Name)</th>
                    <td>{{ $student->mothers_name ?: 'N/A' }}</td>
                </tr>
                <tr>
                    <th>জন্মতারিখ (Date of Birth)</th>
                    <td>
                        @if(!empty($student->date_of_birth))
                            {{ Carbon\Carbon::parse($student->date_of_birth)->format('d F, Y') }}
                        @else
                            {{ $student->age ? $student->age . ' Years' : 'N/A' }}
                        @endif
                    </td>
                    <th>জাতীয়তা (Nationality)</th>
                    <td>{{ $student->nationality ?: 'Bangladeshi' }}</td>
                </tr>
                <tr>
                    <th>জাতীয় পরিচয় / জন্ম সনদ</th>
                    <td>{{ $student->national_id_no ?: 'N/A' }}</td>
                    <th>ধর্ম ও পেশা</th>
                    <td>{{ $student->religion ?: 'N/A' }} / {{ $student->occupation ?: 'N/A' }}</td>
                </tr>
                <tr>
                    <th>বর্তমান ঠিকানা (Present Address)</th>
                    <td>{!! nl2br(e($student->present_address)) !!}</td>
                    <th>স্থায়ী ঠিকানা (Permanent Address)</th>
                    <td>{!! nl2br(e($student->permanent_address)) !!}</td>
                </tr>
                @if(!empty($student->guardian_call_no))
                <tr>
                    <th>অভিভাবকের মোবাইল</th>
                    <td colspan="3">{{ $student->guardian_call_no }}</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- Educational Qualifications -->
        <div class="section-header">
            <i class="fas fa-graduation-cap text-primary"></i>
            <span>২. শিক্ষাগত যোগ্যতা (Educational Qualifications)</span>
        </div>

        @php
            $qualData = !empty($student->qualifications_data) 
                ? (is_array($student->qualifications_data) ? $student->qualifications_data : json_decode($student->qualifications_data, true))
                : null;
        @endphp

        @if(!empty($qualData) && is_array($qualData) && count($qualData) > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">পরীক্ষা / ডিগ্রি (Examination)</th>
                        <th>বোর্ড / প্রতিষ্ঠান (Board/Institution)</th>
                        <th style="width: 20%; text-align: center;">ফলাফল (GPA/Result)</th>
                        <th style="width: 20%; text-align: center;">পাসের সন (Passing Year)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($qualData as $q)
                        <tr>
                            <td class="font-weight-bold">{{ $q['degree'] ?? 'N/A' }}</td>
                            <td>{{ $q['board_university'] ?? 'N/A' }}</td>
                            <td style="text-align: center;">{{ $q['result'] ?? 'N/A' }}</td>
                            <td style="text-align: center;">{{ $q['passing_year'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <table class="info-table">
                <tbody>
                    <tr>
                        <th>ডিগ্রি / পরীক্ষা (Degree)</th>
                        <td>{{ $student->educational_qualification ?: 'N/A' }}</td>
                        <th>ফলাফল ও পাসের সন</th>
                        <td>{{ $student->result ?: 'N/A' }} (Year: {{ $student->passing_year ?: 'N/A' }})</td>
                    </tr>
                </tbody>
            </table>
        @endif

        <!-- Course Applications & Fees (Multi-Course Support) -->
        <div class="section-header">
            <i class="fas fa-book-reader text-primary"></i>
            <span>৩. আবেদনকৃত কোর্স ও ফি বিবরণী (Applied Courses &amp; Fee Details)</span>
        </div>

        @php
            $allAppliedCourses = $student->courses_list;
            $calculatedTotalFee = 0;
        @endphp

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 8%; text-align: center;">SL</th>
                    <th>কোর্সের নাম (Course Title)</th>
                    <th style="width: 30%; text-align: right;">কোর্স ফি (Course Fee)</th>
                </tr>
            </thead>
            <tbody>
                @if($allAppliedCourses->count() > 0)
                    @php $cSl = 1; @endphp
                    @foreach($allAppliedCourses as $cItem)
                        @php
                            $feeVal = is_numeric($cItem['price']) ? (float)$cItem['price'] : (float)preg_replace('/[^\d.]/', '', (string)$cItem['price']);
                            $calculatedTotalFee += $feeVal;
                        @endphp
                        <tr>
                            <td style="text-align: center; color: #64748B;">{{ $cSl++ }}</td>
                            <td class="font-weight-bold text-dark">
                                <i class="fas fa-check-circle text-success mr-1"></i>
                                {{ $cItem['title'] }}
                            </td>
                            <td style="text-align: right; font-weight: 800; font-family: monospace; font-size: 13px;">
                                {{ number_format($feeVal) }} TK
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td style="text-align: center; color: #64748B;">1</td>
                        <td class="font-weight-bold text-dark">
                            {{ App\model\Course::find($student->course_id) ? App\model\Course::find($student->course_id)->course_title : 'N/A' }}
                        </td>
                        <td style="text-align: right; font-weight: 800; font-family: monospace; font-size: 13px;">
                            {{ number_format((float)($student->course_after_discount ?: $student->course_fee)) }} TK
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Payment & Dues Status -->
        <div class="section-header">
            <i class="fas fa-receipt text-primary"></i>
            <span>৪. পেমেন্ট ও বকেয়া স্ট্যাটাস (Payment &amp; Dues Status)</span>
        </div>

        @php
            $studentPayments = App\model\StudentPayment::where('student_id', $student->id)->get();
            $paymentSum = App\model\StudentPayment::where('student_id', $student->id)->sum('paid');
            $returnSum = App\model\StudentPayment::where('student_id', $student->id)->sum('return_money');
            $paidTotal = (int)$paymentSum - (int)$returnSum;

            $totalPayable = $calculatedTotalFee > 0 ? $calculatedTotalFee : (float)($student->course_after_discount ?: $student->course_fee);
            $totalDue = max(0, $totalPayable - $paidTotal);
        @endphp

        @if($studentPayments->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>তারিখ (Date)</th>
                        <th>গ্রহণকারী (Receiver)</th>
                        <th style="text-align: right;">পরিশোধিত অর্থ (Paid Amount)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentPayments as $payment)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($payment->date)->format('d F, Y') }}</td>
                            <td>{{ $payment->user ? $payment->user->name : 'Office Admin' }}</td>
                            <td style="text-align: right; font-weight: 800; font-family: monospace;">
                                {{ number_format((float)$payment->paid) }} TK
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="background: #F8FAFC; border: 1px dashed #CBD5E1; padding: 10px 14px; border-radius: 6px; color: #64748B; font-size: 12px; margin-bottom: 12px;">
                <i class="fas fa-info-circle mr-1"></i> এই শিক্ষার্থীর এখনও কোনো পেমেন্ট রেকর্ড নেই (Pending First Payment)।
            </div>
        @endif

        <!-- Financial Summary -->
        <div class="row">
            <div class="col-6">
                <div style="font-size: 11px; color: #64748B; padding-top: 10px;">
                    * ভর্তিকৃত কোর্স এবং ল্যাব সুবিধা পেতে নির্ধারিত সময়ের মধ্যে ফি পরিশোধ বাধ্যতামূলক।<br>
                    * পেমেন্ট রশিদ ভবিষ্যতের যেকোনো অনুসন্ধানের জন্য সংরক্ষণ করুন।
                </div>
            </div>
            <div class="col-6">
                <div class="summary-card">
                    <div class="summary-row">
                        <span>মোট কোর্স ফি (Total Payable):</span>
                        <span style="font-family: monospace;">{{ number_format($totalPayable) }} TK</span>
                    </div>
                    <div class="summary-row" style="color: #15803D;">
                        <span>মোট জমা (Total Paid):</span>
                        <span style="font-family: monospace;">{{ number_format($paidTotal) }} TK</span>
                    </div>
                    <div class="summary-row total" style="color: {{ $totalDue > 0 ? '#B91C1C' : '#15803D' }};">
                        <span>সর্বমোট বকেয়া (Net Due):</span>
                        <span style="font-family: monospace;">{{ number_format($totalDue) }} TK</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Official Signatures -->
        <div class="signatures-wrap">
            <div class="sig-box">
                <div class="sig-line"></div>
                <div class="sig-label">শিক্ষার্থীর স্বাক্ষর<br>(Applicant's Signature)</div>
            </div>
            <div class="sig-box">
                <div class="sig-line"></div>
                <div class="sig-label">অফিস সহকারী<br>(Prepared By)</div>
            </div>
            <div class="sig-box">
                <div class="sig-line"></div>
                <div class="sig-label">অনুমোদনকারীর স্বাক্ষর<br>(Authorized Officer)</div>
            </div>
        </div>

    </div>

</body>
</html>
