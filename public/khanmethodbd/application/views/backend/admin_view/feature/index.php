<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
             Feature
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Feature</a></li>
            <li class="active">Feature List</li>
        </ol>
    </section>
    <!-- /.box -->

    <section class="content">

        <div class="box">
            <div class="box-header">
                <div class="row">
                	<div class="col-md-3 col-md-offset-9">
                        
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped datatable-button-html5-basic datatable-button-print-basic">
							<thead>
								<tr>
									<th>Serial</th>
									<th>Icon</th>
									<th>Title1</th>
									<th>Title2</th>
									<th>Status</th>
									
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>


								<?php
	                if($feature_list){
	                	$Serial=1;
	                	foreach ($feature_list->result() as $row) {
	               ?>

								<tr>
									<td><?=$Serial++?></td>
									<td><i class="fa fa-<?=$row->feature_icone?>"></i></td>
									<td><?=$row->feature_title1 ?></td>
									<td><?=$row->feature_title2 ?></td>
									<td><span class="label label-success"><?=$row->feature_status==0 ? 'Inactive' : 'Active' ?></span></td>
																	
									<td class="text-center">
										<a class="btn btn-danger" href="<?php echo base_url(); ?>backend/Feature/feature_edit/<?=$row->feature_id ?>"><i class="fa fa-edit"></i> Edit</a>
										<!-- <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url(); ?>backend/Advertisement/advertisement_delete/<?=$row->ad_id ?>"><i class="fa fa-trash"></i> Delete</a> -->
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