<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

function getJuteRate($gradeId, $areaId, $juteRateSumaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'jr_jrs_id' => $juteRateSumaryId,
		'jr_ar_id' => $areaId,
		'jr_j_g_id' => $gradeId,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_rate->getSingleJuteRate($findData);
	return $resultData;
}

function getJuteRateMoistureNew($areaId, $juteRateSumaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'jr_m_jrs_id' => $juteRateSumaryId,
		'jr_m_ar_id' => $areaId,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_rate->getSingleJuteMoistureNew($findData);
	return $resultData;
}

function getJuteRateMoistureOld($areaId, $juteRateSumaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'jr_m_jrs_id' => $juteRateSumaryId,
		'jr_m_ar_id' => $areaId,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_rate->getSingleJuteMoistureOld($findData);
	return $resultData;
}

//for Jute entry form
function getLotNumberCount()
{
	$driverInstanse = &get_instance();
	$findData = array(
		'en_fy_id' => 1,
		//'jr_m_ar_id' =>   $areaId,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_entry->getLotNumberCount($findData);
	return $resultData + 1;
}

// show data in list_out_turn_report.php page
function getOutTurnPer($gradeId, $outTurnSumaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'otp_j_g_id' => $gradeId,
		'otp_ot_id' => $outTurnSumaryId,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_entry->getSingleOutTurn($findData);
	return $resultData;
}

// show data in list_out_turn_report.php page
function getOutTurnPerId($gradeId, $outTurnSumaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'otp_j_g_id' => $gradeId,
		'otp_ot_id' => $outTurnSumaryId,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_entry->getSingleOutTurnPerId($findData);
	return $resultData;
}

// show data in list_out_turn_report.php page
function getInvoiceValue($gradeId, $invoiceSumaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'jpiv_j_g_id' => $gradeId,
		'jpiv_jpis_id' => $invoiceSumaryId,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_entry->getInvoiceValue($findData);
	return $resultData;
}


// show data in supplier_report.php page
function getSupplierPayableAmount($supplierId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'jpis_ot_en_s_id' => $supplierId,
		'jpis_approve_status' => 1,
	);
	//return $gradeId;
	$resultData = $driverInstanse->M_jute_entry->getSupplierPayableAmount($findData);
	//print_r($resultData);
	if ($resultData) {
		//return 1;
		foreach ($resultData->result() as $resultDataa) {
			$jpis_grand_total[] = $resultDataa->jpis_grand_total;
			//return $jpis_grand_total;

		}
		return array_sum($jpis_grand_total);
	} else {
		return 0;
	}
	//return 0;
}

// Get SMR rate by SMR precentage (M_jute_entry) [dinamic IF else Function]
function smrRateGenarete($sr, $fc, $sc, $fv, $sv, $pv)
{
	$q = 0;
	if ($fc == '=') {
		if ($pv == $fv) {
			return $sr;
		} else {
			//return 0;
		}
	}

	//echo $sr;
	//echo '<br>';
	//echo $fc;
	//echo '<br>';
	//echo $sc;
	//echo '<br>';
	//echo $fv;
	//echo '<br>';
	//echo $sv;
	//echo '<br>';
	//echo $pv;
	//echo '<br>';
	//echo $q;
	//echo '<br>';

	eval('if($fv ' . $fc . ' $pv AND $sv ' . $sc . '$pv) $q= $sr; else $q= "0";');
	// echo '<br>';
	// echo $q;
	// echo '<br>';
	return $q;
}

// get jute rate in add_invoice.php page (contract rate)
function getJuteRateForContract($jute_rate_summary_table_id, $ot_ar_id, $gradeId, $outTurnSumaryId)
{
	$driverInstanse = &get_instance();
	if ($gradeId == 5) {
		$findData = array(
			'otp_j_g_id' => $gradeId,
			'otp_ot_id' => $outTurnSumaryId,
		);
		$outTurnPer = $driverInstanse->M_jute_entry->getSingleOutTurn($findData);

		$jute_rate_smr = $driverInstanse->M_jute_entry->getSmrRate($outTurnPer, $jute_rate_summary_table_id);

		if ($jute_rate_smr == 0) {
			$resultData = $driverInstanse->M_jute_entry->getJuteRate($jute_rate_summary_table_id, $ot_ar_id, $gradeId);

			//return $resultData->jr_rate; // new grade add duar karona jai error asca oita soranor jonno model a change korsi 13.10.21
			return $resultData;
		}
		return $jute_rate_smr;
	} else {
		$resultData = $driverInstanse->M_jute_entry->getJuteRate($jute_rate_summary_table_id, $ot_ar_id, $gradeId);
		//return $resultData->jr_rate; // new grade add duar karona jai error asca oita soranor jonno model a change korsi
		return $resultData;
	}
}



