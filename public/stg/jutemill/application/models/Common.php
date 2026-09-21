<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Common extends CI_Model
{

	public function set_data($table, $data)
	{
		$this->db->trans_start();
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			$error = $this->db->error();
			return $error;
		} else {
			return $returnValue;
		}
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
	public function get_data_with_limit($table, $limit)
	{
		$this->db->limit($limit);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return false;
		}
	}
	public function get_data_with_limit_order_by($table, $limit, $orderNmae, $oderType)
	{
		$this->db->limit($limit);
		$this->db->order_by($orderNmae, $oderType);
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
	public function get_data_single_conditional($table, $index, $data)
	{
		$this->db->where($index, $data);
		$query = $this->db->get($table);
		return $query;
	}
	public function get_single_row_information($table, $index, $data)
	{
		$this->db->where($index, $data);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function get_single_row_information_multi_conditional($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function delete_data($table, $index, $data)
	{
		$this->db->where($index, $data);
		$this->db->delete($table);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function update_data_multi_conditional($table, $condition, $data)
	{
		$this->db->where($condition);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
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
	public function count_data($table, $index, $data)
	{
		$this->db->where($index, $data);
		$this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $this->db->affected_rows();
		} else {
			return 0;
		}
	}

	public function sql_excute($sql)
	{
		$query = $this->db->query($sql);
		return $query;
	}

	//By Murad
	public function single_sql_excute($sql)
	{
		$query = $this->db->query($sql);
		return $query->row();
	}

	// Rimon
	public function count_all_result($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->count_all_results($table);
		return $query;
	}
	public function get_single_row_information_multi_conditional_max_value($table, $data, $max)
	{
		$this->db->where($data);
		$this->db->select_max($max);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
}
