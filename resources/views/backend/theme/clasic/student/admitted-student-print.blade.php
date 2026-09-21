<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>student View</title>

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
                                <h6 class="text-center">Contact Us: 01791612121</h6>
                            </div>

                            <div class="row">
                                <div class="col-xs-6"></div>
                                <div class="col-xs-6">
                                    <p><strong>Date: {{ Carbon\Carbon::now()->format('d F, Y') }}</strong> </p>
                                </div>
                                <div class="col-xs-6">
                                    <p><strong>Name: {{ $student->student_name }}</strong> </p>
                                    <p><strong>Address: {{ $student->present_address }}</strong> </p>
                                    <p><strong>Contact Number: {{ $student->personal_call_no }}</strong> </p>
                                    <p><strong>Email: {{ $student->email }}</strong> </p>
                                </div>
                                <div class="col-xs-6">
                                    <p><strong>Course Name: {{ $student->course->course_title }}</strong> </p>
                                    <p><strong>Coruse Duration: {{ $student->course->time_line }}</strong> </p>
                                    <p><strong>Cost: {{ $student->course_after_discount }} TK</strong> </p>
                                    <p><strong>Start Date: {{ $student->date }}</strong> </p>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="left" style="width: 20%">Payment Date</th>
                                                <th class="center" style="width: 20%">Recever</th>
                                                <th class="right" style="width: 20%">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $studentPayments = App\model\StudentPayment::where([
                                                    'student_id' => $student->id,
                                                    'batch_id' => $student->batch_id,
                                                ])->get();
                                            @endphp

                                            @php
                                                $payment = App\model\StudentPayment::where('student_id', $student->id)->sum('paid');
                                                $return = App\model\StudentPayment::where('student_id', $student->id)->sum('return_money');
                                                $paidTotal = (int) $payment - (int) $return;
                                                $totalDue = (int) $student->course_after_discount - (int) $paidTotal;
                                            @endphp
                                            @foreach ($studentPayments as $payment)
                                                <tr>
                                                    <td class="left">
                                                        {{ Carbon\Carbon::parse($payment->date)->format('d F, Y') }}
                                                    </td>
                                                    <td class="center">
                                                        {{ $payment->user->name }}
                                                    </td>
                                                    <td class="right">{{ $payment->paid }} TK</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8"></div>
                                    <div class="col-print-4 text-right  ml-auto">
                                        <table class="table  center">
                                            <tbody>
                                                <tr>
                                                    <td class="center">
                                                        <strong>Total Paid:</strong>
                                                    </td>
                                                    <td class="right">{{ $paidTotal }} TK</td>
                                                </tr>
                                                <tr>
                                                    <td class="center">
                                                        <strong>Due:</strong>
                                                    </td>
                                                    <td class="right">
                                                        <strong>{{ $totalDue }} TK</strong>
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
