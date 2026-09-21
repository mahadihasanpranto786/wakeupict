@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Fontawesome
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('font_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Fontawesome</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap border border-b-2">SL</th>
                                <th class="whitespace-nowrap border border-b-2">Icon Name</th>
                                <th class="whitespace-nowrap border border-b-2">Icon class</th>
                                <th class="whitespace-nowrap border border-b-2">Icon</th>
                                <th class="whitespace-nowrap border border-b-2">Action</th>
                            </tr>
                        </thead>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($fontawesomes as $item)
                            <tbody>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $item->icon_name }}</td>
                                <td>{{ $item->icon }}</td>
                                <td><i class="{{ $item->icon }}"></i></td>
                                <td>
                                    <a href="{{ url('fontawesome/edit/' . $item->id) }}"><button
                                            class="btn btn-primary btn-sm">Edit</button></a>
                                    <a href="{{ url('fontawesome/delete/' . $item->id) }}"><button
                                            class="btn btn-danger btn-sm">Delete</button></a>
                                </td>

                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 id="update_head" class="card-title text-center">Update Icon</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('fontawesome-icon-update') }}">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $fontawesome_edit->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Icon Name</label>
                                    <input class="form-control" id="icon_name" name="icon_name" type="text"
                                        placeholder="Enter name" data-validation='required'
                                        value="{{ $fontawesome_edit->icon_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Icon Class</label>
                                    <input class="form-control" name="icon" id="icon" type="text"
                                        placeholder="Enter icon class" data-validation='required'
                                        value="{{ $fontawesome_edit->icon }}">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary align-top">
                                    Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

@endsection
