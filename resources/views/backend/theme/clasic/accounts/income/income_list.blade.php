@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Incomes List
@endsection
{{-- menu active start --}}
@section('income', 'menu-open')

@section('income_menu', 'active bg-info')

@section('account', 'menu-open')

@section('menu_active', 'active')

@section('income_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Incomes List</h3>

                </div>

                @php
                    $Add_Income = 0;
                    $Delete_Income = 0;
                    foreach (userRolls() as $roll) {
                        if ($roll->module_id == 26) {
                            $Add_Income = 26;
                        } elseif ($roll->module_id == 71) {
                            $Delete_Income = 71;
                        }
                    }
                @endphp
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @if ((checkUserType() == 0 && $Add_Income != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ route('add-income') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i> Add
                                            Income</button>
                                    </a>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Amount(TK)</th>
                                        <th>Remark</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($incomes as $income)
                                        @php
                                            $studentPayment = App\model\StudentPayment::where('income_id', $income->id)
                                                ->where('status', 1)
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td> {{ $serial++ }}</td>

                                            <td>{{ $income->category->title }}
                                            </td>
                                            <td style="width: 20%">{{ $income->title }} </td>
                                            <td>{{ $income->date }} </td>
                                            <td>{{ $income->amount }} TK</td>
                                            <td style="width: 30%">{!! $income->remark !!} </td>

                                            <td>
                                                <div class="d-flex">
                                                    @if ((checkUserType() == 0 && $Add_Income != 0) || Auth::user()->type == 'Admin')
                                                        {{-- edit --}}
                                                        <button title="Edit income" class="btn btn-primary btn-sm">
                                                            <a href="{{ url('edit-income/' . $income->id) }}"> <i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>
                                                    @endif

                                                    @if ((checkUserType() == 0 && $Delete_Income != 0) || Auth::user()->type == 'Admin')
                                                        {{-- delete --}}
                                                        <button title="Delete income" class="btn btn-danger  btn-sm"><a
                                                                id="delete"
                                                                href="{{ url('delete-income/' . $income->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    @endif

                                                    @if (checkUserType() == 0)
                                                        @if (!empty($studentPayment))
                                                            <a
                                                                href="{{ url('income-student-payment/' . $studentPayment->id) }}"><i
                                                                    class="fas fa-eye  text-white btn btn-success  btn-sm"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ url('income-view/' . $income->id) }}"><i
                                                                    class="fas fa-eye  text-white btn btn-success  btn-sm"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-4 float-right">
                            {{ $incomes->links() }}
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
