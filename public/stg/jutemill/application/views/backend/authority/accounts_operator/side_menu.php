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
					Accounts Operator
				</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<!-- Dashboard -->
				<li class="nav-item has-treeview <?= active_open('dashboard', $main_nav); ?>">
					<a href="<?php echo base_url('accounts_operator') ?>" class="nav-link <?= active_nav('dashboard', $main_nav); ?>">
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
							View Details
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
							<a href="<?php echo base_url('list_jute_return_info') ?>" class="nav-link <?= active_nav('list_jute_return_info', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Return Info</p>
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

				<!--Godown -->
				<li class="nav-item has-treeview <?= active_open('godown', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('godown', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Jute Stock
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">

						<!-- <li class="nav-item">
							<a href="<?php echo base_url('godown_reports_old') ?>" class="nav-link <?= active_nav('godown_reports_old', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>View Godown Reports Old</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="<?php echo base_url('godown_reports') ?>" class="nav-link <?= active_nav('godown_reports', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								Jute Purchase, Issue & Stock Report
							</a>
						</li>
						<!-- <li class="nav-item">
							<a href="<?php echo base_url('factory_reports') ?>" class="nav-link <?= active_nav('factory_reports', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>View Factory Reports</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="<?php echo base_url('add_jute_calculation_helper') ?>" class="nav-link <?= active_nav('add_jute_calculation_helper', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Report Calculation Helper</p>
							</a>
						</li>
					</ul>
				</li>

				<!--Khamal -->
				<li class="nav-item has-treeview <?= active_open('khamal', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('khamal', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Khamal Stock
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_godown') ?>" class="nav-link <?= active_nav('add_godown', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Godown</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_khamal') ?>" class="nav-link <?= active_nav('add_khamal', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Khamal</p>
							</a>
						</li>
						<!-- <li class="nav-item">
							<a href="<?php echo base_url('khamal_final_stock_old') ?>" class="nav-link <?= active_nav('khamal_final_stock_old', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Khamal Final Stock Old</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="<?php echo base_url('khamal_final_stock') ?>" class="nav-link <?= active_nav('khamal_final_stock', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Khamal Final Stock</p>
							</a>
						</li>
						<!-- Un Assorted -->
						<li class="nav-item">
							<a href="<?php echo base_url('list_unassorted_added') ?>" class="nav-link <?= active_nav('list_unassorted_added', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Unassorted Added List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_unassorted_deduction') ?>" class="nav-link <?= active_nav('list_unassorted_deduction', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Unassorted Deduction List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_assorted_uncut_added') ?>" class="nav-link <?= active_nav('list_assorted_uncut_added', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Assorted Uncut Added List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_assorted_uncut_deduction') ?>" class="nav-link <?= active_nav('list_assorted_uncut_deduction', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Assorted Uncut Deduction List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_assorted_cut_added') ?>" class="nav-link <?= active_nav('list_assorted_cut_added', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Assorted Cut Added List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_assorted_cut_deduction') ?>" class="nav-link <?= active_nav('list_assorted_cut_deduction', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Assorted Cut Deduction List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_opening_khamal') ?>" class="nav-link <?= active_nav('list_opening_khamal', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Opening Khamal</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_khamal_running_stock') ?>" class="nav-link <?= active_nav('list_khamal_running_stock', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Khamal Running Stock</p>
							</a>
						</li>
						<!--Assorted -->
						<!-- <li class="nav-item has-treeview <?= active_open('assorted', $main_nav); ?>">
							<a href="#" class="nav-link <?= active_nav('khamal', $main_nav); ?>">
								<i class="nav-icon fas fa-edit"></i>
								<p>
									Assorted
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url('add_assorted') ?>" class="nav-link <?= active_nav('add_assorted', $sub_nav); ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Add Assorted</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url('list_assorted') ?>" class="nav-link <?= active_nav('list_assorted', $sub_nav); ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>List Assorted</p>
									</a>
								</li>
							</ul>
						</li> -->
					</ul>
				</li>

				<!--Opening Jute -->
				<li class="nav-item has-treeview <?= active_open('opening_jute', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('opening_jute', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Opening Jute
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('list_opening_jute') ?>" class="nav-link <?= active_nav('list_opening_jute', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Opening Jute</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- Supplier -->
				<li class="nav-item has-treeview <?= active_open('supplier', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('supplier', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Supplier
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<!-- <li class="nav-item">
                            <a href="<?php echo base_url('supplier_type') ?>" class="nav-link <?= active_nav('supplier_type', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier Type</p>
                            </a>
                        </li> -->
						<!-- <li class="nav-item">
							<a href="<?php echo base_url('add_supplier') ?>" class="nav-link <?= active_nav('add_supplier', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Supplier</p>
							</a>
						</li> -->
						<!-- <li class="nav-item">
                            <a href="<?php echo base_url('list_supplier') ?>" class="nav-link <?= active_nav('list_supplier', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier List</p>
                            </a>
                        </li> -->
						<li class="nav-item">
							<a href="<?php echo base_url('jute_supplier_report') ?>" class="nav-link <?= active_nav('jute_supplier_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Supplier Report</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_approx_supplier_payment') ?>" class="nav-link <?= active_nav('jute_supplier_approx_payment_calculator', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Approx Payment Calculator</p>
							</a>
						</li>
					</ul>
				</li>


				<!-- Jute Sell -->
				<li class="nav-item has-treeview <?= active_open('jute_sell', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('jute_sell', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Jute Sell
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_jute_sell') ?>" class="nav-link <?= active_nav('add_jute_sell', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Jute Sell</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_jute_sell') ?>" class="nav-link <?= active_nav('list_jute_sell', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Jute Sell</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('total_jute_sale_quantity') ?>" class="nav-link <?= active_nav('total_jute_sale_quantity', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Sale Quantity</p>
							</a>
						</li>

					</ul>
				</li>


				<!-- Client -->
				<li class="nav-item has-treeview <?= active_open('client', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('client', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Client
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<!-- <li class="nav-item">
                            <a href="<?php echo base_url('client_type') ?>" class="nav-link <?= active_nav('client_type', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Client Type</p>
                            </a>
                        </li> -->
						<!-- <li class="nav-item">
                            <a href="<?php echo base_url('add_client') ?>" class="nav-link <?= active_nav('add_client', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jute Client List</p>
                            </a>
                        </li> -->
						<li class="nav-item">
							<a href="<?php echo base_url('jute_client_report') ?>" class="nav-link <?= active_nav('jute_client_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Client Report</p>
							</a>
						</li>
						<!-- <li class="nav-item">
                            <a href="<?php echo base_url('list_all_payment') ?>" class="nav-link <?= active_nav('list_all_payment', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List All Payments</p>
                            </a>
                        </li> -->

					</ul>
				</li>



				<!-- Adjustment -->
				<li class="nav-item has-treeview <?= active_open('adjustment', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('adjustment', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Adjustment
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('list_adjustment') ?>" class="nav-link <?= active_nav('list_adjustment', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Adjustment</p>
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
