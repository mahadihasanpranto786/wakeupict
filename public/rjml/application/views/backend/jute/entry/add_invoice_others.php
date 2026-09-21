 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <!-- left column -->
                 <div class="col-md-12">
                     <!-- general form elements -->
                     <div class="card card-info mt-3">
                         <div class="card-header">
                             <h3 class="card-title">Add Invoice (Others)</h3>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form role="form" action="<?php echo base_url(); ?>jute/Entry/insertContractInvoice"
                             method="post">
                             <input type="hidden" name="jute_rate_summary_table_id" value="">
                             <input type="hidden" name="contract_sl_no" value="">
                             <input type="hidden" name="bill_type" class="form-control" id="" placeholder="Custom"
                                 value="3">
                             <div class="card-body">
                                 <input type="hidden" name="ot_id" value="<?= $ot_id ?>">
                                 <div class="row">
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Name of Supplier</label>
                                         <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder=""
                                             value="<?= $this->M_supplier->getSupplierById($outTurnReport->ot_en_s_id)->s_title ?>"
                                             readonly>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Party Chalan No</label>
                                         <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder="" value="<?= $outTurnReport->ot_en_chalan_no; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Mill Lot No</label>
                                         <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder="" value="<?= $outTurnReport->ot_lot_no; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Entry Date</label>
                                         <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                             value="<?= date("d-m-Y", strtotime($outTurnReport->ot_en_date)); ?>"
                                             readonly>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Mokam</label>
                                         <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder=""
                                             value="<?= $this->M_mokam->getMokamById($outTurnReport->ot_en_mo_id)->mo_title ?>"
                                             readonly>
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Area</label>
                                         <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder="" value="<?php $en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($outTurnReport->ot_fy_id, $outTurnReport->ot_lot_no)->en_jute_variety;
																																		if ($en_jute_variety == 'Normal' or $en_jute_variety == "Knaf" or $en_jute_variety == "White") {
																																			echo $this->M_area->getAreaById($outTurnReport->ot_ar_id)->ar_title;
																																		} else {
																																			echo $en_jute_variety;
																																		} ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Licence No</label>
                                         <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder="" value="" readonly>
                                     </div>
                                 </div>
                                 <div class="row mt-3">
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Jute Type</label>
                                         <input type="text" name="ot_jute_type" class="form-control"
                                             id="exampleInputEmail1" placeholder=""
                                             value="<?= $outTurnReport->ot_jute_type; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Received Jute Moisture %</label>
                                         <input type="number" name="ot_moisture" class="form-control"
                                             id="receivedJuteMoisture" placeholder=""
                                             value="<?= $outTurnReport->ot_moisture; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Acceptable Moisture %</label>
                                         <input type="text" name="acceptableMoisture" class="form-control input-number"
                                             id="acceptableMoisture" placeholder="" value="" required>
                                     </div>
                                     <!-- <div class="form-group col-sm-2">
 										<label for="exampleInputEmail1">Allow extra moisture %</label>
 										<input type="text" name="" class="form-control" id="extraSar" placeholder="" value="">
 									</div> -->
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Extra Moisture %</label>
                                         <input type="number" name="extra_moisture" id="extraMoisture"
                                             class="form-control" id="exampleInputEmail1" placeholder="" value=""
                                             readonly>
                                     </div>
                                 </div>
                                 <div class="row mt-3">
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Received Bojha/Bale</label>
                                         <input type="number" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder="" value="<?= $outTurnReport->ot_rec_bojha; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Net Weight</label>
                                         <input type="number" name="" class="form-control" id="exampleInputEmail1"
                                             placeholder="" value="<?= $outTurnReport->ot_net_weight; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Kgs (After .5% deduction)</label>
                                         <input type="number" name="" class="form-control" id="kgs_old" placeholder=""
                                             value="<?= $outTurnReport->ot_kgs; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Kgs (After Moisture deduction)</label>
                                         <input type="number" name="" class="form-control" id="kgs_final" placeholder=""
                                             value="" readonly>
                                     </div>
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Mds</label>
                                         <input type="number" name="mds_after_moisture_deduction" class="form-control"
                                             id="mds" placeholder="" value="" readonly>
                                     </div>
                                 </div>
                                 <hr style="border-width: 3px;">
                                 <!-- Table -->
                                 <table id="" class="table table-borderless">
                                     <thead>
                                         <tr>
                                             <th>Grade</th>
                                             <th>Out Turn %</th>
                                             <th>Rate</th>
                                             <th>Out turn (Mds)</th>
                                             <th>Amount</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php if ($grades) {
												foreach ($grades->result() as $grade) {
											?>
                                         <tr>
                                             <td>
                                                 <?= $grade->j_g_title ?>
                                                 <input type="hidden" name="gradeId[]" id=""
                                                     value='<?= $grade->j_g_id ?>'>
                                             </td>
                                             <td class="align-middle"><input type="text" name="outTurnPer[]"
                                                     class="form-control" id="outertonPer<?= $grade->j_g_title ?>"
                                                     placeholder=""
                                                     value="<?= getOutTurnPer($grade->j_g_id, $outTurnReport->ot_id); ?>"
                                                     readonly></td>
                                             <td class="align-middle"><input type="text" name="grade_wise_rate[]"
                                                     class="form-control input-number"
                                                     id="juteRate<?= $grade->j_g_title ?>"
                                                     data-id="<?= $grade->j_g_title ?>" value=""></td>
                                             <td class="align-middle"><input type="text" name="grade_wise_mds[]"
                                                     class="form-control sumOutTorn"
                                                     id="outturn_mds<?= $grade->j_g_title ?>" placeholder="" value=""
                                                     readonly></td>
                                             <td class="align-middle"><input type="text" name="grade_wise_amount[]"
                                                     class="form-control grade_wise_amount"
                                                     id="totalAmount<?= $grade->j_g_title ?>" placeholder="" value="0"
                                                     readonly></td>
                                         </tr>
                                         <?php
												}
											}
											?>

                                         <tr>
                                             <td class="align-middle">Total</td>
                                             <td class="align-middle"></td>
                                             <td class="align-middle"></td>
                                             <td class="align-middle"><input type="text" name="" class="form-control"
                                                     id="sumOutTorn" placeholder="" value="" readonly></td>
                                             <td class="align-middle"><input type="text" name="total_amount"
                                                     class="form-control" id="sumAmount" placeholder="" value=""
                                                     readonly></td>
                                         </tr>
                                         <tr>
                                             <td class="align-middle" colspan="">Taka in Words</td>
                                             <td class="align-middle" colspan="2"><input type="text" name=""
                                                     class="form-control" id="exampleInputEmail1"
                                                     placeholder="Will Auto Calculate"></td>
                                             <td align="right" colspan="">
                                                 <h6 class="font-weight-bold">Avg rate</h6>
                                             </td>
                                             <td class="align-middle" colspan="">
                                                 <input type="text" name="" class="form-control" id="avarageRaye"
                                                     placeholder="" value="" readonly>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                                 <input type="hidden" name="">
                             </div>
                             <!-- /.card-body -->
                             <div class="card-footer">
                                 <div class="pull-right">
                                     <button type="submit" class="btn btn-info">Submit</button>

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

    var idGroup = [];
    <?php
			foreach ($grades->result() as $grade) {
			?>
    idGroup.push('<?= $grade->j_g_title ?>');
    <?php
			}
			?>
    calculateFinalKgs(0, 0, idGroup);
    totalAmountCount();
    var kgs_old = $("#kgs_old").val();

    //-------------------------------
    $("#acceptableMoisture").keyup(function() {
        var acceptableMoisture = $(this).val();
        calculateFinalKgs(acceptableMoisture, 0, idGroup);
    });

    $("#extraSar").keyup(function() {
        var acceptableMoisture = $('#acceptableMoisture').val();
        var extraSar = $(this).val();
        calculateFinalKgs(acceptableMoisture, extraSar, idGroup);
    });

    //calculate Kgs (After Moisture deduction) and Mds
    function calculateFinalKgs(acceptableMoisture, extraSar, idGroup) {
        var kgs_old = $("#kgs_old").val();
        var receivedJuteMoisture = $("#receivedJuteMoisture").val();
        //var acceptableMoisture = $("#acceptableMoisture").val();
        var final = receivedJuteMoisture - acceptableMoisture - extraSar;
        if (final < 0) {
            $("#extraMoisture").val(0);
            kgs_final = kgs_old;
            mds = kgs_final / 40;
            $("#kgs_final").val(kgs_final);
            $("#mds").val(mds);
            finalOuterTurnCalculation(mds);
        } else {
            $("#extraMoisture").val(final);
            kgs_final = kgs_old - ((kgs_old * final) / 100);
            mds = kgs_final / 40;
            $("#kgs_final").val(kgs_final);
            $("#mds").val(mds);
            finalOuterTurnCalculation(mds);
        }
    }
    //-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    //calculate Out turn (Mds)
    function finalOuterTurnCalculation(mds) {
        for (let i = 0; i < idGroup.length; i++) {
            p = idGroup[i];
            outerton = 'outturn_mds' + p;
            outertonPer = 'outertonPer' + p;
            outertonPer = $("#" + outertonPer).val();
            finalmds = (mds * outertonPer) / 100;
            $("#" + outerton).val(finalmds);



            //  code modify by ab siddique start
            totalAmount = 'totalAmount' + p;
            juteRate = 'juteRate' + p;

            if ($("#" + juteRate).val() == "") {
                ab_work = 1;
            } else {
                ab_work = $("#" + juteRate).val();
            }
            total_mds_ammount = parseFloat(finalmds) * parseFloat(ab_work);
            $("#" + totalAmount).val(total_mds_ammount);

            var sumAmount = 0;
            $(".grade_wise_amount").each(function() {
                sumAmount += parseFloat($(this).val());
            });
            $("#sumAmount").val(sumAmount);
            //  code modify by ab siddique end



        }
        totalAmountCount();
    }
    //-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -

    //-----------------------------------------
    function totalAmountCount() {
        for (let i = 0; i < idGroup.length; i++) {
            p = idGroup[i];
            t = 'juteRate' + p;

            $("#" + t).keyup(function() {
                iid = $(this).attr("data-id");
                outerton = 'outturn_mds' + iid;
                outerton = $("#" + outerton).val();

                id = $(this).attr("id");
                juteRate = $("#" + id).val();


                //  code modify by ab siddique end
                if (juteRate == "") {
                    ab_work_jute = 1;

                } else {
                    ab_work_jute = juteRate;
                }
                //  code modify by ab siddique end



                gradeAmount = (parseFloat(ab_work_jute) * parseFloat(outerton));
                gradeWiseAmount = 'totalAmount' + iid;
                $("#" + gradeWiseAmount).val(gradeAmount);

                var sumAmount = 0;
                $(".grade_wise_amount").each(function() {
                    sumAmount += parseFloat($(this).val());
                });
                $("#sumAmount").val(sumAmount);

            });
        }

        var sumOutTorn = 0;
        $(".sumOutTorn").each(function() {
            sumOutTorn += parseFloat($(this).val());
        });
        $("#sumOutTorn").val(sumOutTorn);
    }
    //------------------------------------

    //----------------------
    function avarageRate() {
        o = $("#sumOutTorn").val();
        a = $("#sumAmount").val();
        q = (parseFloat(a) / parseFloat(o));
        $("#avarageRaye").val(q);
        take();
    }


    function take() {
        a = $("#sumAmount").val();
    }

});
 </script>

 <script src="<?php echo base_url('') ?>assets/backend/jquery.num2words.js"></script>