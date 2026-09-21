<div class="content-wrapper clearfix cart-page">
    <div class="container">
        <div class="row">
            <div class="cart-list-wrapper clearfix">
                <div class="col-md-8">
                    <div class="box-wrapper clearfix">
                        <div class="box-header">
                            <h4>Cart</h4>
                        </div>
                        <div class="cart-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody class="cart-data">
                                        <?php
                                        if ($this->cart->contents()) {

                                            $total = 0;
                                            $items = 0;
                                            $cardData = $this->cart->contents();
                                            foreach ($cardData as $card) {
                                                $image = get_rltn_data('poducts', 'p_id', $card['id'])->p_imagepath;
                                        ?>
                                                <tr class="cart-item">
                                                    <td>
                                                        <div class="image-holder">
                                                            <img src="<?php echo base_url(); ?>assets/products/<?= $image ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            <a href="#"><?= $card['name']; ?></a>
                                                        </h5>
                                                        <div class="option">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label>Price:</label>
                                                        <span>BDT&nbsp;<?= $card['price']; ?></span>
                                                    </td>
                                                    <td class="clearfix">
                                                        <form method="POST" id="cart_update">
                                                            <div class="quantity pull-left clearfix">
                                                                <div class="input-group-quantity pull-left clearfix">
                                                                    <input type="hidden" value="<?= $card['id']; ?>" class="card_increase_id" min="1" max="" id="">
                                                                    <input type="hidden" value="<?= $card['rowid']; ?>" class="card_increase_rowid" min="1" max="" id="">
                                                                    <input type="text" name="qty" value="<?= $card['qty']; ?>" class="input-number input-quantity pull-left qty_details" id="qty" min="1" max="">
                                                                    <span class="pull-left btn-wrapper">
                                                                        <button p_id="<?= $card['id']; ?>" type="button" class="btn btn-number btn-plus" data-type="plus"> + </button>
                                                                        <button p_id="<?= $card['id']; ?>" type="button" class="btn btn-number btn-minus" data-type="minus"> &#8211; </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <label>Total:</label>
                                                        <span class="sub_total">BDT&nbsp;<?php echo $card['qty'] * $card['price'] ?> </span>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn-update" title="Update">
                                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                                        </button>

                                                        <button onclick="return confirm('Are you sure want to delete this product from your cart?')" type="button" class="btn-close card_remove_cart_list" id="<?= $card['rowid']; ?>">
                                                            ×
                                                        </button>
                                                        </form>
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
                        <span class="total ">
                            Total
                            <span class="cart-total1">BDT&nbsp; <?= $this->cart->total() ?></span>
                        </span>

                        <a href="<?php echo base_url(); ?>checkout" class="btn btn-primary btn-checkout pull-right" data-loading="">
                            Checkout
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
        </div>
    </div>
</div>