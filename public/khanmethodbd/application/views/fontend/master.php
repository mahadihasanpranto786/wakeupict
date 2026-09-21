<!DOCTYPE html>
<?php
$general_settings = ['s_id' => 1];
$general_settings_list = get_data_single_muli_con("settings", $general_settings);
$category = get_rltn_data_multi_con('categories', ['c_status' => 0, 'c_parent' => 0]);

$menu = get_rltn_data_multi_con('menu', ['menu_isdeleted' => 0, 'menu_status' => 1]);
$footer_category = get_rltn_data_multi_con('footer_category', ['footer_isdeleted' => 0, 'footer_status' => 1]);
?>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/products/' . $general_settings_list->s_company_logo) ?>">
    <meta name="csrf-token" content="jwu6UWn1AHDGopW5kkkhvXEqgPXl1OvV8BPTYA0g">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="<?php echo base_url('assets/storefront/themes/storefront/public/css/app8a8c.css?v=1.1.3') ?>">
    <script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/sweet_alert.js') ?>"></script>

    <!-- style Link -->
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/dist/css/style.css" />
    <!-- Load Facebook SDK for JavaScript -->
    <style>
        /* --------------------
	    => Date: 15/09/2022 
	    -------------------- */
        .ajax__searched__item__section {
            background-color: white;
            position: absolute;
            width: 30%;
            max-height: 250px;
            overflow: auto;
            z-index: 9999;
        }

        .ajax__searched__item {
            background-color: #fff;
            color: #000 !important;
        }

        .ajax__searched__item:hover {
            background-color: #e3e3e3;
        }

        .ajax__searched__item a {
            color: #000;
        }

        .ajax__searched__item a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body class="theme-navy-blue slider_with_banners ltr">
    <div class="main">
        <div class="wrapper">
            <div class="sidebar">
                <ul class="sidebar-content clearfix">
                    <?php

                    if ($category) {
                        foreach ($category->result() as $row) {


                    ?>
                            <li>
                                <a href="<?php echo base_url(); ?>product/category/<?= $row->c_id ?>"><?= $row->c_name ?></a>
                                <?php
                                $parent = get_rltn_data_multi_con('categories', ['c_parent' => $row->c_id, 'c_status' => 0]);
                                if ($parent) { ?>
                                    <ul>
                                        <?php foreach ($parent->result() as $row1) { ?>
                                            <li class="submenu">
                                                <a href="<?php echo base_url(); ?>product/category/<?= $row1->c_id ?>"><?= $row1->c_name ?></a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                <?php } ?>
                            </li>
                    <?php
                        }
                    } ?>
                    <li>
                        <a href="<?php echo base_url(); ?>blog">Blog</a>
                    </li>
                </ul>
            </div>
            <section class="header-wrapper">
                <div class="header-inner">
                    <div class="container">
                        <button class="navbar-toggle visible-sm visible-xs pull-left" type="button">
                            <span class="top-bar icon-bar"></span>
                            <span class="middle-bar icon-bar"></span>
                            <span class="bottom-bar icon-bar"></span>
                        </button>

                        <a href="<?php echo base_url(); ?>" class="website-logo pull-left">
                            <img src="<?php echo base_url('assets/products/' . $general_settings_list->s_company_logo) ?>">
                            <!-- <i class="fa fa-home fa-2x"></i> -->
                        </a>
                        <div class="user-cart pull-right">
                            <div class="dropdown">
                                <div class="user-cart-inner dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-shopping-bag pull-left" aria-hidden="true"></i>
                                    <span class="cart-count" id="cart-total_item"><?php echo $this->cart->total_items(); ?></span>
                                    <div class="cart-amount hidden-sm hidden-xs pull-left">
                                        <span class="cart-label">My Cart</span>
                                        <br>
                                        <span class="cart-price cart-total1" id="cart-total">BDT <?= $this->cart->total() ?></span>
                                    </div>
                                </div>
                                <div class="dropdown-menu">
                                    <h5 class="mini-cart-title">My Cart</h5>
                                    <!-- <div class="mini-cart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <h3 class="empty-cart">Your cart is empty</h3>
                                        </div> -->
                                    <div id="cart-content">
                                        <?php if ($this->cart->contents()) { ?>

                                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                                <div class="mini-cart" style="overflow: hidden; width: auto; height: 250px;">
                                                    <?php
                                                    $total = 0;
                                                    $items = 0;
                                                    $cardData = $this->cart->contents();
                                                    foreach ($cardData as $card) {
                                                        $image = get_rltn_data('poducts', 'p_id', $card['id'])->p_imagepath;
                                                    ?>
                                                        <div class="mini-cart-item clearfix">
                                                            <div class="mini-cart-image">
                                                                <a href="<?php echo base_url(); ?>product/details/<?= $card['id'] ?>">
                                                                    <img src="<?php echo base_url(); ?>assets/products/<?= $image ?>">
                                                                </a>
                                                            </div>

                                                            <div class="mini-cart-details clearfix">
                                                                <a class="product-name" href="<?php echo base_url(); ?>product/details/<?= $card['id'] ?>">
                                                                    <?= $card['name']; ?>
                                                                </a>

                                                                <span class="product-price pull-right">
                                                                    BDT&nbsp;<?= $card['price']; ?>
                                                                </span>
                                                                <span class="product-quantity pull-right">
                                                                    <?= $card['qty'] ?> *
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
                                                Subtotal: <span>BDT&nbsp; <?php echo $this->cart->total(); ?></span>
                                            </span>
                                            <div class="mini-cart-buttons text-center">
                                                <a href="<?php echo base_url(); ?>checkout " class="btn  btn-primary btn-block btn-view-cart">
                                                    CHECKOUT
                                                </a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="mini-cart">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <h3 class="empty-cart">Your cart is empty</h3>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search-area pull-left">
                            <form action="<?php echo base_url('fontend/Product/search') ?>" method="GET" id="search-box-form " class="ajax_search">
                                <div class="search-box hidden-sm hidden-xs">
                                    <input type="text" name="search" class="search-box-input" placeholder="Search for products..." value="" id="homepage_search">

                                    <div class="search-box-button">
                                        <button class="search-box-btn btn btn-primary" type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                            Search
                                        </button>
                                        <!-- <select name="category" class="select search-box-select custom-select-black">
                                                <option value="" selected>All Categories</option>
                                                <?php if ($category) {

                                                    foreach ($category->result() as $row) {
                                                ?>
                                                <option value="<?= $row->c_id ?>" >
                                                    <?= $row->c_name ?>
                                                </option>
                                                <?php }
                                                } ?>
                                                
                                            </select> -->
                                    </div>
                                </div>
                                <div class="ajax__searched__item__section" id="procedure_show"></div>
                                <div class="mobile-search visible-sm visible-xs">
                                    <div class="dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                        <div class="dropdown-menu">
                                            <div class="search-box">
                                                <input type="search" name="query" class="search-box-input" placeholder="Search for products...">
                                                <div class="search-box-button">
                                                    <button type="submit" class="search-box-btn btn btn-primary">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <div class="megamenu-wrapper hidden-xs">
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="category-menu-wrapper pull-left hidden-sm ">
                            <div class="category-menu-dropdown dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                All Categories
                            </div>
                            <ul class="dropdown-menu vertical-mega-menu">
                                <?php
                                if ($category) {
                                    foreach ($category->result() as $row) { ?>

                                        <li class="dropdown fluid-menu">
                                            <a href="<?php echo base_url(); ?>product/category/<?= $row->c_id ?>" class="dropdown-toggle" target="_self"><?= $row->c_name ?> </a>
                                            <?php
                                            $parent = get_rltn_data_multi_con('categories', ['c_parent' => $row->c_id, 'c_status' => 0]);
                                            if ($parent) { ?>
                                                <ul class="dropdown-menu" style="width: 400px">
                                                    <li>
                                                        <div class="fluid-menu-content">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <ul class="list-inline">
                                                                        <?php foreach ($parent->result() as $row1) { ?>
                                                                            <li>
                                                                                <a href="<?php echo base_url(); ?>product/category/<?= $row1->c_id ?>" target="_self">
                                                                                    <?= $row1->c_name ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php } ?>

                                                                    </ul>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </li>
                                                </ul>
                                            <?php }  ?>
                                        </li>
                                <?php
                                    }
                                } ?>
                            </ul>
                        </div>
                        <ul class="nav navbar-nav">
                            <?php
                            if ($menu) {
                                foreach ($menu->result() as $row) {
                                    $menu_category = get_rltn_data_multi_con('categories', ['c_id' => $row->menu_category]);
                                    //$not_parent=category('categories');
                                    if ($menu_category) {
                                        foreach ($menu_category->result() as $row1) {
                                            $parent = get_rltn_data_multi_con('categories', ['c_parent' => $row1->c_id, 'c_status' => 0]);
                                            //$not_parent=category('categories');
                                            if ($parent) { ?>
                                                <li class="dropdown fluid-menu">
                                                    <a href="<?php echo base_url(); ?>product/category/<?= $row1->c_id ?>" class="dropdown-toggle" target="_self">
                                                        <?= $row1->c_name ?>
                                                    </a>
                                                    <ul class="dropdown-menu" style="width: 400px">
                                                        <li>
                                                            <div class="fluid-menu-content">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <!-- <a href="productse076.html?category=shoes" class="title" target="_self">
                                                            Shoes
                                                        </a> -->
                                                                        <ul class="list-inline">
                                                                            <?php foreach ($parent->result() as $row2) { ?>
                                                                                <li>
                                                                                    <a href="<?php echo base_url(); ?>product/category/<?= $row2->c_id ?>" target="_self">
                                                                                        <?= $row2->c_name ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php } ?>

                                                                        </ul>
                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php } else { ?>

                                                <li class=" ">
                                                    <a href="<?php echo base_url(); ?>product/category/<?= $row1->c_id ?>" class="" target="_self">
                                                        <?= $row1->c_name ?>
                                                    </a>
                                                    <ul class="dropdown-menu multi-level">
                                                    </ul>
                                                </li>
                            <?php  }
                                        }
                                    }
                                }
                            } ?>

                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="dropdown fluid-menu">
                                <a href="<?php echo base_url(); ?>blog" class="" target="_self">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>


            <?= $main_content ?>
            <!-- footer start -->

            <!-- footer end -->
            <!-- scroll start -->
            <a class="scroll-top" href="#">
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </a>
            <!-- scroll end -->

            <!-- loader start -->
            <div class="modal fade" id="quick-view-modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body clearfix">
                            Loading...
                        </div>
                    </div>
                </div>
            </div>
            <!-- loader end -->
            <input type="hidden" id="redirect_page" value="<?= base_url("checkout") ?>"></input>
        </div>

    </div>
    <footer class="footer">
        <div class="container">

            <div class="footer-middle p-tb-30 clearfix">
                <ul class="social-links list-inline">
                    <li><a target="_blank" href="<?= $general_settings_list->facebook; ?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="<?= $general_settings_list->insta; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="<?= $general_settings_list->lindin; ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <li><a target="_blank" href="<?= $general_settings_list->youtube; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom p-tb-20 clearfix">
            <div class="container">
                <div class="copyright text-center">
                    <a style="text-decoration: none; color:grey;" href="<?php echo base_url("login") ?>"> <?= $general_settings_list->s_footer ?></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="../cdn.polyfill.io/v2/polyfill.min.js"></script>
    <script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
    <script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry_formvalidation.js') ?>"></script>
    <script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/app8a8c.js?v=1.1.3') ?>"></script>

    <!-- //search -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*console.log('jhjh');*/
            $("#homepage_search").keyup(function() {
                if (this.value.length > 2) {
                    var product_keyword = $('#homepage_search').val();
                    //console.log(product_keyword);
                    if (product_keyword) {
                        $.ajax({
                            type: 'POST',
                            url: "<?php echo base_url('Ajax_play/get_product_name') ?>",
                            data: 'product_keyword=' + product_keyword,
                            success: function(html) {
                                console.log('success');
                                $('#procedure_show').html(html);

                                $('#procedure_show').show();

                                $(".catch_test").click(function() {
                                    var id = this.id;
                                    addtocard = id;
                                    var p = $('#' + id).text();
                                    $('#homepage_search').val(p);
                                    $('#procedure_show').hide();
                                });
                            }
                        });
                    }
                }
            });

        });
    </script>


    <!-- add to cart -->
    <script type="text/javascript">
        $(document).ready(function() {


            $(document).on("click", "body", function() {
                $(".ajax__searched__item__section").css("display", "none");
            });

            $(document).on("click", ".add_to_card", function() {
                var id = $(this).attr("id");

                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/add_to_card_fontend') ?>",
                    data: {
                        id: id
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

                        showcard();
                        card_total();
                        my_card();
                    }
                });
            });

            function showcard() {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/total_card_item') ?>",

                    success: function(data) {
                        //console.log('a');
                        //console.log(data);
                        $('#cart-total_item').html(data);


                    }
                });
            }

            function card_total() {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/total_card') ?>",

                    success: function(data) {
                        //console.log('a');
                        //console.log(data);
                        $('.cart-total1').html('BDT ' + data);


                    }
                });
            }

            function my_card() {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/my_card') ?>",

                    success: function(data) {
                        //console.log('a');
                        //console.log(data);
                        $('#cart-content').html(data);

                    }
                });
            }

            $(".card_remove").click(function() {
                var card_remove_id = $(this).attr("id");
                if (card_remove_id) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('Ajax_play/ajaxCardRemove') ?>",
                        data: 'card_remove_id=' + card_remove_id,
                        success: function(html) {
                            setTimeout(function() {
                                location.reload()
                            })
                            showcard();
                            card_total();
                            my_card();

                        }

                    });
                }
            });

            function cart_list() {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/cart_list') ?>",

                    success: function(data) {
                        $('.cart-data').html(data);

                    }
                });
            }

            $(".qty").blur(function() {
                var qty = $('.qty').val();
                var id = $('.card_increase_id').val();
                var rowid = $('.card_increase_rowid').val();

                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/input_qty_card_fontend') ?>",
                    data: {
                        id: id,
                        qty: qty,
                        rowid: rowid
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                title: "",
                                text: "Product added to cart",
                                icon: "success",
                            });
                        } else {
                            swal({
                                title: "",
                                text: "Insuficent quantity of product",
                                icon: "error",
                            });
                        }
                        showcard();
                        card_total();
                        my_card();
                        //console.log(data);
                        cart_list();
                    }
                });

            });


            $(document).on("click", ".btn-plus", function() {
                var id = $(this).attr('p_id');
                // alert(id);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/details_add_to_card_plus_fontend') ?>",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                title: "",
                                text: "Product added to cart",
                                icon: "success",
                            });
                        } else {
                            swal({
                                title: "",
                                text: "Insuficent quantity of product",
                                icon: "error",
                            });
                        }
                        showcard();
                        card_total();
                        my_card();
                    }
                });
            });
            $(document).on("click", ".btn-minus", function() {
                var id = $(this).attr('p_id');
                // alert(id);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('Ajax_play/details_add_to_card_minus_fontend') ?>",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                title: "",
                                text: "Product Remove to cart",
                                icon: "success",
                            });
                        } else {
                            swal({
                                title: "",
                                text: "Insuficent quantity of product",
                                icon: "error",
                            });
                        }
                        showcard();
                        card_total();
                        my_card();
                    }
                });
            });


        });
    </script>

</body>

</html>