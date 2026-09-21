 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Main content -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Add Running Khamal Stock Balance</h1>
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
 						<li class="breadcrumb-item active">Add Running Khamal Stock Balance</li>
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
 							<h3 class="card-title"> <i class="fa fa-plus-circle"></i> Add New Running Khamal Stock Balance</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('insert_khamal_running_stock') ?>" method="post">
 							<input type="hidden" value="1" id="perfect_sum">
 							<div class="card-body">
 								<?= alert_check() ?>
 								<div class="row mb-2">
 									<div class="col-sm-1">
 										<h5 class="mt-2">Date</h5>
 									</div>
 									<div class="col-sm-2">
 										<input type="text" name="khrsv_date" class="form-control datepicker" id="khrsv_date" placeholder="" value='' required>
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
 														<select class="form-control select2" style="width:170px;" name="khrsv_kh_id[]">
 															<option value="">Select Khamal</option>
 															<?php if ($khamals) {
																	foreach ($khamals->result() as $khamal) { ?>
 																	<option value="<?= $khamal->kh_id; ?>"><?= $khamal->kh_title; ?></option>
 															<?php }
																} ?>
 														</select>
 													</div>
 												</td>
 												<td><input type="text" name="khrsv_description[]" class="form-control" style="width:170px;" placeholder="Enter Description" value='' required></td>
 												<td><input type="text" name="khrsv_bojha[]" class="form-control input-number" style="width:170px;" placeholder="Enter Bojha" value=''></td>
 												<td>
 													<div class="form-group col-sm-12">
 														<select class="form-control select2" style="width:170px;" id="" name="khrsv_used[]" style="width: 100%;" required>
 															<option value="">Select</option>
 															<option value="1">Un Assorted</option>
 															<option value="2">Assorted Kachcha Form</option>
 															<option value="3">Pucca Form</option>
 														</select>
 													</div>
 												</td>
 												<?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
 													<td>
 														<input type="hidden" name="khrsv_j_g_id[]" value='<?= $grade->j_g_id ?>'>
 														<input type="text" name="khrsv_value[]" class="form-control gradeSum input-number" id="gradeSum<?= $grade->j_g_id ?>" placeholder="" value=''>
 													</td>
 												<?php } ?>
 												<td><input type="text" name="khrsv_kf[]" class="form-control gradeSum input-number" id="khrsv_kf" placeholder="" value=''></td>
 												<td><input type="text" name="khrsv_wh[]" class="form-control gradeSum input-number" id="khrsv_wh" placeholder="" value=''></td>
 												<td><input type="text" name="khrsv_total[]" class="form-control readonly" id="total" placeholder="" value='' required></td>
 											</tr>
 										</tbody>
 									</table>
 									<input id="" class="btn btn-info" name="add-new-item" onclick="addInputField('addAssortedItem');" value="Add New" type="button" style="margin: 0px 15px 15px;">
 								</div>
 								<input type="hidden" name="khrsv_id">
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


 		var value_hidden = parseInt($("#perfect_sum").val()) + 1;
 		$("#perfect_sum").val(value_hidden);

 		var dynamic_class_name = "gradeSum" + `${value_hidden}`;
 		var total_grade = "total_grade" + `${value_hidden}`;

 		if (count == limits) {
 			alert("You have reached the limit of adding" + count + "inputs");
 		} else {
 			//    alert(count);return false;
 			var a = "assorted" + count,
 				e = document.createElement("tr");
 			e.innerHTML = `<td><div class='form-group col-sm-12'>\n\
			 <select class='form-control select2edit' id='' style='width:170px;' name='khrsv_kh_id[]'>\n\
			 	<option value = ''>Select Khamal</option>\n\
				 <?php if ($khamals) {
						foreach ($khamals->result() as $khamal) { ?>\n\
 				<option value='<?= $khamal->kh_id; ?>'><?= $khamal->kh_title; ?></option>\n\
				<?php }
					} ?> </select > </div></td>\n\
					<td><input type='text' name='khrsv_description[]' class='form-control' placeholder='Enter Description' value='' required></td>\n\
					<td><input type='text' name='khrsv_bojha[]' class='form-control input-number' placeholder='Enter Bojha' value=''></td>\n\
					<td>\n\
						<div class='form-group col-sm-12'>\n\
							<select class='form-control select2' style='width:170px;' id='' name='khrsv_used[]' style='width: 100%;' required>\n\
								<option value=''>Select</option>\n\
								<option value='1'>Un Assorted</option>\n\
								<option value='2'>Assorted Kachcha Form</option>\n\
								<option value='3'>Pucca Form</option>\n\
							</select>\n\
						</div>\n\
					</td>\n\
                 <?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>\n\
					<input type='hidden' name='khrsv_j_g_id[]' value='<?= $grade->j_g_id ?>'>\n\
                <td><input type='text' name='khrsv_value[]' class='form-control ${dynamic_class_name} input-number' value=''></td>\n\
                                                <?php } ?>\n\
				<td><input type='text' name='khrsv_kf[]' class='form-control input-number ${dynamic_class_name}' placeholder='' value=''></td>\n\
 				<td><input type='text' name='khrsv_wh[]' class='form-control input-number ${dynamic_class_name}' placeholder='' value=''></input>\n\
                <td><input type='text' name='khrsv_total[]' class='form-control readonly ${total_grade}' value='' required></td>\n\ <td><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>\n\ `, document.getElementById(t).appendChild(e);
 			$('.select2edit').select2()
 		};
 		$("." + dynamic_class_name).keyup(function() {
 			//  alert($(this).val());
 			var total = 0;
 			$("." + dynamic_class_name).each(function() {
 				if ($(this).val() == "") {
 					var value = 0;
 				} else {
 					var value = parseFloat($(this).val());
 				}
 				total += value;
 			});
 			$('.' + total_grade).val(total);
 		});

 		// input number
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

 			kfV = $("#khrsv_kf").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(kfV));
 			whV = $("#khrsv_wh").val() || 0;
 			allTotal = (parseFloat(allTotal) + parseFloat(whV));

 			$('#total').val(allTotal);
 		});






 		//automatic get financial year id
 		var khrsv_date = $('#khrsv_date').val();

 		//getFy(khrsv_date);

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
 		//  alert(date)

 		getDate(date);

 		function getDate(date) {
 			//Change Date Formate
 			var [dd, mm, yyyy] = date.split("-");
 			var revDate = `${mm}-${dd}-${yyyy}`;
 			//  Date to Month Name
 			const dateObj = new Date(revDate);
 			const monthNameLong = dateObj.toLocaleString("en-US", {
 				month: "long"
 			});

 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('jute/Khamal/ajaxMonthYearKhamalRunningStock') ?>",
 				data: {
 					date: date
 				},
 				success: function(data) {
 					if (data == "no") {
 						$('#khrsv_date').val(date);
 					} else {
 						Swal.fire({
 							icon: 'error',
 							title: 'Oops !!!!!!!!!!!!!',
 							text: 'You have already entered this (' + monthNameLong + ' ' + yyyy + ') month Running Stock. Please enter valid month.',
 						})
 						// $("#khrsv_date").val('');
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