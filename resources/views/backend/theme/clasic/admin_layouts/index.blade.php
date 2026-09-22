@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Dashboard
@endsection

{{-- menu active start --}}
@section('active_dashboard', 'active')
{{-- menu active end --}}

@section('maincontant')

    {{-- ============================================================
         ENTERPRISE DASHBOARD — Wake Up ICT Admin
         All dynamic variables, routes, and access-control logic preserved.
         ============================================================ --}}

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

    {{-- Page Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; padding-bottom:16px; border-bottom: 1px solid rgba(30,41,59,0.6);">
        <div>
            <h1 style="font-size:22px; font-weight:700; color:#e2e8f0; margin:0 0 4px; font-family:'Plus Jakarta Sans',sans-serif;">
                Command Center
            </h1>
            <p style="font-size:12px; color:#64748b; margin:0; font-family:'JetBrains Mono',monospace; letter-spacing:0.05em;">
                WAKE UP ICT — ADMIN DASHBOARD
            </p>
        </div>
        <div style="display:flex; align-items:center; gap:8px;">
            <span style="display:inline-flex; align-items:center; gap:5px; font-size:11px; color:#64748b; font-family:'JetBrains Mono',monospace; background:rgba(30,41,59,0.5); padding:5px 10px; border-radius:6px; border:1px solid rgba(30,41,59,0.8);">
                <span style="width:6px;height:6px;background:#10b981;border-radius:50%;display:inline-block;box-shadow:0 0 8px #10b981;"></span>
                System Online
            </span>
        </div>
    </div>

    {{-- ============================================================
         ROW 1: Primary KPI Stat Cards (4 columns)
         ============================================================ --}}
    <div class="row">

        {{-- SEO Pages --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $pages }}</h3>
                    <p>Total SEO Pages</p>
                </div>
                <div class="icon"><i class="fas fa-book"></i></div>
                @if ((checkUserType() == 0 && $SEO != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ route('pages') }}" class="small-box-footer">
                        View Pages <i class="fas fa-arrow-right-long" style="font-size:10px;"></i>
                    </a>
                @else
                    <a href="#" class="small-box-footer">No Access</a>
                @endif
            </div>
        </div>

        {{-- Courses --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $courses }}</h3>
                    <p>Total Courses</p>
                </div>
                <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                @if ((checkUserType() == 0 && $Course != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ route('courses-list') }}" class="small-box-footer">
                        View Courses <i class="fas fa-arrow-right-long" style="font-size:10px;"></i>
                    </a>
                @else
                    <a href="#" class="small-box-footer">No Access</a>
                @endif
            </div>
        </div>

        {{-- Blogs --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $blogs }}</h3>
                    <p>Total Blogs</p>
                </div>
                <div class="icon"><i class="fas fa-pen-nib"></i></div>
                @if ((checkUserType() == 0 && $Blog != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ route('blogs-list') }}" class="small-box-footer">
                        View Blogs <i class="fas fa-arrow-right-long" style="font-size:10px;"></i>
                    </a>
                @else
                    <a href="#" class="small-box-footer">No Access</a>
                @endif
            </div>
        </div>

        {{-- Course Members --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $course_member }}</h3>
                    <p>Total Course Members</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
                @if ((checkUserType() == 0 && $User != 0) || Auth::user()->type == 'Admin')
                    <a href="#" class="small-box-footer">
                        View Members <i class="fas fa-arrow-right-long" style="font-size:10px;"></i>
                    </a>
                @else
                    <a href="#" class="small-box-footer">No Access</a>
                @endif
            </div>
        </div>

    </div><!-- /.row 1 -->

    {{-- ============================================================
         ROW 2: Secondary KPI Cards
         ============================================================ --}}
    <div class="row">

        {{-- Total Visitors --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $visitors }}</h3>
                    <p>Total Visitors</p>
                </div>
                <div class="icon"><i class="fas fa-eye"></i></div>
                <a href="#" class="small-box-footer">Analytics</a>
            </div>
        </div>

        {{-- Monthly Visitors --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $CurrentMonthVisitors }}</h3>
                    <p>This Month Visitors</p>
                </div>
                <div class="icon"><i class="fas fa-chart-line"></i></div>
                <a href="#" class="small-box-footer">This Month</a>
            </div>
        </div>

        {{-- Admitted Students --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $admittedStudents }}</h3>
                    <p>Total Admitted Students</p>
                </div>
                <div class="icon"><i class="fas fa-user-graduate"></i></div>
                @if ((checkUserType() == 0 && $AdmittedStudent != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ url('admited-students-list') }}" class="small-box-footer">
                        View Students <i class="fas fa-arrow-right-long" style="font-size:10px;"></i>
                    </a>
                @else
                    <a href="#" class="small-box-footer">No Access</a>
                @endif
            </div>
        </div>

        {{-- Contacts --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $contacts }}</h3>
                    <p>Total Contacts</p>
                </div>
                <div class="icon"><i class="fas fa-envelope"></i></div>
                @if ((checkUserType() == 0 && $Contact != 0) || Auth::user()->type == 'Admin')
                    <a href="{{ url('contacts-list') }}" class="small-box-footer">
                        View Contacts <i class="fas fa-arrow-right-long" style="font-size:10px;"></i>
                    </a>
                @else
                    <a href="#" class="small-box-footer">No Access</a>
                @endif
            </div>
        </div>

    </div><!-- /.row 2 -->

    {{-- ============================================================
         ROW 3: Charts
         ============================================================ --}}
    <div class="row">

        {{-- Income & Expense Chart --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Income &amp; Expense Report
                    <span style="font-size:11px; color:#64748b; font-family:'JetBrains Mono',monospace; margin-left:8px; font-weight:400;">Last 12 Months</span>
                </div>
                <div class="card-body" style="padding: 12px 16px 16px !important;">
                    <div id="incomeExpenseChart"></div>
                </div>
            </div>
        </div>

        {{-- Weekly Visitors Chart --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Visitor Traffic
                    <span style="font-size:11px; color:#64748b; font-family:'JetBrains Mono',monospace; margin-left:8px; font-weight:400;">Last 7 Days</span>
                </div>
                <div class="card-body" style="padding: 12px 16px 16px !important;">
                    <div id="visitorChart"></div>
                </div>
            </div>
        </div>

    </div><!-- /.row 3 -->

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // ── Income & Expense Chart (ApexCharts Area) ──────────────────
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
                            height: 300,
                            width: '100%',
                            type: 'area',
                            background: 'transparent',
                            toolbar: { show: false },
                            animations: { enabled: true, speed: 600 }
                        },
                        theme: { mode: 'dark' },
                        colors: ['#10b981', '#f87171'],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.35,
                                opacityTo: 0.02,
                                stops: [0, 95]
                            }
                        },
                        dataLabels: { enabled: false },
                        stroke: { curve: 'smooth', width: 2 },
                        grid: {
                            borderColor: 'rgba(30, 41, 59, 0.5)',
                            strokeDashArray: 4
                        },
                        xaxis: {
                            type: 'datetime',
                            categories: monthArray,
                            labels: { style: { colors: '#64748b', fontSize: '11px' } }
                        },
                        yaxis: {
                            labels: { style: { colors: '#64748b', fontSize: '11px' } }
                        },
                        tooltip: {
                            theme: 'dark',
                            x: { format: 'MM/yy' }
                        },
                        legend: {
                            labels: { colors: '#94a3b8' }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#incomeExpenseChart"), options);
                    chart.render();
                }
            });

            // ── Weekly Visitor Chart (ApexCharts Bar) ────────────────────
            var barColors = ['#10b981', '#22d3ee', '#818cf8', '#f59e0b', '#f87171', '#34d399', '#a78bfa'];

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
                    height: 300,
                    type: 'bar',
                    background: 'transparent',
                    toolbar: { show: false },
                    animations: { enabled: true, speed: 600 }
                },
                theme: { mode: 'dark' },
                colors: barColors,
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                        distributed: true,
                        borderRadius: 6,
                        borderRadiusApplication: 'end'
                    }
                },
                dataLabels: {
                    enabled: true,
                    style: { fontSize: '11px', colors: ['#94a3b8'] }
                },
                legend: { show: false },
                grid: {
                    borderColor: 'rgba(30, 41, 59, 0.5)',
                    strokeDashArray: 4
                },
                xaxis: {
                    categories: [
                        <?php
                        if ($weeklyData) {
                            foreach ($weeklyData as $row => $value) {
                                if ($row == date('l')) {
                                    echo '"Today",';
                                } else {
                                    echo '"' . $row . '",';
                                }
                            }
                        } ?>
                    ],
                    labels: {
                        style: {
                            colors: barColors,
                            fontSize: '11px',
                            fontFamily: "'JetBrains Mono', monospace"
                        }
                    }
                },
                yaxis: {
                    labels: { style: { colors: '#64748b', fontSize: '11px' } }
                },
                tooltip: {
                    theme: 'dark'
                }
            };

            var chartVisitor = new ApexCharts(document.querySelector("#visitorChart"), optionsVisitor);
            chartVisitor.render();

        });
    </script>
@endsection
