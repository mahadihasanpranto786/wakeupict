 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Main content -->
 	<input type="hidden" value="1" id="rimon_perfect_sum">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Add Opening Khamal Balance</h1>
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
 						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_opening_khamal'); ?>">List Opening Khamal</a></li>
 						<li class="breadcrumb-item active">Add Opening Khamal Balance</li>
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
 							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New Opening Khamal Balance</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('insert_opening_khamal') ?>" method="post" autocomplete="off">
 							<div class="card-body">
 								<?= alert_check() ?>
 								<div class="row mb-2">
 									<div class="col-sm-1">
 										<h5 class="mt-2">Date</h5>
 									</div>
 									<div class="col-sm-2">
 										<input type="text" name="opvkh_date" class="form-control datepicker" id="opvkh_date" placeholder="" value='' required>
 										<input type="hidden" name="opvkh_fy_id" class="" id="opvkh_fy_id" value=''>
 									</div>
 									<div class="col-sm-9">
 									</div>
 								</div>
 								<div class="row">
 									<table class="table table-striped ">
 										<tr>
 											<th>Khamal</th>
 											<th>Bojha</th>
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
 														<select class="form-control select2 opvkh_kh_id" style="width:170px;" name="opvkh_kh_id[]" id="opvkh_kh_id" required>
 															<option value="">Select Khamal</option>
 															<?php if ($khamals) {
																	foreach ($khamals->result() as $khamal) {
																		$singleRowInfo = $this->Common->get_single_row_information_multi_conditional('opening_khamal_summary', ['opskh_kh_id' => $khamal->kh_id, 'opskh_status' => 1]);
																		if ($singleRowInfo) {
																			if ($singleRowInfo->opskh_kh_id != $khamal->kh_id) {
																?>
 																			<option value="<?= $khamal->kh_id; ?>"><?= $khamal->kh_title; ?></option>
 																		<?php }
																		} else { ?>
 																		<option value="<?= $khamal->kh_id; ?>"><?= $khamal->kh_title; ?></option>
 															<?php }
																	}
																} ?>
 														</select>
 													</div>
 												</td>
 												<td><input type="text" name="opvkh_bojha[]" class="form-control input-number" style="width:170px;" placeholder="Enter Bojha" value='' required></td>
 												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 													<td>
 														<input type="hidden" name="opvkh_j_g_id[]" value='<?= $grade->j_g_id ?>'>
 														<input type="text" name="opvkh_value[]" class="form-control gradeSum input-number" id="gradeSum<?= $grade->j_g_id ?>" placeholder="" value=''>
 													</td>
 												<?php } ?>
 												<td><input type="text" name="opvkh_kf[]" class="form-control gradeSum input-number" id="opvkh_kf" placeholder="" value=''></td>
 												<td><input type="text" name="opvkh_wh[]" class="form-control gradeSum input-number" id="opvkh_wh" placeholder="" value=''></td>
 												<td><input type="text" name="opvkh_total[]" class="form-control readonly" id="total" placeholder="" value='' required></td>
 											</tr>
 										</tbody>
 									</table>
 									<?php
										$openingKhamalRowCount = $this->Common->count_all_result('opening_khamal_summary', ['opskh_status' => 1]);
										// echo $openingKhamalRowCount;
										if ($openingKhamalRowCount == 0) { ?>

 										<input id="" class="btn btn-info" name="add-new-item" onclick="addInputField('addAssortedItem');" value="Add New" type="button" style="margin: 0px 15px 15px;">

 									<?php } ?>




 								</div>
 								<input type="hidden" name="opvkh_id">
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
 	// ========== Assorted row =============
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
			 <select class='form-control select2edit opvkh_kh_iid' id='' style='width:170px;' name='opvkh_kh_id[]'>\n\
			 	<option value = ''>Select Khamal</option>\n\
				 <?php if ($khamals) {
						foreach ($khamals->result() as $khamal) { ?>\n\
 				<option value='<?= $khamal->kh_id; ?>'><?= $khamal->kh_title; ?></option>\n\
				<?php }
					} ?> </select > </div></td>\n\ <td><input type='text' name='opvkh_bojha[]' class='form-control input-number' placeholder='Enter Bojha' value='' required></td>\n\
                 <?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>\n\ 
					<input type="hidden" name="opvkh_j_g_id[]" value='<?= $grade->j_g_id ?>'>\n\
					<td><input type='text' name='opvkh_value[]' class='form-control ${dynamic_class_name} input-number' value=''></td>\n\ 
					<?php } ?>\n\ 
					<td><input type='text' name='opvkh_kf[]' class='form-control ${dynamic_class_name} input-number' placeholder='' value=''></td>\n\ 
					<td><input type='text' name='opvkh_wh[]' class='form-control ${dynamic_class_name} input-number' placeholder='' value=''></input>\n\ 
					<td><input type='text' name='opvkh_total[]' class='form-control readonly ${total_grade}' value='' required></td>\n\ <td><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>\n\ `, document.getElementById(t).appendChild(e);
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


 		$(".opvkh_kh_iid").change(function() {
 			var opvkh_kh_iid = $('.opvkh_kh_iid').find(":selected").val();
 			// alert(opvkh_kh_id);
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxUsedByKhamalId') ?>",
 				data: {
 					opvkh_kh_id: opvkh_kh_iid,
 				},
 				success: function(data) {
 					// $("#opvkh_used").val(data);
 					if (data == 1) {
 						alert("This Khamal is for 'Un Assort' Jute. Do you like to store jute in this khamal?");
 					}
 					if (data == 2) {
 						alert("This Khamal is for 'Assort Kachcha Form' Jute. Do you like to store jute in this khamal?");
 					}
 					if (data == 3) {
 						alert("This Khamal is for 'Pacca Form' Jute. Do you like to store jute in this khamal?");
 					}
 					// alert(data);
 				}
 			});
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

 			kfV = $("#opvkh_kf").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(kfV));
 			whV = $("#opvkh_wh").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(whV));

 			$('#total').val(allTotal);
 		});




 		var globalVariableForOpeningKhamalCheck;

 		//automatic get financial year id
 		var opvkh_date = $('#opvkh_date').val();
 		//getFy(opvkh_date);

 		function getFy(opvkh_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxFinancialYearForOpeningKhamal') ?>",
 				data: {
 					opvkh_date: opvkh_date,
 				},
 				success: function(returnResult) {

 					if (returnResult == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Sorry!!!',
 							text: 'No Financial Year found under this (' + opvkh_date + ') date ',

 						})
 						$("#opvkh_date").val('');
 						$("#opvkh_fy_id").val('');
 					} else {
 						$("#opvkh_fy_id").val(returnResult);
 						globalVariableForOpeningKhamalCheck = returnResult;
 						getIdName();
 					}

 				}

 			});
 		}

 		$("#opvkh_date").on('change', function() {
 			opvkh_date = $(this).val();
 			getFy(opvkh_date);

 		});
 		//END automatic get financial year id



 		/* ================== Check Opening Khamal Data Financial Year Wise ================== */
 		var testDate = $('#opvkh_date').val();

 		function getIdName() {
 			var financialYearId = globalVariableForOpeningKhamalCheck;

 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxFinancialYearWiseOpeningKhamalCheck') ?>",
 				data: {
 					testKhamalFYId: financialYearId
 				},
 				success: function(data) {
 					if (data != "no") {
 						Swal.fire({
 							icon: 'error',
 							title: 'Oops !!!!!!!!!!!!!',
 							text: 'You have already entered this Financial Year Opening Khamal. Please enter valid Financial Year.',
 							background: '#f7cac9',
 						});
 						// $("#opvkh_date").val('');
 					} else {
 						$("#opvkh_date").val();
 					}
 				}
 			});
 		}

 		/* ================== /. Check Opening Khamal Data Financial Year Wise ================== */





 		//Alert for Used 
 		$(".opvkh_kh_id").change(function() {
 			var opvkh_kh_id = $('.opvkh_kh_id').find(":selected").val();
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxUsedByKhamalId') ?>",
 				data: {
 					opvkh_kh_id: opvkh_kh_id,
 				},
 				success: function(data) {
 					if (data == 1) {
 						alert("This Khamal is for 'Un Assort' Jute. Do you like to store jute in this khamal?");
 					}
 					if (data == 2) {
 						alert("This Khamal is for 'Assort Kachcha Form' Jute. Do you like to store jute in this khamal?");
 					}
 					if (data == 3) {
 						alert("This Khamal is for 'Pacca Form' Jute. Do you like to store jute in this khamal?");
 					}
 				}

 			});

 		});






 	});
 </script>