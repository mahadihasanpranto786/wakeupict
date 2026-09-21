<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Add Labour</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_labour'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Name of Worker</label>
										<input type="text" name="l_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Worker Name" required>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Card No.</label>
										<input type="number" name="l_card_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Card/ID Number" required>
									</div>
									<div class="form-group col-sm-4">
										<label>Quarter</label>
										<select type="text" name="l_quarter" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
											<option value="Yes">Yes</option>
											<option value="No">No</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Designation</label>
										<select type="text" name="l_l_d_id" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
											<?php if ($labour_designations) foreach ($labour_designations->result() as $labour_designation) { ?>
												<option value="<?= $labour_designation->l_d_id; ?>"><?= $labour_designation->l_d_title; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Joining Date</label>
										<input type="date" name="l_joining_date" class="form-control" id="exampleInputEmail1" placeholder="Enter Joining Date" required>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">NID No.</label>
										<input type="number" name="l_nid_no" class="form-control" id="exampleInputEmail1" placeholder="Enter NID Number">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Department</label>
										<select type="text" id="d_id" name="l_d_id" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
											<?php if ($departments) foreach ($departments->result() as $department) { ?>
												<option value="<?= $department->d_id; ?>"><?= $department->d_title; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-sm-6">
										<label>Sub Department</label>
										<select type="text" id="sub_department" name="l_sd_id" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Date of Birth</label>
										<input type="date" name="l_date_of_birth" class="form-control" id="exampleInputEmail1" placeholder="Enter Date of Birth" required>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Mobile Number</label>
										<input type="number" name="l_mobile_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Mobile Number" required>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Wallet No.</label>
										<input type="number" name="l_wallet_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Wallet Number" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Worker Father's Name</label>
										<input type="text" name="l_father_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Worker Father's Name" required>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Worker Mother's Name</label>
										<input type="text" name="l_mother_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Worker Mother's Name" required>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Post Code</label>
										<input type="text" name="l_post_code" class="form-control" id="exampleInputEmail1" placeholder="Enter Post Code">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Contact Address (Official Address)</label>
										<textarea class="form-control" name="l_address" rows="2" placeholder="Enter Contact Address" required></textarea>
									</div>
								</div>
								<input type="hidden" name="l_id">
							</div>
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Script File -->
<script src="<?php echo base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		// Fetch Sub Department
		$('#d_id').on('change', function() {
			var sub_department_id = $('#d_id').val();
			// alert(sub_department_id);
			// exit;
			if (sub_department_id != '') {
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('jute/labour/fetch_sub_department'); ?>',
					data: {
						sub_department_id: sub_department_id
					},
					success: function(data) {
						$('#sub_department').html(data);
					}
				});
			}
		});
	});
</script>