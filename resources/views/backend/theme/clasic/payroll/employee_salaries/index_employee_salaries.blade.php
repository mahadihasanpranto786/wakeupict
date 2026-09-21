@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Monthly Salary
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('payroll_active', 'menu-open')

@section('menu_active_payroll', 'active bg-info')

@section('employee_salaries', 'active')
{{-- menu active end --}}

@section('maincontant')
    <style>
        span.help-block.form-error {
            color: red;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee Monthly Salary</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="my-2">
                        @if (checkUserType() == 0)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeeSalary">
                                <i class="fas fa-plus-circle"></i> Add Monthly Salary
                            </button>
                        @endif
                    </div>
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th style="width: 10%">Picture</th>
                                <th style="width: 25%">Employee Name</th>
                                <th style="width: 15%">Monthly Salary</th>
                                <th style="width: 20%">Generate Payroll</th>
                                @if (checkUserType() == 0)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $sl = ($employeeSalaries->currentpage() - 1) * $employeeSalaries->perpage() + 1;
                        @endphp
                        @foreach ($employeeSalaries as $item)
                            <tbody>
                                <td>{{ $sl++ }}</td>
                                <td>
                                    <img width="50px" class="img-fluid img-circle"
                                        src="{{ $item->employee->photo == null ? URL::asset('uploads/profile/demo.jpg') : URL::asset($item->employee->photo) }}"
                                        alt="User profile picture">

                                </td>
                                <td>{{ $item->employee->name }}</td>
                                <td>{{ $item->monthly_salary }} TK</td>
                                <td>
                                    <select class="generate_payroll_status" data-id="{{ $item->id }}">
                                        <option value="1" {{ $item->generate_payroll_status == 1 ? 'Selected' : '' }}>
                                            Yes</option>
                                        <option value="0" {{ $item->generate_payroll_status == 0 ? 'Selected' : '' }}>
                                            No</option>
                                    </select>
                                </td>
                                @if (checkUserType() == 0)
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editSalary{{ $item->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <a id="delete" class="btn btn-danger btn-sm"
                                            href="{{ url('employee_monthly_salary_delete/' . $item->id) }}"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                @endif

                            </tbody>
                            <!-- Modal for update edit -->
                            <div class="modal fade" id="editSalary{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-success">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Employee Monthly Salary
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card card-primary">
                                                <!-- form start -->
                                                <form role="form" method="POST"
                                                    action="{{ route('employee_monthly_salary_update') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Employee Type</label>
                                                            <select name="employee_id" id="employee_id"
                                                                data-validation='required' class="form-control select2"
                                                                style="width: 100%;">
                                                                <option label="Choose" selected disabled>Select Name
                                                                </option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}"
                                                                        {{ $user->id == $item->employee_id ? 'selected' : '' }}>
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            @error('employee_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="monthly_salary">Employee Type</label>
                                                            <input class="form-control" data-validation='required'
                                                                type="number" name="monthly_salary" id="monthly_salary"
                                                                placeholder="Please Enter Mothly Salary"
                                                                value="{{ $item->monthly_salary }}">
                                                        </div>
                                                        @error('monthly_salary')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                            </div>
                        @endforeach
                    </table>
                    <div class="float-right">
                        {{ $employeeSalaries->links() }}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card mt-5">
                        <div class="card-header mt-2">Employee Salary Percentage(%)</div>
                        <div class="card-body">
                            <div class="mt-5" id="selaryChart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal for insert -->
    <div class="modal fade" id="employeeSalary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Employee Monthly Salary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('employee_monthly_salary_insert') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Employee Type</label>
                                    <select name="employee_id" id="employee_id" data-validation='required'
                                        class="form-control select2 prefix-picture" style="width: 100%;">
                                        <option label="Choose" selected disabled>Select Name</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                data-picture="{{ $user->photo != '' ? asset($user->photo) : URL::asset('uploads/profile/demo.jpg') }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('employee_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="monthly_salary">Employee Mothly Salary</label>
                                    <input class="form-control" data-validation='required' type="number"
                                        name="monthly_salary" id="monthly_salary"
                                        placeholder="Please Enter Mothly Salary">
                                </div>
                                @error('monthly_salary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary align-top">
                                        Insert</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('backend/theme/clasic/include/modal_photos/modal')

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.generate_payroll_status').change(function(e) {
                e.preventDefault();
                var generate_payroll_status = $(this).val();
                var id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('generate-payroll-status-ajax') }}",
                    data: {
                        generate_payroll_status: generate_payroll_status,
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(error) {
                        toastr.error("Somethings Is Wrong!");
                    },
                    complete: function(done) {
                        if (done.status == 200) {
                            window.location.reload();
                        }
                    }
                });
            });


            ///chart
            var options = {
                series: [

                    <?php
                    if ($chartSalary) {
                        foreach ($chartSalary as $row => $value) {
                            echo $value->monthly_salary . ',';
                        }
                    } ?>
                ],
                chart: {

                    width: 700,
                    type: 'donut',
                    dropShadow: {
                        enabled: true,
                        top: 5,
                        left: -5,
                        blur: 6,
                        opacity: 0.2
                    },
                },
                grid: {
                    padding: {
                        bottom: 50
                    }
                },
                stroke: {
                    colors: ['#9f9b9b']
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    horizontalAlign: 'center'
                },
                labels: [
                    <?php
                    if ($chartSalary) {
                        foreach ($chartSalary as $row => $value) {
                            echo '"' . $value->employee->name . '",';
                        }
                    } ?>
                ],

                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                            },
                            size: '45%',
                        },

                    },
                },
                responsive: [{
                    breakpoint: 400,
                    options: {
                        chart: {
                            width: 180,

                        },

                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#selaryChart"), options);
            chart.render();
        });
    </script>
@endsection
