<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_godown extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insertGodown($data)
	{
		$this->db->insert('godown', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getGodown()
	{
		$this->db->where('g_status', 1);
		$query = $this->db->get('godown');
		return $query;
	}

	public function getGodownById($g_id)
	{
		$this->db->where('g_id', $g_id);
		$query = $this->db->get('godown');
		return $query->row();
	}

	public function updateGodown($g_id, $data)
	{
		$this->db->where('g_id', $g_id);
		$this->db->update('godown', $data);
	}

	//Godown Reports
	public function sql_excute($sql)
	{
		$query = $this->db->query($sql);
		return $query;
	}

	public function ajaxGodownDuplicateNameCheck($name)
	{
		$this->db->where('g_status', 1);
		$this->db->where('g_title =', $name);
		$query = $this->db->get('godown');
		return $query->result();
	}


	//Show data on godown report page via jut_helper
	public function sumJutPurchase($columnName, $jpiv_jpis_id, $jpiv_j_g_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_cost');
		$this->db->where('jpiv_jpis_id', $jpiv_jpis_id);
		$this->db->where('jpiv_j_g_id', $jpiv_j_g_id);
		$query = $this->db->get('jute_purchase_invoice_value')->row();
		return $query->total_cost;
	}

	public function sumJutIssue($columnName, $iss_id, $isv_j_g_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_cost');
		$this->db->where('isv_iss_id', $iss_id);
		$this->db->where('isv_j_g_id', $isv_j_g_id);
		$query = $this->db->get('issue_value')->row();
		return $query->total_cost;
	}

	public function sumJutSale($columnName, $jsv_jss_id, $jsv_j_g_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_cost');
		$this->db->where('jsv_jss_id', $jsv_jss_id);
		$this->db->where('jsv_j_g_id', $jsv_j_g_id);
		$query = $this->db->get('jute_sell_value')->row();
		return $query->total_cost;
	}

	public function sumJutAdjustment($columnName, $id, $grade_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_cost');
		$this->db->where('adjv_adjs_id', $id);
		$this->db->where('adjv_j_g_id', $grade_id);
		$query = $this->db->get('adjustment_value')->row();
		return $query->total_cost;
	}

	//Aria wise Issue
	public function sumJutIssueF($columnName, $iss_id, $isv_j_g_id, $isv_ar_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_cost');
		$this->db->where('isv_iss_id', $iss_id);
		$this->db->where('isv_j_g_id', $isv_j_g_id);
		$this->db->where('isv_ar_id', $isv_ar_id);
		$query = $this->db->get('issue_value')->row();
		return $query->total_cost;
	}

	/* ================ Jute Calculation Helper ================ */
	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getJuteCalculationHelper()
	{
		$this->db->where('jch_status', 1);
		$query = $this->db->get('jute_calculation_helper');
		return $query;
	}

	public function getJuteCalculationHelperById($jch_id)
	{
		$this->db->where('jch_id', $jch_id);
		$query = $this->db->get('jute_calculation_helper');
		return $query->row();
	}

	public function updateJuteCalculationHelper($jch_id, $data)
	{
		$this->db->where('jch_id', $jch_id);
		$this->db->update('jute_calculation_helper', $data);
	}

	//get financial Year id
	public function ajaxFinancialYear($jch_date)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $jch_date);
		$this->db->where('fy_end_date >=', $jch_date);
		$query = $this->db->get('financial_year');
		return $query->row();
	}

	public function ajaxFinancialYearX($jch_date)
	{
		$this->db->where('fy_status', 1);
		//$this->db->where("DATE_FORMAT(add_date,'%m') BETWEEN '$start_month' AND '$end_month' ")
		//$this->db->where('fy_start_date <=', $jch_date);
		$this->db->where('fy_end_date >=', $jch_date);
		$query = $this->db->get('financial_year');
		return $query->row();
	}

	public function getJuteCalculationHelperByEntryDate($entryDate)
	{
		$this->db->where('jch_start_date<=', $entryDate);
		$this->db->where('jch_end_date >=', $entryDate);
		$query = $this->db->get('jute_calculation_helper');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}



	public function juteCalculationHelperYearMonthCheck($jch_start_date, $jch_end_date)
	{
		$this->db->where('jch_status', 1);
		$this->db->where('jch_start_date <=', $jch_start_date);
		$this->db->where('jch_end_date >=', $jch_end_date);
		$query = $this->db->get('jute_calculation_helper');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getJuteCalculationHelperByMonthYear($m, $y, $fy_id)
	{
		$this->db->where('jch_status', 1);
		$this->db->where('MONTH(jch_start_date)', $m);
		$this->db->where('YEAR(jch_start_date)', $y);
		$this->db->where('jch_fy_id', $fy_id);
		$query = $this->db->get('jute_calculation_helper');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}




	//End
}
