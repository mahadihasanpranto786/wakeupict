<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/* ==================== UnAssorted Added ======================== */
// Get Khamal Unassorted Added value 
function getUnassortedAddedValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ua_a_v_s_id' => $summaryId,
		'kh_ua_a_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleUnassortedAddedValue($findData);
	return $resultData;
}
// Get Khamal Unassorted Added value 
function getUnassortedAddedValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ua_a_v_s_id' => $summaryId,
		'kh_ua_a_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleUnassortedAddedValueId($findData);
	return $resultData;
}

/* ==================== UnAssorted Deduction ======================== */
// Get Khamal Unassorted Added value 
function getUnassortedDeductionValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ua_d_v_s_id' => $summaryId,
		'kh_ua_d_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleUnassortedDeductionValue($findData);
	return $resultData;
}
// Get Khamal Unassorted Added value 
function getUnassortedDeductionValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ua_d_v_s_id' => $summaryId,
		'kh_ua_d_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleUnassortedDeductionValueId($findData);
	return $resultData;
}


/* ==================== Assorted Uncut Added ======================== */
// Get Khamal Unassorted Added value 
function getAssortedUncutAddedValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_auc_a_v_s_id' => $summaryId,
		'kh_auc_a_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedUncutAddedValue($findData);
	return $resultData;
}
// Get Khamal Assorted Added value 
function getAssortedUncutAddedValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_auc_a_v_s_id' => $summaryId,
		'kh_auc_a_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedUncutAddedValueId($findData);
	return $resultData;
}
// Get Khamal Unassorted Deduction value 
function getAssortedUncutDeductionValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_auc_d_v_s_id' => $summaryId,
		'kh_auc_d_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedUncutDeductionValue($findData);
	return $resultData;
}
// Get Khamal Assorted Deduction value 
function getAssortedUncutDeductionValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_auc_d_v_s_id' => $summaryId,
		'kh_auc_d_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedUncutDeductionValueId($findData);
	return $resultData;
}
// Get Khamal Unassorted Added value 
function getAssortedCutAddedValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ac_a_v_s_id' => $summaryId,
		'kh_ac_a_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedCutAddedValue($findData);
	return $resultData;
}
// Get Khamal Assorted Added value 
function getAssortedCutAddedValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ac_a_v_s_id' => $summaryId,
		'kh_ac_a_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedCutAddedValueId($findData);
	return $resultData;
}

// Get Khamal Unassorted Deduction value 
function getAssortedCutDeductionValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ac_d_v_s_id' => $summaryId,
		'kh_ac_d_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedCutDeductionValue($findData);
	return $resultData;
}
// Get Khamal Assorted Deduction value 
function getAssortedCutDeductionValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'kh_ac_d_v_s_id' => $summaryId,
		'kh_ac_d_v_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleAssortedCutDeductionValueId($findData);
	return $resultData;
}
// OPening Balance
function getOpeningKhamalValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'opvkh_opskh_id' => $summaryId,
		'opvkh_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleOpeningKhamalValue($findData);
	return $resultData;
}
// OPening Balance Id
function getOpeningKhamalValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'opvkh_opskh_id' => $summaryId,
		'opvkh_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleOpeningKhamalValueId($findData);
	return $resultData;
}



// Running Stock Balance For list_khamal_running_stock.php page
function getKhamalRunningStockValueForListPage($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'khrsv_khrss_id' => $summaryId,
		'khrsv_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleKhamalRunningStockValue($findData);
	return $resultData;
}

// Running Stock Balance for Khamal Stock Page
function getKhamalRunningStockValue($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'khrsv_khrss_id' => $summaryId,
		'khrsv_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getSingleKhamalRunningStockValue($findData);
	return $resultData;
}

function getKhamalRunningStockValueId($gradeId, $summaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'khrsv_khrss_id' => $summaryId,
		'khrsv_j_g_id' => $gradeId
	);
	$resultData = $driverInstanse->M_khamal->getKhamalRunningStockValueId($findData);
	return $resultData;
}


//Balance Bojha after deduct 
function unATotalBalanceBojha($unATotalBalanceBojha_array)
{
	if ($unATotalBalanceBojha_array) {
		echo array_sum($unATotalBalanceBojha_array);
	} else {
		echo 0;
	}
}
// Filter Year, MOnth and Date wise Navbar 

