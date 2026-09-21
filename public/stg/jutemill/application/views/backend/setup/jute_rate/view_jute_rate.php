<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jute Rate Basis # <?= $summary->jrs_sl_no; ?></h1>
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

            <li class="breadcrumb-item"><a href="<?php echo base_url('list_jute_rate'); ?>">Back to Jute Rate Lists</a></li>
            <li class="breadcrumb-item active">Jute Rate Sheets</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <!-- <div class="row"-->
      <!-- Main content -->
      <div class="invoice p-3 mb-3">
        <div class="row invoice-info">
          <div class="col-sm-3 invoice-col">
          </div>
          <!-- /.col -->
          <div class="col-sm-6 invoice-col">
            <div class="text-center">
              <h3>Rajbari Jute Mills LTD.</h3>
              <h4>Project Office Jute Purchasing Center</h4>
              <h3>Jute Rate Basis</h3>
              <br>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-3 invoice-col">
            <div class="">
              <b class="text-danger">Financial Year: <?= $this->M_financial_year->getFinancialYearById($summary->jrs_fy_id)->fy_title; ?>
              </b><br>
              <b class="text-danger">Start Date: <?= date("d-m-Y", strtotime($summary->jrs_start_date)); ?>
              </b><br>
              <b class="text-danger">Serial Number: <?= $summary->jrs_sl_no; ?>
              </b><br>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <tr>
                <th colspan="6" class="text-center">CARPET YARN</th>
              </tr>
              <tr>
                <th>Grade</th>
                <?php if ($areas) {
                  foreach ($areas->result() as $area) {
                ?>
                    <input type="hidden" name="areaID[]" class="form-control" id="" value='<?= $area->ar_id ?>'>
                    <th><?= $area->ar_title ?></th>
                <?php
                  }
                }
                ?>
              </tr>
              <?php if ($grades) {
                foreach ($grades->result() as $grade) {
              ?>
                  <tr>
                    <td>
                      <?= $grade->j_g_title ?>
                      <input type="hidden" name="gradeId[]" class="form-control" id="" value='<?= $grade->j_g_id ?>'>
                    </td>
                    <?php if ($areas) {
                      foreach ($areas->result() as $area) {
                    ?>
                        <td>
                          <input disabled type="text" value="<?= getJuteRate($grade->j_g_id, $area->ar_id, $juteRateSumaryID); ?>" name="juteRate[]" class="form-control" id="" placeholder="<?= str_replace(' ', '', $area->ar_title) . "_" . $grade->j_g_title ?>">
                        </td>
                    <?php
                      }
                    }
                    ?>
                  </tr>
              <?php
                }
              }
              ?>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- <div class="row"> -->
        <br><br>
        <div class="row">
          <div class="col-md-6">
            <table class="table table-striped">
              <tr>
                <th colspan="6" class="text-center">Acceptable Moisture %</th>
              </tr>
              <tr>
                <th>Type</th>
                <?php if ($areas) {
                  foreach ($areas->result() as $area) {
                ?>
                    <th><?= $area->ar_title ?></th>
                <?php
                  }
                }
                ?>
              </tr>
              <tr>
                <th>New</th>
                <?php if ($areas) {
                  foreach ($areas->result() as $area) {
                ?>
                    <td><input disabled type="text" name="new[]" value="<?= getJuteRateMoistureNew($area->ar_id, $juteRateSumaryID); ?>" class="form-control" id="" placeholder=""></td>
                <?php
                  }
                }
                ?>
              </tr>
              <tr>
                <th>Old</th>
                <?php if ($areas) {
                  foreach ($areas->result() as $area) {
                ?>
                    <td><input disabled type="text" name="old[]" value="<?= getJuteRateMoistureOld($area->ar_id, $juteRateSumaryID); ?>" class="form-control" id="" placeholder=""></td>
                <?php
                  }
                }
                ?>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-striped">
              <tr>
                <th colspan="6" class="text-center">Deductions</th>
              </tr>
              <tr>
                <th>Type</th>
                <th>Out turn (%)</th>
                <th>Out turn (%)</th>
                <th>Out turn (%)</th>
                <th>Out turn (%)</th>
                <th>Rate</th>
              </tr>
              <?php
              if ($deductions) {
                foreach ($deductions->result() as $deduction) {
              ?>
                  <tr>
                    <th>SMR</th>
                    <th><?= $deduction->jr_smr_per_from ?></th>
                    <th><?= $deduction->jr_smr_logic_from ?></th>
                    <th><?= $deduction->jr_smr_per_till ?></th>
                    <th><?= $deduction->jr_smr_logic_till ?></th>
                    <th><?= $deduction->jr_smr_rate ?></th>
                  </tr>
              <?php
                }
              }
              ?>
            </table>
          </div>

        </div>
        <!-- </div> -->
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-12">
            <button type="button" class="btn btn-success" onclick="window.print()">Print</button>

          </div>
        </div>
      </div>
      <!-- /.invoice -->
    </div>
</div><!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>