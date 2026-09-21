<?php
$general_settings = ['s_id' => 1];
$general_settings_list = get_data_single_muli_con("settings", $general_settings);
?>
<style>
    .product-grid {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.18), 0 8px 8px rgba(0, 0, 0, 0.17);
    }

    .cart-list-wrapper {
        margin-top: 0px;
    }

    .labelPadding {
        padding-bottom: 8px;
        padding-top: 8px
    }
</style>
<div class="content-wrapper clearfix ">
    <div class="container">
        <section class="checkout">
            <form method="POST" class="form-group" action="<?php echo base_url(); ?>fontend/Order/order_store" id="checkout-form">
                <div class="row">
                    <div class="col-md-8">
                        <div class="cart-list-wrapper  border border-info clearfix">
                            <div class="box-wrapper product-grid clearfix">
                                <div class="box-header">
                                    <h4>Cart
                                        <a href="<?= base_url() ?>" type="submit" class="btn btn-info pull-right" style="margin:-9px">Add More Book</a>
                                    </h4>
                                </div>
                                <div class="cart-list ">
                                    <div class="table-responsive ">
                                        <table class="table">
                                            <tbody class="cart-data ">
                                                <?php
                                                if ($this->cart->contents()) {

                                                    $total = 0;
                                                    $total_qnt = 0;
                                                    $items = 0;
                                                    $cardData = $this->cart->contents();
                                                    foreach ($cardData as $card) {
                                                        $image = get_rltn_data('poducts', 'p_id', $card['id'])->p_imagepath;
                                                        $total_qnt += $card['qty']
                                                ?>
                                                        <tr class="cart-item product-grid ">
                                                            <td>
                                                                <div class="image-holder">
                                                                    <a href="<?php echo base_url(); ?>product/details/<?= $card['id'] ?>">
                                                                        <img src="<?php echo base_url(); ?>assets/products/<?= $image ?>"></a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h5>
                                                                    <a href="<?php echo base_url(); ?>product/details/<?= $card['id'] ?>"><?= $card['name']; ?></a>
                                                                </h5>
                                                                <div class="option">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <label>Price:</label>
                                                                <span>BDT&nbsp;<?= $card['price']; ?></span>
                                                            </td>
                                                            <td class="clearfix">

                                                            </td>
                                                            <td>
                                                                <input type="button" value="-" data-qty="<?= $card['qty']; ?>" data-product_id="<?= $card['id']; ?>" style="width: 30px; height:33px !important" class="button-minus border rounded-circle  icon-shape icon-sm mx-1 cart_decrease" data-field="input_quantity<?= $card['id']; ?>">
                                                                <input type="text" value="<?= $card['qty']; ?>" readonly name="input_quantity<?= $card['id']; ?>" style="width: 68px; height:33px !important" class="quantity-field border-0  cart_single_item text-center" id="input_val<?= $card['id']; ?>">
                                                                <input type="button" value="+" data-qty="<?= $card['qty']; ?>" data-product_id="<?= $card['id']; ?>" style="width: 30px; height:33px !important" class="button-plus border rounded-circle icon-shape icon-sm cart_increase" data-field="input_quantity<?= $card['id']; ?>">

                                                            </td>
                                                            <td>
                                                                <!-- <button type="submit" class="btn-update" title="Update">
                                                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                                                </button> -->

                                                                <button type="button" class="btn-close card_remove_cart" id="<?= $card['rowid']; ?>">
                                                                    ×
                                                                </button>
                                                            </td>
                                                        </tr>

                                                    <?php
                                                        $total += $card['price'] * $card['qty'];
                                                        $items++;
                                                    }
                                                } else { ?>
                                                    <tr>
                                                        <td>cart empty</td>
                                                    </tr>
                                                <?php
                                                }

                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="checkout-sidebar product-grid  order-review">
                            <div class="cart-total">
                                <h3>Cart Totals</h3>
                                <span class="item-amount">
                                    Subtotal
                                    <span class="cart-total1">BDT&nbsp;<?php echo $this->cart->total() ?></span>
                                </span>
                                <span class="item-amount">
                                    <input type="hidden" name="i_shipping_cost" class="shipping-method" value="<?= $general_settings_list->s_shipping_method1 ?>" id="free_shipping" checked="checked">
                                    Shipping Cost
                                    <span class="pull-right">BDT&nbsp;<?= $general_settings_list->s_shipping_method1 ?></span>
                                </span>
                                <span class="item-amount">
                                    Total Cost
                                    <span class="cart-total1">BDT&nbsp;<?php echo (int)$this->cart->total() + (int)$general_settings_list->s_shipping_method1 ?></span>
                                </span>
                                <div id="taxes">
                                </div>
                                <span class="total">
                                    <!-- Total
                                    <span id="total-amount">BDT&nbsp;<?php //echo $this->cart->total()+
                                                                        ?></span> -->
                                </span>
                                <div id="stripe-payment" class="StripeElement StripeElement--empty">
                                    <div class="__PrivateStripeElement" style="margin: 0px !important; padding: 0px !important; border: medium none !important; display: block !important; background: transparent none repeat scroll 0% 0% !important; position: relative !important; opacity: 1 !important;"><iframe allowtransparency="true" scrolling="no" name="__privateStripeFrame5" allowpaymentrequest="true" src="Checkout%20-%20eDokani_files/elements-inner-card-3884a9170a3c653e70afef33e6585584.htm" title="Secure payment input frame" style="border: medium none !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; height: 18px;" frameborder="0"></iframe><input class="__PrivateStripeElement-input" aria-hidden="true" aria-label=" " autocomplete="false" maxlength="1" style="border: medium none !important; display: block !important; position: absolute !important; height: 1px !important; top: 0px !important; left: 0px !important; padding: 0px !important; margin: 0px !important; width: 100% !important; opacity: 0 !important; background: transparent none repeat scroll 0% 0% !important; pointer-events: none !important; font-size: 16px !important;"></div>
                                </div>

                                <div class="checkout-terms checkbox text-center">
                                    <input type="checkbox" name="" id="terms-and-conditions" class="checked" checked="checked">

                                </div>

                            </div>
                        </div>
                        <div class="panel product-grid  border border-info  panel-default">
                            <div class="panel-body">
                                <h2 class="text-center">Customer Information</h2>
                                <div class="form-group">
                                    <label for="f_name" class="labelPadding">Name</label>
                                    <input type="text" class="form-control" name="f_name" id="f_name" placeholder="Enter your name." required>
                                </div>
                                <div class="form-group">
                                    <label for="tel" class="labelPadding">Phone</label>
                                    <input type="tel" name="phone" class="form-control btn-number" placeholder="Enter Your Contact Number." required>
                                    <samp class="text-danger" id="number"></samp>
                                </div>
                                <div class="form-group">
                                    <label for="i_address" class="labelPadding">Shipping Address</label>
                                    <textarea type="address" class="form-control" name="i_address" id="i_address" placeholder="Locality/House/Street no." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="i_thana" class="labelPadding">Thana</label>
                                    <input type="text" class="form-control" name="i_thana" id="i_thana" placeholder="Enter your thana." required>
                                </div>
                                <div class="form-group">
                                    <label for="i_district" class="labelPadding">District Name</label>
                                    <input type="text" class="form-control" name="i_district" id="i_district" placeholder="Enter your district name" required>
                                </div>
                                <button type="submit" <?= empty($total_qnt) ? "disabled" : "" ?> id="inputID" class="btn btn_hide  btn-warning  btn-center btn-block btn-outline-info btn-checkout ">
                                    Place Order
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </section>
    </div>
