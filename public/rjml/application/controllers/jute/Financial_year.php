<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Financial_year extends CI_Controller
{
	private $main_layout = '';
	private $side_menu = '';

	public function __construct()
	{
		parent::__construct();
		$this->main_layout = 'backend/master_layout';

		$current_user_type = $this->session->userdata('current_type');
		if ($current_user_type == 1) {
			$this->side_menu = 'backend/authority/administration/side_menu';
		} elseif ($current_user_type == 10) {
			$this->side_menu = 'backend/authority/operator/side_menu';
		} elseif ($current_user_type == 101) {
			$this->side_menu = 'backend/authority/security_head/side_menu';
		} elseif ($current_user_type == 102) {
			$this->side_menu = 'backend/authority/security_operator/side_menu';
		} elseif ($current_user_type == 201) {
			$this->side_menu = 'backend/authority/weight_head/side_menu';
		} elseif ($current_user_type == 202) {
			$this->side_menu = 'backend/authority/weight_operator/side_menu';
		} elseif ($current_user_type == 301) {
			$this->side_menu = 'backend/authority/jute_head/side_menu';
		} elseif ($current_user_type == 302) {
			$this->side_menu = 'backend/authority/jute_operator/side_menu';
		} elseif ($current_user_type == 401) {
			$this->side_menu = 'backend/authority/accounts_head/side_menu';
		} elseif ($current_user_type == 402) {
			$this->side_menu = 'backend/authority/accounts_operator/side_menu';
		} elseif ($current_user_type == 501) {
			$this->side_menu = 'backend/authority/production_head/side_menu';
		} elseif ($current_user_type == 502) {
			$this->side_menu = 'backend/authority/production_operator/side_menu';
		} elseif ($current_user_type == 601) {
			$this->side_menu = 'backend/authority/gm/side_menu';
		} elseif ($current_user_type == 602) {
			$this->side_menu = 'backend/authority/shareholder/side_menu';
		} elseif ($current_user_type == 603) {
			$this->side_menu = 'backend/authority/system_administrator/side_menu';
		} else {
			$this->session->set_flashdata('login_failed', 'Credential Not match');
			redirect('login', 'location');
		}

		$this->load->model('M_financial_year');
	}

	// Add Financial Year Form View
	public function addFinancialYear()
	{
		$data = $this->engine->store_nav('financial_year', 'add_financial_year', 'Add Financial Year');
		$data['list'] = $this->M_financial_year->getFinancialYear();
		$path = 'backend/jute/financial_year/add_financial_year';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data into datbase table
	public function insertFinancialYear()
	{
		$fy_id = $this->input->post('fy_id');
		$fy_title = $this->input->post('fy_title');
		$fy_end_date = date("Y-m-d", strtotime($this->input->post('fy_end_date')));
		$fy_start_date = date("Y-m-d", strtotime($this->input->post('fy_start_date')));
		$fy_description = $this->input->post('fy_description');
		$data = array(
			'fy_id' => $fy_id,
			'fy_title' => $fy_title,
			'fy_end_date' => $fy_end_date,
			'fy_start_date' => $fy_start_date,
			'fy_description' => $fy_description,
			'fy_status' => 1,
			'fy_created_at' => get_current_time(),
			'fy_created_by' => $this->session->userdata('currentActiveId')
		);
		// echo ('<pre>');
		// print_r($data);
		$id = $this->M_financial_year->insertFinancialYear($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_financial_year');
	}
	// Update Data from data Table
	public function updateFinancialYear()
	{
		$fy_id = $this->input->post('id');
		$fy_title = $this->input->post('fy_title');
		$fy_end_date = date("Y-m-d", strtotime($this->input->post('fy_end_date')));
		$fy_start_date = date("Y-m-d", strtotime($this->input->post('fy_start_date')));
		$fy_description = $this->input->post('fy_description');
		$data = array(
			'fy_id' => $fy_id,
			'fy_title' => $fy_title,
			'fy_start_date' => $fy_start_date,
			'fy_end_date' => $fy_end_date,
			'fy_description' => $fy_description,
			'fy_updated_at' => get_current_time(),
			'fy_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_financial_year->updateFinancialYear($fy_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_financial_year');
	}

	//Delete Data from data Table
	public function deleteFinancialYear()
	{
		$fy_id = $this->input->get('fy_id');
		$data = array(
			'fy_status' => 0,
			'fy_updated_at' => get_current_time(),
			'fy_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_financial_year->updateFinancialYear($fy_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_financial_year');
	}

	//Permanently Delete
	public function permanentlyDeleteFinancialYear()
	{
		$fy_id = $this->input->get('fy_id');
		$this->Common->delete_data('financial_year', 'fy_id', $fy_id);
		set_confirmation_msg('TRUE', 'Your data has been Permanently Deleted successfully', '');
		redirect('add_financial_year');
	}
	//Delete Data from data Table
	public function inactiveFinancialYear()
	{
		$fy_id = $this->input->get('fy_id');
		$data = array(
			'fy_status' => 0,
			'fy_updated_at' => get_current_time(),
			'fy_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_financial_year->updateFinancialYear($fy_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_financial_year');
	}



	//Financial Year Get
	public function ajaxFinancialYear()
	{
		$fy_start_date = date("Y-m-d", strtotime($this->input->post('fy_start_date')));
		$valid = $this->M_financial_year->ajaxFinancialYear($fy_start_date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}
}
