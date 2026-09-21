<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Labour Attendance & Wage Lists</h3>
							<a href="<?php echo base_url('add_labour_attendance'); ?>"><button class="btn btn-primary pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i> Add Labour Attendance</button></a>
						</div>

						<div class="card-body">
							<!-- Search By Date -->
							<form action="<?php echo base_url('list_labour_attendance'); ?>" method="post">
								<div class="input-group col-sm-4 mb-4">
									<label for="exampleInputEmail1" class="mr-2 mt-2">View Working Hour By</label>
									<input type="date" name="search_date" class="form-control" id="exampleInputEmail1" required>
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
							<table id="" class="table table-bordered table-striped">
								<thead style="background: #D3D3D3;">
									<tr>
										<th colspan="3" class="text-center">Date</th>
										<?php $today = $date;
										$date = strtotime($today);
										?>
										<th colspan="3" class="text-center"><?php $extendDate = strtotime("-6 days", $date);
																			echo $seventh = date("Y-m-d", $extendDate); ?></th>
										<th colspan="3" class="text-center"><?php $extendDate = strtotime("-5 days", $date);
																			echo $sixth = date("Y-m-d", $extendDate); ?></th>
										<th colspan="3" class="text-center"><?php $extendDate = strtotime("-4 days", $date);
																			echo $fifth = date("Y-m-d", $extendDate); ?></th>
										<th colspan="3" class="text-center"><?php $extendDate = strtotime("-3 days", $date);
																			echo $fourth = date("Y-m-d", $extendDate); ?></th>
										<th colspan="3" class="text-center"><?php $extendDate = strtotime("-2 days", $date);
																			echo $third = date("Y-m-d", $extendDate); ?></th>
										<th colspan="3" class="text-center"><?php $extendDate = strtotime("-1 days", $date);
																			echo $second = date("Y-m-d", $extendDate); ?></th>
										<th colspan="3" class="text-center"><?php echo $today; ?></th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Holiday Hour</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Arrear Hour</th>
										<th colspan="3" class="text-center">Total Hour</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Rate P.H.</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Actual Wages</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Attendance Bonus</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Night Allow.</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Travel Allow.</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Welfare Amount</th>
										<th rowspan="2" style="writing-mode: tb-rl; transform: rotate(-180deg);">Net Payable Amount</th>
										<th rowspan="2">Actions</th>
									</tr>
									<tr>
										<!-- 1st Date Hour -->
										<th scope="col">SL No.</th>
										<th scope="col">Labour Name</th>
										<th scope="col">Sub Department</th>
										<!-- 1st Date Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
										<!-- 2nd Date Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
										<!-- 3rd Date Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
										<!-- 4th Date Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
										<!-- 5th Date Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
										<!-- 6th Date Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
										<!-- 7th Date Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
										<!-- Total Hour -->
										<th scope="col">A</th>
										<th scope="col">B</th>
										<th scope="col">C</th>
									</tr>
								</thead>
								<tbody style="background:#B0C4DE;">
									<?php
									$serial = 1;
									if ($labours)
										foreach ($labours->result() as $labourss) { ?>
										<tr>
											<td class="align-middle text-center"><?= $serial++; ?></td>
											<td class="align-middle"><?= $labourss->l_name; ?></td>
											<td class="align-middle"><?= $this->M_department->getSubDepartmentById($labourss->l_sd_id)->sd_title; ?></td>
											<!-- 7th Date Hour -->
											<td class="align-middle">
												<?php $hour = $this->M_labour->getLabourDailyData($seventh, $labourss->l_id);
												if ($hour) {
													echo $hour->l_a_shift_a;
												} ?>
											</td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_b;
																		} ?></td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_c;
																		} ?></td>
											<!-- 6th Date Hour -->
											<td class="align-middle">
												<?php $hour = $this->M_labour->getLabourDailyData($sixth, $labourss->l_id);
												if ($hour) {
													echo $hour->l_a_shift_a;
												} ?>
											</td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_b;
																		} ?></td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_c;
																		} ?></td>
											<!-- 5th Date Hour -->
											<td class="align-middle">
												<?php $hour = $this->M_labour->getLabourDailyData($fifth, $labourss->l_id);
												if ($hour) {
													echo $hour->l_a_shift_a;
												} ?>
											</td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_b;
																		} ?></td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_c;
																		} ?></td>
											<!-- 4th Date Hour -->
											<td class="align-middle">
												<?php $hour = $this->M_labour->getLabourDailyData($fourth, $labourss->l_id);
												if ($hour) {
													echo $hour->l_a_shift_a;
												} ?>
											</td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_b;
																		} ?></td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_c;
																		} ?></td>
											<!-- 3rd Date Hour -->
											<td class="align-middle">
												<?php $hour = $this->M_labour->getLabourDailyData($third, $labourss->l_id);
												if ($hour) {
													echo $hour->l_a_shift_a;
												} ?>
											</td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_b;
																		} ?></td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_c;
																		} ?></td>
											<!-- 2nd Date Hour -->
											<td class="align-middle">
												<?php $hour = $this->M_labour->getLabourDailyData($second, $labourss->l_id);
												if ($hour) {
													echo $hour->l_a_shift_a;
												} ?>
											</td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_b;
																		} ?></td>
											<td class="align-middle"><?php if ($hour) {
																			echo $hour->l_a_shift_c;
																		} ?></td>
											<!-- Today Date Hour -->
											<td class="align-middle">
												<?php $hour = $this->M_labour->getLabourDailyData($today, $labourss->l_id);
												if (!empty($hour)) {
													echo $hour->l_a_shift_a;
												} ?>
											</td>
											<td class="align-middle"><?php if (!empty($hour)) {
																			echo $hour->l_a_shift_b;
																		} ?></td>
											<td class="align-middle"><?php if (!empty($hour)) {
																			echo $hour->l_a_shift_c;
																		} ?></td>
											<!-- Holiday Hour -->
											<td class="align-middle">
												<?php $hh_one = $this->M_labour->getLabourDailyData($today, $labourss->l_id);
												if ($hh_one) {
													$hh1 = $hh_one->l_a_holiday_hour;
												} else {
													$hh1 = "0";
												}; ?>
												<?php $hh_two = $this->M_labour->getLabourDailyData($second, $labourss->l_id);
												if ($hh_two) {
													$hh2 = $hh_two->l_a_holiday_hour;
												} else {
													$hh2 = "0";
												}; ?>
												<?php $hh_three = $this->M_labour->getLabourDailyData($third, $labourss->l_id);
												if ($hh_three) {
													$hh3 = $hh_three->l_a_holiday_hour;
												} else {
													$hh3 = "0";
												}; ?>
												<?php $hh_four = $this->M_labour->getLabourDailyData($fourth, $labourss->l_id);
												if ($hh_four) {
													$hh4 = $hh_four->l_a_holiday_hour;
												} else {
													$hh4 = "0";
												}; ?>
												<?php $hh_five = $this->M_labour->getLabourDailyData($fifth, $labourss->l_id);
												if ($hh_five) {
													$hh5 = $hh_five->l_a_holiday_hour;
												} else {
													$hh5 = "0";
												}; ?>
												<?php $hh_six = $this->M_labour->getLabourDailyData($sixth, $labourss->l_id);
												if ($hh_six) {
													$hh6 = $hh_six->l_a_holiday_hour;
												} else {
													$hh6 = "0";
												}; ?>
												<?php $hh_seven = $this->M_labour->getLabourDailyData($seventh, $labourss->l_id);
												if ($hh_seven) {
													$hh7 = $hh_seven->l_a_holiday_hour;
												} else {
													$hh7 = "0";
												}; ?>
												<?php echo $total_holiday_hour = ($hh1 + $hh2 + $hh3 + $hh4 + $hh5 + $hh6 + $hh7); ?>
											</td>
											<!-- Arrear Hour -->
											<td class="align-middle">
												<?php $ah_one = $this->M_labour->getLabourDailyData($today, $labourss->l_id);
												if ($ah_one) {
													$ah1 = $hh_one->l_a_arrear_hour;
												} else {
													$ah1 = "0";
												}; ?>
												<?php $ah_two = $this->M_labour->getLabourDailyData($second, $labourss->l_id);
												if ($ah_two) {
													$ah2 = $ah_two->l_a_arrear_hour;
												} else {
													$ah2 = "0";
												}; ?>
												<?php $ah_three = $this->M_labour->getLabourDailyData($third, $labourss->l_id);
												if ($ah_three) {
													$ah3 = $ah_three->l_a_arrear_hour;
												} else {
													$ah3 = "0";
												}; ?>
												<?php $ah_four = $this->M_labour->getLabourDailyData($fourth, $labourss->l_id);
												if ($ah_four) {
													$ah4 = $ah_four->l_a_arrear_hour;
												} else {
													$ah4 = "0";
												}; ?>
												<?php $ah_five = $this->M_labour->getLabourDailyData($fifth, $labourss->l_id);
												if ($ah_five) {
													$ah5 = $ah_five->l_a_arrear_hour;
												} else {
													$ah5 = "0";
												}; ?>
												<?php $ah_six = $this->M_labour->getLabourDailyData($sixth, $labourss->l_id);
												if ($ah_six) {
													$ah6 = $ah_six->l_a_arrear_hour;
												} else {
													$ah6 = "0";
												}; ?>
												<?php $ah_seven = $this->M_labour->getLabourDailyData($seventh, $labourss->l_id);
												if ($ah_seven) {
													$ah7 = $ah_seven->l_a_arrear_hour;
												} else {
													$ah7 = "0";
												}; ?>
												<?php echo $total_arrear_hour = ($ah1 + $ah2 + $ah3 + $ah4 + $ah5 + $ah6 + $ah7); ?></td>
											<!-- Total Hour = A -->
											<td class="align-middle">
												<?php $one = $this->M_labour->getLabourDailyData($today, $labourss->l_id);
												if ($one) {
													$a1 = $one->l_a_shift_a;
												} else {
													$a1 = 0;
												} ?>
												<?php $two = $this->M_labour->getLabourDailyData($second, $labourss->l_id);
												if ($two) {
													$a2 = $two->l_a_shift_a;
												} else {
													$a2 = 0;
												} ?>
												<?php $three = $this->M_labour->getLabourDailyData($third, $labourss->l_id);
												if ($three) {
													$a3 = $three->l_a_shift_a;
												} else {
													$a3 = 0;
												} ?>
												<?php $four = $this->M_labour->getLabourDailyData($fourth, $labourss->l_id);
												if ($four) {
													$a4 = $four->l_a_shift_a;
												} else {
													$a4 = 0;
												} ?>
												<?php $five = $this->M_labour->getLabourDailyData($fifth, $labourss->l_id);
												if ($five) {
													$a5 = $five->l_a_shift_a;
												} else {
													$a5 = 0;
												} ?>
												<?php $six = $this->M_labour->getLabourDailyData($sixth, $labourss->l_id);
												if ($six) {
													$a6 = $six->l_a_shift_a;
												} else {
													$a6 = 0;
												} ?>
												<?php $seven = $this->M_labour->getLabourDailyData($seventh, $labourss->l_id);
												if ($seven) {
													$a7 = $seven->l_a_shift_a;
												} else {
													$a7 = 0;
												} ?>
												<?php echo $total_hour_a = $a2 + $a1 + $a3 + $a4 + $a5 + $a6 + $a7 ?>
											</td>
											<!-- Total Hour = B -->
											<td class="align-middle">
												<?php $one = $this->M_labour->getLabourDailyData($today, $labourss->l_id);
												if (!empty($one)) {
													$b1 = $one->l_a_shift_b;
												} else {
													$b1 = 0;
												} ?>
												<?php $two = $this->M_labour->getLabourDailyData($second, $labourss->l_id);
												if (!empty($two)) {
													$b2 = $two->l_a_shift_b;
												} else {
													$b2 = 0;
												} ?>
												<?php $three = $this->M_labour->getLabourDailyData($third, $labourss->l_id);
												if (!empty($three)) {
													$b3 = $three->l_a_shift_b;
												} else {
													$b3 = 0;
												} ?>
												<?php $four = $this->M_labour->getLabourDailyData($fourth, $labourss->l_id);
												if (!empty($four)) {
													$b4 = $four->l_a_shift_b;
												} else {
													$b4 = 0;
												} ?>
												<?php $five = $this->M_labour->getLabourDailyData($fifth, $labourss->l_id);
												if (!empty($five)) {
													$b5 = $five->l_a_shift_b;
												} else {
													$b5 = 0;
												} ?>
												<?php $six = $this->M_labour->getLabourDailyData($sixth, $labourss->l_id);
												if (!empty($six)) {
													$b6 = $six->l_a_shift_b;
												} else {
													$b6 = 0;
												} ?>
												<?php $seven = $this->M_labour->getLabourDailyData($seventh, $labourss->l_id);
												if (!empty($seven)) {
													$b7 = $seven->l_a_shift_b;
												} else {
													$b7 = 0;
												} ?>
												<?php echo $total_hour_b = $b1 + $b2 + $b3 + $b4 + $b5 + $b6 + $b7 ?>
											</td>
											<!-- Total Hour = C -->
											<td class="align-middle">
												<?php $one = $this->M_labour->getLabourDailyData($today, $labourss->l_id);
												if (!empty($one)) {
													$c1 = $one->l_a_shift_c;
												} else {
													$c1 = 0;
												}
												$two = $this->M_labour->getLabourDailyData($second, $labourss->l_id);
												if (!empty($two)) {
													$c2 = $two->l_a_shift_c;
												} else {
													$c2 = 0;
												}
												$three = $this->M_labour->getLabourDailyData($third, $labourss->l_id);
												if (!empty($three)) {
													$c3 = $three->l_a_shift_c;
												} else {
													$c3 = 0;
												}
												$four = $this->M_labour->getLabourDailyData($fourth, $labourss->l_id);
												if (!empty($four)) {
													$c4 = $four->l_a_shift_c;
												} else {
													$c4 = 0;
												}
												$five = $this->M_labour->getLabourDailyData($fifth, $labourss->l_id);
												if (!empty($five)) {
													$c5 = $five->l_a_shift_c;
												} else {
													$c5 = 0;
												}
												$six = $this->M_labour->getLabourDailyData($sixth, $labourss->l_id);
												if (!empty($six)) {
													$c6 = $six->l_a_shift_c;
												} else {
													$c6 = 0;
												}
												$seven = $this->M_labour->getLabourDailyData($seventh, $labourss->l_id);
												if (!empty($seven)) {
													$c7 = $seven->l_a_shift_c;
												} else {
													$c7 = 0;
												} ?>
												<?php echo $total_hour_c =  $c1 + $c2 + $c3 + $c4 + $c5 + $c6 + $c7 ?>
											</td>
											<!-- Rate Per Hour -->
											<td class="align-middle">
												<?php echo $lhr_hourly_rate = $this->M_labour->getHourlyRateByLabourId($labourss->l_id)->lhr_hourly_rate;
												?>
											</td>
											<!-- Actual Wage -->
											<td class="align-middle">
												<?php
												$total_hour_abch = $total_hour_a + $total_hour_b + $total_hour_c + $total_holiday_hour + $total_arrear_hour;
												if ($total_hour_abch == "0") {
													echo $actual_wage = "0";
												} else {
													echo $actual_wage = $total_hour_abch * $lhr_hourly_rate;
												} ?>
											</td>
											<!-- Attendance Bonus -->
											<td class="align-middle">
												<?php if ($labour_bonus) foreach ($labour_bonus->result() as $row) {  ?>
													<?php if (($total_hour_a < "48") && ($total_hour_b < "48") && ($total_hour_c < "48")) {
														echo $achieve_hour = "0";
													} elseif (($total_hour_a < "56") && ($total_hour_b < "56") && ($total_hour_c < "56")) {
														echo $achieve_hour = $row->lb_6days_attendance_bonus;
													} else {
														echo $achieve_hour = $row->lb_7days_attendance_bonus;
													}
													?>
												<?php  } ?>
											</td>
											<!-- Night Allowance -->
											<td class="align-middle">
												<?php
												if ($c1 <= 8) {
													$NightA1 = ($row->lb_night_allowance * $c1);
												} else {
													$NightA1 = $row->lb_night_allowance * 8;
												}
												if (!empty($c2 <= 8)) {
													$NightA2 = ($row->lb_night_allowance * $c2);
												} else {
													$NightA2 = $row->lb_night_allowance * 8;
												}
												if ($c3 <= 8) {
													$NightA3 = ($row->lb_night_allowance * $c3);
												} else {
													$NightA3 = $row->lb_night_allowance * 8;
												}
												if ($c4 <= 8) {
													$NightA4 = ($row->lb_night_allowance * $c4);
												} else {
													$NightA4 = $row->lb_night_allowance * 8;
												}
												if ($c5 <= 8) {
													$NightA5 = ($row->lb_night_allowance * $c5);
												} else {
													$NightA5 = $row->lb_night_allowance * 8;
												}
												if ($c6 <= 8) {
													$NightA6 = ($row->lb_night_allowance * $c6);
												} else {
													$NightA6 = $row->lb_night_allowance * 8;
												}
												if ($c7 <= 8) {
													$NightA7 = ($row->lb_night_allowance * $c7);
												} else {
													$NightA7 = $row->lb_night_allowance * 8;
												} ?>
												<?php echo $TotalNightAllowance = ($NightA1 + $NightA2 + $NightA3 + $NightA4 + $NightA5 + $NightA6 + $NightA7); ?>
											</td>
											<!-- Travel Allowance -->
											<td class="align-middle">
												<?php if ($b1 >= 0.1) {
													$TAa1 = $row->lb_travel_allowance;
												} else {
													$TAa1 = 0;
												}
												if ($a2 >= 0.1) {
													$TAa2 = $row->lb_travel_allowance;
												} else {
													$TAa2 = 0;
												}
												if ($a3 >= 0.1) {
													$TAa3 = $row->lb_travel_allowance;
												} else {
													$TAa3 = 0;
												}
												if ($a4 >= 0.1) {
													$TAa4 = $row->lb_travel_allowance;
												} else {
													$TAa4 = 0;
												}
												if ($a5 >= 0.1) {
													$TAa5 = $row->lb_travel_allowance;
												} else {
													$TAa5 = 0;
												}
												if ($a6 >= 0.1) {
													$TAa6 = $row->lb_travel_allowance;
												} else {
													$TAa6 = 0;
												}
												if ($a7 >= 0.1) {
													$TAa7 = $row->lb_travel_allowance;
												} else {
													$TAa7 = 0;
												}
												?>
												<?php if (($TravelAllowanceForA = $TAa1 + $TAa2 + $TAa3 + $TAa4 + $TAa5 + $TAa6 + $TAa7) > 40) {
													$TAForA = $TravelAllowanceForA;
												} else {
													$TAForA = "0";
												}
												?>
												<?php if ($b1 >= 0.1) {
													$TAb1 = $row->lb_travel_allowance;
												} else {
													$TAb1 = 0;
												}
												if ($b2 >= 0.1) {
													$TAb2 = $row->lb_travel_allowance;
												} else {
													$TAb2 = 0;
												}
												if ($b3 >= 0.1) {
													$TAb3 = $row->lb_travel_allowance;
												} else {
													$TAb3 = 0;
												}
												if ($b4 >= 0.1) {
													$TAb4 = $row->lb_travel_allowance;
												} else {
													$TAb4 = 0;
												}
												if ($b5 >= 0.1) {
													$TAb5 = $row->lb_travel_allowance;
												} else {
													$TAb5 = 0;
												}
												if ($b6 >= 0.1) {
													$TAb6 = $row->lb_travel_allowance;
												} else {
													$TAb6 = 0;
												}
												if ($b7 >= 0.1) {
													$TAb7 = $row->lb_travel_allowance;
												} else {
													$TAb7 = 0;
												}
												?>
												<?php if (($TravelAllowanceForB = $TAb1 + $TAb2 + $TAb3 + $TAb4 + $TAb5 + $TAb6 + $TAb7) > 40) {
													$TAForB =	$TravelAllowanceForB;
												} else {
													$TAForB = "0";
												}
												?>
												<?php if ($c1 >= 0.1) {
													$TAc1 = $row->lb_travel_allowance;
												} else {
													$TAc1 = 0;
												}
												if ($c2 >= 0.1) {
													$TAc2 = $row->lb_travel_allowance;
												} else {
													$TAc2 = 0;
												}
												if ($c3 >= 0.1) {
													$TAc3 = $row->lb_travel_allowance;
												} else {
													$TAc3 = 0;
												}
												if ($c4 >= 0.1) {
													$TAc4 = $row->lb_travel_allowance;
												} else {
													$TAc4 = 0;
												}
												if ($c5 >= 0.1) {
													$TAc5 = $row->lb_travel_allowance;
												} else {
													$TAc5 = 0;
												}
												if ($c6 >= 0.1) {
													$TAc6 = $row->lb_travel_allowance;
												} else {
													$TAc6 = 0;
												}
												if ($c7 >= 0.1) {
													$TAc7 = $row->lb_travel_allowance;
												} else {
													$TAc7 = 0;
												}
												?>
												<?php if (($TravelAllowanceForC = $TAc1 + $TAc2 + $TAc3 + $TAc4 + $TAc5 + $TAc6 + $TAc7) > 40) {
													$TAForC = $TravelAllowanceForC;
												} else {
													$TAForC = "0";
												}
												?>
												<?php ($TTAllowance =  $TAForA + $TAForB + $TAForC) ?>
												<?php
												if ($labourss->l_quarter != "Yes") {
													echo $TotalTravelAllowance = $TTAllowance;
												} else {
													echo $TotalTravelAllowance = "0";
												} ?>
											</td>
											<!-- Welfare Amount -->
											<td class="align-middle">
												<?php if ($labour_bonus) foreach ($labour_bonus->result() as $row) {  ?>
													<?php
													if (($total_hour_a + $total_hour_b + $total_hour_c) > 1) {
														echo $welfare_amount = $row->lb_welfare_amount;
													} else {
														echo $welfare_amount = "0";
													}
													?>
												<?php } ?>
											</td>
											<!-- Total Payable Amount -->
											<td class="align-middle">
												<?php if ($actual_wage != 0) {
													echo $net_payable_amount = ($actual_wage + $achieve_hour + $TotalNightAllowance + $TotalTravelAllowance) - $welfare_amount;
												} else {
													echo $net_payable_amount =  "0";
												} ?>
											</td>
											<td class="align-middle text-center">
												<a class='editbutton btn bg-primary btn-xs' href="">
													<i class='fas fa-user-edit'></i>
												</a>
												<a onclick="return confirm('Are you sure want to delete this?');" href="">
													<button type='button' class='btn bg-danger btn-xs'>
														<i class="fas fa-trash"></i>
													</button>
												</a>
												<a onclick="return confirm('Are you sure want to inactive this?');" href="">
													<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
													</button>
												</a>
											</td>
										</tr>
									<?php }
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>