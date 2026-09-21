<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">Bank Deposit</h3>
                                </div>
                            </div>
                        </div>

                        <?= alert_check() ?>
                        <section class="content" style="margin-top:20px">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>SL No.</th>
                                                    <th>Account Name</th>
                                                    <th>Bank</th>
                                                    <th>Branch</th>
                                                    <th>Address</th>
                                                    <th>Main Balance</th>
                                                    <th>Credit Balance</th>
                                                    <th>Debit Balance</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($bank_account_info) {
                                                    $serial = 0;
                                                    foreach ($bank_account_info->result() as $list) {
                                                        $serial++ ?>
                                                        <tr>
                                                            <td class="align-middle"><?= $serial ?></td>
                                                            <td class="align-middle"><?= $list->bacc_name; ?></td>
                                                            <td class="align-middle"><?= $this->Common->get_single_row_information('bank', ['b_status' => 1], $list->bacc_b_id)->b_title ?></td>
                                                            <td class="align-middle"><?= $this->Common->get_single_row_information('bank_branch', ['bb_status' => 1], $list->bacc_bb_id)->bb_title ?></td>
                                                            <td class="align-middle"><?= $list->bacc_bank_address; ?></td>
                                                            <td class="align-middle"><?= $list->bacc_balance ?></td>
                                                            <td class="align-middle"><?= $list->bacc_credit_balance ?></td>
                                                            <td class="align-middle"><?= $list->bacc_debit_balance ?></td>
                                                            <td class="text-left py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <a id="<?= $list->bacc_id ?>" title="<?= $list->bacc_name ?>" class="editButton btn bg-info btn-xs mr-1" data-toggle="modal">
                                                                        <i class="fa fa-plus-circle"></i> Add Deposit
                                                                    </a>
                                                                    <a class='btn bg-olive btn-xs mr-1' href="<?php echo base_url(''); ?>setup/Bank/viewBankDepositAccountWise?bacc_id=<?= $list->bacc_id ?>">
                                                                        <i class='fas fa-eye'> View Deposit</i>
                                                                    </a>
                                                                    <a id="<?= $list->bacc_id ?>" title="<?= $list->bacc_name ?>" class="editButton2 btn bg-warning btn-xs mr-1" data-toggle="modal">
                                                                        <i class="fa fa-plus-circle"></i> Withdraw
                                                                    </a>
                                                                    <a class='btn bg-olive btn-xs mr-1' href="<?php echo base_url(''); ?>setup/Bank/viewBankWithdrawAccountWise?bacc_id=<?= $list->bacc_id ?>">
                                                                        <i class='fas fa-eye'> View Withdraw</i>
                                                                    </a>
                                                                    <a class='btn bg-secondary btn-xs mr-1' href="<?php echo base_url(''); ?>setup/Bank/viewBankAccountLedger?bacc_id=<?= $list->bacc_id ?>">
                                                                        <i class='fas fa-eye'> Account Ledger</i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>

            </div>
    </section>
</div>

<!-- Insert Deposit Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add Deposit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form role="form" action="<?php echo base_url('insert_bank_deposit') ?>" method="post" onkeydown="return event.key != 'Enter';">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h5 class="mt-1">Account Name:</h5>
                            </div>
                            <div class="col-8">
                                <div class="form-group col-sm-12">
                                    <input type="text" id="title" class="form-control" id="exampleInputEmail1" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Reference</label>
                                <input type="text" name="bd_reference" class="form-control" placeholder="Enter Reference">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Amount</label>
                                <input type="text" name="bd_amount" class="form-control" placeholder="Enter Amount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="text" name="bd_date" value="<?= get_current_time_time(); ?>" class="form-control" required readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Deposit By</label>
                                <select class="form-control select2" style="width: 100%;" name="bd_deposit_by">
                                    <option selected="Cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 cheque">
                                <label for="exampleInputEmail1">Cheque No</label>
                                <input type="text" name="bd_cheque_no" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <!-- textarea -->
                            <div class="form-group col-sm-12">
                                <label>Note</label>
                                <textarea class="form-control" name="bd_note" rows="5" placeholder="Enter Note"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="bd_bacc_id" value="" id="id">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info float-right">Submit</button>
                        </div>
                    </div>
                </form>
                <!-- /End Form -->
            </div>
        </div>
    </div>
</div>


<!-- Insert Withdraw Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Withdraw Balance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form role="form" action="<?php echo base_url('insert_bank_withdraw_balance') ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h5 class="mt-1">Account Name:</h5>
                            </div>
                            <div class="col-8">
                                <div class="form-group col-sm-12">
                                    <input type="text" id="wTitle" class="form-control" id="exampleInputEmail1" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Reference</label>
                                <input type="text" name="bw_reference" class="form-control" placeholder="Enter Reference">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Amount</label>
                                <input type="text" name="bw_amount" class="form-control input-number" placeholder="Enter Amount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="text" name="bw_date" value="<?= get_current_time_time(); ?>" class="form-control" required readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Withdraw By</label>
                                <select class="form-control select2" style="width: 100%;" name="bw_withdraw_by">
                                    <option selected="Cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 cheque">
                                <label for="exampleInputEmail1">Cheque No</label>
                                <input type="text" name="bw_cheque_no" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <!-- textarea -->
                            <div class="form-group col-sm-12">
                                <label>Note</label>
                                <textarea class="form-control" name="bw_note" rows="5" placeholder="Enter Note"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="bw_bacc_id" value="" id="wId">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning float-right">Submit</button>
                        </div>
                    </div>
                </form>
                <!-- /End Form -->
            </div>
        </div>
    </div>
</div>

<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".cheque").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".cheque").hide();
                }
            });
        }).change();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //Deposit
        $(".editButton").click(function(e) {
            var iid = $(this).attr('id');
            var title = $(this).attr('title');
            // alert(iid);
            $('#myModal').modal('show');
            $('#id').val(iid);
            $('#title').val(title);
        });
        //Withdraw
        $(".editButton2").click(function(e) {
            var iid = $(this).attr('id');
            var title = $(this).attr('title');
            // alert(iid);
            $('#myModal2').modal('show');
            $('#wId').val(iid);
            $('#wTitle').val(title);
        });
    });
</script>