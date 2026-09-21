@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Expense
@endsection
{{-- menu active start --}}
@section('expense', 'menu-open')

@section('expense_active', 'active bg-info')

@section('account', 'menu-open')

@section('menu_active', 'active')

@section('expense_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="card-body">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 id="update_head" class="card-title text-center">
                                        Edit Expense</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="{{ route('update-expense') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $expense->id }}">
                                    <input type="hidden" id="catId" value="{{ $expense->title_id }}">
                                    <div class="card-body">

                                        <div class="form-group">
                                            @if (user(Auth::id()) == 1)
                                                <input type="hidden" name="expense_type" id="expenseType"
                                                    value="{{ $expense->expense_type }}">
                                            @elseif (user(Auth::id()) == 2)
                                                <input type="hidden" name="expense_type" id="expenseType"
                                                    value="{{ $expense->expense_type }}">
                                            @else
                                                <label>Select Expense Type</label>
                                                <select id="expenseType" name="expense_type" data-validation='required'
                                                    class="form-control select2" style="width: 100%;">
                                                    <option label="Choose type" selected disabled>Select One</option>
                                                    <option value="Local"
                                                        {{ 'Local' == $expense->expense_type ? 'selected' : '' }}>Local
                                                    </option>
                                                    <option value="Global"
                                                        {{ 'Global' == $expense->expense_type ? 'selected' : '' }}>Global
                                                    </option>
                                                </select>
                                                @error('expense_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select name="title_id" id="title_id" data-validation='required'
                                                class="form-control select2" style="width: 100%;">
                                                <option label="Choose category" selected disabled>Select One</option>
                                            </select>
                                            @error('title_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">

                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Enter title" value="{{ $expense->title }}"
                                                data-validation='required'>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="form-group">

                                            <label for="date">Date</label>
                                            <input type="text" name="date" id="datepicker" data-validation='required'
                                                class="form-control" placeholder="Enter Service date"
                                                value="{{ $expense->date }}">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" name="amount" id="amount" class="form-control"
                                                placeholder="Enter amount" value="{{ $expense->amount }}"
                                                data-validation='required'>
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="remark">Remark</label>
                                            <textarea type="text" name="remark" class="form-control" cols="30" rows="3">{{ $expense->remark }}</textarea>
                                            @error('remark')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary align-top">
                                                Update</button>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    {{-- expense type name --}}
    <script>
        $(document).ready(function() {
            $("#expenseType").change(function() {
                var expenseType = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        expenseType: expenseType
                    },
                    url: "{{ route('expense_type_ajax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $("#title_id").empty();
                        $("#title_id").append(
                            ` <option label="Choose" selected disabled>Select One</option>`
                        );
                        $.each(data, function(index, value) {
                            $("#title_id").append(
                                `<option value="${value.id}">${value.title}</option>`
                            );
                        });
                    },
                    error: function(error) {

                    }

                })
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            var expenseType = $("#expenseType").val();
            var catId = $("#catId").val();
            $.ajax({
                method: 'POST',
                type: 'json',
                data: {
                    expenseType: expenseType
                },
                url: "{{ route('expense_type_ajax') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $("#title_id").empty();
                    $.each(data, function(index, value) {
                        $("#title_id").append(
                            `<option value="${value.id}" ${value.id == catId  ? 'selected': ''}>${value.title}</option>`
                        );
                    });
                },
                error: function(error) {

                }

            })
        })
    </script>
@endsection
