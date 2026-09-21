<?php
if ($callFor == "blogAdd") { ?>

	<style>
		.btn {
			margin: 3px !important;
		}
	</style>
	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-sm-12">
					<div class="box box-primary box-outline">
						<div class="box-header">
							<h3 class="box-title">Blog List</h3>
							<a href="<?= base_url() ?>backend/Blog/addBlogPage" class="btn pull-right btn-sm btn-success p-2 mb-2"><i class="fa fa-plus"></i> Add New Blog</a>
						</div>
						<div class="box-body">
							<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
								<div class="row">
									<div class="col-sm-12">
										<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
											<thead>
												<tr role="row">
													<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Blog Title</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Category</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Tag</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Image</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($blogList) {
													$serial = 0;
													foreach ($blogList->result() as $row) {
														$serial++;
												?>
														<tr role="row" class="odd">
															<td class="sorting_1" tabindex="0"><?= $serial; ?></td>
															<td><?= $row->b_title; ?></td>
															<td>
																<ol class="list-group">
																	<?php
																	$blogCatList =	$this->M_blog->get_data_multi_conditional('b_blog_category', ['b_b_cat_status' => 1, "blog_id" => $row->b_id]);
																	if ($blogCatList) {
																		foreach ($blogCatList->result() as  $value) {
																			$blogList1 =	$this->M_blog->get_data_multi_conditional('b_category', ['cat_status' => 1, "cat_id" => $value->cat_id]);
																			foreach ($blogList1->result() as  $value) {
																				echo "<li class='mt-1 list-group-item p-1 border border-info text-sm d-flex justify-content-between align-items-center'>";
																				echo  $value->cat_title;
																				echo "<br>";
																				echo "</li>";
																			}
																		}
																	}
																	?>
																</ol>
															</td>
															<td>
																<ol class="list-group">
																	<?php
																	$tagList =	$this->M_blog->get_data_multi_conditional('b_blog_tag', ['b_b_tag_status' => 1, "blog_id" => $row->b_id]);
																	if ($tagList) {
																		foreach ($tagList->result() as  $value) {
																			$blogList1 =	$this->M_blog->get_data_multi_conditional('b_tag', ['t_status' => 1, "t_id" => $value->tag_id]);
																			foreach ($blogList1->result() as  $value) {
																				echo "<li class='mt-1 list-group-item p-1 border border-info text-sm d-flex justify-content-between align-items-center'>";
																				echo  $value->t_title;
																				echo "<br>";
																				echo "</li>";
																			}
																		}
																	}
																	?>
																</ol>
															</td>

															<td><img src="<?= base_url('assets/uploads/blog/') . $row->b_thum_image; ?>" height="80" width="100" alt="Image"></td>
															<td><a href="<?= base_url() ?>backend/Blog/blogEditView?blog_id=<?= $row->b_id  ?>" class="btn btn-sm btn-info p-2 mb-2 editTagBtn"><i class="fa fa-edit"></i> Edit</a>
																<a href="<?= base_url() ?>backend/Blog/deleteBlog?id=<?= $row->b_id  ?>" class="btn deleteAlert btn-sm btn-danger p-2 mb-2"><i class="fa fa-trash"></i> Trash</a>
																<a href="<?= base_url() ?>backend/Blog/blogDetailsView?id=<?= $row->b_id  ?>" class="btn btn-sm btn-primary p-2 mb-2"><i class="fa fa-info"></i> Details</a>
															</td>
														</tr>
												<?php    }
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

<?php } elseif ($callFor == "addBlogPage") { ?>
	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-sm-12">
					<div class="box box-primary box-outline">
						<div class="box-header">
							<h3 class="box-title">Add Blog</h3>
						</div>
						<!-- /.box-header -->
						<?= alert_check(); ?>
						<!-- form start -->
						<form method="POST" autocomplete="off" action="<?= base_url() ?>backend/Blog/addBlog" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="title"> Blog Title</label>
									<input name="title" type="text" class="form-control" placeholder="Enter Title">
								</div>
								<div class="form-group">
									<label for="text"> Blog Short Description</label>
									<textarea name="text" cols="5" class="form-control" rows="5" placeholder="Enter text"></textarea>

								</div>
								<div class="form-group">
									<label for="description"> Blog Long Description</label>
									<textarea cols="10" id="editor1" name="description" rows="10"></textarea>
								</div>
								<div class="form-group">
									<label for="image">Blog Image</label>
									<input name="image" type="file" class="form-control">
								</div>
								<div class="form-group">
									<label class="form-check-label" for="cat_title">Category</label>
									<select name="cat_title[]" required class="form-control select2" multiple>
										<option value="" disabled>Select Category</option>
										<?php if ($blogCatList) {
											foreach ($blogCatList->result() as $row) {
										?>
												<option value="<?= $row->cat_id ?>"><?= $row->cat_title ?></option>
										<?php  }
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label class="form-check-label" for="tag_id">Tag</label>
									<select name="tag_id[]" class="form-control select2" multiple>
										<option value="" disabled>Select tag</option>
										<?php if ($tagList)

											foreach ($tagList->result() as $row) {

										?>
											<option value="<?= $row->t_id; ?>"><?= $row->t_title ?></option>
										<?php  }  ?>
									</select>
								</div>
								<input type="hidden" name="id" id="Id">
								<div class="float-right">
									<button type="submit" class="btn btn-success btn-flat pull-right">Submit</button>
								</div>
							</div>
							<!-- /.box-body -->
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets/admin_layout/js/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('') ?>assets/plugins/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('editor1', {
			height: 300,
			filebrowserUploadUrl: "<?php echo base_url('') ?>backend/Blog/imageUpload",
			filebrowserUploadMethod: "form"
		});
	</script>

	<script src="<?php echo base_url('') ?>assets/backend/tagsinput.js"></script>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-36251023-1']);
		_gaq.push(['_setDomainName', 'jqueryscript.net']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
	</script>

<?php } elseif ($callFor == "blogEdit") { ?>

	<link href="<?php echo base_url('') ?>assets/backend/css/tagsinput.css" rel="stylesheet" type="text/css">
	<style>
		.btn {
			margin: 3px !important;
		}
	</style>
	<div class="content-wrapper py-4 px-3">
		<section class="content">
			<div class="row">

				<div class="col-sm-12">
					<div class="box box-primary box-outline">
						<div class="box-header">
							<h3 class="box-title">Edit Blog</h3>
						</div>
						<!-- /.box-header -->
						<?= alert_check(); ?>
						<!-- form start -->
						<form method="POST" autocomplete="off" action="<?= base_url() ?>backend/Blog/updateBlog" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="title"> Blog Title</label>
									<input name="title" value="<?= $blogSingleList->b_title ?>" type="text" class="form-control" placeholder="Enter Title">
								</div>
								<div class="form-group">
									<label for="text"> Blog Short Description</label>
									<textarea name="text" cols="5" class="form-control" rows="5" placeholder="Enter text"><?= $blogSingleList->b_text ?></textarea>

								</div>
								<div class="form-group">
									<label for="description"> Blog Long Description</label>
									<textarea cols="10" id="editor1" name="description" rows="10"><?= $blogSingleList->b_short_description ?></textarea>
								</div>
								<div class="form-group">
									<label for="image">Blog Image</label>
									<img class="border border-info mb-1" src="<?= base_url() ?>assets/uploads/blog/<?= $blogSingleList->b_thum_image ?>" height="50" width="50">
									<input name="hidden_image" value="<?= $blogSingleList->b_thum_image ?>" type="hidden" class="form-control">
									<input name="image" type="file" class="form-control">
								</div>

								<div class="form-group">
									<label class="form-check-label" for="cat_title">Category</label>
									<select name="cat_title[]" required class="form-control select2" multiple>
										<option value="" disabled>Select category</option>
										<?php if ($categoryList) {
											foreach ($categoryList->result() as $row) {
										?>
												<option <?php
														if ($blogCatList) {
															foreach ($blogCatList->result() as $value) {

																if ($value->cat_id == $row->cat_id) {
																	echo "selected";
																}
															}
														}
														?> value="<?= $row->cat_id ?>"><?= $row->cat_title ?></option>
										<?php  }
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label class="form-check-label" for="tag_id">Tag</label>
									<select name="tag_id[]" class="form-control select2" multiple>
										<option value="" disabled>Select tag</option>
										<?php if ($tagList) {
											foreach ($tagList->result() as $row) {
										?>
												<option <?php
														if ($tagCatList) {
															foreach ($tagCatList->result() as $value) {
																if ($value->tag_id == $row->t_id) {
																	echo "selected";
																}
															}
														}
														?> value="<?= $row->t_id ?>"><?= $row->t_title ?></option>
										<?php  }
										}
										?>
									</select>
								</div>

								<input type="hidden" name="id" value="<?= $blogSingleList->b_id ?>" id="Id">
								<div class="float-right">
									<button type="submit" class="btn btn-success btn-flat">Update</button>
								</div>
							</div>
							<!-- /.box-body -->
						</form>
					</div>
				</div>

			</div>
		</section>
	</div>

	<script type="text/javascript" src="<?php echo base_url('assets/admin_layout/js/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('') ?>assets/plugins/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('editor1', {
			height: 300,
			filebrowserUploadUrl: "<?php echo base_url('') ?>backend/Blog/imageUpload",
			filebrowserUploadMethod: "form"
		});
	</script>
<?php  } elseif ($callFor == "blogDetails") { ?>

	<link href="<?php echo base_url('') ?>assets/backend/css/tagsinput.css" rel="stylesheet" type="text/css">
	<style>
		.btn {
			margin: 3px !important;
		}
	</style>
	<div class="content-wrapper py-4 px-3">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary box-outline">
					<div class="box-header">
						<h3 class="box-title">Blog List</h3>
					</div>
					<div class="box-body">
						<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
							<div class="row">
								<div class="col-sm-12 col-md-6"></div>
								<div class="col-sm-12 col-md-6"></div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
										<thead>
											<tr role="row">
												<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Blog Title</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Short Description</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Blog Text</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Image</th>
												<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if ($blogList) {
												$serial = 0;
												foreach ($blogList->result() as $row) {
													$serial++;
											?>
													<tr role="row" class="odd">
														<td class="sorting_1" tabindex="0"><?= $serial; ?></td>
														<td><?= $row->b_title; ?></td>
														<td><?= $row->b_short_description; ?></td>
														<td><?= $row->b_text ?></td>

														<td><img class="" src="<?= base_url('assets/uploads/blog/') . $row->b_thum_image; ?>" height="110" width="110" alt="Image"></td>
														<td>
														<td><a href="<?= base_url() ?>backend/Blog/blogEditView?blog_id=<?= $row->b_id  ?>" class="btn btn-sm btn-info p-2 mb-2 editTagBtn"><i class="fa fa-edit"></i> Edit</a>

															<a href="<?= base_url() ?>backend/Blog/deleteBlog?id=<?= $row->b_id  ?>" class="btn deleteAlert btn-sm btn-danger p-2 mb-2"><i class="fa fa-trash"></i> Trash</a>
														</td>
													</tr>
											<?php    }
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php }

?>