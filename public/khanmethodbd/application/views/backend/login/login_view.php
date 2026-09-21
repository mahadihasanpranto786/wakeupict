<body class="theme-navy-blue slider_with_banners ltr">
	<div class="main">
		<div class="wrapper">
			<div class="content-wrapper clearfix ">
				<div class="container">
					<div class="form-wrapper">
						<div class="form form-page">
							<form method="POST" action="<?php echo base_url('backend/Login/authentication_process') ?>">
								<input type="hidden" name="_token" value="jwu6UWn1AHDGopW5kkkhvXEqgPXl1OvV8BPTYA0g">
								<?php
								if ($error = $this->session->flashdata('error')) { ?>
									<div class="alert alert-danger"><strong>Error !</strong><?= $error; ?></div>
								<?php } ?>
								<div class="bg-blue">
									<div class="reflection"></div>
								</div>

								<div class="login form-inner clearfix">

									<h3>Login</h3>
									<div class="form-group ">
										<label for="email">Email<span>*</span></label>

										<input type="text" name="email" required value="" class="form-control" id="email" placeholder="Email" autofocus>

										<div class="input-icon">
											<i class="fa fa-envelope-o" aria-hidden="true"></i>
										</div>
									</div>
									<div class="form-group ">
										<label for="password">Password<span>*</span></label>
										<input type="password" name="password" required class="form-control" id="password" placeholder="Password">
										<div class="input-icon">
											<i class="fa fa-lock" aria-hidden="true"></i>
										</div>
									</div>
									<div class="clearfix"></div>
									<button type="submit" class="btn btn-primary btn-center btn-login">
										Login
									</button>

									<div class="checkbox pull-left">
										<input type="hidden" value="0">
										<input type="checkbox" value="1" id="remember">

										<label for="remember">Remember me</label>
									</div>
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
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
</body>