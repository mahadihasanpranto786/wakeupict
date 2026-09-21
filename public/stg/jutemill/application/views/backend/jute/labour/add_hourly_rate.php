<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title">Rate Per Hour</h3>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Labour Name</th>
										<th>Sub Department</th>
										<th>Hourly Rate</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody><?php
										if ($list) {
											$serial = 0;
											foreach ($list->result() as $list) {
												$serial++; ?>
											<tr>
												<td class="align-middle text-center"><?= $serial ?></td>
												<td class="align-middle"><?= $this->M_labour->getLabourById($list->lhr_l_id)->l_name ?></td>
												<td class="align-middle"><?= $this->M_labour->getSubDepartmentByLabourId($list->lhr_l_id)->sd_title ?></td>
												<td class="align-middle"><?= $list->lhr_hourly_rate ?></td>
												<td class="align-middle text-center">
													<a id="<?= $list->lhr_id; ?>" labour_id="<?= $list->lhr_l_id; ?>" rate="<?= $list->lhr_hourly_rate; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
														<i class='fas fa-user-edit'></i>
													</a>
													<a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url(); ?>jute/Labour/deleteHourlyRate?lhr_id=<?= $list->lhr_id; ?>">
														<button type='button' class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i>
														</button>
													</a>
													<a onclick="return confirm('Are you sure want to inactive this?');" href="<?php echo base_url(); ?>jute/Labour/inactiveHourlyRate?lhr_id=<?= $list->lhr_id; ?>">
														<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
														</button>
													</a>
												</td>
											</tr>
									<?php }
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- Add Rate Per Hour -->
				<div class="col-md-6">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Add Rate Per Hour</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_labour_hourly_rate'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Labour Name</label>
										<select type="text" name="lhr_l_id" class="form-control select2" style="width: 100%;" required>
											<option>Please Select Labour Name</option>
											<?php if ($labours) foreach ($labours->result() as $labour) { ?>
												<option value="<?= $labour->l_id; ?>"><?= $labour->l_name; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Rate Per Hour</label>
										<input type="number" step="any" name="lhr_hourly_rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Rate Per Work" required>
									</div>
								</div>
								<input type="hidden" name="lhr_id">
							</div>
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- / Add Rate Per Hour -->
			</div>
		</div>
	</section>
</div>

<!-- Rate Per Hour Update Modal -->
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
				<form role="form" action="<?php echo base_url('update_labour_hourly_rate'); ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Labour Name</label>
								<select type="text" name="lhr_l_id" id="labour_id" class="form-control select2" style="width: 100%;" required>
									<option>Please Select Labour Name</option>
									<?php if ($labours) foreach ($labours->result() as $labour) { ?>
										<option value="<?= $labour->l_id; ?>"><?= $labour->l_name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Rate Per Hour</label>
								<input type="number" step="any" name="lhr_hourly_rate" id="rate" class="form-control" id="exampleInputEmail1" placeholder="Enter Rate Per Work" required>
							</div>
						</div>
						<input type="hidden" name="lhr_id" id="id">
					</div>
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
			var labour_id = $(this).attr('labour_id');
			var rate = $(this).attr('rate');
			// alert(iid);
			$('#myModal2').modal('show');
			$('#id').val(iid);
			$('#labour_id').val(labour_id);
			$('#rate').val(rate);
		});
	});
</script>