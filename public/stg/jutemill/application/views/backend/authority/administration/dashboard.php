<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->

	<!-- /.content-header -->

	<!-- Main content -->

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3> Administration Dashboard</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- ./col -->
				<div class="col-lg-12 col-12">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3 class="text-center">
								Welcome to Rajbari Jute Mills Limited
							</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php

				$totalValue = round($this->M_area->totalAreaWiseSumMds() - $this->M_area->totalAreaWiseSaleSumMds() - $this->M_area->totalAreaWiseIssueSumMds());

				if (!empty($alertSetting->jsaq_weight)) {
					if ($totalValue == $alertSetting->jsaq_weight) {
				?>
						<div class="col-md-12">
							<div class="card border border-warning card-warning mb-3 ml-auto w-50" style="max-width: 18rem;">
								<div class="card-header text-center font-weight-bold"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Warning
									<div class="card-tools">
										<button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
										<button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
											<i class="fas fa-times"></i>
										</button>
									</div>
								</div>
								<div class="card-body">
									<?php
									$totalValue = round($this->M_area->totalAreaWiseSumMds() - $this->M_area->totalAreaWiseSaleSumMds() - $this->M_area->totalAreaWiseIssueSumMds());
									echo "You have <span class='text-danger'>$alertSetting->jsaq_weight mds </span> jute in stock. Please, purchase new jute.";
									?>
								</div>
							</div>
						</div>
				<?php }
				}
				?>

				<?php

				$totalValue = round($this->M_area->totalAreaWiseSumMds() - $this->M_area->totalAreaWiseSaleSumMds() - $this->M_area->totalAreaWiseIssueSumMds());

				if (!empty($alertSetting->jsaq_weight)) {
					if ($totalValue < $alertSetting->jsaq_weight) {
				?>
						<div class="col-md-12">
							<div class="card border border-danger card-danger mb-3 ml-auto w-50" style="max-width: 18rem;">
								<div class="card-header text-center font-weight-bold"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Warning
									<div class="card-tools">
										<button type="button" class="btn bg-danger btn-sm" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
										<button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
											<i class="fas fa-times"></i>
										</button>
									</div>
								</div>
								<div class="card-body">
									<?php
									$totalValue = round($this->M_area->totalAreaWiseSumMds() - $this->M_area->totalAreaWiseSaleSumMds() - $this->M_area->totalAreaWiseIssueSumMds());
									echo "You have less than <span class='text-danger'> $alertSetting->jsaq_weight mds</span> jute in stock. Please, purchase new jute. ";
									?>
								</div>
							</div>
						</div>
				<?php }
				}
				?>
			</div>
		</div>
	</section>


	<!-- /.content -->
	<?php

	$year_one = 2017;
	$year_two = 2018;
	$year_three = 2019;
	$year_four = 2020;
	$year_five = 2021;

	$v_one = 20;
	$v_two = 30;
	$v_three = 66;
	$v_four = 55;
	$v_five = 44;

	?>
	</section>
	<!-- /.content -->
	<?php
	$year_one = 2017;
	$year_two = 2018;
	$year_three = 2019;
	$year_four = 2020;
	$year_five = 2021;

	$v_one = 20;
	$v_two = 30;
	$v_three = 66;
	$v_four = 55;
	$v_five = 44;
	$active_member = 50;

	?>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
	new Morris.Line({

		element: 'gangetsu',
		data: [{
				year: '<?= $year_one; ?>',
				value: <?= $v_one; ?>
			},
			{
				year: '<?= $year_two; ?>',
				value: <?= $v_two; ?>
			},
			{
				year: '<?= $year_three; ?>',
				value: <?= $v_three; ?>
			},
			{
				year: '<?= $year_four; ?>',
				value: <?= $v_four; ?>
			},
			{
				year: '<?= $year_five; ?>',
				value: <?= $v_five; ?>
			}
		],
		xkey: 'year',
		ykeys: ['value'],
		labels: ['Value']
	});
</script>


<script>
	$(function() {
		"use strict";

		//DONUT CHART
		var donut = new Morris.Donut({
			element: 'sales-chart',
			resize: true,
			colors: ["#00a65a", "#ffff00", "#f56954", "#3c8dbc"],
			data: [{
					label: "Active",
					value: <?php echo $active_member++; ?>
				},
				{
					label: "Inactive",
					value: <?php echo $active_member++; ?>
				},
				{
					label: "Rejected",
					value: <?php echo $active_member++; ?>
				},
				{
					label: "Pending",
					value: <?php echo $active_member++; ?>
				}
			],
			hideHover: 'auto'
		});
	});

	var bar = new Morris.Bar({
		element: 'bar-chart',
		resize: true,
		data: [

			{
				y: 'January',
				a: '100'
			},
			{
				y: 'February',
				a: '900'
			},
			{
				y: 'March',
				a: '500'
			},
			{
				y: 'April',
				a: '300'
			},
		],
		barColors: ["#007cc7"],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['member', 'month'],
		hideHover: 'auto'
	});
</script>