<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase extends CI_Controller
{
	private $main_layout = '';
	private $side_menu = '';


	public function __construct()
	{
		parent::__construct();
		$this->main_layout = 'backend/master_layout';
		$this->side_menu = 'backend/authority/administration/side_menu';
		$this->load->model('M_purchase');
		$this->load->model('M_grade');
		$this->load->model('M_godown');
		$this->load->model('M_supplier');
		$this->load->model('M_financial_year');
	}

	public function listPurchaseOrder()
	{
		$data = $this->engine->store_nav('setup', 'list_purchase_order', 'List Jute Purchase Order');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['purchase_orders'] = $this->M_purchase->getPurchaseOrder();
		$path = 'backend/setup/purchase/list_purchase_order';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function addPurchaseOrder()
	{
		$data = $this->engine->store_nav('setup', 'add_purchase_order', 'Add Jute Purchase Order');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['suppliers'] = $this->M_supplier->getSupplier();
		$path = 'backend/setup/purchase/add_purchase_order';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function insertPurchaseOrder()
	{
		// Summary table
		$jpo_date = $this->input->post('jpo_date');
		$jpo_due_date = $this->input->post('jpo_due_date');
		$jpo_date = date("Y-m-d", strtotime($jpo_date));
		$jpo_due_date = date("Y-m-d", strtotime($jpo_due_date));
		$jpo_s_id = $this->input->post('jpo_s_id');
		$jpo_fy_id = $this->input->post('jpo_fy_id');
		$jpo_total = $this->input->post('jpo_total_mds');

		$summaryData = array(
			'jpos_date' => $jpo_date,
			'jpos_due_date' => $jpo_due_date,
			'jpos_fy_id' => $jpo_fy_id,
			'jpos_s_id' => $jpo_s_id,
			'jpos_total_mds' => $jpo_total,
			'jpos_status' => 1,
			'jpos_created_at' => get_current_time(),
			'jpos_created_by' => $this->session->userdata('currentActiveId')
		);

		$summaryId = $this->M_purchase->insertData('jute_purchase_order_summary', $summaryData);

		// Value Table
		$jpov_j_g_id = $this->input->post('jpo_j_g_id');
		$jpov_mds_value = $this->input->post('jpo_mds_value');

		$jpov_mds_kf = $this->input->post('jpo_mds_kf');
		$jpov_mds_wh = $this->input->post('jpo_mds_wh');


		for ($i = 0; $i < count($jpov_mds_value); $i++) {
			$valueData = array(
				'jpov_jpos_id' => $summaryId,
				'jpov_j_g_id' => $jpov_j_g_id[$i],
				'jpov_mds_value' => $jpov_mds_value[$i],
				'jpov_status' => 1,
				'jpov_wh_kf_status' => 0,
				'jpov_created_at' => get_current_time(),
				'jpov_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_purchase->insertData('jute_purchase_order_value', $valueData);
		}

		$kfValue = array(
			'jpov_jpos_id' => $summaryId,
			'jpov_j_g_id' => 'kf',
			'jpov_mds_value' => $jpov_mds_kf,
			'jpov_status' => 1,
			'jpov_wh_kf_status' => 0,
			'jpov_created_at' => get_current_time(),
			'jpov_created_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_purchase->insertData('jute_purchase_order_value', $kfValue);

		$whValue = array(
			'jpov_jpos_id' => $summaryId,
			'jpov_j_g_id' => 'wh',
			'jpov_mds_value' => $jpov_mds_wh,
			'jpov_status' => 1,
			'jpov_wh_kf_status' => 0,
			'jpov_created_at' => get_current_time(),
			'jpov_created_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_purchase->insertData('jute_purchase_order_value', $whValue);

		redirect('list_jute_purchase_order');
	}

	// Delete
	public function deleteJutePurchaseOrder()
	{
		$id = $this->input->get('jpos_id');
		$data = array(
			'jpos_status' => 0
		);
		$this->M_purchase->updateJutePurchaseOrderSummary($id, $data);

		redirect('list_jute_purchase_order');
	}

	//Financial Year Get
	public function ajaxFinancialYear()
	{
		$jpo_date = date("Y-m-d", strtotime($this->input->post('jpo_date')));
		$valid = $this->M_godown->ajaxFinancialYear($jpo_date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	// View purchase order
	public function viewPurchaseOrder()
	{
		$data = $this->engine->store_nav('setup', 'view_purchase_order', 'View Jute Purchase Order');
		$id = $this->input->get('jpos_id');
		// x_debug($id);
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['purchase_orders'] = $this->M_purchase->getPurchaseOrder();
		$data['purchaseOrder'] = $this->M_purchase->getPurchaseOrderById($id);
		$path = 'backend/setup/purchase/view_purchase_order';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	// Edit purchase order
	public function editPurchaseOrder()
	{
		$data = $this->engine->store_nav('setup', 'edit_purchase_order', 'Edit Jute Purchase Order');
		$id = $this->input->get('jpos_id');
		$data['grades'] = $this->M_grade->getJuteGrade();
		// $data['purchase_orders'] = $this->M_purchase->getPurchaseOrder();
		$data['suppliers'] = $this->M_supplier->getSupplier();
		$data['purchaseOrder'] = $this->M_purchase->getPurchaseOrderById($id);
		$path = 'backend/setup/purchase/edit_purchase_order';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}




	public function updatePurchaseOrder()
	{
		// Summary table
		$jpo_date = $this->input->post('jpo_date');
		$jpo_due_date = $this->input->post('jpo_due_date');
		$jpo_date = date("Y-m-d", strtotime($jpo_date));
		$jpo_due_date = date("Y-m-d", strtotime($jpo_due_date));
		$jpo_s_id = $this->input->post('jpo_s_id');
		$jpo_fy_id = $this->input->post('jpo_fy_id');
		$jpo_total = $this->input->post('jpo_total_mds');
		$jpos_id = $this->input->post('jpos_id');

		$summaryData = array(
			'jpos_date' => $jpo_date,
			'jpos_due_date' => $jpo_due_date,
			'jpos_fy_id' => $jpo_fy_id,
			'jpos_s_id' => $jpo_s_id,
			'jpos_total_mds' => $jpo_total,
			'jpos_updated_at' => get_current_time(),
			'jpos_updated_by' => $this->session->userdata('currentActiveId')
		);

		// $summaryId = $this->M_purchase->updateJutePurchaseOrderSummary($jpos_id, $summaryData);
		$this->Common->update_data('jute_purchase_order_summary', 'jpos_id', $jpos_id, $summaryData);

		// Value Table
		$jpov_j_g_id = $this->input->post('jpo_j_g_id');
		$jpov_mds_value = $this->input->post('jpo_mds_value');
		$jpov_mds_value_id = $this->input->post('jpo_mds_value_id');

		$jpov_mds_kf = $this->input->post('jpo_mds_kf');
		$jpov_mds_kf_id = $this->input->post('jpo_mds_kf_id');
		$jpov_mds_wh = $this->input->post('jpo_mds_wh');
		$jpov_mds_wh_id = $this->input->post('jpo_mds_wh_id');


		for ($i = 0; $i < count($jpov_mds_value); $i++) {
			$valueData = array(
				// 'jpov_jpos_id' => $summaryId,
				// 'jpov_j_g_id' => $jpov_j_g_id[$i],
				'jpov_mds_value' => $jpov_mds_value[$i],
				// 'jpov_status' => 1,
				// 'jpov_wh_kf_status' => 0,
				'jpov_updated_at' => get_current_time(),
				'jpov_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('jute_purchase_order_value', 'jpov_id', $jpov_mds_value_id[$i], $valueData);
		}

		$kfValue = array(
			// 'jpov_jpos_id' => $summaryId,
			// 'jpov_j_g_id' => 'kf',
			'jpov_mds_value' => $jpov_mds_kf,
			// 'jpov_status' => 1,
			// 'jpov_wh_kf_status' => 0,
			'jpov_updated_at' => get_current_time(),
			'jpov_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('jute_purchase_order_value', 'jpov_id', $jpov_mds_kf_id, $kfValue);

		$whValue = array(
			// 'jpov_jpos_id' => $summaryId,
			// 'jpov_j_g_id' => 'wh',
			'jpov_mds_value' => $jpov_mds_wh,
			// 'jpov_status' => 1,
			// 'jpov_wh_kf_status' => 0,
			'jpov_updated_at' => get_current_time(),
			'jpov_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('jute_purchase_order_value', 'jpov_id', $jpov_mds_wh_id, $whValue);

		redirect('list_jute_purchase_order');
	}








	// End
}
