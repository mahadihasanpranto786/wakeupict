<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Popular and Best Product
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Popular and Best Product</a></li>
			<li class="active">Edit Popular and Best Product </li>
		</ol>
	</section>
	<!-- /.box -->
	<section class="content">
		<div class="box">
			<div class="box-header">
				<div class="row">
					<div class="col-md-3 col-md-offset-9">

					</div>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<form method="POST" id="update_popular_product">
					<div class="col-md-6">

						<input type="hidden" name="id" value="<?= $populer_product_list->pb_id ?>" id="popular_id">

						<div class="form-group">
							<label for="product">Product </label>
							<select class="form-control" data-validation="required" id="product" name="product">
								<?php foreach ($products_list->result() as $row) { ?>
									<option value='<?= $row->p_id ?>'><?= $row->p_tittle ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="type">Type</label>
							<select class="form-control" data-validation="required" id="type" name="type">
								<option value='1'>Popular</option>
								<option value='2'>Best</option>
							</select>
						</div>
						<div class="form-group">
							<label for="status">Status</label>
							<select class="form-control" data-validation="required" id="status" name="status">
								<option value='1'>Active</option>
								<option value='0'>Inactive</option>
							</select>
						</div>

						<button type="submit" class="btn btn-success">Update</button>
					</div>
					<div class="col-md-6">

					</div>
				</form>
			</div>
		</div>
	</section>
</div>

<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('') ?>assets/plugins/sweet_alert/sweetalert2@11.js"></script>
<script>
	$(document).ready(function() {

		$("#update_popular_product").submit(function() {
			event.preventDefault();
			var id = $('#popular_id').val();
			var product = $('#product').val();
			var status = $('#status').val();
			var type = $('#type').val();

			$.ajax({
				type: "POST",
				url: "<?= base_url('backend/Admin/check_update_available_populer_product'); ?>",
				data: {
					id: id,
					product: product
				},
				success: function(data) {
					if (data == false) {
						$.ajax({
							type: "POST",
							url: "<?= base_url('backend/Admin/populer_and_best_product_update'); ?>",
							data: {
								id: id,
								product: product,
								status: status,
								type: type
							},
							success: function(data) {
								window.location.href = "<?= base_url('backend/Admin/populer_and_best_product') ?>";
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'This product already exist!',
							text: "You can't update this product. Because this product already add!",
						});
					}
				}
			});
		});
	});
</script>
<script>
	$(document).ready(function() {
		document.getElementById('product').value = <?= $populer_product_list->pb_product ?>;

		document.getElementById('status').value = <?= $populer_product_list->pb_status ?>;

		document.getElementById('type').value = <?= $populer_product_list->pb_type ?>;
	});
</script>