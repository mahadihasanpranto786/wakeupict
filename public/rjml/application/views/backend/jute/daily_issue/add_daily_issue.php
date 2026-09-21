 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Daily Issue</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('add_daily_requisition') ?>">Add New Requisition</a></li>
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_daily_requisition') ?>">Back to Requisition Summary</a></li>
 						<li class="breadcrumb-item active">Add Daily Issue</li>
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
 							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add Daily Issue </h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('insert_daily_issue'); ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
 							<div class="card-body">
 								<div class="row">
 									<div class="form-group px-0 col-sm-4">
 										<label for="exampleInputEmail1">SL No.</label>
 										<input type="text" name="isv_res_sl_no" class="form-control" id="exampleInputEmail1" value="<?= $reAddIssue->res_sl_no ?>" placeholder="Enter sl no." readonly>
 									</div>
 									<div class="form-group col-sm-4">
 										<label for="exampleInputEmail1">Unit</label>
 										<input type="text" name="" class="form-control" id="exampleInputEmail1" value="<?= $this->M_production_unit->getProductionUnitById($reAddIssue->res_pu_id)->pu_title ?>" placeholder="Enter sl no." readonly>
 										<input type="hidden" name="isv_res_pu_id" class="form-control" id="exampleInputEmail1" value="<?= $reAddIssue->res_pu_id ?>" placeholder="Enter sl no." readonly>
 									</div>
 									<div class="form-group col-sm-4">
 										<label for="exampleInputEmail1">Date</label>
 										<input type="text" name="isv_res_date" id="isv_res_date" class="form-control datepicker" value="<?= date("d-m-Y", strtotime($reAddIssue->res_date)) ?>">
 										<input type="hidden" name="isv_res_fy_id" class="form-control" id="isv_res_fy_id" placeholder="" value='<?= $reAddIssue->res_fy_id ?>'>
 									</div>
 								</div>
 								<div class="row">
 									<!-- Table -->
 									<table id="" class="table ">

 										<tr>
 											<?php if ($areas) foreach ($areas->result() as $area) { ?>
 												<th colspan="3" style="background-color:#98FB98"><?= $area->ar_title ?></th>
 												</th>
 											<?php } ?>
 										</tr>
 										<tr>
 											<?php if ($areas) foreach ($areas->result() as $area) { ?>
 												<th>Grade</th>
 												<!-- <th>Balance</th> -->
 												<th>Requisition</th>
 												<th>Issue</th>
 											<?php } ?>
 										</tr>
 										<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 											<tr>
 												<?php if ($areas) foreach ($areas->result() as $area) { ?>
 													<td style="background-color:#FFEBCD">
 														<?= $grade->j_g_title ?>
 														<input type="hidden" name="isv_j_g_id[]" class="form-control" id="exampleInputEmail1" placeholder="" value="<?= $grade->j_g_id ?>">
 													</td>

 													<!-- <td>
 														<input type="text" name="isv_balance[]" class="form-control isv_balance input-number" id="isv_balance</?= $grade->j_g_id ?></?= $area->ar_id ?>" placeholder="" value="" readonly>
 													</td> -->
 													<td>
 														<input type="hidden" name="isv_ar_id[]" class="form-control" id="" value="<?= $area->ar_id ?>">
 														<input type="text" name="" class="form-control input-number" id="exampleInputEmail1" placeholder="" value="<?= getRequisitionValue($grade->j_g_id, $area->ar_id, $requisitionSummaryId); ?>" disabled>
 													</td>
 													<td>
 														<input type="text" name="isv_issue[]" class="form-control input-number isv_issue <?= $area->ar_id ?>" id="isv_issue<?= $grade->j_g_id ?><?= $area->ar_id ?>" placeholder="<?= $area->ar_title ?>_<?= $grade->j_g_title ?>" value="">
 													</td>
 												<?php } ?>
 											</tr>
 										<?php } ?>
 										<!-- Total Issue Count -->
 										<tr>
 											<?php
												if ($areas) foreach ($areas->result() as $area) { ?>
 												<td>Total</td>
 												<!-- <td> </td> -->
 												<td>
 													<input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value="<?= getTotalRequisitionValueByArea($area->ar_id, $requisitionSummaryId); ?>" readonly>
 												</td>
 												<td>
 													<input type="text" name="" class="form-control Total<?= $area->ar_id ?>" id="" placeholder="Total_<?= $area->ar_title ?>_<?= $grade->j_g_title ?>" value="" readonly>
 												</td>

 											<?php } ?>
 										</tr>
 									</table>
 								</div>
 								<div class="row">
 									<div class="col-sm-4" style="background-color:#98FB98">
 										<!-- <table>
 											<tr>
 												<td>WH-1</td>
 												<input type="hidden" name="wh" value="wh">
 												<td>
 													<input type="text" name="" class="form-control" id="" placeholder="Balance" value="" readonly>
 												</td>
 												<td>
 													<input type="text" name="" class="form-control" id="" placeholder="" value="<//?= getRequisitionValue('wh', 'wh', $requisitionSummaryId); ?>" disabled>
 												</td>
 												<td>
 													<input type="text" name="wh_value" class="form-control isv_issue" id="whV" placeholder="" value="">
 												</td>
 											</tr>
 										</table> -->
 									</div>
 									<div class="col-sm-4" style="background-color:#98FB98">
 										<!-- <table>
 											<tr>
 												<td>KF-1</td>
 												<input type="hidden" name="kf" value="kf">
 												<td>
 													<input type="text" name="" class="form-control" id="" placeholder="Balance" value="" readonly>
 												</td>
 												<td>
 													<input type="text" name="" class="form-control" id="" placeholder="" value="<//?= getRequisitionValue('kf', 'kf', $requisitionSummaryId); ?>" disabled>
 												</td>
 												<td>
 													<input type="text" name="kf_value" class="form-control isv_issue" id="kfV" placeholder="" value="">
 												</td>
 											</tr>
 										</table> -->
 									</div>
 									<div class="col-sm-4">

 									</div>
 								</div>
 								<div class="row">
 									<div class="col-sm-4">
 										<h3>Grand Total Requisition: &nbsp;<span class="text-danger font-weight-bold"><u><?= number_format($reAddIssue->res_total_requisition, 2, '.', ','); ?></u></span></h3>
 									</div>
 									<div class="col-sm-2">
 										<h3>Grand Total Issue: </h3>
 									</div>
 									<div class="col-sm-2">
 										<input type="text" name="iss_total_issue" class="form-control font-weight-bold" id="grandTotalPerIssue" placeholder="Total Issue" value="" readonly>
 									</div>
 									<div class="col-sm-2">
 										<!-- <h3>Grand Total Balance: </h3> -->
 									</div>
 									<div class="col-sm-2">
 										<!-- <input type="text" name="iss_total_balance" class="form-control font-weight-bold" id="grandTotalBalancePerIssue" placeholder="Total Balance" value="" readonly> -->
 									</div>
 								</div>
 								<input type="hidden" name="isv_id">
 								<input type="hidden" name="isv_res_id" value="<?= $reAddIssue->res_id; ?>">
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" class="btn btn-info">Submit</button>
 								</div>
 							</div>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>
 </div>

 <!-- Script -->
 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <!-- Total Jute Issue Sum -->
 <script type="text/javascript">
 	$(document).ready(function() {
 		var groupId = []
 		var areaId = []
 		<?php foreach ($jute_grades->result() as $grade) {
			?>

 			<?php if ($areas) foreach ($areas->result() as $area) { ?>
 				areaId.push('<?= $area->ar_id ?>')
 				groupId.push('<?= $grade->j_g_id ?><?= $area->ar_id ?>')
 			<?php } ?>
 		<?php } ?>
 		$(".isv_issue").keyup(function() {
 			var x = $(this).val();
 			allTotal = 0;

 			for (let i = 0; i < groupId.length; i++) {
 				isvPer = 0;

 				id = groupId[i];
 				idName = 'isv_issue' + id;
 				isvPer = $("#" + idName).val() || 0;
 				allTotal = (parseFloat(allTotal) + parseFloat(isvPer));

 				//for area wise calculation
 				for (let k = 0; k < areaId.length; k++) {
 					areaIdNO = areaId[k];
 					var alpha = 0;
 					$("." + areaIdNO).each(function(i, obj) {
 						console.log(alpha);
 						if ($(this).val()) {
 							var e = $(this).val();
 						} else {
 							var e = 0;
 						}

 						alpha = parseFloat(e) + parseFloat(alpha);

 					});
 					var tittleSum = 'Total' + areaIdNO;
 					//alert(tittleSum);
 					$("." + tittleSum).val(alpha);
 				}

 			}
 			whV = $("#whV").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(whV));
 			kfV = $("#kfV").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(kfV));

 			$('#grandTotalPerIssue').val(allTotal);
 		});



 		//automatic get financial year id
 		var isv_res_date = $('#isv_res_date').val();
 		getFy(isv_res_date);

 		function getFy(isv_res_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Daily_issue/ajaxFinancialYearForDailyJuteIssue') ?>",
 				data: {
 					isv_res_date: isv_res_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + isv_res_date + ') date ',
 						})
 						$("#isv_res_date").val('');
 						$("#isv_res_fy_id").val('');
 					} else {
 						$("#isv_res_fy_id").val(data);
 						//  alert(data);
 					}
 				}
 			});
 		}
 		$("#isv_res_date").on('change', function() {
 			isv_res_date = $(this).val();
 			getFy(isv_res_date);

 		});
 		//END automatic get financial year id





 	});
 </script>


 <!-- Total Issue Balance Sum -->
 <script type="text/javascript">
 	$(document).ready(function() {
 		var groupId = []
 		<?php foreach ($jute_grades->result() as $grade) {
			?>
 			<?php if ($areas) foreach ($areas->result() as $area) { ?>
 				groupId.push('<?= $grade->j_g_id ?><?= $area->ar_id ?>')
 			<?php } ?>
 		<?php } ?>
 		$(".isv_balance").keyup(function() {
 			var x = $(this).val();
 			allTotal = 0;

 			for (let i = 0; i < groupId.length; i++) {
 				isvPer = 0;

 				id = groupId[i];
 				idName = 'isv_balance' + id;
 				isvPer = $("#" + idName).val() || 0;
 				allTotal = (parseFloat(allTotal) + parseFloat(isvPer));
 			}
 			$('#grandTotalBalancePerIssue').val(allTotal);
 		});
 	});
 </script>