 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <section class="content-header">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-sm-6">
                     <h1>Update Assorted Cut Deduction</h1>
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
                         <li class="breadcrumb-item active"><a
                                 href="<?php echo base_url('list_assorted_cut_deduction'); ?>">Back to Assorted Cut
                                 Deduction Summary</a></li>
                         <li class="breadcrumb-item active">Update Assorted Cut Deduction</li>
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
                     <div class="card card-info mt-3">
                         <div class="card-header">
                             <h3 class="card-title"><i class="fa fa-edit"></i> Update Assorted Cut Deduction</h3>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form role="form" action="<?php echo base_url('update_assorted_cut_deduction'); ?>"
                             method="post">
                             <div class="card-body">
                                 <div class="row">
                                     <table class="table table-striped">
                                         <tr>
                                             <th>Date</th>
                                             <th>Khamal No.</th>
                                             <th>Bojha No.</th>
                                             <th>Net Weight</th>
                                             <?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
                                             <th><?= $grade->j_g_title ?></th>
                                             <?php } ?>
                                             <th>Total</th>
                                             <th>Comments</th>
                                         </tr>
                                         <tbody>
                                             <tr>
                                                 <td><input type="text" name="kh_ac_d_v_date" id="kh_ac_d_v_date"
                                                         style="width: 100px;" class="form-control datepicker"
                                                         placeholder=""
                                                         value='<?= date("d-m-Y", strtotime($editAssortedCutDeductionView->kh_ac_d_s_date)) ?>'>
                                                     <input type="hidden" name="kh_ac_d_v_fy_id" class="form-control"
                                                         id="kh_ac_d_v_fy_id" placeholder="" value=''>
                                                 </td>
                                                 <td>
                                                     <div class="form-group col-sm-12 ml-0">
                                                         <select class="form-control select2" style="width:170px;"
                                                             name="kh_ac_d_v_kh_id" id="khamal_id" required>
                                                             <option value="">Select Khamal</option>
                                                             <?php if ($khamals) {
																	foreach ($khamals->result() as $khamal) {
																		if ($khamal->kh_used == 3) { ?>
                                                             <option value="<?= $khamal->kh_id; ?>" <?php if (!empty($editAssortedCutDeductionView)) {
																													if ($editAssortedCutDeductionView->kh_ac_d_s_kh_id == $khamal->kh_id) {
																														echo "selected";
																													}
																												} ?>><?= $khamal->kh_title; ?></option>
                                                             <?php }
																	}
																} ?>
                                                         </select>
                                                     </div>
                                                 </td>
                                                 <td><input type="text" name="kh_ac_d_v_bojha_no"
                                                         class="form-control input-number-minus-allow"
                                                         placeholder="Enter Bojha No"
                                                         value='<?= $editAssortedCutDeductionView->kh_ac_d_s_bojha_no ?>'
                                                         required></td>
                                                 <td><input type="text" name="kh_ac_d_v_avg_weight"
                                                         class="form-control input-number-minus-allow"
                                                         placeholder="Enter Avg. Weight"
                                                         value='<?= $editAssortedCutDeductionView->kh_ac_d_s_avg_weight ?>'>
                                                 </td>

                                                 <?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
                                                 <!-- Readonly Input Field By First Grade Wise Entry Data -->
                                                 <?php
														$id = $grade->j_g_id;
														$data = array(
															'kh_ac_d_v_kh_id' => $editAssortedCutDeductionView->kh_ac_d_s_kh_id,
															'kh_ac_d_v_j_g_id' => $grade->j_g_id,
															'kh_ac_d_v_status' => 1
														);
														$getValue = $this->M_khamal->getPreviousInsertedValue('khamal_assorted_cut_deduction_value', $data);
														?>
                                                 <!-- /.Readonly Input Field By First Grade Wise Entry Data -->
                                                 <td>
                                                     <input type="hidden" name="kh_ac_d_v_value_id[]"
                                                         value='<?= getAssortedCutDeductionValueId($grade->j_g_id, $assortedCutDeductionSummaryId); ?>'>
                                                     <input type="text" name="kh_ac_d_v_value[]"
                                                         class="form-control gradeWeight input-number-minus-allow"
                                                         id="gradeWeight<?= $grade->j_g_id ?>"
                                                         placeholder="<?= $grade->j_g_title ?>"
                                                         value='<?= getAssortedCutDeductionValue($grade->j_g_id, $assortedCutDeductionSummaryId); ?>' <?php if ($getValue) {
																																																																																				echo ($getValue->kh_ac_d_v_value > 0) ? true : "readonly";
																																																																																			} ?>>
                                                 </td>
                                                 <?php } ?>
                                                 <td><input type="text" name="kh_ac_d_v_total" class="form-control"
                                                         id="total" placeholder="Total"
                                                         value='<?= $editAssortedCutDeductionView->kh_ac_d_s_total ?>'
                                                         readonly></td>
                                                 <td><input type="text" name="kh_ac_d_v_comments" class="form-control"
                                                         id="" placeholder="Comments"
                                                         value='<?= $editAssortedCutDeductionView->kh_ac_d_s_comments ?>'>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                                 <input type="hidden" name="kh_ac_d_v_id"
                                     value="<?= $editAssortedCutDeductionView->kh_ac_d_s_id; ?>">
                             </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                 <div class="pull-right">
                                     <button type="submit" class="btn btn-info" id="submitButton">Save Changes</button>
                                     <a href="<?php echo base_url('list_assorted_cut_deduction'); ?>" type="submit"
                                         class="btn btn-secondary">Cancel</a>
                                 </div>
                             </div>
                         </form>
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

    var groupId = []
    <?php
			foreach ($jute_grades->result() as $grade) {
			?>
    groupId.push('<?= $grade->j_g_id ?>')

    <?php } ?>
    $("#submit").hide();

    $(".gradeWeight").keyup(function() {
        var x = $(this).val();
        //alert(x);
        allTotal = 0;

        for (let i = 0; i < groupId.length; i++) {
            otPer = 0;

            id = groupId[i];
            idName = 'gradeWeight' + id;
            otPer = $("#" + idName).val() || 0;

            allTotal = (parseFloat(allTotal) + parseFloat(otPer));

        }

        $('#total').val(allTotal);
        // Disable Enable Submit Button
        enableDisableSubmitButton()
    });


    // Disable Enable Submit Button
    enableDisableSubmitButton()

    function enableDisableSubmitButton() {
        var totalValue = $('#total').val();

        if ((totalValue == undefined) || (totalValue == 0) || (totalValue == null) || (totalValue.length ==
            0) || isNaN(totalValue)) {
            $('#submitButton').prop('disabled', true);
        } else {
            $('#submitButton').prop('disabled', false);
        }
    }



    //automatic get financial year id
    var kh_ac_d_v_date = $('#kh_ac_d_v_date').val();
    getFy(kh_ac_d_v_date);

    function getFy(kh_ac_d_v_date) {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('jute/Khamal/ajaxFinancialYearForAssortedCutDeduction') ?>",
            data: {
                kh_ac_d_v_date: kh_ac_d_v_date,
            },
            success: function(data) {

                if (data == 'no') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ops !!!!!!!!!!!!!',
                        text: 'No Financial Year found under this (' + kh_ac_d_v_date +
                            ') date ',
                    })
                    $("#kh_ac_d_v_date").val('');
                    $("#kh_ac_d_v_fy_id").val('');
                } else {
                    $("#kh_ac_d_v_fy_id").val(data);
                    //  alert(data);
                }
            }
        });
    }
    $("#kh_ac_d_v_date").on('change', function() {
        kh_ac_d_v_date = $(this).val();
        getFy(kh_ac_d_v_date);

    });
    //END automatic get financial year id

    // Enable Disable Input by khamal id previous 
    $("#khamal_id").on("change", function() {
        var khamal_id = $("select#khamal_id option:selected").val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('jute/Khamal/getPreviousAssortedCutAddedValueByKhamalId') ?>",
            data: {
                khamal_id: khamal_id
            },
            success: function(data) {
                var datas = JSON.parse(data) //json to javascript object
                var previous_data = datas.previous_data;

                console.log(previous_data)

                if (previous_data) {

                    $.each(previous_data, function(key, value) {


                        id = groupId[key];
                        idName = 'gradeWeight' + id;

                        if (value.kh_ac_a_v_value != 0) {
                            $("#" + idName).prop('readonly', false);
                        } else {
                            $("#" + idName).prop('readonly', true);
                        }

                    });
                } else {
                    for (let i = 0; i < groupId.length; i++) {

                        id = groupId[i];
                        idName = 'gradeWeight' + id;

                        $("#" + idName).prop('readonly', false);

                    }
                }



            }
        });
    });



});
 </script>
