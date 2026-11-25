@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', $student->name . ' — সম্পূর্ণ ফলাফল ট্রি — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_reports_active', 'active')

@section('maincontant')
<style>
    .exam-tree-children {
        position: relative;
        margin-left: 18px;
        padding-left: 22px;
        border-left: 2px solid #CBD5E1;
    }
    .exam-tree-node {
        position: relative;
    }
    .exam-tree-node::before {
        content: '';
        position: absolute;
        left: -22px;
        top: 20px;
        width: 18px;
        height: 2px;
        background-color: #CBD5E1;
    }
    .exam-tree-node:last-child::after {
        content: '';
        position: absolute;
        left: -24px;
        top: 22px;
        bottom: 0;
        width: 4px;
        background-color: #F8FAFC;
    }
    .exam-tree-dot {
        width: 10px;
        height: 10px;
        border-radius: 9999px;
        display: inline-block;
        flex-shrink: 0;
    }
</style>

<div class="content-wrapper-inner p-3">
    <!-- Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
        <div>
            <h3 class="font-weight-bold mb-1" style="color: #0F172A;">
                <i class="fas fa-sitemap text-primary mr-2"></i> {{ $student->name }} — সম্পূর্ণ পরীক্ষার ফলাফল ট্রি
            </h3>
            <p class="text-muted small mb-0">
                আইডি: <strong class="font-mono">{{ $student->student_id_code ?: ($student->registration_number ?: 'N/A') }}</strong>
                <span class="mx-2">&bull;</span>
                মোবাইল: <strong class="font-mono">{{ $student->phone }}</strong>
                @if($student->course)
                    <span class="mx-2">&bull;</span>
                    কোর্স: <strong>{{ $student->course->course_title }}</strong>
                @endif
            </p>
        </div>
        <div class="mt-2 mt-sm-0">
            <a href="{{ route('admin.student-accounts.index') }}" class="btn btn-outline-secondary btn-sm mr-1">
                <i class="fas fa-arrow-left mr-1"></i> শিক্ষার্থী তালিকা
            </a>
            <a href="{{ route('admin.quizzes.reports', ['search' => $student->phone]) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-chart-line mr-1"></i> সকল রিপোর্ট
            </a>
        </div>
    </div>

    <!-- Summary KPI Cards -->
    <div class="row mb-3">
        <div class="col-lg-3 col-6 mb-2">
            <div class="card border shadow-sm p-3 h-100" style="background: #FFFFFF;">
                <div class="text-xs font-weight-bold text-muted text-uppercase">মোট পরীক্ষা / অনুশীলন</div>
                <div class="h3 font-weight-bold mb-0 mt-1" style="color: #0F172A;">{{ $examTrees->count() }}টি ({{ $totalAttempts }} বার)</div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <div class="card border shadow-sm p-3 h-100 bg-emerald-100" style="color: #000000 !important;">
                <div class="text-xs font-weight-bold text-uppercase">উত্তীর্ণ (Passed)</div>
                <div class="h3 font-weight-bold mb-0 mt-1">{{ $passedCount }} বার</div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <div class="card border shadow-sm p-3 h-100" style="background: #FEE2E2; color: #991B1B;">
                <div class="text-xs font-weight-bold text-uppercase">অনুত্তীর্ণ (Failed)</div>
                <div class="h3 font-weight-bold mb-0 mt-1">{{ $failedCount }} বার</div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-2">
            <div class="card border shadow-sm p-3 h-100" style="background: #EFF6FF; color: #1E3A8A;">
                <div class="text-xs font-weight-bold text-uppercase">গড় স্কোর</div>
                <div class="h3 font-weight-bold mb-0 mt-1">{{ $avgPct }}%</div>
            </div>
        </div>
    </div>

    <!-- Hierarchical Tree of All Exams & Practice Attempts -->
    @if($examTrees->isEmpty())
        <div class="card border shadow-sm p-5 text-center" style="background: #FFFFFF;">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="font-weight-bold" style="color: #0F172A;">এই শিক্ষার্থী এখনো কোনো পরীক্ষায় অংশগ্রহণ করেনি।</h5>
        </div>
    @else
        <div class="card border shadow-sm rounded-lg overflow-hidden" style="background: #F8FAFC; border-color: #CBD5E1 !important;">
            <div class="card-body p-3">
                @foreach($examTrees as $tIdx => $tree)
                    @php
                        $quizObj = $tree->quiz;
                        $bestAtt = $tree->best_attempt;
                        $prevScore = (float)$tree->attempts->first()->score;
                    @endphp
                    <div class="bg-white border rounded-lg p-3 mb-3 shadow-xs" style="border-color: {{ $tree->has_passed ? '#86EFAC' : '#FCA5A5' }} !important;">
                        <!-- Exam / Quiz Parent Node -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                <span class="badge badge-secondary font-mono">{{ $tIdx + 1 }}</span>
                                <span class="exam-tree-dot" style="background: {{ $tree->has_passed ? '#16A34A' : '#DC2626' }};"></span>
                                @if($tree->quiz_type === 'exam')
                                    <span class="badge badge-danger text-xs">লাইভ এক্সাম</span>
                                @elseif($tree->quiz_type === 'practice')
                                    <span class="badge badge-info text-xs">অনুশীলন</span>
                                @else
                                    <span class="badge badge-secondary text-xs">কুইজ</span>
                                @endif
                                <span class="font-weight-bold text-sm" style="color: #0F172A;">
                                    {{ $quizObj ? $quizObj->title : 'Assessment' }}
                                </span>
                            </div>
                            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                <span class="badge badge-light border text-xs font-weight-bold">মোট চেষ্টা: {{ $tree->total_attempts }} বার</span>
                                <span class="text-xs font-weight-bold" style="color: #334155;">
                                    সেরা: <strong style="color: #0F172A;">{{ (float)$bestAtt->score }}/{{ (float)$bestAtt->total_marks }}</strong> ({{ (float)$bestAtt->percentage }}%)
                                </span>
                                @if($tree->has_passed)
                                    <span class="badge bg-emerald-100 px-2.5 py-1 text-xs" style="color: #000000 !important;">উত্তীর্ণ</span>
                                @else
                                    <span class="badge badge-danger px-2.5 py-1 text-xs">অনুত্তীর্ণ</span>
                                @endif
                            </div>
                        </div>

                        <!-- Child Attempts Tree -->
                        <div class="exam-tree-children mt-2.5">
                            @foreach($tree->attempts as $aIdx => $att)
                                @php
                                    $stats = $att->getBreakdownStats();
                                    $passed = $att->isPassed();
                                    $delta = $aIdx > 0 ? round((float)$att->score - $prevScore, 2) : 0;
                                    $prevScore = (float)$att->score;
                                @endphp
                                <div class="exam-tree-node d-flex flex-wrap align-items-center justify-content-between py-2 px-3 mb-2 rounded border bg-white" style="border-color: {{ $passed ? '#BBF7D0' : '#FECACA' }} !important;">
                                    <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                        <span class="exam-tree-dot" style="background: {{ $passed ? '#16A34A' : '#DC2626' }};"></span>
                                        <span class="badge {{ $aIdx === 0 ? 'badge-dark' : 'badge-info' }} text-xs">
                                            {{ $aIdx === 0 ? 'মূল পরীক্ষা (#1)' : 'রিটেক / চেষ্টা #' . ($aIdx + 1) }}
                                        </span>
                                        <span class="font-weight-bold text-xs {{ $passed ? 'text-success' : 'text-danger' }}">
                                            {{ (float)$att->score }}/{{ (float)$att->total_marks }} ({{ (float)$att->percentage }}%)
                                            @if($aIdx > 0 && $delta > 0)
                                                <span class="text-success">(+{{ $delta }})</span>
                                            @elseif($aIdx > 0 && $delta < 0)
                                                <span class="text-danger">({{ $delta }})</span>
                                            @endif
                                        </span>
                                        <span class="badge {{ $passed ? 'badge-success' : 'badge-danger' }} text-xs">
                                            {{ $passed ? 'Pass' : 'Fail' }}
                                        </span>
                                        <span class="text-xs" style="color: #475569;">
                                            উত্তর: <strong>{{ $stats['answered'] }}/{{ $stats['total'] }}</strong> &bull;
                                            সঠিক: <strong class="text-success">{{ $stats['correct'] }}</strong> &bull;
                                            ভুল: <strong class="text-danger">{{ $stats['wrong'] }}</strong> &bull;
                                            বাকি: <strong>{{ $stats['unanswered'] }}</strong>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center" style="gap: 8px;">
                                        <span class="text-xs text-muted font-mono">
                                            {{ $att->submitted_at ? $att->submitted_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') : $att->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}
                                        </span>
                                        <a href="{{ route('admin.quizzes.attempt-detail', $att->id) }}" class="btn btn-xs btn-outline-primary font-weight-bold">
                                            <i class="fas fa-eye mr-1"></i> উত্তরপত্র
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
