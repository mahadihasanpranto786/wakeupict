<?php
$general_settings = ['s_id' => 1];
$general_settings_list = get_data_single_muli_con("settings", $general_settings);
?>

<div class="content-wrapper clearfix ">
    <div class="container">
        <!-- slider and add section start -->
        <?php if ($general_settings_list->s_slider_status == 1) { ?>
            <div class="row">
                <div class="col-md-12" style="margin-top: 31px;">
                    <div class="home-slider" data-autoplay="1" data-autoplay-speed="3000" data-arrows="1">
                        <?php
                        if ($main_slider) {
                            foreach ($main_slider->result() as $row) { ?>

                                <div class="slide">
                                    <div class="slider-image" style="background-image: url(<?php echo base_url('assets/storefront/slider/' . $row->slider_image) ?>);"></div>
                                    <div class="display-table">
                                        <div class="display-table-cell">
                                            <div class="col-md-9 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                                <div class="slider-content clearfix">
                                                    <div class="display-table">
                                                        <div class="display-table-cell">
                                                            <div class="caption caption-md" data-delay="ms" data-effect="fadeInUp">
                                                                <?= $row->slider_title ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                    </div>
                </div>
            </div>
        <?php } ?>



        <section class="section-wrapper clearfix">
            <div class="recent-products">


                <h3><i class="fa fa-thumb-tack text-dark f" aria-hidden="true"></i> Recently Sold Products</h3>
                <div class="row">

                    <div class="grid-products separator">
                        <?php
                        if ($pinned_products) {
                            foreach ($pinned_products->result() as $key => $row) {
                                if ($key == 5) {
                                    break;
                                } ?>
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
                                                <span class="product-price">BDT <?= $row->p_sprice ?></span>
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
                    </div>
                </div>
        </section>

        <section class="section-wrapper clearfix">
            <div class="recent-products">
                <h3>All Products</h3>
                <hr>
                <div class="row">
                    <div class="grid-products separator" id="post-data">
                        <?php
                        $this->load->view('fontend/all_products'); ?>
                    </div>
                </div>
        </section>
        <?php
        $total_rows =  $this->Common->count_fact("poducts", "p_status", 0);
        if ($total_rows > 20) { ?>
            <div class="center-block">
                <button class="btn btn-primary center-block showMoreBtn" style="margin-top:15px">Show More...</button>
            </div>
        <?php  }
        ?>

        <section class="section-wrapper clearfix">
            <?php if (!empty($middle_banner)) { ?>
                <a href="<?= $middle_banner->ad_link ?>" class="banner banner-lg" style="background-image: url(<?php echo base_url('assets/storefront/advertisement/' . $middle_banner->ad_image) ?>);" target="_self">
                    <div class="overlay"></div>
                    <div class="display-table">
                        <div class="display-table-cell">
                            <div class="banner-content">
                                <h2><?= $middle_banner->ad_title1 ?></h2>
                                <p><?= $middle_banner->ad_title2 ?></p>
                                <span>
                                    Buy Now
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>

            <?php }
            ?>
        </section>
    </div>


</div>


<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>

<script type="text/javascript">
    var page = 1;
    $(".showMoreBtn").click(function() {
        page++;
        loadMoreData(page);
    });


    function loadMoreData(page) {
        $.ajax({
            url: '?page=' + page,
            type: "get",
            success: function(data) {
                if (data == " ") {
                    $('.showMoreBtn').text("No more records found");
                    return;
                }
                $("#post-data").append(data);
            }
        })

    }
</script>