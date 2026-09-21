<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3>Dashboard</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- ./col -->

                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                100
                            </h3>

                            <p>Something</p>
                        </div>

                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>
                                200
                            </h3>

                            <p>Something</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                300
                            </h3>

                            <p>Something</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                400
                            </h3>
                            <p>Something</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-red">
                        <div class="inner">
                            <h3>
                                500
                            </h3>
                            <p>Something</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                50
                            </h3>
                            <p>Something</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">

                        </h3>
                    </div>

                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Something</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">Something</th>
                                                    <th class="text-center align-middle">Something</th>
                                                    <th class="text-center align-middle">Something</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="box-body chart-responsive">
                                        <div class="chart" id="sales-chart" style="height: 300px; position: relative;">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Overview</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="text-danger text-xl">
                                            <i class="ion ion-ios-people-outline"></i>
                                        </p>
                                        <p class="d-flex flex-column text-center">
                                            <span class="font-weight-bold">
                                                <i class="ion ion-android-arrow-up text-success"></i>
                                                100
                                            </span>
                                            <span class="text-muted">Something</span>
                                        </p>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                        <p class="text-danger text-xl">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </p>
                                        <p class="d-flex flex-column text-center">
                                            <span class="font-weight-bold">
                                                <i class="ion ion-android-arrow-up text-success"></i><?php
                                                                                                        if (!empty($savings_count)) {
                                                                                                            echo $savings_count;
                                                                                                        } else {
                                                                                                            echo "oo";
                                                                                                        }
                                                                                                        ?>
                                            </span>
                                            <span class="text-muted">Something</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-between align-items-center mb-0 border-bottom mb-3">
                                        <p class="text-danger text-xl">
                                            <i class="fas fa-money-check-alt"></i>
                                        </p>
                                        <p class="d-flex flex-column text-center">
                                            <span class="font-weight-bold">

                                                <i class="ion ion-android-arrow-up text-success"></i>

                                            </span>
                                            <span class="text-muted">Something</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-1">
                                        <p class="text-danger text-xl">
                                            <i class="fa fa-dollar-sign"></i>
                                        </p>
                                        <p class="d-flex flex-column text-center">
                                            <span class="font-weight-bold">
                                                <i class="ion ion-android-arrow-up text-success"></i>
                                                500
                                            </span>
                                            <span class="text-muted">Something</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-1">
                                        <p class="text-danger text-xl">
                                            <i class="fa fa-dollar-sign"></i>
                                        </p>
                                        <p class="d-flex flex-column text-center">
                                            <span class="font-weight-bold">
                                                <i class="ion ion-android-arrow-up text-success"></i>
                                                900
                                            </span>
                                            <span class="text-muted">Something</span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="box-body chart-responsive">
                            <div class="chart" id="bar-chart" style="height: 300px;"></div>
                        </div>
                        <?php echo "<br><br>"; ?>
                    </div>
                </div>
    </section>


    <!-- /.content -->
    <?php

    $year_one = 2017;
    $year_two = 2018;
    $year_three = 2019;
    $year_four = 2020;
    $year_five = 2021;

    $v_one = 20;
    $v_two = 30;
    $v_three = 66;
    $v_four = 55;
    $v_five = 44;


    ?>
    </section>
    <!-- /.content -->
    <?php
    $year_one = 2017;
    $year_two = 2018;
    $year_three = 2019;
    $year_four = 2020;
    $year_five = 2021;

    $v_one = 20;
    $v_two = 30;
    $v_three = 66;
    $v_four = 55;
    $v_five = 44;
    $active_member = 50;


    ?>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
    new Morris.Line({

        element: 'gangetsu',
        data: [{
                year: '<?= $year_one; ?>',
                value: <?= $v_one; ?>
            },
            {
                year: '<?= $year_two; ?>',
                value: <?= $v_two; ?>
            },
            {
                year: '<?= $year_three; ?>',
                value: <?= $v_three; ?>
            },
            {
                year: '<?= $year_four; ?>',
                value: <?= $v_four; ?>
            },
            {
                year: '<?= $year_five; ?>',
                value: <?= $v_five; ?>
            }
        ],
        xkey: 'year',
        ykeys: ['value'],
        labels: ['Value']
    });
</script>


<script>
    $(function() {
        "use strict";

        //DONUT CHART
        var donut = new Morris.Donut({
            element: 'sales-chart',
            resize: true,
            colors: ["#00a65a", "#ffff00", "#f56954", "#3c8dbc"],
            data: [{
                    label: "Active",
                    value: <?php echo $active_member++; ?>
                },
                {
                    label: "Inactive",
                    value: <?php echo $active_member++; ?>
                },
                {
                    label: "Rejected",
                    value: <?php echo $active_member++; ?>
                },
                {
                    label: "Pending",
                    value: <?php echo $active_member++; ?>
                }
            ],
            hideHover: 'auto'
        });
    });

    var bar = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: [

            {
                y: 'January',
                a: '100'
            },
            {
                y: 'February',
                a: '900'
            },
            {
                y: 'March',
                a: '500'
            },
            {
                y: 'April',
                a: '300'
            },
        ],
        barColors: ["#007cc7"],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['member', 'month'],
        hideHover: 'auto'
    });
</script>