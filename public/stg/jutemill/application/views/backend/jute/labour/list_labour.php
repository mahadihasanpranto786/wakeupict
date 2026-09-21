<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary mt-3">
						<div class="card-header">
							<h3 class="card-title">Labour Lists</h3>
							<a href="<?php echo base_url('add_labour') ?>"><button class="btn btn-primary pt-0 pb-0 float-right border"><i class="fas fa-plus-circle"></i> Add New Labour</button></a>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Labour Name</th>
										<th>Father's Name</th>
										<th>Card No</th>
										<th>Mobile</th>
										<th>Quarter</th>
										<th>Designation</th>
										<th>Department</th>
										<th>Sub Department</th>
										<th>Address</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($list) {
										$serial = 0;
										foreach ($list->result() as $list) {
											$serial++;
									?>
											<tr>
												<td class="align-middle text-center"><?= $serial ?></td>
												<td class="align-middle"><?= $list->l_name ?></td>
												<td class="align-middle"><?= $list->l_father_name ?></td>
												<td class="align-middle"><?= $list->l_card_no ?></td>
												<td class="align-middle"><?= $list->l_mobile_no ?></td>
												<td class="align-middle"><?= $list->l_quarter ?></td>
												<td class="align-middle"><?= $this->M_labour->getLabourDesignationById($list->l_l_d_id)->l_d_title; ?></td>
												<td class="align-middle"><?= $this->M_department->getDepartmentById($list->l_d_id)->d_title; ?></td>
												<td class="align-middle"><?= $this->M_department->getSubDepartmentById($list->l_sd_id)->sd_title; ?></td>
												<td class="align-middle"><?= $list->l_address ?></td>
												<td class="align-middle text-center">
													<a class='editbutton btn bg-olive btn-xs' href="jute/labour/viewLabour?l_id=<?= $list->l_id ?>">
														<i class='fas fa-eye'></i>
													</a>
													<a class='editbutton btn bg-primary btn-xs' href="jute/labour/editLabour?l_id=<?= $list->l_id ?>">
														<i class='fas fa-user-edit'></i>
													</a>
													<a onclick="return confirm('Are you sure want to delete this?');" href="jute/labour/deleteLabour?l_id=<?= $list->l_id ?>">
														<button type='button' class='btn bg-danger btn-xs'>
															<i class="fas fa-trash"></i>
														</button>
													</a>
													<a onclick="return confirm('Are you sure want to inactive this?');" href="jute/labour/inactiveLabour?l_id=<?= $list->l_id ?>">
														<button type='button' id="" class='btn bg-danger btn-xs'>Inactive
														</button>
													</a>
												</td>
											</tr>
									<?php }
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>