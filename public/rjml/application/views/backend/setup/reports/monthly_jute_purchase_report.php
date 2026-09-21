<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Monthly Grade Wise Actual Purchased Quantity Reports</h1>
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
						<li class="breadcrumb-item active">Jute Grade</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Monthly Purchased Quantity as per Out Turn ( Mds.)</h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th><i class="fas fa-th"></i></th>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<th><?= $grade->j_g_title ?></th>
												<?php } ?>
												<th>KF-D1</th>
												<th>WH-D1</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$start = $month = strtotime('2021-07-01');
											$end = strtotime('2022-06-30');

											$startYear = date('Y', $start);
											$endYear = date('Y', $end);

											while ($month < $end) {
												echo "<tr>";
												echo "<td class='text-left font-weight-bold'>";
												echo $date = date('F Y', $month), PHP_EOL;
												$month = strtotime("+1 month", $month);
												$alpha_year = date('Y', strtotime($date));
												$alpha_month = date('m', strtotime($date));
												echo "</td>"; ?>

												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td>
														<?php
														if ($grade->j_g_id != 1) {
															$monthWiseMds = $this->M_jute_report->getMonthlyTotalJutePurchaseMds($alpha_year, $alpha_month, $grade->j_g_id);
															if ($monthWiseMds) {
																echo round($monthWiseMds);
															} else {
																echo "<span class='text-danger'>0</span>";
															}
														} else if ($grade->j_g_id == 1) {
															$monthWiseMds = $this->M_jute_report->getMonthlyTotalJutePurchaseMds($alpha_year, $alpha_month, $grade->j_g_id);
															if ($monthWiseMds) {
																echo round($monthWiseMds - $this->M_jute_report->getMonthlyTotalJutePurchaseMdsKFWH($alpha_year, $alpha_month, 1, 4) - $this->M_jute_report->getMonthlyTotalJutePurchaseMdsKFWH($alpha_year, $alpha_month, 1, 5));
															} else {
																echo "<span class='text-danger'>0</span>";
															}
														} else {
															echo 0;
														}
														?>
													</td>
												<?php } ?>
												<!-- KF WH -->
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseMdsKFWH($alpha_year, $alpha_month, 1, 4)); ?></td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseMdsKFWH($alpha_year, $alpha_month, 1, 5)); ?></td>
												<td class="table-warning font-weight-bold">
													<?php $monthMDs = $this->M_jute_report->getMonthlyTotalJutePurchaseMdsMonthWise($alpha_year, $alpha_month);
													if ($monthMDs) {
														echo round($monthMDs);
													} else {
														echo 0;
													}
													?></td>
											<?php echo "</tr>";
											} ?>
											<!-- Total Sum -->
											<tr class="table-warning font-weight-bold">
												<td><span class="font-weight-bold">TOTAL</span></td>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td>
														<?php
														if ($grade->j_g_id != 1) {
															$yearGrade = $this->M_jute_report->getMonthlyTotalJutePurchaseMdsGradeWise($startYear, $endYear, $grade->j_g_id);
															if ($yearGrade) {
																echo round($yearGrade);
															} else {
																echo 0;
															}
														} else if ($grade->j_g_id == 1) {
															$yearGrade = $this->M_jute_report->getMonthlyTotalJutePurchaseMdsGradeWise($startYear, $endYear, $grade->j_g_id);
															if ($yearGrade) {
																echo round($yearGrade - $this->M_jute_report->getMonthlyTotalJutePurchaseMdsTotalKFWH($startYear, $endYear, 1, 4) - $this->M_jute_report->getMonthlyTotalJutePurchaseMdsTotalKFWH($startYear, $endYear, 1, 5));
															} else {
																echo 0;
															}
														}

														?>
													</td>
												<?php } ?>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseMdsTotalKFWH($startYear, $endYear, 1, 4)); ?></td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseMdsTotalKFWH($startYear, $endYear, 1, 5)); ?></td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseMdsGrandTotal($startYear, $endYear)); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>










	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-9">
					<div class="card card-info">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Monthly Purchased Amount as per Quality ( Taka) </h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th><i class="fas fa-th"></i></th>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<th><?= $grade->j_g_title ?></th>
												<?php } ?>
												<th>KF-D1</th>
												<th>WH-D1</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$start = $month = strtotime('2021-07-01');
											$end = strtotime('2022-06-30');

											$startYear = date('Y', $start);
											$endYear = date('Y', $end);

											while ($month < $end) {
												echo "<tr>";
												echo "<td class='text-left font-weight-bold'>";
												echo $date = date('F Y', $month), PHP_EOL;
												$month = strtotime("+1 month", $month);
												$alpha_year = date('Y', strtotime($date));
												$alpha_month = date('m', strtotime($date));
												echo "</td>"; ?>

												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td><?php
														if ($grade->j_g_id != 1) {
															$monthWiseAmount = $this->M_jute_report->getMonthlyTotalJutePurchaseAmount($alpha_year, $alpha_month, $grade->j_g_id);
															if ($monthWiseAmount) {
																echo round($monthWiseAmount);
															} else {
																echo "<span class='text-danger'>0</span>";
															}
														} else if ($grade->j_g_id == 1) {
															$monthWiseAmount = $this->M_jute_report->getMonthlyTotalJutePurchaseAmount($alpha_year, $alpha_month, $grade->j_g_id);
															if ($monthWiseAmount) {
																echo round($monthWiseAmount - $this->M_jute_report->getMonthlyTotalJutePurchaseAmountKFWH($alpha_year, $alpha_month, 1, 4) - $this->M_jute_report->getMonthlyTotalJutePurchaseAmountKFWH($alpha_year, $alpha_month, 1, 5));
															} else {
																echo "<span class='text-danger'>0</span>";
															}
														} else {
															echo 0;
														}

														?></td>
												<?php } ?>
												<!-- KF WH -->
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseAmountKFWH($alpha_year, $alpha_month, 1, 4)); ?></td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseAmountKFWH($alpha_year, $alpha_month, 1, 5)); ?></td>
												<td class="table-warning font-weight-bold">
													<?php $monthTaka = $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTakaMonthWise($alpha_year, $alpha_month);
													if ($monthTaka) {
														echo round($monthTaka);
													} else {
														echo 0;
													}
													?></td>
											<?php echo "</tr>";
											} ?>
											<!-- Total Sum -->
											<tr class="table-warning font-weight-bold">
												<td><span class="font-weight-bold">Total</span></td>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td>
														<?php

														if ($grade->j_g_id != 1) {
															$yearGradeTaka = $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTakaGradeWise($startYear, $endYear, $grade->j_g_id);
															if ($yearGradeTaka) {
																echo round($yearGradeTaka);
															} else {
																echo 0;
															}
														} else if ($grade->j_g_id == 1) {
															$yearGradeTaka = $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTakaGradeWise($startYear, $endYear, $grade->j_g_id);
															if ($yearGradeTaka) {
																echo round($yearGradeTaka - $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTotalKFWH($startYear, $endYear, 1, 4) - $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTotalKFWH($startYear, $endYear, 1, 5));
															} else {
																echo 0;
															}
														} else {
															echo 0;
														}
														?>
													</td>
												<?php } ?>
												<!-- KF WH -->
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseAmountTotalKFWH($startYear, $endYear, 1, 4)); ?></td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseAmountTotalKFWH($startYear, $endYear, 1, 5)); ?></td>

												<td class="table-warning font-weight-bold">
													<?php $GrandTotalTaka = $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTakaGrandTotal($startYear, $endYear);
													if ($GrandTotalTaka) {
														echo round($GrandTotalTaka);
													} else {
														echo 0;
													}
													?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>



				<!-- Month Wise Provision -->
				<div class="col-md-3">
					<div class="card card-secondary">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Month Wise 2% Provision (Amount)</h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th width="50%"><i class="fas fa-th"></i></th>
												<th width="50%">Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$start = $month = strtotime('2021-07-01');
											$end = strtotime('2022-06-30');

											$startYear = date('Y', $start);
											$endYear = date('Y', $end);

											while ($month < $end) {
												echo "<tr>";
												echo "<td class='text-left font-weight-bold'>";
												echo $date = date('F Y', $month), PHP_EOL;
												$month = strtotime("+1 month", $month);
												$alpha_year = date('Y', strtotime($date));
												$alpha_month = date('m', strtotime($date));
												echo "</td>"; ?>

												<td><?php $monthWiseMds = $this->M_jute_report->getMonthlyTotalJuteProvisionAmount($alpha_year, $alpha_month);
													if ($monthWiseMds) {
														echo round($monthWiseMds);
													} else {
														echo "<span class='text-danger'>0</span>";
													}
													?></td>
											<?php echo "</tr>";
											} ?>
											<!-- Total Sum -->
											<tr class="table-warning font-weight-bold">
												<td>TOTAL</td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotal($startYear, $endYear)); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
	</section>


	<!-- Grade Wise Bad Provision -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-9">
					<div class="card card-secondary">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> After 2% Provision ( Taka) </h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th><i class="fas fa-th"></i></th>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<th><?= $grade->j_g_title ?></th>
												<?php } ?>
												<th>KF-D1</th>
												<th>WH-D1</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<tr class="table-warning font-weight-bold">
												<td><span class="font-weight-bold">Total</span></td>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td> <?php
															if ($grade->j_g_id != 1) {
																$yearGradeTaka = $this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotalGradeWise($startYear, $endYear, $grade->j_g_id);
																if ($yearGradeTaka) {
																	echo round($yearGradeTaka);
																} else {
																	echo 0;
																}
															} else if ($grade->j_g_id == 1) {
																$yearGradeTaka = $this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotalGradeWise($startYear, $endYear, $grade->j_g_id);
																if ($yearGradeTaka) {
																	echo round($yearGradeTaka - $this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotalGradeWiseKFWH($startYear, $endYear, 1, 4) - $this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotalGradeWiseKFWH($startYear, $endYear, 1, 5));
																} else {
																	echo 0;
																}
															}

															?>
													</td>
												<?php } ?>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotalGradeWiseKFWH($startYear, $endYear, 1, 4)); ?></td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotalGradeWiseKFWH($startYear, $endYear, 1, 5)); ?></td>
												<td class="table-warning font-weight-bold">
													<?php $GrandTotalTaka = $this->M_jute_report->getMonthlyTotalJuteProvisionAmountTotal($startYear, $endYear);
													if ($GrandTotalTaka) {
														echo round($GrandTotalTaka);
													} else {
														echo 0;
													}
													?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>





	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-olive">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Monthly Purchased As Per Out Turn %</h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th><i class="fas fa-th"></i></th>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<th><?= $grade->j_g_title ?> (<span class="text-danger">%</span>) </th>
												<?php } ?>
												<th>Total (<span class="text-danger">Mds</span>)</th>
												<th>Total (<span class="text-danger">Amount</span>)</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$start = $month = strtotime('2021-07-01');
											$end = strtotime('2022-06-30');

											$startYear = date('Y', $start);
											$endYear = date('Y', $end);

											while ($month < $end) {
												echo "<tr>";
												echo "<td class='text-left font-weight-bold'>";
												echo $date = date('F Y', $month), PHP_EOL;
												$month = strtotime("+1 month", $month);
												$alpha_year = date('Y', strtotime($date));
												$alpha_month = date('m', strtotime($date));
												echo "</td>"; ?>

												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td><?php $percentage = $this->M_jute_report->getMonthlyTotalJutePurchaseOutTurnPercentage($alpha_year, $alpha_month, $grade->j_g_id);
														$perTotal = $this->M_jute_report->getMonthlyTotalJutePurchaseOutTurnPercentageTotal($alpha_year, $alpha_month);
														if ($perTotal) {
															$lamra = ($percentage * 100) / $perTotal;
															if ($lamra) {
																echo round($lamra);
															} else {
																echo "<span class='text-danger'>0</span>";
															}
														} else {
															echo "<span class='text-danger'>0</span>";
														}
														?>
													</td>
												<?php } ?>
												<td class="table-warning font-weight-bold">
													<?php $monthMDs = $this->M_jute_report->getMonthlyTotalJutePurchaseMdsMonthWise($alpha_year, $alpha_month);
													if ($monthMDs) {
														echo round($monthMDs);
													} else {
														echo 0;
													}
													?></td>
												<td class="table-warning font-weight-bold">
													<?php $monthTaka = $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTakaMonthWise($alpha_year, $alpha_month);
													if ($monthTaka) {
														echo round($monthTaka);
													} else {
														echo 0;
													}
													?></td>
											<?php echo "</tr>";
											} ?>
											<!-- Total Sum -->
											<tr class="table-warning font-weight-bold">
												<td>TOTAL</td>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td></td>
												<?php } ?>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalJutePurchaseMdsGrandTotal($startYear, $endYear)); ?></td>
												<td>
													<?php $GrandTotalTaka = $this->M_jute_report->getMonthlyTotalJutePurchaseAmountTakaGrandTotal($startYear, $endYear);
													if ($GrandTotalTaka) {
														echo round($GrandTotalTaka);
													} else {
														echo 0;
													}
													?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>