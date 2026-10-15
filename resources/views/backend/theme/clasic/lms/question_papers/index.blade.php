@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Question Paper Management — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_question_paper_active', 'active')

@section('maincontant')
    <!-- Content Header -->
    <div class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.5rem;">
                        <i class="fas fa-layer-group text-warning mr-2"></i> প্রশ্নপত্র ব্যবস্থাপনা ও ড্র্যাগ-অ্যান্ড-ড্রপ বিল্ডার
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        বোর্ড পরীক্ষার আদলে ডিজিটাল প্রশ্নপত্র তৈরি করুন, ড্র্যাগ-অ্যান্ড-ড্রপ করে প্রশ্ন সাজান, প্রিন্ট/পিডিএফ ডাউনলোড করুন অথবা সরাসরি অনলাইন কুইজ হিসেবে প্রকাশ করুন।
                    </p>
                </div>
                <div class="col-sm-5 text-sm-right mt-2 mt-sm-0">
                    <a href="{{ route('admin.question-book.index') }}" class="btn btn-outline-primary shadow-sm mr-1">
                        <i class="fas fa-book-open mr-1"></i> প্রশ্ন লাইব্রেরি
                    </a>
                    <button type="button" class="btn btn-warning shadow-sm font-weight-bold text-dark" data-toggle="modal" data-target="#createPaperModal">
                        <i class="fas fa-plus-circle mr-1"></i> নতুন প্রশ্নপত্র তৈরি করুন
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

    <!-- Paper Stats -->
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-info text-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-white-50">মোট প্রশ্নপত্র</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['total']) }} টি</div>
                    </div>
                    <i class="fas fa-file-alt fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-success text-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-white-50">প্রকাশিত (Published)</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['published']) }} টি</div>
                    </div>
                    <i class="fas fa-globe fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-primary text-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-white-50">অনুমোদিত (Approved)</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['approved']) }} টি</div>
                    </div>
                    <i class="fas fa-check-double fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 mb-3 bg-gradient-secondary text-white">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-white-50">ড্রাফট (Draft)</div>
                        <div class="h3 font-weight-bold mb-0">{{ \App\model\LmsQuiz::toBengaliNumber($stats['draft']) }} টি</div>
                    </div>
                    <i class="fas fa-pencil-ruler fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card shadow-sm mb-3">
        <div class="card-body p-3">
            <form action="{{ route('admin.question-papers.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="শিরোনাম, কোড বা পরীক্ষার নাম খুঁজুন...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <select name="course_id" class="form-control custom-select" onchange="this.form.submit()">
                            <option value="">-- সকল কোর্স --</option>
                            @foreach($courses as $c)
                                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->course_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-6 mb-2">
                        <select name="status" class="form-control custom-select" onchange="this.form.submit()">
                            <option value="">-- স্ট্যাটাস --</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>ড্রাফট</option>
                            <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>পর্যালোচনাধীন</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>অনুমোদিত</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>প্রকাশিত</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-6 mb-2">
                        <select name="paper_set" class="form-control custom-select" onchange="this.form.submit()">
                            <option value="">-- সেট --</option>
                            <option value="Set A" {{ request('paper_set') == 'Set A' ? 'selected' : '' }}>Set A (ক-সেট)</option>
                            <option value="Set B" {{ request('paper_set') == 'Set B' ? 'selected' : '' }}>Set B (খ-সেট)</option>
                            <option value="Set C" {{ request('paper_set') == 'Set C' ? 'selected' : '' }}>Set C (গ-সেট)</option>
                            <option value="Set D" {{ request('paper_set') == 'Set D' ? 'selected' : '' }}>Set D (ঘ-সেট)</option>
                        </select>
                    </div>
                    <div class="col-md-1 col-6 mb-2 text-right">
                        @if(request()->anyFilled(['search', 'course_id', 'status', 'paper_set']))
                            <a href="{{ route('admin.question-papers.index') }}" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Paper Cards Table -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 text-sm align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 140px;">কোড ও সেট</th>
                        <th>প্রশ্নপত্রের শিরোনাম ও বিষয়</th>
                        <th style="width: 120px;" class="text-center">সময় ও পূর্ণমান</th>
                        <th style="width: 110px;" class="text-center">মোট প্রশ্ন</th>
                        <th style="width: 110px;" class="text-center">স্ট্যাটাস</th>
                        <th style="width: 250px;" class="text-center">অ্যাকশন ও আউটপুট</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($papers as $p)
                        <tr>
                            <td>
                                <div class="font-weight-bold text-dark">{{ $p->paper_code }}</div>
                                <span class="badge badge-warning text-dark font-weight-bold">
                                    {{ \App\model\LmsQuestionPaper::getBengaliSetCode($p->paper_set) }}
                                </span>
                                @if($p->master_paper_id)
                                    <span class="badge badge-info" title="মূল প্রশ্নপত্রের ভেরিয়েন্ট">Variant</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.question-papers.builder', $p->id) }}" class="font-weight-bold text-primary text-base d-block mb-1">
                                    {{ $p->title }}
                                </a>
                                <div class="text-xs text-muted">
                                    <i class="fas fa-graduation-cap text-muted mr-1"></i> {{ $p->subject_name }} (বিষয় কোড: {{ $p->subject_code }})
                                    @if($p->class_level)
                                        | <span class="badge badge-light border">{{ $p->class_level }}</span>
                                    @endif
                                    | <i class="fas fa-calendar-alt text-muted mr-1"></i> শিক্ষাবর্ষ: {{ $p->academic_year }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div><i class="fas fa-clock text-info mr-1"></i> {{ \App\model\LmsQuiz::toBengaliNumber($p->duration_minutes) }} মিনিট</div>
                                <div class="font-weight-bold text-success">{{ \App\model\LmsQuiz::toBengaliNumber($p->total_marks) }} নম্বর</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary px-2.5 py-1 text-sm font-weight-bold">
                                    {{ \App\model\LmsQuiz::toBengaliNumber($p->items->count()) }} টি
                                </span>
                                <div class="text-xs text-muted mt-1">{{ $p->sections->count() }}টি সেকশন</div>
                            </td>
                            <td class="text-center">
                                @if($p->status === 'published')
                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> প্রকাশিত</span>
                                @elseif($p->status === 'approved')
                                    <span class="badge badge-primary px-2 py-1"><i class="fas fa-thumbs-up mr-1"></i> অনুমোদিত</span>
                                @elseif($p->status === 'review')
                                    <span class="badge badge-warning px-2 py-1"><i class="fas fa-eye mr-1"></i> পর্যালোচনা</span>
                                @else
                                    <span class="badge badge-secondary px-2 py-1"><i class="fas fa-pencil-alt mr-1"></i> ড্রাফট</span>
                                @endif

                                @if($p->linked_quiz_id)
                                    <div class="mt-1">
                                        <a href="{{ route('admin.quizzes.index', ['search' => $p->title]) }}" class="badge badge-info text-white" title="অনলাইন কুইজে দেখুন">
                                            <i class="fas fa-link mr-1"></i> কুইজ #{{ $p->linked_quiz_id }}
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm mb-1" role="group">
                                    <a href="{{ route('admin.question-papers.builder', $p->id) }}" class="btn btn-warning font-weight-bold text-dark" title="বিল্ডারে খুলুন">
                                        <i class="fas fa-layer-group mr-1"></i> বিল্ডার
                                    </a>
                                    <a href="{{ route('admin.question-papers.print-board', $p->id) }}" target="_blank" class="btn btn-outline-dark" title="বোর্ড প্রিন্ট প্রিভিউ">
                                        <i class="fas fa-print mr-1"></i> প্রিন্ট
                                    </a>
                                    <a href="{{ route('admin.question-papers.teacher-key', $p->id) }}" target="_blank" class="btn btn-outline-info" title="উত্তরপত্র ও মার্কিং স্কিম">
                                        <i class="fas fa-key mr-1"></i> উত্তরপত্র
                                    </a>
                                </div>
                                <div class="dropdown d-inline-block">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                        আরো
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right shadow-sm">
                                        <!-- Publish Online CTA -->
                                        <form action="{{ route('admin.question-papers.publish-online', $p->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-success font-weight-bold" onclick="return confirm('আপনি কি এই প্রশ্নপত্রটি সরাসরি অনলাইন পরীক্ষা হিসেবে প্রকাশ করতে চান?')">
                                                <i class="fas fa-cloud-upload-alt mr-2"></i> অনলাইন পরীক্ষা হিসেবে প্রকাশ
                                            </button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <!-- Generate Variant Sets -->
                                        <form action="{{ route('admin.question-papers.generate-variants', $p->id) }}" method="POST" class="px-3 py-1">
                                            @csrf
                                            <label class="text-xs font-weight-bold text-muted mb-1">নতুন সেট জেনারেট:</label>
                                            <div class="input-group input-group-sm">
                                                <select name="target_set" class="custom-select custom-select-sm">
                                                    <option value="Set B">Set B (খ-সেট)</option>
                                                    <option value="Set C">Set C (গ-সেট)</option>
                                                    <option value="Set D">Set D (ঘ-সেট)</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm">কপি</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.question-papers.destroy', $p->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('আপনি কি নিশ্চিতভাবে এই প্রশ্নপত্রটি মুছে ফেলতে চান?')">
                                                <i class="fas fa-trash-alt mr-2"></i> মুছে ফেলুন
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-muted"></i>
                                <h5>কোনো প্রশ্নপত্র তৈরি করা হয়নি!</h5>
                                <p class="text-sm">উপরের "নতুন প্রশ্নপত্র তৈরি করুন" বাটনে ক্লিক করে বোর্ড পরীক্ষার প্রশ্নপত্র সাজান।</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-light py-2">
            {{ $papers->links() }}
        </div>
    </div>

    <!-- Create Question Paper Modal -->
    <div class="modal fade" id="createPaperModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content shadow-lg border-0">
                <form action="{{ route('admin.question-papers.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-plus-circle mr-1"></i> নতুন প্রশ্নপত্র প্রস্তুতকরণ
                        </h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="font-weight-bold text-xs">প্রশ্নপত্রের শিরোনাম: <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" placeholder="যেমন: বার্ষিক চূড়ান্ত পরীক্ষা ২০২৬ - তথ্য ও যোগাযোগ প্রযুক্তি" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-xs">কোর্স / পাঠ্যক্রম:</label>
                                <select name="course_id" class="form-control custom-select">
                                    <option value="">-- সাধারণ / বোর্ড পরীক্ষা --</option>
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-xs">পরীক্ষার নাম: <span class="text-danger">*</span></label>
                                <input type="text" name="exam_name" class="form-control" value="বার্ষিক পরীক্ষা ২০২৬" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-xs">বিষয়: <span class="text-danger">*</span></label>
                                <input type="text" name="subject_name" class="form-control" value="তথ্য ও যোগাযোগ প্রযুক্তি (ICT)" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-xs">বিষয় কোড: <span class="text-danger">*</span></label>
                                <input type="text" name="subject_code" class="form-control" value="154" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-xs">শ্রেণি / লেভেল:</label>
                                <input type="text" name="class_level" class="form-control" value="নবম-দশম শ্রেণি">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-xs">শিক্ষাবর্ষ: <span class="text-danger">*</span></label>
                                <input type="text" name="academic_year" class="form-control" value="2026" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-xs">সময় (মিনিট): <span class="text-danger">*</span></label>
                                <input type="number" name="duration_minutes" class="form-control" value="60" min="5" max="360" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-xs">পূর্ণমান: <span class="text-danger">*</span></label>
                                <input type="number" step="0.5" name="total_marks" class="form-control" value="100" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-xs">পাস নম্বর:</label>
                                <input type="number" step="0.5" name="pass_marks" class="form-control" value="40">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-xs">সেট কোড:</label>
                                <select name="paper_set" class="form-control custom-select">
                                    <option value="Set A">Set A (ক-সেট)</option>
                                    <option value="Set B">Set B (খ-সেট)</option>
                                    <option value="Set C">Set C (গ-সেট)</option>
                                    <option value="Set D">Set D (ঘ-সেট)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold text-xs">বোর্ড লেআউট শৈলী:</label>
                                <select name="layout_type" class="form-control custom-select">
                                    <option value="standard_board">বাংলাদেশি শিক্ষা বোর্ড (Standard Board)</option>
                                    <option value="two_column">২-কলাম কমপ্যাক্ট প্রিন্ট (Two Column)</option>
                                    <option value="creative_cq">সৃজনশীল প্রশ্নপত্র (Creative CQ)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="font-weight-bold text-xs">পরীক্ষার্থীদের সাধারণ নির্দেশাবলি:</label>
                            <textarea name="instructions" class="form-control" rows="3">[বিশেষ নির্দেশ: সকল প্রশ্নের উত্তর দিতে হবে। প্রতিটি প্রশ্নের মান ১। ওএমআর শিটে নির্ধারিত বৃত্তটি কালো কালির বলপয়েন্ট কলম দিয়ে ভরাট করো।]</textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="submit" class="btn btn-warning font-weight-bold text-dark">
                            <i class="fas fa-layer-group mr-1"></i> প্রশ্নপত্র তৈরি ও বিল্ডারে প্রবেশ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
