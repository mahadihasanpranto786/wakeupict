@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Generate Payrolls
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('payroll_active', 'menu-open')

@section('menu_active_payroll', 'active bg-info')

@section('generate_payroll_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <style>
        span.help-block.form-error {
            color: red;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            @php
                $Add_Payroll = 0;
                $Delete_Payroll = 0;
                foreach (userRolls() as $roll) {
                    if ($roll->module_id == 18) {
                        $Add_Payroll = 18;
                    } elseif ($roll->module_id == 68) {
                        $Delete_Payroll = 68;
                    }
                }
            @endphp
            <div class="card">
                <form action="{{ route('store-generate-payroll') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="date">Payment Date</label>
                                <input type="text" name="date" id="datepicker" data-validation='required'
                                    class="form-control" placeholder="Enter Date"
                                    value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="salary_month">Salary Month</label>
                                <input type="text" name="salary_month" id="datepicker2" data-validation='required'
                                    class="form-control" placeholder="Enter Date"
                                    value="{{ Carbon\Carbon::now()->subMonth()->format('Y-m-01') }}">
                                @error('salary_month')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                @if (user(Auth::id()) == 1)
                                    <input type="hidden" name="payroll_type" class="payroll_type" value="Local">
                                @elseif (user(Auth::id()) == 2)
                                    <input type="hidden" name="payroll_type" class="payroll_type" value="Global">
                                @else
                                    <label>Payroll Type</label>
                                    <select name="payroll_type" id="payroll_type" data-validation='required'
                                        class="form-control select2 payroll_type" style="width: 100%;">
                                        <option label="Choose type" selected disabled>Select One</option>
                                        <option value="Local"
                                            {{ collect(old('payroll_type'))->contains('Local') ? 'selected' : '' }}>Local
                                        </option>
                                        <option value="Global"
                                            {{ collect(old('payroll_type'))->contains('Global') ? 'selected' : '' }}>Global
                                        </option>
                                    </select>
                                    @error('payroll_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label>Select Category</label>
                                <select name="title_id" id="title_id" data-validation='required'
                                    class="form-control select2" style="width: 100%;">
                                    <option label="Choose category" selected disabled>Select One</option>
                                </select>
                                @error('title_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea type="text" name="remark" class="form-control" placeholder="Add Remark" cols="30" rows="3">{{ old('remark') }}</textarea>
                            @error('remark')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- /.card-body -->

                        <div class="pt-2">
                            <button type="submit" class="btn btn-block btn-primary">
                                Generate</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        List Of Payroll</h3>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card-body">
                            {{-- <div class="my-2">
                                @php
                                    $Add_Payroll = 0;
                                    $Delete_Payroll = 0;
                                    foreach (userRolls() as $roll) {
                                        if ($roll->module_id == 18) {
                                            $Add_Payroll = 18;
                                        } elseif ($roll->module_id == 68) {
                                            $Delete_Payroll = 68;
                                        }
                                    }
                                @endphp
                                @if ((checkUserType() == 0 && $Add_Payroll != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ route('add-payroll') }}">
                                        <button class="btn btn-primary"><i class="fas fa-plus-circle"></i>Add Payroll
                                        </button>
                                    </a>
                                @endif
                                <div class="col-md-6 float-right">
                                    <form action="{{ route('payroll-search') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="month" class="form-control select2" style="width: 100%;"
                                                        data-validation='required'>
                                                        <option disabled selected="selected">Select Month</option>
                                                        <option value="01">January</option>
                                                        <option value="02">February</option>
                                                        <option value="03">March</option>
                                                        <option value="04">April</option>
                                                        <option value="05">May</option>
                                                        <option value="06">June</option>
                                                        <option value="07">July</option>
                                                        <option value="08">August</option>
                                                        <option value="09">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <select name="year" class="form-control select2"
                                                                style="width: 100%;" data-validation='required'>
                                                                <option disabled selected="selected">Select Year</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>
                                                                <option value="2025">2025</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-success">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">SL</th>
                                        <th style="width: 10%">Salary Month</th>
                                        <th style="width: 6%">Generated Total</th>
                                        @if (checkUserType() == 0)
                                            <th style="width: 6%">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($payrolls as $payroll)
                                        <tr>
                                            <td> {{ $serial++ }}</td>

                                            <td>{{ dateformater($payroll->salary_month)->format('F, Y') }}
                                            </td>
                                            <td>{{ $payroll->data }} </td>
                                            <td class="border">
                                                <div class="d-flex">
                                                    {{-- edit --}}
                                                    @if (checkUserType() == 0)
                                                        <form action="{{ url('generate-payslip') }}" method="GET">
                                                            <input type="hidden" name="salary_month"
                                                                value="{{ $payroll->salary_month }}">
                                                            <button title="Generate Payslip"
                                                                class="text-white btn btn-success btn-sm">Pay
                                                                Slip</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="mx-4 float-right">
                            {!! $payrolls->render() !!}
                            {{-- {{ $payrolls->links() }} --}}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>


    {{-- expense type name --}}
    <script>
        $(document).ready(function() {
            $(".payroll_type").change(function() {
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
            var expenseType = $('.payroll_type').val();
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
    </script>
@endsection
