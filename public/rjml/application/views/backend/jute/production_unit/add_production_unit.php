<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- List Daily Issue Unit -->
                <div class="col-7">
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-th"></i> Production Unit</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Unit Title</th>
                                        <th>Descriptions</th>
                                        <?php
                                        $current_user_type = $this->session->userdata('current_type');
                                        $formSeePeople = array(1, 10, 603);
                                        if (in_array($current_user_type, $formSeePeople)) {
                                        ?>
                                            <th>Actions</th>
                                        <?php }  ?>
                                    </tr>
                                </thead>
                                <tbody><?php
                                        if ($list) {
                                            $serial = 0;
                                            foreach ($list->result() as $list) {
                                                $serial++;
                                        ?>
                                            <tr>
                                                <td class="align-middle text-center"><?= $serial ?></td>
                                                <td class="align-middle"><?= $list->pu_title ?></td>
                                                <td class="align-middle"><?= $list->pu_description ?></td>
                                                <?php
                                                if (in_array($current_user_type, $formSeePeople)) {
                                                ?>
                                                    <td class="align-middle text-center">
                                                        <a id="<?= $list->pu_id; ?>" title="<?= $list->pu_title; ?>" description="<?= $list->pu_description; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
                                                            <i class='fas fa-user-edit'></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure want to delete this?');" href="jute/production_unit/deleteProductionUnit?pu_id=<?= $list->pu_id; ?>">
                                                            <button type='button' class='btn bg-danger btn-xs'>
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </a>
                                                        <!-- <a onclick="return confirm('Are you sure want to inactive this?');" href="jute/production_unit/inactiveProductionUnit?pu_id=<?= $list->pu_id; ?>">
                                                        <button type='button' id="" class='btn bg-danger btn-xs'>Inactive
                                                        </button>
                                                    </a> -->
                                                    </td>
                                            </tr>
                                <?php }
                                            }
                                        } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- / Daily Issue Unit -->
                <!-- Add Daily Issue Unit -->
                <div class="col-md-5">
                    <?php
                    if (in_array($current_user_type, $formSeePeople)) {
                    ?>
                        <div class="card card-primary mt-3">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-plus-circle"></i> Add Production Unit</h3>
                            </div>
                            <form role="form" action="<?php echo base_url('insert_production_unit'); ?>" method="post">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="exampleInputEmail1">Unit Title</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" name="pu_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Unit" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label>Description</label>
                                            <span class="text-danger">*</span>
                                            <textarea class="form-control" name="pu_description" rows="5" placeholder="Enter Unit Description" required></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="pu_id">
                                </div>
                                <div class="card-footer">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <!-- / Add Unit -->
            </div>
        </div>
    </section>
</div>
<!-- Unit Update Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Update Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('update_production_unit'); ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="exampleInputEmail1">Category Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="title" name="pu_title" class="form-control" id="exampleInputEmail1" placeholder="Enter Unit" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>Description</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control" id="description" name="pu_description" rows="5" placeholder="Enter Unit Description" required></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="id" name="pu_id">
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Script File -->
<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".editbutton").click(function(e) {
            var iid = $(this).attr('id');
            var title = $(this).attr('title');
            var description = $(this).attr('description');
            // alert(iid);
            $('#myModal2').modal('show');
            $('#id').val(iid);
            $('#title').val(title);
            $('#description').val(description);
        });
    });
</script>