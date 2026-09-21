 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Update Unassorted Deduction</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_unassorted_deduction'); ?>">Back to Unassorted Deduction Summary</a></li>
 						<li class="breadcrumb-item active">Update Unassorted Deduction</li>
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
 							<h3 class="card-title"><i class="fa fa-edit"></i> Update Unassorted Deduction</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('update_unassorted_deduction'); ?>" method="post">
 							<div class="card-body">
 								<div class="row">
 									<table class="table table-striped">
 										<tr>
 											<th>Date</th>
 											<!-- <th>Lot No.</th> -->
 											<th>Khamal No.</th>
 											<th>Bojha No.</th>
 											<th>Net Weight</th>
 											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 												<th><?= $grade->j_g_title ?></th>
 											<?php } ?>
 											<th>Total</th>
 											<th>Comments</th>
 										</tr>
 										<tbody>
 											<tr>
 												<td><input type="text" name="kh_ua_d_v_date" id="kh_ua_d_v_date" class="form-control datepicker" style="width: 100px;" placeholder="" value='<?= date("d-m-Y", strtotime($editUnassortedDeView->kh_ua_d_s_date)) ?>'></td>
 												<input type="hidden" name="kh_ua_d_v_fy_id" class="form-control" id="kh_ua_d_v_fy_id" placeholder="" value=''>
 												<td>
 													<div class="form-group col-sm-12 ml-0">
 														<select class="form-control select2" style="width:170px;" name="kh_ua_d_v_kh_id" id="khamal_id" required>
 															<option value="">Select Khamal</option>
 															<?php if ($khamals) {
																	foreach ($khamals->result() as $khamal) {
																		if ($khamal->kh_used == 1) { ?>
 																		<option value="<?= $khamal->kh_id; ?>" <?php if (!empty($editUnassortedDeView)) {
																													if ($editUnassortedDeView->kh_ua_d_s_kh_id == $khamal->kh_id) {
																														echo "selected";
																													}
																												} ?>><?= $khamal->kh_title; ?></option>
 															<?php }
																	}
																} ?>
 														</select>
 													</div>
 												</td>
 												<td><input type="text" name="kh_ua_d_v_bojha_no" class="form-control input-number" placeholder="Enter Bojha No" value='<?= $editUnassortedDeView->kh_ua_d_s_bojha_no ?>'></td>
 												<td><input type="text" name="kh_ua_d_v_avg_weight" class="form-control input-number" placeholder="Enter Avg. Weight" value='<?= $editUnassortedDeView->kh_ua_d_s_avg_weight ?>'></td>

 												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 													<td>
 														<input type="hidden" name="kh_ua_d_v_value_id[]" value='<?= getUnassortedDeductionValueId($grade->j_g_id, $unAssortedDeductionSummaryId); ?>'>
 														<input type="text" name="kh_ua_d_v_value[]" class="form-control input-number gradeWeight" id="gradeWeight<?= $grade->j_g_id ?>" placeholder="<?= $grade->j_g_title ?>" value='<?= getUnassortedDeductionValue($grade->j_g_id, $unAssortedDeductionSummaryId); ?>'>
 													</td>
 												<?php } ?>
 												<td><input type="text" name="kh_ua_d_v_total" class="form-control readonly" id="total" placeholder="Total" value='<?= $editUnassortedDeView->kh_ua_d_s_total ?>'></td>
 												<td><input type="text" name="kh_ua_d_v_comments" class="form-control" id="" placeholder="Comments" value='<?= $editUnassortedDeView->kh_ua_d_s_comments ?>'></td>
 											</tr>
 										</tbody>
 									</table>
 								</div>
 								<input type="hidden" name="kh_ua_d_v_id" value="<?= $editUnassortedDeView->kh_ua_d_s_id ?>">
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" class="btn btn-info" id="submitButton">Save Changes</button>
 									<a href="<?php echo base_url('list_unassorted_deduction'); ?>" type="submit" class="btn btn-secondary">Cancel</a>
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
			foreach ($jute_grades->result() as $grade) {
			?>
 			groupId.push('<?= $grade->j_g_id ?>')

 		<?php } ?>


 		$(".gradeWeight").keyup(function() {
 			var x = $(this).val();
 			allTotal = 0;

 			for (let i = 0; i < groupId.length; i++) {
 				otPer = 0;

 				id = groupId[i];
 				idName = 'gradeWeight' + id;
 				otPer = $("#" + idName).val() || 0;

 				allTotal = (parseFloat(allTotal) + parseFloat(otPer));
 			}
 			$('#total').val(allTotal);
 			enableDisableSubmitButton()

 		});

 		// Disable Enable Submit Button
 		enableDisableSubmitButton()

 		function enableDisableSubmitButton() {
 			var totalValue = $('#total').val();

 			if ((totalValue == undefined) || (totalValue == 0) || (totalValue == null) || (totalValue.length == 0) || isNaN(totalValue)) {
 				$('#submitButton').prop('disabled', true);
 			} else {
 				$('#submitButton').prop('disabled', false);
 			}
 		}



 		//automatic get financial year id
 		var kh_ua_d_v_date = $('#kh_ua_d_v_date').val();
 		getFy(kh_ua_d_v_date);

 		function getFy(kh_ua_d_v_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxFinancialYearForUnassortedDeduction') ?>",
 				data: {
 					kh_ua_d_v_date: kh_ua_d_v_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + kh_ua_d_v_date + ') date ',
 						})
 						$("#kh_ua_d_v_date").val('');
 						$("#kh_ua_d_v_fy_id").val('');
 					} else {
 						$("#kh_ua_d_v_fy_id").val(data);
 						//  alert(data);
 					}
 				}
 			});
 		}
 		$("#kh_ua_d_v_date").on('change', function() {
 			kh_ua_d_v_date = $(this).val();
 			getFy(kh_ua_d_v_date);

 		});




 	});
 </script>
