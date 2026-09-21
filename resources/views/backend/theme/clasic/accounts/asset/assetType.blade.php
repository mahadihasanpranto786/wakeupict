@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Asset Type
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('asset', 'menu-open')

@section('index_asset', 'active bg-info')

@section('asset_type', 'active')
{{-- menu active end --}}
@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Asset Type</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Asset Type</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($assetTypes as $type)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $type->asset_type_name }}</td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#assetTypeEdit{{ $type->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <a id="delete"
                                                        href="{{ url('delete-asset-type/' . $type->id) }}"><button
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button></a>
                                                </td>
                                            @endif
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="assetTypeEdit{{ $type->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Asset
                                                            Type</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- form start -->
                                                        <form role="form" method="POST"
                                                            action="{{ route('insert_and_update_asset_type') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $type->id }}">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="name">Asset Type Name</label>
                                                                    <input class="form-control" id="asset_type_name"
                                                                        name="asset_type_name" type="text"
                                                                        placeholder="Enter Asset Type Name"
                                                                        data-validation='required'
                                                                        value="{{ $type->asset_type_name }}">
                                                                    @error('asset_type_name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="btn btn-block btn-primary align-top">
                                                                        Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $assetTypes->links() }}
                        </div>
                    </div>
                    @if (checkUserType() == 0)
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title text-center">Insert Asset Type</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" method="POST" action="{{ route('insert_and_update_asset_type') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Asset Type Name</label>
                                                <input class="form-control" id="asset_type_name" name="asset_type_name"
                                                    type="text" placeholder="Enter Asset Type Name"
                                                    data-validation='required' value="{{ old('asset_type_name') }}">
                                            </div>

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
