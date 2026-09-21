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

    <section class="content-header">
        <h1>
            Order Report
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
                    <form id="cat_main" method="get" action="<?php echo base_url('backend/Report/genarate_order_report') ?>">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">From</label>
                                <input type="date" name="f_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">To</label>
                                <input type="date" name="t_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <select name="requst_type" class="form-control">
                                    <option value="">ALL</option>
                                    <option value="5">Order</option>
                                    <option value="1">Completed</option>
                                    <option value="2">Cancel</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button id="submit_button" type="submit" class="btn btn-primary a_x">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped">
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
                            $serial;
                            foreach ($report_data->result() as $row) {
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
                <input type="hidden" id="valRes" value="<?php if (isset($report_data->result_id->num_rows)) {
                                                            echo $report_data->result_id->num_rows;
                                                        } else {
                                                            echo 0;
                                                        } ?>">
                <div class="basic-pagination pull-right wow fadeInUp new__custom__pagination" data-wow-delay=".2s">
                    <?= $this->pagination->create_links() ?><br>
                    <span>Showing <span id="showingRow"></span> Result From <?= $total_rows ?> Result</span>
                </div>




            </div>
            <div class="callout callout-info">
                <h4>Your Total Income: <?= $total_income; ?></h4>

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
<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        var valRes = $("#valRes").val()
        $("#showingRow").text(valRes)
    })
</script>