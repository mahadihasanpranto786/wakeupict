@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Investor
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('Invest', 'menu-open')

@section('index_investor_active', 'active bg-info')

@section('index_investor', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Investor</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Type</th>
                                        <th>Mobile</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($investors as $investor)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $investor->name }}</td>
                                            <td>{{ $investor->address }}</td>
                                            <td>{{ $investor->type }}</td>
                                            <td>{{ $investor->mobile }}</td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <button data-toggle="modal"
                                                        data-target="#editInvestor{{ $investor->id }}"
                                                        class="btn btn-primary btn-sm"><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                    <a id="delete"
                                                        href="{{ url('delete-investor/' . $investor->id) }}"><button
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button></a>
                                                </td>
                                            @endif

                                        </tr>

                                        <!-- Modal edit -->
                                        <div class="modal fade" id="editInvestor{{ $investor->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit
                                                            Investor
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" method="POST"
                                                            action="{{ route('update-investor') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $investor->id }}">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="name">Investor Name</label>
                                                                    <input class="form-control" id="name" name="name"
                                                                        type="text" placeholder="Enter name"
                                                                        data-validation='required'
                                                                        value="{{ $investor->name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="address">Investor Address</label>
                                                                    <textarea class="form-control" id="address" name="address" type="text" data-validation='required'
                                                                        placeholder="Enter Investor Address">{{ $investor->address }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    @if (user(Auth::id()) == 1)
                                                                        <input type="hidden" name="type"
                                                                            class="type"
                                                                            value="{{ $investor->type }}">
                                                                    @elseif (user(Auth::id()) == 2)
                                                                        <input type="hidden" name="type"
                                                                            class="type"
                                                                            value="{{ $investor->type }}">
                                                                    @else
                                                                        <label>Investor Type</label>
                                                                        <select name="type" id="type"
                                                                            data-validation='required'
                                                                            class="form-control select2"
                                                                            style="width: 100%;">
                                                                            <option label="Choose type" selected disabled>
                                                                                Select One</option>
                                                                            <option value="Local"
                                                                                {{ $investor->type == 'Local' ? 'selected' : '' }}>
                                                                                Local</option>
                                                                            <option value="Global"
                                                                                {{ $investor->type == 'Global' ? 'selected' : '' }}>
                                                                                Global</option>
                                                                        </select>
                                                                        @error('type')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="mobile">Mobile</label>
                                                                    <input class="form-control" id="mobile" name="mobile"
                                                                        type="number" placeholder="Enter mobile"
                                                                        data-validation='required'
                                                                        value="{{ $investor->mobile }}">
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
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $investors->links() }}
                        </div>
                    </div>

                    @if (checkUserType() == 0)
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title text-center">Insert Investor</h3>
                                    </div>
                                    <!-- form start -->
                                    <form role="form" method="POST" action="{{ route('insert-investor') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Investor Name</label>
                                                <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Enter name" data-validation='required'
                                                    value="{{ old('name') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Investor Address</label>
                                                <textarea class="form-control" id="address" name="address" type="text" data-validation='required'
                                                    placeholder="Enter Investor Address">{{ old('address') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                @if (user(Auth::id()) == 1)
                                                    <input type="hidden" name="type" class="type" value="Local">
                                                @elseif (user(Auth::id()) == 2)
                                                    <input type="hidden" name="type" class="type" value="Global">
                                                @else
                                                    <label>Investor Type</label>
                                                    <select name="type" id="type" data-validation='required'
                                                        class="form-control select2" style="width: 100%;">
                                                        <option label="Choose type" selected disabled>Select One</option>
                                                        <option value="Local">Local</option>
                                                        <option value="Global">Global</option>
                                                    </select>
                                                    @error('type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input class="form-control" id="mobile" name="mobile" type="number"
                                                    placeholder="Enter mobile" data-validation='required'
                                                    value="{{ old('mobile') }}">
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
