@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Student Portal Dynamic Menus — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('student_menu_active', 'active')

@section('maincontant')
<style>
    /* =========================================================================
       HIGH-CONTRAST THEME STYLING (COMMANDS.md COMPLIANT)
       ========================================================================= */
    .menu-builder-card {
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        overflow: hidden;
    }

    /* Light Theme (Strict Contrast) */
    html.light .menu-builder-card,
    body:not(.dark-mode) .menu-builder-card {
        background-color: #ffffff;
        color: #0f172a;
    }
    html.light .menu-builder-table thead th,
    body:not(.dark-mode) .menu-builder-table thead th {
        background-color: #f1f5f9;
        color: #0f172a;
        font-weight: 700;
        border-bottom: 2px solid #cbd5e1;
        font-size: 12px;
        letter-spacing: 0.05em;
    }
    html.light .menu-builder-table tbody tr,
    body:not(.dark-mode) .menu-builder-table tbody tr {
        color: #0f172a;
        border-bottom: 1px solid #e2e8f0;
    }
    html.light .menu-builder-table tr.parent-row,
    body:not(.dark-mode) .menu-builder-table tr.parent-row {
        background-color: #f8fafc;
        font-weight: 600;
    }
    html.light .menu-builder-table tr.parent-row:hover,
    body:not(.dark-mode) .menu-builder-table tr.parent-row:hover {
        background-color: #f1f5f9;
    }
    html.light .menu-builder-table tr.child-row,
    body:not(.dark-mode) .menu-builder-table tr.child-row {
        background-color: #ffffff;
    }
    html.light .menu-builder-table tr.child-row:hover,
    body:not(.dark-mode) .menu-builder-table tr.child-row:hover {
        background-color: #f8fafc;
    }
    html.light .menu-title-primary,
    body:not(.dark-mode) .menu-title-primary {
        color: #0f172a !important;
        font-weight: 700;
    }
    html.light .menu-title-secondary,
    body:not(.dark-mode) .menu-title-secondary {
        color: #334155 !important;
        font-weight: 600;
    }
    html.light .code-key,
    body:not(.dark-mode) .code-key {
        background-color: #f1f5f9;
        color: #0369a1;
        border: 1px solid #cbd5e1;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 600;
        font-family: monospace;
    }

    /* Dark Theme */
    html.dark .menu-builder-card,
    body.dark-mode .menu-builder-card {
        background-color: #1e293b;
        border-color: #334155;
        color: #f8fafc;
    }
    html.dark .menu-builder-table thead th,
    body.dark-mode .menu-builder-table thead th {
        background-color: #0f172a;
        color: #f8fafc;
        border-bottom: 2px solid #334155;
    }
    html.dark .menu-builder-table tbody tr,
    body.dark-mode .menu-builder-table tbody tr {
        color: #e2e8f0;
        border-bottom: 1px solid #334155;
    }
    html.dark .menu-builder-table tr.parent-row,
    body.dark-mode .menu-builder-table tr.parent-row {
        background-color: #182234;
    }
    html.dark .menu-builder-table tr.child-row,
    body.dark-mode .menu-builder-table tr.child-row {
        background-color: #1e293b;
    }
    html.dark .menu-title-primary,
    body.dark-mode .menu-title-primary {
        color: #ffffff !important;
    }
    html.dark .menu-title-secondary,
    body.dark-mode .menu-title-secondary {
        color: #cbd5e1 !important;
    }
    html.dark .code-key,
    body.dark-mode .code-key {
        background-color: #0f172a;
        color: #38bdf8;
        border: 1px solid #334155;
    }

    /* Icon chips */
    .icon-chip {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.15s ease;
        margin: 2px;
    }
    .icon-chip:hover {
        background: #0284c7;
        color: #ffffff;
        border-color: #0284c7;
        transform: scale(1.1);
    }
    .reorder-btn {
        width: 24px;
        height: 24px;
        padding: 0;
        line-height: 22px;
        font-size: 11px;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card menu-builder-card shadow-sm">
            
            <!-- Card Header -->
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center py-3">
                <div class="mb-2 mb-md-0">
                    <h3 class="card-title font-weight-bold menu-title-primary mb-1">
                        <i class="fas fa-sitemap text-primary mr-2"></i>
                        Student Portal Dynamic Menu & Module Manager
                    </h3>
                    <p class="mb-0 text-sm menu-title-secondary">
                        Manage all Student Portal navigation menus, icons, English & Bengali labels, routes, ordering, and live visibility in real-time.
                    </p>
                </div>
                <div class="card-tools d-flex flex-wrap align-items-center gap-2">
                    <!-- Live Search -->
                    <div class="input-group input-group-sm mr-2 mb-1 mb-md-0" style="width: 240px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="menuSearchInput" class="form-control" placeholder="Search menus, routes...">
                    </div>

                    <!-- Open Student Portal Live Shortcut -->
                    <a href="{{ route('student.dashboard') }}" target="_blank" class="btn btn-sm btn-outline-success font-weight-bold mr-2 mb-1 mb-md-0">
                        <i class="fas fa-external-link-alt mr-1"></i> Student Portal
                    </a>

                    <!-- Reset to Defaults -->
                    <form action="{{ route('admin.student-menus.reset') }}" method="POST" class="d-inline mr-2 mb-1 mb-md-0" onsubmit="return confirm('Reset all Student Portal menus to factory defaults? Any custom items will be restored.');">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm font-weight-bold text-dark">
                            <i class="fas fa-undo mr-1"></i> Reset Defaults
                        </button>
                    </form>

                    <!-- Add Menu Modal Trigger -->
                    <button type="button" class="btn btn-primary btn-sm font-weight-bold mb-1 mb-md-0" data-toggle="modal" data-target="#createMenuModal">
                        <i class="fas fa-plus mr-1"></i> Add Menu Item
                    </button>
                </div>
            </div>

            <!-- Card Body / Menus Table -->
            <div class="card-body table-responsive p-0">
                <table class="table menu-builder-table align-middle text-sm mb-0">
                    <thead>
                        <tr class="text-uppercase">
                            <th style="width: 90px;" class="text-center">Reorder</th>
                            <th style="width: 280px;">Menu Label (EN / বাংলা)</th>
                            <th style="width: 170px;">Identifier Key</th>
                            <th style="width: 120px;" class="text-center">Icon</th>
                            <th>Target Route / URL</th>
                            <th style="width: 110px;" class="text-center">Status</th>
                            <th style="width: 130px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="menuTableBody">
                        @forelse($menus as $menu)
                            <!-- Parent Menu Row -->
                            <tr class="parent-row" data-search="{{ strtolower($menu->title_en . ' ' . $menu->title_bn . ' ' . $menu->menu_key . ' ' . $menu->route_name . ' ' . $menu->url) }}">
                                <td class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <form action="{{ route('admin.student-menus.move', [$menu->id, 'up']) }}" method="POST" class="d-inline mr-1">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-secondary btn-xs reorder-btn" title="Move Up">
                                                <i class="fas fa-arrow-up"></i>
                                            </button>
                                        </form>
                                        <span class="font-weight-bold px-1">{{ $menu->order_index }}</span>
                                        <form action="{{ route('admin.student-menus.move', [$menu->id, 'down']) }}" method="POST" class="d-inline ml-1">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-secondary btn-xs reorder-btn" title="Move Down">
                                                <i class="fas fa-arrow-down"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <span class="badge badge-primary mr-2 px-2 py-1">Parent</span>
                                        <div>
                                            <div class="menu-title-primary font-weight-bold">{{ $menu->title_en }}</div>
                                            <div class="menu-title-secondary font-weight-bold text-xs">{{ $menu->title_bn }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="code-key">{{ $menu->menu_key }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-inline-flex flex-column align-items-center">
                                        <i class="{{ $menu->icon }} fa-lg text-primary mb-1"></i>
                                        <span class="font-mono text-xs text-muted">{{ $menu->icon }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @if($menu->route_name)
                                        <span class="badge badge-info font-mono px-2 py-1">route: {{ $menu->route_name }}</span>
                                    @elseif($menu->url)
                                        <span class="badge badge-secondary font-mono px-2 py-1">url: {{ $menu->url }}</span>
                                    @else
                                        <span class="badge badge-light border text-muted">Dropdown Category</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" 
                                            class="btn btn-xs {{ $menu->is_active ? 'btn-success font-weight-bold' : 'btn-secondary' }} toggle-status-btn px-2"
                                            data-id="{{ $menu->id }}">
                                        <i class="fas {{ $menu->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                        {{ $menu->is_active ? 'Active' : 'Disabled' }}
                                    </button>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group btn-group-xs">
                                        <button type="button" class="btn btn-outline-primary edit-menu-btn" 
                                                data-menu='@json($menu)' title="Edit Menu Item">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" 
                                                onclick="if(confirm('Delete {{ $menu->title_en }} and all its submenus?')) { document.getElementById('delete-menu-{{ $menu->id }}').submit(); }"
                                                title="Delete Menu Item">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-menu-{{ $menu->id }}" action="{{ route('admin.student-menus.destroy', $menu->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <!-- Children Submenus -->
                            @foreach($menu->children as $child)
                                <tr class="child-row" data-parent-key="{{ $menu->menu_key }}" data-search="{{ strtolower($child->title_en . ' ' . $child->title_bn . ' ' . $child->menu_key . ' ' . $child->route_name . ' ' . $child->url . ' ' . $menu->title_en) }}">
                                    <td class="text-center align-middle">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <form action="{{ route('admin.student-menus.move', [$child->id, 'up']) }}" method="POST" class="d-inline mr-1">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-secondary btn-xs reorder-btn" title="Move Up">
                                                    <i class="fas fa-arrow-up"></i>
                                                </button>
                                            </form>
                                            <span class="font-weight-bold px-1 text-muted">{{ $child->order_index }}</span>
                                            <form action="{{ route('admin.student-menus.move', [$child->id, 'down']) }}" method="POST" class="d-inline ml-1">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-secondary btn-xs reorder-btn" title="Move Down">
                                                    <i class="fas fa-arrow-down"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="align-middle pl-4">
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted mr-2 font-weight-bold">↳</span>
                                            <span class="badge badge-secondary mr-2 px-2 py-1">Submenu</span>
                                            <div>
                                                <div class="menu-title-primary font-weight-bold">{{ $child->title_en }}</div>
                                                <div class="menu-title-secondary font-weight-bold text-xs">{{ $child->title_bn }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="code-key">{{ $child->menu_key }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-inline-flex flex-column align-items-center">
                                            <i class="{{ $child->icon }} fa-lg text-info mb-1"></i>
                                            <span class="font-mono text-xs text-muted">{{ $child->icon }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($child->route_name)
                                            <span class="badge badge-info font-mono px-2 py-1">route: {{ $child->route_name }}</span>
                                        @elseif($child->url)
                                            <span class="badge badge-secondary font-mono px-2 py-1">url: {{ $child->url }}</span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <button type="button" 
                                                class="btn btn-xs {{ $child->is_active ? 'btn-success font-weight-bold' : 'btn-secondary' }} toggle-status-btn px-2"
                                                data-id="{{ $child->id }}">
                                            <i class="fas {{ $child->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                            {{ $child->is_active ? 'Active' : 'Disabled' }}
                                        </button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group btn-group-xs">
                                            <button type="button" class="btn btn-outline-primary edit-menu-btn" 
                                                    data-menu='@json($child)' title="Edit Submenu Item">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" 
                                                    onclick="if(confirm('Delete {{ $child->title_en }}?')) { document.getElementById('delete-menu-{{ $child->id }}').submit(); }"
                                                    title="Delete Submenu Item">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-menu-{{ $child->id }}" action="{{ route('admin.student-menus.destroy', $child->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                    <p class="font-weight-bold mb-2">No Student Portal menus found in database.</p>
                                    <p class="text-sm mb-3">Click below to auto-generate the complete standard menu structure.</p>
                                    <form action="{{ route('admin.student-menus.reset') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm font-weight-bold">
                                            <i class="fas fa-magic mr-1"></i> Populate Standard Factory Defaults
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- =========================================================================
     MODAL: EDIT MENU ITEM
     ========================================================================= -->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editMenuForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i> Edit Student Portal Menu Item
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-sm">
                <div class="row">
                    <!-- Preset Route Helper -->
                    <div class="col-md-12 form-group bg-light p-3 rounded border">
                        <label class="font-weight-bold text-primary mb-1">
                            <i class="fas fa-magic mr-1"></i> Preset System Route Helper
                        </label>
                        <select id="edit_preset_selector" class="form-control form-control-sm">
                            <option value="">-- Choose preset route to auto-populate (Optional) --</option>
                            @foreach($availableRoutes as $routeKey => $routeInfo)
                                <option value="{{ $routeKey }}" 
                                        data-en="{{ $routeInfo['title_en'] }}" 
                                        data-bn="{{ $routeInfo['title_bn'] }}" 
                                        data-icon="{{ $routeInfo['icon'] }}">
                                    {{ $routeInfo['label'] }} ({{ $routeKey }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Selecting an option fills English title, Bengali title, and icon automatically.</small>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Label (English) <span class="text-danger">*</span></label>
                        <input type="text" name="title_en" id="edit_title_en" required class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Label (Bengali / বাংলা) <span class="text-danger">*</span></label>
                        <input type="text" name="title_bn" id="edit_title_bn" required class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Icon Class <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i id="edit_icon_preview" class="fa fa-circle"></i></span>
                            </div>
                            <input type="text" name="icon" id="edit_icon" required class="form-control" onkeyup="document.getElementById('edit_icon_preview').className = this.value;">
                        </div>
                        <!-- Quick Icon Chips -->
                        <div class="mt-2">
                            <small class="d-block text-muted mb-1 font-weight-bold">Quick Select Icon:</small>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-dashboard')" title="Dashboard"><i class="fa fa-dashboard"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-book')" title="Courses"><i class="fa fa-book"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-graduation-cap')" title="Graduation"><i class="fa fa-graduation-cap"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-calendar')" title="Calendar"><i class="fa fa-calendar"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-calendar-check-o')" title="Attendance"><i class="fa fa-calendar-check-o"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-tasks')" title="Tasks"><i class="fa fa-tasks"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-question-circle')" title="Quiz"><i class="fa fa-question-circle"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-trophy')" title="Trophy"><i class="fa fa-trophy"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-credit-card')" title="Fee"><i class="fa fa-credit-card"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-bell')" title="Notice"><i class="fa fa-bell"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-user-circle')" title="Profile"><i class="fa fa-user-circle"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-download')" title="Download"><i class="fa fa-download"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-video-camera')" title="Live Class"><i class="fa fa-video-camera"></i></span>
                            <span class="icon-chip" onclick="setEditIcon('fa fa-life-ring')" title="Support"><i class="fa fa-life-ring"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Order Index <span class="text-danger">*</span></label>
                        <input type="number" name="order_index" id="edit_order_index" required class="form-control">
                        <small class="text-muted">Smaller numbers appear earlier in the menu list.</small>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Parent Category</label>
                        <select name="parent_id" id="edit_parent_id" class="form-control">
                            <option value="0">— None (Top-Level Parent Menu) —</option>
                            @foreach($allParents as $p)
                                <option value="{{ $p->id }}">{{ $p->title_en }} ({{ $p->title_bn }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Target Named Route</label>
                        <input type="text" name="route_name" id="edit_route_name" class="form-control" placeholder="e.g. student.dashboard">
                        <small class="text-muted">Laravel route name (overrides Custom URL if set).</small>
                    </div>

                    <div class="col-md-12 form-group">
                        <label class="font-weight-bold">Custom URL (if route not used)</label>
                        <input type="text" name="url" id="edit_url" class="form-control" placeholder="e.g. /student/custom-page">
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="edit_is_active" name="is_active" value="1">
                            <label class="custom-control-label font-weight-bold" for="edit_is_active">Enable this menu item in Student Portal sidebar</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL: CREATE NEW MENU ITEM
     ========================================================================= -->
<div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.student-menus.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus mr-2"></i> Add Custom Student Portal Menu Item
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-sm">
                <div class="row">
                    <!-- Preset Route Helper -->
                    <div class="col-md-12 form-group bg-light p-3 rounded border">
                        <label class="font-weight-bold text-primary mb-1">
                            <i class="fas fa-magic mr-1"></i> Preset System Route Helper
                        </label>
                        <select id="create_preset_selector" class="form-control form-control-sm">
                            <option value="">-- Choose preset route to auto-populate (Optional) --</option>
                            @foreach($availableRoutes as $routeKey => $routeInfo)
                                <option value="{{ $routeKey }}" 
                                        data-en="{{ $routeInfo['title_en'] }}" 
                                        data-bn="{{ $routeInfo['title_bn'] }}" 
                                        data-icon="{{ $routeInfo['icon'] }}">
                                    {{ $routeInfo['label'] }} ({{ $routeKey }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Selecting an option fills English title, Bengali title, and icon automatically.</small>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Identifier Key <span class="text-danger">*</span></label>
                        <input type="text" name="menu_key" id="create_menu_key" required class="form-control" placeholder="e.g. career_guidance">
                        <small class="text-muted">Unique key (snake_case) used by feature middleware.</small>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Order Index</label>
                        <input type="number" name="order_index" value="10" class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Label (English) <span class="text-danger">*</span></label>
                        <input type="text" name="title_en" id="create_title_en" required class="form-control" placeholder="e.g. Career Guidance">
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Label (Bengali / বাংলা) <span class="text-danger">*</span></label>
                        <input type="text" name="title_bn" id="create_title_bn" required class="form-control" placeholder="e.g. ক্যারিয়ার গাইডেন্স">
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Icon Class <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i id="create_icon_preview" class="fa fa-circle"></i></span>
                            </div>
                            <input type="text" name="icon" id="create_icon" value="fa fa-circle-o" required class="form-control" onkeyup="document.getElementById('create_icon_preview').className = this.value;">
                        </div>
                        <!-- Quick Icon Chips -->
                        <div class="mt-2">
                            <small class="d-block text-muted mb-1 font-weight-bold">Quick Select Icon:</small>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-dashboard')"><i class="fa fa-dashboard"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-book')"><i class="fa fa-book"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-graduation-cap')"><i class="fa fa-graduation-cap"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-calendar')"><i class="fa fa-calendar"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-tasks')"><i class="fa fa-tasks"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-question-circle')"><i class="fa fa-question-circle"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-trophy')"><i class="fa fa-trophy"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-credit-card')"><i class="fa fa-credit-card"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-bell')"><i class="fa fa-bell"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-user-circle')"><i class="fa fa-user-circle"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-download')"><i class="fa fa-download"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-video-camera')"><i class="fa fa-video-camera"></i></span>
                            <span class="icon-chip" onclick="setCreateIcon('fa fa-life-ring')"><i class="fa fa-life-ring"></i></span>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Parent Category</label>
                        <select name="parent_id" class="form-control">
                            <option value="0">— None (Top-Level Parent Menu) —</option>
                            @foreach($allParents as $p)
                                <option value="{{ $p->id }}">{{ $p->title_en }} ({{ $p->title_bn }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Target Route</label>
                        <input type="text" name="route_name" id="create_route_name" class="form-control" placeholder="e.g. student.dashboard">
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Target URL</label>
                        <input type="text" name="url" class="form-control" placeholder="/student/career">
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="create_is_active" name="is_active" value="1" checked>
                            <label class="custom-control-label font-weight-bold" for="create_is_active">Enable upon creation</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Create Menu Item</button>
            </div>
        </form>
    </div>
</div>

<script>
    function setEditIcon(iconClass) {
        document.getElementById('edit_icon').value = iconClass;
        document.getElementById('edit_icon_preview').className = iconClass;
    }

    function setCreateIcon(iconClass) {
        document.getElementById('create_icon').value = iconClass;
        document.getElementById('create_icon_preview').className = iconClass;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Preset Route Selectors Auto-fill
        $('#create_preset_selector').on('change', function() {
            var selected = $(this).find(':selected');
            var route = $(this).val();
            if (route) {
                $('#create_route_name').val(route);
                $('#create_title_en').val(selected.data('en') || '');
                $('#create_title_bn').val(selected.data('bn') || '');
                var icon = selected.data('icon') || 'fa fa-circle-o';
                setCreateIcon(icon);
                if (!$('#create_menu_key').val()) {
                    var generatedKey = route.replace(/^student\./, '').replace(/\./g, '_');
                    $('#create_menu_key').val(generatedKey);
                }
            }
        });

        $('#edit_preset_selector').on('change', function() {
            var selected = $(this).find(':selected');
            var route = $(this).val();
            if (route) {
                $('#edit_route_name').val(route);
                $('#edit_title_en').val(selected.data('en') || '');
                $('#edit_title_bn').val(selected.data('bn') || '');
                var icon = selected.data('icon') || 'fa fa-circle-o';
                setEditIcon(icon);
            }
        });

        // Edit modal population
        $('.edit-menu-btn').on('click', function() {
            var menu = $(this).data('menu');
            var form = $('#editMenuForm');
            form.attr('action', '{{ url("admin/student-menus") }}/' + menu.id);
            
            $('#edit_title_en').val(menu.title_en);
            $('#edit_title_bn').val(menu.title_bn);
            $('#edit_icon').val(menu.icon);
            $('#edit_icon_preview').attr('class', menu.icon);
            $('#edit_order_index').val(menu.order_index);
            $('#edit_parent_id').val(menu.parent_id || 0);
            $('#edit_route_name').val(menu.route_name || '');
            $('#edit_url').val(menu.url || '');
            $('#edit_is_active').prop('checked', menu.is_active ? true : false);
            
            // Set preset selector if matched
            if (menu.route_name) {
                $('#edit_preset_selector').val(menu.route_name);
            } else {
                $('#edit_preset_selector').val('');
            }

            $('#editMenuModal').modal('show');
        });

        // Live Search Filter
        $('#menuSearchInput').on('keyup', function() {
            var term = $(this).val().toLowerCase().trim();
            if (!term) {
                $('#menuTableBody tr').show();
                return;
            }

            $('#menuTableBody tr').each(function() {
                var searchData = $(this).data('search') || '';
                if (searchData.indexOf(term) > -1) {
                    $(this).show();
                    // If child matched, also show its parent
                    var parentKey = $(this).data('parent-key');
                    if (parentKey) {
                        $('#menuTableBody tr.parent-row').each(function() {
                            if (($(this).data('search') || '').indexOf(parentKey) > -1) {
                                $(this).show();
                            }
                        });
                    }
                } else {
                    $(this).hide();
                }
            });
        });

        // AJAX Toggle button
        $('.toggle-status-btn').on('click', function() {
            var btn = $(this);
            var id = btn.data('id');
            $.ajax({
                url: '{{ url("admin/student-menus") }}/' + id + '/toggle',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.is_active) {
                        btn.removeClass('btn-secondary').addClass('btn-success font-weight-bold')
                           .html('<i class="fas fa-check-circle mr-1"></i> Active');
                    } else {
                        btn.removeClass('btn-success font-weight-bold').addClass('btn-secondary')
                           .html('<i class="fas fa-times-circle mr-1"></i> Disabled');
                    }
                    if (typeof toastr !== 'undefined') {
                        toastr.success(res.message);
                    }
                },
                error: function() {
                    if (typeof toastr !== 'undefined') {
                        toastr.error('Failed to update status.');
                    } else {
                        alert('Failed to update status.');
                    }
                }
            });
        });
    });
</script>
@endsection
