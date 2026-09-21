<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class M_daily_issue extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/* ========================== Jute Requisition ========================== */
	public function insertDailyRequisition($requisitionValueData, $requisitionSummaryData)
	{
		$this->db->insert($requisitionValueData, $requisitionSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	public function getDailyRequisitionValue()
	{
		$this->db->where('rev_status', 1);
		$returnValue = $this->db->get("requisition_value");
		return $returnValue;
	}

	// Get Single Value by jute_helper
	public function getSingleRequisitionValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('requisition_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->rev_requisition;
		} else {
			return 0;
		}
	}

	// Get Single Requisition Id for Edit/Update Requisition Value
	public function getSingleRequisitionValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('requisition_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->rev_id;
		} else {
			return 0;
		}
	}

	public function getDailyRequisitionSummary()
	{
		$this->db->order_by("res_date", "desc");
		$this->db->where('res_status', 1);
		$returnValue = $this->db->get("requisition_summary");
		return $returnValue;
	}
	public function getDailyRequisitionSummaryById()
	{
		$this->db->where('res_status', 1);
		$returnValue = $this->db->get("requisition_summary");
		return $returnValue->row();
	}
	public function getDailyRequisitionById($res_id)
	{
		$this->db->where('res_id', $res_id);
		$query = $this->db->get("requisition_summary");
		return $query->row();
	}
	//Update Requisition Summary Data
	public function updateRequisitionSummary($res_id, $data)
	{
		$this->db->where('res_id', $res_id);
		$this->db->update('requisition_summary', $data);
	}

	public function getDailyRequisitionBySummaryId($summary_id)
	{
		$this->db->where('rev_status', 1);
		$this->db->where('rev_id', $summary_id);
		$query = $this->db->get('requisition_value');
		return $query->row();
	}


	// Get Single Value by jute_helper
	public function getTotalRequisitionValue($data)
	{

		$this->db->select_sum('rev_requisition');
		$this->db->where($data);
		$query = $this->db->get('requisition_value');
		//$query = $this->db->query('SELECT sum(rev_requisition) as total from requisition_value');
		if ($this->db->affected_rows() > 0) {
			//return $query->row()->rev_requisition;
			return $query->result()[0]->rev_requisition;
		} else {
			return 0;
		}
	}


	public function ajaxSerialNumberCheckForRequisition($conditions)
	{
		$this->db->where($conditions);
		$this->db->get('requisition_summary');
		return $this->db->affected_rows();
	}

	/* ========================== Jute Issue ========================== */

	public function insertDailyIssue($issueValueData, $issueSummaryData)
	{
		$this->db->insert($issueValueData, $issueSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	public function getDailyIssueValue()
	{
		$this->db->where('isv_status', 1);
		$returnValue = $this->db->get("issue_value");
		return $returnValue;
	}
	// Get Single Value by jute_helper
	public function getSingleIssueValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('issue_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->isv_issue;
		} else {
			return 0;
		}
	}
	// Get Single Value by jute_helper
	public function getSingleIssueBalanceValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('issue_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->isv_balance;
		} else {
			return 0;
		}
	}
	// Get Single Issue Id for update Issue Value
	public function getSingleIssueValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('issue_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->isv_id;
		} else {
			return 0;
		}
	}

	public function getDailyIssueById($iss_id)
	{
		$this->db->where('iss_id', $iss_id);
		$query = $this->db->get("issue_summary");
		return $query->row();
	}
	public function getDailyIssueSummary()
	{
		$this->db->order_by("iss_date", "desc");
		$this->db->where('iss_status', 1);
		$returnValue = $this->db->get("issue_summary");
		return $returnValue;
	}
	public function getDailyIssueSummaryById($iss_id)
	{
		$this->db->where('iss_id', $iss_id);
		$query = $this->db->get("issue_summary");
		return $query->row();
	}
	public function getDailyIssueBySummaryId($summary_id)
	{
		$this->db->where('isv_status', 1);
		$this->db->where('isv_id', $summary_id);
		$query = $this->db->get('issue_value');
		return $query->row();
	}

	// Get Issue Summary By Requisition Summary Id
	public function getIssueSummaryByRequisitionSummaryId($reSummary_id)
	{
		$this->db->where('iss_status', 1);
		$this->db->where('iss_res_id', $reSummary_id);
		$query = $this->db->get('issue_summary');
		return $query->row();
	}

	//Update Requisition Summary Data
	public function updateIssueSummary($iss_id, $data)
	{
		$this->db->where('iss_id', $iss_id);
		$this->db->update('issue_summary', $data);
	}


	/* =============  Total Issued Quantity  ============ */


	public function sumDateWiseGradeValue()
	{
		$sql = $this->db->query('SELECT isv_iss_id, isv_ar_id, isv_j_g_id, isv_date, SUM(isv_issue) as dateAndGradeWiseTotal FROM issue_value GROUP BY isv_date, isv_j_g_id');
		return $sql->row()->dateAndGradeWiseTotal;
	}


	public function sumDateWiseAreaValue()
	{
		$sql = $this->db->query('SELECT isv_iss_id, isv_ar_id, isv_j_g_id, isv_date, SUM(isv_issue) as dateAndAreaWiseTotal  FROM issue_value  GROUP BY isv_date, isv_ar_id');
		return $sql->row()->dateAndAreaWiseTotal;
	}




	/* =============  financial Year id  ============ */
	//get financial Year id 
	public function ajaxFinancialYear($date)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $date);
		$this->db->where('fy_end_date >=', $date);
		$query = $this->db->get('financial_year');
		return $query->row();
	}



	// End
}
