 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Supplier Ledger</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('jute_supplier_report') ?>">
 								Supplier Report</a></li>
 						<li class="breadcrumb-item active">Supplier Ledger</li>
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
 							<h4 class="text-center text-uppercase"><u>Supplier Ledger</u></h4>
 							<div class="row">

 							</div>
 							<div class="row">
 								<div class="col-sm-4 col-md-4 bg-primary">
 									<br>
 									<h4 class="text-center">Total Purchase Amount:
 										<?= number_format(($supplierById->s_payable), 2, '.', ',') ?></h4>
 									<br>
 								</div>
 								<!-- /.col -->
 								<div class="col-sm-4 col-md-4 bg-secondary">
 									<br>
 									<h4 class="text-center">Total Paid Amount:
 										<?= number_format(($supplierById->s_paid), 2, '.', ',') ?></h4>
 									<br>
 								</div>
 								<div class="col-sm-4 col-md-4 bg-info">
 									<br>
 									<h4 class="text-center">Total Due Amount:
 										<?= number_format(($supplierById->s_due), 2, '.', ',') ?></h4>
 									<br>
 								</div>
 							</div>
 							<!-- /.row -->
 						</div>
 						<div class="card-header">
 							<div class="row mt-3">
 								<div class="col-4 mb-2">
 									<h3 class="bg-secondary pl-2">Supplier Info:</h2>

 										<a s_id="<?= $supplierById->s_id ?>" s_title="<?= $supplierById->s_title ?>" total_due_amount="<?= $supplierById->s_due; ?>" class="addPayment btn bg-success btn-sm  mr-1" data-toggle="modal">
 											<i class="fa fa-plus-circle"></i> Add Payment
 										</a>

 										<p class="m-0 pl-2"><span class="font-weight-bold">Supplier Name: </span>
 											<?= $supplierById->s_title ?></p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Bill Quantity:</span>
 											<?= $this->M_supplier->findTheGoodSupplierTotalBillCount($supplierById->s_id) ?>
 										</p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Total Purchase(<span class="text-danger">Mds</span>):</span>
 											<?= number_format($this->M_supplier->getSupplierWiseTotalMds($supplierById->s_id), 2, '.', ','); ?>
 										</p>
 										<p class="m-0 pl-2"><span class="font-weight-bold">Initial Due Balance:</span>
 											<?= $supplierById->s_initial_due_balance ?></p>
 								</div>
 								<div class="col-4 mb-2">
 									<h3 class="bg-secondary pl-2">Contact Info:</h3>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Address: </span>
 										<?= $supplierById->s_address ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Phone:</span>
 										<?= $supplierById->s_phone ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Email:</span>
 										<?= $supplierById->s_email ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">License No:</span>
 										<?= $supplierById->s_licence_no ?></p>
 								</div>
 								<div class="col-4 mb-2">
 									<h3 class="bg-secondary pl-2">Bank Info:</h3>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Bank: </span> <?php if ($supplierById->s_b_id) {
																											echo $this->M_bank->getBankById($supplierById->s_b_id)->b_title;
																										} ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">Branch: </span> <?php if ($supplierById->s_bb_id) {
																											echo $this->M_bank->getBankBranchById($supplierById->s_bb_id)->bb_title;
																										} ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">AC name:</span>
 										<?= $supplierById->s_ac_name ?></p>
 									<p class="m-0 pl-2"><span class="font-weight-bold">AC No:</span>
 										<?= $supplierById->s_ac_number ?></p>
 								</div>
 							</div>
 						</div>
 						<!-- /.card-header -->
 						<div class="card-body">
 							<div class="row">
 								<div class="col-12">
 									<!-- Table -->
 									<table id="" class="table table-hover table-bordered">
 										<thead>
 											<tr>
 												<th>Date</th>
 												<th>Financial Year</th>
 												<th>Lot No</th>
 												<th>Purchase amount</th>
 												<th>Paid</th>
 												<th>Paid by</th>
 												<th>Action</th>
 											</tr>
 										</thead>
 										<tbody>
 											<tr class="">
 												<td></td>
 												<td></td>
 												<td></td>
 												<td> Initial Due Balance :
 													<b><?= number_format($supplierById->s_initial_due_balance, 2, '.', ','); ?></b>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<?php
												$dates = array();
												$datess = array();
												foreach ($sPurchases->result() as $purchase) {
													$dates[] = $purchase->jpis_ot_en_date;
												}
												foreach ($sPayments->result() as $payment) {
													$datess[] = $payment->sp_date;
												}

												$dat = array_merge($dates, $datess);
												$dattt = array_unique($dat);
												asort($dattt);
												?>
 											<?php
												foreach ($dattt as $key => $value) {
													foreach ($sPurchases->result() as $purchase) {
														if ($purchase->jpis_ot_en_date == $value) {
												?>
 														<tr class="">
 															<td>
 																<?= date("d-m-Y", strtotime($purchase->jpis_ot_en_date)) ?>
 															</td>
 															<td></td>
 															<td>
 																<?php //echo date($settings->date_format, $purchase->date); 
																	?>
 																<?php echo  $purchase->jpis_ot_lot_no; ?>
 															</td>
 															<td>
 																<?php //echo $settings->currency; 
																	?>
 																<?php $purchase_amount = str_replace(',', '', $purchase->jpis_grand_total);
																	echo number_format($purchase_amount, 2, '.', ',');
																	?>
 															</td>
 															<td>

 															</td>
 															<td> </td>
 															<td>
 																<a target=”_blank” href="<?php echo base_url(); ?>jute/Entry/viewPurchaseInvoice?jpis_id=<?= $purchase->jpis_id ?>"><button class="btn btn-info btn-sm" type="button" data-placement="top" title="View"><i class="fas fa-eye"></i> View Invoice</button></a>
 															</td>
 														</tr>
 												<?php
														}
													}
													?>

 												<?php
													foreach ($sPayments->result() as $payment) {
														if ($payment->sp_date == $value) {
													?>
 														<tr class="table-secondary">
 															<td><?= date("d-m-Y", strtotime($payment->sp_date)) ?> </td>
 															<td class="align-middle">
 																<?php $find = $this->M_financial_year->getFinancialYearById($payment->sp_fy_id);
																	if (!empty($find)) {
																		echo $this->M_financial_year->getFinancialYearById($payment->sp_fy_id)->fy_title;
																	} else {
																		echo "<span class='text-danger'>N/A</span>";
																	}
																	?></td>
 															<td></td>
 															<td></td>
 															<td>
 																<?php echo number_format($payment->sp_amount, 2, '.', ','); ?>
 															</td>
 															<td>
 																<?php //echo $settings->currency; 
																	?>
 																<?php echo $payment->sp_paid_by; ?> <?php
																										if (!empty($payment->sp_cheque_no)) {
																											echo " ( No " . $payment->sp_cheque_no . " ) ";
																										} ?>
 															</td>
 															<td>
 																<a id="<?= $payment->sp_id; ?>" reference="<?= $payment->sp_reference; ?>" amount="<?= $payment->sp_amount; ?>" date="<?= $payment->sp_date; ?>" paid_by="<?= $payment->sp_paid_by; ?>" cheque_no="<?= $payment->sp_cheque_no; ?>" note="<?= $payment->sp_note; ?>" class='editbutton btn bg-warning btn-xs' data-toggle="modal">
 																	<i class='fas fa-eye'> View Payment</i>
 																</a>
 															</td>
 														</tr>
 											<?php
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
 				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> View Payment</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- form start -->
 				<form role="form" action="<?php echo base_url('update_supplier_payment') ?>" method="post">
 					<div class="card-body">
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Reference</label>
 								<input type="text" name="sp_reference" id="reference" class="form-control" placeholder="Enter Reference" required disabled>
 							</div>
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Amount</label>
 								<input type="text" name="sp_amount" id="amount" class="form-control" placeholder="Enter Amount" required disabled>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Date</label>
 								<input type="text" name="sp_date" id="date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" placeholder="Enter Date" required disabled>
 							</div>
 							<div class="form-group col-sm-6">
 								<label>Paid By</label>
 								<select class="form-control select2" style="width: 100%;" name="sp_paid_by" id="paid_by" required disabled>
 									<option value="Cash">Cash</option>
 									<option value="Bank">Bank</option>
 									<option value="Other">Other</option>
 								</select>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-12 Bank">
 								<label for="exampleInputEmail1">Cheque No</label>
 								<input type="text" name="sp_cheque_no" id="cheque_no" class="form-control" id="exampleInputEmail1" placeholder="" disabled>
 							</div>
 							<!-- textarea -->
 							<div class="form-group col-sm-12">
 								<label>Note</label>
 								<textarea class="form-control" name="sp_note" id="note" rows="5" placeholder="" required disabled></textarea>
 							</div>
 						</div>
 						<input type="hidden" name="sp_id" value="" id="id">
 					</div>
 					<!-- /.card-body -->
 					<div class="card-footer">
 						<div class="pull-right">
 							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
 						</div>
 					</div>
 				</form>
 				<!-- /End Form -->
 			</div>
 		</div>
 	</div>
 </div>

 <!-- Modal -->
 <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-info">
 				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Payment</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- form start -->
 				<form role="form" action="<?php echo base_url('insert_supplier_payment') ?>" method="post" onkeydown="return event.key != 'Enter';" autocomplete="off">
 					<div class="card-body">
 						<div class="row">
 							<div class="col-12">
 								<table class="table-bordered table table-sm">
 									<tr>
 										<td style="width: 50%;"><strong>Supplier Name:</strong></td>
 										<td style="width: 50%;"><span id="s_title"></span></td>
 									</tr>
 									<tr>
 										<td style="width: 50%;"><strong>Total Due: </strong></td>
 										<td style="width: 50%;"><span id="total_due_amount"></span></td>
 									</tr>
 								</table>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Reference</label>
 								<input type="text" name="sp_reference" class="form-control" placeholder="Enter Reference" required>
 							</div>
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Amount</label>
 								<input type="text" name="sp_amount" class="form-control input-number" placeholder="Enter Amount" required>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Date</label>
 								<input type="text" name="sp_date" id="sp_date" value="" class="form-control datepicker" required>
 								<input type="hidden" name="sp_fy_id" class="form-control" id="sp_fy_id" placeholder="" value=''>
 							</div>
 							<div class="form-group col-sm-6">
 								<label>Paid By</label>
 								<select class="form-control select2" style="width: 100%;" name="sp_paid_by">
 									<option selected="Cash">Cash</option>
 									<option value="Bank">Bank</option>
 									<option value="Other">Other</option>
 								</select>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-12 Bank">
 								<label for="exampleInputEmail1">Cheque No</label>
 								<input type="text" name="sp_cheque_no" class="form-control" id="exampleInputEmail1" placeholder="">
 							</div>
 							<!-- textarea -->
 							<div class="form-group col-sm-12">
 								<label>Note</label>
 								<textarea class="form-control" name="sp_note" rows="5" placeholder="Enter Note"></textarea>
 							</div>
 						</div>
 						<input type="hidden" name="sp_id">
 						<input type="hidden" name="sp_s_id" value="" id="s_id">
 					</div>
 					<!-- /.card-body -->
 					<div class="card-footer">
 						<div class="pull-right">
 							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
 							<button type="submit" class="btn btn-info float-right">Submit</button>
 						</div>
 					</div>
 				</form>

 				<!-- /End Form -->
 			</div>
 		</div>
 	</div>
 </div>

 <!-- Script File -->
 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function() {
 		$("select").change(function() {
 			$(this).find("option:selected").each(function() {
 				var optionValue = $(this).attr("value");
 				if (optionValue) {
 					$(".Bank").not("." + optionValue).hide();
 					$("." + optionValue).show();

 				} else {
 					$(".Bank").hide();
 				}
 			});
 		}).change();
 	});
 </script>
 <!-- Edit Supplier Payment  -->
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

 <script type="text/javascript">
 	$(document).ready(function() {
 		$(".addPayment").click(function(e) {
 			var s_id = $(this).attr('s_id');
 			var s_title = $(this).attr('s_title');
 			var total_due_amount = $(this).attr('total_due_amount');
 			//alert(s_title);
 			$('#myModalAdd').modal('show');
 			$('#s_id').val(s_id);
 			$('#s_title').text(s_title);
 			$('#total_due_amount').text(total_due_amount);
 		});
 	});
 </script>

 <script>
 	$(document).ready(function() {
 		$("select").change(function() {
 			$(this).find("option:selected").each(function() {
 				var optionValue = $(this).attr("value");
 				if (optionValue) {
 					$(".Bank").not("." + optionValue).hide();
 					$("." + optionValue).show();
 				} else {
 					$(".Bank").hide();
 				}
 			});
 		}).change();



 		//automatic get financial year id
 		var sp_date = $('#sp_date').val();
 		//getFy(sp_date);

 		function getFy(sp_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Supplier/ajaxFinancialYearForSupplierPayment') ?>",
 				data: {
 					sp_date: sp_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + sp_date + ') date ',
 						})
 						$("#sp_date").val('');
 						$("#sp_fy_id").val('');
 					} else {
 						$("#sp_fy_id").val(data);
 						//  alert(data);
 					}
 				}
 			});
 		}
 		$("#sp_date").on('change', function() {
 			sp_date = $(this).val();
 			getFy(sp_date);

 		});
 		//END automatic get financial year id

 	});
 </script>