@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title', __('admin.menu.home_cms'))

@section('appearance_menu_open', 'menu-open')
@section('appearance_active', 'active')
@section('appearance_home_active', 'active')

@section('maincontant')
<div class="container-fluid px-2 px-md-4 py-3">
    <!-- Header banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(11, 19, 41, 0.95)); border: 1px solid rgba(51, 65, 85, 0.6); border-radius: 12px;">
        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <span class="badge px-3 py-1 mb-2" style="background: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.15); color: var(--brand-primary, #10b981); border: 1px solid rgba(var(--brand-primary-rgb, 16, 185, 129), 0.3); font-family: 'JetBrains Mono', monospace; font-size: 11px;">
                    Editorial Architecture
                </span>
                <h2 class="text-white font-weight-bold mb-1">
                    {{ __('admin.menu.home_cms') }}
                </h2>
                <p class="text-muted mb-0" style="font-size: 14px;">
                    Manage editorial headlines, mission narrative, metrics, and section headers across the homepage in both English and বাংলা.
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('home-slider-list') }}" class="btn btn-outline-info px-3 py-2" style="border-radius: 8px; font-size: 13px;">
                    <i class="fas fa-images mr-1"></i> Manage Hero Auto-Slider Images
                </a>
            </div>
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

    <form action="{{ route('appearance.home.update') }}" method="POST">
        @csrf

        <!-- 1. Hero Section -->
        <div class="card mb-4" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
            <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                <h5 class="card-title text-white font-weight-bold mb-0">
                    <i class="fas fa-rocket mr-2" style="color: var(--brand-primary, #10b981);"></i> 1. Hero Section Content & CTAs
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Hero Badge Text (English)</label>
                        <input type="text" name="hero_badge[en]" class="form-control" value="{{ app_setting('hero_badge', '2026 Enterprise Digital Engineering & Technology', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Hero Badge Text (বাংলা)</label>
                        <input type="text" name="hero_badge[bn]" class="form-control" value="{{ app_setting('hero_badge', '২০২৬ এন্টারপ্রাইজ ডিজিটাল ইঞ্জিনিয়ারিং ও প্রযুক্তি', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Main Heading (English)</label>
                        <input type="text" name="hero_title[en]" class="form-control" value="{{ app_setting('hero_title', 'Architecting High-Performance Digital Solutions', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Main Heading (বাংলা)</label>
                        <input type="text" name="hero_title[bn]" class="form-control" value="{{ app_setting('hero_title', 'হাই-পারফরম্যান্স ডিজিটাল সলিউশন বিনির্মাণ', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Hero Narrative / Subtitle (English)</label>
                        <textarea name="hero_subtitle[en]" rows="3" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('hero_subtitle', 'Wake Up ICT bridges technical excellence with industry-grade software craftsmanship, specialized computing curriculums, and enterprise transformation.', 'en') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Hero Narrative / Subtitle (বাংলা)</label>
                        <textarea name="hero_subtitle[bn]" rows="3" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('hero_subtitle', 'ওয়েক আপ আইসিটি টেকনিক্যাল উৎকর্ষের সাথে আধুনিক সফটওয়্যার ইঞ্জিনিয়ারিং ও বিশেষায়িত কম্পিউটার শিক্ষার সমন্বয় ঘটায়।', 'bn') }}</textarea>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="text-white font-weight-bold mb-1">CTA 1 Label (English)</label>
                        <input type="text" name="hero_btn1_text[en]" class="form-control" value="{{ app_setting('hero_btn1_text', 'Explore Programs', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="text-white font-weight-bold mb-1">CTA 1 Label (বাংলা)</label>
                        <input type="text" name="hero_btn1_text[bn]" class="form-control" value="{{ app_setting('hero_btn1_text', 'কোর্সগুলো দেখুন', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="text-white font-weight-bold mb-1">CTA 2 Label (English)</label>
                        <input type="text" name="hero_btn2_text[en]" class="form-control" value="{{ app_setting('hero_btn2_text', 'Engineering Services', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="text-white font-weight-bold mb-1">CTA 2 Label (বাংলা)</label>
                        <input type="text" name="hero_btn2_text[bn]" class="form-control" value="{{ app_setting('hero_btn2_text', 'আমাদের সেবাসমূহ', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Metrics & Enterprise Numbers -->
        <div class="card mb-4" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
            <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                <h5 class="card-title text-white font-weight-bold mb-0">
                    <i class="fas fa-chart-line mr-2" style="color: var(--brand-accent, #34d399);"></i> 2. Metrics & Impact Counters
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- Metric 1 -->
                    <div class="col-md-4 mb-3">
                        <label class="text-white font-weight-bold mb-1">Stat 1 (Value & Labels)</label>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend"><span class="input-group-text text-muted" style="background:#1e293b; border-color:#334155; font-size:11px;">EN Val</span></div>
                            <input type="text" name="stat1_value[en]" class="form-control" value="{{ app_setting('stat1_value', '15,000+', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;" placeholder="e.g. 15,000+">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend"><span class="input-group-text text-muted" style="background:#1e293b; border-color:#334155; font-size:11px;">BN Val</span></div>
                            <input type="text" name="stat1_value[bn]" class="form-control" value="{{ app_setting('stat1_value', '১৫,০০০+', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;" placeholder="e.g. ১৫,০০০+">
                        </div>
                        <input type="text" name="stat1_label[en]" class="form-control form-control-sm mt-1" value="{{ app_setting('stat1_label', 'Trained Professionals', 'en') }}" placeholder="EN Label: Trained Professionals" style="background: #0f172a; border-color: #334155; color: #fff;">
                        <input type="text" name="stat1_label[bn]" class="form-control form-control-sm mt-1" value="{{ app_setting('stat1_label', 'প্রশিক্ষণপ্রাপ্ত প্রফেশনাল', 'bn') }}" placeholder="BN Label: প্রশিক্ষণপ্রাপ্ত প্রফেশনাল" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>

                    <!-- Metric 2 -->
                    <div class="col-md-4 mb-3">
                        <label class="text-white font-weight-bold mb-1">Stat 2 (Value & Labels)</label>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend"><span class="input-group-text text-muted" style="background:#1e293b; border-color:#334155; font-size:11px;">EN Val</span></div>
                            <input type="text" name="stat2_value[en]" class="form-control" value="{{ app_setting('stat2_value', '250+', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;" placeholder="e.g. 250+">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend"><span class="input-group-text text-muted" style="background:#1e293b; border-color:#334155; font-size:11px;">BN Val</span></div>
                            <input type="text" name="stat2_value[bn]" class="form-control" value="{{ app_setting('stat2_value', '২৫০+', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;" placeholder="e.g. ২৫০+">
                        </div>
                        <input type="text" name="stat2_label[en]" class="form-control form-control-sm mt-1" value="{{ app_setting('stat2_label', 'Enterprise Deployments', 'en') }}" placeholder="EN Label: Enterprise Deployments" style="background: #0f172a; border-color: #334155; color: #fff;">
                        <input type="text" name="stat2_label[bn]" class="form-control form-control-sm mt-1" value="{{ app_setting('stat2_label', 'সফল প্রজেক্ট ডেলিভারি', 'bn') }}" placeholder="BN Label: সফল প্রজেক্ট ডেলিভারি" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>

                    <!-- Metric 3 -->
                    <div class="col-md-4 mb-3">
                        <label class="text-white font-weight-bold mb-1">Stat 3 (Value & Labels)</label>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend"><span class="input-group-text text-muted" style="background:#1e293b; border-color:#334155; font-size:11px;">EN Val</span></div>
                            <input type="text" name="stat3_value[en]" class="form-control" value="{{ app_setting('stat3_value', '98.5%', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;" placeholder="e.g. 98.5%">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend"><span class="input-group-text text-muted" style="background:#1e293b; border-color:#334155; font-size:11px;">BN Val</span></div>
                            <input type="text" name="stat3_value[bn]" class="form-control" value="{{ app_setting('stat3_value', '৯৮.৫%', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;" placeholder="e.g. ৯৮.৫%">
                        </div>
                        <input type="text" name="stat3_label[en]" class="form-control form-control-sm mt-1" value="{{ app_setting('stat3_label', 'Client Satisfaction', 'en') }}" placeholder="EN Label: Client Satisfaction" style="background: #0f172a; border-color: #334155; color: #fff;">
                        <input type="text" name="stat3_label[bn]" class="form-control form-control-sm mt-1" value="{{ app_setting('stat3_label', 'ক্লায়েন্ট সন্তুষ্টির হার', 'bn') }}" placeholder="BN Label: ক্লায়েন্ট সন্তুষ্টির হার" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Section Headers (Courses, Services, Portfolio, Insights, CTA) -->
        <div class="card mb-4" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
            <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                <h5 class="card-title text-white font-weight-bold mb-0">
                    <i class="fas fa-heading mr-2" style="color: #38bdf8;"></i> 3. Dynamic Section Headers
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- Courses Header -->
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Courses Section Title (English)</label>
                        <input type="text" name="courses_header_title[en]" class="form-control" value="{{ app_setting('courses_header_title', 'Flagship Curriculums', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Courses Section Title (বাংলা)</label>
                        <input type="text" name="courses_header_title[bn]" class="form-control" value="{{ app_setting('courses_header_title', 'বিশেষায়িত কোর্সসমূহ', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>

                    <!-- Services Header -->
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Services Section Title (English)</label>
                        <input type="text" name="services_header_title[en]" class="form-control" value="{{ app_setting('services_header_title', 'Enterprise Engineering Capabilities', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Services Section Title (বাংলা)</label>
                        <input type="text" name="services_header_title[bn]" class="form-control" value="{{ app_setting('services_header_title', 'এন্টারপ্রাইজ ইঞ্জিনিয়ারিং সেবা', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>

                    <!-- Portfolio Header -->
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Portfolio Section Title (English)</label>
                        <input type="text" name="portfolio_header_title[en]" class="form-control" value="{{ app_setting('portfolio_header_title', 'Proven Enterprise Work', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Portfolio Section Title (বাংলা)</label>
                        <input type="text" name="portfolio_header_title[bn]" class="form-control" value="{{ app_setting('portfolio_header_title', 'আমাদের কাজের পোর্টফোলিও', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>

                    <!-- Bottom CTA Banner -->
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Bottom CTA Title (English)</label>
                        <input type="text" name="cta_banner_title[en]" class="form-control" value="{{ app_setting('cta_banner_title', 'Ready to accelerate your technological footprint?', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-white font-weight-bold mb-1">Bottom CTA Title (বাংলা)</label>
                        <input type="text" name="cta_banner_title[bn]" class="form-control" value="{{ app_setting('cta_banner_title', 'আপনার প্রযুক্তিগত যাত্রাকে বেগবান করতে প্রস্তুত?', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
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
