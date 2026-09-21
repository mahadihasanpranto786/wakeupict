<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Footer Categorty
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Footer Categorty</a></li>
			<li class="active">Add Footer Categorty </li>
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
				<form id="footer_category_store" role="form">
					<div class="col-md-6">

						<div class="form-group">
							<div class="form-group">
								<label for="title">Title </label>
								<input type="text" class="form-control input-circle" id="title" placeholder="Title " name="title" data-validation="required length" data-validation-length="max100">
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

		$("#footer_category_store").submit(function() {
			event.preventDefault();
			var title = $('#title').val();
			var category = $('#category').val();

			$.ajax({
				type: "POST",
				url: "<?= base_url('backend/FooterCategorty/check_available_footer_category') ?>",
				data: {
					category: category
				},
				success: function(data) {
					if (data == false) {
						$.ajax({
							type: "POST",
							url: "<?php echo base_url('backend/FooterCategorty/footer_category_store') ?>",
							data: {
								title: title,
								category: category
							},
							success: function(data) {
								window.location.href = "<?= base_url('backend/FooterCategorty') ?>";
							}
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'This category already exist!',
							text: "You can't add this category. Because this category already add!",
						});
					}
				}
			});
		});
	});
</script>