 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Supplier Payment</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('daily_payment_report') ?>">
 								Payment List</a></li>
 						<li class="breadcrumb-item active">Payment Details</li>
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
 							<h4 class="text-center text-uppercase"><u>party payment Sheet</u></h4>

 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="" method="post">
 							<div class="card-body">
 								<div class="row mb-2">
 									<div class="col-sm-6">
 										<h4 class="font-weight-bold"></h4>
 									</div>
 									<div class="col-sm-6">
 										<h4 class="font-weight-bold text-right">Date: <?= date("d-m-Y", strtotime($sp_date)); ?> </h4>
 									</div>
 								</div>
 								<div class="row">
 									<!-- Table -->
 									<table id="" class="table table-hover table-bordered">
 										<thead>
 											<tr>
 												<th>Sl. No</th>
 												<th>Id. No.</th>
 												<th>Ledger name</th>
 												<th>AC name</th>
 												<th>A/C No.</th>
 												<th>Branch</th>
 												<th>Paid By</th>
 												<th>Amount</th>
 												<th>Comment</th>
 											</tr>
 										</thead>
 										<tbody>
 											<?php if (!empty($sPayments)) {
													$serial = 0;
													$gt = 0;
													foreach ($sPayments->result() as $sPayment) {
														$serial++;
														$gt += $sPayment->sp_amount;
												?>
 													<tr>
 														<td class="align-middle"><?= $serial ?></td>
 														<td class="align-middle"></td>
 														<td class="align-middle"><?= $this->M_supplier->getSupplierById($sPayment->sp_s_id)->s_title ?></td>
 														<?php
															$s_b_id = $this->M_supplier->getSupplierById($sPayment->sp_s_id)->s_b_id;
															$s_bb_id = $this->M_supplier->getSupplierById($sPayment->sp_s_id)->s_bb_id;
															?>
 														<td class="align-middle"><?php if ($s_b_id != 0) {
																						echo $this->M_supplier->getSupplierById($sPayment->sp_s_id)->s_ac_name;
																					} ?></td>
 														<td class="align-middle"><?php if ($s_b_id != 0) {
																						echo $this->M_supplier->getSupplierById($sPayment->sp_s_id)->s_ac_number;
																					} ?></td>
 														<td class="align-middle"><?php if ($s_b_id != 0) {
																						echo $this->M_bank->getBankById($s_b_id)->b_title . " , " . $this->M_bank->getBankBranchById($s_b_id)->bb_title;
																					} ?></td>
 														<td class=""><?= $sPayment->sp_paid_by ?></td>
 														<td class="text-right"><?= number_format($sPayment->sp_amount) ?></td>
 														<td class="align-middle"><?= $sPayment->sp_reference ?></td>
 													</tr>
 											<?php }
												} ?>
 											<tr>
 												<th></th>
 												<th></th>
 												<th></th>
 												<th></th>
 												<th></th>
 												<th></th>
 												<th class="text-right">Grand Total TK =</th>
 												<th class="text-right"><?= number_format($gt) ?></th>
 											</tr>
 										</tbody>
 									</table>
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
 		<button class="btn btn-default m-1" onclick="window.print()"> <i class="fas fa-print"></i> Print</button>
 	</section>
 	<!-- /section -->
 </div>
 <!-- /.content-wrapper -->