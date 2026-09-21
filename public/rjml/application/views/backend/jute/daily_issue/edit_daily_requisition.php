<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Update Daily Requisition</h1>
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
						<li class="breadcrumb-item active">Daily Requisition</li>
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
							<h3 class="card-title"><i class="fa fa-edit"></i> Update Daily Requisition</h3>
						</div>
						<form role="form" action="<?php echo base_url('update_daily_requisition') ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
							<div class="card-body">
								<div class="row">
									<div class="form-group px-0 col-sm-4">
										<label for="exampleInputEmail1">SL No.</label>
										<input type="number" name="" class="form-control" id="exampleInputEmail1" placeholder="Enter sl no." value="<?php if ($reValueById) {
																																						echo $reValueById->res_sl_no;
																																					} ?>" readonly>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Production Unit</label>
										<input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value="<?php echo $this->M_production_unit->getProductionUnitById($reValueById->res_pu_id)->pu_title ?>" readonly>
									</div>
									<div class="form-group col-sm-4">
										<label for="exampleInputEmail1">Date</label>
										<input type="text" name="rev_date" id="rev_date" class="form-control datepicker" value="<?php if ($reValueById) {
																																	echo date("d-m-Y", strtotime($reValueById->res_date));
																																} ?>">
										<input type="hidden" name="rev_fy_id" class="form-control" id="rev_fy_id" placeholder="" value=''>
									</div>
								</div>
								<div class="row">
									<table id="" class="table table-striped">
										<tr>
											<?php if ($areas) foreach ($areas->result() as $area) { ?>
												<th colspan="2" class=""><?= $area->ar_title ?></th>
											<?php } ?>
										</tr>
										<tr>
											<?php if ($areas) foreach ($areas->result() as $area) { ?>
												<th>Grade</th>
												<th>Requisition</th>
											<?php } ?>
										</tr>
										<?php if ($jute_grades) {
											foreach ($jute_grades->result() as $grade) { ?>
												<tr>
													<?php if ($areas) {
														foreach ($areas->result() as $area) { ?>
															<td>
																<?= $grade->j_g_title ?>
																<input type="hidden" name="" class="form-control" id="exampleInputEmail1" placeholder="" value="<?= $grade->j_g_id ?>">
															</td>
															<td>
																<input type="hidden" name="rev_requisition_id[]" class="form-control" value="<?= getSingleRequisitionValueId($grade->j_g_id, $area->ar_id, $requisitionSummaryId); ?>">
																<input type="text" name="rev_requisition[]" class="form-control input-number rev_requisition <?= $area->ar_title ?>" id="rev_requisition<?= $grade->j_g_id ?><?= $area->ar_id ?>" placeholder="<?= $area->ar_title ?>_<?= $grade->j_g_title ?>_Requisition" value="<?= getRequisitionValue($grade->j_g_id, $area->ar_id, $requisitionSummaryId); ?>">
															</td>
													<?php }
													} ?>
												</tr>
										<?php }
										} ?>
										<!-- Total Requisition Count -->
										<tr>
											<?php if ($areas) foreach ($areas->result() as $area) {
											?>
												<td>Total</td>
												<td>
													<input type="text" name="" class="form-control Total<?= $area->ar_title ?>" id="total" placeholder="Total_<?= $area->ar_title ?>_<?= $grade->j_g_title ?>_Requisition" value="" readonly>
												</td>
											<?php }
											?>
										</tr>
									</table>
								</div>

								<div class="row">
									<div class="col-sm-4">
										<!-- <table>
											<tr>
												<td>WH-1</td>
												<td></td>
												<input type="hidden" name="wh" value="wh">
												<td>
													<input type="hidden" name="rev_wh_value_id" class="form-control" value="<//?= getSingleRequisitionValueId("wh", "wh", $requisitionSummaryId); ?>">
													<input type="text" name="wh_value" class="form-control rev_requisition" id="whV" placeholder="" value="<//?= getRequisitionValue("wh", "wh", $requisitionSummaryId); ?>">
												</td>
											</tr>
										</table> -->
									</div>
									<div class="col-sm-4">
										<!-- <table>
											<tr>
												<td>KF-1</td>
												<td></td>
												<input type="hidden" name="kf" value="kf">
												<td>
													<input type="hidden" name="rev_kf_value_id" class="form-control" value="<//?= getSingleRequisitionValueId("kf", "kf", $requisitionSummaryId); ?>">
													<input type="text" name="kf_value" class="form-control rev_requisition" id="kfV" placeholder="" value="<//?= getRequisitionValue("kf", "kf", $requisitionSummaryId); ?>">
												</td>
											</tr>
										</table> -->
									</div>
									<div class="col-sm-2 text-right">
										<h3>Grand Total: </h3>
									</div>
									<div class="col-sm-2">
										<input type="text" name="res_total_requisition" class="form-control font-weight-bold" id="grandTotalPerRequisition" placeholder="Total Requisition" value="<?php if ($reValueById) {
																																																		echo $reValueById->res_total_requisition;
																																																	} ?>" readonly>
									</div>

								</div>


								<input type="hidden" name="rev_id" value="<?php if ($reValueById) {
																				echo $reValueById->res_id;
																			} ?>">
							</div>
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
<script type="text/javascript">
	// Grand Total Requisition Sum
	$(document).ready(function() {


		var groupId = []
		var areaId = []
		<?php foreach ($areas->result() as $area) {
		?>
			areaId.push('<?= $area->ar_title ?>')

			<?php foreach ($jute_grades->result() as $grade) {
			?>
				groupId.push('<?= $grade->j_g_id ?><?= $area->ar_id ?>')
			<?php } ?>
		<?php } ?>

		$(".rev_requisition").keyup(function() {
			allTotal = 0;
			for (let i = 0; i < groupId.length; i++) {
				revPer = 0;
				id = groupId[i];
				idName = 'rev_requisition' + id;
				console.log(idName);
				revPer = $("#" + idName).val() || 0;
				allTotal = (parseFloat(allTotal) + parseFloat(revPer));

				//for area wise calculation
				for (let k = 0; k < areaId.length; k++) {
					areaTittle = areaId[k];
					var alpha = 0;
					$("." + areaTittle).each(function(i, obj) {
						console.log(alpha);
						if ($(this).val()) {
							var e = $(this).val();
						} else {
							var e = 0;
						}

						alpha = parseFloat(e) + parseFloat(alpha);

					});
					var tittleSum = 'Total' + areaTittle;
					$("." + tittleSum).val(alpha);
				}

			}
			whV = $("#whV").val() || 0;
			allTotal = (parseFloat(allTotal) + parseFloat(whV));
			kfV = $("#kfV").val() || 0;
			allTotal = (parseFloat(allTotal) + parseFloat(kfV));

			//alert(whV);

			$('#grandTotalPerRequisition').val(allTotal);
		});



		//automatic get financial year id
		var rev_date = $('#rev_date').val();
		getFy(rev_date);

		function getFy(rev_date) {
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Daily_issue/ajaxFinancialYearForDailyJuteRequisition') ?>",
				data: {
					rev_date: rev_date,
				},
				success: function(data) {

					if (data == 'no') {
						Swal.fire({
							icon: 'error',
							title: 'Ops !!!!!!!!!!!!!',
							text: 'No Financial Year found under this (' + rev_date + ') date ',
						})
						$("#rev_date").val('');
						$("#rev_fy_id").val('');
					} else {
						$("#rev_fy_id").val(data);
						//  alert(data);
					}
				}
			});
		}
		$("#rev_date").on('change', function() {
			rev_date = $(this).val();
			getFy(rev_date);

		});
		//END automatic get financial year id




	});
</script>