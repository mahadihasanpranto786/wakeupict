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
						<!-- <li class="breadcrumb-item">
							<a href="<?php echo base_url('administration') ?>">Home</a>
						</li> -->
						<!-- <li class="breadcrumb-item active"><a href="<//?php echo base_url('list_all_payment') ?>">All Payment List</a></li> -->
						<!-- <li class="breadcrumb-item active">Jute Supplier Payment</li> -->
					</ol>
				</div>
			</div>
		</div>
	</section>
	<div class="card-body">
		<div class="card card-primary">
			<div class="card-header">
				<div class="row">
					<div class="col-md-12">
						<h3 class="card-title mt-2"><i class="fas fa-th"></i> Payment Report</h3>
						<a class='btn btn-primary float-right border' href="<?php echo base_url('add_supplier'); ?>">
							<i class="fas fa-plus-circle"></i> Add New Supplier</i>
						</a>
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
										<!-- <th>Image</th> -->
										<th>Name</th>
										<th>Info</th>
										<th>Initial Due</th>
										<th>Total Purchase Amount</th>
										<th>Paid</th>
										<th>Due</th>
										<!-- <th>purchase total</th> -->
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
												<!-- <td class="align-middle"><img src="</?= $list->s_img ?>" class="img-rounded" width="40px" height="40px" alt=""></td> -->
												<td class="align-middle">
													<?= $list->s_title ?>
													<br>
													<div class="progress-group">
														Purchase range:
														<?php
														$totalPerA = $this->M_supplier->getSupplierWiseTotalMds();
														// echo "<br>";
														$sWisePerA = $this->M_supplier->getGrandTotalMds($list->s_id);
														// echo "<br>";
														if ($totalPerA) {
															$PercentageShowA = number_format(($sWisePerA / $totalPerA) * 100, 2, '.', ',');
															// echo "<div class='progress-bar bg-primary' style='width: " . $PercentageShow . "%'></div>";

															echo "<span class='float-right'><b>" . $PercentageShowA . "</b>%</span>";
														}
														?>

														<div class="progress progress-sm" style="background: #E6E6FA;">
															<?php
															$totalPer = $this->M_supplier->getSupplierWiseTotalMds();
															// echo "<br>";
															$sWisePer = $this->M_supplier->getGrandTotalMds($list->s_id);
															// echo "<br>";
															if ($totalPer) {
																$PercentageShow = number_format(($sWisePer / $totalPer) * 100, 2, '.', ',');
																echo "<div class='progress-bar bg-success' style='width: " . $PercentageShow . "%'></div>";
															} ?>
														</div>
													</div>
												</td>
												<td class="align-middle"> <strong>Address:</strong> <span class="text-primary"><?= $list->s_address ?></span>
													<br><strong>Mobile No:</strong><span class="text-primary">
														<?= $list->s_phone ?></span>
													<br><strong>Bill:</strong><span class="text-primary">
														<a href="<?php echo base_url(''); ?>setup/Supplier/juteSupplierLedger?s_id=<?= $list->s_id ?>" data-toggle="tooltip" data-placement="top" title="Click to go supplier ledger and see all bill.">
															<?= $this->M_supplier->findTheGoodSupplierTotalBillCount($list->s_id) ?>
														</a>
													</span>
												</td>
												<td class="align-middle">
													<?= number_format(($list->s_initial_due_balance), 2, '.', ',') ?>
												</td>
												<td class="align-middle">
													<?= number_format(($list->s_payable), 2, '.', ',') ?>
												</td>
												<td class="align-middle">
													<?= number_format(($list->s_paid), 2, '.', ',') ?>
												</td>
												<td class="align-middle">
													<?= $total_due = number_format(($list->s_due), 2, '.', ',') ?>
												</td>
												<!-- <td class="align-middle">
                                                    </?= number_format(getSupplierPayableAmount($list->s_id), 2, '.', ',') ?>
                                                </td> -->
												<td class="text-left py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a id="<?= $list->s_id ?>" title="<?= $list->s_title ?>" total_due_amount="<?= $total_due; ?>" class="editbutton btn bg-success btn-sm  mr-1" data-toggle="modal">
															<i class="fa fa-plus-circle"></i> Add Payment
														</a>
														<a class='btn bg-olive btn-sm mr-1' href="<?php echo base_url(''); ?>setup/Supplier/viewSupplierWisePayment?s_id=<?= $list->s_id ?>">
															<i class='fas fa-eye'> View Payment</i>
														</a>
														<a class='btn bg-olive btn-sm mr-1' href="<?php echo base_url(''); ?>setup/Supplier/juteSupplierLedger?s_id=<?= $list->s_id ?>">
															<i class='fas fa-eye'> View Ledger</i>
														</a>
														<a iid="<?= $list->s_id ?>" title="<?= $list->s_title ?>" supplier_type="<?= $list->s_sup_t_id ?>" email="<?= $list->s_email ?>" address="<?= $list->s_address ?>" phone="<?= $list->s_phone ?>" licence="<?= $list->s_licence_no ?>" bank_id="<?= $list->s_b_id ?>" branch_id="<?= $list->s_bb_id ?>" ac_name="<?= $list->s_ac_name ?>" ac_number="<?= $list->s_ac_number ?>" due_balance="<?= $list->s_initial_due_balance ?>" image="<?= $list->s_img ?>" class='editButton btn bg-warning btn-sm mr-1' data-toggle="modal">
															<i class='fas fa-user-edit'></i> Edit
														</a>
														<a class='btn btn-secondary btn-sm mr-1' href="<?php echo base_url(''); ?>setup/Supplier/juteSupplierAnalysis?s_id=<?= $list->s_id ?>">
															<i class="fas fa-chart-bar"></i> Analysis
														</a>
													</div>
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
				<form role="form" action="<?php echo base_url('insert_supplier_payment') ?>" method="post" onkeydown="return event.key != 'Enter';" autocomplete="off">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<table class="table-bordered table table-sm">
									<tr>
										<td style="width: 50%;"><strong>Supplier Name:</strong></td>
										<td style="width: 50%;"><span id="title"></span></td>
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


