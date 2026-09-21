<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Total Issued Quantity</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('add_daily_requisition'); ?>">Add New Requisition</a></li>
						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_daily_requisition'); ?>">Go to Requisition Summary</a></li>
						<li class="breadcrumb-item active">Total Issued Quantity</li>
					</ol>
				</div>
			</div>
		</div>
	</section>


	<!-- =============  Daily Grade Wise Jute Issue & Sale ============= -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="text-center"> Daily Grade Wise <span>Jute Issue & Sale</span> </h3>
							<h5 class="text-center">Total Issued Quantity (Mds) From Project Godown</h5>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Date</th>
										<?php foreach ($jute_grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>KF-1</th>
										<th>WH-1</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($issuesSummary) {
										foreach ($issuesSummary->result() as $list) { ?>
											<tr>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->iss_date)) ?></td>
												<?php foreach ($jute_grades->result() as $grade) { ?>
													<td>
														<?php $totalGradeValue = 0;
														foreach ($areas->result() as $area) {
															if ($area->ar_id == 1 || $area->ar_id == 2 || $area->ar_id == 3) { ?>
																<?php
																$totalGradeValue += initialZero(getTotalIssuedValue($grade->j_g_id, $area->ar_id, $list->iss_id));
																?>
														<?php }
														}
														echo $totalGradeValue;
														?>
													</td>
												<?php } ?>
												<!-- Date wise total -->
												<td>
													<?= initialZero(getTotalIssuedValue(1, 4, $list->iss_id)) ?>
												</td>
												<td><?= initialZero(getTotalIssuedValue("1", "5", $list->iss_id)) ?></td>
												<td><?= $list->iss_total_issue ?></td>
											</tr>
									<?php }
									} ?>
									<tr class="table-warning">
										<td>Total</td>
										<!-- Grade wise total -->
										<?php foreach ($jute_grades->result() as $grade) { ?>
											<td></td>
										<?php } ?>
										<td></td>
										<td></td>
										<td></td>
									</tr>
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



	<!-- =========================  Daily Area Wise Jute Issue & Sale ========================= -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-olive mt-3">
						<div class="card-header">
							<h3 class="text-center"> Daily Area Wise <span>Jute Issue & Sale</span> </h3>
							<h5 class="text-center">Total Issued Quantity (Mds) From Project Godown</h5>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div style="overflow-x:auto;">

								<table id="" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th rowspan="2" class="align-middle">Date</th>
											<?php foreach ($areas->result() as $area) { ?>
												<th colspan="7" class="text-center"><?= $area->ar_title ?></th>
											<?php } ?>
											<th class="align-middle" rowspan="2">Total</th>
										</tr>
										<tr>
											<?php foreach ($areas->result() as $area) { ?>
												<?php foreach ($jute_grades->result() as $grade) { ?>
													<th class="align-middle"><?= $grade->j_g_title ?></th>
												<?php } ?>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php if ($issuesSummary) {
											foreach ($issuesSummary->result() as $list) { ?>
												<tr>
													<td class="align-middle"><?= date("d-m-Y", strtotime($list->iss_date)); ?></td>
													<?php foreach ($areas->result() as $area) { ?>

														<?php foreach ($jute_grades->result() as $grade) { ?>
															<td class="align-middle">
																<?php echo getTotalIssuedValue($grade->j_g_id, $area->ar_id, $list->iss_id);


																?>

															</td>
														<?php } ?>
													<?php } ?>
													<td class="align-middle"><?= $list->iss_total_issue ?></td>
												</tr>
										<?php }
										} ?>
										<tr class="table-warning">
											<td>Total</td>
											<!-- Area wise total -->
											<?php foreach ($areas->result() as $area) { ?>
												<?php foreach ($jute_grades->result() as $grade) { ?>
													<td></td>
												<?php } ?>
											<?php } ?>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
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



	<!-- End -->
</div>
<!-- /.content-wrapper -->