<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['category'] = 'backend/Admin/category';
$route['sub_category'] = 'backend/Admin/sub_category';
$route['dashboard'] = 'backend/Admin';
$route['add_product'] = 'backend/Admin/create_product';
$route['product_list'] = 'backend/Admin/product_list';
$route['update_pinned_status'] = 'backend/Admin/update_pinned_status';
$route['edit_product/(.*)'] = 'backend/Admin/edit_product/$1';
$route['product_related_image'] = 'backend/Admin/related_product_images_list';
//Authority
$route['authority_info'] = 'backend/Admin/authority_info';
$route['updateAuthority'] = 'backend/Admin/updateAuthority';
//Blog
$route['blog'] = 'fontend/Frontend/frontendBlogView';
$route['blog_details'] = 'fontend/Frontend/blogDetailsView';

$route['create_order'] = 'backend/Order/create_order';
$route['invoice_list/(.*)'] = 'backend/Order/invoice_list/$1';
$route['invoice_view/(.*)'] = 'backend/Order/invoice/$1';
$route['invoice_print/(.*)'] = 'backend/Order/print_invoice/$1';
$route['print_all/(.*)'] = 'backend/Order/print_all/$1';
$route['complete_invoice/(.*)'] = 'backend/Order/complete_invoice/$1';
$route['confirm_shipped/(.*)'] = 'backend/Order/confirm_shipped/$1';
$route['invoice_confirm/(.*)'] = 'backend/Order/invoice_confirm/$1';


$route['order_report'] = 'backend/Report/order_report';
$route['sales_report'] = 'backend/Report/sales_report';
$route['genarate_sales_report'] = 'backend/Report/genarate_sales_report';
$route['product_report'] = 'backend/Report/product_report';
$route['settings'] = 'backend/Admin/settings';

//$route['/'] = 'fontend/Home';
$route['product/category/(.*)'] = 'fontend/Product/category/$1';
$route['product/details/(.*)'] = 'fontend/Product/details/$1';
$route['cart'] = 'fontend/Order/cart';
$route['checkout'] = 'fontend/Order/checkout';
$route['user/dashboard'] = 'user/UserView';
$route['user/change_profile'] = 'user/UserView/change_profile';


$route['user/invoice_list/(.*)'] = 'user/UserView/invoice_list/$1';
$route['user/invoice_view/(.*)'] = 'user/UserView/invoice/$1';
$route['user/invoice_print/(.*)'] = 'user/UserView/print_invoice/$1';
$route['user/print_all/(.*)'] = 'user/UserView/print_all/$1';
$route['user/confirm_invoice/(.*)'] = 'user/UserView/confirm_invoice/$1';
$route['user/confirm_shipped/(.*)'] = 'user/UserView/confirm_shipped/$1';
$route['user/invoice_confirm/(.*)'] = 'user/UserView/invoice_confirm/$1';


$route['vendor/dashboard'] = 'backend/Vendor';
$route['vendor/add_product'] = 'backend/Vendor/create_product';
$route['vendor/product_list'] = 'backend/Vendor/product_list';
$route['vendor/edit_product/(.*)'] = 'backend/Vendor/edit_product/$1';
$route['vendor/edit_product/(.*)'] = 'backend/Vendor/edit_product/$1';
$route['vendor/product_related_image'] = 'backend/Vendor/related_product_images_list';


$route['vendor/invoice_list/(.*)'] = 'backend/VendorOrder/invoice_list/$1';
$route['vendor/invoice_view/(.*)'] = 'backend/VendorOrder/invoice/$1';
$route['vendor/invoice_print/(.*)'] = 'backend/VendorOrder/print_invoice/$1';
$route['vendor/print_all/(.*)'] = 'backend/VendorOrder/print_all/$1';
$route['vendor/confirm_invoice/(.*)'] = 'backend/VendorOrder/confirm_invoice/$1';
$route['vendor/confirm_shipped/(.*)'] = 'backend/VendorOrder/confirm_shipped/$1';
$route['vendor/invoice_confirm/(.*)'] = 'backend/VendorOrder/invoice_confirm/$1';

$route['vendor/order_report'] = 'backend/VendorReport/order_report';
$route['vendor/sales_report'] = 'backend/VendorReport/genarate_sales_report';
$route['vendor/product_report'] = 'backend/VendorReport/product_report';


$route['vendor/withdrawal_list'] = 'backend/Withdrawal/index';
$route['vendor/withdrawal_create'] = 'backend/Withdrawal/create';
$route['vendor/withdrawal_store'] = 'backend/Withdrawal/store';


$route['pending_withdrawal_list'] = 'backend/Admin/pending_withdrawal_list';
$route['accepted_withdrawal_list'] = 'backend/Admin/accepted_withdrawal_list';
$route['accept_withdrawal/(.*)'] = 'backend/Admin/accept_withdrawal/$1';


$route['logout'] = 'backend/Admin/user_logout';
$route['change_profile'] = 'backend/Admin/change_profile';
$route['reset_cart'] = 'Ajax_play/reset_cart';

$route['change_profile/vendor'] = 'backend/Vendor/change_profile';
$route['logout/vendor'] = 'backend/Vendor/user_logout';



$route['login'] = 'backend/Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['test'] = 'fontend/Test';
$route['sign_in'] = 'fontend/Login';
$route['sign_up'] = 'fontend/Registration';

$route['product/ads/(.*)'] = 'fontend/Product/ads/$1';
