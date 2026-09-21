<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="#" class="brand-link">
		<div class="image ml-2">
			<img src="<?php echo base_url('') ?>assets/uploads/users/user_dummy/rjml_logo.png" class="img-circle elevation-2" alt="User Image" style="height:40px; width:40px;">
			<span class="brand-text font-weight-light">RJML</span>
		</div>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel py-2 mb-3 d-flex align-items-center">
			<div class="image">
				<?php
				$userId = $this->session->userdata('currentActiveId');
				if ($userId) {
					$userInformation = $this->Common->get_single_row_information_multi_conditional('authority', ['a_id' => $userId, 'a_status' => 1]);
					if ($userInformation->a_img) {
				?>
						<img src="<?php echo base_url('') ?>./assets/uploads/users/<?= $userInformation->a_img ?>" class="img-square elevation-2" alt="Img">
					<?php } else { ?>
						<img src="<?php echo base_url('') ?>assets/uploads/users/user_dummy/user_dummy.jpg" class="img-square elevation-2" alt="Img">
				<?php }
				} ?>
			</div>
			<div class="info">
				<a href="#" class="d-block h5">
					<?php
					if ($userId) {
						if ($userInformation) {
							echo $userInformation->a_name;
						}
					}
					?>
				</a>
				<a href="#" class="d-block">
					Production Head
				</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<!-- Dashboard -->
				<li class="nav-item has-treeview <?= active_open('dashboard', $main_nav); ?>">
					<a href="<?php echo base_url('production_head') ?>" class="nav-link <?= active_nav('dashboard', $main_nav); ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>

				<!--Daily Issue -->
				<li class="nav-item has-treeview <?= active_open('daily_issue', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('daily_issue', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Daily Issue
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_daily_requisition') ?>" class="nav-link <?= active_nav('add_daily_requisition', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Requisition</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_daily_requisition') ?>" class="nav-link <?= active_nav('list_daily_requisition', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Requisition</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_daily_issue') ?>" class="nav-link <?= active_nav('list_daily_issue', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Daily Issue</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('total_issued_quantity') ?>" class="nav-link <?= active_nav('total_issued_quantity', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Total Issued Quantity</p>
							</a>
						</li>
					</ul>
				</li>



				<!-- User Profile -->
				<li class="nav-item has-treeview <?= active_open('user_profile', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('user_profile', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Profile
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_user_profile') ?>" class="nav-link <?= active_nav('add_user_profile', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Your Profile </p>
							</a>
						</li>
					</ul>
				</li>

			</ul>
		</nav>
	</div>
</aside>
