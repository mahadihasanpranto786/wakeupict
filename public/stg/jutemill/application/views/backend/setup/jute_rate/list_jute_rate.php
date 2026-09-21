<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Jute Rate Sheets</h1>
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
                        <li class="breadcrumb-item active">Jute Rate Sheets</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="card-title mt-2"><i class="fas fa-th"></i> Jute Rate Sheets</h3>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('add_jute_rate') ?>"><button class="btn btn-primary float-right border"><i class="fas fa-plus-circle"></i> Add New Jute Rate Sheet</button></a>
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
                                        <th>SL. No.</th>
                                        <th>Financial year</th>
                                        <th>Sheet Number</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Total Purchases(<span class="text-danger">TK</span>)</th>
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
                                                <td><?= $serial ?></td>
                                                <td><?= $this->M_financial_year->getFinancialYearById($list->jrs_fy_id)->fy_title; ?></td>
                                                <td><?= $list->jrs_sl_no ?></td>
                                                <td><?= date("d-m-Y h:i A", strtotime($list->jrs_start_date)); ?></td>
                                                <td><?= date("d-m-Y h:i A", strtotime($list->jrs_end_date)); ?></td>
                                                <td><?php $totalSum = $this->M_jute_rate->totalJuteRateWIse($list->jrs_id);
                                                    if (!empty($totalSum)) {
                                                        echo number_format(($totalSum), 2, '.', ',');
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>setup/Jute_rate/viewJuteRate?jrs_id=<?= $list->jrs_id ?>" id="<?= $list->jrs_id ?>">
                                                        <button type="submit" class="btn bg-olive btn-xs"><i class="fas fa-eye"></i> View</button>
                                                    </a>
                                                    <?php
                                                    $current_user_type = $this->session->userdata('current_type');
                                                    if ($current_user_type == 1 || $current_user_type == 603 && $list->jrs_activity == 1) {
                                                        $usedInPurchase = $this->Common->get_single_row_information_multi_conditional('jute_purchase_invoice_summary', ['jpis_jrs_id' => $list->jrs_id, 'jpis_status' => 1]);
                                                        if ($usedInPurchase) {
                                                    ?>

                                                            <button id="d_al" type='button' class='btn bg-danger btn-xs'>
                                                                <i class="fas fa-trash"></i>
                                                                Delete
                                                            </button>
                                                            <!-- <a href="<?php echo base_url(); ?>setup/Jute_rate/viewJuteRate?jrs_id=<?= $list->jrs_id ?>" id="<?= $list->jrs_id ?>">
                                                                <button type="submit" class="btn bg-olive btn-xs"><i class="fas fa-eye"></i> Edit</button>
                                                            </a> -->
                                                        <?php } else { ?>
                                                            <a onclick="return confirm('Are you sure you want to delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Jute_rate/permanentlyDeleteJuteRate?jrs_id=<?= $list->jrs_id; ?>" type='button' class='btn bg-danger btn-xs'>
                                                                <i class="fas fa-trash"></i>
                                                                Delete
                                                            </a>
                                                            <!-- <a href="<?php echo base_url(); ?>setup/Jute_rate/viewJuteRate?jrs_id=<?= $list->jrs_id ?>" id="<?= $list->jrs_id ?>">
                                                                <button type="submit" class="btn bg-olive btn-xs"><i class="fas fa-eye"></i> Edit</button>
                                                            </a> -->
                                                    <?php }
                                                    } ?>
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

<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#d_al').click(function() {
            Swal.fire({
                icon: 'error',
                title: 'This sheet already in use',
                text: "You can't delete this ............",

            })
        })
    })
</script>