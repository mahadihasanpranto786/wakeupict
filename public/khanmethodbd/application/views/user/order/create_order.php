<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Order
            <small>Order Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Order</a></li>
            <li class="active">Create Order</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <?= alert_check() ?>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>


                                <th>Price Info</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($products_list) {
                                $Serial = 1;
                                foreach ($products_list->result() as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $row->p_tittle; ?><br>

                                            <img src="<?php echo base_url(); ?>assets/products/<?= $row->p_imagepath ?>" alt="Girl in a jacket" width="128" height="128">
                                        </td>
                                        <td>Purchased: <?= $row->p_pprice; ?><br>
                                            Selling: <?= $row->p_sprice; ?><br>
                                            Quantity: <?= $row->p_quantity; ?>
                                        </td>


                                        <td>
                                            <button id="<?= $row->p_id ?>" class="btn btn-primary add_to_cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
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
        </div>

        <div class="col-md-6">
            <!-- general form elements -->
            <div id="color_change" class="box box-primary">
                <div class="box-header with-border">
                    <h3 id="content_title" class="box-title">Card List</h3>
                    <a href="<?php echo base_url(); ?>reset_cart"  class="btn btn-danger pull-right"><i class="fa fa-print"></i> Reset Cart</a>
                </div>
                <!-- /.box-header -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Product</th>


                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>

                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="show_card_data">


                    </tbody>
                </table>

                <form method="POST" action="<?php echo base_url('backend/Order/genarate_invoice') ?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="i_name" class="form-control" placeholder="Enter Customer Name">
                                </div>

                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" name="i_mobile" class="form-control" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input value="0" data-validation="number" data-validation-allowing="range[0;100000]" type="text" name="i_discount" class="form-control" placeholder="Enter Discount">
                                </div>

                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Advance</label>
                                    <input value="0" data-validation="number" data-validation-allowing="range[0;100000]" type="text" name="i_payment" class="form-control" placeholder="Advance">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Shipping Cost</label>
                                    <input value="0" data-validation="number" data-validation-allowing="range[0;100000]" type="text" name="i_shipping_cost" class="form-control" placeholder="Advance">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <Address>Shipping <Address></Address>
                            </Address>
                            <textarea name="i_address" class="" placeholder="Place some text here" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button id="submit_button" type="submit" class="btn btn-primary">Genarate Invoice</button>
                    </div>
                </form>

            </div>
            <!-- /.box -->
        </div>

        <!-- /.box -->
    </section>
    <div class="clearfix"></div>
</div>
<!-- /.content-wrapper -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {



        var addtocard = "";
        var current = 0;
        var total_amount = "";
        showcard();

        function showcard() {
            var dami = 'Nothing';
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('Ajax_play/show_card') ?>",
                data: 'dami=' + dami,
                success: function(html) {
                    $('.show_card_data').html(html);
                    var dami = 'Nothing';
                    $(".card_remove").click(function() {
                        var card_remove_id = this.id;
                        if (card_remove_id) {
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo base_url('Ajax_play/ajaxCardRemove') ?>",
                                data: 'card_remove_id=' + card_remove_id,
                                success: function(html) {

                                    showcard();

                                }

                            });
                        }

                    });



                    $(".quantity_change").bind('change', function() {
                        var current_quantity = $(this).val();
                        var active_id = this.id;
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo base_url('Ajax_play/ajaxModifyQuantity') ?>",
                            data: {
                                current_quantity: current_quantity,
                                active_id: active_id
                            },
                            success: function(html) {

                                showcard();

                            }

                        });

                    });

                }
            });


        }












        $(".add_to_cart").click(function() {
            var id = this.id;
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('Ajax_play/add_to_card') ?>",
                data: 'id=' + id,
                success: function(resp) {
                    showcard();
                }
            });
        });






    });
</script>