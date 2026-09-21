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

    <!-- Main content -->



    <?php
    if ($invoice_list) {
        $Serial = 1;
        foreach ($invoice_list->result() as $invoice_information) {
            $product_list = $this->Common->get_data_single_conditional('oder_products', 'invoice_id', $invoice_information->i_id);
    ?>






            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <img src="<?php echo base_url(); ?>assets/products/<?= $company_logo ?>" class="user-image" alt="User Image" width="200" height="128">
                        </th>
                        <th>
                            <div class="text-right">
                                <address>
                                    <strong><?= $company_name; ?></strong><br>
                                    <?= $company_address; ?>

                                </address>
                            </div>

                        </th>

                    </tr>

                </thead>
            </table>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <h4>Order Date: <?= $invoice_information->i_createdat; ?></h4>
                        </th>


                    </tr>

                </thead>
            </table>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <h4>Order To: </h4>
                        </th>
                        <th>
                            <h4>Order Number: <?= $invoice_information->i_id + 1000; ?></h4>
                        </th>


                    </tr>

                </thead>
            </table>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <address>
                                <strong>Customer Name: <?= $invoice_information->i_name; ?></strong><br>
                                Address: <?= $invoice_information->i_address; ?><br>

                                Phone: <?= $invoice_information->i_mobile; ?><br>
                                District: <?= $invoice_information->i_district; ?><br>
                                Thana: <?= $invoice_information->i_thana; ?>
                            </address>
                        </th>



                    </tr>

                </thead>
            </table>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <h4>Payment Method</h4>
                        </th>
                        <th>
                            <h4><b>Cash On Delivery</b></h4>
                        </th>


                    </tr>

                </thead>
            </table>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Tax</th>
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
                                <td><?= $row->p_tittle; ?>

                                    <br>
                                    <img src="<?php echo base_url(); ?>assets/products/<?= $row->p_imagepath ?>" class="user-image" alt="User Image" width="50" height="50">

                                </td>
                                <td><?= $row->p_sprice; ?></td>
                                <td><?= $row->p_quantity; ?></td>
                                <td>0</td>

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



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="60%"> </th>

                        <th width="20%">
                            Subtotal:
                        </th>
                        <th width="20%">
                            <?= $total_sum_cost; ?>
                        </th>


                    </tr>
                    <tr>
                        <th width="60%"> </th>

                        <th width="20%">
                            Shipping Cost
                        </th>
                        <th width="20%">
                            <?= $invoice_information->i_shipping_cost; ?>
                        </th>


                    </tr>


                    <?php if ($invoice_information->i_discount != 0) { ?>
                        <tr>
                            <th width="60%"> </th>

                            <th width="20%">
                                Discount
                            </th>
                            <th width="20%">
                                <?= $invoice_information->i_discount; ?>
                            </th>


                        </tr>
                    <?php } ?>



                    <tr>
                        <th width="60%"> </th>

                        <th width="20%">
                            Total Cost
                        </th>
                        <th width="20%">
                            <?= $invoice_information->i_totalcost - $invoice_information->i_payment + $invoice_information->i_shipping_cost ?>
                        </th>


                    </tr>

                    <?php if ($invoice_information->i_payment != 0) { ?>
                        <tr>
                            <th width="60%"> </th>

                            <th width="20%">
                                Advance
                            </th>
                            <th width="20%">
                                <?= $invoice_information->i_payment; ?>
                            </th>


                        </tr>
                    <?php } ?>

                    <tr>
                        <th width="60%"> </th>

                        <th width="20%">
                            Due Payment:
                        </th>
                        <th width="20%">
                            <?= $invoice_information->i_totalcost - $invoice_information->i_payment + $invoice_information->i_shipping_cost ?>
                        </th>


                    </tr>

                </thead>
            </table>









    <?php }
    } else {
    }
    ?>






    <!-- /.content -->

    <!-- ./wrapper -->
</body>


</html>