<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Jute Purchase Order Reports</h1>
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
						<li class="breadcrumb-item active">Jute Purchase</li>
					</ol>
				</div>
			</div>
		</div>
	</section>


	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> Jute Purchase Order Reports</h3>
							<a href="<?php echo base_url('add_jute_purchase_order'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Purchase Order</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>SL.</th>
										<th>Date</th>
										<th>Due Date</th>
										<th>Financial Year</th>
										<th>Supplier</th>
										<?php foreach ($grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>KF</th>
										<th>WH</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($purchase_orders) {
										$serial = 0;
										foreach ($purchase_orders->result() as $list) {
											$serial++;
									?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->jpos_date)) ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->jpos_due_date)) ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($list->jpos_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_supplier->getSupplierById($list->jpos_s_id)->s_title ?></td>
												<?php
												//Mds
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td class="align-middle"><?php echo getJutePurchaseOrderValue($grade->j_g_id, $list->jpos_id); ?></td>
												<?php
													}
												}
												?>
												<td class="align-middle"><?= getJutePurchaseOrderValue('kf', $list->jpos_id); ?></td>
												<td class="align-middle"><?= getJutePurchaseOrderValue('wh', $list->jpos_id); ?></td>
												<td class="align-middle"><?= $list->jpos_total_mds ?></td>
												<td class="align-middle">
													<!-- <button class="btn btn-warning btn-sm">Edit</button> -->
													<a href="<?php echo base_url(); ?>setup/Purchase/viewPurchaseOrder?jpos_id=<?= $list->jpos_id ?>" class="btn btn-info btn-sm">View</a>
													<a href="<?php echo base_url(); ?>setup/Purchase/editPurchaseOrder?jpos_id=<?= $list->jpos_id ?>" class="btn btn-warning btn-sm">Edit</a>
													<a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Purchase/deleteJutePurchaseOrder?jpos_id=<?= $list->jpos_id ?>" class="btn btn-danger btn-sm">Delete</a>
												</td>
											</tr>
									<?php }
									} ?>
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