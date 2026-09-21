<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Update Assigned to khamal</h1>
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
                                href="<?php echo base_url('list_unassorted_out_turn_report'); ?>">Back to Unassorted Out
                                Turn list</a></li>
                        <li class="breadcrumb-item active">Update Unassorted Added</li>
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
                            <h3 class="card-title">Update Unassorted Added</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="<?php echo base_url('update_unassorted_added'); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Entry Date</th>
                                                <th>Lot No.</th>
                                                <th>Khamal No.</th>
                                                <th>T. Bojha</th>
                                                <th>St. Bojha</th>
                                                <th>Received Mds</th>
                                                <th>Avg. per bojha</th>
                                                <th>Net Weight</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <tr>
                                                <td><input type="text" name="kh_ua_a_v_en_date"
                                                        class="form-control datepicker" placeholder=""
                                                        value='<?= $editUnassortedAddView->kh_ua_a_s_en_date ?>'
                                                        readonly></td>
                                                <td><input type="text" name="kh_ua_a_v_ot_lot_no" class="form-control"
                                                        placeholder="Lot No"
                                                        value='<?= $this->M_jute_entry->getJuteOutTurnSummaryById($editUnassortedAddView->kh_ua_a_s_ot_id)->ot_lot_no; ?>'
                                                        readonly></td>
                                                <td class="table-warning">
                                                    <div class="form-group col-sm-12 ml-0">
                                                        <select class="form-control select2" style="width:170px;"
                                                            name="kh_ua_a_v_kh_id" required>
                                                            <option value="">Select Khamal</option>
                                                            <?php if ($khamals) {
																foreach ($khamals->result() as $khamal) {
																	if ($khamal->kh_used == 1) { ?>
                                                            <?php
																		if ($editUnassortedAddView->kh_ua_a_s_area == 4) {
																			if ($khamal->kh_ar_id == 4) { ?>
                                                            <option value="<?= $khamal->kh_id; ?>"
                                                                <?php echo ($khamal->kh_id == $editUnassortedAddView->kh_ua_a_s_kh_id) ? "selected" : false ?>>
                                                                <?= $khamal->kh_title; ?></option>
                                                            <?php }
																		} elseif ($editUnassortedAddView->kh_ua_a_s_area == 5) {
																			if ($khamal->kh_ar_id == 5) { ?>
                                                            <option value="<?= $khamal->kh_id; ?>"
                                                                <?php echo ($khamal->kh_id == $editUnassortedAddView->kh_ua_a_s_kh_id) ? "selected" : false ?>>
                                                                <?= $khamal->kh_id . $khamal->kh_title; ?></option>
                                                            <?php }
																		} else {
																			if ($khamal->kh_ar_id != 4 && $khamal->kh_ar_id != 5) { ?>
                                                            <option value="<?= $khamal->kh_id; ?>"
                                                                <?php echo ($khamal->kh_id == $editUnassortedAddView->kh_ua_a_s_kh_id) ? "selected" : false ?>>
                                                                <?= $khamal->kh_title; ?></option>
                                                            <?php	}
																			?>
                                                            <?php }
																		?>
                                                            <?php }
																}
															} ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td><input type="text" name="" class="form-control" id="pureValue"
                                                        placeholder="Enter Bojha No"
                                                        value='<?= $this->M_jute_entry->getJuteOutTurnSummaryById($editUnassortedAddView->kh_ua_a_s_ot_id)->ot_rec_bojha; ?>'
                                                        readonly>
                                                </td>
                                                <td class="table-warning"><input type="text"
                                                        name="kh_ua_a_v_ot_rec_bojha_no" id="kh_ua_a_v_bojha_no"
                                                        class="form-control" placeholder="Enter Bojha No"
                                                        value='<?= $editUnassortedAddView->kh_ua_a_s_ot_rec_bojha_no ?>'
                                                        required>
                                                </td>

                                                <td><input type="text" name="kh_ua_a_v_ot_rec_mds" id="ot_mds"
                                                        class="form-control" placeholder="Enter Bojha No"
                                                        value='<?= $jpis_ot_mds_after_deduction; ?>' readonly></td>
                                                <td><input type="text" name="kh_ua_a_v_avg" id="ava"
                                                        class="form-control" placeholder="Enter Avg"
                                                        value='<?php echo $jpis_ot_mds_after_deduction / $this->M_jute_entry->getJuteOutTurnSummaryById($editUnassortedAddView->kh_ua_a_s_ot_id)->ot_rec_bojha; ?>'
                                                        readonly></td>
                                                <td><input type="text" name="kh_ua_a_v_net_weight"
                                                        id="kh_ua_a_v_net_weight"
                                                        class="form-control kh_ua_a_v_net_weight" placeholder=""
                                                        value='' readonly></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
                                                <th><?= $grade->j_g_title ?></th>
                                                <?php } ?>
                                                <th>Total</th>
                                                <th>Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <tr>
                                                <?php if ($jute_grades) foreach ($jute_grades->result() as $grade) { ?>
                                                <td>
                                                    <input type="hidden" name="kh_ua_a_v_value_id[]"
                                                        class="form-control"
                                                        value='<?= getUnassortedAddedValueId($grade->j_g_id, $unAssortedAddedSummaryId); ?>'>
                                                    <input type="hidden" name="kh_ua_a_v_j_g_id[]"
                                                        value='<?= $grade->j_g_id ?>'>
                                                    <input type="hidden" name="kh_ua_a_v_valueMod[]"
                                                        class="form-control unAssortedGradeValueMod gradeValueMod"
                                                        id="unAssortedGradeValueMod<?= $grade->j_g_id ?>"
                                                        placeholder="<?= $grade->j_g_title ?>"
                                                        value='<?= getOutTurnPer($grade->j_g_id, $editUnassortedAddView->kh_ua_a_s_ot_id); ?>'>
                                                    <input type="text" name="kh_ua_a_v_value[]"
                                                        class="form-control unAssortedGradeValue gradeValue"
                                                        id="unAssortedGradeValue<?= $grade->j_g_id ?>"
                                                        placeholder="<?= $grade->j_g_title ?>"
                                                        value='<?= getOutTurnPer($grade->j_g_id, $editUnassortedAddView->kh_ua_a_s_ot_id); ?>'
                                                        readonly>
                                                </td>
                                                <?php } ?>

                                                <td><input type="text" name="kh_ua_a_v_total"
                                                        class="form-control kh_ua_a_v_net_weight" id="total"
                                                        placeholder="Total"
                                                        value='<?= $editUnassortedAddView->kh_ua_a_s_total ?>' readonly>
                                                </td>
                                                <td><input type="text" name="kh_ua_a_v_comments" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Comments"
                                                        value='<?= $editUnassortedAddView->kh_ua_a_s_comments ?>'></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" name="kh_ua_a_v_id"
                                    value="<?= $editUnassortedAddView->kh_ua_a_s_id ?>">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-info">Save Changes</button>
                                    <a href="<?php echo base_url('list_unassorted_added'); ?>" type="submit"
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
//  Row data auto calculate
$(document).ready(function() {



    var groupId = []
    <?php foreach ($jute_grades->result() as $grade) {
		?>
    groupId.push('<?= $grade->j_g_id ?>')
    <?php } ?>

    $(".unAssortedGradeValue").keyup(function() {
        var x = $(this).val();
        allTotal = 0;

        for (let i = 0; i < groupId.length; i++) {
            unAssort = 0;

            id = groupId[i];
            idName = 'unAssortedGradeValue' + id;
            unAssort = $("#" + idName).val() || 0;
            allTotal = (parseFloat(allTotal) + parseFloat(unAssort));
        }
        $('#total').val(allTotal);
    });

    // Net Weight -> Auto calculate
    var kh_ua_a_v_bojha_no = parseFloat($('#kh_ua_a_v_bojha_no').val()) || 0;
    var ava = parseFloat($('#ava').val()) || 0;
    var net_weight = kh_ua_a_v_bojha_no * ava.toFixed(3)
    $('.kh_ua_a_v_net_weight').val(net_weight);

    $(".gradeValue").each(function() {
        $(this).val((parseFloat($(this).val()) * net_weight / 100).toFixed(3));
    });


    // Net Weight -> If Bojha amount change
    var pureValue = parseFloat($('#pureValue').val());

    var netWeightPure = $('#kh_ua_a_v_net_weight').val();
    var totalPure = $('#total').val();


    $('#kh_ua_a_v_bojha_no').keyup(function() {




        var kh_ua_a_v_bojha_no = parseFloat($('#kh_ua_a_v_bojha_no').val()) || 0;
        if (pureValue >= kh_ua_a_v_bojha_no) {
            // alert(kh_ua_a_v_bojha_no);
            var ava = parseFloat($('#ava').val()) || 0;
            $('#kh_ua_a_v_net_weight').val(kh_ua_a_v_bojha_no * ava.toFixed(3));

            //Percentage to net value

            var netWeight = parseFloat($('#kh_ua_a_v_net_weight').val()) || 0;


            console.log('newWeight:' + netWeight);


            const gradeWisePersentage = [];


            $(".gradeValueMod").each(function() {
                var e = $(this).val();
                gradeWisePersentage.push(e);
            });
            var TotalSum = 0;
            $(".gradeValue").each(function() {

                var tempV = (parseFloat(gradeWisePersentage.shift()) * netWeight / 100).toFixed(
                    3);
                TotalSum = parseFloat(TotalSum) + parseFloat(tempV);
                console.log(TotalSum);
                $(this).val(tempV);
            });
            $('#total').val(TotalSum);
        } else {
            alert("Sorry! You can't add value more than " +
                <?= $this->M_jute_entry->getJuteOutTurnSummaryById($editUnassortedAddView->kh_ua_a_s_ot_id)->ot_rec_bojha ?>
            );
            $('#kh_ua_a_v_bojha_no').val(pureValue);
            $('#kh_ua_a_v_net_weight').val(netWeightPure);
            $('#total').val(totalPure);
        }


    });
});
</script>