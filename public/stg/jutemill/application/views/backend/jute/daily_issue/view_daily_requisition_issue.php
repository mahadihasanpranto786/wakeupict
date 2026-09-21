 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-sm-6">
                     <h1>Daily Jute Requisition & Issue</h1>
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
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('add_daily_requisition') ?>">Add New Requisition</a></li>
                         <li class="breadcrumb-item active"><a href="<?php echo base_url('list_daily_requisition') ?>">Back to Requisition Summary</a></li>
                         <li class="breadcrumb-item active">Daily Requisition</li>
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
                             <h4 class="text-center text-uppercase"><u>Daily Jute Requisition & Issue </u></h4>
                         </div>
                         <!-- /.card-header -->
                         <!-- form start -->
                         <form role="form" action="" method="post">
                             <div class="card-body">
                                 <div class="row mb-2 text-danger">
                                     <div class="col-sm-2">
                                         <h4 class="font-weight-bold">SL No: <?= $reView->res_sl_no ?></h4>
                                     </div>
                                     <div class="col-sm-2">
                                         <h4 class="font-weight-bold">Unit: <?= $this->M_production_unit->getProductionUnitById($reView->res_pu_id)->pu_title ?></h4>
                                     </div>
                                     <div class="col-sm-3">
                                         <h4 class="font-weight-bold">Requisition Date: <?= date("d-m-Y", strtotime($reView->res_date)); ?></h4>
                                     </div>
                                     <div class="col-sm-3">
                                         <h4 class="font-weight-bold">Issue Date: <?= date("d-m-Y", strtotime($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($reView->res_id)->iss_date)); ?></h4>
                                     </div>
                                     <div class="col-sm-2">
                                         <h4 class="font-weight-bold">Financial Year: <?= $this->M_financial_year->getFinancialYearById($reView->res_fy_id)->fy_title ?></h4>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <!-- Table -->
                                     <table id="" class="table table-hover table-bordered">
                                         <thead>
                                             <tr>
                                                 <?php if ($areas) foreach ($areas->result() as $area) { ?>
                                                     <th colspan="3" class=""><?= $area->ar_title ?></th>
                                                     <input type="hidden" name="rev_ar_id[]" class="form-control" id="" value="<?= $area->ar_id ?>">
                                                 <?php } ?>
                                             </tr>
                                             <tr>
                                                 <?php if ($areas) foreach ($areas->result() as $area) { ?>
                                                     <th>Grade</th>
                                                     <!-- <th>Balance</th> -->
                                                     <th>Requisition</th>
                                                     <th>Issue</th>
                                                 <?php } ?>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php if ($jute_grades) {
                                                    foreach ($jute_grades->result() as $grade) { ?>
                                                     <tr>
                                                         <?php if ($areas) {
                                                                foreach ($areas->result() as $area) { ?>
                                                                 <td>
                                                                     <?= $grade->j_g_title ?>
                                                                 </td>

                                                                 <!-- <td>
                                                                     <//?php if (!empty($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($reView->res_id)->iss_id)) {
                                                                            $issueSummaryId = $this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($reView->res_id)->iss_id;
                                                                            echo getIssueBalanceValue($grade->j_g_id, $area->ar_id, $issueSummaryId);
                                                                        } ?>

                                                                 </td> -->
                                                                 <td>
                                                                     <?= getRequisitionValue($grade->j_g_id, $area->ar_id, $requisitionSummaryId); ?>
                                                                 </td>
                                                                 <td>
                                                                     <?php if (!empty($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($reView->res_id)->iss_id)) {
                                                                            $issueSummaryId = $this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($reView->res_id)->iss_id;
                                                                            echo getIssueValue($grade->j_g_id, $area->ar_id, $issueSummaryId);
                                                                        } ?>
                                                                 </td>
                                                         <?php }
                                                            } ?>
                                                     </tr>
                                             <?php }
                                                } ?>

                                         <tfoot>
                                             <?php if ($areas) foreach ($areas->result() as $area) { ?>
                                                 <td style="visibility: hidden;"></td>
                                                 <!-- <td class="font-weight-bold"></td> -->
                                                 <td class="font-weight-bold"></td>
                                                 <td class="font-weight-bold"></td>
                                             <?php } ?>
                                         </tfoot>

                                         </tbody>
                                     </table>
                                     <!-- <div class="row">
                                         <div class="col-sm-4" style="background-color:#98FB98">
                                             <table>
                                                 <tr>
                                                     <td>WH-1</td>
                                                     <input type="hidden" name="wh" value="wh">
                                                     <td>
                                                         <input type="text" name="" class="form-control" id="" placeholder="Balance" value="" readonly>
                                                     </td>
                                                     <td>
                                                         <input type="text" name="" class="form-control" id="" placeholder="" value="<//?= getRequisitionValue('wh', 'wh', $requisitionSummaryId); ?>" disabled>
                                                     </td>
                                                     <td>
                                                         <input type="text" name="wh_value" class="form-control isv_issue" id="whV" placeholder="" value="<//?= getIssueValue('wh', 'wh', $issueSummaryId) ?>" disabled>
                                                     </td>
                                                 </tr>
                                             </table>
                                         </div>
                                         <div class="col-sm-4" style="background-color:#98FB98">
                                             <table>
                                                 <tr>
                                                     <td>KF-1</td>
                                                     <input type="hidden" name="kf" value="kf">
                                                     <td>
                                                         <input type="text" name="" class="form-control" id="" placeholder="Balance" value="" readonly>
                                                     </td>
                                                     <td>
                                                         <input type="text" name="" class="form-control" id="" placeholder="" value="<//?= getRequisitionValue('kf', 'kf', $requisitionSummaryId); ?>" disabled>
                                                     </td>
                                                     <td>
                                                         <input type="text" name="kf_value" class="form-control isv_issue" id="kfV" placeholder="" value="<//?= getIssueValue('kf', 'kf', $issueSummaryId) ?>" disabled>
                                                     </td>
                                                 </tr>
                                             </table>
                                         </div>
                                         <div class="col-sm-4">

                                         </div>
                                     </div> -->
                                 </div>
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <h3>Grand Total Requisition: <span class="text-danger font-weight-bold"><?= number_format($reView->res_total_requisition, 3, '.', ''); ?></span></h3>
                                     </div>
                                     <div class="col-sm-6">
                                         <h3>Grand Total Issue: <span class="text-danger font-weight-bold"><?= number_format($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($reView->res_id)->iss_total_issue, 3, '.', ''); ?></span></h3>
                                     </div>
                                     <!-- <div class="col-sm-4">
                                         <h3>Grand Total Balance: <span class="text-danger font-weight-bold"><//?= number_format($this->M_daily_issue->getIssueSummaryByRequisitionSummaryId($reView->res_id)->iss_total_balance); ?></span></h3>
                                     </div> -->
                                 </div>
                                 <input type="hidden" name="">
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



 <!-- For Column wise data sum -->
 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <script>
     $(document).ready(function() {
         $('table thead th').each(function(i) {
             calculateColumn(i);
         });
     });

     function calculateColumn(index) {
         var total = 0;
         $('table tr').each(function() {
             var value = parseFloat($('td', this).eq(index).text());
             if (!isNaN(value)) {
                 total += value;
             }
         });
         $('table tfoot td').eq(index).text('Total = ' + total);
     }
 </script>