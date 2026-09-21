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
					Accounts Head
				</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<!-- Dashboard -->
				<li class="nav-item has-treeview <?= active_open('dashboard', $main_nav); ?>">
					<a href="<?php echo base_url('jute_operator') ?>" class="nav-link <?= active_nav('dashboard', $main_nav); ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>

				<li class="nav-item has-treeview <?= active_open('entry', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('entry', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Out Turn
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('list_jute_entry') ?>" class="nav-link <?= active_nav('list_jute_entry', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Jute Entry</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_out_turn_report') ?>" class="nav-link <?= active_nav('add_out_turn_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Out Turn Report</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_monthly_out_turn_report') ?>" class="nav-link <?= active_nav('list_monthly_out_turn_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Monthly Out Turn Report</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_out_turn_report') ?>" class="nav-link <?= active_nav('list_out_turn_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>All Out Turn Report</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview <?= active_open('list_jute_return_info', $main_nav); ?>">
					<a href="<?php echo base_url('list_jute_return_info') ?>" class="nav-link <?= active_nav('list_jute_return_info', $main_nav); ?>">
						<i class="far fa-circle nav-icon"></i>
						<p>Jute Return Info</p>
					</a>
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
