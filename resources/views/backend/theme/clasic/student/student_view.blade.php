<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student View</title>

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
            /* margin: 5%; */
            margin-top: 10%;
        }

        @page {
            size: auto;
            margin: 0mm;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="container-fluid">
                <div>
                    <div>
                        <div class="card">
                            <div class="text-center" id="box">
                                <h1>Wake Up ICT</h1>
                                <p>A Prominent Software Farm at Rajbari</p>
                                <p>Contact Us: 01791612121</p>
                            </div>
                            <div class="card-header">
                                <p><strong>Date:</strong> {{ Carbon\Carbon::parse($student->date)->format('d M, Y') }}
                                </p>
                            </div>
                            <div>
                                <strong>Student Slip: {{ 1000 + $student->id }}</strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive-sm">
                                    <div class="sm:px-16 py-10 sm:py-20">
                                        <div class="overflow-x-auto">
                                            <table class="table grid ">
                                                <thead>
                                                    <tr>
                                                        <td class="border-b dark:border-dark-5 col-span-2">
                                                            <div>1. Student Name:
                                                            </div>
                                                        </td>
                                                        <td class="text-left border-b dark:border-dark-5 w-32">
                                                            {{ $student->student_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b dark:border-dark-5">
                                                            <div class="font-medium whitespace-nowrap col-span-2">2.
                                                                Gender:</div>
                                                        </td>
                                                        <td class="text-left border-b dark:border-dark-5 w-32">
                                                            {{ $student->gander }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b dark:border-dark-5">
                                                            <div>3. Date Of Birth:
                                                            </div>
                                                        </td>
                                                        <td class="text-left border-b dark:border-dark-5 w-32">
                                                            {{ $student->age }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b dark:border-dark-5">
                                                            <div>4. Father's Name:
                                                            </div>
                                                        </td>
                                                        <td class="text-left border-b dark:border-dark-5 w-32">
                                                            {{ $student->fathers_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b dark:border-dark-5">
                                                            <div>5. Mother's Name:
                                                            </div>
                                                        </td>
                                                        <td class="text-left border-b dark:border-dark-5 w-32">
                                                            {{ $student->mothers_name }}
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="table-responsive-sm">
                                                        <table class="table table-striped table-bordered">

                                                            <thead>
                                                                <tr>
                                                                    <th class="left">
                                                                        Nationality:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->nationality }}</th>
                                                                </tr>

                                                                <tr>
                                                                    <th class="left">
                                                                        National Id No:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->national_id_no }}
                                                                    </th>
                                                                </tr>

                                                                <tr>
                                                                    <th class="left">
                                                                        Present Address:
                                                                    </th>
                                                                    <th class="center">
                                                                        {!! $student->present_address !!}
                                                                    </th>
                                                                </tr>

                                                                <tr>
                                                                    <th class="left">
                                                                        Permanent Address:
                                                                    </th>
                                                                    <th class="center">
                                                                        {!! $student->permanent_address !!}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="left">
                                                                        Occupation:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->occupation }}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="left">
                                                                        Religion:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->religion }}
                                                                    </th>
                                                                </tr>

                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="table-responsive-sm">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>

                                                                <tr>
                                                                    <th class="left">
                                                                        Personal Cell No:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->personal_call_no }}
                                                                    </th>
                                                                </tr>

                                                                <tr>
                                                                    <th class="left">
                                                                        Email:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->email }}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="left">
                                                                        Age:
                                                                        @php
                                                                            $data = $student->age;
                                                                            // dd($data);
                                                                            $year = date('Y', strtotime($data));
                                                                            $month = date('m', strtotime($data));
                                                                            $day = date('d', strtotime($data));
                                                                            $age = floor(((date('Y') - $year) * 512 + (date('m') - $month) * 32 + date('d') - $day) / 512);
                                                                        @endphp
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $age }} Years
                                                                    </th>
                                                                </tr>

                                                                <tr>
                                                                    <th class="left">
                                                                        Educational Qualification:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->educational_qualification }}
                                                                    </th>
                                                                </tr>


                                                                <tr>
                                                                    <th class="left">
                                                                        Result:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->result }}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="left">
                                                                        Passing Year:
                                                                    </th>
                                                                    <th class="center">
                                                                        {{ $student->passing_year }}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive-sm">
                                                <table class="table table-striped table-bordered">

                                                    <thead>
                                                        <tr>
                                                            <th class="left">
                                                                Course Applied
                                                            </th>
                                                            <th class="center">
                                                                Course Fee</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="right">
                                                                {{ App\model\Course::find($student->course_id)->course_title }}

                                                            </td>
                                                            <td class="right">
                                                                {{ $student->course_after_discount }}
                                                                TK</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
