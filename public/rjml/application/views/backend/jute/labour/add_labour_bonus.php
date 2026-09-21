<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-8">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title">Attendance Bonus</h3>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sl No</th>
										<th>6 Days Attendance Bonus</th>
										<th>7 Days Attendance Bonus</th>
										<th>Night Allowance Per Hour</th>
										<th>Travel Allowance</th>
										<th>Welfare Amount</th>
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
												<td class="align-middle"><?= $list->lb_6days_attendance_bonus ?> tk</td>
												<td class="align-middle"><?= $list->lb_7days_attendance_bonus ?> tk</td>
												<td class="align-middle"><?= $list->lb_night_allowance ?> tk</td>
												<td class="align-middle"><?= $list->lb_travel_allowance ?> tk</td>
												<td class="align-middle"><?= $list->lb_welfare_amount ?> tk</td>
												<td class="align-middle text-center">
													<a id="<?= $list->lb_id; ?>" six_days="<?= $list->lb_6days_attendance_bonus; ?>" seven_days="<?= $list->lb_7days_attendance_bonus; ?>" n_allowance="<?= $list->lb_night_allowance; ?>" t_allowance="<?= $list->lb_travel_allowance; ?>" w_amount="<?= $list->lb_welfare_amount; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
														<i class='fas fa-user-edit'></i>
													</a>
													<a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url(); ?>jute/Labour/deleteLabourBonus?lb_id=<?= $list->lb_id; ?>">
														<button type='button' class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i>
														</button>
													</a>
												</td>
											</tr>
									<?php }
										} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- Add Rate Per Hour -->
				<div class="col-md-4">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Add Attendance Bonus</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_labour_bonus'); ?>" method="post">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-6">
										<label for="exampleInputEmail1">6 Days Attendance Bonus</label>
										<input type="number" step="any" name="lb_6days_attendance_bonus" class="form-control" id="exampleInputEmail1" placeholder="Enter 6 Days Attendance Bonus" required>
									</div>
									<div class="form-group col-sm-6">
										<label for="exampleInputEmail1">7 Days Attendance Bonus</label>
										<input type="number" step="any" name="lb_7days_attendance_bonus" class="form-control" id="exampleInputEmail1" placeholder="Enter 7 Days Attendance Bonus" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label for="exampleInputEmail1">Night Allowance Per Hour</label>
										<input type="number" step="any" name="lb_night_allowance" class="form-control" id="exampleInputEmail1" placeholder="Enter Night Allowance" required>
									</div>
									<div class="form-group col-sm-6">
										<label for="exampleInputEmail1">Travel Allowance</label>
										<input type="number" step="any" name="lb_travel_allowance" class="form-control" id="exampleInputEmail1" placeholder="Enter Travel Allowance" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Welfare Amount</label>
										<input type="number" step="any" name="lb_welfare_amount" class="form-control" id="exampleInputEmail1" placeholder="Enter Welfare Amount" required>
									</div>
								</div>
								<input type="hidden" name="lb_id">
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
				<h5 class="modal-title" id="exampleModalLabel">Update Bonus</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url('update_labour_bonus'); ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">6 Days Attendance Bonus</label>
								<input type="number" step="any" name="lb_6days_attendance_bonus" id="six_days" class="form-control" id="exampleInputEmail1" placeholder="Enter 6 Days Attendance Bonus" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">7 Days Attendance Bonus</label>
								<input type="number" step="any" name="lb_7days_attendance_bonus" id="seven_days" class="form-control" id="exampleInputEmail1" placeholder="Enter 6 Days Attendance Bonus" required>
							</div>
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Night Allowance Per Hour</label>
								<input type="number" step="any" name="lb_night_allowance" id="n_allowance" class="form-control" id="exampleInputEmail1" placeholder="Enter 6 Days Attendance Bonus" required>
							</div>
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Travel Allowance</label>
								<input type="number" step="any" name="lb_travel_allowance" id="t_allowance" class="form-control" id="exampleInputEmail1" placeholder="Enter 6 Days Attendance Bonus" required>
							</div>
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Welfare Amount</label>
								<input type="number" step="any" name="lb_welfare_amount" id="w_amount" class="form-control" id="exampleInputEmail1" placeholder="Enter 6 Days Attendance Bonus" required>
							</div>
						</div>
						<input type="hidden" name="lb_id" id="">
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
			var six_days = $(this).attr('six_days');
			var seven_days = $(this).attr('seven_days');
			var n_allowance = $(this).attr('n_allowance');
			var t_allowance = $(this).attr('t_allowance');
			var w_amount = $(this).attr('w_amount');
			// alert(iid);
			$('#myModal2').modal('show');
			$('#id').val(iid);
			$('#six_days').val(six_days);
			$('#seven_days').val(seven_days);
			$('#n_allowance').val(n_allowance);
			$('#t_allowance').val(t_allowance);
			$('#w_amount').val(w_amount);
		});
	});
</script>