<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Approx Distributed Amount</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_all_payment') ?>">All Payment List</a></li>
						<li class="breadcrumb-item active">Approx Distributed Amount</li>
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
						<h3 class="card-title"><i class="fas fa-th"></i> Payment Report</h3>
					</div>
				</div>
			</div>

			<?= alert_check() ?>
			<section class="content" style="margin-top:20px">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col-sm-1">
								</div>
								<div class="col-sm-5 border">
									<h4 class="mt-2">Total Due: <span class="text-danger"><?= number_format($query->total, 2, '.', ''); ?></span></h4>
								</div>
								<div class="col-sm-5 border">
									<h4 class="mt-2"><span class="text-danger"><?= $dPercentage  ?>%</span> of the total due amount: <span class="text-danger"><?= $query->total * $dPercentage / 100 ?></span></h4>
								</div>
								<div class="col-sm-1">
									<a href="<?php echo base_url(); ?>setup/Supplier/juteSupplierPaymentCalculator">
										<h6 class="mt-2  text-center"><i class="fas fa-sync fa-2x"></i></h6>
									</a>
								</div>
							</div>

							<div class="row">
								<!-- Select Method -->
								<div class="col-sm-3">
									<div class="form-group">
										<label class="mb-0">Select Payment Method</label>
										<select class="form-control select2" style="width: 100%;" name="">
											<option value="">Select One</option>
											<option value="Amount">Amount</option>
											<option value="Percentage">Percentage</option>
										</select>
									</div>
								</div>
								<div class="col-sm-9"></div>
							</div>


							<form action="<?php echo base_url('') ?>setup/Supplier/juteSupplierPaymentCalculator" method="post">
								<div class="row mb-2 Amount">
									<!-- Amount Calculate -->
									<div class="col-sm-6">
										<div class="input-group">
											<label for="exampleInputEmail1" class="mr-2 mt-2">Distributed Total Amount: </label>
											<input type="text" name="" value="" class="form-control disValue input-number" id="" placeholder="Enter Distributed Amount " onblur="getDistributedAmount()">
										</div>
									</div>
									<div class="col-sm-2">
										<div class="input-group">
											<label for="exampleInputEmail1" class="mr-2 mt-2"> Total creditor Suppliers: </label>
											<input type="number" value="<?php echo $dueSupplierQuantity->dueSupplierQuantity ?>" name="" id="" class="form-control QuantityOfSupplier" placeholder="" readonly>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="input-group">
											<label for="exampleInputEmail1" class="mr-2 mt-2"> Amount </label>
											<input type="any" value="" name="distribute_amount" id="" class="form-control amt" placeholder="" readonly>
										</div>
									</div>
									<!-- Submit Button -->
									<div class="col-sm-2">
										<button type="submit" class="btn btn-primary">Calculate Amount</button>
									</div>
								</div>
							</form>


							<form action="<?php echo base_url('') ?>setup/Supplier/juteSupplierPaymentCalculator" method="post">
								<div class="row mb-2 Percentage">
									<!-- Percentage Calculate -->
									<div class="col-sm-4">
										<div class="input-group">
											<label for="exampleInputEmail1" class="mr-2 mt-2">Percentage (%): </label>
											<input type="text" name="distribute_percentage" value="" class="form-control input-number percent" id="disValue" placeholder="Enter Distributed Percentage ">
										</div>
									</div>
									<!-- Submit Button -->
									<div class="col-sm-2">
										<button type="submit" class="btn btn-primary">Calculate Amount</button>
									</div>
									<div class="col-sm-6">
									</div>

								</div>
							</form>

							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>SL. No</th>
										<th>Name</th>
										<th>Info</th>
										<th>Total Purchase Amount</th>
										<th>Paid</th>
										<th>Due</th>
										<th>Purchase total</th>
										<!-- <th>Percentage Amount</th> -->
										<th>Distribute Amount</th>
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
												<td class="align-middle ">
													<?= $total_due = number_format(($list->s_due), 2, '.', ',') ?>
													<input type="hidden" class="ddue" value="<?= $list->s_due ?>">
												</td>
												<td class="align-middle">
													<?= number_format(getSupplierPayableAmount($list->s_id), 2, '.', ',') ?>
												</td>
												<!-- <td class="align-middle">
                                                    <input type="text" name="" class="form-control input-number" value="">
                                                </td> -->
												<td class="align-middle">
													<input type="text" name="" class="form-control input-number" value="<?php
																														$perAmount = $list->s_due * $dPercentage / 100;
																														if (!empty($perAmount)) {
																															echo $perAmount;
																														} else {
																															echo '';
																														}
																														?><?php echo $dAmount ?>">
												</td>
												<td class="text-left py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<a id="<?= $list->s_id ?>" title="<?= $list->s_title ?>" due="<?= $total_due ?>" view_percentage="<?= $dPercentage ?>" percentage_amount="<?php if (!empty($perAmount)) {
																																																		echo $perAmount;
																																																	} else {
																																																		echo $dAmount;
																																																	} ?>" percentageInNote="<?php if (!empty($dPercentage)) {
																																																								echo ($dPercentage), "% of the total due have been paid.";
																																																							} elseif (!empty($dAmount)) {
																																																								echo "Distributed Amount";
																																																							} else {
																																																								echo "write something";
																																																							} ?>" class="editbutton btn bg-success btn-sm mr-1" data-toggle="modal">
															<i class="fa fa-plus-circle"></i> Add Payment
														</a>
														<a class='btn bg-olive btn-sm mr-1' href="<?php echo base_url(''); ?>setup/Supplier/viewSupplierWisePayment?s_id=<?= $list->s_id ?>">
															<i class='fas fa-eye'> View Payment</i>
														</a>
														<a class='btn bg-olive btn-sm' href="<?php echo base_url(''); ?>setup/Supplier/juteSupplierLedger?s_id=<?= $list->s_id ?>">
															<i class='fas fa-eye'> View Ledger</i>
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


