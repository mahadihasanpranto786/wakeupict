<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url(); ?>assets/admin_layout/image/admin.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?= $this->session->userdata('current_vendor_name') ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->
		
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="<?= active_nav('dashboard', $main_nav); ?>"><a href="<?php echo base_url('vendor/dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			<li class="treeview <?= active_nav('products', $main_nav); ?>">
				<a href="#">
					<i class="fa fa-product-hunt" aria-hidden="true"></i>
</i> <span>Products</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('product_list', $sub_nav); ?>"><a href="<?php echo base_url('vendor/product_list') ?>"><i class="fa fa-circle-o text-aqua"></i> Product List</a></li>
					<li class="<?= active_nav('create_product', $sub_nav); ?>"><a href="<?php echo base_url('vendor/add_product') ?>"><i class="fa fa-circle-o text-aqua"></i> Add Product</a></li>

				</ul>
			</li>

			<li class="treeview <?= active_nav('order', $main_nav); ?>">
				<a href="#">
					<i class="fa fa-money" aria-hidden="true"></i>
 <span>Sells</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('process_order', $sub_nav); ?>"><a href="<?php echo base_url('vendor/invoice_list/0') ?>"><i class="fa fa-circle-o text-aqua"></i> Pending Order List</a></li>


					<li class="<?= active_nav('confirm_order', $sub_nav); ?>"><a href="<?php echo base_url('vendor/invoice_list/6') ?>"><i class="fa fa-circle-o text-aqua"></i> Confirmed Order List</a></li>



					<li class="<?= active_nav('shipped_order', $sub_nav); ?>"><a href="<?php echo base_url('vendor/invoice_list/5') ?>"><i class="fa fa-circle-o text-aqua"></i> Shipped Order List</a></li>
					<li class="<?= active_nav('complete_order', $sub_nav); ?>"><a href="<?php echo base_url('vendor/invoice_list/1') ?>"><i class="fa fa-circle-o text-aqua"></i> Complete Order List</a></li>
					<li class="<?= active_nav('cancle_order', $sub_nav); ?>"><a href="<?php echo base_url('vendor/invoice_list/2') ?>"><i class="fa fa-circle-o text-aqua"></i> Cancel Order List</a></li>
				</ul>
			</li>
			<li class="treeview <?= active_nav('withdrawal', $main_nav); ?>">
				<a href="#">
					<i class="fa fa-paper-plane" aria-hidden="true"></i>
 					<span>Withdrawal</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('withdrawal_list', $sub_nav); ?>"><a href="<?php echo base_url('vendor/withdrawal_list') ?>"><i class="fa fa-circle-o text-aqua"></i> Withdrawal List</a></li>
					<li class="<?= active_nav('withdrawal_create', $sub_nav); ?>"><a href="<?php echo base_url('vendor/withdrawal_create') ?>"><i class="fa fa-circle-o text-aqua"></i> Withdrawal Create</a></li>

				</ul>
			</li>

			<!-- <li class="treeview <?= active_nav('Reporting', $main_nav); ?>">
				<a href="#">
					<i class="fa fa-search-plus" aria-hidden="true"></i>
			 <span>Reporting</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('order_report', $sub_nav); ?>"><a href="<?php echo base_url('vendor/order_report') ?>"><i class="fa fa-circle-o text-aqua"></i>Order Report</a></li>
					<li class="<?= active_nav('sales_report', $sub_nav); ?>"><a href="<?php echo base_url('vendor/sales_report') ?>"><i class="fa fa-circle-o text-aqua"></i>Sales Report</a></li>
					<li class="<?= active_nav('product_report', $sub_nav); ?>"><a href="<?php echo base_url('vendor/product_report') ?>"><i class="fa fa-circle-o text-aqua"></i>Product Report</a></li>
				</ul>
			</li> -->



			
			


		</ul>
	</section>
	<!-- /.sidebar -->
</aside>