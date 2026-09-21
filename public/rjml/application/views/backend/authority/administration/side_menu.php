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
					Administration
				</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

				<!-- Dashboard -->
				<li class="nav-item has-treeview <?= active_open('dashboard', $main_nav); ?>">
					<a href="<?php echo base_url('administration') ?>" class="nav-link <?= active_nav('dashboard', $main_nav); ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<!-- Setup => Area, Mokam -->
				<li class="nav-item has-treeview <?= active_open('setup', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('setup', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Setup
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_area') ?>" class="nav-link <?= active_nav('add_area', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Area</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_mokam') ?>" class="nav-link <?= active_nav('add_mokam', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Mokam</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_jute_purchase_order') ?>" class="nav-link <?= active_nav('list_purchase_order', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Purchase Order</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_jute_stock_alert_quantity') ?>" class="nav-link <?= active_nav('add_jute_stock_alert_quantity', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Stock Quantity Alert</p>
							</a>
						</li>
					</ul>
				</li>


				<!-- Area -->
				<!-- <li class="nav-item has-treeview <?= active_open('area', $main_nav); ?>">
                    <a href="#" class="nav-link <?= active_nav('area', $main_nav); ?>">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Area
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('list_area') ?>" class="nav-link <?= active_nav('list_area', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Area</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('add_area') ?>" class="nav-link <?= active_nav('add_area', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Area</p>
                            </a>
                        </li>
                    </ul>
                </li> -->


				<!-- Mokam -->
				<!-- <li class="nav-item has-treeview <?= active_open('mokam', $main_nav); ?>">
                    <a href="#" class="nav-link <?= active_nav('mokam', $main_nav); ?>">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Mokam
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('add_mokam') ?>" class="nav-link <?= active_nav('add_mokam', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Mokam</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

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
						<li class="nav-item">
							<a href="<?php echo base_url('supplier_type') ?>" class="nav-link <?= active_nav('supplier_type', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Supplier Type</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_supplier') ?>" class="nav-link <?= active_nav('add_supplier', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Supplier</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_supplier') ?>" class="nav-link <?= active_nav('list_supplier', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Supplier List</p>
							</a>
						</li>
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
						<li class="nav-item">
							<a href="<?php echo base_url('add_multi_payment') ?>" class="nav-link <?= active_nav('add_multi_payment', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Multi Payment</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('daily_payment_report') ?>" class="nav-link <?= active_nav('daily_payment_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List Daily Payment</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- grade -->
				<li class="nav-item has-treeview <?= active_open('grade', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('grade', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Grade
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_jute_grade') ?>" class="nav-link <?= active_nav('add_jute_grade', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Grade</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- Jute Rate -->
				<li class="nav-item has-treeview <?= active_open('jute_rate', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('jute_rate', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Jute Rate
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_jute_rate') ?>" class="nav-link <?= active_nav('add_jute_rate', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Jute Rate</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('list_jute_rate') ?>" class="nav-link <?= active_nav('list_jute_rate', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Jute Rate Sheets</p>
							</a>
						</li>
					</ul>

				</li>

				<!-- Financial Year -->
				<li class="nav-item has-treeview <?= active_open('financial_year', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('financial_year', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Financial Year
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_financial_year') ?>" class="nav-link <?= active_nav('add_financial_year', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Financial Year</p>
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


				<!-- Bank -->
				<li class="nav-item has-treeview <?= active_open('bank', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('bank', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Bank
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_bank') ?>" class="nav-link <?= active_nav('add_bank', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Bank Info</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_bank_branch') ?>" class="nav-link <?= active_nav('add_bank_branch', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Branch</p>
							</a>
						</li>
						<!-- <li class="nav-item">
                            <a href="<?php echo base_url('list_bank_account_info') ?>" class="nav-link <?= active_nav('list_bank_account_info', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Account Info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('add_bank_deposit') ?>" class="nav-link <?= active_nav('add_bank_deposit', $sub_nav); ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposit & Withdraw</p>
                            </a>
                        </li> -->
					</ul>
				</li>

				<!-- Reports -->
				<li class="nav-item has-treeview <?= active_open('reports', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('reports', $main_nav); ?>">
						<i class="nav-icon fas fa-edit"></i>
						<p>
							Reports
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('monthly_jute_purchase_report') ?>" class="nav-link <?= active_nav('monthly_jute_purchase', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Monthly Jute Purchase</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('monthly_jute_sale_report') ?>" class="nav-link <?= active_nav('monthly_jute_sale', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Monthly Jute Sale</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('monthly_jute_issue_report') ?>" class="nav-link <?= active_nav('monthly_jute_issue', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Monthly Jute Issue</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('monthly_jute_purchase_payment_report') ?>" class="nav-link <?= active_nav('monthly_jute_purchase_payment_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Monthly Payment Amount</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('monthly_jute_sale_payment_report') ?>" class="nav-link <?= active_nav('monthly_jute_sale_payment_report', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Monthly Received Amount</p>
							</a>
						</li>
						<!-- <li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Level 2
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Level 3</p>
									</a>
								</li>
							</ul>
						</li> -->
						<!-- <li class="nav-item">
							<a href="<?php echo base_url('add_bank_branch') ?>" class="nav-link <?= active_nav('add_bank_branch', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Branch</p>
							</a>
						</li> -->
					</ul>
				</li>


				<!-- User Module -->
				<li class="nav-item has-treeview <?= active_open('user_control', $main_nav); ?>">
					<a href="#" class="nav-link <?= active_nav('user_control', $main_nav); ?>">

						<?php $forgotPasswordRequest = $this->Common->count_all_result('authority', ['a_status' => 2, 'a_forgot_password_status' => 1]); ?>
						<span class="badge btn-danger float-right mr-4 <?php echo (!empty($forgotPasswordRequest)) ? true : "d-none"; ?>"><?php if ($forgotPasswordRequest) {
																																				echo $forgotPasswordRequest;
																																			} ?></span>

						<i class="nav-icon fas fa-edit"></i>
						<p>
							User Control
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('add_new_user') ?>" class="nav-link <?= active_nav('add_new_user', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>List User</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_forgot_password_request') ?>" class="nav-link <?= active_nav('add_forgot_password_request', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>User Password Forgot </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url('add_invoice_approval') ?>" class="nav-link <?= active_nav('add_invoice_approval', $sub_nav); ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Invoice Approval Setup </p>
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




				<!-- End -->
			</ul>
		</nav>
	</div>
</aside>