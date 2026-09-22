@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title', __('admin.menu.global_settings'))

@section('appearance_menu_open', 'menu-open')
@section('appearance_active', 'active')
@section('appearance_global_active', 'active')

@section('maincontant')
<div class="container-fluid px-2 px-md-4 py-3">
    <!-- Header banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(11, 19, 41, 0.95)); border: 1px solid rgba(51, 65, 85, 0.6); border-radius: 12px;">
        <div class="card-body p-4">
            <span class="badge px-3 py-1 mb-2" style="background: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.15); color: var(--brand-primary, #10b981); border: 1px solid rgba(var(--brand-primary-rgb, 16, 185, 129), 0.3); font-family: 'JetBrains Mono', monospace; font-size: 11px;">
                Identity & Information
            </span>
            <h2 class="text-white font-weight-bold mb-1">
                {{ __('admin.menu.global_settings') }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 14px;">
                Manage global brand identity, contact lines, social profiles, and footer credentials in both English and বাংলা.
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

    <form action="{{ route('appearance.global.update') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Brand & Identity -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
                    <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                        <h5 class="card-title text-white font-weight-bold mb-0">
                            <i class="fas fa-building mr-2" style="color: var(--brand-primary, #10b981);"></i> Brand & Tagline
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Site Title (English)</label>
                            <input type="text" name="site_title[en]" class="form-control" value="{{ app_setting('site_title', 'Wake Up ICT', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Site Title (বাংলা)</label>
                            <input type="text" name="site_title[bn]" class="form-control" value="{{ app_setting('site_title', 'ওয়েক আপ আইসিটি', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Tagline / Mission (English)</label>
                            <textarea name="site_tagline[en]" rows="3" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('site_tagline', 'Enterprise Technology, Software Engineering & Advanced Computing Education.', 'en') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Tagline / Mission (বাংলা)</label>
                            <textarea name="site_tagline[bn]" rows="3" class="form-control" style="background: #0f172a; border-color: #334155; color: #fff;">{{ app_setting('site_tagline', 'এন্টারপ্রাইজ টেকনোলজি, আধুনিক সফটওয়্যার ইঞ্জিনিয়ারিং ও বিশেষায়িত কম্পিউটার শিক্ষা।', 'bn') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Footer Copyright Notice (English)</label>
                            <input type="text" name="footer_copyright[en]" class="form-control" value="{{ app_setting('footer_copyright', '© 2026 Wake Up ICT. All rights reserved. Architected with technical precision.', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>
                        <div class="form-group mb-0">
                            <label class="text-white font-weight-bold mb-1">Footer Copyright Notice (বাংলা)</label>
                            <input type="text" name="footer_copyright[bn]" class="form-control" value="{{ app_setting('footer_copyright', '© ২০২৬ ওয়েক আপ আইসিটি। সর্বস্বত্ব সংরক্ষিত।', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact & Social -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
                    <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                        <h5 class="card-title text-white font-weight-bold mb-0">
                            <i class="fas fa-address-book mr-2" style="color: var(--brand-primary, #10b981);"></i> Communications & Social
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Primary Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ app_setting('contact_email', 'info@wakeupict.com') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Support Phone / Hotlines</label>
                            <input type="text" name="contact_phone" class="form-control" value="{{ app_setting('contact_phone', '+880 1711-000000, +880 1911-000000') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Headquarters Address (English)</label>
                            <input type="text" name="contact_address[en]" class="form-control" value="{{ app_setting('contact_address', 'Level 4, ICT Tower, Dhaka, Bangladesh', 'en') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold mb-1">Headquarters Address (বাংলা)</label>
                            <input type="text" name="contact_address[bn]" class="form-control" value="{{ app_setting('contact_address', 'লেভেল ৪, আইসিটি টাওয়ার, ঢাকা, বাংলাদেশ', 'bn') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>

                        <hr class="border-secondary my-4">

                        <h6 class="text-slate-300 font-weight-bold text-white mb-3" style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                            Social Media Presence
                        </h6>
                        <div class="form-group mb-2">
                            <label class="text-muted small mb-1"><i class="fab fa-facebook mr-1 text-primary"></i> Facebook URL</label>
                            <input type="url" name="social_facebook" class="form-control form-control-sm" value="{{ app_setting('social_facebook', 'https://facebook.com/wakeupict') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-muted small mb-1"><i class="fab fa-linkedin mr-1 text-info"></i> LinkedIn URL</label>
                            <input type="url" name="social_linkedin" class="form-control form-control-sm" value="{{ app_setting('social_linkedin', 'https://linkedin.com/company/wakeupict') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-muted small mb-1"><i class="fab fa-youtube mr-1 text-danger"></i> YouTube URL</label>
                            <input type="url" name="social_youtube" class="form-control form-control-sm" value="{{ app_setting('social_youtube', 'https://youtube.com/wakeupict') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>

                        <hr class="border-secondary my-4">

                        <hr class="border-secondary my-4">

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="text-slate-300 font-weight-bold text-white mb-0" style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <i class="fab fa-facebook-square mr-1 text-primary"></i> Facebook Graph API Integration (Permanent Connection)
                            </h6>
                            <span class="badge badge-success px-2 py-1" style="font-size: 10px; font-family: monospace;">Permanent Token Recommended</span>
                        </div>
                        
                        <!-- Permanent Token Quick Guide -->
                        <div class="p-3 mb-3 rounded" style="background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.25); font-size: 12px;">
                            <div class="font-weight-bold text-success mb-1">
                                <i class="fas fa-key mr-1"></i> How to get a Never-Expiring Permanent Token:
                            </div>
                            <ol class="mb-0 pl-3 text-slate-300" style="color: #cbd5e1; line-height: 1.6;">
                                <li>Open <a href="https://developers.facebook.com/tools/explorer/" target="_blank" rel="noopener" class="text-info font-weight-bold">Graph API Explorer <i class="fas fa-external-link-alt" style="font-size: 10px;"></i></a>.</li>
                                <li>In the <strong>User or Page</strong> dropdown, choose your <strong>Page (Wake Up ICT)</strong> instead of "User Token".</li>
                                <li>Check permissions: <code style="color: #6ee7b7; background: #064e3b; padding: 1px 4px; border-radius: 4px;">pages_show_list</code>, <code style="color: #6ee7b7; background: #064e3b; padding: 1px 4px; border-radius: 4px;">pages_read_engagement</code>, <code style="color: #6ee7b7; background: #064e3b; padding: 1px 4px; border-radius: 4px;">pages_read_user_content</code>.</li>
                                <li>Click <strong>Generate Access Token</strong> and paste it below. <em>Page tokens never expire!</em></li>
                            </ol>
                        </div>

                        <div class="form-group mb-2">
                            <label class="text-white font-weight-bold small mb-1">Facebook Page ID / Numeric ID</label>
                            <input type="text" name="facebook_page_id" class="form-control form-control-sm" value="{{ app_setting('facebook_page_id', '854068321357052') }}" placeholder="e.g. 854068321357052 or wakeupict" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>

                        <div class="form-group mb-2">
                            <label class="text-white font-weight-bold small mb-1">Facebook Page Access Token (Never-Expiring)</label>
                            <input type="password" name="facebook_access_token" class="form-control form-control-sm" value="{{ app_setting('facebook_access_token') }}" placeholder="EAA... (Permanent Page Access Token)" style="background: #0f172a; border-color: #334155; color: #fff;">
                            <small class="text-muted">A valid Page Token remains connected permanently until manually revoked or deleted.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-white font-weight-bold small mb-1">Display Name</label>
                            <input type="text" name="facebook_page_name" class="form-control form-control-sm" value="{{ app_setting('facebook_page_name', 'Wake Up ICT Official') }}" style="background: #0f172a; border-color: #334155; color: #fff;">
                        </div>

                        <!-- Optional Auto-Exchange Credentials -->
                        <div class="card p-3 mb-2" style="background: rgba(15, 23, 42, 0.6); border: 1px dashed rgba(100, 116, 139, 0.4); border-radius: 8px;">
                            <div class="font-weight-bold text-white small mb-2 d-flex align-items-center justify-content-between">
                                <span><i class="fas fa-magic mr-1 text-warning"></i> Optional: Auto-Exchange Token with App Credentials</span>
                                <span class="badge badge-secondary" style="font-size: 10px;">Optional</span>
                            </div>
                            <p class="text-muted mb-2" style="font-size: 11px;">If you have a Facebook App ID & App Secret, the system will automatically exchange any short-lived token into a permanent Never-Expiring token on save.</p>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted small mb-1">Facebook App ID</label>
                                    <input type="text" name="facebook_app_id" class="form-control form-control-sm" value="{{ app_setting('facebook_app_id') }}" placeholder="e.g. 10483920..." style="background: #0f172a; border-color: #334155; color: #fff;">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="text-muted small mb-1">Facebook App Secret</label>
                                    <input type="password" name="facebook_app_secret" class="form-control form-control-sm" value="{{ app_setting('facebook_app_secret') }}" placeholder="App Secret key" style="background: #0f172a; border-color: #334155; color: #fff;">
                                </div>
                            </div>
                        </div>
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