function filterReportNav($title, $url, $year, $month, $date)
{ ?>

	<style>
		.custom__padding {
			padding-top: 10px !important;
			padding-bottom: 10px !important;
		}

		.batman__bg {
			border: 2px solid #fff;
			background-color: #8e44ad !important;
			color: #fff;
		}

		.batman__bg:hover {
			border: 2px solid #8e44ad;
			background-color: #fff !important;
			color: #8e44ad !important;
		}
	</style>
	<div class="card mb-0">
		<div class="card-body bg-info custom__padding rounded-top">
			<div class="d-flex">
				<div class="mr-auto pr-2">
					<h6 class=""><i class="fas fa-th"></i> <?= $title ?></h6>
				</div>
				<div class="pr-3 pb-2">
					<a href="<?php echo base_url($url); ?>"><button type="submit" class="btn btn-sm batman__bg "><i class="fas fa-eye"></i> Reset To Current Month</button></a>
				</div>
			</div>
			<div class="row my-1">
				<div class="col-md-1">
					<span class="mb-0">Year : <b><?php
													if ($year) {
														if ($year  == $year) {
															echo $year;
														}
													}
													$date ?></b></span>
				</div>
				<div class="col-md-2">
					<p class=" mb-0"> Month : <b><?php
													if ($month) {
														if ($month == $month) {
															if ($month == "all") {
																echo "All Month";
															} else {
																$dateObj   = DateTime::createFromFormat('!m', $month);
																echo $monthName = $dateObj->format('F');
															}
														}
													}
													$date ?></b></p>
				</div>
				<div class="col-md-6 d-flex flex-row-reverse">
					<form class="" action=" <?php echo base_url($url); ?>" method="post" autocomplete="off">
						<div class="row">
							<div class="col-4">
								<select class="form-control select2" name="yearName" id="yearName">
									<option class="form-control" value="" disabled selected>Select Year</option>
									<!-- <option class="form-control" value="All">All</option> -->
									<?php foreach (get_all_year() as $f_year) {
									?>
										<option class="form-control" value="<?= $f_year ?>" <?php if ($year) {
																								if ($f_year == $year) {
																									echo "selected";
																								}
																							} ?>><?= $f_year; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-4">
								<select class="form-control select2" name="monthName" id="monthName">
									<option class="form-control" value="" disabled selected>Select Month</option>
									<?php
									for ($d = 1; $d <= 12; $d++) {
									?>
										<option class="form-control" value="<?= $d; ?>" <?php if ($month) {
																							if ($d == $month) {
																								echo "selected";
																							}
																						} ?>>
											<?php
											$dateObj   = DateTime::createFromFormat('!m', $d);
											echo $monthName = $dateObj->format('F'); ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="col-4">
								<button class="btn btn-success my-2 my-sm-0 border" type="submit">Search</button>
							</div>
						</div>
					</form>
				</div>
				<!-- <nav class="navbar navbar-light bg-lightblue justify-content-between">
			</nav> -->
			</div>
		</div>
	<?php
}


function openingKamal($f_year, $gradeId, $me)
{
	$dataDriver = &get_instance();

	$sql = "SELECT SUM(opvkh_value) as totalsum
				FROM opening_khamal_summary
				JOIN opening_khamal_value ON opening_khamal_value.opvkh_opskh_id = opening_khamal_summary.opskh_id
				WHERE opskh_kh_id = '$me'
				AND opskh_status = 1
				AND opvkh_j_g_id = '$gradeId'
				AND opskh_fy_id = '$f_year'";
	$v = initialZero($dataDriver->Common->sql_excute($sql)->result()[0]->totalsum);
	return $v;
}

function openingBojha($f_year, $me)
{
	$dataDriver = &get_instance();

	$sql = "SELECT SUM(opskh_bojha) as totalsum
									FROM opening_khamal_summary
									WHERE opskh_kh_id = '$me'
									AND opskh_status = 1
									AND opskh_fy_id = '$f_year'";

	$openingBojha = initialZero($dataDriver->Common->sql_excute($sql)->result()[0]->totalsum);
	return $openingBojha;
}
