@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Assets list
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('loan', 'menu-open')

@section('loan_active', 'active bg-info')

@section('loans-list', 'active')
{{-- menu active end --}}
@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Assets list</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @php
                                    $Add_loan = 0;
                                    $Delete_Loan = 0;
                                    foreach (userRolls() as $roll) {
                                        if ($roll->module_id == 66) {
                                            $Delete_Loan = 66;
                                        } elseif ($roll->module_id == 12) {
                                            $Add_loan = 12;
                                        }
                                    }
                                @endphp
                                @if ((checkUserType() == 0 && $Add_loan != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ URL::to('add-loan') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i> Add
                                            Loan</button>
                                    </a>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">SL</th>
                                        <th style="width: 15%">Loan Holder Name</th>
                                        <th style="width: 15%">Financial Institute</th>
                                        <th style="width: 15%">Loan Amount</th>
                                        <th style="width: 30%">Remark</th>
                                        <th style="width: 10%">
                                            @if ((checkUserType() == 0 && $Add_loan != 0) || Auth::user()->type == 'Admin')
                                                Action
                                            @elseif((checkUserType() == 0 && $Delete_Loan != 0) || Auth::user()->type == 'Admin')
                                                Action
                                            @endif
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $loan->finalcial_institute }}</td>
                                            <td>{{ $loan->loan_holder_name }}</td>
                                            <td>{{ $loan->loan_amount }} Tk</td>
                                            <td>{{ $loan->remark }}</td>
                                            <td>
                                                @if ((checkUserType() == 0 && $Add_loan != 0) || Auth::user()->type == 'Admin')
                                                    <a href="{{ url('edit-loan/' . $loan->id) }}">
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button></a>
                                                @endif
                                                @if ((checkUserType() == 0 && $Delete_Loan != 0) || Auth::user()->type == 'Admin')
                                                    <a id="delete" href="{{ url('delete-loan/' . $loan->id) }}">
                                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $loans->links() }}
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
