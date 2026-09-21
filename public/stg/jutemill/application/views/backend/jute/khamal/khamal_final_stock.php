<!-- Content Wrapper. Contains page content -->
<style>
	.table th,
	.table td {
		padding: 0.5rem !important;
	}
</style>
<?php
$sinigami = 17;
?>
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Khamal Final Stock </h1>
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

	<?php

	$jute_grades = $this->M_grade->getJuteGrade();

	$khamalStock = array();
	$khamalExpense = array();
	$gradeSum = array();
	$gradeSum2 = array();
	$gradeSum3 = array();
	$gradeSumToBe = array();
	$gradeSumToBe2 = array();
	$gradeSumToBe3 = array();
	$gradeSumRunning = array();
	$gradeSumRunningToBe = array();
	$grandTotalGrade = array();
	$grandTotalRunningGrade = array();
	foreach ($jute_grades->result() as $grade) {
		$g = $grade->j_g_id;
		$gradeSum[$g] = 0;
		$gradeSum2[$g] = 0;
		$gradeSum3[$g] = 0;
		$gradeSumToBe[$g] = 0;
		$gradeSumToBe2[$g] = 0;
		$gradeSumToBe3[$g] = 0;
		$gradeSumRunning[$g] = 0;
		$gradeSumRunningToBe[$g] = 0;
		$grandTotalGrade[$g] = 0;
		$grandTotalRunningGrade[$g] = 0;
	}
	$gradeSum['1000'] = 0;
	$gradeSum['1001'] = 0;
	$gradeSumToBe['1000'] = 0;
	$gradeSumToBe['1001'] = 0;
	$gradeSum2['1000'] = 0;
	$gradeSum2['1001'] = 0;
	$gradeSumToBe2['1000'] = 0;
	$gradeSumToBe2['1001'] = 0;
	$gradeSum3['1000'] = 0;
	$gradeSum3['1001'] = 0;
	$gradeSumToBe3['1000'] = 0;
	$gradeSumToBe3['1001'] = 0;
	$gradeSumRunning['1000'] = 0;
	$gradeSumRunning['1001'] = 0;
	$gradeSumRunningToBe['1000'] = 0;
	$gradeSumRunningToBe['1001'] = 0;
	$grandTotalGrade['1000'] = 0;
	$grandTotalGrade['1001'] = 0;
	$grandTotalRunningGrade['1000'] = 0;
	$grandTotalRunningGrade['1001'] = 0;
	$totalMDSMAX = 0;
	$totalMDSMAXToBe = 0;

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
									AND kh_ua_a_s_en_date <= CONCAT(LAST_DAY('$y-$m-01'), ' 17:00:00')";

			$bojhaIncome = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$sql = "SELECT SUM(kh_ua_d_s_bojha_no) as totalsum
									FROM khamal_unassorted_deduction_summary
									WHERE kh_ua_d_s_kh_id = '$me'
									AND kh_ua_d_s_status = 1
									AND kh_ua_d_s_date <= LAST_DAY('$y-$m-01')";
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
									AND kh_ua_a_s_en_date <= CONCAT(LAST_DAY('$y-$m-01'), ' 17:00:00')";

					$khamalStock[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum) + openingKamal($f_year = 1, $grade->j_g_id, $me);

					$sql = "SELECT SUM(kh_ua_d_v_value) as totalsum
							FROM khamal_unassorted_deduction_value
							JOIN khamal_unassorted_deduction_summary ON khamal_unassorted_deduction_summary.kh_ua_d_s_id = khamal_unassorted_deduction_value.kh_ua_d_v_s_id
							WHERE kh_ua_d_s_kh_id = '$me'
							AND kh_ua_d_s_status = 1
							AND kh_ua_d_v_j_g_id = '$grade->j_g_id'
							AND kh_ua_d_s_date <= LAST_DAY('$y-$m-01')";

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
									AND kh_auc_a_s_date <= LAST_DAY('$y-$m-01')";

			$bojhaIncome = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$sql = "SELECT SUM(kh_auc_d_s_bojha_no) as totalsum
									FROM khamal_assorted_uncut_deduction_summary
									WHERE kh_auc_d_s_kh_id = '$me'
									AND kh_auc_d_s_status = 1
									AND kh_auc_d_s_date <= LAST_DAY('$y-$m-01')";
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
									AND kh_auc_a_s_date <= LAST_DAY('$y-$m-01')";

					$khamalStock[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum) + openingKamal($f_year = 1, $grade->j_g_id, $me);

					$sql = "SELECT SUM(kh_auc_d_v_value) as totalsum
							FROM khamal_assorted_uncut_deduction_value
							JOIN khamal_assorted_uncut_deduction_summary ON khamal_assorted_uncut_deduction_summary.kh_auc_d_s_id = khamal_assorted_uncut_deduction_value.kh_auc_d_v_s_id
							WHERE kh_auc_d_s_kh_id = '$me'
							AND kh_auc_d_s_status = 1
							AND kh_auc_d_v_j_g_id = '$grade->j_g_id'
							AND kh_auc_d_s_date <= LAST_DAY('$y-$m-01')";

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
									AND kh_ac_a_s_date <= LAST_DAY('$y-$m-01')";

			$bojhaIncome = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
			$sql = "SELECT SUM(kh_ac_d_s_bojha_no) as totalsum
									FROM khamal_assorted_cut_deduction_summary
									WHERE kh_ac_d_s_kh_id = '$me'
									AND kh_ac_d_s_status = 1
									AND kh_ac_d_s_date <= LAST_DAY('$y-$m-01')";
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
									AND kh_ac_a_s_date <= LAST_DAY('$y-$m-01')";

					$khamalStock[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum) + openingKamal($f_year = 1, $grade->j_g_id, $me);

					$sql = "SELECT SUM(kh_ac_d_v_value) as totalsum
							FROM khamal_assorted_cut_deduction_value
							JOIN khamal_assorted_cut_deduction_summary ON khamal_assorted_cut_deduction_summary.kh_ac_d_s_id = khamal_assorted_cut_deduction_value.kh_ac_d_v_s_id
							WHERE kh_ac_d_s_kh_id = '$me'
							AND kh_ac_d_s_status = 1
							AND kh_ac_d_v_j_g_id = '$grade->j_g_id'
							AND kh_ac_d_s_date <= LAST_DAY('$y-$m-01')";

					$khamalExpense[$me][$grade->j_g_id] = initialZero($this->Common->sql_excute($sql)->result()[0]->totalsum);
				}
			}
		}
	}
	//}
	//}
	?>


	<!-- Un Assorted Long Jute Form -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<!-- Get From Helper -->
						<?php filterReportNav("Khamal Jute UnAssorted Balance Report", "jute/Khamal/khamalFinalStock", $y, $m, $date); ?>
						<!-- /.card-header -->
						<div class="row">
							<div class="card-body">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th colspan="13" style="text-align:right">GRAND TOTAL Mds. =</th>
											<th class="table-info"></th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th id="khamalStockGradeSumDataShow<?= $grade->j_g_id ?>"></th>
											<?php } ?>
											<th id="khamalStockGradeSumDataKfShow"></th>
											<th id="khamalStockGradeSumDataWhShow"></th>
											<th id="khamalFinalStockGrandTotalMdsShow"></th>
										</tr>
										<tr>
											<td colspan="13" class="text-danger">
												Un Assorted Long Jute Form
											</td>
											<th class="table-info"></th>
											<td colspan="12" class="text-danger">
												To Be after final Assort & Pucca Form
											</td>
										</tr>
										<tr>
											<th>God. No.</th>
											<th>Khamal No.</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<td class="table-info"></td>
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
																$openingBojha = openingBojha($f_year = 1, $khamals->kh_id);
																echo $khamalBojha[$khamals->kh_id] + $openingBojha;
																$bojhaMaxUltra += $khamalBojha[$khamals->kh_id] + $openingBojha;
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
																//$totalMds += $mainValue;

															?>
																<td class="align-middle combat">
																	<?php
																	if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																		$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
																		$mainValue += $x;
																		$gradeSum['1000'] += $mainValue;
																		$kf = $mainValue;
																		$totalMds += $mainValue;
																	} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																		$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
																		$mainValue += $x;
																		$gradeSum['1001'] += $mainValue;
																		$wh = $mainValue;
																		$totalMds += $mainValue;
																	} else {
																		$gradeSum[$g] += $mainValue;
																		echo number_currency_format($mainValue, 2);
																		$totalMds += $mainValue;
																	}
																	?>
																</td>
															<?php } ?>
															<td class="">
																<?= number_currency_format($kf, 2)
																?>
															</td>
															<td class="">
																<?= number_currency_format($wh, 2)
																?>
															</td>
															<td class="">
																<?php echo  number_currency_format($totalMds, 2);
																$totalMDSMAX += $totalMds;
																?>
															</td>
															<td class="table-info"></td>
															<?php
															$kf = 0;
															$wh = 0;
															$totalMdsToBe = 0;
															$dmilCut = 0;
															if ($jute_grades) foreach ($jute_grades->result() as $grade) {
																$k = $khamals->kh_id;
																$g = $grade->j_g_id;
																$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];


															?>
																<td class="align-middle combat">
																	<?php
																	if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																		$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
																		$kataTaka = (($mainValue + $x) * $sinigami) / 100;
																		$dmilCut += $kataTaka;
																		$mainValue = $mainValue + $x - $kataTaka;

																		$gradeSumToBe['1000'] += $mainValue;
																		$kf = $mainValue;
																		$totalMdsToBe += $mainValue;
																	} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																		$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
																		$kataTaka = (($mainValue + $x) * $sinigami) / 100;
																		$dmilCut += $kataTaka;
																		$mainValue = $mainValue + $x - $kataTaka;
																		$gradeSumToBe['1001'] += $mainValue;
																		$wh = $mainValue;
																		$totalMdsToBe += $mainValue;
																	} else {
																		if ($grade->j_g_title == 'D1') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSumToBe[$g] += $mainValue;
																			echo number_currency_format($mainValue, 2);
																			$totalMdsToBe += $mainValue;
																		} elseif ($grade->j_g_title == 'D2') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSumToBe[$g] += $mainValue;
																			echo number_currency_format($mainValue, 2);
																			$totalMdsToBe += $mainValue;
																		} elseif ($grade->j_g_title == 'D3') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSumToBe[$g] += $mainValue;
																			echo number_currency_format($mainValue, 2);
																			$totalMdsToBe += $mainValue;
																		} elseif ($grade->j_g_title == 'Mill_C') {
																			$kataTaka = ($mainValue * $sinigami) / 100;
																			$dmilCut += $kataTaka;
																			$mainValue = $mainValue - $kataTaka;
																			$gradeSumToBe[$g] += $mainValue;
																			echo number_currency_format($mainValue, 2);
																			$totalMdsToBe += $mainValue;
																		} elseif ($grade->j_g_title == 'Cutt') {
																			$gradeSumToBe[$g] += $mainValue + $dmilCut;
																			$mainValue = $mainValue + $dmilCut;
																			echo number_currency_format($mainValue, 2);
																			$totalMdsToBe += $mainValue;
																			$dmilCut = 0;
																		} else {
																			$gradeSumToBe[$g] += $mainValue;
																			echo number_currency_format($mainValue, 2);
																			$totalMdsToBe += $mainValue;
																		}
																	}
																	?>
																</td>
															<?php } ?>
															<td class="">
																<?= number_currency_format($kf, 2)
																?>
															</td>
															<td class="">
																<?= number_currency_format($wh, 2)
																?>
															</td>
															<td class="">
																<?php echo number_currency_format($totalMdsToBe, 2);
																$totalMDSMAXToBe += $totalMdsToBe;
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
																echo number_currency_format($bojhaMaxUltra, 2);
																$bojhaMaxUltra = 0;
																?>
															</td>
															<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
																<td class="align-middle">
																	<?php
																	$g = $grade->j_g_id;
																	echo number_currency_format($gradeSum[$g], 2);
																	$gradeSum[$g] = 0;
																	?>
																</td>
															<?php } ?>
															<td>
																<?php
																echo number_currency_format($gradeSum['1000'], 2);
																$gradeSum['1000'] = 0;
																?>
															</td>
															<td>
																<?php
																echo number_currency_format($gradeSum['1001'], 2);
																$gradeSum['1001'] = 0;
																?>
															</td>
															<td class="">
																<?php
																//$totalMDSMAX += $totalMds;
																echo number_currency_format($totalMDSMAX, 2);
																$totalMDSMAX = 0;
																?>
															</td>
															<td class="table-info"></td>
															<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
																<td class="align-middle">
																	<?php
																	$g = $grade->j_g_id;
																	echo number_currency_format($gradeSumToBe[$g], 2);
																	$grandTotalGrade[$g] += $gradeSumToBe[$g];
																	$gradeSumToBe[$g] = 0;
																	?>
																</td>
															<?php } ?>
															<td>
																<?php
																echo number_currency_format($gradeSumToBe['1000'], 2);
																$grandTotalGrade['1000'] += $gradeSumToBe['1000'];
																$gradeSumToBe['1000'] = 0;
																?>
															</td>
															<td>
																<?php
																echo number_currency_format($gradeSumToBe['1001'], 2);
																$grandTotalGrade['1001'] += $gradeSumToBe['1001'];
																$gradeSumToBe['1001'] = 0;
																?>
															</td>
															<td class="">
																<?php
																//$totalMDSMAX += $totalMds;
																echo number_currency_format($totalMDSMAXToBe, 2);
																$totalMDSMAXToBe = 0;
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
													$openingBojha = openingBojha($f_year = 1, $noGodownKhamal->kh_id);
													echo $khamalBojha[$noGodownKhamal->kh_id] + $openingBojha;
													$bojhaMaxUltra += $khamalBojha[$noGodownKhamal->kh_id] + $openingBojha;
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
													//$totalMds += $mainValue;

												?>
													<td class="align-middle combat">
														<?php
														if ($noGodownKhamal->kh_ar_id == 4 && $grade->j_g_id == '1') {
															$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
															$mainValue += $x;
															$gradeSum['1000'] += $mainValue;
															$kf = $mainValue;
															$totalMds += $mainValue;
														} elseif ($noGodownKhamal->kh_ar_id == 5 && $grade->j_g_id == '1') {
															$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
															$mainValue += $x;
															$gradeSum['1001'] += $mainValue;
															$wh = $mainValue;
															$totalMds += $mainValue;
														} else {
															$gradeSum[$g] += $mainValue;
															echo number_currency_format($mainValue, 2);
															$totalMds += $mainValue;
														}
														?>
													</td>
												<?php } ?>
												<td class="">
													<?= number_currency_format($kf, 2)
													?>
												</td>
												<td class="">
													<?= number_currency_format($wh, 2)
													?>
												</td>
												<td class="">
													<?php echo number_currency_format($totalMds, 2);
													//$totalMDSMAX += $totalMds;
													?>
												</td>
												<td class="table-info"></td>
												<?php
												$kf = 0;
												$wh = 0;
												$totalMdsToBe = 0;
												$dmilCut = 0;
												if ($jute_grades) foreach ($jute_grades->result() as $grade) {
													$k = $noGodownKhamal->kh_id;
													$g = $grade->j_g_id;
													$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];


												?>
													<td class="align-middle combat">
														<?php
														if ($noGodownKhamal->kh_ar_id == 4 && $grade->j_g_id == '1') {
															$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
															$kataTaka = (($mainValue + $x) * $sinigami) / 100;
															$dmilCut += $kataTaka;
															$mainValue = $mainValue + $x - $kataTaka;
															$gradeSumToBe['1000'] += $mainValue;
															$grandTotalGrade['1000'] += $mainValue;
															$kf = $mainValue;
															$totalMdsToBe += $mainValue;
														} elseif ($noGodownKhamal->kh_ar_id == 5 && $grade->j_g_id == '1') {
															$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
															$kataTaka = (($mainValue + $x) * $sinigami) / 100;
															$dmilCut += $kataTaka;
															$mainValue = $mainValue + $x - $kataTaka;
															$gradeSumToBe['1001'] += $mainValue;
															$grandTotalGrade['1001'] += $mainValue;
															$wh = $mainValue;
															$totalMdsToBe += $mainValue;
														} else {
															if ($grade->j_g_title == 'D1') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSumToBe[$g] += $mainValue;
																$grandTotalGrade[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMdsToBe += $mainValue;
															} elseif ($grade->j_g_title == 'D2') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSumToBe[$g] += $mainValue;
																$grandTotalGrade[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMdsToBe += $mainValue;
															} elseif ($grade->j_g_title == 'D3') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSumToBe[$g] += $mainValue;
																$grandTotalGrade[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMdsToBe += $mainValue;
															} elseif ($grade->j_g_title == 'Mill_C') {
																$kataTaka = ($mainValue * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue - $kataTaka;
																$gradeSumToBe[$g] += $mainValue;
																$grandTotalGrade[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMdsToBe += $mainValue;
															} elseif ($grade->j_g_title == 'Cutt') {
																$gradeSumToBe[$g] += $mainValue + $dmilCut;
																$grandTotalGrade[$g] += $mainValue + $dmilCut;
																$mainValue = $mainValue + $dmilCut;
																echo number_currency_format($mainValue, 2);
																$totalMdsToBe += $mainValue;
																$dmilCut = 0;
															} else {
																$gradeSumToBe[$g] += $mainValue;
																$grandTotalGrade[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMdsToBe += $mainValue;
															}
														}
														?>
													</td>
												<?php } ?>
												<td class="">
													<?= number_currency_format($kf, 2)
													?>
												</td>
												<td class="">
													<?= number_currency_format($wh, 2)
													?>
												</td>
												<td class="">
													<?php echo number_currency_format($totalMdsToBe, 2);
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Assorted Kachcha Form -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="row">
							<div class="card-body">
								<div class="row">
									<div class="col-7">
										<p class="text-danger"> Assorted Kachcha Form</p>
									</div>
									<div class="col-5">
										<p class="text-danger">To Be after Pucca Form</p>
									</div>
								</div>
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
											<td class="table-in                                <table class=" table table-bordered table-striped table-hover">
												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>KF-1</th>
										<th>WH-1</th>
										<th>Total Mds.</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$bojhaMaxUltra = 0;
										$allKhamal = $this->M_khamal->getKhamal();
										foreach ($allKhamal->result() as $khamals) {
											if ($khamals->kh_used == 2) {
										?>
												<tr>
													<td class="align-middle">
														<?php
														echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
														$khamals->kh_title;
														?>
													</td>
													<td class="align-middle">
														<?php
														$openingBojha = openingBojha($f_year = 1, $khamals->kh_id);
														echo $khamalBojha[$khamals->kh_id] + $openingBojha;
														$bojhaMaxUltra += $khamalBojha[$khamals->kh_id] + $openingBojha;
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
														//$totalMds += $mainValue;

													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
																$mainValue += $x;
																$gradeSum2['1000'] += $mainValue;
																$kf = $mainValue;
																$totalMds += $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
																$mainValue += $x;
																$gradeSum2['1001'] += $mainValue;
																$wh = $mainValue;
																$totalMds += $mainValue;
															} else {
																$gradeSum2[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMds += $mainValue;
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= number_currency_format($kf, 2)
														?>
													</td>
													<td class="">
														<?= number_currency_format($wh, 2)
														?>
													</td>
													<td class="">
														<?php echo number_currency_format($totalMds, 2);
														$totalMDSMAX += $totalMds;
														?>
													</td>
													<td class="table-info"></td>
													<?php
													$kf = 0;
													$wh = 0;
													$totalMdsToBe = 0;
													$dmilCut = 0;
													if ($jute_grades) foreach ($jute_grades->result() as $grade) {
														$k = $khamals->kh_id;
														$g = $grade->j_g_id;
														$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];


													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
																$kataTaka = (($mainValue + $x) * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue + $x - $kataTaka;

																$gradeSumToBe2['1000'] += $mainValue;
																$grandTotalGrade['1000'] += $mainValue;
																$kf = $mainValue;
																$totalMdsToBe += $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
																$kataTaka = (($mainValue + $x) * $sinigami) / 100;
																$dmilCut += $kataTaka;
																$mainValue = $mainValue + $x - $kataTaka;
																$gradeSumToBe2['1001'] += $mainValue;
																$grandTotalGrade['1001'] += $mainValue;
																$wh = $mainValue;
																$totalMdsToBe += $mainValue;
															} else {
																if ($grade->j_g_title == 'D1') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumToBe2[$g] += $mainValue;
																	$grandTotalGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsToBe += $mainValue;
																} elseif ($grade->j_g_title == 'D2') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumToBe2[$g] += $mainValue;
																	$grandTotalGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsToBe += $mainValue;
																} elseif ($grade->j_g_title == 'D3') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumToBe2[$g] += $mainValue;
																	$grandTotalGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsToBe += $mainValue;
																} elseif ($grade->j_g_title == 'Mill_C') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumToBe2[$g] += $mainValue;
																	$grandTotalGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsToBe += $mainValue;
																} elseif ($grade->j_g_title == 'Cutt') {
																	$gradeSumToBe2[$g] += $mainValue + $dmilCut;
																	$grandTotalGrade[$g] += $mainValue + $dmilCut;
																	$mainValue = $mainValue + $dmilCut;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsToBe += $mainValue;
																	$dmilCut = 0;
																} else {
																	$gradeSumToBe2[$g] += $mainValue;
																	$grandTotalGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsToBe += $mainValue;
																}
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= number_currency_format($kf, 2)
														?>
													</td>
													<td class="">
														<?= number_currency_format($wh, 2)
														?>
													</td>
													<td class="">
														<?php echo number_currency_format($totalMdsToBe, 2);
														$totalMDSMAXToBe += $totalMdsToBe;
														?>
													</td>
											<?php
											}
										} ?>

												</tr>
												<tr class="table-warning">
													<td>Total = </td>
													<td><?php
														echo number_currency_format($bojhaMaxUltra, 2);
														$bojhaMaxUltra = 0;
														?>
													</td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">
															<?php
															$g = $grade->j_g_id;
															echo $gradeSum2[$g];
															$gradeSum2[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSum2['1000'];
														$gradeSum2['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSum2['1001'];
														$gradeSum2['1001'] = 0;
														?>
													</td>
													<td class="">
														<?php
														//$totalMDSMAX += $totalMds;
														echo number_currency_format($totalMDSMAX, 2);
														$totalMDSMAX = 0;
														?>
													</td>
													<td class="table-info"></td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">
															<?php
															$g = $grade->j_g_id;
															echo $gradeSumToBe2[$g];
															$gradeSumToBe2[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSumToBe2['1000'];
														$gradeSumToBe2['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSumToBe2['1001'];
														$gradeSumToBe2['1001'] = 0;
														?>
													</td>
													<td class="">
														<?php
														//$totalMDSMAX += $totalMds;
														echo number_currency_format($totalMDSMAXToBe, 2);
														$totalMDSMAXToBe = 0;
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

	<!-- ------------ Present Pucca Form ------------- -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="row">
							<div class="card-body">
								<div class="row">
									<div class="col-7">
										<p class="text-danger"> Present Pucca Form</p>
									</div>
									<div class="col-5">
										<p class="text-danger">Present Pucca Form</p>
									</div>
								</div>
								<table class=" table table-bordered table-striped table-hover">
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
											<td class="table-info"></td>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$bojhaMaxUltra = 0;
										$allKhamal = $this->M_khamal->getKhamal();
										foreach ($allKhamal->result() as $khamals) {
											if ($khamals->kh_used == 3) {
										?>
												<tr>
													<td class="align-middle">
														<?php
														echo //$this->M_khamal->getKhamalById($khamal->kh_ua_a_s_kh_id)->kh_title; 
														$khamals->kh_title;
														?>
													</td>
													<td class="align-middle">
														<?php
														$openingBojha = openingBojha($f_year = 1, $khamals->kh_id);
														echo $khamalBojha[$khamals->kh_id] + $openingBojha;
														$bojhaMaxUltra += $khamalBojha[$khamals->kh_id] + $openingBojha;
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
														//$totalMds += $mainValue;

													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
																$mainValue += $x;
																$gradeSum3['1000'] += $mainValue;
																$kf = $mainValue;
																$totalMds += $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
																$mainValue += $x;
																$gradeSum3['1001'] += $mainValue;
																$wh = $mainValue;
																$totalMds += $mainValue;
															} else {
																$gradeSum3[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMds += $mainValue;
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= number_currency_format($kf, 2)
														?>
													</td>
													<td class="">
														<?= number_currency_format($wh, 2)
														?>
													</td>
													<td class="">
														<?php echo number_currency_format($totalMds, 2);
														$totalMDSMAX += $totalMds;
														?>
													</td>
													<td class="table-info"></td>
													<?php
													$kf = 0;
													$wh = 0;
													$totalMdsToBe = 0;
													if ($jute_grades) foreach ($jute_grades->result() as $grade) {
														$k = $khamals->kh_id;
														$g = $grade->j_g_id;
														$mainValue = $khamalStock[$k][$g] - $khamalExpense[$k][$g];
														//$totalMds += $mainValue;

													?>
														<td class="align-middle combat">
															<?php
															if ($khamals->kh_ar_id == 4 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'kf', $k);
																$mainValue += $x;
																$gradeSumToBe3['1000'] += $mainValue;
																$grandTotalGrade['1000'] += $mainValue;
																$kf = $mainValue;
																$totalMdsToBe += $mainValue;
															} elseif ($khamals->kh_ar_id == 5 && $grade->j_g_id == '1') {
																$x = openingKamal($f_year = 1, $gradeId = 'wh', $k);
																$mainValue += $x;
																$gradeSumToBe3['1001'] += $mainValue;
																$grandTotalGrade['1001'] += $mainValue;
																$wh = $mainValue;
																$totalMdsToBe += $mainValue;
															} else {
																$gradeSumToBe3[$g] += $mainValue;
																$grandTotalGrade[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMdsToBe += $mainValue;
															}
															?>
														</td>
													<?php } ?>
													<td class="">
														<?= number_currency_format($kf, 2)
														?>
													</td>
													<td class="">
														<?= number_currency_format($wh, 2)
														?>
													</td>
													<td class="">
														<?php echo number_currency_format($totalMdsToBe, 2);
														$totalMDSMAXToBe += $totalMdsToBe;
														?>
													</td>
											<?php
											}
										} ?>

												</tr>
												<tr class="table-warning">
													<td>Total = </td>
													<td><?php
														echo number_currency_format($bojhaMaxUltra, 2);
														$bojhaMaxUltra = 0;
														?>
													</td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">
															<?php
															$g = $grade->j_g_id;
															echo $gradeSum3[$g];
															$gradeSum3[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSum3['1000'];
														$gradeSum3['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSum3['1001'];
														$gradeSum3['1001'] = 0;
														?>
													</td>
													<td class="">
														<?php
														//$totalMDSMAX += $totalMds;
														echo number_currency_format($totalMDSMAX, 2);
														$totalMDSMAX = 0;
														?>
													</td>
													<td class="table-info"></td>
													<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
														<td class="align-middle">
															<?php
															$g = $grade->j_g_id;
															echo $gradeSumToBe3[$g];
															$gradeSumToBe3[$g] = 0;
															?>
														</td>
													<?php } ?>
													<td>
														<?php
														echo $gradeSumToBe3['1000'];
														$gradeSumToBe3['1000'] = 0;
														?>
													</td>
													<td>
														<?php
														echo $gradeSumToBe3['1001'];
														$gradeSumToBe3['1001'] = 0;
														?>
													</td>
													<td class="">
														<?php
														//$totalMDSMAX += $totalMds;
														echo number_currency_format($totalMDSMAXToBe, 2);
														$totalMDSMAXToBe = 0;
														?>
													</td>
												</tr>

									</tbody>
								</table>

								<?php
								foreach ($jute_grades->result() as $grade) {
									$g = $grade->j_g_id; ?>
									<span class="d-none" id='khamalStockGradeSumData<?= $g ?>'><?= $grandTotalGrade[$g] ?></span>
								<?php }
								?>
								<span class="d-none" id="khamalStockGradeSumDataKf"><?= $grandTotalGrade['1000'] ?></span>
								<span class="d-none" id="khamalStockGradeSumDataWh"><?= $grandTotalGrade['1001'] ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- ------------ Running Stock Unsorted Long Jute Form ------------- -->
	<section class="content">
		<h1 class="">Running Stock</h1>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="row">
							<div class="card-body">
								<table class=" table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th colspan="12" style="text-align:right">GRAND TOTAL Mds. =</th>
											<th class="table-info"></th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th id="totalRunningStockDataShow<?= $grade->j_g_id ?>"></th>
											<?php } ?>
											<th id="runningStockGradeSumDataKfShow"></th>
											<th id="runningStockGradeSumDataWhShow"></th>
											<th id="runningStockGradeGrandTotalShow"></th>
											<th></th>
										</tr>
										<tr>
											<td colspan="12" class="text-danger">
												Running Unassorted Long Jute Form
											</td>
											<th class="table-info"></th>
											<td colspan="13" class="text-danger">
												To Be after final Assort & Pucca Form
											</td>
										</tr>
										<tr>
											<th>Khamal No</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<td class="table-info"></td>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<th></th>
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
														<td class="align-middle">
															<?php $find = $this->M_khamal->getKhamalById($summary->khrss_kh_id);
															if (!empty($find)) {
																echo $this->M_khamal->getKhamalById($summary->khrss_kh_id)->kh_title;
															} else {
																echo "N/A";
															} ?>
														</td>
														<td class="align-middle">
															<?php echo  $summary->khrss_bojha;
															$bojhaTotal += $summary->khrss_bojha ?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id; ?>
															<td>
																<?php echo getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																$gradeSumRunning[$g] += getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																?>
															</td>
														<?php } ?>
														<td class="">
															<?php echo getKhamalRunningStockValue('kf', $summary->khrss_id);
															$gradeSumRunning['1000'] += getKhamalRunningStockValue('kf', $summary->khrss_id);
															?>
														</td>
														<td class="">
															<?php echo getKhamalRunningStockValue('wh', $summary->khrss_id);
															$gradeSumRunning['1001'] += getKhamalRunningStockValue('wh', $summary->khrss_id);
															?>
														</td>
														<td class="align-middle">
															<?php echo $summary->khrss_total;
															$grandTotal += $summary->khrss_total; ?>
														</td>
														<td class="table-info"></td>
														<?php
														$totalMdsRunningToBe = 0;
														$dmilCut = 0;

														$mainValue = getKhamalRunningStockValue('kf', $summary->khrss_id);
														$kataTaka = ($mainValue * $sinigami) / 100;
														$dmilCut += $kataTaka;
														$mainValue = $mainValue - $kataTaka;
														$gradeSumRunningToBe['1000'] += $mainValue;
														$grandTotalRunningGrade['1000'] += $mainValue;
														$kf = $mainValue;
														$totalMdsRunningToBe += $mainValue;


														$mainValue = getKhamalRunningStockValue('wh', $summary->khrss_id);
														$kataTaka = ($mainValue * $sinigami) / 100;
														$dmilCut += $kataTaka;
														$mainValue = $mainValue - $kataTaka;
														$gradeSumRunningToBe['1001'] += $mainValue;
														$grandTotalRunningGrade['1001'] += $mainValue;
														$wh = $mainValue;
														$totalMdsRunningToBe += $mainValue;


														if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id;
															$mainValue = getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
														?>
															<td class="align-middle combat">
																<?php
																if ($grade->j_g_title == 'D1') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'D2') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'D3') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'Mill_C') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'Cutt') {
																	$gradeSumRunningToBe[$g] += $mainValue + $dmilCut;
																	$grandTotalRunningGrade[$g] += $mainValue + $dmilCut;
																	$mainValue = $mainValue + $dmilCut;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																	$dmilCut = 0;
																} else {
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																}
																?>
															</td>
														<?php } ?>
														<td class="">
															<?= number_currency_format($kf, 2)
															?>
														</td>
														<td class="">
															<?= number_currency_format($wh, 2)
															?>
														</td>
														<td class="">
															<?php echo  $totalMdsRunningToBe;
															$totalMDSMAXToBe += $totalMdsRunningToBe;
															?>
														</td>
														<td class="align-middle text-danger"><?= $summary->khrss_description ?></td>
											<?php
												}
											}
										} ?>

													</tr>
													<tr class="table-warning">
														<td>Total = </td>
														<td>
															<?php
															echo $bojhaTotal;
															$bojhaMaxUltra = 0;
															?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
															<td class="align-middle">
																<?php
																$g = $grade->j_g_id;
																echo $gradeSumRunning[$g];
																$gradeSumRunning[$g] = 0;
																?>
															</td>
														<?php } ?>
														<td>
															<?php
															echo $gradeSumRunning['1000'];
															$gradeSumRunning['1000'] = 0;
															?>
														</td>
														<td>
															<?php
															echo $gradeSumRunning['1001'];
															$gradeSumRunning['1001'] = 0;
															?>
														</td>
														<td class="align-middle">
															<?php
															echo $grandTotal;
															$grandTotal = 0; ?>
														</td>
														<td class="table-info"></td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
															<td class="align-middle">
																<?php
																$g = $grade->j_g_id;
																echo $gradeSumRunningToBe[$g];
																$gradeSumRunningToBe[$g] = 0;
																?>
															</td>
														<?php } ?>
														<td>
															<?php
															echo $gradeSumRunningToBe['1000'];
															$gradeSumRunningToBe['1000'] = 0;
															?>
														</td>
														<td>
															<?php
															echo $gradeSumRunningToBe['1001'];
															$gradeSumRunningToBe['1001'] = 0;
															?>
														</td>
														<td class="">
															<?php
															//$totalMDSMAX += $totalMds;
															echo number_currency_format($totalMDSMAXToBe, 2);
															$totalMDSMAXToBe = 0;
															?>
														</td>
														<td></td>
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

	<!-- ------------ Running Assorted Kachcha Form ------------- -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="row">
							<div class="card-body">
								<table class=" table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<td colspan="12" class="text-danger">
												Running Assorted Kachcha Form
											</td>
											<th class="table-info"></th>
											<td colspan="13" class="text-danger">
												To Be after Pucca Form
											</td>
										</tr>
										<tr>
											<th>Khamal No</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<td class="table-info"></td>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<th></th>
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
														<td class="align-middle">
															<?php $find = $this->M_khamal->getKhamalById($summary->khrss_kh_id);
															if (!empty($find)) {
																echo $this->M_khamal->getKhamalById($summary->khrss_kh_id)->kh_title;
															} else {
																echo "N/A";
															} ?>
														</td>
														<td class="align-middle">
															<?php echo  $summary->khrss_bojha;
															$bojhaTotal += $summary->khrss_bojha ?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id; ?>
															<td>
																<?php echo getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																$gradeSumRunning[$g] += getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																?>
															</td>
														<?php } ?>
														<td class="">
															<?php echo getKhamalRunningStockValue('kf', $summary->khrss_id);
															$gradeSumRunning['1000'] += getKhamalRunningStockValue('kf', $summary->khrss_id);
															?>
														</td>
														<td class="">
															<?php echo getKhamalRunningStockValue('wh', $summary->khrss_id);
															$gradeSumRunning['1001'] += getKhamalRunningStockValue('wh', $summary->khrss_id);
															?>
														</td>
														<td class="align-middle">
															<?php echo $summary->khrss_total;
															$grandTotal += $summary->khrss_total; ?>
														</td>
														<td class="table-info"></td>
														<?php
														$totalMdsRunningToBe = 0;
														$dmilCut = 0;

														$mainValue = getKhamalRunningStockValue('kf', $summary->khrss_id);
														$kataTaka = ($mainValue * $sinigami) / 100;
														$dmilCut += $kataTaka;
														$mainValue = $mainValue - $kataTaka;
														$gradeSumRunningToBe['1000'] += $mainValue;
														$grandTotalRunningGrade['1000'] += $mainValue;
														$kf = $mainValue;
														$totalMdsRunningToBe += $mainValue;


														$mainValue = getKhamalRunningStockValue('wh', $summary->khrss_id);
														$kataTaka = ($mainValue * $sinigami) / 100;
														$dmilCut += $kataTaka;
														$mainValue = $mainValue - $kataTaka;
														$gradeSumRunningToBe['1001'] += $mainValue;
														$grandTotalRunningGrade['1001'] += $mainValue;
														$wh = $mainValue;
														$totalMdsRunningToBe += $mainValue;


														if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id;
															$mainValue = getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
														?>
															<td class="align-middle combat">
																<?php
																if ($grade->j_g_title == 'D1') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'D2') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'D3') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'Mill_C') {
																	$kataTaka = ($mainValue * $sinigami) / 100;
																	$dmilCut += $kataTaka;
																	$mainValue = $mainValue - $kataTaka;
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																} elseif ($grade->j_g_title == 'Cutt') {
																	$gradeSumRunningToBe[$g] += $mainValue + $dmilCut;
																	$grandTotalRunningGrade[$g] += $mainValue + $dmilCut;
																	$mainValue = $mainValue + $dmilCut;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																	$dmilCut = 0;
																} else {
																	$gradeSumRunningToBe[$g] += $mainValue;
																	$grandTotalRunningGrade[$g] += $mainValue;
																	echo number_currency_format($mainValue, 2);
																	$totalMdsRunningToBe += $mainValue;
																}
																?>
															</td>
														<?php } ?>
														<td class="">
															<?= number_currency_format($kf, 2)
															?>
														</td>
														<td class="">
															<?= number_currency_format($wh, 2)
															?>
														</td>
														<td class="">
															<?php echo  $totalMdsRunningToBe;
															$totalMDSMAXToBe += $totalMdsRunningToBe;
															?>
														</td>
														<td class="align-middle text-danger"><?= $summary->khrss_description ?></td>
											<?php
												}
											}
										} ?>

													</tr>
													<tr class="table-warning">
														<td>Total = </td>
														<td>
															<?php
															echo $bojhaTotal;
															$bojhaMaxUltra = 0;
															?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
															<td class="align-middle">
																<?php
																$g = $grade->j_g_id;
																echo $gradeSumRunning[$g];
																$gradeSumRunning[$g] = 0;
																?>
															</td>
														<?php } ?>
														<td>
															<?php
															echo $gradeSumRunning['1000'];
															$gradeSumRunning['1000'] = 0;
															?>
														</td>
														<td>
															<?php
															echo $gradeSumRunning['1001'];
															$gradeSumRunning['1001'] = 0;
															?>
														</td>
														<td class="align-middle">
															<?php
															echo $grandTotal;
															$grandTotal = 0; ?>
														</td>
														<td class="table-info"></td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
															<td class="align-middle">
																<?php
																$g = $grade->j_g_id;
																echo $gradeSumRunningToBe[$g];
																$gradeSumRunningToBe[$g] = 0;
																?>
															</td>
														<?php } ?>
														<td>
															<?php
															echo $gradeSumRunningToBe['1000'];
															$gradeSumRunningToBe['1000'] = 0;
															?>
														</td>
														<td>
															<?php
															echo $gradeSumRunningToBe['1001'];
															$gradeSumRunningToBe['1001'] = 0;
															?>
														</td>
														<td class="">
															<?php
															//$totalMDSMAX += $totalMds;
															echo number_currency_format($totalMDSMAXToBe, 2);
															$totalMDSMAXToBe = 0;
															?>
														</td>
														<td></td>
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
	<!-- ------------ Assorted Pacha Form ------------- -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="row">
							<div class="card-body">
								<table class=" table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<td colspan="12" class="text-danger">
												Running Present Pucca Form

											</td>
											<th class="table-info"></th>
											<td colspan="13" class="text-danger">
												Present Pucca Form
											</td>
										</tr>
										<tr>
											<th>Khamal No</th>
											<th>Total Bojha</th>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<td class="table-info"></td>
											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
												<th><?= $grade->j_g_title ?></th>
											<?php } ?>
											<th>KF-1</th>
											<th>WH-1</th>
											<th>Total Mds.</th>
											<th></th>
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
														<td class="align-middle">
															<?php $find = $this->M_khamal->getKhamalById($summary->khrss_kh_id);
															if (!empty($find)) {
																echo $this->M_khamal->getKhamalById($summary->khrss_kh_id)->kh_title;
															} else {
																echo "N/A";
															} ?>
														</td>
														<td class="align-middle">
															<?php echo  $summary->khrss_bojha;
															$bojhaTotal += $summary->khrss_bojha ?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id; ?>
															<td>
																<?php echo getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																$gradeSumRunning[$g] += getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
																?>
															</td>
														<?php } ?>
														<td class="">
															<?php echo getKhamalRunningStockValue('kf', $summary->khrss_id);
															$gradeSumRunning['1000'] += getKhamalRunningStockValue('kf', $summary->khrss_id);
															?>
														</td>
														<td class="">
															<?php echo getKhamalRunningStockValue('wh', $summary->khrss_id);
															$gradeSumRunning['1001'] += getKhamalRunningStockValue('wh', $summary->khrss_id);
															?>
														</td>
														<td class="align-middle">
															<?php echo $summary->khrss_total;
															$grandTotal += $summary->khrss_total; ?>
														</td>
														<td class="table-info"></td>
														<?php
														$totalMdsRunningToBe = 0;
														$dmilCut = 0;

														$mainValue = getKhamalRunningStockValue('kf', $summary->khrss_id);
														$gradeSumRunningToBe['1000'] += $mainValue;
														$grandTotalRunningGrade['1000'] += $mainValue;
														$kf = $mainValue;
														$totalMdsRunningToBe += $mainValue;


														$mainValue = getKhamalRunningStockValue('wh', $summary->khrss_id);
														$gradeSumRunningToBe['1001'] += $mainValue;
														$grandTotalRunningGrade['1001'] += $mainValue;
														$wh = $mainValue;
														$totalMdsRunningToBe += $mainValue;


														if ($jute_grades) foreach ($jute_grades->result() as $grade) {
															$g = $grade->j_g_id;
															$mainValue = getKhamalRunningStockValue($grade->j_g_id, $summary->khrss_id);
														?>
															<td class="align-middle combat">
																<?php
																$gradeSumRunningToBe[$g] += $mainValue;
																$grandTotalRunningGrade[$g] += $mainValue;
																echo number_currency_format($mainValue, 2);
																$totalMdsRunningToBe += $mainValue;
																?>
															</td>
														<?php } ?>
														<td class="">
															<?= number_currency_format($kf, 2)
															?>
														</td>
														<td class="">
															<?= number_currency_format($wh, 2)
															?>
														</td>
														<td class="">
															<?php echo  $totalMdsRunningToBe;
															$totalMDSMAXToBe += $totalMdsRunningToBe;
															?>
														</td>
														<td class="align-middle text-danger"><?= $summary->khrss_description ?></td>
											<?php
												}
											}
										} ?>

													</tr>
													<tr class="table-warning">
														<td>Total = </td>
														<td>
															<?php
															echo $bojhaTotal;
															$bojhaMaxUltra = 0;
															?>
														</td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
															<td class="align-middle">
																<?php
																$g = $grade->j_g_id;
																echo $gradeSumRunning[$g];
																$gradeSumRunning[$g] = 0;
																?>
															</td>
														<?php } ?>
														<td>
															<?php
															echo $gradeSumRunning['1000'];
															$gradeSumRunning['1000'] = 0;
															?>
														</td>
														<td>
															<?php
															echo $gradeSumRunning['1001'];
															$gradeSumRunning['1001'] = 0;
															?>
														</td>
														<td class="align-middle">
															<?php
															echo $grandTotal;
															$grandTotal = 0; ?>
														</td>
														<td class="table-info"></td>
														<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
															<td class="align-middle">
																<?php
																$g = $grade->j_g_id;
																echo $gradeSumRunningToBe[$g];
																$gradeSumRunningToBe[$g] = 0;
																?>
															</td>
														<?php } ?>
														<td>
															<?php
															echo $gradeSumRunningToBe['1000'];
															$gradeSumRunningToBe['1000'] = 0;
															?>
														</td>
														<td>
															<?php
															echo $gradeSumRunningToBe['1001'];
															$gradeSumRunningToBe['1001'] = 0;
															?>
														</td>
														<td class="">
															<?php
															//$totalMDSMAX += $totalMds;
															echo number_currency_format($totalMDSMAXToBe, 2);
															$totalMDSMAXToBe = 0;
															?>
														</td>
														<td></td>
													</tr>
									</tbody>
								</table>

								<?php
								foreach ($jute_grades->result() as $grade) {
									$g = $grade->j_g_id; ?>
									<span class="d-none" id='runningStockGradeSumData<?= $g ?>'><?= $grandTotalRunningGrade[$g] ?></span>
								<?php	}
								?>
								<span class="d-none" id="runningStockGradeSumDataKf"><?= $grandTotalRunningGrade['1000'] ?></span>
								<span class="d-none" id="runningStockGradeSumDataWh"><?= $grandTotalRunningGrade['1001'] ?></span>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		// Khamal Running Stock Total Data Assign to grand total
		function khamalRunningStockData() {
			var groupId = []
			<?php
			foreach ($jute_grades->result() as $grade) {
			?>
				groupId.push('<?= $grade->j_g_id ?>')

			<?php } ?>

			var gradeGrandTotalSum = 0;
			var runningStockGrandTotalSum = 0;

			for (let i = 0; i < groupId.length; i++) {
				runningStockGradeWiseTotal = 0;
				gradeWiseGrandTotal = 0;

				// Running Stock Data
				id = groupId[i];
				idName = 'runningStockGradeSumData' + id;
				runningStockGradeWiseTotal = $("#" + idName).text() || 0;
				$('#totalRunningStockDataShow' + id).text(runningStockGradeWiseTotal);

				runningStockGrandTotalSum += parseFloat(runningStockGradeWiseTotal);

				// Grand Total
				idNameNew = 'khamalStockGradeSumData' + id;
				gradeWiseGrandTotal = $("#" + idNameNew).text() || 0;

				var grandTotalCalculateValue = parseFloat(runningStockGradeWiseTotal) + parseFloat(
					gradeWiseGrandTotal);

				gradeGrandTotalSum += parseFloat(grandTotalCalculateValue);

				$('#khamalStockGradeSumDataShow' + id).text(grandTotalCalculateValue.toFixed(2));
			}

			// Running Total 
			var kfRunning = $("#runningStockGradeSumDataKf").text();
			var whRunning = $("#runningStockGradeSumDataWh").text();
			$("#runningStockGradeSumDataKfShow").text(kfRunning);
			$("#runningStockGradeSumDataWhShow").text(whRunning);

			var khamalRunningStockDataSumData = parseFloat(runningStockGrandTotalSum) + parseFloat(kfRunning) +
				parseFloat(whRunning);
			$("#runningStockGradeGrandTotalShow").text(khamalRunningStockDataSumData);


			// Grand Total			
			var kfGrand = $("#khamalStockGradeSumDataKf").text();
			var whGrand = $("#khamalStockGradeSumDataWh").text();

			var grandTotalKfValue = parseFloat(kfRunning) + parseFloat(kfGrand);
			var grandTotalWhValue = parseFloat(whRunning) + parseFloat(whGrand);

			$("#khamalStockGradeSumDataKfShow").text(grandTotalKfValue.toFixed(2));
			$("#khamalStockGradeSumDataWhShow").text(grandTotalWhValue.toFixed(2));



			var allGradeGrandTotalSumData = parseFloat(gradeGrandTotalSum) + parseFloat(grandTotalKfValue) +
				parseFloat(grandTotalWhValue);


			$("#khamalFinalStockGrandTotalMdsShow").text(allGradeGrandTotalSumData.toFixed(2));

		}






























		khamalRunningStockData()



	});
</script>
