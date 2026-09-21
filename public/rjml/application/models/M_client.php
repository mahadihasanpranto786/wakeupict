<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_client extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertClientType($data)
	{
		$this->db->insert('client_type', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getClientType()
	{
		$this->db->order_by('ct_id', 'DESC');
		$this->db->where('ct_status', 1);
		$query = $this->db->get('client_type');
		return $query;
	}


	public function getClientTypeById($ct_id)
	{
		$this->db->where('ct_id', $ct_id);
		$query = $this->db->get('client_type');
		return $query->row();
	}

	public function updateClientType($ct_id, $data)
	{
		$this->db->where('ct_id', $ct_id);
		$this->db->update('client_type', $data);
	}

	/* ================== Client Info ================== */
	public function insertClient($data)
	{
		$this->db->insert('client', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	public function getClient()
	{
		$this->db->order_by('c_id', 'DESC');
		$this->db->where('c_status', 1);
		$query = $this->db->get('client');
		return $query;
	}

	public function getClientById($c_id)
	{
		$this->db->where('c_id', $c_id);
		$query = $this->db->get('client');
		return $query->row();
	}

	public function updateClient($c_id, $data)
	{
		$this->db->where('c_id', $c_id);
		$this->db->update('client', $data);
	}


	/* ================== Client Payment ================== */
	public function insertClientPayment($data)
	{
		$this->db->insert('client_payment', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	public function getClientPayment()
	{
		$this->db->where('cp_status', 1);
		$query = $this->db->get('client_payment');
		return $query;
	}

	public function getClientPaymentById($cp_id)
	{
		$this->db->where('cp_id', $cp_id);
		$query = $this->db->get('client_payment');
		return $query->row();
	}

	public function getClientPaymentByClientId($client_id)
	{
		$this->db->where('cp_status', 1);
		$this->db->where('cp_c_id', $client_id);
		$query = $this->db->get('client_payment');
		return $query;
	}

	public function updateClientPayment($cp_id, $data)
	{
		$this->db->where('cp_id', $cp_id);
		$this->db->update('client_payment', $data);
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


	/* ================== Jute Sell ================== */
	public function insertJuteSell($ValueData, $SummaryData)
	{
		$this->db->insert($ValueData, $SummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getJuteSell()
	{
		$this->db->order_by('jss_id', 'DESC');
		$this->db->where('jss_status', 1);
		$query = $this->db->get('jute_sell_summary');
		return $query;
	}
	public function getJuteSellForTotalQuantity()
	{
		$this->db->where('jss_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_summary');
		return $query;
	}

	public function getJuteSellById($jss_id)
	{
		$this->db->where('jss_id', $jss_id);
		$query = $this->db->get('jute_sell_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}

	// Get Single Value by jute_helper
	public function getSingleJuteSellWeightValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_sell_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->jsv_weight;
		} else {
			return 0;
		}
	}
	// Get Single Value by jute_helper
	public function getSingleJuteSellRateValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_sell_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->jsv_rate;
		} else {
			return 0;
		}
	}
	// Get Single Value by jute_helper
	public function getSingleJuteSellAmountValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_sell_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->jsv_amount;
		} else {
			return 0;
		}
	}
	// Get Single ID by jute_helper
	public function getSingleJuteSellValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_sell_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->jsv_id;
		} else {
			return 0;
		}
	}

	//Update
	public function updateJuteSellSummary($jss_id, $data)
	{
		$this->db->where('jss_id', $jss_id);
		$this->db->update('jute_sell_summary', $data);
	}

	//Get Jute sell by client Id
	public function getJuteSellSummaryByClientId($client_id)
	{
		$this->db->where('jss_status', 1);
		$this->db->where('jss_c_id', $client_id);
		$query = $this->db->get('jute_sell_summary');
		return $query;
	}
	public function getJuteSellSummaryByClientIdAfterApproved($client_id)
	{
		$this->db->where('jss_status', 1);
		$this->db->where('jss_approve_status', 1);
		$this->db->where('jss_c_id', $client_id);
		$query = $this->db->get('jute_sell_summary');
		return $query;
	}




	// Sum
	public function sumJuteSell($columnName, $id, $grade_id)
	{
		$this->db->select('SUM(' . $columnName . ') AS total_cost');
		$this->db->where('jsv_jss_id', $id);
		$this->db->where('jsv_j_g_id', $grade_id);
		$query = $this->db->get('jute_sell_value')->row();
		return $query->total_cost;
	}



	public function getClientWiseTotalMds()
	{
		$query = $this->db->query("SELECT SUM(jss_total_weight) AS total FROM jute_sell_summary WHERE jss_status = 1 AND jss_approve_status = 1");
		return $query->row()->total;
	}

	public function getClientTotalBillCount($client_id)
	{
		$query = $this->db->query("SELECT COUNT(jss_id) AS total FROM jute_sell_summary  WHERE jss_c_id = '$client_id' AND jss_status = 1 AND jss_approve_status = 1");
		return $query->row()->total;
	}





	// End
}
