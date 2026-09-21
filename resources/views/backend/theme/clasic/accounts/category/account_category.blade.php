@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Account Category
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('category_active', 'menu-open')

@section('menu_active_category', 'active bg-info')

@section('account_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Account Category</h3>
                </div>
                <div class="mt-4 ml-4">
                    <!-- Button trigger modal -->
                    @php
                        $Add_Account_Categories = 0;
                        foreach (userRolls() as $roll) {
                            if ($roll->module_id == 67) {
                                $Add_Account_Categories = 67;
                            }
                        }
                    @endphp
                    @if ((checkUserType() == 0 && $Add_Account_Categories != 0) || Auth::user()->type == 'Admin')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertCateroyModal">
                            <i class="fas fa-plus-circle"></i> Insert Category
                        </button>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-header">Local Income and Expense Category</h5>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Account Type</th>
                                        <th>Type</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        @if ($category->type == 'Local')
                                            <tr>
                                                <td>{{ $serial++ }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->account_type }}</td>
                                                <td>{{ $category->type }}</td>
                                                @if (checkUserType() == 0)
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editAccountCategory{{ $category->id }}"><i
                                                                class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        {{-- <a href="{{ url('edit-account-category/' . $category->id) }}"><button
                                                            class="btn btn-primary btn-sm"><i
                                                                class="fas fa-pencil-alt"></i></button></a> --}}
                                                        {{-- <a href="{{ url('delete-account-category/' . $category->id) }}"><button
                                                        class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button></a> --}}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-header">Global Income and Expense Category</h5>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Account Type</th>
                                        <th>Type</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        @if ($category->type == 'Global')
                                            <tr>
                                                <td>{{ $serial++ }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->account_type }}</td>
                                                <td>{{ $category->type }}</td>
                                                @if (checkUserType() == 0)
                                                    <td>

                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editAccountCategory{{ $category->id }}"><i
                                                                class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        {{-- <a href="{{ url('edit-account-category/' . $category->id) }}"><button
                                                            class="btn btn-primary btn-sm"><i
                                                                class="fas fa-pencil-alt"></i></button></a> --}}
                                                        {{-- <a href="{{ url('delete-account-category/' . $category->id) }}"><button
                                                        class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button></a> --}}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                        <!-- Modal insert  -->
                                        <div class="modal fade" id="editAccountCategory{{ $category->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Category
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="card card-primary">
                                                            <!-- /.card-header -->
                                                            <!-- form start -->
                                                            <form role="form" method="POST"
                                                                action="{{ route('update-category') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $category->id }}">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="title">Category Name</label>
                                                                        <input class="form-control" id="title"
                                                                            name="title" type="text"
                                                                            placeholder="Enter title"
                                                                            data-validation='required'
                                                                            value="{{ $category->title }}">

                                                                        @error('title')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    @if (user(Auth::id()) == 1)
                                                                        <input type="hidden" name="type" value="Local">
                                                                    @elseif (user(Auth::id()) == 2)
                                                                        <input type="hidden" name="type" value="Global">
                                                                    @else
                                                                        <div class="form-group">
                                                                            <label>Select Category Type</label>
                                                                            <select id="type" name="type"
                                                                                data-validation='required'
                                                                                class="form-control select2"
                                                                                style="width: 100%;">
                                                                                <option label="Choose type" selected
                                                                                    disabled>Select One</option>
                                                                                <option value="Local"
                                                                                    {{ 'Local' == $category->type ? 'selected' : '' }}>
                                                                                    Local
                                                                                </option>

                                                                                <option value="Global"
                                                                                    {{ 'Global' == $category->type ? 'selected' : '' }}>
                                                                                    Global
                                                                                </option>
                                                                            </select>
                                                                            @error('type')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    @endif
                                                                    <div class="form-group">
                                                                        <label>Select Type</label>
                                                                        <select name="account_type"
                                                                            data-validation='required'
                                                                            class="form-control select2"
                                                                            style="width: 100%;">
                                                                            <option disabled selected="selected">Selected
                                                                                One</option>
                                                                            <option value="Expense"
                                                                                {{ 'Expense' == $category->account_type ? 'selected' : '' }}>
                                                                                Expense</option>
                                                                            <option value="Income"
                                                                                {{ 'Income' == $category->account_type ? 'selected' : '' }}>
                                                                                Income</option>
                                                                        </select>
                                                                        @error('account_type')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->

                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn  btn-block btn-primary align-top">
                                                                        Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="ml-auto mx-3">
                    {{ $categories->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- Modal insert  -->
    <div class="modal fade" id="insertCateroyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('insert-category') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" value="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Category Name</label>
                                <input class="form-control" id="title" name="title" type="text"
                                    placeholder="Enter title" data-validation='required' value="{{ old('title') }}">
                            </div>
                            @if (user(Auth::id()) == 1)
                                <input type="hidden" name="type" value="Local">
                            @elseif (user(Auth::id()) == 2)
                                <input type="hidden" name="type" value="Global">
                            @else
                                <div class="form-group">
                                    <label>Select Category Type</label>
                                    <select id="type" name="type" data-validation='required'
                                        class="form-control select2" style="width: 100%;">
                                        <option label="Choose type" selected disabled>Select One</option>
                                        <option value="Local">Local</option>
                                        <option value="Global">Global</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Select Type</label>
                                <select name="account_type" data-validation='required' class="form-control select2"
                                    style="width: 100%;">
                                    <option disabled selected="selected">Selected One</option>
                                    <option value="Expense">Expense</option>
                                    <option value="Income">Income</option>
                                </select>
                                @error('account_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn  btn-block btn-primary align-top">
                                Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('backend/theme/clasic/include/modal_photos/modal')
@endsection
