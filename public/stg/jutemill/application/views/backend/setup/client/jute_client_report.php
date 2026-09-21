<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Jute Client Reports</h1>
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
						<li class="breadcrumb-item active">Jute Client Reports</li>
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
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title mt-2"> <i class="fas fa-th"></i> Jute Client Reports</h3>
							<button class="btn btn-info float-right border" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-plus-circle"></i> Add New Client</button>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="<?php echo base_url('insert_unassorted_added'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="col-md">
										<table id="example1" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>SL No.</th>
													<th>Image</th>
													<th>Name</th>
													<th>Type</th>
													<th>Email</th>
													<th>Address</th>
													<!-- <th>Licence no</th> -->
													<th>Initial Due</th>
													<th>Total Receivable</th>
													<th>Paid</th>
													<th>Due</th>
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
															<td class="align-middle"><img src="<?= $list->c_img ?>" class="img-rounded" width="40px" height="40px" alt=""></td>
															<td class="align-middle"><?= $list->c_title ?></td>
															<td class="align-middle"><?= $this->M_client->getClientTypeById($list->c_ct_id)->ct_title ?></td>
															<td class="align-middle"><?= $list->c_email ?></td>
															<td class="align-middle">
																<span>Address: <b class="text-danger"><?= $list->c_address ?></b><br>
																	<span>Mobile: <b class="text-danger"><?= $list->c_phone ?></b></span>
															</td>
															<!-- <td class="align-middle"><//?= $list->c_licence_no ?></td> -->
															<td class="align-middle"><?= number_format(($list->c_initial_due_balance), 2, '.', ',') ?></td>
															<td class="align-middle"><?= number_format(($list->c_payable), 2, '.', ',') ?></td>
															<td class="align-middle"><?= number_format(($list->c_paid), 2, '.', ',') ?></td>
															<td class="align-middle"><?= number_format(($list->c_due), 2, '.', ',') ?></td>

															<td class="text-left py-0 align-middle">
																<div class="btn-group btn-group-sm">
																	<a id="<?= $list->c_id ?>" title="<?= $list->c_title ?>" class="paymentButton btn bg-success btn-xs mr-1" data-toggle="modal">
																		<i class="fa fa-plus-circle"></i> Add Payment
																	</a>
																	<a class='btn bg-olive btn-xs mr-1' href="<?php echo base_url(''); ?>setup/Client/juteClientWisePayment?c_id=<?= $list->c_id ?>" id="<?= $list->c_id ?>">
																		<i class='fas fa-eye'> View Payment</i>
																	</a>
																	<a class='btn bg-info btn-xs mr-1' href="<?php echo base_url(''); ?>setup/Client/juteClientLedger?c_id=<?= $list->c_id ?>" id="<?= $list->c_id ?>">
																		<i class='fas fa-eye'> View Ledger</i>
																	</a>
																	<a iid="<?= $list->c_id ?>" client_title="<?= $list->c_title ?>" client_type="<?= $list->c_ct_id ?>" email="<?= $list->c_email ?>" address="<?= $list->c_address ?>" phone="<?= $list->c_phone ?>" licence="<?= $list->c_licence_no ?>" due_balance="<?= $list->c_initial_due_balance ?>" image="<?= $list->c_img ?>" class='editButton btn bg-primary btn-xs mr-1' data-toggle="modal">
																		<i class='fas fa-user-edit'></i>
																	</a>
																</div>
															</td>
														</tr>
												<?php  }
												} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
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
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Payment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- form start -->
				<form role="form" action="<?php echo base_url('insert_client_payment') ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<h5 class="mt-1">Client Name:</h5>
							</div>
							<div class="col-8">
								<div class="form-group col-sm-12">
									<input type="text" id="title" class="form-control" id="exampleInputEmail1" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Reference</label>
								<input type="text" name="cp_reference" class="form-control" placeholder="Enter Reference" required>
							</div>
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Amount</label>
								<input type="text" name="cp_amount" class="form-control input-number" placeholder="Enter Amount" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Date</label>
								<input type="text" name="cp_date" id="cp_date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" required>
								<input type="hidden" name="cp_fy_id" class="form-control" id="cp_fy_id" placeholder="" value=''>
							</div>
							<div class="form-group col-sm-6">
								<label>Paid By</label>
								<select class="form-control select2" style="width: 100%;" name="cp_paid_by" required>
									<option selected="Cash">Cash</option>
									<option value="Bank">Bank</option>
									<option value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12 Bank">
								<label for="exampleInputEmail1">Cheque No</label>
								<input type="text" name="cp_cheque_no" class="form-control" id="exampleInputEmail1" placeholder="">
							</div>
							<!-- textarea -->
							<div class="form-group col-sm-12">
								<label>Note</label>
								<textarea class="form-control" name="cp_note" rows="5" placeholder="Enter Note"></textarea>
							</div>
						</div>
						<input type="hidden" name="cp_id">
						<input type="hidden" name="cp_c_id" value="" id="id">
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


