<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> List Processing Jute Purchase Invoice</h3>
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
														<?php
														$userId = $this->session->userdata('currentActiveId');
														if ($userId) {
														?>
															<a href="<?php echo base_url(); ?>jute/Entry/viewPurchaseInvoice?jpis_id=<?= $list->jpis_id ?>"><button class="btn btn-info btn-sm m-1" type="button" data-placement="top" title="View"><i class="fas fa-eye"></i> View Bill Book</button></a>
														<?php
														}
														?>
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