<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Main Slider
		<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Slider</a></li>
			<li class="active">Add Slider </li>
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
				<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Slider/slider_store') ?>">
					<div class="col-md-6">
						
						<div class="form-group">
							<label class=" control-label text-semibold">Slider Image: <small>(main slider: width=850, height=400; brand: width=150, height=80;)</small></label>
							<input type="file"  data-show-caption="false" data-show-upload="false" data-validation="required mime size"  data-validation-allowing="jpg, png,gif" data-validation-max-size="2Mb"  data-validation-error-msg-size="You can not upload images larger than 2Mb" data-validation-error-msg-mime="You can only upload images" name="slider_image">
							
							
						</div>
						<div class="form-group">
						    <label for="exampleInputEmail1">Type</label>
						    <select class="form-control"  data-validation="required" id="type" name="type" >
						        <option value='1'>Main Slider</option>
						    </select>
						</div>
                        <div class="form-group">
                            <label for="">Title</label>


                            <textarea name="title" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

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