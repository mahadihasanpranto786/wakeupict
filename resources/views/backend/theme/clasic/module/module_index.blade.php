@extends('backend.theme.clasic.admin_layouts.admin-master')

{{-- menu active start --}}
@section('user_active', 'menu-open')

@section('menu_active_user', 'active')

@section('module', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- form start -->
                <div class="card-header">
                    <h3 class="card-title">Module List</h3>
                </div>
                {{-- <div class="nav nav-pills ml-auto p-2 d-block d-flex">
                    <a href="{{ route('module') }}" class="btn btn-secondary"><i class="fas fa-home"></i>Module
                        Home</a>
                    <a href="{{ route('create_sub_module') }}" class="btn btn-success ml-2"><i
                            class="fas fa-plus-circle"></i>Insert Sub
                        Module</a>
                    <a href="{{ route('create_sub_sub_module') }}" class="btn btn-success mx-2"><i
                            class="fas fa-plus-circle"></i>Insert Sub Sub
                        Module</a>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col-md-12 callout callout-info">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%">Serial</th>
                                                <th>Title</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($modules as $module)
                                                <tr>
                                                    <td>{{ $i++ }} </td>
                                                    <td>{{ $module->title }} </td>
                                                    {{-- <td>
                                                        <a title="Edit" class="flex items-center btn btn-primary btn-sm"
                                                            href="{{ url('module_edit/' . $module->id) }}"> <i
                                                                class="fas fa-pencil-alt text-white btn-btn-danger"></i>
                                                        </a>
                                                        <a title="Delete" class="flex items-center btn btn-danger btn-sm"
                                                            href="{{ url('module_delete/' . $module->id) }}"> <i
                                                                class="fas fa-trash text-white btn-btn-danger"></i>
                                                        </a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            @yield('moduleSection')
                        </div> --}}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div> <!-- jQuery -->

@endsection
