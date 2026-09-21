<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>List Opening Khamal Balance</h1>
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
						<?php
						$current_user_type = $this->session->userdata('current_type');
						$seePeople = array(1, 10, 402, 603);
						if (in_array($current_user_type, $seePeople)) {
						?>
							<li class="breadcrumb-item active"><a href="<?php echo base_url('add_opening_khamal'); ?>">Add New Opening Khamal</a></li>
						<?php
						}
						?>
						<li class="breadcrumb-item active">List Opening Khamal Balance</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fas fa-th"></i> List Opening Khamal Balance</h3>
							<?php
							$current_user_type = $this->session->userdata('current_type');
							$seePeople = array(1, 10, 402, 603);
							if (in_array($current_user_type, $seePeople)) {
							?>
								<a href="<?php echo base_url('add_opening_khamal'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Opening Khamal</button></a>
							<?php
							}
							?>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= alert_check() ?>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Fy. Year</th>
										<th>Date</th>
										<th>Khamal No.</th>
										<th>Total Bojha</th>
										<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>KF</th>
										<th>WH</th>
										<th>Total</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($opSummary) {
										$serial = 0;
										foreach ($opSummary->result() as $summary) {
											$serial++; ?>
											<tr>
												<td class="align-middle"><?= $serial; ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($summary->opskh_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($summary->opskh_date)); ?></td>
												<td class="align-middle"><?= $this->M_khamal->getKhamalById($summary->opskh_kh_id)->kh_title; ?></td>
												<td class="align-middle"><?= $summary->opskh_bojha ?></td>
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
													<td>
														<?= getOpeningKhamalValue($grade->j_g_id, $summary->opskh_id); ?>
													</td>
												<?php } ?>
												<td class="align-middle"><?= getOpeningKhamalValue("kf", $summary->opskh_id); ?></td>
												<td class="align-middle"><?= getOpeningKhamalValue("wh", $summary->opskh_id); ?></td>
												<td class="align-middle"><?= $summary->opskh_total ?></td>
												<td class="text-left py-0 align-middle">
													<?php
													$current_user_type = $this->session->userdata('current_type');
													$seePeople = array(1, 10, 402, 603);
													if (in_array($current_user_type, $seePeople)) {
													?>
														<div class="btn-group btn-group-sm">
															<a href="<?php echo base_url(''); ?>jute/Khamal/deleteOpeningKhamal?opskh_id=<?= $summary->opskh_id ?>" class="deleteBySweetAlert">
																<button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
																	<i class="fa fa-trash"></i> Delete</button>
															</a>
															<a href="<?php echo base_url(''); ?>jute/Khamal/editOpeningKhamal?opskh_id=<?= $summary->opskh_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
														</div>
													<?php
													}
													?>
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