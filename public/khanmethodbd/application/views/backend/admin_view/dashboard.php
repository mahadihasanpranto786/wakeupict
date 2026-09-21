<!-- Content Wrapper. Contains page content -->
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

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $today_profit ?></h3>

                        <p>Today Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $total_profit ?></h3>

                        <p>Total Profit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= $pending_order ?></h3>

                        <p>Pending Order</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $complete_order ?></h3>

                        <p>Complete Order</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>



        <h2 class="page-header">Orders Quick View</h2>

        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Pending Order List</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Shipped Order List</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Completed Order List</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Invoice Number</th>
                                        <th>Invoice Date</th>
                                        <th>Customer Information</th>
                                        <th>Total Cost</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($pending_list) {
                                        $Serial = 1;
                                        foreach ($pending_list->result() as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $Serial++ ?></td>
                                                <td><?= $row->i_id + 1000; ?>
                                                </td>
                                                <td>
                                                    <?= $row->i_createdat; ?>

                                                </td>
                                                <td> <?= $row->i_name; ?><br>
                                                    <?= $row->i_mobile; ?><br>
                                                    <?= $row->i_address; ?><br>
                                                    <?= $row->i_thana; ?><br>
                                                    <?= $row->i_district; ?>
                                                </td>
                                                <td><?= $row->i_totalcost; ?></td>
                                                <td>






                                                    <a href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                        View </a>

                                                    <a href="<?php echo base_url(); ?>confirm_shipped/<?= $row->i_id ?>"> <i class="fa fa-truck" aria-hidden="true"></i>

                                                        Shipped </a>





                                                    <a href="<?php echo base_url(); ?>confirm_invoice/<?= $row->i_id ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                        complete </a>

                                                    <a onclick="return confirm('Are you sure you want to Cancel this Item?');" href="<?php echo base_url(); ?>backend/Order/cancel_invoice/<?= $row->i_id ?>"><i class="fa fa-trash" aria-hidden="true"></i>
                                                        cancel</a>


                                                </td>
                                            </tr>

                                    <?php }
                                    } else {
                                    }
                                    ?>

                                </tbody>

                            </table>



                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table id="tab2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Invoice Number</th>
                                        <th>Invoice Date</th>
                                        <th>Customer Information</th>
                                        <th>Total Cost</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($ship_list) {
                                        $Serial = 1;
                                        foreach ($ship_list->result() as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $Serial++ ?></td>
                                                <td><?= $row->i_id + 1000; ?>
                                                </td>
                                                <td>
                                                    <?= $row->i_createdat; ?>

                                                </td>
                                                <td> <?= $row->i_name; ?><br>
                                                    <?= $row->i_mobile; ?><br>
                                                    <?= $row->i_address; ?><br>
                                                    <?= $row->i_thana; ?><br>
                                                    <?= $row->i_district; ?>
                                                </td>
                                                <td><?= $row->i_totalcost; ?></td>
                                                <td>






                                                    <a href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                        View </a>







                                                    <a href="<?php echo base_url(); ?>confirm_invoice/<?= $row->i_id ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                        complete </a>

                                                    <a onclick="return confirm('Are you sure you want to Cancel this Item?');" href="<?php echo base_url(); ?>backend/Order/cancel_invoice/<?= $row->i_id ?>"><i class="fa fa-trash" aria-hidden="true"></i>
                                                        cancel</a>


                                                </td>
                                            </tr>

                                    <?php }
                                    } else {
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <table id="tab3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Invoice Number</th>
                                        <th>Invoice Date</th>
                                        <th>Customer Information</th>
                                        <th>Total Cost</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($complete_list) {
                                        $Serial = 1;
                                        foreach ($complete_list->result() as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $Serial++ ?></td>
                                                <td><?= $row->i_id + 1000; ?>
                                                </td>
                                                <td>
                                                    <?= $row->i_createdat; ?>

                                                </td>
                                                <td> <?= $row->i_name; ?><br>
                                                    <?= $row->i_mobile; ?><br>
                                                    <?= $row->i_address; ?><br>
                                                    <?= $row->i_thana; ?><br>
                                                    <?= $row->i_district; ?>
                                                </td>
                                                <td><?= $row->i_totalcost; ?></td>
                                                <td>






                                                    <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                        View </a>










                                                </td>
                                            </tr>

                                    <?php }
                                    } else {
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->

    </section>



    <!-- /.content -->
</div>
<!-- /.content-wrapper -->