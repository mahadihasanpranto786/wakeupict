<!-- Main content -->
<div class="content-wrapper">
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> <?= $company_name; ?>
                    <small class="pull-right">Date: <?= $invoice_information->i_createdat; ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong><?= $company_name; ?></strong><br>
                    <?= $company_address; ?>

                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong><?= $invoice_information->i_name; ?></strong><br>
                    <?= $invoice_information->i_address; ?><br>

                    Phone: <?= $invoice_information->i_mobile; ?><br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice: <?= $invoice_information->i_id + 1000; ?></b><br>
                <br>
                <b>Order Status:</b> <?php if ($invoice_information->i_status == 0) {
                                            echo "ON PROCESS";
                                        } elseif ($invoice_information->i_status == 1) {
                                            echo "COMPLETE";
                                        } elseif ($invoice_information->i_status == 2) {
                                            echo "CANCLE";
                                        } ?><br>
                <b>Date:</b> <?= $invoice_information->i_createdat; ?><br>
                <b>Total Cost:</b> <?= $invoice_information->i_totalcost+$invoice_information->i_shipping_cost; ?> TK
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Description</th>
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
                                    <td><?= $Serial++ ?></td>
                                    <td><?= $row->p_tittle; ?></td>
                                    <td><?= $row->p_quantity; ?></td>
                                    <td><?= $row->p_description; ?></td>
                                    <td><?= $row->p_quantity * $row->p_sprice; ?></td>
                                </tr>

                        <?php
                                $total_sum_cost +=    $row->p_quantity * $row->p_sprice;
                            }
                        } else { }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Terms of service:</p>

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    <?= $tandc; ?>
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td><?= $total_sum_cost; ?></td>
                        </tr>
                        <tr>
                            <th>Shipping cost</th>
                            <td><?= $invoice_information->i_shipping_cost; ?></td>
                        </tr>
                        <tr>
                            <th>Discount </th>
                            <td><?= $invoice_information->i_discount; ?></td>
                        </tr>

                        <tr>
                            <th>Total:</th>
                            <td><?= $invoice_information->i_totalcost+$invoice_information->i_shipping_cost; ?></td>
                        </tr>
                        <tr>
                            <th>Advance:</th>
                            <td><?= $invoice_information->i_payment; ?></td>
                        </tr>
                        <tr>
                            <th>Due Payment:</th>
                            <td><?= $invoice_information->i_totalcost - $invoice_information->i_payment+$invoice_information->i_shipping_cost ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?php echo base_url(); ?>invoice_print/<?= $invoice_information->i_id ?>" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print Invoice</a>

            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>