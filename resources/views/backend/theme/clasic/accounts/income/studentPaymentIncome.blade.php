<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Payment View</title>

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
            width: 41%;
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

        #box2 {
            margin: 0%;
        }

        @page {
            size: auto;
            margin: 0mm;
        }

        td.right {
            width: 30%;
        }
    </style>
</head>

<body>

    <div id="box">
        <div class="container">
            <div class="row ">
                <div class="container-fluid">
                    <div>
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Wake Up ICT</h2>
                                <h6 class="text-center">A Prominent Software Farm at Rajbari</h6>
                                <p><strong>Date:</strong> {{ Carbon\Carbon::parse($payment->date)->format('d M, Y') }}
                                </p>
                            </div>
                            <div>
                                <strong>Payment Slip: {{ 1000 + $payment->id }}</strong>
                            </div>
                            <div>
                                <strong>{{ $static }} Income</strong>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive-sm">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="left" style="width: 15%">Category</th>
                                                <th class="left" style="width: 15%">Name</th>
                                                <th class="left" style="width: 20%">Course</th>
                                                <th class="left" style="width: 15%">Batch</th>
                                                <th class="center" style="width: 30%">Remark</th>
                                                <th class="right" style="width: 20%">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $income = App\model\Income::findOrFail($payment->income_id);
                                                $category = App\model\AccountCategory::findOrFail($income->title_id);
                                            @endphp
                                            <tr>
                                                <td class="left">{{ $category->title }}</td>
                                                <td class="left">{{ $payment->student->student_name }}</td>
                                                <td class="left">
                                                    {{ $payment->course->course_title }}
                                                </td>
                                                <td class="left">
                                                    {{ $payment->batch->batch_number }}
                                                </td>
                                                <td class="center">{!! $payment->remark !!}</td>
                                                <td class="right">{{ $income->amount }} TK</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row" id="box2">
                                    <div class="col-xs-7"></div>
                                    <div class="col-print-5 text-left  ml-auto">
                                        <table class="table table-bordered center">
                                            <tbody>
                                                <tr>
                                                    <td class="center">
                                                        <strong>Course Fee: </strong>
                                                    </td>
                                                    @php
                                                        $admittedStudent = App\model\AdmitedStudent::where('id', $payment->student_id)->first();
                                                    @endphp
                                                    <td class="right">{{ $admittedStudent->course_fee }} TK
                                                    </td>
                                                </tr>
                                                @if ($admittedStudent->course_fee != $admittedStudent->course_after_discount)
                                                    <tr>
                                                        <td class="center">
                                                            <strong>Course After Discount: </strong>
                                                        </td>
                                                        <td class="right">
                                                            {{ $admittedStudent->course_after_discount }} TK
                                                        </td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td class="center">
                                                        <strong>Amount Received: </strong>
                                                    </td>
                                                    <td class="right">{{ $payment->paid }} TK</td>
                                                </tr>
                                                @if ($payment->return_money != 0)
                                                    <tr>
                                                        <td class="center">
                                                            <strong>Amount Return: </strong>
                                                        </td>
                                                        <td class="right">{{ $payment->return_money }} TK
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($payment->return_money == 0)
                                                    <tr>
                                                        <td class="center">
                                                            <strong>Due:</strong>
                                                        </td>
                                                        <td class="right">
                                                            {{ $admittedStudent->course_after_discount - $payment->paid - $payment->return_money }}
                                                            TK</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            <strong>
                                                                <p>Reason: {!! $payment->return_reason !!}</p>
                                                            </strong>
                                                        </td>
                                                        <td class="right">
                                                            {{ $income->amount }} TK</td>
                                                    </tr>
                                                @endif
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
