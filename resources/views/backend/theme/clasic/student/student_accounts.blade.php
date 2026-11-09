@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Registered Student Accounts | Wake Up ICT')

{{-- Menu active section --}}
@section('student_active', 'menu-open')
@section('menu_active_active', 'active')
@section('student_account_list_active', 'active')

@section('maincontant')
<div class="content-header p-2">
    <div class="container-fluid">
        @include('backend.theme.clasic.student.include.student_directory_nav')
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="m-0 font-weight-bold text-dark" style="font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', sans-serif;">
                    <i class="fas fa-id-badge text-primary mr-2"></i> শিক্ষার্থী অ্যাকাউন্ট তালিকা (Student Accounts)
                </h4>
                <p class="text-muted text-xs mb-0 mt-1">
                    স্টুডেন্ট পোর্টাল ও কোর্স অ্যাপ্লিকেশন থেকে নিবন্ধিত সকল শিক্ষার্থীর তথ্য ও অ্যাকাউন্ট ব্যবস্থাপনা।
                </p>
            </div>
            <div class="mt-2 mt-sm-0">
                <a href="{{ route('students-list') }}" class="btn btn-outline-secondary btn-sm mr-2 font-weight-bold">
                    <i class="fas fa-user-clock mr-1"></i> কোর্স আবেদনকারী তালিকা
                </a>
                <a href="{{ route('admited-students-list') }}" class="btn btn-outline-success btn-sm font-weight-bold">
                    <i class="fas fa-user-check mr-1"></i> ভর্তিকৃত শিক্ষার্থী
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Metric Stat Cards -->
    <div class="row mb-3">
        <div class="col-12 col-sm-6 col-md-3 mb-2">
            <div class="card shadow-sm border-0 bg-white" style="border-left: 4px solid #2563EB !important;">
                <div class="card-body p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-muted">সর্বমোট অ্যাকাউন্ট</div>
                        <div class="h4 mb-0 font-weight-bold text-dark">{{ number_format($stats['total']) }}</div>
                    </div>
                    <div class="rounded-circle p-2 bg-light text-primary">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-2">
            <div class="card shadow-sm border-0 bg-white" style="border-left: 4px solid #16A34A !important;">
                <div class="card-body p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-muted">সক্রিয় অ্যাকাউন্ট</div>
                        <div class="h4 mb-0 font-weight-bold text-success">{{ number_format($stats['active']) }}</div>
                    </div>
                    <div class="rounded-circle p-2 bg-light text-success">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-2">
            <div class="card shadow-sm border-0 bg-white" style="border-left: 4px solid #0EA5E9 !important;">
                <div class="card-body p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-muted">পোর্টাল রেজিস্ট্রেশন</div>
                        <div class="h4 mb-0 font-weight-bold text-info">{{ number_format($stats['portal']) }}</div>
                    </div>
                    <div class="rounded-circle p-2 bg-light text-info">
                        <i class="fas fa-globe fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-2">
            <div class="card shadow-sm border-0 bg-white" style="border-left: 4px solid #D97706 !important;">
                <div class="card-body p-3 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs text-uppercase font-weight-bold text-muted">কোর্স আবেদনকারী</div>
                        <div class="h4 mb-0 font-weight-bold text-warning">{{ number_format($stats['admission']) }}</div>
                    </div>
                    <div class="rounded-circle p-2 bg-light text-warning">
                        <i class="fas fa-file-signature fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body p-3">
            <form action="{{ route('admin.student-accounts.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <label class="text-xs font-weight-bold text-dark mb-1">শিক্ষার্থী খুঁজুন (Search)</label>
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="নাম, মোবাইল নম্বর, ইমেইল বা আইডি...">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 mb-2 mb-md-0">
                        <label class="text-xs font-weight-bold text-dark mb-1">রেজিস্ট্রেশন মাধ্যম</label>
                        <select name="source" class="form-control form-control-sm custom-select">
                            <option value="">-- সকল মাধ্যম --</option>
                            <option value="portal" {{ request('source') == 'portal' ? 'selected' : '' }}>পোর্টাল রেজিস্ট্রেশন</option>
                            <option value="admission" {{ request('source') == 'admission' ? 'selected' : '' }}>কোর্স আবেদন</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                        <label class="text-xs font-weight-bold text-dark mb-1">কোর্স ফিল্টার</label>
                        <select name="course_id" class="form-control form-control-sm custom-select">
                            <option value="">-- সকল কোর্স --</option>
                            @foreach($courses as $c)
                                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->course_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-2 mb-2 mb-md-0">
                        <label class="text-xs font-weight-bold text-dark mb-1">স্ট্যাটাস</label>
                        <select name="status" class="form-control form-control-sm custom-select">
                            <option value="">-- সকল স্ট্যাটাস --</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>সক্রিয় (Active)</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>স্থগিত (Suspended)</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-1 d-flex">
                        <button type="submit" class="btn btn-primary btn-sm btn-block font-weight-bold mr-1">
                            ফিল্টার
                        </button>
                        @if(request()->anyFilled(['search', 'source', 'course_id', 'status']))
                            <a href="{{ route('admin.student-accounts.index') }}" class="btn btn-light btn-sm" title="ফিল্টার রিসেট">
                                <i class="fas fa-times text-danger"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Accounts Data Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">
                নিবন্ধিত শিক্ষার্থী তালিকা (Total: {{ $accounts->total() }})
            </h6>
            <div class="text-xs text-muted">
                পেজ {{ $accounts->currentPage() }} এর {{ $accounts->lastPage() }}
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0" style="vertical-align: middle;">
                    <thead style="background-color: #F8FAFC; color: #0F172A; border-bottom: 2px solid #E2E8F0;">
                        <tr class="text-xs font-weight-bold text-uppercase">
                            <th style="width: 50px;" class="text-center">#</th>
                            <th>শিক্ষার্থীর পরিচয়</th>
                            <th>যোগাযোগ (Contact)</th>
                            <th>রেজিস্ট্রেশন সোর্স</th>
                            <th>কোর্স ও ব্যাচ</th>
                            <th class="text-center">স্ট্যাটাস</th>
                            <th>নিবন্ধন তারিখ</th>
                            <th style="width: 140px;" class="text-right">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody style="color: #1E293B; font-size: 13px;">
                        @forelse($accounts as $index => $acc)
                            @php
                                $parentStudent = $acc->student ?: ($acc->admitedStudent ? $acc->admitedStudent->student : null);
                                $sourceMeta = is_array($acc->meta) ? $acc->meta : json_decode($acc->meta, true);
                                $source = $sourceMeta['registered_from'] ?? ($sourceMeta['registration_source'] ?? null);
                                $isPortal = ($source === 'portal_registration' || (empty($source) && empty($acc->admited_student_id)));
                            @endphp
                            <tr>
                                <td class="text-center font-weight-bold text-muted">
                                    {{ $accounts->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(!empty($acc->avatar))
                                            <img src="{{ safe_asset($acc->avatar) }}" alt="{{ $acc->name }}" class="rounded-circle mr-2" style="width: 38px; height: 38px; object-fit: cover; border: 1px solid #CBD5E1;">
                                        @else
                                            <div class="rounded-circle mr-2 d-flex align-items-center justify-content-center text-white font-weight-bold" style="width: 38px; height: 38px; background-color: #3B82F6; font-size: 14px;">
                                                {{ mb_substr($acc->name, 0, 1, 'utf-8') }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-weight-bold text-dark">{{ $acc->name }}</div>
                                            <div class="text-xs text-muted d-flex align-items-center" style="gap: 6px;">
                                                <span class="badge badge-light border text-primary font-weight-bold" style="font-family: monospace;">{{ $acc->registration_number ?: $acc->student_id_code }}</span>
                                                @if($parentStudent)
                                                    <a href="{{ route('students-view', $parentStudent->id) }}" class="badge badge-info text-white" target="_blank" title="ভিউ স্লিপ #{{ 1000 + $parentStudent->id }}">
                                                        মাস্টার আইডি: #{{ 1000 + $parentStudent->id }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <i class="fas fa-phone-alt text-success text-xs mr-1"></i>
                                        <a href="tel:{{ $acc->phone }}" class="text-dark font-weight-bold">{{ $acc->phone }}</a>
                                    </div>
                                    @if($acc->email)
                                        <div class="text-xs text-muted">
                                            <i class="fas fa-envelope text-info text-xs mr-1"></i>
                                            <a href="mailto:{{ $acc->email }}" class="text-muted">{{ $acc->email }}</a>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($isPortal)
                                        <span class="badge badge-info font-weight-bold px-2 py-1" style="font-size: 11px;">
                                            <i class="fas fa-globe mr-1"></i> পোর্টাল রেজিস্ট্রেশন
                                        </span>
                                    @else
                                        <span class="badge badge-warning font-weight-bold px-2 py-1" style="font-size: 11px; color: #000000 !important; font-weight: 800;">
                                            <i class="fas fa-file-signature mr-1"></i> কোর্স আবেদনকারী
                                        </span>
                                    @endif
                                    @if($acc->admitedStudent)
                                        <div class="mt-1">
                                            <span class="badge badge-success px-2 py-0" style="font-size: 10px;">
                                                <i class="fas fa-user-check mr-1"></i> কনফার্মড শিক্ষার্থী
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $coursesList = $acc->full_courses_list;
                                    @endphp
                                    @if($coursesList && $coursesList->count() > 0)
                                        <div class="d-flex flex-column" style="gap: 3px;">
                                            @foreach($coursesList as $cItem)
                                                <div class="text-xs">
                                                    <span class="badge badge-light border text-dark font-weight-bold">
                                                        <i class="fas fa-book-open text-primary mr-1"></i> {{ $cItem['title'] }}
                                                    </span>
                                                    @if(!empty($cItem['batch_number']))
                                                        <span class="badge badge-success" style="font-size: 10px;">
                                                            {{ $cItem['batch_number'] }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-muted">কোনো কোর্স বরাদ্দ নেই</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($acc->status == 1)
                                        <span class="badge badge-success px-2 py-1 font-weight-bold">সক্রিয় (Active)</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1 font-weight-bold">স্থগিত (Suspended)</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-xs text-dark font-weight-bold">
                                        {{ $acc->created_at ? $acc->created_at->format('d M, Y') : 'N/A' }}
                                    </div>
                                    <div class="text-xs text-muted">
                                        {{ $acc->created_at ? $acc->created_at->format('h:i A') : '' }}
                                    </div>
                                    @if($acc->last_login_at)
                                        <div class="text-xs text-info mt-1" title="সর্বশেষ লগইন">
                                            <i class="fas fa-clock mr-1"></i>{{ $acc->last_login_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm">
                                        @if($parentStudent)
                                            <a href="{{ route('students-view', $parentStudent->id) }}" class="btn btn-outline-info" title="স্লিপ / সম্পূর্ণ প্রোফাইল দেখুন" target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        <form action="{{ route('admin.student-accounts.toggle-status', $acc->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি এই অ্যাকাউন্টের স্ট্যাটাস পরিবর্তন করতে চান?')">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-{{ $acc->status == 1 ? 'warning' : 'success' }}" title="{{ $acc->status == 1 ? 'অ্যাকাউন্ট স্থগিত করুন' : 'অ্যাকাউন্ট সক্রিয় করুন' }}">
                                                <i class="fas fa-{{ $acc->status == 1 ? 'ban' : 'check' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.student-accounts.destroy', $acc->id) }}" method="POST" class="d-inline" onsubmit="return confirm('সতর্কতা: এই শিক্ষার্থী অ্যাকাউন্টটি মুছে ফেলতে চান?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="মুছে ফেলুন">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-slash fa-3x mb-3 text-secondary d-block"></i>
                                    <div class="h6 font-weight-bold">কোনো শিক্ষার্থী অ্যাকাউন্ট খুঁজে পাওয়া যায়নি</div>
                                    <p class="text-xs mb-0">ফিল্টার পরিবর্তন করে পুনরায় চেষ্টা করুন অথবা নতুন শিক্ষার্থী আবেদন করলে তা এখানে দেখা যাবে।</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($accounts->hasPages())
            <div class="card-footer bg-white border-top d-flex justify-content-end p-2">
                {{ $accounts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

