@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Question Bank & Multi-Type Question Library — Wake Up ICT')

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
                        <i class="fas fa-book-open text-primary mr-2"></i> প্রশ্ন ব্যাংক — ডিজিটাল প্রশ্ন বই ও প্রশ্ন লাইব্রেরি (Question Bank)
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        ৩৪৭টি মূল MCQ সহ বহুনির্বাচনি, সত্য/মিথ্যা, শূন্যস্থান পূরণ, অতি সংক্ষেপ, সৃজনশীল ও অনুবাদ প্রশ্ন তৈরি, সম্পর্কিত সংস্করণ ও প্রশ্নপত্রে ব্যবহার।
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

    <!-- Question Types Strip / Stat Cards -->
    <div class="row g-2 mb-3">
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('admin.question-book.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-2 {{ !request('question_type') && !request('relation_status') ? 'bg-primary text-white' : 'bg-white text-dark' }} transition-hover">
                    <div class="card-body p-2.5 text-center">
                        <div class="text-xs font-weight-bold text-uppercase opacity-75">মোট প্রশ্ন</div>
                        <div class="h4 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['total']) }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('admin.question-book.index', ['question_type' => 'mcq']) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-2 {{ request('question_type') == 'mcq' ? 'bg-success text-white' : 'bg-white text-dark' }} transition-hover">
                    <div class="card-body p-2.5 text-center">
                        <div class="text-xs font-weight-bold text-uppercase opacity-75">বহুনির্বাচনি (MCQ)</div>
                        <div class="h4 font-weight-bold mb-0 text-success {{ request('question_type') == 'mcq' ? 'text-white' : '' }}">{{ \App\model\LmsQuiz::toBengaliNumber($stats['mcq']) }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('admin.question-book.index', ['question_type' => 'true_false']) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-2 {{ request('question_type') == 'true_false' ? 'bg-info text-white' : 'bg-white text-dark' }} transition-hover">
                    <div class="card-body p-2.5 text-center">
                        <div class="text-xs font-weight-bold text-uppercase opacity-75">সত্য / মিথ্যা</div>
                        <div class="h4 font-weight-bold mb-0 text-info {{ request('question_type') == 'true_false' ? 'text-white' : '' }}">{{ \App\model\LmsQuiz::toBengaliNumber($stats['true_false']) }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('admin.question-book.index', ['question_type' => 'fill_blanks']) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-2 {{ request('question_type') == 'fill_blanks' ? 'bg-warning text-dark' : 'bg-white text-dark' }} transition-hover">
                    <div class="card-body p-2.5 text-center">
                        <div class="text-xs font-weight-bold text-uppercase opacity-75">শূন্যস্থান পূরণ</div>
                        <div class="h4 font-weight-bold mb-0 text-warning {{ request('question_type') == 'fill_blanks' ? 'text-dark' : '' }}">{{ \App\model\LmsQuiz::toBengaliNumber($stats['fill_blanks']) }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('admin.question-book.index', ['question_type' => 'short_answer']) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-2 {{ request('question_type') == 'short_answer' ? 'bg-indigo text-white' : 'bg-white text-dark' }} transition-hover" style="{{ request('question_type') == 'short_answer' ? 'background:#6610f2;color:#fff;' : '' }}">
                    <div class="card-body p-2.5 text-center">
                        <div class="text-xs font-weight-bold text-uppercase opacity-75">অতি সংক্ষেপে উত্তর</div>
                        <div class="h4 font-weight-bold mb-0" style="color: #6610f2; {{ request('question_type') == 'short_answer' ? 'color:#fff !important;' : '' }}">{{ \App\model\LmsQuiz::toBengaliNumber($stats['short_answer']) }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-2">
            <a href="{{ route('admin.question-book.index', ['question_type' => 'creative']) }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-2 {{ request('question_type') == 'creative' ? 'bg-danger text-white' : 'bg-white text-dark' }} transition-hover">
                    <div class="card-body p-2.5 text-center">
                        <div class="text-xs font-weight-bold text-uppercase opacity-75">সৃজনশীল (CQ)</div>
                        <div class="h4 font-weight-bold mb-0 text-danger {{ request('question_type') == 'creative' ? 'text-white' : '' }}">{{ \App\model\LmsQuiz::toBengaliNumber($stats['creative']) }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Quick Relation Pills (Original vs Derived) -->
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <span class="text-xs font-weight-bold text-muted mr-1"><i class="fas fa-filter text-primary"></i> সম্পর্ক ফিল্টার:</span>
        <a href="{{ request()->fullUrlWithQuery(['relation_status' => null]) }}" class="badge badge-pill {{ !request('relation_status') ? 'badge-dark' : 'badge-light border' }} px-3 py-2 text-xs">
            সকল প্রশ্ন ({{ \App\model\LmsQuiz::toBengaliNumber($stats['total']) }})
        </a>
        <a href="{{ request()->fullUrlWithQuery(['relation_status' => 'original']) }}" class="badge badge-pill {{ request('relation_status') == 'original' ? 'badge-primary' : 'badge-light border' }} px-3 py-2 text-xs">
            <i class="fas fa-star mr-1"></i> মূল প্রশ্ন / ৩৪৭টি MCQ ({{ \App\model\LmsQuiz::toBengaliNumber($stats['original_count']) }})
        </a>
        <a href="{{ request()->fullUrlWithQuery(['relation_status' => 'derived']) }}" class="badge badge-pill {{ request('relation_status') == 'derived' ? 'badge-info' : 'badge-light border' }} px-3 py-2 text-xs">
            <i class="fas fa-code-branch mr-1"></i> সম্পর্কিত উদ্ভূত সংস্করণ ({{ \App\model\LmsQuiz::toBengaliNumber($stats['derived_count']) }})
        </a>
        @if($stats['archived'] > 0)
            <a href="{{ request()->fullUrlWithQuery(['archived' => 1]) }}" class="badge badge-pill {{ request('archived') ? 'badge-secondary' : 'badge-light border' }} px-3 py-2 text-xs ml-auto">
                <i class="fas fa-archive mr-1"></i> আর্কাইভকৃত ({{ \App\model\LmsQuiz::toBengaliNumber($stats['archived']) }})
            </a>
        @endif
    </div>

    <!-- Search & Filter Controls -->
    <div class="card shadow-sm mb-3">
        <div class="card-body p-3">
            <form action="{{ route('admin.question-book.index') }}" method="GET" id="filterForm">
                <div class="row align-items-center">
                    <!-- Search Input -->
                    <div class="col-md-3 mb-2">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="প্রশ্ন, উত্তর বা #ID খুঁজুন...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Filter -->
                    <div class="col-md-2 col-6 mb-2">
                        <select name="course_id" class="form-control form-control-sm custom-select" onchange="this.form.submit()">
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
                        <select name="category" class="form-control form-control-sm custom-select" onchange="this.form.submit()">
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
                        <select name="question_type" class="form-control form-control-sm custom-select" onchange="this.form.submit()">
                            <option value="">-- প্রশ্নের ধরন --</option>
                            <option value="mcq" {{ request('question_type') == 'mcq' ? 'selected' : '' }}>MCQ (সকল)</option>
                            <option value="mcq_single" {{ request('question_type') == 'mcq_single' ? 'selected' : '' }}>MCQ (একক নির্বাচন)</option>
                            <option value="mcq_multi" {{ request('question_type') == 'mcq_multi' ? 'selected' : '' }}>MCQ (বহুপদী)</option>
                            <option value="true_false" {{ request('question_type') == 'true_false' ? 'selected' : '' }}>সত্য / মিথ্যা</option>
                            <option value="fill_blanks" {{ request('question_type') == 'fill_blanks' ? 'selected' : '' }}>শূন্যস্থান পূরণ</option>
                            <option value="short_answer" {{ request('question_type') == 'short_answer' ? 'selected' : '' }}>অতি সংক্ষেপে উত্তর</option>
                            <option value="creative" {{ request('question_type') == 'creative' ? 'selected' : '' }}>সৃজনশীল (CQ)</option>
                            <option value="descriptive" {{ request('question_type') == 'descriptive' ? 'selected' : '' }}>রচনামূলক ও অনুবাদ</option>
                            <option value="matching" {{ request('question_type') == 'matching' ? 'selected' : '' }}>মিলকরণ (Matching)</option>
                        </select>
                    </div>

                    <!-- Difficulty -->
                    <div class="col-md-1 col-6 mb-2">
                        <select name="difficulty" class="form-control form-control-sm custom-select" onchange="this.form.submit()">
                            <option value="">-- কঠিন্যতা --</option>
                            <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>সহজ</option>
                            <option value="medium" {{ request('difficulty') == 'medium' ? 'selected' : '' }}>মাঝারি</option>
                            <option value="hard" {{ request('difficulty') == 'hard' ? 'selected' : '' }}>কঠিন</option>
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="col-md-2 col-6 mb-2">
                        <select name="sort" class="form-control form-control-sm custom-select" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>সর্বশেষ আগে</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>প্রাচীনতম আগে</option>
                            <option value="marks_high" {{ request('sort') == 'marks_high' ? 'selected' : '' }}>সর্বোচ্চ নম্বর</option>
                            <option value="marks_low" {{ request('sort') == 'marks_low' ? 'selected' : '' }}>সর্বনিম্ন নম্বর</option>
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
                        @if(request()->anyFilled(['search', 'course_id', 'category', 'question_type', 'difficulty', 'relation_status', 'archived']))
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
                <h4 class="text-muted font-weight-bold">কোনো প্রশ্ন পাওয়া যায়নি!</h4>
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
                        <div class="card shadow-sm h-100 border-left-{{ $q->question_type === 'mcq_single' ? 'primary' : ($q->question_type === 'true_false' ? 'info' : ($q->question_type === 'fill_blanks' ? 'warning' : 'danger')) }} transition-hover">
                            <div class="card-header bg-white py-2 px-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center flex-wrap gap-1">
                                    <div class="custom-control custom-checkbox mr-2">
                                        <input type="checkbox" name="selected_ids[]" value="{{ $q->id }}" class="custom-control-input question-checkbox" id="q_check_{{ $q->id }}">
                                        <label class="custom-control-label" for="q_check_{{ $q->id }}"></label>
                                    </div>
                                    <span class="badge badge-secondary mr-1">#{{ $q->id }}</span>
                                    <span class="badge badge-info mr-1">{{ $q->getTypeLabel() }}</span>
                                    {!! $q->getDifficultyBadge() !!}

                                    <!-- Relationship Indicators -->
                                    @if($q->isDerived())
                                        <span class="badge badge-light border text-primary ml-1" title="মূল প্রশ্ন #{{ $q->parent_question_id }} থেকে প্রাপ্ত">
                                            <i class="fas fa-link mr-1"></i> Derived (#{{ $q->parent_question_id }})
                                        </span>
                                    @elseif($q->derivedQuestions->count() > 0)
                                        <button type="button" class="badge badge-primary border-0 ml-1 cursor-pointer" onclick="openRelatedModal({{ $q->id }})" title="সম্পর্কিত সকল সংস্করণ দেখুন">
                                            <i class="fas fa-sitemap mr-1"></i> {{ $q->derivedQuestions->count() }}টি ভ্যারিয়েন্ট
                                        </button>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-pill badge-light border text-muted mr-2 font-weight-bold">
                                        মান: {{ \App\model\LmsQuiz::toBengaliNumber($q->marks) }}
                                    </span>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link text-muted p-0" type="button" data-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right shadow-sm">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="openPreviewModal({{ $q->id }})">
                                                <i class="fas fa-eye text-primary mr-2"></i> বিস্তারিত প্রিভিউ
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="openDeriveModal({{ $q->id }})">
                                                <i class="fas fa-code-branch text-success mr-2"></i> সম্পর্কিত প্রশ্ন তৈরি (Derive)
                                            </a>
                                            @if($q->isDerived() || $q->derivedQuestions->count() > 0)
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="openRelatedModal({{ $q->id }})">
                                                    <i class="fas fa-sitemap text-info mr-2"></i> সকল সংস্করণ দেখুন
                                                </a>
                                            @endif
                                            <button type="button" class="dropdown-item" onclick="openEditModal({{ $q->id }})">
                                                <i class="fas fa-edit text-warning mr-2"></i> সম্পাদনা করুন
                                            </button>
                                            <button type="button" class="dropdown-item" onclick="quickAddToPaper({{ $q->id }})">
                                                <i class="fas fa-file-export text-success mr-2"></i> প্রশ্নপত্রে যোগ করুন
                                            </button>
                                            <button type="submit" formaction="{{ route('admin.question-book.duplicate', $q->id) }}" class="dropdown-item">
                                                <i class="fas fa-copy text-info mr-2"></i> ডুপ্লিকেট (Copy)
                                            </button>
                                            <button type="submit" formaction="{{ route('admin.question-book.archive-toggle', $q->id) }}" class="dropdown-item">
                                                <i class="fas fa-archive text-secondary mr-2"></i> {{ $q->is_archived ? 'রিস্টোর করুন' : 'আর্কাইভ করুন' }}
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

                                <!-- Main Question Text with clean styling -->
                                <h5 class="card-title font-weight-bold text-dark mb-3" style="font-size: 1.05rem; line-height: 1.4;">
                                    {{ \App\model\LmsQuiz::toBengaliNumber($index + 1) }}. {!! nl2br(e($q->question_text)) !!}
                                </h5>

                                <!-- TYPE-SPECIFIC CONTENT DISPLAY -->
                                <!-- 1. MCQ Options Grid -->
                                @if(in_array($q->question_type, ['mcq_single', 'mcq_multi']) && $q->options->isNotEmpty())
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

                                <!-- 2. True / False Display -->
                                @if($q->question_type === 'true_false')
                                    <div class="d-flex align-items-center gap-3 p-2 bg-light rounded border mb-2">
                                        <span class="text-xs font-weight-bold text-muted mr-2">সঠিক বিবৃতি:</span>
                                        <span class="badge badge-success px-3 py-1 font-weight-bold">
                                            <i class="fas fa-check mr-1"></i> {{ ($q->correct_answer_text === 'true' || ($q->options->where('is_correct', true)->first() && $q->options->where('is_correct', true)->first()->option_text == 'সত্য')) ? 'সত্য (True)' : 'মিথ্যা (False)' }}
                                        </span>
                                    </div>
                                @endif

                                <!-- 3. Fill in the Blanks Display -->
                                @if($q->question_type === 'fill_blanks')
                                    <div class="p-2 bg-light rounded border mb-2 text-xs">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span><strong>প্রত্যাশিত শব্দ / উত্তর:</strong> <span class="badge badge-success font-mono font-weight-bold text-sm px-2 py-1">{{ $q->correct_answer_text ?: 'N/A' }}</span></span>
                                            @if($q->hints)
                                                <span class="text-muted"><i class="fas fa-info-circle text-info mr-1"></i> ক্লু: <code>{{ $q->hints }}</code></span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- 4. Creative Question (CQ) Subquestions -->
                                @if($q->question_type === 'creative' && !empty($q->cq_subquestions_decoded))
                                    <div class="p-2 bg-light rounded border mb-2">
                                        <div class="text-xs font-weight-bold text-muted mb-1">উপ-প্রশ্নাবলি:</div>
                                        <div class="row g-1">
                                            @foreach($q->cq_subquestions_decoded as $sub)
                                                <div class="col-12 col-sm-6 text-xs mb-1">
                                                    <span class="badge badge-dark mr-1">{{ isset($sub['label']) ? $sub['label'] : 'উপ' }}</span>
                                                    <span class="text-dark">{{ isset($sub['text']) ? $sub['text'] : '' }}</span>
                                                    <span class="text-muted">[{{ isset($sub['marks']) ? \App\model\LmsQuiz::toBengaliNumber($sub['marks']) : '১' }} নম্বর]</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- 5. Short Question / Translation / Descriptive -->
                                @if(in_array($q->question_type, ['short_answer', 'translation', 'descriptive']) && $q->correct_answer_text)
                                    <div class="p-2 bg-light rounded border mb-2 text-xs">
                                        <strong>নমুনা উত্তর / গাইডলাইন:</strong>
                                        <p class="mb-0 text-success font-italic mt-0.5">{{ $q->correct_answer_text }}</p>
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
                                <div class="d-flex align-items-center gap-1">
                                    <button type="button" class="btn btn-xs btn-outline-success mr-1" onclick="openDeriveModal({{ $q->id }})" title="এই মূল প্রশ্ন থেকে অন্য ফরম্যাট বানান">
                                        <i class="fas fa-code-branch mr-1"></i> সম্পর্কিত প্রশ্ন
                                    </button>
                                    <button type="button" class="btn btn-xs btn-outline-primary" onclick="quickAddToPaper({{ $q->id }})">
                                        <i class="fas fa-plus mr-1"></i> পেপারে যোগ
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
                                <th>প্রশ্নের বিবরণ ও উত্তর</th>
                                <th style="width: 140px;">ধরন</th>
                                <th style="width: 130px;">সম্পর্ক</th>
                                <th style="width: 100px;">কঠিন্যতা</th>
                                <th style="width: 80px;" class="text-center">মান</th>
                                <th style="width: 120px;">ক্যাটাগরি</th>
                                <th style="width: 150px;" class="text-center">অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $index => $q)
                                <tr>
                                    <td class="text-center font-weight-bold text-muted text-xs">
                                        #{{ $q->id }}
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="selected_ids[]" value="{{ $q->id }}" class="custom-control-input question-checkbox" id="q_tbl_check_{{ $q->id }}">
                                            <label class="custom-control-label" for="q_tbl_check_{{ $q->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-weight-bold text-dark" style="font-size: 0.95rem;">
                                            {{ $q->question_text }}
                                        </div>
                                        @if($q->correct_answer_text)
                                            <div class="text-xs text-success font-weight-bold mt-1">
                                                <i class="fas fa-check-circle mr-1"></i> উত্তর: {{ $q->correct_answer_text }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $q->getTypeLabel() }}</span>
                                    </td>
                                    <td>
                                        @if($q->isDerived())
                                            <span class="badge badge-light border text-primary" title="মূল প্রশ্ন #{{ $q->parent_question_id }} থেকে প্রাপ্ত">
                                                <i class="fas fa-link mr-1"></i> Derived (#{{ $q->parent_question_id }})
                                            </span>
                                        @elseif($q->derivedQuestions->count() > 0)
                                            <button type="button" class="btn btn-xs btn-outline-primary" onclick="openRelatedModal({{ $q->id }})">
                                                <i class="fas fa-sitemap mr-1"></i> {{ $q->derivedQuestions->count() }} Variants
                                            </button>
                                        @else
                                            <span class="badge badge-light border text-muted">মূল প্রশ্ন</span>
                                        @endif
                                    </td>
                                    <td>
                                        {!! $q->getDifficultyBadge() !!}
                                    </td>
                                    <td class="text-center font-weight-bold">
                                        {{ \App\model\LmsQuiz::toBengaliNumber($q->marks) }}
                                    </td>
                                    <td class="text-xs text-muted">
                                        {{ $q->category ?: 'জেনারেল' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-xs">
                                            <button type="button" class="btn btn-outline-info" onclick="openPreviewModal({{ $q->id }})" title="প্রিভিউ">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-success" onclick="openDeriveModal({{ $q->id }})" title="সম্পর্কিত প্রশ্ন বানান">
                                                <i class="fas fa-code-branch"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" onclick="openEditModal({{ $q->id }})" title="সম্পাদনা">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-primary" onclick="quickAddToPaper({{ $q->id }})" title="প্রশ্নপত্রে যোগ করুন">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
            <div class="text-muted text-xs mb-2">
                মোট <strong>{{ \App\model\LmsQuiz::toBengaliNumber($questions->total()) }}</strong> টি প্রশ্নের মধ্যে <strong>{{ \App\model\LmsQuiz::toBengaliNumber($questions->firstItem() ?: 0) }} - {{ \App\model\LmsQuiz::toBengaliNumber($questions->lastItem() ?: 0) }}</strong> প্রদর্শিত হচ্ছে
            </div>
            <div>
                {{ $questions->links() }}
            </div>
        </div>

    </form>

    <!-- ========================================================================= -->
    <!-- MODALS: Create Question (Dynamic Multi-Type), Derive Question, Related, Edit -->
    <!-- ========================================================================= -->

    <!-- Modal 1: Create New Question (Dynamic fields per type) -->
    <div class="modal fade" id="createQuestionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <form action="{{ route('admin.question-book.store') }}" method="POST" id="createQuestionForm">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-plus-circle mr-1"></i> প্রশ্ন ব্যাংকে নতুন প্রশ্ন তৈরি করুন
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <!-- Question Type Selection -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-xs text-dark">প্রশ্নের ধরন (Question Type) <span class="text-danger">*</span></label>
                                <select name="question_type" id="create_question_type" class="form-control font-weight-bold" onchange="toggleQuestionTypeFields('create')" required>
                                    <option value="mcq_single">MCQ — বহুনির্বাচনি (একক নির্বাচন)</option>
                                    <option value="mcq_multi">MCQ — বহুপদী সমাপ্তিসূচক (Multiple Select)</option>
                                    <option value="true_false">সত্য / মিথ্যা (True/False)</option>
                                    <option value="fill_blanks">শূন্যস্থান পূরণ (Fill in the Blanks)</option>
                                    <option value="short_answer">অতি সংক্ষেপে উত্তর (Very Short Question)</option>
                                    <option value="creative">সৃজনশীল প্রশ্ন (Creative CQ with subquestions)</option>
                                    <option value="translation">ইংরেজি অনুবাদ (Translate into English)</option>
                                    <option value="descriptive">রচনামূলক / বর্ণনামূলক (Descriptive)</option>
                                    <option value="matching">বাম-ডান মিলকরণ (Matching Pairs)</option>
                                </select>
                            </div>

                            <!-- Course Selection -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-xs">কোর্স / বিষয় (ঐচ্ছিক):</label>
                                <select name="course_id" class="form-control">
                                    <option value="">-- সাধারণ প্রশ্ন ব্যাংক (General Bank) --</option>
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Stimulus (Optional Context) -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-xs">উদ্দীপক / অনুচ্ছেদ (ঐচ্ছিক):</label>
                            <textarea name="stimulus" class="form-control" rows="2" placeholder="যদি কোনো উদ্দীপক বা অনুচ্ছেদ থাকে তা এখানে লিখুন..."></textarea>
                        </div>

                        <!-- Main Question Prompt -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-xs text-dark">মূল প্রশ্ন / বিবরণ (Question Text) <span class="text-danger">*</span></label>
                            <textarea name="question_text" class="form-control font-weight-bold" rows="2" placeholder="প্রশ্ন লিখুন... (যেমন: মেমরির একক হচ্ছে ........... ।)" required></textarea>
                        </div>

                        <!-- TYPE FIELD A: MCQ Options Block -->
                        <div id="create_mcq_fields_block" class="p-3 bg-light rounded border mb-3">
                            <label class="font-weight-bold text-xs text-dark mb-2">
                                বিকল্প অপশনসমূহ ও সঠিক উত্তর নির্ধারণ: <span class="text-danger">*</span>
                            </label>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="correct_option" value="0" checked>
                                                <span class="ml-1 font-weight-bold">ক</span>
                                            </div>
                                        </div>
                                        <input type="text" name="options[0]" class="form-control" placeholder="অপশন ১...">
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
                                        <input type="text" name="options[1]" class="form-control" placeholder="অপশন ২...">
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

                        <!-- TYPE FIELD B: True / False Toggle Block -->
                        <div id="create_tf_fields_block" class="p-3 bg-light rounded border mb-3" style="display: none;">
                            <label class="font-weight-bold text-xs text-dark mb-2">বিবৃতিটি সত্য নাকি মিথ্যা নির্বাচন করুন: <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center gap-4">
                                <div class="custom-control custom-radio mr-4">
                                    <input type="radio" id="create_tf_true" name="tf_correct" value="true" class="custom-control-input" checked>
                                    <label class="custom-control-label font-weight-bold text-success" for="create_tf_true">
                                        <i class="fas fa-check-circle mr-1"></i> সত্য (True / স)
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="create_tf_false" name="tf_correct" value="false" class="custom-control-input">
                                    <label class="custom-control-label font-weight-bold text-danger" for="create_tf_false">
                                        <i class="fas fa-times-circle mr-1"></i> মিথ্যা (False / মি)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- TYPE FIELD C: Fill in the Blanks / Short Answer Answer Block -->
                        <div id="create_text_answer_block" class="p-3 bg-light rounded border mb-3" style="display: none;">
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-xs text-dark" id="create_answer_label">সঠিক উত্তর / প্রত্যাশিত শব্দ:</label>
                                <input type="text" name="correct_answer_text" id="create_correct_answer_input" class="form-control" placeholder="যেমন: বাইট (একাধিক বিকল্প থাকলে কমা দিয়ে লিখুন: Byte, বাইট)">
                            </div>
                            <div class="form-group mb-0" id="create_hints_group">
                                <label class="font-weight-bold text-xs text-muted">ক্লু বা অপশন ব্র্যাকেট (ঐচ্ছিক):</label>
                                <input type="text" name="hints" class="form-control form-control-sm" placeholder="যেমন: (am/is/are) বা (on/at/in)">
                            </div>
                        </div>

                        <!-- TYPE FIELD D: Creative (CQ) Subquestions Block -->
                        <div id="create_cq_fields_block" class="p-3 bg-light rounded border mb-3" style="display: none;">
                            <label class="font-weight-bold text-xs text-dark mb-2">সৃজনশীল উপ-প্রশ্নাবলি ও নম্বর বণ্টন:</label>
                            <div class="space-y-2">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"><span class="input-group-text font-weight-bold">ক (১ নম্বর)</span></div>
                                    <input type="hidden" name="cq_subquestions[0][label]" value="ক">
                                    <input type="hidden" name="cq_subquestions[0][marks]" value="1">
                                    <input type="text" name="cq_subquestions[0][text]" class="form-control" placeholder="জ্ঞানমূলক প্রশ্ন...">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"><span class="input-group-text font-weight-bold">খ (২ নম্বর)</span></div>
                                    <input type="hidden" name="cq_subquestions[1][label]" value="খ">
                                    <input type="hidden" name="cq_subquestions[1][marks]" value="2">
                                    <input type="text" name="cq_subquestions[1][text]" class="form-control" placeholder="অনুধাবনমূলক প্রশ্ন...">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"><span class="input-group-text font-weight-bold">গ (৩ নম্বর)</span></div>
                                    <input type="hidden" name="cq_subquestions[2][label]" value="গ">
                                    <input type="hidden" name="cq_subquestions[2][marks]" value="3">
                                    <input type="text" name="cq_subquestions[2][text]" class="form-control" placeholder="প্রয়োগমূলক প্রশ্ন...">
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend"><span class="input-group-text font-weight-bold">ঘ (৪ নম্বর)</span></div>
                                    <input type="hidden" name="cq_subquestions[3][label]" value="ঘ">
                                    <input type="hidden" name="cq_subquestions[3][marks]" value="4">
                                    <input type="text" name="cq_subquestions[3][text]" class="form-control" placeholder="উচ্চতর দক্ষতামূলক প্রশ্ন...">
                                </div>
                            </div>
                        </div>

                        <!-- Meta Attributes: Marks, Difficulty, Category, Chapter -->
                        <div class="row mt-2">
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">পূর্ণমান: <span class="text-danger">*</span></label>
                                <input type="number" step="0.25" name="marks" id="create_marks_input" class="form-control" value="1.0" required>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">নেগেটিভ মার্ক:</label>
                                <input type="number" step="0.05" name="negative_marks" class="form-control" value="0.00">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">ক্যাটাগরি:</label>
                                <input type="text" name="category" class="form-control" placeholder="যেমন: কম্পিউটার অফিস অ্যাপ্লিকেশন" list="qbCategoryDatalist">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="font-weight-bold text-xs">অধ্যায় / পাঠ:</label>
                                <input type="text" name="chapter" class="form-control" placeholder="যেমন: ১ম অধ্যায়" list="qbChapterDatalist">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="font-weight-bold text-xs">কঠিন্যতা (Difficulty):</label>
                                <select name="difficulty" class="form-control">
                                    <option value="easy">সহজ (Easy)</option>
                                    <option value="medium" selected>মাঝারি (Medium)</option>
                                    <option value="hard">কঠিন (Hard)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="font-weight-bold text-xs">সোর্স / বোর্ড রেফারেন্স:</label>
                                <input type="text" name="source_reference" class="form-control" placeholder="যেমন: BTEB 2026 অফিস অ্যাপ্লিকেশন">
                            </div>
                        </div>

                        <!-- Concept-Based Explanation & Learning System -->
                        <div class="card border border-info mt-3 shadow-none bg-white">
                            <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold text-dark text-xs">
                                    <i class="fas fa-graduation-cap text-info mr-1"></i> কনসেপ্টভিত্তিক শিখন ও বাংলা ব্যাখ্যা (Concept-Based Learning System)
                                </span>
                                <span class="badge badge-success">বাংলা বাধ্যতামূলক</span>
                            </div>
                            <div class="card-body p-3">
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">মূল কনসেপ্ট / শিখন শিরোনাম (Concept Title):</label>
                                    <input type="text" name="concept_title" class="form-control form-control-sm" placeholder="যেমন: কম্পিউটার মেমোরি ও প্রকারভেদ (RAM vs ROM)">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">সঠিক উত্তর ও মূল যুক্তি (Direct Answer & Reason):</label>
                                    <textarea name="explanation" class="form-control form-control-sm" rows="2" placeholder="কেন এই উত্তরটি সঠিক..."></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">মূল কনসেপ্ট ও বিশদ শিখন (Conceptual Understanding):</label>
                                    <textarea name="concept_explanation" class="form-control form-control-sm" rows="3" placeholder="সম্পূর্ণ কনসেপ্ট বাংলায় সহজভাবে বুঝিয়ে লিখুন, সাথে ইংরেজি টার্ম ব্র্যাকেটে দিন..."></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">অন্যান্য অপশনগুলো কেন ভুল ও প্রয়োগ (MCQ-এর ক্ষেত্রে):</label>
                                    <textarea name="why_other_options_wrong" class="form-control form-control-sm" rows="2" placeholder="ভুল অপশনগুলো কেন প্রযোজ্য নয় এবং কোন পরিস্থিতিতে সঠিক হতে পারত..."></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="font-weight-bold text-xs">পরীক্ষায় সাধারণ ভুল ও ফাঁদ (Common Mistakes):</label>
                                        <textarea name="common_mistakes" class="form-control form-control-sm" rows="2" placeholder="শিক্ষার্থীরা সাধারণত যেখানে বিভ্রান্ত হয়..."></textarea>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="font-weight-bold text-xs">মনে রাখার সহজ কৌশল / নেমোনিক (Memory Aid):</label>
                                        <textarea name="memory_aid" class="form-control form-control-sm" rows="2" placeholder="শর্টকাট বা বাস্তব জীবনের তুলনা..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-xs">শিক্ষক যাচাইকরণ স্ট্যাটাস (Faculty Verification Status):</label>
                                    <select name="explanation_status" class="form-control form-control-sm">
                                        <option value="verified" selected>যাচাইকৃত (Verified by ICT Faculty)</option>
                                        <option value="pending_review">পর্যালোচনাধীন (Pending Review)</option>
                                        <option value="draft">খসড়া (Draft)</option>
                                    </select>
                                </div>
                            </div>
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

    <!-- Modal 2: Derive Related Question from Existing Question -->
    <div class="modal fade" id="deriveModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <form id="deriveForm" method="POST">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-code-branch mr-1"></i> একই মূল প্রশ্ন থেকে নতুন সম্পর্কিত সংস্করণ তৈরি (Derive Question)
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Source Question Box -->
                        <div class="alert alert-light border border-success p-3 rounded mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="badge badge-secondary" id="derive_source_id_badge">#0</span>
                                <span class="badge badge-info" id="derive_source_type_badge">MCQ</span>
                            </div>
                            <div class="font-weight-bold text-dark" id="derive_source_text"></div>
                        </div>

                        <!-- Target Question Type Selector -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-xs text-dark">নতুন সংস্করণ কোন ধরনে তৈরি করতে চান? <span class="text-danger">*</span></label>
                            <select name="target_type" id="derive_target_type" class="form-control font-weight-bold" onchange="toggleQuestionTypeFields('derive')" required>
                                <option value="true_false">সত্য / মিথ্যা (True/False হিসেবে)</option>
                                <option value="fill_blanks">শূন্যস্থান পূরণ (Fill in the Blanks হিসেবে)</option>
                                <option value="short_answer">অতি সংক্ষেপে উত্তর (Short Question হিসেবে)</option>
                                <option value="mcq_single">MCQ — বহুনির্বাচনি (বিকল্প সংস্করণ)</option>
                                <option value="creative">সৃজনশীল প্রশ্ন (CQ হিসেবে)</option>
                                <option value="translation">ইংরেজি অনুবাদ (Translation হিসেবে)</option>
                                <option value="descriptive">রচনামূলক (Descriptive হিসেবে)</option>
                            </select>
                        </div>

                        <!-- Question Text -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-xs text-dark">নতুন সংস্করণের প্রশ্ন বিবরণ (Question Text) <span class="text-danger">*</span></label>
                            <textarea name="question_text" id="derive_question_text" class="form-control font-weight-bold" rows="2" required></textarea>
                            <small class="text-muted">উদ্বৃত্ত প্রশ্নের ভাষা ও শূন্যস্থান ইচ্ছামত পরিমার্জন করতে পারেন। মূল প্রশ্নের সাথে স্বয়ংক্রিয় সংযোগ সংরক্ষিত থাকবে।</small>
                        </div>

                        <!-- DERIVE TYPE FIELDS -->
                        <div id="derive_tf_fields_block" class="p-3 bg-light rounded border mb-3">
                            <label class="font-weight-bold text-xs text-dark mb-2">বিবৃতিটি সত্য নাকি মিথ্যা নির্বাচন করুন:</label>
                            <div class="d-flex align-items-center gap-4">
                                <div class="custom-control custom-radio mr-4">
                                    <input type="radio" id="derive_tf_true" name="tf_correct" value="true" class="custom-control-input" checked>
                                    <label class="custom-control-label font-weight-bold text-success" for="derive_tf_true">সত্য (True / স)</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="derive_tf_false" name="tf_correct" value="false" class="custom-control-input">
                                    <label class="custom-control-label font-weight-bold text-danger" for="derive_tf_false">মিথ্যা (False / মি)</label>
                                </div>
                            </div>
                        </div>

                        <div id="derive_text_answer_block" class="p-3 bg-light rounded border mb-3" style="display: none;">
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-xs text-dark">সঠিক উত্তর / প্রত্যাশিত শব্দ:</label>
                                <input type="text" name="correct_answer_text" id="derive_correct_answer" class="form-control" placeholder="যেমন: গণনাকারী">
                            </div>
                            <div class="form-group mb-0">
                                <label class="font-weight-bold text-xs text-muted">ক্লু বা অপশন ব্র্যাকেট (ঐচ্ছিক):</label>
                                <input type="text" name="hints" id="derive_hints" class="form-control form-control-sm" placeholder="যেমন: (am/is/are)">
                            </div>
                        </div>

                        <div id="derive_mcq_fields_block" class="p-3 bg-light rounded border mb-3" style="display: none;">
                            <label class="font-weight-bold text-xs text-dark mb-2">বিকল্প অপশনসমূহ ও সঠিক উত্তর:</label>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="correct_option" value="0" checked><span class="ml-1 font-weight-bold">ক</span></div></div>
                                        <input type="text" name="options[0]" class="form-control" placeholder="অপশন ১...">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="correct_option" value="1"><span class="ml-1 font-weight-bold">খ</span></div></div>
                                        <input type="text" name="options[1]" class="form-control" placeholder="অপশন ২...">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="correct_option" value="2"><span class="ml-1 font-weight-bold">গ</span></div></div>
                                        <input type="text" name="options[2]" class="form-control" placeholder="অপশন ৩...">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="correct_option" value="3"><span class="ml-1 font-weight-bold">ঘ</span></div></div>
                                        <input type="text" name="options[3]" class="form-control" placeholder="অপশন ৪...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-xs">পূর্ণমান: <span class="text-danger">*</span></label>
                                <input type="number" step="0.25" name="marks" id="derive_marks" class="form-control" value="1.0" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-xs">নেগেটিভ মার্ক:</label>
                                <input type="number" step="0.05" name="negative_marks" class="form-control" value="0.00">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="font-weight-bold text-xs">কঠিন্যতা:</label>
                                <select name="difficulty" class="form-control">
                                    <option value="easy">সহজ (Easy)</option>
                                    <option value="medium" selected>মাঝারি (Medium)</option>
                                    <option value="hard">কঠিন (Hard)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Inherited / Customized Concept-Based Explanation for Derived Question -->
                        <div class="card border border-success mt-2 mb-0 shadow-none bg-white">
                            <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold text-dark text-xs">
                                    <i class="fas fa-graduation-cap text-success mr-1"></i> মূল কনসেপ্ট ও শিখন (স্বয়ংক্রিয়ভাবে মূল প্রশ্ন থেকে ইনহেরিট হবে)
                                </span>
                                <span class="badge badge-success text-xs">Shared Concept</span>
                            </div>
                            <div class="card-body p-3">
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">মূল কনসেপ্ট শিরোনাম (Concept Title):</label>
                                    <input type="text" name="concept_title" id="derive_concept_title" class="form-control form-control-sm" placeholder="স্বয়ংক্রিয়ভাবে মূল কনসেপ্টের সাথে লিঙ্ক থাকবে">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">সঠিক উত্তরের যুক্তি ও ব্যাখ্যা:</label>
                                    <textarea name="explanation" id="derive_explanation" class="form-control form-control-sm" rows="2" placeholder="এই নতুন সংস্করণের জন্য নির্দিষ্ট ব্যাখ্যা..."></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-xs">মূল কনসেপ্ট বিশদ ব্যাখ্যা (ঐচ্ছিক - ফাঁকা রাখলে মূল প্রশ্ন থেকে সরাসরি পাবে):</label>
                                    <textarea name="concept_explanation" id="derive_concept_explanation" class="form-control form-control-sm" rows="2" placeholder="বিশেষ কোনো পরিবর্তন থাকলে এখানে লিখুন..."></textarea>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-success font-weight-bold">
                            <i class="fas fa-check-circle mr-1"></i> সম্পর্কিত প্রশ্ন হিসেবে তৈরি ও লিংক করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal 3: Related Questions Visual Tree & Variations -->
    <div class="modal fade" id="relatedModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-sitemap text-primary mr-2"></i> সম্পর্কিত সকল সংস্করণ (Related Question Family)
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="relatedModalBody">
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                        <p class="text-muted mt-2">লোড হচ্ছে...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4: Edit Question Modal -->
    <div class="modal fade" id="editQuestionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <form id="editQuestionForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-edit mr-1"></i> প্রশ্ন সম্পাদনা করুন (#<span id="edit_modal_id">0</span>)
                        </h5>
                        <button type="button" class="close text-dark" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4" id="editModalBody">
                        <div class="text-center py-4">
                            <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                            <p class="text-muted mt-2">লোড হচ্ছে...</p>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-warning font-weight-bold">
                            <i class="fas fa-save mr-1"></i> হালনাগাদ সংরক্ষণ করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal 5: Quick Add to Paper Modal -->
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

    <!-- Modal 6: Detail Preview Modal -->
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

    <!-- Modal 7: Excel Import -->
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
                        <div class="alert alert-light border border-success/30 p-3 mb-4 rounded shadow-sm">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="pr-2">
                                    <h6 class="font-weight-bold text-success mb-1">
                                        <i class="fas fa-info-circle mr-1"></i> এক্সেল কলামের নিয়মাবলী:
                                    </h6>
                                    <p class="text-xs text-muted mb-0">
                                        এক্সেল শিটে <code>question_text</code>, <code>option_a</code>, <code>option_b</code>, <code>option_c</code>, <code>option_d</code>, <code>correct_option</code> (A/B/C/D), <code>marks</code> ও <code>explanation</code> কলাম থাকতে হবে।
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

                        <!-- Library Defaults Block -->
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
                                        <input type="text" name="default_category" class="form-control form-control-sm" placeholder="যেমন: ICT, Bangla, English">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold text-xs">ডিফল্ট অধ্যায় / পাঠ</label>
                                        <input type="text" name="default_chapter" class="form-control form-control-sm" placeholder="যেমন: Chapter 1: Information Technology">
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

                        <!-- Existing Quiz Block -->
                        <div id="qbExistingQuizBlock" class="form-group" style="display: none;">
                            <label class="font-weight-bold text-sm">টার্গেট কুইজ নির্বাচন করুন <span class="text-danger">*</span></label>
                            <select name="quiz_id" id="qbTargetQuizSelect" class="form-control">
                                <option value="">-- কুইজ নির্বাচন করুন --</option>
                                @if(isset($quizzes))
                                    @foreach($quizzes as $qz)
                                        <option value="{{ $qz->id }}">
                                            {{ $qz->title }} ({{ $qz->course ? $qz->course->course_title : 'General' }} — {{ $qz->questions_count }}টি প্রশ্ন)
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- New Quiz Block -->
                        <div id="qbNewQuizBlock" class="p-3 border rounded bg-light mb-3" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">কোর্স নির্বাচন করুন <span class="text-danger">*</span></label>
                                        <select name="course_id" id="qbNewQuizCourseId" class="form-control form-control-sm">
                                            @foreach($courses as $c)
                                                <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">নতুন কুইজের শিরোনাম</label>
                                        <input type="text" name="new_quiz_title" class="form-control form-control-sm" placeholder="যেমন: ICT Model Test 2026">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File Input -->
                        <div class="form-group mb-0">
                            <label class="font-weight-bold text-sm text-dark">এক্সেল বা সিএসভি ফাইল আপলোড করুন (.xlsx, .xls, .csv) <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" name="excel_file" class="custom-file-input" id="qbExcelFile" accept=".xlsx,.xls,.csv" required onchange="updateQbFileName(this)">
                                <label class="custom-file-label" for="qbExcelFile" id="qbExcelFileLabel">ফাইল বেছে নিন (.xlsx বা .csv)</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-success font-weight-bold">
                            <i class="fas fa-upload mr-1"></i> প্রশ্ন আপলোড শুরু করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Datalists for categories and chapters -->
    <datalist id="qbCategoryDatalist">
        @foreach($categories as $cat)
            <option value="{{ $cat }}">
        @endforeach
    </datalist>
    <datalist id="qbChapterDatalist">
        @foreach($chapters as $chap)
            <option value="{{ $chap }}">
        @endforeach
    </datalist>

    <script>
        // Checkbox management for Bulk Actions
        document.addEventListener('DOMContentLoaded', function () {
            var selectAll = document.getElementById('selectAllCheckbox');
            var checkboxes = document.querySelectorAll('.question-checkbox');
            var countBadge = document.getElementById('selectedCountBadge');
            var bulkSubmit = document.getElementById('bulkSubmitBtn');
            var bulkActionSelect = document.getElementById('bulkActionSelect');
            var targetPaperWrapper = document.getElementById('targetPaperWrapper');
            var bulkCategoryWrapper = document.getElementById('bulkCategoryWrapper');

            function updateBulkCount() {
                var checked = document.querySelectorAll('.question-checkbox:checked').length;
                if (countBadge) countBadge.textContent = checked + 'টি নির্বাচিত';
                if (bulkSubmit) bulkSubmit.disabled = (checked === 0 || !bulkActionSelect.value);
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

        // Dynamic Form Field Switcher for Question Types
        function toggleQuestionTypeFields(prefix) {
            var typeSelect = document.getElementById(prefix + '_question_type') || document.getElementById(prefix + '_target_type');
            if (!typeSelect) return;
            var val = typeSelect.value;

            var mcqBlock = document.getElementById(prefix + '_mcq_fields_block');
            var tfBlock = document.getElementById(prefix + '_tf_fields_block');
            var textBlock = document.getElementById(prefix + '_text_answer_block');
            var cqBlock = document.getElementById(prefix + '_cq_fields_block');
            var marksInput = document.getElementById(prefix + '_marks_input') || document.getElementById(prefix + '_marks');

            if (mcqBlock) mcqBlock.style.display = 'none';
            if (tfBlock) tfBlock.style.display = 'none';
            if (textBlock) textBlock.style.display = 'none';
            if (cqBlock) cqBlock.style.display = 'none';

            if (val === 'mcq_single' || val === 'mcq_multi') {
                if (mcqBlock) mcqBlock.style.display = 'block';
                if (marksInput) marksInput.value = '1.0';
            } else if (val === 'true_false') {
                if (tfBlock) tfBlock.style.display = 'block';
                if (marksInput) marksInput.value = '1.0';
            } else if (val === 'fill_blanks') {
                if (textBlock) textBlock.style.display = 'block';
                var lbl = document.getElementById(prefix + '_answer_label');
                if (lbl) lbl.textContent = 'সঠিক শূন্যস্থানের শব্দ (বিকল্প থাকলে কমা দিয়ে লিখুন):';
                if (marksInput) marksInput.value = '1.0';
            } else if (val === 'creative') {
                if (cqBlock) cqBlock.style.display = 'block';
                if (marksInput) marksInput.value = '10.0';
            } else if (val === 'short_answer' || val === 'translation') {
                if (textBlock) textBlock.style.display = 'block';
                var lbl = document.getElementById(prefix + '_answer_label');
                if (lbl) lbl.textContent = val === 'translation' ? 'প্রত্যাশিত ইংরেজি অনুবাদ:' : 'সংক্ষিপ্ত সঠিক উত্তর / গাইডলাইন:';
                if (marksInput) marksInput.value = val === 'translation' ? '1.0' : '1.0';
            } else if (val === 'descriptive') {
                if (textBlock) textBlock.style.display = 'block';
                var lbl = document.getElementById(prefix + '_answer_label');
                if (lbl) lbl.textContent = 'মডেল উত্তর / মূল্যায়ন গাইডলাইন:';
                if (marksInput) marksInput.value = '5.0';
            }
        }

        // Open Derive Modal
        function openDeriveModal(questionId) {
            fetch('/admin/question-book/' + questionId + '/preview')
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    if (res.success) {
                        var q = res.question;
                        document.getElementById('derive_source_id_badge').textContent = '#' + q.id;
                        document.getElementById('derive_source_type_badge').textContent = q.type_label;
                        document.getElementById('derive_source_text').textContent = q.question_text;
                        document.getElementById('derive_question_text').value = q.question_text;
                        document.getElementById('derive_concept_title').value = q.concept_title || '';
                        document.getElementById('derive_explanation').value = q.explanation || '';
                        document.getElementById('derive_concept_explanation').value = q.concept_explanation || '';
                        document.getElementById('deriveForm').action = '/admin/question-book/' + q.id + '/derive';
                        toggleQuestionTypeFields('derive');
                        $('#deriveModal').modal('show');
                    }
                });
        }

        // Open Related Questions Visual Modal
        function openRelatedModal(questionId) {
            $('#relatedModal').modal('show');
            var body = document.getElementById('relatedModalBody');
            body.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i><p class="text-muted mt-2">লোড হচ্ছে...</p></div>';

            fetch('/admin/question-book/' + questionId + '/related')
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    if (res.success) {
                        var root = res.root_question;
                        var variants = res.variants;

                        var html = `
                            <div class="p-3 bg-light rounded border border-primary mb-3">
                                <div class="text-xs text-primary font-weight-bold text-uppercase mb-1"><i class="fas fa-star mr-1"></i> মূল ধারণা / ভিত্তি প্রশ্ন (#${root.id})</div>
                                <div class="font-weight-bold text-dark h6 mb-1">${root.question_text}</div>
                                <div class="text-xs text-muted">ধরন: <strong>${root.question_type}</strong> | পূর্ণমান: <strong>${root.marks}</strong></div>
                            </div>
                            <h6 class="font-weight-bold text-dark mb-2"><i class="fas fa-code-branch text-success mr-1"></i> সম্পর্কিত সকল রূপ ও সংস্করণ (${variants.length}টি):</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-sm">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#ID</th>
                                            <th>ধরন</th>
                                            <th>প্রশ্নের টেক্সট</th>
                                            <th>সঠিক উত্তর</th>
                                            <th>মান</th>
                                            <th>অ্যাকশন</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        `;

                        variants.forEach(function(v) {
                            var rowCls = v.is_current ? 'table-warning font-weight-bold' : '';
                            var rootBadge = v.is_root ? '<span class="badge badge-primary mr-1">Root</span>' : '';
                            html += `
                                <tr class="${rowCls}">
                                    <td>${rootBadge}#${v.id}</td>
                                    <td><span class="badge badge-info">${v.question_type}</span></td>
                                    <td>${v.question_text}</td>
                                    <td class="text-success">${v.correct_answer || 'N/A'}</td>
                                    <td class="text-center">${v.marks}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-outline-primary" onclick="openPreviewModal(${v.id})"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-xs btn-outline-success" onclick="quickAddToPaper(${v.id})"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
                            `;
                        });

                        html += `
                                    </tbody>
                                </table>
                            </div>
                        `;

                        body.innerHTML = html;
                    } else {
                        body.innerHTML = '<div class="alert alert-danger">সম্পর্কিত প্রশ্ন লোড করা যায়নি।</div>';
                    }
                });
        }

        // Open Edit Modal
        function openEditModal(questionId) {
            $('#editQuestionModal').modal('show');
            document.getElementById('edit_modal_id').textContent = questionId;
            var body = document.getElementById('editModalBody');
            body.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-muted"></i><p class="text-muted mt-2">লোড হচ্ছে...</p></div>';

            document.getElementById('editQuestionForm').action = '/admin/question-book/' + questionId;

            fetch('/admin/question-book/' + questionId + '/preview')
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    if (res.success) {
                        var q = res.question;
                        var isMcq = (q.question_type === 'mcq_single' || q.question_type === 'mcq_multi');
                        var isTf = (q.question_type === 'true_false');

                        var optionsInputs = '';
                        if (isMcq && q.options) {
                            optionsInputs += '<div class="row">';
                            q.options.forEach(function(o, idx) {
                                var checked = o.is_correct ? 'checked' : '';
                                optionsInputs += `
                                    <div class="col-md-6 mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="correct_option" value="${idx}" ${checked}><span class="ml-1 font-weight-bold">${o.letter}</span></div></div>
                                            <input type="text" name="options[${idx}]" value="${o.text}" class="form-control" required>
                                        </div>
                                    </div>
                                `;
                            });
                            optionsInputs += '</div>';
                        }

                        var tfHtml = '';
                        if (isTf) {
                            var isTrue = (q.correct_answer_text === 'true');
                            tfHtml = `
                                <div class="form-group p-2 bg-light rounded border">
                                    <label class="font-weight-bold text-xs">সঠিক বিবৃতি:</label>
                                    <div class="d-flex gap-3">
                                        <label class="mr-3"><input type="radio" name="tf_correct" value="true" ${isTrue ? 'checked' : ''}> সত্য (True)</label>
                                        <label><input type="radio" name="tf_correct" value="false" ${!isTrue ? 'checked' : ''}> মিথ্যা (False)</label>
                                    </div>
                                </div>
                            `;
                        }

                        body.innerHTML = `
                            <input type="hidden" name="question_type" value="${q.question_type}">
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-xs">প্রশ্নের ধরন:</label>
                                <input type="text" class="form-control form-control-sm bg-light" value="${q.type_label}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="font-weight-bold text-xs">প্রশ্ন বিবরণ: <span class="text-danger">*</span></label>
                                <textarea name="question_text" class="form-control" rows="2" required>${q.question_text}</textarea>
                            </div>
                            ${optionsInputs}
                            ${tfHtml}
                            ${!isMcq && !isTf ? `
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">সঠিক উত্তর / প্রত্যাশিত শব্দ:</label>
                                    <input type="text" name="correct_answer_text" value="${q.correct_answer_text || ''}" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold text-xs">ক্লু বা হিন্ট:</label>
                                    <input type="text" name="hints" value="${q.hints || ''}" class="form-control form-control-sm">
                                </div>
                            ` : ''}
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="font-weight-bold text-xs">পূর্ণমান:</label>
                                    <input type="number" step="0.25" name="marks" value="${q.marks}" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="font-weight-bold text-xs">ক্যাটাগরি:</label>
                                    <input type="text" name="category" value="${q.category || ''}" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="font-weight-bold text-xs">অধ্যায়:</label>
                                    <input type="text" name="chapter" value="${q.chapter || ''}" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="card border border-info mt-3 shadow-none bg-white">
                                <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold text-dark text-xs">
                                        <i class="fas fa-graduation-cap text-info mr-1"></i> কনসেপ্টভিত্তিক শিখন ও বাংলা ব্যাখ্যা (Concept-Based Learning)
                                    </span>
                                    <span class="badge badge-success">বাংলা বাধ্যতামূলক</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">মূল কনসেপ্ট শিরোনাম (Concept Title):</label>
                                        <input type="text" name="concept_title" value="${q.concept_title || ''}" class="form-control form-control-sm" placeholder="যেমন: কম্পিউটার মেমোরি ও প্রকারভেদ">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">সঠিক উত্তর ও মূল যুক্তি (Direct Answer & Reason):</label>
                                        <textarea name="explanation" class="form-control form-control-sm" rows="2" placeholder="কেন এই উত্তরটি সঠিক...">${q.explanation || ''}</textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">মূল কনসেপ্ট ও বিশদ শিখন (Conceptual Understanding):</label>
                                        <textarea name="concept_explanation" class="form-control form-control-sm" rows="3" placeholder="সম্পূর্ণ কনসেপ্ট বাংলায় সহজভাবে বুঝিয়ে লিখুন, সাথে ইংরেজি টার্ম ব্র্যাকেটে দিন...">${q.concept_explanation || ''}</textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-xs">অন্যান্য অপশনগুলো কেন ভুল ও প্রয়োগ (MCQ-এর ক্ষেত্রে):</label>
                                        <textarea name="why_other_options_wrong" class="form-control form-control-sm" rows="2" placeholder="ভুল অপশনগুলো কেন প্রযোজ্য নয় এবং কোন পরিস্থিতিতে সঠিক হতে পারত...">${q.why_other_options_wrong || ''}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="font-weight-bold text-xs">পরীক্ষায় সাধারণ ভুল ও ফাঁদ (Common Mistakes):</label>
                                            <textarea name="common_mistakes" class="form-control form-control-sm" rows="2">${q.common_mistakes || ''}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="font-weight-bold text-xs">মনে রাখার সহজ কৌশল / নেমোনিক (Memory Aid):</label>
                                            <textarea name="memory_aid" class="form-control form-control-sm" rows="2">${q.memory_aid || ''}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold text-xs">শিক্ষক অনুমোদন স্ট্যাটাস:</label>
                                        <select name="explanation_status" class="form-control form-control-sm">
                                            <option value="verified" ${q.explanation_status === 'verified' ? 'selected' : ''}>যাচাইকৃত (Verified by ICT Faculty)</option>
                                            <option value="pending_review" ${q.explanation_status === 'pending_review' ? 'selected' : ''}>পর্যালোচনাধীন (Pending Review)</option>
                                            <option value="draft" ${q.explanation_status === 'draft' ? 'selected' : ''}>খসড়া (Draft)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                });
        }

        // Detail Preview Modal AJAX
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

                        var ansTextHtml = q.correct_answer_text ? `
                            <div class="mt-2 p-2.5 bg-light-success border border-success rounded text-sm text-success font-weight-bold">
                                <i class="fas fa-check-circle mr-1"></i> সঠিক উত্তর: ${q.correct_answer_text}
                            </div>
                        ` : '';

                        var hintsHtml = q.hints ? `
                            <div class="mt-1 text-xs text-muted"><strong>ক্লু / ব্র্যাকেট:</strong> <code>${q.hints}</code></div>
                        ` : '';

                        var cqHtml = '';
                        if (q.cq_subquestions && q.cq_subquestions.length > 0) {
                            cqHtml += '<div class="mt-3 p-3 bg-light rounded border"><h6 class="font-weight-bold text-dark mb-2">সৃজনশীল উপ-প্রশ্নাবলি:</h6><ul class="pl-3 mb-0 text-sm">';
                            q.cq_subquestions.forEach(function(sub) {
                                cqHtml += `<li><strong>${sub.label || 'উপ'}:</strong> ${sub.text || ''} <span class="badge badge-secondary ml-1">[${sub.marks || 1} নম্বর]</span></li>`;
                            });
                            cqHtml += '</ul></div>';
                        }

                        var relHtml = '';
                        if (q.is_derived) {
                            relHtml = `<div class="badge badge-info p-1.5 mb-2"><i class="fas fa-link mr-1"></i> মূল প্রশ্ন #${q.parent_question_id} (${q.parent_title || ''}) থেকে তৈরি</div>`;
                        } else if (q.derived_count > 0) {
                            relHtml = `<div class="badge badge-primary p-1.5 mb-2"><i class="fas fa-sitemap mr-1"></i> এই মূল প্রশ্নের ${q.derived_count}টি সম্পর্কিত সংস্করণ প্রশ্ন ব্যাংকে রয়েছে</div>`;
                        }

                        var stimHtml = q.stimulus ? '<div class="alert alert-light border p-2 mb-3"><strong>উদ্দীপক:</strong> ' + q.stimulus + '</div>' : '';

                        // Rich Educational Concept Card Preview
                        var eduHtml = '';
                        if (q.has_educational_explanation) {
                            var conceptTitle = q.concept_title ? `<h6 class="font-weight-bold text-dark mb-0"><i class="fas fa-lightbulb text-warning mr-1"></i> ${q.concept_title}</h6>` : '';
                            var statusBadge = q.explanation_status_badge || '<span class="badge badge-success">যাচাইকৃত</span>';
                            
                            var directExp = q.explanation ? `
                                <div class="p-2.5 bg-white border rounded mb-2">
                                    <div class="text-xs font-weight-bold text-success mb-1"><i class="fas fa-check-circle mr-1"></i> সঠিক উত্তরের ব্যাখ্যা ও যুক্তি:</div>
                                    <div class="text-xs text-dark">${q.explanation.replace(/\\n/g, '<br>')}</div>
                                </div>
                            ` : '';

                            var conceptExp = q.concept_explanation ? `
                                <div class="p-2.5 bg-light-info border border-info rounded mb-2">
                                    <div class="text-xs font-weight-bold text-primary mb-1"><i class="fas fa-book-reader mr-1"></i> মূল কনসেপ্ট ও বিশদ শিখন:</div>
                                    <div class="text-xs text-dark">${q.concept_explanation.replace(/\\n/g, '<br>')}</div>
                                </div>
                            ` : '';

                            var wrongExp = q.why_other_options_wrong ? `
                                <div class="p-2.5 bg-light border border-danger rounded mb-2">
                                    <div class="text-xs font-weight-bold text-danger mb-1"><i class="fas fa-times-circle mr-1"></i> অন্যান্য অপশন কেন ভুল:</div>
                                    <div class="text-xs text-dark">${q.why_other_options_wrong.replace(/\\n/g, '<br>')}</div>
                                </div>
                            ` : '';

                            var rulesExp = q.important_rules ? `
                                <div class="p-2.5 bg-light border border-warning rounded mb-2">
                                    <div class="text-xs font-weight-bold text-warning mb-1"><i class="fas fa-star mr-1"></i> গুরুত্বপূর্ণ নিয়ম ও সূত্র:</div>
                                    <div class="text-xs text-dark">${q.important_rules.replace(/\\n/g, '<br>')}</div>
                                </div>
                            ` : '';

                            var mistakesExp = q.common_mistakes ? `
                                <div class="p-2.5 bg-light-warning border border-warning rounded mb-2">
                                    <div class="text-xs font-weight-bold text-dark mb-1"><i class="fas fa-exclamation-triangle text-warning mr-1"></i> সাধারণ ভুল ও ফাঁদ:</div>
                                    <div class="text-xs text-dark">${q.common_mistakes.replace(/\\n/g, '<br>')}</div>
                                </div>
                            ` : '';

                            var memoryExp = q.memory_aid ? `
                                <div class="p-2.5 bg-light border border-secondary rounded mb-2">
                                    <div class="text-xs font-weight-bold text-dark mb-1"><i class="fas fa-magic text-purple mr-1"></i> মনে রাখার কৌশল (Mnemonic):</div>
                                    <div class="text-xs text-dark">${q.memory_aid.replace(/\\n/g, '<br>')}</div>
                                </div>
                            ` : '';

                            var relQsHtml = '';
                            if (q.related_concept_questions && q.related_concept_questions.length > 0) {
                                relQsHtml = '<div class="p-2.5 bg-light border rounded mt-2"><div class="text-xs font-weight-bold text-dark mb-1.5"><i class="fas fa-random text-success mr-1"></i> একই কনসেপ্টের অন্যান্য প্রশ্ন ও অনুশীলন (' + q.related_concept_questions.length + 'টি):</div><div class="list-group list-group-flush">';
                                q.related_concept_questions.forEach(function(rq) {
                                    relQsHtml += `
                                        <div class="list-group-item bg-white px-2 py-1.5 mb-1 rounded border d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge badge-secondary mr-1">${rq.question_type}</span>
                                                <span class="text-xs text-dark font-weight-bold">${rq.question_text.substring(0, 75)}...</span>
                                                <div class="text-xs text-success ml-1">উত্তর: ${rq.correct_answer}</div>
                                            </div>
                                            <span class="badge badge-light border">#${rq.id}</span>
                                        </div>
                                    `;
                                });
                                relQsHtml += '</div></div>';
                            }

                            eduHtml = `
                                <div class="card border border-info mt-3 shadow-none">
                                    <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                                        <span class="text-xs font-weight-bold text-info"><i class="fas fa-graduation-cap mr-1"></i> কনসেপ্টভিত্তিক শিখন ও বাংলা বিশ্লেষণ</span>
                                        ${statusBadge}
                                    </div>
                                    <div class="card-body p-3">
                                        ${conceptTitle}
                                        <div class="mt-2">
                                            ${directExp}
                                            ${conceptExp}
                                            ${wrongExp}
                                            ${rulesExp}
                                            ${mistakesExp}
                                            ${memoryExp}
                                            ${relQsHtml}
                                        </div>
                                    </div>
                                </div>
                            `;
                        }

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
                            ${relHtml}
                            ${stimHtml}
                            <h5 class="font-weight-bold mb-3">${q.question_text}</h5>
                            ${optHtml}
                            ${ansTextHtml}
                            ${hintsHtml}
                            ${cqHtml}
                            ${eduHtml}
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
