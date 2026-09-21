 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Update Opening Jute</h1>
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
 						<li class="breadcrumb-item"><a href="<?php echo base_url('list_opening_jute'); ?>">Back to List Opening Jute</a></li>
 						<li class="breadcrumb-item active">Opening Jute</li>
 					</ol>
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- Main content -->
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<!-- left column -->
 				<div class="col-md-12">
 					<!-- general form elements -->
 					<div class="card card-info">
 						<div class="card-header">
 							<h3 class="card-title"><i class="fa fa-plus-circle"></i> Update Opening Jute</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('update_opening_jute') ?>" method="post" autocomplete="off">
 							<div class="card-body">
 								<div class="row">
 									<div class="row form-group col-sm-4">
 										<label class="col-sm-2 col-form-label" for="">Date</label>
 										<div class="col-sm-8">
 											<?php $openingDateOfFy = $this->M_financial_year->getFirstFinancialYear()->fy_start_date ?>
 											<input type="text" name="opening_date" id="opening_date" class="form-control" id="" value='<?= $openingDateOfFy ?>' required readonly>
 											<input type="hidden" name="opening_fy_id" id="opening_fy_id" value=''>
 										</div>
 									</div>
 									<div class="form-group col-sm-4">
 									</div>
 									<div class="form-group col-sm-4">

 									</div>
 								</div>
 								<div class="row">
 									<table class="table table-striped">
 										<tr>
 											<th></th>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
 													<th class="text-center"><?= $grade->j_g_title ?></th>
 													<input type="hidden" name="opening_j_g_id[]" value="<?= $grade->j_g_id ?>">
 											<?php
													}
												}
												?>
 											<th>KF-D1</th>
 											<th>WH-D1</th>
 											<th>Total</th>
 										</tr>
 										<tbody>
 											<tr>
 												<td>Opening Quantity Monds</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td>
 															<input type="hidden" name="opv_value_id[]" value='<?= getJuteOpeningMdsValueId($grade->j_g_id, 1); ?>'>
 															<input type="text" name="opening_mds[]" class="form-control gradeSumMds input-number" id="gradeSumMds<?= $grade->j_g_id ?>" placeholder="mds" value='<?php echo getJuteOpeningMdsValue($grade->j_g_id, 1); ?>'>
 														</td>
 												<?php
														}
													}
													?>
 												<td>
 													<input type="hidden" name="opv_kf_id" class="form-control" id="" placeholder="" value='<?= getJuteOpeningMdsValueId('kf', 1); ?>'>
 													<input type="text" name="opening_mds_kf" class="form-control gradeSumMds input-number" id="kfMds" placeholder="kf-d-1_opening" value='<?= getJuteOpeningMdsValue('kf', 1); ?>'>
 												</td>
 												<td>
 													<input type="hidden" name="opv_wh_id" class="form-control" id="" placeholder="" value='<?= getJuteOpeningMdsValueId('wh', 1); ?>'>
 													<input type="text" name="opening_mds_wh" class="form-control gradeSumMds input-number" id="whMds" placeholder="wh-d-1_opening" value='<?= getJuteOpeningMdsValue('wh', 1); ?>'>
 												</td>
 												<td>
 													<input type="text" name="opening_mds_total" class="form-control readonly" id="totalMds" placeholder="total mds_opening" value='<?php echo $this->M_opening_jute->getOpeningJuteSummaryById(1)->ops_mds_total; ?>' required>
 												</td>
 											</tr>
 											<tr>
 												<td>Opening Average Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td>
 															<input type="text" name="opening_ave[]" class="form-control input-number" id="exampleInputEmail1" placeholder="ave" value='<?= getJuteOpeningAvgRate($grade->j_g_id, 1); ?>'>
 														</td>
 												<?php
														}
													}
													?>
 												<td><input type="text" name="opening_ave_kf" class="form-control input-number" id="" placeholder="kf-d-1_opening_avg_rate" value='<?= getJuteOpeningAvgRate('kf', 1); ?>'></td>
 												<td><input type="text" name="opening_ave_wh" class="form-control input-number" id="" placeholder="wh-d-1_opening_avg_rate" value='<?= getJuteOpeningAvgRate('wh', 1); ?>'></td>
 												<td><input type="text" name="opening_ave_total" class="form-control readonly" id="totalAvgAmount" placeholder="total mds_opening_avg_rate" value='<?php echo $this->M_opening_jute->getOpeningJuteSummaryById(1)->ops_ave_total; ?>'></td>
 											</tr>
 											<tr>
 												<td>Opening Amount</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td><input type="text" name="opening_amount[]" class="form-control gradeSumAmount input-number" id="gradeSumAmount<?= $grade->j_g_id ?>" placeholder="amount" value='<?= getJuteOpeningAmount($grade->j_g_id, 1); ?>' required></td>
 												<?php
														}
													}
													?>
 												<td><input type="text" name="opening_amount_kf" class="form-control gradeSumAmount input-number" id="kfAmount" placeholder="kf-d-1_opening_amount" value='<?= getJuteOpeningAmount('kf', 1); ?>'></td>
 												<td><input type="text" name="opening_amount_wh" class="form-control gradeSumAmount input-number" id="whAmount" placeholder="wh-d-1_opening_amount" value='<?= getJuteOpeningAmount('wh', 1); ?>'></td>
 												<td><input type="text" name="opening_amount_total" class="form-control readonly" id="totalAmount" placeholder="total mds_opening_amount" value='<?php echo $this->M_opening_jute->getOpeningJuteSummaryById(1)->ops_amount_total; ?>' required></td>
 											</tr>
 										</tbody>
 									</table>
 								</div>

 								<input type="hidden" name="ops_id" value="1">
 								<!-- /.card-body -->
 								<div class="card-footer">
 									<div class="pull-right">

 										<?php $rowCount = $this->Common->count_all_result('opening_summary', ['ops_status' => 1]);
											if ($rowCount == 1) { ?>
 											<button type="submit" class="btn btn-info">Save Changes</button>
 										<?php } else { ?>
 											<span class="btn btn-info">You can't update now.</span>
 										<?php } ?>


 									</div>
 								</div>
 						</form>
 						<!-- /End Form -->
 					</div>
 					<!-- /.card -->
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- /section -->
 </div>
 <!-- /.content-wrapper -->





 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function() {



 		var groupId = []
 		<?php
			foreach ($grades->result() as $grade) {
			?>
 			groupId.push('<?= $grade->j_g_id ?>')
 		<?php } ?>
 		// Mds
 		$(".gradeSumMds").keyup(function() {
 			var x = $(this).val();
 			allTotal = 0;
 			for (let i = 0; i < groupId.length; i++) {
 				otPer = 0;
 				id = groupId[i];
 				idName = 'gradeSumMds' + id;
 				otPer = $("#" + idName).val() || 0;
 				allTotal = (parseFloat(allTotal) + parseFloat(otPer));
 			}
 			kfV = $("#kfMds").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(kfV));
 			whV = $("#whMds").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(whV));
 			$('#totalMds').val(allTotal);
 		});
 		// Amount
 		$(".gradeSumAmount").keyup(function() {
 			var x = $(this).val();
 			allTotal = 0;
 			for (let i = 0; i < groupId.length; i++) {
 				otPer = 0;
 				id = groupId[i];
 				idName = 'gradeSumAmount' + id;
 				otPer = $("#" + idName).val() || 0;
 				allTotal = (parseFloat(allTotal) + parseFloat(otPer));
 			}
 			kfV = $("#kfAmount").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(kfV));
 			whV = $("#whAmount").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(whV));
 			$('#totalAmount').val(allTotal);
 		});

 		// Total Average
 		$(".gradeSumMds, .gradeSumAmount").keyup(function() {
 			var totalMds = $('#totalMds').val()
 			var totalAmount = $('#totalAmount').val()
 			var totalAvg = parseFloat(totalAmount) / parseFloat(totalMds);
 			$('#totalAvgAmount').val(totalAvg)
 		});









 		//automatic get financial year id
 		var opening_date = $('#opening_date').val();

 		getFy(opening_date);

 		function getFy(opening_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Opening_jute/ajaxFinancialYear') ?>",
 				data: {
 					opening_date: opening_date,
 				},
 				success: function(dataA) {

 					if (dataA == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + opening_date + ') date ',

 						})
 						$("#opening_date").val('');
 						$("#opening_fy_id").val('');
 					} else {
 						$("#opening_fy_id").val(dataA);
 						getName(dataA)

 					}
 				}

 			});
 		}

 		$("#opening_date").on('change', function() {
 			opening_date = $(this).val();
 			getFy(opening_date);

 		});
 		//END automatic get financial year id

 		//Check Adjustment YEar Wise check
 		// var testDate = $('#opening_date').val();
 		// getName(dataA);
 		// var [dd, mm, yyyy] = testDate.split("-");
 		// var changeDateCatch = `${yyyy}`;

 		// function getName(dataA) {
 		// 	$.ajax({
 		// 		type: 'POST',
 		// 		url: "</?php echo base_url('jute/Opening_jute/ajaxFinancialYearWiseOpeningCheck') ?>",
 		// 		data: {
 		// 			testId: dataA
 		// 		},
 		// 		success: function(data) {
 		// 			if (data == "no") {
 		// 				$('#opening_date').val(testDate);
 		// 			} else {
 		// 				Swal.fire({
 		// 					icon: 'error',
 		// 					title: 'Oops !!!!!!!!!!!!!',
 		// 					text: 'You have already entered this Financial Year Opening Jute. Please enter valid Financial Year.',
 		// 				})
 		// 				$("#opening_date").val('');
 		// 			}
 		// 		}
 		// 	})
 		// }
 		// $("#opening_date").on('change', function() {
 		// 	testDate1 = $(this).val();
 		// 	getName(testDate1);

 		// });





 		// Check Adjustment month
 		// var date = $('#opening_date').val();
 		// getDate(date);

 		// function getDate(date) {
 		// 	//Change Date Formate
 		// 	var [dd, mm, yyyy] = date.split("-");
 		// 	var revDate = `${mm}-${dd}-${yyyy}`;
 		// 	//  Date to Month Name
 		// 	const dateObj = new Date(revDate);
 		// 	const monthNameLong = dateObj.toLocaleString("en-US", {
 		// 		month: "long"
 		// 	});
 		// 	$.ajax({
 		// 		type: 'POST',
 		// 		url: "</?php echo base_url('jute/Opening_jute/ajaxMonthYear') ?>",
 		// 		data: {
 		// 			date: date
 		// 		},
 		// 		success: function(data) {
 		// 			if (data == "no") {
 		// 				$('#opening_date').val(date);
 		// 			} else {
 		// 				Swal.fire({
 		// 					icon: 'error',
 		// 					title: 'Oops !!!!!!!!!!!!!',
 		// 					text: 'You have already entered this (' + monthNameLong + ' ' + yyyy + ') month Opening Jute. Please enter valid month.',
 		// 				})
 		// 				$("#opening_date").val('');
 		// 			}
 		// 		}
 		// 	});
 		// }
 		// $("#opening_date").on('change', function() {
 		// 	date = $(this).val();
 		// 	getDate(date);

 		// });



 	});
 </script>
