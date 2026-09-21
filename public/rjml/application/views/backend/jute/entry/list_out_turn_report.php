<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1> Out Turn Report
						<b style="color:#f6ca71;">
							<?php if ($m) {
								$dateObj = DateTime::createFromFormat('!m', $m);
								echo "- " . $monthName = $dateObj->format('F') . " , " . $y;
							} ?>
						</b>
					</h1>
				</div>
				<div class="col-sm-6">
					<form role="form" action="<?php echo base_url('list_monthly_out_turn_report') ?>" method="post">
						<div class="row justify-content-end">
							<div class="form-group row col-4">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Year</label>
								<div class="col-sm-8">
									<select class="form-control select2 year" style="width: 100%;" name="y" required>
										<option value="">Select Year</option>
										<?php foreach (get_all_year() as $year) { ?>
											<option value="<?= $year ?>"> <?= $year ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group row col-4">
								<label for="inputEmail3" class="col-sm-3 col-form-label">Month</label>
								<div class="col-sm-8">
									<select class="form-control select2 month" id="month" style="width: 100%;" name="m" required>
										<option value="">Select Month</option>
										<option value="01">January</option>
										<option value="02">February</option>
										<option value="03">March</option>
										<option value="04">April</option>
										<option value="05">May</option>
										<option value="06">June</option>
										<option value="07">July</option>
										<option value="08">August</option>
										<option value="09">September</option>
										<option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
								</div>
							</div>
							<div class="form-group row col-4">
								<a href="" id="submit1"><button class="btn btn-info">
										Submit</button></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> Out Turn Report</h3>
							<?php
							$current_user_type = $this->session->userdata('current_type');
							$seePeople = array(1, 10, 302, 603);
							if (in_array($current_user_type, $seePeople)) {
							?>
								<a href="<?php echo base_url('add_out_turn_report'); ?>"><button class="btn btn-info pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i>
										Add Out Turn Report</button></a>
							<?php
							}
							?>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<!-- <th>Fy year</th> -->
										<th>Lot Number</th>
										<th>En Date</th>
										<th>AssDate</th>
										<th>Supplier Name</th>
										<!-- <th>Mokam</th> -->
										<th>Area</th>
										<!-- <th>C_Area</th>
										<th>Chalan (Mds.)</th> -->
										<th>Received Bojha</th>
										<th>Received (Mds.)</th>
										<th>Mds. After Moisture deduction</th>
										<?php if ($grades) {
											foreach ($grades->result() as $grade) {
										?>
												<input type="hidden" name="gradeId[]" class="form-control" id="" value='<?= $grade->j_g_id ?>'>
												<th class="text-center"><?= $grade->j_g_title ?></th>

										<?php
											}
										}
										?>
										<!-- <th>Total</th> -->
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($list) {
										foreach ($list->result() as $list) {
									?>
											<tr>
												<!-- <td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($list->ot_fy_id)->fy_title ?></td> -->
												<td class="align-middle"><?= $list->ot_lot_no ?></td>
												<td class="align-middle"><?= date("d-m-Y h:i A", strtotime($list->ot_en_date)); ?>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->ot_ass_date)); ?>
												</td>
												<td class="align-middle">
													<?= $this->M_supplier->getSupplierById($list->ot_en_s_id)->s_title ?></td>
												<!-- <td class="align-middle"></td> -->
												<td class="align-middle">
													<?php $en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($list->ot_fy_id, $list->ot_lot_no)->en_jute_variety;
													//echo $en_jute_variety;
													if ($en_jute_variety == 'Normal' || $en_jute_variety == 'Knaf' || $en_jute_variety == 'White' || $en_jute_variety == "") {
														echo $this->M_area->getAreaById($list->ot_ar_id)->ar_title;
													} else {
														echo $en_jute_variety;
													} ?>
												</td>
												<!-- <td class="align-middle">123</td>
											<td class="align-middle">5</td> -->
												<td class="align-middle"><?= $list->ot_rec_bojha ?></td>
												<td class="align-middle"><?= $list->ot_mds ?></td>
												<td class="align-middle">
													<?php
													$extraM = $this->M_jute_entry->getPurchaseInvoiceSummaryByOutTurnId($list->ot_id);
													if ($extraM) {
														if ($extraM->jpis_extra_moisture != 0) {
															echo $extraM->jpis_ot_mds_after_deduction;
														}
													}
													?>
												</td>
												<?php if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td>
															<?= getOutTurnPer($grade->j_g_id, $list->ot_id); ?>
														</td>
												<?php
													}
												}
												?>

												<!-- <td class="align-middle">34654</td> -->
												<td class="text-right py-0 align-middle">
													<div class="btn-group btn-group-sm">
														<?php
														// Invoice Summary Info
														$purchaseInvoiceInfo = $this->Common->get_single_row_information_multi_conditional('jute_purchase_invoice_summary', ['jpis_ot_id' => $list->ot_id, 'jpis_status' => 1]);



														if ($purchaseInvoiceInfo) {
															$purchaseInvoiceApproveInfoByUser = $purchaseInvoiceInfo->jpis_user_serially_approval_status;
														} else {
															$purchaseInvoiceApproveInfoByUser = '';
														}
														?>

														<!-- Invoice Return Info Button -->
														<?php
														if ($purchaseInvoiceInfo) {
															$jutePurchaseInvoiceReturnInfoByInvoiceId = $this->Common->get_single_row_information_multi_conditional('invoice_approval_return', ['iar_invoice_id' => $purchaseInvoiceInfo->jpis_id, 'iar_status' => 1]);
															if ($jutePurchaseInvoiceReturnInfoByInvoiceId) { ?>
																<button type="button" class="btn btn-pink btn-sm m-1 invoiceReturnInfoButton <?php echo ($jutePurchaseInvoiceReturnInfoByInvoiceId) ? true : "d-none"; ?>" data-invoice-id="<?= $purchaseInvoiceInfo->jpis_id ?>"><i class="fa fa-info-circle text-white" aria-hidden="true"></i>
																	Return Info </button>
														<?php }
														}
														?>
														<!-- /.Invoice Return Info Button -->



														<?php if ($list->ot_jpis_approve_status == 1) { ?>
															<button class="btn btn-info btn-sm" type="button"><i class="fas fa-eye"></i> Purchase Approved (No option to
																modify)</button>
														<?php } elseif ($purchaseInvoiceApproveInfoByUser > 0 && $list->ot_jpis_approve_status == 0) { ?>

															<button class="btn btn-warning btn-sm" type="button"><i class="fas fa-running"></i> Approval Running</button>

														<?php } else { ?>
															<?php
															$deletePeople = array(1, 10);
															if (in_array($current_user_type, $deletePeople)) {
															?>
																<a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url('') ?>jute/Entry/deleteOutTurn?ot_id=<?= $list->ot_id; ?>&&ot_en_id=<?= $list->ot_en_id; ?>" type='button' class='btn bg-danger btn-sm mr-1'>
																	<i class="fas fa-trash"></i>
																</a>
															<?php } ?>
															<?php if ($list->ot_bill_type == 1) { ?>
																<?php
																$invoicePeople = array(1, 10, 402, 603);
																if (in_array($current_user_type, $invoicePeople)) {
																?>
																	<button type="button" class="btn btn-primary btn-sm editbutton mr-1" data-toggle="modal" fy_year="<?= $list->ot_fy_id ?>" data-id="<?= $list->ot_id ?>" data-target="#myModalContract"><i class='fas fa-user-edit'> Contract</i></button>
																<?php
																}
																$editPeople = array(1, 10, 301, 603);
																if (in_array($current_user_type, $editPeople)) {
																?>
																	<a href="<?php echo base_url(''); ?>jute/Entry/editOutTurnReport?ot_id=<?= $list->ot_id; ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i>Edit</button></a>
																<?php }
															} elseif ($list->ot_bill_type == 0) { ?>
																<?php
																$invoicePeople = array(1, 10, 402, 603);
																if (in_array($current_user_type, $invoicePeople)) {
																?>
																	<a href="<?php echo base_url(); ?>jute/Entry/addInvoice?ot_id=<?= $list->ot_id ?>">
																		<button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="" data-id="" data-target=""><i class='fas fa-user-edit'> Add Invoice</i></button></a>
																<?php }
																$editPeople = array(1, 10, 301, 603);
																if (in_array($current_user_type, $editPeople)) {
																?>
																	<a href="<?php echo base_url(''); ?>jute/Entry/editOutTurnReport?ot_id=<?= $list->ot_id; ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i>Edit</button></a>
																<?php }
															} else {
																$jpis_id_get = $purchaseInvoiceInfo->jpis_id;
																$jutePurchaseInvoiceReturnInfoByInvoiceId = $this->Common->get_single_row_information_multi_conditional('invoice_approval_return', ['iar_invoice_id' => $jpis_id_get, 'iar_status' => 1]);
																if ($jutePurchaseInvoiceReturnInfoByInvoiceId) { ?>
																	<?php
																	$invoicePeople = array(1, 10, 402, 603);
																	if (in_array($current_user_type, $invoicePeople)) {
																	?>
																		<button type="button" class="btn btn-primary btn-sm editbutton mr-1" data-toggle="modal" fy_year="<?= $list->ot_fy_id ?>" data-id="<?= $list->ot_id ?>" data-target="#myModalContract"><i class='fas fa-user-edit'> Contract</i></button>
																	<?php
																	}
																	$editPeople = array(1, 10, 301, 603);
																	if (in_array($current_user_type, $editPeople)) {
																	?>
																		<a href="<?php echo base_url(''); ?>jute/Entry/editOutTurnReport?ot_id=<?= $list->ot_id; ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i>Edit</button></a>
																	<?php } ?>
																<?php } else { ?>
																	<button class="btn btn-indigo btn-sm" type="button"><i class="fas fa-eye"></i> Contract Bill Created</button>
																<?php } ?>
																<!-- <a href="#"><button class="btn btn-info btn-sm" type="button" data-placement="top" title="View"><i class="fas fa-eye"></i></button></a> -->
																<!-- <a href="<?php echo base_url(''); ?>jute/Entry/editOutTurnReport?ot_id=<?= $list->ot_id; ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a> -->
														<?php }
														} ?>
													</div>
												</td>
											</tr>
									<?php  }
									} ?>
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

