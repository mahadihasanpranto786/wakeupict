<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Add Labour Attendance</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_labour_attendance'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-4">
										<label>Department</label>
										<select type="text" id="d_id" name="l_a_d_id" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
											<?php if ($departments) foreach ($departments->result() as $department) { ?>
												<option value="<?= $department->d_id; ?>"><?= $department->d_title; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label>Sub Department</label>
										<select type="text" id="sub_department" name="l_a_sd_id" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
										</select>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Date</label>
										<input type="date" name="l_a_date" class="form-control" id="exampleInputEmail1" placeholder="" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">Unit</label>
										<select type="text" id="" name="l_a_unit" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
											<option value="1">1</option>
											<option value="1(A)">1(A)</option>
											<option value="2">2</option>
											<option value="2(A)">2(A)</option>
										</select>
									</div>
									<div class="form-group col-sm-3">
										<label>Permanent Shift</label>
										<select type="text" id="" name="l_a_permanent_shift" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
										</select>
									</div>
									<div class="form-group col-sm-3">
										<label>Running Shift</label>
										<select type="text" id="" name="l_a_running_shift" class="form-control select2" style="width: 100%;" required>
											<option>Please Select One</option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
										</select>
									</div>
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">Running Day</label>
										<input type="number" name="l_a_running_day" class="form-control" id="exampleInputEmail1" placeholder="Enter Running Day" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="1">
									</div>
								</div>
								<div class="row">
									<table class="table table-striped">
										<tr>
											<th>Name of Worker</th>
											<th>Worker ID</th>
											<th>Shift - A</th>
											<th>Shift - B</th>
											<th>Shift - C</th>
											<th>Holiday Hour</th>
											<th>Arrear Hour</th>
											<th>Attendance Status</th>
										</tr>
										<tbody id="labour_attendance">
										</tbody>
									</table>
								</div>
								<input type="hidden" name="l_a_id">
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
		// Fetch Labour Information
		$('#sub_department').on('change', function() {
			var labour_id = $('#sub_department').val();
			if (labour_id != '') {
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('jute/labour/fetch_labour'); ?>',
					data: {
						labour_id: labour_id
					},
					success: function(data) {
						$('#labour_attendance').html(data);
					}
				});
			}
		});
	});
</script>