<!-- =========== Distributed Percentage Amount Insert Form =========== -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Payment View Percentage</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- form start -->
				<form role="form" action="<?php echo base_url('insert_approx_supplier_payment') ?>" method="post">
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
										<td style="width: 50%;"><span id="due"></span></td>
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
								<input type="text" name="sp_amount" id="percentage_amount" class="form-control input-number" placeholder="Enter Amount" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="exampleInputEmail1">Date</label>
								<input type="text" name="sp_date" id="sp_date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" required>
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
								<textarea class="form-control" name="sp_note" id="" value="" rows="3" placeholder="Enter Note"></textarea>
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


		$("select").change(function() {
			$(this).find("option:selected").each(function() {
				var optionValue = $(this).attr("value");
				if (optionValue) {
					$(".Amount").not("." + optionValue).hide();
					$("." + optionValue).show();
				} else {
					$(".Amount").hide();
				}
			});
		}).change();


		$("select").change(function() {
			$(this).find("option:selected").each(function() {
				var optionValue = $(this).attr("value");
				if (optionValue) {
					$(".Percentage").not("." + optionValue).hide();
					$("." + optionValue).show();
				} else {
					$(".Percentage").hide();
				}
			});
		}).change();





		//automatic get financial year id
		var sp_date = $('#sp_date').val();
		getFy(sp_date);

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
			var due = $(this).attr('due');
			var view_percentage = $(this).attr('view_percentage');
			var percentage_amount = $(this).attr('percentage_amount');
			var percentageInNote = $(this).attr('percentageInNote');
			// alert(iid);
			$('#myModal').modal('show');
			$('#id').val(iid);
			$('#title').text(title);
			$('#due').text(due);
			$('#view_percentage').val(view_percentage);
			$('#percentage_amount').val(percentage_amount);
			$('#percentageInNote').val(percentageInNote);
		});
	});

	// Row data auto calculation
	function getDistributedAmount() {
		var value = $('.disValue').val();
		var supplier = $('.QuantityOfSupplier').val();
		var ab = $('.amt').val(value / supplier);
	}
</script>