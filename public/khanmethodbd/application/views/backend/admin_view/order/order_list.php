<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <?php if ($sub_nav == 'process_order') { ?>
                Pending Order
            <?php } else if ($sub_nav == 'confirm_order') { ?>
                Confirm Order
            <?php } else if ($sub_nav == 'shipped_order') { ?>
                Pending Order
            <?php } else if ($sub_nav == 'complete_order') { ?>
                Complete Order
            <?php } else if ($sub_nav == 'cancle_order') { ?>
                Cancel Order
            <?php } ?>
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
                            <th>Status</th>
                            <th>Actions</th>
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

                                                <img src="<?php echo base_url(); ?>assets/products/<?= $pro->p_imagepath ?>" class="user-image" alt="Product_Image" width="50" height="50">
                                        <?php
                                            }
                                        } else {
                                        }
                                        ?>

                                    </td>
                                    <td><?= date("d-m-Y", strtotime($row->i_createdat)); ?></td>
                                    <td> <?= $row->i_name; ?><br>
                                        <?= $row->i_mobile; ?><br>
                                        <?= $row->i_address; ?><br>
                                        <?= $row->i_thana; ?><br>
                                        <?= $row->i_district; ?>
                                    </td>
                                    <td><?= $row->i_totalcost; ?> + <?= $row->i_shipping_cost; ?></td>
                                    <td><?= $row->i_type == 1 ? 'Frontend' : 'Backend' ?></td>
                                    <td>
                                        <?php if ($sub_nav == 'process_order') { ?>
                                            <a href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice</a>
                                            <a href="<?php echo base_url(); ?>invoice_confirm/<?= $row->i_id ?>"><i class="fa fa-check-circle" aria-hidden="true"></i>Confirm </a>

                                            <a onclick="return confirm('Are you sure you want to Cancel this Item?');" href="<?php echo base_url(); ?>backend/Order/cancel_invoice/<?= $row->i_id ?>"><i class="fa fa-trash" aria-hidden="true"></i>cancel</a>
                                        <?php } ?>

                                        <?php if ($sub_nav == 'confirm_order') { ?>
                                            <a href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice</a>

                                            <a href="<?php echo base_url(); ?>confirm_shipped/<?= $row->i_id ?>"><i class="fa fa-check-circle" aria-hidden="true"></i> Shipped</a>

                                            <a onclick="return confirm('Are you sure you want to Cancel this Item?');" href="<?php echo base_url(); ?>backend/Order/cancel_invoice/<?= $row->i_id ?>"><i class="fa fa-trash" aria-hidden="true"></i> cancel</a>
                                        <?php } ?>

                                        <?php if ($sub_nav == 'shipped_order') { ?>
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice</a>

                                            <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>complete_invoice/<?= $row->i_id ?>"><i class="fa fa-check-circle" aria-hidden="true"></i> complete </a>

                                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to Cancel this Item?');" href="<?php echo base_url(); ?>backend/Order/cancel_invoice/<?= $row->i_id ?>"><i class="fa fa-trash" aria-hidden="true"></i> cancel</a>
                                        <?php } ?>

                                        <?php if ($sub_nav == 'complete_order') { ?>

                                            <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice</a>

                                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to Cancel this Item?');" href="<?php echo base_url(); ?>backend/Order/cancel_invoice/<?= $row->i_id ?>"><i class="fa fa-trash" aria-hidden="true"></i> cancel</a>
                                        <?php } ?>

                                        <?php if ($sub_nav == 'cancle_order') { ?>
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice</a>
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