<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-7">
					<div class="card card-success mt-3">

						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"> <i class="fas fa-th"></i> Mokam List</h3>
								</div>
							</div>
						</div>

						<?= alert_check() ?>
						<div class="card-body">
							<div class="row mt-2">
								<div class="col-12">
									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>SL. No.</th>
												<th>Mokam Name</th>
												<th>Total Purchased(<span class="text-danger">Mds</span>)</th>
												<th>Area</th>
												<?php
												$current_user_type = $this->session->userdata('current_type');
												$seePeople = array(1, 10, 302, 603);
												if (in_array($current_user_type, $seePeople)) {
												?>
													<th>Action</th>
												<?php
												}
												?>

											</tr>
										</thead>
										<tbody>
											<?php
											if ($list) {
												$serial = 0;
												foreach ($list->result() as $list) {
													if ($list->mo_ar_id != 4 and $list->mo_ar_id != 5) {
														$serial++;
											?>
														<tr>
															<td class="align-middle"><?= $serial ?></td>
															<td class="align-middle"><?= $list->mo_title ?></td>
															<td class="align-middle">
																<?php $total_mokam_wise_purchase =  $this->M_mokam->sumPurchasedMokamWiseJute('jpis_ot_mds', $list->mo_id);
																if ($total_mokam_wise_purchase) {
																	echo number_format(($total_mokam_wise_purchase), 2, '.', ',');
																} else {
																	echo 0;
																}
																?>
															</td>
															<td class="align-middle"><?= $this->M_area->getAreaById($list->mo_ar_id)->ar_title; ?></td>
															<?php
															$current_user_type = $this->session->userdata('current_type');
															$seePeople = array(1, 10, 603);
															if (in_array($current_user_type, $seePeople)) {
															?>
																<td width="200px" class="align-middle text-center">

																	<!-- <a href="<?php echo base_url(); ?>setup/Mokam/editMokam?mo_id=<?= $list->mo_id ?>" id="<?= $list->mo_id ?>">
                                                                    <button type='button' class='btn bg-primary btn-xs'><i class='fas fa-user-edit'></i>
                                                                    </button>
                                                                </a> -->
																	<button type="button" class="btn bg-primary btn-xs editbutton" data-toggle="modal" data-id="<?= $list->mo_id ?>"><i class='fas fa-user-edit'></i></button>
																	<?php if ($total_mokam_wise_purchase <= 0) { ?>
																		<a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Mokam/deleteMokam?mo_id=<?= $list->mo_id ?>" id="<?= $list->mo_id ?>">
																			<button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
																				<i class="fas fa-trash"></i>
																			</button>
																		</a>
																	<?php } else { ?>
																		<a onclick="return confirm('This Mokam ( <?= $list->mo_title ?> ) use in <?php echo $this->M_mokam->countUsedMokamInPurchase($list->mo_id); ?> another places. That will be deleted. Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Mokam/deleteMokam?mo_id=<?= $list->mo_id ?>" id="<?= $list->mo_id ?>">
																			<button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
																				<i class="fas fa-trash"></i>
																			</button>
																		</a>
																	<?php } ?>

																	<!-- <a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>setup/Mokam/inactiveMokam?mo_id=<?= $list->mo_id ?>" id="<?= $list->mo_id ?>">
                                                                    <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Mokam/permanentlyDeleteMokam?mo_id=<?= $list->mo_id; ?>" type='button' class='btn bg-danger btn-xs ml-2'>
                                                                    <i class="fas fa-trash"></i>
                                                                    Permanently Delete
                                                                </a> -->

																</td>
															<?php
															}
															?>
														</tr>
											<?php
													}
												}
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-5">
					<?php
					$current_user_type = $this->session->userdata('current_type');
					$seePeople = array(1, 10, 603);
					if (in_array($current_user_type, $seePeople)) {
					?>
						<div class="card card-primary mt-3">
							<div class="card-header">
								<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New Mokam</h3>
							</div>
							<form id="add_mokam" method="POST" action="<?php echo base_url('insert_mokam') ?>" onkeydown="return event.key != 'Enter';">
								<div class="card-body">
									<div class="=col-md-12">
										<div class="form-group">
											<label>Mokam Name</label>
											<span class="text-danger">*</span>
											<input type="text" class="form-control" value="" name="mo_title" id="" placeholder="Mokam Name" data-validation="length" data-validation-length="min2">
										</div>
										<div class="form-group">
											<label>Area <span class="text-secondary">( N.B: Knaf & White area is predefined.) </span></label>
											<select class="form-control select2" style="width: 100%;" id="" name="mo_ar_id" required>
												<option value="">Select Area</option>
												<?php
												if ($areas) {
													foreach ($areas->result() as $area) {
												?>
														<option value="<?= $area->ar_id ?>"><?= $area->ar_title ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					<?php
					}
					?>

				</div>
			</div>
	</section>
</div>

<!-- Edit Mokam Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-edit"></i>Edit Mokam</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form role="form" id="editSupplierForm" action="<?php echo base_url('') ?>setup/Mokam/updateMokam" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Mokam Name</label>
						<span class="text-danger">*</span>
						<input type="text" class="form-control" name="mo_title" id="mo_title" placeholder="Mokam Name" data-validation="length" data-validation-length="min2">
					</div>
					<div class="form-group">
						<label>Area</label>
						<select class="form-control select2" style="width: 100%;" name="mo_ar_id" id="mo_ar_id" required>

							<?php
							if ($areas) {
								foreach ($areas->result() as $area) {
							?>
									<option value="<?= $area->ar_id ?>"><?= $area->ar_title ?></option>
							<?php
								}
							}
							?>
						</select>
					</div>

					<input type="hidden" name="mo_id" id="mo_id" value="">

					<button type="submit" name="submit" class="btn btn-info"> Update</button>
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
				url: '<?php echo base_url(); ?>setup/Mokam/editMokamByJason?id=' + iid,

				success: function(resp) {

					//var fruits = resp;
					var json = $.parseJSON(resp);
					//var x = resp.toString();

					console.log(json);
					$('#mo_id').val(json.mokam.mo_id);
					$('#mo_title').val(json.mokam.mo_title);
					$("#mo_ar_id").val(json.mokam.mo_ar_id).trigger('change');

					$('#myModal2').modal('show');
				}
			});
		});

	});
</script>