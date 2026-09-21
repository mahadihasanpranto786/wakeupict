<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Opening Jute Reports</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active">Opening Jute Reports</li>
					</ol>
				</div>
			</div>
		</div>
	</section>


	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title mt-2"><i class="fa fa-th"></i> Opening Jute Reports</h3>
							<?php
							$current_user_type = $this->session->userdata('current_type');
							$formSeePeople = array(1, 10, 603);
							if (in_array($current_user_type, $formSeePeople)) {
							?>
								<a href="<?php echo base_url('add_opening_jute'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Update Opening Jute</button></a>
							<?php }  ?>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>SL.</th>
										<th>Date</th>
										<th>Financial Year</th>
										<th>Opening Jute Reports</th>
										<?php foreach ($grades->result() as $grade) { ?>
											<th><?= $grade->j_g_title ?></th>
										<?php } ?>
										<th>KF</th>
										<th>WH</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($list) {
										$serial = 0;
										foreach ($list->result() as $list) {
											$serial++;
									?>
											<tr>
												<td rowspan="3" class="align-middle text-center <?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>"><?= $serial; ?></td>
												<td rowspan="3" class="align-middle <?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>"><?= date("d-m-Y", strtotime($list->ops_date)) ?></td>
												<td rowspan="3" class="align-middle <?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>"><?= $this->M_financial_year->getFinancialYearById($list->ops_fy_id)->fy_title ?></td>
												<td class="align-middle <?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>">Opening Quantity Monds</td>
												<?php
												//Mds
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
														<td class="<?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>"><?php echo number_currency_format(getJuteOpeningMdsValue($grade->j_g_id, $list->ops_id), 2); ?></td>
												<?php
													}
												}
												?> <td class="align-middle <?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>"><?= number_currency_format(getJuteOpeningMdsValue('kf', $list->ops_id), 2); ?></td>
												<td class="align-middle <?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>"><?= number_currency_format(getJuteOpeningMdsValue('wh', $list->ops_id), 2); ?></td>
												<td class="align-middle <?php echo ($list->ops_id == 1) ? "table-primary" : "table-info"; ?>"><?= number_currency_format($list->ops_mds_total, 2); ?></td>
											</tr>
											<tr>
												<td class="align-middle">Opening Average</td>
												<?php
												// Avg
												if ($grades) {
													foreach ($grades->result() as $grade) {
														// $g = $grade->j_g_id;
												?>
														<td><?= number_currency_format(getJuteOpeningAvgRate($grade->j_g_id, $list->ops_id), 2); ?></td>
												<?php
													}
												}
												?>
												<td class="align-middle"><?= number_currency_format(getJuteOpeningAvgRate('kf', $list->ops_id), 2); ?></td>
												<td class="align-middle"><?= number_currency_format(getJuteOpeningAvgRate('wh', $list->ops_id), 2); ?></td>
												<td><?= number_currency_format($list->ops_ave_total, 2); ?></td>
											</tr>
											<tr>
												<td class="align-middle">Opening Amount</td>
												<?php
												// Mds
												if ($grades) {
													foreach ($grades->result() as $grade) {
														// $g = $grade->j_g_id;
												?>
														<td><?= number_currency_format(getJuteOpeningAmount($grade->j_g_id, $list->ops_id), 2);
															?></td>
												<?php
													}
												}
												?>
												<td class="align-middle"><?= number_currency_format(getJuteOpeningAmount('kf', $list->ops_id), 2); ?></td>
												<td class="align-middle"><?= number_currency_format(getJuteOpeningAmount('wh', $list->ops_id), 2); ?></td>
												<td><?= number_currency_format($list->ops_amount_total, 2); ?></td>
											</tr>
									<?php }
									} ?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->