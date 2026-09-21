<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Home Categorty
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home Categorty</a></li>
			<li class="active">Edit Home Categorty </li>
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
				<form id="update_home_category" role="form">
					<div class="col-md-6">

						<input type="hidden" name="id" id="home_id" value="<?= $home_category->home_id ?>">

						<div class="form-group">
							<div class="form-group">
								<label for="title">Title </label>
								<input type="text" class="form-control input-circle" id="title" placeholder="Title " name="title" data-validation="required length" data-validation-length="max100" value="<?= $home_category->home_title ?>">
							</div>

						</div>
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
			</div>

			</form>

		</div>
		<!-- /.box-body -->
</div>
<!-- /.box -->
</section>
</div>
<!-- /.content-wrapper -->
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

		$("#update_home_category").submit(function() {
			event.preventDefault();
			var id = $('#home_id').val();
			var title = $('#title').val();
			var category = $('#category').val();
			var status = $('#status').val();

			$.ajax({
				type: "POST",
				url: "<?= base_url('backend/HomeCategorty/check_update_available_home_category'); ?>",
				data: {
					id: id,
					category: category
				},
				success: function(data) {
					if (data == false) {
						$.ajax({
							type: "POST",
							url: "<?= base_url('backend/HomeCategorty/home_category_update') ?>",
							data: {
								id: id,
								title: title,
								category: category,
								status: status
							},
							success: function(data) {
								window.location.href = "<?= base_url('backend/HomeCategorty') ?>";
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
		document.getElementById('category').value = <?= $home_category->home_category ?>;
		document.getElementById('status').value = <?= $home_category->home_status ?>;
	});
</script>