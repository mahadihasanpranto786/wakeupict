<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Add New Out Turn Reports</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<!-- <li class="breadcrumb-item"><a href="<?php
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
						<li class="breadcrumb-item active">Add New Out Turn Reports</li> -->
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
							<h3 class="card-title"> <i class="fa fa-plus-circle"></i> Out Turn Report</h3>
						</div>
						<!-- form start -->
						<form role="form" id="myForm" action="<?php echo base_url(); ?>jute/Entry/insertOutTurnReport" method="post" autocomplete="off">
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
										<select class="form-control select2" style="width: 100%;" id="ot_en_id" name="ot_en_id" required>
											<option value="">Please Select Lot Number</option>
											<?php if ($entry_ides) {
												$serial = 0;
												foreach ($entry_ides as $en_id) {
													$serial++;
													$lot = $this->M_jute_entry->getJuteEntryById($en_id);
											?>
													<option value="<?= $lot->en_id ?>"><?= $lot->en_lot_no ?></option>
											<?php
												}
											}
											?>
										</select>

									</div>
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">Net Weight <span class="text-danger">(KG)</span> </label>
										<input type="text" name="ot_net_weight" class="form-control input-number" id="ot_net_weight" placeholder="Enter Net Weight" required>
									</div>
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">KGs (After .5% Deduction)</label>
										<input type="text" name="ot_kgs" class="form-control" id="ot_kgs" placeholder="KGs (After .5% Deduction)" readonly>
									</div>
									<div class="form-group col-sm-3">
										<label for="exampleInputEmail1">Mds</label>
										<input type="text" name="ot_mds" class="form-control" id="ot_mds" placeholder="Enter Mds" readonly>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Entry Date</label>
										<input type="text" name="" class="form-control" id="en_date" readonly>
									</div>
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Assessment Date</label>
										<input type="text" name="ot_ass_date" class="form-control datepicker" id="ot_ass_date" value="<?= get_current_time_time(); ?>" required>
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
													<option value="<?= $area->ar_id ?>"><?= $area->ar_title ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Received Bojha/Bale</label>
										<input type="text" name="ot_rec_bojha" class="form-control input-number" id="exampleInputEmail1" placeholder="Received Bojha/Bale" required>
									</div>
									<div class="form-group col-sm-2">
										<label>New/Old</label>
										<select class="form-control select2" style="width: 100%;" name="ot_jute_type" required>
											<option value="">Select Jute Type</option>
											<option value="new">NEW</option>
											<option value="old">OLD</option>
										</select>
									</div>
									<div class="form-group col-sm-2">
										<label for="exampleInputEmail1">Moisture %</label>
										<input type="text" name="ot_moisture" class="form-control input-number" id="ot_moisture" placeholder="Enter Moisture %" required>
									</div>
								</div>

								<div class="row mt-1">
									<h5 class="mx-auto">Out Turn (%) </h5>
									<h5>[ Verity: <span class="text-danger" id="en_jute_variety"></span>]</h5>
								</div>
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
														<input type="text" name="outTurnPer[]" class="form-control outTurnPer input-number readonly-input" id="outTurnPer<?= $grade->j_g_id ?>" placeholder="Enter <?= $grade->j_g_title ?> %" value=''>
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
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" class="btn btn-info" id="submit">Submit</button>
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
		$("#submit").hide();

		$(".outTurnPer").keyup(function() {
			calculateTotalGradePercentage()
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

		$("#ot_en_id").change(function() {
			var ot_en_id = $('#ot_en_id').find(":selected").val();
			// alert(ot_en_id);
			//var en_fy_id = $('#en_fy_id').val();
			//alert(ot_en_id);

			$("#total").val('');

			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/ajaxAreaId') ?>",
				data: {
					ot_en_id: ot_en_id,

				},
				success: function(data) {
					var data = JSON.parse(data) //json to javascript object

					console.log(data);
					$('#ot_ar_id').val(data.mo_ar_id).trigger('change');
					$('#ot_ar_id_hh').val(data.mo_ar_id);
					$('#en_date').val(data.en_datetime);

					$('#en_jute_variety').text(data.en_jute_variety);

					// Disable Input Field by Condition
					if (data.en_jute_variety == 'Cutting') { //ok
						disableInputFieldInCondition([0, 1, 2, 3, 4, 6]);
						enableInputFieldInCondition([5]);
						$("#ot_ar_id_div").hide();
					} else if (data.en_jute_variety == 'TW') { //ok
						disableInputFieldInCondition([0, 1, 2, 3, 4, 5]);
						enableInputFieldInCondition([6]);
						$("#ot_ar_id_div").hide();
					} else if (data.mo_ar_id == "4" || data.mo_ar_id == "5") { //ok
						disableInputFieldInCondition([1, 2, 3, 5, 6]);
						enableInputFieldInCondition([0, 4]);
						$("#ot_ar_id_div").show();
					} else if (data.en_jute_variety == 'Normal' && data.mo_ar_id == "1" || data.mo_ar_id == "2" || data.mo_ar_id == "3") {
						disableInputFieldInCondition([5, 6]);
						enableInputFieldInCondition([0, 1, 2, 3, 4]);
						$("#ot_ar_id_div").show();
					} else {
						disableInputFieldInCondition([0, 1, 2, 3, 4, 5, 6]);
						$("#ot_ar_id_div").show();
					}

					getJuteCalculationHelper(data.en_date);
					getJuteRate(data.en_date);
					calculateTotalGradePercentage()


				}
			});
		});

		// Function For disable conditional input filed
		function disableInputFieldInCondition(inputField) {
			for (let i = 0; i < inputField.length; i++) {
				// Clear input
				$(".readonly-input:eq(" + inputField[i] + ")").val('');
				// Readonly input
				$(".readonly-input:eq(" + inputField[i] + ")").prop("readonly", true);
			}
		}

		// Function For enable conditional input filed
		function enableInputFieldInCondition(inputField) {
			for (let i = 0; i < inputField.length; i++) {
				// Clear input
				$(".readonly-input:eq(" + inputField[i] + ")").val('');
				// Readonly input
				$(".readonly-input:eq(" + inputField[i] + ")").prop("readonly", false);
			}
		}


		/* ================ Area id change condition - Rimon 25/09/22 ================ */
		$("#ot_ar_id").change(function() {
			var ot_ar_id = $('#ot_ar_id').find(":selected").val();
			// alert(ot_ar_id);

			//$("#total").val('');


			// Disable Input Field by Condition
			if (ot_ar_id == "4" || ot_ar_id == "5") { //ok
				disableInputFieldInConditionByAreaId([1, 2, 3, 5, 6]);
				enableInputFieldInConditionByAreaId([0, 4]);
			} else if (ot_ar_id == "1" || ot_ar_id == "2" || ot_ar_id == "3") {
				disableInputFieldInConditionByAreaId([5, 6]);
				enableInputFieldInConditionByAreaId([0, 1, 2, 3, 4]);
			} else {
				disableInputFieldInConditionByAreaId([0, 1, 2, 3, 4, 5, 6]);
			}
			calculateTotalGradePercentage()

		});

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

		function getJuteCalculationHelper(ot_en_date) {



			var [dd, mm, yyyy] = ot_en_date.split("-");
			var splitDate = `${mm}-${dd}-${yyyy}`;
			// alert(splitDate)
			var onlyYear = `${yyyy}`;
			// alert(onlyYear)
			//  Date to Month Name
			const dateObj = new Date(splitDate);
			const monthNameLong = dateObj.toLocaleString("en-US", {
				month: "long"
			});

			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/ajaxMonthlyJuteCalculationHelperCheck') ?>",
				data: {
					date: ot_en_date,
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
				}

			});
		}

		// $("#ot_ass_date").on('change', function() {
		// 	date = $(this).val();
		// 	getJuteCalculationHelper(date);

		// });





		/* ========================== Check Jute Rate ========================== */
		// getJuteRate(ot_ass_date);

		function getJuteRate(ot_en_date) {

			// alert(ot_en_date)

			var [dd, mm, yyyy] = ot_en_date.split("-");
			var splitDate = `${mm}-${dd}-${yyyy}`;
			var dMY = `${dd}-${mm}-${yyyy}`;
			var onlyYear = `${yyyy}`;
			// alert(splitDate) 
			//  Date to Month Name
			const dateObj = new Date(splitDate);
			const monthNameLong = dateObj.toLocaleString("en-US", {
				month: "long"
			});

			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/ajaxJuteRateCheck') ?>",
				data: {
					date: ot_en_date,
				},
				success: function(data) {
					console.log(data)
					if (data == 'no') {
						Swal.fire({
							icon: 'error',
							title: 'Oops !!!!!!!!!!!!!',
							text: 'No Jute Rate found under this ( ' + dMY + ' ). Please, go to Jute Rate Module and add this month rate.',
						});
						$("select#ot_en_id")[0].selectedIndex = 0;
						$('#ot_en_id').trigger('change');
					} else {
						// $("#ot_ass_date").val(ot_ass_date);
						// alert(data);
					}
				}

			});
		}

		// $("#ot_ass_date").on('change', function() {
		// 	date = $(this).val();
		// 	getJuteRate(date);

		// });





		$('#myForm').one('submit', function() {
			$(this).find('button[type="submit"]').attr('disabled', 'disabled');
		});
	});
</script>