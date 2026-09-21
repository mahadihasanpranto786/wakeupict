<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1> Daily Jute Khamal Report
						<b style="color:#f6ca71;">
							<?php if ($kh_ac_a_v_date) {
								echo ": " . date("d-m-Y", strtotime($kh_ac_a_v_date));
							} ?>
						</b>
					</h1>
				</div>
				<div class="col-sm-6">
					<form role="form" action="<?php echo base_url('daily_jute_khamal_report') ?>" method="post">
						<div class="row justify-content-end">
							<div class="form-group row col-4">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Date</label>
								<div class="col-sm-8">
									<input type="text" name="kh_ac_a_v_date" id="kh_ac_a_v_date" class="form-control datepicker" style="width: 100px;" placeholder="" value='' required>
								</div>
							</div>
							<div class="form-group row col-4">
								<a href="" id="submit1"><button class="btn btn-info">
										Submit</button></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12"><?= alert_check() ?>
					<!-- 01 -->
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> List Unassorted Added Summary</h3>
							<a href="<?php echo base_url('list_unassorted_out_turn_report'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Unassorted Added</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Date</th>
										<th>Lot No</th>
										<th>Khamal No.</th>
										<th>Bojha No.</th>
										<th>Net Weight</th>
										<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>Total</th>
										<th>Comments</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($unaaddedSummary) {
										$serial = 0;
										foreach ($unaaddedSummary->result() as $summary) {
											$serial++; ?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($summary->kh_ua_a_s_en_date)) ?></td>
												<td class="align-middle"><?= $this->M_jute_entry->getJuteOutTurnSummaryById($summary->kh_ua_a_s_ot_id)->ot_lot_no ?></td>
												<td class="align-middle">
													<?php if ($summary->kh_ua_a_s_status == 1) {
														echo $this->M_khamal->getKhamalById($summary->kh_ua_a_s_kh_id)->kh_title;
													} ?>
												</td>
												<td class="align-middle"><?php if ($summary->kh_ua_a_s_status == 1) {
																				echo $summary->kh_ua_a_s_ot_rec_bojha_no;
																			} ?></td>
												<td class="align-middle"><?php if ($summary->kh_ua_a_s_status == 1) {
																				echo number_format($summary->kh_ua_a_s_net_weight, 2, '.', ',');
																			} ?></td>
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
													<td>
														<?php if ($summary->kh_ua_a_s_status == 1) {
															echo getUnassortedAddedValue($grade->j_g_id, $summary->kh_ua_a_s_id);
														} ?>
													</td>
												<?php } ?>
												<td class="align-middle"><?php if ($summary->kh_ua_a_s_status == 1) {
																				echo $summary->kh_ua_a_s_total;
																			} ?></td>
												<td class="align-middle"><?php if ($summary->kh_ua_a_s_status == 1) {
																				echo $summary->kh_ua_a_s_comments;
																			} ?></td>
												<td class="">
													<!-- <a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url(''); ?>jute/Khamal/deleteUnAssortedAdded?kh_ua_a_s_id=<?= $summary->kh_ua_a_s_id ?>">
                                                            <button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
                                                                <i class="fa fa-trash"></i> Delete</button>
                                                        </a> -->
													<a href="<?php echo base_url('jute/Khamal/deleteUnAssortedAdded?') ?>kh_ua_a_s_id=<?= $summary->kh_ua_a_s_id; ?>" type='button' id="" class='btn btn-danger btn-sm mr-1 mb-2 rounded deleteBySweetAlert'>
														<i class="fas fa-trash"></i>
														Delete
													</a>
													<?php if ($summary->kh_ua_a_s_status == 1) { ?>
														<a href="<?php echo base_url(''); ?>jute/Khamal/editUnAssortedAdded?kh_ua_a_s_id=<?= $summary->kh_ua_a_s_id ?>&kh_ua_a_s_ot_id=<?= $summary->kh_ua_a_s_ot_id ?>"><button class="btn btn-warning btn-sm mr-1 mb-2 rounded" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
													<?php } ?>
											</tr>
									<?php }
									} ?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- 02 -->
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> List Unassorted Deduction Summary</h3>
							<a href="<?php echo base_url('add_unassorted_deduction'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Unassorted Deduction</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Date</th>
										<th>Financial Year</th>
										<!-- <th>Lot No.</th> -->
										<th>Khamal No.</th>
										<th>Bojha No.</th>
										<th>Net Weight</th>
										<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>Total</th>
										<th>Comments</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($unaDeductionSummary) {
										$serial = 0;
										foreach ($unaDeductionSummary->result() as $summary) {
											$serial++; ?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($summary->kh_ua_d_s_date)) ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($summary->kh_ua_d_s_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_khamal->getKhamalById($summary->kh_ua_d_s_kh_id)->kh_title ?></td>
												<td class="align-middle"><?= $summary->kh_ua_d_s_bojha_no ?></td>
												<td class="align-middle"><?= $summary->kh_ua_d_s_avg_weight ?></td>
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
													<td>
														<?= getUnassortedDeductionValue($grade->j_g_id, $summary->kh_ua_d_s_id); ?>
													</td>
												<?php } ?>
												<td class="align-middle"><?= $summary->kh_ua_d_s_total ?></td>
												<td class="align-middle"><?= $summary->kh_ua_d_s_comments ?></td>
												<td class="text-left py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="<?php echo base_url(''); ?>jute/Khamal/deleteUnAssortedDeduction?kh_ua_d_s_id=<?= $summary->kh_ua_d_s_id ?>" class="deleteBySweetAlert">
															<button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
																<i class="fa fa-trash"></i> Delete</button>
														</a>
														<a href="<?php echo base_url(''); ?>jute/Khamal/editUnAssortedDeduction?kh_ua_d_s_id=<?= $summary->kh_ua_d_s_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
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
					<!-- 03 -->
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
					<!--04 -->
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> List Assorted Uncut Deduction Summary</h3>
							<a href="<?php echo base_url('add_assorted_uncut_deduction'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Assorted Uncut Deduction</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= alert_check() ?>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Date</th>
										<th>Financial Year</th>
										<!-- <th>Lot No.</th> -->
										<th>Khamal No.</th>
										<th>Bojha No.</th>
										<th>Net Weight</th>
										<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>Total</th>
										<th>Comments</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($assortedUncutDeductionSummary) {
										$serial = 0;
										foreach ($assortedUncutDeductionSummary->result() as $summary) {
											$serial++; ?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($summary->kh_auc_d_s_date)) ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($summary->kh_auc_d_s_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_khamal->getKhamalById($summary->kh_auc_d_s_kh_id)->kh_title ?></td>
												<td class="align-middle"><?= $summary->kh_auc_d_s_bojha_no ?></td>
												<td class="align-middle"><?= $summary->kh_auc_d_s_avg_weight ?></td>
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
													<td>
														<?= getAssortedUncutDeductionValue($grade->j_g_id, $summary->kh_auc_d_s_id); ?>
													</td>
												<?php } ?>
												<td class="align-middle"><?= $summary->kh_auc_d_s_total ?></td>
												<td class="align-middle"><?= $summary->kh_auc_d_s_comments ?></td>
												<td class="text-left py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="<?php echo base_url(''); ?>jute/Khamal/deleteAssortedUncutDeduction?kh_auc_d_s_id=<?= $summary->kh_auc_d_s_id ?>" class="deleteBySweetAlert">
															<button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
																<i class="fa fa-trash"></i> Delete</button>
														</a>
														<a href="<?php echo base_url(''); ?>jute/Khamal/editAssortedUncutDeduction?kh_auc_d_s_id=<?= $summary->kh_auc_d_s_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
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
					<!-- 05 -->
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> List Assorted Cut Added Summary</h3>
							<a href="<?php echo base_url('add_assorted_cut_added'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Assorted Cut Added</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Date</th>
										<th>Financial Year</th>
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
									<?php if ($assortedCutAddedSummary) {
										$serial = 0;
										foreach ($assortedCutAddedSummary->result() as $summary) {
											$serial++; ?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($summary->kh_ac_a_s_date)) ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($summary->kh_ac_a_s_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_khamal->getKhamalById($summary->kh_ac_a_s_kh_id)->kh_title ?></td>
												<td class="align-middle"><?= $summary->kh_ac_a_s_bojha_no ?></td>
												<td class="align-middle"><?= $summary->kh_ac_a_s_avg_weight ?></td>
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
													<td>
														<?= getAssortedCutAddedValue($grade->j_g_id, $summary->kh_ac_a_s_id); ?>
													</td>
												<?php } ?>
												<td class="align-middle"><?= $summary->kh_ac_a_s_total ?></td>
												<td class="align-middle"><?= $summary->kh_ac_a_s_comments ?></td>
												<td class="text-left py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="<?php echo base_url(''); ?>jute/Khamal/deleteAssortedCutAdded?kh_ac_a_s_id=<?= $summary->kh_ac_a_s_id ?>" class="deleteBySweetAlert">
															<button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
																<i class="fa fa-trash"></i> Delete</button>
														</a>
														<a href="<?php echo base_url(''); ?>jute/Khamal/editAssortedCutAdded?kh_ac_a_s_id=<?= $summary->kh_ac_a_s_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
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
					<!-- 06 -->
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> List Assorted Cut Deduction Summary
							</h3>
							<a href="<?php echo base_url('add_assorted_cut_deduction'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New
									Assorted Cut Deduction</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Date</th>
										<th>Financial Year</th>
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
									<?php if ($assortedCutDeductionSummary) {
										$serial = 0;
										foreach ($assortedCutDeductionSummary->result() as $summary) {
											$serial++; ?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle">
													<?= date("d-m-Y", strtotime($summary->kh_ac_d_s_date)) ?></td>
												<td class="align-middle">
													<?= $this->M_financial_year->getFinancialYearById($summary->kh_ac_d_s_fy_id)->fy_title ?>
												</td>
												<td class="align-middle">
													<?= $this->M_khamal->getKhamalById($summary->kh_ac_d_s_kh_id)->kh_title ?>
												</td>
												<td class="align-middle"><?= $summary->kh_ac_d_s_bojha_no ?></td>
												<td class="align-middle"><?= $summary->kh_ac_d_s_avg_weight ?></td>
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) {
												?>
													<td>
														<?= getAssortedCutDeductionValue($grade->j_g_id, $summary->kh_ac_d_s_id); ?>
													</td>
												<?php }
												?>
												<td class="align-middle"><?= $summary->kh_ac_d_s_total ?></td>
												<td class="align-middle"><?= $summary->kh_ac_d_s_comments ?></td>
												<td class="text-left py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a href="<?php echo base_url(''); ?>jute/Khamal/deleteAssortedCutDeduction?kh_ac_d_s_id=<?= $summary->kh_ac_d_s_id ?>" class="deleteBySweetAlert">
															<button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
																<i class="fa fa-trash"></i> Delete</button>
														</a>
														<a href="<?php echo base_url(''); ?>jute/Khamal/editAssortedCutDeduction?kh_ac_d_s_id=<?= $summary->kh_ac_d_s_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i>
																Edit</button></a>
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