<?php if ($callFor == "tagAdd") { ?>
	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-sm-7">
					<div class="box box-primary box-outline">
						<div class="box-header">
							<h3 class="box-title">Tag List</h3>
						</div>
						<div class="box-body">
							<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
								<div class="row">
									<div class="col-sm-12 col-md-6"></div>
									<div class="col-sm-12 col-md-6"></div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
											<thead>
												<tr role="row">
													<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tag Title</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($tagList) {
													$serial = 0;
													foreach ($tagList->result() as $row) {
														$serial++;
												?>
														<tr role="row" class="odd">
															<td class="sorting_1" tabindex="0"><?= $serial; ?></td>
															<td><?= $row->t_title; ?></td>
															<td>
																<a href="<?= base_url() ?>backend/Blog/tagEditView?id=<?= $row->t_id; ?>" class="btn btn-sm btn-info p-2 mb-2 editTagBtn"><i class="fa fa-edit"></i> Edit</a>
																<a href="<?= base_url() ?>backend/Blog/trashTag?id=<?= $row->t_id; ?>" class="btn btn-sm btn-danger deleteAlert p-2 mb-2"><i class="fa fa-trash"></i> Trash</a>
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
				<div class="col-sm-5">
					<div class="box box-primary box-outline">
						<div class="box-header">
							<h3 class="box-title">Add Tag</h3>
						</div>
						<!-- /.box-header -->
						<?= alert_check(); ?>
						<!-- form start -->
						<form method="POST" autocomplete="off" action="<?= base_url() ?>backend/Blog/addTag">
							<div class="box-body">
								<div class="form-group">
									<label for="title"> Tag Title</label>
									<input name="title" required type="text" class="form-control" placeholder="Enter Tag Title">
								</div>

								<input type="hidden" name="id" id="Id">
								<div class="float-right">
									<button type="submit" class="btn btn-sm btn-success btn-flat">Submit</button>
								</div>
							</div>
							<!-- /.box-body -->
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php } elseif ($callFor == "tagEdit") { ?>
	<div class="content-wrapper py-4 px-3">
		<section class="content">
			<div class="row">
				<div class="col-sm-8">
					<div class="box box-primary box-outline">
						<div class="box-header">
							<h3 class="box-title">tag List</h3>
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
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">tag Title</th>
													<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr role="row" class="odd">
													<td class="sorting_1" tabindex="0">1</td>
													<td><?= $tagList->t_title; ?></td>
													<td>
														<a href="<?= base_url() ?>backend/Blog/trashTag?id=<?= $tagList->t_id; ?>" class="btn btn-sm deleteAlert btn-danger p-2 mb-2"><i class="fa fa-trash"></i> Trash</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="box box-primary box-outline">
						<div class="box-header">
							<h3 class="box-title">Edit Tag</h3>
						</div>
						<!-- /.box-header -->
						<?= alert_check(); ?>
						<!-- form start -->
						<form method="POST" autocomplete="off" action="<?= base_url() ?>backend/Blog/updatedTag">
							<div class="box-body">
								<div class="form-group">
									<label for="title"> Tag Title</label>
									<input name="title" required value="<?= $tagList->t_title; ?>" type="text" class="form-control" placeholder="Enter Tag Title">
								</div>
								<input type="hidden" value="<?= $tagList->t_id; ?>" name="id" id="Id">
								<div class="float-right">
									<button type="submit" class="btn btn-sm btn-success btn-flat">Update</button>
								</div>
							</div>
							<!-- /.box-body -->
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php } ?>