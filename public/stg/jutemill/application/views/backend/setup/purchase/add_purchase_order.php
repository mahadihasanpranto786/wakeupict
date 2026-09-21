 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Add Purchase Order</h1>
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
 						<li class="breadcrumb-item"><a href="<?php echo base_url('list_jute_purchase_order'); ?>">Back to List Purchase Order</a></li>
 						<li class="breadcrumb-item active">Purchase Order</li>
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
 							<h3 class="card-title"><i class="fa fa-plus-circle"></i> Add Purchase Order</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('insert_purchase_order') ?>" method="post" autocomplete="off">
 							<div class="card-body">
 								<div class="row">
 									<div class="row form-group col-sm-4">
 										<label class="col-sm-2 col-form-label" for="">Date</label>
 										<div class="col-sm-6">
 											<input type="text" name="jpo_date" id="jpo_date" class="form-control datepicker" id="" value='<?= get_current_time_time(); ?>' required>
 											<input type="hidden" name="jpo_fy_id" id="jpo_fy_id" value=''>
 										</div>
 									</div>
 									<div class="row form-group col-sm-4">
 										<label class="col-sm-2 col-form-label" for="">Due Date</label>
 										<div class="col-sm-6">
 											<input type="text" name="jpo_due_date" id="jpo_due_date" class="form-control datepicker" id="" value='<?= get_current_time_time(); ?>' required>
 										</div>
 									</div>
 									<div class="row form-group col-sm-4">
 										<label class="col-sm-2 col-form-label" for="">Supplier</label>
 										<select class="form-control col-sm-6  select2" name="jpo_s_id" required>
 											<option value="">Select Supplier</option>
 											<?php if ($suppliers) {
													foreach ($suppliers->result() as $supplier) {
												?>
 													<option value="<?= $supplier->s_id ?>"><?= $supplier->s_title ?> - <?= $supplier->s_phone ?></option>
 											<?php
													}
												}
												?>
 										</select>
 									</div>

 								</div>
 								<div class="row">
 									<table class="table">
 										<thead>
 											<tr>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<th class="text-center"><?= $grade->j_g_title ?></th>
 														<input type="hidden" name="jpo_j_g_id[]" value="<?= $grade->j_g_id ?>">
 												<?php
														}
													}
													?>
 												<th>KF-D1</th>
 												<th>WH-D1</th>
 												<th>Total</th>
 											</tr>
 										</thead>
 										<tbody>
 											<tr>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td><input type="text" name="jpo_mds_value[]" class="form-control gradeSumMds input-number" id="gradeSumMds<?= $grade->j_g_id ?>" placeholder="mds" value=''></td>
 												<?php
														}
													}
													?>
 												<td><input type="text" name="jpo_mds_kf" class="form-control gradeSumMds input-number" id="kfMds" placeholder="kf-d-1" value=''></td>
 												<td><input type="text" name="jpo_mds_wh" class="form-control gradeSumMds input-number" id="whMds" placeholder="wh-d-1" value=''></td>
 												<td><input type="text" name="jpo_total_mds" class="form-control readonly" id="totalMds" placeholder="total" value='' required></td>
 											</tr>
 										</tbody>
 									</table>
 								</div>
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" class="btn btn-info">Submit</button>
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




 		// F YEar  check
 		var jpo_date = $('#jpo_date').val();
 		getFy(jpo_date);

 		function getFy(jpo_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Purchase/ajaxFinancialYear') ?>",
 				data: {
 					jpo_date: jpo_date,
 				},
 				success: function(data) {
 					if (data == 'no') {
 						// Swal.fire({
 						// 	icon: 'error',
 						// 	title: 'Ops !!!!!!!!!!!!!',
 						// 	text: 'No Financial Year found under this (' + jpo_date + ') date ',

 						// })
 						alert('No Financial Year found under this (' + jpo_date + ') date. Please enter valid date.');
 						$("#jpo_date").val('');
 						$("#jpo_fy_id").val('');
 					} else {
 						$("#jpo_fy_id").val(data);
 						//  alert(data);
 					}
 				}
 			});
 		}
 		$("#jpo_date").on('change', function() {
 			jpo_date = $(this).val();
 			getFy(jpo_date);

 		});

 		//  Another Check
 		var jpo_due_date = $('#jpo_due_date').val();
 		getDueFy(jpo_due_date);

 		function getDueFy(jpo_due_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Purchase/ajaxFinancialYear') ?>",
 				data: {
 					jpo_date: jpo_due_date,
 				},
 				success: function(data) {
 					if (data == 'no') {
 						// Swal.fire({
 						// 	icon: 'error',
 						// 	title: 'Ops !!!!!!!!!!!!!',
 						// 	text: 'No Financial Year found under this (' + jpo_due_date + ') date ',

 						// })

 						alert('No Financial Year found under this (' + jpo_due_date + ') date. Please enter valid date.');


 						$("#jpo_due_date").val('');
 					}
 				}
 			});
 		}
 		$("#jpo_due_date").on('change', function() {
 			jpo_due_date = $(this).val();
 			getDueFy(jpo_due_date);

 		});





 	});
 </script>