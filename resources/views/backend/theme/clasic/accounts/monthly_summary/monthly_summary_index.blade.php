@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Current Monthly Summary
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('monthly_summary', 'active')
{{-- menu active end --}}


@section('maincontant')
    <strong>
        <p>{{ \Carbon\Carbon::now()->format('F, Y') }}</p>
    </strong>

    <div class="row">

        <div class="col-md-3">
            <div class="info-box mb-3 bg-primary">
                <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>

                <div class="
                        info-box-content">
                    <span class="info-box-text">Current Month Investment</span>
                    <span class="info-box-number">{{ number_format($currentMonthInvestmentSum, 0, ',', ',') }} Tk</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fas fa-landmark"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Current Month Loan</span>
                    <span class="info-box-number">{{ number_format($currentMonthLoanSum, 0, ',', ',') }} tk</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-donate"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Current Month Asset</span>
                    <span class="info-box-number">{{ number_format($currentMonthAssetSum, 0, ',', ',') }} tk</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fas fa-hands"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Current Month Incomes</span>
                    <span class="info-box-number">{{ number_format($sumIncome, 0, ',', ',') }} TK</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-money-bill-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Current Month Expense</span>
                    <span class="info-box-number">
                        {{ number_format($sumExpense, 0, ',', ',') }} TK</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    </div>
    @if (empty($year))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-hand-holding-usd"></i> Current Month
                                        Investment</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px"> SL</th>
                                                <th>Investor</th>
                                                <th>Date</th>
                                                <th style="width: 20%">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serial = ($currentMonthInvestments->currentpage() - 1) * $currentMonthInvestments->perpage() + 1;
                                            @endphp
                                            @foreach ($currentMonthInvestments as $investment)
                                                <tr>
                                                    <td>{{ $serial++ }}</td>
                                                    <td>{{ $investment->investor->name }}</td>
                                                    <td>{{ dateformater($investment->date)->format('d F, Y') }} </td>
                                                    <td>{{ $investment->amount }} TK</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $currentMonthInvestments->links() }}
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-donate"></i> Current Month Asset
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">SL</th>
                                                <th>Asset Name</th>
                                                <th>Date</th>
                                                <th style="width: 25%">Asset Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serial = ($currentMonthInvestments->currentpage() - 1) * $currentMonthInvestments->perpage() + 1;
                                            @endphp
                                            @foreach ($currentMonthAssets as $asset)
                                                <tr>
                                                    <td>{{ $serial++ }}</td>
                                                    <td>{{ $asset->asset_name }}</td>
                                                    <td>{{ dateformater($investment->date)->format('d F, Y') }} </td>
                                                    <td>{{ $asset->total_price }} (tk)</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $currentMonthAssets->links() }}
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-landmark"></i> Current Month Loan
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">SL</th>
                                                <th>Loan Info</th>
                                                <th>Date</th>
                                                <th style="width: 20%">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serial = ($currentMonthLoans->currentpage() - 1) * $currentMonthLoans->perpage() + 1;
                                            @endphp
                                            @foreach ($currentMonthLoans as $loan)
                                                <tr>
                                                    <td>{{ $serial++ }}</td>
                                                    <td>
                                                        <b>Institute:</b> {{ $loan->finalcial_institute }} <br>
                                                        <b>Loan Holder:</b> {{ $loan->loan_holder_name }}
                                                    </td>
                                                    <td>{{ dateformater($investment->date)->format('d F, Y') }}</td>

                                                    <td>{{ $loan->loan_amount }} tk</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-hands"></i> Current Month Incomes
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Amount(TK)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serial = 1;
                                            @endphp
                                            @foreach ($incomes as $income)
                                                @if ($income->amount != 0)
                                                    <tr>
                                                        <td> {{ $serial++ }}</td>

                                                        <td>{{ $income->category->title }}
                                                        </td>
                                                        <td>{{ $income->title }} </td>
                                                        <td>{{ \Carbon\Carbon::parse($income->date)->format('d M, Y') }}
                                                        </td>
                                                        <td>{{ $income->amount }} TK</td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-money-bill-alt"></i> Current Month Expense
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Amount(TK)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serial = 1;
                                            @endphp
                                            @foreach ($expenses as $expense)
                                                @if ($expense->amount != 0)
                                                    <tr>
                                                        <td> {{ $serial++ }}</td>

                                                        <td>{{ $expense->category->title }}
                                                        </td>
                                                        <td>{{ $expense->title }} </td>
                                                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}
                                                        </td>
                                                        <td>{{ $expense->amount }} TK</td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
    @else
        <div class="float-right my-1">
            <form action="{{ url('/searched-monthly-sheet-print') }}" method="POST">
                @csrf
                <input type="hidden" name="searchedDate"
                    value="{{ \Carbon\Carbon::parse($search_date)->format('d-m-Y') }}">
                <button type="submit" title="Monthly Searched Sheet Print" class="btn btn-light btn-sm"><i
                        class="fas fa-print"></i></button>
            </form>
        </div>
        <h2>{{ \Carbon\Carbon::parse($search_date)->format('F, Y') }}</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card-header p-2">
                                Incomes Sheet
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Amount(TK)</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach ($incomes as $income)
                                            @if ($income->amount != 0)
                                                <tr>
                                                    <td> {{ $serial++ }}</td>
                                                    <td>{{ $income->category->title }}
                                                    </td>
                                                    <td>{{ $income->title }} </td>
                                                    <td>{{ \Carbon\Carbon::parse($income->date)->format('d M, Y') }}
                                                    </td>
                                                    <td>{{ $income->amount }} TK</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-header  p-2">
                                Summation Of Income <span class="float-right mr-5">= {{ $sumIncome }}TK</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-header p-2">
                                Expenses Sheet
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Amount(TK)</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach ($expenses as $expense)
                                            @php
                                                
                                                $expensePayback = App\model\ExpensePayback::where('expense_id', $expense->id)
                                                    ->where('status', 1)
                                                    ->sum('payback_money');
                                            @endphp
                                            <tr>
                                                <td> {{ $serial++ }}</td>

                                                <td>{{ $expense->category->title }}
                                                </td>
                                                <td>{{ $expense->title }} </td>
                                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}
                                                </td>
                                                @if (!empty($expensePayback))
                                                    <td>
                                                        {{ $expense->amount - $expensePayback }}TK
                                                    </td>
                                                @else
                                                    <td>{{ $expense->amount }} TK</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header  p-2">
                                Summation Of Expense <span class="float-right mr-5"> = {{ $sumExpense }} TK</span>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            @if ($sumIncome > $sumExpense)
                                <div class="card-header p-2 text-center">
                                    Total Income = {{ $sumIncome - $sumExpense }} TK
                                </div>
                            @else
                                <div class="card-header bg-danger p-2 text-center">
                                    Total Expense = {{ $sumExpense - $sumIncome }} TK
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    @endif

@endsection
