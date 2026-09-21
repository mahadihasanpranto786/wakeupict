<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>List Mismatch Area</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<!-- <li class="breadcrumb-item"><a href="<?php
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('add_out_turn_report'); ?>">Add Out Turn Report</a></li>
						<li class="breadcrumb-item active">List Out Turn Reports</li> -->
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
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> Mismatch Area Report</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Lot Number</th>
										<th>AssDate</th>
										<th>Supplier Name</th>
										<th>Jute Variety</th>
										<th>Entry Mokam</th>
										<th>Entry Area</th>
										<th>Entry BY</th>
										<th>Area By Out Turn Team </th>
										<th>Out Turn By</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($list) {

										foreach ($list->result() as $list) {
											$entryAreaId = null;
											$en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($list->ot_fy_id, $list->ot_lot_no)->en_jute_variety;
											if ($en_jute_variety == 'Normal') {
												$entryAreaId = $this->M_area->getAreaById($this->M_mokam->getMokamById($list->ot_en_mo_id)->mo_ar_id)->ar_id;
											} elseif ($en_jute_variety == 'Knaf') {
												$entryAreaId = 4;
											} elseif ($en_jute_variety == 'White') {
												$entryAreaId = 5;
											}
											if ($entryAreaId) {

												$outTurnAreaId = $list->ot_ar_id;
												if ($entryAreaId != $outTurnAreaId) {
									?>
													<tr>
														<td class="align-middle"><?= $list->ot_lot_no ?></td>
														<td class="align-middle"><?= date("d-m-Y", strtotime($list->ot_ass_date)); ?></td>
														<td class="align-middle"><?= $this->M_supplier->getSupplierById($list->ot_en_s_id)->s_title ?></td>
														<td class="align-middle"><?= $en_jute_variety ?></td>
														<td class="align-middle"><?= $this->M_mokam->getMokamById($list->ot_en_mo_id)->mo_title ?></td>
														<td class="align-middle">
															<?php
															if ($en_jute_variety == 'Normal') {
																echo $this->M_area->getAreaById($this->M_mokam->getMokamById($list->ot_en_mo_id)->mo_ar_id)->ar_title;
															} elseif ($en_jute_variety == 'Knaf') {
																echo $this->M_area->getAreaById(4)->ar_title;
															} elseif ($en_jute_variety == 'White') {
																echo $this->M_area->getAreaById(5)->ar_title;
															}
															?>
														</td>
														<td class="align-middle"> <?= $this->M_jute_entry->getJuteEntryById($list->ot_en_id)->en_created_by ?></td>
														<td class="align-middle">
															<?php $en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($list->ot_fy_id, $list->ot_lot_no)->en_jute_variety;
															//echo $en_jute_variety;
															if ($en_jute_variety == 'Normal' || $en_jute_variety == 'Knaf' || $en_jute_variety == 'White' || $en_jute_variety == "") {
																echo $this->M_area->getAreaById($list->ot_ar_id)->ar_title;
															} else {
																echo $en_jute_variety;
															} ?>
														</td>
														<td class="align-middle"><?= $list->ot_created_by ?></td>
													</tr>
									<?php  }
											}
										}
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