<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-8">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> Godown Report Calculation Helper</h3>
						</div>
						<div class="card-body">
							<?= alert_check(); ?>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>SL No.</th>
										<!-- <th>Start Date</th>
										<th>End Date</th> -->
										<th>Month</th>
										<th>Financial Year</th>
										<th>Cutting Rate</th>
										<th>Bad Provision Percentage</th>
										<th>Cutting Percentage</th>
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
												<!-- <td class="align-middle"><?= date("d-m-Y", strtotime($list->jch_start_date)); ?></td>
												<td class="align-middle"><?= date("d-m-Y", strtotime($list->jch_end_date)); ?></td> -->
												<td class="align-middle"><?= date("F Y", strtotime($list->jch_start_date)); ?></td>
												<td class="align-middle"><?= $this->M_financial_year->getFinancialYearById($list->jch_fy_id)->fy_title ?></td>
												<td class="align-middle"><?= $list->jch_cutting_rate ?></td>
												<td class="align-middle"><?= $list->jch_bad_provision_percentage ?></td>
												<td class="align-middle"><?= $list->jch_cutting_percentage ?></td>
												<td class="align-middle text-center">
													<!-- <a href="</?php echo base_url('jute/godown/deleteJuteCalculationHelper?') ?>jch_id=</?= $list->jch_id; ?>" type='button' id="deleteBySweetAlert" class='btn bg-danger btn-xs'>
														<i class="fas fa-trash"></i>
													</a>
                                                    <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>jute/Godown/permanentlyDeleteJuteCalculationHelper?jch_id=<?= $list->jch_id; ?>" type='button' class='btn bg-danger btn-xs ml-2'>
                                                        <i class="fas fa-trash"></i>
                                                        Permanently Delete
                                                    </a> -->


													<!-- <button type="button" data-id="<?= $list->jch_id ?>" data-start-date="<?= date("d-m-Y", strtotime($list->jch_start_date)); ?>" data-end-date="<?= date("d-m-Y", strtotime($list->jch_end_date)); ?>" data-cutting-rate="<?= $list->jch_cutting_rate; ?>" data-bad-provision="<?= $list->jch_bad_provision_percentage; ?>" data-cutting-percentage="<?= $list->jch_cutting_percentage; ?>" class="btn btn-warning btn-sm editButton"><i class="fas fa-edit"></i></button> -->
												</td>
											</tr>
									<?php }
										} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- / List Jute Calculation Helper -->
				<!-- Add Jute Calculation Helper -->
				<div class="col-md-4">
					<?php
					$current_user_type = $this->session->userdata('current_type');
					$formSeePeople = array(1, 10, 603);
					if (in_array($current_user_type, $formSeePeople)) {
					?>
						<div class="card card-primary mt-3">
							<div class="card-header">
								<h3 class="card-title"><i class="fa fa-plus-circle"></i> Add New Calculation Helper</h3>
							</div>
							<form role="form" action="<?php echo base_url('insert_jute_calculation_helper'); ?>" method="post">
								<div class="card-body">
									<div class="form-group row">
										<label for="" class="col-form-label">Year</label>
										<div class="col-sm-12">
											<select class="form-control select2" style="width: 100%;" name="jch_year" id="jch_year" required>
												<option value="">Please Select Year</option>
												<?php foreach (get_all_year() as $year) { ?>
													<option value="<?= $year ?>"> <?= $year ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="" class="col-form-label">Month</label>
										<div class="col-sm-12">
											<select class="form-control select2" style="width: 100%;" name="jch_month" id="jch_month" required>
												<option value="">Please Select Month</option>
												<?php foreach (get_all_month() as $key => $months) { ?>
													<option value="<?= $key; ?>"><?= $months; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											<label for="exampleInputEmail1">Cutting Rate</label>
											<input type="text" name="jch_cutting_rate" class="form-control input-number" id="" placeholder="Enter Cutting Rate" required>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											<label for="exampleInputEmail1">Bad Provision Percentage</label>
											<input type="text" name="jch_bad_provision_percentage" class="form-control input-number" value="2" required readonly>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12">
											<label for="exampleInputEmail1">Cutting Percentage</label>
											<input type="text" name="jch_cutting_percentage" class="form-control input-number" id="" value="17" required readonly>
										</div>
									</div>
									<input type="hidden" name="jch_id">
								</div>
								<div class="card-footer">
									<div class="pull-right">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</div>
					<?php } ?>
				</div>
	</section>
</div>


<!-- Update password -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"> </i> Update Jute Calculation Helper</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url('insert_jute_calculation_helper'); ?>" method="post">
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Start Date</label>
							<input type="text" name="jch_start_date" class="form-control datepicker" id="jch_start_date" placeholder="Enter Start Date" value="<?= get_current_time_time(); ?>" required>
							<input type="hidden" name="jch_fy_id" class="form-control" id="jch_fy_id">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">End Date</label>
							<input type="text" name="jch_end_date" class="form-control datepicker" placeholder="Enter End Date" value="<?= get_current_time_time(); ?>" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Cutting Rate</label>
							<input type="text" name="jch_cutting_rate" class="form-control input-number" id="" placeholder="Enter Cutting Rate" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Bad Provision Percentage</label>
							<input type="text" name="jch_bad_provision_percentage" class="form-control input-number" id="" placeholder="Enter Bad Provision Percentage" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Cutting Percentage</label>
							<input type="text" name="jch_cutting_percentage" class="form-control input-number" id="" placeholder="Enter Cutting Percentage" required>
						</div>
					</div>
					<input type="hidden" name="jch_id">
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info" id="saveChangesButtonInfo">Save changes</button>
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


		$("#jch_month, #jch_year").on('change', function() {
			//automatic get financial year id
			var jch_year = $('#jch_year').val();
			var jch_month = $('#jch_month').val();
			var yearMonth = jch_year + "-" + jch_month;

			if (jch_year != '' && jch_month != '') {
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('jute/Godown/ajaxFinancialYear') ?>",
					data: {
						jch_start_date: yearMonth,
					},
					success: function(data) {

						if (data == 'no') {
							Swal.fire({
								icon: 'error',
								title: 'Oops !!!!!!!!!!!!!',
								text: 'No Financial Year found under this (' + yearMonth + ') date ',

							})

							$("select#jch_year")[0].selectedIndex = 0;
							$('#jch_year').trigger('change');

							$("select#jch_month")[0].selectedIndex = 0;
							$('#jch_month').trigger('change');

						}
					}

				});
			}

		});
		//END automatic get financial year id



		$("#jch_month, #jch_year").on('change', function() {
			//automatic get financial year id
			var jch_year = $('#jch_year').val();
			var jch_month = $('#jch_month').val();
			var yearMonth = jch_year + "-" + jch_month;

			if (jch_year != '' && jch_month != '') {
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('jute/Godown/ajaxJuteCalculationHelperExistingValueCheck') ?>",
					data: {
						jch_start_date: yearMonth,
					},
					success: function(data) {

						if (data) {
							Swal.fire({
								icon: 'error',
								title: 'Oops !!!!!!!!!!!!!',
								text: 'You have already added this Year & Month value.',

							})

							$("select#jch_year")[0].selectedIndex = 0;
							$('#jch_year').trigger('change');

							$("select#jch_month")[0].selectedIndex = 0;
							$('#jch_month').trigger('change');

						}
					}

				});
			}

		});



		// Edit Jute Calculation Helper
		$(".editButton").click(function(e) {
			var id = $(this).data('id');

			$('#myModal2').modal('show');
			$('#iid').val(id);

		});
	});
</script>
