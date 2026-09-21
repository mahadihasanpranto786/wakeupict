<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_play extends CI_Controller
{

    public function ajaxGetCatInformation()
    {
        $table = "categories";
        $index = "c_id";
        $identifier = $this->input->post('id');
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        $response = json_encode($response);
        print_r($response);
    }


    public function add_to_card()
    {
        $table = "poducts";
        $index = "p_id";
        $identifier = $this->input->post('id');
        $response = $this->Common->get_single_row_information($table, $index, $identifier);

        if ($response->p_quantity > 0) {
            $data = array(
                'id'      => $response->p_id,
                'qty'     => 1,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle

            );
            $this->cart->insert($data);
            echo $a = 1;
        } else {
            echo $a = 2;
        }
    }



    public function show_card()
    {
        $total = 0;
        $items = 0;
        $cardData = $this->cart->contents();
        $serial = 1;
        foreach ($cardData as $card) {
?>
            <tr>
                <td><?= $serial++; ?></td>
                <td><?= $card['name']; ?></td>
                <td><?= $card['price']; ?>
                <td><input type="text" id="<?= $card['rowid']; ?>" class="form-control quantity_change" value="<?= $card['qty']; ?>">
                    <br>
                </td>
                <td><?= $card['price'] * $card['qty']; ?>
                <td><button type="button" id="<?= $card['rowid']; ?>" class="card_remove btn btn-danger btn-sm">Remove</button></td>
            </tr>
        <?php
            $total += $card['price'] * $card['qty'];
            $items++;
        }
        ?>

        <tr>
            <td></td>
            <td></td>
            <td></td>

            <td>Total Cost:</td>
            <td><?= $total ?></td>
            <td></td>
        </tr>

        <?php

    }

    public function ajaxCardRemove()
    {
        $information = $this->input->post('card_remove_id');
        $this->cart->remove($information);
    }

    public function ajaxModifyQuantity()
    {
        $current_quantity = $this->input->post('current_quantity');
        $active_id = $this->input->post('active_id');
        $data = array(
            'rowid'  => $active_id,
            'qty'    => $current_quantity
        );

        $this->cart->update($data);
    }


    public function show()
    {
        $cardData = $this->cart->contents();
        //$cardData = $this->cart->total_items();
        echo "<pre>";
        print_r($cardData);
    }

    public function reset_cart()
    {
        $this->cart->destroy();
        redirect('create_order', 'location');
    }

    /*version 2*/
    public function get_product_name()
    {
        $information = $this->input->post('product_keyword');
        //$information = 'Shampoo';
        $procedureInformation = $this->Common->getProductList($information);
        if ($procedureInformation) {
            foreach ($procedureInformation->result() as $procedure_name) { ?>
                <li class='catch_test ajax__searched__item' id="<?= $procedure_name->p_id ?>"><a href="<?php echo base_url(); ?>product/details/<?= $procedure_name->p_id ?>"><?= $procedure_name->p_tittle ?></a></li>
        <?php   }
        }
    }

    public function add_to_card_fontend()
    {
        $identifier = $this->input->post('id');
        $table = "poducts";
        $index = "p_id";
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        if ($response->p_quantity > 0) {

            $data = array(
                'id'      => $response->p_id,
                'qty'     => 1,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle

            );
            $this->cart->insert($data);
            echo $a = 1;
        } else {
            echo $a = 2;
        }
    }

    public function details_add_to_card_fontend()
    {
        $identifier = $this->input->post('id');
        $qty = $this->input->post('qty');
        $table = "poducts";
        $index = "p_id";
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        if ($response->p_quantity > $qty) {

            $data = array(
                'id'      => $response->p_id,
                'qty'     => $qty,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle

            );
            $this->cart->insert($data);
            echo $a = 1;
        } else {
            echo $a = 2;
        }
    }

    public function details_add_to_card_plus_fontend()
    {
        $identifier = $this->input->post('id');
        $table = "poducts";
        $index = "p_id";
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        if ($response->p_quantity > 0) {
            $data = array(
                'id'      => $response->p_id,
                'qty'     => 1,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle

            );
            $this->cart->insert($data);
            echo $a = 1;
        } else {
            echo $a = 2;
        }
    }

    public function details_add_to_card_minus_fontend()
    {
        $identifier = $this->input->post('id');
        $table = "poducts";
        $index = "p_id";
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        if ($response->p_quantity > 0) {
            $data = array(
                'id'      => $response->p_id,
                'qty'     => -1,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle

            );
            $this->cart->insert($data);
            echo $a = 1;
        } else {
            echo $a = 2;
        }
    }

    public function increase_card_fontend()
    {
        $identifier = $this->input->post('id');
        $qty = $this->input->post('qty');

        $table = "poducts";
        $index = "p_id";
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        if ($response->p_quantity > $qty) {
            $data = array(
                'id'      => $response->p_id,
                'qty'     => 1,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle
            );
            $this->cart->insert($data);
            echo $a = 1;
        } else {
            echo $a = 2;
        }
    }
    public function decrease_card_fontend()
    {
        $identifier = $this->input->post('id');
        $qty = $this->input->post('qty');
        if ($qty == 1) {
            echo 3;
        } else {
            $table = "poducts";
            $index = "p_id";
            $response = $this->Common->get_single_row_information($table, $index, $identifier);
            if ($response->p_quantity >= $qty) {
                $data = array(
                    'id'      => $response->p_id,
                    'qty'     => -1,
                    'price'   => $response->p_sprice,
                    'pp_price'   => $response->p_pprice,
                    'name'    => $response->p_tittle

                );
                $this->cart->insert($data);
                echo $a = 1;
            } else {
                echo $a = 2;
            }
        }
    }


    public function input_qty_card_fontend()
    {
        $identifier = $this->input->post('id');
        $qty = $this->input->post('qty');
        $information = $this->input->post('rowid');
        $this->cart->remove($information);
        $table = "poducts";
        $index = "p_id";
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        if ($response->p_quantity > $qty) {



            $data = array(
                'id'      => $response->p_id,
                'qty'     => $qty,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle

            );
            $this->cart->insert($data);
            echo $a = 1;
        } else {
            echo $a = 2;
        }
    }

    public function total_card_item()
    {
        echo $this->cart->total_items();
    }
    public function total_card()
    {
        echo $this->cart->total();
    }
    public function my_card()
    {
        ?>

        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
            <div class="mini-cart" style="overflow: hidden; width: auto; height: 250px;">
                <?php
                $total = 0;
                $items = 0;
                $cardData = $this->cart->contents();
                foreach ($cardData as $card) {
                    $image = $this->Common->get_single_row_information('poducts', 'p_id', $card['id'])->p_imagepath;
                ?>
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-image">
                            <img src="<?php echo base_url(); ?>assets/products/<?= $image ?>">
                        </div>

                        <div class="mini-cart-details clearfix">
                            <a class="product-name" href="#">
                                <?= $card['name']; ?>
                            </a>

                            <span class="product-price pull-right">
                                BDT&nbsp;<?= $card['price']; ?>
                            </span>
                            <span class="product-quantity pull-right">
                                <?= $card['qty'] * $this->cart->total() ?>
                            </span>
                            <button type="button" class="btn-close card_remove" id="<?= $card['rowid']; ?>">
                                ×
                            </button>
                        </div>
                    </div>
                <?php
                    $total += $card['price'] * $card['qty'];
                    $items++;
                }

                ?>
            </div>
            <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 250px;"></div>
            <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
        </div>
        <span class="subtotal">
            Subtotal: <span>BDT&nbsp; <?= $total ?></span>
        </span>
        <div class="mini-cart-buttons text-center">
            <a href="<?php echo base_url(); ?>checkout " class="btn btn-primary btn-view-cart">
                View Cart
            </a>
            <a href="<?php echo base_url(); ?>fontend/Order/checkout " class="btn btn-default btn-checkout">
                Checkout
            </a>
        </div>
        <?php

    }
    public function cart_list()
    {

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
                                    <input type="text" name="qty" value="<?= $card['qty']; ?>" class="input-number input-quantity pull-left qty-0 qty" min="1" max="" id="qty">
                                    <span class="pull-left btn-wrapper">
                                        <button type="button" class="btn btn-number btn-plus cart_increase" data-type="plus"> + </button>
                                        <button type="button" class="btn btn-number btn-minus cart_decrease" data-type="minus"> – </button>
                                    </span>
                                </div>
                            </div>
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
    }
}
