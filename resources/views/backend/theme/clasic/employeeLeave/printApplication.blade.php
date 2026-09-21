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
                                <p>
                                    {!! $LeaveApplication->application !!}
                                </p>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive-sm">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 18%">Categories <i
                                                        class="far fa-hand-point-right"></i>....
                                                </th>
                                                @foreach ($leaves as $item)
                                                    <th>{{ $item->category_name }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td> Leave Days <i class="far fa-hand-point-right"></i>....</td>
                                                @foreach ($leaves as $day)
                                                    <td> {{ $day->leave_days }} Days</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Leave You Taken <i class="far fa-hand-point-right"></i>....</td>
                                                @foreach ($leaves as $day)
                                                    @php
                                                        $leaveTaken = App\model\LeaveTaken::where('leave_category_id', $day->id)->sum('leave_taken');
                                                    @endphp
                                                    <td>
                                                        @if (!empty($leaveTaken))
                                                            @if ($leaveTaken == 1)
                                                                {{ $leaveTaken }} Day
                                                            @else
                                                                {{ $leaveTaken }} Days
                                                            @endif
                                                        @else
                                                            0 Days
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Leave You Have <i class="far fa-hand-point-right"></i>....</td>
                                                @foreach ($leaves as $day)
                                                    @php
                                                        $leaveTaken = App\model\LeaveTaken::where('leave_category_id', $day->id)->sum('leave_taken');
                                                    @endphp
                                                    <td> {{ $day->leave_days - $leaveTaken }} Days</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