// Code By Rimon
// Get Daily Jute Requisition Value
function getRequisitionValue($gradeId, $areaId, $requisitionSummaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'rev_res_id' => $requisitionSummaryId,
		'rev_ar_id' => $areaId,
		'rev_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_daily_issue->getSingleRequisitionValue($findData);
	return $resultData;
}

// get total velue
function getTotalRequisitionValueByArea($areaId, $requisitionSummaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'rev_res_id' => $requisitionSummaryId,
		'rev_ar_id' => $areaId,
	);
	$resultData = $driverInstanse->M_daily_issue->getTotalRequisitionValue($findData);
	return $resultData;
}

// Get Requisition Value id for update data (Done by Sir)
function getSingleRequisitionValueId($gradeId, $areaId, $requisitionSummaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'rev_res_id' => $requisitionSummaryId,
		'rev_ar_id' => $areaId,
		'rev_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_daily_issue->getSingleRequisitionValueId($findData);
	return $resultData;
}

// Get Daily Jute Issue Value
function getIssueValue($gradeId, $areaId, $issueSummaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'isv_iss_id' => $issueSummaryId,
		'isv_ar_id' => $areaId,
		'isv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_daily_issue->getSingleIssueValue($findData);
	return $resultData;
}
// Get Daily Jute Issue Value for Stock
function getTotalIssuedValue($gradeId, $areaId, $issueSummaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'isv_iss_id' => $issueSummaryId,
		'isv_ar_id' => $areaId,
		'isv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_daily_issue->getSingleIssueValue($findData);
	return $resultData;
}





// Get Issue Value id for update issue value data 
function getSingleIssueValueId($gradeId, $areaId, $issueSummaryId)
{
	$driverInstanse = &get_instance();
	$findData = array(
		'isv_iss_id' => $issueSummaryId,
		'isv_ar_id' => $areaId,
		'isv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_daily_issue->getSingleIssueValueId($findData);
	return $resultData;
}

// Get Daily Jute Issue Balance 
function getIssueBalanceValue($gradeId, $areaId, $issueSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'isv_iss_id' => $issueSummaryId,
		'isv_ar_id' => $areaId,
		'isv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_daily_issue->getSingleIssueBalanceValue($findBalanceData);
	return $resultData;
}


/* =================================== Jute Sell Client Module =================================== */
// Get jute sell invoice weight
function getJuteSellWeightValue($gradeId, $jsSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'jsv_jss_id' => $jsSummaryId,
		'jsv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_client->getSingleJuteSellWeightValue($findBalanceData);
	return $resultData;
}
//Rate
function getJuteSellRateValue($gradeId, $jsSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'jsv_jss_id' => $jsSummaryId,
		'jsv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_client->getSingleJuteSellRateValue($findBalanceData);
	return $resultData;
}

//Show jute sale amount
function getJuteSellAmountValue($gradeId, $jsSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'jsv_jss_id' => $jsSummaryId,
		'jsv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_client->getSingleJuteSellAmountValue($findBalanceData);
	return $resultData;
}

//ID
function getJuteSellValueId($gradeId, $jsSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'jsv_jss_id' => $jsSummaryId,
		'jsv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_client->getSingleJuteSellValueId($findBalanceData);
	return $resultData;
}

// Opening Jute Value
function getJuteOpeningMdsValue($gradeId, $opSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'opv_ops_id' => $opSummaryId,
		'opv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_opening_jute->getSingleJuteOpeningMdsValue($findBalanceData);
	return $resultData;
}
// Opening Jute Avg
function getJuteOpeningAvgRate($gradeId, $opSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'opv_ops_id' => $opSummaryId,
		'opv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_opening_jute->getSingleJuteOpeningAvgRate($findBalanceData);
	return $resultData;
}


// Opening Jute Amount
function getJuteOpeningAmount($gradeId, $opSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'opv_ops_id' => $opSummaryId,
		'opv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_opening_jute->getSingleJuteOpeningAmount($findBalanceData);
	return $resultData;
}

// Opening Jute Value id [Used in opening jute update and godown report page ]
function getJuteOpeningMdsValueId($gradeId, $opSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'opv_ops_id' => $opSummaryId,
		'opv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_opening_jute->getSingleJuteOpeningMdsValueId($findBalanceData);
	return $resultData;
}


//গোডআউন রিপোর্ট এ দেখানোর জন্য--- কোন ক্যাচাল না থাকলে
function VagalSaraTa($grade_id)
{
	$driverInstanse = &get_instance();
	$y = year();
	$m = month();
	$sql = "Select * 
					FROM jute_purchase_invoice_summary
					WHERE jpis_status = '1'
					AND YEAR(jpis_ot_en_date)<='$y' AND MONTH(jpis_ot_en_date)<='$m'";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$sum = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->Common->sumGG($row->jpis_id, $grade_id);
		$sum += $x;
	}
	return $sum;
}

