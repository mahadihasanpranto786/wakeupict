<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_production_unit extends CI_model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insertProductionUnit($data)
	{
		$this->db->insert('production_unit', $data);
		$query = $this->db->insert_id();
		return $query;
	}
	public function getProductionUnit()
	{
		$this->db->where('pu_status', 1);
		$query = $this->db->get('production_unit');
		return $query;
	}
	public function getProductionUnitById($pu_id)
	{
		$this->db->where('pu_id', $pu_id);
		$query = $this->db->get('production_unit');
		return $query->row();
	}
	public function updateProductionUnit($pu_id, $data)
	{
		$this->db->where('pu_id', $pu_id);
		$this->db->update('production_unit', $data);
	}
}
