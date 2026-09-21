<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Jut Supplier Payment Reports</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_all_payment') ?>">All
								Payment List</a></li>
						<li class="breadcrumb-item active">Jute Supplier Payment</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<div class="card-body">
		<div class="card card-primary">
			<div class="card-header">
				<div class="row">
					<div class="col-md-10">
						<h3 class="card-title">Payment Report</h3>
					</div>
				</div>
			</div>

			<?= alert_check() ?>
			<section class="content" style="margin-top:20px">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>SL. No</th>
										<th>Image</th>
										<th>Name</th>
										<th>Info</th>
										<th>Payable</th>
										<th>Paid</th>
										<th>Due</th>
										<th>purchase total</th>
										<th>Action</th>
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
												<td class="align-middle"><img src="<?= $list->s_img ?>" class="img-rounded" width="40px" height="40px" alt=""></td>
												<td class="align-middle"><?= $list->s_title ?>
													<br>[<?= $this->M_supplier->getSupplierTypeById($list->s_sup_t_id)->sup_t_title; ?>
													supplier]
												</td>
												<td class="align-middle"> Address: <?= $list->s_address ?>
													<br>Mobile No:<?= $list->s_phone ?>
												</td>
												<td class="align-middle">
													<?= number_format(($list->s_payable), 2, '.', ',') ?>
												</td>
												<td class="align-middle">
													<?= number_format(($list->s_paid), 2, '.', ',') ?>
												</td>
												<td class="align-middle">
													<?= number_format(($list->s_due), 2, '.', ',') ?>
												</td>
												<td class="align-middle">
													<?= number_format(getSupplierPayableAmount($list->s_id), 2, '.', ',') ?>
												</td>
												<td class="align-middle">
													<a id="<?= $list->s_id ?>" title="<?= $list->s_title ?>" class="editbutton btn bg-success btn-xs" data-toggle="modal">
														<i class="fa fa-plus-circle"></i> Add Payment
													</a>
													<a class='btn bg-olive btn-xs mr-1' href="<?php echo base_url(''); ?>setup/Supplier/viewSupplierWisePayment?s_id=<?= $list->s_id ?>">
														<i class='fas fa-eye'> View Payment</i>
													</a>
													<a class='btn bg-olive btn-xs mr-1' href="<?php echo base_url(''); ?>setup/Supplier/juteSupplierLedger?s_id=<?= $list->s_id ?>">
														<i class='fas fa-eye'> View Ledger</i>
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
					</div>
				</div>
			</section>
		</div>
	</div>
</div>



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
				<form role="form" action="<?php echo base_url('insert_supplier_payment') ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="col-4">
								<h5 class="mt-1">Supplier Name:</h5>
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
								<input type="text" name="sp_reference" class="form-control" placeholder="Enter Reference">
							</div>
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Amount</label>
								<input type="text" name="sp_amount" class="form-control input-number" placeholder="Enter Amount">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Date</label>
								<input type="text" name="sp_date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" required>
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
						<input type="hidden" name="sp_s_id" value="" id="id">
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

<script type="text/javascript">
	$(document).ready(function() {
		$(".editbutton").click(function(e) {
			var iid = $(this).attr('id');
			var title = $(this).attr('title');
			// alert(iid);
			$('#myModal').modal('show');
			$('#id').val(iid);
			$('#title').val(title);
		});
	});
</script>