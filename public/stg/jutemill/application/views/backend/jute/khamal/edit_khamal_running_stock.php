 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Main content -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Update Running Khamal Stock Balance</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_khamal_running_stock'); ?>">List Khamal Running Stock</a></li>
 						<li class="breadcrumb-item active">Update Running Khamal Stock Balance</li>
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
 							<h3 class="card-title"><i class="fa fa-edit"></i> Update New Running Khamal Stock Balance</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('update_khamal_running_stock') ?>" method="post">
 							<div class="card-body">
 								<div class="row mb-2">
 									<div class="col-sm-1">
 										<h5 class="mt-2">Date</h5>
 									</div>
 									<div class="col-sm-2">
 										<input type="text" name="khrsv_date" class="form-control datepicker" id="khrsv_date" placeholder="" value='<?= date("d-m-Y", strtotime($runningStockSummaryInEdit->khrss_date)); ?>' autocomplete="off" required>
 										<input type="hidden" name="" class="form-control" id="catch_date" placeholder="" value='<?= date("d-m-Y", strtotime($runningStockSummaryInEdit->khrss_date)); ?>'>
 										<input type="hidden" name="khrsv_fy_id" class="" id="khrsv_fy_id" value=''>
 									</div>
 									<div class="col-sm-9">
 									</div>
 								</div>
 								<div class="row">
 									<table class="table table-striped ">
 										<tr>
 											<th>Khamal</th>
 											<th>Description<span class="text-danger">*</span></th>
 											<th>Bojha</th>
 											<th>Used For<span class="text-danger">*</span></th>
 											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 												<th><?= $grade->j_g_title ?></th>
 											<?php } ?>
 											<th>KF</th>
 											<th>WH</th>
 											<th>Total</th>
 										</tr>
 										<tbody id="addAssortedItem">

 											<tr>
 												<td>
 													<div class="form-group col-sm-12 ml-0">
 														<select class="form-control select2" style="width:170px;" name="khrsv_kh_id">
 															<option value="">Select Khamal</option>
 															<?php if ($khamals) {
																	foreach ($khamals->result() as $khamal) { ?>
 																	<?php if ($khamal->kh_id == $runningStockSummaryInEdit->khrss_kh_id) { ?>
 																		<option value="<?= $khamal->kh_id; ?>" <?php if ($runningStockSummaryInEdit->khrss_kh_id == $khamal->kh_id) {
																													echo "selected";
																												} else {
																													echo 0;
																												} ?>><?= $khamal->kh_title; ?></option>
 																	<?php	} ?>
 															<?php }
																} ?>
 														</select>
 													</div>
 												</td>
 												<td><input type="text" name="khrsv_description" class="form-control" style="width:170px;" placeholder="Enter Description" value='<?= $runningStockSummaryInEdit->khrss_description; ?>' required></td>
 												<td><input type="text" name="khrsv_bojha" class="form-control input-number" style="width:170px;" placeholder="Enter Bojha" value='<?= $runningStockSummaryInEdit->khrss_bojha; ?>'></td>
 												<td>
 													<div class="form-group col-sm-12">
 														<select class="form-control select2" style="width:170px;" id="" name="khrsv_used" style="width: 100%;" required>
 															<option value="">Select</option>
 															<option value="1" <?php echo $runningStockSummaryInEdit->khrss_used == 1 ?  'selected' : '' ?>>Un Assorted</option>
 															<option value="2" <?php echo $runningStockSummaryInEdit->khrss_used == 2 ?  'selected' : '' ?>>Assorted Kachcha Form</option>
 															<option value="3" <?php echo $runningStockSummaryInEdit->khrss_used == 3 ?  'selected' : ''; ?>>Pucca Form</option>
 														</select>
 													</div>
 												</td>
 												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 													<td>
 														<!-- <input type="hidden" name="khrsv_j_g_id[]" value='<//?= $grade->j_g_id ?>'> -->
 														<input type="hidden" name="khrsv_value_id[]" value='<?= getKhamalRunningStockValueId($grade->j_g_id, $runningStockSummaryInEdit->khrss_id); ?>'>
 														<input type="text" name="khrsv_value[]" class="form-control gradeSum input-number" id="gradeSum<?= $grade->j_g_id ?>" placeholder="" value='<?= getKhamalRunningStockValueForListPage($grade->j_g_id, $runningStockSummaryInEdit->khrss_id); ?>'>
 													</td>
 												<?php } ?>
 												<td>
 													<input type="hidden" name="khrsv_kf_id" class="form-control" id="" placeholder="" value='<?= getKhamalRunningStockValueId('kf', $runningStockSummaryInEdit->khrss_id); ?>'>
 													<input type="text" name="khrsv_kf" class="form-control gradeSum input-number" id="khrsv_kf" placeholder="" value='<?= getKhamalRunningStockValueForListPage('kf', $runningStockSummaryInEdit->khrss_id); ?>'>
 												</td>
 												<td>
 													<input type="hidden" name="khrsv_wh_id" class="form-control" id="" placeholder="" value='<?= getKhamalRunningStockValueId('wh', $runningStockSummaryInEdit->khrss_id); ?>'>
 													<input type="text" name="khrsv_wh" class="form-control gradeSum input-number" id="khrsv_wh" placeholder="" value='<?= getKhamalRunningStockValueForListPage('wh', $runningStockSummaryInEdit->khrss_id); ?>'>
 												</td>
 												<td><input type="text" name="khrsv_total" class="form-control readonly" id="total" placeholder="" value='<?= $runningStockSummaryInEdit->khrss_total; ?>' required></td>
 											</tr>
 										</tbody>
 									</table>
 								</div>
 								<input type="hidden" name="khrsv_id" value="<?= $runningStockSummaryInEdit->khrss_id; ?>">
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" class="btn btn-info">Save Changes</button>
 									<a href="<?php echo base_url('list_khamal_running_stock'); ?>" type="submit" class="btn btn-secondary">Cancel</a>
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
 	//Grade wise sum
 	$(document).ready(function() {
 		var groupId = []
 		<?php
			foreach ($jute_grades->result() as $grade) {
			?>
 			groupId.push('<?= $grade->j_g_id ?>')
 		<?php } ?>

 		$(".gradeSum").keyup(function() {
 			var x = $(this).val();
 			allTotal = 0;

 			for (let i = 0; i < groupId.length; i++) {
 				otPer = 0;
 				id = groupId[i];
 				idName = 'gradeSum' + id;
 				otPer = $("#" + idName).val() || 0;
 				allTotal = (parseFloat(allTotal) + parseFloat(otPer));

 			}

 			kfV = $("#khrsv_kf").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(kfV));
 			whV = $("#khrsv_wh").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(whV));

 			$('#total').val(allTotal);
 		});






 		//automatic get financial year id
 		var khrsv_date = $('#khrsv_date').val();

 		getFy(khrsv_date);

 		function getFy(khrsv_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxFinancialYearKhamalRunningStock') ?>",
 				data: {
 					khrsv_date: khrsv_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + khrsv_date + ') date ',

 						})
 						$("#khrsv_date").val('');
 						$("#khrsv_fy_id").val('');
 					} else {
 						$("#khrsv_fy_id").val(data);
 						// alert(data);
 					}
 				}

 			});
 		}

 		$("#khrsv_date").on('change', function() {
 			khrsv_date = $(this).val();
 			getFy(khrsv_date);

 		});
 		//END automatic get financial year id


 		//  Check Adjustment month
 		var date = $('#khrsv_date').val();
 		//  getDate(date);

 		function getDate(date) {
 			//Change Date Formate
 			var [dd, mm, yyyy] = date.split("-");
 			var revDate = `${mm}-${dd}-${yyyy}`;
 			var changing_date = `${mm}-${yyyy}`;


 			const dateObj = new Date(revDate);
 			const monthNameLong = dateObj.toLocaleString("en-US", {
 				month: "long"
 			});

 			var catch_date = $('#catch_date').val();
 			var [dd1, mm1, yyyy1] = catch_date.split("-");
 			var catch_date_from_db = `${mm1}-${yyyy1}`;

 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxMonthYearKhamalRunningStock') ?>",
 				data: {
 					date: date
 				},
 				success: function(data) {
 					if (data == "no") {
 						$('#khrsv_date').val(date);
 					} else if (changing_date == catch_date_from_db) {
 						$("#khrsv_date").val(date);
 					} else {
 						Swal.fire({
 							icon: 'error',
 							title: 'Oops !!!!!!!!!!!!!',
 							text: 'You have already entered this (' + monthNameLong + ' ' + yyyy + ') month Running Stock. Please enter valid month.',
 						})
 						$("#khrsv_date").val('');
 					}
 				}
 			})
 		}
 		$("#khrsv_date").on('change', function() {
 			date = $(this).val();
 			getDate(date);

 		});





 	});
 </script>
