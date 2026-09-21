<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">

			<?php
			$invoiceApprovalRunningQuantity = $this->Common->count_all_result('jute_purchase_invoice_summary', ['jpis_user_serially_approval_status >' => 0, 'jpis_approve_status' => 0, 'jpis_status' => 1]);
			if ($invoiceApprovalRunningQuantity) {
			?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-warning alert-dismissible mt-3 mb-0">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><i class="icon fas fa-exclamation-triangle"></i>Warning!</h5>
							May be some jute purchase invoice approval running. So, you can't add new or
							delete approval user from here. After approval successfully running invoice, you will be able action from here.
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="row">
				<div class="col-md-8">
					<div class="card card-primary card-outline mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> Jute Purchase Invoice Approval User Setup</h3>
						</div>
						<div class="card-body">
							<?= alert_check() ?>
							<!-- form start -->
							<form role="form" action="<?php echo base_url('update_jute_purchase_invoice_approval') ?>" method="post" autocomplete="off">
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>SL No</th>
												<th>User Name</th>
												<th>Designation</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody id="page_list">
											<?php

											foreach ($invoice_approval_jute_purchase_list as $list) { ?>
												<tr>
													<td>
														<input type="hidden" name="iajp_user_id[]" value="<?= $list->iajp_user_id ?>">
														<?= $list->iajp_approval_status ?>
													</td>
													<td><?php $userInfo = $this->Common->get_single_row_information('authority', 'a_id', $list->iajp_user_id);
														if ($userInfo) {
															echo $userInfo->a_name;
														}
														?></td>
													<td><?php
														if ($userInfo->a_type == 101) {
															echo "Security Department Head";
														};
														if ($userInfo->a_type == 102) {
															echo "Security Department Operator";
														};

														if ($userInfo->a_type == 201) {
															echo "Weight Department Head";
														};
														if ($userInfo->a_type == 202) {
															echo "Weight Department Operator";
														};

														if ($userInfo->a_type == 301) {
															echo "Jute Department Head";
														};
														if ($userInfo->a_type == 302) {
															echo "Jute Department Operator";
														};

														if ($userInfo->a_type == 401) {
															echo "Accounts Department Head";
														};
														if ($userInfo->a_type == 402) {
															echo "Accounts Department Operator";
														};

														if ($userInfo->a_type == 501) {
															echo "Production Department Head";
														};
														if ($userInfo->a_type == 502) {
															echo "Production Department Operator";
														};

														if ($userInfo->a_type == 601) {
															echo "Authority General Manager";
														};
														if ($userInfo->a_type == 602) {
															echo "Authority Shareholder";
														};
														if ($userInfo->a_type == 603) {
															echo "Authority System Administrator";
														}; ?></td>
													<td>
														<?php if ($invoiceApprovalRunningQuantity) { ?>
															<span type="button" class="btn btn-danger invoiceRunningAlert"><i class="fa fa-trash" aria-hidden="true"></i> Remove</span>
														<?php } else { ?>
															<a type="button" href="<?php echo base_url(); ?>delete_jute_purchase_invoice_approval?iajp_id=<?= $list->iajp_id ?>" onclick="return confirm('Are you sure want to delete this?');" class="btn btn-danger deleteButton"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
														<?php } ?>

													</td>
												</tr>
											<?php } ?>

										</tbody>
									</table>
								</div>
								<div class="row">
									<table class="table table-borderless">
										<tr>
											<td>
												<?php if ($invoiceApprovalRunningQuantity) { ?>
													<span class="btn btn-primary btn-block invoiceRunningAlert"> Update</span>
												<?php } else { ?>
													<button type="submit" onclick="return confirm('Are you sure want to update this?');" class="btn btn-primary btn-block">Update</button>
												<?php } ?>
											</td>
										</tr>
									</table>
								</div>
							</form>
							<!-- form end -->
						</div>
					</div>
					<!-- /.card -->
				</div>




				<div class="col-md-4">
					<div class="card card-primary card-outline mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> Jute Purchase Invoice Approval User</h3>
						</div>
						<!-- form start -->
						<form role="form" action="<?php echo base_url('insert_jute_purchase_invoice_approval') ?>" method="post" autocomplete="off">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-12">
										<label>Select user for purchase invoice approval </label>
										<span class="text-danger">*</span>
										<select class="form-control select2" style="width: 100%;" name="iajp_user_id" required>
											<option value="">Please Select User </option>
											<?php if ($authority_list) {
												foreach ($authority_list as $authorities) {
													if ($authorities->a_type != 1 && $authorities->a_type != 10) {
														$userInformation = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_user_id' => $authorities->a_id, 'iajp_status' => 1]);

														if ($userInformation->iajp_user_id != $authorities->a_id) {
											?>
															<option value="<?= $authorities->a_id; ?>"><?= $authorities->a_name; ?> - <?= $authorities->a_type; ?></option>
											<?php }
													}
												}
											} ?>
										</select>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<div class="pull-right">

									<?php if ($invoiceApprovalRunningQuantity) { ?>
										<span class="btn btn-primary btn-block invoiceRunningAlert"> Submit</span>
									<?php } else { ?>
										<button type="submit" class="btn btn-primary btn-block">Submit</button>
									<?php } ?>
								</div>
							</div>
						</form>
						<!-- /End Form -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$("#page_list").sortable({
			placeholder: "ui-state-highlight",
			update: function(event, ui) {
				var page_id_array = new Array();
				$('#page_list tr').each(function() {
					page_id_array.push($(this).attr("id"));
					// console.log(page_id_array);
				});
			}
		});



		// Button Disable if there is 1 row
		$(".deleteButton").on('click', function() {
			deleteButtonDisable();
		});

		deleteButtonDisable();

		function deleteButtonDisable() {
			var rowCount = $('#page_list tr').length;

			if (rowCount < 3) {
				$('.deleteButton').hide()
			} else {
				$('.deleteButton').show();
			}
		}



		// If invoice approval running then click show alert
		$(".invoiceRunningAlert").click(function() {
			Swal.fire({
				icon: 'info',
				title: 'Oops...',
				text: "May be some jute purchase invoice approval running. So, you can't add new or delete approval user from here. After approval successfully running invoice you will be able action from here.",
			})
		});

	});
</script>