@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'LMS Quizzes & Excel Import — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_quiz_active', 'active')

@section('maincontant')
    <!-- Header -->
    <div class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.5rem;">
                        <i class="fas fa-file-excel text-success mr-2"></i> কুইজ ও এক্সেল ডাটা আপলোড
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        কোর্স ক্যাটাগরি ভিত্তিক কুইজ ব্যবস্থাপনা এবং এক্সেল/সিএসভি শিটের মাধ্যমে একসাথে শত শত MCQ প্রশ্ন আপলোড করুন।
                    </p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <a href="{{ route('admin.quizzes.sample') }}" class="btn btn-outline-info shadow-sm mr-1">
                        <i class="fas fa-file-download mr-1"></i> নমুনা এক্সেল ফরম্যাট ডাউনলোড
                    </a>
                    <button type="button" class="btn btn-success shadow-sm mr-1" data-toggle="modal" data-target="#excelImportModal">
                        <i class="fas fa-file-upload mr-1"></i> এক্সেল থেকে আপলোড
                    </button>
                    <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#createQuizModal">
                        <i class="fas fa-plus-circle mr-1"></i> নতুন কুইজ
                    </button>
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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> <strong>ত্রুটি পরিলক্ষিত হয়েছে:</strong>
            <ul class="mb-0 pl-3 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Summary KPI Cards -->
    <div class="row mb-3">
        <div class="col-md-4 col-sm-6">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-question-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">মোট সংগৃহীত MCQ প্রশ্ন</span>
                    <span class="info-box-number font-weight-bold text-success" style="font-size: 1.4rem;">{{ number_format($totalQuestions) }}</span>
                    <span class="text-xs text-muted">বিভিন্ন কোর্সে সক্রিয় প্রশ্নভাণ্ডার</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list-ol"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">মোট কুইজ সংখ্যা</span>
                    <span class="info-box-number font-weight-bold text-primary" style="font-size: 1.4rem;">{{ $totalQuizzes }}</span>
                    <span class="text-xs text-muted">প্র্যাকটিস টেস্ট ও ক্লাস পরীক্ষা</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-double"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">প্রকাশিত কুইজ (Published)</span>
                    <span class="info-box-number font-weight-bold text-info" style="font-size: 1.4rem;">{{ $publishedQuizzes }}</span>
                    <span class="text-xs text-muted">শিক্ষার্থীরা পরীক্ষা দিতে পারবে</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card card-outline card-success shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <form action="{{ route('admin.quizzes.index') }}" method="GET" class="row align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="কুইজের নাম বা বিবরণ খুঁজুন..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="course_id" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- সকল কোর্স ক্যাটাগরি --</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->course_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="quiz_type" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- সকল কুইজ ধরণ --</option>
                        <option value="practice" {{ request('quiz_type') == 'practice' ? 'selected' : '' }}>অনুশীলন (Practice)</option>
                        <option value="exam" {{ request('quiz_type') == 'exam' ? 'selected' : '' }}>চূড়ান্ত পরীক্ষা (Exam)</option>
                        <option value="class_test" {{ request('quiz_type') == 'class_test' ? 'selected' : '' }}>ক্লাস টেস্ট (Class Test)</option>
                    </select>
                </div>
                <div class="col-md-2 text-md-right">
                    @if(request()->hasAny(['search', 'course_id', 'quiz_type']))
                        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt mr-1"></i> রিসেট ফিল্টার
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="bg-light text-uppercase text-xs font-weight-bold text-muted">
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>কোর্স ও কুইজ শিরোনাম</th>
                        <th>ধরণ ও সময়</th>
                        <th class="text-center">প্রশ্ন সংখ্যা</th>
                        <th class="text-center">মোট নম্বর</th>
                        <th class="text-center">পাস মার্ক</th>
                        <th class="text-center">স্ট্যাটাস</th>
                        <th class="text-center" style="width: 170px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quizzes as $quiz)
                        <tr>
                            <td class="text-center text-muted text-sm">{{ $loop->iteration + ($quizzes->currentPage() - 1) * $quizzes->perPage() }}</td>
                            <td>
                                <div class="font-weight-bold text-dark" style="font-size: 0.95rem;">{{ $quiz->title }}</div>
                                <div class="text-xs text-primary font-weight-semibold">
                                    <i class="fas fa-graduation-cap mr-1"></i> {{ $quiz->course ? $quiz->course->course_title : 'General / All' }}
                                </div>
                                @if($quiz->description)
                                    <div class="text-xs text-muted font-italic text-truncate mt-0.5" style="max-width: 280px;">
                                        {{ $quiz->description }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-light border text-capitalize px-2 py-1">
                                    {{ $quiz->quiz_type }}
                                </span>
                                <div class="text-xs text-muted mt-1">
                                    <i class="far fa-clock mr-1"></i> {{ $quiz->duration_minutes }} মিনিট
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-info px-2.5 py-1 text-sm">
                                    {{ $quiz->questions_count }} টি MCQ
                                </span>
                            </td>
                            <td class="text-center font-weight-bold text-dark">
                                {{ number_format($quiz->total_marks, 0) }}
                            </td>
                            <td class="text-center text-sm text-muted">
                                {{ number_format($quiz->pass_marks, 0) }}
                            </td>
                            <td class="text-center">
                                @if($quiz->is_published)
                                    <span class="badge badge-success px-2.5 py-1.5 shadow-sm">
                                        <i class="fas fa-check mr-1"></i> Published
                                    </span>
                                @else
                                    <span class="badge badge-secondary px-2.5 py-1.5">
                                        <i class="fas fa-lock mr-1"></i> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <!-- Toggle Publish -->
                                    <form action="{{ route('admin.quizzes.toggle', $quiz->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn {{ $quiz->is_published ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $quiz->is_published ? 'ড্রাফট করুন (Hide)' : 'পাবলিশ করুন (Make Live)' }}">
                                            <i class="fas {{ $quiz->is_published ? 'fa-eye-slash' : 'fa-check' }}"></i>
                                        </button>
                                    </form>

                                    <!-- Quick Excel Upload for this Quiz -->
                                    <button type="button" class="btn btn-outline-info" title="এই কুইজে আরও প্রশ্ন আপলোড করুন" onclick="openImportForQuiz({{ $quiz->id }}, '{{ addslashes($quiz->title) }}')">
                                        <i class="fas fa-file-upload"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই কুইজ এবং এর সকল প্রশ্ন মুছে ফেলতে চান?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="মুছে ফেলুন">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary d-block"></i>
                                কোন কুইজ পাওয়া যায়নি। এক্সেল শিট থেকে বা ম্যানুয়ালি কুইজ তৈরি করতে উপরের বোতামগুলো ব্যবহার করুন।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($quizzes->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-xs text-muted">দেখাচ্ছে {{ $quizzes->firstItem() }} থেকে {{ $quizzes->lastItem() }} (মোট {{ $quizzes->total() }})</span>
                    {{ $quizzes->links() }}
                </div>
            </div>
        @endif
    </div>

<!-- Modal: Excel Import -->
<div class="modal fade" id="excelImportModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg border-0">
            <form action="{{ route('admin.quizzes.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-file-excel mr-1"></i> এক্সেল / সিএসভি থেকে MCQ প্রশ্ন আপলোড
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <!-- Instruction alert with sample download -->
                    <div class="alert alert-light border border-success/30 p-3 mb-4 rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="font-weight-bold text-success mb-1">
                                    <i class="fas fa-info-circle mr-1"></i> এক্সেল কলামের নিয়মাবলী:
                                </h6>
                                <p class="text-xs text-muted mb-0">
                                    এক্সেল শিটে <code>question_text</code>, <code>option_a</code>, <code>option_b</code>, <code>option_c</code>, <code>option_d</code>, <code>correct_option</code> (A/B/C/D), <code>marks</code> ও <code>explanation</code> কলাম থাকতে হবে।
                                </p>
                            </div>
                            <a href="{{ route('admin.quizzes.sample') }}" class="btn btn-sm btn-outline-success font-weight-bold text-nowrap ml-3">
                                <i class="fas fa-download mr-1"></i> নমুনা টেমপ্লেট
                            </a>
                        </div>
                    </div>

                    <!-- Target Mode Selector -->
                    <div class="form-group">
                        <label class="font-weight-bold text-sm">আপলোড করার মাধ্যম নির্বাচন করুন:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio border rounded p-2.5 bg-light">
                                    <input type="radio" id="modeExisting" name="import_mode" value="existing" class="custom-control-input" checked onchange="toggleImportMode()">
                                    <label class="custom-control-label font-weight-bold text-dark" for="modeExisting">
                                        বিদ্যমান কোনো কুইজে যোগ করুন
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2 mt-md-0">
                                <div class="custom-control custom-radio border rounded p-2.5 bg-light">
                                    <input type="radio" id="modeNew" name="import_mode" value="new" class="custom-control-input" onchange="toggleImportMode()">
                                    <label class="custom-control-label font-weight-bold text-dark" for="modeNew">
                                        কোর্স ক্যাটাগরি ভিত্তিক নতুন কুইজ তৈরি করুন
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Block 1: Select Existing Quiz -->
                    <div id="existingQuizBlock" class="form-group">
                        <label class="font-weight-bold text-sm">টার্গেট কুইজ নির্বাচন করুন <span class="text-danger">*</span></label>
                        <select name="quiz_id" id="targetQuizSelect" class="form-control">
                            <option value="">-- কুইজ নির্বাচন করুন --</option>
                            @foreach($quizzes as $q)
                                <option value="{{ $q->id }}">
                                    {{ $q->title }} ({{ $q->course ? $q->course->course_title : 'General' }} | বর্তমানে {{ $q->questions_count }} টি প্রশ্ন)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Block 2: Create New Quiz along with Import -->
                    <div id="newQuizBlock" class="p-3 border rounded bg-light mb-3" style="display: none;">
                        <h6 class="font-weight-bold text-primary mb-3">
                            <i class="fas fa-plus-circle mr-1"></i> নতুন কুইজ কনফিগারেশন:
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-sm">কোর্স ক্যাটাগরি <span class="text-danger">*</span></label>
                                    <select name="course_id" id="newQuizCourseId" class="form-control">
                                        <option value="">-- কোর্স নির্বাচন করুন --</option>
                                        @foreach($courses as $c)
                                            <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-sm">কুইজের শিরোনাম <span class="text-danger">*</span></label>
                                    <input type="text" name="new_quiz_title" id="newQuizTitle" class="form-control" placeholder="যেমন: ICT চ্যাপ্টার ৩ MCQ টেস্ট">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-sm">কুইজের ধরণ</label>
                                    <select name="quiz_type" class="form-control">
                                        <option value="practice">অনুশীলন (Practice)</option>
                                        <option value="exam">চূড়ান্ত পরীক্ষা (Live Exam)</option>
                                        <option value="class_test">ক্লাস টেস্ট (Class Test)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-sm">পরীক্ষার সময় (মিনিট)</label>
                                    <input type="number" name="duration_minutes" class="form-control" value="20" min="1" max="300">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- File input -->
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-sm">এক্সেল বা সিএসভি ফাইল নির্বাচন করুন (.xlsx, .xls, .csv) <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="excel_file" class="custom-file-input" id="excelFileField" accept=".xlsx,.xls,.csv" required onchange="updateFileName(this)">
                            <label class="custom-file-label" for="excelFileField" id="excelFileLabel">ফাইল বেছে নিন (.xlsx বা .csv)</label>
                        </div>
                        <small class="form-text text-muted">সর্বোচ্চ ফাইল সাইজ: ১০ মেগাবাইট।</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-success font-weight-bold px-4">
                        <i class="fas fa-cloud-upload-alt mr-1"></i> আপলোড শুরু করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Create New Quiz Manually -->
<div class="modal fade" id="createQuizModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <form action="{{ route('admin.quizzes.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-plus-circle mr-1"></i> নতুন কুইজ তৈরি করুন
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 space-y-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-sm">কোর্স নির্বাচন করুন <span class="text-danger">*</span></label>
                        <select name="course_id" class="form-control" required>
                            <option value="">-- কোর্স নির্বাচন করুন --</option>
                            @foreach($courses as $c)
                                <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-sm">কুইজ শিরোনাম <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="যেমন: Web Development Fundamental Assessment" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-sm">সংক্ষিপ্ত বিবরণ</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="কুইজের নিয়মাবলি বা বর্ণনা..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">ধরণ <span class="text-danger">*</span></label>
                                <select name="quiz_type" class="form-control" required>
                                    <option value="practice">অনুশীলন (Practice)</option>
                                    <option value="exam">পরীক্ষা (Live Exam)</option>
                                    <option value="class_test">ক্লাস টেস্ট (Class Test)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">সময়সীমা (মিনিট) <span class="text-danger">*</span></label>
                                <input type="number" name="duration_minutes" class="form-control" value="20" min="1" max="300" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="font-weight-bold text-sm">পাস মার্কস</label>
                                <input type="number" step="0.5" name="pass_marks" class="form-control" value="5.0" min="0">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="font-weight-bold text-sm">স্ট্যাটাস</label>
                                <select name="is_published" class="form-control">
                                    <option value="1">সরাসরি প্রকাশ (Live)</option>
                                    <option value="0">ড্রাফট (Draft)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">কুইজ সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleImportMode() {
    var mode = document.querySelector('input[name="import_mode"]:checked').value;
    var existingBlock = document.getElementById('existingQuizBlock');
    var newBlock = document.getElementById('newQuizBlock');
    var targetSelect = document.getElementById('targetQuizSelect');
    var newCourse = document.getElementById('newQuizCourseId');
    var newTitle = document.getElementById('newQuizTitle');

    if (mode === 'new') {
        existingBlock.style.display = 'none';
        newBlock.style.display = 'block';
        targetSelect.removeAttribute('required');
        newCourse.setAttribute('required', 'required');
        newTitle.setAttribute('required', 'required');
    } else {
        existingBlock.style.display = 'block';
        newBlock.style.display = 'none';
        targetSelect.setAttribute('required', 'required');
        newCourse.removeAttribute('required');
        newTitle.removeAttribute('required');
    }
}

function openImportForQuiz(quizId, quizTitle) {
    document.getElementById('modeExisting').checked = true;
    toggleImportMode();
    var select = document.getElementById('targetQuizSelect');
    select.value = quizId;
    $('#excelImportModal').modal('show');
}

function updateFileName(input) {
    var fileName = input.files[0] ? input.files[0].name : 'ফাইল বেছে নিন (.xlsx বা .csv)';
    document.getElementById('excelFileLabel').innerText = fileName;
}
</script>
@endsection
