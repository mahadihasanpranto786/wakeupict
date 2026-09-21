<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_jute_report extends CI_model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	/* ============================== Jute Purchase ============================== */
	// Monthly Total Jute Purchase Mds
	public function getMonthlyTotalJutePurchaseMds($year, $month, $grade_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->select('SUM(jpiv_weight_mds) AS total_purchase');
		$this->db->where('YEAR(jpis_ot_en_date) =', $year);
		$this->db->where('MONTH(jpis_ot_en_date) =', $month);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total_purchase;
	}

	// public function getMonthlyTotalJutePurchaseMds($year, $month, $grade_id)
	public function getMonthlyTotalJutePurchaseMdsKFWH($year, $month, $grade_id, $ar_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");
		$this->db->select('SUM(jpiv_weight_mds) AS total_purchase');
		$this->db->where('YEAR(jpis_ot_en_date) =', $year);
		$this->db->where('MONTH(jpis_ot_en_date) =', $month);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total_purchase;
	}

	public function exampleQuery($startYear, $endYear, $grade_id, $ar_id)
	{
		$arrayYear = array($startYear, $endYear);
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");
		$this->db->select('SUM(jpiv_weight_mds) AS total');
		$this->db->where_in('YEAR(jpis_ot_en_date)', $arrayYear);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_statuss', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->row()->total;
	}

	public function getMonthlyTotalJutePurchaseMdsTotalKFWH($startYear, $endYear, $grade_id, $ar_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id JOIN mokam ON mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id JOIN area ON mokam.mo_ar_id = area.ar_id WHERE YEAR(jpis_ot_en_date) IN('$startYear', '$endYear') AND jpiv_j_g_id = $grade_id AND mo_ar_id = $ar_id AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}



	// Monthly Total Jute Issue Mds
	public function getMonthlyTotalJutePurchaseMdsGradeWise($startYear, $endYear, $grade_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE YEAR(jpis_ot_en_date) IN('$startYear', '$endYear') AND jpiv_j_g_id = '$grade_id' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}

	public function getMonthlyTotalJutePurchaseMdsMonthWise($year, $month)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE YEAR(jpis_ot_en_date) = '$year' AND MONTH(jpis_ot_en_date) ='$month' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}

	// Monthly Total GRand Total 
	public function getMonthlyTotalJutePurchaseMdsGrandTotal($startYear, $endYear)
	{
		$query = $this->db->query("SELECT SUM(jpiv_weight_mds) AS grand_total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE YEAR(jpis_ot_en_date) IN('$startYear', '$endYear') AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->grand_total;
	}



	// Monthly Total Jute Purchase Amount
	public function getMonthlyTotalJutePurchaseAmount($year, $month, $grade_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->select('SUM(jpiv_amount) AS total_purchase');
		$this->db->where('YEAR(jpis_ot_en_date) =', $year);
		$this->db->where('MONTH(jpis_ot_en_date) =', $month);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total_purchase;
	}

	public function getMonthlyTotalJutePurchaseAmountKFWH($year, $month, $grade_id, $ar_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");
		$this->db->select('SUM(jpiv_amount) AS total_purchase');
		$this->db->where('YEAR(jpis_ot_en_date) =', $year);
		$this->db->where('MONTH(jpis_ot_en_date) =', $month);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total_purchase;
	}

	public function getMonthlyTotalJutePurchaseAmountTotalKFWH($startYear, $endYear, $grade_id, $ar_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_amount) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id JOIN mokam ON mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id JOIN area ON mokam.mo_ar_id = area.ar_id WHERE YEAR(jpis_ot_en_date) IN('$startYear', '$endYear') AND jpiv_j_g_id = $grade_id AND mo_ar_id = $ar_id AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}






	// Monthly Total Jute Issue Mds
	public function getMonthlyTotalJutePurchaseAmountTakaGradeWise($startYear, $endYear, $grade_id)
	{
		$query = $this->db->query("SELECT SUM(jpiv_amount) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE YEAR(jpis_ot_en_date) IN('$startYear', '$endYear') AND jpiv_j_g_id = '$grade_id' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}

	public function getMonthlyTotalJutePurchaseAmountTakaMonthWise($year, $month)
	{
		$query = $this->db->query("SELECT SUM(jpiv_amount) AS total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE YEAR(jpis_ot_en_date) = '$year' AND MONTH(jpis_ot_en_date) ='$month' AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->total;
	}

	// Monthly Total GRand Total 
	public function getMonthlyTotalJutePurchaseAmountTakaGrandTotal($startYear, $endYear)
	{
		$query = $this->db->query("SELECT SUM(jpiv_amount) AS grand_total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE YEAR(jpis_ot_en_date) IN('$startYear', '$endYear') AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->grand_total;
	}



	// Monthly Total Jute Purchase Out Turn Percentage %
	public function getMonthlyTotalJutePurchaseOutTurnPercentage($year, $month, $grade_id)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->select('SUM(jpiv_percentage) AS total');
		$this->db->where('YEAR(jpis_ot_en_date) =', $year);
		$this->db->where('MONTH(jpis_ot_en_date) =', $month);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total;
	}
	// Total Percentage %
	public function getMonthlyTotalJutePurchaseOutTurnPercentageTotal($year, $month)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->select('SUM(jpiv_percentage) AS total');
		$this->db->where('YEAR(jpis_ot_en_date) =', $year);
		$this->db->where('MONTH(jpis_ot_en_date) =', $month);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total;
	}


	// Monthly Total Jute Purchase Provision Amount
	public function getMonthlyTotalJuteProvisionAmount($year, $month)
	{
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->select('SUM(jpiv_amount_with_bad_pro) AS total');
		$this->db->where('YEAR(jpis_ot_en_date) =', $year);
		$this->db->where('MONTH(jpis_ot_en_date) =', $month);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total;
	}

	// Monthly Total Jute Purchase Provision Amount Grade Wise 
	public function getMonthlyTotalJuteProvisionAmountTotalGradeWise($startYear, $endYear, $grade_id)
	{
		$arrYear = array($startYear, $endYear);
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");

		$this->db->select('SUM(jpiv_amount_with_bad_pro) AS total');
		$this->db->where_in('YEAR(jpis_ot_en_date)', $arrYear);
		$this->db->where('jpiv_j_g_id', $grade_id);
		// $this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->result()[0]->total;
	}

	public function getMonthlyTotalJuteProvisionAmountTotalGradeWiseKFWH($startYear, $endYear, $grade_id, $ar_id)
	{
		$arrYear = array($startYear, $endYear);
		$this->db->join('jute_purchase_invoice_summary', 'jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id');
		$this->db->join('mokam', 'mokam.mo_id = jute_purchase_invoice_summary.jpis_ot_en_mo_id');
		$this->db->join('area', "mokam.mo_ar_id = area.ar_id");

		$this->db->select('SUM(jpiv_amount_with_bad_pro) AS total');
		$this->db->where_in('YEAR(jpis_ot_en_date)', $arrYear);
		$this->db->where('jpiv_j_g_id', $grade_id);
		$this->db->where('mo_ar_id', $ar_id);
		$this->db->where('jpiv_status', 1);
		$this->db->where('jpis_status', 1);
		$this->db->where('jpis_approve_status', 1);
		$query = $this->db->get('jute_purchase_invoice_value');
		return $query->row()->total;
	}


	public function getMonthlyTotalJuteProvisionAmountTotal($startYear, $endYear)
	{
		$query = $this->db->query("SELECT SUM(jpiv_amount_with_bad_pro) AS grand_total FROM jute_purchase_invoice_value JOIN jute_purchase_invoice_summary ON jute_purchase_invoice_summary.jpis_id = jute_purchase_invoice_value.jpiv_jpis_id WHERE YEAR(jpis_ot_en_date) IN('$startYear', '$endYear') AND jpiv_status = 1 AND jpis_status = 1 AND jpis_approve_status = 1");
		return $query->row()->grand_total;
	}


	/* ============================== Jute Sale ============================== */
	// Monthly Total Jute Sale Mds
	public function getMonthlyTotalJuteSaleMds($year, $month, $grade_id)
	{
		$this->db->join('jute_sell_summary', 'jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id');
		$this->db->select('SUM(jsv_weight) AS total_sale');
		$this->db->where('YEAR(jss_date) =', $year);
		$this->db->where('MONTH(jss_date) =', $month);
		$this->db->where('jsv_j_g_id', $grade_id);
		$this->db->where('jss_status', 1);
		$this->db->where('jsv_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_value');
		return $query->result()[0]->total_sale;
	}

	// KF WH
	public function getMonthlyTotalJuteSaleMdsKFWH($year, $month, $grade_id, $ar_id)
	{
		$this->db->join('jute_sell_summary', 'jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id');
		$this->db->select('SUM(jsv_weight) AS total_sale');
		$this->db->where('YEAR(jss_date) =', $year);
		$this->db->where('MONTH(jss_date) =', $month);
		$this->db->where('jsv_j_g_id', $grade_id);
		$this->db->where('jss_ar_id', $ar_id);
		$this->db->where('jss_status', 1);
		$this->db->where('jsv_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_value');
		return $query->result()[0]->total_sale;
	}

	public function getMonthlyTotalJuteSaleMdsTotalKFWH($startYear, $endYear, $grade_id, $ar_id)
	{
		$arrayYEar = array($startYear, $endYear);
		$this->db->join('jute_sell_summary', 'jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id');
		$this->db->select('SUM(jsv_weight) AS total_sale');
		$this->db->where_in('YEAR(jss_date)', $arrayYEar);
		$this->db->where('jsv_j_g_id', $grade_id);
		$this->db->where('jss_ar_id', $ar_id);
		$this->db->where('jss_status', 1);
		$this->db->where('jsv_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_value');
		return $query->row()->total_sale;
	}

	// Monthly Total Jute Issue Mds
	public function getMonthlyTotalJuteSaleMdsGradeWise($startYear, $endYear, $grade_id)
	{
		$query = $this->db->query("SELECT SUM(jsv_weight) AS total FROM jute_sell_value JOIN jute_sell_summary ON jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id WHERE YEAR(jss_date) IN('$startYear', '$endYear') AND jsv_j_g_id = '$grade_id' AND jss_status = 1 AND jsv_status = 1 AND jss_approve_status = 1");
		return $query->row()->total;
	}

	public function getMonthlyTotalJuteSaleMdsMonthWise($year, $month)
	{
		$query = $this->db->query("SELECT SUM(jsv_weight) AS total FROM jute_sell_value JOIN jute_sell_summary ON jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id WHERE YEAR(jss_date) = '$year' AND MONTH(jss_date) ='$month' AND jss_status = 1 AND jsv_status = 1 AND jss_approve_status = 1");
		return $query->row()->total;
	}

	// Monthly Total GRand Total 
	public function getMonthlyTotalJuteSaleMdsGrandTotal($startYear, $endYear)
	{
		$query = $this->db->query("SELECT SUM(jsv_weight) AS grand_total FROM jute_sell_value JOIN jute_sell_summary ON jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id WHERE YEAR(jss_date) IN('$startYear', '$endYear') AND jss_status = 1 AND jsv_status = 1 AND jss_approve_status = 1");
		return $query->row()->grand_total;
	}


	// Monthly Total Jute Sale Amount
	public function getMonthlyTotalJuteSaleAmount($year, $month, $grade_id)
	{
		$this->db->join('jute_sell_summary', 'jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id');
		$this->db->select('SUM(jsv_amount) AS total_sale');
		$this->db->where('YEAR(jss_date) =', $year);
		$this->db->where('MONTH(jss_date) =', $month);
		$this->db->where('jsv_j_g_id', $grade_id);
		$this->db->where('jss_status', 1);
		$this->db->where('jsv_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_value');
		return $query->result()[0]->total_sale;
	}


	// KF WH
	public function getMonthlyTotalJuteSaleAmountKFWH($year, $month, $grade_id, $ar_id)
	{
		$this->db->join('jute_sell_summary', 'jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id');
		$this->db->select('SUM(jsv_amount) AS total_sale');
		$this->db->where('YEAR(jss_date) =', $year);
		$this->db->where('MONTH(jss_date) =', $month);
		$this->db->where('jsv_j_g_id', $grade_id);
		$this->db->where('jss_ar_id', $ar_id);
		$this->db->where('jss_status', 1);
		$this->db->where('jsv_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_value');
		return $query->result()[0]->total_sale;
	}

	public function getMonthlyTotalJuteSaleAmountTotalKFWH($startYear, $endYear, $grade_id, $ar_id)
	{
		$arrayYEar = array($startYear, $endYear);
		$this->db->join('jute_sell_summary', 'jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id');
		$this->db->select('SUM(jsv_amount) AS total_sale');
		$this->db->where_in('YEAR(jss_date)', $arrayYEar);
		$this->db->where('jsv_j_g_id', $grade_id);
		$this->db->where('jss_ar_id', $ar_id);
		$this->db->where('jss_status', 1);
		$this->db->where('jsv_status', 1);
		$this->db->where('jss_approve_status', 1);
		$query = $this->db->get('jute_sell_value');
		return $query->row()->total_sale;
	}

	// Monthly Total Jute Issue Mds
	public function getMonthlyTotalJuteSaleAmountGradeWise($startYear, $endYear, $grade_id)
	{
		$query = $this->db->query("SELECT SUM(jsv_amount) AS total FROM jute_sell_value JOIN jute_sell_summary ON jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id WHERE YEAR(jss_date) IN('$startYear', '$endYear') AND jsv_j_g_id = '$grade_id' AND jss_status = 1 AND jsv_status = 1 AND jss_approve_status = 1");
		return $query->row()->total;
	}

	public function getMonthlyTotalJuteSaleAmountMonthWise($year, $month)
	{
		$query = $this->db->query("SELECT SUM(jsv_amount) AS total FROM jute_sell_value JOIN jute_sell_summary ON jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id WHERE YEAR(jss_date) = '$year' AND MONTH(jss_date) ='$month' AND jss_status = 1 AND jsv_status = 1 AND jss_approve_status = 1");
		return $query->row()->total;
	}

	// Monthly Total GRand Total 
	public function getMonthlyTotalJuteSaleAmountGrandTotal($startYear, $endYear)
	{
		$query = $this->db->query("SELECT SUM(jsv_amount) AS grand_total FROM jute_sell_value JOIN jute_sell_summary ON jute_sell_summary.jss_id = jute_sell_value.jsv_jss_id WHERE YEAR(jss_date) IN('$startYear', '$endYear') AND jss_status = 1 AND jsv_status = 1 AND jss_approve_status = 1");
		return $query->row()->grand_total;
	}



	/* ============================== Jute Issue ============================== */
	// Monthly Total Jute Issue Mds
	public function getMonthlyTotalJuteIssueMds($year, $month, $grade_id)
	{
		$this->db->join('issue_summary', 'issue_summary.iss_id = issue_value.isv_iss_id');
		$this->db->select('SUM(isv_issue) AS total');
		$this->db->where('YEAR(iss_date) =', $year);
		$this->db->where('MONTH(iss_date) =', $month);
		$this->db->where('isv_j_g_id', $grade_id);
		$this->db->where('iss_status', 1);
		$this->db->where('isv_status', 1);
		$query = $this->db->get('issue_value');
		return $query->result()[0]->total;
	}


	public function getMonthlyTotalJuteIssueMdsKFWH($year, $month, $grade_id, $ar_id)
	{
		$this->db->join('issue_summary', 'issue_summary.iss_id = issue_value.isv_iss_id');
		$this->db->select('SUM(isv_issue) AS total');
		$this->db->where('YEAR(iss_date) =', $year);
		$this->db->where('MONTH(iss_date) =', $month);
		$this->db->where('isv_j_g_id', $grade_id);
		$this->db->where('isv_ar_id', $ar_id);
		$this->db->where('iss_status', 1);
		$this->db->where('isv_status', 1);
		$query = $this->db->get('issue_value');
		return $query->result()[0]->total;
	}

	public function getMonthlyTotalJuteIssueMdsTotalKFWH($startYear, $endYear, $grade_id, $ar_id)
	{
		$arrayYear = array($startYear, $endYear);
		$this->db->join('issue_summary', 'issue_summary.iss_id = issue_value.isv_iss_id');
		$this->db->select('SUM(isv_issue) AS total');
		$this->db->where_in('YEAR(iss_date)', $arrayYear);
		$this->db->where('isv_j_g_id', $grade_id);
		$this->db->where('isv_ar_id', $ar_id);
		$this->db->where('iss_status', 1);
		$this->db->where('isv_status', 1);
		$query = $this->db->get('issue_value');
		return $query->row()->total;
	}




	// Monthly Total Jute Issue Grade Wise
	public function getMonthlyTotalJuteIssueMdsTotalGradeWIse($startYear, $endYear, $grade_id)
	{
		$arrayYear = array($startYear, $endYear);
		$this->db->join('issue_summary', 'issue_summary.iss_id = issue_value.isv_iss_id');
		$this->db->select('SUM(isv_issue) AS total');
		$this->db->where_in('YEAR(iss_date)', $arrayYear);
		$this->db->where('isv_j_g_id', $grade_id);
		$this->db->where('iss_status', 1);
		$this->db->where('isv_status', 1);
		$query = $this->db->get('issue_value');
		return $query->row()->total;
	}

	// Monthly Total Jute Issue Mds
	public function getMonthlyTotalJuteIssueMdsTotalMonthWise($year, $month)
	{
		$query = $this->db->query("SELECT SUM(isv_issue) AS total FROM issue_value JOIN issue_summary ON issue_summary.iss_id = issue_value.isv_iss_id WHERE YEAR(iss_date) = '$year' AND MONTH(iss_date) ='$month' AND iss_status = 1 AND isv_status = 1");
		return $query->row()->total;
	}

	// Monthly Total GRand Total 
	public function getMonthlyTotalJuteIssueMdsGrandTotal($startYear, $endYear)
	{
		$query = $this->db->query("SELECT SUM(isv_issue) AS grand_total FROM issue_value JOIN issue_summary ON issue_summary.iss_id = issue_value.isv_iss_id WHERE YEAR(iss_date) IN('$startYear', '$endYear') AND iss_status = 1 AND isv_status = 1");
		return $query->row()->grand_total;
	}




	/* ============================== Purchase Supplier Monthly Payment Report ============================== */
	// Monthly Total Jute Sale Mds
	public function getMonthlyTotalSupplierPaymentAmount($year, $month)
	{
		$this->db->select('SUM(sp_amount) AS total');
		$this->db->where('YEAR(sp_date) =', $year);
		$this->db->where('MONTH(sp_date) =', $month);
		$this->db->where('sp_status', 1);
		$query = $this->db->get('supplier_payment');
		return $query->result()[0]->total;
	}

	public function getMonthlyTotalSupplierPaymentAmountGrandTotal($startYear, $endYear)
	{
		$arrayYear = array($startYear, $endYear);
		$this->db->select('SUM(sp_amount) AS total');
		$this->db->where_in('YEAR(sp_date)', $arrayYear);
		$this->db->where('sp_status', 1);
		$query = $this->db->get('supplier_payment');
		return $query->row()->total;
	}

	/* ============================== Purchase Supplier Monthly Received Amount Report ============================== */
	public function getMonthlyTotalClientPaymentAmount($year, $month)
	{
		$this->db->select('SUM(cp_amount) AS total');
		$this->db->where('YEAR(cp_date) =', $year);
		$this->db->where('MONTH(cp_date) =', $month);
		$this->db->where('cp_status', 1);
		$query = $this->db->get('client_payment');
		return $query->result()[0]->total;
	}

	public function getMonthlyTotalClientPaymentAmountGrandTotal($startYear, $endYear)
	{
		$arrayYear = array($startYear, $endYear);
		$this->db->select('SUM(cp_amount) AS total');
		$this->db->where_in('YEAR(cp_date)', $arrayYear);
		$this->db->where('cp_status', 1);
		$query = $this->db->get('client_payment');
		return $query->row()->total;
	}





	// Extra Query
	public function extraQuery($startYear, $endYear, $grade_id)
	{
		$query = $this->db->query("SELECT SUM(isv_issue) AS total FROM issue_value JOIN issue_summary ON issue_summary.iss_id = issue_value.isv_iss_id WHERE YEAR(iss_date) IN('$startYear', '$endYear') AND isv_j_g_id = '$grade_id' AND iss_status = 1 AND isv_status = 1");
		return $query->row()->total;
	}





	/* ================================ Jute Stock Alert Report ================================ */

	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}

	public function getJuteStockAlertQuantity()
	{
		$this->db->where('jsaq_id', 1);
		$query = $this->db->get('jute_stock_alert_quantity');
		return $query->row();
	}

	public function getJuteStockAlertQuantityById($id)
	{
		$this->db->where('jsaq_status', 1);
		$this->db->where('jsaq_id', $id);
		$query = $this->db->get('jute_stock_alert_quantity');
		return $query->row();
	}


	public function updateJuteStockAlertQuantity($id, $data)
	{
		$this->db->where('jsaq_id', $id);
		$this->db->update('jute_stock_alert_quantity', $data);
	}




	// End
}
