@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Monthly Sheet
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('monthly_sheet_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <form action="{{ route('monthly-sheet-search') }}" method="GET">
        @csrf
        <div class="row">
            <div class="col-md-3 offset-3">
                <div class="form-group">
                    <select name="month" class="form-control select2" style="width: 100%;" data-validation='required'>
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
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <select name="year" class="form-control select2" style="width: 100%;" data-validation='required'>
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
        </div>
    </form>
    @if (empty($year))
        <div class="float-right my-1">
            <a href="{{ url('/monthly-sheet-print') }}" title="Print searched Payroll" class="btn btn-light btn-sm"><i
                    class="fas fa-print"></i></a>
        </div>
        <h2>{{ \Carbon\Carbon::now()->format('F, Y') }}</h2>

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
                                                    <td>{{ \Carbon\Carbon::parse($income->date)->format('d M, Y') }} </td>
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
                                Summation Of Expense <span class="float-right mr-5"> = {{ $sumExpense }}
                                    TK</span>
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
