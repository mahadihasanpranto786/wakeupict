<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Area extends CI_Controller
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

		$this->load->model('M_area');
	}

	// Add New From view for Area
	public function addArea()
	{
		$data = $this->engine->store_nav('setup', 'add_area', 'Add Area');
		$data['lists'] = $this->M_area->getArea();
		// x_debug($data['list']->result());
		$path = 'backend/setup/area/add_area';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data in database table
	public function insertArea()
	{
		$ar_id = $this->input->post('ar_id');
		$ar_title = $this->input->post('ar_title');
		$ar_description = $this->input->post('ar_description');
		$data = array(
			'ar_id' => $ar_id,
			'ar_title' => $ar_title,
			'ar_status' => 1,
			'ar_description' => $ar_description,
			'ar_created_at' => get_current_time(),
			'ar_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_area->insertArea($data);
		if ($id) {
			set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
		} else {
			set_confirmation_msg('False', '', 'Some thing worng happend.');
		}
		redirect('add_area');
	}

	// edit From view for Area
	public function editArea()
	{
		$ar_id = $this->input->get('ar_id');
		$data = $this->engine->store_nav('area', 'edit_area', 'Edit Area');
		$data['area'] = $this->M_area->getAreaById($ar_id);
		$data['list'] = $this->M_area->getArea();
		$path = 'backend/setup/area/edit_area';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Update Data in database table
	public function updateArea()
	{
		$ar_id = $this->input->post('ar_id');
		$ar_title = $this->input->post('ar_title');
		$ar_description = $this->input->post('ar_description');
		$data = array(
			'ar_id' => $ar_id,
			'ar_title' => $ar_title,
			'ar_status' => 1,
			'ar_description' => $ar_description,
			'ar_updated_at' => get_current_time(),
			'ar_updated_by' => $this->session->userdata('currentActiveId')
		);

		$this->M_area->updateArea($ar_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Updated succesfully', '');
		redirect('add_area');
	}

	// Delete Data in database table
	public function deleteArea()
	{
		$ar_id = $this->input->get('ar_id');
		$data = array(
			'ar_status' => 0,
			'ar_updated_at' => get_current_time(),
			'ar_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_area->updateArea($ar_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Deleted succesfully', '');
		redirect('add_area');
	}

	//Permanently Delete
	public function permanentlyDeleteArea()
	{
		$ar_id = $this->input->get('ar_id');
		$this->Common->delete_data('area', 'ar_id', $ar_id);
		set_confirmation_msg('TRUE', 'Your data has been Permanently Deleted successfully', '');
		redirect('add_area');
	}

	// Delete Data in database table
	public function inactiveArea()
	{
		$ar_id = $this->input->get('ar_id');
		$data = array(
			'ar_status' => 0,
			'ar_updated_at' => get_current_time(),
			'ar_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_area->updateArea($ar_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Inactive succesfully', '');
		redirect('add_area');
	}
}
