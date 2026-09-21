 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Main content -->
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-12">
 					<div class="card card-default mt-3">
 						<!-- <div class="card-header">
							<h3 class="card-title"> </h3>
						</div> -->
 						<!-- /.card-header -->
 						<!-- form start -->
 						<div class="card-body">

 							<form role="form" action="<?php echo base_url('godown_reports') ?>" method="post">
 								<div class="row">
 									<div class="col-sm-7">
 										<h3 class="text-success">Jute Purchase, Issue & Stock Report:
 											<?php $dateObj   = DateTime::createFromFormat('!m', $m);
												echo $monthName = $dateObj->format('F') . " , " . $y; ?> </h3>
 									</div>
 									<div class="form-group col-sm-2">
 										<label>Year</label>
 										<select class="form-control select2 year" style="width: 100%;" name="y" required>
 											<option value="">Select Year</option>
 											<?php foreach (get_all_year() as $year) { ?>
 												<option value="<?= $year ?>"> <?= $year ?></option>
 											<?php } ?>
 										</select>
 									</div>
 									<div class="form-group col-sm-2">
 										<label>Month</label>
 										<select class="form-control select2 month" id="month" style="width: 100%;" name="m" required>
 											<option value="">Select Month</option>
 											<option value="01">January</option>
 											<option value="02">February</option>
 											<option value="03">March</option>
 											<option value="04">April</option>
 											<option value="05">May</option>
 											<option value="06">June</option>
 											<option value="07">July</option>
 											<option value="08">August</option>
 											<option value="09">September</option>
 											<option value="10">October</option>
 											<option value="11">November</option>
 											<option value="12">December</option>
 										</select>
 									</div>
 									<div class="col-sm-1">
 										<a href="" id="submit1"><button class="btn btn-info float-right mt-4">
 												Submit</button></a>
 									</div>
 								</div>
 							</form>
 							<div class="row">
 								<!-- Table -->
 								<table id="" class="table table-bordered">
 									<thead>
 										<tr>
 											<th colspan="2" class="text-center">Particulars</th>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
 													<th class="text-center"><?= $grade->j_g_title ?></th>
 											<?php
													}
												}
												?>
 											<th>KF-D1</th>
 											<th>WH-D1</th>
 											<th>TOTAL</th>
 										</tr>
 									</thead>
 									<tbody>
 										<!-- Opening Pacca Jute -->
 										<tr style="background-color:#f6ca71">
 											<td rowspan="3" class="align-middle text-center" style="">
 												<b>Opening </b><br> Pacca Jute
 											</td>
 											<td>Opening Quantity Monds</td>
 											<?php
												// Mds
												if ($grades) {
													$totalOpeningMds = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php echo number_format($openingMds[$g] = monthlyOpeningValue($grade->j_g_id, 'opv_mds', $m, $y, $fy_id), 2, '.', '');
															$totalOpeningMds += $openingMds[$g];
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($kfOpeningMds = monthlyOpeningValue('kf', 'opv_mds', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($whOpeningMds = monthlyOpeningValue('wh', 'opv_mds', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($grandTotalOpeningMds = $totalOpeningMds + $kfOpeningMds + $whOpeningMds, 2, '.', '') ?>
 											</td>
 										</tr>
 										<!-- START To get Average Opening amount -->
 										<?php

											if ($grades) {
												$totalOpeningAmount = 0;
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													number_format($openingAmount[$g] = monthlyOpeningValue($grade->j_g_id, 'opv_amount', $m, $y, $fy_id), 2, '.', '');
													$totalOpeningAmount += $openingAmount[$g];
												}
											}
											$kfOpeningAmount = monthlyOpeningValue('kf', 'opv_amount', $m, $y, $fy_id);
											$whOpeningAmount = monthlyOpeningValue('wh', 'opv_amount', $m, $y, $fy_id);
											$grandTotalOpeningAmount = $totalOpeningAmount + $kfOpeningAmount + $whOpeningAmount;
											?>
 										<!-- End To get Average Opening amount -->

 										<tr style="background-color:#f6ca71">
 											<td>Opening Average Rate</td>
 											<?php
												// Average
												if ($grades) {
													$i = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?php echo number_format($openingAve[$g] = monthlyOpeningValue($grade->j_g_id, 'opv_ave', $m, $y, $fy_id), 2, '.', '');
															$i++ ?></td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($kfOpeningAve = monthlyOpeningValue('kf', 'opv_ave', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($whOpeningAve = monthlyOpeningValue('wh', 'opv_ave', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td>
 												<?php
													if ($grandTotalOpeningAmount != 0) {
														echo number_format($grandTotalOpeningAve = $grandTotalOpeningAmount / $grandTotalOpeningMds, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?>
 											</td>
 										</tr>
 										<tr style="background-color:#f6ca71">
 											<td>Opening Amount</td>
 											<?php
												// Mds
												if ($grades) {
													$i = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?php echo number_format($openingAmount[$g] = monthlyOpeningValue($grade->j_g_id, 'opv_amount', $m, $y, $fy_id), 2, '.', '');
															$i++ ?></td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($kfOpeningAmount = monthlyOpeningValue('kf', 'opv_amount', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($whOpeningAmount = monthlyOpeningValue('wh', 'opv_amount', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($grandTotalOpeningAmount, 2, '.', '') ?></td>
 										</tr>
 										<tr class="faka">
 											<td></td>
 											<td></td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) { ?>
 													<td></td>
 											<?php
													}
												}
												?>
 											<td></td>
 											<td></td>
 											<td></td>
 										</tr>
 										<!-- Actual Purchased Avg. Rate -->
 										<?php
											//Getting MDS
											if ($grades) {
												$totalPurchaseMds = 0;
												$kf = 0;
												$wh = 0;
												$this->session->set_userdata('kf', $kf);
												$this->session->set_userdata('wh', $wh);
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$purchaseMds[$g] = currentMonthPurchaseData($grade->j_g_id, 'jpiv_weight_mds', $m, $y, $fy_id);
													$totalPurchaseMds += $purchaseMds[$g];
												}
											}

											//mds
											$kfPurchaseMds = $this->session->userdata('kf');
											$whPurchaseMds = $this->session->userdata('wh');
											//End Getting MDS
											?>

 										<?php
											//Getting amount
											if ($grades) {
												$kf = 0;
												$wh = 0;
												$totalPurchaseAmount = 0;
												$this->session->set_userdata('kf', $kf);
												$this->session->set_userdata('wh', $wh);
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$purchaseAmount[$g] = currentMonthPurchaseData($grade->j_g_id, 'jpiv_amount', $m, $y, $fy_id);
													$totalPurchaseAmount += $purchaseAmount[$g];
												}
											}

											//mds
											$kfPurchaseAmount = $this->session->userdata('kf');
											$whPurchaseAmount = $this->session->userdata('wh');
											?>

 										<!-- Current Month Data -->
 										<tr style="background-color:#98FB98">
 											<td rowspan="3" class="align-middle text-center" style="">
 												Actual <br> Purchased</td>
 											<td>Purchased Monds</td>
 											<?php
												//getting Mds
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?= number_format($purchaseMds[$g], 2, '.', '') ?></td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($kfPurchaseMds, 2, '.', '') ?></td>
 											<td><?= number_format($whPurchaseMds, 2, '.', '') ?></td>
 											<td>
 												<?php $grandTotalPurchaseMds = $totalPurchaseMds + $kfPurchaseMds + $whPurchaseMds;
													echo number_format($grandTotalPurchaseMds, 2, '.', ''); ?>
 											</td>
 											<td>Shortage Provision</td>
 										</tr>
 										<tr style="background-color:#98FB98">
 											<td>Average Purchased Rate</td>
 											<?php
												//gating Amount
												if ($grades) {
													$kf = 0;
													$wh = 0;
													$this->session->set_userdata('kf', $kf);
													$this->session->set_userdata('wh', $wh);
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php
															if ($purchaseAmount[$g] == 0 and $purchaseMds[$g] == 0) {
																echo number_format(0, 2, '.', '');
															} else {
																echo $monthlyAverageRate[$g] = number_format($purchaseAmount[$g] /  $purchaseMds[$g], 2, '.', '');
															}
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?php
													if ($kfPurchaseAmount != 0) {
														echo $kfMonthlyAverageRate = number_format($kfPurchaseAmount / $kfPurchaseMds, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?></td>
 											<td>
 												<?php
													if ($whPurchaseAmount != 0) {
														echo $whMonthlyAverageRate = number_format($whPurchaseAmount / $whPurchaseMds, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?>
 											</td>
 											<td>
 												<?php
													$grandTotalPurchaseAmount = $totalPurchaseAmount + $kfPurchaseAmount + $whPurchaseAmount;
													if ($grandTotalPurchaseAmount != 0) {
														echo number_format($grandTotalPurchaseAmount / $grandTotalPurchaseMds, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													} ?>
 											</td>
 											<td>2%</td>
 										</tr>
 										<tr style="background-color:#98FB98">
 											<td>Amount</td>
 											<?php
												//amount_with_bad_pro
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?php echo number_format($purchaseAmount[$g], 2, '.', ''); ?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?php echo number_format($kfPurchaseAmount, 2, '.', ''); ?>
 											</td>
 											<td><?php echo number_format($whPurchaseAmount, 2, '.', ''); ?>
 											</td>
 											<td><?php echo number_format($grandTotalPurchaseAmount, 2, '.', ''); ?>
 											</td>
 											<td>
 												<?php echo number_format($grandTotalPurchaseAmount * 2 / 100, 2, '.', ''); ?>
 											</td>
 										</tr>
 										<!-- Purchased After 2% -->
 										<?php
											//add 2% with purchase amount
											if ($grades) {
												$kf = 0;
												$wh = 0;
												$this->session->set_userdata('kf', $kf);
												$this->session->set_userdata('wh', $wh);
												$total_jpiv_amount_with_bad_pro = 0;
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$jpiv_amount_with_bad_pro[$g] = currentMonthPurchaseData($grade->j_g_id, 'jpiv_amount_with_bad_pro', $m, $y, $fy_id);
													$total_jpiv_amount_with_bad_pro += $jpiv_amount_with_bad_pro[$g];
												}
											}
											$kf_jpiv_amount_with_bad_pro = $this->session->userdata('kf');
											$wh_jpiv_amount_with_bad_pro = $this->session->userdata('wh');
											?>
 										<!-- Shortage Provision 2% -->
 										<tr class="text-danger">
 											<td></td>
 											<td>Shortage Provision 2%</td>
 											<?php
												// Average amount_with_bad_pro
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php
															if ($purchaseMds[$g] != 0) {
																echo number_format(($jpiv_amount_with_bad_pro[$g] / $purchaseMds[$g]) - $monthlyAverageRate[$g], 2, '.', '');
															} else {
																echo number_format(0, 2, '.', '');
															}
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td>
 												<?php
													if ($kfPurchaseAmount != 0) {
														echo number_format(($kf_jpiv_amount_with_bad_pro / $kfPurchaseMds) - $kfMonthlyAverageRate, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?>
 											</td>
 											<td>
 												<?php
													if ($whPurchaseAmount != 0) {
														echo number_format(($wh_jpiv_amount_with_bad_pro / $whPurchaseMds) - $whMonthlyAverageRate, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?>
 											</td>
 											<td></td>
 											<td>Cutting Production</td>
 										</tr>
 										<!-- Start কাটিং ভেলুর ভেরিয়েবল ধরার জন্য এই কাজটি করতে হবে -->
 										<?php
											//Getting MDS
											if ($grades) {
												$kf = 0;
												$wh = 0;
												$this->session->set_userdata('kf', $kf);
												$this->session->set_userdata('wh', $wh);
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$jpiv_after_cutting_mds[$g] = currentMonthPurchaseData($grade->j_g_id, 'jpiv_after_cutting_mds', $m, $y, $fy_id);
												}
											}

											//mds
											$kf_jpiv_after_cutting_mds = $this->session->userdata('kf');
											$wh_jpiv_after_cutting_mds = $this->session->userdata('wh');
											//End Getting MDS
											?>

 										<?php
											//Getting cutting_mds
											if ($grades) {
												$kf = 0;
												$wh = 0;
												$this->session->set_userdata('kf', $kf);
												$this->session->set_userdata('wh', $wh);
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$jpiv_cutting_mds[$g] = currentMonthPurchaseData($grade->j_g_id, 'jpiv_cutting_mds', $m, $y, $fy_id);
												}
											}

											//cutting_mds
											$kf_jpiv_cutting_mds = $this->session->userdata('kf');
											$wh_jpiv_cutting_mds = $this->session->userdata('wh');
											?>

 										<?php
											//Getting jpiv_amount_with_bad_pro_after_cutting_amount
											if ($grades) {
												$kf = 0;
												$wh = 0;
												$this->session->set_userdata('kf', $kf);
												$this->session->set_userdata('wh', $wh);
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$jpiv_amount_with_bad_pro_after_cutting_amount[$g] = currentMonthPurchaseData($grade->j_g_id, 'jpiv_amount_with_bad_pro_after_cutting_amount', $m, $y, $fy_id);
												}
											}

											//mds
											$kf_jpiv_amount_with_bad_pro_after_cutting_amount = $this->session->userdata('kf');
											$wh_jpiv_amount_with_bad_pro_after_cutting_amount = $this->session->userdata('wh');
											?>

 										<?php
											//Getting jpiv_cutting_amount
											if ($grades) {
												$kf = 0;
												$wh = 0;
												$this->session->set_userdata('kf', $kf);
												$this->session->set_userdata('wh', $wh);
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$jpiv_cutting_amount[$g] = currentMonthPurchaseData($grade->j_g_id, 'jpiv_cutting_amount', $m, $y, $fy_id);
													//$total_jpiv_cutting_amount += $jpiv_cutting_amount[$g] ;
												}
											}

											//mds
											$kf_jpiv_cutting_amount = $this->session->userdata('kf');
											$wh_jpiv_cutting_amount = $this->session->userdata('wh');
											?>
 										<!-- End কাটিয় ভেলুর ভেরিয়েবল ধরার জন্য এই কাজটি করতে হবে -->
 										<!-- After Cutting 17% -->
 										<tr style="background-color:#d3edfb">
 											<td rowspan="3" class="align-middle text-center" style="">
 												After Cutting <br> 17% </td>
 											<td>Total Quantity Monds</td>
 											<?php
												// cutting jpiv_after_cutting_mds
												if ($grades) {
													$total_jpiv_cutting_mds = 0;
													$total_mds_after_cutting_mds = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?php
															$total_jpiv_cutting_mds += $jpiv_cutting_mds[$g];
															if ($grade->j_g_title == 'D1') {
																echo number_format($mds_after_cutting_mds[$g] = $jpiv_after_cutting_mds[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'D2') {
																echo number_format($mds_after_cutting_mds[$g] = $jpiv_after_cutting_mds[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'D3') {
																echo number_format($mds_after_cutting_mds[$g] = $jpiv_after_cutting_mds[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'Mill_C') {
																echo number_format($mds_after_cutting_mds[$g] = $jpiv_after_cutting_mds[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'Cutt') {
																echo number_format($mds_after_cutting_mds[$g] = $purchaseMds[$g] + $total_jpiv_cutting_mds + $kf_jpiv_cutting_mds + $wh_jpiv_cutting_mds, 2, '.', '');
															} else {
																echo number_format($mds_after_cutting_mds[$g] = $purchaseMds[$g], 2, '.', '');
															}
															$total_mds_after_cutting_mds += $mds_after_cutting_mds[$g];
															?></td>
 											<?php
													}
												}
												?>
 											<td><?php
													if ($kfPurchaseMds != 0) {
														echo number_format($kf_jpiv_after_cutting_mds, 2, '.', '');
													} else {
														echo number_format($kf_jpiv_after_cutting_mds = 0, 2, '.', '');
													}
													?></td>
 											<td><?php
													if ($whPurchaseMds != 0) {
														echo number_format($wh_jpiv_after_cutting_mds, 2, '.', '');
													} else {
														echo number_format($wh_jpiv_after_cutting_mds = 0, 2, '.', '');
													}
													?></td>
 											<td>
 												<?php echo number_format($grand_total_mds_after_cutting_mds = $total_mds_after_cutting_mds + $kf_jpiv_after_cutting_mds + $wh_jpiv_after_cutting_mds, 2, '.', '');
													?>
 											</td>
 											<td>
 												<?php echo number_format($total_jpiv_cutting_mds + $kf_jpiv_cutting_mds + $wh_jpiv_cutting_mds, 2, '.', '');
													?>
 											</td>
 										</tr>
 										<tr style="background-color:#d3edfb">
 											<td>Average Pucca Rate</td>
 											<?php
												//Average
												if ($grades) {
													$total_jpiv_cutting_amount = 0;
													$total_jpiv_amount_with_bad_pro_after_cutting_amount = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php
															$total_jpiv_cutting_amount += $jpiv_cutting_amount[$g];
															if ($mds_after_cutting_mds[$g] != 0) {
																if ($grade->j_g_title == 'D1') {
																	echo number_format($jpiv_amount_with_bad_pro_after_cutting_amount[$g] / $mds_after_cutting_mds[$g], 2, '.', '');
																} elseif ($grade->j_g_title == 'D2') {
																	echo number_format($jpiv_amount_with_bad_pro_after_cutting_amount[$g] / $mds_after_cutting_mds[$g], 2, '.', '');
																} elseif ($grade->j_g_title == 'D3') {
																	echo number_format($jpiv_amount_with_bad_pro_after_cutting_amount[$g] / $mds_after_cutting_mds[$g], 2, '.', '');
																} elseif ($grade->j_g_title == 'Mill_C') {
																	echo number_format($jpiv_amount_with_bad_pro_after_cutting_amount[$g] / $mds_after_cutting_mds[$g], 2, '.', '');
																} elseif ($grade->j_g_title == 'Cutt') {
																	echo number_format(($jpiv_amount_with_bad_pro_after_cutting_amount[$g] + $total_jpiv_cutting_amount + $kf_jpiv_cutting_amount + $wh_jpiv_cutting_amount) / $mds_after_cutting_mds[$g], 2, '.', '');
																} else {
																	echo number_format($jpiv_amount_with_bad_pro_after_cutting_amount[$g] / $mds_after_cutting_mds[$g], 2, '.', '');
																}
															} else {
																echo number_format(0, 2, '.', '');
															}
															$total_jpiv_amount_with_bad_pro_after_cutting_amount += $jpiv_amount_with_bad_pro_after_cutting_amount[$g];
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td>
 												<?php
													if ($kfPurchaseMds != 0) {
														echo number_format($kf_jpiv_amount_with_bad_pro_after_cutting_amount / $kf_jpiv_after_cutting_mds, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?></td>
 											<td>
 												<?php
													if ($whPurchaseMds != 0) {
														echo number_format($wh_jpiv_amount_with_bad_pro_after_cutting_amount / $wh_jpiv_after_cutting_mds, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?></td>
 											<td>
 												<?php
													$grand_total_jpiv_amount_with_bad_pro_after_cutting_amount = $total_jpiv_amount_with_bad_pro_after_cutting_amount + $kf_jpiv_amount_with_bad_pro_after_cutting_amount + $wh_jpiv_amount_with_bad_pro_after_cutting_amount + $total_jpiv_cutting_amount + $kf_jpiv_cutting_amount + $wh_jpiv_cutting_amount;
													if ($grand_total_jpiv_amount_with_bad_pro_after_cutting_amount != 0) {
														echo number_format($grand_total_jpiv_amount_with_bad_pro_after_cutting_amount / $grand_total_mds_after_cutting_mds, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?>
 											</td>
 											<td>
 												<?php $cuttingRate = $this->M_godown->getJuteCalculationHelperByMonthYear($m, $y, $fy_id);
													if ($cuttingRate) {
														echo $cuttingRate->jch_cutting_rate;
													}
													?>
 											</td>
 										</tr>
 										<tr style="background-color:#d3edfb">
 											<td>Amount</td>
 											<?php
												//getting Amount
												if ($grades) {
													$total_jpiv_cutting_amount = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php
															$total_jpiv_cutting_amount += $jpiv_cutting_amount[$g];
															if ($grade->j_g_title == 'D1') {
																echo number_format($amount_with_bad_pro_after_cutting_amount[$g] = $jpiv_amount_with_bad_pro_after_cutting_amount[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'D2') {
																echo number_format($amount_with_bad_pro_after_cutting_amount[$g] = $jpiv_amount_with_bad_pro_after_cutting_amount[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'D3') {
																echo number_format($amount_with_bad_pro_after_cutting_amount[$g] = $jpiv_amount_with_bad_pro_after_cutting_amount[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'Mill_C') {
																echo number_format($amount_with_bad_pro_after_cutting_amount[$g] = $jpiv_amount_with_bad_pro_after_cutting_amount[$g], 2, '.', '');
															} elseif ($grade->j_g_title == 'Cutt') {
																echo number_format($amount_with_bad_pro_after_cutting_amount[$g] = $jpiv_amount_with_bad_pro_after_cutting_amount[$g] + $total_jpiv_cutting_amount + $kf_jpiv_cutting_amount + $wh_jpiv_cutting_amount, 2, '.', '');
															} else {
																echo number_format($amount_with_bad_pro_after_cutting_amount[$g] = $jpiv_amount_with_bad_pro_after_cutting_amount[$g], 2, '.', '');
															}
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td>
 												<?php
													if ($kfPurchaseMds != 0) {
														echo number_format($kf_jpiv_amount_with_bad_pro_after_cutting_amount, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?></td>
 											<td>
 												<?php
													if ($whPurchaseMds != 0) {
														echo number_format($wh_jpiv_amount_with_bad_pro_after_cutting_amount, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?></td>
 											<td>
 												<?php
													echo number_format($grand_total_jpiv_amount_with_bad_pro_after_cutting_amount, 2, '.', '');
													?>
 											</td>
 											<td>
 												<?php
													echo number_format($total_jpiv_cutting_amount + $kf_jpiv_cutting_amount + $wh_jpiv_cutting_amount, 2, '.', '');
													?>
 											</td>
 										</tr>
 										<tr class="faka">
 											<td></td>
 											<td></td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) { ?>
 													<td></td>
 											<?php
													}
												}
												?>
 											<td></td>
 											<td></td>
 											<td></td>
 										</tr>
 										<!-- 421 Opening + Purchased -->
 										<?php
											// veriable dhorar jonno
											if ($grades) {
												$totalOpeningAndPurchaseAmount = 0;
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													$openingAndPurchaseAmount[$g] = $amount_with_bad_pro_after_cutting_amount[$g] + $openingAmount[$g];
													$totalOpeningAndPurchaseAmount += $openingAndPurchaseAmount[$g];
												}
											}
											?>
 										<tr style="background-color:#eced61">
 											<td rowspan="3" class="align-middle text-center" style="">
 												Opening + <br> <b>Purchased</b> </td>
 											<td>Opening Quantity Monds</td>
 											<?php
												if ($grades) {
													$totalOpeningAndPurchaseMds = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?= number_format($openingAndPurchaseMds[$g] = $mds_after_cutting_mds[$g] + $openingMds[$g], 2, '.', '');
															$totalOpeningAndPurchaseMds += $openingAndPurchaseMds[$g];
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?php echo number_format($openingAndPurchaseMdsKf = $kf_jpiv_after_cutting_mds + $kfOpeningMds, 2, '.', ''); ?>
 											</td>
 											<td><?php echo number_format($openingAndPurchaseMdsWh = $wh_jpiv_after_cutting_mds + $whOpeningMds, 2, '.', ''); ?>
 											</td>
 											<td>
 												<?php echo number_format($grandTotalOpeningAndPurchaseMds = $totalOpeningAndPurchaseMds + $openingAndPurchaseMdsKf + $openingAndPurchaseMdsWh, 2, '.', ''); ?>
 											</td>
 										</tr>
 										<tr style="background-color:#eced61">
 											<td>Opening Average Rate</td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?php if ($openingAndPurchaseAmount[$g] != 0) {
																echo number_format($openingAndPurchaseAve[$g] = $openingAndPurchaseAmount[$g] / $openingAndPurchaseMds[$g], 2, '.', '');
															} else {
																echo number_format($openingAndPurchaseAve[$g] = 0, 2, '.', '');
															} ?></td>
 											<?php
													}
												}
												?>
 											<td>
 												<!-- 25.9.22 a if condition update krlam aga silo $kf_jpiv_amount_with_bad_pro_after_cutting_amount != 0 -->
 												<?php if ($kf_jpiv_amount_with_bad_pro_after_cutting_amount || $kfOpeningAmount) {
														echo number_format($openingAndPurchaseAveKf = ($kf_jpiv_amount_with_bad_pro_after_cutting_amount + $kfOpeningAmount) / ($kf_jpiv_after_cutting_mds + $kfOpeningMds), 2, '.', '');
													} else {
														echo number_format($openingAndPurchaseAveKf = 0, 2, '.', '');
													}
													?>
 											</td>
 											<td>
 												<?php if ($wh_jpiv_amount_with_bad_pro_after_cutting_amount || $whOpeningAmount) {
														echo number_format($openingAndPurchaseAveWh = ($wh_jpiv_amount_with_bad_pro_after_cutting_amount + $whOpeningAmount) / ($wh_jpiv_after_cutting_mds + $whOpeningMds), 2, '.', '');
													} else {
														echo number_format($openingAndPurchaseAveWh = 0, 2, '.', '');
													} ?>
 											</td>
 											<td>
 												<?php
													$grandTotalOpeningAndPurchaseAmount = $totalOpeningAndPurchaseAmount + $kf_jpiv_amount_with_bad_pro_after_cutting_amount + $kfOpeningAmount + $wh_jpiv_amount_with_bad_pro_after_cutting_amount + $whOpeningAmount;
													if ($grandTotalOpeningAndPurchaseAmount != 0) {
														echo number_format($totalOpeningAndPurchaseAve = $grandTotalOpeningAndPurchaseAmount / $grandTotalOpeningAndPurchaseMds, 2, '.', '');
													} else {
														echo number_format($totalOpeningAndPurchaseAve = 0, 2, '.', '');
													} ?>
 											</td>
 										</tr>
 										<tr style="background-color:#eced61">
 											<td>Opening Amount</td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?= number_format($amount_with_bad_pro_after_cutting_amount[$g] + $openingAmount[$g], 2, '.', '') ?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($kf_jpiv_amount_with_bad_pro_after_cutting_amount + $kfOpeningAmount, 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($wh_jpiv_amount_with_bad_pro_after_cutting_amount + $whOpeningAmount, 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($grandTotalOpeningAndPurchaseAmount, 2, '.', ''); ?>
 											</td>
 										</tr>
 										<tr class="faka">
 											<td></td>
 											<td></td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) { ?>
 													<td></td>
 											<?php
													}
												}
												?>
 											<td></td>
 											<td></td>
 											<td></td>
 										</tr>
 										<!-- Issue-->
 										<tr style="background-color:#f7c1f3">
 											<td rowspan="3" class="align-middle text-center" style="">
 												Issue </td>
 											<td>Total Quantity Monds</td>
 											<?php
												if ($grades) {
													$kf = 0;
													$wh = 0;
													$totalCurrentMonthIssue = 0;
													$this->session->set_userdata('kf', $kf);
													$this->session->set_userdata('wh', $wh);
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?= number_format($currentMonthIssue[$g] = currentMonthIssue($grade->j_g_id, 'isv_issue', $m, $y, $fy_id), 2, '.', '');
															$totalCurrentMonthIssue += $currentMonthIssue[$g];
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($currentMonthIssueKf = $this->session->userdata('kf'), 2, '.', '') ?>
 											</td>
 											<td><?= number_format($currentMonthIssueWh = $this->session->userdata('wh'), 2, '.', '') ?>
 											</td>
 											<td><?= number_format($grandTotalCurrentMonthIssue = $totalCurrentMonthIssue + $currentMonthIssueKf + $currentMonthIssueWh, 2, '.', '') ?>
 											</td>
 										</tr>
 										<!-- Getting Issue Amount -->
 										<?php
											$totalIssueAmount = 0;
											if ($grades) {
												foreach ($grades->result() as $grade) {
													$g = $grade->j_g_id;
													number_format($issueAmount[$g] = $openingAndPurchaseAve[$g] * $currentMonthIssue[$g], 2, '.', '');
													$totalIssueAmount += $issueAmount[$g];
												}
											}
											?>
 										<?php number_format($kfIssueAmount = $openingAndPurchaseAveKf * $currentMonthIssueKf, 2, '.', ''); ?>
 										<?php number_format($whIssueAmount = $openingAndPurchaseAveWh * $currentMonthIssueWh, 2, '.', '');
											$grandTotalIssueAmount = $totalIssueAmount + $kfIssueAmount + $whIssueAmount;
											?>

 										<tr style="background-color:#e7c1f7">
 											<td>Average Issue Rate</td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php
															if ($currentMonthIssue[$g]) {
																echo number_format($openingAndPurchaseAve[$g], 2, '.', '');
															} else {
																echo number_format(0, 2, '.', '');
															} ?>
 													</td>
 											<?php
													}
												}
												?>
 											<td>
 												<?php if ($currentMonthIssueKf) {
														echo number_format($openingAndPurchaseAveKf, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													} ?>
 											</td>
 											<td>
 												<?php if ($currentMonthIssueWh) {
														echo number_format($openingAndPurchaseAveWh, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													} ?>
 											<td> pp
 												<?php if ($grandTotalCurrentMonthIssue) {
														echo number_format($grandTotalIssueAmount / $grandTotalCurrentMonthIssue, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													} ?>
 											</td>
 										</tr>
 										<tr style="background-color:#e7c1f7">
 											<td>Amount</td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?= number_format($issueAmount[$g], 2, '.', '') ?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($kfIssueAmount, 2, '.', '') ?>
 											</td>
 											<td><?= number_format($whIssueAmount, 2, '.', '') ?>
 											</td>
 											<td><?= number_format($grandTotalIssueAmount, 2, '.', '') ?>
 											</td>
 										</tr>
 										<tr class="faka">
 											<td></td>
 											<td></td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) { ?>
 													<td></td>
 											<?php
													}
												}
												?>
 											<td></td>
 											<td></td>
 											<td></td>
 										</tr>
 										<!-- Sale-->
 										<tr style="background-color:#ffaeba">
 											<td rowspan="3" class="align-middle text-center" style="">
 												Sale </td>
 											<td>Total Quantity Monds</td>
 											<?php
												if ($grades) {
													$kf = 0;
													$wh = 0;
													$totalCurrentMonthSale = 0;
													$this->session->set_userdata('kf', $kf);
													$this->session->set_userdata('wh', $wh);
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?= number_format($currentMonthSale[$g] = currentMonthSale($grade->j_g_id, 'jsv_weight', $m, $y, $fy_id), 2, '.', '');
															$totalCurrentMonthSale += $currentMonthSale[$g];
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($currentMonthSaleKf = $this->session->userdata('kf'), 2, '.', '') ?>
 											</td>
 											<td><?= number_format($currentMonthSaleWh = $this->session->userdata('wh'), 2, '.', '') ?>
 											</td>
 											<td><?= number_format($grandTotalCurrentMonthSale = $totalCurrentMonthSale + $currentMonthSaleKf + $currentMonthSaleWh, 2, '.', '') ?>
 											</td>
 										</tr>
 										<tr style="background-color:#ffaeba">
 											<td>Average Sale Rate</td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php
															if ($currentMonthSale[$g]) {
																echo number_format($openingAndPurchaseAve[$g], 2, '.', '');
															} else {
																echo number_format(0, 2, '.', '');
															}
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td>
 												<?php if ($currentMonthSaleKf) {
														echo number_format($openingAndPurchaseAveKf, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													} ?>
 											</td>
 											<td>
 												<?php if ($currentMonthSaleWh) {
														echo number_format($openingAndPurchaseAveWh, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													} ?>
 											</td>
 											<td>
 												<?php if ($grandTotalCurrentMonthSale) {
														echo number_format($totalOpeningAndPurchaseAve, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													} ?></td>
 										</tr>
 										<tr style="background-color:#ffaeba">
 											<td>Amount</td>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td><?= number_format($openingAndPurchaseAve[$g] * $currentMonthSale[$g], 2, '.', '') ?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($openingAndPurchaseAveKf * $currentMonthSaleKf, 2, '.', '') ?>
 											</td>
 											<td><?= number_format($openingAndPurchaseAveWh * $currentMonthSaleWh, 2, '.', '') ?>
 											</td>
 											<td>
 												<?php if ($grandTotalCurrentMonthSale) {
														echo number_format($grandTotalSaleAmount = $totalOpeningAndPurchaseAve * $grandTotalCurrentMonthSale, 2, '.', '');
													} else {
														echo number_format($grandTotalSaleAmount = 0, 2, '.', '');
													} ?>
 											</td>
 										</tr>
 										<!-- Start Adjustment -->
 										<tr style="background-color:#ff3351">
 											<td></td>
 											<td>Adjustment</td>
 											<?php
												if ($grades) {
													$totalCurrentMonthAdjustment = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
												?>
 													<td>
 														<?php echo number_format($currentMonthAdjustment[$g] = currentMonthAdjustment($grade->j_g_id, 'adjv_value', $m, $y, $fy_id), 2, '.', '');
															$totalCurrentMonthAdjustment += $currentMonthAdjustment[$g];
															?>
 													</td>
 											<?php
													}
												}
												?>
 											<td><?= number_format($currentMonthAdjustmentKf = currentMonthAdjustment('kf', 'adjv_value', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($currentMonthAdjustmentWh = currentMonthAdjustment('wh', 'adjv_value', $m, $y, $fy_id), 2, '.', ''); ?>
 											</td>
 											<td><?= number_format($grandTotalCurrentMonthAdjustment = $totalCurrentMonthAdjustment + $currentMonthAdjustmentKf + $currentMonthAdjustmentWh, 2, '.', ''); ?>
 											</td>
 										</tr>
 										<!-- end Adjustment -->
 										<!-- 423 CL. Balance -->

 										<form role="form" action="<?php echo base_url('insert_opening_jute') ?>" method="post">
 											<tr>
 												<td rowspan="3" class="align-middle text-center" style="">
 													CL. Balance </td>
 												<td>Closing Quantity Monds</td>
 												<?php
													if ($grades) {
														$totalClosingMds = 0;
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td>
 															<?php
																echo number_format($closingMds[$g] = $openingAndPurchaseMds[$g] - $currentMonthIssue[$g] - $currentMonthSale[$g] + $currentMonthAdjustment[$g], 2, '.', '');
																$totalClosingMds += $closingMds[$g];
																?>

 															<input type="hidden" name="opening_mds[]" value='<?= $closingMds[$g] ?>'>
 															<input type="hidden" name="opv_value_id[]" value='<?= getJuteOpeningMdsValueId($grade->j_g_id, $helperCall); ?>'>
 														</td>
 												<?php
														}
													}
													?>
 												<td>
 													<?= number_format($closingMdsKf = $openingAndPurchaseMdsKf - $currentMonthIssueKf - $currentMonthSaleKf + $currentMonthAdjustmentKf, 2, '.', '') ?>
 													<br>
 													<input type="hidden" name="opening_mds_kf" value='<?= $closingMdsKf ?>'>
 													<input type="hidden" name="opv_kf_id" value='<?= getJuteOpeningMdsValueId('kf', $helperCall); ?>'>
 												</td>
 												<td>
 													<?= number_format($closingMdsWh = $openingAndPurchaseMdsWh - $currentMonthIssueWh - $currentMonthSaleWh + $currentMonthAdjustmentWh, 2, '.', '') ?>
 													<br>
 													<input type="hidden" name="opening_mds_wh" value='<?= $closingMdsWh ?>'>
 													<input type="hidden" name="opv_wh_id" value='<?= getJuteOpeningMdsValueId('wh', $helperCall); ?>'>
 												</td>
 												<td>
 													<?= number_format($grandTotalClosingMds = $totalClosingMds + $closingMdsKf + $closingMdsWh, 2, '.', '') ?>
 													<input type="hidden" name="opening_mds_total" value='<?= $grandTotalClosingMds ?>'>
 												</td>
 												<td>
 													Weight Gain/Loss
 												</td>
 											</tr>
 											<!-- START To get Average Closing amount -->
 											<?php
												if ($grades) {
													$totalClosingAmount = 0;
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
														number_format($closingAmount[$g] = $closingMds[$g] * $openingAndPurchaseAve[$g], 2, '.', '');
														$totalClosingAmount += $closingAmount[$g];
													}
												}
												$closingAmountKf = $openingAndPurchaseAveKf * $closingMdsKf;
												$closingAmountWh = $openingAndPurchaseAveWh * $closingMdsWh;
												$grandTotalClosingAmount = $totalClosingAmount + $closingAmountKf + $closingAmountWh;
												?>
 											<!-- End To get Average Closing amount -->
 											<tr>
 												<td>Closing Average Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td>
 															<?php
																echo number_format($openingAndPurchaseAve[$g], 2, '.', '');
																?>
 															<br>
 															<input type="hidden" name="opening_ave[]" value='<?= $openingAndPurchaseAve[$g] ?>'>
 														</td>
 												<?php
														}
													}
													?>
 												<td>
 													<?= number_format($openingAndPurchaseAveKf, 2, '.', '') ?>
 													<input type="hidden" name="opening_ave_kf" value='<?= $openingAndPurchaseAveKf ?>'>
 												</td>
 												<td>
 													<?= number_format($openingAndPurchaseAveWh, 2, '.', '') ?>
 													<input type="hidden" name="opening_ave_wh" value='<?= $openingAndPurchaseAveWh ?>'>
 												</td>
 												<td>
 													<?php
														if ($grandTotalClosingAmount == 0 and $grandTotalClosingMds == 0) {
															echo number_format($grandTotalClosingAverage = 0, 2, '.', '');
														} else {
															echo number_format($grandTotalClosingAverage = $grandTotalClosingAmount / $grandTotalClosingMds, 2, '.', '');
														}
														?>
 													<input type="hidden" name="opening_ave_total" value='<?= $grandTotalClosingAverage ?>'>
 												</td>
 												<td>
 													<?= number_format($weightGainLoss = $grandTotalCurrentMonthAdjustment * $grandTotalClosingAverage, 2, '.', ''); ?>
 												</td>
 											</tr>
 											<tr>
 												<td>Closing Amount</td>
 												<?php
													if ($grades) {
														$totalClosingAmount = 0;
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td>
 															<?php
																echo number_format($closingAmount[$g] = $closingMds[$g] * $openingAndPurchaseAve[$g], 2, '.', '');
																$totalClosingAmount += $closingAmount[$g];
																?>
 															<input type="hidden" name="opening_j_g_id[]" value='<?= $g ?>'>
 															<input type="hidden" name="opening_amount[]" value='<?= $closingAmount[$g] ?>'>
 														</td>
 												<?php
														}
													}
													?>
 												<td>
 													<?= number_format($closingAmountKf = $openingAndPurchaseAveKf * $closingMdsKf, 2, '.', '') ?>
 													<input type="hidden" name="opening_amount_kf" value='<?= $closingAmountKf ?>'>
 												</td>
 												<td>
 													<?= number_format($closingAmountWh = $openingAndPurchaseAveWh * $closingMdsWh, 2, '.', '') ?>
 													<input type="hidden" name="opening_amount_wh" value='<?= $closingAmountWh ?>'>
 												</td>
 												<td>
 													<?= number_format($grandTotalClosingAmount = $totalClosingAmount + $closingAmountKf + $closingAmountWh, 2, '.', '') ?>
 													<input type="hidden" name="opening_amount_total" value='<?= $grandTotalClosingAmount ?>'>
 												</td>
 												<td>
 													Grade Gain/Loss <br>
 													<?= number_format($grandTotalClosingAmount - ($grandTotalOpeningAndPurchaseAmount - $grandTotalIssueAmount - $grandTotalSaleAmount) - $weightGainLoss, 2, '.', '') ?>
 												</td>
 											</tr>
 											<?php
												$current_user_type = $this->session->userdata('current_type');
												$buttonSeePeople = array(1, 10, 603);
												if (in_array($current_user_type, $buttonSeePeople)) {
												?>
 												<tr>
 													<td></td>
 													<td></td>
 													<?php
														if ($grades) {
															foreach ($grades->result() as $grade) {
																$g = $grade->j_g_id;
														?>
 															<td>
 															</td>
 													<?php
															}
														}
														?>
 													<td colspan="5">
 														<div class="pull-right">
 															<input type="hidden" name="month" id="c_month" value='<?= $m ?>'>
 															<input type="hidden" name="year" id="c_year" value='<?= $y ?>'>
 															<input type="hidden" name="idForUpdate" id="idForUpdate" value='<?= $helperCall ?>'>
 															<button type="submit" id="closingBalance" class="btn btn-info" onclick="return confirm('Are you sure, You want to submit this')">Submit
 																Closing Balance</button>
 															<button type="submit" id="updateClosingBalance" class="btn btn-info" onclick="return confirm('Are you sure, You want to UPDATE this')">Update
 																Closing Balance</button>
 														</div>
 													</td>

 												</tr>
 											<?php
												}
												?>
 										</form>
 									</tbody>
 								</table>
 							</div>
 						</div>
 						<!-- /.card-body -->
 						<div class="card-footer">
 						</div>
 						<!-- /End Form -->
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


 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function() {

 		$(".month").change(function() {
 			var month = $('.month').find(":selected").val();
 			var year = $('.year').find(":selected").val();
 			var catching_date = ('01' + '-' + month + '-' + year);
 			// alert(catching_date)

 			var [dd, mm, yyyy] = catching_date.split("-");
 			var revDate = `${mm}-${dd}-${yyyy}`;
 			//  Date to Month Name
 			const dateObj = new Date(revDate);
 			const monthNameLong = dateObj.toLocaleString("en-US", {
 				month: "long"
 			});


 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Godown/ajaxFinancialYearCheckMonthYearForFilter') ?>",
 				data: {
 					catching_date: catching_date,

 				},
 				success: function(data) {
 					// alert(data);
 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Oops !!!!!!!!!!!!!',
 							text: `No Financial Year Found Under ( ${monthNameLong} ${yyyy} ) `
 						}).then((result) => {
 							if (result.isConfirmed) {
 								refreshPage();
 							} else {
 								refreshPage();
 							}
 						});

 					}
 				}

 			});

 			function refreshPage() {
 				setInterval('location.reload()', 100);
 			}
 		});

 		closingButtonShow()

 		function closingButtonShow() {

 			var month = $('#c_month').val();
 			//alert(month);
 			var year = $('#c_year').val();

 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Opening_jute/ajaxButtonAvailabilityCheck') ?>",
 				data: {
 					month: month,
 					year: year,
 				},
 				success: function(data) {
 					var all_data = JSON.parse(data);
 					if (all_data.button == 'add') {
 						$('#closingBalance').show();
 						$('#updateClosingBalance').hide();
 					} else if (all_data.button == 'update') {
 						$('#closingBalance').hide();
 						$('#updateClosingBalance').show();
 					} else {
 						$('#closingBalance').hide();
 						$('#updateClosingBalance').hide();
 					}
 				}
 			});

 		}


 	});
 </script>
