<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_user_control extends CI_model
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

	public function get_data($table)
	{
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return false;
		}
	}

	public function get_data_multi_conditional($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query;
	}

	// It's for same column multiple condition 
	public function get_data_multi_conditional_where_in($table, $data, $whereInIndex, $whereInCondition)
	{
		$this->db->where($data);
		$this->db->where_in($whereInIndex, $whereInCondition, FALSE);
		$query = $this->db->get($table);
		return $query;
	}

	public function get_data_multi_conditional_distinct($table, $data, $distinct)
	{
		$this->db->where($data);
		$this->db->distinct();
		$this->db->select($distinct);
		$query = $this->db->get($table);
		return $query;
	}

	public function update_data($table, $index, $identifier, $data)
	{
		$this->db->where($index, $identifier);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function getJutePurchaseInvoiceApprovalData($table, $data, $orderByColumn, $orderBy)
	{
		$this->db->order_by($orderByColumn, $orderBy);
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query;
	}


	// End
}
