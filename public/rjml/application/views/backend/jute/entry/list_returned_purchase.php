<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> List Returned Jute Purchase Invoice</h3>
							<?php
							$current_user_type = $this->session->userdata('current_type');
							$seePeople = array(1, 10, 302, 603);
							if (in_array($current_user_type, $seePeople)) {
							?>
								<a href="<?php echo base_url('add_out_turn_report'); ?>"><button class="btn btn-info pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i> Add Out Turn Report</button></a>
							<?php
							}
							?>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Fy year</th>
										<th>Date</th>
										<th>Supplier</th>
										<!-- <th>Chalan No</th> -->
										<!-- <th>Mokam</th> -->
										<th>Area</th>
										<th>Mill Lot No</th>
										<th>Quantity(Mds)</th>
										<th>Grand Total</th>
										<th>Bill Type</th>
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
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($list->jpis_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->jpis_created_at)); ?></td>
												<td class="align-middle"><?= $this->M_supplier->getSupplierById($list->jpis_ot_en_s_id)->s_title ?></td>
												<!-- <td class="align-middle"></td> -->
												<!-- <td class="align-middle"></td> -->
												<td class="align-middle">
													<?php $en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($list->jpis_fy_id, $list->jpis_ot_lot_no)->en_jute_variety;
													if ($en_jute_variety == 'Normal' or $en_jute_variety == "") {
														echo $this->M_area->getAreaById($this->M_jute_entry->getJuteOutTurnSummaryById($list->jpis_ot_id)->ot_ar_id)->ar_title;
													} else {
														echo $this->M_jute_entry->getJuteOutTurnSummaryById($list->jpis_ot_id)->ot_ar_id;
													} ?>

												</td>
												<td class="align-middle"><?= $list->jpis_ot_lot_no ?></td>
												<td class="align-middle"><?= $this->M_jute_entry->getJuteOutTurnSummaryById($list->jpis_ot_id)->ot_mds ?></td>
												<td class="align-middle"><?= number_format($list->jpis_grand_total, 2, '.', ',') ?></td>
												<td class="align-middle">
													<?php if ($list->jpis_bill_type == 1) {
														echo "Normal";
													} elseif ($list->jpis_bill_type == 2) {
														echo "Contract";
													} else {
														echo "Custom";
													} ?>
												</td>
												<td class="text-right align-middle">
													<div class="btn-group py-0 btn-group-sm">
														<!-- If Return Invoice Show this message -->
														<?php
														$userId = $this->session->userdata('currentActiveId');
														$jutePurchaseInvoiceReturnInfoByInvoiceId = $this->Common->get_single_row_information_multi_conditional('invoice_approval_return', ['iar_invoice_id' => $list->jpis_id, 'iar_status' => 1]);

														if ($userId) {
														?>
															<button type="button" class="btn btn-pink btn-sm m-1 invoiceReturnInfoButton <?php echo ($jutePurchaseInvoiceReturnInfoByInvoiceId) ? true : "d-none"; ?>" data-invoice-id="<?= $list->jpis_id ?>"><i class="fa fa-info-circle text-white" aria-hidden="true"></i> Return Info </button>
															<a href="<?php echo base_url(); ?>jute/Entry/viewPurchaseInvoice?jpis_id=<?= $list->jpis_id ?>"><button class="btn btn-info btn-sm m-1" type="button" data-placement="top" title="View"><i class="fas fa-eye"></i> View Bill Book</button></a>

														<?php
														}  ?>
														<!-- /.If Return Invoice Show this message -->
													</div>
												</td>
											</tr>
									<?php }
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




<!-- Return Invoice Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle" aria-hidden="true"></i> Invoice Return Information</h5>
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


<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
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
					var jutePurchaseInvoiceReturnInformation = getData.jutePurchaseInvoiceReturnInformation;

					html = '';
					$.each(jutePurchaseInvoiceReturnInformation, function(index, value) {
						var serial = index + 1;
						html += "<tr><td>" + serial + "</td><td>" + value.iar_return_reason + "</td><td>" + value.iar_created_at + "</td></tr>";
					});
					if (html) {
						$("#information").append(html);
					} else {
						$("#information").html("<tr><td colspan='2' class='text-center'>No data found</span></td></tr>");
					}

				}

			});
		});



	});
</script>
