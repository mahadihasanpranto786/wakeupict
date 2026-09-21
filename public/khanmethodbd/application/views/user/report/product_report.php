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
                    <form id="cat_main" method="POST" action="<?php echo base_url('backend/Report/genarate_product_report') ?>">

                        <div class="col-md-3">



                            <div class="form-group">
                                <label>Product </label>
                                <select name="product_id" class="form-control select2" style="width: 100%;">
                                    <?php
                                    if ($products_list) {
                                        $Serial = 1;
                                        foreach ($products_list->result() as $row) {
                                    ?>
                                            <option value="<?= $row->p_id; ?>"><?= $row->p_tittle; ?> </option>

                                    <?php }
                                    } else {
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">From</label>
                                <input type="date" name="f_date" class="form-control" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">To</label>
                                <input type="date" name="t_date" class="form-control" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-2">
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
                            <th>Product Status</th>
                            <th>Selling Price</th>
                            <th>Profit</th>

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
                                    <td><?= $row->invoice_id + 1000; ?>
                                    </td>
                                    <td>
                                        <?= $row->o_createdat; ?>

                                    </td>
                                    <td>
                                        <?php
                                        if ($row->o_status == 0) {
                                            echo "Processing";
                                        }
                                        if ($row->o_status == 1) {
                                            echo "Complete";
                                        }
                                        if ($row->o_status == 2) {
                                            echo "Cancel";
                                        }
                                        if ($row->o_status == 5) {
                                            echo "Shipped";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row->p_sprice; ?></td>
                                    <td><?= ($row->p_sprice - $row->p_pprice) * $row->p_quantity; ?></td>

                                </tr>

                        <?php


                            }
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

<style>
    .a_x {

        margin-top: 24px;

    }
</style>