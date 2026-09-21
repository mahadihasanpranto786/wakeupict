<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Product Image List
            <small>Create New Product Image</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Product Image</a></li>
            <li class="active">Create New Product Image</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">
<div class="box-header">
                    <?= alert_check() ?>
                </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create New Product Image</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Admin/store_product_image') ?>">
                <div class="box-body">
                    <div class="col-md-6">
                        <input type="hidden" name="p_id" value="<?=$p_id?>">
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input name="image_path" type="file" class="form-control" id="" placeholder="Enter Product Image">
                        </div>



                    </div>
                    


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
</div>

<script>
    $(function() {

        $('.textarea').wysihtml5()
    })
</script>
<!-- /.content-wrapper -->