<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Popular and Best Product
		<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Popular and Best Product</a></li>
			<li class="active">Edit Popular and Best Product </li>
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
				<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Admin/populer_and_best_product_update') ?>">
					<div class="col-md-6">
						
						<input type="hidden" name="id" value="<?=$populer_product_list->pb_id?>">
						
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product </label>
                            <select class="form-control"  data-validation="required" id="product" name="product" >
                                <?php foreach ($products_list->result() as $row) { ?>
                                    <option value='<?=$row->p_id?>'><?=$row->p_tittle?></option>
                                <?php } ?>
                            </select>
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
        document.getElementById('product').value=<?=$populer_product_list->pb_product?>

 </script>
 <script >
        document.getElementById('status').value=<?=$populer_product_list->pb_status?>

 </script>