<!-- Insert Modal -->
<div class="modal fade" id="modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class='fas fa-plus-circle'></i> Add New Client</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- form start -->
				<form role="form" action="<?php echo base_url('insert_client'); ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Client Name</label>
								<span class="text-danger">*</span>
								<input type="text" name="c_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Name" required>
							</div>
							<div class="form-group col-sm-4">
								<label>Client Type</label>
								<span class="text-danger">*</span>
								<select type="text" name="c_ct_id" class="form-control select2" style="width: 100%;" required>
									<?php if ($client_types) foreach ($client_types->result() as $client_type) { ?>
										<option value="<?= $client_type->ct_id; ?>" selected><?= $client_type->ct_title; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" name="c_email" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Email">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Address</label>
								<span class="text-danger">*</span>
								<input type="text" name="c_address" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Address" required>
							</div>
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Phone</label>
								<span class="text-danger">*</span>
								<input type="text" name="c_phone" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Phone Number" required>
							</div>
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Licence Number</label>
								<input type="text" name="c_licence_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Licence Number">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Previous Due Balance</label>
								<input type="text" name="c_initial_due_balance" class="form-control" id="exampleInputEmail1" placeholder="Enter Client Previous Due Balance">
							</div>

							<div class="form-group col-sm-4">
								<label class="" for="customFile">Image</label>
								<span class="text-danger">*</span>
								<input type="file" name="c_img" class="form-control" id="customFile" />
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="modal-xl2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class='fas fa-edit'></i> Update Client Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- form start -->
				<form role="form" action="<?php echo base_url('update_client'); ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Client Name</label>
								<span class="text-danger">*</span>
								<input type="text" name="c_title" id="client_title" class="form-control" placeholder="Enter Client Name" required>
							</div>
							<div class="form-group col-sm-4">
								<label>Client Type</label>
								<span class="text-danger">*</span>
								<select type="text" name="c_ct_id" id="client_type" class="form-control select2" style="width: 100%;" required>
									<?php if ($client_types) foreach ($client_types->result() as $client_type) { ?>
										<option value="<?= $client_type->ct_id; ?>"><?= $client_type->ct_title; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" name="c_email" id="email" class="form-control" placeholder="Enter Client Email">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Address</label>
								<span class="text-danger">*</span>
								<input type="text" name="c_address" id="address" class="form-control" placeholder="Enter Client Address" required>
							</div>
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Phone</label>
								<span class="text-danger">*</span>
								<input type="text" name="c_phone" id="phone" class="form-control" placeholder="Enter Client Phone Number" required>
							</div>
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Licence Number</label>
								<input type="text" name="c_licence_no" id="licence" class="form-control" placeholder="Enter Client Licence Number">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="exampleInputEmail1">Previous Due Balance</label>
								<input type="text" name="c_initial_due_balance" id="due_balance" class="form-control input-number" placeholder="" readonly>
							</div>

							<div class="form-group col-sm-4">
								<label class="" for="customFile">Image</label>
								<span class="text-danger">*</span>
								<input type="file" name="c_img" id="image" class="form-control" id="customFile" />
							</div>
						</div>

						<input type="hidden" name="c_id" id="iid">
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Save Changes</button>
					</div>
				</form>
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
		var cp_date = $('#cp_date').val();
		getFy(cp_date);

		function getFy(cp_date) {
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('setup/Client/ajaxFinancialYearForClientPayment') ?>",
				data: {
					cp_date: cp_date,
				},
				success: function(data) {

					if (data == 'no') {
						Swal.fire({
							icon: 'error',
							title: 'Ops !!!!!!!!!!!!!',
							text: 'No Financial Year found under this (' + cp_date + ') date ',
						})
						$("#cp_date").val('');
						$("#cp_fy_id").val('');
					} else {
						$("#cp_fy_id").val(data);
						//  alert(data);
					}
				}
			});
		}
		$("#cp_date").on('change', function() {
			cp_date = $(this).val();
			getFy(cp_date);

		});
		//END automatic get financial year id



	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".paymentButton").click(function(e) {
			var iid = $(this).attr('id');
			var title = $(this).attr('title');
			// alert(iid);
			$('#myModal').modal('show');
			$('#id').val(iid);
			$('#title').val(title);
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		$(".editButton").click(function(e) {
			var iid = $(this).attr('iid');
			var title = $(this).attr('client_title');
			var client_type = $(this).attr('client_type');
			var email = $(this).attr('email');
			var address = $(this).attr('address');
			var phone = $(this).attr('phone');
			var licence = $(this).attr('licence');
			var due_balance = $(this).attr('due_balance');
			var image = $(this).attr('image');
			// alert(iid);
			$('#modal-xl2').modal('show');
			$('#iid').val(iid);
			$('#client_title').val(title);
			$('#client_type').val(client_type).trigger('change');
			$('#email').val(email);
			$('#address').val(address);
			$('#phone').val(phone);
			$('#licence').val(licence);
			$('#due_balance').val(due_balance);
			$('#image').val(image);
		});
	});
</script>