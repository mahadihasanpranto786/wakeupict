<aside class="main-sidebar" style="background-color: #1b1b1b">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="text-center image">
				<?php
				$authorityData = $this->Common->get_data_single_multi_conditional('authority', ['authority_isdeleted' => '0', 'authority_type' => 1]);
				if (isset($authorityData->authority_image)) {
					$src = base_url() . "assets/uploads/authority/" . $authorityData->authority_image;
				} else {
					$src =  base_url() . 'assets/admin_layout/image/admin.png';
				}
				?><a href="<?= base_url() ?>authority_info?id=1">
					<div style="display: flex; justify-content: center">
						<span>
							<img src="<?php echo $src ?>" class="img-circle" height="50" width="50" alt="User Image">
						</span>
						<span class="text-center" style="font-size:16px; padding-left:10px">Admin
							<br><span style="color:#fff; font-size:10px;" href="#"><i class="fa fa-circle text-success"></i> Online</span>
						</span>
					</div>
				</a>
			</div>

		</div>
		<!-- search form -->

		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header text-center">MAIN NAVIGATION</li>
			<li class="<?= active_nav('dashboard', $main_nav); ?>"><a href="<?php echo base_url('dashboard') ?>">

					<img src="<?php echo base_url() ?>assets/storefront/icon/dashboard.png" height="25" width="25" alt="">
					<span>Dashboard</span></a></li>
			<li class="treeview <?= active_nav('products', $main_nav); ?>">
				<a href="#">

					<img src="<?php echo base_url() ?>assets/storefront/icon/products.png" height="20" width="20" alt=""> <span>Products</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('category', $sub_nav); ?>"><a href="<?php echo base_url('category') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Category</a></li>
					<li class="<?= active_nav('sub_category', $sub_nav); ?>"><a href="<?php echo base_url('sub_category') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Sub Category</a></li>
					<li class="<?= active_nav('product_list', $sub_nav); ?>"><a href="<?php echo base_url('product_list') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Product List</a></li>
					<li class="<?= active_nav('create_product', $sub_nav); ?>"><a href="<?php echo base_url('add_product') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Add Product</a></li>

				</ul>
			</li>

			<li class="treeview <?= active_nav('order', $main_nav); ?>">
				<a href="#">
					<img src="<?php echo base_url() ?>assets/storefront/icon/accounts.png" height="20" width="20" alt="">
					<span> Sells</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">

					<li class="<?= active_nav('shipped_order', $sub_nav); ?>"><a href="<?php echo base_url('invoice_list/5') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Pending Order List</a></li>

					<li class="<?= active_nav('complete_order', $sub_nav); ?>"><a href="<?php echo base_url('invoice_list/1') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Complete Order List</a></li>

					<li class="<?= active_nav('cancle_order', $sub_nav); ?>"><a href="<?php echo base_url('invoice_list/2') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Cancel Order List</a></li>
				</ul>
			</li>

			<li class="treeview <?= active_nav('Reporting', $main_nav); ?>">
				<a href="#">

					<img src="<?php echo base_url() ?>assets/storefront/icon/Search.png" height="25" width="25" alt="">
					<span>Reporting</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('order_report', $sub_nav); ?>"><a href="<?php echo base_url('order_report') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Order Report</a></li>
					<li class="<?= active_nav('sales_report', $sub_nav); ?>"><a href="<?php echo base_url('sales_report') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i> Sales Report</a></li>
					<li class="<?= active_nav('product_report', $sub_nav); ?>"><a href="<?php echo base_url('product_report') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							Product Report</a></li>
				</ul>
			</li>

			<li class="<?= active_nav('settings', $main_nav); ?>"><a href="<?php echo base_url('settings') ?>">


					<img src="<?php echo base_url() ?>assets/storefront/icon/setting.png" class="text-inf" height="25" width="25" alt=""> <span> Settings</span></a></li>

			<li class="treeview <?= active_nav('appearance', $main_nav); ?>">
				<a href="#"><img src="<?php echo base_url() ?>assets/storefront/icon/appreance.png" class="text-inf" height="25" width="25" alt="">
					<span>Appearance</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('slider', $sub_nav); ?>"><a href="<?php echo base_url('backend/Slider') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i><span>Slider</span></a></li>
					<li class="<?= active_nav('advertisement', $sub_nav); ?>"><a href="<?php echo base_url('backend/Advertisement') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i><span>Advertisement</span></a></li>

					<li class="<?= active_nav('menu', $sub_nav); ?>"><a href="<?php echo base_url('backend/Menu') ?>"><i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i><span>Menu</span></a></li>

				</ul>
			</li>

			<li class="<?= active_nav('user', $main_nav); ?>"><a href="<?php echo base_url('backend/Admin/user_list') ?>">

					<img src="<?php echo base_url() ?>assets/storefront/icon/user_list.png" height="25" width="25" alt="">

					<span>User List</span></a>
			</li>

			<li class="treeview <?= active_nav('blog', $main_nav); ?>">
				<a href="#">
					<img src="<?php echo base_url() ?>assets/storefront/icon/blog.png" height="25" width="25" alt="">
					<span>Blog</span><span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= active_nav('categoryView', $sub_nav); ?>">
						<a href="<?php echo base_url('backend/Blog/categoryView') ?>">
							<i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							<span>Category</span>

						</a>
					</li>
					<li class="nav-item <?= active_nav('tagView', $sub_nav); ?>">
						<a href="<?php echo base_url('backend/Blog/tagView') ?>">
							<i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							<span>Tag</span>
						</a>
					</li>
					<li class="nav-item <?= active_nav('blogView', $sub_nav); ?>">
						<a href="<?php echo base_url('backend/Blog/blogView') ?>">
							<i class="fa fa-check-square-o text-success fa-1x" aria-hidden="true"></i>
							<span>Blog</span>
						</a>
					</li>
				</ul>
			</li>


		</ul>
	</section>
	<!-- /.sidebar -->
</aside>