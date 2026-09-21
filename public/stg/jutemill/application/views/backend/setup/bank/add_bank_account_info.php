<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Add Bank Account Information</h1>
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
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('list_bank_account_info'); ?>">List Bank Account Information</a></li>
                        <li class="breadcrumb-item active">Add Bank Account Information</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Add New Account</h3>
                        </div>

                        <form method="POST" action="<?php echo base_url('insert_bank_account_info') ?>" onkeydown="return event.key != 'Enter';">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label>Bank</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control select2" id="bank_id" style="width: 100%;" name="bacc_b_id" required>
                                                <option>Select Bank</option>
                                                <?php
                                                if ($banks) {
                                                    foreach ($banks->result() as $bank) {
                                                ?>
                                                        <option value="<?= $bank->b_id ?>"><?= $bank->b_title ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label>Bank Branch</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control select2" style="width: 100%;" id="branch" name="bacc_bb_id" required>
                                                <option>Select Branch</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label>Address</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" value="" name="bacc_bank_address" id="" placeholder="Address" data-validation="length" data-validation-length="min2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-3">
                                            <label>Account Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" value="" name="bacc_name" id="" placeholder="Enter Bank Branch Title" data-validation="length" data-validation-length="min2">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label>Account Number</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" value="" name="bacc_number" id="" placeholder="Enter Bank Branch Title" data-validation="length" data-validation-length="min2">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label>Account Type</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control select2" style="width: 100%;" id="" name="bacc_type" required>
                                                <option>Select Type</option>
                                                <option value="1">Savings Deposit Account</option>
                                                <option value="2">Current Deposit Account</option>
                                                <option value="3">Short Term Deposit Account</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-sm-3">
                                            <label>Opening Balance</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control input-number" value="" name="bacc_balance" id="" placeholder="Enter Opening Balance" data-validation="required length number" data-validation-length="min2" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3>Bank Contact Person Info</h3>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label>Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" value="" name="bacc_cp_name" id="" placeholder="Enter Name" data-validation="length" data-validation-length="min2">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label>Mobile</label>
                                            <span class="text-danger">*</span>
                                            <input type="number" class="form-control" value="" name="bacc_cp_mobile" id="" placeholder="Enter Bank Branch Title" data-validation="length" data-validation-length="min2">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label>Post</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" class="form-control" value="" name="bacc_cp_post" id="" placeholder="Enter Bank Branch Title" data-validation="length" data-validation-length="min2">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-info"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>

<!-- Script File -->
<script src="<?php echo base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bank_id').on('change', function() {
            var iid = $('#bank_id').val();
            // alert(iid);
            if (iid != '') {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('setup/bank/getBankBranch'); ?>',
                    data: {
                        branch_id: iid
                    },
                    success: function(data) {
                        $('#branch').html(data);
                    }
                });
            }
        });
    });
</script>