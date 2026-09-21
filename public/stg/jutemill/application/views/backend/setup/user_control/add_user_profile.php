<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">

					<!-- Profile Image -->
					<div class="card card-primary card-outline mt-3">
						<div class="card-body box-profile">
							<div class="text-center">
								<?php if ($userInformation->a_img) { ?>
									<img src="<?php echo base_url(''); ?>./assets/uploads/users/<?= $userInformation->a_img ?>" class="profile-user-img img-fluid img-circle" width="40px" height="40px" alt="Img">
								<?php } else { ?>
									<img src="<?php echo base_url('') ?>assets/uploads/users/user_dummy/user_dummy.jpg" class="profile-user-img img-fluid img-circle" alt="Img">
								<?php }
								?>

							</div>

							<h3 class="profile-username text-center"><?php echo $userInformation->a_name; ?></h3>

							<p class="text-muted text-center">
								<?php
								if ($userInformation->a_type == 1) {
									echo "Admin";
								};
								if ($userInformation->a_type == 10) {
									echo "Operator";
								};
								if ($userInformation->a_type == 101) {
									echo "Security Department Head";
								};
								if ($userInformation->a_type == 102) {
									echo "Security Department Operator";
								};

								if ($userInformation->a_type == 201) {
									echo "Weight Department Head";
								};
								if ($userInformation->a_type == 202) {
									echo "Weight Department Operator";
								};

								if ($userInformation->a_type == 301) {
									echo "Jute Department Head";
								};
								if ($userInformation->a_type == 302) {
									echo "Jute Department Operator";
								};

								if ($userInformation->a_type == 401) {
									echo "Accounts Department Head";
								};
								if ($userInformation->a_type == 402) {
									echo "Accounts Department Operator";
								};

								if ($userInformation->a_type == 501) {
									echo "Production Department Head";
								};
								if ($userInformation->a_type == 502) {
									echo "Production Department Operator";
								};

								if ($userInformation->a_type == 601) {
									echo "Authority General Manager";
								};
								if ($userInformation->a_type == 602) {
									echo "Authority Shareholder";
								};
								if ($userInformation->a_type == 603) {
									echo "Authority System Administrator";
								};

								?></p>

							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>Mobile</b> <a class="float-right"><?php echo $userInformation->a_credential; ?></a>
								</li>
								<li class="list-group-item">
									<b>Email</b> <a class="float-right"><?php echo $userInformation->a_email; ?></a>
								</li>
								<li class="list-group-item">
									<b>Address</b> <a class="float-right"><?php echo $userInformation->a_address; ?> </a>
								</li>
								<li class="list-group-item">
									<b>Created At</b> <a class="float-right"><?php echo date("d-m-Y", strtotime($userInformation->a_created_at)); ?> </a>
								</li>
							</ul>
							<button class="btn btn-success btn-block editButtonInfo" data-id="<?= $userInformation->a_id; ?>" data-name="<?= $userInformation->a_name; ?>" data-email="<?= $userInformation->a_email; ?>" data-address="<?= $userInformation->a_address; ?>" data-mobile="<?= $userInformation->a_credential; ?>" data-img="<?= $userInformation->a_img; ?>"><b>Change Information</b></button>
							<button class=" btn btn-primary btn-block editButtonPassword" data-id="<?= $userInformation->a_id; ?>"><b>Change Password</b></button>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->

				</div>
				<!-- /.col -->
				<div class="col-md-8">
					<div class="card card-success card-outline mt-3">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> Your Information</h3>
						</div>
						<div class="card-body">
						</div>
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


<!-- Update Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"> </i> Update Your Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" role="form" action="<?php echo base_url('update_user_profile_information') ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Name</label>
							<span class="text-danger">*</span>
							<input type="text" name="a_name" class="form-control" id="user_name" placeholder="Enter Name" required>
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
							<label>Image</label>
							<input type="file" class="form-control" value="" name="a_img" id="">
							<input type="hidden" class="form-control" value="" name="hidden_img" id="user_img">
						</div>
					</div>
					<input type="hidden" name="a_id" id="iid">
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info" id="saveChangesButtonInfo">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Update password -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"> </i> Update Your Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" role="form" action="<?php echo base_url('update_user_profile_password') ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-sm-12">
							<label>Enter Your New Password</label>
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
					</div>
					<input type="hidden" name="a_id" id="iiid">
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info" id="saveChangesButtonPassword">Save changes</button>
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



		/* ======================== Edit ======================== */
		// Edit User
		$(".editButtonInfo").click(function(e) {
			var id = $(this).data('id');
			// alert(id)
			var name = $(this).data('name');
			var email = $(this).data('email');
			var address = $(this).data('address');
			var mobile = $(this).data('mobile');
			var img = $(this).data('img');

			$('#myModal2').modal('show');
			$('#iid').val(id);
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
					$("#saveChangesButtonInfo").prop("disabled", true);
				}

				if (this.value.length === 11) {
					$mobile_validation.text("Good!");
					$mobile_validation.css("color", goodColor);
					$("#saveChangesButtonInfo").prop("disabled", false);
				}
			});

		});


		// update password
		// Edit User
		$(".editButtonPassword").click(function(e) {
			var id = $(this).data('id');

			$('#myModal3').modal('show');
			$('#iiid').val(id);


			// Mobile number length And Password length
			const goodColor = "#0C6";
			const badColor = "#FF0000";
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
			$("#user_password").on('keyup change paste', function() {
				const passwordLength = $("#user_password").val();

				if ((passwordLength.length >= 1 && passwordLength.length <= 6)) {
					$("#saveChangesButtonPassword").prop("disabled", false);
				} else {
					$("#saveChangesButtonPassword").prop("disabled", true);
				}
			});

		});



	});
</script>