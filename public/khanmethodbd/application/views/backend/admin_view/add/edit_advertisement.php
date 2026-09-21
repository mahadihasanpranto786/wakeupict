<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Advertisement
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Advertisement</a></li>
			<li class="active">Edit Advertisement </li>
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
				<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('backend/Advertisement/advertisement_update') ?>">
					<div class="col-md-6">
						<input type="hidden" name="id" value="<?= $advertisement_list->ad_id ?>">
						<div class="form-group">
							<label class=" control-label text-semibold">Advertisement Image:</label>
							<input type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-validation=" mime size" data-validation-allowing="jpg, png,gif" data-validation-max-size="2Mb" data-validation-error-msg-size="You can not upload images larger than 2Mb" data-validation-error-msg-mime="You can only upload images" name="add_image">


						</div>

						<div class="form-group">
							<label for="exampleInputEmail1">Status</label>
							<select class="form-control" data-validation="required" id="status" name="status">
								<option value='1'>Active</option>
								<option value='0'>Inactive</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Title 1</label>
							<input type="text" class="form-control input-circle" id="exampleInputEmail1" placeholder="Title 1" name="title1" data-validation=" length" data-validation-length="max100" value="<?= $advertisement_list->ad_title1 ?>">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Title 2</label>
							<input type="text" class="form-control input-circle" id="exampleInputEmail1" placeholder="Title 2" name="title2" data-validation=" length" data-validation-length="max100" value="<?= $advertisement_list->ad_title2 ?>">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Link</label>
							<input type="text" class="form-control input-circle" id="exampleInputEmail1" placeholder="Link" name="link" data-validation=" length" data-validation-length="max100" value="<?= $advertisement_list->ad_link ?>">
						</div>




						<button type="submit" class="btn btn-default">Submit</button>
					</div>
					<div class="col-md-6">

						<ul class="list-group">
							<li class='list-group-item active'>Banner size</li>
							<li class='list-group-item'>bellow feature banner 1 (width= 750; height=200;)</li>
							<li class='list-group-item'>Image formate (gif | jpg | png | jpeg)</li>
						</ul>




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

<script>
	document.getElementById('status').value = <?= $advertisement_list->ad_status ?>
</script>