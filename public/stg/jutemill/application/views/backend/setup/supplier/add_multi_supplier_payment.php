 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-sm-6">
 					<h1>Add Supplier Payment</h1>
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
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('insert_multi_payment'); ?>" method="post" autocomplete="off">
 							<div class="card-body">
 								<div class="row mb-2">
 									<div class="col-sm-1">
 										<h5 class="mt-2">Date</h5>
 									</div>
 									<div class="col-sm-2">
 										<input type="text" name="sp_date" id="sp_date" class="form-control datepicker" style="width: 100px;" placeholder="" value='' required>
 										<input type="hidden" name="sp_fy_id" class="form-control" id="sp_fy_id" placeholder="" value=''>
 									</div>
 									<div class="col-sm-9">
 									</div>
 								</div>
 								<div class="row">
 									<table class="table table-striped table-bordered">
 										<tr>
 											<th>Supplier Name.</th>
 											<th>Bank Info</th>
 											<th>Paid By</th>
 											<th>Amount</th>
 											<th>Comments</th>
 										</tr>
 										<tbody id="addAssortedItem">
 											<tr>
 												<td>
 													<div class="form-group col-sm-12 ml-0">
 														<select class="form-control supplier_id select2" row_count='0' style="width:250px;" name="sp_s_id[]" id="supplier_id" required>
 															<option value="">Select Supplier</option>
 															<?php if ($suppliers) {
																	foreach ($suppliers->result() as $supplier) {
																		if ($supplier->s_sup_t_id == 1) { ?>
 																		<option value="<?= $supplier->s_id; ?>">
 																			<?= $supplier->s_title; ?></option>
 															<?php }
																	}
																} ?>
 														</select>
 														<span class="text-danger supplierResult" id="supplier_result0"></span>
 													</div>
 												</td>
 												<td><span id="bankBranch0"></span> </td>
 												<td>
 													<div class="form-group col-sm-6">
 														<select class="form-control select2" style="width: 150%;" name="sp_paid_by[]">
 															<option selected="Bank">Bank</option>
 															<option value="Cash">Cash</option>
 															<option value="Other">Other</option>
 														</select>
 													</div>
 												</td>
 												<td><input type="text" name="sp_amount[]" class="form-control amount" placeholder="" value='' required></td>
 												<td><input type="text" name="sp_reference[]" class="form-control" id="exampleInputEmail1" placeholder="Comments" value=''></td>
 											</tr>
 										</tbody>
 										<tr>
 											<th></th>
 											<th></th>
 											<th class="text-right">Grand Total TK =</th>
 											<th><span id="grandTotalAmount"></span></th>

 											<th></th>
 										</tr>
 									</table>
 									<input class="btn btn-info" id="addNewAssortedItem" name="add-new-item" value="Add New" type="button" style="margin: 0px 15px 15px;">
 								</div>
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
 	$(document).ready(function() {
 		var rowCount = 1;
 		$('#addNewAssortedItem').click(function() {
 			$.ajax({
 				url: "<?= base_url('setup/Supplier/clone_data'); ?>",
 				type: "post",
 				data: {
 					rowCount: rowCount
 				},
 				success: function(response) {
 					$('#addAssortedItem').append(response);
 				}
 			});
 			rowCount++;
 		});

 		// $(".input-number").keyup(function(e) {
 		$(document).on('keyup', '.input-number', function(e) {
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

 		// ============= row delete dynamically =========
 		// function deleteRow(t) {
 		$(document).on('click', '.deleteRow', function() {
 			var row_count = $(this).attr('row_count');
 			// alert(row_count);
 			$(`#row_${row_count}`).remove();
 		});
 		//automatic get financial year id
 		var sp_date = $('#sp_date').val();
 		//getFy(sp_date);

 		function getFy(sp_date) {
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url('setup/Supplier/ajaxFinancialYearForSupplierPayment') ?>",
 				data: {
 					sp_date: sp_date,
 				},
 				success: function(data) {

 					if (data == 'no') {
 						Swal.fire({
 							icon: 'error',
 							title: 'Ops !!!!!!!!!!!!!',
 							text: 'No Financial Year found under this (' + sp_date +
 								') date ',
 						})
 						$("#sp_date").val('');
 						$("#sp_fy_id").val('');
 					} else {
 						$("#sp_fy_id").val(data);
 					}
 				}
 			});
 		}
 		$("#sp_date").on('change', function() {
 			sp_date = $(this).val();
 			getFy(sp_date);

 		});
 		//END automatic get financial year id

 		// $("#supplier_id").on("change", function() {
 		$(document).on("change", '.supplier_id', function() {
 			var row_count = $(this).attr('row_count');
 			var supplier_id = $(this).val();
 			var resultFalse = 0;
 			var allSupplierId = $('.supplier_id').map((_, el) => el.value).get()
 			var allSupplierId = allSupplierId.sort();

 			for (var i = 0; i < allSupplierId.length - 1; i++) {
 				if (allSupplierId[i + 1] == allSupplierId[i]) {
 					resultFalse += 1;
 				}
 			}

 			if (resultFalse == 0) {
 				$('.supplierResult').html('');
 				$.ajax({
 					url: "<?= base_url('setup/Supplier/get_supplier_id_json'); ?>",
 					type: "post",
 					dataType: 'json',
 					data: {
 						supplier_id: supplier_id
 					},
 					success: function(supData) {
 						//console.log(supData);
 						if (parseInt(supData[0].s_b_id) != 0) {
 							$(`#bankBranch${row_count}`).text(`${supData[0].s_ac_name} - ${supData[0].s_ac_number} - ${supData[1].b_title} - ${supData[2].bb_title}`);
 						} else {
 							$(`#bankBranch${row_count}`).text('N/A');
 						}
 					}
 				});
 			} else {
 				$(`#supplier_result${row_count}`).html("<i class='fas fa-times'></i> This Supplier Already exist");
 			}
 		});

 		$(document).on('keyup change', '.amount', function(event) {
 			var sum = 0;
 			$('.amount').each(function() {
 				var amount = $(this).val();
 				if (amount != '') {
 					amount = parseFloat(amount.replace(/,/g, ''));
 					sum += parseFloat(amount);
 				}
 			});
 			var amountVal = $(this).val();
 			if (amountVal != '') {
 				amountVal = parseFloat(amountVal.replace(/,/g, ''));
 				$(this).val(parseFloat(amountVal).toLocaleString());
 			}
 			$('#grandTotalAmount').text(sum.toLocaleString());
 		});
 	});
 </script>