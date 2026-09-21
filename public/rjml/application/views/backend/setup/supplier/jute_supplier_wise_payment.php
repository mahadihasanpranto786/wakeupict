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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('jute_supplier_report') ?>">
 								Supplier Report</a></li>
 						<li class="breadcrumb-item active">Supplier Payment</li>
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
 							<h4 class="text-center text-uppercase"><u>Supplier Payment</u></h4>
 							<br>
 							<div class="row">
 								<div class="col-sm-4 col-md-4 bg-primary">
 									<br>
 									<h4 class="text-center">Total Purchase Amount: <?= number_format(($supplierById->s_payable), 2, '.', ',') ?></h4>
 									<br>
 								</div>
 								<!-- /.col -->
 								<div class="col-sm-4 col-md-4 bg-secondary">
 									<br>
 									<h4 class="text-center">Total Paid Amount: <?= number_format(($supplierById->s_paid), 2, '.', ',') ?></h4>
 									<br>
 								</div>
 								<div class="col-sm-4 col-md-4 bg-info">
 									<br>
 									<h4 class="text-center">Total Due Amount: <?= number_format(($supplierById->s_due), 2, '.', ',') ?></h4>
 									<br>
 								</div>
 							</div>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="" method="post">
 							<div class="card-body">
 								<div class="row mb-2 text-danger">
 									<div class="col-sm-6">
 										<h4 class="font-weight-bold">Supplier Name: <?= $supplierById->s_title ?> </h4>
 									</div>
 									<div class="col-sm-6">
 										<h4 class="font-weight-bold"></h4>
 									</div>
 								</div>
 								<div class="row">
 									<!-- Table -->
 									<table id="" class="table table-hover table-bordered">
 										<thead>
 											<tr>
 												<th>Payment Date</th>
 												<th>Financial Year</th>
 												<th>Payment Amount</th>
 												<th>Reference</th>
 												<th>Paid By</th>
 												<th>Cheque No</th>
 												<th>Notes</th>
 												<th>Actions</th>
 											</tr>
 										</thead>
 										<tbody>
 											<?php if (!empty($sPayments)) {
													foreach ($sPayments->result() as $sPayment) { ?>
 													<tr>
 														<td class="align-middle"><?= date("d-m-Y", strtotime($sPayment->sp_date)); ?></td>
 														<td class="align-middle"><?php $find = $this->M_financial_year->getFinancialYearById($sPayment->sp_fy_id);
																					if (!empty($find)) {
																						echo $this->M_financial_year->getFinancialYearById($sPayment->sp_fy_id)->fy_title;
																					} else {
																						echo "<span class='text-danger'>No Financial Year Found!</span>";
																					}
																					?></td>
 														<td class="align-middle"><?= $sPayment->sp_amount ?></td>
 														<td class="align-middle"><?= $sPayment->sp_reference ?></td>
 														<td class="align-middle"><?= $sPayment->sp_paid_by ?></td>
 														<td class="align-middle"><?= $sPayment->sp_cheque_no ?></td>
 														<td class="align-middle"><?= $sPayment->sp_note ?></td>
 														<td class="align-middle">
 															<!-- Edit Payment done -->
 															<style type="text/css">
 																a[disabled="disabled"] {
 																	pointer-events: none;
 																}
 															</style>
 															<a id="<?= $sPayment->sp_id; ?>" supplier_id="<?= $supplierById->s_id; ?>" reference="<?= $sPayment->sp_reference; ?>" amount="<?= $sPayment->sp_amount; ?>" s_date="<?= date("d-m-Y", strtotime($sPayment->sp_date)); ?>" paid_by="<?= $sPayment->sp_paid_by; ?>" cheque_no="<?= $sPayment->sp_cheque_no; ?>" note="<?= $sPayment->sp_note; ?>" class='editButton btn bg-warning btn-sm'>
 																<i class='fas fa-user-edit'> Edit Payment</i>
 															</a>
 															<!-- Delete Done -->
 															<a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Supplier/deleteSupplierPayment?sp_id=<?= $sPayment->sp_id ?>&&sp_s_id=<?= $supplierById->s_id; ?>">
 																<button type='button' class='btn bg-danger btn-sm'>
 																	<i class="fas fa-trash"></i> Delete
 																</button>
 															</a>
 														</td>
 													</tr>
 											<?php }
												} ?>
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
 	</section>
 	<!-- /section -->
 </div>
 <!-- /.content-wrapper -->

 <!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-info">
 				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Update Payment</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<!-- form start -->
 				<form role="form" action="<?php echo base_url('update_supplier_payment') ?>" method="post" autocomplete="off">
 					<div class="card-body">
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Reference</label>
 								<input type="text" name="sp_reference" id="reference" class="form-control" placeholder="Enter Reference" required>
 							</div>
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Amount</label>
 								<input type="text" name="sp_amount" id="amount" class="form-control" placeholder="Enter Amount" required>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-6">
 								<label for="exampleInputEmail1">Date</label>
 								<input type="text" name="sp_date" id="date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" required>
 								<input type="hidden" name="sp_fy_id" class="form-control" id="sp_fy_id" placeholder="" value=''>
 							</div>
 							<div class="form-group col-sm-6">
 								<label>Paid By</label>
 								<select class="form-control select2" style="width: 100%;" name="sp_paid_by" id="paid_by" required>
 									<option value="Cash">Cash</option>
 									<option value="Bank">Bank</option>
 									<option value="Other">Other</option>
 								</select>
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-12 Bank">
 								<label for="exampleInputEmail1">Cheque No</label>
 								<input type="text" name="sp_cheque_no" id="cheque_no" class="form-control" id="exampleInputEmail1" placeholder="">
 							</div>
 							<!-- textarea -->
 							<div class="form-group col-sm-12">
 								<label>Note</label>
 								<textarea class="form-control" name="sp_note" id="note" rows="5" placeholder="" required></textarea>
 							</div>
 						</div>
 						<input type="hidden" name="previous_amount" value="" id="previous_amount">
 						<input type="hidden" name="sp_s_id" value="" id="supplier_id">
 						<input type="hidden" name="sp_id" value="" id="id">
 					</div>
 					<!-- /.card-body -->
 					<div class="card-footer">
 						<div class="pull-right">
 							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 							<button type="submit" class="btn btn-info float-right">Save Changes</button>
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
 		var date = $('#date').val();
 		getFy(date);

 		function getFy(date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Supplier/ajaxFinancialYearForSupplierPayment') ?>",
 				data: {
 					sp_date: date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + date + ') date ',
 						})
 						$("#date").val('');
 						$("#sp_fy_id").val('');
 					} else {
 						$("#sp_fy_id").val(data);
 						//  alert(data);
 					}
 				}
 			});
 		}
 		$("#date").on('change', function() {
 			date = $(this).val();
 			getFy(date);

 		});
 		//END automatic get financial year id

 	});
 </script>
 <!-- Edit Supplier Payment  -->
 <script type="text/javascript">
 	$(document).ready(function() {
 		$(".editButton").click(function(e) {
 			var iid = $(this).attr('id');
 			var supplier_id = $(this).attr('supplier_id');
 			var reference = $(this).attr('reference');
 			var amount = $(this).attr('amount');
 			var date = $(this).attr('s_date');
 			var paid_by = $(this).attr('paid_by');
 			var cheque_no = $(this).attr('cheque_no');
 			var note = $(this).attr('note');
 			// alert(iid);
 			$('#myModal').modal('show');
 			$('#id').val(iid);
 			$('#supplier_id').val(supplier_id);
 			$('#reference').val(reference);
 			$('#amount').val(amount);
 			$('#previous_amount').val(amount);
 			$('#date').val(date);
 			$('#paid_by').val(paid_by).trigger('change');
 			$('#cheque_no').val(cheque_no);
 			$('#note').val(note);
 		});
 	});
 </script>