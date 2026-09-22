<!-- Navbar — Wake Up ICT Enterprise Admin Topbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-flex align-items-center">
            <span style="font-size:11px; font-weight:600; letter-spacing:0.1em; text-transform:uppercase; color:#64748b; font-family:'JetBrains Mono',monospace; padding: 0 4px;">
                Admin Console
            </span>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" style="align-items:center; gap: 6px;">

        <!-- Live Site Button -->
        <li class="nav-item d-none d-sm-flex">
            <a href="{{ route('home-page') }}" target="_blank" class="admin-live-btn" title="View live website">
                <span class="btn-dot"></span>
                Live Site
                <i class="fas fa-arrow-up-right-from-square" style="font-size:9px;opacity:0.7;"></i>
            </a>
        </li>

        <!-- Language Switcher -->
        <li class="nav-item d-flex align-items-center">
            <div class="lang-switcher-pill d-flex align-items-center" style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(51, 65, 85, 0.8); border-radius: 9999px; padding: 2px 4px; font-size: 11px; font-weight: 600; font-family: 'JetBrains Mono', monospace;">
                <a href="{{ route('language.switch', 'en') }}" class="px-2 py-1 {{ App::getLocale() == 'en' ? 'text-white active-lang' : 'text-muted' }}" style="{{ App::getLocale() == 'en' ? 'background: var(--brand-primary, #10b981); border-radius: 9999px; text-decoration: none;' : 'text-decoration: none;' }}">
                    EN
                </a>
                <span style="color: #475569; padding: 0 2px;">|</span>
                <a href="{{ route('language.switch', 'bn') }}" class="px-2 py-1 {{ App::getLocale() == 'bn' ? 'text-white active-lang' : 'text-muted' }}" style="{{ App::getLocale() == 'bn' ? 'background: var(--brand-primary, #10b981); border-radius: 9999px; text-decoration: none;' : 'text-decoration: none;' }}">
                    বাং
                </a>
            </div>
        </li>

        <!-- Global Theme Switcher -->
        <li class="nav-item d-flex align-items-center">
            <div class="dropdown">
                <button type="button" class="btn btn-sm btn-dark d-flex align-items-center" data-toggle="dropdown" id="adminThemeBtn" style="background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(51, 65, 85, 0.8); border-radius: 9999px; padding: 3px 10px; font-size: 11px; font-family: 'JetBrains Mono', monospace; color: #94a3b8;" title="Toggle Theme (Dark / Light / Dynamic)">
                    <span id="admThemeIconDark"><i class="fas fa-moon mr-1" style="color: var(--brand-primary, #10b981);"></i> Dark</span>
                    <span id="admThemeIconLight" style="display:none;"><i class="fas fa-sun mr-1 text-warning"></i> Light</span>
                    <span id="admThemeIconCustom" style="display:none;"><i class="fas fa-wand-magic-sparkles mr-1 text-info"></i> Dynamic</span>
                    <i class="fas fa-chevron-down ml-1" style="font-size: 8px; opacity: 0.6;"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="background: #0f172a; border: 1px solid #1e293b; border-radius: 8px; font-size: 12px; min-width: 140px;">
                    <a class="dropdown-item text-slate-200" href="javascript:void(0);" onclick="setAppTheme('dark')" style="color: #cbd5e1; padding: 6px 14px;">
                        <i class="fas fa-moon mr-2" style="color: var(--brand-primary, #10b981);"></i> Dark Mode
                    </a>
                    <a class="dropdown-item text-slate-200" href="javascript:void(0);" onclick="setAppTheme('light')" style="color: #cbd5e1; padding: 6px 14px;">
                        <i class="fas fa-sun mr-2 text-warning"></i> Light Mode
                    </a>
                    <a class="dropdown-item text-slate-200" href="javascript:void(0);" onclick="setAppTheme('custom')" style="color: #cbd5e1; padding: 6px 14px;">
                        <i class="fas fa-wand-magic-sparkles mr-2 text-info"></i> Dynamic
                    </a>
                </div>
            </div>
        </li>

        <!-- User Profile Dropdown -->
        <li class="nav-item">
            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile pt-0" data-toggle="dropdown" style="display:flex; align-items:center; gap:8px; padding: 4px 8px;">

                    @if (Auth::user()->photo == null)
                        <img style="height: 34px; width: 34px;" class="profile-user-img img-fluid img-circle"
                            src="{{ asset('uploads/profile/demo.jpg') }}"
                            alt="{{ Auth::user()->name }}'s photo">
                    @else
                        <img style="height: 34px; width: 34px;" class="profile-user-img img-fluid img-circle"
                            src="{{ URL::asset(Auth::user()->photo) }}" alt="{{ Auth::user()->name }}'s photo">
                    @endif

                    <span class="d-none d-md-block" style="font-size:12.5px; font-weight:500; color:#94a3b8; font-family:'Inter',sans-serif;">
                        {{ Auth::user()->name }}
                    </span>
                    <i class="fas fa-chevron-down d-none d-md-inline" style="font-size:9px; color:#64748b; margin-left:2px;"></i>

                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <!-- User Info Header -->
                    <div style="padding: 10px 16px 8px; border-bottom: 1px solid rgba(30,41,59,0.8); margin-bottom: 4px;">
                        <div style="font-size:13px; font-weight:600; color:#e2e8f0; font-family:'Inter',sans-serif;">
                            {{ Auth::user()->name }}
                        </div>
                        <div style="font-size:11px; color:#64748b; font-family:'JetBrains Mono',monospace; text-transform:uppercase; letter-spacing:0.06em; margin-top:2px;">
                            {{ Auth::user()->type }}
                        </div>
                    </div>

                    <a href="{{ route('profile') }}" class="dropdown-item">
                        <i class="far fa-user" style="width:16px; margin-right:8px; color:#64748b;"></i>
                        My Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('home-page') }}" target="_blank" class="dropdown-item">
                        <i class="fas fa-globe" style="width:16px; margin-right:8px; color:#64748b;"></i>
                        View Live Site
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       style="color: #f87171 !important;">
                        <i class="fas fa-right-from-bracket" style="width:16px; margin-right:8px; color:#f87171;"></i>
                        Sign Out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div><!-- dropdown-menu -->
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
