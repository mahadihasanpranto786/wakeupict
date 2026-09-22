<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- fab icon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ URL::asset('frontend/image/wakeupict-fabicon.png') }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ URL::asset('public/css/app.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/summernote/summernote-bs4.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="preloader">
        <div id="loader"></div>
    </div>
    <div class="wrapper">
        @include('backend.theme.clasic.include.profile.profile')
        <!-- Main Sidebar Container -->
        @php
            $user = App\User::findOrFail(Auth::id());
        @endphp
        @if ($user->type == 'Admin')
            @include('backend.theme.clasic.include.sidebar.new_sidebar')
        @else
            @include('backend.theme.clasic.include.sidebar.user_excess_sidebar')
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    @yield('maincontant')
                </div>
            </section>
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @php
                $year = Carbon\Carbon::now()->format('Y');
            @endphp
            <strong>Copyright &copy; 2021-{{ $year }} <a href="#">WakeUpICT</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> Build 5.8
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{-- apex chart --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('public/admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('public/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('public/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('public/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('public/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('public/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('public/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('public/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('public/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('public/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('public/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- jquery form validator -->
    <script src="{{ asset('public/admin/plugins/jquiry-from-validator/jquiry_form_validator.js') }}"></script>
    <script>
        window.onload = function() {
            $('.wrapper, .main-footer').css('display', 'block');
            $('#content').fadeOut().css('display', 'none');
        }
    </script>
    <!-- page script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                stateSave: true
            });
            $("#example3").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    @yield('select-content')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                placeholder: 'Choose',
            })
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
            $.datepicker._gotoToday = function(id) {
                $(id).datepicker('setDate', new Date()).datepicker('hide').blur();
            };
            $("#datepicker").datepicker({
                showButtonPanel: true,
                showTodayButton: true,
                showAnim: 'slide',
                yearRange: '1920 : ' + '2050',
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });
            $(".datepicker").datepicker({
                showButtonPanel: true,
                showTodayButton: true,
                yearRange: '1920 : ' + '2050',
                showAnim: 'slide',
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });

            $("#datepicker2").datepicker({
                showButtonPanel: true,
                showTodayButton: true,
                setDate: new Date(),
                showAnim: 'slide',
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
            });

        })
    </script>
    <!-- fileinput -->
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
    <!-- editor -->

    <script>
        $(function() {
            // Summernote
            $('.textarea').summernote()
        })
    </script>

    <!-- jquery form validator -->
    <script>
        $.validate({
            lang: 'en',
            modules: 'file',
        });
    </script>
    <!-- tultip -->
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <!-- Discount amount invoice -->
    <script>
        $(document).on("change keyup blur", "#discount", function() {
            var main = $('#payment').val();
            var disc = $('#discount').val();
            var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
            var mult = main * dec; // gives the value for subtract from main value
            var discont = main - mult;
            $('#result').val(discont);
        });

        $(document).on("change keyup blur", "#payment", function() {
            var fee = $('#course_fee').val();
            var pay = $('#payment').val(); //its convert 10 into 0.10
            var sub = fee - pay;
            $('#due').val(sub);
        });
    </script>
    <!-- expense dicount amount (tk) -->
    <script>
        $(document).on("change keyup blur", "#discount", function() {
            var main = $('#total').val();
            var disc = $('#discount').val(); //its convert 10 into 0.10
            // gives the value for subtract from main value
            var discont = main - disc;
            $('#grand_total').val(discont);
        });

        $(document).on("change keyup blur", "#unit_price", function() {
            var quantity = $('#quantity').val();
            var unit = $('#unit_price').val(); //its convert 10 into 0.10
            var multiple = quantity * unit;
            $('#total').val(multiple);
        });
    </script>

    {{-- //toastr alert --}}
    <script src="{{ URL::asset('admin/js/toastr.min.js') }}"></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}")
        </script>
    @elseif (!empty(Session::get('error')))
        <script>
            toastr.error("{{ Session::get('error') }}")
        </script>
    @endif



    {{-- sweetalert for delete --}}
    <script src="{{ URL::asset('admin/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = link;
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })

        });
    </script>
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                placeholder: function() {
                    $(this).data('placeholder');
                }
            });

            function fontAwesomeIcon(icon) {
                return $('<span><i class="' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
            };

            $('.select2').select2({
                templateSelection: fontAwesomeIcon,
                templateResult: fontAwesomeIcon
            });

            function dataPhoto(icon) {
                return $('<span><img width="20" src="' + $(icon.element).data('picture') + '"> ' + icon.text +
                    '</span>');
            };
            $('.prefix-picture').select2({
                templateSelection: dataPhoto,
                templateResult: dataPhoto
            });
        });
    </script>
    @yield('script')
</body>

</html>
