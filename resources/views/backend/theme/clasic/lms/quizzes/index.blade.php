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
                    <a href="{{ route('admin.quizzes.reports') }}" class="btn btn-outline-primary shadow-sm mr-1">
                        <i class="fas fa-chart-line mr-1"></i> পরীক্ষার রিপোর্ট
                    </a>
                    <a href="{{ route('admin.quizzes.sample') }}" class="btn btn-outline-info shadow-sm mr-1">
                        <i class="fas fa-file-download mr-1"></i> নমুনা এক্সেল ডাউনলোড
                    </a>
                    <button type="button" class="btn btn-warning shadow-sm mr-1 font-weight-bold" data-toggle="modal" data-target="#libraryImportModal" style="color: #000000 !important;">
                        <i class="fas fa-book-open mr-1"></i> লাইব্রেরি থেকে প্রশ্ন যোগ (No File)
                    </button>
                    <button type="button" class="btn btn-success shadow-sm mr-1" data-toggle="modal" data-target="#excelImportModal">
                        <i class="fas fa-file-upload mr-1"></i> এক্সেল আপলোড
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
                        <th>মোড ও সেট</th>
                        <th>ধরণ ও সময়</th>
                        <th class="text-center">প্রশ্ন সংখ্যা</th>
                        <th class="text-center">মোট নম্বর</th>
                        <th class="text-center">নেগেটিভ মার্ক</th>
                        <th class="text-center">স্ট্যাটাস</th>
                        <th class="text-center" style="width: 190px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quizzes as $quiz)
                        <tr>
                            <td class="text-center text-muted text-sm">{{ $loop->iteration + ($quizzes->currentPage() - 1) * $quizzes->perPage() }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="font-weight-bold text-dark" style="font-size: 0.95rem;">{{ $quiz->title }}</span>
                                    <button type="button" class="btn btn-link btn-xs text-primary p-0 ml-1" title="কোর্স ও কুইজ শিরোনাম এডিট করুন" onclick="openEditQuizModal({{ json_encode($quiz) }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                <a href="{{ route('admin.quizzes.questions', $quiz->id) }}" class="text-xs text-info font-weight-semibold d-inline-block mt-0.5" title="প্রশ্ন তালিকা দেখুন">
                                    <i class="fas fa-tasks mr-1"></i> প্রশ্ন তালিকা দেখুন ({{ $quiz->questions_count }}টি প্রশ্ন)
                                </a>
                                <div class="text-xs text-primary font-weight-semibold">
                                    <i class="fas fa-graduation-cap mr-1"></i> {{ $quiz->course ? $quiz->course->course_title : 'General / All' }}
                                    @if($quiz->subject_code)
                                        <span class="badge badge-light border ml-1">কোড: {{ $quiz->subject_code }}</span>
                                    @endif
                                </div>
                                @if($quiz->description)
                                    <div class="text-xs text-muted font-italic text-truncate mt-0.5" style="max-width: 280px;">
                                        {{ $quiz->description }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <span class="badge badge-info text-xs px-2 py-0.5">
                                        {{ $quiz->view_mode == 'one_by_one' ? '১টি করে প্রশ্ন' : 'সকল প্রশ্ন (বোর্ড পেপার)' }}
                                    </span>
                                </div>
                                <div class="mt-1">
                                    <span class="badge badge-light border text-xs px-2 py-0.5 font-weight-bold text-dark">
                                        {{ $quiz->question_set ?: 'Set A' }} ({{ \App\model\LmsQuiz::getBengaliSetCode($quiz->question_set) }})
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light border text-capitalize px-2 py-1">
                                    {{ $quiz->quiz_type }}
                                </span>
                                <div class="text-xs text-muted mt-1">
                                    <i class="far fa-clock mr-1"></i> {{ $quiz->duration_minutes }} মিনিট
                                </div>
                                <div class="mt-1">
                                    @if($quiz->max_attempts > 0)
                                        <span class="badge badge-warning text-xs font-weight-bold" style="color: #000000 !important;" title="সর্বোচ্চ {{ $quiz->max_attempts }} বার পরীক্ষা দিতে পারবে">
                                            <i class="fas fa-redo-alt mr-1"></i> রিটেক: {{ $quiz->max_attempts }} বার
                                        </span>
                                    @else
                                        <span class="badge badge-light border text-xs text-muted" title="যত খুশি ততবার রিটেক দেওয়া যাবে">
                                            <i class="fas fa-infinity mr-1"></i> আনলিমিটেড রিটেক
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-0.5">
                                    @if($quiz->shuffle_questions)
                                        <span class="badge badge-light border text-xs text-primary" title="প্রতি রিটেকে প্রশ্নের সিরিয়াল নম্বর এলোমেলো হবে">
                                            <i class="fas fa-random mr-0.5"></i> প্রশ্ন শাফলিং
                                        </span>
                                    @endif
                                    @if($quiz->shuffle_options)
                                        <span class="badge badge-light border text-xs text-success" title="প্রতি রিটেকে উত্তরের অপশন (ক, খ, গ, ঘ) শাফলিং হবে">
                                            <i class="fas fa-dice mr-0.5"></i> অপশন শাফলিং
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-info px-2.5 py-1 text-sm">
                                    {{ $quiz->questions_count }} টি MCQ
                                </span>
                            </td>
                            <td class="text-center font-weight-bold text-dark">
                                {{ number_format($quiz->total_marks, 0) }}
                                <div class="text-xs text-muted">পাস: {{ number_format($quiz->pass_marks, 0) }}</div>
                            </td>
                            <td class="text-center text-sm font-weight-semibold {{ $quiz->negative_marks > 0 ? 'text-danger' : 'text-muted' }}">
                                {{ $quiz->negative_marks > 0 ? '-' . number_format($quiz->negative_marks, 2) : '০.০০' }}
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
                                    <!-- View/Manage Questions in Quiz -->
                                    <a href="{{ route('admin.quizzes.questions', $quiz->id) }}" class="btn btn-outline-info" title="কুইজের প্রশ্ন তালিকা ও ডিলিট/ম্যানেজ করুন">
                                        <i class="fas fa-tasks"></i>
                                    </a>
                                    <!-- Edit Quiz Info (Title, Course, Duration, etc.) -->
                                    <button type="button" class="btn btn-outline-secondary" title="কোর্স ও কুইজ শিরোনাম সম্পাদনা করুন" onclick="openEditQuizModal({{ json_encode($quiz) }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Quick Import from Question Library (No File Required) -->
                                    <button type="button" class="btn btn-outline-success" title="ফাইল ছাড়া লাইব্রেরি থেকে সরাসরি প্রশ্ন যুক্ত করুন" onclick="openLibraryImportForQuiz({{ $quiz->id }}, '{{ addslashes($quiz->title) }}')">
                                        <i class="fas fa-book-open"></i>
                                    </button>
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

                                    <!-- Generate Question Sets -->
                                    <button type="button" class="btn btn-outline-primary" title="সেট ক, খ, গ, ঘ তৈরি করুন" onclick="openGenerateSetsModal({{ $quiz->id }}, '{{ addslashes($quiz->title) }}')">
                                        <i class="fas fa-layer-group"></i>
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
                            <td colspan="9" class="text-center py-5 text-muted">
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
                    <!-- Library Import Notice (No File) -->
                    <div class="alert alert-warning border-0 d-flex align-items-center justify-content-between p-2.5 mb-3 rounded shadow-sm" style="background-color: #FEF3C7; color: #92400E;">
                        <div class="text-xs font-weight-bold">
                            <i class="fas fa-lightbulb text-warning mr-1"></i> এক্সেল ফাইল নেই? প্রশ্ন ব্যাংক ও লাইব্রেরি থেকে ফাইল ছাড়াই প্রশ্ন যোগ করতে চান?
                        </div>
                        <button type="button" class="btn btn-xs btn-warning font-weight-bold shadow-xs text-nowrap ml-2" style="color: #000000 !important;" data-dismiss="modal" data-toggle="modal" data-target="#libraryImportModal">
                            <i class="fas fa-book-open mr-1"></i> লাইব্রেরি থেকে যোগ করুন
                        </button>
                    </div>
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
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-sm text-dark mb-2">আপলোড করার মাধ্যম নির্বাচন করুন:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 mb-0 shadow-sm" id="quizModeCardExisting" for="modeExisting" style="cursor: pointer; border-color: #28a745 !important; background-color: #ffffff;">
                                    <input type="radio" id="modeExisting" name="import_mode" value="existing" class="mr-2" checked onchange="toggleImportMode()" style="width: 17px; height: 17px; accent-color: #28a745; cursor: pointer; flex-shrink: 0;">
                                    <span class="font-weight-bold text-dark text-sm">
                                        বিদ্যমান কোনো কুইজে যোগ করুন
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-6 mt-2 mt-md-0">
                                <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 mb-0 bg-light" id="quizModeCardNew" for="modeNew" style="cursor: pointer;">
                                    <input type="radio" id="modeNew" name="import_mode" value="new" class="mr-2" onchange="toggleImportMode()" style="width: 17px; height: 17px; accent-color: #28a745; cursor: pointer; flex-shrink: 0;">
                                    <span class="font-weight-bold text-dark text-sm">
                                        কোর্স ক্যাটাগরি ভিত্তিক নতুন কুইজ তৈরি করুন
                                    </span>
                                </label>
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

    <!-- Modal: Edit Quiz Info -->
    <div class="modal fade" id="editQuizModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg border-0">
                <form id="editQuizForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-edit mr-1"></i> কোর্স ও কুইজ শিরোনাম সম্পাদনা
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">কোর্স নির্বাচন করুন <span class="text-danger">*</span></label>
                                    <select name="course_id" id="editQuizCourseId" class="form-control" required>
                                        @foreach($courses as $c)
                                            <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">কুইজ শিরোনাম <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="editQuizTitle" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">কুইজের ধরণ</label>
                                    <select name="quiz_type" id="editQuizType" class="form-control">
                                        <option value="practice">অনুশীলন (Practice)</option>
                                        <option value="exam">চূড়ান্ত পরীক্ষা (Live Exam)</option>
                                        <option value="class_test">ক্লাস টেস্ট (Class Test)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">সময়সীমা (মিনিট) <span class="text-danger">*</span></label>
                                    <input type="number" name="duration_minutes" id="editQuizDuration" class="form-control" min="1" max="300" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">পাস মার্কস</label>
                                    <input type="number" step="0.5" name="pass_marks" id="editQuizPassMarks" class="form-control" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">প্রশ্ন সেট কোড</label>
                                    <input type="text" name="question_set" id="editQuizSet" class="form-control" placeholder="যেমন: Set A">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">নেগেটিভ মার্ক প্রতি ভুল উত্তরে</label>
                                    <input type="number" step="0.05" name="negative_marks" id="editQuizNegativeMarks" class="form-control" min="0" value="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">সর্বোচ্চ রিটেক সংখ্যা (Max Attempts)</label>
                                    <input type="number" name="max_attempts" id="editQuizMaxAttempts" class="form-control" min="0" max="50" value="0">
                                    <small class="text-muted d-block mt-0.5">০ = আনলিমিটেড বার রিটেক; ১ = কোনো রিটেক নেই; ২ বা ৩ = সর্বোচ্চ ততবার।</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-sm">প্রতি রিটেকে শাফলিং সেটিংস</label>
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" class="custom-control-input" id="editQuizShuffleQuestions" name="shuffle_questions" value="1">
                                        <label class="custom-control-label text-sm font-weight-normal text-dark" for="editQuizShuffleQuestions">
                                            <i class="fas fa-random text-primary mr-1"></i> প্রশ্নের সিরিয়াল নম্বর এলোমেলো (Shuffle)
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-1">
                                        <input type="checkbox" class="custom-control-input" id="editQuizShuffleOptions" name="shuffle_options" value="1">
                                        <label class="custom-control-label text-sm font-weight-normal text-dark" for="editQuizShuffleOptions">
                                            <i class="fas fa-dice text-success mr-1"></i> উত্তরের অপশন (ক, খ, গ, ঘ) এলোমেলো (Shuffle)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="font-weight-bold text-sm">বর্ণনা / নির্দেশাবলী</label>
                            <textarea name="description" id="editQuizDescription" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">
                            <i class="fas fa-save mr-1"></i> আপডেট সংরক্ষণ করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Library Import to Quiz (No File Required) -->
    <div class="modal fade" id="libraryImportModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg border-0">
                <form id="libraryImportForm" method="POST">
                    @csrf
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title font-weight-bold" style="color: #000000 !important;">
                            <i class="fas fa-book-open mr-1"></i> প্রশ্ন লাইব্রেরি থেকে সরাসরি কুইজে প্রশ্ন যোগ করুন (ফাইল লাগবে না)
                        </h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="alert alert-light border border-warning p-3 mb-4 rounded" style="background-color: #FFFBEB;">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-warning fa-2x mr-3"></i>
                                <div>
                                    <div class="font-weight-bold text-dark">কোনো এক্সেল ফাইল আপলোড ছাড়াই প্রশ্ন যোগ করুন</div>
                                    <div class="text-xs text-muted">আপনার কেন্দ্রীয় প্রশ্ন ব্যাংকের (৪২২+ প্রশ্ন) যেকোনো ক্যাটাগরি বা সেট থেকে সরাসরি এই কুইজে প্রশ্ন যুক্ত করতে পারবেন।</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-sm">টার্গেট কুইজ নির্বাচন করুন: <span class="text-danger">*</span></label>
                            <select name="quiz_id" id="libTargetQuizSelect" class="form-control" onchange="updateLibFormAction(this.value)" required>
                                <option value="">-- কুইজ নির্বাচন করুন --</option>
                                @foreach($quizzes as $qz)
                                    <option value="{{ $qz->id }}">{{ $qz->title }} ({{ $qz->course ? $qz->course->course_title : 'General' }} | বর্তমানে {{ $qz->questions_count }}টি প্রশ্ন)</option>
                                @endforeach
                            </select>
                        </div>

                                                <div class="form-group mb-3">
                            <label class="font-weight-bold text-sm">প্রশ্ন নির্বাচনের পদ্ধতি: <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 bg-white shadow-sm" for="srcCategory" style="cursor: pointer;">
                                        <input type="radio" id="srcCategory" name="source_mode" value="category" class="mr-2" checked onchange="toggleLibSourceMode()">
                                        <span class="font-weight-bold text-sm text-dark"><i class="fas fa-folder text-warning mr-1"></i> ক্যাটাগরি ভিত্তিক</span>
                                    </label>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 bg-light" for="srcType" style="cursor: pointer;">
                                        <input type="radio" id="srcType" name="source_mode" value="type" class="mr-2" onchange="toggleLibSourceMode()">
                                        <span class="font-weight-bold text-sm text-dark"><i class="fas fa-filter text-primary mr-1"></i> প্রশ্নের ধরন ভিত্তিক</span>
                                    </label>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 bg-light border-primary" for="srcPaper" style="cursor: pointer;">
                                        <input type="radio" id="srcPaper" name="source_mode" value="paper" class="mr-2" onchange="toggleLibSourceMode()">
                                        <span class="font-weight-bold text-sm text-primary"><i class="fas fa-scroll text-danger mr-1"></i> পেপার বিল্ডার থেকে</span>
                                    </label>
                                </div>
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 bg-light" for="srcRandom" style="cursor: pointer;">
                                        <input type="radio" id="srcRandom" name="source_mode" value="random" class="mr-2" onchange="toggleLibSourceMode()">
                                        <span class="font-weight-bold text-sm text-dark"><i class="fas fa-dice text-success mr-1"></i> র‍্যান্ডম লটারি ভিত্তিক</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 bg-light" for="srcAll" style="cursor: pointer;">
                                        <input type="radio" id="srcAll" name="source_mode" value="all" class="mr-2" onchange="toggleLibSourceMode()">
                                        <span class="font-weight-bold text-sm text-dark"><i class="fas fa-layer-group text-info mr-1"></i> সব প্রশ্ন থেকে</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Paper Builder Selector (Active when srcPaper is chosen) -->
                        <div id="libPaperBlock" class="form-group mb-3 p-3 rounded border border-danger shadow-xs" style="display: none; background-color: #FEF2F2;">
                            <label class="font-weight-bold text-sm text-danger">
                                <i class="fas fa-file-alt mr-1"></i> পেপার বিল্ডারের প্রশ্নপত্র (Question Paper) বেছে নিন: <span class="text-danger">*</span>
                            </label>
                            <select name="paper_id" id="libPaperSelect" class="form-control">
                                <option value="">-- পেপার বিল্ডার থেকে তৈরি প্রশ্নপত্র বেছে নিন --</option>
                                @if(isset($questionPapers) && count($questionPapers) > 0)
                                    @foreach($questionPapers as $paper)
                                        <option value="{{ $paper->id }}">
                                            {{ $paper->title }} (কোড: {{ $paper->paper_code }} | প্রশ্ন: {{ $paper->items_count }}টি | মোট নম্বর: {{ $paper->total_marks }})
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>এখনো কোনো প্রশ্নপত্র তৈরি করা হয়নি (পেপার বিল্ডারে যান)</option>
                                @endif
                            </select>
                            <small class="text-muted d-block mt-1">নির্বাচিত প্রশ্নপত্রের সকল প্রশ্ন, সেকশন মার্কস ও অপশনসমূহ স্বয়ংক্রিয়ভাবে এই কুইজে যুক্ত হয়ে যাবে।</small>
                        </div>

                        <!-- Category Selector -->
                        <div id="libCategoryBlock" class="form-group mb-3">
                            <label class="font-weight-bold text-sm">প্রশ্ন লাইব্রেরির ক্যাটাগরি বেছে নিন:</label>
                            <select name="category" class="form-control">
                                <option value="">-- যেকোনো ক্যাটাগরি --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Question Type Selector (As requested by user) -->
                        <div id="libTypeBlock" class="form-group mb-3">
                            <label class="font-weight-bold text-sm">প্রশ্নের ধরন (Question Type):</label>
                            <select name="question_type" class="form-control">
                                <option value="">-- যেকোনো ধরনের প্রশ্ন (All Types) --</option>
                                <option value="fill_blanks">শূন্যস্থান পূরণ (Fill in Blanks)</option>
                                <option value="true_false">সত্য / মিথ্যা (True/False)</option>
                                <option value="mcq_single">MCQ (বহুনির্বাচনি)</option>
                                <option value="mcq_multi">বহুপদী সমাপ্তিসূচক (Multiple Select)</option>
                                <option value="short_answer">অতি সংক্ষেপ / সংক্ষিপ্ত (Short Question)</option>
                                <option value="creative">সৃজনশীল (Creative CQ)</option>
                                <option value="translation">ইংরেজি অনুবাদ (Translation)</option>
                                <option value="descriptive">রচনামূলক (Descriptive)</option>
                                <option value="matching">বাম-ডান মিলকরণ (Matching)</option>
                            </select>
                            <small class="text-muted">নির্দিষ্ট ধরনের প্রশ্ন বাছাই করতে চাইলে এটি নির্বাচন করুন।</small>
                        </div>

                        <!-- Question Count -->
                        <div id="libCountBlock" class="form-group mb-0">
                            <label class="font-weight-bold text-sm">কতটি প্রশ্ন যুক্ত করতে চান? (সংখ্যা লিখুন)</label>
                            <input type="number" name="count" class="form-control" value="25" min="1" max="200" placeholder="যেমন: 25">
                            <small class="text-muted">ডিফল্টভাবে ২৫টি প্রশ্ন যুক্ত হবে। চাইলে সংখ্যা বাড়াতে বা কমাতে পারেন।</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-warning font-weight-bold" style="color: #000000 !important;">
                            <i class="fas fa-plus-circle mr-1"></i> কুইজে প্রশ্নসমূহ যুক্ত করুন
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
                                <label class="font-weight-bold text-sm">প্রশ্ন প্রদর্শন মোড <span class="text-danger">*</span></label>
                                <select name="view_mode" class="form-control" required>
                                    <option value="all_questions">সকল প্রশ্ন একসাথে (বোর্ড পরীক্ষার পেপার)</option>
                                    <option value="one_by_one">১টি করে প্রশ্ন (One-by-One)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">প্রশ্ন সেট <span class="text-danger">*</span></label>
                                <select name="question_set" class="form-control" required>
                                    <option value="Set A">সেট ক (Set A)</option>
                                    <option value="Set B">সেট খ (Set B)</option>
                                    <option value="Set C">সেট গ (Set C)</option>
                                    <option value="Set D">সেট ঘ (Set D)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">বিষয় কোড</label>
                                <input type="text" name="subject_code" class="form-control" value="101" placeholder="যেমন: 101 বা 154">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">শিক্ষা বোর্ড / প্রতিষ্ঠান নাম</label>
                                <input type="text" name="board_name" class="form-control" value="ঢাকা শিক্ষা বোর্ড" placeholder="যেমন: ঢাকা বোর্ড / Wake Up ICT">
                            </div>
                        </div>
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
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">ভুল উত্তরের নেগেটিভ মার্ক</label>
                                <input type="number" step="0.05" name="negative_marks" class="form-control" value="0.00" min="0" placeholder="যেমন: 0.25 বা 0.50">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">পাস মার্কস</label>
                                <input type="number" step="0.5" name="pass_marks" class="form-control" value="5.0" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">সর্বোচ্চ রিটেক সংখ্যা (Max Attempts)</label>
                                <input type="number" name="max_attempts" class="form-control" value="0" min="0" max="50">
                                <small class="text-muted d-block mt-0.5">০ = আনলিমিটেড বার রিটেক; ১ = কোনো রিটেক নেই (১ বারই দেওয়া যাবে); ২ বা ৩ = সর্বোচ্চ ততবার।</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">প্রতি রিটেকে শাফলিং সেটিংস</label>
                                <div class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" class="custom-control-input" id="createShuffleQ" name="shuffle_questions" value="1" checked>
                                    <label class="custom-control-label text-sm font-weight-normal text-dark" for="createShuffleQ">
                                        <i class="fas fa-random text-primary mr-1"></i> প্রশ্নের সিরিয়াল নম্বর এলোমেলো (Shuffle)
                                    </label>
                                </div>
                                <div class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" class="custom-control-input" id="createShuffleOpt" name="shuffle_options" value="1" checked>
                                    <label class="custom-control-label text-sm font-weight-normal text-dark" for="createShuffleOpt">
                                        <i class="fas fa-dice text-success mr-1"></i> উত্তরের অপশন (ক, খ, গ, ঘ) এলোমেলো (Shuffle)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <label class="font-weight-bold text-sm">ফলাফল প্রকাশের নীতি</label>
                                <select name="result_release_policy" class="form-control">
                                    <option value="immediate">পরীক্ষা শেষে তাৎক্ষণিক প্রকাশ</option>
                                    <option value="after_deadline">নির্ধারিত সময়সীমা শেষ হলে</option>
                                    <option value="admin_publish">অ্যাডমিন কর্তৃক প্রকাশ সাপেক্ষে</option>
                                </select>
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

<!-- Modal: Generate Question Sets -->
<div class="modal fade" id="generateSetsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <form id="generateSetsForm" action="" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-layer-group mr-1"></i> প্রশ্ন সেট জেনারেটর (Set A, B, C, D)
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 space-y-3">
                    <p class="text-sm text-dark font-weight-semibold mb-2">
                        কুইজ: <span id="generateSetsQuizTitle" class="text-primary font-weight-bold"></span>
                    </p>
                    <div class="alert alert-info border-0 text-xs py-2">
                        <i class="fas fa-info-circle mr-1"></i> বিদ্যমান প্রশ্নভাণ্ডার থেকে স্বয়ংক্রিয়ভাবে অপশন ও প্রশ্ন শাফলিং করে ভিন্ন ভিন্ন সেট তৈরি হবে।
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-sm">তৈরি করার জন্য সেটগুলো নির্বাচন করুন:</label>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="setA" name="sets[]" value="Set A" checked>
                            <label class="custom-control-label" for="setA">সেট ক (Set A) — প্রধান সেট</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="setB" name="sets[]" value="Set B" checked>
                            <label class="custom-control-label" for="setB">সেট খ (Set B) — অপশন শাফলিং ভ্যারিয়েন্ট</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="setC" name="sets[]" value="Set C" checked>
                            <label class="custom-control-label" for="setC">সেট গ (Set C) — অপশন শাফলিং ভ্যারিয়েন্ট</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="setD" name="sets[]" value="Set D" checked>
                            <label class="custom-control-label" for="setD">সেট ঘ (Set D) — অপশন শাফলিং ভ্যারিয়েন্ট</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-magic mr-1"></i> সেট তৈরি শুরু করুন
                    </button>
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
    var cardExisting = document.getElementById('quizModeCardExisting');
    var cardNew = document.getElementById('quizModeCardNew');

    if (mode === 'new') {
        if (existingBlock) existingBlock.style.display = 'none';
        if (newBlock) newBlock.style.display = 'block';
        if (targetSelect) targetSelect.removeAttribute('required');
        if (newCourse) newCourse.setAttribute('required', 'required');
        if (newTitle) newTitle.setAttribute('required', 'required');
        if (cardNew) {
            cardNew.style.borderColor = '#28a745';
            cardNew.style.backgroundColor = '#ffffff';
            cardNew.classList.add('shadow-sm');
            cardNew.classList.remove('bg-light');
        }
        if (cardExisting) {
            cardExisting.style.borderColor = '';
            cardExisting.style.backgroundColor = '';
            cardExisting.classList.remove('shadow-sm');
            cardExisting.classList.add('bg-light');
        }
    } else {
        if (existingBlock) existingBlock.style.display = 'block';
        if (newBlock) newBlock.style.display = 'none';
        if (targetSelect) targetSelect.setAttribute('required', 'required');
        if (newCourse) newCourse.removeAttribute('required');
        if (newTitle) newTitle.removeAttribute('required');
        if (cardExisting) {
            cardExisting.style.borderColor = '#28a745';
            cardExisting.style.backgroundColor = '#ffffff';
            cardExisting.classList.add('shadow-sm');
            cardExisting.classList.remove('bg-light');
        }
        if (cardNew) {
            cardNew.style.borderColor = '';
            cardNew.style.backgroundColor = '';
            cardNew.classList.remove('shadow-sm');
            cardNew.classList.add('bg-light');
        }
    }
}

function openEditQuizModal(quiz) {
    document.getElementById('editQuizForm').action = "/admin/quizzes/" + quiz.id;
    document.getElementById('editQuizCourseId').value = quiz.course_id;
    document.getElementById('editQuizTitle').value = quiz.title;
    document.getElementById('editQuizType').value = quiz.quiz_type || 'practice';
    document.getElementById('editQuizDuration').value = quiz.duration_minutes || 20;
    document.getElementById('editQuizPassMarks').value = quiz.pass_marks || 5.0;
    document.getElementById('editQuizSet').value = quiz.question_set || 'Set A';
    document.getElementById('editQuizNegativeMarks').value = quiz.negative_marks || 0.00;
    document.getElementById('editQuizDescription').value = quiz.description || '';
    document.getElementById('editQuizMaxAttempts').value = (quiz.max_attempts !== undefined && quiz.max_attempts !== null) ? quiz.max_attempts : 0;
    document.getElementById('editQuizShuffleQuestions').checked = (quiz.shuffle_questions !== false && quiz.shuffle_questions !== 0);
    document.getElementById('editQuizShuffleOptions').checked = (quiz.shuffle_options !== false && quiz.shuffle_options !== 0);
    $('#editQuizModal').modal('show');
}

function openLibraryImportForQuiz(quizId, quizTitle) {
    var select = document.getElementById('libTargetQuizSelect');
    if (select) {
        select.value = quizId;
    }
    updateLibFormAction(quizId);
    $('#libraryImportModal').modal('show');
}

function updateLibFormAction(quizId) {
    var form = document.getElementById('libraryImportForm');
    if (form && quizId) {
        form.action = "/admin/quizzes/" + quizId + "/import-from-library";
    }
}

function toggleLibSourceMode() {
    var mode = document.querySelector('input[name="source_mode"]:checked').value;
    var catBlock = document.getElementById('libCategoryBlock');
    var typeBlock = document.getElementById('libTypeBlock');
    var paperBlock = document.getElementById('libPaperBlock');
    var countBlock = document.getElementById('libCountBlock');

    if (catBlock) {
        catBlock.style.display = (mode === 'category') ? 'block' : 'none';
    }
    if (paperBlock) {
        paperBlock.style.display = (mode === 'paper') ? 'block' : 'none';
    }
    if (countBlock) {
        countBlock.style.display = (mode !== 'paper') ? 'block' : 'none';
    }
    if (typeBlock) {
        typeBlock.style.display = (mode !== 'paper') ? 'block' : 'none';
    }
}

function openImportForQuiz(quizId, quizTitle) {
    document.getElementById('modeExisting').checked = true;
    toggleImportMode();
    var select = document.getElementById('targetQuizSelect');
    select.value = quizId;
    $('#excelImportModal').modal('show');
}

function openGenerateSetsModal(quizId, quizTitle) {
    document.getElementById('generateSetsQuizTitle').innerText = quizTitle;
    document.getElementById('generateSetsForm').action = "/admin/quizzes/" + quizId + "/generate-sets";
    $('#generateSetsModal').modal('show');
}

function updateFileName(input) {
    var fileName = input.files[0] ? input.files[0].name : 'ফাইল বেছে নিন (.xlsx বা .csv)';
    document.getElementById('excelFileLabel').innerText = fileName;
}
</script>
@endsection
