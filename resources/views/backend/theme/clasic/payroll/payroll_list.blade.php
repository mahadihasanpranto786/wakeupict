@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Payrolls List
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
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        List Of Payroll</h3>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card-body">
                            <div class="my-2">
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
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">SL</th>
                                        <th style="width: 10%">Employee Name</th>
                                        <th style="width: 6%">Payment Date</th>
                                        <th style="width: 6%">Salary Month</th>
                                        <th style="width: 6%">Amount(TK)</th>
                                        <th style="width: 25%">Remark</th>
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

                                            <td>{{ $payroll->user->name }}
                                            </td>
                                            <td>{{ $payroll->date }} </td>
                                            <td>{{ Carbon\Carbon::parse($payroll->salary_month)->format('F, Y') }} </td>
                                            <td>{{ $payroll->amount }} TK</td>
                                            <td>{!! $payroll->remark !!} </td>

                                            <td class="border">
                                                <div class="d-flex">
                                                    {{-- edit --}}

                                                    @if ((checkUserType() == 0 && $Add_Payroll != 0) || Auth::user()->type == 'Admin')
                                                        <button title="Edit payroll" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('edit-payroll/' . $payroll->id) }}"><i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>
                                                    @endif

                                                    @if ((checkUserType() == 0 && $Delete_Payroll != 0) || Auth::user()->type == 'Admin')
                                                        {{-- delete --}}
                                                        <button title="Delete payroll" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-payroll/' . $payroll->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    @endif
                                                    @if (checkUserType() == 0)
                                                        <a href="{{ url('payroll_view/' . $payroll->id) }}"><i
                                                                class="fas fa-eye  text-white btn btn-success  btn-sm"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-4 float-right">
                            {{ $payrolls->links() }}
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
