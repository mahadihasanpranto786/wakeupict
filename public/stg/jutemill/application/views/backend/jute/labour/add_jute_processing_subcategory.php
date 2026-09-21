<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- List Jute Processing Sub Category -->
				<div class="col-8">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title">Jute Processing Subcategory List</h3>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="align-middle text-center">Sl No</th>
										<th class="align-middle text-center">Category</th>
										<th class="align-middle text-center">বিবরণ</th>
										<th class="align-middle text-center">পরিমাণ মন (৪০ কেজি)</th>
										<th class="align-middle text-center">দর</th>
										<th class="align-middle text-center">পরিমাণ টাকা</th>
										<th class="align-middle text-center">Actions</th>
									</tr>
								</thead>
								<tbody><?php
										if ($list) {
											$serial = 0;
											foreach ($list->result() as $list) {
												$serial++;
										?>
											<tr>
												<td class="align-middle text-center"><?= $serial ?></td>
												<td class="align-middle"><?= $this->M_labour->getJuteprocessingCategoryById($list->jpsc_jpc_id)->jpc_title; ?></td>
												<td class="align-middle"><?= $list->jpsc_title ?></td>
												<td class="align-middle"></td>
												<td class="align-middle"><?= $list->jpsc_rate ?></td>
												<td class="align-middle"></td>
												<td class="align-middle text-center">
													<a id="<?= $list->jpsc_id; ?>" category_id="<?= $list->jpsc_jpc_id; ?>" title="<?= $list->jpsc_title; ?>" rate="<?= $list->jpsc_rate; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
														<i class='fas fa-user-edit'></i>
													</a>
													<a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url(); ?>jute/Labour/deleteJuteProcessingSubCategory?jpsc_id=<?= $list->jpsc_id; ?>">
														<button type='button' class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i>
														</button>
													</a>
													<a onclick="return confirm('Are you sure want to inactive this?');" href="<?php echo base_url(); ?>jute/Labour/inactiveJuteProcessingSubCategory?jpsc_id=<?= $list->jpsc_id; ?>">
														<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
														</button>
													</a>
												</td>
											</tr>
									<?php }
										} ?>
								</tbody>
								<tfoot>
									<tr>
										<th>Sl No</th>
										<th>Category</th>
										<th>বিবরণ</th>
										<th>পরিমাণ মন (৪০ কেজি)</th>
										<th>দর</th>
										<th>পরিমাণ টাকা</th>
										<th>Actions</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<!-- / List Jute Processing Sub Category -->
				<!-- Add Jute Processing Sub Category -->
				<div class="col-md-4">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Add Jute Processing Subcategory</h3>
						</div>
						<form role="form" action="<?php echo base_url('add_jute_processing_sub_category'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Category Name</label>
										<select type="text" name="jpsc_jpc_id" class="form-control select2" style="width: 100%;">
											<option>Please Select One</option>
											<?php if ($jute_processing_categories) foreach ($jute_processing_categories->result() as $jute_processing_category) { ?>
												<option value="<?php echo $jute_processing_category->jpc_id; ?>"><?php echo $jute_processing_category->jpc_title; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Subcategory Name</label>
										<input type="text" name="jpsc_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Subcategory Name" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Rate</label>
										<input type="text" name="jpsc_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Rate" required>
									</div>
								</div>
								<input type="hidden" name="jpsc_id">
							</div>
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- / Add Jute Processing Sub Category -->
			</div>
		</div>
	</section>
</div>

<!-- Jute Processing Sub Category Update Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel">Update Jute Processing Subcategory</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url('update_jute_processing_sub_category'); ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Category Name</label>
								<select type="text" id="category_id" name="jpsc_jpc_id" class="form-control select2" style="width: 100%;">
									<option>Please Select One</option>
									<?php if ($jute_processing_categories) foreach ($jute_processing_categories->result() as $jute_processing_category) { ?>
										<option value="<?php echo $jute_processing_category->jpc_id; ?>"><?php echo $jute_processing_category->jpc_title; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Subcategory Name</label>
								<input type="text" id="title" name="jpsc_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Subcategory Name" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Rate</label>
								<input type="text" id="rate" name="jpsc_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Rate" required>
							</div>
						</div>
						<input type="hidden" id="id" name="jpsc_id">
					</div>
					<div class="card-footer">
						<div class="pull-right">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
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
			var category_id = $(this).attr('category_id');
			var title = $(this).attr('title');
			var rate = $(this).attr('rate');
			// alert(iid);
			$('#myModal2').modal('show');
			$('#id').val(iid);
			$('#category_id').val(category_id);
			$('#title').val(title);
			$('#rate').val(rate);
		});
	});
</script>