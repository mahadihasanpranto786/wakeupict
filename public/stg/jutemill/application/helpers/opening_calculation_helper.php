<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

//27.9.22 TO get Munth Wish Opening Report
function monthlyOpeningValue($grade_id, $columnName, $m, $y, $fy_id)
{

	$driverInstanse = &get_instance();
	$sql = "Select * 
					FROM opening_summary
					WHERE ops_status = '1' 
					AND ops_fy_id = $fy_id 
					AND YEAR(ops_date)='$y' AND MONTH(ops_date)='$m'";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$x = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->M_opening_jute->sumJutOpening($columnName, $row->ops_id, $grade_id);
	}
	return $x;
}


// Start Opening values for Godown reports

function openingValue($grade_id, $columnName, $fy_id)
{

	$driverInstanse = &get_instance();
	$sql = "Select * 
					FROM opening_summary
					WHERE ops_status = '1' 
					AND ops_fy_id = $fy_id ";
	$mySummary = $driverInstanse->Common->sql_excute($sql)->result();
	$x = 0;
	foreach ($mySummary as $row) {
		$x = $driverInstanse->M_opening_jute->sumJutOpening($columnName, $row->ops_id, $grade_id);
	}
	return $x;
}

function currentYearPurchaseData($grade_id, $columnName, $m, $fy_id)
{
	$driverInstanse = &get_instance();
	$sql = "Select * 
					FROM jute_purchase_invoice_summary
					WHERE jpis_status = '1'
					AND jpis_approve_status = '1'
					AND jpis_fy_id = $fy_id
					AND MONTH(jpis_ot_en_date)<'$m'";
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

function currentYearIssue($grade_id, $columnName, $m, $y, $fy_id)
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
function currentYearSale($grade_id, $columnName, $m, $y, $fy_id)
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

function currentYearAdjustment($grade_id, $columnName, $m, $y, $fy_id)
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

// end Opening values for Godown reports 

function magic($grade_id, $columnName, $m, $y, $fy_id)
{

	return currentYearPurchaseData($grade_id, $columnName, $m, $y, $fy_id)
		+ openingValue($grade_id, $columnName, $fy_id)
		- currentYearSale($grade_id, $columnName, $m, $y, $fy_id)
		- currentYearIssue($grade_id, $columnName, $m, $y, $fy_id)
		+ currentYearAdjustment($grade_id, $columnName, $m, $y, $fy_id);
}
