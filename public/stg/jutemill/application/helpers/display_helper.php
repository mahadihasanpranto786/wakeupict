<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function alert_check()
{
	$driverInstanse = &get_instance();

	if ($success = $driverInstanse->session->flashdata('success')) {
?>
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4> <?= $success; ?></h4>
		</div>
	<?php } ?>

	<?php
	if ($error = $driverInstanse->session->flashdata('error')) {
	?>
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Error!</strong> <?= $error; ?>
		</div>
	<?php }
}


function pegination_genarate($links)
{
	?>
	<div style="padding: 60px;">
		<nav aria-label="Page navigation">
			<div class="pagination">
				<ul class="pagination">
					<?php foreach ($links as $link) {
						echo "<li>" . $link . "</li>";
					} ?>
			</div>
		</nav>
	</div>


<?php

}

function active_nav($nav, $check_nav)
{
	if ($nav == $check_nav) {
		return "active";
	}
}

function active_open($nav, $check_nav)
{
	if ($nav == $check_nav) {
		return "menu-open";
	}
}
