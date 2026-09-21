<style>
	.field-icon {
		float: right;
		margin-left: -25px;
		margin-top: -30px;
		position: relative;
		z-index: 2;
	}
</style>

<body class="theme-navy-blue slider_with_banners ltr">
	<div class="main">
		<div class="wrapper">
			<div class="content-wrapper clearfix ">
				<div class="container">
					<div class="form-wrapper">
						<div class="form form-page">
							<form method="POST" action="<?php echo base_url('fontend/Registration/store') ?>" class="login-form clearfix">
								<input type="hidden" name="_token" value="jwu6UWn1AHDGopW5kkkhvXEqgPXl1OvV8BPTYA0g">
								<?php
								if ($error = $this->session->flashdata('error')) {
								?>
									<div class="alert alert-danger">
										<strong>Error!</strong> <?= $error; ?>
									</div>
								<?php
									$this->session->sess_destroy();
								} ?>
								<?php
								if ($success = $this->session->flashdata('success')) {
								?>
									<div class="alert alert-success">
										<strong>success!</strong> <?= $success; ?>
									</div>
								<?php
									$this->session->sess_destroy();
								}
								if ($passAlert = $this->session->flashdata('passAlert')) {
								?>
									<div class="alert alert-warning">
										<strong>Warning!</strong> <?= $passAlert; ?>
									</div>
								<?php
									$this->session->sess_destroy();
								} ?>
								<div class="bg-blue">
									<div class="reflection"></div>
								</div>

								<div class="login form-inner clearfix">
									<a href="<?php echo base_url(); ?>sign_in" class="register" data-toggle="tooltip" data-placement="top" title="Login" rel="tooltip">
										<i class="fa fa-user-plus" aria-hidden="true"></i>
									</a>

									<h3>Register</h3>
									<div class="form-group">
										<input type="text" name="fname" class="form-control" autofocus placeholder="First Name" data-validation="required length" data-validation-length="max100" required />
									</div>
									<div class="form-group">
										<input type="text" name="lname" class="form-control" placeholder="Last Name" data-validation="required length" data-validation-length="max100" required />
									</div>
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Email" data-validation="required length" data-validation-length="max100" required />
									</div>
									<div class="form-group pass_hide_show">
										<input class="password_hide_show form-control" type="password" name="password" placeholder="Password" data-validation="required length" data-validation-length="max100" required />
										<i toggle="#password" class="fa fa-fw toggle-password field-icon fa-eye"></i>
									</div>
									<div class="form-group">
										<input type="text" name="phone" class="form-control" placeholder="Phone No" data-validation="required length" data-validation-length="max100" required />
									</div>
									<div class="form-group">
										<input type="text" name="address" class="form-control" placeholder="Address" />
									</div>
									<div class="clearfix"></div>
									<button type="submit" class="btn btn-primary btn-center btn-login" data-loading>
										Register
									</button>
									<a href="<?php echo base_url(); ?>sign_in" class="forgot-password pull-right">
										Login
									</a>
								</div>
							</form>
						</div>
						<div class="social-login-buttons text-center">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- partial -->
<script type="text/javascript" src="<?php echo base_url('assets/admin_layout/login/script.js') ?>"></script>
<!-- Script -->
<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
	$(document).ready(function() {
		$(".toggle-password").click(function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var type = $('.password_hide_show').attr('type');
			if (type == 'text') {
				$(".password_hide_show").attr("type", "password");
			} else {
				$(".password_hide_show").attr("type", "text");
			}
		});
	});
</script>
</body>

</html>