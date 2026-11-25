<div id="live-exam-diagram-section" class="mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
        <div>
            <h4 class="font-weight-bold mb-0" style="color: #0F172A;">
                <i class="fas fa-sitemap text-primary mr-2"></i> লাইভ এক্সাম ফলাফল ও রিটেক ট্রি ভিউ (Exam Tree View)
            </h4>
            <p class="text-muted text-xs mb-0">
                প্রতিটি এক্সামের শুরুতে মোট সামারি এবং নিচে প্রতিটি শিক্ষার্থীর মূল পরীক্ষা ও রিটেকগুলো সহজ ট্রি আকারে দেখুন।
            </p>
        </div>
        <span class="badge badge-primary px-3 py-2 font-weight-bold">
            মোট এক্সাম: {{ $liveExamDiagrams->count() }}টি
        </span>
    </div>

    @foreach($liveExamDiagrams as $diagram)
        @php
            $examObj = $diagram->exam;
            $failRate = max(0, round(100 - $diagram->pass_rate, 1));
        @endphp
        <div class="card border shadow-sm rounded-lg mb-4 overflow-hidden" style="background: #FFFFFF; border-color: #CBD5E1 !important;">
            <div class="card-header py-3 px-4 border-bottom" style="background: #F8FAFC;">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div>
                        <div class="d-flex align-items-center flex-wrap">
                            <span class="badge badge-danger mr-2 px-2 py-1 font-weight-bold">লাইভ এক্সাম</span>
                            <h5 class="font-weight-bold mb-0 mr-2" style="color: #0F172A;">{{ $examObj->title }}</h5>
                            <span class="badge badge-light border font-mono text-xs">{{ $examObj->question_set ?: 'Set A' }}</span>
                        </div>
                        <div class="text-xs mt-1" style="color: #334155;">
                            <strong>{{ $examObj->course ? $examObj->course->course_title : 'General' }}</strong>
                            <span class="mx-2">&bull;</span>
                            পূর্ণমান: <strong>{{ (float)$examObj->total_marks }}</strong>
                            <span class="mx-2">&bull;</span>
                            পাস মার্কস: <strong>{{ (float)$examObj->pass_marks }}</strong>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                        <span class="px-2.5 py-1 rounded border text-xs font-weight-bold bg-white" style="color: #0F172A;">
                            মোট পরীক্ষার্থী: {{ $diagram->total_students }} জন
                        </span>
                        <span class="px-2.5 py-1 rounded border text-xs font-weight-bold bg-emerald-100" style="color: #000000 !important;">
                            উত্তীর্ণ: {{ $diagram->passed_students }} ({{ $diagram->pass_rate }}%)
                        </span>
                        <span class="px-2.5 py-1 rounded border text-xs font-weight-bold" style="background: #FEE2E2; color: #991B1B;">
                            অনুত্তীর্ণ: {{ $diagram->failed_students }} ({{ $failRate }}%)
                        </span>
                        <span class="px-2.5 py-1 rounded border text-xs font-weight-bold" style="background: #EFF6FF; color: #1E3A8A;">
                            রিটেক দিয়েছে: {{ $diagram->retake_students_count }} জন
                        </span>
                        <button type="button" class="btn btn-sm btn-outline-secondary font-weight-bold" data-toggle="collapse" data-target="#exam-tree-body-{{ $examObj->id }}">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>

                <div class="progress rounded-pill mt-2" style="height: 8px; background-color: #E2E8F0;">
                    <div class="progress-bar bg-success" style="width: {{ $diagram->pass_rate }}%;" title="উত্তীর্ণ: {{ $diagram->passed_students }}"></div>
                    <div class="progress-bar bg-danger" style="width: {{ $failRate }}%;" title="অনুত্তীর্ণ: {{ $diagram->failed_students }}"></div>
                </div>
            </div>

            <div id="exam-tree-body-{{ $examObj->id }}" class="collapse show card-body p-3" style="background: #F8FAFC;">
                @foreach($diagram->students as $sIdx => $sg)
                    @php
                        $initAtt = $sg->initial_attempt;
                        $childRetakes = $sg->retakes;
                        $finalPassed = $sg->final_passed;
                        $bestAtt = $sg->best_attempt;
                        $prevScore = (float)$initAtt->score;
                    @endphp
                    <div class="bg-white border rounded-lg p-3 mb-2.5 shadow-xs" style="border-color: {{ $finalPassed ? '#86EFAC' : '#FCA5A5' }} !important;">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                <span class="badge badge-secondary font-mono">{{ $sIdx + 1 }}</span>
                                <span class="exam-tree-dot" style="background: {{ $finalPassed ? '#16A34A' : '#DC2626' }};"></span>
                                <span class="font-weight-bold text-sm" style="color: #0F172A;">
                                    {{ $sg->student ? $sg->student->name : 'N/A' }}
                                </span>
                                @if($sg->student && $sg->student->student_id_code)
                                    <span class="badge badge-light border font-mono text-xs">{{ $sg->student->student_id_code }}</span>
                                @endif
                                <span class="text-xs text-muted">{{ $sg->student ? $sg->student->phone : '' }}</span>
                                @if($sg->student)
                                    <a href="{{ route('admin.quizzes.reports.student-tree', $sg->student->id) }}" class="btn btn-xs btn-outline-secondary font-weight-bold" title="সম্পূর্ণ ইতিহাস ট্রি">
                                        <i class="fas fa-sitemap"></i> সব ফলাফল
                                    </a>
                                @endif
                            </div>

                            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                <span class="text-xs font-weight-bold" style="color: #334155;">
                                    সেরা স্কোর: <strong style="color: #0F172A;">{{ (float)$bestAtt->score }}/{{ (float)$bestAtt->total_marks }}</strong> ({{ (float)$bestAtt->percentage }}%)
                                </span>
                                @if($sg->retake_count > 0)
                                    <span class="badge badge-info px-2 py-1 text-xs">
                                        <i class="fas fa-redo mr-1"></i> {{ $sg->retake_count }}টি রিটেক
                                    </span>
                                    @if(!$sg->initial_passed && $sg->retake_passed)
                                        <span class="badge bg-emerald-100 px-2 py-1 text-xs" style="color: #000000 !important;">Fail ➔ Pass</span>
                                    @endif
                                @endif
                                @if($finalPassed)
                                    <span class="badge bg-emerald-100 px-2.5 py-1 text-xs" style="color: #000000 !important;">
                                        <i class="fas fa-check-circle text-success mr-1"></i> উত্তীর্ণ
                                    </span>
                                @else
                                    <span class="badge badge-danger px-2.5 py-1 text-xs">
                                        <i class="fas fa-times-circle mr-1"></i> অনুত্তীর্ণ
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="exam-tree-children mt-2.5">
                            @php $initStats = $initAtt->getBreakdownStats(); @endphp
                            <div class="exam-tree-node d-flex flex-wrap align-items-center justify-content-between py-2 px-3 mb-2 rounded border bg-white" style="border-color: #E2E8F0 !important;">
                                <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                    <span class="exam-tree-dot" style="background: {{ $sg->initial_passed ? '#16A34A' : '#DC2626' }};"></span>
                                    <span class="font-weight-bold text-xs" style="color: #0F172A;">মূল পরীক্ষা (#1)</span>
                                    <span class="font-weight-bold text-xs {{ $sg->initial_passed ? 'text-success' : 'text-danger' }}">
                                        {{ (float)$initAtt->score }}/{{ (float)$initAtt->total_marks }}
                                    </span>
                                    <span class="badge {{ $sg->initial_passed ? 'badge-success' : 'badge-danger' }} text-xs">
                                        {{ $sg->initial_passed ? 'Pass' : 'Fail' }}
                                    </span>
                                    <span class="text-xs" style="color: #475569;">
                                        উত্তর: <strong>{{ $initStats['answered'] }}/{{ $initStats['total'] }}</strong> &bull;
                                        সঠিক: <strong class="text-success">{{ $initStats['correct'] }}</strong> &bull;
                                        ভুল: <strong class="text-danger">{{ $initStats['wrong'] }}</strong> &bull;
                                        বাকি: <strong>{{ $initStats['unanswered'] }}</strong>
                                    </span>
                                </div>
                                <a href="{{ route('admin.quizzes.attempt-detail', $initAtt->id) }}" class="btn btn-xs btn-outline-primary font-weight-bold">
                                    <i class="fas fa-eye mr-1"></i> উত্তরপত্র
                                </a>
                            </div>

                            @if($childRetakes->count() > 0)
                                @foreach($childRetakes as $rIdx => $childAtt)
                                    @php
                                        $childStats = $childAtt->getBreakdownStats();
                                        $childPassed = $childAtt->isPassed();
                                        $stepDelta = round((float)$childAtt->score - $prevScore, 2);
                                        $prevScore = (float)$childAtt->score;
                                    @endphp
                                    <div class="exam-tree-node d-flex flex-wrap align-items-center justify-content-between py-2 px-3 mb-2 rounded border bg-white" style="border-color: {{ $childPassed ? '#BBF7D0' : '#FECACA' }} !important;">
                                        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                            <span class="exam-tree-dot" style="background: {{ $childPassed ? '#16A34A' : '#DC2626' }};"></span>
                                            <span class="badge badge-info text-xs">Retake #{{ $rIdx + 1 }}</span>
                                            <span class="font-weight-bold text-xs {{ $childPassed ? 'text-success' : 'text-danger' }}">
                                                {{ (float)$childAtt->score }}/{{ (float)$childAtt->total_marks }}
                                                @if($stepDelta > 0)
                                                    <span class="text-success">(+{{ $stepDelta }})</span>
                                                @elseif($stepDelta < 0)
                                                    <span class="text-danger">({{ $stepDelta }})</span>
                                                @endif
                                            </span>
                                            <span class="badge {{ $childPassed ? 'badge-success' : 'badge-danger' }} text-xs">
                                                {{ $childPassed ? 'Pass' : 'Fail' }}
                                            </span>
                                            <span class="text-xs" style="color: #475569;">
                                                উত্তর: <strong>{{ $childStats['answered'] }}/{{ $childStats['total'] }}</strong> &bull;
                                                সঠিক: <strong class="text-success">{{ $childStats['correct'] }}</strong> &bull;
                                                ভুল: <strong class="text-danger">{{ $childStats['wrong'] }}</strong> &bull;
                                                বাকি: <strong>{{ $childStats['unanswered'] }}</strong>
                                            </span>
                                        </div>
                                        <a href="{{ route('admin.quizzes.attempt-detail', $childAtt->id) }}" class="btn btn-xs btn-outline-primary font-weight-bold">
                                            <i class="fas fa-eye mr-1"></i> উত্তরপত্র
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
