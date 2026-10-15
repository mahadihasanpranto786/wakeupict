@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Question Book & Digital Question Library — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_question_book_active', 'active')

@section('maincontant')
    <!-- Content Header -->
    <div class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.5rem;">
                        <i class="fas fa-book-open text-primary mr-2"></i> ডিজিটাল প্রশ্ন বই ও প্রশ্ন লাইব্রেরি (Question Book)
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        সমস্ত কোর্স ও বিষয়ের সংরক্ষিত বহুনির্বাচনি (MCQ), সত্য/মিথ্যা ও সৃজনশীল প্রশ্নাবলি ব্রাউজ, ফিল্টার ও প্রশ্নপত্রে পুনর্ব্যবহার করুন।
                    </p>
                </div>
                <div class="col-sm-5 text-sm-right mt-2 mt-sm-0">
                    <a href="{{ route('admin.question-papers.index') }}" class="btn btn-outline-warning shadow-sm mr-1">
                        <i class="fas fa-layer-group mr-1"></i> পেপার বিল্ডার
                    </a>
                    <button type="button" class="btn btn-outline-info shadow-sm mr-1" data-toggle="modal" data-target="#excelImportModal">
                        <i class="fas fa-file-excel mr-1"></i> এক্সেল ইমপোর্ট
                    </button>
                    <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#createQuestionModal">
                        <i class="fas fa-plus-circle mr-1"></i> নতুন প্রশ্ন তৈরি
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
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

    <!-- Library Stats Summary -->
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-primary text-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-white-50">মোট সংরক্ষিত প্রশ্ন</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['total']) }} টি</div>
                    </div>
                    <i class="fas fa-database fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-success text-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-white-50">বহুনির্বাচনি (MCQ)</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['mcq']) }} টি</div>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-warning text-dark">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-dark-50">সৃজনশীল ও সংক্ষিপ্ত</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['creative']) }} টি</div>
                    </div>
                    <i class="fas fa-pen-nib fa-2x text-black-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-secondary text-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-white-50">আর্কাইভকৃত প্রশ্ন</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['archived']) }} টি</div>
                    </div>
                    <i class="fas fa-archive fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="card shadow-sm mb-3">
        <div class="card-body p-3">
            <form action="{{ route('admin.question-book.index') }}" method="GET" id="filterForm">
                <div class="row align-items-center">
                    <!-- Search Input -->
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="প্রশ্ন, উদ্দীপক বা কীওয়ার্ড খুঁজুন...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Filter -->
                    <div class="col-md-2 col-6 mb-2">
                        <select name="course_id" class="form-control custom-select" onchange="this.form.submit()">
                            <option value="">-- সকল কোর্স/বিষয় --</option>
                            @foreach($courses as $c)
                                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->course_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Filter -->
                    <div class="col-md-2 col-6 mb-2">
                        <select name="category" class="form-control custom-select" onchange="this.form.submit()">
                            <option value="">-- সকল ক্যাটাগরি --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Question Type -->
                    <div class="col-md-2 col-6 mb-2">
                        <select name="question_type" class="form-control custom-select" onchange="this.form.submit()">
                            <option value="">-- প্রশ্নের ধরন --</option>
                            <option value="mcq_single" {{ request('question_type') == 'mcq_single' ? 'selected' : '' }}>MCQ (একক)</option>
                            <option value="mcq_multi" {{ request('question_type') == 'mcq_multi' ? 'selected' : '' }}>MCQ (বহুপদী)</option>
                            <option value="true_false" {{ request('question_type') == 'true_false' ? 'selected' : '' }}>সত্য / মিথ্যা</option>
                            <option value="short_answer" {{ request('question_type') == 'short_answer' ? 'selected' : '' }}>সংক্ষিপ্ত প্রশ্ন</option>
                            <option value="descriptive" {{ request('question_type') == 'descriptive' ? 'selected' : '' }}>রচনামূলক</option>
                            <option value="creative" {{ request('question_type') == 'creative' ? 'selected' : '' }}>সৃজনশীল</option>
                        </select>
                    </div>

                    <!-- Difficulty -->
                    <div class="col-md-2 col-6 mb-2">
                        <select name="difficulty" class="form-control custom-select" onchange="this.form.submit()">
                            <option value="">-- কঠিন্যতা --</option>
                            <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>সহজ (Easy)</option>
                            <option value="medium" {{ request('difficulty') == 'medium' ? 'selected' : '' }}>মাঝারি (Medium)</option>
                            <option value="hard" {{ request('difficulty') == 'hard' ? 'selected' : '' }}>কঠিন (Hard)</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                    <div class="text-muted text-xs">
                        মোট প্রদর্শিত: <strong>{{ \App\model\LmsQuiz::toBengaliNumber($questions->total()) }}</strong> টি প্রশ্ন
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mr-2 mb-0 text-xs font-weight-bold">ভিউ মোড:</label>
                        <div class="btn-group btn-group-sm mr-2" role="group">
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'book']) }}" class="btn {{ $viewStyle === 'book' ? 'btn-primary' : 'btn-outline-secondary' }}">
                                <i class="fas fa-book-open mr-1"></i> বুক রিডিং মোড
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" class="btn {{ $viewStyle === 'list' ? 'btn-primary' : 'btn-outline-secondary' }}">
                                <i class="fas fa-list mr-1"></i> কমপ্যাক্ট তালিকা
                            </a>
                        </div>
                        @if(request()->anyFilled(['search', 'course_id', 'category', 'question_type', 'difficulty', 'archived']))
                            <a href="{{ route('admin.question-book.index') }}" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-times mr-1"></i> ফিল্টার মুছুন
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bulk Action Form Wrapper -->
    <form action="{{ route('admin.question-book.bulk-action') }}" method="POST" id="bulkActionForm">
        @csrf
        <div class="card shadow-sm mb-3 bg-light border">
            <div class="card-body p-2 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center">
                    <div class="custom-control custom-checkbox mr-3">
                        <input type="checkbox" class="custom-control-input" id="selectAllCheckbox">
                        <label class="custom-control-label font-weight-bold text-xs" for="selectAllCheckbox">সবগুলো সিলেক্ট করুন</label>
                    </div>
                    <span id="selectedCountBadge" class="badge badge-info mr-2">০টি নির্বাচিত</span>
                </div>
                <div class="d-flex flex-wrap align-items-center">
                    <select name="action" id="bulkActionSelect" class="form-control form-control-sm mr-2 custom-select" style="width: 170px;">
                        <option value="">-- একশন বেছে নিন --</option>
                        <option value="add_to_paper">প্রশ্নপত্রে যুক্ত করুন</option>
                        <option value="categorize">ক্যাটাগরি পরিবর্তন</option>
                        <option value="export_csv">সিএসভি (CSV) এক্সপোর্ট</option>
                        <option value="archive">আর্কাইভে সরান</option>
                    </select>

                    <!-- Target Paper Selector (shown when add_to_paper selected) -->
                    <div id="targetPaperWrapper" class="mr-2" style="display: none;">
                        <select name="target_paper_id" class="form-control form-control-sm custom-select" style="width: 220px;">
                            @foreach($papers as $p)
                                <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->paper_set }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- New Category Input (shown when categorize selected) -->
                    <div id="bulkCategoryWrapper" class="mr-2" style="display: none;">
                        <input type="text" name="bulk_category" class="form-control form-control-sm" placeholder="নতুন ক্যাটাগরি নাম" style="width: 160px;">
                    </div>

                    <button type="submit" class="btn btn-sm btn-dark" id="bulkSubmitBtn" disabled>
                        <i class="fas fa-check mr-1"></i> কার্যকর করুন
                    </button>
                </div>
            </div>
        </div>

        @if($questions->isEmpty())
            <div class="card shadow-sm p-5 text-center">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">কোনো প্রশ্ন পাওয়া যায়নি!</h4>
                <p class="text-muted text-sm">নতুন প্রশ্ন তৈরি করুন অথবা এক্সেল শিটের মাধ্যমে প্রশ্ন আপলোড করুন।</p>
                <div class="mt-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createQuestionModal">
                        <i class="fas fa-plus-circle mr-1"></i> প্রথম প্রশ্ন তৈরি করুন
                    </button>
                </div>
            </div>
        @elseif($viewStyle === 'book')
            <!-- Book Reading Grid View -->
            <div class="row">
                @foreach($questions as $index => $q)
                    <div class="col-lg-6 mb-3">
                        <div class="card shadow-sm h-100 border-left-{{ $q->question_type === 'mcq_single' ? 'primary' : 'warning' }} transition-hover">
                            <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="custom-control custom-checkbox mr-2">
                                        <input type="checkbox" name="selected_ids[]" value="{{ $q->id }}" class="custom-control-input question-checkbox" id="q_check_{{ $q->id }}">
                                        <label class="custom-control-label" for="q_check_{{ $q->id }}"></label>
                                    </div>
                                    <span class="badge badge-secondary mr-1">#{{ $q->id }}</span>
                                    <span class="badge badge-info mr-1">{{ $q->getTypeLabel() }}</span>
                                    {!! $q->getDifficultyBadge() !!}
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-pill badge-light border text-muted mr-2 font-weight-bold">
                                        মান: {{ \App\model\LmsQuiz::toBengaliNumber($q->marks) }}
                                    </span>
                                    @if($q->negative_marks > 0)
                                        <span class="badge badge-pill badge-danger mr-2">
                                            -{{ \App\model\LmsQuiz::toBengaliNumber($q->negative_marks) }}
                                        </span>
                                    @endif
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" type="button" data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right shadow-sm">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="openPreviewModal({{ $q->id }})">
                                                <i class="fas fa-eye text-primary mr-2"></i> বিস্তারিত প্রিভিউ
                                            </a>
                                            <button type="button" class="dropdown-item" onclick="quickAddToPaper({{ $q->id }})">
                                                <i class="fas fa-file-export text-success mr-2"></i> প্রশ্নপত্রে যোগ করুন
                                            </button>
                                            <button type="submit" formaction="{{ route('admin.question-book.duplicate', $q->id) }}" class="dropdown-item">
                                                <i class="fas fa-copy text-info mr-2"></i> ডুপ্লিকেট (Copy)
                                            </button>
                                            <button type="submit" formaction="{{ route('admin.question-book.archive-toggle', $q->id) }}" class="dropdown-item">
                                                <i class="fas fa-archive text-warning mr-2"></i> {{ $q->is_archived ? 'রিস্টোর করুন' : 'আর্কাইভ করুন' }}
                                            </button>
                                            <div class="dropdown-divider"></div>
                                            <button type="submit" formaction="{{ route('admin.question-book.destroy', $q->id) }}" class="dropdown-item text-danger" onclick="return confirm('আপনি কি নিশ্চিতভাবে এই প্রশ্নটি মুছে ফেলতে চান?')">
                                                <i class="fas fa-trash-alt mr-2"></i> মুছে ফেলুন
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <!-- Stimulus Context if available -->
                                @if($q->stimulus)
                                    <div class="alert alert-light border p-2 mb-2 text-xs text-muted font-italic bg-light rounded">
                                        <strong><i class="fas fa-align-left text-info mr-1"></i> উদ্দীপক:</strong> {{ $q->stimulus }}
                                    </div>
                                @endif

                                <!-- Main Question Text with Kalpurush font -->
                                <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.05rem; line-height: 1.4;">
                                    {{ \App\model\LmsQuiz::toBengaliNumber($index + 1) }}. {!! nl2br(e($q->question_text)) !!}
                                </h5>

                                <!-- Options Grid -->
                                @if($q->options->isNotEmpty())
                                    <div class="row row-cols-1 row-cols-sm-2 mb-2 g-2">
                                        @foreach($q->options as $optIdx => $opt)
                                            <div class="col mb-2">
                                                <div class="p-2 border rounded option-box d-flex align-items-center {{ $opt->is_correct ? 'border-success bg-light-success text-dark font-weight-bold' : 'bg-white' }}" style="font-size: 0.9rem;">
                                                    <span class="badge {{ $opt->is_correct ? 'badge-success' : 'badge-light border' }} mr-2">
                                                        {{ \App\model\LmsQuestion::getBengaliOptionLetter($optIdx) }}
                                                    </span>
                                                    <span class="flex-grow-1">{{ $opt->option_text }}</span>
                                                    @if($opt->is_correct)
                                                        <i class="fas fa-check-circle text-success ml-2" title="সঠিক উত্তর"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Admin Explanation Drawer -->
                                @if($q->explanation)
                                    <div class="mt-2 pt-2 border-top">
                                        <button type="button" class="btn btn-xs btn-link text-muted p-0" data-toggle="collapse" data-target="#exp_{{ $q->id }}">
                                            <i class="fas fa-lightbulb text-warning mr-1"></i> ব্যাখ্যা ও রেফারেন্স দেখুন
                                        </button>
                                        <div class="collapse mt-1" id="exp_{{ $q->id }}">
                                            <div class="p-2 rounded bg-light border text-xs text-muted">
                                                {!! nl2br(e($q->explanation)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer bg-light py-2 px-3 text-xs text-muted d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="mr-2"><i class="fas fa-folder text-warning"></i> {{ $q->category ?: 'জেনারেল' }}</span>
                                    @if($q->chapter)
                                        <span class="mr-2"><i class="fas fa-bookmark text-info"></i> {{ $q->chapter }}</span>
                                    @endif
                                </div>
                                <div>
                                    <button type="button" class="btn btn-xs btn-outline-primary" onclick="quickAddToPaper({{ $q->id }})">
                                        <i class="fas fa-plus mr-1"></i> প্রশ্নপত্রে যোগ করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Compact Table List View -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-sm align-middle">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 40px;" class="text-center">#</th>
                                <th style="width: 30px;"></th>
                                <th>প্রশ্নের বিবরণ</th>
                                <th style="width: 140px;">ধরন</th>
                                <th style="width: 110px;">কঠিন্যতা</th>
                                <th style="width: 80px;" class="text-center">মান</th>
                                <th style="width: 130px;">ক্যাটাগরি</th>
                                <th style="width: 120px;" class="text-center">অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $q)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $q->id }}</td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="selected_ids[]" value="{{ $q->id }}" class="custom-control-input question-checkbox" id="q_tbl_{{ $q->id }}">
                                            <label class="custom-control-label" for="q_tbl_{{ $q->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-bold text-dark mb-1">{{ $q->question_text }}</div>
                                        @if($q->options->isNotEmpty())
                                            <div class="text-xs text-muted">
                                                অফশনসমূহ: {{ $q->options->pluck('option_text')->join(' | ') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-info">{{ $q->getTypeLabel() }}</span></td>
                                    <td>{!! $q->getDifficultyBadge() !!}</td>
                                    <td class="text-center font-weight-bold">{{ \App\model\LmsQuiz::toBengaliNumber($q->marks) }}</td>
                                    <td><span class="badge badge-light border">{{ $q->category ?: 'General' }}</span></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-info mr-1" onclick="openPreviewModal({{ $q->id }})" title="প্রিভিউ">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="quickAddToPaper({{ $q->id }})" title="প্রশ্নপত্রে যোগ">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted text-xs">
                পৃষ্ঠা {{ \App\model\LmsQuiz::toBengaliNumber($questions->currentPage()) }} / {{ \App\model\LmsQuiz::toBengaliNumber($questions->lastPage()) }}
            </div>
            <div>
                {{ $questions->links() }}
            </div>
        </div>
    </form>

    <!-- Create Question Modal -->
    <div class="modal fade" id="createQuestionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content shadow-lg border-0">
                <form action="{{ route('admin.question-book.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-plus-circle mr-1"></i> প্রশ্ন ব্যাংকে নতুন প্রশ্ন সংযোজন
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-xs">কোর্স / বিষয়:</label>
                                <select name="course_id" class="form-control custom-select">
                                    <option value="">-- সাধারণ প্রশ্ন ব্যাংক (সকল কোর্স) --</option>
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-xs">প্রশ্নের ধরন: <span class="text-danger">*</span></label>
                                <select name="question_type" id="modalQuestionType" class="form-control custom-select" required>
                                    <option value="mcq_single">MCQ (একক নির্বাচন)</option>
                                    <option value="mcq_multi">বহুপদী সমাপ্তিসূচক</option>
                                    <option value="true_false">সত্য / মিথ্যা (True/False)</option>
                                    <option value="short_answer">সংক্ষিপ্ত প্রশ্ন</option>
                                    <option value="descriptive">রচনামূলক প্রশ্ন</option>
                                    <option value="creative">সৃজনশীল প্রশ্ন</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-xs">কঠিন্যতা: <span class="text-danger">*</span></label>
                                <select name="difficulty" class="form-control custom-select" required>
                                    <option value="easy">সহজ (Easy)</option>
                                    <option value="medium" selected>মাঝারি (Medium)</option>
                                    <option value="hard">কঠিন (Hard)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Stimulus Context -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-xs">উদ্দীপক / অনুচ্ছেদ (ঐচ্ছিক):</label>
                            <textarea name="stimulus" class="form-control" rows="2" placeholder="প্রয়োজনে উদ্দীপক লিখুন..."></textarea>
                        </div>

                        <!-- Question Text -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-xs">প্রশ্নের মূল বিবরণ: <span class="text-danger">*</span></label>
                            <textarea name="question_text" class="form-control font-weight-bold" rows="3" placeholder="প্রশ্ন লিখুন..." required></textarea>
                        </div>

                        <!-- MCQ Options Container -->
                        <div id="modalOptionsContainer">
                            <label class="font-weight-bold text-xs mb-2">অপশনসমূহ ও সঠিক উত্তর নির্বাচন:</label>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct_option" value="0" checked>
                                                <span class="ml-1 font-weight-bold">ক</span>
                                            </div>
                                        </div>
                                        <input type="text" name="options[0]" class="form-control" placeholder="অপশন ১..." required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct_option" value="1">
                                                <span class="ml-1 font-weight-bold">খ</span>
                                            </div>
                                        </div>
                                        <input type="text" name="options[1]" class="form-control" placeholder="অপশন ২..." required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct_option" value="2">
                                                <span class="ml-1 font-weight-bold">গ</span>
                                            </div>
                                        </div>
                                        <input type="text" name="options[2]" class="form-control" placeholder="অপশন ৩...">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct_option" value="3">
                                                <span class="ml-1 font-weight-bold">ঘ</span>
                                            </div>
                                        </div>
                                        <input type="text" name="options[3]" class="form-control" placeholder="অপশন ৪...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">পূর্ণমান: <span class="text-danger">*</span></label>
                                <input type="number" step="0.5" name="marks" class="form-control" value="1.0" required>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">নেগেটিভ মার্ক:</label>
                                <input type="number" step="0.05" name="negative_marks" class="form-control" value="0.25">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">ক্যাটাগরি:</label>
                                <input type="text" name="category" class="form-control" placeholder="যেমন: আইসিটি">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">অধ্যায় / পাঠ:</label>
                                <input type="text" name="chapter" class="form-control" placeholder="যেমন: অধ্যায় ১">
                            </div>
                        </div>

                        <!-- Explanation -->
                        <div class="form-group mb-0 mt-2">
                            <label class="font-weight-bold text-xs">সঠিক উত্তরের ব্যাখ্যা ও রেফারেন্স (শিক্ষক ও উত্তরপত্রের জন্য):</label>
                            <textarea name="explanation" class="form-control" rows="2" placeholder="কেন এই উত্তরটি সঠিক..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">
                            <i class="fas fa-save mr-1"></i> প্রশ্ন সংরক্ষণ করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick Add to Paper Modal -->
    <div class="modal fade" id="quickAddModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow border-0">
                <form id="quickAddForm" method="POST">
                    @csrf
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-layer-group mr-1"></i> প্রশ্নপত্রে যুক্ত করুন
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="question_id" id="quickAddQuestionId">
                        <div class="form-group">
                            <label class="font-weight-bold text-xs">লক্ষ্যবর্তী প্রশ্নপত্র নির্বাচন করুন:</label>
                            <select name="target_paper_id" id="quickAddPaperSelect" class="form-control custom-select" required>
                                @foreach($papers as $p)
                                    <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->paper_set }})</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-muted text-xs mb-0">
                            * নির্বাচিত প্রশ্নটি প্রশ্নপত্রের সর্বশেষ ক্রমে যুক্ত হবে এবং স্বয়ংক্রিয়ভাবে নম্বর হিসাব হালনাগাদ হবে।
                        </p>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="button" class="btn btn-warning font-weight-bold" onclick="submitQuickAdd()">
                            <i class="fas fa-plus mr-1"></i> যুক্ত করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Detail Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold" id="previewModalTitle">
                        <i class="fas fa-eye text-primary mr-2"></i> প্রশ্ন বিবরণ ও প্রিভিউ
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="previewModalBody">
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                        <p class="text-muted mt-2">লোড হচ্ছে...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Excel Import directly into Question Book / Quiz -->
    <div class="modal fade" id="excelImportModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg border-0">
                <form action="{{ route('admin.question-book.import') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="alert alert-light border border-success/30 p-3 mb-4 rounded shadow-sm">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="pr-2">
                                    <h6 class="font-weight-bold text-success mb-1">
                                        <i class="fas fa-info-circle mr-1"></i> এক্সেল কলামের নিয়মাবলী:
                                    </h6>
                                    <p class="text-xs text-muted mb-0">
                                        এক্সেল শিটে <code>question_text</code>, <code>option_a</code>, <code>option_b</code>, <code>option_c</code>, <code>option_d</code>, <code>correct_option</code> (A/B/C/D), <code>marks</code> ও <code>explanation</code> কলাম থাকতে হবে। (ঐচ্ছিক: <code>category</code>, <code>chapter</code>, <code>topic</code>, <code>difficulty</code>, <code>set_code</code>)
                                    </p>
                                </div>
                                <a href="{{ route('admin.quizzes.sample') }}" class="btn btn-sm btn-outline-success font-weight-bold text-nowrap mt-2 mt-sm-0">
                                    <i class="fas fa-download mr-1"></i> নমুনা টেমপ্লেট
                                </a>
                            </div>
                        </div>

                        <!-- Target Mode Selector -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-sm text-dark mb-2">আপলোড করার মাধ্যম নির্বাচন করুন:</label>
                            <div class="row">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 mb-0 shadow-sm" id="qbModeCardLibrary" for="qbModeLibrary" style="cursor: pointer; border-color: #28a745 !important; background-color: #ffffff;">
                                        <input type="radio" id="qbModeLibrary" name="import_mode" value="library" class="mr-2" checked onchange="toggleQbImportMode()" style="width: 17px; height: 17px; accent-color: #28a745; cursor: pointer; flex-shrink: 0;">
                                        <span class="font-weight-bold text-dark text-sm">
                                            সরাসরি প্রশ্ন লাইব্রেরিতে
                                        </span>
                                    </label>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 mb-0 bg-light" id="qbModeCardExisting" for="qbModeExisting" style="cursor: pointer;">
                                        <input type="radio" id="qbModeExisting" name="import_mode" value="existing_quiz" class="mr-2" onchange="toggleQbImportMode()" style="width: 17px; height: 17px; accent-color: #28a745; cursor: pointer; flex-shrink: 0;">
                                        <span class="font-weight-bold text-dark text-sm">
                                            বিদ্যমান কোনো কুইজে
                                        </span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-flex align-items-center p-2.5 border rounded cursor-pointer h-100 mb-0 bg-light" id="qbModeCardNew" for="qbModeNew" style="cursor: pointer;">
                                        <input type="radio" id="qbModeNew" name="import_mode" value="new_quiz" class="mr-2" onchange="toggleQbImportMode()" style="width: 17px; height: 17px; accent-color: #28a745; cursor: pointer; flex-shrink: 0;">
                                        <span class="font-weight-bold text-dark text-sm">
                                            নতুন কুইজ তৈরি করে
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Block 1: Library Defaults (Course / Category / Chapter) -->
                        <div id="qbLibraryBlock" class="p-3 border rounded bg-light mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">কোর্স / বিষয় (ঐচ্ছিক)</label>
                                        <select name="course_id" id="qbLibraryCourseId" class="form-control form-control-sm">
                                            <option value="">-- সাধারণ প্রশ্ন ব্যাংক (General Bank) --</option>
                                            @foreach($courses as $c)
                                                <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">ডিফল্ট ক্যাটাগরি / বিষয়</label>
                                        <input type="text" name="default_category" class="form-control form-control-sm" placeholder="যেমন: ICT, Bangla, English" list="qbImportCategoryList">
                                        <datalist id="qbImportCategoryList">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat }}">
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold text-xs">ডিফল্ট অধ্যায় / পাঠ</label>
                                        <input type="text" name="default_chapter" class="form-control form-control-sm" placeholder="যেমন: Chapter 1: Information Technology" list="qbImportChapterList">
                                        <datalist id="qbImportChapterList">
                                            @foreach($chapters as $chap)
                                                <option value="{{ $chap }}">
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold text-xs">ডিফল্ট সেট কোড</label>
                                        <input type="text" name="default_set_code" class="form-control form-control-sm" value="Set A">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Block 2: Existing Quiz Selection -->
                        <div id="qbExistingQuizBlock" class="form-group" style="display: none;">
                            <label class="font-weight-bold text-sm">টার্গেট কুইজ নির্বাচন করুন <span class="text-danger">*</span></label>
                            <select name="quiz_id" id="qbTargetQuizSelect" class="form-control">
                                <option value="">-- কুইজ নির্বাচন করুন --</option>
                                @if(isset($quizzes))
                                    @foreach($quizzes as $q)
                                        <option value="{{ $q->id }}">
                                            {{ $q->title }} ({{ $q->course ? $q->course->course_title : 'General' }} | বর্তমানে {{ $q->questions_count }} টি প্রশ্ন)
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Block 3: New Quiz Configuration -->
                        <div id="qbNewQuizBlock" class="p-3 border rounded bg-light mb-3" style="display: none;">
                            <h6 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-plus-circle mr-1"></i> নতুন কুইজ কনফিগারেশন:
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-sm">কোর্স ক্যাটাগরি <span class="text-danger">*</span></label>
                                        <select name="new_quiz_course_id" id="qbNewQuizCourseId" class="form-control">
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
                                        <input type="text" name="new_quiz_title" id="qbNewQuizTitle" class="form-control" placeholder="যেমন: ICT চ্যাপ্টার ৩ MCQ টেস্ট">
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
                                <input type="file" name="excel_file" class="custom-file-input" id="qbExcelFileField" accept=".xlsx,.xls,.csv" required onchange="updateQbFileName(this)">
                                <label class="custom-file-label" for="qbExcelFileField" id="qbExcelFileLabel">ফাইল বেছে নিন (.xlsx বা .csv)</label>
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

    <!-- Page Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select All Checkbox Handler
            var selectAll = document.getElementById('selectAllCheckbox');
            var checkboxes = document.querySelectorAll('.question-checkbox');
            var badge = document.getElementById('selectedCountBadge');
            var bulkBtn = document.getElementById('bulkSubmitBtn');
            var bulkActionSelect = document.getElementById('bulkActionSelect');
            var targetPaperWrapper = document.getElementById('targetPaperWrapper');
            var bulkCategoryWrapper = document.getElementById('bulkCategoryWrapper');

            function updateBulkCount() {
                var checkedCount = document.querySelectorAll('.question-checkbox:checked').length;
                badge.innerText = checkedCount + 'টি নির্বাচিত';
                if (checkedCount > 0 && bulkActionSelect.value !== '') {
                    bulkBtn.removeAttribute('disabled');
                } else {
                    bulkBtn.setAttribute('disabled', 'disabled');
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    checkboxes.forEach(function (cb) {
                        cb.checked = selectAll.checked;
                    });
                    updateBulkCount();
                });
            }

            checkboxes.forEach(function (cb) {
                cb.addEventListener('change', function () {
                    updateBulkCount();
                });
            });

            if (bulkActionSelect) {
                bulkActionSelect.addEventListener('change', function () {
                    if (this.value === 'add_to_paper') {
                        targetPaperWrapper.style.display = 'block';
                        bulkCategoryWrapper.style.display = 'none';
                    } else if (this.value === 'categorize') {
                        targetPaperWrapper.style.display = 'none';
                        bulkCategoryWrapper.style.display = 'block';
                    } else {
                        targetPaperWrapper.style.display = 'none';
                        bulkCategoryWrapper.style.display = 'none';
                    }
                    updateBulkCount();
                });
            }
        });

        // Quick Add to Paper helper
        function quickAddToPaper(questionId) {
            document.getElementById('quickAddQuestionId').value = questionId;
            $('#quickAddModal').modal('show');
        }

        function submitQuickAdd() {
            var qId = document.getElementById('quickAddQuestionId').value;
            var paperId = document.getElementById('quickAddPaperSelect').value;

            fetch('/admin/question-papers/' + paperId + '/add-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ question_id: qId })
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                $('#quickAddModal').modal('hide');
                if (res.success) {
                    alert('সফলভাবে প্রশ্নপত্রে যুক্ত হয়েছে! মোট প্রশ্ন: ' + res.total_questions);
                } else {
                    alert(res.message || 'ত্রুটি ঘটেছে');
                }
            })
            .catch(function(err) {
                alert('যুক্ত করতে সমস্যা হয়েছে');
            });
        }

        // Preview Question Modal AJAX
        function openPreviewModal(questionId) {
            $('#previewModal').modal('show');
            var body = document.getElementById('previewModalBody');
            body.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i><p class="text-muted mt-2">লোড হচ্ছে...</p></div>';

            fetch('/admin/question-book/' + questionId + '/preview')
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    if (res.success) {
                        var q = res.question;
                        var optHtml = '';
                        if (q.options && q.options.length > 0) {
                            optHtml += '<div class="row row-cols-1 row-cols-md-2 g-2 mt-2">';
                            q.options.forEach(function(o) {
                                var cls = o.is_correct ? 'border-success bg-light-success font-weight-bold text-success' : 'bg-light';
                                var icon = o.is_correct ? '<i class="fas fa-check-circle text-success ml-auto"></i>' : '';
                                optHtml += '<div class="col mb-2"><div class="p-2.5 border rounded d-flex align-items-center ' + cls + '"><span class="badge badge-secondary mr-2">' + o.letter + '</span><span>' + o.text + '</span>' + icon + '</div></div>';
                            });
                            optHtml += '</div>';
                        }

                        var stimHtml = q.stimulus ? '<div class="alert alert-light border p-2 mb-3"><strong>উদ্দীপক:</strong> ' + q.stimulus + '</div>' : '';
                        var expHtml = q.explanation ? '<div class="mt-3 p-3 bg-light rounded border"><strong><i class="fas fa-lightbulb text-warning mr-1"></i> সঠিক উত্তরের ব্যাখ্যা:</strong><p class="mb-0 mt-1">' + q.explanation + '</p></div>' : '';

                        body.innerHTML = `
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="badge badge-info mr-1">${q.type_label}</span>
                                    ${q.difficulty_badge}
                                </div>
                                <div class="text-muted text-xs">
                                    পূর্ণমান: <strong>${q.marks}</strong> | নেগেটিভ: <strong>${q.negative_marks}</strong>
                                </div>
                            </div>
                            ${stimHtml}
                            <h5 class="font-weight-bold mb-3">${q.question_text}</h5>
                            ${optHtml}
                            ${expHtml}
                            <div class="mt-4 pt-3 border-top d-flex justify-content-between text-xs text-muted">
                                <span>কোর্স: <strong>${q.course_title}</strong></span>
                                <span>ক্যাটাগরি: <strong>${q.category || 'N/A'}</strong></span>
                                <span>অধ্যায়: <strong>${q.chapter || 'N/A'}</strong></span>
                            </div>
                        `;
                    } else {
                        body.innerHTML = '<div class="alert alert-danger">প্রশ্ন লোড করা যায়নি।</div>';
                    }
                })
                .catch(function(err) {
                    body.innerHTML = '<div class="alert alert-danger">সার্ভার ত্রুটি: ' + err + '</div>';
                });
        }

        // Excel Import Mode Toggle
        function toggleQbImportMode() {
            var selectedRadio = document.querySelector('input[name="import_mode"]:checked');
            if (!selectedRadio) return;
            var mode = selectedRadio.value;

            // Highlight selected card visually
            var cards = {
                'library': document.getElementById('qbModeCardLibrary'),
                'existing_quiz': document.getElementById('qbModeCardExisting'),
                'new_quiz': document.getElementById('qbModeCardNew')
            };

            for (var key in cards) {
                if (cards[key]) {
                    if (key === mode) {
                        cards[key].style.borderColor = '#28a745';
                        cards[key].style.backgroundColor = '#ffffff';
                        cards[key].classList.add('shadow-sm');
                        cards[key].classList.remove('bg-light');
                    } else {
                        cards[key].style.borderColor = '';
                        cards[key].style.backgroundColor = '';
                        cards[key].classList.remove('shadow-sm');
                        cards[key].classList.add('bg-light');
                    }
                }
            }

            var libBlock = document.getElementById('qbLibraryBlock');
            var existingBlock = document.getElementById('qbExistingQuizBlock');
            var newBlock = document.getElementById('qbNewQuizBlock');
            var courseField = document.getElementById('qbLibraryCourseId');
            var newCourseField = document.getElementById('qbNewQuizCourseId');
            var targetQuiz = document.getElementById('qbTargetQuizSelect');

            if (mode === 'library') {
                if (libBlock) libBlock.style.display = 'block';
                if (existingBlock) existingBlock.style.display = 'none';
                if (newBlock) newBlock.style.display = 'none';
                if (targetQuiz) targetQuiz.removeAttribute('required');
                if (newCourseField) newCourseField.removeAttribute('name');
                if (courseField) courseField.setAttribute('name', 'course_id');
            } else if (mode === 'existing_quiz') {
                if (libBlock) libBlock.style.display = 'none';
                if (existingBlock) existingBlock.style.display = 'block';
                if (newBlock) newBlock.style.display = 'none';
                if (targetQuiz) targetQuiz.setAttribute('required', 'required');
                if (newCourseField) newCourseField.removeAttribute('name');
                if (courseField) courseField.removeAttribute('name');
            } else {
                if (libBlock) libBlock.style.display = 'none';
                if (existingBlock) existingBlock.style.display = 'none';
                if (newBlock) newBlock.style.display = 'block';
                if (targetQuiz) targetQuiz.removeAttribute('required');
                if (courseField) courseField.removeAttribute('name');
                if (newCourseField) newCourseField.setAttribute('name', 'course_id');
            }
        }

        function updateQbFileName(input) {
            var fileName = input.files && input.files[0] ? input.files[0].name : 'ফাইল বেছে নিন (.xlsx বা .csv)';
            var label = document.getElementById('qbExcelFileLabel');
            if (label) {
                label.textContent = fileName;
            }
        }
    </script>
@endsection
