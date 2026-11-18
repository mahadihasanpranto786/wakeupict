@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'কুইজের প্রশ্ন ব্যবস্থাপনা: ' . $quiz->title . ' — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_quiz_active', 'active')

@section('maincontant')
    <!-- Content Header -->
    <div class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.4rem;">
                        <i class="fas fa-tasks text-primary mr-2"></i> {{ $quiz->title }} — প্রশ্ন তালিকা ও সম্পাদনা
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        কোর্স: <strong>{{ $quiz->course ? $quiz->course->course_title : 'General' }}</strong> |
                        মোট প্রশ্ন: <strong>{{ $questions->total() }}</strong> টি |
                        মোট নম্বর: <strong>{{ (float)$quiz->total_marks }}</strong>
                    </p>
                </div>
                <div class="col-sm-5 text-sm-right mt-2 mt-sm-0">
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-secondary shadow-sm mr-1">
                        <i class="fas fa-arrow-left mr-1"></i> কুইজ তালিকা
                    </a>
                    <a href="{{ route('admin.quizzes.builder', $quiz->id) }}" class="btn btn-primary shadow-sm font-weight-bold mr-1" title="ড্র্যাগ অ্যান্ড ড্রপ স্টুডিওতে প্রশ্ন বাছাই ও সাজান">
                        <i class="fas fa-hand-pointer mr-1"></i> ড্র্যাগ অ্যান্ড ড্রপ বিল্ডার
                    </a>
                    <a href="{{ route('admin.question-book.index') }}" class="btn btn-outline-primary shadow-sm">
                        <i class="fas fa-plus-circle mr-1"></i> প্রশ্ন লাইব্রেরি
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <!-- Bulk Action Bar -->
        <div id="bulkActionBar" class="card-header bg-light border-bottom py-2" style="display: none;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center my-1">
                    <span class="badge badge-primary px-2.5 py-1 text-sm font-weight-bold mr-2">
                        <i class="fas fa-check-square mr-1"></i> <span id="selectedCountText">০</span> টি প্রশ্ন নির্বাচিত
                    </span>
                    <span class="text-xs text-muted">একসাথে একাধিক প্রশ্ন কুইজ থেকে মুছে ফেলতে পাশের বাটনে ক্লিক করুন।</span>
                </div>
                <div class="my-1">
                    <button type="button" class="btn btn-sm btn-danger font-weight-bold shadow-sm" onclick="executeBulkDeleteQuestions()">
                        <i class="fas fa-trash-alt mr-1"></i> নির্বাচিত প্রশ্নসমূহ মুছুন (Bulk Delete)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary ml-1" onclick="clearAllQuestionSelections()">
                        বাতিল
                    </button>
                </div>
            </div>
        </div>

        <form id="bulkDeleteQuestionsForm" action="{{ route('admin.quizzes.questions.bulk-delete', $quiz->id) }}" method="POST">
        @csrf
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase text-xs font-weight-bold text-muted">
                    <tr>
                        <th class="text-center" style="width: 36px;" title="ড্র্যাগ করে ওপরে বা নিচে সাজান"><i class="fas fa-grip-vertical text-muted"></i></th>
                        <th class="text-center" style="width: 48px;">
                            <input type="checkbox" id="selectAllCheckbox" class="adm-checkbox" title="সবগুলো প্রশ্ন একসাথে নির্বাচন করুন">
                        </th>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>প্রশ্ন ও অপশনসমূহ</th>
                        <th class="text-center">ধরণ</th>
                        <th class="text-center">সেট</th>
                        <th class="text-center">নম্বর</th>
                        <th class="text-center" style="width: 100px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody id="quizQuestionsTableBody">
                    @forelse($questions as $index => $q)
                        <tr id="q-row-{{ $q->id }}" class="sortable-question-row" draggable="true" data-question-id="{{ $q->id }}">
                            <td class="text-center text-muted drag-handle cursor-grab" style="cursor: grab;" title="ড্র্যাগ করে ওপরে বা নিচে সাজান">
                                <i class="fas fa-grip-vertical"></i>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="question_ids[]" value="{{ $q->id }}" class="question-checkbox" title="প্রশ্ন #{{ $q->id }} নির্বাচন করুন">
                            </td>
                            <td class="text-center text-muted font-weight-bold row-index-number">
                                {{ $loop->iteration + ($questions->currentPage() - 1) * $questions->perPage() }}
                            </td>
                            <td>
                                <div class="font-weight-bold text-dark mb-1" style="font-size: 1rem;">
                                    {{ $q->question_text }}
                                </div>
                                @if($q->options && $q->options->count() > 0)
                                    <div class="row g-2 mt-1">
                                        @foreach($q->options as $optIdx => $opt)
                                            <div class="col-md-6 mb-1">
                                                <span class="badge {{ $opt->is_correct ? 'badge-success font-weight-bold' : 'badge-light border' }} px-2 py-1 text-xs">
                                                    {{ chr(65 + $optIdx) }}. {{ $opt->option_text }}
                                                    @if($opt->is_correct) <i class="fas fa-check ml-1"></i> @endif
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($q->correct_answer_text)
                                    <div class="text-xs text-success font-weight-bold">
                                        সঠিক উত্তর: {{ $q->correct_answer_text }}
                                    </div>
                                @endif
                                @if($q->explanation)
                                    <div class="text-xs text-muted mt-1 font-italic">
                                        <strong>ব্যাখ্যা:</strong> {{ $q->explanation }}
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light border text-xs text-uppercase">{{ $q->question_type }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-info px-2 py-1 text-xs font-weight-bold">
                                    {{ $q->set_code ?: 'Set A' }}
                                </span>
                            </td>
                            <td class="text-center font-weight-bold text-dark">
                                {{ (float)$q->marks }}
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-danger" title="কুইজ থেকে বাদ দিন" onclick="confirmSingleQuestionDelete({{ $q->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary d-block"></i>
                                <h5>এই কুইজে এখনও কোনো প্রশ্ন যোগ করা হয়নি!</h5>
                                <p class="text-xs text-muted">প্রশ্ন লাইব্রেরি থেকে বা ড্র্যাগ অ্যান্ড ড্রপ পেপার বিল্ডার থেকে সরাসরি প্রশ্ন যুক্ত করতে পারেন।</p>
                                <a href="{{ route('admin.quizzes.builder', $quiz->id) }}" class="btn btn-sm btn-primary font-weight-bold mt-2 shadow-sm">
                                    <i class="fas fa-hand-pointer mr-1"></i> ড্র্যাগ অ্যান্ড ড্রপ পেপার বিল্ডার খুলুন
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </form>

        @if($questions->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <span class="text-xs text-muted">দেখাচ্ছে {{ $questions->firstItem() }} থেকে {{ $questions->lastItem() }} (মোট {{ $questions->total() }}টি প্রশ্ন)</span>
                    {{ $questions->links() }}
                </div>
            </div>
        @endif
    </div>

        <!-- Hidden Single Delete Form -->
    <form id="singleQuestionDeleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

<script>
        function updateBulkQuestionBar() {
            var checkboxes = document.querySelectorAll('.question-checkbox:checked');
            var count = checkboxes.length;
            var bar = document.getElementById('bulkActionBar');
            var countText = document.getElementById('selectedCountText');
            var selectAll = document.getElementById('selectAllCheckbox');

            if (countText) countText.innerText = count;
            if (bar) {
                bar.style.display = count > 0 ? 'block' : 'none';
            }

            var allBoxes = document.querySelectorAll('.question-checkbox');
            if (selectAll && allBoxes.length > 0) {
                selectAll.checked = (checkboxes.length === allBoxes.length);
            }

            // Highlight selected rows
            document.querySelectorAll('.question-checkbox').forEach(function(cb) {
                var row = cb.closest('tr');
                if (row) {
                    if (cb.checked) {
                        row.classList.add('selected-row');
                    } else {
                        row.classList.remove('selected-row');
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            var selectAll = document.getElementById('selectAllCheckbox');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    var checked = this.checked;
                    document.querySelectorAll('.question-checkbox').forEach(function(cb) {
                        cb.checked = checked;
                    });
                    updateBulkQuestionBar();
                });
            }

            document.querySelectorAll('.question-checkbox').forEach(function(cb) {
                cb.addEventListener('change', updateBulkQuestionBar);
            });
        });

        function clearAllQuestionSelections() {
            var selectAll = document.getElementById('selectAllCheckbox');
            if (selectAll) selectAll.checked = false;
            document.querySelectorAll('.question-checkbox').forEach(function(cb) {
                cb.checked = false;
            });
            updateBulkQuestionBar();
        }

                function confirmSingleQuestionDelete(questionId) {
            if (confirm('আপনি কি নিশ্চিতভাবে এই প্রশ্নটি এই কুইজ থেকে মুছে ফেলতে চান?')) {
                var form = document.getElementById('singleQuestionDeleteForm');
                form.action = '/admin/quizzes/{{ $quiz->id }}/questions/' + questionId;
                form.submit();
            }
        }

function executeBulkDeleteQuestions() {
            var checked = document.querySelectorAll('.question-checkbox:checked');
            if (checked.length === 0) {
                alert('অনুগ্রহ করে প্রথমে কমপক্ষে একটি প্রশ্ন নির্বাচন করুন।');
                return;
            }

            if (confirm('আপনি কি নিশ্চিতভাবে নির্বাচিত ' + checked.length + 'টি প্রশ্ন এই কুইজ থেকে মুছে ফেলতে চান? মুছে ফেললে কুইজের মোট নম্বর স্বয়ংক্রিয়ভাবে সমন্বয় করা হবে।')) {
                document.getElementById('bulkDeleteQuestionsForm').submit();
            }
        }

        // ================= Drag-and-Drop Table Reordering ================= //
        (function() {
            var tbody = document.getElementById('quizQuestionsTableBody');
            if (!tbody) return;

            var draggedRow = null;

            tbody.addEventListener('dragstart', function(e) {
                var row = e.target.closest('.sortable-question-row');
                if (!row) return;
                draggedRow = row;
                row.classList.add('table-primary', 'opacity-75');
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', row.dataset.questionId);
            });

            tbody.addEventListener('dragend', function(e) {
                if (draggedRow) {
                    draggedRow.classList.remove('table-primary', 'opacity-75');
                    draggedRow = null;
                }
                document.querySelectorAll('.sortable-question-row').forEach(function(r) {
                    r.classList.remove('border-top', 'border-primary', 'border-2');
                });
            });

            tbody.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                var targetRow = e.target.closest('.sortable-question-row');
                if (targetRow && targetRow !== draggedRow) {
                    var rect = targetRow.getBoundingClientRect();
                    var next = (e.clientY - rect.top) / (rect.bottom - rect.top) > 0.5;
                    tbody.insertBefore(draggedRow, next ? targetRow.nextSibling : targetRow);
                }
            });

            tbody.addEventListener('drop', function(e) {
                e.preventDefault();
                if (!draggedRow) return;

                // Re-calculate visible index numbers
                var rows = tbody.querySelectorAll('.sortable-question-row');
                var orderIds = [];
                var startIdx = {{ ($questions->currentPage() - 1) * $questions->perPage() }};
                rows.forEach(function(row, idx) {
                    orderIds.push(row.dataset.questionId);
                    var numCell = row.querySelector('.row-index-number');
                    if (numCell) numCell.innerText = (startIdx + idx + 1);
                });

                // Send AJAX reorder request
                fetch("{{ route('admin.quizzes.questions.reorder', $quiz->id) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ order: orderIds })
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data.success) {
                        // Show subtle toast or notification
                        var toast = document.createElement('div');
                        toast.className = 'alert alert-success shadow-sm position-fixed';
                        toast.style.cssText = 'bottom: 20px; right: 20px; z-index: 9999; font-size: 0.85rem; padding: 8px 16px; border-radius: 8px;';
                        toast.innerHTML = '<i class="fas fa-check-circle mr-1"></i> প্রশ্নের ক্রম সফলভাবে ড্র্যাগ করে সাজানো হয়েছে!';
                        document.body.appendChild(toast);
                        setTimeout(function() { toast.remove(); }, 2500);
                    }
                })
                .catch(function(err) {
                    console.error('Reorder error:', err);
                });
            });
        })();
    </script>
@endsection