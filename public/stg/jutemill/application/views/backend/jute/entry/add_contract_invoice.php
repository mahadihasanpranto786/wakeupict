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
                             <h3 class="card-title">Add Contract Invoice</h3>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form role="form" action="<?php echo base_url(); ?>jute/Entry/insertContractInvoice"
                             method="post">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Bill Type</label>
                                         <input type="text" name="" class="form-control" id="" placeholder=""
                                             value="<?= $bill_type ?>" readonly>
                                         <input type="hidden" name="bill_type" class="form-control" id=""
                                             placeholder="Contract" value="2">
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label for="exampleInputEmail1">Jute Rate Basis Sl No</label>
                                         <input type="number" class="form-control" id="" placeholder=""
                                             value="<?= $this->M_jute_rate->getJuteRateByJrsId($jute_rate_summary_table_id)->jrs_sl_no ?>"
                                             readonly>
                                         <input type="hidden" name="jute_rate_summary_table_id"
                                             value="<?= $jute_rate_summary_table_id ?>">
                                     </div>
                                     <div class="form-group col-sm-3">
                                         <label>Contract Sl No</label>
                                         <input type="number" name="contract_sl_no" class="form-control" id=""
                                             placeholder="" value="<?= $contract_sl_no ?>" readonly>
                                     </div>
                                     <!--all data from out_turn_summary table-->
                                     <input type="hidden" name="ot_id" value="<?= $ot_id ?>">
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
                                         <input type="text" name="acceptableMoisture"
                                             class="form-control input-number-minus-allow" id="acceptableMoisture"
                                             placeholder="" value="<?= $acceptableMoisture; ?>" readonly>
                                     </div>
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Allow extra moisture %</label>
                                         <input type="text" name="" class="form-control" id="extraSar" placeholder=""
                                             value="" <?php
																																$accptableDeductRecived = $outTurnReport->ot_moisture - $acceptableMoisture;
																																if ($accptableDeductRecived > 0) {
																																} else {
																																	echo 'readonly';
																																}

																																?>>
                                     </div>
                                     <div class="form-group col-sm-2">
                                         <label for="exampleInputEmail1">Extra Moisture %</label>
                                         <input type="number" name="extra_moisture" id="extraMoisture"
                                             class="form-control" id="exampleInputEmail1" placeholder="" value="<?php
																																											$accptableDeductRecived = $outTurnReport->ot_moisture - $acceptableMoisture;
																																											if ($accptableDeductRecived > 0) {
																																												echo $accptableDeductRecived;
																																											} else {
																																												echo 0;
																																											}

																																											?>" readonly>
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
                                             <th>Jute Rate Basis SL. NO - <span
                                                     class="text-danger font-weight-bold"><?= $this->M_jute_rate->getJuteRateByJrsId($jute_rate_summary_table_id)->jrs_sl_no ?></span>
                                             </th>
                                             <th class="nai">Jute Rate Basis SL. NO - <span
                                                     class="text-danger font-weight-bold"><?= $this->M_jute_rate->getJuteRateByJrsId($jute_rate_summary_table_id)->jrs_sl_no ?></span>
                                             </th>
                                             <th width="15%" class="border">
                                                 <input type="radio" name="contract" id="activeIndividualExtra"
                                                     value="Contract" class="showHideInputField"> Individual Extra
                                                 <br>
                                                 <input type="radio" name="contract" id="activeAllExtra" value=""
                                                     class="showHideInputField"> Extra to all
                                                 <br>
                                                 <input type="radio" name="contract" id="mdsYesContract"
                                                     value="mds_contract" class="showHideInputField mb-2"> Mds Rate
                                                 <br>
                                                 <input type="text" class="input-number-minus-allow form-control"
                                                     name="" id="allExtra" value="" placeholder="Extra to all ">
                                                 <input type="text" class="input-number-minus-allow form-control"
                                                     name="mds_wise_rate" id="allExtraMds" value=""
                                                     placeholder="Mds Rate">
                                             </th>
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
                                             <td class="align-middle">
                                                 <input type="text" name="outTurnPer[]" class="form-control"
                                                     id="outertonPer<?= $grade->j_g_title ?>" placeholder=""
                                                     value="<?= getOutTurnPer($grade->j_g_id, $outTurnReport->ot_id); ?>"
                                                     readonly>
                                             </td>
                                             <td class="align-middle mdsSelected">
                                                 <input type="text" name="grade_wise_rate[]" class="form-control"
                                                     id="juteRate<?= $grade->j_g_title ?>" placeholder=""
                                                     value="<?= getJuteRateForContract($jute_rate_summary_table_id, $outTurnReport->ot_ar_id, $grade->j_g_id, $outTurnReport->ot_id); ?>"
                                                     readonly>
                                                 <!-- Default Value -->
                                                 <input type="hidden" name="" class="form-control"
                                                     id="previousJuteRate<?= $grade->j_g_title ?>" placeholder=""
                                                     value="<?= getJuteRateForContract($jute_rate_summary_table_id, $outTurnReport->ot_ar_id, $grade->j_g_id, $outTurnReport->ot_id); ?>"
                                                     readonly>
                                             </td>
                                             <td class="align-middle nai">
                                                 <input type="text" name="" class="form-control"
                                                     id="juteRateShow<?= $grade->j_g_title ?>" placeholder=""
                                                     value="<?= getJuteRateForContract($jute_rate_summary_table_id, $outTurnReport->ot_ar_id, $grade->j_g_id, $outTurnReport->ot_id); ?>"
                                                     readonly>
                                             </td>
                                             <td class="mdsSelected">
                                                 <div class="individualExtra">
                                                     <input type='text'
                                                         class="addExtraInput input-number-minus-allow form-control"
                                                         id='addExtra<?= $grade->j_g_title ?>'
                                                         o-oldValue='<?= getJuteRateForContract($jute_rate_summary_table_id, $outTurnReport->ot_ar_id, $grade->j_g_id, $outTurnReport->ot_id); ?>'
                                                         o-id='<?= $grade->j_g_title ?>' name='<?= $grade->j_g_title ?>'
                                                         value="" placeholder="Add Extra">
                                                 </div>
                                             </td>
                                             <td class="align-middle"><input type="text" name="grade_wise_mds[]"
                                                     class="form-control" id="outturn_mds<?= $grade->j_g_title ?>"
                                                     placeholder="" value="" readonly></td>
                                             <td class="align-middle"><input type="text" name="grade_wise_amount[]"
                                                     class="form-control" id="totalAmount<?= $grade->j_g_title ?>"
                                                     placeholder="" value="" readonly></td>
                                         </tr>
                                         <?php
												}
											}
											?>

                                         <tr>
                                             <td class="align-middle">Total</td>
                                             <td class="align-middle"><input type="text" name="" class="form-control"
                                                     id="exampleInputEmail1" placeholder="" value="" readonly></td>
                                             <td class="align-middle"><input type="text" name="" class="form-control"
                                                     id="exampleInputEmail1" placeholder="" value="" readonly></td>
                                             <td class="align-middle"></td>
                                             <td class="align-middle"><input type="text" name="" class="form-control"
                                                     id="sumOutTorn" placeholder="" value="" readonly></td>
                                             <td class="align-middle"><input type="text" name="total_amount"
                                                     class="form-control" id="sumAmount" placeholder="" value=""
                                                     readonly></td>
                                         </tr>
                                         <tr>
                                             <td class="align-middle" colspan="3">
                                                 <h6 class="font-weight-bold">Taka in Words</h6>
                                                 <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                                     placeholder="Will Auto Calculate">
                                             </td>
                                             <td class="align-middle"></td>
                                             <td class="align-middle" colspan="2">
                                                 <h6 class="font-weight-bold">Avg rate</h6>
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
    calculateFinalKgs(0, idGroup);
    totalAmountCount();
    var kgs_old = $("#kgs_old").val();

    $(".individualExtra").hide();
    $("#allExtra").hide();
    $("#allExtraMds").hide();
    $(".nai").hide();

    // add Individual Extra with basis jute rate
    $(".addExtraInput").keyup(function() {
        var x = $(this).val();
        //alert(x);
        var q = $(this).attr("o-id");
        var oldValue = $(this).attr("o-oldValue");
        var finalValue = parseFloat(x) + parseFloat(oldValue);
        t = 'juteRate' + q;
        if (x === "") {
            $("#" + t).val(oldValue);
        } else {
            $("#" + t).val(finalValue);
        }
        totalAmountCount();
    });




    /* ================ Radio Button Change Issue Solve by Rimon - 21.09.2022 ================= */

    // Previous 
    // $("#activeIndividualExtra").click(function() {
    // 	$(".individualExtra").show();
    // });

    $('.showHideInputField').click(function() {
        switch ($(this).attr('id')) {
            case 'activeIndividualExtra':
                $(".individualExtra").show();

                $("#allExtra").val('');
                $("#allExtraMds").val('');

                $("#allExtra").hide();
                $("#allExtraMds").hide();
                break;
            case 'activeAllExtra':
                $("#allExtra").show();

                j = 0;
                o = 0;
                a = 0;
                for (let i = 0; i < idGroup.length; i++) {

                    p = idGroup[i];

                    outTurn = 'outturn_mds' + p;
                    outTurn = $("#" + outTurn).val();
                    t = 'juteRate' + p;
                    juteRate = $("#" + t).val();

                    previousJuteRate = 'previousJuteRate' + p;
                    getPreviousJuteRate = $("#" + previousJuteRate).val();

                    finalMds = (parseFloat(getPreviousJuteRate) * parseFloat(outTurn));
                    totalAmount = 'totalAmount' + p;
                    $("#" + totalAmount).val(finalMds);

                    $("#" + t).val(getPreviousJuteRate);

                    $("#" + totalAmount).val(finalMds);

                    j = (parseFloat(j) + parseFloat(juteRate));
                    o = (parseFloat(o) + parseFloat(outTurn));
                    a = (parseFloat(a) + parseFloat(finalMds));

                    $("#addExtra" + p).val('');
                }
                $("#allExtraMds").val(j);
                $("#sumOutTorn").val(o);
                $("#sumAmount").val(a);

                avarageRate();


                $("#allExtraMds").val('');


                $(".individualExtra").hide();
                $("#allExtraMds").hide();
                break;
            case 'mdsYesContract':
                $("#allExtraMds").show();


                j = 0;
                o = 0;
                a = 0;
                for (let i = 0; i < idGroup.length; i++) {


                    p = idGroup[i];

                    outTurn = 'outturn_mds' + p;
                    outTurn = $("#" + outTurn).val();
                    t = 'juteRate' + p;
                    juteRate = $("#" + t).val();

                    previousJuteRate = 'previousJuteRate' + p;
                    getPreviousJuteRate = $("#" + previousJuteRate).val();

                    finalMds = (parseFloat(getPreviousJuteRate) * parseFloat(outTurn));
                    totalAmount = 'totalAmount' + p;
                    $("#" + totalAmount).val(finalMds);

                    $("#" + t).val(getPreviousJuteRate);

                    $("#" + totalAmount).val(finalMds);

                    j = (parseFloat(j) + parseFloat(juteRate));
                    o = (parseFloat(o) + parseFloat(outTurn));
                    a = (parseFloat(a) + parseFloat(finalMds));

                    $("#addExtra" + p).val('');
                }
                // $("#allExtraMds").val(j);
                $("#sumOutTorn").val(o);
                $("#sumAmount").val(a);
                avarageRate();


                $("#allExtra").val('');


                $(".individualExtra").hide();
                $("#allExtra").hide();
                break;
            default:
                $(".individualExtra").hide();
                $("#allExtra").hide();
                $("#allExtraMds").hide();
        }
    });
    /* ================ /.Radio Button Change Issue Solve by Rimon - 21.09.2022 ================= */





    $("#extraSar").keyup(function() {
        var extraSar = $(this).val();
        calculateFinalKgs(extraSar, idGroup);
    });

    //calculate Kgs (After Moisture deduction) and Mds
    function calculateFinalKgs(extraSar, idGroup) {
        var kgs_old = $("#kgs_old").val();
        var receivedJuteMoisture = $("#receivedJuteMoisture").val();
        var acceptableMoisture = $("#acceptableMoisture").val();
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

    //calculate Out turn (Mds)
    function finalOuterTurnCalculation(mds) {
        for (let i = 0; i < idGroup.length; i++) {
            p = idGroup[i];
            outerton = 'outturn_mds' + p;
            outertonPer = 'outertonPer' + p;
            outertonPer = $("#" + outertonPer).val();
            finalmds = (mds * outertonPer) / 100;
            $("#" + outerton).val((finalmds).toFixed(4));
        }
        totalAmountCount();
    }

    // $("#activeAllExtra").click(function() {
    // 	$("#allExtra").show();
    // });

    $("#allExtra").keyup(function() {
        var allExtra = $(this).val();
        console.log(idGroup);
        for (let i = 0; i < idGroup.length; i++) {
            q = idGroup[i];
            t = 'juteRate' + q;
            w = 'juteRateShow' + q;
            oldValue = $("#" + w).val();
            var finalValue = parseFloat(oldValue) + parseFloat(allExtra);
            if (allExtra === "") {
                $("#" + t).val(oldValue);
            } else {
                $("#" + t).val(finalValue);
            }
        }
        totalAmountCount();
    });


    // $("#mdsYesContract").click(function() {
    // 	$("#allExtraMds").show();
    // });

    //Mds Rate * out turn mds = grade wise amount
    $("#allExtraMds").keyup(function() {
        var allExtraMds = $(this).val();
        for (let i = 0; i < idGroup.length; i++) {
            p = idGroup[i];
            //start murad 8.8.22 to show contact Mds rate under te rate input field
            t = 'juteRate' + p;
            $("#" + t).val(parseFloat(allExtraMds));
            //End murad 8.8.22
            outerton = 'outturn_mds' + p;
            outerton = $("#" + outerton).val();
            finalmds = (parseFloat(allExtraMds) * parseFloat(outerton));
            totalAmount = 'totalAmount' + p;
            $("#" + totalAmount).val(finalmds);
        }
        x_count();

    });



    function totalAmountCount() {


        j = 0;
        o = 0;
        a = 0;
        for (let i = 0; i < idGroup.length; i++) {


            p = idGroup[i];
            outerton = 'outturn_mds' + p;

            outerton = $("#" + outerton).val();
            t = 'juteRate' + p;


            juteRate = $("#" + t).val();
            finalmds = (parseFloat(juteRate) * parseFloat(outerton));
            totalAmount = 'totalAmount' + p;
            $("#" + totalAmount).val(finalmds);

            j = (parseFloat(j) + parseFloat(juteRate));
            o = (parseFloat(o) + parseFloat(outerton));
            a = (parseFloat(a) + parseFloat(finalmds));




        }
        //$("#allExtraMds").val(j);
        $("#sumOutTorn").val(o);
        $("#sumAmount").val(a);
        avarageRate();
    }


    function x_count() {
        j = 0;
        o = 0;
        a = 0;
        for (let i = 0; i < idGroup.length; i++) {


            p = idGroup[i];
            totalAmount = 'totalAmount' + p;
            totalAmount = $("#" + totalAmount).val();
            outerton = 'outturn_mds' + p;
            outerton = $("#" + outerton).val();

            j = (parseFloat(j) + parseFloat(juteRate));
            o = (parseFloat(o) + parseFloat(outerton));
            a = (parseFloat(a) + parseFloat(totalAmount));




        }
        //$("#allExtraMds").val(j);
        $("#sumOutTorn").val(o);
        $("#sumAmount").val(a);
        avarageRate();
    }

    function avarageRate() {
        o = $("#sumOutTorn").val();
        a = $("#sumAmount").val();
        q = (parseFloat(a) / parseFloat(o));
        $("#avarageRaye").val(q);
        take();
    }


    function take() {
        a = $("#sumAmount").val();
        //var words = toWords(a);
        // alert(a);

    }

});
 </script>



 <script src="<?php echo base_url('') ?>assets/backend/jquery.num2words.js"></script>