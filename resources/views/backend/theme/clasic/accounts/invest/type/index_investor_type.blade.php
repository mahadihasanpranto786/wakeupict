@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Investor Type
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('Invest', 'menu-open')

@section('index_investor_active', 'active bg-info')

@section('index_investor_type', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Investor Type</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Investor Type Name</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($investor_type as $type)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $type->investor_type_name }}</td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <button data-toggle="modal" data-target="#editInvestorType"
                                                        class="btn btn-primary btn-sm"><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                    <a id="delete"
                                                        href="{{ url('delete-investor-type/' . $type->id) }}"><button
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button></a>
                                                </td>
                                            @endif
                                        </tr>

                                        <!-- Modal  edit-->
                                        <div class="modal fade" id="editInvestorType" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Invetor Type
                                                            Edit
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <!-- form start -->
                                                            <form role="form" method="POST"
                                                                action="{{ route('update-investor-type') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $type->id }}">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="investor_type_name">Investor Type
                                                                            Name</label>
                                                                        <input class="form-control"
                                                                            id="investor_type_name"
                                                                            name="investor_type_name" type="text"
                                                                            placeholder="Enter name"
                                                                            data-validation='required'
                                                                            value="{{ $type->investor_type_name }}">
                                                                    </div>

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
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $investor_type->links() }}
                        </div>
                    </div>
                    @if (checkUserType() == 0)
                        <div class="col-md-4">

                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title text-center">Insert Investor Type</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" method="POST" action="{{ route('insert-investor-type') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="investor_type_name">Investor Type Name</label>
                                                <input class="form-control" id="investor_type_name"
                                                    name="investor_type_name" type="text" placeholder="Enter name"
                                                    data-validation='required' value="{{ old('investor_type_name') }}">
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
