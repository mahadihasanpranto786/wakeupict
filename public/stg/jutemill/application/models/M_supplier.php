<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_supplier extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Function for supplier Type
	public function insertSupplierType($data)
	{
		$this->db->insert('supplier_type', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getSupplierType()
	{
		$this->db->where('sup_t_status', 1);
		$query = $this->db->get('supplier_type');
		return $query;
	}

	public function getSupplierTypeById($sup_t_id)
	{
		$this->db->where('sup_t_id', $sup_t_id);
		$query = $this->db->get('supplier_type');
		return $query->row();
	}

	public function updateSupplierType($sup_t_id, $data)
	{
		$this->db->where('sup_t_id', $sup_t_id);
		$this->db->update('supplier_type', $data);
	}

	// Functions for Supplier
	public function insertSupplier($data)
	{
		$this->db->insert('supplier', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getSupplier()
	{
		$this->db->order_by('s_id', 'DESC');
		$this->db->where('s_status', 1);
		$query = $this->db->get('supplier');
		return $query;
	}

	public function getSupplierById($s_id)
	{
		$this->db->where('s_id', $s_id);
		$query = $this->db->get('supplier');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function updateSupplier($s_id, $data)
	{
		$this->db->where('s_id', $s_id);
		$this->db->update('supplier', $data);
	}

	public function getSupplierbySupplierType($sup_t_id)
	{
		$this->db->order_by('s_id', 'DESC');
		$this->db->where('s_sup_t_id', $sup_t_id);
		$query = $this->db->get('supplier');
		return $query;
	}

	/* ===================== Supplier Payment ===================== */
	public function insertSupplierPayment($data)
	{
		$this->db->insert('supplier_payment', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	public function getSupplierPayment()
	{
		$this->db->order_by("sp_date", "desc");
		$this->db->where('sp_status', 1);
		$query = $this->db->get('supplier_payment');
		return $query;
	}
	// grand total
	public function getSupplierPaymentGrandTotal()
	{
		$this->db->select('sp_date');
		$this->db->select_sum('sp_amount');
		$this->db->group_by("sp_date", "desc");
		$this->db->order_by("sp_date", "asc");
		$this->db->where('sp_status', 1);
		$query = $this->db->get('supplier_payment');
		return $query;
	}

	public function getSupplierPaymentById($sp_id)
	{
		$this->db->where('sp_id', $sp_id);
		$query = $this->db->get('supplier_payment');
		return $query->row();
	}

	public function getSupplierPaymentBySupplierId($supplier_id)
	{
		$this->db->where('sp_status', 1);
		$this->db->where('sp_s_id', $supplier_id);
		$query = $this->db->get('supplier_payment');
		return $query;
	}

	public function updateSupplierPayment($sp_id, $data)
	{
		$this->db->where('sp_id', $sp_id);
		$this->db->update('supplier_payment', $data);
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


	// Get Total Due Balance
	public function getTotalDueBalance()
	{
		$query = $this->db->query('SELECT SUM(s_due) as total FROM supplier WHERE s_status = 1');
		return $query->row();
	}

	// Get Total Due Balance
	public function getDueSupplierQuantity()
	{
		$query = $this->db->query('SELECT COUNT(s_id) as dueSupplierQuantity FROM supplier WHERE s_status = 1 AND s_due > 0');
		return $query->row();
	}





	/* ====================== Supplier Analysis ====================== */
	public function findTheGoodSupplier($supplier_id, $grade_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');

		$this->db->select('SUM(jpiv_weight_mds) AS total');
		$this->db->where('jpis_ot_en_s_id', $supplier_id);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->row()->total;
	}

	public function findTheGoodSupplierKfWh($supplier_id, $grade_id, $ar_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");
		$this->db->select('SUM(jpiv_weight_mds) AS total_purchase');
		$this->db->where('jpis_ot_en_s_id', $supplier_id);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->row()->total_purchase;
	}


	// public function findTheGoodSupplierTotalPercentage($supplier_id)
	// {
	// 	$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');

	// 	$this->db->select('SUM(jpiv_weight_mds) AS total');
	// 	$this->db->where('jpis_ot_en_s_id', $supplier_id);
	// 	$this->db->where('jpiv_status', 1);
	// 	$this->db->where('jpis_status', 1);
	// 	$this->db->where('jpis_approve_status', 1);
	// 	$query = $this->db->get('jute_purchase_invoice_value');
	// 	return $query->row()->total;
	// }

	public function findTheGoodSupplierTotalPercentage($supplier_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE jpis_ot_en_s_id = '$supplier_id' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}

	public function findTheGoodSupplierTotalMds($supplier_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE jpis_ot_en_s_id = '$supplier_id' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}

	// For  Total
	public function getGrandTotalMds($supplier_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE jpis_ot_en_s_id = '$supplier_id' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}
	public function getSupplierWiseTotalMds()
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}
	// For  Total



	public function findTheGoodSupplierTotalBillCount($supplier_id)
	{
		$query = $this->db->query("SELECT COUNT(jpis_ot_en_s_id) AS total FROM jute_purchase_invoice_summary  WHERE jpis_ot_en_s_id = '$supplier_id' AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}



	// Another Analysis
	public function getTotalJutePurchaseMdsGradeWiseForSupplierAnalysis($grade_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE jpiv_j_g_id = '$grade_id' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}

	public function getTotalJutePurchaseMdsGradeWiseForSupplierAnalysisKFWH($grade_id, $ar_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");
		$this->db->select('SUM(jpiv_weight_mds) AS total_purchase');
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->row()->total_purchase;
	}

	public function getTotalJutePurchaseMdsGrandTotalForSupplierAnalysis()
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS grand_total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->grand_total;
	}




	public function getTotalJutePurchaseMdsKfWhForSupplierAnalysis($grade_id, $ar_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");
		$this->db->select('SUM(jpiv_weight_mds) AS total_purchase');
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->row()->total_purchase;
	}


	//Multi Payment Section
	public function juteSupplierPaymentByDate($sp_date)
	{
		$this->db->where('sp_status', 1);
		$this->db->where('sp_date', $sp_date);
		$query = $this->db->get('supplier_payment');
		return $query;
	}









	//End
}
