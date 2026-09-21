 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Jute Sell</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_jute_sell'); ?>">Back to Jute Sell List</a></li>
 						<li class="breadcrumb-item active">Jute Sell</li>
 					</ol>
 				</div>
 			</div>
 		</div>
 	</section>



 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-md-12">
 					<div class="card card-info mt-3">
 						<div class="card-header">
 							<h3 class="card-title"><i class="fas fa-plus-circle"></i>New Jute Sell</h3>
 						</div>
 						<form role="form" action="<?php echo base_url('insert_jute_sell'); ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
 							<div class="card-body">
 								<div class="row">
 									<div class="form-group col-sm-3">
 										<label>Client Name</label>
 										<span class="text-danger">*</span>
 										<select type="text" name="jsv_c_id" id="" class="form-control select2" style="width: 100%;" required>
 											<option value="">Please Select One</option>
 											<?php if ($clients) foreach ($clients->result() as $client) { ?>
 												<option value="<?= $client->c_id; ?>"><?= $client->c_title; ?></option>
 											<?php } ?>
 										</select>
 									</div>
 									<!-- <div class="form-group col-sm-3">
                                         <label>Jute variety</label>
                                         <select class="form-control select2" style="width: 100%;" name="jsv_jute_variety" required>
                                             <option value="">Select</option>
                                             <option value="Normal">Normal</option>
                                             <option value="WH">WH</option>
                                             <option value="KF">KF</option>
                                             <option value="Cutting">Cutting</option>
                                             <option value="TW">TW</option>
                                         </select>
                                     </div> -->
 									<div class="form-group col-sm-3">
 										<label for="exampleInputEmail1">Date</label>
 										<input type="text" name="jsv_date" id="jsv_date" id="date" value="<?= get_current_time_time(); ?>" class="form-control datepicker" placeholder="Enter Date" required>
 										<input type="hidden" name="jsv_fy_id" class="form-control" id="jsv_fy_id" placeholder="" value=''>
 									</div>
 									<div class="form-group col-sm-3">
 										<label>Jute Area</label>
 										<span class="text-danger">*</span>
 										<select type="text" name="jsv_ar_id" id="" class="form-control select2" style="width: 100%;" required>
 											<option value="">Please Select One</option>
 											<?php if ($areas) foreach ($areas->result() as $area) { ?>
 												<option value="<?= $area->ar_id; ?>"><?= $area->ar_title; ?></option>
 											<?php } ?>
 										</select>
 									</div>
 								</div>


 								<div class="row mt-2">
 									<table class="table table-striped">
 										<thead>
 											<tr>
 												<th>Grades</th>
 												<th>Quantity (Mds)</th>
 												<th>Rate (Per Mds)</th>
 												<th>Amount</th>
 											</tr>
 										</thead>
 										<tbody>
 											<?php if ($jute_grades) {
													foreach ($jute_grades->result() as $grade) { ?>
 													<tr>
 														<td>
 															<?= $grade->j_g_title ?>
 															<input type="hidden" name="jsv_j_g_id[]" class="form-control" id="exampleInputEmail1" placeholder="" value="<?= $grade->j_g_id ?>">
 														</td>
 														<td>
 															<input type="text" name="jsv_weight[]" class="form-control js_weight auto-calc input-number" id="js_weight<?= $grade->j_g_id ?>" placeholder="Enter Jute Weight (kg)" value="">
 														</td>
 														<td>
 															<input type="text" name="jsv_rate[]" class="form-control js_rate auto-calc input-number" id="rate" placeholder="Enter Rate " value="">
 														</td>
 														<td>
 															<input type="text" name="jsv_amount[]" class="form-control auto-calc js_balance readonly" id="js_balance<?= $grade->j_g_id ?>" placeholder="Total Taka" value="">
 														</td>
 													</tr>
 											<?php }
												} ?>
 											<!-- For Total Amount -->
 											<tr>
 												<td>Total</td>
 												<td>
 													<input type="text" name="jsv_total_weight" class="form-control readonly" id="totalJuteWeight" placeholder="Total Weight" value="" required>
 												</td>
 												<td>

 												</td>
 												<td>
 													<input type="text" name="jsv_total_amount" class="form-control readonly" id="total-amount" placeholder="Total Taka" value="" required>
 												</td>
 											</tr>

 										</tbody>
 									</table>

 								</div>

 								<input type="hidden" name="jsv_id" id="id">
 							</div>
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" id="submit" class="btn btn-info">Submit</button>
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
 <script type="text/javascript">
 	// Grand Total Sum
 	$(document).ready(function() {

 		var groupId = []
 		<?php foreach ($jute_grades->result() as $grade) {
			?>
 			groupId.push('<?= $grade->j_g_id ?>')
 		<?php } ?>
 		//Tota lJute Weight
 		$(".js_weight").keyup(function() {
 			var x = $(this).val();
 			allTotal = 0;

 			for (let i = 0; i < groupId.length; i++) {
 				rate = 0;

 				id = groupId[i];
 				idName = 'js_weight' + id;
 				rate = $("#" + idName).val() || 0;
 				allTotal = (parseFloat(allTotal) + parseFloat(rate));
 			}
 			$('#totalJuteWeight').val(allTotal);
 		});



 		//automatic get financial year id
 		var jsv_date = $('#jsv_date').val();
 		getFy(jsv_date);

 		function getFy(jsv_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Client/ajaxFinancialYearForJuteSell') ?>",
 				data: {
 					jsv_date: jsv_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + jsv_date + ') date ',
 						})
 						$("#jsv_date").val('');
 						$("#jsv_fy_id").val('');
 					} else {
 						$("#jsv_fy_id").val(data);
 						//  alert(data);
 					}
 				}
 			});
 		}
 		$("#jsv_date").on('change', function() {
 			jsv_date = $(this).val();
 			getFy(jsv_date);

 		});
 		//END automatic get financial year id







 	});

 	// Row data auto calculation
 	$(document).on("keyup change paste", "td > input.auto-calc", function() {

 		// Determine parent row
 		row = $(this).closest("tr");

 		// Get first and second input values
 		first = row.find("td input.js_weight").val();
 		second = row.find("td input.js_rate").val();

 		// Print input values to output cell
 		row.find(".js_balance").val(parseFloat(first) * parseFloat(second));

 		// Update total value
 		var sum = 0;
 		// Cycle through each input with class total-cost
 		$("input.js_balance").each(function() {
 			// Add value to sum
 			sum += +$(this).val();
 		});

 		// Assign sum to text of #total-invoice
 		// Using the id here as there is only one of these
 		$("#total-amount").val(sum);
 		//  var bb = $('#total-amount').val();
 		if (sum > 0) {
 			//  alert('null');
 			$("#submit").attr("disabled", false);
 		} else {
 			$("#submit").attr("disabled", true);
 		}

 	});
 </script>