@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Account Category
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('account_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Account Category</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Account Type</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $category->title }}</td>
                                            <td>{{ $category->account_type }}</td>
                                            <td>{{ $category->type }}</td>
                                            <td>

                                                <a href="{{ url('edit-account-category/' . $category->id) }}"><button
                                                        class="btn btn-primary btn-sm"><i
                                                            class="fas fa-pencil-alt"></i></button></a>
                                                {{-- <a href="{{ url('delete-account-category/' . $category->id) }}"><button
                                                        class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 id="update_head" class="card-title text-center">Update Category</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="{{ route('update-category') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $category_edit->id }}">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Icon Name</label>
                                            <input class="form-control" id="title" name="title" type="text"
                                                placeholder="Enter title" data-validation='required'
                                                value="{{ $category_edit->title }}">

                                            @error('title')
                                                <span class="text-theme-6">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Select Type</label>
                                            <select name="type" data-validation='required' class="form-control select2"
                                                style="width: 100%;">
                                                <option disabled selected="selected">Selected One</option>
                                                <option value="Global"
                                                    {{ 'Global' == $category_edit->type ? 'selected' : '' }}>Global
                                                </option>
                                                <option value="Local"
                                                    {{ 'Local' == $category_edit->type ? 'selected' : '' }}>Local
                                                </option>
                                            </select>
                                            @error('type')
                                                <span class="text-theme-6">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Select Type</label>
                                            <select name="account_type" data-validation='required'
                                                class="form-control select2" style="width: 100%;">
                                                <option disabled selected="selected">Selected One</option>
                                                <option value="Expense"
                                                    {{ 'Expense' == $category_edit->account_type ? 'selected' : '' }}>
                                                    Expense</option>
                                                <option value="Income"
                                                    {{ 'Income' == $category_edit->account_type ? 'selected' : '' }}>
                                                    Income</option>
                                            </select>
                                            @error('account_type')
                                                <span class="text-theme-6">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn  btn-block btn-primary align-top">
                                            Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
