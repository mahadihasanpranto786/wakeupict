<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Khanmethodbd | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/mainstyle.min.css') ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/skins/_all-skins.min.css') ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/morris.css') ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/jquery-jvectormap.css') ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/bootstrap-datepicker.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/daterangepicker.css') ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/bootstrap3-wysihtml5.min.css') ?>">


    <link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/css/dataTables.bootstrap.min.css') ?>">



    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>






<body onload="window.print();">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?= $company_name; ?>
                        <small class="pull-right">Date:<?= date("d-m-Y", strtotime($invoice_information->i_createdat)); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong><?= $company_name; ?></strong><br>
                        <?= $company_address; ?>

                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?= $invoice_information->i_name; ?></strong><br>
                        <?= $invoice_information->i_address; ?><br>

                        Phone: <?= $invoice_information->i_mobile; ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice: <?= $invoice_information->i_id + 1000; ?></b><br>
                    <br>
                    <b>Order Status:</b> <?php if ($invoice_information->i_status == 0) {
                                                echo "ON PROCESS";
                                            } elseif ($invoice_information->i_status == 1) {
                                                echo "COMPLETE";
                                            } elseif ($invoice_information->i_status == 2) {
                                                echo "CANCLE";
                                            } ?><br>
                    <b>Date:</b> <?= $invoice_information->i_createdat; ?><br>
                    <b>Total Cost:</b> <?= $invoice_information->i_totalcost + $invoice_information->i_shipping_cost; ?> TK

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $total_sum_cost = 0;
                            if ($product_list) {
                                $Serial = 1;

                                foreach ($product_list->result() as $row) {
                            ?>
                                    <tr>
                                        <td><?= $Serial++ ?></td>
                                        <td><?= $row->p_tittle; ?></td>
                                        <td><?= $row->p_quantity; ?></td>
                                        <td><?= $row->p_description; ?></td>
                                        <td><?= $row->p_quantity * $row->p_sprice; ?></td>
                                    </tr>

                            <?php
                                    $total_sum_cost +=    $row->p_quantity * $row->p_sprice;
                                }
                            } else {
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Terms of service:</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        <?= $tandc; ?>
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">


                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td><?= $total_sum_cost; ?></td>
                            </tr>
                            <tr>
                                <th>Shipping cost</th>
                                <td><?= $invoice_information->i_shipping_cost; ?></td>
                            </tr>
                            <tr>
                                <th>Discount </th>
                                <td><?= $invoice_information->i_discount; ?></td>
                            </tr>

                            <tr>
                                <th>Total:</th>
                                <td><?= $invoice_information->i_totalcost + $invoice_information->i_shipping_cost; ?></td>
                            </tr>
                            <tr>
                                <th>Advance:</th>
                                <td><?= $invoice_information->i_payment; ?></td>
                            </tr>
                            <tr>
                                <th>Due Payment:</th>
                                <td><?= $invoice_information->i_totalcost - $invoice_information->i_payment + $invoice_information->i_shipping_cost ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>


</html>