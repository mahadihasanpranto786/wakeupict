<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jute_report extends CI_Controller
{
	private $main_layout = '';
	private $side_menu = '';


	public function __construct()
	{
		parent::__construct();
		$this->main_layout = 'backend/master_layout';
		$this->side_menu = 'backend/authority/administration/side_menu';
		$this->load->model('M_grade');
		$this->load->model('M_adjustment');
		$this->load->model('M_financial_year');
		$this->load->model('M_client');
		$this->load->model('M_jute_report');
		$this->load->model('M_area');
	}



	// Purchase
	public function monthlyJuteSaleReport()
	{
		$data = $this->engine->store_nav('reports', 'monthly_jute_sale', 'Monthly Jute Sale Report');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/setup/reports/monthly_jute_sale_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Purchase
	public function monthlyJutePurchaseReport()
	{
		$data = $this->engine->store_nav('reports', 'monthly_jute_purchase', 'Monthly Jute Purchase Report');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/setup/reports/monthly_jute_purchase_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Purchase
	public function monthlyJuteIssueReport()
	{
		$data = $this->engine->store_nav('reports', 'monthly_jute_issue', 'Monthly Jute Issue Report');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/setup/reports/monthly_jute_issue_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Jute Purchase Payment
	public function monthlyJutePurchasePaymentReport()
	{
		$data = $this->engine->store_nav('reports', 'monthly_jute_purchase_payment_report', 'Monthly Payment Report');
		$year = $this->input->post('year_value');
		if ($year == "") {
			$data['year_value'] = date('Y');
		} else {
			$data['year_value'] = $year;
		}
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/setup/reports/monthly_jute_purchase_payment_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Jute Sale Payment
	public function monthlyJuteSalePaymentReport()
	{
		$data = $this->engine->store_nav('reports', 'monthly_jute_sale_payment_report', 'Monthly Payment Report');
		$year = $this->input->post('year_value');
		if ($year == "") {
			$data['year_value'] = date('Y');
		} else {
			$data['year_value'] = $year;
		}
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/setup/reports/monthly_jute_sale_payment_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	/* ================================ Jute Stock Alert Report ================================ */

	// edit From view 
	public function addJuteStockAlertQuantity()
	{
		$data = $this->engine->store_nav('setup', 'add_jute_stock_alert_quantity', 'Alert Setup');
		$data['alertSetting'] = $this->M_jute_report->getJuteStockAlertQuantity();
		$path = 'backend/setup/reports/add_jute_stock_alert_quantity';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Update Data in database table
	public function updateJuteStockAlertQuantity()
	{

		$jsaq_id = $this->input->post('jsaq_id');
		$jsaq_weight = $this->input->post('jsaq_weight');
		$jsaq_description = $this->input->post('jsaq_description');
		if ($jsaq_id != '') {
			$data = array(
				'jsaq_id' => $jsaq_id,
				'jsaq_weight' => $jsaq_weight,
				'jsaq_description' => $jsaq_description,
				'jsaq_updated_at' => get_current_time(),
				'jsaq_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_jute_report->updateJuteStockAlertQuantity($jsaq_id, $data);
		} else {
			$data = array(
				// 'jsaq_id' => $jsaq_id,
				'jsaq_weight' => $jsaq_weight,
				'jsaq_description' => $jsaq_description,
				'jsaq_status' => 1,
				'jsaq_created_at' => get_current_time(),
				'jsaq_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_jute_report->insertData('jute_stock_alert_quantity', $data);
		}

		set_confirmation_msg('TRUE', 'Your data has been Updated successfully', '');
		redirect('add_jute_stock_alert_quantity');
	}
}
