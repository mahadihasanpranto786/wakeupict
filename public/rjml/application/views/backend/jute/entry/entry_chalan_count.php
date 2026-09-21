<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>List All Entries</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php
																$current_user_type = $this->session->userdata('current_type');
																if ($current_user_type == 1) {
																	echo base_url('administration');
																} elseif ($current_user_type == 10) {
																	echo base_url('operator');
																} elseif ($current_user_type == 101) {
																	echo base_url('security_head');
																} elseif ($current_user_type == 102) {
																	echo base_url('security_operator');
																} elseif ($current_user_type == 201) {
																	echo base_url('weight_head');
																} elseif ($current_user_type == 202) {
																	echo base_url('weight_operator');
																} elseif ($current_user_type == 301) {
																	echo base_url('jute_head');
																} elseif ($current_user_type == 302) {
																	echo base_url('jute_operator');
																} elseif ($current_user_type == 401) {
																	echo base_url('accounts_head');
																} elseif ($current_user_type == 402) {
																	echo base_url('accounts_operator');
																} elseif ($current_user_type == 501) {
																	echo base_url('production_head');
																} elseif ($current_user_type == 502) {
																	echo base_url('production_operator');
																} elseif ($current_user_type == 601) {
																	echo base_url('gm');
																} elseif ($current_user_type == 602) {
																	echo base_url('shareholder');
																} elseif ($current_user_type == 603) {
																	echo base_url('system_administrator');
																} else {
																	$this->session->set_flashdata('login_failed', 'Credential Not match');
																	redirect('login', 'location');
																}
																?>">
								Home</a>
						</li>
						<?php
						$current_user_type = $this->session->userdata('current_type');
						if ($current_user_type == 102) {
						?>
							<li class="breadcrumb-item active"><a href="<?php echo base_url('add_entry'); ?>">Add New Entry</a></li>
						<?php } ?>

						<li class="breadcrumb-item active">List All Entries</li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-info">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-th"></i> All Entries</h3>
							<?php
							$res = $this->session->userdata('current_type');
							if ($res == 102) {
							?>
								<a href="<?php echo base_url('add_entry'); ?>"><button class="btn btn-info pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i> Add New Entry</button></a>

							<?php } ?>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Supplier</th>
										<th>Chalan No</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($entrys) {
										$serial = 0;
										foreach ($entrys->result() as $entry) {
											$serial++;
									?>
											<tr>
												<td class="align-middle"><?= $this->M_supplier->getSupplierById($entry->en_s_id)->s_title ?> (<?= $entry->en_s_id ?>)</td>
												<td class="align-middle"><?= $entry->COUNT_id  ?></td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->







<!-- ======================== Jute Return Insert Modal ======================== -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title" id="exampleModalLabel"><i class='fas fa-plus-circle'></i> Jute Return</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- form start -->
				<form role="form" action="<?php echo base_url('insert_jute_return_info'); ?>" method="post" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Return Date</label>
								<span class="text-danger">*</span>
								<input type="text" name="jri_date" class="form-control datepicker" id="exampleInputEmail1" placeholder="Enter Return Date" value="<?= get_current_time_time(); ?>" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="exampleInputEmail1">Return By</label>
								<span class="text-danger">*</span>
								<input type="text" name="jri_return_by" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label>Return Reason</label>
								<span class="text-danger">*</span>
								<textarea class="form-control" id="" name="jri_reason" rows="5" placeholder="Enter Reason" required></textarea>
							</div>
						</div>
						<input type="hidden" name="jri_en_id" value="" id="jri_id">
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>




<script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".editButton").click(function(e) {
			var iid = $(this).attr('id');
			// alert(iid);
			$('#myModal').modal('show');
			$('#jri_id').val(iid);
		});
	});
</script>