<!-- Contract Invoice Modal-->
<div class="modal fade" id="myModalContract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-edit"></i>Contract Invoice</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form role="form" id="" action="<?php echo base_url(); ?>jute/Entry/addContractInvoice" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Bill Type</label>
						<span class="text-danger">*</span>
						<input type="text" class="form-control" name="bill_type" id="bill_type" value="Contract" readonly>
					</div>
					<div class="form-group">
						<label>Jute Rate Basis Sl No</label>
						<select class="form-control select2" style="width: 100%;" name="jute_rate_summary_table_id" id="jute_rate_summary_table_id" required>
							<option value=""> Select Basis Sl</option>
						</select>
					</div>
					<div class="form-group">
						<label>Contract Sl No</label>
						<span class="text-danger">*</span>
						<input type="text" class="form-control" name="contract_sl_no" id="contract_sl_no" value="" required>
					</div>

					<input type="hidden" name="ot_id" id="ot_id" value="<?= $list->ot_id ?>">

					<button type="submit" name="submit" class="btn btn-info"> Submit</button>
				</form>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- /Edit Modal-->


<!-- Return Invoice Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle" aria-hidden="true"></i>
					Invoice Return Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody id="information">
					</tbody>
				</table>
				<div class="modal-footer justify-content-right">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".editbutton").click(function() {
			$("#ot_id").val($(this).attr('data-id'));

			var fy_id = $(this).attr('fy_year');
			//alert(fy_id);
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/getJuteRateSheetByFyId') ?>",
				data: {
					fy_id: fy_id,
				},
				success: function(data) {
					//alert(data);
					var jute_rate_data = JSON.parse(data);
					var jute_rates = jute_rate_data.jute_rates;

					var html = '';
					$.each(jute_rates, function(key, value) {
						html += "<option value=" + value.jrs_id + ">" + value
							.jrs_sl_no + "</option>";
					});
					$('#jute_rate_summary_table_id').append(html);
				}
			});
		});




		/* ======================== Jute Return Information ======================== */
		$(".invoiceReturnInfoButton").click(function(e) {
			var invoice_id = $(this).data('invoice-id');
			var invoice_type = 1; //Jute purchase invoice type = 1
			$('#myModal').modal('show');
			$("#information").html('');
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('jute/Entry/getJutePurchaseInvoiceReturnInformation'); ?>",
				data: {
					invoice_id: invoice_id,
					invoice_type: invoice_type
				},
				success: function(data) {
					var getData = JSON.parse(data);
					var jutePurchaseInvoiceReturnInformation = getData
						.jutePurchaseInvoiceReturnInformation;

					html = '';
					$.each(jutePurchaseInvoiceReturnInformation, function(index, value) {
						var serial = index + 1;
						html += "<tr><td>" + serial + "</td><td>" + value
							.iar_return_reason + "</td><td>" + value.iar_created_at +
							"</td></tr>";
					});
					if (html) {
						$("#information").append(html);
					} else {
						$("#information").html(
							"<tr><td colspan='2' class='text-center'>No data found</span></td></tr>"
						);
					}

				}

			});
		});



	});
</script>
