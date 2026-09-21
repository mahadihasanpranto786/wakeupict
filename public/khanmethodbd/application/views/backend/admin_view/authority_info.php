<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-sm-5">
                <div class="box box-primary box-outline">
                    <div class="box-body">
                        <div class="text-center">
                            <?php
                            if (isset($authorityData->authority_image)) {
                                $src = base_url() . "assets/uploads/authority/" . $authorityData->authority_image;
                            } else {
                                $src =  base_url() . 'images/users/avatar.png';
                            }
                            ?>
                            <img class="profile-user-img img-fluid img-circle rounded-circle " height="100" width="100" src="<?= $src ?>" alt="User profile picture">
                        </div>
                    </div>
                    <div class="box-header text-center">
                        <h3 class="box-title "><?= $authorityData->authority_name ?></h3>
                        <div class="box-body">
                            <a class="dropdown-item btn border-bottom p-2 text-left mb-1 btn-info" href="<?= base_url() . 'authority_info?id=1'; ?>" type="button">
                                <i class="fa fa-info-circle float-left ml-2 mr-2 "></i>Change Info</a>
                            <a class="dropdown-item btn border-bottom text-left  p-2 mb-1 btn-info" href="<?= base_url() . 'authority_info?id=3'; ?>" type="button">
                                <i class="fa  float-left ml-2 mr-2 fa-image"></i> Change Image</a>
                            <a class="dropdown-item btn border-bottom text-left p-2 btn-info" href="<?= base_url() . 'authority_info?id=2'; ?>" type="button">
                                <i class="fa float-left ml-2 mr-2 fa-key"></i> Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="box box-primary box-outline">
                    <div class="box-header">
                        <h3 class="box-title">Authority info</h3>
                    </div>
                    <div class="box-body  ">
                        <!-- /.box-header -->
                        <?php
                        if ($this->input->get("id") == 1) {  ?>
                            <form method="POST" autocomplete="off" action="<?= base_url() ?>updateAuthority" enctype="multipart/form-data">

                                <div class="tab-content" id="main_form">
                                    <div class="form-group">
                                        <span class="form-group-text">Authority Name <span class="text-danger">*</span></span>
                                        <input name="authority_name" value="<?= $authorityData->authority_name ?>" type="text" class="form-control" placeholder="Enter your name">
                                    </div>
                                    <div class="form-group">
                                        <span class="form-group-text">Email<span class="text-danger">*</span></span>

                                        <input required name="authority_email" value="<?= $authorityData->authority_email ?>" type="text" class="form-control" placeholder="Enter your email">
                                    </div>
                                    <div class="form-group">
                                        <span class="form-group-text">Mobile <span class="text-danger">*</span></span>

                                        <input name="authority_phone" value="<?= $authorityData->authority_phone ?>" type="address" class="form-control" placeholder="Enter your mobile number">
                                    </div>
                                    <div class="form-group">
                                        <span class="form-group-text">Address</span>

                                        <input name="authority_address" value="<?= $authorityData->authority_address ?>" type="address" class="form-control" placeholder="Enter your address">

                                    </div>
                                    <input value="<?= $authorityData->authority_id ?>" type="hidden" name="authority_id" id="authority_id">
                                    <input type="hidden" class="custom-file-input" name="con_id" value="1">
                                </div>
                                <button type="submit" class="btn btn-sm btn-success mt-3 pull-right">
                                    Update
                                </button>
                            </form>
                            <?php } elseif ($this->input->get("id") == 2) {
                            if ($passAlert = $this->session->flashdata('error')) {
                            ?>

                                <div class="alert alert-warning">
                                    <strong> <?= $passAlert; ?></strong>
                                </div>
                            <?php
                                $this->session->unset_userdata('error');
                            } elseif ($success = $this->session->flashdata('success')) {
                            ?>
                                <div class="alert alert-success">
                                    <strong> <?= $success; ?></strong>
                                </div>
                            <?php
                                $this->session->unset_userdata('success');;
                            } ?>
                            <form method="POST" autocomplete="off" action="<?= base_url() ?>updateAuthority" enctype="multipart/form-data">
                                <div class="tab-content" id="main_form">
                                    <div class="form-group">
                                        <span class="form-group-text">Password</span>

                                        <input required name="authority_password" type="password" class="form-control" placeholder="Enter your new password">
                                    </div>
                                    <input type="hidden" class="custom-file-input" name="con_id" value="2">
                                    <input value="<?= $authorityData->authority_id ?>" type="hidden" name="authority_id" id="authority_id">
                                </div>
                                <button type="submit" class="btn btn-sm btn-success mt-3 pull-right">
                                    Update
                                </button>
                            </form>
                        <?php } elseif ($this->input->get("id") == 3) { ?>
                            <form class="form-group" method="POST" autocomplete="off" action="<?= base_url() ?>updateAuthority" enctype="multipart/form-data">
                                <div class="tab-content" id="main_form">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="image">Profile photo</label>
                                            <input name="authority_image" value="<?= $authorityData->authority_image ?>" type="file" class="custom-file-label">
                                        </div>
                                        <?php
                                        if (isset($authorityData->authority_image)) {
                                            $src = base_url() . "assets/uploads/authority/" . $authorityData->authority_image;
                                        } else {
                                            $src =  base_url() . 'assets/admin_layout/image/admin.png';
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" class="custom-file-input" name="con_id" value="3">
                                    <input type="hidden" class="custom-file-input" name="hidden_img" id="hidden_img" value="<?= $authorityData->authority_image ?>">
                                    <input value="<?= $authorityData->authority_id ?>" type="hidden" name="authority_id" id="authority_id">
                                    <img style="width: 70px; height: 60px;" src="<?= $src ?>" alt=""/>
                                </div>
                                <button type="submit" class="btn btn-sm btn-success mt-3 pull-right">
                                    Update
                                </button>
                            </form>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>