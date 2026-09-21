<div class="container">
    <div class="breadcrumb">
        <ul class="list-inline">
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="#">Shop</a></li>
            <li class="active"><?= $product_details->p_tittle ?></li>
        </ul>
    </div>

    <div class="product-details-wrapper">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-5 col-xs-7">
                <div class="product-image">
                    <div class="base-image">
                        <a class="base-image-inner" href="<?php echo base_url(); ?>assets/products/<?= $product_details->p_imagepath ?>">
                            <img src="<?php echo base_url(); ?>assets/products/<?= $product_details->p_imagepath ?>">
                            <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                        </a>
                        <?php
                        $related_images = get_rltn_data_multi_con('poduct_images', ['poduct_images_p_id' => $product_details->p_id, 'poduct_images_status' => 1, 'poduct_images_isdeleted' => 0]);
                        if ($related_images) {
                            foreach ($related_images->result() as $row) {

                        ?>
                                <a class="base-image-inner" href="<?php echo base_url(); ?>assets/products/<?= $row->poduct_images_image ?>">
                                    <img src="<?php echo base_url(); ?>assets/products/<?= $row->poduct_images_image ?>">
                                    <span><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                </a>
                        <?php }
                        } ?>



                    </div>
                    <div class="additional-image">
                        <?php
                        $related_images = get_rltn_data_multi_con('poduct_images', ['poduct_images_p_id' => $product_details->p_id, 'poduct_images_status' => 1, 'poduct_images_isdeleted' => 0]);
                        if ($related_images) {
                            foreach ($related_images->result() as $row) {

                        ?>
                                <div class="thumb-image">
                                    <img src="<?php echo base_url(); ?>assets/products/<?= $row->poduct_images_image ?>">
                                </div>

                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                <div class="product-details">
                    <h1 class="product-name"><?= $product_details->p_tittle ?></h1>



                    <div class="clearfix"></div>
                    <span class="product-price pull-left">BDT <?= $product_details->p_sprice ?></span>
                    <div class="availability pull-left">
                        <label>Availability:</label>
                        <?php if ($product_details->p_quantity > 0) { ?>
                            <span class="in-stock">In Stock</span>

                        <?php } else { ?>
                            <span class="ribbon bg-red">Out of Stock </span>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>

                    <form method="POST" action="" class="clearfix">
                        <input type="hidden" name="_token" value="jwu6UWn1AHDGopW5kkkhvXEqgPXl1OvV8BPTYA0g">
                        <input type="hidden" name="product_id" value="<?= $product_details->p_id ?>">

                        <div class="quantity pull-left clearfix">
                            <input type="hidden" value="<?= $product_details->p_id ?>" id="qty_details_id">
                            <input type="number" value="1" min="1" name="qty" class="form-control" style="width: 85px; height:45px !important" id="qty">
                        </div>

                        <button type="button" class="add-to-cart btn btn-primary pull-left add_to_card_details">
                            Add to cart
                        </button>
                    </form>
                    <div class="clearfix"></div>
                    <div class="add-to clearfix">
                        <form method="POST" action="http://edokani.codefixit.com/wishlist">
                            <input type="hidden" name="_token" value="jwu6UWn1AHDGopW5kkkhvXEqgPXl1OvV8BPTYA0g">
                            <input type="hidden" name="product_id" value="79">

                        </form>
                    </div>

                    <?php
                    if ($product_details->p_file != 'No Files inserted') {
                    ?>
                        <button type="button" class="btn btn-info col-md-5 btnClickFile" data-toggle="modal" data-target="#fileModal">একটু পড়ুন</button>

                    <?php } ?>



                    <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">PDF File <?= $product_details->p_file; ?> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    if ($product_details->p_file == "No Files inserted") { ?>
                                        <b class='text-center text-danger'>No Data Found !</b>
                                    <?php } else { ?>
                                        <embed src="<?= base_url('assets/pdf_files/') . ($product_details->p_file); ?>" type="application/pdf" frameBorder="0" scrolling="false" height="740px" width="100%"></embed>
                                    <?php  }
                                    ?>


                                </div>
                                <div class=" modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tab product-tab clearfix">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#description">Description</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="description" class="description tab-pane fade in active">
                            <p><?= $product_details->p_description ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="landscape-products-wrapper">
        <div class="section-header">
            <h3>Related Products</h3>
        </div>
        <div class="row">
            <div class="landscape-products slick-arrow separator">
                <?php
                $related_product = get_data_muli_con_order_limit("poducts", ['p_category' => $product_details->p_category, 'p_status' => 0,], 'p_id', 3);
                if ($related_product) {

                    foreach ($related_product->result() as $row1) {
                ?>
                        <div class="col-md-4">
                            <a href="<?php echo base_url(); ?>fontend/Product/details/<?= $row1->p_id ?>" class="single-product">
                                <div class="image-holder">
                                    <img src="<?php echo base_url(); ?>assets/products/<?= $row1->p_imagepath ?>">
                                </div>

                                <div class="single-product-details">
                                    <span class="product-name"><?= $row1->p_tittle ?></span>
                                    <span class="product-price">
                                        BDT <?= $row1->p_sprice ?><span class='previous-price'></span>
                                    </span>
                                </div>
                            </a>
                        </div>
                <?php }
                } ?>

            </div>
        </div>
    </section>
</div>


<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        $(".add_to_card_details").click(function() {
            var qty = $('#qty').val();
            var id = $('#qty_details_id').val();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('Ajax_play/details_add_to_card_fontend') ?>",
                data: {
                    id: id,
                    qty: qty
                },
                success: function(data) {
                    if (data == 1) {
                        swal({
                            title: "",
                            text: "Product added to cart",
                            icon: "success",
                        });
                        setTimeout(function() {
                            window.location.href = $("#redirect_page").val()
                        }, 900)
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
    });
</script>