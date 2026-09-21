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
                <form  method="POST"  action="<?php echo base_url('backend/Admin/profile_updated') ?>">
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
                            <label>Admin Name</label>
                            <input type="text" name="authority_name" value="<?=$admin_info->authority_name;?>" class="form-control" placeholder="Enter Category Name">
                        </div>

                        <div class="form-group">
                            <label>Admin Password</label>
                            
                            <input type="password" name="password" value="000000" class="form-control" placeholder="Enter Category Name">
                        </div>

                        <div class="form-group">
                            <label>Admin Email</label>
                            <input type="text" name="authority_email" value="<?=$admin_info->authority_email;?>" class="form-control" placeholder="Enter Category Name">
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
                
                    <!-- /.box-body -->

                    
               
            </div>
            <!-- /.box -->
        </div>

        <!-- /.box -->
        </form>
    </section>
    <div class="clearfix"></div>

</div>