<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title"><i class="fas fa-th"></i> Bank List</h3>
                                </div>
                            </div>
                        </div>

                        <?= alert_check() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>SL No.</th>
                                                <th>Name</th>
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
                                                        <td class="align-middle"><?= $list->b_title ?></td>
                                                        <td class="align-middle"><?= $list->b_description ?></td>
                                                        <td class="align-middle text-center">
                                                            <button type="button" class="btn bg-primary btn-xs editbutton" data-toggle="modal" data-id="<?= $list->b_id ?>"><i class='fas fa-user-edit'></i></button>
                                                            <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Bank/deleteBank?b_id=<?= $list->b_id ?>" id="<?= $list->b_id ?>">
                                                                <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </a>
                                                            <!-- <a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>setup/Bank/inactiveBank?b_id=<?= $list->b_id ?>" id="<?= $list->b_id ?>">
                                                                    <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Bank/permanentlyDeleteBank?b_id=<?= $list->b_id; ?>" type='button' class='btn bg-danger btn-xs'>
                                                                    <i class="fas fa-trash"></i>
                                                                    Permanently Delete
                                                                </a> -->
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
                    </div>
                </div>

                <!-- Add Bank -->
                <div class="col-md-5">
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fas fa-plus-circle"></i> Add New Bank</h3>
                        </div>

                        <form method="POST" action="<?php echo base_url('insert_bank') ?>" onkeydown="return event.key != 'Enter';">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" value="" name="b_title" id="" placeholder="Enter Bank Title" data-validation="length" data-validation-length="min2">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" value="" name="b_description" id="" placeholder="Description" data-validation="length" data-validation-length="min2">
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

<!-- Edit Bank Modal-->
<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>Edit Bank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="" action="<?php echo base_url('update_bank'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Bank Title</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="b_title" id="title" placeholder="Enter Bank Title" data-validation="length" data-validation-length="min2">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control" value="" name="b_description" id="description" placeholder="Enter Bank Description" data-validation="length" data-validation-length="min2">
                    </div>

                    <input type="hidden" name="b_id" id="id" value="">

                    <button type="submit" name="submit" class="btn btn-info"> Submit</button>
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
                url: '<?php echo base_url(); ?>setup/Bank/editBankByJason?id=' + iid,

                success: function(resp) {
                    var json = $.parseJSON(resp);
                    console.log(json);
                    $('#id').val(json.bank.b_id);
                    $('#title').val(json.bank.b_title);
                    $("#description").val(json.bank.b_description).trigger('change');

                    $('#myModal2').modal('show');
                }
            });
        });

    });
</script>