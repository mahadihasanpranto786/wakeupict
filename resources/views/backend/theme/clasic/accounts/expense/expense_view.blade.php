<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense View</title>

    <link href="{{ asset('public/admin/plugins/print/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
    <script src="{{ asset('public/admin/plugins/print/bootstrap.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        .col-print-1 {
            width: 8%;
            float: left;
        }

        .col-print-2 {
            width: 16%;
            float: left;
        }

        .col-print-3 {
            width: 25%;
            float: left;
        }

        .col-print-4 {
            width: 33%;
            float: left;
        }

        .col-print-5 {
            width: 42%;
            float: left;
        }

        .col-print-6 {
            width: 50%;
            float: left;
        }

        .col-print-7 {
            width: 58%;
            float: left;
        }

        .col-print-8 {
            width: 66%;
            float: left;
        }

        .col-print-9 {
            width: 75%;
            float: left;
        }

        .col-print-10 {
            width: 83%;
            float: left;
        }

        .col-print-11 {
            width: 92%;
            float: left;
        }

        .col-print-12 {
            width: 100%;
            float: left;
        }

        @media (min-width: 768px) {
            .lead {
                font-size: 21px;
                padding: 0px;
                margin: 0px;
            }
        }

        #box {
            margin: 5%;
        }

        @page {
            size: auto;
            margin: 0mm;
        }

    </style>
</head>

<body>

    <div class="container" id="box">
        <div class="row ">
            <div class="container-fluid">
                <div>
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Wake Up ICT</h2>
                                <h6 class="text-center">A Prominent Software Farm at Rajbari</h6>
                                <p><strong>Date:</strong> {{ Carbon\Carbon::parse($expense->date)->format('d M, Y') }}
                                </p>
                            </div>
                            <div>
                                <strong>Expense Slip: {{ 1000 + $expense->id }}</strong>
                            </div>
                            <div>
                                <strong>{{ $expense->category->type }} Expense</strong>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive-sm">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="left">Category</th>
                                                <th class="left">Expense Title</th>
                                                <th class="center">Remark</th>
                                                <th class="right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="left">{{ $expense->category->title }}</td>

                                                <td class="left">{{ $expense->title }}</td>
                                                <td class="center" style="width: 40%">{!! $expense->remark !!}
                                                </td>
                                                @php
                                                    $expensePayback = App\model\ExpensePayback::where('expense_id', $expense->id)
                                                        ->where('status', 1)
                                                        ->sum('payback_money');
                                                @endphp
                                                @if (!empty($expensePayback))
                                                    <td>
                                                        {{ $expense->amount - $expensePayback }}TK
                                                    </td>
                                                @else
                                                    <td>{{ $expense->amount }} TK</td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8"></div>
                                    <div class="col-print-4 text-right  ml-auto">
                                        <table class="table center">
                                            <tbody>
                                                <tr>
                                                    <td class="center">
                                                        <strong>Subtotal:</strong>
                                                    </td>
                                                    <td class="right">{{ $expense->amount }} TK</td>
                                                </tr>

                                                <tr>

                                                    @if (!empty($expensePayback))
                                                        <td class="center">
                                                            <strong>Payback:</strong>
                                                        </td>
                                                        <td class="right">({{ $expensePayback }}) TK</td>
                                                    @else
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="center">
                                                        <strong>Total:</strong>
                                                    </td>
                                                    <td class="right">
                                                        <strong> {{ $expense->amount - $expensePayback }}TK</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <footer class="footer">
                                    <div class="row ">
                                        <div class="col-xs-4">
                                            <p class="lead marginbottom">.......................</p>
                                            <p class="lead marginbottom">HR Signature</p>
                                        </div>

                                        <div class="col-xs-4 text-center">
                                            <p class="lead marginbottom">..............................</p>
                                            <p class="lead marginbottom">Accounts Signature</p>

                                        </div>

                                        <div class="col-xs-4 text-right ">
                                            <p class="lead marginbottom">................................</p>
                                            <p class="lead marginbottom">Authority Signature</p>
                                        </div>

                                    </div>
                                </footer>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <button class="btn btn-primary hidden-print" onclick="myFunction()"><i class="fas fa-print"></i>
                    Print</button>
            </center>
        </div>
    </div>
</body>
<script>
    function myFunction() {
        window.print();
    }
</script>

</html>
