<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Stocks
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
            <li class="active">Category</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">
        <div class="col-md-12">
            <div class="box"><a class="btn btn-xs btn-primary add_stock" type="button" data-toggle="modal" data-target="#stockModal"><i class="fa fa-edit"></i> Add Stock</a>
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($stock_list) {
                                foreach ($stock_list->result() as  $stock) {


                                    $Serial = 1; ?>
                                    <tr>
                                        <td><?= $Serial++ ?></td>
                                        <td><?= date("d-m-Y", strtotime($stock->s_date)) ?></td>
                                        <td><?= $stock->s_quantity ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this Item?');" href="<?php echo base_url(); ?>backend/Admin/stock_delete?s_id=<?= $stock->s_id ?>"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="stock_main" method="POST" action="<?php echo base_url('backend/Admin/stock_store') ?>">
                            <div class="box-body">
                                <input type="hidden" id="identifier" name="identifier">
                                <div class="form-group">
                                    <label for="s_date">Date</label>
                                    <input type="date" id="s_date" name="s_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="s_quantity">Quantity</label>
                                    <input type="text" id="s_quantity" name="s_quantity" class="form-control" placeholder="Enter stock quantity" required>
                                    <input type="hidden" name="s_p_id" value="<?= $this->input->get("p_id") ?>">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button id="submit_button" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>

                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.box -->
    </section>
</div>
<script>
    $(document).ready(function() {
        $(".add_stock").click(function() {
            $('#stockModal').modal('show');
        })
    })
</script>