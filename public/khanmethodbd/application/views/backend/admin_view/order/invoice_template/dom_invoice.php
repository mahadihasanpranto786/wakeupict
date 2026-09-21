<div class="content-wrapper">
    <section class="invoice">

        <!-- Main content -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <img src="<?php echo base_url(); ?>assets/products/<?= $company_logo ?>" class="user-image" alt="User Image" width="200" height="128">
                    </th>
                    <th>
                        <div class="text-right">
                            <address>
                                <strong><?= $company_name; ?></strong><br>
                                <?= $company_address; ?>

                            </address>
                        </div>

                    </th>

                </tr>

            </thead>
        </table>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <h4>Order Date: <?= date("d-m-Y", strtotime($invoice_information->i_createdat)); ?></h4>
                    </th>


                </tr>

            </thead>
        </table>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <h4>Order To: </h4>
                    </th>
                    <th>
                        <h4>Order Number: <?= $invoice_information->i_id + 1000; ?></h4>
                    </th>


                </tr>

            </thead>
        </table>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <address>
                            <strong>Customer Name: <?= $invoice_information->i_name; ?></strong><br>
                            Address: <?= $invoice_information->i_address; ?><br>

                            Phone: <?= $invoice_information->i_mobile; ?><br>
                            District: <?= $invoice_information->i_district; ?><br>
                            Thana: <?= $invoice_information->i_thana; ?>
                        </address>
                    </th>



                </tr>

            </thead>
        </table>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <h4>Payment Method</h4>
                    </th>
                    <th>
                        <h4><b>Cash On Delivery</b></h4>
                    </th>


                </tr>

            </thead>
        </table>



        <table class="table table-striped">
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
                                <img src="<?php echo base_url(); ?>assets/products/<?= $row->p_imagepath ?>" class="user-image" alt="User Image" width="50" height="50">
                            </td>
                            <td><?= $row->p_sprice; ?></td>
                            <td><?= $row->p_quantity; ?></td>
                            <td>0</td>

                            <td><?= $row->p_quantity * $row->p_sprice; ?></td>
                        </tr>

                <?php
                        $total_sum_cost +=    $row->p_quantity * $row->p_sprice;
                    }
                } else {
                }
                ?>
            </tbody>
        </table>



        <table class="table table-striped">
            <thead>


                <tr>
                    <th width="60%"> </th>

                    <th width="20%">
                        Subtotal:
                    </th>
                    <th width="20%">
                        <?= $total_sum_cost; ?>
                    </th>


                </tr>
                <tr>
                    <th width="60%"> </th>

                    <th width="20%">
                        Shipping Cost
                    </th>
                    <th width="20%">
                        <?= $invoice_information->i_shipping_cost; ?>
                    </th>


                </tr>


                <?php if ($invoice_information->i_discount != 0) { ?>
                    <tr>
                        <th width="60%"> </th>

                        <th width="20%">
                            Discount
                        </th>
                        <th width="20%">
                            <?= $invoice_information->i_discount; ?>
                        </th>


                    </tr>
                <?php } ?>



                <tr>
                    <th width="60%"> </th>

                    <th width="20%">
                        Total Cost
                    </th>
                    <th width="20%">
                        <?= $invoice_information->i_totalcost + $invoice_information->i_shipping_cost ?>
                    </th>


                </tr>

                <?php if ($invoice_information->i_payment != 0) { ?>
                    <tr>
                        <th width="60%"> </th>

                        <th width="20%">
                            Advance
                        </th>
                        <th width="20%">
                            <?= $invoice_information->i_payment; ?>
                        </th>


                    </tr>
                <?php } ?>

                <tr>
                    <th width="60%"> </th>

                    <th width="20%">
                        Due Payment:
                    </th>
                    <th width="20%">
                        <?= $invoice_information->i_totalcost - $invoice_information->i_payment + $invoice_information->i_shipping_cost ?>
                    </th>


                </tr>




            </thead>
        </table>













        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?php echo base_url(); ?>invoice_print/<?= $invoice_information->i_id ?>" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print Invoice</a>

            </div>
        </div>


        <!-- /.content -->

        <!-- ./wrapper -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>