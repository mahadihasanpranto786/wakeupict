<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Update Jute Entry</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php
                                                                $current_user_type = $this->session->userdata('current_type');
                                                                if ($current_user_type == 1) {
                                                                    echo base_url('administration');
                                                                } elseif ($current_user_type == 10) {
                                                                    echo base_url('operator');
                                                                } elseif ($current_user_type == 101) {
                                                                    echo base_url('security_head');
                                                                } elseif ($current_user_type == 102) {
                                                                    echo base_url('security_operator');
                                                                } elseif ($current_user_type == 201) {
                                                                    echo base_url('weight_head');
                                                                } elseif ($current_user_type == 202) {
                                                                    echo base_url('weight_operator');
                                                                } elseif ($current_user_type == 301) {
                                                                    echo base_url('jute_head');
                                                                } elseif ($current_user_type == 302) {
                                                                    echo base_url('jute_operator');
                                                                } elseif ($current_user_type == 401) {
                                                                    echo base_url('accounts_head');
                                                                } elseif ($current_user_type == 402) {
                                                                    echo base_url('accounts_operator');
                                                                } elseif ($current_user_type == 501) {
                                                                    echo base_url('production_head');
                                                                } elseif ($current_user_type == 502) {
                                                                    echo base_url('production_operator');
                                                                } elseif ($current_user_type == 601) {
                                                                    echo base_url('gm');
                                                                } elseif ($current_user_type == 602) {
                                                                    echo base_url('shareholder');
                                                                } elseif ($current_user_type == 603) {
                                                                    echo base_url('system_administrator');
                                                                } else {
                                                                    $this->session->set_flashdata('login_failed', 'Credential Not match');
                                                                    redirect('login', 'location');
                                                                }
                                                                ?>">
                                Home</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('list_jute_entry'); ?>">Back to Entry List</a></li>
                        <li class="breadcrumb-item active">Update Jute Entry</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-warning mt-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-edit"></i> Update Jute Entry</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div id="normal">
                            <form role="form" action="<?php echo base_url('update_jute_entry'); ?>" method="post" onkeydown="return event.key != 'Enter';" autocomplete="off">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-1 col-form-label">Jute variety</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control select2" style="width: 100%;" name="en_jute_variety" id="en_jute_variety" required>
                                                        <option value="">Select</option>
                                                        <option value="Normal" <?php
                                                                                if (!empty($jEntry->en_jute_variety)) {
                                                                                    if ($jEntry->en_jute_variety == 'Normal') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>>Normal</option>
                                                        <option value="Knaf" <?php
                                                                                if (!empty($jEntry->en_jute_variety)) {
                                                                                    if ($jEntry->en_jute_variety == 'Knaf') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>>Knaf</option>
                                                        <option value="White" <?php
                                                                                if (!empty($jEntry->en_jute_variety)) {
                                                                                    if ($jEntry->en_jute_variety == 'White') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>>White</option>
                                                        <option value="Cutting" <?php
                                                                                if (!empty($jEntry->en_jute_variety)) {
                                                                                    if ($jEntry->en_jute_variety == 'Cutting') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                } ?>>Cutting</option>
                                                        <option value="TW" <?php
                                                                            if (!empty($jEntry->en_jute_variety)) {
                                                                                if ($jEntry->en_jute_variety == 'TW') {
                                                                                    echo 'selected';
                                                                                }
                                                                            } ?>>TW</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Mill Lot No</label>
                                                <input type="text" name="en_lot_no" class="form-control" id="millLotNo" value="<?php if ($jEntry) {
                                                                                                                                    echo $jEntry->en_lot_no;
                                                                                                                                } ?>" placeholder="Enter Mill Lot No" style="text-transform:uppercase" required>

                                                <input type="hidden" name="" class="form-control" id="millLotNoForMatch" value="<?php if ($jEntry) {
                                                                                                                                    echo $jEntry->en_lot_no;
                                                                                                                                } ?>" required>

                                                <label class="text-danger" id="lastLot">Last Entered Lot No: </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Entry Date</label>
                                                <input value="<?php if ($jEntry) {
                                                                    echo date("d-m-Y", strtotime($jEntry->en_date));
                                                                } ?>" required name="en_date" id="en_date" class="form-control datepicker" type="text">
                                            </div>
                                            <input type="hidden" value="" name="en_fy_id" id="en_fy_id" class="">

                                            <div class="form-group">
                                                <label for="">Entry Time</label>
                                                <input type="text" id="time_picker" class="form-control" name="en_time" value="<?php if ($jEntry) {
                                                                                                                                    echo date("h:i A", strtotime($jEntry->en_date));
                                                                                                                                } ?>" autocomplete="off" required />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Name of Supplier</label>
                                                <select class="form-control select2 supplier" style="width: 100%;" name="en_s_id" required>
                                                    <option value="">Select Supplier</option>
                                                    <?php if ($suppliers) {
                                                        foreach ($suppliers->result() as $supplier) {
                                                    ?>
                                                            <option value="<?= $supplier->s_id ?>" <?php if (!empty($jEntry)) {
                                                                                                        if ($jEntry->en_s_id == $supplier->s_id) {
                                                                                                            echo "selected";
                                                                                                        }
                                                                                                    } ?>><?= $supplier->s_title ?> - <?= $supplier->s_phone ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-9">Party Chalan No</label><label class="col-sm-3"><input class="form-check-input" type="checkbox" id="chalan_checkbox"> Edit </label>
                                                <input type="text" name="en_chalan_no" class="form-control" id="suplierPartyChalan" placeholder="Enter Party Chalan No" value="<?php if ($jEntry) {
                                                                                                                                                                                    echo $jEntry->en_chalan_no;
                                                                                                                                                                                } ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Mokam</label>
                                                <select id="mokam" class="form-control select2" style="width: 100%;" name="en_mo_id" required>
                                                    <option value="">Select Mokam</option>
                                                    <?php if ($mokams) {
                                                        foreach ($mokams->result() as $mokam) {
                                                    ?>
                                                            <option value="<?= $mokam->mo_id ?>" <?php if (!empty($jEntry)) {
                                                                                                        if ($jEntry->en_mo_id == $mokam->mo_id) {
                                                                                                            echo "selected";
                                                                                                        }
                                                                                                    } ?>><?= $mokam->mo_title ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Truck Number</label>
                                                <input type="text" name="en_truck_no" class="form-control" id="" placeholder="Ex: Rajbari - Ga - 007" value="<?php if ($jEntry) {
                                                                                                                                                                    echo $jEntry->en_truck_no;
                                                                                                                                                                } ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Driver Name</label>
                                                <input type="text" name="en_td_name" class="form-control" id="" placeholder="Driver Name" value="<?php if ($jEntry) {
                                                                                                                                                        echo $jEntry->en_td_name;
                                                                                                                                                    } ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Chalan Bojha/Bale</label>
                                                <input type="text" name="en_bojha_bale" class="form-control input-number" id="bale" placeholder="Enter Chalan Bojha/Bale" value="<?php if ($jEntry) {
                                                                                                                                                                                        echo $jEntry->en_bojha_bale;
                                                                                                                                                                                    } ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for=""> Chalan Bojha/Bale Weight</label>
                                                <input type="text" name="en_bojha_weight" class="form-control input-number" id="baleW" placeholder="Enter Bojha/Bale Weight" value="<?php if ($jEntry) {
                                                                                                                                                                                        echo $jEntry->en_bojha_weight;
                                                                                                                                                                                    } ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for=""> Chalan Net Weight</label>
                                                <input type="text" name="en_net_weight" class="form-control" id="nw" placeholder="" value="<?php if ($jEntry) {
                                                                                                                                                echo $jEntry->en_net_weight;
                                                                                                                                            } ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Chalan Mds</label>
                                                <input type="text" name="en_net_mds" class="form-control" id="en_net_mds" placeholder="" value="<?php if ($jEntry) {
                                                                                                                                                    echo $jEntry->en_net_mds;
                                                                                                                                                } ?>" readonly>
                                            </div>
                                            <input type="hidden" name="en_id" value="<?php if ($jEntry) {
                                                                                            echo $jEntry->en_id;
                                                                                        } ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-warning">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /End Form -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /section -->
