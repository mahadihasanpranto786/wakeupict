<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mt-3">
                    <form role="form" action="<?php echo base_url('insert_jute_rate') ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';" autocomplete="off">
                        <div class="card card-success">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="card-title"><i class="fas fa-plus-circle"></i> Jute Rate Basis</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-1">
                                        <h5>SL. NO</h5>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="jrs_sl_no" id="jrs_sl_no" placeholder="Sl No" required readonly>
                                    </div>
                                    <div class="col-sm-1">
                                    </div>
                                    <div class="col-sm-1">
                                        <h5>Start Date</h5>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control datepicker" name="jrs_start_date" id="jrs_start_date" value="<?= get_current_time_time(); ?>" required>
                                        <input type="hidden" name="jrs_fy_id" class="" id="jrs_fy_id" value=''>
                                    </div>
                                    <div class="col-sm-1">
                                    </div>
                                    <div class="col-sm-1">
                                        <h5>Start Time</h5>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" id="time_picker" class="form-control" name="jrs_start_time" value="05:01 PM" autocomplete="off" />

                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <th colspan="6" class="text-center">CARPET YARN</th>
                                        </tr>
                                        <tr>
                                            <th>Grade</th>
                                            <?php if ($areas) {
                                                foreach ($areas->result() as $area) {
                                            ?>
                                                    <input type="hidden" name="areaID[]" class="form-control" id="" value='<?= $area->ar_id ?>'>
                                                    <th><?= $area->ar_title ?></th>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <?php if ($grades) {
                                            foreach ($grades->result() as $grade) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <?= $grade->j_g_title ?>
                                                        <input type="hidden" name="gradeId[]" class="form-control" id="" value='<?= $grade->j_g_id ?>'>
                                                    </td>
                                                    <?php if ($areas) {
                                                        foreach ($areas->result() as $area) {
                                                    ?>
                                                            <td>
                                                                <input type="text" name="juteRate[]" class="form-control input-number sdf" id="requiredInput" placeholder="<?= str_replace(' ', '', $area->ar_title) . "_" . $grade->j_g_title ?>" value=''>
                                                            </td>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </table>
                                </div>
                                <div class="form-group row col-md-12">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <tr>
                                                <th colspan="6" class="text-center">Moisture</th>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <?php if ($areas) {
                                                    foreach ($areas->result() as $area) {
                                                ?>
                                                        <th><?= $area->ar_title ?></th>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>New</th>
                                                <?php if ($areas) {
                                                    foreach ($areas->result() as $area) {
                                                ?>
                                                        <td><input type="text" name="new[]" class="form-control input-number" id="" placeholder="<?= "new_" . str_replace(' ', '', $area->ar_title) . "%" ?>" value=''></td>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Old</th>
                                                <?php if ($areas) {
                                                    foreach ($areas->result() as $area) {
                                                ?>
                                                        <td><input type="text" name="old[]" class="form-control input-number" id="" placeholder="<?= "old_" . str_replace(' ', '', $area->ar_title) . "%" ?>" value=''></td>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped" id="normalDeduction">
                                                <tr>
                                                    <th colspan="5" class="text-center">Deductions</th>
                                                    <th class="text-center">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="disable-checkbox" checked>
                                                            <label class="form-check-label text-danger">If no SMR Deductions check it.</label>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Out turn (%) from</th>
                                                    <th>Logic from</th>
                                                    <th>Out turn (%) till</th>
                                                    <th>Logic till</th>
                                                    <th>Rate</th>
                                                </tr>
                                                <tbody id="addDeductionItem">
                                                    <tr>
                                                        <td>SMR</td>
                                                        <td><input type="text" name="jr_smr_per_from[]" class="form-control input-number disable-input-by-checkbox" id="jr_smr_per_from" placeholder="%%" value='' required></td>
                                                        <td>
                                                            <select class="form-control select2 disable-input-by-checkbox" style="width: 100%;" id="" name="jr_smr_logic_from[]">
                                                                <option value="">Select</option>
                                                                <option value="<=">
                                                                    <= সামান & অধিক</option>
                                                                <option value=">=">>= পর্যন্ত</option>
                                                                <option value="<">
                                                                    < অধিক</option>
                                                                <option value=">">> কম</option>
                                                                <option value="=">= সামান</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" name="jr_smr_per_till[]" class="form-control input-number disable-input-by-checkbox" id="jr_smr_per_till" placeholder="%%" value=''></td>
                                                        <td>
                                                            <select class="form-control select2 disable-input-by-checkbox" style="width: 100%;" id="" name="jr_smr_logic_till[]">
                                                                <option value="">Select</option>
                                                                <option value="<=">
                                                                    <= সামান & অধিক</option>
                                                                <option value=">=">>= পর্যন্ত</option>
                                                                <option value="<">
                                                                    < অধিক</option>
                                                                <option value=">">> কম</option>
                                                                <option value="=">= সামান</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" name="d_rate[]" class="form-control input-number disable-input-by-checkbox" id="" placeholder="rate" value=''></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <input id="add-deduction-item" class="btn btn-info disable-input-by-checkbox" name="add-new-item" onclick="addInputField('addDeductionItem');" value="Add New" type="button" style="margin: 0px 15px 15px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>





            <!-- ========================== View Last Entry Start ========================== -->

            <div class="col-md-4 mt-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-th"></i> Last Entry Jute Rate Sheets</h3>
                    </div>

                    <?php if (!empty($list)) { ?>
                        <section class="content" style="margin-top:20px">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Financial Year: </h6>
                                                    <h6 class="text-danger"> <?php echo $this->M_financial_year->getFinancialYearById($list->jrs_fy_id)->fy_title; ?></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Start Date: </h5>
                                                <h6 class="text-danger"><?= date("d-m-Y", strtotime($list->jrs_start_date)); ?></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Serial Number: </h5>
                                                <h6 class="text-danger"> <?= $list->jrs_sl_no; ?></h6>
                                            </div>
                                        </div>



                                        <table id="" class="table table-bordered table-hover">
                                            <thead>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>





                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th colspan="6" class="text-center">CARPET YARN</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Grade</th>
                                                        <?php if ($areas) {
                                                            foreach ($areas->result() as $area) {
                                                        ?>
                                                                <input type="hidden" name="areaID[]" class="form-control" id="" value='<?= $area->ar_id ?>'>
                                                                <th><?= $area->ar_title ?></th>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php if ($grades) {
                                                        foreach ($grades->result() as $grade) {
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $grade->j_g_title ?>
                                                                    <input type="hidden" name="gradeId[]" class="form-control" id="" value='<?= $grade->j_g_id ?>'>
                                                                </td>
                                                                <?php if ($areas) {
                                                                    foreach ($areas->result() as $area) {
                                                                ?>
                                                                        <td>
                                                                            <input disabled type="text" value="<?= getJuteRate($grade->j_g_id, $area->ar_id, $list->jrs_id); ?>" name="juteRate[]" class="form-control" id="" placeholder="<?= str_replace(' ', '', $area->ar_title) . "_" . $grade->j_g_title ?>">
                                                                        </td>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->





                                        <!-- Acceptable Moisture -->
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th colspan="6" class="text-center">Acceptable Moisture %</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Type</th>
                                                        <?php if ($areas) {
                                                            foreach ($areas->result() as $area) {
                                                        ?>
                                                                <th><?= $area->ar_title ?></th>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <th>New</th>
                                                        <?php if ($areas) {
                                                            foreach ($areas->result() as $area) {
                                                        ?>
                                                                <td><input disabled type="text" name="new[]" value="<?= getJuteRateMoistureNew($area->ar_id, $list->jrs_id); ?>" class="form-control" id="" placeholder=""></td>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Old</th>
                                                        <?php if ($areas) {
                                                            foreach ($areas->result() as $area) {
                                                        ?>
                                                                <td><input disabled type="text" name="old[]" value="<?= getJuteRateMoistureOld($area->ar_id, $list->jrs_id); ?>" class="form-control" id="" placeholder=""></td>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>


                                        <!-- Deductions -->
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th colspan="6" class="text-center">Deductions</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Out turn (%)</th>
                                                        <th>Out turn (%)</th>
                                                        <th>Out turn (%)</th>
                                                        <th>Out turn (%)</th>
                                                        <th>Rate</th>
                                                    </tr>
                                                    <?php
                                                    $data = $this->M_jute_rate->getSmrDeductionsByJrsId($list->jrs_id);
                                                    if ($data) {
                                                        foreach ($data->result() as $deduction) {
                                                    ?>
                                                            <tr>
                                                                <th>SMR</th>
                                                                <th><?= $deduction->jr_smr_per_from ?></th>
                                                                <th><?= $deduction->jr_smr_logic_from ?></th>
                                                                <th><?= $deduction->jr_smr_per_till ?></th>
                                                                <th><?= $deduction->jr_smr_logic_till ?></th>
                                                                <th><?= $deduction->jr_smr_rate ?></th>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php } else { ?>
                        <section class="content" style="margin-top:20px">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-danger">
                                            Sorry! No jute rate has been entered so far.
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php }  ?>


                </div>
            </div>
        </div>
    </section>
</div>




<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script>
    // ========== Add Deductions row =============
    function addInputField(t) {
        var count = 2;
        var limits = 500;
        if (count == limits) {
            alert("You have reached the limit of adding" + count + "inputs");
        } else {
            //    alert(count);return false;
            var a = "smr_ded_" + count,
                e = document.createElement("tr");
            e.innerHTML = "<td id='" + a + "'>SMR</td>\n\
<td><input type='text' class='form-control input-number' name='jr_smr_per_from[]' id='jr_smr_per_from_" + count + "'></td>\n\
<td><select class='form-control' id='jr_smr_logic_from_'" + count + "' name='jr_smr_logic_from[]' required>\n\
                                                    <option>Select</option>\n\
                                                    <option value='<='><= সামান & অধিক</option>\n\
                                                    <option value='>='>>= পর্যন্ত</option>\n\
                                                    <option value='<'>< অধিক</option>\n\
                                                    <option value='>'>> কম</option>\n\
                                                    <option value='='>= সামান</option>\n\
                                                </select>\n\
                                                </td>\n\
<td><input type='text' class='form-control input-number' name='jr_smr_per_till[]' id='jr_smr_per_till_" + count + "'></td>\n\
<td><select class='form-control' id='jr_smr_logic_till_'" + count + "' name='jr_smr_logic_till[]' required>\n\
                                                    <option>Select</option>\n\
                                                    <option value='<='><= সামান & অধিক</option>\n\
                                                    <option value='>='>>= পর্যন্ত</option>\n\
                                                    <option value='<'>< অধিক</option>\n\
                                                    <option value='>'>> কম</option>\n\
                                                    <option value='='>= সামান</option>\n\
                                                </select>\n\
</td>\n\
<td><input type='text' class='form-control input-number' name='d_rate[]' id='rhythmc_sinus_AF_'" + count + "'></td>\n\
<td><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>\n\
",
                document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++;
        }
    }
    // ============= row delete dynamically =========
    function deleteRow(t) {
        var a = $("#normalDeduction > tbody > tr").length;
        if (1 == a) {
            alert("There only one row you can't delete it.");
        } else {
            var e = t.parentNode.parentNode;
            e.parentNode.removeChild(e);
        }
    }
</script>



<script type="text/javascript">
    $(document).ready(function() {

        //automatic get financial year id
        var jrs_start_date = $('#jrs_start_date').val();

        getFy(jrs_start_date);

        function getFy(jrs_start_date) {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('setup/Jute_rate/ajaxFinancialYear') ?>",
                data: {
                    jrs_start_date: jrs_start_date,
                },
                success: function(data) {

                    if (data == 'no') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops !!!!!!!!!!!!!',
                            text: 'No Financial Year found under this (' + jrs_start_date + ') date ',

                        })
                        $("#jrs_start_date").val('');
                        $("#jrs_fy_id").val('');
                        $("#jrs_sl_no").val('');
                    } else {
                        var result = JSON.parse(data);

                        $("#jrs_fy_id").val(result.fy_id);
                        $("#jrs_sl_no").val(result.new_rate_sl);
                    }
                }

            });
        }

        $("#jrs_start_date").on('change', function() {
            jrs_start_date = $(this).val();
            getFy(jrs_start_date);

        });
        //END automatic get financial year id




        // Check Serial number
        $("#jrs_sl_no").blur(function() {
            var jrs_sl_no = $('#jrs_sl_no').val();
            // alert(jrs_sl_no);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('setup/Jute_rate/ajaxSerialNumberCheckForJuteRate') ?>",
                data: {
                    jrs_sl_no: jrs_sl_no
                },
                success: function(data) {
                    console.log(data)
                    if (data == 0) {
                        $("#jrs_sl_no").val(jrs_sl_no);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Serial No. ' + jrs_sl_no,
                            text: 'This serial number is already in used',

                        })
                        $("#jrs_sl_no").val('');
                    }

                }

            });
        });




        /* =========== MOdified By Rimon - For Disable SMR Deduction =========== */
        // Disable SMR Deduction Field if have no SMR 
        $("#disable-checkbox").click(function() {

            if ($("#disable-checkbox").is(':checked') == true) {
                $('.disable-input-by-checkbox').prop('disabled', true)
                // $(".disable-input-by-checkbox").prop("readonly", true);
                // console.log('HELLO');
            } else {
                $('.disable-input-by-checkbox').prop('disabled', false)
                // $(".disable-input-by-checkbox").prop("readonly", false);
                // console.log('NOT WORKING');
            }
        })

        //Murad 13.8.22 Disable SMR logic
        $('.disable-input-by-checkbox').prop('disabled', true)




    });
</script>