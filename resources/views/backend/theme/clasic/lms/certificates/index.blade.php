@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'LMS Certificate Management — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_certificate_active', 'active')

@section('maincontant')
    <!-- Header -->
    <div class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.5rem;">
                        <i class="fas fa-certificate text-warning mr-2"></i> সার্টিফিকেট ম্যানেজমেন্ট ও প্রকাশনা
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        অফলাইন কোর্স সম্পন্নকারী শিক্ষার্থীদের সার্টিফিকেট প্রস্তুত, প্রকাশ (Publish) ও যাচাই নিয়ন্ত্রণ করুন।
                    </p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <button type="button" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#issueCertModal">
                        <i class="fas fa-plus-circle mr-1"></i> নতুন সার্টিফিকেট ইস্যু / প্রকাশ করুন
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
            <ul class="mb-0 pl-3">
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
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-award"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">প্রকাশিত সার্টিফিকেট (Published)</span>
                    <span class="info-box-number font-weight-bold text-success" style="font-size: 1.4rem;">{{ $issuedCerts }}</span>
                    <span class="text-xs text-muted">শিক্ষার্থী পোর্টালে দৃশ্যমান ও ডাউনলোডযোগ্য</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-warning elevation-1 text-white"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">অপেক্ষমাণ / ড্রাফট (Pending Review)</span>
                    <span class="info-box-number font-weight-bold text-warning" style="font-size: 1.4rem;">{{ $pendingCerts }}</span>
                    <span class="text-xs text-muted">পোর্টালে অপ্রকাশিত (Hidden from student)</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="info-box shadow-sm border-0">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-graduate"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">মোট নিবন্ধিত শিক্ষার্থী</span>
                    <span class="info-box-number font-weight-bold text-info" style="font-size: 1.4rem;">{{ $students->count() }}</span>
                    <span class="text-xs text-muted">ওয়েক আপ আইসিটি ক্যাম্পাস ডাটাবেজ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card card-outline card-primary shadow-sm border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <form action="{{ route('admin.certificates.index') }}" method="GET" class="row align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="শিক্ষার্থীর নাম, মোবাইল, রোল বা কোড..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="course_id" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- সকল কোর্স --</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->course_title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- সকল স্ট্যাটাস --</option>
                        <option value="issued" {{ request('status') == 'issued' ? 'selected' : '' }}>প্রকাশিত (Published)</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>অপেক্ষমান (Draft / Pending)</option>
                    </select>
                </div>
                <div class="col-md-2 text-md-right">
                    @if(request()->hasAny(['search', 'course_id', 'status']))
                        <a href="{{ route('admin.certificates.index') }}" class="btn btn-sm btn-outline-secondary">
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
                        <th>শিক্ষার্থী বিবরণ</th>
                        <th>কোর্স ও শিরোনাম</th>
                        <th>সার্টিফিকেট কোড</th>
                        <th class="text-center">গ্রেড ও স্কোর</th>
                        <th class="text-center">ইস্যুর তারিখ</th>
                        <th class="text-center">প্রকাশনা স্ট্যাটাস</th>
                        <th class="text-center" style="width: 180px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificates as $cert)
                        <tr>
                            <td class="text-center text-muted text-sm">{{ $loop->iteration + ($certificates->currentPage() - 1) * $certificates->perPage() }}</td>
                            <td>
                                @if($cert->student)
                                    <div class="font-weight-bold text-dark">{{ $cert->student->name }}</div>
                                    <div class="text-xs text-muted">
                                        <i class="fas fa-phone-alt mr-1"></i> {{ $cert->student->phone }}
                                        @if($cert->student->student_id_code)
                                            | <span class="badge badge-light border">ID: {{ $cert->student->student_id_code }}</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted font-italic">শিক্ষার্থী আইডি: #{{ $cert->student_account_id }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-semibold text-primary">
                                    {{ $cert->course ? $cert->course->course_title : 'Course #' . $cert->course_id }}
                                </div>
                                <div class="text-xs text-muted font-italic text-truncate" style="max-width: 250px;">
                                    {{ $cert->title }}
                                </div>
                            </td>
                            <td>
                                <code class="font-weight-bold text-dark bg-light px-2 py-1 rounded border">{{ $cert->certificate_code }}</code>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary px-2 py-1">{{ $cert->grade ?: 'A+' }}</span>
                                <div class="text-xs font-weight-bold text-muted mt-1">{{ number_format($cert->score_percentage, 1) }}%</div>
                            </td>
                            <td class="text-center text-sm text-muted">
                                {{ $cert->issue_date ? $cert->issue_date->format('d M, Y') : 'N/A' }}
                            </td>
                            <td class="text-center">
                                @if($cert->status === 'issued')
                                    <span class="badge badge-success px-2.5 py-1.5 shadow-sm">
                                        <i class="fas fa-check-circle mr-1"></i> Published (প্রকাশিত)
                                    </span>
                                @else
                                    <span class="badge badge-warning text-dark px-2.5 py-1.5 shadow-sm">
                                        <i class="fas fa-eye-slash mr-1"></i> Pending / Hidden
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <!-- Toggle Publish -->
                                    <form action="{{ route('admin.certificates.toggle', $cert->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn {{ $cert->status === 'issued' ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $cert->status === 'issued' ? 'Unpublish (Hide from student)' : 'Publish (Make visible to student)' }}">
                                            <i class="fas {{ $cert->status === 'issued' ? 'fa-eye-slash' : 'fa-check-circle' }}"></i>
                                        </button>
                                    </form>

                                    <!-- Public Verify Link -->
                                    <a href="{{ url('/verify/certificate/' . $cert->verification_hash) }}" target="_blank" class="btn btn-outline-info" title="পাবলিক ভেরিফিকেশন প্রিভিউ">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>

                                    <!-- Edit Trigger Modal -->
                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#editModal{{ $cert->id }}" title="সম্পাদনা করুন">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই সার্টিফিকেটটি মুছে ফেলতে চান?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="মুছে ফেলুন">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade text-left" id="editModal{{ $cert->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content shadow-lg border-0">
                                            <form action="{{ route('admin.certificates.update', $cert->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title font-weight-bold">
                                                        <i class="fas fa-edit text-primary mr-1"></i> সার্টিফিকেট সম্পাদনা: {{ $cert->certificate_code }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body space-y-3">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold text-sm">সার্টিফিকেট শিরোনাম</label>
                                                        <input type="text" name="title" class="form-control" value="{{ $cert->title }}" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold text-sm">গ্রেড (Grade)</label>
                                                                <select name="grade" class="form-control" required>
                                                                    @foreach(['A+', 'A', 'A-', 'B+', 'B', 'B-', 'Pass'] as $g)
                                                                        <option value="{{ $g }}" {{ $cert->grade == $g ? 'selected' : '' }}>{{ $g }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold text-sm">প্রাপ্ত স্কোর / মার্কস (%)</label>
                                                                <input type="number" step="0.1" name="score_percentage" class="form-control" value="{{ $cert->score_percentage }}" min="0" max="100" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold text-sm">ইস্যুর তারিখ</label>
                                                                <input type="date" name="issue_date" class="form-control" value="{{ $cert->issue_date ? $cert->issue_date->format('Y-m-d') : date('Y-m-d') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold text-sm">প্রকাশনা স্ট্যাটাস</label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="issued" {{ $cert->status == 'issued' ? 'selected' : '' }}>প্রকাশিত (Published)</option>
                                                                    <option value="pending" {{ $cert->status == 'pending' ? 'selected' : '' }}>ড্রাফট / গোপন (Pending)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
                                                    <button type="submit" class="btn btn-primary font-weight-bold">আপডেট সংরক্ষণ করুন</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-secondary d-block"></i>
                                কোন সার্টিফিকেট পাওয়া যায়নি। নতুন সার্টিফিকেট ইস্যু করতে উপরের বোতামটি ব্যবহার করুন।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($certificates->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-xs text-muted">দেখাচ্ছে {{ $certificates->firstItem() }} থেকে {{ $certificates->lastItem() }} (মোট {{ $certificates->total() }})</span>
                    {{ $certificates->links() }}
                </div>
            </div>
        @endif
    </div>

<!-- Modal: Issue New Certificate -->
<div class="modal fade" id="issueCertModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg border-0">
            <form action="{{ route('admin.certificates.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-award mr-1"></i> নতুন সার্টিফিকেট ইস্যু / প্রকাশনা ফরম
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info py-2 px-3 text-sm">
                        <i class="fas fa-info-circle mr-1"></i> আপনি <strong>"প্রকাশিত (Published)"</strong> নির্বাচন করলে শিক্ষার্থী তার স্টুডেন্ট পোর্টালে সাথে সাথে সার্টিফিকেট দেখতে এবং ডাউনলোড করতে পারবে।
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">শিক্ষার্থী নির্বাচন করুন <span class="text-danger">*</span></label>
                                <select name="student_account_id" class="form-control" required id="selectStudentCert">
                                    <option value="">-- শিক্ষার্থী নির্বাচন করুন --</option>
                                    @foreach($students as $st)
                                        <option value="{{ $st->id }}">
                                            {{ $st->name }} ({{ $st->phone }}{{ $st->student_id_code ? ' | ' . $st->student_id_code : '' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">কোর্স নির্বাচন করুন <span class="text-danger">*</span></label>
                                <select name="course_id" class="form-control" required id="selectCourseCert">
                                    <option value="">-- কোর্স নির্বাচন করুন --</option>
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-sm">সার্টিফিকেটের শিরোনাম (ঐচ্ছিক)</label>
                        <input type="text" name="title" class="form-control" placeholder="উদাহরণ: Certificate of Professional Completion: Graphic Design">
                        <small class="form-text text-muted">খালি রাখলে স্বয়ংক্রিয়ভাবে কোর্সের শিরোনাম দিয়ে জেনারেট হবে।</small>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">গ্রেড (Grade) <span class="text-danger">*</span></label>
                                <select name="grade" class="form-control" required>
                                    <option value="A+" selected>A+ (Excellent / ৯৫%+)</option>
                                    <option value="A">A (Very Good / ৯০%+)</option>
                                    <option value="A-">A- (Good / ৮৫%+)</option>
                                    <option value="B+">B+ (Satisfactory / ৮০%+)</option>
                                    <option value="B">B (Above Average / ৭৫%+)</option>
                                    <option value="Pass">Pass (উত্তীর্ণ)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">প্রাপ্ত স্কোর / মার্কস (%) <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" name="score_percentage" class="form-control" value="95.0" min="0" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold text-sm">ইস্যুর তারিখ <span class="text-danger">*</span></label>
                                <input type="date" name="issue_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-sm">প্রকাশনা স্ট্যাটাস (Publish Status) <span class="text-danger">*</span></label>
                        <div class="border rounded p-3 bg-light">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="statusIssued" name="status" value="issued" class="custom-control-input" checked>
                                <label class="custom-control-label font-weight-bold text-success" for="statusIssued">
                                    <i class="fas fa-check-circle"></i> সরাসরি প্রকাশ করুন (Published — স্টুডেন্ট পোর্টালে দৃশ্যমান হবে)
                                </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="statusPending" name="status" value="pending" class="custom-control-input">
                                <label class="custom-control-label font-weight-bold text-warning" for="statusPending">
                                    <i class="fas fa-clock"></i> ড্রাফট হিসেবে রাখুন (Pending — পরবর্তীতে যাচাই করে প্রকাশ করবেন)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-success font-weight-bold px-4">
                        <i class="fas fa-save mr-1"></i> সার্টিফিকেট সংরক্ষণ ও কার্যকর করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
