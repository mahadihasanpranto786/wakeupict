  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<div class="container-fluid">
  			<div class="row mb-2">
  				<div class="col-sm-6">
  					<h1>Invoice</h1>
  				</div>
  				<div class="col-sm-6">
  					<ol class="breadcrumb float-sm-right">
  						<li class="breadcrumb-item"><a href="#">Home</a></li>
  						<li class="breadcrumb-item active">Invoice</li>
  					</ol>
  				</div>
  			</div>
  		</div><!-- /.container-fluid -->
  	</section>

  	<section class="content">
  		<div class="container-fluid">
  			<div class="row">
  				<div class="col-12">
  					<!-- Main content -->
  					<div class="invoice p-3 mb-3">
  						<!-- title row -->
  						<div class="row">
  						</div>
  						<!-- info row -->
  						<div class="row invoice-info">
  							<div class="col-sm-4 invoice-col">
  								<p><strong class="">SL No: <?= $invoice_s->jpis_invoice_sl; ?></strong></p>
  							</div>
  							<!-- /.col -->
  							<div class="col-sm-4 invoice-col">
  								<div class="text-center">
  									<h3>Rajbari Jute Mills LTD.</h3>
  									<h2><i>PROJECT</i></h2>
  									<h3>Jute Department</h3>
  									<br>
  									<h4><u>Bill Book</u></h4>
  								</div>
  							</div>
  							<!-- /.col -->
  							<div class="col-sm-4 invoice-col">
  								<div class="text-right">
  									<b class="text-danger">Assessment Date:
  										<?php
											$outturnInfoById = $this->M_jute_entry->getJuteOutTurnSummaryById($invoice_s->jpis_ot_id);
											echo date("d-m-Y", strtotime($outturnInfoById->ot_ass_date)); ?> </b>
  									<br>
  								</div>
  							</div>
  						</div>
  						<!-- /.row -->

  						<!-- Table row -->
  						<div class="row">
  							<div class="col-12 table-responsive">
  								<table class="table table-striped">
  									<tr>
  										<th>Name of Supplier:</th>
  										<td><?= $this->M_supplier->getSupplierById($invoice_s->jpis_ot_en_s_id)->s_title ?>
  										</td>
  										<th>Bill Type: &nbsp; &nbsp; &nbsp; </th>
  										<td><?php if ($invoice_s->jpis_bill_type == 1) {
													echo "Normal";
												} elseif ($invoice_s->jpis_bill_type == 2) {
													echo "Contract";
												} else {
													echo "Custom";
												} ?></td>
  										<th>Financial Year: </th>
  										<td><?= $this->M_financial_year->getFinancialYearById($invoice_s->jpis_fy_id)->fy_title; ?>
  										</td>
  									</tr>
  									<tr>
  										<th style="width: 15%">Party calan no:</th>
  										<td><?= $invoice_s->jpis_ot_en_chalan_no; ?></td>
  										<th>Mill lot no: </th>
  										<td><?= $invoice_s->jpis_ot_lot_no; ?></td>
  										<th style="width: 15%">Entry Date:</th>
  										<td><?= date("d-m-Y h:s A", strtotime($invoice_s->jpis_ot_en_date)); ?></td>
  									</tr>
  									<tr>
  										<th>Mokam:</th>
  										<td><?= $this->M_mokam->getMokamById($this->M_jute_entry->getJuteOutTurnSummaryById($invoice_s->jpis_ot_id)->ot_en_mo_id)->mo_title ?>
  										</td>
  										<th>Area: </th>
  										<td>
  											<?php $en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($invoice_s->jpis_fy_id, $invoice_s->jpis_ot_lot_no)->en_jute_variety;
												if ($en_jute_variety == 'Normal' or $en_jute_variety == "Knaf" or $en_jute_variety == "White") {
													echo $this->M_area->getAreaById($this->M_jute_entry->getJuteOutTurnSummaryById($invoice_s->jpis_ot_id)->ot_ar_id)->ar_title;
												} else {
													echo $en_jute_variety;
												} ?>
  										</td>
  										<th>License no:</th>
  										<td><?= $this->M_supplier->getSupplierById($invoice_s->jpis_ot_en_s_id)->s_licence_no ?>
  										</td>
  									</tr>
  									<tr>
  										<th>Received bojha/bale: &nbsp; &nbsp; &nbsp;
  											<?= $invoice_s->jpis_ot_rec_bojha ?></th>
  										<th>Kgs: &nbsp; &nbsp; &nbsp; <?= $invoice_s->jpis_ot_kgs ?></th>
  										<th>Mds: &nbsp; &nbsp; &nbsp; <?= $invoice_s->jpis_ot_mds ?></th>
  										<th>Extra moisture: &nbsp; &nbsp; &nbsp;
  											<?= $invoice_s->jpis_extra_moisture ?></th>
  										<th>Mds after moisture deduction: </th>
  										<th><?= $invoice_s->jpis_ot_mds_after_deduction ?></th>
  									</tr>
  								</table>
  							</div>
  							<!-- /.col -->
  						</div>
  						<!-- /.row -->
  						<div class="row">
  							<div class="col-12 table-responsive">
  								<table class="table table-striped">
  									<tr>
  										<th>Grade</th>
  										<th>Out turn (%)</th>
  										<th><?php if ($invoice_s->jpis_jrs_id == 0) {
													echo "Rate";
												} else { ?>
  												Basic rate Sl. No :- <strong style="font-size: large; color: red"><?php if ($invoice_s->jpis_jrs_id != 0) {
																														echo $this->M_jute_rate->getJuteRateByJrsId($invoice_s->jpis_jrs_id)->jrs_sl_no;
																													} ?>
  													<?php if ($invoice_s->jpis_bill_type == 2) {
															echo "<br>" . "& Contract Sl. No-" . $invoice_s->jpis_contract_sheet_no;
														} ?>
  												</strong>
  											<?php
												}
												?>
  										</th>
  										<th>Out turn (Mds)</th>
  										<th>Amount</th>
  									</tr>
  									<?php if ($grades) {
											$totalPer = 0;
											foreach ($grades->result() as $grade) {
												if (getInvoiceValue($grade->j_g_id, $invoice_s->jpis_id)->jpiv_percentage != 0) {


										?>
  												<tr>
  													<td><?= $grade->j_g_title ?></td>
  													<td>
  														<?php
															$jpiv_percentage =	getInvoiceValue($grade->j_g_id, $invoice_s->jpis_id);
															if ($jpiv_percentage) {
																echo $jpiv_percentage->jpiv_percentage;
																$totalPer += $jpiv_percentage->jpiv_percentage;
															} else {
																echo 0;
															}
															?>
  													</td>

  													<td>
  														<?php
															$jpiv_unit_price =	getInvoiceValue($grade->j_g_id, $invoice_s->jpis_id);
															if ($jpiv_unit_price) {
																echo $jpiv_unit_price->jpiv_unit_price;
															} else {
																echo 0;
															}
															?>
  													</td>
  													<td>
  														<?php
															$jpiv_weight_mds =	getInvoiceValue($grade->j_g_id, $invoice_s->jpis_id);
															if ($jpiv_weight_mds) {
																echo $jpiv_weight_mds->jpiv_weight_mds;
															} else {
																echo 0;
															}
															?>
  													</td>

  													<td>
  														<?php
															$jpiv_amount =	getInvoiceValue($grade->j_g_id, $invoice_s->jpis_id);
															if ($jpiv_amount) {
																echo number_format($jpiv_amount->jpiv_amount, 2, '.', ',');
																//echo $jpiv_amount->jpiv_amount;
															} else {
																echo 0;
															}
															?>
  													</td>
  												</tr>
  									<?php
												}
											}
										}
										?>

  									<tr class="table-warning">
  										<th>Total</td>
  										<th>
  											<?php echo $totalPer;
												?>
  										</th>
  										<th><b>Avg rate = </b>
  											<?php echo number_format($invoice_s->jpis_grand_total / $invoice_s->jpis_ot_mds_after_deduction, 3, '.', ',');
												?>
  										</th>
  										<th>
  											<?php echo $invoice_s->jpis_ot_mds_after_deduction;
												?>
  										</th>
  										<th>
  											<?= number_format($invoice_s->jpis_grand_total, 2, '.', ',') ?>
  										</th>
  									</tr>
  								</table>
  							</div>
  							<!-- /.col -->
  						</div>
  						<!-- /.row -->

  						<div class="row mt-2">
  							<!-- accepted payments column -->
  							<div class="col-6">
  								<th style="width: 15%;">Taka in word: <?php
																		$totalTaka = round($invoice_s->jpis_grand_total);
																		echo talkTomoney($totalTaka); ?></th>
  								<td>

  								</td>
  							</div>
  							<!-- /.col -->
  							<div class="col-6">
  								<!-- <th style="width: 15%;">Avg rate:</th> -->
  								<td><?php // echo $purchase->avg_rate; 
										?></td>
  							</div>
  							<!-- /.col -->
  						</div>
  						<!-- /.row -->

  						<div class="row mt-4">
  							<div class="col-md-12">
  								<table class="table table-striped">
  									<tr>
  										<td width="20%" class="text-center">
  											<!-- Created By -->
  											<p class="mb-0"><strong>
  													<i><?php
															$createdUserInfo = $this->Common->get_single_row_information_multi_conditional('authority', ['a_id' => $invoice_s->jpis_created_by, 'a_status' => 1]);
															if ($createdUserInfo) {
																echo $createdUserInfo->a_name;
															}
															?></i>
  												</strong></p>
  											<p class="mb-0">
  												<?= date("d-m-Y", strtotime($invoice_s->jpis_created_at)); ?></p>
  											<p>Created By</p>
  											<!-- /.Created By -->
  										</td>


  										<!-- Approved Information -->
  										<?php
											$invoiceApproveStatusInfo = $this->Common->get_data_multi_conditional('invoice_approval_status', ['ias_invioce_id' => $invoice_s->jpis_id, 'ias_status' => 1, 'ias_invoice_type' => 1])->result();

											if ($invoiceApproveStatusInfo) {
												foreach ($invoiceApproveStatusInfo as $value) { ?>
  												<td class="text-center">
  													<p class="mb-0"><strong>
  															<i><?php
																	$approvedUserInfo = $this->Common->get_single_row_information_multi_conditional('authority', ['a_id' => $value->ias_user_id, 'a_status' => 1]);
																	if ($approvedUserInfo) {
																		echo $approvedUserInfo->a_name;
																	}
																	?></i>
  														</strong></p>
  													<p class="mb-0"><?= date("d-m-Y", strtotime($value->ias_created_at)); ?>
  													</p>
  													<p>Approved By</p>
  												</td>
  										<?php 	}
											}
											?>
  										<!-- /.Approved Information -->
  									</tr>
  								</table>
  							</div>
  						</div>


  						<!-- this row will not appear when printing -->
  						<div class="row no-print">
  							<div class="col-12">

  								<button class="btn btn-default m-1" onclick="window.print()"> <i class="fas fa-print"></i> Print</button>


  								<!-- Approve Invoice Button In Conditional -->
  								<?php
									$userId = $this->session->userdata('currentActiveId');
									$purchaseInvoiceApproveInfoByUser = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_user_id' => $userId, 'iajp_status' => 1]);
									$jutePurchaseInvoiceReturnInfoByInvoiceId = $this->Common->get_single_row_information_multi_conditional('invoice_approval_return', ['iar_invoice_id' => $invoice_s->jpis_id, 'iar_status' => 1]);

									if ($purchaseInvoiceApproveInfoByUser) {

										$serialApprove = (int)$invoice_s->jpis_user_serially_approval_status + 1;
										$serialMax = (int)$purchaseInvoiceApproveInfoByUser->iajp_approval_status;
										if ($serialMax == $serialApprove) { ?>

  										<?php if ($jutePurchaseInvoiceReturnInfoByInvoiceId) { ?>
  											<button class="btn btn-secondary float-right m-1"><i class="fas fa-undo-alt"></i>
  												Returned</button>
  										<?php } else { ?>
  											<!-- Approve -->
  											<a onclick="return confirm('Are you sure want to approve this invoice?');" href="<?php echo base_url(); ?>jute/Entry/approveInvoice?jpis_id=<?= $invoice_s->jpis_id ?>&&iajp_approval_status=<?= $purchaseInvoiceApproveInfoByUser->iajp_approval_status ?>&&user_id=<?= $userId ?>">
  												<button type="button" class="btn btn-success float-right m-1"><i class="fas fa-thumbs-up" aria-hidden="true"></i> Approve </button>
  											</a>
  											<!-- Return -->
  											<?php if ($createdUserInfo->a_id != $userId) {
												?>
  												<button type="button" class="btn btn-warning float-right m-1 invoiceReturnButton" data-invoice-id="<?= $invoice_s->jpis_id ?>" data-user-id="<?= $userId ?>"><i class="fas fa-undo" aria-hidden="true"></i> Return </button>
  											<?php }
												?>

  								<?php }
										}
									} ?>
  								<!-- /.Approve Invoice Button In Conditional -->

  							</div>
  						</div>
  					</div>
  					<!-- /.invoice -->
  				</div><!-- /.col -->
  			</div><!-- /.row -->
  		</div><!-- /.container-fluid -->
  	</section>
  	<!-- /.content -->
  </div>



  <!-- Return Invoice Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header bg-info">
  				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"> </i> Invoice Return With Reason
  				</h5>
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  					<span aria-hidden="true">&times;</span>
  				</button>
  			</div>
  			<div class="modal-body">
  				<form method="POST" role="form" action="<?php echo base_url('insert_jute_purchase_invoice_approval_return') ?>" enctype="multipart/form-data">
  					<div class="row">
  						<div class="form-group col-sm-12">
  							<label for="exampleInputEmail1">Return Reason</label>
  							<span class="text-danger">*</span>
  							<textarea class="form-control" name="iar_return_reason" cols="5" rows="5" placeholder="Enter Invoice Return Reason" required></textarea>
  						</div>
  					</div>
  					<input type="hidden" name="iar_invoice_id" id="invoiceId">
  					<input type="hidden" name="iar_user_id" id="userId">
  					<div class="modal-footer justify-content-between">
  						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  						<button type="submit" class="btn btn-info">Submit</button>
  					</div>
  				</form>
  			</div>
  		</div>
  	</div>
  </div>


  <!-- Script File -->
  <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function() {
  		/* ======================== Edit ======================== */
  		// Edit User
  		$(".invoiceReturnButton ").click(function(e) {
  			var invoice_id = $(this).data('invoice-id');
  			var user_id = $(this).data('user-id');
  			$('#myModal').modal('show');
  			$('#invoiceId').val(
  				invoice_id);
  			$('#userId').val(user_id);
  		});

  	});
  </script>
