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
                <!-- <a href="<?php //echo base_url(); ?>print_all/<?= $status ?>" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print Invoice</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
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
                                
                            </td>
                            <td>
                                <?= $row->i_createdat; ?>
                            </td>
                            
                            <td>
                                <a href="<?php echo base_url(); ?>vendor/invoice_view/<?= $row->i_id ?>"><i class="fa fa-eye" aria-hidden="true"></i>
                                View </a>                                
                            </td>
                        </tr>
                        <?php }
                        } else { }
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