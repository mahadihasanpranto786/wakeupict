<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>All Payment List</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('jute_client_report'); ?>">Client Report</a></li>
						<li class="breadcrumb-item active">All Payment List</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12"><?= alert_check() ?>
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title">Client Payment List</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Sl. No</th>
										<th>Payment Received Date</th>
										<th>Client Name</th>
										<th>Reference</th>
										<th>Amount</th>
										<th>Paid By</th>
										<th>Cheque No</th>
										<th>Notes</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($list) {
										$serial = 0;
										foreach ($list->result() as $list) {
											$serial++;
									?>
											<tr>
												<td class="align-middle"><?= $serial ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->cp_date)); ?></td>
												<td class="align-middle"><?= $this->M_client->getClientById($list->cp_c_id)->c_title ?></td>
												<td class="align-middle"><?= $list->cp_reference ?></td>
												<td class="align-middle"><?= $list->cp_amount ?></td>
												<td class="align-middle"><?= $list->cp_paid_by ?></td>
												<td class="align-middle"><?= $list->cp_cheque_no ?></td>
												<td class="align-middle"><?= $list->cp_note ?></td>
												<td class="align-middle">
													<a id="<?= $list->cp_id; ?>" reference="<?= $list->cp_reference; ?>" amount="<?= $list->cp_amount; ?>" date="<?= $list->cp_date; ?>" paid_by="<?= $list->cp_paid_by; ?>" cheque_no="<?= $list->cp_cheque_no; ?>" note="<?= $list->cp_note; ?>" class='editbutton btn bg-warning btn-xs' data-toggle="modal">
														<i class='fas fa-user-edit'> Edit Payment</i>
													</a>
													<a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Client/deleteClientPayment?cp_id=<?= $list->cp_id ?>">
														<button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i> Delete
														</button>
													</a>
												</td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
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
				<form role="form" action="<?php echo base_url('update_client_payment') ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Reference</label>
								<input type="text" name="cp_reference" id="reference" class="form-control" placeholder="Enter Reference" required>
							</div>
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Amount</label>
								<input type="text" name="cp_amount" id="amount" class="form-control" placeholder="Enter Amount" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Date</label>
								<input type="text" name="cp_date" id="date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" placeholder="Enter Date" required>
							</div>
							<div class="form-group col-sm-6">
								<label>Paid By</label>
								<select class="form-control select2" style="width: 100%;" name="cp_paid_by" id="paid_by" required>
									<option value="Cash">Cash</option>
									<option value="Bank">Cheque</option>
									<option value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12 Bank">
								<label for="exampleInputEmail1">Cheque No</label>
								<input type="text" name="cp_cheque_no" id="cheque_no" class="form-control" id="exampleInputEmail1" placeholder="">
							</div>
							<!-- textarea -->
							<div class="form-group col-sm-12">
								<label>Note</label>
								<textarea class="form-control" name="cp_note" id="note" rows="5" placeholder="" required></textarea>
							</div>
						</div>
						<input type="hidden" name="cp_id" value="" id="id">
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
			$('#paid_by').val(paid_by).val(paid_by).trigger('change');
			$('#cheque_no').val(cheque_no);
			$('#note').val(note);
		});
	});
</script>