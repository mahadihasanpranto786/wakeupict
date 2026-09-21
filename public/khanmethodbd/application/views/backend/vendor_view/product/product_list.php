<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Product List
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Product</a></li>
      <li class="active">Product List</li>
    </ol>
  </section>
  <!-- /.box -->

  <section class="content">

    <div class="box">
      <div class="box-header">

      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Serial</th>
              <th>Name</th>
              <th>Category</th>
              <th>Image</th>
              <th>Purchased Price</th>
              <th>Selling Price</th>
              <th>Quantity</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($products_list) {
              $Serial = 1;
              foreach ($products_list->result() as $row) {
                $category=get_rltn_data('categories', 'c_id', $row->p_category);
                ?>
                <tr>
                  <td><?= $Serial++ ?></td>
                  <td><?= $row->p_tittle; ?> </td>
                  <td><?= $category->c_name; ?> </td>
                  <td>
                    <img src="<?php echo base_url(); ?>assets/products/<?= $row->p_imagepath ?>" alt="Girl in a jacket" width="128" height="128">

                  </td>
                  <td> <?= $row->p_pprice; ?></td>
                  <td><?= $row->p_sprice; ?></td>
                  <td><?= $row->p_quantity; ?></td>
                  <td>
                    <a href="<?php echo base_url(); ?>backend/Vendor/related_product_images_list/<?= $row->p_id ?>"><i class="fa fa-image" aria-hidden="true"></i>
                      Images</a>
                      <a href="<?php echo base_url(); ?>vendor/edit_product/<?= $row->p_id ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
                      Edit</a>
                    <a onclick="return confirm('Are you sure you want to delete this Item?');" href="<?php echo base_url(); ?>backend/Vendor/product_delete/<?= $row->p_id ?>"><i class="fa fa-trash" aria-hidden="true"></i>
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