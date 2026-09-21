<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Monthly Jute Issue Reports</h1>
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
									<h3 class="card-title"><i class="fas fa-th"></i> Monthly Grade Wise Issued Quantity ( Monds )</h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th style="width: 15%;"><i class="fas fa-th"></i></th>
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
											$start  = $month = strtotime('2021-07-01');
											$end = strtotime('2022-06-30');

											$startYear = date('Y', $start);
											$EndYear = date('Y', $end);

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
															$monthWiseMds = $this->M_jute_report->getMonthlyTotalJuteIssueMds($alpha_year, $alpha_month, $grade->j_g_id);
															if ($monthWiseMds) {
																echo round($monthWiseMds);
															} else {
																echo "<span class='text-danger'>0</span>";
															}
														} else if ($grade->j_g_id == 1) {
															$monthWiseMds = $this->M_jute_report->getMonthlyTotalJuteIssueMds($alpha_year, $alpha_month, $grade->j_g_id);
															if ($monthWiseMds) {
																echo round($monthWiseMds - $this->M_jute_report->getMonthlyTotalJuteIssueMdsKFWH($alpha_year, $alpha_month, 1, 4) - $this->M_jute_report->getMonthlyTotalJuteIssueMdsKFWH($alpha_year, $alpha_month, 1, 5));
															} else {
																echo "<span class='text-danger'>0</span>";
															}
														} else {
															echo 0;
														}

														?></td>
												<?php } ?>
												<!-- KF WH -->
												<td><?php $KFMV = $this->M_jute_report->getMonthlyTotalJuteIssueMdsKFWH($alpha_year, $alpha_month, 1, 4);
													if ($KFMV) {
														echo $KFMV;
													} else {
														echo "<span class='text-danger'>0</span>";
													}
													?></td>
												<td><?php $WHMV = $this->M_jute_report->getMonthlyTotalJuteIssueMdsKFWH($alpha_year, $alpha_month, 1, 5);
													if ($WHMV) {
														echo $WHMV;
													} else {
														echo "<span class='text-danger'>0</span>";
													}
													?></td>

												<td class="table-warning font-weight-bold">
													<?php
													$monthWiseSum = $this->M_jute_report->getMonthlyTotalJuteIssueMdsTotalMonthWise($alpha_year, $alpha_month);
													if ($monthWiseSum) {
														echo round($monthWiseSum);
													} else {
														echo "<span class='text-danger font-weight-bold'>0</span>";
													}
													?></td>
											<?php echo "</tr>";
											} ?>
											<!-- Total Sum -->
											<tr class="table-warning font-weight-bold">
												<td>Total</td>
												<?php if ($grades)
													foreach ($grades->result() as $grade) { ?>
													<td>
														<?php
														if ($grade->j_g_id != 1) {
															$gradeWiseSum = $this->M_jute_report->getMonthlyTotalJuteIssueMdsTotalGradeWIse($startYear, $EndYear, $grade->j_g_id);
															if ($gradeWiseSum) {
																echo round($gradeWiseSum);
															} else {
																echo "<span class='text-danger font-weight-bold'>0</span>";
															}
														} else if ($grade->j_g_id == 1) {
															$gradeWiseSum = $this->M_jute_report->getMonthlyTotalJuteIssueMdsTotalGradeWIse($startYear, $EndYear, $grade->j_g_id);
															if ($gradeWiseSum) {
																echo round($gradeWiseSum - $this->M_jute_report->getMonthlyTotalJuteIssueMdsTotalKFWH($startYear, $EndYear, 1, 4) - $this->M_jute_report->getMonthlyTotalJuteIssueMdsTotalKFWH($startYear, $EndYear, 1, 5));
															} else {
																echo "<span class='text-danger font-weight-bold'>0</span>";
															}
														} else {
															echo 0;
														}

														?></td>
												<?php } ?>

												<!-- KF Wh -->
												<td><?php $KFV = round($this->M_jute_report->getMonthlyTotalJuteIssueMdsTotalKFWH($startYear, $EndYear, 1, 4));
													if ($KFV) {
														echo $KFV;
													} else {
														echo "<span class='text-danger'>0</span>";
													}
													?></td>
												<td><?php $WFV = round($this->M_jute_report->getMonthlyTotalJuteIssueMdsTotalKFWH($startYear, $EndYear, 1, 5));
													if ($WFV) {
														echo $WFV;
													} else {
														echo "<span class='text-danger'>0</span>";
													}
													?></td>

												<td><?php echo round($this->M_jute_report->getMonthlyTotalJuteIssueMdsGrandTotal($startYear, $EndYear)); ?></td>
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