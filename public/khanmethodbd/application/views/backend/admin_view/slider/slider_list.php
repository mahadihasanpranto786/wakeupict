<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Slider
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Slider</a></li>
			<li class="active">Slider List</li>
		</ol>
	</section>
	<!-- /.box -->

	<section class="content">

		<div class="box">
			<div class="box-header">
				<div class="row">
					<div class="col-md-3 col-md-offset-9">
						<a href="<?php echo base_url('backend/Slider/create_slider') ?>" class="btn btn-success pull-right text-white"><i class="fa fa-plus"></i> Add New</a>
					</div>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped datatable-button-html5-basic datatable-button-print-basic">
					<thead>
						<tr>
							<th>Serial</th>
							<th>Image</th>
							<th>Title</th>
							<th>Type</th>
							<th>Status</th>

							<th>Action</th>

						</tr>
					</thead>
					<tbody>


						<?php
						if ($slider_list) {
							$Serial = 1;
							foreach ($slider_list->result() as $row) {
						?>

								<tr>
									<td><?= $Serial++ ?></td>
									<td><img width="50px" height="50px" src="<?php echo base_url('assets/storefront/slider/' . $row->slider_image) ?>"></td>
									<td><?= $row->slider_title ?></td>
									<td><span class="label label-success"><?= $row->slider_type == 1 ? 'Main Slider' : 'Brand' ?></span></td>
									<td><span class="label label-success"><?= $row->slider_status == 0 ? 'Inactive' : 'Active' ?></span></td>

									<td class="text-center">
										<a class="btn btn-info" href="<?php echo base_url(); ?>backend/Slider/slider_edit/<?= $row->slider_id ?>"><i class="fa fa-edit"></i> Edit</a>
										<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url(); ?>backend/Slider/slider_delete/<?= $row->slider_id ?>"><i class="fa fa-trash"></i> Delete</a>
									</td>
								</tr>



						<?php }
						} else {
						}
						?>

					</tbody>
				</table>



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