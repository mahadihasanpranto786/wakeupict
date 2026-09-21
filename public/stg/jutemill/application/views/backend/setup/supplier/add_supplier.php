<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New Supplier</h3>
						</div>
						<form id="add_supplier" method="POST" action="<?php echo base_url('insert_supplier') ?>" enctype="multipart/form-data" autocomplete="off" onkeydown="return event.key != 'Enter';">
							<div class="card-body">
								<div class="col-md-12">
									<div class="form-group">
										<label>Supplier Name</label>
										<span class="text-danger">*</span>
										<input type="text" class="form-control" value="" name="s_title" id="" placeholder="Supplier Name" data-validation="length" data-validation-length="min2" required>
									</div>
									<div class="form-group">
										<label>Type</label>
										<span class="text-danger">*</span>
										<select class="form-control select2" style="width: 100%;" name="s_sup_t_id" required>
											<?php if ($supplier_type) {
												foreach ($supplier_type->result() as $supplier_type) {
											?>
													<option value="<?= $supplier_type->sup_t_id ?>" selected><?= $supplier_type->sup_t_title ?></option>
											<?php }
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" value="" name="s_email" id="" placeholder="Email Address">
									</div>
									<div class="form-group">
										<label>Address</label>
										<span class="text-danger">*</span>
										<input type="text" class="form-control" value="" name="s_address" id="" placeholder="Address" data-validation="length" data-validation-length="min2" required>
									</div>
									<div class="form-group">
										<label>Phone</label>
										<span class="text-danger">*</span>
										<input type="number" class="form-control" value="" name="s_phone" id="" placeholder="Phone Number" data-validation="length" data-validation-length="min2" required>
									</div>
									<div class="form-group">
										<label>Licence no</label>
										<input type="text" class="form-control" value="" name="s_licence_no" id="" placeholder="Licence no">
									</div>
									<div class="row">
										<div class="form-group col-sm-3">
											<label>Bank Name</label>
											<!-- <span class="text-danger">*</span> -->
											<select class="form-control select2" id="bank_id" name="s_b_id">
												<option value="">Select Bank</option>
												<?php if ($banks) {
													foreach ($banks->result() as $bank) { ?>
														<option value="<?= $bank->b_id; ?>"><?= $bank->b_title; ?></option>
												<?php }
												} ?>
											</select>
										</div>
										<div class="form-group col-sm-3">
											<label>Bank Branch</label>
											<!-- <span class="text-danger">*</span> -->
											<select class="form-control select2" style="width: 100%;" id="branch" name="s_bb_id">
												<option>Select Branch</option>
											</select>
										</div>
										<div class="form-group col-sm-3">
											<label>Name of Account</label>
											<!-- <span class="text-danger">*</span> -->
											<input type="text" class="form-control" value="" name="s_ac_name" id="" placeholder="Enter Account Name" data-validation="length" data-validation-length="">
										</div>
										<div class="form-group col-sm-3">
											<label>A/C Number</label>
											<!-- <span class="text-danger">*</span> -->
											<input type="text" class="form-control" value="" name="s_ac_number" id="" placeholder="Enter Bank Account Number" data-validation="length" data-validation-length="">
										</div>
									</div>
									<div class="form-group">
										<label>Previous Due Blance</label>
										<!-- <span class="text-danger">*</span> -->
										<input type="text" class="form-control input-number" value="" name="s_initial_due_balance" id="" placeholder="Due Blance">
									</div>
									<div class="form-group">
										<label>Image</label>
										<!-- <span class="text-danger">*</span> -->
										<input type="file" class="" value="" name="s_img" id="">
									</div>

								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
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
		$('#bank_id').on('change', function() {
			var iid = $('#bank_id').val();
			// alert(iid);
			if (iid != '') {
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('setup/Supplier/getBankBranch'); ?>',
					data: {
						branch_id: iid
					},
					success: function(data) {
						$('#branch').html(data);
					}
				});
			}
		});
	});
</script>
