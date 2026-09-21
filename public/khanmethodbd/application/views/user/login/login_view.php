<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>OMS Login System</title>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
	<link rel="stylesheet" href="<?php echo base_url('assets/admin_layout/login/style.css') ?>">
</head>
<body>
	<!-- partial:index.partial.html -->
	<div class="container" id="container">
		<div class="form-container sign-up-container">

		</div>
		<div class="form-container sign-in-container">
			<form method="POST" action="<?php echo base_url('backend/Login/authentication_process') ?>">
				<h1>Sign in</h1>
				<?php
				if ( $error = $this->session->flashdata('error')) {
					?>
					<div class="alert alert-danger">
						<strong>Error!</strong> <?= $error; ?>
					</div>
					<?php
					$this->session->sess_destroy();

				} ?>
				<span></span>
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="password"  placeholder="Password" />

				<button type="submit">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1><?=$company_info->s_login_tittle;?></h1>
					<p><?=$company_info->s_description;?></p>

				</div>
			</div>
		</div>
	</div>

	<footer>
		<?=$company_info->s_footer;?>
		
	</footer>
	<!-- partial -->

	<script type="text/javascript" src="<?php echo base_url('assets/admin_layout/login/script.js') ?>"></script>

</body>
</html>