<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Sub Department</h1>
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
						<li class="breadcrumb-item active">Sub Department</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- List Department -->
				<div class="col-8">
					<div class="card card-success">
						<div class="card-header">
							<h3 class="card-title">Sub Department List</h3>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Department Name</th>
										<th>Sub Department Name</th>
										<th>Descriptions</th>
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
												<td class="align-middle text-center"><?= $serial ?></td>
												<td class="align-middle"><?= $this->M_department->getDepartmentById($list->sd_d_id)->d_title; ?></td>
												<td class="align-middle"><?= $list->sd_title ?></td>
												<td class="align-middle"><?= $list->sd_description ?></td>
												<td class="align-middle text-center">
													<a id="<?= $list->sd_id; ?>" d_id="<?= $list->sd_d_id; ?>" title="<?= $list->sd_title; ?>" description="<?= $list->sd_description; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
														<i class='fas fa-user-edit'></i>
													</a>
													<a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url(); ?>jute/Department/deleteSubDepartment?sd_id=<?= $list->sd_id; ?>">
														<button type='button' class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i>
														</button>
													</a>
													<a onclick="return confirm('Are you sure want to inactive this?');" href="<?php echo base_url(); ?>jute/Department/inactiveSubDepartment?sd_id=<?= $list->sd_id; ?>">
														<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
														</button>
													</a>
													<a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>jute/Department/permanentlyDeleteSubDepartment?sd_id=<?= $list->sd_id; ?>" type='button' class='btn bg-danger btn-xs ml-2'>
														<i class="fas fa-trash"></i>
														Permanently Delete
													</a>
												</td>
											</tr>
									<?php }
									} ?>
								</tbody>
								<tfoot>
									<tr>
										<th>Sl No</th>
										<th>Department Name</th>
										<th>Sub Department Name</th>
										<th>Descriptions</th>
										<th>Actions</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<!-- / List Department -->
				<!-- Add Department -->
				<div class="col-md-4">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Add Sub Department</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_sub_department'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Department Name</label>
										<select type="text" name="sd_d_id" class="form-control select2" style="width: 100%;">
											<option>Select Department</option>
											<?php if ($departments) foreach ($departments->result() as $department) { ?>
												<option value="<?= $department->d_id; ?>"><?= $department->d_title; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Sub Department Name</label>
										<input type="text" name="sd_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Sub Department Name" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Description</label>
										<textarea class="form-control" name="sd_description" rows="3" placeholder="Enter Sub Department Description" required></textarea>
									</div>
								</div>
								<input type="hidden" name="sd_id">
							</div>
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- / Add Department -->
			</div>
		</div>
	</section>
</div>

<!-- Department Update Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel">Update Sub Department</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url('update_sub_department'); ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Department Name</label>
								<select type="text" id="d_id" name="sd_d_id" class="form-control select2" style="width: 100%;">
									<?php if ($departments) foreach ($departments->result() as $department) { ?>
										<option value="<?php echo $department->d_id; ?>"><?php echo $department->d_title; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Sub Department Name</label>
								<input type="text" id="title" name="sd_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Sub Department Name" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Description</label>
								<textarea class="form-control" id="description" name="sd_description" rows="3" placeholder="Enter Sub Department Description" required></textarea>
							</div>
						</div>
						<input type="hidden" id="id" name="sd_id">
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
			var d_id = $(this).attr('d_id');
			var title = $(this).attr('title');
			var description = $(this).attr('description');
			// alert(iid);
			$('#myModal2').modal('show');
			$('#id').val(iid);
			$('#d_id').val(d_id);
			$('#title').val(title);
			$('#description').val(description);
		});
	});
</script>