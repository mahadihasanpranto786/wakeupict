<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Feature
		<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Feature</a></li>
			<li class="active">Edit Feature </li>
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
				<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Feature/feature_update') ?>">
					<div class="col-md-6">
						<input type="hidden" name="id" value="<?=$feature_list->feature_id?>">
						
						
						
                        <div class="form-group">
                            <label for="exampleInputEmail1">Icon</label>
                            <input type="text" class="form-control input-circle" id="exampleInputEmail1" placeholder="Title 1" name="icone" data-validation="required length" data-validation-length="max100" value="<?=$feature_list->feature_icone?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title 1</label>
                            <input type="text" class="form-control input-circle" id="exampleInputEmail1" placeholder="Title 1" name="title1" data-validation="required length" data-validation-length="max100" value="<?=$feature_list->feature_title1?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title 2</label>
                            <input type="text" class="form-control input-circle" id="exampleInputEmail1" placeholder="Title 2" name="title2" data-validation="required length" data-validation-length="max100" value="<?=$feature_list->feature_title2?>">
                        </div>
                       

                        <div class="form-group">
						    <label for="exampleInputEmail1">Status</label>
						    <select class="form-control"  data-validation="required" id="status" name="status" >
						        <option value='1'>Active</option>
						        <option value='0'>Inactive</option>
						    </select>
						</div>

						
						
						
						<button type="submit" class="btn btn-default">Submit</button>
					</div>
					<div class="col-md-6">
						
						
						
						
						
						
					</div>
					
				</div>
				
				
				
			</form>
			
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

<script >
        document.getElementById('status').value=<?=$feature_list->feature_status?>

 </script>
 