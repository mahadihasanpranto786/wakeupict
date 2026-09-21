<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>List Assorted Uncut Added Summary</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('add_assorted_uncut_added'); ?>">Add New Assorted Uncut Added</a></li>
						<li class="breadcrumb-item active">List Assorted Uncut Added Summary</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12"><?= alert_check() ?>
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> List Assorted Uncut Added Summary</h3>
							<a href="<?php echo base_url('add_assorted_uncut_added'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Assorted Uncut Added</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Date</th>
										<th>Financial year</th>
										<!-- <th>Lot No.</th> -->
										<th>Khamal No.</th>
										<th>Bojha No.</th>
										<th>Avg. Weight</th>
										<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>Total</th>
										<th>Comments</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($assortedUncutAddedSummary) {
										$serial = 0;
										foreach ($assortedUncutAddedSummary->result() as $summary) {
											$serial++; ?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($summary->kh_auc_a_s_date)) ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($summary->kh_auc_a_s_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_khamal->getKhamalById($summary->kh_auc_a_s_kh_id)->kh_title ?></td>
												<td class="align-middle"><?= $summary->kh_auc_a_s_bojha_no ?></td>
												<td class="align-middle"><?= $summary->kh_auc_a_s_avg_weight ?></td>
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
													<td class="align-middle">
														<?= getAssortedUncutAddedValue($grade->j_g_id, $summary->kh_auc_a_s_id); ?>
													</td>
												<?php } ?>
												<td class="align-middle"><?= $summary->kh_auc_a_s_total ?></td>
												<td class="align-middle"><?= $summary->kh_auc_a_s_comments ?></td>
												<td class="text-left py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="<?php echo base_url(''); ?>jute/Khamal/deleteAssortedUncutAdded?kh_auc_a_s_id=<?= $summary->kh_auc_a_s_id ?>" class="deleteBySweetAlert">
															<button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
																<i class="fa fa-trash"></i> Delete</button>
														</a>
														<a href="<?php echo base_url(''); ?>jute/Khamal/editAssortedUncutAdded?kh_auc_a_s_id=<?= $summary->kh_auc_a_s_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
													</div>
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
