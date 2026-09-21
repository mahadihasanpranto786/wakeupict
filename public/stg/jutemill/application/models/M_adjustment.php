<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class M_adjustment extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getAdjustmentSummary()
	{
		$this->db->where('adjs_status', 1);
		$query = $this->db->get('adjustment_summary');
		return $query;
	}

	public function getSingleAdjustmentValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('adjustment_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->adjv_value;
		} else {
			return 0;
		}
	}
	public function getSingleAdjustmentValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('adjustment_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->adjv_id;
		} else {
			return 0;
		}
	}



	//get financial Year id
	public function ajaxFinancialYear($adjv_date)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $adjv_date);
		$this->db->where('fy_end_date >=', $adjv_date);
		$query = $this->db->get('financial_year');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}

	//get Running Date
	public function ajaxFindMonth($m, $y)
	{
		$this->db->where('adjs_status', 1);
		$this->db->where('month(adjs_date) =', $m);
		$this->db->where('year(adjs_date) =', $y);
		$query = $this->db->get('adjustment_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}
}
