<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>List All Entries </h1>
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
						<?php
						$seePeople = array(1, 10, 102);
						if (in_array($current_user_type, $seePeople)) {
						?>
							<li class="breadcrumb-item active"><a href="<?php echo base_url('add_entry'); ?>">Add New
									Entry</a></li>
						<?php } ?>

						<li class="breadcrumb-item active">List All Entries</li>
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
							<h3 class="card-title"><i class="fa fa-th"></i> All Entries</h3>
							<?php
							if (in_array($current_user_type, $seePeople)) {
							?>
								<a href="<?php echo base_url('add_entry'); ?>"><button class="btn btn-info pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i>
										Add New Entry</button></a>

							<?php } ?>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="row">
								<div class="col-sm-8 p-0"></div>
								<div class="col-sm-4 text-right p-0">
									<table class="table table-borderless">
										<tr>
											<td class="d-flex justify-content-end text-right">
												<form action="<?php echo base_url('list_jute_entry'); ?>" method="get" class="inline-block" style="width:90%;">
													<div class="input-group mb-3">
														<input type="search" name="search" value="<?= $search ? $search : false ?>" class="form-control" placeholder="Lot/Chalan/Supplier/Truck/mokam/chalan mds" aria-label="Search">
														<div class="input-group-append">
															<button type="submit" class="btn-primary border-0">Submit</button>
														</div>
													</div>
												</form>
												<form action="<?php echo base_url('list_jute_entry'); ?>" method="get" style="width:10%;">
													<div class="input-group mb-3">
														<div class="input-group-append">
															<button type="submit" class="btn-danger border-0" style="height: 38px; width:100%;">Reset</button>
														</div>
													</div>
												</form>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<table id="" class="table table-bordered table-striped">
								<thead>
									<tr>
										<!-- <th>Serial</th> -->
										<th>Sl</th>
										<th>Mill Lot No</th>
										<th>Entry Date</th>
										<th>Supplier</th>
										<th>Chalan No</th>
										<th>Varity</th>
										<th>Mokam</th>
										<?php
										$notSeePeople = array(101, 102, 301, 302);
										if (!in_array($current_user_type, $notSeePeople)) {
										?>
											<th>Area</th>
										<?php } ?>
										<th>Chalan Bojha/Bale</th>
										<th>Chalan Mds</th>
										<th>Truck Info</th>
										<th>Created By</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$serial;
									if ($entry_ides) {

										foreach ($entry_ides as $en_id) {
											$entry = $this->M_jute_entry->getJuteEntryById($en_id);

									?>
											<tr>
												<td class="align-middle"><?= $serial++; ?></td>
												<td class="align-middle"><?= $entry->en_lot_no ?></td>
												<!-- <td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($entry->en_fy_id)->fy_title ?></td> -->
												<td class="align-middle"><?= date("d-m-Y h:i A", strtotime($entry->en_date)); ?>
												</td>
												<td class="align-middle">
													<?= $this->M_supplier->getSupplierById($entry->en_s_id)->s_title ?></td>
												<td class="align-middle"><?= $entry->en_chalan_no ?></td>
												<td class="align-middle">
													<?= $entry->en_jute_variety ?>
												</td>
												<td class="align-middle">
													<?= $this->M_mokam->getMokamById($entry->en_mo_id)->mo_title ?></td>
												<?php
												if (!in_array($current_user_type, $notSeePeople)) {
												?>
													<td class="align-middle">
														<?php if ($entry->en_jute_variety == 'Normal') {
															echo $this->M_area->getAreaById($this->M_mokam->getMokamById($entry->en_mo_id)->mo_ar_id)->ar_title;
														} else {
															echo $entry->en_jute_variety;
														} ?>
													</td>
												<?php } ?>
												<td class="align-middle">
													<?= $entry->en_bojha_bale . " x " . $entry->en_bojha_weight . " = " . number_format($entry->en_net_weight, 2, '.', ',') . " Kg"; ?>
												</td>
												<td class="align-middle"><?= number_format($entry->en_net_mds, 2, '.', ','); ?>
												</td>
												<td class="align-middle">
													<?php echo $entry->en_truck_no;
													echo "<br>";
													echo $entry->en_td_name;
													?>
												</td>
												<td class="align-middle">
													<?php
													echo $userInformation = $this->Common->get_single_row_information_multi_conditional('authority', ['a_id' =>  $entry->en_created_by, 'a_status' => 1])->a_name;
													?>
												</td>
												<td class="text-right py-0 align-middle">
													<?php if ($entry->en_jri_status == 2) { ?>
														<button class="btn btn-danger btn-sm" type="button"><i class="fas fa-eye"></i> Returned Done</button>
													<?php } elseif ($entry->en_jri_status == 1) { ?>
														<button class="btn btn-warning btn-sm" type="button"><i class="fas fa-spinner fa-spin"></i> Return Processing</button>
													<?php } elseif ($entry->en_out_turn_status == 0) { ?>
														<button class="btn btn-info btn-sm" type="button"><i class="fas fa-eye"></i>
															Assessment Done</button>
														<?php } else {
														$buttonSeePeople = array(102, 301, 302, 401, 402, 601, 602);
														if (!in_array($current_user_type, $buttonSeePeople)) {
														?>
															<div class="btn-group btn-group-sm">
																<a id="<?= $entry->en_id ?>" class="btn btn-warning btn-sm editButton mr-1" type="button" data-placement="top" data-toggle="modal" data-target="#myModal"><i class="fas fa-undo"></i> Return </a>

																<a href="<?php echo base_url('') ?>jute/Entry/editJuteEntry?en_id=<?= $entry->en_id ?>"><button class="btn btn-success btn-sm mr-1" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>
																<a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url('') ?>jute/Entry/deleteJuteEntry?en_id=<?= $entry->en_id; ?>" type='button' class='btn bg-danger btn-xs mr-1'>
																	<i class="fas fa-trash"></i>
																</a>
																<!-- <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>jute/Entry/permanentlyDeleteJuteEntry?en_id=<?= $entry->en_id; ?>" type='button' class='btn bg-danger btn-xs'>
																<i class="fas fa-trash"></i>
																Permanently Delete
															</a> -->
															</div>
													<?php }
													} ?>
												</td>
											</tr>
									<?php
										}
									}
									if (isset($total_rows)) {
										if ($total_rows == 0) {
											echo "<tr><td colspan='13' class='align-middle text-center text-danger table-danger'>Sorry! No record found.</td></tr>";
										}
									}
									?>
								</tbody>
							</table>
							<div class="row py-3 mt-2 align-middle">
								<div class="col-sm-4">
									<input type="hidden" id="valRes" value="<?php if (isset($entrys->result_id->num_rows)) {
																				echo $entrys->result_id->num_rows;
																			} else {
																				echo 0;
																			} ?>">
									<span>Showing <span id="showingRow"></span> Result From <?= $total_rows ?>
										Result</span>
								</div>
								<div class="col-sm-8 text-right">
									<div class="basic-pagination pull-right wow fadeInUp new__custom__pagination" data-wow-delay=".2s">
										<?= $this->pagination->create_links() ?><br>
									</div>
								</div>
							</div>
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







<!-- ======================== Jute Return Insert Modal ======================== -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class='fas fa-plus-circle'></i> Jute Return</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- form start -->
				<form role="form" action="<?php echo base_url('insert_jute_return_info'); ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Return Date</label>
								<span class="text-danger">*</span>
								<input type="text" name="jri_date" class="form-control datepicker" id="exampleInputEmail1" placeholder="Enter Return Date" value="<?= get_current_time_time(); ?>" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Return By</label>
								<span class="text-danger">*</span>
								<input type="text" name="jri_return_by" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">

								<label>Return Reason</label>
								<span class="text-danger">*</span>
								<textarea class="form-control" id="" name="jri_reason" rows="5" placeholder="Enter Reason" required></textarea>
							</div>
						</div>
						<input type="hidden" name="jri_en_id" value="" id="jri_id">
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>




<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".editButton").click(function(e) {
			var iid = $(this).attr('id');
			// alert(iid);
			$('#myModal').modal('show');
			$('#jri_id').val(iid);
		});

		// Row Count
		var valRes = $("#valRes").val()
		$("#showingRow").text(valRes);

	});
</script>
