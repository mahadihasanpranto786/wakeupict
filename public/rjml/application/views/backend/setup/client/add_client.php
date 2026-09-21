<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Clients Lists</h1>
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
                        <li class="breadcrumb-item active">Clients Lists</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- <//?= alert_check() ?> -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Clients Lists</h3>
                            <button class="btn btn-info pt-0 pb-0 float-right border" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-plus-circle"></i> Add New Client</button>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="<?php echo base_url(''); ?>" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>SL No.</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>License no</th>
                                                    <th>Payable</th>
                                                    <th>Paid</th>
                                                    <th>Due</th>
                                                    <th>Action</th>
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
                                                            <td class="align-middle"><img src="<?= $list->c_img ?>" class="img-rounded" width="40px" height="40px" alt=""></td>
                                                            <td class="align-middle"><?= $list->c_title ?></td>
                                                            <td class="align-middle"><?= $this->M_client->getClientTypeById($list->c_ct_id)->ct_title ?></td>
                                                            <td class="align-middle"><?= $list->c_email ?></td>
                                                            <td class="align-middle"><?= $list->c_address ?><br>
                                                                <span>Mobile: <b class="text-danger"><?= $list->c_phone ?></b></span>
                                                            </td>
                                                            <td class="align-middle"><?= $list->c_licence_no ?></td>
                                                            <td class="align-middle"><?= $list->c_payable ?></td>
                                                            <td class="align-middle"><?= $list->c_paid ?></td>
                                                            <td class="align-middle"><?= $list->c_due ?></td>

                                                            <td class="text-left py-0 align-middle">
                                                                <div class="btn-group btn-group-sm">
                                                                    <a id="<?= $list->c_id ?>" title="<?= $list->c_title ?>" client_type="<?= $list->c_ct_id ?>" email="<?= $list->c_email ?>" address="<?= $list->c_address ?>" phone="<?= $list->c_phone ?>" licence="<?= $list->c_licence_no ?>" due_balance="<?= $list->c_initial_due_balance ?>" image="<?= $list->c_img ?>" class='editbutton btn bg-primary btn-xs mr-1' data-toggle="modal">
                                                                        <i class='fas fa-user-edit'></i>
                                                                    </a>
                                                                    <a href="<?php echo base_url('delete_client?') ?>c_id=<?= $list->c_id; ?>" type='button' id="deleteBySweetAlert" class='btn bg-danger btn-xs mr-2'>
                                                                        <i class="fas fa-trash"></i>
                                                                        Delete
                                                                    </a>
                                                                    <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Client/permanentlyDeleteClient?c_id=<?= $list->c_id; ?>" type='button' class='btn bg-danger btn-xs'>
                                                                        <i class="fas fa-trash"></i>
                                                                        Permanently Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php  }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
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