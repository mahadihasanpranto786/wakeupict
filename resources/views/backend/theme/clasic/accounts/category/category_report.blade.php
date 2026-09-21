@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Account Category Report
@endsection
{{-- menu active start --}}
@section('account', 'menu-open')

@section('menu_active', 'active')

@section('category_active', 'menu-open')

@section('menu_active_category', 'active bg-info')

@section('category_report', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Account Category Report</h3>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header bg-light">Last Month Global Expense Report</h5>
                                <div id="globalExpenseReport"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header bg-light">Last Month Global Income Report</h5>
                                <div id="globalIncomeReport"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header bg-light">Last Month Local Expense Report</h5>
                                <div id="localExpenseReport"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header bg-light">Last Month Local Income Report</h5>
                                <div id="localIncomeReport"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var colors = ['#F44336', '#E91E63', '#9C27B0', '#28a745', '#ffc107', '#17a2b8',
                '#9C27B0'
            ];

            // global expense chart 
            var options = {
                series: [{
                    name: 'Total',
                    data: [
                        <?php
                        foreach ($globalExpenseCategory as $category) {
                            echo '"' . getGlobalExpenseLastMonth($category->id) . '",';
                        }
                        ?>
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
                    show: true
                },
                yaxis: [{
                    tooltip: {
                        offsetX: -28,
                        enabled: true
                    }
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($globalExpenseCategory as $category) {
                            echo '"' . $category->title . '",';
                        }
                        ?>
                    ],
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#globalExpenseReport"), options);
            chart.render();

            // global income chart 

            var options2 = {
                series: [{
                    name: 'Total',
                    data: [
                        <?php
                        foreach ($globalIncomeCategory as $category) {
                            echo '"' . getGlobalIncomeLastMonth($category->id) . '",';
                        }
                        ?>
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
                    textAnchor: 'middle',
                    enabled: true,
                    offsetX: 0,
                    offsetY: -20,
                },
                legend: {
                    show: true
                },
                yaxis: [{
                    tooltip: {
                        offsetX: -28,
                        enabled: true
                    }
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($globalIncomeCategory as $category) {
                            echo '"' . $category->title . '",';
                        }
                        ?>
                    ],
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#globalIncomeReport"), options2);
            chart.render();

            //local expense chart
            var options3 = {
                series: [{
                    name: 'Total',
                    data: [
                        <?php
                        foreach ($localExpenseCategory as $category) {
                            echo '"' . getLocalExpenseLastMonth($category->id) . '",';
                        }
                        ?>
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
                    textAnchor: 'middle',
                    enabled: true,
                    offsetX: 0,
                    offsetY: -20,
                },
                legend: {
                    show: true
                },
                yaxis: [{
                    tooltip: {
                        offsetX: -28,
                        enabled: true
                    }
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($localExpenseCategory as $category) {
                            echo '"' . $category->title . '",';
                        }
                        ?>
                    ],
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#localExpenseReport"), options3);
            chart.render();

            //local income report

            var options4 = {
                series: [{
                    name: 'Total',
                    data: [
                        <?php
                        foreach ($localIncomeCategory as $category) {
                            echo '"' . getLocalIncomeLastMonth($category->id) . '",';
                        }
                        ?>
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
                    textAnchor: 'middle',
                    enabled: true,
                    offsetX: 0,
                    offsetY: -20,
                },
                legend: {
                    show: true
                },
                yaxis: [{
                    tooltip: {
                        offsetX: -28,
                        enabled: true
                    }
                }],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($localIncomeCategory as $category) {
                            echo '"' . $category->title . '",';
                        }
                        ?>
                    ],
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '12px'
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#localIncomeReport"), options4);
            chart.render();


        });
    </script>
@endsection
