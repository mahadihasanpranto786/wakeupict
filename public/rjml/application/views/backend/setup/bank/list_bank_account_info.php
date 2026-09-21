<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Bank Account Information</h1>
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
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('add_bank_account_info'); ?>">Add New Account</a></li>
                        <li class="breadcrumb-item active">Bank Account Information</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12"><?= alert_check() ?>
                    <div class="card card-info mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-2">Bank Account Information</h3>
                            <a href="<?php echo base_url('add_bank_account_info'); ?>"><button class="btn btn-info float-right border"><i class="fas fa-plus-circle"></i> Add New Account</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Opening Date</th>
                                        <th>Account Name</th>
                                        <th>Bank</th>
                                        <th>Branch</th>
                                        <th>Address</th>
                                        <th>Total Balance</th>
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
                                                <td class="align-middle"><?= date("d-m-Y", strtotime($list->bacc_created_at)); ?></td>
                                                <td class="align-middle"><?= $list->bacc_name; ?></td>
                                                <td class="align-middle"><?= $this->Common->get_single_row_information('bank', ['b_status' => 1], $list->bacc_b_id)->b_title ?></td>
                                                <td class="align-middle"><?= $this->Common->get_single_row_information('bank_branch', ['bb_status' => 1], $list->bacc_bb_id)->bb_title ?></td>
                                                <td class="align-middle"><?= $list->bacc_bank_address; ?></td>
                                                <td class="align-middle"><?= $list->bacc_balance ?></td>
                                                <td class="text-left py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <!-- <a class='btn bg-olive btn-xs mr-1' href="<//?php echo base_url(''); ?>">
                                                            <i class='fas fa-eye'> View</i>
                                                        </a> -->
                                                        <!-- <a onclick="return confirm('Are you sure want to delete this?');" href="<//?php echo base_url(''); ?>">
                                                            <button class="btn btn-danger btn-sm mr-1" type="button" data-placement="top" title="Delete">
                                                                <i class="fa fa-trash"></i> Delete</button>
                                                        </a> -->
                                                        <!-- <a href="<//?php echo base_url('') ?>"><button class="btn btn-warning btn-sm" type="button" data-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit Issue</button></a> -->
                                                        <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Bank/permanentlyDeleteBankAccountInfo?bacc_id=<?= $list->bacc_id; ?>" type='button' class='btn bg-danger btn-xs'>
                                                            <i class="fas fa-trash"></i>
                                                            Permanently Delete
                                                        </a>
                                                    </div>
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