<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Adjustment</h1>
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
						<li class="breadcrumb-item active">Jute Adjustment</li>
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
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fas fa-th"></i> List Adjustment</h3>
							<a href="<?php echo base_url('add_adjustment') ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Adjustment</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= alert_check(); ?>
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>SL No</th>
										<th>Date</th>
										<th>Financial Year</th>
										<?php foreach ($grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>KF</th>
										<th>WH</th>
										<th>Total</th>
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
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->adjs_date)); ?></td>
												<td class="align-middle"><?php $fyYear = $this->M_financial_year->getFinancialYearById($list->adjs_fy_id);
																			if (!empty($fyYear)) {
																				echo $this->M_financial_year->getFinancialYearById($list->adjs_fy_id)->fy_title;
																			} else {
																				echo "No FY year Found";
																			}
																			?></td>

												<?php
												// Mds
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td class="align-middle"><?= getAdjustmentGradeValue($grade->j_g_id, $list->adjs_id) ?></td>
												<?php
													}
												}
												?>


												<td class="align-middle"><?= getAdjustmentGradeValue("kf", $list->adjs_id) ?></td>
												<td class="align-middle"><?= getAdjustmentGradeValue("wh", $list->adjs_id) ?></td>
												<td class="align-middle"><?= $list->adjs_total ?></td>
												<td class="align-middle">
													<a href="<?php echo base_url('') ?>setup/Adjustment/editAdjustment?adjs_id=<?= $list->adjs_id; ?>&&adjs_date=<?= $list->adjs_date; ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
													<a href="<?php echo base_url('') ?>setup/Adjustment/deleteAdjustment?adjs_id=<?= $list->adjs_id; ?>&&adjs_date=<?= $list->adjs_date; ?>" onclick="return confirm('Are you sure want to delete this item?');"><button class="btn btn-danger btn-sm" type="button" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</button></a>
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
