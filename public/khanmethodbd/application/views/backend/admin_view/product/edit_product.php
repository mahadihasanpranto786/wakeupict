<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Product List
            <small>Update Product Information</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Product</a></li>
            <li class="active">Update Product Information</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update Product Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Admin/update_product') ?>">
                <div class="box-body">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input value="<?= $product_information->p_tittle; ?>" data-validation="length" data-validation-length="min1" name="p_tittle" type="text" class="form-control" id="" placeholder="Enter Product Name">
                            <input value="<?= $product_information->p_id; ?>" type="hidden" name="identifier">
                            <input value="<?= $product_information->p_imagepath; ?>" type="hidden" name="temp_img">
                            <input value="<?= $product_information->p_file; ?>" type="hidden" name="p_file">
                        </div>

                        <div class="form-group">
                            <label for="">Product Purchase Price</label>
                            <input data-validation="number" data-validation-allowing="float" value="<?= $product_information->p_pprice; ?>" name="p_pprice" type="text" class="form-control" id="" placeholder="Enter Product Purchase Price">
                        </div>

                        <div class="form-group">
                            <label for="">Product Selling Price</label>
                            <input data-validation="number" data-validation-allowing="float" value="<?= $product_information->p_sprice; ?>" name="p_sprice" type="text" class="form-control" id="" placeholder="Enter Product Selling Price">
                        </div>

                        <div class="form-group">
                            <label for="">Product Quantity</label>
                            <input data-validation="number" data-validation-allowing="range[1;100000]" value="<?= $product_information->p_quantity; ?>" name="p_quantity" type="number" class="form-control" id="" placeholder="Enter Product Quantity">
                        </div>

                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input name="image_path" value="<?= $product_information->p_imagepath; ?>" type="file" class="form-control" id="" placeholder="Enter Product Image">
                        </div>
                        <div class="form-group">
                            <label for="">Product File <span class="text-danger"> (only PDF file allowed)</span></label>
                            <input type="file" name="product_file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category </label>
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


                            <textarea name="p_description" id="editor1" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                        <?= $product_information->p_description; ?>
                        </textarea>

                        </div>

                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Update</button>
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
<script>
    document.getElementById('p_category').value = <?= $product_information->p_category ?>
</script>