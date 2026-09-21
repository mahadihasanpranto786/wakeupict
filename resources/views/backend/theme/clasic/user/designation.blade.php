@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Designaiton
@endsection
{{-- menu active start --}}
@section('user_active', 'menu-open')

@section('menu_active_user', 'active')

@section('designation', 'active')

{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Designaiton</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Designaiton Name</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($designations as $designation)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $designation->designation_name }}</td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <a class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#editDesignation{{ $designation->id }}"
                                                        href="{{ url('edit-investor/' . $designation->id) }}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <a id="delete"
                                                        href="{{ url('delete-designation/' . $designation->id) }}"><button
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button></a>
                                                </td>
                                            @endif

                                        </tr>
                                        <!-- Edit  Modal -->
                                        <div class="modal fade" id="editDesignation{{ $designation->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Designation
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="POST"
                                                            action="{{ route('add-update-designation') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $designation->id }}">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="designation_name">Designation Name</label>
                                                                    <input class="form-control" id="designation_name"
                                                                        name="designation_name" type="text"
                                                                        placeholder="Enter Designation Name"
                                                                        data-validation='required'
                                                                        value="{{ $designation->designation_name }}">
                                                                </div>
                                                                @error('designation_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="btn btn-block btn-primary align-top">
                                                                        Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $designations->links() }}
                        </div>
                    </div>
                    @if (checkUserType() == 0)
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title text-center">Add Designation</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" method="POST" action="{{ route('add-update-designation') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="designation_name">Designation Name</label>
                                                <input class="form-control" id="designation_name" name="designation_name"
                                                    type="text" placeholder="Enter Designation Name"
                                                    data-validation='required' value="{{ old('designation_name') }}">
                                            </div>
                                            @error('designation_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-primary align-top">
                                                    Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
