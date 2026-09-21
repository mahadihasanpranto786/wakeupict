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
 						<form role="form" action="" method="post">
 							<div class="card-body">
 								<div class="row">
 									<div class="col-sm-7">
 										<h3 class="text-success">Godown Reports FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF: <?= date("F") ?> </h3>
 									</div>
 									<div class="form-group col-sm-2">
 										<label>Year</label>
 										<select class="form-control select2" style="width: 100%;">
 											<option selected="selected">Select Year</option>
 											<option value="">2019-2020</option>
 											<option value="">2020-2021</option>
 										</select>
 									</div>
 									<div class="form-group col-sm-2">
 										<label>Month</label>
 										<select class="form-control select2" style="width: 100%;">
 											<option selected="selected">Select Month</option>
 											<option value="">January</option>
 											<option value="">February</option>
 											<option value="">March</option>
 											<option value="">April</option>
 											<option value="">May</option>
 											<option value="">June</option>
 											<option value="">July</option>
 											<option value="">August</option>
 											<option value="">September</option>
 											<option value="">October</option>
 											<option value="">November</option>
 											<option value="">December</option>
 										</select>
 									</div>
 									<div class="col-sm-1">
 										<a href=""><button class="btn btn-info float-right mt-4"> Submit</button></a>
 									</div>
 								</div>
 								<div class="row">
 									<!-- Table -->
 									<table id="" class="table table-bordered table-striped">
 										<thead>
 											<tr>
 												<th>Particulars</th>
 												<th></th>
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
 												<th>Actions</th>
 											</tr>
 										</thead>
 										<tbody>
 											<!-- Opening Pacca Jute -->
 											<tr style="background-color:#f6ca71">
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Opening Pacca Jute</td>
 												<td>Opening Quantity Monds</td>
 												<?php
													// Mds
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?php echo $openingMds[$g] = openingValue($grade->j_g_id, 'opv_mds');
																?></td>
 												<?php
														}
													}
													?>
 												<td><?= $kfOpeningMds = openingValue('kf', 'opv_mds'); ?></td>
 												<td><?= $whOpeningMds = openingValue('wh', 'opv_mds'); ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#f6ca71">
 												<td>Opening Average Rate</td>
 												<?php
													// Average
													if ($grades) {
														$i = 0;
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?php echo $openingAve[$g] = openingValue($grade->j_g_id, 'opv_ave');
																$i++ ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $kfOpeningAve = openingValue($grade->j_g_id, 'opv_ave'); ?></td>
 												<td><?= $whOpeningAve = openingValue($grade->j_g_id, 'opv_ave'); ?></td>
 												<td></td>
 												<td></td>
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
 														<td><?php echo $openingAmount[$g] = openingValue($grade->j_g_id, 'opv_amount');
																$i++ ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $kfOpeningAmount = openingValue($grade->j_g_id, 'opv_amount'); ?></td>
 												<td><?= $whOpeningAmount = openingValue($grade->j_g_id, 'opv_amount'); ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Actual Purchased Avg. Rate -->
 											<?php
												//Getting MDS
												if ($grades) {
													$kf = 0;
													$wh = 0;
													$this->session->set_userdata('kf', $kf);
													$this->session->set_userdata('wh', $wh);
													foreach ($grades->result() as $grade) {
														currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds');
													}
												}

												//mds
												$kfBuyMds = $this->session->userdata('kf');
												$whBuyMds = $this->session->userdata('wh');
												//End Getting MDS
												?>

 											<?php
												//Getting amount
												if ($grades) {
													$kf = 0;
													$wh = 0;
													$this->session->set_userdata('kf', $kf);
													$this->session->set_userdata('wh', $wh);
													foreach ($grades->result() as $grade) {
														currentMonthPurchase($grade->j_g_id, 'jpiv_amount');
													}
												}

												//mds
												$kfBuyAmount = $this->session->userdata('kf');
												$whBuyAmount = $this->session->userdata('wh');
												?>

 											<tr class="text-danger">
 												<td></td>
 												<td> Actual Purchased Avg. Rate</td>
 												<?php
													//gating Amount
													if ($grades) {
														$kf = 0;
														$wh = 0;
														$this->session->set_userdata('kf', $kf);
														$this->session->set_userdata('wh', $wh);
														foreach ($grades->result() as $grade) {
													?>
 														<td>
 															<?php
																$jpiv_amount = currentMonthPurchase($grade->j_g_id, 'jpiv_amount');
																$jpiv_weight_mds = currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds');
																if ($jpiv_amount == 0 and $jpiv_weight_mds == 0) {
																	echo 0;
																} else {
																	echo $jpiv_amount /  $jpiv_weight_mds;
																}
																?>
 														</td>
 												<?php
														}
													}
													?>
 												<td><?php
														//$kfBuyAmount = $this->session->userdata('kf');
														//echo "kfold--" . $kfBuyAmount . "kfold--";
														if ($kfBuyAmount != 0) {
															echo $kfBuyAmount / $kfBuyMds;
														} else {
															echo 0;
														}
														?></td>
 												<td><?php
														///$whBuyAmount = $this->session->userdata('wh');
														if ($whBuyAmount != 0) {
															echo $whBuyAmount / $whBuyMds;
														} else {
															echo 0;
														}
														?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Purchased After 2% -->
 											<tr style="background-color:#98FB98">
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Purchased After 2%</td>
 												<td>Total Purchased Monds</td>
 												<?php
													//getting Mds
													if ($grades) {
														$kf = 0;
														$wh = 0;
														$this->session->set_userdata('kf', $kf);
														$this->session->set_userdata('wh', $wh);
														foreach ($grades->result() as $grade) {
													?>
 														<td><?= currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds') ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $this->session->userdata('kf'); ?></td>
 												<td><?= $this->session->userdata('wh'); ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<?php
												//add 2% with purchase amount
												if ($grades) {
													$kf = 0;
													$wh = 0;
													$this->session->set_userdata('kf', $kf);
													$this->session->set_userdata('wh', $wh);
													foreach ($grades->result() as $grade) {
														currentMonthPurchase($grade->j_g_id, 'jpiv_amount');
													}
												}
												//echo $this->session->userdata('kf');
												$afterPerKf = $this->session->userdata('kf') + ($this->session->userdata('kf') * 2 / 100);
												$afterPerWh = $this->session->userdata('wh') + ($this->session->userdata('wh') * 2 / 100);
												?>
 											<tr style="background-color:#98FB98">
 												<td>Average Purchased Rate</td>
 												<?php
													// Getting Mds
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td><?php
																$currentMonthPurchas = currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds');
																$afterPer = currentMonthPurchase($grade->j_g_id, 'jpiv_amount') + (currentMonthPurchase($grade->j_g_id, 'jpiv_amount') * 2 / 100);
																if ($afterPer != 0) {
																	echo $afterPer / $currentMonthPurchas;
																} else {
																	echo 0;
																}
																?>
 														</td>
 												<?php
														}
													}
													?>
 												<td><?php
														if ($kfBuyAmount != 0) {
															echo $afterPerKf / $kfBuyMds;
														} else {
															echo 0;
														}
														?></td>
 												<td><?php
														if ($whBuyAmount != 0) {
															echo $afterPerWh / $whBuyMds;
														} else {
															echo 0;
														}
														?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#98FB98">
 												<td>Amount</td>
 												<?php
													//getting Amount
													if ($grades) {
														$kf = 0;
														$wh = 0;
														$this->session->set_userdata('kf', $kf);
														$this->session->set_userdata('wh', $wh);
														foreach ($grades->result() as $grade) {
													?>
 														<td><?php echo currentMonthPurchase($grade->j_g_id, 'jpiv_amount') + (currentMonthPurchase($grade->j_g_id, 'jpiv_amount') * 2 / 100) ?></td>
 												<?php
														}
													}
													?>
 												<td><?php //echo "kfold-" . $this->session->userdata('kf') . "kfold--";
														echo $kfBuyAmount + ($kfBuyAmount * 2 / 100);
														?></td>
 												<td><?php echo $whBuyAmount + ($whBuyAmount * 2 / 100); ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Cutting Production -->
 											<tr style="background-color:#d3edfb">
 												<td></td>
 												<td></td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td></td>
 												<?php
														}
													}
													?>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td>Cutting Production</td>
 											</tr>
 											<!-- After Cutting 17% -->
 											<?php
												//17% cutting from Kf
												if ($kfBuyMds != 0) {
													$kataMdsKf = ($kfBuyMds * 15) / 100;
													//echo "<br>";
												} else {
													$kataMdsKf = 0;
													//echo 0;
												}
												?>

 											<?php
												//17% cutting from WH
												if ($whBuyMds != 0) {
													$kataMdsWh = ($whBuyMds * 15) / 100;
												} else {
													$kataMdsWh = 0;
												}
												?>
 											<?php
												// Module Banaia Database Thaka Anta Hoba
												// Apatato Static
												$cuttingRate = 1650;

												?>
 											<tr style="background-color:#d3edfb">
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">After Cutting 17% </td>
 												<td>Total Quantity Monds</td>
 												<?php
													// cutting 17% from MDS
													if ($grades) {
														$seventeenPerCut = 0;
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?php
																$mainValue = currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds');
																if ($grade->j_g_title == 'D1') {
																	$kataMds = ($mainValue * 15) / 100;
																	$seventeenPerCut += $kataMds;
																	$mainValue = $mainValue - $kataMds;
																	$gradeMdsAfterSeventeenPer[$g] = $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'D2') {
																	$kataMds = ($mainValue * 15) / 100;
																	$seventeenPerCut += $kataMds;
																	$mainValue = $mainValue - $kataMds;
																	$gradeMdsAfterSeventeenPer[$g] = $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'D3') {
																	$kataMds = ($mainValue * 15) / 100;
																	$seventeenPerCut += $kataMds;
																	$mainValue = $mainValue - $kataMds;
																	$gradeMdsAfterSeventeenPer[$g] = $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'Mill_C') {
																	$kataMds = ($mainValue * 15) / 100;
																	$seventeenPerCut += $kataMds;
																	$mainValue = $mainValue - $kataMds;
																	$gradeMdsAfterSeventeenPer[$g] = $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'Cutt') {

																	echo $gradeMdsAfterSeventeenPer[$g] = $mainValue + $seventeenPerCut + $kataMdsKf + $kataMdsWh;
																	//$seventeenPerCut = 0;
																} else {
																	$gradeMdsAfterSeventeenPer[$g] = $mainValue;
																	echo $mainValue;
																}
																?></td>
 												<?php
														}
													}
													?>
 												<td><?php
														if ($kfBuyMds != 0) {
															$kataMds = ($kfBuyMds * 15) / 100;
															$seventeenPerCut += $kataMds;
															$mainValue = $kfBuyMds - $kataMds;
															echo $kfMdsAfterSeventeenPer = $mainValue;
														} else {
															$kfMdsAfterSeventeenPer = 0;
														}
														?></td>
 												<td><?php
														if ($whBuyMds != 0) {
															$kataMds = ($whBuyMds * 15) / 100;

															$seventeenPerCut += $kataMds;
															$mainValue = $whBuyMds - $kataMds;
															echo $whMdsAfterSeventeenPer = $mainValue;
														} else {
															$whMdsAfterSeventeenPer = 0;
														}
														?></td>
 												<td></td>
 												<td></td>
 												<td><?php echo $cuttingProduction = $seventeenPerCut;
														$seventeenPerCut = 0; ?></td>
 											</tr>


 											<!-- 420 শুরু ভেরিয়েবল ধরার জন্য এই কাজটি করতে হবে -->

 											<?php //echo "kfold-" . $this->session->userdata('kf') . "kfold--";
												$kfBuyAmountAfterTwoPer = $kfBuyAmount + ($kfBuyAmount * 2 / 100);
												//echo "<br>";
												if ($kfBuyMds != 0) {
													$kataMdsKf = $kfBuyMds * 15 / 100;
													//echo "<br>";
													$KataTakaKf = $kataMdsKf * $cuttingRate;
													//echo "<br>";
													$kfAmountAfterSeventeenPer = $kfBuyAmountAfterTwoPer - $KataTakaKf;
												} else {
													$KataTakaKf = 0;
													$kfAmountAfterSeventeenPer = 0;
												}
												?>
 											<?php //echo "kfold-" . $this->session->userdata('kf') . "kfold--";
												$whBuyAmountAfterTwoPer = $whBuyAmount + ($whBuyAmount * 2 / 100);;
												//echo "<br>";
												if ($whBuyMds != 0) {
													$kataMdsWh = $whBuyMds * 15 / 100;
													$KataTakaWh = $kataMdsWh * $cuttingRate;
													//echo "<br>";
													$whAmountAfterSeventeenPer = $whBuyAmountAfterTwoPer - $KataTakaWh;
												} else {
													$KataTakaWh = 0;
													$whAmountAfterSeventeenPer = 0;
												}
												//echo "<br>";
												//echo "+++++++++++++++++++++++";
												?>


 											<?php
												//getting Amount
												if ($grades) {
													$kf = 0;
													$wh = 0;
													$seventeenPerCutTaka = 0;
													$this->session->set_userdata('kf', $kf);
													$this->session->set_userdata('wh', $wh);
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id
												?>
 													<?php
														$currentMonthPurchase = currentMonthPurchase($grade->j_g_id, 'jpiv_amount');
														$amountAfterAddTwoPer = $currentMonthPurchase + ($currentMonthPurchase * 2 / 100);

														//echo "<br>";

														$mainValue = currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds');
														if ($grade->j_g_title == 'D1') {
															$kataMds = ($mainValue * 15) / 100;
															//echo "<br>";
															$KataTaka = $kataMds * $cuttingRate;
															//echo "<br>";
															$amountAfterSeventeenPer[$g] = $amountAfterAddTwoPer - $KataTaka;

															$seventeenPerCutTaka += $KataTaka;
															$mainValue = $mainValue - $kataMds;
															//$gradeSum[$g] += $mainValue;
															//echo $mainValue;
														} elseif ($grade->j_g_title == 'D2') {
															$kataMds = ($mainValue * 15) / 100;
															//echo "<br>";
															$KataTaka = $kataMds * $cuttingRate;
															//echo "<br>";
															$amountAfterSeventeenPer[$g] = $amountAfterAddTwoPer - $KataTaka;

															$seventeenPerCutTaka += $KataTaka;
															$mainValue = $mainValue - $kataMds;
															//$gradeSum[$g] += $mainValue;
															//echo $mainValue;
														} elseif ($grade->j_g_title == 'D3') {
															$kataMds = ($mainValue * 15) / 100;
															//echo "<br>";
															$KataTaka = $kataMds * $cuttingRate;
															// "<br>";
															$amountAfterSeventeenPer[$g] = $amountAfterAddTwoPer - $KataTaka;

															$seventeenPerCutTaka += $KataTaka;
															$mainValue = $mainValue - $kataMds;
															//$gradeSum[$g] += $mainValue;
															//echo $mainValue;
														} elseif ($grade->j_g_title == 'Mill_C') {
															$kataMds = ($mainValue * 15) / 100;
															//echo "<br>";
															$KataTaka = $kataMds * $cuttingRate;
															//echo "<br>";
															$amountAfterSeventeenPer[$g] =  $amountAfterAddTwoPer - $KataTaka;

															$seventeenPerCutTaka += $KataTaka;
															$mainValue = $mainValue - $kataMds;
															//$gradeSum[$g] += $mainValue;
															//echo $mainValue;
														} elseif ($grade->j_g_title == 'Cutt') {
															//$gradeSum[$g] += $mainValue + $seventeenPerCut;
															//echo "fffff";
															$amountAfterSeventeenPer[$g] = $amountAfterAddTwoPer + $seventeenPerCutTaka + $KataTakaKf + $KataTakaWh;
															//$seventeenPerCut = 0;
														} else {
															$amountAfterSeventeenPer[$g] =  $amountAfterAddTwoPer;
															//$gradeSum[$g] += $mainValue;
															//echo $mainValue;
														}


														?>
 											<?php
													}
												}
												?>

 											<!-- খতম ভেরিয়েবল ধরার জন্য এই কাজটি করতে হবে -->
 											<tr style="background-color:#d3edfb">
 												<td>Average Pucca Rate</td>
 												<?php
													// Getting Mds
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td>
 															<?php
																if ($amountAfterSeventeenPer[$g] != 0) {

																	echo $amountAfterSeventeenPer[$g] / $gradeMdsAfterSeventeenPer[$g];
																} else {
																	echo 0;
																}

																?>
 														</td>
 												<?php
														}
													}
													?>
 												<td><?php
														if ($kfBuyAmount != 0) {
															echo $kfAmountAfterSeventeenPer / $kfMdsAfterSeventeenPer;
														} else {
															echo 0;
														}
														?></td>
 												<td><?php
														if ($whBuyAmount != 0) {
															echo $whAmountAfterSeventeenPer / $whMdsAfterSeventeenPer;
														} else {
															echo 0;
														}
														?></td>
 												<td></td>
 												<td></td>
 												<td>
 													<?php echo $cuttingRate;
														?>
 												</td>
 											</tr>
 											<tr style="background-color:#d3edfb">
 												<td>Amount</td>
 												<?php
													//getting Amount
													if ($grades) {
														$kf = 0;
														$wh = 0;
														$seventeenPerCutTaka = 0;
														$this->session->set_userdata('kf', $kf);
														$this->session->set_userdata('wh', $wh);
														foreach ($grades->result() as $grade) {
													?>
 														<td>
 															<?php
																$currentMonthPurchase = currentMonthPurchase($grade->j_g_id, 'jpiv_amount');
																$amountAfterAddTwoPer = $currentMonthPurchase + ($currentMonthPurchase * 2 / 100);

																//echo "<br>";

																$mainValue = currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds');
																if ($grade->j_g_title == 'D1') {
																	$kataMds = ($mainValue * 15) / 100;
																	//echo "<br>";
																	$KataTaka = $kataMds * $cuttingRate;
																	//echo "<br>";
																	echo $amountAfterAddTwoPer - $KataTaka;

																	$seventeenPerCutTaka += $KataTaka;
																	$mainValue = $mainValue - $kataMds;
																	//$gradeSum[$g] += $mainValue;
																	//echo $mainValue;
																} elseif ($grade->j_g_title == 'D2') {
																	$kataMds = ($mainValue * 15) / 100;
																	//echo "<br>";
																	$KataTaka = $kataMds * $cuttingRate;
																	//echo "<br>";
																	echo $amountAfterAddTwoPer - $KataTaka;

																	$seventeenPerCutTaka += $KataTaka;
																	$mainValue = $mainValue - $kataMds;
																	//$gradeSum[$g] += $mainValue;
																	//echo $mainValue;
																} elseif ($grade->j_g_title == 'D3') {
																	$kataMds = ($mainValue * 15) / 100;
																	//echo "<br>";
																	$KataTaka = $kataMds * $cuttingRate;
																	// "<br>";
																	echo $amountAfterAddTwoPer - $KataTaka;

																	$seventeenPerCutTaka += $KataTaka;
																	$mainValue = $mainValue - $kataMds;
																	//$gradeSum[$g] += $mainValue;
																	//echo $mainValue;
																} elseif ($grade->j_g_title == 'Mill_C') {
																	$kataMds = ($mainValue * 15) / 100;
																	//echo "<br>";
																	$KataTaka = $kataMds * $cuttingRate;
																	//echo "<br>";
																	echo $amountAfterAddTwoPer - $KataTaka;

																	$seventeenPerCutTaka += $KataTaka;
																	$mainValue = $mainValue - $kataMds;
																	//$gradeSum[$g] += $mainValue;
																	//echo $mainValue;
																} elseif ($grade->j_g_title == 'Cutt') {
																	//$gradeSum[$g] += $mainValue + $seventeenPerCut;
																	//echo "fffff";
																	echo $amountAfterAddTwoPer + $seventeenPerCutTaka + $KataTakaKf + $KataTakaWh;
																	//$seventeenPerCut = 0;
																} else {
																	echo $amountAfterAddTwoPer;
																	//$gradeSum[$g] += $mainValue;
																	//echo $mainValue;
																}


																?>
 														</td>
 												<?php
														}
													}
													?>
 												<td><?php //echo "kfold-" . $this->session->userdata('kf') . "kfold--";
														$kfBuyAmountAfterTwoPer = $kfBuyAmount + ($kfBuyAmount * 2 / 100);
														//echo "<br>";
														if ($kfBuyMds != 0) {
															$kataMdsKf = $kfBuyMds * 15 / 100;
															//echo "<br>";
															$KataTaka = $kataMdsKf * $cuttingRate;
															//echo "<br>";
															echo $kfBuyAmountAfterTwoPer - $KataTaka;
														} else {
															echo 0;
														}
														?></td>
 												<td><?php //echo "kfold-" . $this->session->userdata('kf') . "kfold--";
														$whBuyAmountAfterTwoPer = $whBuyAmount + ($whBuyAmount * 2 / 100);;
														//echo "<br>";
														if ($whBuyMds != 0) {
															$kataMdsWh = $whBuyMds * 15 / 100;
															$KataTaka = $kataMdsWh * $cuttingRate;
															//echo "<br>";
															echo $whBuyAmountAfterTwoPer - $KataTaka;
														} else {
															echo 0;
														}
														?></td>
 												<td></td>
 												<td></td>
 												<td>
 													<?= $cuttingProduction * $cuttingRate
														?>
 												</td>
 											</tr>
 											<!-- 421 Opening + Purchased -->
 											<?php
												// veriable dhorar jonno
												if ($grades) {
													foreach ($grades->result() as $grade) {
														$g = $grade->j_g_id;
														$openingAndPurchaseAmount[$g] = $amountAfterSeventeenPer[$g] + $openingAmount[$g];
													}
												}
												?>
 											<tr style="background-color:#eced61">
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Opening + Purchased </td>
 												<td>Opening Quantity Monds</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $openingAndPurchaseMds[$g] = $gradeMdsAfterSeventeenPer[$g] + $openingMds[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?php echo $openingAndPurchaseMdsKf = $kfMdsAfterSeventeenPer + $kfOpeningMds; ?></td>
 												<td><?php echo $openingAndPurchaseMdsWh = $whMdsAfterSeventeenPer + $whOpeningMds; ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#eced61">
 												<td>Opening Average Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?php if ($openingAndPurchaseAmount[$g] != 0) {
																	echo $openingAndPurchaseAve[$g] = $openingAndPurchaseAmount[$g] / $openingAndPurchaseMds[$g];
																} else {
																	echo $openingAndPurchaseAve[$g] = 0;
																} ?></td>
 												<?php
														}
													}
													?>
 												<td>
 													<?php if ($kfAmountAfterSeventeenPer != 0) {
															echo $openingAndPurchaseAveKf = ($kfAmountAfterSeventeenPer + $kfOpeningAmount) / ($kfMdsAfterSeventeenPer + $kfOpeningMds);
														} else {
															$openingAndPurchaseAveKf = 0;
														} ?>
 												</td>
 												<td>
 													<?php if ($whAmountAfterSeventeenPer != 0) {
															echo $openingAndPurchaseAveWh = ($whAmountAfterSeventeenPer + $whOpeningAmount) / ($whMdsAfterSeventeenPer + $whOpeningMds);
														} else {
															$openingAndPurchaseAveWh = 0;
														} ?>
 												</td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#eced61">
 												<td>Opening Amount</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $amountAfterSeventeenPer[$g] + $openingAmount[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $kfAmountAfterSeventeenPer + $kfOpeningAmount; ?></td>
 												<td><?= $whAmountAfterSeventeenPer + $whOpeningAmount; ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Issue-->
 											<tr style="background-color:#f7c1f3">
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Issue </td>
 												<td>Total Quantity Monds</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $currentMonthIssue[$g] = currentMonthIssue($grade->j_g_id, 'isv_issue') ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $currentMonthIssueKf = currentMonthIssue('kf', 'isv_issue') ?></td>
 												<td><?= $currentMonthIssueWh = currentMonthIssue('wh', 'isv_issue') ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#e7c1f7">
 												<td>Average Issue Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $openingAndPurchaseAve[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $openingAndPurchaseAveKf ?></td>
 												<td><?= $openingAndPurchaseAveWh ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#e7c1f7">
 												<td>Amount</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $openingAndPurchaseAve[$g] * $currentMonthIssue[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $openingAndPurchaseAveKf * $currentMonthIssueKf ?></td>
 												<td><?= $openingAndPurchaseAveWh * $currentMonthIssueWh ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Sale-->
 											<tr style="background-color:#ffaeba">
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Sale </td>
 												<td>Total Quantity Monds</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $currentMonthIssue[$g] = currentMonthIssue($grade->j_g_id, 'isv_issue') ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $currentMonthIssueKf = currentMonthIssue('kf', 'isv_issue') ?></td>
 												<td><?= $currentMonthIssueWh = currentMonthIssue('wh', 'isv_issue') ?></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#ffaeba">
 												<td>Average Issue Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $openingAndPurchaseAve[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $openingAndPurchaseAveKf ?></td>
 												<td><?= $openingAndPurchaseAveWh ?></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr style="background-color:#ffaeba">
 												<td>Amount</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $openingAndPurchaseAve[$g] * $currentMonthIssue[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $openingAndPurchaseAveKf * $currentMonthIssueKf ?></td>
 												<td><?= $openingAndPurchaseAveWh * $currentMonthIssueWh ?></td>
 												<td></td>
 												<td></td>

 											</tr>
 											<!-- Start Adjustment -->
 											<tr style="background-color:#ff3351">
 												<td></td>
 												<td>Adjustment</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td></td>
 												<?php
														}
													}
													?>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- end Adjustment -->
 											<!-- 423 CL. Balance -->
 											<tr>
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">CL. Balance </td>
 												<td>Closing Quantity Monds</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $closingMds[$g] = $openingAndPurchaseMds[$g] - $currentMonthIssue[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $closingMdsKf = $openingAndPurchaseMdsKf - $currentMonthIssueKf ?></td>
 												<td><?= $closingMdsWh = $openingAndPurchaseMdsWh - $currentMonthIssueWh ?></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Closing Average Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $openingAndPurchaseAve[$g] ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $openingAndPurchaseAveKf ?></td>
 												<td><?= $openingAndPurchaseAveWh ?></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Closing Amount</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
															$g = $grade->j_g_id;
													?>
 														<td><?= $closingMds[$g] * $openingAndPurchaseAve[$g]  ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $openingAndPurchaseAveKf * $closingMdsKf ?></td>
 												<td><?= $openingAndPurchaseAveWh * $closingMdsWh ?></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 										</tbody>
 									</table>
 								</div>
 								<input type="hidden" name="">
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<!-- <button type="submit" class="btn btn-info">Submit</button> -->
 								</div>
 							</div>
 						</form>
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