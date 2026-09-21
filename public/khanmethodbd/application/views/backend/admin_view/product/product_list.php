<!-- Content Wrapper. Contains page content -->

<style>
  .new__custom__pagination {
    display: inline;
    margin-top: 20px;
  }

  .pagination_ci_custom li {
    display: inline;
  }

  .pagination_ci_custom li a {
    border: 1px solid #00c0ef;
    padding: 15px 20px;
  }

  .pagination_ci_custom a.active {
    background-color: #00c0ef;
    color: #fff;
  }

  .small-box:hover {
    color: #000;
  }

  .btn_top {
    margin-top: 22px;
  }
</style>
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
        <form action="<?= base_url("product_list") ?>" method="get" class="form-inline pull-right">
          <div class="row">
            <div class="col-md-8 col-xs-8">
              <div class="form-group">
                <input type="text" name="product_name" class="form-control" placeholder="Enter product name">
              </div>
            </div>
            <div class=" col-md-4 col-xs-4">
              <button type="submit" class="btn btn-dark">Search</button>
            </div>
          </div>
        </form>

      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-striped">
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
              $serial;
              foreach ($products_list->result() as $row) {
                $category = get_rltn_data('categories', 'c_id', $row->p_category);
            ?>
                <tr>
                  <td><?= $serial++ ?></td>

                  <td><?= $row->p_tittle; ?>
                    <br>


                    <?php if ($row->p_spin == 1) {
                      echo "<span class='text-success'>Pinned</span>";
                    } else {
                      echo "<span class='text-danger'>Unpinned</span>";
                    } ?>


                  </td>
                  <td><?= $category->c_name; ?> </td>
                  <td>
                    <img src="<?php echo base_url(); ?>assets/products/<?= $row->p_imagepath ?>" alt="Girl in a jacket" width="110" height="110">
                  </td>
                  <td> <?= $row->p_pprice; ?></td>
                  <td><?= $row->p_sprice; ?></td>
                  <td><?= $row->p_quantity; ?></td>
                  <td>
                    <a href="<?php echo base_url(); ?>backend/Admin/related_product_images_list/<?= $row->p_id ?>" class="btn mt-1 btn-sm btn-info"><i class="fa fa-image" aria-hidden="true"></i>
                      Images</a>
                    <a href="<?php echo base_url(); ?>edit_product/<?= $row->p_id ?>" class="btn mt-1 btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i>
                      Edit</a>
                    <a onclick="return confirm('Are you sure you want to delete this Item?');" href="<?php echo base_url(); ?>backend/Admin/product_delete/<?= $row->p_id ?>" class="btn mt-1 btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                      Delete</a>
                    <?php

                    if ($row->p_spin == 1) { ?>
                      <br><a href="<?php echo base_url('update_pinned_status?id=') ?><?= $row->p_id ?>" type="button" class="btn mb-1 btn-sm btn-success" id="<?= $row->p_id ?>" id_name="<?= $row->p_spin ?>">Pinned</a>
                    <?php
                    } elseif ($row->p_spin == 0) { ?>
                      <br><a href="<?php echo base_url('update_pinned_status?id=') ?><?= $row->p_id ?>" type="button" class="btn mt-1 btn-sm btn-warning" id="<?= $row->p_id ?>" id_name="<?= $row->p_spin ?>">Unpinned</a>

                    <?php
                    } ?>
                    <a href="<?php echo base_url('backend/Admin/stock_view?p_id=') ?><?= $row->p_id ?>" type="button" class="btn mt-1 btn-sm btn-warning">Stock</a>

                    <a target="_blank" href="<?php echo base_url(); ?>product/ads/<?= $row->p_id ?>" class="btn btn-add-to-cart btn-primary ">
                      Ads
                    </a>
                  </td>
                </tr>

              <?php }
            } else { ?>
              <tr>
                <td colspan="7" class="text-center text-danger">
                  No data available in table
                </td>
              </tr>

            <?php  }
            ?>

          </tbody>

        </table>
        <input type="hidden" id="valRes" value="<?php if (isset($products_list->result_id->num_rows)) {
                                                  echo $products_list->result_id->num_rows;
                                                } else {
                                                  echo 0;
                                                } ?>">
        <div class="basic-pagination pull-right wow fadeInUp new__custom__pagination" data-wow-delay=".2s">
          <?= $this->pagination->create_links() ?><br>
          <span>Showing <span id="showingRow"></span> Result From <?= $total_rows ?> Result</span>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section>
</div>


<script src="<?php echo base_url('assets/storefront/themes/storefront/public/js/jquiry3.1.1.js') ?>"></script>
<script>
  $(document).ready(function() {
    var valRes = $("#valRes").val()
    $("#showingRow").text(valRes)
  })
</script>
<!-- /.content-wrapper -->