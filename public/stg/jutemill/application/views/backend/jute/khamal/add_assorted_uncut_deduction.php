 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<input type="hidden" value="1" id="rimon_perfect_sum">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Add Assorted Uncut Deduction</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_assorted_uncut_deduction'); ?>">Back to Assorted Uncut
 								Deduction Summary</a></li>
 						<li class="breadcrumb-item active">Add Assorted Uncut Deduction</li>
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
 							<h3 class="card-title mt-2"><i class="fa fa-plus-circle"></i> Add Assorted Uncut Deduction
 							</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('insert_assorted_uncut_deduction'); ?>" method="post">
 							<div class="card-body">
 								<div class="row mb-2">
 									<div class="col-sm-1">
 										<h5 class="mt-2">Date</h5>
 									</div>
 									<div class="col-sm-2">
 										<input type="text" name="kh_auc_d_v_date" id="kh_auc_d_v_date" class="form-control datepicker" style="width: 100px;" placeholder="" value='' required>
 										<input type="hidden" name="kh_auc_d_v_fy_id" class="form-control" id="kh_auc_d_v_fy_id" placeholder="" value=''>
 									</div>
 									<div class="col-sm-9">
 									</div>
 								</div>
 								<div class="row">
 									<table class="table table-striped">
 										<tr>
 											<th>Khamal No.</th>
 											<th>Total Bojha</th>
 											<th>Avg. Weight</th>
 											<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 												<th><?= $grade->j_g_title ?></th>
 											<?php } ?>
 											<th>Total Mds</th>
 											<th>Comments</th>
 										</tr>
 										<tbody id="addAssortedItem">
 											<tr>
 												<td>
 													<div class="form-group col-sm-12 ml-0">
 														<select class="form-control select2" style="width:150px;" name="kh_auc_d_v_kh_id[]" id="khamal_id" required>
 															<option value="">Select Khamal</option>
 															<?php if ($khamals) {
																	foreach ($khamals->result() as $khamal) {
																		if ($khamal->kh_used == 2) { ?>
 																		<option value="<?= $khamal->kh_id; ?>">
 																			<?= $khamal->kh_title; ?></option>
 															<?php }
																	}
																} ?>
 														</select>
 													</div>
 												</td>
 												<td><input type="text" name="kh_auc_d_v_bojha_no[]" class="form-control input-number-minus-allow" placeholder="Enter Bojha No" value='' required></td>
 												<td><input type="text" name="kh_auc_d_v_avg_weight[]" class="form-control input-number-minus-allow" placeholder="Enter Weight" value=''></td>

 												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>

 													<td>
 														<input type="hidden" name="kh_auc_d_v_j_g_id[]" value='<?= $grade->j_g_id ?>'>
 														<input type="text" name="kh_auc_d_v_value[]" class="form-control gradeWeight input-number-minus-allow" id="gradeWeight<?= $grade->j_g_id ?>" placeholder="<?= $grade->j_g_title ?>" value=''>
 													</td>
 												<?php } ?>

 												<td><input type="text" name="kh_auc_d_v_total[]" class="form-control" id="total" placeholder="Total Mds" value='' readonly required>
 												</td>
 												<td><input type="text" name="kh_auc_d_v_comments[]" class="form-control" id="exampleInputEmail1" placeholder="Comments" value=''></td>
 											</tr>
 										</tbody>
 									</table>
 									<input id="" class="btn btn-info" name="add-new-item" onclick="addInputField('addAssortedItem');" value="Add New" type="button" style="margin: 0px 15px 15px;">
 								</div>
 								<input type="hidden" name="kh_auc_d_v_id">
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" class="btn btn-info" id="submitButton">Submit</button>
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
 	// ========== Add extra row =============
 	function addInputField(t) {
 		var count = 2;
 		var limits = 5;

 		var value_hidden = parseInt($("#rimon_perfect_sum").val()) + 1;
 		$("#rimon_perfect_sum").val(value_hidden);

 		var dynamic_class_name = "gradeSum" + `${value_hidden}`;
 		var total_grade = "total_grade" + `${value_hidden}`;
 		// alert(dynamic_class_name);
 		if (count == limits) {
 			alert("You have reached the limit of adding" + count + "inputs");
 		} else {
 			//    alert(count);return false;
 			var a = "assorted" + count,
 				e = document.createElement("tr");
 			e.innerHTML = `<td><div class='form-group col-sm-12'>\n\
			 <select class='form-control select2edit' id='' style='width:150px;' name='kh_auc_d_v_kh_id[]' required>\n\
			 	<option value = ''>Select Khamal</option>\n\
				 <?php if ($khamals) {
						foreach ($khamals->result() as $khamal) {
							if ($khamal->kh_used == 2) { ?>\n\
 				<option value='<?= $khamal->kh_id; ?>'><?= $khamal->kh_title; ?></option>\n\
				<?php }
						}
					} ?> </select > </div></td>\n\ <td><input type='text' name='kh_auc_d_v_bojha_no[]' class='form-control input-number-minus-allow' placeholder='Enter Bojha' value='' required></td>\n\
					\n\ <td><input type='text' name='kh_auc_d_v_avg_weight[]' class='form-control input-number-minus-allow' placeholder='Avg. Weight' value='' required></td>\n\
                 <?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>\n\ 
					<input type="hidden" name="kh_auc_d_v_j_g_id[]" value='<?= $grade->j_g_id ?>'>\n\
					<td><input type='text' name='kh_auc_d_v_value[]' class='form-control ${dynamic_class_name} input-number-minus-allow' value=''></td>\n\ 
					<?php } ?>\n\
					<td><input type='text' name='kh_auc_d_v_total[]' class='form-control readonly ${total_grade}' value='' required></td>\n\ 
					\n\ <td><input type='text' name='kh_auc_d_v_comments[]' class='form-control' placeholder='Comm' value=''></td>\n\
					<td><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>\n\ `, document.getElementById(t).appendChild(e);

 			$('.select2edit').select2()
 		};

 		$("." + dynamic_class_name).keyup(function() {
 			// alert($(this).val());
 			var total = 0;
 			$("." + dynamic_class_name).each(function() {
 				if ($(this).val() == "") {
 					var rimon = 0;
 				} else {
 					var rimon = parseFloat($(this).val());
 				}
 				total += rimon;
 			});
 			$('.' + total_grade).val(total);
 		});

 		$(".input-number").keyup(function(e) {
 			var data, i;
 			data = document.querySelectorAll(".input-number"); //HTML DOM querySelector() Method
 			for (i = 0; i < data.length; i++) {
 				data[i].value = data[i].value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
 			}
 			// alert("Replace Text");
 		});

 		$(".readonly").on('keydown paste focus mousedown', function(e) {
 			if (e.keyCode != 9) // ignore tab
 				e.preventDefault();
 		});



 	}
 	// ============= row delete dynamically =========
 	function deleteRow(t) {
 		var a = $().length;
 		if (1 == a) {
 			alert("There only one row you can't delete it.");
 		} else {
 			var e = t.parentNode.parentNode;
 			e.parentNode.removeChild(e);
 		}
 	}


 	$(document).ready(function() {

 		var groupId = []
 		<?php
			foreach ($jute_grades->result() as $grade) {
			?>
 			groupId.push('<?= $grade->j_g_id ?>')

 		<?php } ?>

 		$("#submit").hide();

 		$(".gradeWeight").keyup(function() {
 			var x = $(this).val();
 			//alert(x);
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

 			if ((totalValue == undefined) || (totalValue == 0) || (totalValue == null) || (totalValue.length ==
 					0) || isNaN(totalValue)) {
 				$('#submitButton').prop('disabled', true);
 			} else {
 				$('#submitButton').prop('disabled', false);
 			}
 		}



 		//automatic get financial year id
 		var kh_auc_d_v_date = $('#kh_auc_d_v_date').val();
 		//getFy(kh_auc_d_v_date);

 		function getFy(kh_auc_d_v_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxFinancialYearForAssortedUnCutDeduction') ?>",
 				data: {
 					kh_auc_d_v_date: kh_auc_d_v_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + kh_auc_d_v_date +
 								') date ',
 						})
 						$("#kh_auc_d_v_date").val('');
 						$("#kh_auc_d_v_fy_id").val('');
 					} else {
 						$("#kh_auc_d_v_fy_id").val(data);
 					}
 				}
 			});
 		}
 		$("#kh_auc_d_v_date").on('change', function() {
 			kh_auc_d_v_date = $(this).val();
 			getFy(kh_auc_d_v_date);

 		});
 		//END automatic get financial year id


 		// Enable Disable Input by khamal id previous 
 		$("#khamal_id").on("change", function() {
 			var khamal_id = $("select#khamal_id option:selected").val();
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/getPreviousAssortedUncutDeductionValueByKhamalId') ?>",
 				data: {
 					khamal_id: khamal_id
 				},
 				success: function(data) {
 					var datas = JSON.parse(data) //json to javascript object
 					var previous_data = datas.previous_data;

 					console.log(previous_data)

 					if (previous_data) {

 						$.each(previous_data, function(key, value) {

 							id = groupId[key];
 							idName = 'gradeWeight' + id;

 							if (value.kh_auc_d_v_value != 0) {
 								$("#" + idName).prop('readonly', false);
 							} else {
 								$("#" + idName).prop('readonly', true);
 							}


 						});
 					} else {
 						for (let i = 0; i < groupId.length; i++) {

 							id = groupId[i];
 							idName = 'gradeWeight' + id;


 							$("#" + idName).prop('readonly', false);

 						}
 					}



 				}
 			});
 		});




 	});
 </script>