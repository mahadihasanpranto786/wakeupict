<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Jute Sale Quantity Report: <span class="text-success font-weight-bold"><?= date("F") ?></span></h1>
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
						<li class="breadcrumb-item active">Jute Sale Quantity Report</li>
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
							<h3 class="text-center">Grade Wise Jute Sale Quantity Report</h3>
							<h5 class="text-center"> Total Jute Sale Quantity Report </h5>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Date</th>
										<th>Financial Year</th>
										<th>Area</th>
										<?php foreach ($grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>KF-1</th>
										<th>WH-1</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($list) {
										foreach ($list->result() as $list) { ?>
											<tr>
												<td><?= date("d-m-Y", strtotime($list->jss_date)) ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($list->jss_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_area->getAreaById($list->jss_ar_id)->ar_title ?></td>
												<?php

												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
														<!-- <td><//?= getJuteSellWeightValue($grade->j_g_id, $list->jss_id); ?></td> -->
														<td>
															<?php $weight = getJuteSellWeightValue($grade->j_g_id, $list->jss_id);
															$rate = getJuteSellRateValue($grade->j_g_id, $list->jss_id);
															$amount = getJuteSellAmountValue($grade->j_g_id, $list->jss_id);
															echo number_format($weight, 2, '.', ''), " <span class='text-danger'>x</span> ", number_format($rate, 2, '.', ''), " <span class='text-danger'>=</span> ", number_format($amount, 2, '.', ''); ?>
														</td>
												<?php }
												} ?>
												<!-- KF -->
												<td>
													<?php $weight = getJuteSellWeightValue("kf", $list->jss_id);
													$rate = getJuteSellRateValue("kf", $list->jss_id);
													$amount = getJuteSellAmountValue("kf", $list->jss_id);
													echo number_format($weight, 2, '.', ''), " <span class='text-danger'>x</span> ", number_format($rate, 2, '.', ''), " <span class='text-danger'>=</span> ", number_format($amount, 2, '.', ''); ?>
												</td>
												<!-- WH -->
												<td>
													<?php $weight = getJuteSellWeightValue("wh", $list->jss_id);
													$rate = getJuteSellRateValue("wh", $list->jss_id);
													$amount = getJuteSellAmountValue("wh", $list->jss_id);
													echo number_format($weight, 2, '.', ''), " <span class='text-danger'>x</span> ", number_format($rate, 2, '.', ''), " <span class='text-danger'>=</span> ", number_format($amount, 2, '.', ''); ?>
												</td>
												<!-- Total -->
												<td><?= $list->jss_total_amount ?></td>
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