//গোডআউন রিপোর্ট এ দেখানোর জন্য--- কোন ক্যাচাল থাকলে
function stockValue($grade_id, $columnName)
{

	$driverInstanse = &get_instance();
	$m = month();
	$y = year();
	if ($m == 1) {
		$m = 12;
		$y = $y - 1;
	} else {
		$m = $m - 1;
	}

	$sql = "Select * 
					FROM jute_purchase_invoice_summary
					WHERE jpis_status = '1'
					AND jpis_approve_status = '1'
					AND YEAR(jpis_ot_en_date)<='$y' AND MONTH(jpis_ot_en_date)<='$m'";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$sum = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->M_godown->sumJutPurchase($columnName, $row->jpis_id, $grade_id);
		//$sum += $x;
		if ($grade_id == 1) {

			$ot_ar_id = $driverInstanse->Common->get_single_row_information('out_turn_summary', 'ot_lot_no', $row->jpis_ot_lot_no)->ot_ar_id;
			if ($ot_ar_id == 5) {
				$oldWH = $driverInstanse->session->userdata('wh');
				$oldWH += $x;
				$driverInstanse->session->set_userdata('wh', $oldWH);
			} elseif ($ot_ar_id == 4) {
				$oldKF = $driverInstanse->session->userdata('kf');
				$oldKF += $x;
				$driverInstanse->session->set_userdata('kf', $oldKF);
			} else {
				$sum += $x;
			}
		} else {
			$sum += $x;
		}
	}
	return $sum;
}

//to show calculation on godown rePORT PAGE	
function currentMonthPurchaseData($grade_id, $columnName, $m, $y, $fy_id)
{
	$driverInstanse = &get_instance();
	$sql = "Select * 
					FROM jute_purchase_invoice_summary
					WHERE jpis_status = '1'
					AND jpis_approve_status = '1'
					AND jpis_fy_id = $fy_id
					AND jpis_ot_en_date > DATE_SUB('$y-$m-01 17:00:00', INTERVAL 1 DAY)   
					AND jpis_ot_en_date <= CONCAT(LAST_DAY('$y-$m-01'), ' 17:00:00')";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$sum = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->M_godown->sumJutPurchase($columnName, $row->jpis_id, $grade_id);
		//$sum += $x;
		if ($grade_id == 1) {

			$ot_ar_id = $driverInstanse->Common->get_single_row_information('out_turn_summary', 'ot_lot_no', $row->jpis_ot_lot_no)->ot_ar_id;
			if ($ot_ar_id == 5) {
				$oldWH = $driverInstanse->session->userdata('wh');
				$oldWH += $x;
				$driverInstanse->session->set_userdata('wh', $oldWH);
			} elseif ($ot_ar_id == 4) {
				$oldKF = $driverInstanse->session->userdata('kf');
				$oldKF += $x;
				$driverInstanse->session->set_userdata('kf', $oldKF);
			} else {
				$sum += $x;
			}
		} else {
			$sum += $x;
		}
	}
	return $sum;
}
function currentMonthIssue($grade_id, $columnName, $m, $y, $fy_id)
{
	$driverInstanse = &get_instance();
	$sql = "Select * 
					FROM issue_summary
					WHERE iss_status = '1'
					AND iss_res_fy_id = $fy_id
					AND YEAR(iss_date)='$y' AND MONTH(iss_date)='$m'";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$sum = 0;
	$fff = 0;
	foreach ($mySummary as $row) {
		if ($grade_id == 1) {
			$data = array(
				'isv_iss_id' => $row->iss_id,
				'isv_j_g_id' => $grade_id
			);
			$issue_value = $driverInstanse->Common->get_data_multi_conditional('issue_value', $data)->result();
			foreach ($issue_value as $kk) {
				$x = $driverInstanse->M_godown->sumJutIssueF($columnName, $row->iss_id, $grade_id, $kk->isv_ar_id);
				if ($kk->isv_ar_id == 5) {
					$oldWH = $driverInstanse->session->userdata('wh');
					$oldWH += $x;
					$driverInstanse->session->set_userdata('wh', $oldWH);
				} elseif ($kk->isv_ar_id == 4) {
					$oldKF = $driverInstanse->session->userdata('kf');
					$oldKF += $x;
					$driverInstanse->session->set_userdata('kf', $oldKF);
				} else {
					$sum += $x;
				}
			}
		} else {
			$x = $driverInstanse->M_godown->sumJutIssue($columnName, $row->iss_id, $grade_id);
			$sum += $x;
		}
	}
	return $sum;
}

