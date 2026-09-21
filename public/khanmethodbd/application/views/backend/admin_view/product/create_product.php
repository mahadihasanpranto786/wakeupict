<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Product List
            <small>Create New Product</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Product</a></li>
            <li class="active">Create New Product</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">
        <div class="box-header">
            <?= alert_check() ?>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create New Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Admin/store_product') ?>">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input name="p_tittle" type="text" class=" form-control" data-validation="length" data-validation-length="min1" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label for="">Product Purchase Price</label>
                            <input name="p_pprice" type="text" class="form-control" data-validation="number" data-validation-allowing="float" placeholder="Enter Product Purchase Price">
                        </div>

                        <div class="form-group">
                            <label for="">Product Selling Price</label>
                            <input name="p_sprice" type="text" class="form-control" data-validation="number" data-validation-allowing="float" placeholder="Enter Product Selling Price">
                        </div>

                        <div class="form-group">
                            <label for="">Product Quantity</label>
                            <input name="p_quantity" data-validation="number" data-validation-allowing="range[1;100000]" type="text" class="form-control" id="" placeholder="Enter Product Quantity">
                        </div>

                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input name="image_path" type="file" class="form-control" id="" placeholder="Enter Product Image">
                        </div>
                        <div class="form-group">
                            <label for="">Product File <span class="text-danger"> (only PDF file allowed)</span></label>
                            <input type="file" name="product_file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="p_category">Category </label>
                            <select class="form-control" data-validation="required" id="p_category" name="p_category">
                                <?php foreach ($categories_list->result() as $row) { ?>
                                    <option value='<?= $row->c_id ?>'><?= $row->c_name ?></option>
                                    <?php
                                    $sub_category = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => $row->c_id]);
                                    if ($sub_category) {
                                        foreach ($sub_category->result() as $sub) { ?>
                                            <option value='<?= $sub->c_id ?>'> --<?= $sub->c_name ?></option>
                                <?php }
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Product Description</label>

                            <textarea name="p_description" id="editor1" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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

<script type="text/javascript" src="<?php echo base_url('assets/admin_layout/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('') ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1', {
        height: 300,
        filebrowserUploadUrl: "<?php echo base_url('') ?>backend/Admin/imageUpload",
        filebrowserUploadMethod: "form"
    });
</script>
<script>
    $(function() {

        $('.textarea').wysihtml5()
    })
</script>
<!-- /.content-wrapper -->