<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $tittle ?></title>
	<!--	datatable start-->
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!--	datatable end-->


	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/summernote/summernote-bs4.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Bootstrap4 Duallistbox -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/dist/css/adminlte.min.css">
	<!--custom css-->
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/css/custom.css">
	<!-- SweetAlert2 -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<link rel="stylesheet" href="<?php echo base_url('') ?>assets/backend/dist/css/sweet.css"> -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Headlines -->
			<!-- <div style="float:left; overflow: hidden; width: 100%; font-weight: bold; " class='marquee marquee-with-options'>
				write something
			</div> -->


			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Messages Dropdown Menu -->

				<!-- Notifications Dropdown Menu -->

				<li class="nav-item">
					<a href="<?php echo base_url('logout') ?>">
						<button type="button" class="btn btn-block btn-danger">Logout</button>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->
		<?php echo $side_menu; ?>


		<section id="main-content">
			<section class="wrapper">
				<?= $main_content; ?>
			</section>
		</section>
	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">

		<strong>Page rendered in <strong>{elapsed_time}</strong> seconds.</strong>

		<div class="float-right d-none d-sm-inline-block">
			<b><?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></b>
		</div>
	</footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
	</aside>
	<!-- /.control-sidebar -->
	</div>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/chart.js/Chart.min.js"></script>
	<!-- Dashboard 3 -->
	<script src="<?php echo base_url('') ?>assets/backend/dist/js/pages/dashboard3.js"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?php echo base_url('') ?>assets/backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/moment/moment.min.js"></script>
	<script src="<?php echo base_url('') ?>assets/backend/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
	</script>
	<!-- Summernote -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
	</script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('') ?>assets/backend/dist/js/adminlte.js"></script>

	<!-- SweetAlert2 -->

	<script src="<?php echo base_url('') ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url('') ?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
	</script>
	<script src="<?php echo base_url('') ?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js">
	</script>
	<script src="<?php echo base_url('') ?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
	</script>

	<!-- Text-Scrolling-Plugin-for-jQuery-Marquee -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/text-scrolling-plugin-for-jQuery-marquee/jquery.marquee.min.js">
	</script>

	<!-- Our Used JS  -->
	<!-- <script src="<//?php echo base_url('') ?>assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script> -->
	<!-- Sweet Alert package link -->
	<script src="<?php echo base_url('') ?>assets/backend/plugins/package/dist/sweetalert2.all.js"></script>
	<script src="<?php echo base_url('') ?>assets/backend/custom/client_site.js"></script>
	<script src="<?php echo base_url('') ?>assets/backend/custom/select2.full.min.js"></script>
	<script src="<?php echo base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>

	<!-- time picker add by murad 15.09.22  -->
	<script src="<?php echo base_url() ?>assets/backend/plugins/easy-time-picker-bootstrap/dayjs.min.js" defer="defer">
	</script>
	<script src="<?php echo base_url() ?>assets/backend/plugins/easy-time-picker-bootstrap/timepicker-bs4.js" defer="defer"></script>



	<!-- <script src="<//?php echo base_url('') ?>assets/backend/dist/js/sweet.js"></script> -->

	<!-- =============================== Marquee =============================== -->
	<script>
		$('.marquee-with-options').marquee({
			speed: 80,
			gap: 1500,
			delayBeforeStart: 0,
			direction: 'left',
			duplicated: true,
			pauseOnHover: true
		});
	</script>

	<script>
		$(function() {

			$(".datepicker").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true
			});


			//to prevent typing date
			$(".datepicker").on('keydown drag drop', function(event) {
				event.preventDefault()
			});
		});
	</script>



	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"ordering": false,
				"pageLength": 50
			});
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>
	<script>
		$.validate({
			lang: 'en'
		});
	</script>
	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})

			//Datemask dd/mm/yyyy
			$('#datemask').inputmask('dd/mm/yyyy', {
				'placeholder': 'dd/mm/yyyy'
			})
			//Datemask2 mm/dd/yyyy
			$('#datemask2').inputmask('mm/dd/yyyy', {
				'placeholder': 'mm/dd/yyyy'
			})
			//Money Euro
			$('[data-mask]').inputmask()

			//Date range picker
			$('#reservationdate').datetimepicker({
				format: 'L'
			});
			//Date range picker
			$('#reservation').daterangepicker()
			//Date range picker with time picker
			$('#reservationtime').daterangepicker({
				timePicker: true,
				timePickerIncrement: 30,
				locale: {
					format: 'MM/DD/YYYY hh:mm A'
				}
			})
			//Date range as a button
			$('#daterange-btn').daterangepicker({
					ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
							'month').endOf('month')]
					},
					startDate: moment().subtract(29, 'days'),
					endDate: moment()
				},
				function(start, end) {
					$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
						'MMMM D, YYYY'))
				}
			)

			//Timepicker
			$('#timepicker').datetimepicker({
				format: 'LT'
			})

			//Bootstrap Duallistbox
			$('.duallistbox').bootstrapDualListbox()

			//Colorpicker
			$('.my-colorpicker1').colorpicker()
			//color picker with addon
			$('.my-colorpicker2').colorpicker()

			$('.my-colorpicker2').on('colorpickerChange', function(event) {
				$('.my-colorpicker2 .fa-square').css('color', event.color.toString());
			});

			$("input[data-bootstrap-switch]").each(function() {
				$(this).bootstrapSwitch('state', $(this).prop('checked'));
			});

		})
	</script>
	<script>
		$(function() {
			// Summernote
			$('.textarea').summernote()
		})
	</script>
	<!-- For clear selected data in selector -->
	<script>
		$(document).ready(function() {
			$('input[name="searchDate"]').change(function() {
				$('#yearName').val('');
				$('#monthName').val('');
			});

			//easy time picker add by murad
			$('#time_picker').timepicker({
				//options here
			});
		});
	</script>
	<!-- Delete Data Using SweetAlert Modal -->
	<script>
		$(document).on("click", ".deleteBySweetAlert", function(e) {
			e.preventDefault();
			var link = $(this).attr("href");
			Swal.fire({
				title: 'Are you sure want to delete this?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#007bff',
				cancelButtonColor: '#FF0000',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = link;
					Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
				} else {
					Swal.fire('Canceled!', 'Your imaginary file is safe :)', 'error');
				}
			});
		});

		$(document).on("click", ".confirmationAlert", function(e) {
			e.preventDefault();
			var link = $(this).attr("href");
			Swal.fire({
				title: 'Are you sure want to do this?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#007bff',
				cancelButtonColor: '#FF0000',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = link;
					Swal.fire('Done!', 'Your file has been updated.', 'success');
				} else {
					Swal.fire('Canceled!', 'Your imaginary file is safe :)', 'error');
				}
			});
		});
	</script>
	<!-- =============================== Javascript Regular Expression =============================== -->
	<!-- =============================== Numerical/Float/Double number input - Start =============================== -->
	<!-- For only input Numerical/Float/Double number input. Not for any text input -->
	<!-- Input field (type="text") -->
	<script>
		$(document).ready(function() {
			$(".input-number").on('keyup change paste keypress', function(e) {
				var data, i;
				data = document.querySelectorAll(".input-number"); //HTML DOM querySelector() Method
				for (i = 0; i < data.length; i++) {
					data[i].value = data[i].value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
				}
				// alert("Replace Text");
			});
			$(".input-number").on('drop', function(e) {
				$(this).prop("readonly", true)
			});
			$(".input-number").on('click, keyup', function(e) {
				$(this).prop("readonly", false)
			});
		});
	</script>
	<!-- Input field a Minus Allow kora -->
	<script>
		$(document).ready(function() {
			$(".input-number-minus-allow").keyup(function(e) {
				var data, i;
				data = document.querySelectorAll(
					".input-number-minus-allow"); //HTML DOM querySelector() Method
				for (i = 0; i < data.length; i++) {
					data[i].value = data[i].value.replace(/[^0-9.-]/g, '').replace(/(\..*)\./g, '$1');
				}
				// alert("Replace Text");
			});
			$(".input-number-minus-allow").on('drop', function(e) {
				$(this).prop("readonly", true)
			});
			$(".input-number-minus-allow").on('click, keyup', function(e) {
				$(this).prop("readonly", false)
			});
		});
	</script>
	<!-- Remove White Space from input field -->
	<script>
		$(document).ready(function() {
			$(".removeWhiteSpace").keyup(function(e) {
				var data, i;
				data = document.querySelectorAll(".removeWhiteSpace"); //HTML DOM querySelector() Method
				for (i = 0; i < data.length; i++) {
					data[i].value = data[i].value.replace(/ /g, '');
				}
				// alert("Replace Text");
			});
		});
	</script>
	<!-- =============================== Numerical/Float/Double number input - End =============================== -->


	<!-- =============================== Readonly Input Field =============================== -->
	<script>
		$(".readonly").on('keydown paste focus mousedown', function(e) {
			if (e.keyCode != 9) // ignore tab
				e.preventDefault();
		});

		readonlyColor();

		function readonlyColor() {
			$(".readonly").css("background-color", "rgba(233, 236, 239, 0.5)");
		}


		$(document).ready(function() {
			// datepicker  month and year active in modal 
			var enforceModalFocusFn = $.fn.modal.Constructor.prototype._enforceFocus;

			$.fn.modal.Constructor.prototype._enforceFocus = function() {};

			$confModal.on('hidden', function() {

				$.fn.modal.Constructor.prototype._enforceFocus = enforceModalFocusFn;
			});
			$confModal.modal({
				backdrop: false
			});
		});
	</script>



</body>

</html>