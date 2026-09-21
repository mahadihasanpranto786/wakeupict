@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Investment List
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('Invest', 'menu-open')

@section('index_investor_active', 'active bg-info')

@section('investment_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Investment List</h3>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @php
                                    $Add_Investment = 0;
                                    $Delete_Investment = 0;
                                    foreach (userRolls() as $roll) {
                                        if ($roll->module_id == 62) {
                                            $Add_Investment = 62;
                                        } elseif ($roll->module_id == 63) {
                                            $Delete_Investment = 63;
                                        }
                                    }
                                @endphp
                                @if ((checkUserType() == 0 && $Add_Investment != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ route('add_investment') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i> Add
                                            Investment</button>
                                    </a>
                                @endif

                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th style="width: 25%">Investor Info</th>
                                        <th>Date</th>
                                        <th>Amount(TK)</th>
                                        <th>Rate</th>
                                        <th style="width: 30%">Remark</th>
                                        @if ((checkUserType() == 0 && $Add_Investment != 0) || Auth::user()->type == 'Admin')
                                            <th>Action</th>
                                        @elseif ($Delete_Investment == 63)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($investments as $investment)
                                        <tr>
                                            <td> {{ $serial++ }}</td>

                                            <td>
                                                <strong>Investor Name :</strong>
                                                {{ $investment->investor->name }} <br>
                                                <strong>Investment Type :</strong>
                                                {{ $investment->investorType->investor_type_name }} <br>
                                                <strong>Type :</strong>
                                                {{ $investment->invest_type }} <br>
                                            </td>
                                            <td>{{ dateformater($investment->date)->format('d F, Y') }} </td>
                                            <td>{{ $investment->amount }} TK</td>
                                            <td>{{ $investment->rate }}</td>
                                            <td>{!! $investment->remark !!} </td>
                                            <td>
                                                <div class="d-flex">
                                                    @if ((checkUserType() == 0 && $Add_Investment != 0) || Auth::user()->type == 'Admin')
                                                        {{-- edit --}}
                                                        <button title="Edit Investment" class="btn btn-primary btn-sm">
                                                            <a href="{{ url('edit-investment/' . $investment->id) }}"> <i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a></button>
                                                        {{-- delete --}}
                                                    @endif
                                                    @if ((checkUserType() == 0 && $Delete_Investment == 63) || Auth::user()->type == 'Admin')
                                                        <button title="Delete Investment" class="btn btn-danger  btn-sm"><a
                                                                id="delete"
                                                                href="{{ url('delete-investment/' . $investment->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a></button>
                                                    @endif

                                                    @if ((checkUserType() == 0 && $Add_Investment != 0) || Auth::user()->type == 'Admin')
                                                        <a href="{{ url('investment_view/' . $investment->id) }}"><i
                                                                class="fas fa-eye  text-white btn btn-success  btn-sm"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $investments->links() }}
                                </tbody>
                            </table>
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
