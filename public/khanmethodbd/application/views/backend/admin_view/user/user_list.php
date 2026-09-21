<!-- Content Wrapper. Contains page content -->

<!-- Content Wrapper. Contains page content -->
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
            User
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
            <li class="active">User List</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">

        <div class="box">
            <div class="box-header">
                <form action="<?= base_url("backend/Admin/user_list") ?>" method="get" class="form-inline pull-right">
                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <div class="form-group">
                                <input type="text" name="user_name" class="form-control" placeholder="Enter user name">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <div class="form-group">
                                <input type="number" name="user_number" class="form-control" placeholder="Enter mobile number">
                            </div>
                        </div>
                        <div class=" col-md-4 col-xs-4">
                            <button type="submit" class="btn btn-dark">Search</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped datatable-button-html5-basic datatable-button-print-basic">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Total Completed Order</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        if ($user_list) {
                            $serial;
                            foreach ($user_list->result() as $row) {
                        ?>
                                <tr>
                                    <td><?= $serial++ ?></td>

                                    <td><?= $row->u_first_name ?> <?= $row->u_last_name ?></td>
                                    <td><?= $row->u_phone ?> </td>

                                    <td><?= $row->u_address ?> </td>

                                    <td>
                                        <?php
                                        $total_order_invoice = 0;
                                        $invoices =   $this->Common->get_data_multi_conditional("invoice", ["i_status" => 1, "i_mobile" => $row->u_phone]);
                                        if ($invoices) {
                                            foreach ($invoices->result() as $invoice) {
                                                $total_order_invoice += $invoice->i_status;
                                            }
                                        }
                                        echo  $total_order_invoice;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>backend/Admin/user_total_order?u_phone=<?= $row->u_phone; ?>" class="btn btn-sm btn-success p-2 mb-2 editCategoryBtn"> View</a>
                                    </td>



                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6" class="text-center text-danger">No Data Found</td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>
                </table>

                <input type="hidden" id="valRes" value="<?php if (isset($user_list->result_id->num_rows)) {
                                                            echo $user_list->result_id->num_rows;
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