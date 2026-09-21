<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Advertisement
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Advertisement</a></li>
			<li class="active">Advertisement List</li>
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
				<table id="example1" class="table table-bordered table-striped datatable-button-html5-basic datatable-button-print-basic">
					<thead>
						<tr>
							<th>Serial</th>
							<th>Image</th>
							<th>Title1</th>
							<th>Title2</th>
							<th>link</th>
							<th>Type</th>
							<th>Status</th>

							<th>Action</th>

						</tr>
					</thead>
					<tbody>


						<?php
						if ($advertisement_list) {
							$Serial = 1;
							foreach ($advertisement_list->result() as $row) {
								if ($row->ad_id != 6) {
									continue; ?>
								<?php }
								?>

								<tr>
									<td><?= $Serial++ ?></td>
									<td><img width="50px" height="50px" src="<?php echo base_url('assets/storefront/advertisement/' . $row->ad_image) ?>"></td>
									<td><?= $row->ad_title1 ?></td>
									<td><?= $row->ad_title2 ?></td>
									<td><?= $row->ad_link ?></td>
									<td><?= $row->ad_type ?></td>
									<td><span class="label label-success"><?= $row->ad_status == 0 ? 'Inactive' : 'Active' ?></span></td>

									<td class="text-center">
										<a class="btn btn-info" href="<?php echo base_url(); ?>backend/Advertisement/advertisement_edit/<?= $row->ad_id ?>"><i class="fa fa-edit"></i> Edit</a>
										<!-- <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url(); ?>backend/Advertisement/advertisement_delete/<?= $row->ad_id ?>"><i class="fa fa-trash"></i> Delete</a> -->
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