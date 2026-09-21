<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Unassorted Out Turn Report List</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_unassorted_added'); ?>">Back to Unassorted Added
								Summary</a></li>
						<li class="breadcrumb-item active">Unassorted Out Turn Report List</li>
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
							<h3 class="card-title mt-2"><i class="fa fa-tasks"></i> Unassorted Out Turn Report List
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<div class="card-body">

							<!-- Pagination Search -->
							<?php echo paginationSearch("list_unassorted_out_turn_report", $search, "GET", "Lot/Area"); ?>

							<div class="row">
								<div class="col-12">
									<form role="form" action="<?php echo base_url('insert_unassorted_added'); ?>" method="post">
										<table id="" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>SL.</th>
													<th>AssDate</th>
													<th>Lot Number</th>
													<th>Received Bojha</th>
													<th>Received (Mds.)</th>
													<th>Area</th>
													<?php if ($jute_grades) {
														foreach ($jute_grades->result() as $grade) {
													?>
															<input type="hidden" name="gradeId[]" class="form-control" id="" value='<?= $grade->j_g_id ?>'>
															<th class="text-center"><?= $grade->j_g_title ?></th>
													<?php
														}
													}
													?>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($lists) {
													foreach ($lists->result() as $list) {
												?>
														<tr>
															<td class="align-middle"><?= $serial++; ?></td>
															<td class="align-middle">
																<?= date("d-m-Y", strtotime($list->ot_ass_date)) ?></td>
															<td class="align-middle"><b><?= $list->ot_lot_no ?></b></td>
															<td class="align-middle"><?= $list->ot_rec_bojha ?></td>
															<td class="align-middle">
																<?php
																echo $jpis_ot_mds_after_deduction = $this->M_jute_entry->getPurchaseInvoiceSummaryByOutTurnId($list->ot_id)->jpis_ot_mds_after_deduction;
																?>
															</td>
															<td class="align-middle">
																<?php $en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($list->ot_fy_id, $list->ot_lot_no)->en_jute_variety;
																//echo $en_jute_variety;
																if ($en_jute_variety == 'Normal' || $en_jute_variety == 'Knaf' || $en_jute_variety == 'White' || $en_jute_variety == "") {
																	echo $this->M_area->getAreaById($list->ot_ar_id)->ar_title;
																} else {
																	echo $en_jute_variety;
																} ?>
															</td>

															<?php if ($jute_grades) {
																foreach ($jute_grades->result() as $grade) {
															?>
																	<td>
																		<?= getOutTurnPer($grade->j_g_id, $list->ot_id); ?>
																	</td>
															<?php
																}
															}
															?>

															<td class="">
																<a href="<?php echo base_url('jute/Khamal/insertNotUnAssortedAdded?') ?>ot_id=<?= $list->ot_id; ?>" type='button' class='btn btn-warning btn-sm mr-1 confirmationAlert'>
																	<i class="fas fa-trash"></i>
																	Not Applicable
																</a>
																<div class="btn-group btn-group-sm">
																	<a href="<?php echo base_url('') ?>jute/Khamal/addUnAssortedAdded?ot_id=<?= $list->ot_id ?>"><button class="btn btn-info btn-sm" type="button" data-placement="top" title="Add"><i class="fas fa-plus-circle">&nbsp;</i> Assign to
																			khamal &nbsp;</button></a>
																</div>
															</td>
														</tr>
												<?php  }
												} ?>
											</tbody>
										</table>
										<input type="hidden" name="kh_ua_a_v_id">
									</form>
								</div>
							</div>

							<!-- Showing Result Count Pagination -->
							<?php echo showingResultCountPagination($lists, $total_rows); ?>
						</div> 
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</section>
	<!-- /section -->
</div>
<!-- /.content-wrapper -->

<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	//  Row data auto calculate
	$(document).ready(function() {
		// Pagination Row Count
		var valRes = $("#valRes").val()
		$("#showingRow").text(valRes);
	});
</script>
