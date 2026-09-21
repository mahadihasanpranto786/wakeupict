<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Update New Out Turn Reports</h1>
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
						<li class="breadcrumb-item active"><a href="<?php echo base_url('list_out_turn_report'); ?>">Back to Out Turn Report list</a></li>
						<li class="breadcrumb-item active">Update New Out Turn Reports</li>
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
							<h3 class="card-title">Update Out Turn Report</h3>
						</div>
						<!-- form start -->
						<form role="form" action="<?php echo base_url('update_out_turn_report'); ?>" method="post" autocomplete="off" onkeydown="return event.key != 'Enter';">
							<div class="card-body">
								<!-- <div class="row">
									<div class="form-group col-sm-1">
										<label for="" class="">Jute variety</label>
										<select class="form-control select2" style="width: 100%;" name="en_jute_variety" required>
											<option value="">Select</option>
											<option value="Normal">Normal</option>
											<option value="WH">WH</option>
											<option value="KF">KF</option>
											<option value="Cutting">Cutting</option>
											<option value="TW">TW</option>
										</select>
									</div>
								</div> -->
								<div class="row">
									<div class="form-group col-sm-3">
										<label for="">Mill Lot No</label>
										<select class="form-control select2" style="width: 100%;" id="ot_en_id" name="" disabled>
											<!-- <option value="">Select</option> -->
											<option value="<?= $singleRowData->ot_en_id ?>"><?= $singleRowData->ot_lot_no ?></option>
										</select>

									</div>
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">Net Weight <span class="text-danger">(KG)</span> </label>
										<input type="text" name="ot_net_weight" class="form-control input-number" value="<?= $singleRowData->ot_net_weight; ?>" id="ot_net_weight" placeholder="Enter Net Weight" required>
									</div>
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">KGs (After .5% Deduction)</label>
										<input type="text" name="ot_kgs" class="form-control" value="<?= $singleRowData->ot_kgs; ?>" id="ot_kgs" placeholder="KGs (After .5% Deduction)" readonly>
									</div>
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">Mds</label>
										<input type="text" name="ot_mds" class="form-control" value="<?= $singleRowData->ot_mds; ?>" id="ot_mds" placeholder="Enter Mds" readonly>
									</div>
								</div>
								<div class="row">
									<input type="hidden" value="<?= $singleRowData->ot_en_id ?>" id="ot_en_id">
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Entry Date</label>
										<input type="text" class="form-control" id="en_date" value="<?= date("d-m-Y H:i:s A", strtotime($this->M_jute_entry->getJuteEntryById($singleRowData->ot_en_id)->en_date)); ?>" readonly>
									</div>
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Assessment Date</label>
										<input type="text" name="ot_ass_date" class="form-control datepicker" id="ot_ass_date" value="<?php echo date("d-m-Y", strtotime($singleRowData->ot_en_date)); ?>" required>
									</div>
									<div class="form-group col-sm-2" id="ot_ar_id_div">
										<label>Area</label>
										<input type="hidden" name="" id="ot_ar_id_hh" value="">
										<select class="form-control select2" style="width: 100%;" name="ot_ar_id" id="ot_ar_id">
											<option value="">Select Area</option>
											<?php
											if ($areas) {
												foreach ($areas->result() as $area) {
											?>
													<option value="<?= $area->ar_id; ?>" <?php if ($singleRowData->ot_ar_id == $area->ar_id) {
																								echo "selected";
																							} ?>><?= $area->ar_title ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Received Bojha/Bale</label>
										<input type="text" name="ot_rec_bojha" class="form-control input-number" id="exampleInputEmail1" value="<?= $singleRowData->ot_rec_bojha; ?>" placeholder="Received Bojha/Bale" required>
									</div>
									<div class="form-group col-sm-2">
										<label>New/Old</label>
										<select class="form-control select2" style="width: 100%;" name="ot_jute_type" required>
											<option value="">Select Jute Type</option>
											<option value="new" <?php if ($singleRowData->ot_jute_type == "new") {
																	echo "selected";
																} ?>>NEW</option>
											<option value="old" <?php if ($singleRowData->ot_jute_type == "old") {
																	echo "selected";
																} ?>>OLD</option>
										</select>
									</div>
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Moisture %</label>
										<input type="text" name="ot_moisture" class="form-control input-number" value="<?= $singleRowData->ot_moisture; ?>" id="ot_moisture" placeholder="Enter Moisture %" required>
									</div>
								</div>
								<div class="row mt-1">
									<h5 class="mx-auto">Out Turn (%) </h5>
									<h5>[ Verity: <span class="text-danger" id="en_jute_variety" en_jute_variety="<?= $this->M_jute_entry->getJuteEntryById($singleRowData->ot_en_id)->en_jute_variety ?>"><?= $this->M_jute_entry->getJuteEntryById($singleRowData->ot_en_id)->en_jute_variety ?></span>]</h5>
								</div>
								<!-- [ <span id="en_jute_variety"></span>] -->
								<div class="row">
									<table class="table table-striped">
										<tr>
											<?php if ($grades) {
												foreach ($grades->result() as $grade) {
											?>
													<input type="hidden" name="gradeId[]" class="form-control" id="" value='<?= $grade->j_g_id ?>'>
													<th class="text-center"><?= $grade->j_g_title ?></th>
											<?php
												}
											}
											?>
											<th class="text-center">Total %</th>
										</tr>
										<tr>
											<?php if ($grades) {
												foreach ($grades->result() as $grade) {
											?>
													<td>
														<input type="hidden" name="outTurnPerId[]" class="form-control" value='<?= getOutTurnPerId($grade->j_g_id, $singleRowData->ot_id); ?>'>
														<input type="text" name="outTurnPer[]" class="form-control outTurnPer input-number readonly-input" id="outTurnPer<?= $grade->j_g_id ?>" placeholder="Enter <?= $grade->j_g_title ?> %" value='<?= getOutTurnPer($grade->j_g_id, $singleRowData->ot_id); ?>'>
													</td>
											<?php
												}
											}
											?>
											<td>
												<input type="text" name="outTurnTotal" class="form-control" id="total" placeholder="total" value='' readonly required>
											</td>
										</tr>
									</table>
									<input type="hidden" name="ot_id" value="<?= $singleRowData->ot_id ?>">
									<input type="hidden" name="ot_en_id" value="<?= $singleRowData->ot_en_id ?>">
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-info" id="submit">Save Changes</button>
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

		$('#ot_net_weight').keyup(function() {
			//alert("Hello! I am an alert box!");
			var otnw = parseFloat($('#ot_net_weight').val()) || 0;
			$('#ot_kgs').val((otnw - (otnw * .5 / 100)).toFixed(3));

			var otkg = parseFloat($('#ot_kgs').val()) || 0;
			$('#ot_mds').val((otkg / 40).toFixed(3));
		});

		var groupId = []
		<?php
		foreach ($grades->result() as $grade) {
		?>
			groupId.push('<?= $grade->j_g_id ?>')

		<?php } ?>
		//alert(groupId);

		//normally Submit Butten Hide thakba
		$("#submit").show();

		$(".outTurnPer").keyup(function() {
			var x = $(this).val();
			// alert(x);
			allTotal = 0;

			for (let i = 0; i < groupId.length; i++) {
				otPer = 0;

				id = groupId[i];
				idName = 'outTurnPer' + id;
				//otPerNa = $("#" + idName).val(0) ;
				otPer = $("#" + idName).val() || 0;
				//alert(otPer);

				allTotal = (parseFloat(allTotal) + parseFloat(otPer));

			}

			$('#total').val(allTotal);


			if (allTotal > 100) {
				alert('Total Out Turn % will not more then 100!!!');
				$("#submit").hide();
			} else if (allTotal < 100) {
				//alert('Total Out Turn % will not more then 333!!!');
				$("#submit").hide();
			} else {
				$("#submit").show();
			}

		});


		// for moisture %
		$('#ot_moisture').keyup(function() {
			//alert('Fajlami vvvv koro');
			var mmm = $("#ot_moisture").val();
			//alert(mmm);
			if (mmm >= 100) {
				Swal.fire({
					icon: 'error',
					title: 'Ops!!!!!!!!!',
					text: 'Please recheck the value',

				})
				$("#ot_moisture").val('');
			}
		});


		/* ================ Area id change condition - Rimon 25/09/22 ================ */
		defaultGradeInputDisable()

		function defaultGradeInputDisable() {
			var ot_ar_id = $('#ot_ar_id').find(":selected").val();
			var en_jute_variety = $('#en_jute_variety').attr("en_jute_variety");
			//alert(en_jute_variety);
			// Disable Input Field by Condition
			if (en_jute_variety == 'Normal' || en_jute_variety == 'White' || en_jute_variety == 'Knaf') {
				if (ot_ar_id == "4" || ot_ar_id == "5") { //ok
					disableInputFieldInConditionByAreaId([1, 2, 3, 5, 6]);
					enableInputFieldInConditionByAreaId([0, 4]);
				} else if (ot_ar_id == "1" || ot_ar_id == "2" || ot_ar_id == "3") {
					disableInputFieldInConditionByAreaId([5, 6]);
					enableInputFieldInConditionByAreaId([0, 1, 2, 3, 4]);
				} else {
					disableInputFieldInConditionByAreaId([0, 1, 2, 3, 4, 5, 6]);
				}
			} else {
				if (en_jute_variety == 'Cutting') { //ok
					disableInputFieldInConditionByAreaId([0, 1, 2, 3, 4, 6]);
					enableInputFieldInConditionByAreaId([5]);
					$("#ot_ar_id_div").hide();
				} else if (en_jute_variety == 'TW') { //ok
					disableInputFieldInConditionByAreaId([0, 1, 2, 3, 4, 5]);
					enableInputFieldInConditionByAreaId([6]);
					$("#ot_ar_id_div").hide();
				}
			}
			calculateTotalGradePercentage()
		}

		$("#ot_ar_id").change(function() {
			defaultGradeInputDisable()
			calculateTotalGradePercentage()

		});

		// Calculate Total Grade Percentage - Rimon - 27.09.22
		function calculateTotalGradePercentage() {
			var x = $('.outTurnPer').val();
			// alert(x);
			allTotal = 0;

			for (let i = 0; i < groupId.length; i++) {
				otPer = 0;

				id = groupId[i];
				idName = 'outTurnPer' + id;
				//otPerNa = $("#" + idName).val(0) ;
				otPer = $("#" + idName).val() || 0;
				//alert(otPer);

				allTotal = (parseFloat(allTotal) + parseFloat(otPer));

			}

			$('#total').val(allTotal);

			if (allTotal > 100) {
				alert('Total Out Turn % will not more then 100!!!');
				$("#submit").hide();
			} else if (allTotal < 100) {
				//alert('Total Out Turn % will not more then 333!!!');
				$("#submit").hide();
			} else {
				$("#submit").show();
			}
		}

		// Function For disable conditional input filed
		function disableInputFieldInConditionByAreaId(inputField) {
			for (let i = 0; i < inputField.length; i++) {
				// Clear input
				$(".readonly-input:eq(" + inputField[i] + ")").val('');
				// Readonly input
				$(".readonly-input:eq(" + inputField[i] + ")").prop("readonly", true);
			}
		}

		function enableInputFieldInConditionByAreaId(inputField) {
			for (let i = 0; i < inputField.length; i++) {
				// Clear input
				//$(".readonly-input:eq(" + inputField[i] + ")").val('');
				// Readonly input
				$(".readonly-input:eq(" + inputField[i] + ")").prop("readonly", false);
			}
		}
		/* ================ /.Area id change condition  ================ */





		//Check Jute Calculation Helper
		// var ot_ass_date = $('#ot_ass_date').val();
		// getJuteCalculationHelper(ot_ass_date);

		function getJuteCalculationHelper(ot_ass_date) {

			var [dd, mm, yyyy] = ot_ass_date.split("-");
			var splitDate = `${mm}-${dd}-${yyyy}`;
			var onlyYear = `${yyyy}`;
			//  Date to Month Name
			const dateObj = new Date(splitDate);
			const monthNameLong = dateObj.toLocaleString("en-US", {
				month: "long"
			});

			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/ajaxMonthlyJuteCalculationHelperCheck') ?>",
				data: {
					date: ot_ass_date,
				},
				success: function(data) {

					if (data == 'no') {
						Swal.fire({
							icon: 'error',
							title: 'Oops !!!!!!!!!!!!!',
							text: 'No Jute Calculation Helper found under this (' + monthNameLong + ' ' + onlyYear + ' ). Please, go to Godown Module and insert this (' + monthNameLong + ' ' + onlyYear + ') data.',
						});
						// $("#ot_ass_date").val('');
					}
					//else {
					//	$("#ot_ass_date").val(ot_ass_date);
					// alert(data);
					//}
				}

			});
		}

		// $("#ot_ass_date").on('change', function() {
		// 	date = $(this).val();
		// 	getJuteCalculationHelper(date);

		// });



		//Check Jute Rate
		// getJuteRate(ot_ass_date);

		function getJuteRate(ot_ass_date) {

			var [dd, mm, yyyy] = ot_ass_date.split("-");
			var splitDate = `${mm}-${dd}-${yyyy}`;
			var onlyYear = `${yyyy}`;
			//  Date to Month Name
			const dateObj = new Date(splitDate);
			const monthNameLong = dateObj.toLocaleString("en-US", {
				month: "long"
			});

			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/ajaxJuteRateCheck') ?>",
				data: {
					date: ot_ass_date,
				},
				success: function(data) {

					if (data == 'no') {
						Swal.fire({
							icon: 'error',
							title: 'Oops !!!!!!!!!!!!!',
							text: 'No Jute Rate found under this (' + monthNameLong + ' ' + onlyYear + ' ). Please, go to Jute Rate Module and add this month rate.',
						})
						// $("#ot_ass_date").val('');
					}
					// else {
					// 	$("#ot_ass_date").val(ot_ass_date);
					// 	// alert(data);
					// }
				}

			});
		}

		// $("#ot_ass_date").on('change', function() {
		// 	date = $(this).val();
		// 	getJuteRate(date);

		// });





	});
</script>