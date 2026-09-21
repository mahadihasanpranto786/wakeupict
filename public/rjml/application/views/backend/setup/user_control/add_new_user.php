<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card card-success mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> User List</h3>
						</div>
						<div class="card-body">
							<?= alert_check() ?>
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>SL No</th>
											<th>Image</th>
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
												if ($list->a_type != 1 && $list->a_type != 10) {
													$serial++;
										?>
													<tr class="<?php echo ($list->a_status == 2) ? "bg-warning" : false; ?>">
														<td class="align-middle"><?= $serial; ?></td>
														<td class="align-middle"><img src="<?php echo base_url(''); ?>./assets/uploads/users/<?= $list->a_img ?>" class="img-rounded" width="40px" height="40px" alt="Img"></td>
														<td class="align-middle"><?= $list->a_name; ?></td>
														<td class="align-middle"><?= $list->a_credential; ?></td>
														<td class="align-middle"><?= $list->a_email; ?></td>
														<td class="align-middle">
															<?php
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
														<td class="align-middle">
															<?php if ($list->a_status == 1) { ?>
																<button type="button" data-id="<?= $list->a_id; ?>" data-password="<?= $list->a_password; ?>" data-type="<?= $list->a_type; ?>" data-name="<?= $list->a_name; ?>" data-email="<?= $list->a_email; ?>" data-address="<?= $list->a_address; ?>" data-mobile="<?= $list->a_credential; ?>" data-img="<?= $list->a_img; ?>" class="btn btn-primary btn-sm editButton" title="Update User"><i class='fas fa-user-edit'></i></button>
																<a class="deleteBySweetAlert" href="<?php echo base_url(); ?>delete_user?a_id=<?= $list->a_id ?>">
																	<button type='button' class='btn bg-danger btn-sm m-1 <?php echo ($this->session->userdata('currentActiveId') == $list->a_id) ? "d-none" : false; ?>' title="Delete User">
																		<i class="fas fa-trash"></i>
																	</button>
																</a>
															<?php } else { ?>
																<button class="btn btn-info btn-sm m-1">Inactive User</button>
															<?php } ?>

															<?php if ($list->a_status == 1) { ?>
																<a onclick="return confirm('Are you sure you want to inactive this user?');" href="<?php echo base_url(); ?>inactive_user?a_id=<?= $list->a_id ?>">
																	<button type='button' class='btn bg-warning btn-sm m-1 <?php echo ($this->session->userdata('currentActiveId') == $list->a_id) ? "d-none" : false; ?>' title="Inactive User">
																		<i class="fa fa-arrow-down" aria-hidden="true"></i>
																	</button>
																</a>
															<?php } elseif ($list->a_status == 2) { ?>
																<a onclick="return confirm('Are you sure you want to active this user?');" href="<?php echo base_url(); ?>active_user?a_id=<?= $list->a_id ?>">
																	<button type='button' class='btn bg-success btn-sm m-1' title="Click Button to Active User">
																		<i class="fa fa-arrow-up" aria-hidden="true"></i>
																	</button>
																</a>
															<?php } ?>
														</td>
													</tr>
										<?php }
											}
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-plus-circle"></i> Add New User</h3>
						</div>
						<form role="form" action="<?php echo base_url('insert_user'); ?>" method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Name</label>
										<span class="text-danger">*</span>
										<input type="text" name="a_name" class="form-control" id="" placeholder="Enter Name" required>
									</div>
									<div class="form-group col-sm-12">
										<label>User Type</label>
										<span class="text-danger">*</span>
										<select class="form-control select2" style="width: 100%;" id="" name="a_type" required>
											<option value="">Pease Select User Type</option>
											<?php
											if (userType()) {
												foreach (userType() as $key => $value) {
											?>
													<option value="<?php echo $key; ?>">
														<?php echo $value;
														?></option>
											<?php }
											} ?>
										</select>
									</div>
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Email</label>
										<input type="email" name="a_email" class="form-control" id="" placeholder="Enter Email">
									</div>
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Address</label>
										<span class="text-danger">*</span>
										<input type="text" name="a_address" class="form-control" id="" placeholder="Enter Address" required>
									</div>
									<div class="form-group col-sm-12">
										<label for="exampleInputEmail1">Mobile</label>
										<span class="text-danger">*</span><span class="text-primary">(Enter 11 digit mobile number.)</span>
										<input type="text" name="a_mobile" class="form-control input-number" id="mobileNumber" placeholder="Enter Mobile" required>
										<span id="mobile_number_validation"></span>
									</div>

									<div class="form-group col-sm-12">
										<label>Password</label>
										<span class="text-danger">*</span><span class="text-primary">(Enter password between 1 to 6 character.)</span>
										<div class="input-group" id="show_hide_password">
											<input type="password" name="a_key" class="form-control removeWhiteSpace" placeholder="Password" id="passwordNumber" required>
											<div class="input-group-append">
												<div class="input-group-text">
													<span><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
										<span id="password_validation"></span>
									</div>
									<div class="form-group col-sm-12">
										<label>Image</label>
										<input type="file" class="form-control" value="" name="a_img" id="">
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="pull-right">
									<button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Update Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"> </i> Update User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" role="form" action="<?php echo base_url('update_user') ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Name</label>
							<span class="text-danger">*</span>
							<input type="text" name="a_name" class="form-control" id="user_name" placeholder="Enter Name" required>
						</div>
						<div class="form-group col-sm-12">
							<label>User Type</label>
							<span class="text-danger">*</span>
							<select class="form-control select2" style="width: 100%;" id="user_type" name="a_type" required>
								<option value="">Pease Select User Type</option>
								<?php
								if (userType()) {
									foreach (userType() as $key => $value) {
								?>
										<option value="<?php echo $key; ?>">
											<?php echo $value;
											?></option>
								<?php }
								} ?>
							</select>
						</div>
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Email</label>
							<input type="email" name="a_email" class="form-control" id="user_email" placeholder="Enter Email">
						</div>
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Address</label>
							<span class="text-danger">*</span>
							<input type="text" name="a_address" class="form-control" id="user_address" placeholder="Enter Address" required>
						</div>
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Mobile</label>
							<span class="text-danger">*</span><span class="text-primary">(Enter 11 digit mobile number.)</span>
							<input type="text" name="a_mobile" class="form-control input-number" id="user_mobile" placeholder="Enter Mobile" required>
							<span id="user_mobile_number_validation"></span>
						</div>

						<div class="form-group col-sm-12">
							<label>Password</label>
							<span class="text-danger">*</span><span class="text-primary">(Enter password between 1 to 6 character.)</span>
							<div class="input-group" id="show_hide_password">
								<input type="password" name="a_key" class="form-control removeWhiteSpace" placeholder="Password" id="user_password" required>
								<div class="input-group-append">
									<div class="input-group-text">
										<span><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
									</div>
								</div>
							</div>
							<span id="user_password_validation"></span>
						</div>
						<div class="form-group col-sm-12">
							<label>Image</label>
							<input type="file" class="form-control" value="" name="a_img" id="">
							<input type="hidden" class="form-control" value="" name="hidden_img" id="user_img">
						</div>
					</div>
					<input type="hidden" name="a_id" id="iid">
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info" id="saveChangesButton">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// Password show hide
		$("#show_hide_password span").on('click', function(event) {
			event.preventDefault();
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass("fa-eye-slash");
				$('#show_hide_password i').removeClass("fa-eye");
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass("fa-eye-slash");
				$('#show_hide_password i').addClass("fa-eye");
			}
		});


		// Mobile number length And Password length
		const goodColor = "#0C6";
		const badColor = "#FF0000";

		const $mobile_validation = $('#mobile_number_validation');

		$('#mobileNumber').on('paste keyup keypress', function(e) {

			if (e.which == 46 || e.which == 45 || e.which < 48 || e.which > 57) {
				event.preventDefault();
			}

			if (this.value.length != 11) {
				$mobile_validation.text("Please enter 11 digit mobile number.");
				$mobile_validation.css("color", badColor);
			}

			if (this.value.length === 11) {
				$mobile_validation.text("Good!");
				$mobile_validation.css("color", goodColor);
			}
		});


		// Password length
		const $password_validation = $('#password_validation');

		$('#passwordNumber').on('paste keyup keypress', function(e) {

			if (this.value.length >= 1 && this.value.length <= 6) {
				$password_validation.text("Good!");
				$password_validation.css("color", goodColor);
			} else {
				$password_validation.text("Please enter password between 1 to 6 character.");
				$password_validation.css("color", badColor);
			}
		});

		// 
		$("#passwordNumber, #mobileNumber").on('keyup change paste', function() {
			const passwordLength = $("#passwordNumber").val();
			const mobileLength = $("#mobileNumber").val();

			if ((passwordLength.length >= 1 && passwordLength.length <= 6) && mobileLength.length === 11) {
				$("#submitButton").prop("disabled", false);
			} else {
				$("#submitButton").prop("disabled", true);
			}
		});


		/* ======================== Edit ======================== */
		// Edit User
		$(".editButton").click(function(e) {
			var id = $(this).data('id');
			var type = $(this).data('type');
			var password = $(this).data('password');
			// alert(id)
			var name = $(this).data('name');
			var email = $(this).data('email');
			var address = $(this).data('address');
			var mobile = $(this).data('mobile');
			var img = $(this).data('img');

			$('#myModal2').modal('show');
			$('#iid').val(id);
			$('#user_type').val(type).trigger('change');
			$('#user_password').val(password)
			$('#user_name').val(name);
			$('#user_email').val(email);
			$('#user_address').val(address);
			$('#user_mobile').val(mobile);
			$('#user_img').val(img);





			// Mobile number length And Password length
			const goodColor = "#0C6";
			const badColor = "#FF0000";

			const $mobile_validation = $('#user_mobile_number_validation');

			$('#user_mobile').on('paste keyup keypress', function(e) {

				if (e.which == 46 || e.which == 45 || e.which < 48 || e.which > 57) {
					event.preventDefault();
				}

				if (this.value.length != 11) {
					$mobile_validation.text("Please enter 11 digit mobile number.");
					$mobile_validation.css("color", badColor);
				}

				if (this.value.length === 11) {
					$mobile_validation.text("Good!");
					$mobile_validation.css("color", goodColor);
				}
			});


			// Password length
			const $password_validation = $('#user_password_validation');

			$('#user_password').on('paste keyup keypress', function(e) {

				if (this.value.length >= 1 && this.value.length <= 6) {
					$password_validation.text("Good!");
					$password_validation.css("color", goodColor);
				} else {
					$password_validation.text("Please enter password between 1 to 6 character.");
					$password_validation.css("color", badColor);
				}
			});

			// 
			$("#user_password, #user_mobile").on('keyup change paste', function() {
				const passwordLength = $("#user_password").val();
				const mobileLength = $("#user_mobile").val();

				if ((passwordLength.length >= 1 && passwordLength.length <= 6) && mobileLength.length === 11) {
					$("#saveChangesButton").prop("disabled", false);
				} else {
					$("#saveChangesButton").prop("disabled", true);
				}
			});


		});



	});
</script>