<!-- Edit Supplier Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"> </i>Update Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?php echo base_url('update_supplier') ?>" enctype="multipart/form-data">
					<div class="card-body">
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-sm-6">
									<label>Supplier Name</label>
									<span class="text-danger">*</span>
									<input type="text" class="form-control" value="" name="s_title" id="supp_title" placeholder="Supplier Name" data-validation="length" data-validation-length="min2" required>
								</div>
								<div class="form-group col-sm-6">
									<label>Type</label>
									<span class="text-danger">*</span>
									<select class="form-control select2" style="width: 100%;" name="s_sup_t_id" id="supplier_type" required>
										<?php if ($supplier_type) {
											foreach ($supplier_type->result() as $supplier_type) {
										?>
												<option value="<?= $supplier_type->sup_t_id ?>">
													<?= $supplier_type->sup_t_title ?></option>
										<?php }
										}
										?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label>Email</label>
									<input type="email" class="form-control" value="" name="s_email" id="email" placeholder="Email Address">
								</div>
								<div class="form-group col-sm-6">
									<label>Address</label>
									<span class="text-danger">*</span>
									<input type="text" class="form-control" value="" name="s_address" id="address" placeholder="Address" data-validation="length" data-validation-length="min2" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label>Phone</label>
									<span class="text-danger">*</span>
									<input type="number" class="form-control" value="" name="s_phone" id="phone" placeholder="Phone Number" data-validation="length" data-validation-length="min2" required>
								</div>

								<div class="form-group col-sm-6">
									<label>License no</label>
									<input type="text" class="form-control" value="" name="s_licence_no" id="licence" placeholder="Licence no">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label>Bank Name</label>
									<select class="form-control select2" id="bank_id" name="s_b_id">
										<option value="">Select Bank</option>
										<?php if ($banks) {
											foreach ($banks->result() as $bank) { ?>
												<option value="<?= $bank->b_id; ?>"><?= $bank->b_title; ?></option>
										<?php }
										} ?>
									</select>
								</div>
								<div class="form-group col-sm-6">
									<label>Bank Branch</label>
									<select class="form-control select2" style="width: 100%;" id="branch" name="s_bb_id">
										<!-- <option>Select Branch</option> -->
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label>Name of Account</label>
									<input type="text" class="form-control" value="" name="s_ac_name" id="ac_name" placeholder="Enter Account Name">
								</div>
								<div class="form-group col-sm-6">
									<label>A/C Number</label>
									<input type="number" class="form-control" value="" name="s_ac_number" id="ac_number" placeholder="Enter Bank Account Number">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label>Previous Due Blance</label>
									<input type="text" class="form-control input-number" value="" name="s_initial_due_balance" id="due_balance" readonly>
								</div>
								<div class="form-group col-sm-6">
									<label>Image</label>
									<input type="file" class="form-control" value="" name="s_img" id="image_url">
									<!-- <img src="<//?= $list->s_img ?>" class="img-square" width="40px" height="40px" alt=""> -->
								</div>
							</div>
							<input type="hidden" name="s_id" id="iid">
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-info">Save changes</button>
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

<script type="text/javascript">
	$(document).ready(function() {
		$(".editbutton").click(function(e) {
			var iid = $(this).attr('id');
			var title = $(this).attr('title');
			var total_due_amount = $(this).attr('total_due_amount');
			// alert(iid);
			$('#myModal').modal('show');
			$('#id').val(iid);
			$('#title').text(title);
			$('#total_due_amount').text(total_due_amount);
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".editButton").click(function(e) {


			var iid = $(this).attr('iid');
			var title = $(this).attr('title');
			var supplier_type = $(this).attr('supplier_type');
			var email = $(this).attr('email');
			var address = $(this).attr('address');
			var phone = $(this).attr('phone');
			var licence = $(this).attr('licence');
			var bank_id = $(this).attr('bank_id');
			var branch_id = $(this).attr('branch_id');
			var ac_name = $(this).attr('ac_name');
			var ac_number = $(this).attr('ac_number');
			var due_balance = $(this).attr('due_balance');
			var image = $(this).attr('image');
			// alert(iid);
			$('#myModal2').modal('show');
			$('#iid').val(iid);
			$('#supp_title').val(title);
			$('#supplier_type').val(supplier_type).trigger('change');
			$('#email').val(email);
			$('#address').val(address);
			$('#phone').val(phone);
			$('#licence').val(licence);

			$('#bank_id').attr("brance_id", branch_id);
			$('#bank_id').val(bank_id).trigger('change');
			$('#branch').val(branch_id).trigger('change');
			$('#ac_name').val(ac_name);
			$('#ac_number').val(ac_number);
			$('#due_balance').val(due_balance);
			$('#image_url').val(image);

		});

	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		// Bank Brach Cascading Dropdown
		$('#bank_id').change(function() {
			var iid = $(this).val();
			var brance_id = $(this).attr("brance_id");
			// alert(brance_id);
			if (iid != '') {
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('setup/Supplier/getBankBranch'); ?>',
					data: {
						branch_id: iid,
						ab_brance: brance_id
					},
					success: function(data) {
						$('#branch').html(data);
						console.log(data)

					}
				});
			}
		});
	});
</script>