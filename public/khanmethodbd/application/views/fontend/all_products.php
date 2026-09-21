<?php
if ($recent_product) {
    foreach ($recent_product->result() as $row) { ?>

        <div class="product-card">
            <div class="product-card-inner">
                <a href="<?php echo base_url(); ?>product/details/<?= $row->p_id ?>">
                    <div class="product-image clearfix">
                        <ul class="product-ribbon list-inline">
                            <li>
                                <?php if ($row->p_quantity > 0) {
                                } else { ?>
                                    <span class="ribbon bg-red">Out of Stock </span>
                                <?php } ?>
                            </li>

                        </ul>
                        <div class="image-holder">
                            <img src="<?php echo base_url(); ?>assets/products/<?= $row->p_imagepath ?>">
                        </div>

                    </div>
                    <div class="product-content clearfix">
                        <span class="product-price"> BDT <?= $row->p_sprice ?></span>
                        <span class="product-name"><?= $row->p_tittle ?></span>
                    </div>
                </a>
                <div class="add-to-actions-wrapper">
                    <a id="<?= $row->p_id ?>" class="btn btn-default btn-add-to-cart add_to_card">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>





<?php }
} ?>