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
                <!-- Main content -->
                <table id="example1" class="table table-bordered table-striped">
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
                            <td><?= $Serial++ ?>
                            </td>
                            <td><?= $row->p_tittle; ?>
                                <br>
                                <img src="<?php echo base_url(); ?>assets/products/<?=$row->p_imagepath?>" class="user-image" alt="User Image" width="50" height="50">
                            </td>
                            <td><?= $row->p_sprice; ?></td>
                            <td><?= $row->p_quantity; ?></td>
                            <td>0</td>
                            
                            <td><?= $row->p_quantity * $row->p_sprice; ?></td>
                        </tr>
                        <?php
                        $total_sum_cost +=    $row->p_quantity * $row->p_sprice;
                        }
                        } else { }
                        ?>
                    </tbody>
                </table>
                <div class="row no-print">
                    <div class="col-xs-12">
                        <!-- <a href="<?php //echo base_url(); ?>vendor/invoice_print/<?= $invoice_information->i_id ?>" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print Invoice</a> -->
                    </div>
                </div>
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>
<!-- /.content-wrapper -->