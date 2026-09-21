 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Main content -->
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-12">
 					<div class="card card-default mt-3">
 						<!-- <div class="card-header">
							<h3 class="card-title"> </h3>
						</div> -->
 						<!-- /.card-header -->
 						<!-- form start -->
 						<form role="form" action="" method="post">
 							<div class="card-body">
 								<div class="row">
 									<div class="col-sm-7">
 										<h3 class="text-success">Jute Purchase, Issue & Stock Report: <?= date("F") ?> </h3>
 									</div>
 									<div class="form-group col-sm-2">
 										<label>Year</label>
 										<select class="form-control select2" style="width: 100%;">
 											<option selected="selected">Select Year</option>
 											<option value="">2019-2020</option>
 											<option value="">2020-2021</option>
 										</select>
 									</div>
 									<div class="form-group col-sm-2">
 										<label>Month</label>
 										<select class="form-control select2" style="width: 100%;">
 											<option selected="selected">Select Month</option>
 											<option value="">January</option>
 											<option value="">February</option>
 											<option value="">March</option>
 											<option value="">April</option>
 											<option value="">May</option>
 											<option value="">June</option>
 											<option value="">July</option>
 											<option value="">August</option>
 											<option value="">September</option>
 											<option value="">October</option>
 											<option value="">November</option>
 											<option value="">December</option>
 										</select>
 									</div>
 									<div class="col-sm-1">
 										<a href=""><button class="btn btn-info float-right mt-4"> Submit</button></a>
 									</div>
 								</div>
 								<div class="row">
 									<!-- Table -->
 									<table id="" class="table table-bordered table-striped">
 										<thead>
 											<tr>
 												<th>Particulars</th>
 												<th></th>
 												<?php if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<input type="hidden" name="gradeId[]" class="form-control" id="" value='<?= $grade->j_g_id ?>'>
 														<th class="text-center"><?= $grade->j_g_title ?></th>
 												<?php
														}
													}
													?>
 												<th>KF-D1</th>
 												<th>WH-D1</th>
 												<th>TOTAL</th>
 												<th>Actions</th>
 											</tr>
 										</thead>
 										<tbody>
 											<!-- Opening Pacca Jute -->
 											<tr>
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Opening Pacca Jute</td>
 												<td>Opening Quantity Monds</td>
 												<?php
													//getting stock Mds
													if ($grades) {
														$kf = 0;
														$wh = 0;
														$this->session->set_userdata('kf', $kf);
														$this->session->set_userdata('wh', $wh);
														foreach ($grades->result() as $grade) {
													?>
 														<td><?= stockValue($grade->j_g_id, 'jpiv_weight_mds') ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $this->session->userdata('kf'); ?></td>
 												<td><?= $this->session->userdata('wh'); ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Opening Average Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td></td>
 												<?php
														}
													}
													?>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Opening Amount</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td></td>
 												<?php
														}
													}
													?>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Actual Purchased Avg. Rate -->
 											<tr class="text-danger">
 												<td></td>
 												<td> Actual Purchased Avg. Rate</td>
 												<?php
													if ($grades) {
														foreach ($grades->result() as $grade) {
													?>
 														<td></td>
 												<?php
														}
													}
													?>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Purchased After 2% -->
 											<tr>
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Purchased After 2%</td>
 												<td>Total Purchased Monds</td>
 												<?php
													$w = 0;
													foreach ($amiloop as $key => $value) { ?>

 													<td><?php echo "ki?" . $value; ?></td>

 												<?php } ?>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Average Purchased Rate</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Amount</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Cutting Production -->
 											<tr>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td>Cutting Production</td>
 											</tr>
 											<!-- After Cutting 17% -->
 											<tr>
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">After Cutting 17% </td>
 												<td>Total Quantity Monds</td>
 												<?php
													//getting stock Mds
													if ($grades) {
														$kf = 0;
														$wh = 0;
														$this->session->set_userdata('kf', $kf);
														$this->session->set_userdata('wh', $wh);
														foreach ($grades->result() as $grade) {
													?>
 														<td><?= currentMonthPurchase($grade->j_g_id, 'jpiv_weight_mds') ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $this->session->userdata('kf'); ?></td>
 												<td><?= $this->session->userdata('wh'); ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Average Pucca Rate</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Amount</td>
 												<?php
													//getting stock Mds
													if ($grades) {
														$kf = 0;
														$wh = 0;
														$this->session->set_userdata('kf', $kf);
														$this->session->set_userdata('wh', $wh);
														foreach ($grades->result() as $grade) {
													?>
 														<td><?= currentMonthPurchase($grade->j_g_id, 'jpiv_amount') ?></td>
 												<?php
														}
													}
													?>
 												<td><?= $this->session->userdata('kf'); ?></td>
 												<td><?= $this->session->userdata('wh'); ?></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Opening + Purchased -->
 											<tr>
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Opening + Purchased </td>
 												<td>Opening Quantity Monds</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Opening Average Rate</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Opening Amount</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- Issue-->
 											<tr>
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">Issue </td>
 												<td>Total Quantity Monds</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Average Issue Rate</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Amount</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<!-- CL. Balance -->
 											<tr>
 												<td rowspan="3" class="align-middle" style="writing-mode: vertical-lr; -ms-writing-mode: tb-rl; transform: rotate(270deg);">CL. Balance </td>
 												<td>Closing Quantity Monds</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Closing Average Rate</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 											<tr>
 												<td>Closing Amount</td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 												<td></td>
 											</tr>
 										</tbody>
 									</table>
 								</div>
 								<input type="hidden" name="">
 							</div>
 							<!-- /.card-body -->
 							<div class="card-footer">
 								<div class="pull-right">
 									<!-- <button type="submit" class="btn btn-info">Submit</button> -->
 								</div>
 							</div>
 						</form>
 						<!-- /End Form -->
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
