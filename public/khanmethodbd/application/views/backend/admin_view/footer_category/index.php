<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
             Footer Category
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Footer Category</a></li>
            <li class="active">Footer Category List</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">

        <div class="box">
            <div class="box-header">
                <div class="row">
                	<div class="col-md-3 col-md-offset-9">
                        <a href="<?php echo base_url('backend/FooterCategorty/create_footer_category') ?>" class="btn btn-success pull-right text-white"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped datatable-button-html5-basic datatable-button-print-basic">
							<thead>
								<tr>
									<th>Serial</th>
									<th>Title</th>
									<th>Category</th>
									<th>Status</th>
									
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>


								<?php
	                if($footer_category){
	                	$Serial=1;
	                	foreach ($footer_category->result() as $row) {
	                		$category=get_rltn_data('categories', 'c_id', $row->footer_category);
	               ?>

								<tr>
									<td><?=$Serial++?></td>
									
									<td><?=$row->footer_title ?></td>
									<td><?=$category->c_name?></td>
									<td><span class="label label-success"><?=$row->footer_status==0 ? 'Inactive' : 'Active' ?></span></td>
																	
									<td class="text-center">
										<a class="btn btn-danger" href="<?php echo base_url(); ?>backend/FooterCategorty/footer_category_edit/<?=$row->footer_id ?>"><i class="fa fa-edit"></i> Edit</a>
										<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url(); ?>backend/FooterCategorty/footer_category_delete/<?=$row->footer_id ?>"><i class="fa fa-trash"></i> Delete</a>
									</td>
								</tr>



								 <?php } 
	                }
	                else{

	                }
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

<style>
    .a_x {

        margin-top: 24px;

    }
</style>