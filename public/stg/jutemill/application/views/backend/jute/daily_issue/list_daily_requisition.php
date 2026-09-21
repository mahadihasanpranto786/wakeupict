<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Daily Jute Requisition & Issue</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('add_daily_requisition') ?>">Add New Requisition</a></li>
						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_daily_issue') ?>">Go to Issue Summary</a></li>
						<li class="breadcrumb-item active">Daily Requisition & Issue List</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fas fa-th"></i> Daily Requisition Summary Lists</h3>
							<a href="<?php echo base_url('add_daily_requisition'); ?>"><button class="btn btn-info pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i> Add New Daily Requisition</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>SL No.</th>
										<th>Date</th>
										<th>Financial Year</th>
										<th>Production Unit</th>
										<th>Total Requisition</th>
										<th>Total Issue</th>
										<!-- <th>Total Balance</th> -->
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($reSummary) {
										foreach ($reSummary->result() as $list) {
									?>
											<tr>
												<td class="align-middle"><?= $list->res_sl_no ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->res_date)); ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($list->res_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $this->M_production_unit->getProductionUnitById($list->res_pu_id)->pu_title; ?></td>
												<td class="align-middle"><?= number_format($list->res_total_requisition, 3, '.', '') ?></td>
												<td class="align-middle">
													<?php if (!empty($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($list->res_id)->iss_total_issue)) {
														echo (number_format($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($list->res_id)->iss_total_issue, 3, '.', ''));
													} ?>
												</td>
												<!-- <td class="align-middle">
                                                    <//?php if (!empty($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($list->res_id)->iss_total_balance)) {
                                                        echo (number_format($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($list->res_id)->iss_total_balance));
                                                    } ?>
                                                </td> -->
												<td class="align-middle text-left">
													<div class="btn-group btn-group-sm">
														<a class=' btn bg-olive btn-xs mr-1' href="<?php echo base_url('') ?>jute/Daily_issue/viewDailyRequisition?res_id=<?= $list->res_id ?>">
															<i class='fas fa-eye'> View Requisition</i>
														</a>
														<?php if (!empty($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($list->res_id)->iss_res_id)) { ?>
															<a href="<?php echo base_url('') ?>jute/Daily_issue/viewDailyRequisitionIssue?res_id=<?= $list->res_id ?>" class=' btn bg-olive btn-xs mr-1' href=""><i class='fas fa-eye'> View Issue</i></a>
														<?php } ?>
														<?php if (empty($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($list->res_id)->iss_res_id)) { ?>
															<a href="<?php echo base_url('') ?>add_daily_issue?res_id=<?= $list->res_id ?>"><button class="btn btn-info btn-sm mr-1" type="button" data-placement="top" title="Add"><i class="fas fa-plus-circle">&nbsp;</i> Add Issue &nbsp;</button></a>
														<?php } ?>

														<?php
														$buttonSeePeople = array(1, 10, 301, 501, 603);
														if (in_array($current_user_type, $buttonSeePeople)) {
														?>
															<a href="<?php echo base_url('') ?>jute/Daily_issue/editDailyRequisition?res_id=<?= $list->res_id ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit Requisition</button></a>
															<!-- Conditional delete -->
															<?php
															$issueByRequisitionId = $this->Common->get_single_row_information_multi_conditional('issue_summary', ['iss_res_id' => $list->res_id, 'iss_status' => 1]);
															if ($issueByRequisitionId) {
																if ($issueByRequisitionId->iss_res_id == $list->res_id) {
															?>
																	<button class="btn btn-danger btn-sm ml-1 requisitionDeleteAlert" type="button" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</button>
																<?php }
															} else { ?>
																<a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url('') ?>jute/Daily_issue/deleteRequisitionSummary?res_id=<?= $list->res_id ?>"><button class="btn btn-danger btn-sm ml-1" type="button" data-placement="top" title="Delete"><i class="fa fa-trash"></i> Delete</button></a>
														<?php }
														} ?>
													</div>
												</td>
											</tr>
									<?php }
									}  ?>
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


<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		// Just for Alert
		$(".requisitionDeleteAlert").click(function() {
			Swal.fire({
				icon: 'error',
				title: 'Sorry',
				text: "You can't delete now. You already issue jute for this requisition. If you want to delete this, delete issue first then you will be able to delete this requisition.",
			})
		});

	});
</script>
