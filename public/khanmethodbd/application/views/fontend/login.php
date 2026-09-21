<body class="theme-navy-blue slider_with_banners ltr">
	<div class="main">
		<div class="wrapper">
			<div class="content-wrapper clearfix ">
				<div class="container">
					<div class="form-wrapper">
						<div class="form form-page">
							<form method="POST" action="<?php echo base_url(); ?>fontend/Login/check_login" class="login-form clearfix">
								<input type="hidden" name="_token" value="jwu6UWn1AHDGopW5kkkhvXEqgPXl1OvV8BPTYA0g">
								<?php
								if ($error = $this->session->flashdata('error')) { ?>
									<div class="alert alert-danger"><strong>Error !</strong><?= $error; ?></div>
								<?php } ?>
								<div class="bg-blue">
									<div class="reflection"></div>
								</div>

								<div class="login form-inner clearfix">
									<a href="<?php echo base_url(); ?>fontend/Registration" class="register" data-toggle="tooltip" data-placement="top" title="Register" rel="tooltip">
										<i class="fa fa-user-plus" aria-hidden="true"></i>
									</a>

									<h3>Login</h3>
									<div class="form-group ">
										<label for="email">Email<span>*</span></label>

										<input type="text" name="email" value="" class="form-control" id="email" placeholder="Email" autofocus>

										<div class="input-icon">
											<i class="fa fa-envelope-o" aria-hidden="true"></i>
										</div>
									</div>
									<div class="form-group ">
										<label for="password">Password<span>*</span></label>
										<input type="password" name="password" class="form-control" id="password" placeholder="Password">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
										</div>
									</div>
									<div class="clearfix"></div>
									<button type="submit" class="btn btn-primary btn-center btn-login" data-loading>
										Login
									</button>

									<div class="checkbox pull-left">
										<input type="hidden" value="0">
										<input type="checkbox" value="1" id="remember">

										<label for="remember">Remember me</label>
									</div>
									<a href="<?php echo base_url(); ?>fontend/Registration" class="forgot-password pull-right">
										Register
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
<!-- 
<body>
		<div class="container pc" id="container">

		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back !</h1>
					<p>To keep connected with us please login with your personal info</p><button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1><?= $company_info->s_login_tittle; ?></h1>
					<p><?= $company_info->s_description; ?></p>
				</div>
			</div>
		</div>
	</div>
	<form method="POST" action="<?php echo base_url(); ?>fontend/Login/check_login" class="mbl">
		<h1>Sign in</h1>
		<?php
		if ($error = $this->session->flashdata('error')) { ?>
			<div class="alert alert-danger"><strong>Error !</strong><?= $error; ?></div>
		<?php } ?>
		<input type="email" name="email" placeholder="Email" />
		<input type="password" name="password" placeholder="Password" />
		<button type="submit">Sign In</button><br>
		<a href="<?php echo base_url(); ?>fontend/Registration" class="forgot-password pull-left">Registration</a>
	</form>
	<footer><?= $company_info->s_footer; ?></footer> 
	<script type="text/javascript" src="<?php echo base_url('assets/admin_layout/login/script.js') ?>"></script>
</body>

</html>-->