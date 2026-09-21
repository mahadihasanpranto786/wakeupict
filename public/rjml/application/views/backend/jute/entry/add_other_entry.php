<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="card card-info mt-3">
						<div class="card-header">
							<h3 class="card-title">Add New Entry</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="<?php echo base_url(); ?>jute/Entry/insertJuteEntry" method="post">
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Financial year</label>
											<select id="en_fy_id" class="form-control select2" style="width: 100%;" name="en_fy_id" required>
												<?php
												if ($financial_years) {
													foreach ($financial_years->result() as $financial_year) {
												?>
														<option value="<?= $financial_year->fy_id ?>"><?= $financial_year->fy_title ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="">Entry Date</label>
											<input value="<?= get_current_time_time(); ?>" required name="en_date" class="form-control datepicker" type="text">

										</div>
										<div class="form-group">
											<label for="">Mill Lot No</label>
											<input type="text" name="en_lot_no" class="form-control" id="" value="<?= getLotNumberCount(); ?>" placeholder="Enter Mill Lot No">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Name of Supplier</label>
											<select class="form-control select2 supplier" style="width: 100%;" name="en_s_id" required>
												<option value="">Select Supplier</option>
												<?php if ($suppliers) {
													foreach ($suppliers->result() as $supplier) {
												?>
														<option value="<?= $supplier->s_id ?>"><?= $supplier->s_title ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="">Party Chalan No</label>
											<input type="text" name="en_chalan_no" class="form-control" id="suplierPartyChalan" placeholder="Enter Party Chalan No" readonly>
										</div>
										<div class="form-group">
											<label>Mokam</label>
											<select id="mokam" class="form-control select2" style="width: 100%;" name="en_mo_id" required>
												<option value="">Select Mokam</option>
												<?php if ($mokams) {
													foreach ($mokams->result() as $mokam) {
												?>
														<option value="<?= $mokam->mo_id ?>"><?= $mokam->mo_title ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Truck Number</label>
											<input type="text" name="en_truck_no" class="form-control" id="en_truck_no" placeholder="Ex: Rajbari - Ga - 007">
										</div>
										<div class="form-group">
											<label for="">Driver Name</label>
											<input type="text" name="en_td_name" class="form-control" id="" placeholder="Driver Name">
										</div>
										<div class="form-group">
											<label>Area</label>
											<select class="form-control select2" style="width: 100%;" name="en_mo_id" required>
												<option value="">Select Area</option>
												<?php if ($mokams) {
													foreach ($mokams->result() as $mokam) {
												?>
														<option value="<?= $mokam->mo_id ?>"><?= $mokam->mo_title ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Chalan Bojha/Bale</label>
											<input type="number" name="en_bojha_bale" class="form-control" id="bale" placeholder="Enter Chalan Bojha/Bale" required>
										</div>
										<div class="form-group">
											<label for="">Bojha/Bale Weight</label>
											<input type="number" name="en_bojha_weight" class="form-control" id="baleW" placeholder="Enter Bojha/Bale Weight" required>
										</div>
										<div class="form-group">
											<label for="">Net Weight</label>
											<input type="text" name="en_net_weight" class="form-control" id="nw" placeholder="" value="" readonly>
										</div>
										<div class="form-group">
											<label for="">Mds</label>
											<input type="text" name="en_net_mds" class="form-control" id="en_net_mds" placeholder="" value="" readonly>
										</div>

									</div>
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
	$('#bale, #baleW').change(function() {
		var bale = parseFloat($('#bale').val()) || 0;
		var baleW = parseFloat($('#baleW').val()) || 0;
		$('#nw').val(bale * baleW);
		$('#en_net_mds').val(bale * baleW / 40);
	});


	$(document).ready(function() {
		$(".supplier").change(function() {
			var supplierId = $('.supplier').find(":selected").val();
			var en_fy_id = $('#en_fy_id').find(":selected").val();
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/ajaxSuplierPartyChalan') ?>",
				data: {
					supplierId: supplierId,
					en_fy_id: en_fy_id,

				},
				success: function(data) {
					$("#suplierPartyChalan").val(data);
				}

			});



		});
		$("#en_fy_id").change(function() {
			var supplierId = $('.supplier').find(":selected").val();
			var en_fy_id = $('#en_fy_id').find(":selected").val();
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('jute/Entry/ajaxSuplierPartyChalan') ?>",
				data: {
					supplierId: supplierId,
					en_fy_id: en_fy_id,

				},
				success: function(data) {
					$("#suplierPartyChalan").val(data);
				}

			});
		});


	});
</script>