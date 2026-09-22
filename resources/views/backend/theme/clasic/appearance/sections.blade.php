@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title', __('admin.menu.sections_cms'))

@section('appearance_menu_open', 'menu-open')
@section('appearance_active', 'active')
@section('appearance_sections_active', 'active')

@section('maincontant')
<div class="container-fluid px-2 px-md-4 py-3">
    <!-- Header banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(11, 19, 41, 0.95)); border: 1px solid rgba(51, 65, 85, 0.6); border-radius: 12px;">
        <div class="card-body p-4">
            <span class="badge px-3 py-1 mb-2" style="background: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.15); color: var(--brand-primary, #10b981); border: 1px solid rgba(var(--brand-primary-rgb, 16, 185, 129), 0.3); font-family: 'JetBrains Mono', monospace; font-size: 11px;">
                Page Architecture
            </span>
            <h2 class="text-white font-weight-bold mb-1">
                {{ __('admin.menu.sections_cms') }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 14px;">
                Manage static editorial headers, subtitles, and badges for Courses, Services, About, Team, Blog, Contact, and Auth pages in both English and বাংলা.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px; background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #a7f3d0;">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('appearance.sections.update') }}" method="POST">
        @csrf

        <!-- 1. Courses Page -->
        <div class="card mb-4" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
            <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                <h5 class="card-title text-white font-weight-bold mb-0">
                    <i class="fas fa-graduation-cap mr-2" style="color: var(--brand-primary, #10b981);"></i> Courses Page Header
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Title (English)</label>
                        <input type="text" name="page_courses_title[en]" class="form-control" value="{{ app_setting('page_courses_title', 'Engineered Computing Curriculums', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Title (বাংলা)</label>
                        <input type="text" name="page_courses_title[bn]" class="form-control" value="{{ app_setting('page_courses_title', 'বিশেষায়িত কম্পিউটার কোর্সসমূহ', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Subtitle (English)</label>
                        <textarea name="page_courses_sub[en]" rows="2" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('page_courses_sub', 'Structured, outcome-driven programs designed to accelerate professional software engineering capabilities.', 'en') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Subtitle (বাংলা)</label>
                        <textarea name="page_courses_sub[bn]" rows="2" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('page_courses_sub', 'বাস্তবমুখী ও পেশাদার সফটওয়্যার দক্ষতা অর্জনের জন্য সাজানো বিশেষায়িত কারিকুলাম।', 'bn') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Services Page -->
        <div class="card mb-4" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
            <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                <h5 class="card-title text-white font-weight-bold mb-0">
                    <i class="fas fa-cogs mr-2" style="color: var(--brand-accent, #34d399);"></i> Services Page Header
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Title (English)</label>
                        <input type="text" name="page_services_title[en]" class="form-control" value="{{ app_setting('page_services_title', 'Enterprise Digital Engineering Services', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Title (বাংলা)</label>
                        <input type="text" name="page_services_title[bn]" class="form-control" value="{{ app_setting('page_services_title', 'এন্টারপ্রাইজ ডিজিটাল ইঞ্জিনিয়ারিং সেবা', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Subtitle (English)</label>
                        <textarea name="page_services_sub[en]" rows="2" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('page_services_sub', 'From cloud infrastructure and bespoke enterprise systems to digital experience platforms.', 'en') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Subtitle (বাংলা)</label>
                        <textarea name="page_services_sub[bn]" rows="2" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('page_services_sub', 'ক্লাউড ইনফ্রাস্ট্রাকচার ও কাস্টম সফটওয়্যার থেকে শুরু করে পূর্ণাঙ্গ ডিজিটাল রূপান্তর সেবা।', 'bn') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. About & Leadership -->
        <div class="card mb-4" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
            <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                <h5 class="card-title text-white font-weight-bold mb-0">
                    <i class="fas fa-users mr-2" style="color: #38bdf8;"></i> About & Leadership Page Headers
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">About Title (English)</label>
                        <input type="text" name="page_about_title[en]" class="form-control" value="{{ app_setting('page_about_title', 'Pioneering Technical Rigor in Bangladesh', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">About Title (বাংলা)</label>
                        <input type="text" name="page_about_title[bn]" class="form-control" value="{{ app_setting('page_about_title', 'প্রযুক্তিগত উৎকর্ষ ও মেধার নেতৃত্ব', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Leadership Title (English)</label>
                        <input type="text" name="page_team_title[en]" class="form-control" value="{{ app_setting('page_team_title', 'Architects, Practitioners & Mentors', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Leadership Title (বাংলা)</label>
                        <input type="text" name="page_team_title[bn]" class="form-control" value="{{ app_setting('page_team_title', 'আমাদের অভিজ্ঞ মেন্টর ও লিডারশিপ', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Contact & Auth -->
        <div class="card mb-4" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
            <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                <h5 class="card-title text-white font-weight-bold mb-0">
                    <i class="fas fa-envelope-open-text mr-2" style="color: #f43f5e;"></i> Contact & Auth Pages
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Contact Page Title (English)</label>
                        <input type="text" name="page_contact_title[en]" class="form-control" value="{{ app_setting('page_contact_title', 'Initiate a Technical Dialogue', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Contact Page Title (বাংলা)</label>
                        <input type="text" name="page_contact_title[bn]" class="form-control" value="{{ app_setting('page_contact_title', 'আমাদের সাথে যোগাযোগ করুন', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Auth / Sign In Banner (English)</label>
                        <input type="text" name="page_auth_title[en]" class="form-control" value="{{ app_setting('page_auth_title', 'Access Wake Up ICT Console', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Auth / Sign In Banner (বাংলা)</label>
                        <input type="text" name="page_auth_title[bn]" class="form-control" value="{{ app_setting('page_auth_title', 'ওয়েক আপ আইসিটি কনসোলে প্রবেশ করুন', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5 text-right">
            <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 8px; background: var(--brand-primary, #10b981); border-color: var(--brand-primary, #10b981); color: #fff;">
                <i class="fas fa-save mr-2"></i> {{ __('admin.appearance.save_button') }}
            </button>
        </div>
    </form>
</div>
@endsection
