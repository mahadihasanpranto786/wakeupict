<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>User</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->

		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="<?= active_nav('dashboard', $main_nav); ?>"><a href="<?php echo base_url('user/dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

			<li class="treeview <?= active_nav('order', $main_nav); ?>">
				<a href="#">
					<i class="fa fa-money" aria-hidden="true"></i>
					<span>Order</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">

					<li class="<?= active_nav('process_order', $sub_nav); ?>"><a href="<?php echo base_url('user/invoice_list/0') ?>"><i class="fa fa-circle-o text-aqua"></i> Pending Order List</a></li>
					<li class="<?= active_nav('confirm_order', $sub_nav); ?>"><a href="<?php echo base_url('user/invoice_list/6') ?>"><i class="fa fa-circle-o text-aqua"></i> Confirmed Order List</a></li>
					<li class="<?= active_nav('shipped_order', $sub_nav); ?>"><a href="<?php echo base_url('user/invoice_list/5') ?>"><i class="fa fa-circle-o text-aqua"></i> Shipped Order List</a></li>
					<li class="<?= active_nav('complete_order', $sub_nav); ?>"><a href="<?php echo base_url('user/invoice_list/1') ?>"><i class="fa fa-circle-o text-aqua"></i> Complete Order List</a></li>
					<li class="<?= active_nav('cancle_order', $sub_nav); ?>"><a href="<?php echo base_url('user/invoice_list/2') ?>"><i class="fa fa-circle-o text-aqua"></i> Cancel Order List</a></li>
				</ul>
			</li>



			<li class="<?= active_nav('settings', $main_nav); ?>"><a href="<?php echo base_url('user/change_profile') ?>"><i class="fa fa-cogs" aria-hidden="true"></i>
					<span>Settings</span></a>
			</li>

		</ul>
	</section>
	<!-- /.sidebar -->
</aside>