</div>

<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        $(".btnClickFile").click(function() {
            $('#fileModal').modal('show');
        })
    })
</script>


<script>
    $(document).ready(function() {

        $(".btn-number").on('keyup change paste keypress', function(e) {
            var number = $(this).val().length;
            if (number > 11) {
                $(this).val("")
                $("#number").text("Number must be 11 digit")
            } else {
                $("#number").text("")
                $("#inputID").prop('disabled', true);
            }
            if (number == 11) {
                $("#inputID").prop('disabled', false);
            }
            if ($(this).val() == "00") {
                $(this).val("")
            }

        })
        $(".btn-number").focusout(function() {
            myText = $(this).val();
            myText.replace(/ /g, '');
            var number = $(this).val().length;
            if (number <= 10) {
                $(this).val("")
                $("#number").text("Number must be 11 digit")
            } else {
                $("#number").text("")
            }
            if (number == "") {
                $("#number").text("")
            }
        });
        // Remove White  Space
        $(".btn-number").on('keyup change paste keypress', function(e) {
            var data, i;
            data = document.querySelectorAll(".btn-number"); //HTML DOM querySelector() Method
            for (i = 0; i < data.length; i++) {
                data[i].value = data[i].value.replace(/[^0-9.]/g, '').replace(/(\.*)\./g, '$1');
            }
        });
        $(".btn-number").on('drop', function(e) {
            $(this).prop("readonly", true)
        });
        $(".btn-number").on('click, keyup', function(e) {
            $(this).prop("readonly", false)
        });


        $(".cart_increase").click(function() {
            var qty = $(this).data("qty");
            var id = $(this).data("product_id");
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('Ajax_play/increase_card_fontend') ?>",
                data: {
                    id: id,
                    qty: qty
                },
                success: function(data) {
                    if (data == 1) {
                        setTimeout(function() {
                            location.reload()
                        })
                    } else {
                        swal({
                            title: "",
                            text: "Insuficent quantity of product",
                            icon: "error",
                        });
                    }
                }
            });
        });
        $(".cart_decrease").click(function() {
            var qty = $(this).data("qty");
            var id = $(this).data("product_id");
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('Ajax_play/decrease_card_fontend') ?>",
                data: {
                    id: id,
                    qty: qty
                },
                success: function(data) {
                    if (data == 1) {
                        setTimeout(function() {
                            location.reload()
                        })
                    } else if (data == 3) {
                        swal({
                            title: "Opps..",
                            text: "Product Quantity Minimum One",
                            icon: "error",
                        });
                    } else {
                        swal({
                            title: "",
                            text: "Insuficent quantity of product",
                            icon: "error",
                        });
                    }
                }
            });

        });
        $(".card_remove_cart").click(function() {
            var x = confirm("Are you sure you want to delete?!");
            if (x) {
                var card_remove_id = $(this).attr("id");
                if (card_remove_id) {
                    $.ajax({
                        type: 'POST',
                        url: "<?= base_url('Ajax_play/ajaxCardRemove') ?>",
                        data: 'card_remove_id=' + card_remove_id,
                        success: function(html) {
                            setTimeout(function() {
                                location.reload()
                            })

                        }

                    });
                }
            }

        });
    })
</script>