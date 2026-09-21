<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_khamal extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insertKhamal($data)
	{
		$this->db->insert('khamal', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getKhamal()
	{
		$this->db->where('kh_status', 1);
		$query = $this->db->get('khamal');
		return $query;
	}

	public function getKhamalById($kh_id)
	{
		$this->db->where('kh_id', $kh_id);
		$query = $this->db->get('khamal');
		return $query->row();
	}

	public function updateKhamal($kh_id, $data)
	{
		$this->db->where('kh_id', $kh_id);
		$this->db->update('khamal', $data);
	}

	public function ajaxKhamalDuplicateNameCheck($name)
	{
		$this->db->where('kh_status', 1);
		$this->db->where('kh_title =', $name);
		$query = $this->db->get('khamal');
		return $query->result();
	}

	/* ======================== Khamal UnAssorted Added  ======================= */
	public function insertUnAssortedAddedData($UnAssortedAddedData, $UnAssortedAddedSummaryData)
	{
		$this->db->insert($UnAssortedAddedData, $UnAssortedAddedSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	// Get Value
	public function getUnassortedAddedValue()
	{
		$this->db->where('kh_ua_a_v_id', 1);
		$returnValue = $this->db->get("khamal_unassorted_added_value");
		return $returnValue;
	}
	public function getUnassortedAddedById($kh_ua_a_s_id)
	{
		$this->db->where('kh_ua_a_s_id', $kh_ua_a_s_id);
		$query = $this->db->get("khamal_unassorted_added_summary");
		return $query->row();
	}
	public function getUnassortedAddedSummaryById()
	{
		$this->db->where('kh_ua_a_s_status', 1);
		$query = $this->db->get("khamal_unassorted_added_summary");
		return $query->row();
	}
	public function getUnassortedAddedSummary()
	{
		$this->db->order_by("kh_ua_a_s_id", "asc");
		$this->db->where("(kh_ua_a_s_status='1' OR kh_ua_a_s_status='2')");
		$query = $this->db->get("khamal_unassorted_added_summary");
		return $query;
	}
	// Get Single Value by Assorted Helper
	public function getSingleUnassortedAddedValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_unassorted_added_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ua_a_v_value;
		} else {
			return 0;
		}
	}
	// Get Single Value Id by Assorted Helper for Id
	public function getSingleUnassortedAddedValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_unassorted_added_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ua_a_v_id;
		} else {
			return 0;
		}
	}

	public function updateUnAssortedAddedSummaryData($kh_ua_a_s_id, $data)
	{
		$this->db->where('kh_ua_a_s_id', $kh_ua_a_s_id);
		$this->db->update('khamal_unassorted_added_summary', $data);
	}

	// For Out tern Id
	public function getOutTurnIdByUnAssortedAddedLotNoId($id)
	{
		$this->db->where('ot_status', 1);
		$this->db->where('ot_lot_no', $id);
		$query = $this->db->get('out_turn_summary');
		return $query->row();
	}

	/* ======================== Khamal UnAssorted Deduction  ======================= */
	public function insertUnAssortedDeductionData($UnAssortedDeductionData, $UnAssortedDeductionSummaryData)
	{
		$this->db->insert($UnAssortedDeductionData, $UnAssortedDeductionSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	// Get Value
	public function getUnassortedDeductionValue()
	{
		$this->db->where('kh_ua_d_v_id', 1);
		$returnValue = $this->db->get("khamal_unassorted_deduction_value");
		return $returnValue;
	}
	public function getUnassortedDeductionById($kh_ua_d_s_id)
	{
		$this->db->where('kh_ua_d_s_id', $kh_ua_d_s_id);
		$query = $this->db->get("khamal_unassorted_deduction_summary");
		return $query->row();
	}
	public function getUnassortedDeductionSummaryById()
	{
		$this->db->where('kh_ua_d_s_status', 1);
		$query = $this->db->get("khamal_unassorted_deduction_summary");
		return $query->row();
	}
	public function getUnassortedDeductionSummary()
	{
		$this->db->order_by("kh_ua_d_s_date", "asc");
		$this->db->where('kh_ua_d_s_status', 1);
		$query = $this->db->get("khamal_unassorted_deduction_summary");
		return $query;
	}
	// Get Single Value by Assorted Helper
	public function getSingleUnassortedDeductionValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_unassorted_deduction_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ua_d_v_value;
		} else {
			return 0;
		}
	}
	// Get Single Value Id by Assorted Helper for Id
	public function getSingleUnassortedDeductionValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_unassorted_deduction_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ua_d_v_id;
		} else {
			return 0;
		}
	}

	public function updateUnAssortedDeductionSummaryData($kh_ua_d_s_id, $data)
	{
		$this->db->where('kh_ua_d_s_id', $kh_ua_d_s_id);
		$this->db->update('khamal_unassorted_deduction_summary', $data);
	}


	/* ======================== Khamal Assorted Uncut Added  ======================= */
	public function insertAssortedUncutAddedData($AssortedUncutAddedData, $AssortedUncutAddedSummaryData)
	{
		$this->db->insert($AssortedUncutAddedData, $AssortedUncutAddedSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	// Get Value
	public function getAssortedUncutAddedValue()
	{
		$this->db->where('kh_auc_a_v_id', 1);
		$returnValue = $this->db->get("khamal_assorted_uncut_added_value");
		return $returnValue;
	}
	public function getAssortedUncutAddedById($kh_auc_a_s_id)
	{
		$this->db->where('kh_auc_a_s_id', $kh_auc_a_s_id);
		$query = $this->db->get("khamal_assorted_uncut_added_summary");
		return $query->row();
	}
	public function getAssortedUncutAddedSummaryById()
	{
		$this->db->where('kh_auc_a_s_status', 1);
		$query = $this->db->get("khamal_assorted_uncut_added_summary");
		return $query->row();
	}
	public function getAssortedUncutAddedSummary()
	{
		$this->db->order_by("kh_auc_a_s_date", "desc");
		$this->db->where('kh_auc_a_s_status', 1);
		$query = $this->db->get("khamal_assorted_uncut_added_summary");
		return $query;
	}
	// Get Single Value by Assorted Helper
	public function getSingleAssortedUncutAddedValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_uncut_added_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_auc_a_v_value;
		} else {
			return 0;
		}
	}
	// Get Single Value Id by Assorted Helper for Id
	public function getSingleAssortedUncutAddedValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_uncut_added_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_auc_a_v_id;
		} else {
			return 0;
		}
	}

	public function updateAssortedUncutAddedSummaryData($kh_auc_a_s_id, $data)
	{
		$this->db->where('kh_auc_a_s_id', $kh_auc_a_s_id);
		$this->db->update('khamal_assorted_uncut_added_summary', $data);
	}


	// Get Previous Inserted Value
	public function getPreviousInsertedValue($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}
	public function getPreviousInsertedValueTest($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query->result();
	}






	/* ======================== Khamal Assorted Uncut Deduction  ======================= */
	public function insertAssortedUncutDeductionData($AssortedUncutDeductionData, $AssortedUncutDeductionSummaryData)
	{
		$this->db->insert($AssortedUncutDeductionData, $AssortedUncutDeductionSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	// Get Value
	public function getAssortedUncutDeductionValue()
	{
		$this->db->where('kh_auc_d_v_id', 1);
		$returnValue = $this->db->get("khamal_assorted_uncut_deduction_value");
		return $returnValue;
	}
	public function getAssortedUncutDeductionById($kh_auc_d_s_id)
	{
		$this->db->where('kh_auc_d_s_id', $kh_auc_d_s_id);
		$query = $this->db->get("khamal_assorted_uncut_deduction_summary");
		return $query->row();
	}
	public function getAssortedUncutDeductionSummaryById()
	{
		$this->db->where('kh_auc_d_s_status', 1);
		$query = $this->db->get("khamal_assorted_uncut_deduction_summary");
		return $query->row();
	}
	public function getAssortedUncutDeductionSummary()
	{
		$this->db->order_by("kh_auc_d_s_date", "desc");
		$this->db->where('kh_auc_d_s_status', 1);
		$query = $this->db->get("khamal_assorted_uncut_deduction_summary");
		return $query;
	}
	// Get Single Value by Assorted Helper
	public function getSingleAssortedUncutDeductionValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_uncut_deduction_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_auc_d_v_value;
		} else {
			return 0;
		}
	}
	// Get Single Value Id by Assorted Helper for Id
	public function getSingleAssortedUncutDeductionValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_uncut_deduction_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_auc_d_v_id;
		} else {
			return 0;
		}
	}

	public function updateAssortedUncutDeductionSummaryData($kh_auc_d_s_id, $data)
	{
		$this->db->where('kh_auc_d_s_id', $kh_auc_d_s_id);
		$this->db->update('khamal_assorted_uncut_deduction_summary', $data);
	}

	/* ======================== Khamal Assorted Uncut Added  ======================= */
	public function insertAssortedCutAddedData($AssortedCutAddedData, $AssortedCutAddedSummaryData)
	{
		$this->db->insert($AssortedCutAddedData, $AssortedCutAddedSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	// Get Value
	public function getAssortedCutAddedValue()
	{
		$this->db->where('kh_ac_a_v_id', 1);
		$returnValue = $this->db->get("khamal_assorted_cut_added_value");
		return $returnValue;
	}
	public function getAssortedCutAddedById($kh_ac_a_s_id)
	{
		$this->db->where('kh_ac_a_s_id', $kh_ac_a_s_id);
		$query = $this->db->get("khamal_assorted_cut_added_summary");
		return $query->row();
	}
	public function getAssortedCutAddedSummaryById()
	{
		$this->db->where('kh_ac_a_s_status', 1);
		$query = $this->db->get("khamal_assorted_cut_added_summary");
		return $query->row();
	}
	public function getAssortedCutAddedSummary()
	{
		$this->db->order_by("kh_ac_a_s_date", "desc");
		$this->db->where('kh_ac_a_s_status', 1);
		$query = $this->db->get("khamal_assorted_cut_added_summary");
		return $query;
	}
	// Get Single Value by Assorted Helper
	public function getSingleAssortedCutAddedValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_cut_added_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ac_a_v_value;
		} else {
			return 0;
		}
	}
	// Get Single Value Id by Assorted Helper for Id
	public function getSingleAssortedCutAddedValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_cut_added_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ac_a_v_id;
		} else {
			return 0;
		}
	}

	public function updateAssortedCutAddedSummaryData($kh_ac_a_s_id, $data)
	{
		$this->db->where('kh_ac_a_s_id', $kh_ac_a_s_id);
		$this->db->update('khamal_assorted_cut_added_summary', $data);
	}


	/* ======================== Khamal Assorted Cut Deduction  ======================= */
	public function insertAssortedCutDeductionData($AssortedCutDeductionData, $AssortedCutDeductionSummaryData)
	{
		$this->db->insert($AssortedCutDeductionData, $AssortedCutDeductionSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	// Get Value
	public function getAssortedCutDeductionValue()
	{
		$this->db->where('kh_ac_d_v_id', 1);
		$returnValue = $this->db->get("khamal_assorted_cut_deduction_value");
		return $returnValue;
	}
	public function getAssortedCutDeductionById($kh_ac_d_s_id)
	{
		$this->db->where('kh_ac_d_s_id', $kh_ac_d_s_id);
		$query = $this->db->get("khamal_assorted_cut_deduction_summary");
		return $query->row();
	}
	public function getAssortedCutDeductionSummaryById()
	{
		$this->db->where('kh_ac_d_s_status', 1);
		$query = $this->db->get("khamal_assorted_cut_deduction_summary");
		return $query->row();
	}
	public function getAssortedCutDeductionSummary()
	{
		$this->db->order_by("kh_ac_d_s_date", "desc");
		$this->db->where('kh_ac_d_s_status', 1);
		$query = $this->db->get("khamal_assorted_cut_deduction_summary");
		return $query;
	}
	// Get Single Value by Assorted Helper
	public function getSingleAssortedCutDeductionValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_cut_deduction_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ac_d_v_value;
		} else {
			return 0;
		}
	}
	// Get Single Value Id by Assorted Helper for Id
	public function getSingleAssortedCutDeductionValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_assorted_cut_deduction_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->kh_ac_d_v_id;
		} else {
			return 0;
		}
	}

	public function updateAssortedCutDeductionSummaryData($kh_ac_d_s_id, $data)
	{
		$this->db->where('kh_ac_d_s_id', $kh_ac_d_s_id);
		$this->db->update('khamal_assorted_cut_deduction_summary', $data);
	}

	/* ============= Unassorted Added & Deduct Table joined ============= */
	public function filterDateWiseUnAssortedAddedSummaryToDeductSummaryForBalance()
	{
		//$this->db->join('khamal_unassorted_deduction_summary', 'khamal_unassorted_deduction_summary.kh_ua_d_s_kh_id = khamal_unassorted_added_summary.kh_ua_a_s_kh_id');
		//$this->db->join('khamal_unassorted_deduction_summary');

		$query = $this->db->query("select *
		from khamal_unassorted_added_summary d left join khamal_unassorted_deduction_summary e
		on (d.kh_ua_a_s_kh_id = e.kh_ua_d_s_kh_id) where d.kh_ua_a_s_status = 1 OR e.kh_ua_d_s_status = 1 group by d.kh_ua_a_s_kh_id");
		return $query->result();
		// $this->db->order_by("kh_ua_a_s_kh_id", "asc");
		// $this->db->where($data);
		// $query = $this->db->get("khamal_unassorted_added_summary");
		// return $query;
	}
	public function filterDateWiseUnAssortedAddedSummaryToDeductSummaryForBalanceA($date)
	{
		//$this->db->join('khamal_unassorted_deduction_summary', 'khamal_unassorted_deduction_summary.kh_ua_d_s_kh_id = khamal_unassorted_added_summary.kh_ua_a_s_kh_id');
		//$this->db->join('khamal_unassorted_deduction_summary');

		$query = $this->db->query("select *
		from khamal_unassorted_added_summary d left join khamal_unassorted_deduction_summary e
		on (d.kh_ua_a_s_kh_id = e.kh_ua_d_s_kh_id) where d.kh_ua_a_s_en_date = '$date' and d.kh_ua_a_s_status = 1 or e.kh_ua_d_s_status = 1 group by d.kh_ua_a_s_kh_id");
		return $query->result();
		// $this->db->order_by("kh_ua_a_s_kh_id", "asc");
		// $this->db->where($data);
		// $query = $this->db->get("khamal_unassorted_added_summary");
		// return $query;
	}

	/* ============= assorted Added & Deduct Table joined ============= */
	public function filterDateWiseAssortedCutAddedSummaryToDeductSummaryForBalance($data)
	{
		$this->db->join('khamal_assorted_cut_deduction_summary', 'khamal_assorted_cut_deduction_summary.kh_ac_d_s_kh_id = khamal_assorted_cut_added_summary.kh_ac_a_s_kh_id');
		$this->db->order_by("kh_ac_a_s_kh_id", "asc");
		$this->db->where($data);
		$query = $this->db->get("khamal_assorted_cut_added_summary");
		return $query;
	}



	public function verifiedKamal($sql)
	{
		// $this->db->where($index, $data);
		// $query = $this->db->get($table);
		// return $query;
		$query = $this->db->query($sql);
		return $query;
	}




	/* ============= code by murad (shuvro) ============= */


	/* ====================== Insert OPening Khamal ====================== */
	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}


	public function getSingleOpeningKhamalValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('opening_khamal_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->opvkh_value;
		} else {
			return 0;
		}
	}

	public function getSingleOpeningKhamalValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('opening_khamal_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->opvkh_id;
		} else {
			return 0;
		}
	}

	public function getMonthlyKhamalRunningStockSummary($y, $m)
	{
		$this->db->where('khrss_status', 1);
		$this->db->where('YEAR(khrss_date)', $y);
		$this->db->where('MONTH(khrss_date)', $m);
		$query = $this->db->get('khamal_running_stock_summary');
		return $query;
	}

	public function getSingleKhamalRunningStockValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_running_stock_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->khrsv_value;
		} else {
			return 0;
		}
	}

	public function getKhamalRunningStockValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('khamal_running_stock_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->khrsv_id;
		} else {
			return 0;
		}
	}

	//get financial Year id Opening Khamal
	public function ajaxFinancialYear($date)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $date);
		$this->db->where('fy_end_date >=', $date);
		$query = $this->db->get('financial_year');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}

	//get financial Year id  Khamal Running Stock
	public function ajaxFinancialYearKhamalRunningStock($khrsv_date)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $khrsv_date);
		$this->db->where('fy_end_date >=', $khrsv_date);
		$query = $this->db->get('financial_year');
		return $query->row();
	}

	public function getKhamalByConditions($conditions)
	{
		$this->db->where($conditions);
		$query = $this->db->get('khamal');
		return $query->row();
	}

	//get Running Date
	public function ajaxFindMonth($m, $y)
	{
		$this->db->where('khrss_status', 1);
		$this->db->where('month(khrss_date) =', $m);
		$this->db->where('year(khrss_date) =', $y);
		$query = $this->db->get('khamal_running_stock_summary');
		return $query->result();
	}


	//get Running Date
	public function ajaxFindYearOpeningKhamal($y)
	{
		$this->db->where('opskh_status', 1);
		$this->db->where('year(opskh_date) =', $y);
		$query = $this->db->get('opening_khamal_summary');
		return $query->result();
	}


	public function ajaxMFinancialYearWiseOpeningKhamalCheck($id)
	{
		$this->db->where('opskh_status', 1);
		$this->db->where('opskh_fy_id', $id);
		$query = $this->db->get('opening_khamal_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}



	//End
}
