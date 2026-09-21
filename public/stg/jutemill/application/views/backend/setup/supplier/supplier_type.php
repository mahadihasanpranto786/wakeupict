<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title"><i class="fas fa-th"></i> Supplier Type List</h3>
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
                                                    <th>Type</th>
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
                                                            <td class="align-middle"><?= $list->sup_t_title ?></td>
                                                            <td class="align-middle"><?= $list->sup_t_description ?></td>
                                                            <td class="align-middle text-center">
                                                                <button type="button" class="btn bg-primary btn-xs editbutton" data-toggle="modal" data-id="<?= $list->sup_t_id ?>"><i class='fas fa-user-edit'></i></button>
                                                                <a onclick="return confirm('Are you sure you want to delete this?');" href="<?php echo base_url(); ?>setup/Supplier/deleteSupplierType?sup_t_id=<?= $list->sup_t_id ?>" id="<?= $list->sup_t_id ?>">
                                                                    <button type='button' name='delete_btn' id="" class='btn bg-danger btn-xs'>
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to inactive this?');" href="<?php echo base_url(); ?>setup/Supplier/inactiveSupplierType?sup_t_id=<?= $list->sup_t_id ?>" id="<?= $list->sup_t_id ?>">
                                                                    <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                                    </button>
                                                                </a>
                                                                <a onclick="return confirm('Are you sure you want to permanently delete this? You will not able to recover this.');" href="<?php echo base_url('') ?>setup/Supplier/permanentlyDeleteSupplierType?sup_t_id=<?= $list->sup_t_id; ?>" type='button' class='btn bg-danger btn-xs'>
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
                            <h3 class="card-title"><i class="fas fa-plus-circle"></i> Add Type</h3>
                        </div>

                        <form id="add_area" method="POST" action="<?php echo base_url('insert_supplier_type') ?>">
                            <div class="card-body">
                                <div class="=col-md-12">
                                    <div class="form-group">
                                        <label>Supplier Type Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" value="" name="sup_t_title" id="" placeholder="Supplier Type Titel" data-validation="length" data-validation-length="min2">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" value="" name="sup_t_description" id="" placeholder="Description" data-validation="length" data-validation-length="min2">
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

<!-- Edit Supplier Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>Edit Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="" action="<?php echo base_url('') ?>setup/Supplier/updateSupplierType" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Supplier Name</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="sup_t_title" id="sup_t_title" placeholder="Supplier Name" data-validation="length" data-validation-length="min2">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control" value="" name="sup_t_description" id="sup_t_description" placeholder="Description" data-validation="length" data-validation-length="min2">
                    </div>

                    <input type="hidden" name="sup_t_id" id="sup_t_id" value="">

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
                url: '<?php echo base_url(); ?>setup/Supplier/editSupplierTypeByJason?id=' + iid,

                success: function(resp) {
                    var json = $.parseJSON(resp);
                    console.log(json);
                    $('#sup_t_id').val(json.supplier_type.sup_t_id);
                    $('#sup_t_title').val(json.supplier_type.sup_t_title);
                    $("#sup_t_description").val(json.supplier_type.sup_t_description).trigger('change');

                    $('#myModal2').modal('show');
                }
            });
        });

    });
</script>