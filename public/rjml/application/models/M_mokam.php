<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_mokam extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertMokam($data)
	{
		$this->db->insert('mokam', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getMokam()
	{
		$this->db->where('mo_status', 1);
		$query = $this->db->get('mokam');
		return $query;
	}

	public function getMokamById($mo_id)
	{
		$this->db->where('mo_id', $mo_id);
		$query = $this->db->get('mokam');
		return $query->row();
	}

	public function updateMokam($mo_id, $data)
	{
		$this->db->where('mo_id', $mo_id);
		$this->db->update('mokam', $data);
	}

	public function getMokamByConditions($conditions)
	{
		$this->db->where($conditions);
		$query = $this->db->get('mokam');
		return $query->row();
	}
	public function countUsedMokamInPurchase($jpis_ot_en_mo_id)
	{
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_ot_en_mo_id', $jpis_ot_en_mo_id);
		$query  = $this->db->count_all_results('jute_purchase_invoice_summary');
		return $query;
	}


	//Contract Bll ar jonno
	public function getAreaByMokamIs($mo_id)
	{
		$this->db->where('mo_id', $mo_id);
		$query = $this->db->get('mokam');
		return $query->row();
	}


	public function sumPurchasedMokamWiseJute($columnName, $mokam_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_purchase');
		$this->db->where('jpis_ot_en_mo_id', $mokam_id);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_summary')->row();
		return $query->total_purchase;
	}

	public function totalMokamWiseSumMds()
	{
		$sql = $this->db->query("SELECT SUM(jpis_ot_mds) AS total_s FROM jute_purchase_invoice_summary WHERE jpis_status = 1 AND jpis_approve_status = 1");
		return $sql->row()->total_s;
	}
}
