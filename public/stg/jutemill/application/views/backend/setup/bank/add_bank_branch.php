<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-7">
					<div class="card card-success mt-3">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"> <i class="fas fa-th"></i> Bank Branch</h3>
								</div>
							</div>
						</div>

						<?= alert_check() ?>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<table id="example1" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>SL No.</th>
												<th>Branch Name</th>
												<th>Bank Name</th>
												<th>Address</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if ($branch) {
												$serial = 0;
												foreach ($branch->result() as $branch) {
													$serial++;
													if ($branch->bb_status == 1) {
											?>
														<tr>
															<td class="align-middle"><?= $serial ?></td>
															<td class="align-middle"><?= $branch->bb_title ?></td>
															<td class="align-middle"><?= $this->M_bank->getBankById($branch->bb_b_id)->b_title ?></td>
															<td class="align-middle"><?= $branch->bb_address ?></td>
															<td class="align-middle text-center">
																<button type="button" class="btn bg-primary btn-xs editbutton" data-toggle="modal" data-id="<?= $branch->bb_id ?>"><i class='fas fa-user-edit'></i></button>
																<a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Bank/deleteBankBranch?bb_id=<?= $branch->bb_id ?>" id="<?= $branch->bb_id ?>">
																	<button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
																		<i class="fas fa-trash"></i>
																	</button>
																</a>
																<!-- <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Bank/permanentlyDeleteBankBranch?bb_id=<?= $branch->bb_id; ?>" type='button' class='btn bg-danger btn-xs'>
                                                                        <i class="fas fa-trash"></i>
                                                                        Permanently Delete
                                                                    </a> -->
															</td>
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

				<!-- Add Bank -->
				<div class="col-md-5">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New Branch</h3>
						</div>

						<form method="POST" action="<?php echo base_url('insert_bank_branch') ?>" onkeydown="return event.key != 'Enter';">
							<div class="card-body">
								<div class="col-md-12">
									<div class="form-group">
										<label>Branch Name</label>
										<span class="text-danger">*</span>
										<input type="text" class="form-control" value="" name="bb_title" id="" placeholder="Enter Bank Branch Title" data-validation="length" data-validation-length="min2" required>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											<label>Bank Name</label>
											<span class="text-danger">*</span>
											<select class="form-control select2" style="width: 100%;" id="" name="bb_b_id" required>
												<option value="">Select Bank</option>
												<?php
												if ($banks) {
													foreach ($banks->result() as $bank) {
												?>
														<option value="<?= $bank->b_id ?>"><?= $bank->b_title ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>Address</label>
										<span class="text-danger">*</span>
										<input type="text" class="form-control" value="" name="bb_address" id="" placeholder="Address" data-validation="length" data-validation-length="min2">
									</div>
								</div>
							</div>

							<div class="card-footer">
								<button type="submit" name="submit" class="btn btn-info"> Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
	</section>
</div>

<!-- Edit Modal-->
<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="fa fa-edit"></i>Edit Branch</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form role="form" id="" action="<?php echo base_url('update_bank_branch'); ?>" method="post" enctype="multipart/form-data">
					<div class="col-md-12">
						<div class="form-group">
							<label>Branch Name</label>
							<span class="text-danger">*</span>
							<input type="text" class="form-control" value="" name="bb_title" id="title" placeholder="Enter Bank Branch Title" data-validation="length" data-validation-length="min2">
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Bank Name</label>
								<span class="text-danger">*</span>
								<select class="form-control select2" style="width: 100%;" id="b_id" name="bb_b_id" required>
									<option value="">Select Bank</option>
									<?php
									if ($banks) {
										foreach ($banks->result() as $bank) {
									?>
											<option value="<?= $bank->b_id ?>"><?= $bank->b_title ?></option>
									<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Address</label>
							<span class="text-danger">*</span>
							<input type="text" class="form-control" value="" name="bb_address" id="address" placeholder="Address" data-validation="length" data-validation-length="min2">
						</div>
					</div>

					<input type="hidden" name="bb_id" id="id" value="">

					<button type="submit" name="submit" class="btn btn-info"> Submit</button>
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
				url: '<?php echo base_url(); ?>setup/Bank/editBankBranchByJason?id=' + iid,

				success: function(resp) {
					var json = $.parseJSON(resp);
					console.log(json);
					$('#id').val(json.branch.bb_id);
					$('#title').val(json.branch.bb_title);
					$('#b_id').val(json.branch.bb_b_id).trigger('change');
					$("#address").val(json.branch.bb_address);

					$('#myModal2').modal('show');
				}
			});
		});

	});
</script>
