 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Jute Sell Invoice</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_jute_sell') ?>">Back to Sell List</a></li>
 						<li class="breadcrumb-item active">Jute Sell Invoice</li>
 					</ol>
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- Main content -->
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<!-- left column -->
 				<div class="col-md-12">
 					<!-- general form elements -->
 					<div class="card card-default mt-3">
 						<div class="card-header">
 							<h3 class="text-center mb-0 text-uppercase">Rajbari Jute Mills LTD. </h3>
 							<h5 class="text-center mb-0  text-uppercase">Aladipur, Rajbari </h5>
 							<h5 class="text-center mb-0 font-weight-bold">Jute Department</h5>
 							<h4 class="text-center text-uppercase"><u>Jute Sell Invoice</u></h4>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="" method="post">
 							<div class="card-body">
 								<div class="row mb-2">
 									<div class="col-md-2">
 										<h5 class="font-weight-bold">Name of Client: </h5>
 									</div>
 									<div class="col-md-4">
 										<h5 class="text-danger font-weight-bold"><?= $this->M_client->getClientById($soldById->jss_c_id)->c_title ?></h5>
 									</div>
 									<div class="col-md-2">
 										<h5 class="font-weight-bold">Financial Year: </h5>
 									</div>
 									<div class="col-md-4">
 										<h5 class="text-danger font-weight-bold"><?= $this->M_financial_year->getFinancialYearById($soldById->jss_fy_id)->fy_title ?></h5>
 									</div>
 								</div>
 								<div class="row mb-2">

 									<div class="col-md-2">
 										<h5 class="font-weight-bold">Jute Variety:</h5>
 									</div>
 									<div class="col-md-4">
 										<h5 class="text-danger font-weight-bold"><?= $soldById->jss_jute_variety ?></h5>
 									</div>
 									<div class="col-md-2">
 										<h5 class="font-weight-bold">Date:</h5>
 									</div>
 									<div class="col-md-4">
 										<h5 class="text-danger font-weight-bold"><?= date("d-m-Y", strtotime($soldById->jss_date)); ?></h5>
 									</div>

 								</div>
 								<div class="row mb-2">
 									<div class="col-md-2">
 										<h5 class="font-weight-bold">Jute Area:</h5>
 									</div>
 									<div class="col-md-4">
 										<h5 class="text-danger font-weight-bold"><?= $this->M_area->getAreaById($soldById->jss_ar_id)->ar_title ?> </h5>
 									</div>
 									<div class="col-sm-6">
 										<h5 class="font-weight-bold"></h5>
 									</div>
 								</div>
 								<div class="row">
 									<!-- Table -->
 									<table class="table table-striped">
 										<thead>
 											<tr>
 												<th>Grades</th>
 												<th>Quantity (Mds)</th>
 												<th>Rate (Per Mds)</th>
 												<th>Amount</th>
 											</tr>
 										</thead>
 										<tbody>
 											<?php if ($jute_grades) {
													foreach ($jute_grades->result() as $grade) {
														if (getJuteSellWeightValue($grade->j_g_id, $jsSummaryId) != 0) {
															if (getJuteSellRateValue($grade->j_g_id, $jsSummaryId) != 0) {
																if (getJuteSellAmountValue($grade->j_g_id, $jsSummaryId) != 0) {

												?>
 																<tr>
 																	<td>
 																		<?= $grade->j_g_title ?>
 																	</td>
 																	<td>
 																		<?php $weight = getJuteSellWeightValue($grade->j_g_id, $jsSummaryId);
																			if ($weight) {
																				echo $weight;
																			}
																			?>
 																	</td>
 																	<td>
 																		<?php $rate = getJuteSellRateValue($grade->j_g_id, $jsSummaryId);
																			if ($rate) {
																				echo number_format($rate, 2, '.', '');
																			} ?>
 																	</td>
 																	<td>
 																		<?php $amount = getJuteSellAmountValue($grade->j_g_id, $jsSummaryId);
																			if ($amount) {
																				echo number_format($amount, 2, '.', ',');
																			}
																			?>
 																	</td>
 																</tr>
 											<?php }
															}
														}
													}
												} ?>
 											<!-- For Total Amount -->
 											<tr class="table-warning">
 												<td>
 													<span class="font-weight-bold">Total</span>
 												</td>
 												<td>
 													<span class="text-danger font-weight-bold"><?= $soldById->jss_total_weight ?> Mds</span>
 												</td>
 												<td>

 												</td>
 												<td>
 													<span class="text-danger font-weight-bold"> TK <?= number_format(($soldById->jss_total_amount), 2, '.', ',') ?></span>
 												</td>
 											</tr>
 										</tbody>
 									</table>

 									<div class="mt-1 mb-1">
 										<span><strong>Taka In Words: </strong><?php echo talkTomoney(round($soldById->jss_total_amount)); ?></span>
 									</div>
 								</div>
 								<div class="row no-print mt-2">
 									<div class="col-12">
 										<button onclick="window.print();" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
 										<?php if ($soldById->jss_approve_status == 0) { ?>
 											<a onclick="return confirm('Are you sure you want to approve this?');" href="<?php echo base_url(''); ?>setup/Client/approveJuteSellInvoice?jss_id=<?= $soldById->jss_id ?>">
 												<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
 													<i class="fas fa-money-check"></i> Approve</button>
 											</a>
 										<?php } ?>
 									</div>
 								</div>
 							</div>
 							<!-- /.card-body -->
 						</form>
 						<!-- /End Form -->
 					</div>
 					<!-- /.card -->
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- /section -->
 </div>
 <!-- /.content-wrapper -->