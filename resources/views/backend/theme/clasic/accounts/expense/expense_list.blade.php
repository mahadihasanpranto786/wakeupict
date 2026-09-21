@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Expenses List
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
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Expenses List
                    </h3>

                    @php
                        $Add_Expense = 0;
                        $Delete_Expense = 0;
                        foreach (userRolls() as $roll) {
                            if ($roll->module_id == 21) {
                                $Add_Expense = 21;
                            } elseif ($roll->module_id == 69) {
                                $Delete_Expense = 69;
                            }
                        }
                    @endphp
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-2">
                                @if ((checkUserType() == 0 && $Add_Expense != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ route('add-expense') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i> Add
                                            Expense</button>
                                    </a>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category</th>
                                        <th style="width: 20%">Title</th>
                                        <th style="width: 11%">Date</th>
                                        <th>Amount(TK)</th>
                                        <th style="width: 30%">Remark</th>
                                        @if ((checkUserType() == 0 && $Add_Expense != 0) || Auth::user()->type == 'Admin')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($expenses as $expense)
                                        @php
                                            $payroll = App\model\Payroll::where('expense_id', $expense->id)
                                                ->where('status', 1)
                                                ->first();
                                            $expensePayback = App\model\ExpensePayback::where('expense_id', $expense->id)
                                                ->where('status', 1)
                                                ->sum('payback_money');
                                            
                                        @endphp

                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>{{ $expense->category->title }}</td>
                                            <td>{{ $expense->title }} </td>
                                            <td>{{ Carbon\Carbon::parse($expense->date)->format('d M, Y') }} </td>
                                            @if (!empty($expensePayback))
                                                <td>({{ $expense->amount }}-<span
                                                        class="text-danger">{{ $expensePayback }}</span>)=
                                                    {{ $expense->amount - $expensePayback }}TK
                                                </td>
                                            @else
                                                <td>{{ $expense->amount }} TK</td>
                                            @endif
                                            <td>{!! $expense->remark !!} </td>

                                            <td>
                                                <div class="d-flex">
                                                    @if ((checkUserType() == 0 && $Add_Expense != 0) || Auth::user()->type == 'Admin')
                                                        {{-- edit --}}
                                                        <button title="Edit expense" class="btn btn-primary btn-sm">
                                                            <a href="{{ url('edit-expense/' . $expense->id) }}"> <i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a></button>
                                                    @endif
                                                    @if ((checkUserType() == 0 && $Delete_Expense != 0) || Auth::user()->type == 'Admin')
                                                        {{-- delete --}}
                                                        <button title="Delete expense" class="btn btn-danger  btn-sm"><a
                                                                id="delete"
                                                                href="{{ url('delete-expense/' . $expense->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    @endif

                                                    @if ($payroll == null)
                                                        <a href="{{ url('expense-view/' . $expense->id) }}"><i
                                                                class="fas fa-eye  text-white btn btn-success  btn-sm"></i></a>
                                                    @else
                                                        <a href="{{ url('expense-payroll/' . $expense->id) }}"><i
                                                                class="fas fa-eye  text-white btn btn-success  btn-sm"></i></a>
                                                    @endif
                                                </div>
                                                <div>
                                                    @if ((checkUserType() == 0 && $Add_Expense != 0) || Auth::user()->type == 'Admin')
                                                        @if ($payroll == null)
                                                            <a data-toggle="modal"
                                                                data-target="#payback{{ $expense->id }}" type="button"
                                                                class="btn btn-primary btn-sm my-1 text-white"
                                                                style="padding: 5px 23px;">Payback</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal for payback -->
                                        <div class="modal fade" id="payback{{ $expense->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-success">
                                                        <h5 class="modal-title" id="exampleModalLabel">Payback Expense
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card card-primary">
                                                            <!-- form start -->
                                                            <form role="form" method="POST"
                                                                action="{{ route('expense_payback_store') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="expense_id"
                                                                    value="{{ $expense->id }}">
                                                                <input type="hidden" name="expense_date"
                                                                    value="{{ $expense->date }}">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="payback_money">Payback Money
                                                                            (TK)
                                                                        </label>
                                                                        <input class="form-control"
                                                                            data-validation='required' type="number"
                                                                            name="payback_money" id="payback_money"
                                                                            placeholder="Please Enter Payback Money">

                                                                        @error('payback_money')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="remark">Remark</label>
                                                                        <textarea class="form-control" data-validation='required' type="text" name="remark" id="remark"
                                                                            placeholder="Please Write some Remark"></textarea>
                                                                        @error('remark')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <button type="submit"
                                                                            class="btn btn-block btn-primary align-top">
                                                                            Payback</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mx-4 float-right">
                            {{ $expenses->links() }}
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
