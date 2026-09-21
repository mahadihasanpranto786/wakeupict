<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- List Jute Processing Category -->
				<div class="col-6">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title">Labour Designation List</h3>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Designation Title</th>
										<th>Descriptions</th>
										<th>Actions</th>
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
												<td class="align-middle"><?= $list->l_d_title ?></td>
												<td class="align-middle"><?= $list->l_d_description ?></td>
												<td class="align-middle text-center">
													<a id="<?= $list->l_d_id; ?>" title="<?= $list->l_d_title; ?>" description="<?= $list->l_d_description; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
														<i class='fas fa-user-edit'></i>
													</a>
													<a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url(); ?>jute/Labour/deleteLabourDesignation?l_d_id=<?= $list->l_d_id; ?>">
														<button type='button' class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i>
														</button>
													</a>
													<a onclick="return confirm('Are you sure want to inactive this?');" href="<?php echo base_url(); ?>jute/Labour/inactiveLabourDesignation?l_d_id=<?= $list->l_d_id; ?>">
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
										<th>Designation Title</th>
										<th>Descriptions</th>
										<th>Actions</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<!-- / List Jute Processing Category -->
				<!-- Add Jute Processing Category -->
				<div class="col-md-6">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Add Labour Designation</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_labour_designation'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Labour Designation Title</label>
										<input type="text" name="l_d_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Labour Designation Name" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Description</label>
										<textarea class="form-control" name="l_d_description" rows="5" placeholder="Enter Labour Designation Description" required></textarea>
									</div>
								</div>
								<input type="hidden" name="l_d_id">
							</div>
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- / Add Jute Processing Category -->
			</div>
		</div>
	</section>
</div>

<!-- Jute Processing Category Update Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel">Update Rate Per Hour</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url('update_labour_designation'); ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Labour Designation Title</label>
								<input type="text" id="title" name="l_d_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Description</label>
								<textarea class="form-control" id="description" name="l_d_description" rows="5" placeholder="Enter Category Description" required></textarea>
							</div>
						</div>
						<input type="hidden" id="id" name="l_d_id">
					</div>
					<!-- /.card-body -->
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Save changes</button>
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
			var title = $(this).attr('title');
			var description = $(this).attr('description');
			// alert(iid);
			$('#myModal2').modal('show');
			$('#id').val(iid);
			$('#title').val(title);
			$('#description').val(description);
		});
	});
</script>