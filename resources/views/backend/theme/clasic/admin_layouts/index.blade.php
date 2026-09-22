@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Dashboard
@endsection

{{-- menu active start --}}
@section('active_dashboard', 'active')
{{-- menu active end --}}
@section('maincontant')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $pages }}</h3>
                    <p>Total SEO Pages</p>

                    @php
                        $SEO = 0;
                        $Course = 0;
                        $Blog = 0;
                        $User = 0;
                        $AdmittedStudent = 0;
                        $Contact = 0;
                        foreach (userRolls() as $roll) {
                            if ($roll->module_id == 46) {
                                $SEO = 46;
                            } elseif ($roll->module_id == 47) {
                                $Course = 47;
                            } elseif ($roll->module_id == 51) {
                                $Blog = 51;
                            } elseif ($roll->module_id == 59) {
                                $User = 59;
                            } elseif ($roll->module_id == 58) {
                                $AdmittedStudent = 58;
                            } elseif ($roll->module_id == 45) {
                                $Contact = 45;
                            }
                        }
                    @endphp
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                @if ((checkUserType() == 0 && $SEO != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ route('pages') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="#" class="small-box-footer">---</a>
                @endif

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $courses }}</h3>

                    <p>Total Courses</p>
                </div>
                <div class="icon"><i class="far fa-star"></i>
                </div>
                @if ((checkUserType() == 0 && $Course != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ route('courses-list') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="#" class="small-box-footer">---</a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $blogs }}</h3>

                    <p>Total Blogs</p>
                </div>
                <div class="icon"><i class="fas fa-blog"></i>
                </div>
                @if ((checkUserType() == 0 && $Blog != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ route('blogs-list') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="#" class="small-box-footer">---</a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $course_member }}</h3>

                    <p>Total Users (Course Members)</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i>
                </div>
                @if ((checkUserType() == 0 && $User != 0) || Auth::user()->type == 'Admin')
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="#" class="small-box-footer">---</a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $visitors }}</h3>

                    <p>Total Visitors</p>
                </div>
                <div class="icon"><i class="fas fa-eye"></i>
                </div>
                <a href="#" class="small-box-footer">---</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $CurrentMonthVisitors }}</h3>

                    <p>This Month Visitors</p>
                </div>
                <div class="icon"><i class="fas fa-eye"></i>
                </div>
                <a href="#" class="small-box-footer">---</a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ $admittedStudents }}</h3>

                    <p>Total Admitted Students</p>
                </div>
                <div class="icon"><i class="fas fa-graduation-cap"></i>
                </div>
                @if ((checkUserType() == 0 && $AdmittedStudent != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ url('admited-students-list') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="#" class="small-box-footer">---</a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-muted">
                <div class="inner">
                    <h3>{{ $contacts }}</h3>

                    <p>Total Contacts</p>
                </div>
                <div class="icon"><i class="fas fa-sms"></i>
                </div>
                @if ((checkUserType() == 0 && $Contact != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ url('contacts-list') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="#" class="small-box-footer">---</a>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">Income And Expense Report (Last 12 Months)</div>
                <div class="card-body">
                    <div id="incomeExpenseChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">Last 7 Days Visitors</div>
                <div class="card-body">
                    <div id="visitorChart"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ url('income-expense-chart-ajax') }}",
                success: function(response) {
                    var monthArray = [];
                    var expenseArray = [];
                    var incomeArray = [];

                    $.each(response.monthlyExpense, function(index, value) {
                        monthArray.push(index);
                        expenseArray.push(value);
                    });

                    $.each(response.monthlyIncome, function(index, value) {
                        incomeArray.push(value);
                    });


                    var options = {
                        series: [{
                            name: 'Income',
                            data: incomeArray
                        }, {
                            name: 'Expense',
                            data: expenseArray
                        }],
                        chart: {
                            height: 350,
                            width: '100%',
                            type: 'area',
                        },
                        dataLabels: {
                            enabled: true
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        xaxis: {
                            type: 'datetime',
                            categories: monthArray
                        },
                        tooltip: {
                            x: {
                                format: 'MM/yy'
                            },
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#incomeExpenseChart"), options);
                    chart.render();
                }
            });
            var colors = ['#F44336', '#E91E63', '#9C27B0', '#28a745', '#ffc107', '#17a2b8',
                '#9C27B0'
            ];
            var optionsVisitor = {
                series: [{
                    name: 'Total',
                    data: [

                        <?php
                        if ($weeklyData) {
                            foreach ($weeklyData as $row => $value) {
                                echo '"' . $value . '",';
                            }
                        } ?>
                    ]
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {
                            // console.log(chart, w, e)
                        }
                    }
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: [

                        <?php
                        if ($weeklyData) {
                            foreach ($weeklyData as $row => $value) {
                                if ($row == date('l')) {
                                    echo '"' . 'Today' . '",';
                                } else {
                                    echo '"' . $row . '",';
                                }
                            }
                        } ?>
                    ],
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#visitorChart"), optionsVisitor);
            chart.render();
        });
    </script>
@endsection
