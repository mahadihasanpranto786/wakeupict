 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1 class="mb-3">Jute Purchase Order</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_jute_purchase_order') ?>">Back to List</a></li>
 						<li class="breadcrumb-item active">Jute Purchase Order</li>
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
 					<div class="card card-default">
 						<div class="card-header">
 							<h3 class="text-center text-uppercase font-weight-bold">Purchase Order</h3>
 							<div class="row mt-3">
 								<div class="col-6 mb-2">
 									<h3 class="bg-secondary pl-2">Purchase From:</h2>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Supplier Name: </span> <?= $this->M_supplier->getSupplierById($purchaseOrder->jpos_s_id)->s_title ?></p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Phone:</span> <?= $this->M_supplier->getSupplierById($purchaseOrder->jpos_s_id)->s_phone ?></p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Address:</span> <?= $this->M_supplier->getSupplierById($purchaseOrder->jpos_s_id)->s_address ?></p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">License No:</span> <?= $this->M_supplier->getSupplierById($purchaseOrder->jpos_s_id)->s_licence_no ?></p>
 								</div>
 								<div class="col-6 mb-2">
 									<h3 class="bg-secondary pl-2">Ship To:</h3>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Company Name:</span> <span class="text-uppercase font-weight-bold"></span> Rajbari Jute Mills LTD. </p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Address: </span>Address: Aladipur, Rajbari </p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Department: </span> Jute Department</p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Date: </span><?= date("d-m-Y", strtotime($purchaseOrder->jpos_date)); ?></p>
 								</div>
 							</div>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="" method="post">
 							<div class="card-body">
 								<div class="row">
 									<!-- Table -->
 									<table class="table table-striped">
 										<thead>
 											<tr>
 												<th>Grades</th>
 												<th>Quantity (Mds)</th>
 											</tr>
 										</thead>
 										<tbody>
 											<?php if ($grades) {
													foreach ($grades->result() as $grade) {
														if (getJutePurchaseOrderValue($grade->j_g_id, $purchaseOrder->jpos_id) != 0) {

												?>
 														<tr>
 															<td class="w-50">
 																<?= $grade->j_g_title ?>
 															</td>
 															<td class="w-50">
 																<?php $weight = getJutePurchaseOrderValue($grade->j_g_id, $purchaseOrder->jpos_id);
																	if ($weight) {
																		echo $weight;
																	}
																	?>
 															</td>
 														</tr>
 											<?php }
													}
												} ?>
 											<!-- For Total Amount -->
 											<tr class="table-warning">
 												<td>
 													<span class="font-weight-bold">Total</span>
 												</td>
 												<td>
 													<span class="text-danger font-weight-bold"><?= $purchaseOrder->jpos_total_mds ?> Mds</span>
 												</td>
 											</tr>
 										</tbody>
 									</table>
 								</div>
 								<div class="row no-print mt-2">
 									<div class="col-12 text-right">
 										<button onclick="window.print();" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
 										<!-- </?php if ($soldById->jss_approve_status == 0) { ?>
 											<a onclick="return confirm('Are you sure you want to approve this?');" href="</?php echo base_url(''); ?>setup/Client/approveJuteSellInvoice?jss_id=<?= $soldById->jss_id ?>">
 												<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
 													<i class="fas fa-money-check"></i> Approve</button>
 											</a>
 										</?php } ?> -->
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