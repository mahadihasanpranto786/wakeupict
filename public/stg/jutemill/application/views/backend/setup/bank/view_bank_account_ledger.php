 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-sm-6">
                     <h1>Statement of Account</h1>
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
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('add_bank_deposit') ?>"> Back to Deposit & Withdraw List</a></li>
                         <li class="breadcrumb-item active">Statement of Account</li>
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
                             <h4 class="text-center text-uppercase"><u>Statement of Account</u></h4>
                             <br>
                             <div class="row mb-3">
                                 <div class="col-sm-4">
                                     <table>
                                         <tr>
                                             <td> Account Holder</td>
                                             <td>: &nbsp &nbsp</td>
                                             <td class="text-uppercase"><?= $bankInfo->bacc_name ?></td>
                                         </tr>
                                         <tr>
                                             <td> Customer ID</td>
                                             <td>: &nbsp &nbsp</td>
                                             <td class=""><?= $bankInfo->bacc_customerID ?></td>
                                         </tr>
                                         <tr>
                                             <td> Address</td>
                                             <td>:&nbsp &nbsp</td>
                                             <td><?= $bankInfo->bacc_bank_address ?></td>
                                         </tr>
                                     </table>
                                 </div>
                                 <div class="col-sm-4"></div>
                                 <div class="col-sm-4">
                                     <table>
                                         <tr>
                                             <td> Account Number</td>
                                             <td> :</td>
                                             <td><?= $bankInfo->bacc_number ?></td>
                                         </tr>
                                         <tr>
                                             <td> A/C Type</td>
                                             <td> :</td>
                                             <td><?php if ($bankInfo->bacc_type == 1) {
                                                        echo "Savings Deposit Account";
                                                    } elseif ($bankInfo->bacc_type == 2) {
                                                        echo "Current Deposit Account";
                                                    } else {
                                                        echo "Short Term Deposit Account";
                                                    } ?></td>
                                         </tr>
                                         <tr>
                                             <td> A/C Opening Date</td>
                                             <td> :</td>
                                             <td><?= date("d-m-Y", strtotime($bankInfo->bacc_created_at)); ?></td>
                                         </tr>
                                         <tr>
                                             <td> Available Balance</td>
                                             <td>: &nbsp &nbsp</td>
                                             <td><?= number_format(($bankInfo->bacc_balance), '2', '.', ',') ?></td>
                                         </tr>
                                     </table>
                                 </div>
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form role="form" action="" method="post">
                             <div class="card-body">
                                 <div class="row mb-2 text-danger">
                                     <div class="col-sm-6">
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
                                                 <th>Date</th>
                                                 <th>Cheque No</th>
                                                 <th>Notes</th>
                                                 <th>Debit</th>
                                                 <th>Credit</th>
                                                 <th>Balance</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td class="font-weight-bold">Opening Balance</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td><?= number_format(($bankInfo->bacc_opening_balance), 2, '.', ',') ?></td>
                                             </tr>
                                             <?php
                                                $depoDates = array();
                                                $withDates = array();
                                                foreach ($bankDeposits->result() as $bankDeposit) {
                                                    $depoDates[] = $bankDeposit->bd_date;
                                                }
                                                foreach ($bankWithdraws->result() as $bankWithdraw) {
                                                    $withDates[] = $bankWithdraw->bw_date;
                                                }
                                                $mergeDates = array_merge($depoDates, $withDates);
                                                $uniqueDates = array_unique($mergeDates);
                                                ?>


                                             <?php
                                                foreach ($uniqueDates as $key => $value) {


                                                    if (!empty($bankWithdraws)) {
                                                        foreach ($bankWithdraws->result() as $withdraws) {
                                                            if ($withdraws->bw_date == $value) {
                                                ?>
                                                             <tr class="table-warning">
                                                                 <td class="align-middle"><?= date("d-m-Y", strtotime($withdraws->bw_date)); ?></td>
                                                                 <td class="align-middle"><?= $withdraws->bw_cheque_no ?></td>
                                                                 <td class="align-middle"><?= $withdraws->bw_note ?></td>
                                                                 <td class="align-middle"><?= number_format(($withdraws->bw_amount), 2, '.', ',') ?></td>
                                                                 <td class="align-middle">0.00</td>
                                                                 <td class="align-middle"><?= number_format(($withdraws->bw_available_balance), 2, '.', ',') ?> </td>
                                                             </tr>
                                                 <?php }
                                                        }
                                                    } ?>

                                                 <?php if (!empty($bankDeposits)) {
                                                        foreach ($bankDeposits->result() as $deposits) {
                                                            if ($deposits->bd_date == $value) {
                                                    ?>
                                                             <tr class="table-success">
                                                                 <td class="align-middle"><?= date("d-m-Y", strtotime($deposits->bd_date)); ?></td>
                                                                 <td class="align-middle"><?= $deposits->bd_cheque_no ?></td>
                                                                 <td class="align-middle"><?= $deposits->bd_reference ?></td>
                                                                 <td class="align-middle">0.00</td>
                                                                 <td class="align-middle"><?= number_format(($deposits->bd_amount), 2, '.', ',') ?></td>
                                                                 <td class="align-middle"><?= number_format(($deposits->bd_available_balance), 2, '.', ',') ?></td>
                                                             </tr>
                                             <?php }
                                                        }
                                                    }
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