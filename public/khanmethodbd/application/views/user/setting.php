<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Settings
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Settings</a></li>
            <li class="active">Control panel</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">
        <div class="box-header">
            <?= alert_check() ?>
        </div>
        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Admin/settings_updated') ?>">
            <div class="col-md-6">
                <!-- general form elements -->
                <div id="color_change" class="box box-primary">
                    <div class="box-header with-border">
                        <h3 id="content_title" class="box-title">Invoice Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="s_companyname" value="<?= $company_info->s_companyname; ?>" class="form-control" placeholder="Enter Category Name">
                        </div>
                        <div class="form-group">
                            <label for="">Company Logo</label>
                            <input value="<?= $company_info->s_company_logo; ?>" type="hidden" name="c_temp_img">
                            <input name="c_image_path" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Invoice Logo</label>
                            <input value="<?= $company_info->s_invoice_logo; ?>" type="hidden" name="temp_img">
                            <input name="image_path" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Company Address</label>


                            <textarea name="s_companyaddress" class="textarea" placeholder="Place some text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $company_info->s_companyaddress; ?></textarea>

                        </div>
                        <div class="form-group">
                            <label for="">Terms of service</label>


                            <textarea name="s_tandc" class="textarea" placeholder="Place some text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $company_info->s_tandc; ?></textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Recent Product Status</label>
                            <select class="form-control" data-validation="required" id="s_recent_product_status" name="s_recent_product_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Middle Banner Status</label>
                            <select class="form-control" data-validation="required" id="s_middlebanner_status" name="s_middlebanner_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">lower Banner Status</label>
                            <select class="form-control" data-validation="required" id="s_lower_banner_status" name="s_lower_banner_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Feature Banner Status</label>
                            <select class="form-control" data-validation="required" id="s_featurs_banner_status" name="s_featurs_banner_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slider Status</label>
                            <select class="form-control" data-validation="required" id="s_slider_status" name="s_slider_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Feature Status</label>
                            <select class="form-control" data-validation="required" id="s_feature_section_status" name="s_feature_section_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>



                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button id="submit_button" type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-6">
                <!-- general form elements -->
                <div id="color_change" class="box box-primary">
                    <div class="box-header with-border">
                        <h3 id="content_title" class="box-title">System Setup</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">

                        <div class="form-group">
                            <label>Company Text Logo</label>
                            <input type="text" name="s_admin_logo" value="<?= $company_info->s_admin_logo; ?>" class="form-control" placeholder="Enter Category Name">
                        </div>

                        <div class="form-group">
                            <label for="">Company Footer</label>


                            <textarea name="s_tandc" required class="textarea" placeholder="Place some text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $company_info->s_footer; ?></textarea>

                        </div>

                        <div class="form-group">
                            <label>Company Login Tittle</label>
                            <input type="text" name="s_login_tittle" value="<?= $company_info->s_login_tittle; ?>" class="form-control" placeholder="Enter Category Name">
                        </div>

                        <div class="form-group">
                            <label for="">Company Login Description</label>


                            <textarea name="s_description" placeholder="Place some text here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $company_info->s_description; ?></textarea>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Popular and Best Product Status</label>
                            <select class="form-control" data-validation="required" id="s_pop_and_best_product_status" name="s_pop_and_best_product_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Three category section Status</label>
                            <select class="form-control" data-validation="required" id="s_three_category_section_status" name="s_three_category_section_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Three category section 1st Category </label>
                            <select class="form-control" data-validation="required" id="s_three_category_section_1st_category" name="s_three_category_section_1st_category">
                                <?php foreach ($categories_list->result() as $row) { ?>
                                    <option value='<?= $row->c_id ?>'><?= $row->c_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Three category section 2nd Category </label>
                            <select class="form-control" data-validation="required" id="s_three_category_section_2nd_category" name="s_three_category_section_2nd_category">
                                <?php foreach ($categories_list->result() as $row) { ?>
                                    <option value='<?= $row->c_id ?>'><?= $row->c_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Three category section 3rd Category </label>
                            <select class="form-control" data-validation="required" id="s_three_category_section_3rd_category" name="s_three_category_section_3rd_category">
                                <?php foreach ($categories_list->result() as $row) { ?>
                                    <option value='<?= $row->c_id ?>'><?= $row->c_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Product Slider Status</label>
                            <select class="form-control" data-validation="required" id="s_category_slider_status" name="s_category_slider_status">
                                <option value='1'>Active</option>
                                <option value='0'>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Product Slider Category</label>
                            <select class="form-control" data-validation="required" id="s_category_slider" name="s_category_slider">
                                <?php foreach ($categories_list->result() as $row) { ?>
                                    <option value='<?= $row->c_id ?>'><?= $row->c_name ?></option>
                                <?php } ?>
                            </select>
                        </div>






                    </div>
                    <!-- /.box-body -->



                </div>
                <!-- /.box -->
            </div>

            <!-- /.box -->
        </form>
    </section>
    <div class="clearfix"></div>

</div>
<script>
    document.getElementById('s_recent_product_status').value = <?= $company_info->s_recent_product_status ?>
</script>
<script>
    document.getElementById('s_middlebanner_status').value = <?= $company_info->s_middlebanner_status ?>
</script>
<script>
    document.getElementById('s_lower_banner_status').value = <?= $company_info->s_lower_banner_status ?>
</script>
<script>
    document.getElementById('s_feature_section_status').value = <?= $company_info->s_feature_section_status ?>
</script>
<script>
    document.getElementById('s_featurs_banner_status').value = <?= $company_info->s_featurs_banner_status ?>
</script>
<script>
    document.getElementById('s_slider_status').value = <?= $company_info->s_slider_status ?>
</script>
<script>
    document.getElementById('s_pop_and_best_product_status').value = <?= $company_info->s_pop_and_best_product_status ?>
</script>
<script>
    document.getElementById('s_three_category_section_status').value = <?= $company_info->s_three_category_section_status ?>
</script>
<script>
    document.getElementById('s_three_category_section_1st_category').value = <?= $company_info->s_three_category_section_1st_category ?>
</script>
<script>
    document.getElementById('s_three_category_section_2nd_category').value = <?= $company_info->s_three_category_section_2nd_category ?>
</script>
<script>
    document.getElementById('s_three_category_section_3rd_category').value = <?= $company_info->s_three_category_section_3rd_category ?>
</script>
<script>
    document.getElementById('s_category_slider_status').value = <?= $company_info->s_category_slider_status ?>
</script>

<script>
    document.getElementById('s_category_slider').value = <?= $company_info->s_category_slider ?>
</script>