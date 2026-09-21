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
            Product Report
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
                    <form id="cat_main" method="get" action="<?php echo base_url('backend/Report/genarate_product_report') ?>">

                        <div class="col-md-3">



                            <div class="form-group">
                                <label>Product </label>
                                <select name="product_id" class="form-control select2" style="width: 100%;">
                                    <option selected disabled value="">Select product</option>
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
                                <input type="date" name="f_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">To</label>
                                <input type="date" name="t_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
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
                            <th>Product Quantity</th>
                            <th>Product Status</th>
                            <th>Total cost</th>
                            <th>Profit</th>

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
                                    <td><?= $row->invoice_id + 1000; ?>
                                    </td>
                                    <td>
                                        <?= $row->o_createdat; ?>

                                    </td>
                                    <td>
                                        <?= $row->p_quantity; ?>

                                    </td>
                                    <td>
                                        <?php
                                        if ($row->o_status == 0) {
                                            echo "Processing";
                                        } else if ($row->o_status == 1) {
                                            echo "Complete";
                                        } else if ($row->o_status == 2) {
                                            echo "Cancel";
                                        } else if ($row->o_status == 5) {
                                            echo "Shipped";
                                        } else if ($row->o_status == 6) {
                                            echo "Confirm";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row->p_sprice * $row->p_quantity; ?></td>
                                    <td><?= ($row->p_sprice - $row->p_pprice) * $row->p_quantity; ?></td>

                                </tr>

                            <?php


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