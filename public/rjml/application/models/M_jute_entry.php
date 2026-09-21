<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_jute_entry extends CI_model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Entry
	public function insertJuteEntry($data)
	{
		$this->db->insert('jute_entry', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getJuteEntry()
	{
		$this->db->order_by("en_id", "desc");
		$this->db->where('en_status', 1);
		$query = $this->db->get('jute_entry');
		return $query;
	}

	public function getJuteEntryByLimit($limit, $offset, $search = '')
	{
		if ($search != '') {
			$this->db->like('en_lot_no', $search);
			$multipleData = array(
				'en_chalan_no' =>  $search,
				'en_jute_variety' =>  $search,
				'en_truck_no' =>  $search,
				's_title' =>  $search,
				'mo_title' =>  $search,
				'en_td_name' =>  $search,
				'en_bojha_bale' =>  $search,
				'en_net_mds' =>  $search,
			);
			$this->db->or_like($multipleData);
		}
		$this->db->select('*');
		$this->db->from('jute_entry');
		$this->db->join('supplier', 'supplier.s_id = jute_entry.en_s_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_entry.en_mo_id', 'left');
		$this->db->join('area', 'area.ar_id = jute_entry.en_mo_id', 'left');

		$this->db->order_by("en_id", "desc");
		$this->db->where('en_status', 1);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	public function get_count($search = '')
	{
		if ($search != '') {
			$this->db->like('en_lot_no', $search);
			$multipleData = array(
				'en_chalan_no' =>  $search,
				'en_jute_variety' =>  $search,
				'en_truck_no' =>  $search,
				's_title' =>  $search,
				'mo_title' =>  $search,
				'en_td_name' =>  $search,
				'en_bojha_bale' =>  $search,
				'en_net_mds' =>  $search,
			);
			$this->db->or_like($multipleData);
		}
		$this->db->select('*');
		$this->db->from('jute_entry');
		$this->db->join('supplier', 'supplier.s_id = jute_entry.en_s_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_entry.en_mo_id', 'left');
		$this->db->join('area', 'area.ar_id = jute_entry.en_mo_id', 'left');

		$this->db->where('en_status', 1);
		$query = $this->db->count_all_results();
		return $query;
	}


	public function getJuteEntryCount()
	{
		$this->db->where('en_status', 1);
		$this->db->get('jute_entry');
		if ($this->db->affected_rows() > 0) {
			return $this->db->affected_rows();
		} else {
			return 0;
		}
	}
	public function getJuteEntryById($en_id)
	{
		$this->db->where('en_id', $en_id);
		$query = $this->db->get('jute_entry');
		return $query->row();
	}

	public function getLotNumberCount($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_entry');
		if ($this->db->affected_rows() > 0) {
			return $this->db->affected_rows();
		} else {
			return 0;
		}
	}

	public function updateJuteEntryTable($id, $data)
	{
		$this->db->where('en_id', $id);
		$this->db->update('jute_entry', $data);
	}


	/* ===================== Return jute ===================== */
	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getJuteReturnInfo()
	{
		$this->db->order_by("jri_id", "desc");
		// $this->db->where('jri_status', 1);
		$query = $this->db->get('jute_return_info');
		return $query;
	}

	public function getJuteReturnInfoById($jri_id)
	{
		$this->db->where('jri_id', $jri_id);
		$query = $this->db->get('jute_return_info');
		return $query->row();
	}

	public function approveJuteReturnInfo($jri_id, $data)
	{
		$this->db->where('jri_id', $jri_id);
		$this->db->update('jute_return_info', $data);
	}



	/* ===================== Out Turn ===================== */
	public function insertOutTurnSummary($outTurnSummaryData)
	{
		$this->db->insert('out_turn_summary', $outTurnSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function insertOutTurnPer($outTurnPerData)
	{
		$this->db->insert('out_turn_percentage', $outTurnPerData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function insertJutePurchaseInvoiceSummaryData($jutePurchaseInvoiceSummaryData)
	{
		$this->db->insert('jute_purchase_invoice_summary', $jutePurchaseInvoiceSummaryData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function insertJutePurchaseInvoiceValueData($jutePurchaseInvoiceValueData)
	{
		$this->db->insert('jute_purchase_invoice_value', $jutePurchaseInvoiceValueData);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	//get Entry date
	public function getEntryInfoByEnID($id)
	{
		$this->db->where('en_id', $id);
		$query = $this->db->get('jute_entry');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	//get Entry date
	public function getEntryInfoByFyAndLot($ot_fy_id, $ot_lot_no)
	{
		$this->db->where('en_status', 1);
		$this->db->where('en_fy_id', $ot_fy_id);
		$this->db->where('en_lot_no', $ot_lot_no);
		$query = $this->db->get('jute_entry');
		return $query->row();
	}

	//get jute_rate_summary date
	public function getJuteRateSummaryByEntryDate($entryDate)
	{
		$this->db->where('jrs_status', 1);
		$this->db->where('jrs_start_date<=', $entryDate);
		$this->db->where('jrs_end_date>=', $entryDate);
		$query = $this->db->get('jute_rate_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	//get jute_rate_summary date
	public function getJuteRateById($jute_rate_summary_table_id)
	{
		$this->db->where('jr_jrs_id', $jute_rate_summary_table_id);
		$query = $this->db->get('jute_rate');
		return $query->result();
	}

	//get jute_rate_summary date
	public function getJuteMoistureById($jute_rate_summary_table_id)
	{
		$this->db->where('jr_m_jrs_id', $jute_rate_summary_table_id);
		$query = $this->db->get('jute_rate_moisture');
		return $query->result();
	}

	//get jute_rate_smr date
	public function getJuteSmrById($jute_rate_summary_table_id)
	{
		$this->db->where('jr_smr_jrs_id', $jute_rate_summary_table_id);
		$query = $this->db->get('jute_rate_smr');
		return $query->result();
	}

	//for normal invoice and contract invoier
	public function getJuteRate($jute_rate_summary_table_id, $ot_ar_id, $gradeId)
	{
		$this->db->where('jr_jrs_id', $jute_rate_summary_table_id);
		$this->db->where('jr_ar_id', $ot_ar_id);
		$this->db->where('jr_j_g_id', $gradeId);
		$query = $this->db->get('jute_rate');
		if ($this->db->affected_rows() > 0) {
			//return $query->row() //aga silo
			return $query->row()->jr_rate; //pora disi
		} else {
			return 0;
		}
	}

	public function getJuteOutTurnSummary()
	{
		$this->db->order_by("ot_id", "desc");
		$this->db->where('ot_status', 1);
		$query = $this->db->get('out_turn_summary');
		return $query;
	}

	public function getMonthlyJuteOutTurnSummary($m, $y)
	{
		$query = $this->db->query("SELECT  * FROM out_turn_summary
		WHERE ot_status = 1
		AND ot_en_date > DATE_SUB('$y-$m-01 17:00:00', INTERVAL 1 DAY)   
		AND ot_en_date <= CONCAT(LAST_DAY('$y-$m-01'), ' 17:00:00') 
		ORDER BY ot_id  desc");
		return $query;
	}

	public function getPurchaseApproveJuteOutTurnSummaryByLimit($limit, $offset, $search = '')
	{
		if ($search != '') {
			$this->db->like('ot_lot_no', $search);
			$multipleData = array(
				's_title' =>  $search,
				'mo_title' =>  $search,
				'ar_title' =>  $search,
			);
			$this->db->or_like($multipleData);
		}
		$this->db->select('*');
		$this->db->from('out_turn_summary');
		$this->db->join('supplier', 'supplier.s_id = out_turn_summary.ot_en_s_id');
		$this->db->join('mokam', 'mokam.mo_id = out_turn_summary.ot_en_mo_id', 'left');
		$this->db->join('area', 'area.ar_id = out_turn_summary.ot_ar_id', 'left');

		$this->db->order_by("ot_id", "asc");
		$this->db->where('ot_status', 1);
		$this->db->where('ot_jpis_approve_status', 1);
		$this->db->where('ot_khamal_status', 0);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	public function get_out_turn_count($search = '')
	{
		if ($search != '') {
			$this->db->like('ot_lot_no', $search);
			$multipleData = array(
				's_title' =>  $search,
				'mo_title' =>  $search,
				'ar_title' =>  $search,
			);
			$this->db->or_like($multipleData);
		}
		$this->db->select('*');
		$this->db->from('out_turn_summary');
		$this->db->join('supplier', 'supplier.s_id = out_turn_summary.ot_en_s_id');
		$this->db->join('mokam', 'mokam.mo_id = out_turn_summary.ot_en_mo_id', 'left');
		$this->db->join('area', 'area.ar_id = out_turn_summary.ot_ar_id', 'left');

		$this->db->where('ot_status', 1);
		$this->db->where('ot_jpis_approve_status', 1);
		$this->db->where('ot_khamal_status', 0);
		$query = $this->db->count_all_results();
		return $query;
	}


	// public function getPurchaseApproveJuteOutTurnSummary()
	// {
	// 	$this->db->order_by("ot_id", "desc");
	// 	$this->db->where('ot_status', 1);
	// 	$this->db->where('ot_jpis_approve_status', 1);
	// 	$query = $this->db->get('out_turn_summary');
	// 	return $query;
	// }

	public function getJuteOutTurnSummaryById($id)
	{
		$this->db->where('ot_id', $id);
		$query = $this->db->get('out_turn_summary');
		return $query->row();
	}

	// function for jute_helper.php
	public function getSingleOutTurn($data)
	{
		$this->db->where($data);
		$query = $this->db->get('out_turn_percentage');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->otp_percentage;
		} else {
			return 0;
		}
	}
	public function getSingleOutTurnPerId($data)
	{
		$this->db->where($data);
		$query = $this->db->get('out_turn_percentage');
		if ($this->db->affected_rows() > 0) {
			return $query->row()->otp_id;
		} else {
			return 0;
		}
	}

	public function getSmrRate($smr_rate, $jute_rate_summary_table_id)
	{
		$resultFinal = 0;
		$this->db->where('jr_smr_jrs_id', $jute_rate_summary_table_id);
		$query = $this->db->get('jute_rate_smr');

		if ($query) {

			foreach ($query->result() as $smrRate) {
				$res = smrRateGenarete($smrRate->jr_smr_rate, $smrRate->jr_smr_logic_from, $smrRate->jr_smr_logic_till, $smrRate->jr_smr_per_from, $smrRate->jr_smr_per_till, $smr_rate);

				if ($res == 0) {
				} else {
					$resultFinal = $res;
				}
			}
		} else {
			echo 'No Data';
		}
		return $resultFinal;
	}

	public function getInvoiceSummary()
	{
		$this->db->order_by("jpis_id", "desc");
		$this->db->where('jpis_status', 1);
		$query = $this->db->get('jute_purchase_invoice_summary');
		return $query;
	}

	public function getInvoiceSummaryById($jpis_id)
	{
		$this->db->where('jpis_id', $jpis_id);
		$query = $this->db->get('jute_purchase_invoice_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}

	// function from jute_helper.php
	public function getInvoiceValue($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_purchase_invoice_value');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}


	public function approveInvoiceStatus($jpis_id, $data)
	{
		$this->db->where('jpis_id', $jpis_id);
		$this->db->update('jute_purchase_invoice_summary', $data);
	}

	// function from jute_helper.php
	public function getSupplierPayableAmount($data)
	{
		$this->db->where($data);
		$query = $this->db->get('jute_purchase_invoice_summary');
		//return $query;
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return 0;
		}
	}

	public function jute_rate_moisture($jute_rate_summary_table_id, $ot_ar_id)
	{
		$this->db->where('jr_m_jrs_id', $jute_rate_summary_table_id);
		$this->db->where('jr_m_ar_id', $ot_ar_id);
		$query = $this->db->get('jute_rate_moisture');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}

	//For Contract Jut rate data submission
	public function getJutePurchaseInvoiceSummaryTableId($ot_fy_id, $ot_lot_no)
	{
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_fy_id', $ot_fy_id);
		$this->db->where('jpis_ot_lot_no', $ot_lot_no);
		$query = $this->db->get('jute_purchase_invoice_summary');
		return $query->row();
	}

	public function updateJutePurchaseInvoiceSummaryTable($jute_purchase_invoice_summary_table_id, $data)
	{
		$this->db->where('jpis_id', $jute_purchase_invoice_summary_table_id);
		$this->db->update('jute_purchase_invoice_summary', $data);
	}

	//update data on Out turn Summary Table
	public function updateOtBillType($ot_id, $data)
	{
		$this->db->where('ot_id', $ot_id);
		$this->db->update('out_turn_summary', $data);
	}

	//update data on Out turn Summary Table
	public function updateWithCondition($ot_id, $data)
	{
		$this->db->where('ot_id', $ot_id);
		$this->db->update('out_turn_summary', $data);
	}

	public function get_data_with_limit_order_by_for_last_number($table, $limit, $orderNmae, $oderType, $where)
	{
		$this->db->limit($limit);
		$this->db->where($where);
		$this->db->order_by($orderNmae, $oderType);
		$query = $this->db->get($table);
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}


	public function ajaxSuplierPartyChalan($conditions)
	{
		$this->db->order_by("en_id", "desc");
		$this->db->where($conditions);
		$query = $this->db->get('jute_entry');
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return 0;
		}
	}

	public function ajaxMillLotNoCheckForEntry($conditions)
	{
		$this->db->where($conditions);
		$this->db->get('jute_entry');
		return $this->db->affected_rows();
	}

	// get result by condition
	public function get_data_multi_conditional($table, $data)
	{
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query;
	}

	//get financial Year id
	public function ajaxFinancialYear($enDate)
	{
		$this->db->where('fy_status', 1);
		$this->db->where('fy_start_date <=', $enDate);
		$this->db->where('fy_end_date >=', $enDate);
		$query = $this->db->get('financial_year');
		return $query->row();
	}

	//get last lot no ro show in add entry page
	public function getAjaxLastLotNo($conditions)
	{
		$this->db->order_by("en_id", "desc");
		$this->db->where($conditions);
		$query = $this->db->get('jute_entry');
		if ($this->db->affected_rows() > 0) {
			return $query;
		} else {
			return 0;
		}
	}


	//Month check for Jute Calculation Helper
	public function ajaxFindMonthlyJuteCalculationHelperCheck($date)
	{
		$this->db->where('jch_status', 1);
		$this->db->where('jch_start_date <=', $date);
		$this->db->where('jch_end_date >=', $date);
		$query = $this->db->get('jute_calculation_helper');
		return $query->row();
	}

	//Jute Rate Check
	public function ajaxFindJuteRateByDate($date)
	{
		$this->db->where('jrs_status', 1);
		$this->db->where('jrs_start_date <=', $date);
		$this->db->where('jrs_end_date >=', $date);
		$query = $this->db->get('jute_rate_summary');
		return $query->row();
	}


	// Last Serial
	public function getLastJutePurchaseInvoiceSerialNumber()
	{
		$this->db->where("jpis_status", 1);
		$this->db->limit(1);
		$this->db->order_by("jpis_id", "desc");
		$query = $this->db->get('jute_purchase_invoice_summary');
		return $query->row();
	}


	//Murad 24.09.2022 to Show Mds. After Moisture deduction in out turn report list page
	public function getPurchaseInvoiceSummaryByOutTurnId($id)
	{
		$this->db->where("jpis_status", 1);
		$this->db->where("jpis_ot_id", $id);
		$query = $this->db->get('jute_purchase_invoice_summary');
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return 0;
		}
	}

	public function getChalanJuteEntry()
	{
		$query = $this->db->query('SELECT en_s_id, COUNT(en_s_id) AS COUNT_id FROM jute_entry where en_status = 1 GROUP BY en_s_id');
		return $query;
	}






	//End
}
