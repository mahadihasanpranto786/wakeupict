 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">

 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Update Adjustment</h1>
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
 						<li class="breadcrumb-item"><a href="<?php echo base_url('list_adjustment'); ?>">Back to List Adjustment</a></li>
 						<li class="breadcrumb-item active">Adjustment</li>
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
 					<div class="card card-info mt-3">
 						<div class="card-header">
 							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Update Adjustment</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('update_adjustment') ?>" method="post" autocomplete="off" onkeydown="return event.key != 'Enter';">
 							<div class="card-body">
 								<div class="row">
 									<table class="table table-striped">
 										<tr>
 											<th>Date</th>
 											<?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
 													<th class="text-center"><?= $grade->j_g_title ?></th>
 											<?php
													}
												}
												?>
 											<th>KF-1</th>
 											<th>WH-1</th>
 											<th>Total</th>
 										</tr>
 										<tbody>
 											<tr>
 												<td>
 													<input type="text" name="adjv_date" class="form-control datepicker" id="adjv_date" value='<?= date("d-m-Y", strtotime($singleData->adjs_date)); ?>' required>
 													<input type="hidden" name="" class="form-control" id="catch_date" value='<?= date("d-m-Y", strtotime($singleData->adjs_date)); ?>'>
 													<input type="hidden" name="adjv_fy_id" class="" id="adjv_fy_id" value=''>
 												</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td>
 															<input type="hidden" name="adjv_value_id[]" class="form-control" id="" placeholder="" value='<?= getAdjustmentGradeValueId($grade->j_g_id, $singleData->adjs_id) ?>'>
 															<input type="text" name="adjv_value[]" class="form-control gradeSum input-number-minus-allow" id="gradeSum<?= $grade->j_g_id ?>" placeholder="" value='<?= getAdjustmentGradeValue($grade->j_g_id, $singleData->adjs_id) ?>'>
 														</td>
 												<?php
														}
													}
													?>
 												<td>
 													<input type="hidden" name="adjv_kf_id" class="form-control " id="" placeholder="" value='<?= getAdjustmentGradeValueId('kf', $singleData->adjs_id) ?>'>
 													<input type="text" name="adjv_kf" class="form-control gradeSum input-number-minus-allow" id="kf" placeholder="" value='<?= getAdjustmentGradeValue('kf', $singleData->adjs_id) ?>'>
 												</td>
 												<td>
 													<input type="hidden" name="adjv_wh_id" class="form-control " id="" placeholder="" value='<?= getAdjustmentGradeValueId('wh', $singleData->adjs_id) ?>'>
 													<input type="text" name="adjv_wh" class="form-control gradeSum input-number-minus-allow" id="wh" placeholder="" value='<?= getAdjustmentGradeValue('wh', $singleData->adjs_id) ?>'>
 												</td>
 												<td><input type="text" name="adjv_total" class="form-control readonly" id="total" placeholder="Total" value='<?= $singleData->adjs_total ?>' required></td>
 											</tr>
 											<input type="hidden" name="adjs_id" value="<?= $singleData->adjs_id ?>">
 										</tbody>
 									</table>
 								</div>
 								<!-- /.card-body -->
 								<div class="card-footer">
 									<div class="pull-right">
 										<button type="submit" class="btn btn-info submit" id="submitButton">Save Changes</button>
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

 		$(".gradeSum").keyup(function() {
 			var x = $(this).val();
 			//alert(x);
 			allTotal = 0;

 			for (let i = 0; i < groupId.length; i++) {
 				otPer = 0;

 				id = groupId[i];
 				idName = 'gradeSum' + id;
 				otPer = $("#" + idName).val() || 0;

 				allTotal = (parseFloat(allTotal) + parseFloat(otPer));

 			}

 			kfV = $("#kf").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(kfV));
 			whV = $("#wh").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(whV));
 			//  alert(whV);


 			$('#total').val(allTotal);

 			enableSubmitButton()
 		});

 		// Disable Enable Submit Button
 		enableSubmitButton()

 		function enableSubmitButton() {
 			var totalValue = $('#total').val();
 			if ((totalValue == undefined) || (totalValue == 0) || (totalValue == null) || (totalValue.length == 0) || isNaN(totalValue)) {
 				$('#submitButton').prop('disabled', true);
 			} else {
 				$('#submitButton').prop('disabled', false);
 			}
 		}




 		//automatic get financial year id
 		var adjv_date = $('#adjv_date').val();

 		getFy(adjv_date);

 		function getFy(adjv_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Adjustment/ajaxFinancialYear') ?>",
 				data: {
 					adjv_date: adjv_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + adjv_date + ') date ',

 						})
 						$("#adjv_date").val('');
 						$("#adjv_fy_id").val('');
 					} else {
 						$("#adjv_fy_id").val(data);
 						//  alert(data);
 					}
 				}

 			});
 		}

 		$("#adjv_date").on('change', function() {
 			adjv_date = $(this).val();
 			getFy(adjv_date);

 		});
 		//END automatic get financial year id




 		//  Check Adjustment month
 		var date = $('#adjv_date').val();

 		getDate(date);

 		function getDate(date) {
 			//Change Date Formate
 			var [dd, mm, yyyy] = date.split("-");
 			var revDate = `${mm}-${dd}-${yyyy}`;
 			var changing_date = `${mm}-${yyyy}`;


 			//  Date to Month Name
 			const dateObj = new Date(revDate);
 			const monthNameLong = dateObj.toLocaleString("en-US", {
 				month: "long"
 			});

 			//  For match date
 			var catch_date = $('#catch_date').val();
 			var [dd, mm, yyyy] = catch_date.split("-");
 			var catch_year_from_db = `${mm}-${yyyy}`;


 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Adjustment/ajaxMonthYear') ?>",
 				data: {
 					date: date
 				},
 				success: function(data) {
 					if (data == "no") {
 						$('#adjv_date').val(date);
 					} else if (changing_date == catch_year_from_db) {
 						$('#adjv_date').val(date);
 					} else {
 						Swal.fire({
 							icon: 'error',
 							title: 'Oops !!!!!!!!!!!!!',
 							text: 'You have already entered this (' + monthNameLong + ' ' + yyyy + ') month adjustment. Please enter valid month.',
 						})
 						$("#adjv_date").val('');
 					}
 				}
 			})
 		}
 		$("#adjv_date").on('change', function() {
 			date = $(this).val();
 			getDate(date);

 		});



 	});
 </script>
