<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_department extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Category
	public function insertDepartment($data)
	{
		$this->db->insert('department', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getDepartment()
	{
		$this->db->where('d_status', 1);
		$query = $this->db->get('department');
		return $query;
	}

	public function getDepartmentById($d_id)
	{
		$this->db->where('d_id', $d_id);
		$query = $this->db->get('department');
		return $query->row();
	}

	public function updateDepartment($d_id, $data)
	{
		$this->db->where('d_id', $d_id);
		$this->db->update('department', $data);
	}
	/* ===================== Sub Department ===================== */
	//Sub Department
	public function insertSubDepartment($data)
	{
		$this->db->insert('sub_department', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getSubDepartment()
	{
		$this->db->where('sd_status', 1);
		$query = $this->db->get('sub_department');
		return $query;
	}

	public function getSubDepartmentById($sd_id)
	{
		$this->db->where('sd_id', $sd_id);
		$query = $this->db->get('sub_department');
		return $query->row();
	}

	public function updateSubDepartment($sd_id, $data)
	{
		$this->db->where('sd_id', $sd_id);
		$this->db->update('sub_department', $data);
	}
}
