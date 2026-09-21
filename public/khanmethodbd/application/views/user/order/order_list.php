<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Order
            <small>Order List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Order</a></li>
            <li class="active">Order List</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">

        <div class="box">
            <div class="box-header">
                <!-- <a href="<?php echo base_url(); ?>user/UserView/print_all/<?= $status ?>" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print Invoice</a> -->

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Customer Information</th>
                            <th>Total Cost</th>
                            <th>Shipping cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($invoice_list) {
                            $Serial = 1;
                            foreach ($invoice_list->result() as $row) {
                        ?>
                                <tr>
                                    <td><?= $Serial++ ?></td>
                                    <td><?= $row->i_id + 1000; ?><br>


                                        <!-- Faul client wants -->

                                        <?php
                                        $product_list = $this->Common->get_data_single_conditional('oder_products', 'invoice_id', $row->i_id);
                                        if ($product_list) {
                                            foreach ($product_list->result() as $pro) {
                                        ?>

                                                <img src="<?php echo base_url(); ?>assets/products/<?= $pro->p_imagepath ?>" class="user-image" alt="User Image" width="50" height="50">
                                        <?php
                                            }
                                        } else {
                                        }
                                        ?>

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
                                    <td><?= $row->i_totalcost; ?> </td>
                                    <td><?= $row->i_shipping_cost; ?></td>
                                    <td>




                                        <?php if ($sub_nav == 'process_order') { ?>

                                            <a href="<?php echo base_url(); ?>user/UserView/invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                View </a>










                                        <?php } ?>



                                        <?php if ($sub_nav == 'confirm_order') { ?>

                                            <a href="<?php echo base_url(); ?>user/UserView/invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                View </a>










                                        <?php } ?>





                                        <?php if ($sub_nav == 'shipped_order') { ?>

                                            <a href="<?php echo base_url(); ?>user/UserView/invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                View </a>










                                        <?php } ?>


                                        <?php if ($sub_nav == 'complete_order') { ?>

                                            <a href="<?php echo base_url(); ?>user/UserView/invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                View </a>





                                        <?php } ?>




                                        <?php if ($sub_nav == 'cancle_order') { ?>

                                            <a href="<?php echo base_url(); ?>user/UserView/invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>

                                                View </a>



                                        <?php } ?>
                                    </td>
                                </tr>

                        <?php }
                        } else {
                        }
                        ?>

                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>
<!-- /.content-wrapper -->