//For Godown Report
function currentMonthSale($grade_id, $columnName, $m, $y, $fy_id)
{
	$driverInstanse = &get_instance();
	$sql = "Select * 
					FROM jute_sell_summary
					WHERE jss_status = '1'
					AND jss_approve_status = '1'
					AND jss_fy_id = $fy_id
					AND YEAR(jss_date)='$y' AND MONTH(jss_date)='$m'";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$sum = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->M_godown->sumJutSale($columnName, $row->jss_id, $grade_id);
		//$sum += $x;
		if ($grade_id == 1) {

			//$ot_ar_id = $driverInstanse->Common->get_single_row_information('jute_sell_summary', 'jss_ar_id', $row->jpis_ot_lot_no)->ot_ar_id;
			if ($row->jss_ar_id == 5) {
				$oldWH = $driverInstanse->session->userdata('wh');
				$oldWH += $x;
				$driverInstanse->session->set_userdata('wh', $oldWH);
			} elseif ($row->jss_ar_id == 4) {
				$oldKF = $driverInstanse->session->userdata('kf');
				$oldKF += $x;
				$driverInstanse->session->set_userdata('kf', $oldKF);
			} else {
				$sum += $x;
			}
		} else {
			$sum += $x;
		}
	}
	return $sum;
}

function currentMonthAdjustment($grade_id, $columnName, $m, $y, $fy_id)
{

	$driverInstanse = &get_instance();
	$sql = "Select * 
					FROM adjustment_summary
					WHERE adjs_status = '1'
					AND adjs_fy_id = $fy_id
					AND YEAR(adjs_date)='$y' AND MONTH(adjs_date)='$m'";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$sum = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->M_godown->sumJutAdjustment($columnName, $row->adjs_id, $grade_id);
		$sum += $x;
	}
	return $sum;
}

function juteSell($grade_id, $columnName)
{

	$driverInstanse = &get_instance();
	$m = month();
	$y = year();
	$sql = "Select * 
					FROM jute_sell_summary
					WHERE jss_status = '1' AND YEAR(jss_date)='$y' AND MONTH(jss_date)='$m'";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$sum = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->M_client->sumJuteSell($columnName, $row->jss_id, $grade_id);
		$sum += $x;
	}
	return $sum;
}


function getAdjustmentGradeValue($gradeId, $adjsSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'adjv_adjs_id' => $adjsSummaryId,
		'adjv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_adjustment->getSingleAdjustmentValue($findBalanceData);
	return $resultData;
}
function getAdjustmentGradeValueId($gradeId, $adjsSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'adjv_adjs_id' => $adjsSummaryId,
		'adjv_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_adjustment->getSingleAdjustmentValueId($findBalanceData);
	return $resultData;
}




/* ==================== Jute Purchase Order ==================== */
function getJutePurchaseOrderValue($gradeId, $opSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'jpov_jpos_id' => $opSummaryId,
		'jpov_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_purchase->getJutePurchaseOrderValue($findBalanceData);
	return $resultData;
}
function getJutePurchaseOrderValueId($gradeId, $opSummaryId)
{
	$driverInstanse = &get_instance();
	$findBalanceData = array(
		'jpov_jpos_id' => $opSummaryId,
		'jpov_j_g_id' => $gradeId,
	);
	$resultData = $driverInstanse->M_purchase->getJutePurchaseOrderValueId($findBalanceData);
	return $resultData;
}
