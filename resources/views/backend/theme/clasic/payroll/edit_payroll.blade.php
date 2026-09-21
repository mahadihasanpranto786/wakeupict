@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Payroll
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('payroll_active', 'menu-open')

@section('menu_active_payroll', 'active bg-info')

@section('payroll_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('update-payroll') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="expense_id" value="{{ $payroll->expense_id }}">
                                <input type="hidden" name="id" value="{{ $payroll->id }}">
                                <input type="hidden" id="employeeId" value="{{ $payroll->user_id }}">
                                <input type="hidden" id="title_id" value="{{ $payroll->title_id }}">
                                <div class="form-group">
                                    <label for="date">Payment Date</label>
                                    <input type="text" name="date" id="datepicker" data-validation='required'
                                        class="form-control" placeholder="Enter Date" value="{{ $payroll->date }}">
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Employee Type</label>
                                    <select name="employee_type" id="employee_type" data-validation='required'
                                        class="form-control select2" style="width: 100%;">
                                        <option label="Choose" selected disabled>Select One</option>
                                        <option value="Paid" {{ 'Paid' == $payroll->employee_type ? 'selected' : '' }}>
                                            Paid
                                        </option>
                                        <option value="Unpaid" {{ 'Unpaid' == $payroll->employee_type ? 'selected' : '' }}>
                                            Unpaid
                                        </option>
                                    </select>
                                    @error('employee_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    @if (user(Auth::id()) == 1)
                                        <input type="hidden" name="payroll_type" id="payroll_type" class="payroll_type"
                                            value="{{ $payroll->payroll_type }}">
                                    @elseif (user(Auth::id()) == 2)
                                        <input type="hidden" name="payroll_type" id="payroll_type" class="payroll_type"
                                            value="{{ $payroll->payroll_type }}">
                                    @else
                                        <label>Payroll Type</label>
                                        <select name="payroll_type" id="payroll_type" data-validation='required'
                                            class="form-control select2" style="width: 100%;">
                                            <option label="Choose type" selected disabled>Select One</option>

                                            <option value="Local"
                                                {{ 'Local' == $payroll->payroll_type ? 'selected' : '' }}>
                                                Local</option>
                                            <option value="Global"
                                                {{ 'Global' == $payroll->payroll_type ? 'selected' : '' }}>
                                                Global</option>

                                        </select>
                                        @error('payroll_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="type">Salary Type</label>
                                    <select name="type" id="type" data-validation='required'
                                        class="form-control select2" style="width: 100%;">
                                        <option label="Choose" selected disabled>Select type</option>
                                        <option value="Salary" {{ 'Salary' == $payroll->type ? 'selected' : '' }}>Salary
                                        </option>
                                        <option value="Bonus" {{ 'Bonus' == $payroll->type ? 'selected' : '' }}>
                                            Bonus</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="salary_month">Salary Month Or Bonus Month</label>
                                    <input type="text" name="salary_month" id="datepicker2" data-validation='required'
                                        class="form-control" placeholder="Enter Date" value="{{ $payroll->salary_month }}">
                                    @error('salary_month')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="user_id">Employee name</label>
                                    <select name="user_id" id="user_id" data-validation='required'
                                        class="form-control select2" style="width: 100%;">
                                        <option label="Choose" selected disabled>Select One</option>

                                    </select>
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="title_id" id="title_id" data-validation='required'
                                        class="form-control select2 title_id" style="width: 100%;">
                                        <option label="Choose category" selected disabled>Select One</option>
                                    </select>
                                    @error('title_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                        placeholder="Enter Amount" value="{{ $payroll->amount }}">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea type="text" name="remark" class="form-control" cols="30" rows="3">{{ $payroll->remark }}</textarea>
                            @error('remark')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <!-- /.card-body -->

                    <div class="pt-2">
                        <button type="submit" class="btn  btn-block btn-primary">
                            Update</button>
                    </div>
                </form>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#employee_type").change(function() {
                var employeeType = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        employeeType: employeeType
                    },
                    url: "{{ route('payroll_employee_type_ajax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $("#amount").val('');
                        $("#user_id").empty();
                        $("#user_id").append(
                            ` <option label="Choose" selected disabled>Select One</option>`
                        );
                        $.each(data, function(index, value) {
                            $("#user_id").append(
                                `<option value="${value.id}">${value.name}</option>`
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
            var employeeType = $("#employee_type").val();
            var employeeId = $("#employeeId").val();
            $.ajax({
                method: 'POST',
                type: 'json',
                data: {
                    employeeType: employeeType
                },
                url: "{{ route('payroll_employee_type_ajax') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $("#user_id").empty();
                    $.each(data, function(index, value) {
                        $("#user_id").append(
                            `<option value="${value.id}" ${value.id == employeeId ? 'selected': ''}>${value.name}</option>`
                        );
                    });
                },
                error: function(error) {

                }

            })
        })
    </script>
    {{-- salary amount --}}
    <script>
        $(document).ready(function() {
            $("#user_id").change(function() {
                var user_id = $(this).val();
                $.ajax({
                    method: 'POST',
                    type: 'json',
                    data: {
                        user_id: user_id
                    },
                    url: "{{ route('payroll_employee_salary_ajax') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $("#amount").empty();
                        $("#amount").val(data.monthly_salary);
                    },
                    error: function(error) {

                    }

                })
            })
        })
    </script>
    {{-- expense type name --}}
    <script>
        $(document).ready(function() {
            $("#payroll_type").change(function() {
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
            var expenseType = $("#payroll_type").val();
            var categoryId = $("#title_id").val();
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
                        ` <option label="Choose"  disabled>Select One</option>`
                    );
                    $.each(data, function(index, value) {
                        $(".title_id").append(
                            `<option value="${value.id}"${value.id == categoryId ? 'selected': ''}>${value.title}</option>`
                        );
                    });
                },
                error: function(error) {

                }

            })
        })
    </script>
@endsection
