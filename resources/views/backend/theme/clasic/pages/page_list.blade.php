@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Pages List
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('seo_pages', 'menu-open')

@section('menu_active_seo', 'active bg-info')

@section('pages_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Lists</h3>
                    @if (Auth::user()->type == 'Admin')
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#modal-default"><i class="fas fa-plus-circle"></i>
                            Add New Page
                        </button>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>SL</th>
                                        <th>Page Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td class="text-center">

                                                <a href="{{ url('add-content/' . $page->id) }}">{{ $page->page_name }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                        class="flex items-center  text-white"
                                                        href="{{ url('add-content/' . $page->id) }}"><i
                                                            class="fas fa-pencil-alt text-white"></i>
                                                        Edit </a>
                                                </button>



                                                <button title="View" class="btn btn-success btn-sm"> <a
                                                        class="flex items-center  text-white"
                                                        href="{{ url('page-content/' . $page->id) }}"><i
                                                            class="fas fa-eye text-white"></i>
                                                        View </a>
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3 float-right">{{ $pages->links() }}</div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Page</h4>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <form action="{{ route('add-page-name') }}" method="POST">
                        @csrf
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12"> <label for="modal-form-1" class="form-label">Page
                                    Name:</label>
                                <input id="modal-form-1" name="page_name" type="text" class="form-control"
                                    placeholder="Enter Page Name">
                            </div>
                            <div class="col-span-12 sm:col-span-12"> <label for="modal-form-2"
                                    class="form-label">Creator</label>
                                <input id="modal-form-2" type="text" class="form-control" placeholder="Enter Creator">
                            </div>
                        </div> <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer text-right"><button type="button" data-dismiss="modal"
                                class="btn btn-outline-secondary w-20 mr-1">Cancel</button> <button type="submit"
                                class="btn btn-primary w-20">Add</button>

                        </div> <!-- END: Modal Footer -->
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection
