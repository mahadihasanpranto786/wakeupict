<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_purchase extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getInvoiceSummary()
	{
		$this->db->order_by("jpis_id", "desc");
		$this->db->where('jpis_status', 1);
		$query = $this->db->get('jute_purchase_invoice_summary');
		return $query;
	}

	//for supplier ledger 
	public function getPurchaseSummaryBySupplierId($supplier_id)
	{
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);  // Approved purchases only
		$this->db->where('jpis_ot_en_s_id', $supplier_id);
		$query = $this->db->get('jute_purchase_invoice_summary');
		return $query;
	}




	/* ====================== Purchase Order ====================== */

	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getPurchaseOrder()
	{
		$this->db->where('jpos_status', 1);
		$query = $this->db->get('jute_purchase_order_summary');
		return $query;
	}

	public function getPurchaseOrderById($id)
	{
		$this->db->where('jpos_status', 1);
		$this->db->where('jpos_id', $id);
		$query = $this->db->get('jute_purchase_order_summary');
		return $query->row();
	}

	public function updateJutePurchaseOrderSummary($id, $data)
	{
		$this->db->where('jpos_id', $id);
		$this->db->update('jute_purchase_order_summary', $data);
	}

	public function getJutePurchaseOrderValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_purchase_order_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->jpov_mds_value;
		} else {
			return 0;
		}
	}

	public function getJutePurchaseOrderValueId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_purchase_order_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->jpov_id;
		} else {
			return 0;
		}
	}




	// end
}
