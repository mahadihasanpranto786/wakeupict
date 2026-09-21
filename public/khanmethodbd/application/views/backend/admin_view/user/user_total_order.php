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
            User Completed Order List
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
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped datatable-button-html5-basic datatable-button-print-basic">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Invoice Id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($invoices) {
                            $serial = 1;
                            foreach ($invoices->result() as $row) {
                        ?>
                                <tr>
                                    <td><?= $serial++ ?></td>
                                    <td><?= $row->i_id + 1000 ?></td>
                                    <td><?= $row->i_name ?></td>
                                    <td><?= $row->i_mobile ?> </td>
                                    <td><?= date("d-m-Y", strtotime($row->i_createdat)); ?> </td>
                                    <td> <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i> View Invoice </a></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8" class="text-center text-danger">No Data Found</td>
                            </tr>
                        <?php }
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

<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        var valRes = $("#valRes").val()
        $("#showingRow").text(valRes)
    })
</script>