<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_financial_year extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertFinancialYear($data)
	{
		$this->db->insert('financial_year', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getFinancialYear()
	{
		$this->db->order_by("fy_id", "desc");
		$this->db->where('fy_status', 1);
		$query = $this->db->get('financial_year');
		return $query;
	}

	public function getFinancialYearById($fy_id)
	{
		$this->db->where('fy_id', $fy_id);
		$query = $this->db->get('financial_year');
		return $query->row();
	}

	public function updateFinancialYear($fy_id, $data)
	{
		$this->db->where('fy_id', $fy_id);
		$this->db->update('financial_year', $data);
	}



	//get financial Year id
	public function ajaxFinancialYear($date)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $date);
		$this->db->where('fy_end_date >=', $date);
		$query = $this->db->get('financial_year');
		return $query->row();
	}

	//get financial Year id
	public function getFirstFinancialYear()
	{
		$this->db->where('fy_status', 1);
		$this->db->order_by("fy_id", "asc");
		$query = $this->db->get('financial_year');
		return $query->row();
	}
}
