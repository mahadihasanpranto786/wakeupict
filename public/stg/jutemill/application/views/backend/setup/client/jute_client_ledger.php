 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Client Ledger</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('jute_client_report') ?>">Back to Client Report List</a></li>
 						<li class="breadcrumb-item active">Client Ledger</li>
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
 							<h4 class="text-center text-uppercase"><u>Client Ledger</u></h4>
 							<br>
 							<div class="row">
 								<div class="col-sm-4 col-md-4 bg-teal py-4">
 									<h4 class="text-center">Total Receivable Amount: <?= number_format(($clientById->c_payable), 2, '.', ',') ?></h4>
 								</div>
 								<div class="col-sm-4 col-md-4 bg-purple py-4">
 									<h4 class="text-center">Total Received Amount: <?= number_format(($clientById->c_paid), 2, '.', ',') ?></h4>
 								</div>
 								<div class="col-sm-4 col-md-4 bg-pink py-4">
 									<h4 class="text-center">Total Due Amount: <?= number_format(($clientById->c_due), 2, '.', ',') ?></h4>
 								</div>
 							</div>
 						</div>
 						<div class="card-header">
 							<div class="row mt-3">
 								<div class="col-6 mb-2">
 									<h3 class="bg-secondary pl-2">Client Info:</h2>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Client Name: </span> <span class="text-danger"><?= $clientById->c_title ?></span></p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Bill Quantity:</span> <?= $this->M_client->getClientTotalBillCount($clientById->c_id) ?></p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Total Sale(<span class="text-danger">Mds</span>):</span> <?= number_format($this->M_client->getClientWiseTotalMds($clientById->c_id), 2, '.', ','); ?></p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Initial Due Balance:</span> <?= $clientById->c_initial_due_balance ?></p>
 								</div>
 								<div class="col-6 mb-2">
 									<h3 class="bg-secondary pl-2">Contact Info:</h3>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Address: </span> <?= $clientById->c_address ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Phone:</span> <?= $clientById->c_phone ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Email:</span> <?= $clientById->c_email ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">License No:</span> <?= $clientById->c_licence_no ?></p>
 								</div>
 							</div>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="" method="post">
 							<div class="card-body">
 								<div class="row">
 									<div class="col-12">
 										<!-- Table -->
 										<table id="" class="table table-hover table-bordered">
 											<thead>
 												<tr>
 													<th>Date</th>
 													<th>Financial Year</th>
 													<th>Purchase Amount</th>
 													<th>Paid</th>
 													<th>Paid By</th>
 													<th>Notes</th>
 													<th>Actions</th>
 												</tr>
 											</thead>
 											<tbody>
 												<tr>
 													<td></td>
 													<td></td>
 													<td class="align-middle">Initial Due Balance: <b><?= number_format(($clientById->c_initial_due_balance), 2, '.', ',') ?></b></td>
 													<td></td>
 													<td></td>
 													<td></td>
 													<td></td>
 												</tr>

 												<?php
													$pDates = array();
													$cDates = array();
													foreach ($cPurchases->result() as $cPurchase) {
														$pDates[] = $cPurchase->jss_date; //Fetch all purchase dates
													}
													foreach ($cPayments->result() as $cPayment) {
														$cDates[] = $cPayment->cp_date; //Fetch all payment dates
													}
													$mergeDate = array_merge($pDates, $cDates); //Two table date merge
													$uniqueDate = array_unique($mergeDate); //Find unique dates from merge dates
													asort($uniqueDate); //Asort dates like ascending(1,2,3,4,5,......). 
													?>


 												<?php foreach ($uniqueDate as $key => $value) {
														foreach ($cPurchases->result() as $cPurchase) {
															if ($cPurchase->jss_date == $value) {
													?>
 															<tr>
 																<td><?= date("d-m-Y", strtotime($cPurchase->jss_date)); ?></td>
 																<td></td>
 																<td><?= number_format(($cPurchase->jss_total_amount), 2, '.', ',') ?></td>
 																<td></td>
 																<td></td>
 																<td></td>
 																<td>
 																	<a target="_blank" class='btn bg-olive btn-sm mr-1' href="<?php echo base_url('') ?>setup/Client/viewJuteSellInvoice?jss_id=<?= $cPurchase->jss_id ?>">
 																		<i class='fas fa-eye'> View Invoice</i>
 																	</a>
 																</td>
 															</tr>

 													<?php }
														} ?>

 													<?php
														if (!empty($cPayments)) {
															foreach ($cPayments->result() as $cPayment) {
																if ($cPayment->cp_date == $value) {
														?>


 																<tr class="table-secondary">
 																	<td class="align-middle"><?= date("d-m-Y", strtotime($cPayment->cp_date)); ?></td>
 																	<td class="align-middle">
 																		<?php $find = $this->M_financial_year->getFinancialYearById($cPayment->cp_fy_id);
																			if (!empty($find)) {
																				echo $this->M_financial_year->getFinancialYearById($cPayment->cp_fy_id)->fy_title;
																			} else {
																				echo "<span class='text-danger'>No Financial Year Found!</span>";
																			} ?></td>
 																	<td class="align-middle"></td>
 																	<td class="align-middle"><?= number_format(($cPayment->cp_amount), 2, '.', ',') ?></td>
 																	<td class="align-middle"><?= $cPayment->cp_paid_by ?>
 																		<?php if (!empty($cPayment->cp_cheque_no)) {
																				echo "(No. " . $cPayment->cp_cheque_no . ")";
																			} ?>
 																	</td>

 																	</td>
 																	<td class="align-middle"><?= $cPayment->cp_note ?></td>
 																	<td class="align-middle">
 																		<a id="<?= $cPayment->cp_id; ?>" reference="<?= $cPayment->cp_reference; ?>" amount="<?= $cPayment->cp_amount; ?>" date="<?= $cPayment->cp_date; ?>" paid_by="<?= $cPayment->cp_paid_by; ?>" cheque_no="<?= $cPayment->cp_cheque_no; ?>" note="<?= $cPayment->cp_note; ?>" class='editbutton btn bg-warning btn-xs' data-toggle="modal">
 																			<i class="fas fa-eye"></i> View Payment</i>
 																		</a>
 																		<!-- <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Client/deleteClientPayment?cp_id=<?= $cPayment->cp_id ?>">
                                                                         <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs' disabled>
                                                                             <i class="fas fa-trash"></i> Delete
                                                                         </button>
                                                                     </a> -->
 																	</td>
 																</tr>
 												<?php }
															}
														}
													}
													?>
 											</tbody>
 										</table>
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

 <!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-info">
 				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-eye"></i> View Payment</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- form start -->
 				<form role="form" action="<?php echo base_url('') ?>" method="post" onkeydown="return event.key != 'Enter';">
 					<div class="card-body">
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Reference</label>
 								<input type="text" name="cp_reference" id="reference" class="form-control" placeholder="" disabled>
 							</div>
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Amount</label>
 								<input type="text" name="cp_amount" id="amount" class="form-control" placeholder="" disabled>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Date</label>
 								<input type="text" name="cp_date" id="date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" placeholder="" disabled>
 							</div>
 							<div class="form-group col-sm-6">
 								<label>Paid By</label>
 								<select class="form-control select2" style="width: 100%;" name="cp_paid_by" id="paid_by" disabled>
 									<option value="Cash">Cash</option>
 									<option value="cheque">Cheque</option>
 									<option value="Other">Other</option>
 								</select>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-12 cheque">
 								<label for="exampleInputEmail1">Cheque No</label>
 								<input type="text" name="cp_cheque_no" id="cheque_no" class="form-control" id="exampleInputEmail1" placeholder="" disabled>
 							</div>
 							<!-- textarea -->
 							<div class="form-group col-sm-12">
 								<label>Note</label>
 								<textarea class="form-control" name="cp_note" id="note" rows="5" placeholder="" disabled></textarea>
 							</div>
 						</div>
 						<input type="hidden" name="cp_id" value="" id="id">
 					</div>
 					<!-- /.card-body -->
 				</form>
 				<!-- /End Form -->
 			</div>
 		</div>
 	</div>
 </div>

 <!-- Script File -->
 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <script>
 	$(document).ready(function() {
 		$("select").change(function() {
 			$(this).find("option:selected").each(function() {
 				var optionValue = $(this).attr("value");
 				if (optionValue) {
 					$(".cheque").not("." + optionValue).hide();
 					$("." + optionValue).show();
 				} else {
 					$(".cheque").hide();
 				}
 			});
 		}).change();
 	});
 </script>
 <!-- Edit Client Payment  -->
 <script type="text/javascript">
 	$(document).ready(function() {
 		$(".editbutton").click(function(e) {
 			var iid = $(this).attr('id');
 			var reference = $(this).attr('reference');
 			var amount = $(this).attr('amount');
 			var date = $(this).attr('date');
 			var paid_by = $(this).attr('paid_by');
 			var cheque_no = $(this).attr('cheque_no');
 			var note = $(this).attr('note');
 			// alert(iid);
 			$('#myModal').modal('show');
 			$('#id').val(iid);
 			$('#reference').val(reference);
 			$('#amount').val(amount);
 			$('#date').val(date);
 			$('#paid_by').val(paid_by).trigger('change');
 			$('#cheque_no').val(cheque_no);
 			$('#note').val(note);
 		});
 	});
 </script>