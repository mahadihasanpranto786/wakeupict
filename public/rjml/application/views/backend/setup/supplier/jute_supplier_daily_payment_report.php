 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<div class="container-fluid">
 			<div class="row">
 			</div>
 		</div>
 	</section>
 	<!-- Main content -->
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<!-- left column -->
 				<div class="col-md-12">
 					<!-- general form elements -->
 					<div class="card card-default mt-3">
 						<div class="card-header">
 							<h3 class="text-center mb-0 text-uppercase">Rajbari Jute Mills LTD. </h3>
 							<h4 class="text-center text-uppercase"><u>Daily Payment Info </u></h4>

 						</div>
 						<!-- /.card-header -->
 						<div class="card-body">
 							<div class="row">
 								<div class="col-12">
 									<!-- Table -->
 									<table id="" class="table table-hover table-bordered">
 										<thead>
 											<tr>
 												<th>Date</th>
 												<th>Grand Total</th>
 												<th>Action</th>
 											</tr>
 										</thead>
 										<tbody>
 											<?php
												foreach ($sPayments->result() as $paymentSup) {
												?>
 												<tr>
 													<td><?= date("d-m-Y", strtotime($paymentSup->sp_date)) ?></td>
 													<td><?= number_format($paymentSup->sp_amount) ?></td>
 													<td>
 														<a target=”_blank” href="<?php echo base_url(); ?>setup/Supplier/juteSupplierPaymentByDate?date=<?= $paymentSup->sp_date ?>"><button class="btn btn-info btn-sm" type="button" data-placement="top" title="View"><i class="fas fa-eye"></i> View Details</button></a>
 													</td>

 												</tr>
 											<?php
												}
												?>
 										</tbody>
 									</table>
 								</div>
 							</div>
 						</div>
 						<!-- /.card-body -->
 					</div>
 					<!-- /.card -->
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- /section -->
 </div>
 <!-- /.content-wrapper -->