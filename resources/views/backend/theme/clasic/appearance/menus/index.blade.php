@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Frontend Menus Builder — Wake Up ICT')

@section('appearance_menu_open', 'menu-open')
@section('appearance_active', 'active')
@section('appearance_menus_active', 'active')

@section('maincontant')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary shadow">
            
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h3 class="card-title font-weight-bold text-dark">
                        <i class="fas fa-bars text-primary mr-2"></i>
                        Universal Frontend Navigation &amp; Menu Builder
                    </h3>
                    <p class="text-muted small mb-0 mt-1">
                        Control the entire public website navigation: manage header items, dropdown submenus, footer links, bilingual labels, and custom URLs.
                    </p>
                </div>
                <div class="card-tools d-flex align-items-center mt-2 mt-md-0">
                    <a href="{{ route('admin.student-menus.index') }}" class="btn btn-outline-info btn-sm mr-2 font-weight-bold">
                        <i class="fas fa-user-graduate mr-1"></i> Student Panel Menus
                    </a>
                    <form action="{{ route('admin.appearance.menus.reset') }}" method="POST" class="mr-2" onsubmit="return confirm('Restore default system menus for this location? Custom links will be reset to factory defaults.');">
                        @csrf
                        <input type="hidden" name="location" value="{{ $location }}">
                        <button type="submit" class="btn btn-warning btn-sm font-weight-bold text-dark">
                            <i class="fas fa-undo mr-1"></i> Reset Defaults
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#createMenuModal">
                        <i class="fas fa-plus mr-1"></i> Add Menu Item
                    </button>
                </div>
            </div>

            <!-- Location Tabs Navigation -->
            <div class="card-header p-2 bg-light border-bottom">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold {{ $location === 'header' ? 'active' : '' }}" 
                           href="{{ route('admin.appearance.menus.index', ['location' => 'header']) }}">
                            <i class="fas fa-compass mr-1"></i> Main Header &amp; Mobile Drawer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold {{ $location === 'footer_quick' ? 'active' : '' }}" 
                           href="{{ route('admin.appearance.menus.index', ['location' => 'footer_quick']) }}">
                            <i class="fas fa-link mr-1"></i> Footer Quick Links
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Card Body / Menus Table -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-bordered table-striped text-sm mb-0">
                    <thead class="thead-light">
                        <tr class="text-uppercase text-muted">
                            <th style="width: 60px;" class="text-center">Order</th>
                            <th>Menu Label (EN / BN)</th>
                            <th style="width: 140px;" class="text-center">Icon / Badge</th>
                            <th>Target URL / Route</th>
                            <th style="width: 90px;" class="text-center">Target</th>
                            <th style="width: 110px;" class="text-center">Status</th>
                            <th style="width: 130px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                            @php
                                $hasChildren = $menu->children->count() > 0;
                            @endphp
                            <!-- Parent Menu Item -->
                            <tr class="bg-light font-weight-bold">
                                <td class="text-center font-mono">{{ $menu->order_index }}</td>
                                <td>
                                    <span class="badge badge-primary mr-1">Parent</span>
                                    <strong class="text-dark">{{ $menu->title_en }}</strong>
                                    <span class="text-muted font-weight-normal ml-1">({{ $menu->title_bn ?: '—' }})</span>
                                    @if($hasChildren)
                                        <span class="badge badge-secondary ml-2">{{ $menu->children->count() }} Submenu(s)</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($menu->icon)
                                        <i class="{{ $menu->icon }} text-primary mr-1"></i>
                                    @endif
                                    @if($menu->badge_text)
                                        <span class="badge badge-success text-[10px]">{{ $menu->badge_text }}</span>
                                    @endif
                                    @if(!$menu->icon && !$menu->badge_text)
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    <code class="text-primary">{{ $menu->route_name ? 'route: ' . $menu->route_name : $menu->url }}</code>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light border">{{ $menu->target }}</span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.appearance.menus.toggle', $menu->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-xs {{ $menu->status ? 'btn-success' : 'btn-secondary' }}">
                                            <i class="fas {{ $menu->status ? 'fa-check' : 'fa-times' }} mr-1"></i>
                                            {{ $menu->status ? 'Active' : 'Disabled' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-xs edit-menu-btn" 
                                            data-menu="{{ json_encode($menu) }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.appearance.menus.destroy', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this menu item? Submenus will become top-level.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Submenu Children Rows -->
                            @foreach($menu->children as $child)
                                <tr>
                                    <td class="text-center font-mono text-muted pl-4">
                                        <span class="small">{{ $menu->order_index }}.{{ $child->order_index }}</span>
                                    </td>
                                    <td class="pl-5">
                                        <i class="fas fa-level-up-alt fa-rotate-90 text-muted mr-2"></i>
                                        <span class="text-dark">{{ $child->title_en }}</span>
                                        <span class="text-muted small ml-1">({{ $child->title_bn ?: '—' }})</span>
                                    </td>
                                    <td class="text-center">
                                        @if($child->icon)
                                            <i class="{{ $child->icon }} text-secondary mr-1"></i>
                                        @endif
                                        @if($child->badge_text)
                                            <span class="badge badge-info text-[10px]">{{ $child->badge_text }}</span>
                                        @endif
                                        @if(!$child->icon && !$child->badge_text)
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <code class="text-secondary small">{{ $child->route_name ? 'route: ' . $child->route_name : $child->url }}</code>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-light border">{{ $child->target }}</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.appearance.menus.toggle', $child->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-xs {{ $child->status ? 'btn-success' : 'btn-secondary' }}">
                                                <i class="fas {{ $child->status ? 'fa-check' : 'fa-times' }} mr-1"></i>
                                                {{ $child->status ? 'Active' : 'Disabled' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-xs edit-menu-btn" 
                                                data-menu="{{ json_encode($child) }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.appearance.menus.destroy', $child->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this submenu item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-compass fa-2x mb-3 text-secondary d-block"></i>
                                    No menus found for this location. Click <strong>Reset Defaults</strong> or <strong>Add Menu Item</strong> above.
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
     MODAL: CREATE MENU ITEM
     ========================================================================= -->
<div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.appearance.menus.store') }}" method="POST">
            @csrf
            <input type="hidden" name="location" value="{{ $location }}">

            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-plus mr-1"></i> Add Frontend Menu Item
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- English Label -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                            <input type="text" name="title_en" class="form-control" placeholder="e.g. Courses, About Us" required>
                        </div>

                        <!-- Bengali Label -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Title (বাংলা)</label>
                            <input type="text" name="title_bn" class="form-control" placeholder="e.g. কোর্সসমূহ, আমাদের সম্পর্কে">
                        </div>

                        <!-- Parent Item (Dropdown nesting) -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Parent Menu (Optional for Submenu)</label>
                            <select name="parent_id" class="form-control">
                                <option value="">-- Top-Level Parent Item --</option>
                                @foreach($parentOptions as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->title_en }} ({{ $parent->title_bn }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Target Window -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Link Target</label>
                            <select name="target" class="form-control">
                                <option value="_self">Same Tab (_self)</option>
                                <option value="_blank">New Tab (_blank)</option>
                            </select>
                        </div>

                        <!-- Target URL or Route -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Target URL / Relative Path</label>
                            <input type="text" name="url" class="form-control" placeholder="e.g. /courses, /about, or https://...">
                            <small class="text-muted">Enter path, full URL, or leave # for dropdown toggle.</small>
                        </div>

                        <!-- Named Route (Optional) -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Laravel Route Name (Optional)</label>
                            <input type="text" name="route_name" class="form-control" placeholder="e.g. home-page, academic-training">
                            <small class="text-muted">If specified, system generates localized URL dynamically.</small>
                        </div>

                        <!-- Icon -->
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Icon Class (FontAwesome)</label>
                            <input type="text" name="icon" class="form-control" placeholder="e.g. fa fa-desktop, fa fa-book">
                        </div>

                        <!-- Badge Text -->
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Badge Text</label>
                            <input type="text" name="badge_text" class="form-control" placeholder="e.g. New, Hot, Live">
                        </div>

                        <!-- Order Index -->
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Order Index</label>
                            <input type="number" name="order_index" class="form-control" placeholder="Auto">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Save Menu Item
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL: EDIT MENU ITEM
     ========================================================================= -->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editMenuForm" action="" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-edit mr-1"></i> Edit Frontend Menu Item
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- English Label -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                            <input type="text" name="title_en" id="edit_title_en" class="form-control" required>
                        </div>

                        <!-- Bengali Label -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Title (বাংলা)</label>
                            <input type="text" name="title_bn" id="edit_title_bn" class="form-control">
                        </div>

                        <!-- Parent Item -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Parent Menu (For Submenu)</label>
                            <select name="parent_id" id="edit_parent_id" class="form-control">
                                <option value="">-- Top-Level Parent Item --</option>
                                @foreach($parentOptions as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->title_en }} ({{ $parent->title_bn }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Target Window -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Link Target</label>
                            <select name="target" id="edit_target" class="form-control">
                                <option value="_self">Same Tab (_self)</option>
                                <option value="_blank">New Tab (_blank)</option>
                            </select>
                        </div>

                        <!-- Target URL -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Target URL / Path</label>
                            <input type="text" name="url" id="edit_url" class="form-control">
                        </div>

                        <!-- Route Name -->
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Laravel Route Name</label>
                            <input type="text" name="route_name" id="edit_route_name" class="form-control">
                        </div>

                        <!-- Icon -->
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Icon Class</label>
                            <input type="text" name="icon" id="edit_icon" class="form-control">
                        </div>

                        <!-- Badge Text -->
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Badge Text</label>
                            <input type="text" name="badge_text" id="edit_badge_text" class="form-control">
                        </div>

                        <!-- Order Index -->
                        <div class="col-md-4 form-group">
                            <label class="font-weight-bold">Order Index <span class="text-danger">*</span></label>
                            <input type="number" name="order_index" id="edit_order_index" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info font-weight-bold">
                        <i class="fas fa-check mr-1"></i> Update Menu Item
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.edit-menu-btn').click(function() {
            var menu = $(this).data('menu');
            var url = "{{ url('admin/appearance/menus') }}/" + menu.id;

            $('#editMenuForm').attr('action', url);
            $('#edit_title_en').val(menu.title_en);
            $('#edit_title_bn').val(menu.title_bn || '');
            $('#edit_parent_id').val(menu.parent_id || '');
            $('#edit_target').val(menu.target || '_self');
            $('#edit_url').val(menu.url || '#');
            $('#edit_route_name').val(menu.route_name || '');
            $('#edit_icon').val(menu.icon || '');
            $('#edit_badge_text').val(menu.badge_text || '');
            $('#edit_order_index').val(menu.order_index);

            $('#editMenuModal').modal('show');
        });
    });
</script>
@endpush
