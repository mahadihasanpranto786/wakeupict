<!DOCTYPE html>
<html lang="en">
<?php
$tittle = "Jute Mill Management System || Forgot Password";

?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $tittle; ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/forgot_password/css/fontawesome-all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/forgot_password/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/forgot_password/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="<?php echo base_url('login'); ?>" class="h1"><b>RJML</b></a>
			</div>
			<div class="card-body">
				<p>You forgot your password? Here you can send a new password request to admin.</p>
				<?= alert_check() ?>
				<form role="form" action="<?php echo base_url('forgot_password_request'); ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="exampleInputEmail1">Enter Your Mobile</label>
							<span class="text-danger">*</span>
							<input type="text" name="a_mobile" class="form-control input-number" id="mobileNumber" placeholder="Enter Mobile" autocomplete="off" required style="padding: 1.2rem .75rem;">
							<span id="mobile_number_validation"></span>
						</div>

						<div class="form-group col-sm-12">
							<label>Enter Your New Password</label>
							<span class="text-danger">*</span>
							<div class="input-group" id="show_hide_password">
								<input type="password" name="a_forgot_password_code" class="form-control removeWhiteSpace" placeholder="Password" id="passwordNumber" autocomplete="off" required style="padding: 1.2rem .75rem;">
								<div class="input-group-append border-0">
									<div class="input-group-text">
										<span><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
									</div>
								</div>
							</div>
							<span id="password_validation"></span>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block" id="submitButton"><i class="fas fa-arrow-circle-right"></i> Request new password</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<p class="mt-3 mb-1">
					<a href="<?php echo base_url('login'); ?>"><i class="fas fa-arrow-circle-left"></i> Login</a>
				</p>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="<?php echo base_url('') ?>assets/login/js/jquery-3.5.0.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('') ?>assets/forgot_password/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('') ?>assets/forgot_password/js/adminlte.min.js"></script>

	<!-- Script File -->
	<script type="text/javascript">
		$(document).ready(function() {

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

			// Remove white space
			$(".removeWhiteSpace").keyup(function(e) {
				var data, i;
				data = document.querySelectorAll(".removeWhiteSpace"); //HTML DOM querySelector() Method
				for (i = 0; i < data.length; i++) {
					data[i].value = data[i].value.replace(/ /g, '');
				}
			});



		});
	</script>


</body>

</html>
