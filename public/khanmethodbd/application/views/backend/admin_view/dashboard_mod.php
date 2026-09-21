<!-- Content Wrapper. Contains page content -->
<style>
    .new__custom__pagination {
        display: inline;
        margin-top: 20px;
    }

    .pagination_ci_custom li {
        display: inline;
    }

    .pagination_ci_custom li a {
        border: 1px solid #00c0ef;
        padding: 15px 20px;
    }

    .pagination_ci_custom a.active {
        background-color: #00c0ef;
        color: #fff;
    }

    .small-box:hover {
        color: #000;
    }

    .btn_top {
        margin-top: 22px;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border ">
                        <h3 class="box-title">Sales Report</h3>


                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Today Total Sales:</th>
                                <th><?= $yesterday_sales ?> Tk</th>

                            </tr>
                            <tr>
                                <th>Last 7 days Sales:</th>
                                <th><?= $last_seven_days ?> Tk</th>
                            </tr>
                            <tr>
                                <th>Last 30 days Sales:</th>
                                <th><?= $last_thiry_days ?> Tk</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border ">
                        <h3 class="box-title">Profit Report</h3>


                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Today Total Profit:</th>
                                <th><?= $yesterday_sales_profit ?> Tk</th>

                            </tr>
                            <tr>
                                <th>Last 7 days Profit:</th>
                                <th><?= $last_seven_days_profit ?> Tk</th>
                            </tr>
                            <tr>
                                <th>Last 30 days Profit:</th>
                                <th><?= $last_thiry_days_profit ?> Tk</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header with-border ">
                        <h3 class="box-title">Order Summary</h3>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
            <div class="col-md-7">

                <div class="box box-info">
                    <div class="box-header with-border ">
                        <h3 class="box-title">Order Summary</h3>
                        <form action="<?= base_url("backend/Admin/index") ?>" method="get" class="form-inline pull-right">
                            <div class="row">
                                <div class="col-md-4 col-xs-4">
                                    <div class="form-group">
                                        <input type="number" name="invoice_id" class="form-control" placeholder="Enter invoice id">
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    <div class="form-group">
                                        <input type="number" name="user_number" class="form-control" placeholder="Enter mobile number">
                                    </div>
                                </div>
                                <div class=" col-md-4 col-xs-4">
                                    <button type="submit" class="btn bg-dark">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Invoice Number</th>
                                <th>Invoice Date</th>
                                <th class="text-center">Customer Information</th>
                                <th>Total Cost</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($list_data) {
                                $serial;
                                foreach ($list_data->result() as $row) {
                            ?>
                                    <tr>
                                        <td><?= $serial++ ?></td>
                                        <td><?= $row->i_id + 1000; ?>
                                        </td>
                                        <td>
                                            <?= $row->i_createdat; ?>

                                        </td>
                                        <td>
                                            <table class="table">
                                                <tbody class="table  table-striped">
                                                    <tr>
                                                        <td><?= $row->i_name; ?></td>
                                                        <td><?= $row->i_address; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $row->i_mobile; ?></td>
                                                        <td><?= $row->i_thana; ?></td>
                                                        <td><?= $row->i_district; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td><?= $row->i_totalcost; ?></td>
                                        <td>
                                            <?php
                                            if ($row->i_status == '5') {
                                                echo "<span class='text-warning'>Pending</span>";
                                            } elseif ($row->i_status == '1') {
                                                echo "<span class='text-success'>Complete</span>";
                                            } elseif ($row->i_status == '2') {
                                                echo "<span class='text-danger'>Cancel</span>";
                                            }
                                            ?>

                                        </td>
                                        <td>






                                            <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                View </a>




                                        </td>
                                    </tr>

                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center text-danger">
                                        No data Found
                                    </td>
                                </tr>
                            <?php  }
                            ?>

                        </tbody>

                    </table>
                    <div class="box">
                        <div class="box-body">
                            <input type="hidden" id="valRes" value="<?php if (isset($list_data->result_id->num_rows)) {
                                                                        echo $list_data->result_id->num_rows;
                                                                    } else {
                                                                        echo 0;
                                                                    } ?>">
                            <div class="basic-pagination pull-right wow fadeInUp new__custom__pagination" data-wow-delay=".2s">
                                <?= $this->pagination->create_links() ?><br>
                                <span>Showing <span id="showingRow"></span> Result From <?= $total_rows ?> Result</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>

<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $(document).ready(function() {
        var valRes = $("#valRes").val()
        $("#showingRow").text(valRes)
    })
</script>

<script>
    var options = {
        series: [<?= (int)$orderSummary->result()[0]->pending ?>,
            <?= (int)$orderSummary->result()[0]->complete ?>,
            <?= (int)$orderSummary->result()[0]->cencel ?>
        ],
        chart: {
            type: 'donut',
            dropShadow: {
                enabled: true,
                top: 5,
                left: -15,
                blur: 3,
                opacity: 0.6
            }
        },
        colors: ['#FEB019', '#00E396',
            '#FF4560'
        ],
        stroke: {
            colors: ['#fff']
        },
        fill: {
            opacity: 0.8
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                    },
                    size: '60%',
                },
            },
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        labels: ['Pending', 'Complete', 'Cancel']

    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>