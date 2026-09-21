 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <section class="content-header">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-sm-6">
                     <h1>Update Jute Sell</h1>
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
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('list_jute_sell'); ?>">Back to Jute Sell List</a></li>
                         <li class="breadcrumb-item active">Update Jute Sell</li>
                     </ol>
                 </div>
             </div>
         </div>
     </section>

     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card card-info mt-3">
                         <div class="card-header">
                             <h3 class="card-title">Update Jute Sell</h3>
                         </div>
                         <form role="form" action="<?php echo base_url('update_jute_sell'); ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="form-group col-sm-3">
                                         <label>Client Name</label>
                                         <span class="text-danger">*</span>
                                         <select type="text" name="jsv_c_id" id="" class="form-control select2" style="width: 100%;" required>
                                             <option value="">Please Select One</option>
                                             <?php if ($clients) foreach ($clients->result() as $client) { ?>
                                                 <option value="<?= $client->c_id; ?>" <?php if (!empty($editJS)) {
                                                                                            if ($editJS->jss_c_id == $client->c_id) {
                                                                                                echo "selected";
                                                                                            }
                                                                                        } ?>><?= $client->c_title; ?></option>
                                             <?php } ?>
                                         </select>
                                     </div>
                                     <!-- <div class="form-group col-sm-3">
                                         <label>Jute variety</label>
                                         <select class="form-control select2" style="width: 100%;" name="jsv_jute_variety" required>
                                             <option value="">Select</option>
                                             <option value="Normal" <?php
                                                                    if (!empty($editJS->jss_jute_variety)) {
                                                                        if ($editJS->jss_jute_variety == 'Normal') {
                                                                            echo 'selected';
                                                                        }
                                                                    } ?>>Normal</option>
                                             <option value="WH" <?php
                                                                if (!empty($editJS->jss_jute_variety)) {
                                                                    if ($editJS->jss_jute_variety == 'WH') {
                                                                        echo 'selected';
                                                                    }
                                                                } ?>>WH</option>
                                             <option value="KF" <?php
                                                                if (!empty($editJS->jss_jute_variety)) {
                                                                    if ($editJS->jss_jute_variety == 'KF') {
                                                                        echo 'selected';
                                                                    }
                                                                } ?>>KF</option>
                                             <option value="Cutting" <?php
                                                                        if (!empty($editJS->jss_jute_variety)) {
                                                                            if ($editJS->jss_jute_variety == 'Cutting') {
                                                                                echo 'selected';
                                                                            }
                                                                        } ?>>Cutting</option>
                                             <option value="TW" <?php
                                                                if (!empty($editJS->jss_jute_variety)) {
                                                                    if ($editJS->jss_jute_variety == 'TW') {
                                                                        echo 'selected';
                                                                    }
                                                                } ?>>TW</option>
                                         </select>
                                     </div> -->

                                     <!-- <div class="form-group col-sm-2">
                                         <label>Jute variety</label>
                                         <select class="" style="width: 100%;" name="jsv_jute_variety" required>
                                             <//?php
                                                $selected = ($this->input->post('jsv_jute_variety')) ? $this->input->post('jsv_jute_variety') : $editJS->jss_jute_variety;;
                                                $jsv_jute_variety = array("Normal" => "Normal", "WH" => "WH", "KF" => "KF", "Cutting" => "Cutting", "TW" => "TW");
                                                echo form_dropdown('jss_jute_variety', $jsv_jute_variety, $selected);
                                                ?>
                                         </select>
                                     </div> -->

                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Date</label>
                                         <input type="text" name="jsv_date" id="jsv_date" id="date" value="<?php if ($editJS) {
                                                                                                                echo date("d-m-Y", strtotime($editJS->jss_date));
                                                                                                            } ?>" class="form-control datepicker" placeholder="Enter Date" required>
                                         <input type="hidden" name="jsv_fy_id" class="form-control" id="jsv_fy_id" placeholder="" value='<?php if ($editJS) {
                                                                                                                                                echo $editJS->jss_fy_id;
                                                                                                                                            } ?>'>
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label>Jute Area</label>
                                         <span class="text-danger">*</span>
                                         <select type="text" name="jsv_ar_id" id="" class="form-control select2" style="width: 100%;" required>
                                             <option>Please Select One</option>
                                             <?php if ($areas) foreach ($areas->result() as $area) { ?>
                                                 <option value="<?= $area->ar_id; ?>" <?php if (!empty($editJS)) {
                                                                                            if ($editJS->jss_ar_id == $area->ar_id) {
                                                                                                echo "selected";
                                                                                            }
                                                                                        } ?>><?= $area->ar_title; ?></option>
                                             <?php } ?>
                                         </select>
                                     </div>
                                 </div>


                                 <div class="row mt-2">
                                     <table class="table table-striped">
                                         <thead>
                                             <tr>
                                                 <th>Grades</th>
                                                 <th>Quantity (Mds)</th>
                                                 <th>Rate (Per Mds)</th>
                                                 <th>Amount</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php if ($jute_grades) {
                                                    foreach ($jute_grades->result() as $grade) { ?>
                                                     <tr>
                                                         <td>
                                                             <?= $grade->j_g_title ?>
                                                             <input type="hidden" name="jsv_j_g_id[]" class="form-control" id="exampleInputEmail1" placeholder="" value="<?= $grade->j_g_id ?>">
                                                         </td>
                                                         <td>
                                                             <input type="hidden" name="jsv_value_id[]" class="form-control" id="" value="<?= getJuteSellValueId($grade->j_g_id, $jsSummaryId); ?>" placeholder="Enter Jute Weight (kg)">
                                                             <input type="text" name="jsv_weight[]" class="form-control auto-calc js_weight input-number" id="js_weight<?= $grade->j_g_id ?>" value="<?= getJuteSellWeightValue($grade->j_g_id, $jsSummaryId); ?>" placeholder="Enter Jute Weight (kg)">
                                                         </td>
                                                         <td>
                                                             <input type="text" name="jsv_rate[]" class="form-control auto-calc js_rate input-number" id="rate" value="<?= getJuteSellRateValue($grade->j_g_id, $jsSummaryId); ?>" placeholder="Enter Rate">
                                                         </td>
                                                         <td>
                                                             <input type="text" name="jsv_amount[]" class="form-control js_balance readonly" id="js_balance<?= $grade->j_g_id ?>" value="<?= getJuteSellAmountValue($grade->j_g_id, $jsSummaryId); ?>" placeholder="Total Taka">
                                                         </td>
                                                     </tr>
                                             <?php }
                                                } ?>
                                             <!-- For Total Amount -->
                                             <tr>
                                                 <td>Total</td>
                                                 <td>
                                                     <input type="text" name="jsv_total_weight" class="form-control readonly" id="totalJuteWeight" value="<?= $editJS->jss_total_weight ?>" placeholder="Total Weight" required>
                                                 </td>
                                                 <td>

                                                 </td>
                                                 <td>
                                                     <input type="text" name="jsv_total_amount" class="form-control total-amount readonly" id="total-amount" value="<?= $editJS->jss_total_amount ?>" placeholder="Total Taka" required>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>

                                 <input type="hidden" name="jsv_id" value="<?php if ($editJS) {
                                                                                echo $editJS->jss_id;
                                                                            } ?>">
                             </div>
                             <div class="card-footer">
                                 <div class="pull-right">
                                     <button type="submit" class="btn btn-info">Save Changes</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 </div>

 <!-- Script -->
 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <script type="text/javascript">
     // Grand Total Sum
     $(document).ready(function() {

         var groupId = []
         <?php foreach ($jute_grades->result() as $grade) {
            ?>
             groupId.push('<?= $grade->j_g_id ?>')
         <?php } ?>
         //Tota lJute Weight
         $(".js_weight").keyup(function() {
             var x = $(this).val();
             allTotal = 0;

             for (let i = 0; i < groupId.length; i++) {
                 rate = 0;

                 id = groupId[i];
                 idName = 'js_weight' + id;
                 rate = $("#" + idName).val() || 0;
                 allTotal = (parseFloat(allTotal) + parseFloat(rate));
             }
             $('#totalJuteWeight').val(allTotal);
         });




         //automatic get financial year id
         var jsv_date = $('#jsv_date').val();
         getFy(jsv_date);

         function getFy(jsv_date) {
             $.ajax({
                 type: 'POST',
                 url: "<?php echo base_url('setup/Client/ajaxFinancialYearForJuteSell') ?>",
                 data: {
                     jsv_date: jsv_date,
                 },
                 success: function(data) {

                     if (data == 'no') {
                         Swal.fire({
                             icon: 'error',
                             title: 'Ops !!!!!!!!!!!!!',
                             text: 'No Financial Year found under this (' + jsv_date + ') date ',
                         })
                         $("#jsv_date").val('');
                         $("#jsv_fy_id").val('');
                     } else {
                         $("#jsv_fy_id").val(data);
                         //  alert(data);
                     }
                 }
             });
         }
         $("#jsv_date").on('change', function() {
             jsv_date = $(this).val();
             getFy(jsv_date);

         });
         //END automatic get financial year id







     });

     // Row data auto calculation
     $(document).on("keyup change paste", "td > input.auto-calc", function() {

         row = $(this).closest("tr");

         first = row.find("td input.js_weight").val();
         second = row.find("td input.js_rate").val();

         row.find(".js_balance").val(first * second);

         // Update total value
         var sum = 0;
         $("input.js_balance").each(function() {
             sum += +$(this).val();
         });
         $("#total-amount").val(sum);
     });
 </script>



 </div>
 <!-- /.content-wrapper -->