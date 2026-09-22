<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Zero-FOUT Theme Initializer -->
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme_mode') || 'dark';
            if (savedTheme === 'light') {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <title>@yield('title') — Wake Up ICT Admin</title>
    <!-- fab icon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('frontend/image/wakeupict-fabicon.png') }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Enterprise Fonts: Plus Jakarta Sans, Inter, JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- AdminLTE Core (kept intact for JS layout engine) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Google Font: Source Sans Pro (kept for AdminLTE compatibility) -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Font Awesome 6 Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ★ Enterprise Visual Override (loaded LAST to override AdminLTE styles) -->
    <link rel="stylesheet" href="{{ asset('css/admin-enterprise.css') }}">

    <!-- Critical inline: prevent AdminLTE gray flash before CSS loads and inject dynamic theme palette -->
    <style>
        :root {
            --brand-primary: {{ app_setting('theme_primary_color', '#10b981') }};
            --brand-primary-rgb: {{ app_setting('theme_primary_rgb', '16, 185, 129') }};
            --brand-accent: {{ app_setting('theme_accent_color', '#34d399') }};
            --brand-accent-rgb: {{ app_setting('theme_accent_rgb', '52, 211, 153') }};
            --brand-cyan: {{ app_setting('theme_cyan_color', '#22d3ee') }};
            --brand-indigo: {{ app_setting('theme_indigo_color', '#6366f1') }};
        }
        html, body, .wrapper, .content-wrapper {
            background-color: #030712 !important;
            background: #030712 !important;
            color: #e2e8f0 !important;
        }
        .main-sidebar, aside.main-sidebar {
            background-color: #040a15 !important;
            background: #040a15 !important;
        }
        .main-header, nav.main-header {
            background-color: rgba(4,10,21,0.97) !important;
            background: rgba(4,10,21,0.97) !important;
        }
    </style>

    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed" style="background-color:#030712;color:#e2e8f0;">
    <!-- Dynamic Theme Preloader -->
    <div id="preloader" style="position: fixed; inset: 0; z-index: 99999; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #030712; transition: opacity 0.4s ease-out;">
        <div style="position: relative; display: flex; align-items: center; justify-content: center; width: 80px; height: 80px; margin-bottom: 16px;">
            <div style="position: absolute; inset: 0; border-radius: 50%; animation: adm-pulse 1.8s infinite; background: radial-gradient(circle, var(--brand-primary, #10b981) 0%, transparent 70%); opacity: 0.25;"></div>
            <div id="loader" style="width: 52px; height: 52px; border: 3px solid rgba(255,255,255,0.08); border-top-color: var(--brand-primary, #10b981); border-right-color: var(--brand-accent, #34d399); border-radius: 50%; animation: adm-spin 0.8s linear infinite;"></div>
            <div style="position: absolute; width: 10px; height: 10px; border-radius: 50%; background: var(--brand-primary, #10b981); box-shadow: 0 0 10px var(--brand-primary, #10b981);"></div>
        </div>
        <div style="font-family: 'JetBrains Mono', monospace; font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; font-weight: 600; color: #94a3b8; display: flex; align-items: center; gap: 8px;">
            <span style="width: 6px; height: 6px; border-radius: 50%; background: var(--brand-primary, #10b981); display: inline-block;"></span>
            <span class="adm-preloader-text" style="color: #f1f5f9; font-weight: 700;">WAKE UP ICT ADMIN</span>
        </div>
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
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{-- apex chart --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- jquery form validator -->
    <script src="{{ asset('admin/plugins/jquiry-from-validator/jquiry_form_validator.js') }}"></script>
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
    <script src="{{ asset('admin/js/toastr.min.js') }}"></script>
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
    <script src="{{ asset('admin/sweetalert/sweetalert.min.js') }}"></script>
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

        // Admin Theme Switcher & Preloader Logic
        function setAppTheme(theme) {
            localStorage.setItem('theme_mode', theme);
            document.cookie = "theme_mode=" + theme + "; path=/; max-age=" + (365*24*60*60);

            if (theme === 'light') {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            }
            updateAdminThemeUI(theme);
        }

        function updateAdminThemeUI(theme) {
            var darkI = document.getElementById('admThemeIconDark');
            var lightI = document.getElementById('admThemeIconLight');
            var custI = document.getElementById('admThemeIconCustom');

            if (!darkI) return;
            darkI.style.display = 'none';
            lightI.style.display = 'none';
            custI.style.display = 'none';

            if (theme === 'light') {
                lightI.style.display = 'inline-block';
            } else if (theme === 'custom') {
                custI.style.display = 'inline-block';
            } else {
                darkI.style.display = 'inline-block';
            }
        }

        (function() {
            var cur = localStorage.getItem('theme_mode') || 'dark';
            updateAdminThemeUI(cur);

            function hideAdmPreloader() {
                var p = document.getElementById('preloader');
                if (p) {
                    p.style.opacity = '0';
                    p.style.pointerEvents = 'none';
                    setTimeout(function() { if (p && p.parentNode) p.parentNode.removeChild(p); }, 400);
                }
            }
            if (document.readyState === 'complete') {
                hideAdmPreloader();
            } else {
                window.addEventListener('load', hideAdmPreloader);
                setTimeout(hideAdmPreloader, 1500);
            }
        })();
    </script>
    @yield('script')
</body>

</html>
