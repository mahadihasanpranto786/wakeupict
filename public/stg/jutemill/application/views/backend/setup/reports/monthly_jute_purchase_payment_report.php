<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Monthly Payment Reports</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php
																$current_user_type = $this->session->userdata('current_type');
																if ($current_user_type == 1) {
																	echo base_url('administration');
																} elseif ($current_user_type == 10) {
																	echo base_url('operator');
																} elseif ($current_user_type == 101) {
																	echo base_url('security_head');
																} elseif ($current_user_type == 102) {
																	echo base_url('security_operator');
																} elseif ($current_user_type == 201) {
																	echo base_url('weight_head');
																} elseif ($current_user_type == 202) {
																	echo base_url('weight_operator');
																} elseif ($current_user_type == 301) {
																	echo base_url('jute_head');
																} elseif ($current_user_type == 302) {
																	echo base_url('jute_operator');
																} elseif ($current_user_type == 401) {
																	echo base_url('accounts_head');
																} elseif ($current_user_type == 402) {
																	echo base_url('accounts_operator');
																} elseif ($current_user_type == 501) {
																	echo base_url('production_head');
																} elseif ($current_user_type == 502) {
																	echo base_url('production_operator');
																} elseif ($current_user_type == 601) {
																	echo base_url('gm');
																} elseif ($current_user_type == 602) {
																	echo base_url('shareholder');
																} elseif ($current_user_type == 603) {
																	echo base_url('system_administrator');
																} else {
																	$this->session->set_flashdata('login_failed', 'Credential Not match');
																	redirect('login', 'location');
																}
																?>">
								Home</a>
						</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="row">


				<div class="col-md-4">
					<div class="card card-secondary">
						<div class="card-header">
							<div class="row">
								<div class="col-md-8">
									<h3 class="card-title"><i class="fas fa-th"></i> Monthly Supplier Payments</h3>
								</div>
								<div class="col-md-4">
									<!-- Filter Yearly Data -->
									<form action="<?php echo base_url('monthly_jute_purchase_payment_report'); ?>" method="post">
										<div class="row">
											<div class="col-sm-6">
												<select class="badge btn-secondary btn-outline-dark text-white" name="year_value" style="width: 100%;" required>
													<option value="">Select</option>
													<option value="2021">2021-2022</option>
													<option value="2022">2022-2023 </option>
													<option value="2023">2023-2024 </option>
												</select>
											</div>
											<div class="col-sm-6">
												<a href=""><button class="badge btn-secondary float-left" style="margin-top: 2px; padding-bottom: 5px;"> Search</button></a>
											</div>
										</div>
									</form>
									<!-- /. Filter Yearly Data -->
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th width="50%"><i class="fas fa-th"></i> <?php echo $year_value; ?>-<?php echo $year_value + 1; ?></th>
												<th width="50%">Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$start = $month = strtotime($year_value . "-07-01");
											$end = strtotime($year_value + 1 . "-06-30");

											$startYear = date('Y', $start);
											$endYear = date('Y', $end);

											while ($month < $end) {
												echo "<tr>";
												echo "<td class='text-left font-weight-bold'>";
												echo $date = date('F Y', $month), PHP_EOL;
												$month = strtotime("+1 month", $month);
												$alpha_year = date('Y', strtotime($date));
												$alpha_month = date('m', strtotime($date));
												echo "</td>"; ?>

												<td><?php $PaymentAmount = $this->M_jute_report->getMonthlyTotalSupplierPaymentAmount($alpha_year, $alpha_month);
													if ($PaymentAmount) {
														echo round($PaymentAmount);
													} else {
														echo "<span class='text-danger'>0</span>";
													}
													?></td>
											<?php echo "</tr>";
											} ?>
											<!-- Total Sum -->
											<tr class="table-warning font-weight-bold">
												<td>TOTAL</td>
												<td><?php echo round($this->M_jute_report->getMonthlyTotalSupplierPaymentAmountGrandTotal($startYear, $endYear)); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>

</div>