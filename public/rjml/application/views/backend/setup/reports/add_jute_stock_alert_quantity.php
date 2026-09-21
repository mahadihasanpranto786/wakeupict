<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card card-success mt-3">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Alert Weight</h3>
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
												<th>Weight(<span class="text-danger">Mds</span>)</th>
												<th>Description</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<?php if (!empty($alertSetting->jsaq_weight)) {
														echo $alertSetting->jsaq_weight;
													} ?>
												</td>
												<td>
													<?php if (!empty($alertSetting->jsaq_description)) {
														echo $alertSetting->jsaq_description;
													} ?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="card card-secondary ">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h3 class="card-title"><i class="fas fa-th"></i> Jute Stock</h3>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<table id="" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Name</th>
												<!-- <th>Description</th> -->
												<th>Total Purchased(<span class="text-danger">Mds</span>)</th>
												<th>Total Sale(<span class="text-danger">Mds</span>)</th>
												<th>Total Issue(<span class="text-danger">Mds</span>)</th>
												<th>Available(<span class="text-danger">Mds</span>)</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><span class="text-danger font-weight-bold">Grand Total: </span></td>
												<td><?php echo number_format($this->M_area->totalAreaWiseSumMds(), 2, ".", ","); ?> <span class="text-danger font-weight-bold">Mds</span></td>
												<td><?php echo number_format($this->M_area->totalAreaWiseSaleSumMds(), 2, ".", ","); ?> <span class="text-danger font-weight-bold">Mds</span></td>
												<td><?php echo number_format($this->M_area->totalAreaWiseIssueSumMds(), 2, ".", ","); ?> <span class="text-danger font-weight-bold">Mds</span></td>
												<td><?php echo round($this->M_area->totalAreaWiseSumMds() - $this->M_area->totalAreaWiseSaleSumMds() - $this->M_area->totalAreaWiseIssueSumMds()); ?> <span class="text-danger font-weight-bold">Mds</span></td>
											</tr>
											<!-- <tr> -->
											<!-- <td colspan="5" class=""> -->
											<?php
											$totalValue = round($this->M_area->totalAreaWiseSumMds() - $this->M_area->totalAreaWiseSaleSumMds() - $this->M_area->totalAreaWiseIssueSumMds());
											if (!empty($alertSetting->jsaq_weight)) {
												if ($totalValue < $alertSetting->jsaq_weight) {
													echo "<tr><td colspan='5' class='bg-danger border-danger'><span class='p-2'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Warning: You have less than $alertSetting->jsaq_weight mds jute in stock. Please, purchase new jute. </span></td></tr>";
												} elseif ($totalValue == $alertSetting->jsaq_weight) {
													echo "<tr><td colspan='5' class='bg-warning border-warning'><span class='p-2'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Warning: You have $alertSetting->jsaq_weight mds jute in stock. Please, purchase new jute. </span></td></tr>";
												} else {
													echo "<tr><td colspan='5' class='bg-success border-success'><span class='p-2'>You have more than $alertSetting->jsaq_weight mds</span></td></tr>";
												}
											} else {
												echo "<tr><td colspan='5' class=''>** No Condition **</td></tr>";
											} ?>
											<!-- </td> -->
											<!-- </tr> -->
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-4">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Update Jute Stock Alert Quantity</h3>
						</div>
						<form method="POST" action="<?php echo base_url('update_jute_stock_alert_quantity') ?>" onkeydown="return event.key != 'Enter';">
							<div class="card-body">
								<div class="col-md-12">
									<div class="row">
										<label>Minimum Weight</label>
										<span class="text-danger">*</span>
										<input type="text" class="form-control" value="<?php if (!empty($alertSetting->jsaq_weight)) {
																							echo $alertSetting->jsaq_weight;
																						} ?>" name="jsaq_weight" placeholder="Minimum Weight" data-validation="length" data-validation-length="min2" required>
									</div>
									<div class="row">
										<label>Description</label>
										<span class="text-danger">*</span>
										<textarea type="text" class="form-control" value="" name="jsaq_description" placeholder="Description" data-validation="length" data-validation-length="min2" required><?php if (!empty($alertSetting->jsaq_description)) {
																																																					echo $alertSetting->jsaq_description;
																																																				} ?></textarea>
									</div>


									<input type="hidden" class="form-control" value="<?php if (!empty($alertSetting->jsaq_id)) {
																							echo $alertSetting->jsaq_id;
																						} ?>" name="jsaq_id">
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>



			<div class="row">
				<div class="col-md-8">

				</div>
			</div>



	</section>
</div>
