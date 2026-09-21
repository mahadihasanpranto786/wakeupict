<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Product List
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Product</a></li>
            <li class="active">Product List</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">

        <div class="box">
            <div class="box-header">
                <div class="row">
                    <form id="cat_main" method="POST" action="<?php echo base_url('backend/Report/genarate_order_report') ?>">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">From</label>
                                <input type="date" name="f_date" class="form-control" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">To</label>
                                <input type="date" name="t_date" class="form-control" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <select name="requst_type" class="form-control">
                                    <option value="">ALL</option>
                                    <option value="3">Processing</option>
                                    <option value="6">Confirm</option>
                                    <option value="5">Shipped</option>
                                    <option value="1">Completed</option>
                                    <option value="2">Cancel</option>
                                </select>
                            </div>



                        </div>

                        <div class="col-md-3">
                            <button id="submit_button" type="submit" class="btn btn-primary a_x">Search</button>
                        </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th class="text-center">Customer Information</th>
                            <th>Quantity</th>
                            <th>Total Cost</th>
                            <th>Profit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_income = 0;
                        if ($report_data) {
                            $Serial = 1;
                            foreach ($report_data->result() as $row) {
                        ?>
                                <tr>
                                    <td><?= $Serial++ ?></td>
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
                                    <td> <?php
                                            $total_quantity = 0;
                                            $order_list = $this->Common->get_data_multi_conditional('oder_products', ['invoice_id' => $row->i_id]);
                                            if ($order_list) {
                                                foreach ($order_list->result() as $key => $order) {
                                                    $total_quantity += $order->p_quantity;
                                                }
                                            }
                                            echo $total_quantity;
                                            ?>
                                    </td>
                                    <td><?= $row->i_totalcost; ?></td>
                                    <td><?= $row->i_total_profit; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                                            View </a>
                                        <?php if ($sub_nav == 'process_order') { ?>
                                            <a href="<?php echo base_url(); ?>confirm_invoice/<?= $row->i_id ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                complete </a>

                                            <a onclick="return confirm('Are you sure you want to Cancel this Item?');" href="<?php echo base_url(); ?>backend/Order/cancel_invoice/<?= $row->i_id ?>"><i class="fa fa-trash" aria-hidden="true"></i>
                                                cancel</a>
                                        <?php

                                        } ?>
                                    </td>
                                </tr>

                        <?php

                                $total_income += $row->i_total_profit;
                            }
                        } else {
                        }
                        ?>

                    </tbody>

                </table>

                <div class="callout callout-info">
                    <h4>Your Total Income: <?= $total_income; ?></h4>


                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>
<!-- /.content-wrapper -->

<style>
    .a_x {

        margin-top: 24px;

    }
</style>