<style>
    .pass_hide_show {
        position: relative;
        z-index: 99;
    }

    .toggle-password {
        position: absolute;
        z-index: 1;
        right: 19px;
        bottom: 13px;
        font-size: 14px;
        color: #a1a1a1;
    }
</style>
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
        <form method="POST" action="<?php echo base_url('user/UserView/profile_updated') ?>">
            <input type="hidden" name="id" value="<?= $user_info->u_id ?>">
            <div class="col-md-12">
                <!-- general form elements -->
                <div id="color_change" class="box box-primary">
                    <div class="box-header with-border">
                        <h3 id="content_title" class="box-title">User Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="login form-inner clearfix">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="billing-first-name">
                                        First Name<span>*</span>
                                    </label>
                                    <input type="text" name="fname" class="form-control " id="billing-first-name" data-validation="required length" data-validation-length="max100" value="<?= $user_info->u_first_name ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="billing-last-name">
                                        Last Name<span>*</span>
                                    </label>
                                    <input type="text" name="lname" class="form-control" id="billing-last-name" data-validation="required length" data-validation-length="max100" value="<?= $user_info->u_last_name ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group pass_hide_show">
                                    <label for="password">Password<span>*</span></label>
                                    <input type="password" name="password" class="form-control password_hide_show" id="password" placeholder="Password" data-validation=" length" data-validation-length="max100" value="<?= $user_info->u_password ?>" required>
                                    <i toggle="#password" class="fa fa-fw toggle-password field-icon fa-eye"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="phone">Phone No<span>*</span></label>
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" data-validation="required length" data-validation-length="max100" value="<?= $user_info->u_phone ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="address">Address<span>*</span></label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Address" data-validation="required length" data-validation-length="max100" required value="<?= $user_info->u_address ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button id="submit_button" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-6">
                <!-- general form elements -->
                <div id="color_change" class="box box-primary">

                </div>
                <!-- /.box -->
            </div>

            <!-- /.box -->
        </form>
    </section>
    <div class="clearfix"></div>
</div>
<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $('.password_hide_show').attr('type');
            if (type == 'text') {
                $(".password_hide_show").attr("type", "password");
            } else {
                $(".password_hide_show").attr("type", "text");
            }
        });
    });
</script>