</div>
<!-- /.content-wrapper -->


<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#bale, #baleW').keyup(function() {
            var bale = parseFloat($('#bale').val()) || 0;
            var baleW = parseFloat($('#baleW').val()) || 0;
            $('#nw').val((bale * baleW).toFixed(2));
            $('#en_net_mds').val((bale * baleW / 40).toFixed(2));
        });


        $(".supplier").change(function() {
            var supplierId = $('.supplier').find(":selected").val();
            var en_fy_id = $('#en_fy_id').val();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('jute/Entry/ajaxSuplierPartyChalan') ?>",
                data: {
                    supplierId: supplierId,
                    en_fy_id: en_fy_id,

                },
                success: function(data) {
                    $("#suplierPartyChalan").val(data);
                    //alert(data);
                }

            });
        });

        // To prevent duplicate lot number entry
        $("#millLotNo").blur(function() {
            var millLotNo = $('#millLotNo').val();
            var en_fy_id = $('#en_fy_id').val();
            var millLotNoForMatch = $('#millLotNoForMatch').val();


            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('jute/Entry/ajaxMillLotNoCheckForEntry') ?>",
                data: {
                    millLotNo: millLotNo,
                    en_fy_id: en_fy_id,

                },
                success: function(data) {
                    console.log(data);
                    if (data == 0) {
                        $("#millLotNo").val(millLotNo);
                    } else if (millLotNo == millLotNoForMatch) {
                        $("#millLotNo").val(millLotNo);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lot No ' + millLotNo,
                            text: 'Mill Lot Number Already in Use',
                        })
                        $("#millLotNo").val(millLotNoForMatch);
                    }

                }

            });
        });


        //automatic get financial year id
        var enDate = $('#en_date').val();

        getFy(enDate);

        function getFy(enDate) {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('jute/Entry/ajaxFinancialYear') ?>",
                data: {
                    enDate: enDate,
                },
                success: function(data) {

                    if (data == 'no') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ops !!!!!!!!!!!!!',
                            text: 'No Financial Year found under this (' + enDate + ') date ',

                        })
                        $("#en_date").val('');
                        $("#en_fy_id").val('');
                    } else {
                        $("#en_fy_id").val(data);
                        //alert(data);
                    }
                }

            });
        }

        $("#en_jute_variety").change(function() {
            var en_jute_variety = $('#en_jute_variety').find(":selected").val();
            var en_fy_id = $('#en_fy_id').val();
            //alert(en_fy_id);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('jute/Entry/ajaxLastLotNo') ?>",
                data: {
                    en_jute_variety: en_jute_variety,
                    en_fy_id: en_fy_id,

                },
                success: function(data) {
                    $("#lastLot").text(data);
                    //alert(data);
                }

            });
        });

        $("#en_date").on('change', function() {

            enDate = $(this).val();
            getFy(enDate);

            // Start (05) - For change party calan When financial year is change
            var supplierId = $('.supplier').find(":selected").val();
            var en_fy_id = $('#en_fy_id').val();
            //alert(en_fy_id);

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('jute/Entry/ajaxSuplierPartyChalan') ?>",
                data: {
                    supplierId: supplierId,
                    en_fy_id: en_fy_id,
                },
                success: function(data) {
                    $("#suplierPartyChalan").val(data);
                }
            });
            // end (05) 

            // Start (06) - For change party calan When financial year is change
            var en_jute_variety = $('#en_jute_variety').find(":selected").val();
            //var en_fy_id = $('#en_fy_id').val();
            //alert(en_fy_id);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('jute/Entry/ajaxLastLotNo') ?>",
                data: {
                    en_jute_variety: en_jute_variety,
                    en_fy_id: en_fy_id,

                },
                success: function(data) {
                    $("#lastLot").text(data);
                    //alert(data);
                }

            });
            // end (06) 

        });
        //END automatic get financial year id





        //Check Jute Calculation Helper
        var en_date = $('#en_date').val();
        getJuteCalculationHelper(en_date);

        function getJuteCalculationHelper(en_date) {

            var [dd, mm, yyyy] = en_date.split("-");
            var splitDate = `${mm}-${dd}-${yyyy}`;
            var onlyYear = `${yyyy}`;
            //  Date to Month Name
            const dateObj = new Date(splitDate);
            const monthNameLong = dateObj.toLocaleString("en-US", {
                month: "long"
            });

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('jute/Entry/ajaxMonthlyJuteCalculationHelperCheck') ?>",
                data: {
                    date: en_date,
                },
                success: function(data) {

                    if (data == 'no') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops !!!!!!!!!!!!!',
                            text: 'No Jute Calculation Helper found under this (' + monthNameLong + ' ' + onlyYear + ' ). Please, go to Godown Module and insert this (' + monthNameLong + ' ' + onlyYear + ') data.',
                        })
                        $("#en_date").val('');
                    } else {
                        $("#en_date").val(en_date);
                        // alert(data);
                    }
                }

            });
        }

        $("#en_date").on('change', function() {
            date = $(this).val();
            getJuteCalculationHelper(date);

        });

        $('#chalan_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('#suplierPartyChalan').attr('readonly', false);
            } else {
                $('#suplierPartyChalan').attr('readonly', true);
            }
        });
        $('#suplierPartyChalan').attr('readonly', true);


    });
</script>