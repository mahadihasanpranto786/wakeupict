<div class="content-wrapper">
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="card-title mt-2">Supplier List</h3>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('add_supplier') ?>"><button class="btn btn-primary float-right border"><i class="fas fa-plus-circle"></i> Add New Supplier</button></a>
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
                                        <th>Serial no..</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Licence no</th>
                                        <th>Bank Info</th>
                                        <th>Due Amount</th>
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
                                                <td class="align-middle text-center"><?= $serial ?></td>
                                                <td class="align-middle"><img src="<?= $list->s_img ?>" class="img-rounded" width="40px" height="40px" alt=""></td>
                                                <td class="align-middle"><?= $list->s_title ?></td>
                                                <td class="align-middle"><?= $this->M_supplier->getSupplierTypeById($list->s_sup_t_id)->sup_t_title; ?>
                                                </td>
                                                <td class="align-middle"><?= $list->s_email ?></td>
                                                <td class="align-middle"><?= $list->s_address ?> <br>Mobile No: <?= $list->s_phone ?> </td>
                                                <td class="align-middle"><?= $list->s_licence_no ?></td>
                                                <td class="align-middle">Bank: <span class="text-danger"><?= $this->M_bank->getBankById($list->s_b_id)->b_title ?></span><br>Bank Branch: <span class="text-danger"><?= $this->M_bank->getBankBranchById($list->s_bb_id)->bb_title ?></span> <br>A/C Name: <span class="text-danger"><?= $list->s_ac_name ?></span><br>A/C No: <span class="text-danger"><?= $list->s_ac_number ?></span> </td>
                                                <td class="align-middle"><?= number_format($list->s_initial_due_balance, 2, ".", ",") ?></td>
                                                <td class="align-middle">
                                                    <a id="<?= $list->s_id ?>" img="<?= $list->s_img ?>" title="<?= $list->s_title ?>" supplier_type="<?= $list->s_sup_t_id ?>" email="<?= $list->s_email ?>" address="<?= $list->s_address ?>" phone="<?= $list->s_phone ?>" licence="<?= $list->s_licence_no ?>" bank_name="<?= $list->s_b_id ?>" branch_name="<?= $list->s_bb_id ?>" ac_name="<?= $list->s_ac_name ?>" ac_number="<?= $list->s_ac_number ?>" due_balance="<?= $list->s_initial_due_balance ?>" image="<?= $list->s_img ?>" class='editButton btn bg-primary btn-xs' data-toggle="modal">
                                                        <i class='fas fa-user-edit'></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Supplier/deleteSupplier?s_id=<?= $list->s_id ?>" id="<?= $list->s_id ?>">
                                                        <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>setup/Supplier/inactiveSupplier?s_id=<?= $list->s_id ?>" id="<?= $list->s_id ?>">
                                                        <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                        </button>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Supplier/permanentlyDeleteSupplier?s_id=<?= $list->s_id; ?>" type='button' class='btn bg-danger btn-xs'>
                                                        <i class="fas fa-trash"></i>
                                                        Permanently Delete
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>