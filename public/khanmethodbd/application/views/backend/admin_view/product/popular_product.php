<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Popular and Best Product
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Popular and Best Product</a></li>
			<li class="active"> Popular and Best Product List</li>
		</ol>
	</section>
	<!-- /.box -->

	<section class="content">

		<div class="box">
			<div class="box-header">
				<div class="row">
					<div class="col-md-3 col-md-offset-9">
						<a href="<?php echo base_url('backend/Admin/populer_and_best_product_add'); ?>" class="btn btn-success pull-right text-white"><i class="fa fa-plus"></i> Add New</a>
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
							<th>Product</th>
							<th>Type</th>
							<th>Status</th>

							<th>Action</th>

						</tr>
					</thead>
					<tbody>


						<?php
						if ($populer_product_list) {
							$Serial = 1;
							foreach ($populer_product_list->result() as $row) {
								$product = get_rltn_data('poducts', 'p_id', $row->pb_product);
						?>

								<tr>
									<td><?= $Serial++ ?></td>
									<td><img width="50px" height="50px" src="<?php echo base_url(); ?>assets/products/<?= $product->p_imagepath ?>"></td>
									<td><?= $product->p_tittle ?></td>
									<td><span class="label label-success"><?= $row->pb_type == 1 ? 'Populer Product' : 'Best Product' ?></span></td>
									<td>
										<?php
										if ($row->pb_status == 0) { ?>
											<span class="label label-warning"> Inactive</span>
										<?php } else { ?>
											<span class="label label-success"> Active</span>
										<?php } ?>
									</td>


									<td class="text-center">
										<a class="btn btn-danger" href="<?php echo base_url(); ?>backend/Admin/populer_and_best_product_edit/<?= $row->pb_id ?>"><i class="fa fa-edit"></i> Edit</a>
										<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url(); ?>backend/Admin/populer_and_best_product_delete/<?= $row->pb_id ?>"><i class="fa fa-trash"></i> Delete</a>
									</td>
								</tr>

						<?php }
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