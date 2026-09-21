<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_area extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertArea($data)
	{
		$this->db->insert('area', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getArea()
	{
		$this->db->where('ar_status', 1);
		$query = $this->db->get('area');
		return $query;
	}
	public function getAreaLimited()
	{
		$this->db->where('ar_status', 1);
		$this->db->limit(3);
		$query = $this->db->get('area');
		return $query;
	}

	public function getAreaById($ar_id)
	{
		$this->db->where('ar_id', $ar_id);
		$query = $this->db->get('area');
		return $query->row();
	}

	public function updateArea($ar_id, $data)
	{
		$this->db->where('ar_id', $ar_id);
		$this->db->update('area', $data);
	}

	/* ================================= For Reporting -> Rimon ================================= */
	// Total Area wise purchase jute quantity
	public function getTotalPurchaseAreaWise($ar_id)
	{
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");
		// $this->db->select('ar_id, ar_title, ar_description, SUM(jpis_ot_mds) AS total_purchase');
		$this->db->select('SUM(jpis_ot_mds) AS total_purchase');
		$this->db->where('ar_id', $ar_id);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_summary');
		return $query->result()[0]->total_purchase;
	}
	// Total Area Wise Purchase Sum
	public function totalAreaWiseSumMds()
	{
		$sql = $this->db->query("SELECT SUM(jpis_ot_mds) AS total_s FROM jute_purchase_invoice_summary WHERE jpis_status = 1 AND jpis_approve_status = 1");
		return $sql->row()->total_s;
	}

	// Total Are wise sale quantity
	public function getTotalAreaWiseSaleMds($area_id)
	{
		$this->db->select('SUM(jss_total_weight) AS total_sale');
		$this->db->where('jss_ar_id', $area_id);
		$this->db->where('jss_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_summary');
		return $query->result()[0]->total_sale;
	}
	// Total Are wise sale sum
	public function totalAreaWiseSaleSumMds()
	{
		$sql = $this->db->query("SELECT SUM(jss_total_weight) AS total_sum FROM jute_sell_summary WHERE jss_status = 1 AND jss_approve_status = 1");
		return $sql->row()->total_sum;
	}


	// Total Are wise Issue quantity
	public function getTotalAreaWiseIssueMds($area_id)
	{
		$this->db->select('SUM(isv_issue) AS total_sale');
		$this->db->where('isv_ar_id', $area_id);
		$this->db->where('isv_status', 1);
		$query = $this->db->get('issue_value');
		return $query->result()[0]->total_sale;
	}
	// Total Are wise Issue sum
	public function totalAreaWiseIssueSumMds()
	{
		$sql = $this->db->query("SELECT SUM(iss_total_issue) AS total_sum FROM issue_summary WHERE iss_status = 1");
		return $sql->row()->total_sum;
	}



	//End
}
