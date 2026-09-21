<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Jute Grade</h1>
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
						<li class="breadcrumb-item active">Jute Grade</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-success">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Jute Grade List</h3>
								</div>
							</div>


						</div>

						<?= alert_check() ?>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Sl no.</th>
												<th>Name</th>
												<th>Total Purchased(<span class="text-danger">Mds</span>)</th>
												<th>Total Sale(<span class="text-danger">Mds</span>)</th>
												<th>Total Issue(<span class="text-danger">Mds</span>)</th>
												<!-- <th>Action</th> -->
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
														<td class="align-middle text-center"><?= $serial ?></td>
														<td><?= $list->j_g_title ?></td>
														<td><?php echo number_format($this->M_grade->getTotalPurchaseGradeWise($list->j_g_id), 2, ".", ","); ?></td>
														<td><?php echo number_format($this->M_grade->getTotalGradeWiseSaleMds($list->j_g_id), 2, ".", ","); ?></td>
														<td><?php echo number_format($this->M_grade->getTotalGradeWiseIssueMds($list->j_g_id), 2, ".", ","); ?></td>
														<!-- <td class="align-middle text-center">
                                                                <button type="button" class="btn bg-primary btn-xs editbutton" data-toggle="modal" data-id="<?= $list->j_g_id ?>"><i class='fas fa-user-edit'></i></button>
                                                                <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Grade/deleteJuteGrade?j_g_id=<?= $list->j_g_id ?>" id="<?= $list->j_g_id ?>">
                                                                    <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>setup/Grade/inactiveJuteGrade?j_g_id=<?= $list->j_g_id ?>" id="<?= $list->j_g_id ?>">
                                                                    <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Grade/permanentlyDeleteJuteGrade?j_g_id=<?= $list->j_g_id; ?>" type='button' class='btn bg-danger btn-xs'>
                                                                    <i class="fas fa-trash"></i>
                                                                    Permanently Delete
                                                                </a>
                                                            </td> -->
													</tr>
											<?php
												}
											}
											?>
											<tr>
												<td colspan="2"></td>
												<td><span class="text-danger font-weight-bold">Grand Total: </span><?php echo number_format($this->M_grade->totalGradeWiseSumMds(), 2, ".", ","); ?> Mds</td>
												<td><span class="text-danger font-weight-bold">Grand Total: </span><?php echo number_format($this->M_grade->totalGradeWiseSumSaleMds(), 2, ".", ","); ?> Mds</td>
												<td><span class="text-danger font-weight-bold">Grand Total: </span><?php echo number_format($this->M_grade->totalGradeWiseSumIssueMds(), 2, ".", ","); ?> Mds</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="col-md-6">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"> <i class="fas fa-info-circle"></i> About Jute Grade Information</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table id="" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Name</th>
												<th>Information</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><strong>Note:</strong></td>
												<td class="text-danger"><strong>Jute grades are pre-determined so there is no method to correct or delete any information.</strong></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- 
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New Jute Grade</h3>
                        </div>

                        <form id="add_grade" method="POST" action="<?php echo base_url('insert_jute_grade') ?>" onkeydown="return event.key != 'Enter';">
                            <div class="card-body">
                                <div class="=col-md-12">
                                    <div class="row">
                                        <label>Grade Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control removeWhiteSpace" value="" name="j_g_title" id="" placeholder="Grade Name" data-validation="length" data-validation-length="min2">
                                    </div>
                                    <div class="row">
                                        <label>Description</label>
                                        <span class="text-danger">*</span>
                                        <textarea type="text" class="form-control" value="" name="j_g_description" id="" placeholder="Description" data-validation="length" data-validation-length="min2" rows="5"></textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div> -->
			</div>
	</section>
</div>

<!-- Edit Jute Grade Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-edit"></i>Edit Jute Grade</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form role="form" id="editSupplierForm" action="<?php echo base_url() ?>setup/Grade/updateJuteGrade" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Grade Name</label>
						<span class="text-danger">*</span>
						<input type="text" class="form-control" name="j_g_title" id="j_g_title" placeholder="Grade Name" data-validation="length" data-validation-length="min2">
					</div>
					<div class="form-group">
						<label>Description</label>
						<span class="text-danger">*</span>
						<input type="text" class="form-control" value="" name="j_g_description" id="j_g_description" placeholder="Description" data-validation="length" data-validation-length="min2">
					</div>
					<input type="hidden" name="j_g_id" id="j_g_id" value="">

					<button type="submit" name="submit" class="btn btn-info">Submit</button>
				</form>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- /Edit Modal-->


<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".editbutton").click(function() {
			var iid = $(this).attr('data-id');
			$.ajax({
				type: 'GET',
				url: '<?php echo base_url(); ?>setup/Grade/editJuteGradeByJason?id=' + iid,

				success: function(resp) {
					var json = $.parseJSON(resp);

					console.log(json);
					$('#j_g_id').val(json.jute_grade.j_g_id);
					$('#j_g_title').val(json.jute_grade.j_g_title);
					$("#j_g_description").val(json.jute_grade.j_g_description);

					$('#myModal2').modal('show');
				}
			});
		});

	});
</script>