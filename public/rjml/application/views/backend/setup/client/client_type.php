<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Client Type</h1>
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
                        <li class="breadcrumb-item active">Add Client Type</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">Client Type List</h3>
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
                                                    <th>SL. No</th>
                                                    <th>Client Type</th>
                                                    <th>Description</th>
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
                                                            <td class="align-middle"><?= $list->ct_title ?></td>
                                                            <td class="align-middle"><?= $list->ct_description ?></td>
                                                            <td class="align-middle text-center">
                                                                <button type="button" class="btn bg-primary btn-xs editbutton" data-toggle="modal" data-id="<?= $list->ct_id ?>"><i class='fas fa-user-edit'></i></button>
                                                                <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Client/deleteClientType?ct_id=<?= $list->ct_id ?>" id="<?= $list->ct_id ?>">
                                                                    <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>setup/Client/inactiveClientType?ct_id=<?= $list->ct_id ?>" id="<?= $list->ct_id ?>">
                                                                    <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Client/permanentlyDeleteClientType?ct_id=<?= $list->ct_id; ?>" type='button' class='btn bg-danger btn-xs'>
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

                <div class="col-md-5">
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Add Client Type</h3>
                        </div>

                        <form id="add_area" method="POST" action="<?php echo base_url('insert_client_type') ?>" onkeydown="return event.key != 'Enter';">
                            <div class="card-body">
                                <div class="=col-md-12">
                                    <div class="form-group">
                                        <label>Client Type Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" value="" name="ct_title" id="" placeholder="Client Type Title" data-validation="length" data-validation-length="min2">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span class="text-danger">*</span>
                                        <textarea type="text" class="form-control" value="" name="ct_description" id="" placeholder="Description" data-validation="length" data-validation-length="min2" rows="4"></textarea>
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

<!-- Edit Client Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>Edit Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="add_area" method="POST" action="<?php echo base_url('update_client_type') ?>">
                    <div class="card-body">
                        <div class="=col-md-12">
                            <div class="form-group">
                                <label>Client Type Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" value="" name="ct_title" id="ct_title" placeholder="Client Type Title" data-validation="length" data-validation-length="min2">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <span class="text-danger">*</span>
                                <textarea type="text" class="form-control" value="" name="ct_description" id="ct_description" placeholder="Description" data-validation="length" data-validation-length="min2" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="ct_id" id="ct_id" value="">
                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-info"> Submit</button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /Edit Modal-->


<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".editbutton").click(function() {
            var iid = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>setup/Client/editClientTypeByJason?id=' + iid,

                success: function(resp) {
                    var json = $.parseJSON(resp);
                    // console.log(json);
                    $('#ct_id').val(json.client_type.ct_id);
                    $('#ct_title').val(json.client_type.ct_title);
                    $("#ct_description").val(json.client_type.ct_description).trigger('change');

                    $('#myModal2').modal('show');
                }
            });
        });

    });
</script>