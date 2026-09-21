<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>List Return Jute Entry</h1>
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
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
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('list_jute_entry'); ?>">Back to List Jute Entry</a></li>
                        <li class="breadcrumb-item active">List Jute Return Info</li>
                    </ol> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-th"></i> List Jute Return Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Return Date</th>
                                        <th>Return By</th>
                                        <th>Reason</th>
                                        <th>Entry Date</th>
                                        <th>Mill Lot No</th>
                                        <th>Supplier</th>
                                        <th>Chalan No</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($list) {
                                        $serial = 0;
                                        foreach ($list->result() as $list) {
                                            $serial++;
                                            if ($list->jri_status == 1 or $list->jri_status == 2) {
                                    ?>
                                                <tr>
                                                    <td class="align-middle"><?= $serial ?></td>
                                                    <td class="align-middle"><?= date("d-m-Y", strtotime($list->jri_date)); ?></td>
                                                    <td class="align-middle"><?= $list->jri_return_by ?></td>
                                                    <td class="align-middle"><?= $list->jri_reason ?></td>
                                                    <td class="align-middle"><?= $this->M_jute_entry->getJuteEntryById($list->jri_en_id)->en_date ?></td>
                                                    <td class="align-middle"><?= $this->M_jute_entry->getJuteEntryById($list->jri_en_id)->en_lot_no ?></td>
                                                    <td class="align-middle"><?php echo $this->M_supplier->getSupplierById($this->M_jute_entry->getJuteEntryById($list->jri_en_id)->en_s_id)->s_title; ?></td>
                                                    <td class="align-middle"><?= $this->M_jute_entry->getJuteEntryById($list->jri_en_id)->en_chalan_no ?></td>
                                                    <td class="text-right align-middle">
                                                        <div class="btn-group py-0 btn-group-sm">
                                                            <?php if ($list->jri_status == 1) { ?>
                                                                <a onclick="return confirm('Are you sure you want to approve this?');" href="<?php echo base_url('') ?>jute/Entry/approveJuteReturn?jri_id=<?= $list->jri_id ?>" class="btn btn-success btn-sm mr-1" type="button" data-placement="top" title="Approve"><i class="fas fa-check-circle"></i> Approve</a>
                                                                <a onclick="return confirm('Are you sure you want to revert this?');" href="<?php echo base_url('') ?>jute/Entry/revertJuteReturn?jri_id=<?= $list->jri_id ?>" class="btn btn-warning btn-sm" type="button" data-placement="top" title="Revert"><i class="fa fa-undo" aria-hidden="true"></i> Revert</a>
                                                            <?php  } elseif ($list->jri_status == 2) { ?>
                                                                <button type="button" class="btn btn-danger" title="Approve Done">Return Done</button>
                                                            <?php  } ?>

                                                        </div>
                                                    </td>
                                                </tr>
                                    <?php }
                                        }
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