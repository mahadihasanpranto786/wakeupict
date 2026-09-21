 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Main content -->
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<!-- left column -->
 				<div class="col-md-12">
 					<!-- general form elements -->
 					<div class="card card-info mt-3">
 						<div class="card-header">
 							<h3 class="card-title">Add Assorted</h3>
 						</div>
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="<?php echo base_url('list_assorted'); ?>" method="post">
 							<div class="card-body">
 								<div class="row">
 									<table class="table table-striped">
 										<tr>
 											<th>Khamal</th>
 											<th>Bojha</th>
 											<th>D1</th>
 											<th>D2</th>
 											<th>D3</th>
 											<th>Mill-C</th>
 											<th>SMR</th>
 											<th>Total</th>
 										</tr>
 										<tbody id="addAssortedItem">
 											<tr>
 												<td>
 													<div class="form-group col-sm-12 ml-0">
 														<select class="form-control select2" style="width:170px;" required>
 															<option value="">Select Khamal</option>
 															<?php if ($khamals) {
																	foreach ($khamals->result() as $khamal) { ?>
 																	<option value="<?= $khamal->kh_id; ?>"><?= $khamal->kh_title; ?></option>
 															<?php }
																} ?>
 														</select>
 													</div>
 												</td>
 												<td><input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value=''></td>
 												<td><input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value=''></td>
 												<td><input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value=''></td>
 												<td><input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value=''></td>
 												<td><input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value=''></td>
 												<td><input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value=''></td>
 												<td><input type="text" name="" class="form-control" id="exampleInputEmail1" placeholder="" value=''></td>
 											</tr>
 										</tbody>
 									</table>
 									<input id="" class="btn btn-info" name="add-new-item" onclick="addInputField('addAssortedItem');" value="Add New" type="button" style="margin: 0px 15px 15px;">
 								</div>
 								<input type="hidden" name="">
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<button type="submit" class="btn btn-info">Submit</button>
 								</div>
 							</div>
 						</form>
 						<!-- /End Form -->
 					</div>
 					<!-- /.card -->
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- /section -->
 </div>
 <!-- /.content-wrapper -->


 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script type="text/javascript">
 	// ========== Assorted row =============
 	function addInputField(t) {
 		var count = 2;
 		var limits = 5;
 		if (count == limits) {
 			alert("You have reached the limit of adding" + count + "inputs");
 		} else {
 			//    alert(count);return false;
 			var a = "assorted" + count,
 				e = document.createElement("tr");
 			e.innerHTML = "<td><div class='form-group col-sm-12'>\n\
			 <select class='form-control select2' id='' style='width:170px;'>\n\
			 	<option value = ''>Select Khamal</option>\n\
				 <?php if ($khamals) {foreach ($khamals->result() as $khamal) { ?>\n\
 				<option value='<?= $khamal->kh_id; ?>'><?= $khamal->kh_title; ?></option>\n\
				 \n\<?php } } ?> </select > </div></td> \n\
<td><input type='text' class='form-control' name='' id='" + count + "'></td> \n\
<td><input type='text' class='form-control' name='' id='" + count + "'></td> \n\
<td><input type='text' class='form-control' name='' id='" + count + "'></td> \n\
<td><input type='text' class='form-control' name='' id='" + count + "'></td> \n\
<td><input type='text' class='form-control' name='' id='" + count + "'></td> \n\
<td><input type='text' class='form-control' name='' id='" + count + "'></td> \n\
<td><input type='text' class='form-control' name='' id='" + count + "'></td> \n\
<td><button style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>\n\
",
 				document.getElementById(t).appendChild(e), document.getElementById(a).focus(), count++;
 		}
 	}
 	// ============= row delete dynamically =========
 	function deleteRow(t) {
 		var a = $().length;
 		if (1 == a) {
 			alert("There only one row you can't delete it.");
 		} else {
 			var e = t.parentNode.parentNode;
 			e.parentNode.removeChild(e);
 		}
 	}
 </script>