<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card card-success mt-3">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Area List</h3>
								</div>
							</div>
						</div>
						<?= alert_check() ?>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<table id="" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>SL. No.</th>
												<th>Name</th>
												<!-- <th>Description</th> -->
												<th>Total Purchased(<span class="text-danger">Mds</span>)</th>
												<th>Total Sale(<span class="text-danger">Mds</span>)</th>
												<th>Total Issue(<span class="text-danger">Mds</span>)</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											if ($lists) {
												$serial = 0;
												// x_debug($list);
												// $mokam_id_arr = array();
												foreach ($lists->result() as $list) {
													$serial++;
											?>
													<tr>
														<td class="align-middle"><?= $serial ?></td>
														<td class="align-middle">
															<?= $list->ar_title ?>
														</td>
														<!-- <td class="align-middle">
															</?= $list->ar_description ?>
														</td> -->
														<td class="align-middle">
															<?= number_format($this->M_area->getTotalPurchaseAreaWise($list->ar_id), 2, ".", ","); ?>
														</td>
														<td class="align-middle">
															<?= number_format($this->M_area->getTotalAreaWiseSaleMds($list->ar_id), 2, ".", ","); ?>
														</td>
														<td class="align-middle">
															<?= number_format($this->M_area->getTotalAreaWiseIssueMds($list->ar_id), 2, ".", ","); ?>
														</td>

														<!-- <td width="200px" class="align-middle text-center">
																<a href="<?php echo base_url(); ?>setup/Area/editArea?ar_id=<?= $list->ar_id ?>" id="<?= $list->ar_id ?>">
																	<button type='button' class='btn bg-primary btn-xs'><i class='fas fa-user-edit'></i>
																	</button>
																</a> -->
														<!-- <a href="<?php echo base_url(); ?>backend/employee/Add_info/employee_add_info/<?= $list->ar_id ?>" id="<?= $list->ar_id ?>">
                                                                    <button type="button" class="btn btn-info"><i class="fa fa-address-card"></i></button>
                                                                </a> -->
														<!-- <a href="<?php echo base_url(); ?>backend/employee/View_info/employee_info_view/<?= $list->ar_id ?>" id="<?= $list->ar_id ?>">
                                                                    <button type="submit" class="btn bg-olive"><i class="fas fa-eye"></i></button>
                                                                </a> -->
														<!-- <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Area/deleteArea?ar_id=<?= $list->ar_id ?>" id="<?= $list->ar_id ?>">
																	<button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
																		<i class="fas fa-trash"></i>
																	</button>
																</a>
																<a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>setup/Area/inactiveArea?ar_id=<?= $list->ar_id ?>" id="<?= $list->ar_id ?>">
																	<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
																	</button>
																</a>
																<a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Area/permanentlyDeleteArea?ar_id=<?= $list->ar_id; ?>" type='button' class='btn bg-danger btn-xs ml-2'>
																	<i class="fas fa-trash"></i>
																	Permanently Delete
																</a>
															</td> -->
													</tr>
											<?php
												}
											}
											?>
											<tr>
												<td colspan="2"><span class="text-danger font-weight-bold">Grand Total: </span></td>
												<td><?php echo number_format($this->M_area->totalAreaWiseSumMds(), 2, ".", ","); ?> <span class="text-danger font-weight-bold">Mds</span></td>
												<td><?php echo number_format($this->M_area->totalAreaWiseSaleSumMds(), 2, ".", ","); ?> <span class="text-danger font-weight-bold">Mds</span></td>
												<td><?php echo number_format($this->M_area->totalAreaWiseIssueSumMds(), 2, ".", ","); ?> <span class="text-danger font-weight-bold">Mds</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card card-success mt-3">
						<div class="card-body">
							<div class="card-header">
								<h3 class="card-title"> <i class="fas fa-info-circle"></i> Chart View</h3>
							</div>
							<div class="row">
								<div class="col-12">

									<div id="chart"></div>

								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="col-md-5">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Add Area</h3>
						</div>
						<form id="add_area" method="POST" action="<?php echo base_url('insert_area') ?>" onkeydown="return event.key != 'Enter';">
							<div class="card-body">
								<div class="=col-md-12">
									<div class="row">
										<label>Area Name</label>
										<span class="text-danger">*</span>
										<input type="text" class="form-control" value="" name="ar_title" id="" placeholder="Area Name" data-validation="length" data-validation-length="min2">
									</div>
									<div class="row">
										<label>Description</label>
										<span class="text-danger">*</span>
										<input type="text" class="form-control" value="" name="ar_description" id="" placeholder="Description" data-validation="length" data-validation-length="min2">
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div> -->
			</div>





	</section>
</div>


<!-- test -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/apex-chart/apexchart.js"></script>
<script>
	var arrayValue = [
		<?php
		if ($lists)
			foreach ($lists->result() as $value) {
		?>
			<?php echo number_format($this->M_area->getTotalPurchaseAreaWise($value->ar_id), 2, ".", ""); ?>,
		<?php } ?>
	]

	var arrayName = [
		<?php
		if ($lists)
			foreach ($lists->result() as $alpha) {
		?>

			"<?= $alpha->ar_title ?>",
		<?php } ?>
	]

	var options = {
		series: [{
			name: 'Weight',
			// data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2],
			data: arrayValue
		}],
		chart: {
			height: 350,
			type: 'bar',
		},
		plotOptions: {
			bar: {
				borderRadius: 10,
				dataLabels: {
					position: 'top', // top, center, bottom
				},
			}
		},
		dataLabels: {
			enabled: true,
			formatter: function(val) {
				// return val + "%";
				return val;
			},
			offsetY: -20,
			style: {
				fontSize: '12px',
				colors: ["#304758"]
			}
		},

		xaxis: {
			// categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			categories: arrayName,
			position: 'top',
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false
			},
			crosshairs: {
				fill: {
					type: 'gradient',
					gradient: {
						colorFrom: '#D8E3F0',
						colorTo: '#BED1E6',
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					}
				}
			},
			tooltip: {
				enabled: true,
			}
		},
		yaxis: {
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false,
			},
			labels: {
				show: false,
				formatter: function(val) {
					// return val + "%";
					return val;
				}
			}

		},
		title: {
			text: 'Area wise total jute purchased (mds)',
			floating: true,
			offsetY: 330,
			align: 'center',
			style: {
				color: '#444'
			}
		}
	};

	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
</script>