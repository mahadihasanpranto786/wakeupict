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
					Jute Head
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
						<!-- <li class="nav-item">
							<a href="<?php echo base_url('add_out_turn_report') ?>" class="nav-link <?= active_nav('add_out_turn_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Out Turn Report</p>
							</a>
						</li> -->
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
						<li class="nav-item">
							<a href="<?php echo base_url('list_mismatch_area') ?>" class="nav-link <?= active_nav('list_mismatch_area', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Mismatch Area</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_purchase') ?>" class="nav-link <?= active_nav('list_purchase', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Purchase</p>
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


				<!--Jute Purchase Invoice List -->
				<li class="nav-item has-treeview <?= active_open('invoice_status', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('invoice_status', $main_nav); ?>">

						<?php

						$purchaseInvoiceApproveInfoByUser = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_user_id' => $userId, 'iajp_status' => 1]);
						if ($purchaseInvoiceApproveInfoByUser) {

							$serialMax = (int)$purchaseInvoiceApproveInfoByUser->iajp_approval_status - 1;

							$newInvoiceCount = $this->db->query("SELECT COUNT(jpis_id) as total FROM jute_purchase_invoice_summary WHERE jpis_id NOT IN (SELECT iar_invoice_id
							FROM invoice_approval_return WHERE  iar_invoice_type = 1 AND iar_status = 1
						   ) AND jpis_user_serially_approval_status = $serialMax AND jpis_approve_status = 0 AND jpis_status = 1")->row()->total;
						} else {

							$newInvoiceCount = $this->db->query("SELECT COUNT(jpis_id) as total FROM jute_purchase_invoice_summary WHERE jpis_id NOT IN (SELECT iar_invoice_id
							FROM invoice_approval_return WHERE  iar_invoice_type = 1 AND iar_status = 1
						   ) AND jpis_user_serially_approval_status = 0 AND jpis_approve_status = 0 AND jpis_status = 1")->row()->total;
						}


						if ($purchaseInvoiceApproveInfoByUser) {
							$processingInvoiceCountApprovalPositionWise = $this->Common->count_all_result('jute_purchase_invoice_summary', ['jpis_user_serially_approval_status >= ' => $purchaseInvoiceApproveInfoByUser->iajp_approval_status, 'jpis_approve_status' => 0, 'jpis_status' => 1]);
						} else {
							$approveRunningInvoiceCount = $this->Common->count_all_result('jute_purchase_invoice_summary', ['jpis_user_serially_approval_status > ' => 0, 'jpis_approve_status' => 0, 'jpis_status' => 1]);
						}

						$approveDoneInvoiceCount = $this->Common->count_all_result('jute_purchase_invoice_summary', ['jpis_approve_status' => 1, 'jpis_status' => 1]);
						$returnedInvoiceCount = $this->db->query("SELECT COUNT(jpis_id) as total FROM jute_purchase_invoice_summary INNER JOIN invoice_approval_return ON iar_invoice_id = jpis_id WHERE iar_invoice_type = 1 AND iar_status = 1 AND jpis_status = 1")->row()->total;

						?>

						<span class="badge btn-danger float-right mr-4 <?php echo (!empty($newInvoiceCount)) ? true : "d-none"; ?>">New: <?php if ($newInvoiceCount) {
																																				echo $newInvoiceCount;
																																			} ?></span>
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Invoice Status
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<!-- Coming Invoice -->
						<?php
						$purchaseInvoiceApproveInfoByUser = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_user_id' => $userId, 'iajp_status' => 1]);

						if ($purchaseInvoiceApproveInfoByUser) {
							if ($purchaseInvoiceApproveInfoByUser->iajp_approval_status > 1) {
								$previousNumber = (int)$purchaseInvoiceApproveInfoByUser->iajp_approval_status - 1;
								$approveComingInvoiceCount = $this->db->query("SELECT COUNT(jpis_id) as total FROM jute_purchase_invoice_summary WHERE jpis_id NOT IN (SELECT iar_invoice_id
						FROM invoice_approval_return WHERE  iar_invoice_type = 1 AND iar_status = 1
					   ) AND jpis_user_serially_approval_status < $purchaseInvoiceApproveInfoByUser->iajp_approval_status AND jpis_user_serially_approval_status != $previousNumber AND jpis_approve_status = 0 AND jpis_status = 1")->row()->total;

						?>
								<li class="nav-item">
									<a href="<?php echo base_url('list_coming_purchase') ?>" class="nav-link <?= active_nav('list_coming_purchase', $sub_nav); ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Coming</p>

										<span class="badge btn-danger float-right mr-4 <?php echo (!empty($approveComingInvoiceCount)) ? true : "d-none"; ?>"> <?php if ($approveComingInvoiceCount) {
																																									echo $approveComingInvoiceCount;
																																								} ?></span>
									</a>
								</li>
						<?php }
						} ?>
						<!-- /.Coming Invoice -->



						<li class="nav-item">
							<a href="<?php echo base_url('list_new_purchase') ?>" class="nav-link <?= active_nav('list_new_purchase', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>New</p>

								<span class="badge btn-danger float-right mr-4 <?php echo (!empty($newInvoiceCount)) ? true : "d-none"; ?>"> <?php if ($newInvoiceCount) {
																																					echo $newInvoiceCount;
																																				} ?></span>
							</a>
						</li>

						<?php
						$purchaseInvoiceLastApprover = $this->Common->get_single_row_information_multi_conditional_max_value('invoice_approver_jute_purchase', ['iajp_status' => 1], 'iajp_approval_status');
						if ($purchaseInvoiceApproveInfoByUser) {
							$getUserByApprovalMaxValue = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_approval_status' =>  $purchaseInvoiceLastApprover->iajp_approval_status, 'iajp_status' => 1]);
							if ($userId != $getUserByApprovalMaxValue->iajp_user_id) {
						?>
								<li class="nav-item">
									<a href="<?php echo base_url('list_processing_purchase') ?>" class="nav-link <?= active_nav('list_processing_purchase', $sub_nav); ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Processing</p>
										<?php
										if ($purchaseInvoiceApproveInfoByUser->iajp_user_id == $userId) { ?>
											<span class="badge btn-danger float-right mr-4 <?php echo (!empty($processingInvoiceCountApprovalPositionWise)) ? true : "d-none"; ?>"> <?php if ($processingInvoiceCountApprovalPositionWise) {
																																														echo $processingInvoiceCountApprovalPositionWise;
																																													} ?></span>
										<?php } else { ?>
											<span class="badge btn-danger float-right mr-4 <?php echo (!empty($approveRunningInvoiceCount)) ? true : "d-none"; ?>"> <?php if ($approveRunningInvoiceCount) {
																																										echo $approveRunningInvoiceCount;
																																									} ?></span>
										<?php } ?>

									</a>
								</li>
						<?php }
						} ?>

						<li class="nav-item">
							<a href="<?php echo base_url('list_returned_purchase') ?>" class="nav-link <?= active_nav('list_returned_purchase', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Returned</p>

								<span class="badge btn-danger float-right mr-4 <?php echo (!empty($returnedInvoiceCount)) ? true : "d-none"; ?>"> <?php if ($returnedInvoiceCount) {
																																						echo $returnedInvoiceCount;
																																					} ?></span>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url('list_approved_purchase') ?>" class="nav-link <?= active_nav('list_approved_purchase', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Approved</p>

								<span class="badge btn-danger float-right mr-4 <?php echo (!empty($approveDoneInvoiceCount)) ? true : "d-none"; ?>"> <?php if ($approveDoneInvoiceCount) {
																																							echo $approveDoneInvoiceCount;
																																						} ?></span>
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
