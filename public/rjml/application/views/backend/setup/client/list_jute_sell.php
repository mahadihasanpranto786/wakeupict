<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Jute Sell List</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php
																$current_user_type = $this->session->userdata('current_type');
																if ($current_user_type == 1) {
																	echo base_url('administration');
																} elseif ($current_user_type == 10) {
																	echo base_url('operator');
																} elseif ($current_user_type == 101) {
																	echo base_url('security_head');
																} elseif ($current_user_type == 102) {
																	echo base_url('security_operator');
																} elseif ($current_user_type == 201) {
																	echo base_url('weight_head');
																} elseif ($current_user_type == 202) {
																	echo base_url('weight_operator');
																} elseif ($current_user_type == 301) {
																	echo base_url('jute_head');
																} elseif ($current_user_type == 302) {
																	echo base_url('jute_operator');
																} elseif ($current_user_type == 401) {
																	echo base_url('accounts_head');
																} elseif ($current_user_type == 402) {
																	echo base_url('accounts_operator');
																} elseif ($current_user_type == 501) {
																	echo base_url('production_head');
																} elseif ($current_user_type == 502) {
																	echo base_url('production_operator');
																} elseif ($current_user_type == 601) {
																	echo base_url('gm');
																} elseif ($current_user_type == 602) {
																	echo base_url('shareholder');
																} elseif ($current_user_type == 603) {
																	echo base_url('system_administrator');
																} else {
																	$this->session->set_flashdata('login_failed', 'Credential Not match');
																	redirect('login', 'location');
																}
																?>">
								Home</a>
						</li>
						<li class="breadcrumb-item active"><a href="<?php echo base_url('add_jute_sell'); ?>">Add New Jute Sell</a></li>
						<li class="breadcrumb-item active">All Jute Sell List</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12"><?= alert_check() ?>
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title  mt-2"><i class="fas fa-th"></i> Jute Sell List</h3>
							<a href="<?php echo base_url('add_jute_sell'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Jute Sell</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Sl. No</th>
										<th>Date</th>
										<th>Financial Year</th>
										<th>Client Name</th>
										<th>Jute Variety</th>
										<th>Jute Area</th>
										<th>Total Weight</th>
										<th>Total Price</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($list) {
										$serial = 0;
										foreach ($list->result() as $list) {
											$serial++;
									?>
											<tr>
												<td class="align-middle"><?= $serial ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->jss_date)); ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($list->jss_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_client->getClientById($list->jss_c_id)->c_title ?></td>
												<td class="align-middle"><?= $list->jss_jute_variety ?></td>
												<td class="align-middle"><?= $this->M_area->getAreaById($list->jss_ar_id)->ar_title ?></td>
												<td class="align-middle"><?= $list->jss_total_weight ?> <span class="text-danger">Mds</span></td>
												<td class="align-middle"><?= number_format(($list->jss_total_amount), 2, '.', ',') ?></td>
												<td class="align-middle">
													<?php if ($list->jss_approve_status == 1) { ?>
														<a class='editbutton btn bg-info btn-sm mr-1' href="<?php echo base_url('') ?>setup/Client/viewJuteSellInvoice?jss_id=<?= $list->jss_id ?>">
															<i class='fas fa-eye'> View Invoice</i>
														</a>
														<button class="btn btn-success btn-sm" type="button"><i class="fas fa-check-circle"></i>Approved Success</button>
													<?php } elseif ($list->jss_approve_status == 0) { ?>
														<a class='editbutton btn bg-olive btn-sm' href="<?php echo base_url('') ?>setup/Client/viewJuteSellInvoice?jss_id=<?= $list->jss_id ?>">
															<i class='fas fa-eye'> View & Approve</i>
														</a>
														<a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url('') ?>setup/Client/deleteJuteSellSummary?jss_id=<?= $list->jss_id ?>"><button class="btn btn-danger btn-sm" type="button" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</button></a>
														<a href="<?php echo base_url('') ?>setup/Client/editJuteSell?jss_id=<?= $list->jss_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
													<?php } ?>
												</td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->