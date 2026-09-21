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
                            <div class="">
                                <strong>
                                    <i>{{ DateTime::createFromFormat('!m', $month)->format('F') }} ,
                                        {{ $year }}</i>
                                </strong>
                                <div class="float-right my-1">
                                    <a href="{{ url('print-searched-payroll/' . $month . '/' . $year) }}"
                                        title="Print searched Payroll" class="btn btn-light btn-sm"><i
                                            class="fas fa-print"></i></a>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Employee Name</th>
                                        <th>Payment Date</th>
                                        <th>Salary Month</th>
                                        <th>Amount(TK)</th>
                                        <th>Remark</th>
                                        <th>Action</th>
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

                                                    <button title="Edit payroll" class="btn btn-primary btn-sm"> <a
                                                            class="flex items-center "
                                                            href="{{ url('edit-payroll/' . $payroll->id) }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a>
                                                    </button>

                                                    {{-- delete --}}
                                                    <button title="Delete payroll" class="btn btn-danger btn-sm"><a
                                                            class="flex items-center " id="delete"
                                                            href="{{ url('delete-payroll/' . $payroll->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    </button>
                                                    <a href="{{ url('payroll_view/' . $payroll->id) }}"><i
                                                            class="fas fa-eye  text-white btn btn-success  btn-sm"></i></a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-4 float-right">
                            {{ $payrolls->appends(Request::except('page'))->links() }}
                            {{-- {{ $payrolls->links() }} --}}
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
