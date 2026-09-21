<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_grade extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertJuteGrade($data)
	{
		$this->db->insert('jute_grade', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getJuteGrade()
	{
		$this->db->where('j_g_status', 1);
		$query = $this->db->get('jute_grade');
		return $query;
	}

	public function getJuteGradeById($j_g_id)
	{
		$this->db->where('j_g_id', $j_g_id);
		$query = $this->db->get('jute_grade');
		return $query->row();
	}

	public function updateJuteGrade($j_g_id, $data)
	{
		$this->db->where('j_g_id', $j_g_id);
		$this->db->update('jute_grade', $data);
	}






	/* =================================== For Reporting -> Rimon =================================== */
	// Total Grade wise purchase jute quantity
	public function getTotalPurchaseGradeWise($j_g_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->select('SUM(jpiv_weight_mds) AS total_purchase');
		$this->db->where('jpiv_j_g_id', $j_g_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total_purchase;
	}

	// Total Grade Wise Purchase Sum
	public function totalGradeWiseSumMds()
	{
		$sql = $this->db->query("SELECT SUM(jpis_ot_mds) AS total_s FROM jute_purchase_invoice_summary WHERE jpis_status = 1 AND jpis_approve_status = 1");
		return $sql->row()->total_s;
	}


	// Total Grade Wise Sale
	public function getTotalGradeWiseSaleMds($grade_id)
	{
		$this->db->join('jute_sell_summary', 'jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id');
		$this->db->select('SUM(jsv_weight) AS total_purchase');
		$this->db->where('jsv_j_g_id', $grade_id);
		$this->db->where('jsv_status', 1);
		$this->db->where('jss_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_value');
		return $query->result()[0]->total_purchase;
	}
	// Total Grade Wise Sale Sum
	public function totalGradeWiseSumSaleMds()
	{
		$sql = $this->db->query("SELECT SUM(jss_total_weight) AS total_sum FROM jute_sell_summary WHERE jss_status = 1 AND jss_approve_status = 1");
		return $sql->row()->total_sum;
	}


	// Total Grade Wise Issue
	public function getTotalGradeWiseIssueMds($grade_id)
	{
		$this->db->select('SUM(isv_issue) AS total_purchase');
		$this->db->where('isv_j_g_id', $grade_id);
		$this->db->where('isv_status', 1);
		$query = $this->db->get('issue_value');
		return $query->result()[0]->total_purchase;
	}
	// Total Grade Wise Sale Sum
	public function totalGradeWiseSumIssueMds()
	{
		$sql = $this->db->query("SELECT SUM(iss_total_issue) AS total_sum FROM issue_summary WHERE iss_status = 1");
		return $sql->row()->total_sum;
	}


	// End
}
