<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> User Forgot Password Request List</h3>
						</div>
						<div class="card-body">
							<?= alert_check() ?>
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>SL No</th>
											<th>Image</th>
											<th>Requested At</th>
											<th>Name</th>
											<th>Mobile</th>
											<th>Email</th>
											<th>Type</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($authority_list) {
											$serial = 0;
											foreach ($authority_list as $key => $list) {
												$serial++;
										?>
												<tr class="">
													<td><?= $serial; ?></td>
													<td><img src="<?php echo base_url(''); ?>./assets/uploads/users/<?= $list->a_img ?>" class="img-rounded" width="40px" height="40px" alt="Img"></td>
													<td><?= date("d-m-Y h:i A", strtotime($list->a_forgot_password_request_at)); ?></td>
													<td><?= $list->a_name; ?></td>
													<td><?= $list->a_credential; ?></td>
													<td><?= $list->a_email; ?></td>
													<td><?php
														if ($list->a_type == 101) {
															echo "Security Department Head";
														};
														if ($list->a_type == 102) {
															echo "Security Department Operator";
														};

														if ($list->a_type == 201) {
															echo "Weight Department Head";
														};
														if ($list->a_type == 202) {
															echo "Weight Department Operator";
														};

														if ($list->a_type == 301) {
															echo "Jute Department Head";
														};
														if ($list->a_type == 302) {
															echo "Jute Department Operator";
														};

														if ($list->a_type == 401) {
															echo "Accounts Department Head";
														};
														if ($list->a_type == 402) {
															echo "Accounts Department Operator";
														};

														if ($list->a_type == 501) {
															echo "Production Department Head";
														};
														if ($list->a_type == 502) {
															echo "Production Department Operator";
														};

														if ($list->a_type == 601) {
															echo "Authority General Manager";
														};
														if ($list->a_type == 602) {
															echo "Authority Shareholder";
														};
														if ($list->a_type == 603) {
															echo "Authority System Administrator";
														}; ?></td>
													<td>
														<a onclick="return confirm('Are you sure want to approve this password change request?');" href="<?php echo base_url(); ?>approve_forgot_password_request?a_id=<?= $list->a_id ?>&&a_forgot_password_code=<?= $list->a_forgot_password_code ?>">
															<button type='button' class='btn btn-warning btn-sm m-1 ' title="Approve New Password">
																<i class="fas fa-stroopwafel fa-spin"></i> Approve Request
															</button>
														</a>

													</td>
												</tr>
										<?php }
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>