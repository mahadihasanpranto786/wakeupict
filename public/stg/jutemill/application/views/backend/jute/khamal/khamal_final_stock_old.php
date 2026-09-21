<!-- Content Wrapper. Contains page content -->
<?php
$sinigami = 17;
?>
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Khamal Final Stock OLD</h1>
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
						<li class="breadcrumb-item active">Khamal Final Stock</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- Unassorted Added deduct report -->

	<?php

	if (!$year) {
		$y = year();
	} else {
		$y = $year;
	}
	if (!$month) {
		$m = month();
	} else {
		$m = $month;
	}

	$jute_grades = $this->M_grade->getJuteGrade();

	$khamalStock = array();
	$khamalExpense = array();
	$gradeSum = array();
	foreach ($jute_grades->result() as $grade) {
		$g = $grade->j_g_id;
		$gradeSum[$g] = 0;
	}
	$gradeSum['1000'] = 0;
	$gradeSum['1001'] = 0;
	$totalMDSMAX = 0;

	$khamalBojha = array();

	$allGodown = $this->Common->get_data_single_conditional('godown', 'g_status', 1);
	//if ($allGodown) {
	//foreach ($allGodown->result() as $godown) {


	//$godownHasKhamal = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', $godown->g_id);
	$allKhamal = $this->M_khamal->getKhamal();

	foreach ($allKhamal->result() as $khamals) {
		if ($khamals->kh_used == 1) {
			//echo '<pre>';
			//print_r($khamals);
			$me = $khamals->kh_id;
			$sql = "SELECT SUM(kh_ua_a_s_ot_rec_bojha_no) as totalsum
									FROM khamal_unassorted_added_summary
									WHERE kh_ua_a_s_kh_id = '$me'
									AND kh_ua_a_s_status = 1
									AND YEAR(kh_ua_a_s_en_date)<='$y' AND MONTH(kh_ua_a_s_en_date)<='$m'";

			$bojhaIncome = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$sql = "SELECT SUM(kh_ua_d_s_bojha_no) as totalsum
									FROM khamal_unassorted_deduction_summary
									WHERE kh_ua_d_s_kh_id = '$me'
									AND kh_ua_d_s_status = 1
									AND YEAR(kh_ua_d_s_date)<='$y' AND MONTH(kh_ua_d_s_date)<='$m'";
			$bojhaExpense = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$khamalBojha[$khamals->kh_id] = $bojhaIncome - $bojhaExpense;


			if ($jute_grades) {
				foreach ($jute_grades->result() as $grade) {


					$sql = "SELECT SUM(kh_ua_a_v_value) as totalsum
									FROM khamal_unassorted_added_value
									JOIN khamal_unassorted_added_summary ON khamal_unassorted_added_summary.kh_ua_a_s_id = khamal_unassorted_added_value.kh_ua_a_v_s_id
									WHERE kh_ua_a_s_kh_id = '$me'
									AND kh_ua_a_s_status = 1
									AND kh_ua_a_v_j_g_id = '$grade->j_g_id'
									AND YEAR(kh_ua_a_s_en_date)<='$y' AND MONTH(kh_ua_a_s_en_date)<='$m'";

					$khamalStock[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum) + openingKamal($f_year = 1, $grade->j_g_id, $me);

					$sql = "SELECT SUM(kh_ua_d_v_value) as totalsum
							FROM khamal_unassorted_deduction_value
							JOIN khamal_unassorted_deduction_summary ON khamal_unassorted_deduction_summary.kh_ua_d_s_id = khamal_unassorted_deduction_value.kh_ua_d_v_s_id
							WHERE kh_ua_d_s_kh_id = '$me'
							AND kh_ua_d_s_status = 1
							AND kh_ua_d_v_j_g_id = '$grade->j_g_id'
							AND YEAR(kh_ua_d_s_date)<='$y' AND MONTH(kh_ua_d_s_date)<='$m'";

					$khamalExpense[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
				}
			}
		}
		// 2
		if ($khamals->kh_used == 2) {
			//echo '<pre>';
			//print_r($khamals);
			$me = $khamals->kh_id;
			$sql = "SELECT SUM(kh_auc_a_s_bojha_no) as totalsum
									FROM khamal_assorted_uncut_added_summary
									WHERE kh_auc_a_s_kh_id = '$me'
									AND kh_auc_a_s_status = 1
									AND YEAR(kh_auc_a_s_date)<='$y' AND MONTH(kh_auc_a_s_date)<='$m'";

			$bojhaIncome = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$sql = "SELECT SUM(kh_auc_d_s_bojha_no) as totalsum
									FROM khamal_assorted_uncut_deduction_summary
									WHERE kh_auc_d_s_kh_id = '$me'
									AND kh_auc_d_s_status = 1
									AND YEAR(kh_auc_d_s_date)<='$y' AND MONTH(kh_auc_d_s_date)<='$m'";
			$bojhaExpense = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$khamalBojha[$khamals->kh_id] = $bojhaIncome - $bojhaExpense;


			if ($jute_grades) {
				foreach ($jute_grades->result() as $grade) {


					$sql = "SELECT SUM(kh_auc_a_v_value) as totalsum
									FROM khamal_assorted_uncut_added_value
									JOIN khamal_assorted_uncut_added_summary ON khamal_assorted_uncut_added_summary.kh_auc_a_s_id = khamal_assorted_uncut_added_value.kh_auc_a_v_s_id
									WHERE kh_auc_a_s_kh_id = '$me'
									AND kh_auc_a_s_status = 1
									AND kh_auc_a_v_j_g_id = '$grade->j_g_id'
									AND YEAR(kh_auc_a_s_date)<='$y' AND MONTH(kh_auc_a_s_date)<='$m'";

					$khamalStock[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);

					$sql = "SELECT SUM(kh_auc_d_v_value) as totalsum
							FROM khamal_assorted_uncut_deduction_value
							JOIN khamal_assorted_uncut_deduction_summary ON khamal_assorted_uncut_deduction_summary.kh_auc_d_s_id = khamal_assorted_uncut_deduction_value.kh_auc_d_v_s_id
							WHERE kh_auc_d_s_kh_id = '$me'
							AND kh_auc_d_s_status = 1
							AND kh_auc_d_v_j_g_id = '$grade->j_g_id'
							AND YEAR(kh_auc_d_s_date)<='$y' AND MONTH(kh_auc_d_s_date)<='$m'";

					$khamalExpense[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
				}
			}
		}
		//3
		if ($khamals->kh_used == 3) {
			//echo '<pre>';
			//print_r($khamals);
			$me = $khamals->kh_id;
			$sql = "SELECT SUM(kh_ac_a_s_bojha_no) as totalsum
									FROM khamal_assorted_cut_added_summary
									WHERE kh_ac_a_s_kh_id = '$me'
									AND kh_ac_a_s_status = 1
									AND YEAR(kh_ac_a_s_date)<='$y' AND MONTH(kh_ac_a_s_date)<='$m'";

			$bojhaIncome = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$sql = "SELECT SUM(kh_ac_d_s_bojha_no) as totalsum
									FROM khamal_assorted_cut_deduction_summary
									WHERE kh_ac_d_s_kh_id = '$me'
									AND kh_ac_d_s_status = 1
									AND YEAR(kh_ac_d_s_date)<='$y' AND MONTH(kh_ac_d_s_date)<='$m'";
			$bojhaExpense = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$khamalBojha[$khamals->kh_id] = $bojhaIncome - $bojhaExpense;


			if ($jute_grades) {
				foreach ($jute_grades->result() as $grade) {


					$sql = "SELECT SUM(kh_ac_a_v_value) as totalsum
									FROM khamal_assorted_cut_added_value
									JOIN khamal_assorted_cut_added_summary ON khamal_assorted_cut_added_summary.kh_ac_a_s_id = khamal_assorted_cut_added_value.kh_ac_a_v_s_id
									WHERE kh_ac_a_s_kh_id = '$me'
									AND kh_ac_a_s_status = 1
									AND kh_ac_a_v_j_g_id = '$grade->j_g_id'
									AND YEAR(kh_ac_a_s_date)<='$y' AND MONTH(kh_ac_a_s_date)<='$m'";

					$khamalStock[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);

					$sql = "SELECT SUM(kh_ac_d_v_value) as totalsum
							FROM khamal_assorted_cut_deduction_value
							JOIN khamal_assorted_cut_deduction_summary ON khamal_assorted_cut_deduction_summary.kh_ac_d_s_id = khamal_assorted_cut_deduction_value.kh_ac_d_v_s_id
							WHERE kh_ac_d_s_kh_id = '$me'
							AND kh_ac_d_s_status = 1
							AND kh_ac_d_v_j_g_id = '$grade->j_g_id'
							AND YEAR(kh_ac_d_s_date)<='$y' AND MONTH(kh_ac_d_s_date)<='$m'";

					$khamalExpense[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
				}
			}
		}
	}
	//}
	//}
	?>


	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- Assorted Uncut Added -->
				<div class="col-12">
					<div class="card card-info mt-3">
						<!-- Get From Helper -->
						<?php filterReportNav("Khamal Jute UnAssorted Balance Report", "jute/Khamal/khamalFinalStockOld", $year, $month, $date); ?>
						<!-- /.card-header -->
						<div class="row">
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">Khamal Jute UnAssorted Balance After Deduction</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th colspan="2">GRAND TOTAL Mds. =</th>
											<th></th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th>
													<?php ?>
												</th>
											<?php } ?>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<thead>
										<tr>
											<th>Godown No.</th>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<?php
									$bojhaMaxUltra = 0;
									if ($godowns) {
										foreach ($godowns->result() as $godown) { ?>
											<tbody>
												<?php
												$godownHasKhamal = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', $godown->g_id);
												foreach ($godownHasKhamal->result() as $khamals) {
													if ($khamals->kh_used == 1) {
												?>
														<tr>
															<td rowspan=""><?= $godown->g_title  ?></td>
															<td class="align-middle">
																<?php
																echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
																$khamals->kh_title;
																?>
															</td>
															<td class="align-middle">
																<?php
																echo $khamalBojha[$khamals->kh_id];
																$bojhaMaxUltra += $khamalBojha[$khamals->kh_id];
																?>
															</td>
															<?php
															$kf = 0;
															$wh = 0;
															$totalMds = 0;
															if ($jute_grades) foreach ($jute_grades->result() as $grade) {
																$k = $khamals->kh_id;
																$g = $grade->j_g_id;
																$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
																$totalMds += $mainValue;

															?>
																<td class="align-middle combat">
																	<?php
																	if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																		$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
																		$mainValue += $x;
																		$gradeSum['1000'] += $mainValue;
																		$kf = $mainValue;
																	} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																		$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
																		$mainValue += $x;
																		$gradeSum['1001'] += $mainValue;
																		$wh = $mainValue;
																	} else {
																		$gradeSum[$g] += $mainValue;
																		echo $mainValue;
																	}
																	?>
																</td>
															<?php } ?>
															<td class="">
																<?= $kf
																?>
															</td>
															<td class="">
																<?= $wh
																?>
															</td>
															<td class="">
																<?php echo  $totalMds;
																$totalMDSMAX += $totalMds;
																?>
															</td>
													<?php
													} else {
														//Khamal Na Thakla error asa tai eita dilam 16.10.2022
														$totalMds = 0;
													}
												} ?>

														</tr>
														<tr class="table-warning">
															<td>Total = </td>
															<td></td>
															<td><?php
																echo $bojhaMaxUltra;
																$bojhaMaxUltra = 0;
																?>
															</td>
															<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
																<td class="align-middle">
																	<?php
																	$g = $grade->j_g_id;
																	echo $gradeSum[$g];
																	$gradeSum[$g] = 0;
																	?>
																</td>
															<?php } ?>
															<td>
																<?php
																echo $gradeSum['1000'];
																$gradeSum['1000'] = 0;
																?>
															</td>
															<td>
																<?php
																echo $gradeSum['1001'];
																$gradeSum['1001'] = 0;
																?>
															</td>
															<td class="">
																<?php
																//$totalMDSMAX += $totalMds;
																echo $totalMDSMAX;
																$totalMDSMAX = 0;
																?>
															</td>
														</tr>
														<tr>
															<td></td>
														</tr>
											</tbody>
									<?php }
									} ?>
									<!-- Godown Ni ja khamal Tar Jonno -->
									<?php
									$noGodownKhamals = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', '');
									foreach ($noGodownKhamals->result() as $noGodownKhamal) {
										if ($noGodownKhamal->kh_used == 1) {
									?>
											<tr>
												<td rowspan=""></td>
												<td class="align-middle">
													<?php
													echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
													$noGodownKhamal->kh_title;
													?>
												</td>
												<td class="align-middle">
													<?php
													echo $khamalBojha[$noGodownKhamal->kh_id];
													$bojhaMaxUltra += $khamalBojha[$noGodownKhamal->kh_id];
													?>
												</td>
												<?php
												$kf = 0;
												$wh = 0;
												$totalMds = 0;
												if ($jute_grades) foreach ($jute_grades->result() as $grade) {
													$k = $noGodownKhamal->kh_id;
													$g = $grade->j_g_id;
													$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
													$totalMds += $mainValue;

												?>
													<td class="align-middle combat">
														<?php
														if ($noGodownKhamal->kh_ar_id == 4 && $grade->j_g_id == '1') {
															$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
															$mainValue += $x;
															$gradeSum['1000'] += $mainValue;
															$kf = $mainValue;
														} elseif ($noGodownKhamal->kh_ar_id == 5 && $grade->j_g_id == '1') {
															$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
															$mainValue += $x;
															$gradeSum['1001'] += $mainValue;
															$wh = $mainValue;
														} else {
															$gradeSum[$g] += $mainValue;
															echo $mainValue;
														}
														?>
													</td>
												<?php } ?>
												<td class="">
													<?= $kf
													?>
												</td>
												<td class="">
													<?= $wh
													?>
												</td>
												<td class="">
													<?php echo  $totalMds;
													//$totalMDSMAX += $totalMds;
													?>
												</td>

											</tr>
											<tr>
												<td></td>
											</tr>
									<?php }
									} ?>

								</table>
							</div>
							<!-- ============ To Be after final Assort & Pucca Form ============ -->
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">To Be after final Assort & cutting $sinigami% & Pucca Form</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th colspan="2">GRAND TOTAL Mds. =</th>
											<th></th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th>
													<?php ?>
												</th>
											<?php } ?>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<thead>
										<tr>
											<th>Godown No.</th>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<?php
									$bojhaMaxUltra = 0;
									if ($godowns) {
										foreach ($godowns->result() as $godown) { ?>
											<tbody>
												<?php
												$godownHasKhamal = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', $godown->g_id);
												foreach ($godownHasKhamal->result() as $khamals) {
													if ($khamals->kh_used == 1) {
												?>
														<tr>
															<td rowspan=""><?= $godown->g_title  ?></td>
															<td class="align-middle">
																<?php
																echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
																$khamals->kh_title;
																?>
															</td>
															<td class="align-middle">
																<?php
																echo $khamalBojha[$khamals->kh_id];
																$bojhaMaxUltra += $khamalBojha[$khamals->kh_id];
																?>
															</td>
															<?php
															$kf = 0;
															$wh = 0;
															$totalMds = 0;
															$dmilCut = 0;
															if ($jute_grades) foreach ($jute_grades->result() as $grade) {
																$k = $khamals->kh_id;
																$g = $grade->j_g_id;
																$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
																$totalMds += $mainValue;

															?>
																<td class="align-middle combat">
																	<?php
																	if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {

																		$kataTaka = ($mainValue * $sinigami) / 100;
																		$dmilCut += $kataTaka;
																		$mainValue = $mainValue - $kataTaka;

																		$gradeSum['1000'] += $mainValue;
																		$kf = $mainValue;
																	} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																		$kataTaka = ($mainValue * $sinigami) / 100;
																		$dmilCut += $kataTaka;
																		$mainValue = $mainValue - $kataTaka;
																		$gradeSum['1001'] += $mainValue;
																		$wh = $mainValue;
																	} else {
																		if ($grade->j_g_title == 'D1') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSum[$g] += $mainValue;
																			echo $mainValue;
																		} elseif ($grade->j_g_title == 'D2') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSum[$g] += $mainValue;
																			echo $mainValue;
																		} elseif ($grade->j_g_title == 'D3') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSum[$g] += $mainValue;
																			echo $mainValue;
																		} elseif ($grade->j_g_title == 'Mill_C') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSum[$g] += $mainValue;
																			echo $mainValue;
																		} elseif ($grade->j_g_title == 'Cutt') {
																			$gradeSum[$g] += $mainValue + $dmilCut;
																			echo $mainValue + $dmilCut;
																			$dmilCut = 0;
																		} else {
																			$gradeSum[$g] += $mainValue;
																			echo $mainValue;
																		}
																	}
																	?>
																</td>
															<?php } ?>
															<td class="">
																<?= $kf
																?>
															</td>
															<td class="">
																<?= $wh
																?>
															</td>
															<td class="">
																<?php echo  $totalMds;
																$totalMDSMAX += $totalMds;
																?>
															</td>
													<?php
													}
												} ?>

														</tr>
														<tr class="table-warning">
															<td>Total = </td>
															<td></td>
															<td><?php
																echo $bojhaMaxUltra;
																$bojhaMaxUltra = 0;
																?>
															</td>
															<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
																<td class="align-middle">
																	<?php
																	$g = $grade->j_g_id;
																	echo $gradeSum[$g];
																	$gradeSum[$g] = 0;
																	?>
																</td>
															<?php } ?>
															<td>
																<?php
																echo $gradeSum['1000'];
																$gradeSum['1000'] = 0;
																?>
															</td>
															<td>
																<?php
																echo $gradeSum['1001'];
																$gradeSum['1001'] = 0;
																?>
															</td>
															<td class="">
																<?php
																//$totalMDSMAX += $totalMds;
																echo $totalMDSMAX;
																$totalMDSMAX = 0;
																?>
															</td>
														</tr>
														<tr>
															<td></td>
														</tr>
											</tbody>
									<?php }
									} ?>
									<!-- Godown Ni ja khamal Tar Jonno || To Be after final Assort & Pucca Form -->
									<?php
									$noGodownKhamals = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', '');
									foreach ($noGodownKhamals->result() as $noGodownKhamal) {
										if ($noGodownKhamal->kh_used == 1) {
									?>
											<tr>
												<td rowspan=""><?= $godown->g_title  ?></td>
												<td class="align-middle">
													<?php
													echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
													$noGodownKhamal->kh_title;
													?>
												</td>
												<td class="align-middle">
													<?php
													echo $khamalBojha[$noGodownKhamal->kh_id];
													$bojhaMaxUltra += $khamalBojha[$noGodownKhamal->kh_id];
													?>
												</td>
												<?php
												$kf = 0;
												$wh = 0;
												$totalMds = 0;
												$dmilCut = 0;
												if ($jute_grades) foreach ($jute_grades->result() as $grade) {
													$k = $noGodownKhamal->kh_id;
													$g = $grade->j_g_id;
													$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
													$totalMds += $mainValue;

												?>
													<td class="align-middle combat">
														<?php
														if ($noGodownKhamal->kh_ar_id == 4 && $grade->j_g_id == '1') {

															$kataTaka = ($mainValue * $sinigami) / 100;
															$dmilCut += $kataTaka;
															$mainValue = $mainValue - $kataTaka;

															$gradeSum['1000'] += $mainValue;
															$kf = $mainValue;
														} elseif ($noGodownKhamal->kh_ar_id == 5 && $grade->j_g_id == '1') {
															$kataTaka = ($mainValue * $sinigami) / 100;
															$dmilCut += $kataTaka;
															$mainValue = $mainValue - $kataTaka;
															$gradeSum['1001'] += $mainValue;
															$wh = $mainValue;
														} else {
															if ($grade->j_g_title == 'D1') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															} elseif ($grade->j_g_title == 'D2') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															} elseif ($grade->j_g_title == 'D3') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															} elseif ($grade->j_g_title == 'Mill_C') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															} elseif ($grade->j_g_title == 'Cutt') {
																$gradeSum[$g] += $mainValue + $dmilCut;
																echo $mainValue + $dmilCut;
																$dmilCut = 0;
															} else {
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															}
														}
														?>
													</td>
												<?php } ?>
												<td class="">
													<?= $kf
													?>
												</td>
												<td class="">
													<?= $wh
													?>
												</td>
												<td class="">
													<?php echo  $totalMds;
													//$totalMDSMAX += $totalMds;
													?>
												</td>

											</tr>
											<tr>
												<td></td>
											</tr>
									<?php }
									} ?>
								</table>
							</div>
							<!-- .row -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Assorted uncut Added deduct report -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- Assorted Uncut Added -->
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="row">
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">Assorted Kachcha Form After Deduction</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Godown No.</th>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<?php
									$bojhaMaxUltra = 0;
									//if ($godowns) {
									//foreach ($godowns->result() as $godown) { 
									?>
									<tbody>
										<?php
										//$godownHasKhamal = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', $godown->g_id);
										$allKhamal = $this->M_khamal->getKhamal();
										foreach ($allKhamal->result() as $khamals) {
											if ($khamals->kh_used == 2) {
										?>
												<tr>
													<td rowspan=""></td>
													<td class="align-middle">
														<?php
														echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
														$khamals->kh_title;
														?>
													</td>
													<td class="align-middle">
														<?php
														echo $khamalBojha[$khamals->kh_id];
														$bojhaMaxUltra += $khamalBojha[$khamals->kh_id];
														?>
													</td>
													<?php
													$kf = 0;
													$wh = 0;
													$totalMds = 0;
													if ($jute_grades) foreach ($jute_grades->result() as $grade) {
														$k = $khamals->kh_id;
														$g = $grade->j_g_id;
														$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
														$totalMds += $mainValue;

													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																$gradeSum['1000'] += $mainValue;
																$kf = $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$gradeSum['1001'] += $mainValue;
																$wh = $mainValue;
															} else {
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= $kf
														?>
													</td>
													<td class="">
														<?= $wh
														?>
													</td>
													<td class="">
														<?php echo  $totalMds;
														$totalMDSMAX += $totalMds;
														?>
													</td>
											<?php
											}
										} ?>

												</tr>
												<tr class="table-warning">
													<td>Total = </td>
													<td></td>
													<td><?php
														echo $bojhaMaxUltra;
														$bojhaMaxUltra = 0;
														?>
													</td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">
															<?php
															$g = $grade->j_g_id;
															echo $gradeSum[$g];
															$gradeSum[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSum['1000'];
														$gradeSum['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSum['1001'];
														$gradeSum['1001'] = 0;
														?>
													</td>
													<td class="">
														<?php
														//$totalMDSMAX += $totalMds;
														echo $totalMDSMAX;
														$totalMDSMAX = 0;
														?>
													</td>
												</tr>
									</tbody>
									<?php //}
									//} 
									?>
								</table>
							</div>
							<!-- ============ To Be after final Assort & Pucca Form ============ -->
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">To Be after final Assort & cutting $sinigami% & Pucca Form</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Godown No.</th>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<?php
									$bojhaMaxUltra = 0;
									//if ($godowns) {
									//foreach ($godowns->result() as $godown) { 
									?>
									<tbody>
										<?php
										//$godownHasKhamal = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', $godown->g_id);
										$allKhamal = $this->M_khamal->getKhamal();
										foreach ($allKhamal->result() as $khamals) {
											if ($khamals->kh_used == 2) {
										?>
												<tr>
													<td rowspan=""></td>
													<td class="align-middle">
														<?php
														echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
														$khamals->kh_title;
														?>
													</td>
													<td class="align-middle">
														<?php
														echo $khamalBojha[$khamals->kh_id];
														$bojhaMaxUltra += $khamalBojha[$khamals->kh_id];
														?>
													</td>
													<?php
													$kf = 0;
													$wh = 0;
													$totalMds = 0;
													$dmilCut = 0;
													if ($jute_grades) foreach ($jute_grades->result() as $grade) {
														$k = $khamals->kh_id;
														$g = $grade->j_g_id;
														$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
														$totalMds += $mainValue;

													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {

																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;

																$gradeSum['1000'] += $mainValue;
																$kf = $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSum['1001'] += $mainValue;
																$wh = $mainValue;
															} else {
																if ($grade->j_g_title == 'D1') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'D2') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'D3') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'Mill_C') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'Cutt') {
																	$gradeSum[$g] += $mainValue + $dmilCut;
																	echo $mainValue + $dmilCut;
																	$dmilCut = 0;
																} else {
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																}
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= $kf
														?>
													</td>
													<td class="">
														<?= $wh
														?>
													</td>
													<td class="">
														<?php echo  $totalMds;
														$totalMDSMAX += $totalMds;
														?>
													</td>
											<?php
											}
										} ?>

												</tr>
												<tr class="table-warning">
													<td>Total = </td>
													<td></td>
													<td><?php
														echo $bojhaMaxUltra;
														$bojhaMaxUltra = 0;
														?>
													</td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">
															<?php
															$g = $grade->j_g_id;
															echo $gradeSum[$g];
															$gradeSum[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSum['1000'];
														$gradeSum['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSum['1001'];
														$gradeSum['1001'] = 0;
														?>
													</td>
													<td class="">
														<?php
														//$totalMDSMAX += $totalMds;
														echo $totalMDSMAX;
														$totalMDSMAX = 0;
														?>
													</td>
												</tr>
									</tbody>
									<?php //}
									//} 
									?>
								</table>
							</div>
							<!-- .row -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- ------------ Assorted Cut Added deduct report ------------- -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- Assorted Added -->
				<div class="col-12">
					<div class="card card-info mt-3">
						<!-- /.card-header -->
						<div class="row">
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">Khamal Jute Assorted Cut Balance </p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Godown No.</th>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<?php
									$bojhaMaxUltra = 0;
									//if ($godowns) {
									//foreach ($godowns->result() as $godown) { 
									?>
									<tbody>
										<?php
										//$godownHasKhamal = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', $godown->g_id);
										$allKhamal = $this->M_khamal->getKhamal();
										foreach ($allKhamal->result() as $khamals) {
											if ($khamals->kh_used == 3) {
										?>
												<tr>
													<td rowspan=""></td>
													<td class="align-middle">
														<?php
														echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
														$khamals->kh_title;
														?>
													</td>
													<td class="align-middle">
														<?php
														echo $khamalBojha[$khamals->kh_id];
														$bojhaMaxUltra += $khamalBojha[$khamals->kh_id];
														?>
													</td>
													<?php
													$kf = 0;
													$wh = 0;
													$totalMds = 0;
													if ($jute_grades) foreach ($jute_grades->result() as $grade) {
														$k = $khamals->kh_id;
														$g = $grade->j_g_id;
														$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
														$totalMds += $mainValue;

													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																$gradeSum['1000'] += $mainValue;
																$kf = $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$gradeSum['1001'] += $mainValue;
																$wh = $mainValue;
															} else {
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= $kf
														?>
													</td>
													<td class="">
														<?= $wh
														?>
													</td>
													<td class="">
														<?php echo  $totalMds;
														$totalMDSMAX += $totalMds;
														?>
													</td>
											<?php
											}
										} ?>

												</tr>
												<tr class="table-warning">
													<td>Total = </td>
													<td></td>
													<td><?php
														echo $bojhaMaxUltra;
														$bojhaMaxUltra = 0;
														?>
													</td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">pp
															<?php
															$g = $grade->j_g_id;
															echo $gradeSum[$g];
															$gradeSum[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSum['1000'];
														$gradeSum['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSum['1001'];
														$gradeSum['1001'] = 0;
														?>
													</td>
													<td class="">fff
														<?php
														//$totalMDSMAX += $totalMds;
														echo $totalMDSMAX;
														$totalMDSMAX = 0;
														?>
													</td>
												</tr>
									</tbody>
									<?php //}
									//} 
									?>
								</table>
							</div>
							<!-- ============ To Be after final Assort & Pucca Form ============ -->
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">To Be after pucca form & cutting $sinigami%</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Godown No.</th>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<?php
									$bojhaMaxUltra = 0;
									//if ($godowns) {
									//foreach ($godowns->result() as $godown) { 
									?>
									<tbody>
										<?php
										//$godownHasKhamal = $this->Common->get_data_single_conditional('khamal', 'kh_g_id', $godown->g_id);
										$allKhamal = $this->M_khamal->getKhamal();
										foreach ($allKhamal->result() as $khamals) {
											if ($khamals->kh_used == 3) {
										?>
												<tr>
													<td rowspan=""></td>
													<td class="align-middle">
														<?php
														echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
														$khamals->kh_title;
														?>
													</td>
													<td class="align-middle">
														<?php
														echo $khamalBojha[$khamals->kh_id];
														$bojhaMaxUltra += $khamalBojha[$khamals->kh_id];
														?>
													</td>
													<?php
													$kf = 0;
													$wh = 0;
													$totalMds = 0;
													if ($jute_grades) foreach ($jute_grades->result() as $grade) {
														$k = $khamals->kh_id;
														$g = $grade->j_g_id;
														$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
														$totalMds += $mainValue;

													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																$gradeSum['1000'] += $mainValue;
																$kf = $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$gradeSum['1001'] += $mainValue;
																$wh = $mainValue;
															} else {
																$gradeSum[$g] += $mainValue;
																echo $mainValue;
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= $kf
														?>
													</td>
													<td class="">
														<?= $wh
														?>
													</td>
													<td class="">
														<?php echo  $totalMds;
														$totalMDSMAX += $totalMds;
														?>
													</td>
											<?php
											}
										} ?>

												</tr>
												<tr class="table-warning">
													<td>Total = </td>
													<td></td>
													<td><?php
														echo $bojhaMaxUltra;
														$bojhaMaxUltra = 0;
														?>
													</td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">
															<?php
															$g = $grade->j_g_id;
															echo $gradeSum[$g];
															$gradeSum[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSum['1000'];
														$gradeSum['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSum['1001'];
														$gradeSum['1001'] = 0;
														?>
													</td>
													<td class="">
														<?php
														//$totalMDSMAX += $totalMds;
														echo $totalMDSMAX;
														$totalMDSMAX = 0;
														?>
													</td>
												</tr>
									</tbody>
									<?php //}
									//} 
									?>
								</table>
							</div>
							<!-- .row -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>




	<h1 class="">Running Stock</h1>
	<!-- ------------ Unsorted Long Jute Form ------------- -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- UN Assorted -->
				<div class="col-12">
					<div class="card card-info mt-3">
						<!-- /.card-header -->
						<div class="row">
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">Unassorted Long Jute Form</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<tbody>
										<?php $grandTotal = 0;
										$bojhaTotal = 0;
										if ($runningStockSummary) {
											foreach ($runningStockSummary->result() as $summary) {

												if ($summary->khrss_used == 1) {
										?>
													<tr>
														<td class="align-middle"><?php $find = $this->M_khamal->getKhamalById($summary->khrss_kh_id);
																					if (!empty($find)) {
																						echo $this->M_khamal->getKhamalById($summary->khrss_kh_id)->kh_title;
																					} else {
																						echo "N/A";
																					} ?></td>
														<td class="align-middle">
															<?php echo  $summary->khrss_bojha;
															$bojhaTotal += $summary->khrss_bojha ?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id; ?>
															<td>
																<?php echo getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																$gradeSum[$g] += getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id); ?>
															</td>
														<?php } ?>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("kf", $summary->khrss_id);
															$gradeSum['1000'] += getKhamalRunningStockValue("kf", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("wh", $summary->khrss_id);
															$gradeSum['1001'] += getKhamalRunningStockValue("wh", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php echo $summary->khrss_total;
															$grandTotal += $summary->khrss_total; ?>
														</td>
													</tr>
										<?php }
											}
										} ?>
										<tr class="table-warning">
											<td class="align-middle">Total =</td>
											<td class="align-middle">
												<?php
												echo $bojhaTotal;
												$bojhaTotal = 0; ?>
											</td>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<td>
													<?php $g = $grade->j_g_id;
													echo $gradeSum[$g];
													$gradeSum[$g] = 0; ?>
												</td>
											<?php } ?>
											<td class="align-middle">
												<?php
												echo $gradeSum['1000'];
												$gradeSum['1000'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $gradeSum['1001'];
												$gradeSum['1001'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $grandTotal;
												$grandTotal = 0; ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- ============ To Be after final Assort & Pucca Form ============ -->
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">To Be after final Assort & Pucca Form</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
										<?php $grandTotal = 0;
										$bojhaTotal = 0;
										if ($runningStockSummary) {
											foreach ($runningStockSummary->result() as $summary) {

												if ($summary->khrss_used == 1) {
										?>
													<tr>
														<?php $dmilCut = 0;
														if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$mainValue = getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
															$g = $grade->j_g_id; ?>
															<td>
																<?php
																if ($grade->j_g_title == 'D1') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'D2') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'D3') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'Mill_C') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} elseif ($grade->j_g_title == 'Cutt') {
																	$gradeSum[$g] += $mainValue + $dmilCut;
																	echo $mainValue + $dmilCut;
																	$dmilCut = 0;
																} else {
																	$gradeSum[$g] += $mainValue;
																	echo $mainValue;
																} ?>
															</td>
														<?php } ?>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("kf", $summary->khrss_id);
															$gradeSum['1000'] += getKhamalRunningStockValue("kf", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("wh", $summary->khrss_id);
															$gradeSum['1001'] += getKhamalRunningStockValue("wh", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php echo $summary->khrss_total;
															$grandTotal += $summary->khrss_total; ?>
														</td>
														<td class="align-middle text-danger"><?= $summary->khrss_description ?></td>
													</tr>
										<?php }
											}
										} ?>
										<tr class="table-warning">
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<td>
													<?php $g = $grade->j_g_id;
													echo $gradeSum[$g];
													$gradeSum[$g] = 0; ?>
												</td>
											<?php } ?>
											<td class="align-middle">
												<?php
												echo $gradeSum['1000'];
												$gradeSum['1000'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $gradeSum['1001'];
												$gradeSum['1001'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $grandTotal;
												$grandTotal = 0; ?>
											</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- .row -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ------------ Assorted Kachcha Form ------------- -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- Assorted Added -->
				<div class="col-12">
					<div class="card card-info mt-3">
						<!-- /.card-header -->
						<div class="row">
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">Assorted Kachcha Form</p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<tbody>
										<?php $grandTotal = 0;
										$bojhaTotal = 0;
										if ($runningStockSummary) {
											foreach ($runningStockSummary->result() as $summary) {

												if ($summary->khrss_used == 2) {
										?>
													<tr>
														<td class="align-middle"><?php $find = $this->M_khamal->getKhamalById($summary->khrss_kh_id);
																					if (!empty($find)) {
																						echo $this->M_khamal->getKhamalById($summary->khrss_kh_id)->kh_title;
																					} else {
																						echo "N/A";
																					} ?></td>
														<td class="align-middle">
															<?php echo  $summary->khrss_bojha;
															$bojhaTotal += $summary->khrss_bojha ?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id; ?>
															<td>
																<?php echo getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																$gradeSum[$g] += getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id); ?>
															</td>
														<?php } ?>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("kf", $summary->khrss_id);
															$gradeSum['1000'] += getKhamalRunningStockValue("kf", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("wh", $summary->khrss_id);
															$gradeSum['1001'] += getKhamalRunningStockValue("wh", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php echo $summary->khrss_total;
															$grandTotal += $summary->khrss_total; ?>
														</td>
													</tr>
										<?php }
											}
										} ?>
										<tr class="table-warning">
											<td class="align-middle">Total =</td>
											<td class="align-middle">
												<?php
												echo $bojhaTotal;
												$bojhaTotal = 0; ?>
											</td>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<td>
													<?php $g = $grade->j_g_id;
													echo $gradeSum[$g];
													$gradeSum[$g] = 0; ?>
												</td>
											<?php } ?>
											<td class="align-middle">
												<?php
												echo $gradeSum['1000'];
												$gradeSum['1000'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $gradeSum['1001'];
												$gradeSum['1001'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $grandTotal;
												$grandTotal = 0; ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- ============ To Be after final Assort & Pucca Form ============ -->
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">To Be after Pucca Form </p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<th>Description</th>
										</tr>
									</thead>
									<?php if ($runningStockSummary) {
										foreach ($runningStockSummary->result() as $summary) {
											if ($summary->khrss_used == 2) {
									?>
												<tbody>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td><?= getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id); ?></td>
													<?php } ?>
													<td class="align-middle"><?= getKhamalRunningStockValue("kf", $summary->khrss_id); ?></td>
													<td class="align-middle"><?= getKhamalRunningStockValue("wh", $summary->khrss_id); ?></td>
													<td class="align-middle"><?= $summary->khrss_total ?></td>
													<td class="align-middle text-danger"><?= $summary->khrss_description ?></td>
												</tbody>
									<?php }
										}
									} ?>
								</table>
							</div>
							<!-- .row -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ------------ Assorted Pacha Form ------------- -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- Assorted Added -->
				<div class="col-12">
					<div class="card card-info mt-3">
						<!-- /.card-header -->
						<div class="row">
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">Present Pucca Form </p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<tbody>
										<?php $grandTotal = 0;
										$bojhaTotal = 0;
										if ($runningStockSummary) {
											foreach ($runningStockSummary->result() as $summary) {

												if ($summary->khrss_used == 3) {
										?>
													<tr>
														<td class="align-middle"><?php $find = $this->M_khamal->getKhamalById($summary->khrss_kh_id);
																					if (!empty($find)) {
																						echo $this->M_khamal->getKhamalById($summary->khrss_kh_id)->kh_title;
																					} else {
																						echo "N/A";
																					} ?></td>
														<td class="align-middle">
															<?php echo  $summary->khrss_bojha;
															$bojhaTotal += $summary->khrss_bojha ?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id; ?>
															<td>
																<?php echo getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																$gradeSum[$g] += getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id); ?>
															</td>
														<?php } ?>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("kf", $summary->khrss_id);
															$gradeSum['1000'] += getKhamalRunningStockValue("kf", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php
															echo getKhamalRunningStockValue("wh", $summary->khrss_id);
															$gradeSum['1001'] += getKhamalRunningStockValue("wh", $summary->khrss_id); ?>
														</td>
														<td class="align-middle">
															<?php echo $summary->khrss_total;
															$grandTotal += $summary->khrss_total; ?>
														</td>
													</tr>
										<?php }
											}
										} ?>
										<tr class="table-warning">
											<td class="align-middle">Total =</td>
											<td class="align-middle">
												<?php
												echo $bojhaTotal;
												$bojhaTotal = 0; ?>
											</td>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<td>
													<?php $g = $grade->j_g_id;
													echo $gradeSum[$g];
													$gradeSum[$g] = 0; ?>
												</td>
											<?php } ?>
											<td class="align-middle">
												<?php
												echo $gradeSum['1000'];
												$gradeSum['1000'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $gradeSum['1001'];
												$gradeSum['1001'] = 0;
												?></td>
											<td class="align-middle">
												<?php
												echo $grandTotal;
												$grandTotal = 0; ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- ============ To Be after final Assort & Pucca Form ============ -->
							<div class="card-body col-6" style="overflow-x: scroll;">
								<p class="text-danger">Present Pucca Form </p>
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<th>Description</th>
										</tr>
									</thead>
									<?php if ($runningStockSummary) {
										foreach ($runningStockSummary->result() as $summary) {
											if ($summary->khrss_used == 3) {
									?>
												<tbody>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td><?= getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id); ?></td>
													<?php } ?>
													<td class="align-middle"><?= getKhamalRunningStockValue("kf", $summary->khrss_id); ?></td>
													<td class="align-middle"><?= getKhamalRunningStockValue("wh", $summary->khrss_id); ?></td>
													<td class="align-middle"><?= $summary->khrss_total ?></td>
													<td class="align-middle text-danger"><?= $summary->khrss_description ?></td>
												</tbody>
									<?php }
										}
									} ?>
								</table>
							</div>
							<!-- .row -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
