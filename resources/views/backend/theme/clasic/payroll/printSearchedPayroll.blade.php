<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Print Searched Payroll</title>

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
            margin: 30px;
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
                            <center>
                                <button class="btn btn-primary hidden-print" onclick="myFunction()"><i
                                        class="fas fa-print"></i>
                                    Print</button>
                            </center>
                            <div class="card-header">
                                <h2 class="text-center">Wake Up ICT</h2>
                                <h6 class="text-center">A Prominent Software Farm at Rajbari</h6>
                                <h6 class="text-center">Contact Us: 01791612121</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="left" style="width: 5%">SL</th>
                                                <th class="center" style="width: 20%">Employee Name</th>
                                                <th class="right" style="width: 15%">Payment Date</th>
                                                <th>Salary Month</th>
                                                <th>Amount(TK)</th>
                                                <th>Remark</th>
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
                                                    <td>{{ Carbon\Carbon::parse($payroll->salary_month)->format('F, Y') }}
                                                    </td>
                                                    <td>{{ $payroll->amount }} TK</td>
                                                    <td>{!! $payroll->remark !!} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function myFunction() {
        window.print();
    }
</script>

</html>
