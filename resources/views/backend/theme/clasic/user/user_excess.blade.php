@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    User Access & Permissions (Folder-Wise)
@endsection

@section('user_active', 'menu-open')
@section('menu_active_user', 'active')
@section('user_list_list', 'active')

@section('maincontant')
<style>
    /* ==========================================================================
       USER ACCESS & PERMISSIONS — ENTERPRISE THEME & CONTRAST SYSTEM
       ========================================================================== */

    /* User Information Hero Banner */
    .user-excess-hero {
        border-radius: 14px !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04) !important;
        transition: all 0.25s ease !important;
    }
    html.dark .user-excess-hero {
        background: linear-gradient(135deg, #0d1526 0%, #1e293b 100%) !important;
        border-color: #334155 !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4) !important;
    }
    .user-excess-hero .hero-name {
        color: #0f172a !important;
        font-weight: 700 !important;
        font-size: 20px !important;
    }
    html.dark .user-excess-hero .hero-name {
        color: #ffffff !important;
    }
    .user-excess-hero .hero-meta {
        color: #334155 !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
    }
    html.dark .user-excess-hero .hero-meta {
        color: #cbd5e1 !important;
    }
    .user-excess-hero .hero-avatar {
        width: 54px !important;
        height: 54px !important;
        font-size: 22px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: 700 !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35) !important;
        flex-shrink: 0 !important;
    }
    .user-excess-hero .btn-hero-back {
        border-radius: 8px !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #1e293b !important;
        font-weight: 600 !important;
        transition: all 0.2s ease !important;
    }
    .user-excess-hero .btn-hero-back:hover {
        background: #f1f5f9 !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }
    html.dark .user-excess-hero .btn-hero-back {
        background: rgba(255, 255, 255, 0.06) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        color: #f1f5f9 !important;
    }
    html.dark .user-excess-hero .btn-hero-back:hover {
        background: rgba(255, 255, 255, 0.12) !important;
        color: #ffffff !important;
    }

    /* Main Container Cards */
    .excess-card {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03) !important;
    }
    html.dark .excess-card {
        background: #0d1526 !important;
        border-color: #1e293b !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4) !important;
    }
    .excess-card-header {
        background: #ffffff !important;
        border-bottom: 1px solid #e2e8f0 !important;
        color: #0f172a !important;
        border-radius: 12px 12px 0 0 !important;
    }
    html.dark .excess-card-header {
        background: #0b1324 !important;
        border-bottom-color: #1e293b !important;
        color: #f1f5f9 !important;
    }
    .excess-card-header h5, .excess-card-header h6 {
        color: #0f172a !important;
        font-weight: 700 !important;
    }
    html.dark .excess-card-header h5, html.dark .excess-card-header h6 {
        color: #f1f5f9 !important;
    }

    /* Search bar wrapper */
    .excess-search-bar {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
    html.dark .excess-search-bar {
        background: #080f1e !important;
        border-bottom-color: #1e293b !important;
    }
    .excess-search-bar .input-group-text {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-right: none !important;
        color: #64748b !important;
    }
    html.dark .excess-search-bar .input-group-text {
        background: #0c1628 !important;
        border-color: #1e293b !important;
        color: #94a3b8 !important;
    }
    .excess-search-bar .form-control {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-left: none !important;
        color: #0f172a !important;
    }
    html.dark .excess-search-bar .form-control {
        background: #0c1628 !important;
        border-color: #1e293b !important;
        color: #f1f5f9 !important;
    }

    /* Folder Accordion Item Cards */
    .folder-card {
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        border-radius: 10px !important;
        overflow: hidden !important;
        margin-bottom: 14px !important;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.03) !important;
    }
    html.dark .folder-card {
        border-color: #1e293b !important;
        background: #0d1526 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25) !important;
    }
    .folder-card .folder-header {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 10px 16px !important;
    }
    html.dark .folder-card .folder-header {
        background: #0a1120 !important;
        border-bottom-color: #1e293b !important;
    }
    .folder-card .folder-header .parent-label {
        color: #0f172a !important;
        font-weight: 700 !important;
        font-size: 14.5px !important;
    }
    html.dark .folder-card .folder-header .parent-label {
        color: #f1f5f9 !important;
    }
    .folder-card .folder-header .folder-count-badge {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        font-weight: 500 !important;
        font-size: 11px !important;
    }
    html.dark .folder-card .folder-header .folder-count-badge {
        background: #080f1e !important;
        border-color: #1e293b !important;
        color: #94a3b8 !important;
    }

    /* Sub-Module Boxes (e.g. Invest, Assets, Loan, Expense, etc.) */
    .subfolder-box {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 12px 14px !important;
        height: 100% !important;
        transition: all 0.2s ease !important;
    }
    .subfolder-box:hover {
        background: #ffffff !important;
        border-color: #cbd5e1 !important;
        box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05) !important;
    }
    html.dark .subfolder-box {
        background: #080f1e !important;
        border-color: #1e293b !important;
    }
    html.dark .subfolder-box:hover {
        border-color: #334155 !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3) !important;
    }

    /* Sub-Module Label */
    .subfolder-box .sub-label {
        color: #0f172a !important;
        font-weight: 600 !important;
        font-size: 13.5px !important;
    }
    html.dark .subfolder-box .sub-label {
        color: #e2e8f0 !important;
    }

    /* Sub-Sub Action Checkboxes */
    .subfolder-box .action-tree {
        border-left: 2px solid #cbd5e1 !important;
        padding-left: 12px !important;
        margin-top: 8px !important;
    }
    html.dark .subfolder-box .action-tree {
        border-left-color: #334155 !important;
    }
    .subfolder-box .action-label {
        color: #334155 !important;
        font-size: 12.5px !important;
        font-weight: 500 !important;
    }
    html.dark .subfolder-box .action-label {
        color: #94a3b8 !important;
    }

    /* Empty Top-Level Module Note */
    .single-module-notice {
        background: #f8fafc !important;
        border: 1px dashed #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 12px 16px !important;
        color: #475569 !important;
        font-size: 12.5px !important;
        margin: 0 !important;
    }
    html.dark .single-module-notice {
        background: #080f1e !important;
        border-color: #1e293b !important;
        color: #94a3b8 !important;
    }

    /* Bottom Action Bar */
    .excess-card-footer {
        background: #f8fafc !important;
        border-top: 1px solid #e2e8f0 !important;
        padding: 14px 20px !important;
        border-radius: 0 0 12px 12px !important;
    }
    html.dark .excess-card-footer {
        background: #0b1324 !important;
        border-top-color: #1e293b !important;
    }
    .selected-counter-badge {
        background: #0f172a !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        padding: 6px 14px !important;
        border-radius: 8px !important;
        font-size: 13px !important;
        letter-spacing: 0.02em !important;
        display: inline-block !important;
    }
    html.dark .selected-counter-badge {
        background: #059669 !important;
        color: #ffffff !important;
    }

    /* Quick Management Links in Right Column */
    .excess-shortcut-item {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 10px 14px !important;
        margin-bottom: 8px !important;
        color: #0f172a !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }
    .excess-shortcut-item:hover {
        background: #f8fafc !important;
        border-color: #cbd5e1 !important;
        color: #047857 !important;
        transform: translateX(2px) !important;
    }
    html.dark .excess-shortcut-item {
        background: #080f1e !important;
        border-color: #1e293b !important;
        color: #e2e8f0 !important;
    }
    html.dark .excess-shortcut-item:hover {
        background: #1e293b !important;
        border-color: #334155 !important;
        color: #34d399 !important;
    }

    /* Active Permissions Table */
    .excess-table th {
        background: #f8fafc !important;
        color: #334155 !important;
        font-weight: 600 !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
    html.dark .excess-table th {
        background: #080f1e !important;
        color: #cbd5e1 !important;
        border-bottom-color: #1e293b !important;
    }
    .excess-table td {
        border-bottom: 1px solid #f1f5f9 !important;
        color: #0f172a !important;
    }
    html.dark .excess-table td {
        border-bottom-color: #1e293b !important;
        color: #f1f5f9 !important;
    }
</style>

<div class="container-fluid py-3">

    <!-- User Information Header Banner -->
    <div class="card shadow-sm border-0 mb-4 user-excess-hero">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="hero-avatar mr-3">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="mb-1 hero-name">{{ $user->name }}</h4>
                            <div class="d-flex flex-wrap align-items-center hero-meta" style="gap: 8px;">
                                <span><i class="fas fa-envelope mr-1 text-primary"></i> {{ $user->email }}</span>
                                <span class="text-muted opacity-50">•</span>
                                <span><i class="fas fa-briefcase mr-1 text-warning"></i> {{ $user->designation->designation_name ?? 'Employee' }}</span>
                                <span class="text-muted opacity-50">•</span>
                                <span class="badge {{ $user->type == 'Admin' ? 'badge-danger' : 'badge-success' }} px-2 py-1 font-weight-semibold">{{ $user->type }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                    <a href="{{ route('user-list') }}" class="btn btn-hero-back btn-sm mr-2 px-3">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Users
                    </a>
                    <a href="{{ url('delete-all-excess/' . $user->id) }}" class="btn btn-danger btn-sm px-3" onclick="return confirm('Revoke ALL permissions for this user?');" style="border-radius: 8px;">
                        <i class="fas fa-trash-alt mr-1"></i> Clear All Permissions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('danger') || session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('danger') ?? session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <!-- Left: Hierarchical Folder-Wise Checkbox Permission Tree -->
        <div class="col-lg-8">
            <form action="{{ route('user_excess.store') }}" method="POST" id="permissions-form">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="card shadow-sm border-0 mb-4 excess-card">
                    <div class="card-header excess-card-header py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-0 font-weight-bold">
                                <i class="fas fa-folder-tree text-primary mr-2"></i> Folder-Wise Module Permissions
                            </h5>
                            <small class="text-muted">Check folders and sub-menus to grant access. Parent checkboxes automatically toggle child items.</small>
                        </div>
                        <div class="btn-group btn-group-sm mt-2 mt-md-0" role="group">
                            <button type="button" class="btn btn-outline-secondary" id="btn-expand-all" title="Expand all folders">
                                <i class="fas fa-folder-open mr-1"></i> Expand All
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="btn-collapse-all" title="Collapse all folders">
                                <i class="fas fa-folder mr-1"></i> Collapse All
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="btn-select-all" title="Select all modules">
                                <i class="fas fa-check-double mr-1"></i> Select All
                            </button>
                            <button type="button" class="btn btn-outline-danger" id="btn-deselect-all" title="Deselect all modules">
                                <i class="fas fa-times mr-1"></i> Deselect All
                            </button>
                        </div>
                    </div>

                    <!-- Search Filter Input -->
                    <div class="px-4 py-2.5 excess-search-bar">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                            </div>
                            <input type="text" id="module-search" class="form-control" placeholder="Filter menus or modules by title...">
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <div class="accordion" id="modulesAccordion">
                            @forelse ($modules as $modIndex => $item)
                                @php
                                    $isModChecked = in_array($item->id, $assignedModuleIds);
                                    $subCount = count($item->subModules);
                                @endphp

                                <div class="card folder-card mb-3 shadow-xs" data-title="{{ strtolower($item->title) }}">
                                    <!-- Folder Header -->
                                    <div class="card-header folder-header d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <!-- Toggle Chevron Button -->
                                            <button type="button" class="btn btn-sm btn-link p-0 mr-2 toggle-folder-btn" data-target="#folder-body-{{ $item->id }}" aria-expanded="true">
                                                <i class="fas fa-chevron-down text-secondary folder-chevron"></i>
                                            </button>

                                            <!-- Parent Folder Checkbox -->
                                            <div class="custom-control custom-checkbox mr-2">
                                                <input type="checkbox" 
                                                       class="custom-control-input parent-checkbox" 
                                                       id="mod-{{ $item->id }}" 
                                                       name="module_id[]" 
                                                       value="{{ $item->id }}"
                                                       data-folder-id="{{ $item->id }}"
                                                       {{ $isModChecked ? 'checked' : '' }}>
                                                <label class="custom-control-label parent-label cursor-pointer" for="mod-{{ $item->id }}">
                                                    <i class="fas fa-folder text-warning mr-1"></i> {{ $item->title }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <span class="badge folder-count-badge px-2 py-1 font-weight-normal mr-2">
                                                {{ $subCount }} {{ Str::plural('sub-item', $subCount) }}
                                            </span>
                                            <button type="button" class="btn btn-xs btn-outline-info select-folder-all" data-folder-id="{{ $item->id }}" style="font-size: 11px; padding: 2px 8px; border-radius: 6px;">
                                                Toggle All
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Folder Body (Sub-modules & Actions) -->
                                    <div id="folder-body-{{ $item->id }}" class="folder-body collapse show" data-parent-mod="{{ $item->id }}">
                                        <div class="card-body p-3">
                                            @if($subCount > 0)
                                                <div class="row">
                                                    @foreach ($item->subModules as $sub)
                                                        @php
                                                            $isSubChecked = in_array($sub->id, $assignedModuleIds);
                                                            $subSubCount = count($sub->subSubModules);
                                                        @endphp

                                                        <div class="col-md-6 mb-3 subfolder-item" data-title="{{ strtolower($sub->title) }}">
                                                            <div class="subfolder-box">
                                                                <!-- Sub-module Checkbox -->
                                                                <div class="custom-control custom-checkbox mb-1">
                                                                    <input type="checkbox" 
                                                                           class="custom-control-input child-checkbox sub-checkbox" 
                                                                           id="sub-{{ $sub->id }}" 
                                                                           name="module_id[]" 
                                                                           value="{{ $sub->id }}"
                                                                           data-parent-id="{{ $item->id }}"
                                                                           data-sub-id="{{ $sub->id }}"
                                                                           {{ $isSubChecked ? 'checked' : '' }}>
                                                                    <label class="custom-control-label sub-label cursor-pointer" for="sub-{{ $sub->id }}">
                                                                        <i class="fas fa-folder-open text-info mr-1"></i> {{ $sub->title }}
                                                                    </label>
                                                                </div>

                                                                <!-- Sub-Sub Modules / Action Checkboxes -->
                                                                @if($subSubCount > 0)
                                                                    <div class="action-tree">
                                                                        @foreach ($sub->subSubModules as $subsub)
                                                                            @php
                                                                                $isSubSubChecked = in_array($subsub->id, $assignedModuleIds);
                                                                            @endphp
                                                                            <div class="custom-control custom-checkbox my-1 subsub-item" data-title="{{ strtolower($subsub->title) }}">
                                                                                <input type="checkbox" 
                                                                                       class="custom-control-input child-checkbox subsub-checkbox" 
                                                                                       id="subsub-{{ $subsub->id }}" 
                                                                                       name="module_id[]" 
                                                                                       value="{{ $subsub->id }}"
                                                                                       data-parent-id="{{ $item->id }}"
                                                                                       data-sub-parent-id="{{ $sub->id }}"
                                                                                       {{ $isSubSubChecked ? 'checked' : '' }}>
                                                                                <label class="custom-control-label action-label cursor-pointer" for="subsub-{{ $subsub->id }}">
                                                                                    <i class="fas fa-file-alt text-muted mr-1" style="font-size: 11px;"></i> {{ $subsub->title }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="single-module-notice">
                                                    <i class="fas fa-info-circle mr-1 text-info"></i> This is a single top-level module with no sub-menus. Check above to grant access.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                                    <h5>No Modules Configured</h5>
                                    <p class="small">Add modules from the Module Management page to assign permissions.</p>
                                    <a href="{{ route('module') }}" class="btn btn-primary btn-sm">Add New Module</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Bottom Submit Footer -->
                    <div class="card-footer excess-card-footer d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="selected-counter-badge" id="selected-counter">
                                {{ count($assignedModuleIds) }} Permissions Selected
                            </span>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success px-4 font-weight-bold" style="border-radius: 8px;">
                                <i class="fas fa-save mr-1"></i> Save Permissions
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right: Current Assigned Permissions List & Quick Module Links -->
        <div class="col-lg-4">
            <!-- Active Permissions Summary Card -->
            <div class="card shadow-sm border-0 mb-4 excess-card">
                <div class="card-header excess-card-header py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 font-weight-bold">
                        <i class="fas fa-shield-alt text-success mr-2"></i> Current Active Permissions
                    </h6>
                    <span class="badge badge-success px-2 py-1">{{ $user_roll->total() }} Total</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 excess-table" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th class="py-2 pl-3">Module Name</th>
                                    <th class="py-2">Level</th>
                                    <th class="py-2 text-right pr-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user_roll as $excess)
                                    <tr>
                                        <td class="pl-3 font-weight-medium">
                                            @if($excess->module)
                                                <i class="fas fa-check-circle text-success mr-1"></i>
                                                {{ $excess->module->title }}
                                            @else
                                                <span class="text-danger font-italic">Module Removed (#{{ $excess->module_id }})</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($excess->module)
                                                @if ($excess->module->parents == 0 && $excess->module->orgine == 0)
                                                    <span class="badge badge-primary">Parent Folder</span>
                                                @elseif ($excess->module->orgine == $excess->module->parents && $excess->module->orgine != 0)
                                                    <span class="badge badge-info">Sub-Menu</span>
                                                @else
                                                    <span class="badge badge-secondary">Action Item</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-right pr-3">
                                            <a href="{{ url('delete_user_excess/' . $excess->id) }}" 
                                               class="btn btn-outline-danger btn-xs" 
                                               title="Revoke Permission"
                                               onclick="return confirm('Revoke this permission?');"
                                               style="padding: 2px 6px; border-radius: 4px;">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            <em>No permissions assigned to this user yet.</em>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($user_roll->hasPages())
                    <div class="card-footer excess-card-footer py-2 px-3">
                        <div class="float-right">
                            {{ $user_roll->links() }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Quick Management Shortcuts Card -->
            <div class="card shadow-sm border-0 excess-card">
                <div class="card-header excess-card-header py-3 border-bottom">
                    <h6 class="mb-0 font-weight-bold">
                        <i class="fas fa-sliders-h text-primary mr-2"></i> Menu & Module Management
                    </h6>
                </div>
                <div class="card-body p-3">
                    <p class="text-muted small mb-3">Manage all menus, sub-menus, and student portal navigation directly from these portals:</p>
                    <div>
                        <a href="{{ route('module') }}" class="excess-shortcut-item">
                            <span><i class="fas fa-folder text-warning mr-2"></i> Manage Admin Modules</span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                        </a>
                        <a href="{{ route('create_sub_module') }}" class="excess-shortcut-item">
                            <span><i class="fas fa-folder-plus text-info mr-2"></i> Add Admin Sub-Module</span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                        </a>
                        <a href="{{ route('create_sub_sub_module') }}" class="excess-shortcut-item">
                            <span><i class="fas fa-plus-circle text-primary mr-2"></i> Add Sub-Sub Module (Action)</span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                        </a>
                        <a href="{{ route('admin.appearance.menus.index') }}" class="excess-shortcut-item">
                            <span><i class="fas fa-bars text-success mr-2"></i> Manage Frontend Menus</span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                        </a>
                        <a href="{{ route('admin.student-menus.index') }}" class="excess-shortcut-item">
                            <span><i class="fas fa-graduation-cap text-danger mr-2"></i> Manage Student Portal Menus</span>
                            <i class="fas fa-arrow-right text-muted small"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Interactive Folder-Wise Tree JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Update Selected Counter
    function updateCounter() {
        const checkedCount = document.querySelectorAll('input[name="module_id[]"]:checked').length;
        const counterEl = document.getElementById('selected-counter');
        if (counterEl) {
            counterEl.textContent = checkedCount + ' Permissions Selected';
        }
    }

    // 2. Expand/Collapse Folder Chevrons
    document.querySelectorAll('.toggle-folder-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const targetEl = document.querySelector(targetId);
            const chevron = this.querySelector('.folder-chevron');
            if (targetEl) {
                if (targetEl.classList.contains('show')) {
                    $(targetEl).collapse('hide');
                    chevron.classList.remove('fa-chevron-down');
                    chevron.classList.add('fa-chevron-right');
                } else {
                    $(targetEl).collapse('show');
                    chevron.classList.remove('fa-chevron-right');
                    chevron.classList.add('fa-chevron-down');
                }
            }
        });
    });

    // 3. Parent Checkbox Toggles Entire Folder (Children & Sub-Children)
    document.querySelectorAll('.parent-checkbox').forEach(parentBox => {
        parentBox.addEventListener('change', function () {
            const folderId = this.getAttribute('data-folder-id');
            const isChecked = this.checked;
            const container = document.querySelector('[data-parent-mod="' + folderId + '"]');
            if (container) {
                container.querySelectorAll('input[type="checkbox"]').forEach(child => {
                    child.checked = isChecked;
                });
            }
            updateCounter();
        });
    });

    // 4. Sub-Module Checkbox Toggles its own Sub-Sub Action Children
    document.querySelectorAll('.sub-checkbox').forEach(subBox => {
        subBox.addEventListener('change', function () {
            const subId = this.getAttribute('data-sub-id');
            const isChecked = this.checked;
            document.querySelectorAll('[data-sub-parent-id="' + subId + '"]').forEach(subsub => {
                subsub.checked = isChecked;
            });

            // Also check parent folder if checked
            const parentId = this.getAttribute('data-parent-id');
            const parentBox = document.getElementById('mod-' + parentId);
            if (isChecked && parentBox) {
                parentBox.checked = true;
            }
            updateCounter();
        });
    });

    // 5. Sub-Sub Checkbox checks parent sub-module and parent folder
    document.querySelectorAll('.subsub-checkbox').forEach(subsubBox => {
        subsubBox.addEventListener('change', function () {
            if (this.checked) {
                const subParentId = this.getAttribute('data-sub-parent-id');
                const subBox = document.getElementById('sub-' + subParentId);
                if (subBox) subBox.checked = true;

                const parentId = this.getAttribute('data-parent-id');
                const parentBox = document.getElementById('mod-' + parentId);
                if (parentBox) parentBox.checked = true;
            }
            updateCounter();
        });
    });

    // 6. "Toggle All" Folder Button
    document.querySelectorAll('.select-folder-all').forEach(btn => {
        btn.addEventListener('click', function () {
            const folderId = this.getAttribute('data-folder-id');
            const parentBox = document.getElementById('mod-' + folderId);
            const container = document.querySelector('[data-parent-mod="' + folderId + '"]');
            if (parentBox && container) {
                const shouldCheck = !parentBox.checked;
                parentBox.checked = shouldCheck;
                container.querySelectorAll('input[type="checkbox"]').forEach(c => {
                    c.checked = shouldCheck;
                });
                updateCounter();
            }
        });
    });

    // 7. Global Actions: Expand / Collapse All
    document.getElementById('btn-expand-all').addEventListener('click', function () {
        document.querySelectorAll('.folder-body').forEach(el => $(el).collapse('show'));
        document.querySelectorAll('.folder-chevron').forEach(c => {
            c.classList.remove('fa-chevron-right');
            c.classList.add('fa-chevron-down');
        });
    });

    document.getElementById('btn-collapse-all').addEventListener('click', function () {
        document.querySelectorAll('.folder-body').forEach(el => $(el).collapse('hide'));
        document.querySelectorAll('.folder-chevron').forEach(c => {
            c.classList.remove('fa-chevron-down');
            c.classList.add('fa-chevron-right');
        });
    });

    // 8. Global Actions: Select All / Deselect All
    document.getElementById('btn-select-all').addEventListener('click', function () {
        document.querySelectorAll('input[name="module_id[]"]').forEach(box => box.checked = true);
        updateCounter();
    });

    document.getElementById('btn-deselect-all').addEventListener('click', function () {
        document.querySelectorAll('input[name="module_id[]"]').forEach(box => box.checked = false);
        updateCounter();
    });

    // 9. Real-time Search Filter
    const searchInput = document.getElementById('module-search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            document.querySelectorAll('.folder-card').forEach(card => {
                const title = card.getAttribute('data-title') || '';
                const bodyText = card.textContent.toLowerCase();
                if (q === '' || title.includes(q) || bodyText.includes(q)) {
                    card.style.display = '';
                    if (q !== '') {
                        $(card.querySelector('.folder-body')).collapse('show');
                    }
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Initialize counter on load
    updateCounter();
});
</script>
@endsection
