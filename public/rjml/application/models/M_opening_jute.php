<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class M_opening_jute extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insertDataWithTableName($table, $data)
	{
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getOpeningJuteSummary()
	{
		$this->db->where('ops_status', 1);
		$query = $this->db->get('opening_summary');
		return $query;
	}

	public function getOpeningJuteSummaryById($id)
	{
		$this->db->where('ops_status', 1);
		$this->db->where('ops_id', $id);
		$query = $this->db->get('opening_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}

	public function sumJutOpening($columnName, $id, $grade_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_cost');
		$this->db->where('opv_ops_id', $id);
		$this->db->where('opv_j_g_id', $grade_id);
		$query = $this->db->get('opening_value')->row();
		return $query->total_cost;
	}

	public function getSingleJuteOpeningMdsValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('opening_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->opv_mds;
		} else {
			return 0;
		}
	}

	public function getSingleJuteOpeningMdsValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('opening_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->opv_id;
		} else {
			return 0;
		}
	}
	public function getSingleJuteOpeningAvgRate($data)
	{
		$this->db->where($data);
		$query = $this->db->get('opening_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->opv_ave;
		} else {
			return 0;
		}
	}
	public function getSingleJuteOpeningAmount($data)
	{
		$this->db->where($data);
		$query = $this->db->get('opening_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->opv_amount;
		} else {
			return 0;
		}
	}


	//get financial Year id
	public function ajaxFinancialYear($opening_date)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $opening_date);
		$this->db->where('fy_end_date >=', $opening_date);
		$query = $this->db->get('financial_year');
		return $query->row();
	}

	//get Running Date
	public function ajaxFindMonth($m, $y)
	{
		$this->db->where('ops_status', 1);
		$this->db->where('month(ops_date) =', $m);
		$this->db->where('year(ops_date) =', $y);
		$query = $this->db->get('opening_summary');
		return $query->result();
	}



	public function ajaxMFinancialYearWiseOpeningCheck($id)
	{
		$this->db->where('ops_status', 1);
		$this->db->where('ops_fy_id =', $id);
		$query = $this->db->get('opening_summary');
		return $query->result();
	}


	//for Opening and Closing 

	public function getOpeningJuteByMonth($m, $y)
	{
		$this->db->where('ops_status', 1);
		$this->db->where('month(ops_date) =', $m);
		$this->db->where('year(ops_date) =', $y);
		$query = $this->db->get('opening_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}




	// End
}
