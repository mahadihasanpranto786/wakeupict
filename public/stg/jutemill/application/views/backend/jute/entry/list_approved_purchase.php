<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info mt-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-th"></i> List Approved Jute Purchase Invoice</h3>
                            <?php
							$current_user_type = $this->session->userdata('current_type');
							$seePeople = array(1, 10, 302, 603);
							if (in_array($current_user_type, $seePeople)) {
							?>
                            <a href="<?php echo base_url('add_out_turn_report'); ?>"><button
                                    class="btn btn-info pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i>
                                    Add Out Turn Report</button></a>
                            <?php
							}
							?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Entry Date</th>
                                        <th>Bill Date</th>
                                        <th>Supplier</th>
                                        <!-- <th>Chalan No</th> -->
                                        <!-- <th>Mokam</th> -->
                                        <th>Area</th>
                                        <th>Mill Lot No</th>
                                        <?php
										if ($grades) {
											foreach ($grades->result() as $grade) {
										?>
                                        <th class="text-center"><?= $grade->j_g_title ?></th>
                                        <?php
											}
										}
										?>
                                        <th>Total Mds</th>
                                        <th>Total Taka</th>
                                        <th>Bill Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									if ($list) {
										$serial = 0;
										foreach ($list->result() as $list) {
											$serial++;
									?>
                                    <tr>
                                        <td class="align-middle"><?= $serial ?></td>
                                        <td class="align-middle">
                                            <?= date("d-m-Y h:i", strtotime($list->jpis_ot_en_date)); ?></td>
                                        <td class="align-middle">
                                            <?= date("d-m-Y", strtotime($list->jpis_created_at)); ?></td>
                                        <td class="align-middle">
                                            <?= $this->M_supplier->getSupplierById($list->jpis_ot_en_s_id)->s_title ?>
                                        </td>
                                        <!-- <td class="align-middle"></td> -->
                                        <!-- <td class="align-middle"></td> -->
                                        <td class="align-middle">
                                            <?php $en_jute_variety = $this->M_jute_entry->getEntryInfoByFyAndLot($list->jpis_fy_id, $list->jpis_ot_lot_no)->en_jute_variety;
													if ($en_jute_variety == 'Normal' or $en_jute_variety == "Knaf" or $en_jute_variety == "White") {
														echo $this->M_area->getAreaById($this->M_jute_entry->getJuteOutTurnSummaryById($list->jpis_ot_id)->ot_ar_id)->ar_title;
													} else {
														echo $en_jute_variety;
													} ?>

                                        </td>
                                        <td class="align-middle"><?= $list->jpis_ot_lot_no ?></td>
                                        <?php
												if ($grades) {
													foreach ($grades->result() as $grade) {
												?>
                                        <td class="text-center">
                                            <?= $this->M_godown->sumJutPurchase('jpiv_weight_mds', $list->jpis_id, $grade->j_g_id); ?>
                                        </td>
                                        <?php
													}
												}
												?>
                                        <td class="align-middle">
                                            <?= $this->M_jute_entry->getJuteOutTurnSummaryById($list->jpis_ot_id)->ot_mds ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= number_format($list->jpis_grand_total, 2, '.', ',') ?></td>
                                        <td class="align-middle">
                                            <?php if ($list->jpis_bill_type == 1) {
														echo "Normal";
													} elseif ($list->jpis_bill_type == 2) {
														echo "Contract";
													} else {
														echo "Custom";
													} ?>
                                        </td>
                                        <td class="text-right align-middle">
                                            <div class="btn-group py-0 btn-group-sm">
                                                <?php
														$userId = $this->session->userdata('currentActiveId');
														if ($userId) {
														?>
                                                <a
                                                    href="<?php echo base_url(); ?>jute/Entry/viewPurchaseInvoice?jpis_id=<?= $list->jpis_id ?>"><button
                                                        class="btn btn-info btn-sm m-1" type="button"
                                                        data-placement="top" title="View"><i class="fas fa-eye"></i>
                                                        View Bill Book</button></a>

                                                <?php }
														?>

                                            </div>
                                            <?php $current_user_type = $this->session->userdata('current_type');
													$seePeople = array(1, 10);
													if (in_array($current_user_type, $seePeople)) {
													?>
                                            <button type="button"
                                                class="btn btn-warning float-right m-1 invoiceReturnButton"
                                                data-invoice-id="<?= $list->jpis_id ?>" data-user-id="<?= $userId ?>"
                                                data-jpis_ot_en_s_id="<?= $list->jpis_ot_en_s_id ?>"
                                                data-jpis_grand_total="<?= $list->jpis_grand_total ?>"><i
                                                    class="fas fa-undo" aria-hidden="true"></i> Return </button>
                                            <?php }
													?>
                                        </td>
                                    </tr>
                                    <?php }
									} ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Return Invoice Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"> </i> Invoice Return With Reason
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" role="form" action="<?php echo base_url('approved_bill_returned') ?>"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="exampleInputEmail1">Return Reason</label>
                            <span class="text-danger">*</span>
                            <textarea class="form-control" name="iar_return_reason" cols="5" rows="5"
                                placeholder="Enter Invoice Return Reason" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="iar_invoice_id" id="invoiceId">
                    <input type="hidden" name="iar_user_id" id="userId">
                    <input type="hidden" name="jpis_grand_total" id="jpis_grand_total">
                    <input type="hidden" name="jpis_ot_en_s_id" id="jpis_ot_en_s_id">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".invoiceReturnButton").click(function(e) {
        var invoice_id = $(this).data('invoice-id');
        var user_id = $(this).data('user-id');
        var jpis_grand_total = $(this).data('jpis_grand_total');
        var jpis_ot_en_s_id = $(this).data('jpis_ot_en_s_id');

        $('#myModal').modal('show');
        $('#invoiceId').val(invoice_id);
        $('#userId').val(user_id);
        $('#jpis_grand_total').val(jpis_grand_total);
        $('#jpis_ot_en_s_id').val(jpis_ot_en_s_id);
    });

});
</script>