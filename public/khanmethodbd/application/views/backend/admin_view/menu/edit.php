<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Menu
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
			<li class="active">Edit Menu </li>
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
				<form id="update_menu" method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Menu/menu_update') ?>">
					<div class="col-md-6">

						<input type="hidden" id="menu_id" name="id" value="<?= $menu->menu_id ?>">

					
						<div class="form-group">
							<label for="category">Category </label>
							<select class="form-control" data-validation="required" id="category" name="category">
								<?php foreach ($categories_list->result() as $row) { ?>
									<option value='<?= $row->c_id ?>'><?= $row->c_name ?></option>
									<?php
									$sub_category = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => $row->c_id]);
									if ($sub_category) {
										foreach ($sub_category->result() as $sub) { ?>
											<option value='<?= $sub->c_id ?>'> --<?= $sub->c_name ?></option>
								<?php }
									}
								} ?>
							</select>
						</div>
						<div class="form-group">
							<label for="status">Status</label>
							<select class="form-control" data-validation="required" id="status" name="status">
								<option value='1'>Active</option>
								<option value='0'>Inactive</option>
							</select>
						</div>

						<button type="submit" class="btn btn-default">Submit</button>
					</div>
					<div class="col-md-6">

					</div>
				</form>
			</div>

		</div>
		<!-- /.box-body -->
	</section>
</div>
<!-- /.box -->
<style>
	.a_x {
		margin-top: 24px;
	}
</style>

<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('') ?>assets/plugins/sweet_alert/sweetalert2@11.js"></script>
<script>
	$(document).ready(function() {

		$("#update_menu").submit(function() {
			event.preventDefault();
			var id = $('#menu_id').val();
			var category = $('#category').val();
			var status = $('#status').val();

			$.ajax({
				type: "POST",
				url: "<?= base_url('backend/Menu/check_update_available_menu'); ?>",
				data: {
					id: id,
					category: category
				},
				success: function(data) {
					if (data == false) {
						$.ajax({
							type: "POST",
							url: "<?php echo base_url('backend/Menu/menu_update') ?>",
							data: {
								id: id,
								category: category,
								status: status
							},
							success: function(data) {
								window.location.href = "<?= base_url('backend/Menu') ?>";
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'This category already exist!',
							text: "You can't update this category. Because this category already add!",
						});
					}
				}
			});
		});
	});
</script>
<script>
	$(document).ready(function() {
		document.getElementById('category').value = <?= $menu->menu_category ?>;
		document.getElementById('status').value = <?= $menu->menu_status ?>;
	});
</script>