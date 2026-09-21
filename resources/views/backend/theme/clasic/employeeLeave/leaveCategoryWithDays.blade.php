@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Leave Category With Days
@endsection
{{-- menu active start --}}
@section('leave_active', 'menu-open')

@section('leave_menu_active', 'active')

@section('leave_Category_with_days', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Leave Category With Days
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            {{-- <div class="row"> --}}
                            <div class="col-md-8 offest-2">
                                <button type="button" class="btn btn-primary mx-3" data-toggle="modal"
                                    data-target="#insertLeaveCategory"> <i class="fas fa-plus-circle"></i>
                                    Insert Leave Category
                                </button>

                                <div class="modal-body">
                                    <div class="card ">
                                        <!-- form start -->
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Leave Category Name</th>
                                                    <th>Leave Days</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach ($leaveCategories as $category)
                                                    <tr>
                                                        <td> {{ $serial++ }}</td>
                                                        <td>{{ $category->category_name }}</td>
                                                        <td>{{ $category->leave_days }} days</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                {{-- edit --}}
                                                                <button data-cat_id="{{ $category->id }}"
                                                                    data-cat_name="{{ $category->category_name }}"
                                                                    data-leave_days="{{ $category->leave_days }}"
                                                                    type="button"
                                                                    class="btn btn-sm btn-primary editCategory"
                                                                    data-toggle="modal" data-target="#editLeaveCategory"> <i
                                                                        class="fas fa-pencil-alt text-white text-white"></i>
                                                                </button>
                                                                {{-- delete --}}
                                                                <a title="Delete category" class="btn btn-danger btn-sm"
                                                                    id="delete"
                                                                    href="{{ url('delete-leave-category/' . $category->id) }}"><i
                                                                        class="fas fa-trash  text-white"></i>
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                {{ $leaveCategories->links() }}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Insert Leave Category -->
    <div class="modal fade" id="insertLeaveCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Leave Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('insertAndUpdateLeaveCategory') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_name">Leave Category Name</label>
                                <input type="text" name="category_name" id="category_name" data-validation='required'
                                    class="form-control" placeholder="Enter Leave Category Name">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="leave_days">Leave Days</label>
                                <input type="number" name="leave_days" id="leave_days" data-validation='required'
                                    class="form-control" placeholder="Enter Leave Days">
                                @error('leave_days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">
                                    Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Leave Category -->
    <div class="modal fade" id="editLeaveCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Leave Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('insertAndUpdateLeaveCategory') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="CatId">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_name">Leave Category Name</label>
                                <input type="text" name="category_name" id="catName" data-validation='required'
                                    class="form-control" placeholder="Enter Leave Category Name">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="leave_days">Leave Days</label>
                                <input type="number" name="leave_days" id="leaveDays" data-validation='required'
                                    class="form-control" placeholder="Enter Leave Days">
                                @error('leave_days')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">
                                    Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.editCategory').click(function() {
                $('#CatId').val($(this).data("cat_id"))
                $('#catName').val($(this).data("cat_name"))
                $('#leaveDays').val($(this).data("leave_days"))
            });
        });
    </script>
@endsection
