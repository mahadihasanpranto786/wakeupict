<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Products
            <small>Category Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
            <li class="active">Category</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Category Tittle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($categories_list) {
                                $Serial = 1;
                                foreach ($categories_list->result() as $row) {
                                    if ($row->c_parent != 0) {
                                        $parent = get_rltn_data('categories', 'c_id', $row->c_parent);
                                    }
                            ?>
                                    <tr>
                                        <td><?= $Serial++ ?></td>
                                        <td><?= $row->c_name ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-info edit_cat" id="<?= $row->c_id ?>"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this Item?');" href="<?php echo base_url(); ?>backend/Admin/category_delete/<?= $row->c_id ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="col-md-6">
            <!-- general form elements -->
            <div id="color_change" class="box box-primary">
                <div class="box-header with-border">
                    <h3 id="content_title" class="box-title">Create New Category</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form id="cat_main" method="POST" action="<?php echo base_url('backend/Admin/category_store') ?>">
                    <div class="box-body">
                        <input type="hidden" id="identifier" name="identifier">
                        <div class="form-group">
                            <label for="cat_name">Category Name</label>
                            <input type="text" id="cat_name" name="c_name" class="form-control" placeholder="Enter Category Name" required>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button id="submit_button" type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>

        <!-- /.box -->
    </section>
</div>
<!-- /.content-wrapper -->
<script src="<?php echo base_url('') ?>assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".edit_cat").click(function() {
            var id = $(this).attr("id");

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('Ajax_play/ajaxGetCatInformation') ?>",
                data: 'id=' + id,

                success: function(resp) {

                    var txtdata = 'Modify Category';
                    var information = JSON.parse(resp);

                    $('#cat_name').val(information.c_name);

                    $('#submit_button').html('Update');
                    $('#cat_main').attr('action', '<?php echo site_url('backend/Admin/category_update') ?>');
                    $('#identifier').val(id);
                    $('#content_title').html(txtdata);
                    $("#color_change").addClass("box box-danger");
                }
            });
        });


    });
</script>