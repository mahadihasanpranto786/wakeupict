<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admitted page print</title>

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

        @media print {
            footer {
                page-break-after: always;
            }
        }

        @media print {
            header {
                page-break-before: always;
            }
        }

        footer {
            font-size: 9px;
            color: #f00;
            text-align: center;
        }

        @page {
            size: A4;
            margin: 11mm 17mm 17mm 17mm;
        }

        @media print {
            footer {
                position: fixed;
                bottom: 0;
            }

            .content-block,
            p {
                page-break-inside: avoid;
            }
        }

    </style>
    <style media="print">
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
                                                <th class="left" style="width: 10%">Student ID</th>
                                                <th class="center" style="width: 45%">Student Info</th>
                                                <th class="right" style="width: 45%">Payment Info Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td class="left">{{ $student->id }}</td>
                                                    <td class="center">

                                                        <strong>Name: </strong> {{ $student->student_name }} <br>

                                                        <strong>Phone: </strong> {{ $student->personal_call_no }} <br>

                                                        <strong>Email: </strong> {{ $student->email }} <br>

                                                        <strong>Education: </strong>
                                                        {{ $student->educational_qualification }}<br>

                                                        <strong>Batch No: </strong>
                                                        {{ $student->batch->batch_number }}

                                                    </td>
                                                    <td class="right">
                                                        <strong>Course: </strong>
                                                        {{ App\model\Course::find($student->course_id)->course_title }}<br>
                                                        <strong>Course Fee: </strong>
                                                        {{ $student->course_fee }} TK<br>
                                                        @if ($student->course_fee != $student->course_after_discount)
                                                            <strong>Course After Discount: </strong>
                                                            {{ $student->course_after_discount }} TK<br>
                                                        @endif
                                                        <strong>Paid: </strong>
                                                        @php
                                                            $payment = App\model\StudentPayment::where('student_id', $student->id)->sum('paid');
                                                            $return = App\model\StudentPayment::where('student_id', $student->id)->sum('return_money');
                                                            $paidTotal = (int) $payment - (int) $return;
                                                            $totalDue = (int) $student->course_after_discount - (int) $paidTotal;
                                                        @endphp
                                                        {{ $payment }} TK<br>
                                                        @if ($return != 0)
                                                            <strong>Return: </strong>
                                                            {{ $return }} TK<br>
                                                        @endif
                                                        <strong>Due: </strong>
                                                        {{ $totalDue }}TK<br>
                                                    </td>
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
