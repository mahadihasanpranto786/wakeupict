@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title', __('admin.theme.title'))

@section('appearance_menu_open', 'menu-open')
@section('appearance_active', 'active')
@section('appearance_theme_active', 'active')

@section('maincontant')
<div class="container-fluid px-2 px-md-4 py-3">
    <!-- Header banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(11, 19, 41, 0.95)); border: 1px solid rgba(51, 65, 85, 0.6); border-radius: 12px; box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <div>
                    <span class="badge px-3 py-1 mb-2" style="background: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.15); color: var(--brand-primary, #10b981); border: 1px solid rgba(var(--brand-primary-rgb, 16, 185, 129), 0.3); font-family: 'JetBrains Mono', monospace; font-size: 11px; letter-spacing: 0.08em; text-transform: uppercase;">
                        2026 Engine
                    </span>
                    <h2 class="text-white font-weight-bold mb-1" style="letter-spacing: -0.02em;">
                        {{ __('admin.theme.title') }}
                    </h2>
                    <p class="text-muted mb-0" style="font-size: 14px; max-width: 650px;">
                        {{ __('admin.theme.subtitle') }}
                    </p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="{{ route('home-page') }}" target="_blank" class="btn btn-outline-light px-3 py-2" style="border-radius: 8px; font-size: 13px;">
                        <i class="fas fa-external-link-alt mr-1"></i> Preview Live Site
                    </a>
                </div>
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

    <div class="row">
        <!-- Settings Form Column -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
                <div class="card-header border-bottom border-secondary py-3 px-4" style="background: rgba(15, 23, 42, 0.7);">
                    <h5 class="card-title text-white font-weight-bold mb-0">
                        <i class="fas fa-sliders-h mr-2" style="color: var(--brand-primary, #10b981);"></i> Theme Color Engine
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('appearance.theme.update') }}" method="POST" id="themeForm">
                        @csrf

                        <!-- Preset Palettes -->
                        <div class="form-group mb-4">
                            <label class="text-slate-300 font-weight-bold text-white mb-2" style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                {{ __('admin.theme.presets') }}
                            </label>
                            <div class="d-flex flex-wrap" style="gap: 10px;">
                                <button type="button" class="btn btn-dark palette-btn" data-primary="#10b981" data-accent="#34d399" data-cyan="#22d3ee" data-indigo="#6366f1" style="background:#0f172a; border:1px solid #334155; border-radius:8px; padding: 6px 12px; font-size:12px;">
                                    <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#10b981; margin-right:6px;"></span>
                                    Cyber Jade (Default)
                                </button>
                                <button type="button" class="btn btn-dark palette-btn" data-primary="#6366f1" data-accent="#818cf8" data-cyan="#38bdf8" data-indigo="#4f46e5" style="background:#0f172a; border:1px solid #334155; border-radius:8px; padding: 6px 12px; font-size:12px;">
                                    <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#6366f1; margin-right:6px;"></span>
                                    Electric Indigo
                                </button>
                                <button type="button" class="btn btn-dark palette-btn" data-primary="#06b6d4" data-accent="#22d3ee" data-cyan="#38bdf8" data-indigo="#0284c7" style="background:#0f172a; border:1px solid #334155; border-radius:8px; padding: 6px 12px; font-size:12px;">
                                    <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#06b6d4; margin-right:6px;"></span>
                                    Quantum Cyan
                                </button>
                                <button type="button" class="btn btn-dark palette-btn" data-primary="#f59e0b" data-accent="#fbbf24" data-cyan="#38bdf8" data-indigo="#d97706" style="background:#0f172a; border:1px solid #334155; border-radius:8px; padding: 6px 12px; font-size:12px;">
                                    <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#f59e0b; margin-right:6px;"></span>
                                    Enterprise Amber
                                </button>
                                <button type="button" class="btn btn-dark palette-btn" data-primary="#f43f5e" data-accent="#fb7185" data-cyan="#fda4af" data-indigo="#e11d48" style="background:#0f172a; border:1px solid #334155; border-radius:8px; padding: 6px 12px; font-size:12px;">
                                    <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:#f43f5e; margin-right:6px;"></span>
                                    Neon Rose
                                </button>
                            </div>
                        </div>

                        <!-- Primary Color Input -->
                        <div class="form-group mb-4">
                            <label class="text-white font-weight-bold mb-1" for="primary_color">
                                {{ __('admin.theme.primary_color') }} <span class="text-danger">*</span>
                            </label>
                            <p class="text-muted small mb-2">Used for active navigation states, primary buttons, accents, and key headers.</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text p-1" style="background: #1e293b; border-color: #334155;">
                                        <input type="color" id="primaryPicker" value="{{ $primaryColor }}" style="width: 38px; height: 32px; border: none; cursor: pointer; background: transparent;">
                                    </span>
                                </div>
                                <input type="text" name="theme_primary_color" id="primaryInput" class="form-control" value="{{ $primaryColor }}" style="background: #0f172a; border-color: #334155; color: #fff; font-family: 'JetBrains Mono', monospace;" required>
                            </div>
                        </div>

                        <!-- Accent Color Input -->
                        <div class="form-group mb-4">
                            <label class="text-white font-weight-bold mb-1" for="accent_color">
                                {{ __('admin.theme.accent_color') }} <span class="text-danger">*</span>
                            </label>
                            <p class="text-muted small mb-2">Used for hover glow reflections, badges, gradients, and secondary highlights.</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text p-1" style="background: #1e293b; border-color: #334155;">
                                        <input type="color" id="accentPicker" value="{{ $accentColor }}" style="width: 38px; height: 32px; border: none; cursor: pointer; background: transparent;">
                                    </span>
                                </div>
                                <input type="text" name="theme_accent_color" id="accentInput" class="form-control" value="{{ $accentColor }}" style="background: #0f172a; border-color: #334155; color: #fff; font-family: 'JetBrains Mono', monospace;" required>
                            </div>
                        </div>

                        <!-- Cyan/Secondary Input -->
                        <input type="hidden" name="theme_cyan_color" id="cyanInput" value="{{ $cyanColor }}">
                        <input type="hidden" name="theme_indigo_color" id="indigoInput" value="{{ $indigoColor }}">

                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold" id="saveThemeBtn" style="border-radius: 8px; background: var(--brand-primary, #10b981); border-color: var(--brand-primary, #10b981); color: #fff;">
                                <i class="fas fa-save mr-2"></i> {{ __('admin.theme.save_changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Real-Time Live Preview Column -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100" style="background: #0b1329; border: 1px solid #1e293b; border-radius: 12px;">
                <div class="card-header border-bottom border-secondary py-3 px-4 d-flex justify-content-between align-items-center" style="background: rgba(15, 23, 42, 0.7);">
                    <h5 class="card-title text-white font-weight-bold mb-0">
                        <i class="fas fa-eye mr-2" id="previewEyeIcon" style="color: var(--brand-primary, #10b981);"></i> {{ __('admin.theme.preview') }}
                    </h5>
                    <span class="badge" id="previewLiveBadge" style="background: rgba(var(--brand-primary-rgb, 16,185,129), 0.2); color: var(--brand-primary, #10b981); font-size: 11px;">
                        Interactive
                    </span>
                </div>
                <div class="card-body p-4" id="previewContainer">
                    <!-- Hero card preview -->
                    <div class="p-4 mb-4" id="previewCard" style="background: #030712; border: 1px solid rgba(var(--brand-primary-rgb, 16, 185, 129), 0.4); border-radius: 12px; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.8);">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge px-3 py-1" id="previewBadge" style="background: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.15); color: var(--brand-primary, #10b981); border: 1px solid rgba(var(--brand-primary-rgb, 16, 185, 129), 0.3); font-family: 'JetBrains Mono', monospace; font-size: 11px;">
                                Enterprise Demo
                            </span>
                            <span class="text-muted small">Live Output</span>
                        </div>
                        <h4 class="text-white font-weight-bold mb-2" id="previewHeading">
                            Architecting High-Performance <span id="previewHighlight" style="color: var(--brand-primary, #10b981);">Digital Solutions</span>
                        </h4>
                        <p class="text-slate-400 small mb-4" style="color: #94a3b8; line-height: 1.6;">
                            This preview box instantaneously reflects your custom color choices before you commit them to the database.
                        </p>
                        <div class="d-flex flex-wrap" style="gap: 10px;">
                            <button type="button" class="btn px-3 py-2 font-weight-bold" id="previewBtnPrimary" style="background: var(--brand-primary, #10b981); border: none; color: #fff; border-radius: 6px; font-size: 13px;">
                                Primary Action
                            </button>
                            <button type="button" class="btn px-3 py-2" id="previewBtnAccent" style="background: transparent; border: 1px solid var(--brand-accent, #34d399); color: var(--brand-accent, #34d399); border-radius: 6px; font-size: 13px;">
                                Outline Accent
                            </button>
                        </div>
                    </div>

                    <!-- Metrics bar preview -->
                    <div class="row text-center mb-2">
                        <div class="col-4">
                            <div class="p-3" style="background: #0f172a; border-radius: 8px; border: 1px solid #1e293b;">
                                <div class="font-weight-bold" id="previewStat1" style="font-size: 20px; color: var(--brand-primary, #10b981);">
                                    100%
                                </div>
                                <div class="text-muted" style="font-size: 11px;">Dynamic</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3" style="background: #0f172a; border-radius: 8px; border: 1px solid #1e293b;">
                                <div class="font-weight-bold" id="previewStat2" style="font-size: 20px; color: var(--brand-accent, #34d399);">
                                    2026
                                </div>
                                <div class="text-muted" style="font-size: 11px;">Modern</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3" style="background: #0f172a; border-radius: 8px; border: 1px solid #1e293b;">
                                <div class="font-weight-bold" id="previewStat3" style="font-size: 20px; color: #38bdf8;">
                                    Instant
                                </div>
                                <div class="text-muted" style="font-size: 11px;">Preview</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const primaryPicker = document.getElementById('primaryPicker');
        const primaryInput = document.getElementById('primaryInput');
        const accentPicker = document.getElementById('accentPicker');
        const accentInput = document.getElementById('accentInput');
        const cyanInput = document.getElementById('cyanInput');
        const indigoInput = document.getElementById('indigoInput');

        function hexToRgb(hex) {
            hex = hex.replace('#', '');
            if (hex.length === 3) {
                hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
            }
            if (hex.length !== 6) return '16, 185, 129';
            const r = parseInt(hex.substring(0, 2), 16);
            const g = parseInt(hex.substring(2, 4), 16);
            const b = parseInt(hex.substring(4, 6), 16);
            return `${r}, ${g}, ${b}`;
        }

        function updatePreview(primary, accent) {
            const rgbPrimary = hexToRgb(primary);
            const rgbAccent = hexToRgb(accent);

            // Update CSS variables on root
            document.documentElement.style.setProperty('--brand-primary', primary);
            document.documentElement.style.setProperty('--brand-primary-rgb', rgbPrimary);
            document.documentElement.style.setProperty('--brand-accent', accent);
            document.documentElement.style.setProperty('--brand-accent-rgb', rgbAccent);

            // Update preview elements directly
            document.getElementById('previewHighlight').style.color = primary;
            document.getElementById('previewBadge').style.color = primary;
            document.getElementById('previewBadge').style.borderColor = `rgba(${rgbPrimary}, 0.3)`;
            document.getElementById('previewBadge').style.backgroundColor = `rgba(${rgbPrimary}, 0.15)`;
            document.getElementById('previewCard').style.borderColor = `rgba(${rgbPrimary}, 0.4)`;
            document.getElementById('previewBtnPrimary').style.backgroundColor = primary;
            document.getElementById('previewBtnAccent').style.borderColor = accent;
            document.getElementById('previewBtnAccent').style.color = accent;
            document.getElementById('previewStat1').style.color = primary;
            document.getElementById('previewStat2').style.color = accent;
            document.getElementById('saveThemeBtn').style.backgroundColor = primary;
            document.getElementById('saveThemeBtn').style.borderColor = primary;
            document.getElementById('previewEyeIcon').style.color = primary;
            document.getElementById('previewLiveBadge').style.color = primary;
            document.getElementById('previewLiveBadge').style.backgroundColor = `rgba(${rgbPrimary}, 0.2)`;
        }

        // Color input bindings
        primaryPicker.addEventListener('input', function() {
            primaryInput.value = this.value;
            updatePreview(this.value, accentInput.value);
        });

        primaryInput.addEventListener('input', function() {
            if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                primaryPicker.value = this.value;
                updatePreview(this.value, accentInput.value);
            }
        });

        accentPicker.addEventListener('input', function() {
            accentInput.value = this.value;
            updatePreview(primaryInput.value, this.value);
        });

        accentInput.addEventListener('input', function() {
            if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                accentPicker.value = this.value;
                updatePreview(primaryInput.value, this.value);
            }
        });

        // Palette presets click handler
        document.querySelectorAll('.palette-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const p = this.getAttribute('data-primary');
                const a = this.getAttribute('data-accent');
                const c = this.getAttribute('data-cyan');
                const i = this.getAttribute('data-indigo');

                primaryPicker.value = p;
                primaryInput.value = p;
                accentPicker.value = a;
                accentInput.value = a;
                cyanInput.value = c;
                indigoInput.value = i;

                updatePreview(p, a);
            });
        });
    });
</script>
@endsection
