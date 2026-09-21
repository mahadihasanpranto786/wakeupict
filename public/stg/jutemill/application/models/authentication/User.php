<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model
{

	public function user_validation($table, $data)
	{
		$query = $this->db->where($data)
			->get($table)->row();
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return FALSE;
		}
	}

	public function user_info($authId)
	{
		$this->db->join('authority_branch', 'authority_branch.ab_a_id = authority.a_id');
		$this->db->join('branch', 'branch.b_id = authority_branch.ab_b_id');
		$this->db->join('employee', 'employee.e_a_id = authority.a_id');
		$this->db->join('designation', 'designation.des_id = employee.e_designation_id');
		$this->db->join('department', 'department.d_id = employee.e_department_id');
		$this->db->where('a_id', $authId);
		$query = $this->db->get('authority');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}
	public function update_user_info($table, $a_id, $authId, $data)
	{
		$this->db->join('employee', 'employee.e_a_id = authority.a_id');
		$this->db->where($a_id, $authId);
		$this->db->update($table, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
