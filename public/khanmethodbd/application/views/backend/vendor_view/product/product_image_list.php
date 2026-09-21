<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Product Image List
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Product Image</a></li>
      <li class="active">Product Image List</li>
    </ol>
  </section>
  <!-- /.box -->

  <section class="content">

    <div class="box">
      <div class="box-header">
        <div class="row">
          <div class="col-md-3 col-md-offset-9">
                <a href="<?php echo base_url('backend/Vendor/related_product_images_create/'); ?><?=$p_id?>" class="btn btn-success pull-right text-white"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Serial</th>
              
              <th>Image</th>
              
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($products_list) {
              $Serial = 1;
              foreach ($products_list->result() as $row) {
                ?>
                <tr>
                  <td><?= $Serial++ ?></td>
                  
                  <td>
                    <img src="<?php echo base_url(); ?>assets/products/<?= $row->poduct_images_image ?>" alt="no image" width="128" height="128">

                  </td>
                  
                  <td>
                    
                    <a onclick="return confirm('Are you sure you want to delete this Item?');" href="<?php echo base_url(); ?>backend/Vendor/product_image_delete/<?= $row->poduct_images_id ?>/<?=$p_id?>"><i class="fa fa-trash" aria-hidden="true"></i>
                      Delete</a>
                  </td>
                </tr>

            <?php }
            } else { }
            ?>

          </tbody>

        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
</div>
<!-- /.content-wrapper -->