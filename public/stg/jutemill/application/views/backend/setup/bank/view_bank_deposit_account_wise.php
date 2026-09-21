 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-sm-6">
                     <h1>Deposit</h1>
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
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('') ?>"></a></li>
                         <li class="breadcrumb-item active"></li>
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
                     <div class="card card-default mt-3">
                         <div class="card-header">
                             <h3 class="text-center mb-0 text-uppercase">Rajbari Jute Mills LTD. </h3>
                             <h5 class="text-center mb-0  text-uppercase">Aladipur, Rajbari </h5>
                             <h4 class="text-center text-uppercase"><u>Deposit</u></h4>
                             <br>
                             <div class="row">
                                 <div class="col-sm-6 bg-primary">
                                     <br>
                                     <h4 class="text-center">Main Balance: <?= number_format(($depositById->bacc_balance), 2, '.', ',') ?></h4>
                                     <br>
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-sm-6 bg-secondary">
                                     <br>
                                     <h4 class="text-center">Total Debit Balance: <?= number_format(($depositById->bacc_debit_balance), 2, '.', ',') ?></h4>
                                     <br>
                                 </div>
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form role="form" action="" method="post">
                             <div class="card-body">
                                 <div class="row mb-2 text-danger">
                                     <div class="col-sm-6">
                                         <h4 class="font-weight-bold">Account Holder: <?= $depositById->bacc_name ?> </h4>
                                     </div>
                                     <div class="col-sm-6">
                                         <h4 class="font-weight-bold"></h4>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <!-- Table -->
                                     <table id="" class="table table-hover table-bordered">
                                         <thead>
                                             <tr>
                                                 <th>Deposit Date</th>
                                                 <th>Amount</th>
                                                 <th>Reference</th>
                                                 <th>Deposit By</th>
                                                 <th>Cheque No</th>
                                                 <th>Notes</th>
                                                 <th>Actions</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php if (!empty($bankDeposits)) {
                                                    foreach ($bankDeposits->result() as $deposits) { ?>
                                                     <tr>
                                                         <td class="align-middle"><?= date("d-m-Y", strtotime($deposits->bd_date)); ?></td>
                                                         <td class="align-middle"><?= $deposits->bd_amount ?></td>
                                                         <td class="align-middle"><?= $deposits->bd_reference ?></td>
                                                         <td class="align-middle"><?= $deposits->bd_deposit_by ?></td>
                                                         <td class="align-middle"><?= $deposits->bd_cheque_no ?></td>
                                                         <td class="align-middle"><?= $deposits->bd_note ?></td>
                                                         <td class="align-middle">
                                                             <style type="text/css">
                                                                 a[disabled="disabled"] {
                                                                     pointer-events: none;
                                                                 }
                                                             </style>
                                                             <!-- <a disabled="disabled" id="<?= $sPayment->sp_id; ?>" reference="<?= $sPayment->sp_reference; ?>" amount="<?= $sPayment->sp_amount; ?>" date="<?= $sPayment->sp_date; ?>" paid_by="<?= $sPayment->sp_paid_by; ?>" cheque_no="<?= $sPayment->sp_cheque_no; ?>" note="<?= $sPayment->sp_note; ?>" class='editbutton btn bg-warning btn-xs' data-toggle="modal">
                                                                 <i class='fas fa-user-edit'> Edit Payment</i>
                                                             </a>
                                                             <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Supplier/deleteSupplierPayment?sp_id=<?= $sPayment->sp_id ?>">
                                                                 <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs' disabled>
                                                                     <i class="fas fa-trash"></i> Delete
                                                                 </button>
                                                             </a> -->
                                                         </td>
                                                     </tr>
                                             <?php }
                                                } ?>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                             <!-- /.card-body -->
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