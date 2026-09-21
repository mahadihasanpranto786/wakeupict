<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Jute supplier analysis</h1>
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
						<li class="breadcrumb-item active">Jute supplier analysis</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-success">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Jute Supplier Information</h3>
								</div>
								<div class="col-md-2">
									<button onclick="window.print();" class="badge btn-success btn-sm float-right"><i class="fas fa-print"></i> Print</button>
								</div>
							</div>
						</div>
						<div class="card-body">

							<div class="row">
								<div class="col-md-12">

									<table class="table table-hover table-striped">
										<tbody>
											<tr>
												<td>Supplier Name:</td>
												<td><?= $supplierById->s_title ?></td>
												<td>Total Purchase:</td>
												<td><?php echo round($this->M_supplier->findTheGoodSupplierTotalMds($supplierById->s_id)); ?> (<span class="text-success">mds</span>)</td>
											</tr>
											<tr>
												<td>Total Purchase Amount(<span class="text-success">tk</span>):</td>
												<td><span class="text-danger"><?= number_format($supplierById->s_payable, 2, '.', ','); ?></span></td>
												<td>Total paid(<span class="text-success">tk</span>):</td>
												<td><span class="text-success"><?= number_format($supplierById->s_paid, 2, '.', ','); ?></span></td>
											</tr>
											<tr>
												<td>Total Due(<span class="text-success">tk</span>):</td>
												<td><span class="text-danger"><?= number_format($supplierById->s_due, 2, '.', ','); ?></span></td>
												<td>Total Bill:</td>
												<td>
													<a class="d-block" href="<?php echo base_url(''); ?>setup/Supplier/juteSupplierLedger?s_id=<?= $supplierById->s_id ?>" data-toggle="tooltip" data-placement="top" title="Click to go supplier ledger and see all bill.">
														<?= $this->M_supplier->findTheGoodSupplierTotalBillCount($supplierById->s_id) ?>
													</a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<span class="text-success mb-2"><strong>Total grade wise purchase percentage(%):</strong> </span>
								<div class="col-12">
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<th><?= $grade->j_g_title ?> (<span class="text-success">%</span>)</th>
												<?php
													}
												}
												?>
												<th>KF-D1 (<span class="text-success">%</span>)</th>
												<th>WH-D1 (<span class="text-success">%</span>)</th>
												<th>Total </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td class="align-middle">
															<?php
															if ($grade->j_g_id != 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id);

																$total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
																if ($per) {
																	echo round(($per / $total) * 100);
																} else {
																	echo 0;
																}
															} else if ($grade->j_g_id == 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);

																$total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);

																if ($per) {
																	echo round(($per / $total) * 100);
																} else {
																	echo 0;
																}
															}


															?>
														</td>
												<?php
													}
												}
												?>
												<td>
													<?php $kkff = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4);

													$totall = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);

													if ($kkff) {
														echo round(($kkff / $totall) * 100);
													} else {
														echo 0;
													}

													?>
												</td>
												<td>
													<?php $wwhh = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);

													$totall = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);

													if ($wwhh) {
														echo round(($wwhh / $totall) * 100);
													} else {
														echo 0;
													}


													?>
												</td>
												<td>
													<?php $total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
													if ($total) {
														echo round(($total / $total) * 100);
													} else {
														echo 0;
													}

													?>%
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="card card-info">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-chart-bar"></i> Jute Supplier Analysis</h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr>
												<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>

														<th><?= $grade->j_g_title ?> (<span class="text-success">%</span>)</th>
												<?php
													}
												}
												?>
												<th>KF-D1 (<span class="text-success">%</span>)</th>
												<th>WH-D1 (<span class="text-success">%</span>)</th>
												<th>Total </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="10">
													<span class="text-success">Grand total purchase percentage:</span>
												</td>
											</tr>
											<tr>
												<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td class="align-middle">
															<?php
															if ($grade->j_g_id != 1) {
																$g_wise = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id);

																$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();
																if ($g_wise) {
																	echo number_format(($g_wise / $g_total) * 100, 2, '.', '');
																} else {
																	echo 0;
																}
															} else if ($grade->j_g_id == 1) {
																$g_wise = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id) - $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 4) - $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 5);

																$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

																if ($g_wise) {
																	echo number_format(($g_wise / $g_total) * 100, 2, '.', '');
																} else {
																	echo 0;
																}
															}


															?>
														</td>
												<?php
													}
												}
												?>
												<td>
													<?php $kf = $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 4);

													$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

													if ($kf) {
														echo number_format(($kf / $g_total) * 100, 2, '.', '');
													} else {
														echo 0;
													}

													?>
												</td>
												<td>
													<?php $wh = $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 5);

													$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();
													if ($wh) {
														echo number_format(($wh / $g_total) * 100, 2, '.', '');
													} else {
														echo 0;
													}

													?>
												</td>
												<td>
													<?php $g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();
													if ($g_total) {
														echo number_format(($g_total / $g_total) * 100, 0, '.', '');
													} else {
														echo 0;
													}

													?>%
												</td>
											</tr>

											<tr>
												<td colspan="10">
													<span>Grade wise jute purchase percentage(<span class="text-success">%</span>):</span>
												</td>
											</tr>
											<tr>
												<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td class="align-middle">
															<?php
															if ($grade->j_g_id != 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id);

																// echo "<br>";

																$grade_wise_total = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id);

																// echo "<br>";
																// $total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
																// echo "<br>";
																if ($grade_wise_total != 0) {
																	echo number_format(($per / $grade_wise_total) * 100, 2, '.', '');
																} else {
																	echo number_format(0, 2, '.', '');
																}

																// echo "<br>";


																// round($per / $total * 100);
															} else if ($grade->j_g_id == 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);

																// $total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
																$grade_wise_total = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id);

																if ($grade_wise_total != 0) {
																	echo number_format(($per / $grade_wise_total) * 100, 2, '.', '');
																} else {
																	echo "0.0";
																}
															}

															?>
														</td>
												<?php
													}
												}
												?>
												<td>
													<?php
													$kkff = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4);

													// $totall = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
													// echo "<br>";
													// echo $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysisKFWH(1, 4);
													// echo "<br>";
													$kfTotal = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysisKFWH(1, 4);
													// echo "<br>";
													if ($kkff) {
														echo number_format(($kkff / $kfTotal) * 100, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?>
												</td>
												<td>
													<?php $wwhh = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);

													// $totall = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);

													$whTotal = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysisKFWH(1, 5);
													if ($wwhh) {
														echo number_format(($wwhh / $whTotal) * 100, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}
													?>
												</td>
												<td>
													<!-- </?php $total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);

													echo round($total / $total * 100); ?>% -->
												</td>
											</tr>
											<tr>
												<td colspan="10">
													<span>The following part of the total purchased jute has been purchased from <strong class="text-danger"><?= $supplierById->s_title ?></strong>:</span>
												</td>
											</tr>
											<tr>
												<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td class="align-middle singleRowData">
															<?php

															if ($grade->j_g_id != 1) {
																$g_wise = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id);

																$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

																$jerry = number_format(($g_wise / $g_total) * 100, 2, '.', '');
															} else if ($grade->j_g_id == 1) {
																$g_wise = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id) - $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 4) - $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 5);

																$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

																$jerry = number_format($g_wise / $g_total * 100, 2, '.', '');
															}

															if ($grade->j_g_id != 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id);


																$grade_wise_total = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id);
																if ($grade_wise_total != 0) {
																	$tom = number_format(($per / $grade_wise_total) * 100, 2, '.', '');
																} else {
																	$tom = 0;
																}
															} else if ($grade->j_g_id == 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);

																$grade_wise_total = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id);

																if ($grade_wise_total != 0) {
																	$tom = number_format(($per / $grade_wise_total) * 100, 2, '.', '');
																} else {
																	$tom = 0;
																}
															}
															if ($jerry) {
																echo number_format(($jerry / 100) * $tom, 2, '.', '');
															} else {
																echo number_format(0, 2, '.', '');
															}
															?>
															<br>

															<?php
															// Neew
															if ($grade->j_g_id != 1) {
																$g_wise = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id);

																$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

																$alphaNew = ($g_wise / $g_total) * 100;
															} else if ($grade->j_g_id == 1) {
																$g_wise = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade->j_g_id) - $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 4) - $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 5);

																$g_total = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

																$alphaNew = ($g_wise / $g_total) * 100;
															}


															if ($grade->j_g_id != 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id);

																$total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
																if ($per) {
																	$bitaNew = ($per / $total) * 100;
																} else {
																	$bitaNew = 0;
																}
															} else if ($grade->j_g_id == 1) {
																$per = $this->M_supplier->findTheGoodSupplier($supplierById->s_id, $grade->j_g_id) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4) - $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);

																$total = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
																if ($per) {
																	$bitaNew = ($per / $total) * 100;
																} else {
																	$bitaNew = 0;
																}
															}


															?>
														</td>
												<?php
													}
												}
												?>
												<td class="singleRowData">
													<?php


													$kkffQ = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4);
													$kfTotalQ = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysisKFWH(1, 4);

													if ($kkffQ) {
														$forTotalKF = ($kkffQ / $kfTotalQ) * 100;
													} else {
														$forTotalKF = 0;
													}

													// echo "<br>";

													// grand total
													$kkff = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 4);
													$totallK = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
													// echo $forTotalKF = ($kkff / $totallK) * 100;

													// echo "<br>";



													// dfsdfsdfsdfsdfsdf =====================
													$kfGrantTotal = $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 4);
													$g_totalGrantTotal = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

													if ($kfGrantTotal) {
														$lllllllllll = number_format(($kfGrantTotal / $g_totalGrantTotal) * 100, 2, '.', '');
													} else {
														$lllllllllll = 0;
													}

													// dfsdfsdfsdfsdfsdf ====================

													// echo "<br>";

													if ($lllllllllll) {
														echo number_format(($lllllllllll * $forTotalKF) / 100, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}

													?>
												</td>
												<td class="singleRowData">
													<?php
													$kkffZ = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);
													$kfTotalZ = $this->M_supplier->getTotalJutePurchaseMdsGradeWiseForSupplierAnalysisKFWH(1, 5);

													if ($kkffZ) {
														$forTotalWH = ($kkffZ / $kfTotalZ) * 100;
													} else {
														$forTotalWH = 0;
													}



													// grand total
													$wwwhhh = $this->M_supplier->findTheGoodSupplierKfWh($supplierById->s_id, 1, 5);
													$totall = $this->M_supplier->findTheGoodSupplierTotalPercentage($supplierById->s_id);
													// echo $forTotalWH = ($wwwhhh / $totall) * 100;

													// echo "<br>";

													// Tekjdfgdfg =============================
													$whGrantTotal = $this->M_supplier->getTotalJutePurchaseMdsKfWhForSupplierAnalysis(1, 5);

													$g_totalGrandTotal = $this->M_supplier->getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis();

													$kkkkkkkkkk = number_format(($whGrantTotal / $g_totalGrandTotal) * 100, 2, '.', '');
													// Tekjdfgdfg ===============================


													// echo "<br>";

													if ($kkkkkkkkkk) {
														echo number_format(($kkkkkkkkkk * $forTotalWH) / 100, 2, '.', '');
													} else {
														echo number_format(0, 2, '.', '');
													}

													// $forEcho = ($kkkkkkkkkk * $forTotalWH) / 100;
													?>
												</td>
												<td class="totalRowDataSum">
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
<!-- Script File -->
<script src="<?php echo base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>

<script>
	$(document).ready(function() {
		$('tr').each(function() {
			var sum = 0
			$(this).find('.singleRowData').each(function() {
				var rowData = $(this).text();
				if (!isNaN(rowData) && rowData.length !== 0) {
					sum += parseFloat(rowData);
				}
			});
			$('.totalRowDataSum', this).html(sum.toFixed(2) + '%');
		});
	});
</script>