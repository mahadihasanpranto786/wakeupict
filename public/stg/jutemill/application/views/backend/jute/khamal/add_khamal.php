<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-8">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title"> <i class="fa fa-th"></i> Khamal Lists</h3>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>SL No</th>
										<th>Godown Name/No</th>
										<th>Khamal Name/No</th>
										<th>Jute Type (Area)</th>
										<th>Khamal used for</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody><?php
										if ($list) {
											$serial = 0;
											foreach ($list->result() as $list) {
												$serial++;
										?>
											<tr>
												<td class="align-middle text-center"><?= $serial ?></td>
												<td class="align-middle">
													<?PHP if ($list->kh_g_id) {
														echo $this->M_godown->getGodownById($list->kh_g_id)->g_title;
													} ?>
												</td>
												<td class="align-middle"><?= $list->kh_title ?></td>
												<td class="align-middle"><?= $this->M_area->getAreaById($list->kh_ar_id)->ar_title; ?></td>
												<td class="align-middle">
													<?php if ($list->kh_used == 1) {
														echo "Un Assorted";
													}
													if ($list->kh_used == 2) {
														echo "Assorted Kachcha Form";
													}
													if ($list->kh_used == 3) {
														echo "Pucca Form";
													} ?>
												</td>
												<td class="align-middle text-center">
													<a id="<?= $list->kh_id; ?>" g_id="<?= $list->kh_g_id; ?>" title="<?= $list->kh_title; ?>" description="<?= $list->kh_description; ?>" kh_ar_id="<?= $list->kh_ar_id; ?>" kh_used="<?= $list->kh_used; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
														<i class='fas fa-user-edit'></i>
													</a>
													<!-- <a onclick="return confirm('Are you sure want to delete this?');" href="jute/khamal/deleteKhamal?kh_id=<//?= $list->kh_id; ?>">
														<button type='button' class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i>
														</button>
													</a> -->
													<!-- <a href="<?php echo base_url('delete_khamal?') ?>kh_id=<?= $list->kh_id; ?>" type='button' id="deleteBySweetAlert" class='btn bg-danger btn-xs'>
														<i class="fas fa-trash"></i>
														Delete
													</a>

													<a onclick="return confirm('Are you sure want to inactive this?');" href="jute/khamal/inactiveKhamal?kh_id=<?= $list->kh_id; ?>">
														<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
														</button>
													</a> -->
												</td>
											</tr>
									<?php }
										} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- / List Khamal -->
				<!-- Add Khamal -->
				<div class="col-md-4">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New Khamal</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_khamal'); ?>" method="post" onkeydown="return event.key != 'Enter';" autocomplete="off">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Godown Name/No</label>
										<select class="form-control select2" name="kh_g_id" style="width: 100%;">
											<option value="">Select Godown</option>
											<?php if ($godowns) {
												foreach ($godowns->result() as $godown) { ?>
													<option value="<?= $godown->g_id; ?>"><?= $godown->g_title; ?></option>
											<?php }
											}
											?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Khamal Name/No</label>
										<input type="text" name="kh_title" class="form-control removeWhiteSpace khamal_name_warning" id="" placeholder="Enter Khamal Name/No" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Jute Type (Area)</label>
										<select class="form-control select2" style="width: 100%;" id="" name="kh_ar_id" required>
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
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Used for</label>
										<select class="form-control select2" id="" name="kh_used" style="width: 100%;" required>
											<option value="">Select</option>
											<option value="1">Un Assorted</option>
											<option value="2">Assorted Kachcha Form</option>
											<option value="3">Pucca Form</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Description</label>
										<textarea class="form-control" name="kh_description" rows="3" placeholder="Enter Khamal Description"></textarea>
									</div>
								</div>
								<input type="hidden" name="kh_id">
							</div>
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-info">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Update Khamal Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Update Khamal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url('update_khamal'); ?>" method="post" onkeydown="return event.key != 'Enter';" autocomplete="off">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Godown Name/No</label>
								<select class="form-control select2" id="g_id" name="kh_g_id" style="width: 100%;">
									<option value="">Select Godown</option>
									<?php if ($godowns) {
										foreach ($godowns->result() as $godown) { ?>
											<option value="<?= $godown->g_id; ?>"><?= $godown->g_title; ?></option>
									<?php }
									}
									?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Khamal Name/No</label>
								<input type="text" id="title" name="kh_title" class="form-control removeWhiteSpace khamal_name_warning_for_edit" required>
								<input type="hidden" id="titleForAlert" name="" class="form-control catch_knw" placeholder="">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Jute Type (Area)</label>
								<select class="form-control select2" style="width: 100%;" id="kh_ar_id" name="kh_ar_id" required>
									<option>Select Area</option>
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
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Used for</label>
								<select class="form-control select2" id="kh_used" name="kh_used" style="width: 100%;" required>
									<option value="">Select</option>
									<option value="1">Un Assorted</option>
									<option value="2">Assorted Kachcha Form</option>
									<option value="3">Pucca Form</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Description</label>
								<textarea class="form-control" id="description" name="kh_description" rows="3" placeholder="Enter Khamal Description"></textarea>
							</div>
						</div>
						<input type="hidden" id="id" name="kh_id">
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Save changes</button>
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
		$(".editbutton").click(function(e) {
			var iid = $(this).attr('id');
			var g_id = $(this).attr('g_id');
			var title = $(this).attr('title');
			var kh_ar_id = $(this).attr('kh_ar_id');
			var kh_used = $(this).attr('kh_used');
			var description = $(this).attr('description');
			// alert(iid);
			$('#myModal2').modal('show');
			$('#id').val(iid);
			$('#g_id').val(g_id).trigger('change');
			$('#title').val(title);
			$('#titleForAlert').val(title);
			$('#kh_ar_id').val(kh_ar_id).trigger('change');
			$('#kh_used').val(kh_used).trigger('change');
			$('#description').val(description);
		});


		// Duplicate KHamal Name Warning 
		$(".khamal_name_warning").blur(function() {
			var khamalNameWarning = $('.khamal_name_warning').val();
			var catch_knw = $('.catch_knw').val();
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url(''); ?>jute/Khamal/ajaxKhamalDuplicateNameAlert",
				data: {
					khamalNameWarning: khamalNameWarning
				},
				success: function(result) {
					if (result == 'no') {
						$('.khamal_name_warning').val(khamalNameWarning);
					} else {
						alert('Sorry! The number you entered already has. Please enter a unique name.');
						$('.khamal_name_warning').val('');
					}
				}
			})
		})
		// Duplicate KHamal Name Warning 
		$(".khamal_name_warning_for_edit").blur(function() {
			var khamalNameWarningForEdit = $('.khamal_name_warning_for_edit').val();
			var catch_knw = $('.catch_knw').val();
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url(''); ?>jute/Khamal/ajaxKhamalDuplicateNameAlert",
				data: {
					khamalNameWarning: khamalNameWarningForEdit
				},
				success: function(result) {
					if (result == 'no') {
						$('.khamal_name_warning_for_edit').val(khamalNameWarningForEdit);
					} else if (catch_knw == khamalNameWarningForEdit) {
						$('.khamal_name_warning_for_edit').val(khamalNameWarningForEdit);
					} else {
						$('.khamal_name_warning_for_edit').attr('placeholder', "This number already has. Please enter a unique name.");
						$('.khamal_name_warning_for_edit').val('');
					}
				}
			})
		})




	});
</script>