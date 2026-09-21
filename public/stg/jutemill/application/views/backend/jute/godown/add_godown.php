 <div class="content-wrapper">
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-6">
 					<div class="card card-success mt-3">
 						<div class="card-header">
 							<h3 class="card-title"><i class="fas fa-th"></i> Godown Lists</h3>
 						</div>
 						<div class="card-body">
 							<table id="example1" class="table table-bordered table-striped">
 								<thead>
 									<tr>
 										<th>SL No.</th>
 										<th>Godown Name/No</th>
 										<th>Description</th>
 										<th>Actions</th>
 									</tr>
 								</thead>
 								<tbody><?php
										if ($list) {
											$serial = 0;
											foreach ($list->result() as $list) {
												$serial++;
										?>
 											<tr>
 												<td class="align-middle text-center"><?= $serial ?></td>
 												<td class="align-middle"><?= $list->g_title ?></td>
 												<td class="align-middle"><?= $list->g_description ?></td>
 												<td class="align-middle text-center">
 													<a id="<?= $list->g_id; ?>" title="<?= $list->g_title; ?>" description="<?= $list->g_description; ?>" class='editbutton btn bg-primary btn-xs' data-toggle="modal">
 														<i class='fas fa-user-edit'></i>
 													</a>
 													<!-- <a onclick="return confirm('Are you sure want to delete this?');" href="jute/godown/deleteGodown?g_id=<?= $list->g_id; ?>">
 														<button type='button' class='btn bg-danger btn-xs'>
 															<i class="fas fa-trash"></i>
 														</button>
 													</a> -->
 													<!-- <a href="<?php echo base_url('jute/godown/deleteGodown?') ?>g_id=<?= $list->g_id; ?>" type='button' id="deleteBySweetAlert" class='btn bg-danger btn-xs'>
 														<i class="fas fa-trash"></i>
 													</a> -->
 													<!-- <a onclick="return confirm('Are you sure want to inactive this?');" href="jute/godown/inactiveGodown?g_id=<?= $list->g_id; ?>">
 														<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
 														</button>
 													</a> -->
 												</td>
 											</tr>
 									<?php }
										} ?>
 								</tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 				<!-- / List Godown -->
 				<!-- Add Godown -->
 				<div class="col-md-6">
 					<div class="card card-primary mt-3">
 						<div class="card-header">
 							<h3 class="card-title"><i class="fas fa-plus-circle"></i> Add New Godown</h3>
 						</div>
 						<form role="form" action="<?php echo base_url('insert_godown'); ?>" method="post" autocomplete="off" onkeydown="return event.key != 'Enter';">
 							<div class="card-body">
 								<div class="row">
 									<div class="form-group col-sm-12">
 										<label for="exampleInputEmail1">Godown Name/No</label>
 										<span class="text-danger">*</span>
 										<input type="text" name="g_title" class="form-control removeWhiteSpace godown_name_warning" placeholder="Enter Godown Name/No" required>
 									</div>
 								</div>
 								<div class="row">
 									<div class="form-group col-sm-12">
 										<label>Description</label>
 										<textarea class="form-control" name="g_description" rows="3" placeholder="Enter Godown Description"></textarea>
 									</div>
 								</div>
 								<input type="hidden" name="">
 							</div>
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" class="btn btn-primary">Submit</button>
 								</div>
 							</div>
 						</form>
 					</div>
 				</div>
 	</section>
 </div>

 <!-- Update Godown Modal -->
 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header bg-info">
 				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Update Godown</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form role="form" action="<?php echo base_url('update_godown'); ?>" method="post" autocomplete="off" onkeydown="return event.key != 'Enter';">
 					<div class="card-body">
 						<div class="row">
 							<div class="form-group col-sm-12">
 								<label for="exampleInputEmail1">Godown Name/No</label>
 								<input type="text" id="title" name="g_title" class="form-control removeWhiteSpace godown_name_warning_for_edit" required>
 								<input type="hidden" id="titleForAlert" name="" class="form-control catch_knw" placeholder="">
 							</div>
 						</div>
 						<div class="row">
 							<div class="form-group col-sm-12">
 								<label>Description</label>
 								<textarea class="form-control" id="description" name="g_description" rows="5" placeholder="Enter Godown Description" required></textarea>
 							</div>
 						</div>
 						<input type="hidden" id="id" name="g_id">
 					</div>
 					<div class="modal-footer justify-content-between">
 						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
 						<button type="submit" class="btn btn-info">Save changes</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- Script File -->
 <script src="<?php echo base_url('') ?>assets/backend/plugins/jquery/jquery.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function() {
 		$(".editbutton").click(function(e) {
 			var iid = $(this).attr('id');
 			var title = $(this).attr('title');
 			var description = $(this).attr('description');
 			// alert(iid);
 			$('#myModal2').modal('show');
 			$('#id').val(iid);
 			$('#title').val(title);
 			$('#titleForAlert').val(title);
 			$('#description').val(description);
 		});


 		// Duplicate Godown Name Warning 
 		$(".godown_name_warning").blur(function() {
 			var godownNameWarning = $('.godown_name_warning').val();
 			var catch_knw = $('.catch_knw').val();
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url(''); ?>jute/Godown/ajaxGodownDuplicateNameAlert",
 				data: {
 					godownNameWarning: godownNameWarning
 				},
 				success: function(result) {
 					if (result == 'no') {
 						$('.godown_name_warning').val(godownNameWarning);
 					} else {
 						alert('Sorry! The number you entered already has. Please enter a unique number.');
 						$('.godown_name_warning').val('');
 					}
 				}
 			})
 		})
 		// Duplicate Godown Name Warning 
 		$(".godown_name_warning_for_edit").blur(function() {
 			var godownNameWarningForEdit = $('.godown_name_warning_for_edit').val();
 			var catch_knw = $('.catch_knw').val();
 			$.ajax({
 				type: 'POST',
 				url: "<?php echo base_url(''); ?>jute/Godown/ajaxGodownDuplicateNameAlert",
 				data: {
 					godownNameWarning: godownNameWarningForEdit
 				},
 				success: function(result) {
 					if (result == 'no') {
 						$('.godown_name_warning_for_edit').val(godownNameWarningForEdit);
 					} else if (catch_knw == godownNameWarningForEdit) {
 						$('.godown_name_warning_for_edit').val(godownNameWarningForEdit);
 					} else {
 						$('.godown_name_warning_for_edit').attr('placeholder', "This number already has. Please enter a unique number.");
 						$('.godown_name_warning_for_edit').val('');
 					}
 				}
 			})
 		})












 	});
 </script>