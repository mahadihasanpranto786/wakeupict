<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_test extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function test($smr_rate)
	{
		$this->db->where('jr_smr_jrs_id', '7');
		$this->db->where('jr_smr_per>', $smr_rate);
		$query = $this->db->get('jute_rate_smr');
		return $query->row()->jr_smr_rate;
	}
	public function beta($smr_rate)
	{
		$this->db->where('jrs_start_date<=', $smr_rate);
		$this->db->where('jrs_end_date>=', $smr_rate);
		$query = $this->db->get('jute_rate_summary');
		return $query;
	}
	public function test_one($codintion)
	{
		$this->db->select('SUM(kh_ua_a_v_value) as totalsum');
		$this->db->join('khamal_unassorted_added_summary', 'khamal_unassorted_added_summary.kh_ua_a_s_id = khamal_unassorted_added_value.kh_ua_a_v_s_id');
		$this->db->where($codintion);
		$query = $this->db->get('khamal_unassorted_added_value');
		return $query->result()[0]->totalsum;
	}
	public function test_two($codintion)
	{
		$this->db->select('SUM(kh_ua_d_v_value) as totalsum');
		$this->db->join('khamal_unassorted_deduction_summary', 'khamal_unassorted_deduction_summary.kh_ua_d_s_id = khamal_unassorted_deduction_value.kh_ua_d_v_s_id');
		$this->db->where($codintion);
		$query = $this->db->get('khamal_unassorted_deduction_value');
		return $query->result()[0]->totalsum;
	}

	public function test_three($codintion)
	{
		$this->db->select('SUM(kh_ua_a_v_value) as totalsum');
		$this->db->join('khamal_assorted_uncut_added_summary', 'khamal_assorted_uncut_added_summary.kh_auc_a_s_id = khamal_assorted_uncut_added_value.kh_auc_a_v_s_id');
		$this->db->where($codintion);
		$query = $this->db->get('khamal_assorted_uncut_added_value');
		return $query->result()[0]->totalsum;
	}
	public function test_four($codintion)
	{
		$this->db->select('SUM(kh_ua_d_v_value) as totalsum');
		$this->db->join('khamal_assorted_uncut_deduction_summary', 'khamal_assorted_uncut_deduction_summary.kh_auc_d_s_id = khamal_assorted_cut_deduction_value.kh_ac_d_v_s_id');
		$this->db->where($codintion);
		$query = $this->db->get('khamal_assorted_cut_deduction_value');
		return $query->result()[0]->totalsum;
	}
}
