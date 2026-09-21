<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
{
	private $main_layout = '';
	private $side_menu = '';


	public function __construct()
	{
		parent::__construct();
		$this->main_layout = 'backend/master_layout';
		$this->side_menu = 'backend/authority/operator/side_menu';
		$this->load->model('M_department');
	}
	//Jute Department
	// add Labour Department Form
	public function addDepartment()
	{
		$data = $this->engine->store_nav('department', 'add_department', 'Add Department');
		$data['list'] = $this->M_department->getDepartment();
		$path = 'backend/jute/department/add_department';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	// Insert Data into datbase table
	public function insertDepartment()
	{
		$d_id = $this->input->post('d_id');
		$d_title = $this->input->post('d_title');
		$d_description = $this->input->post('d_description');
		$data = array(
			'd_id' => $d_id,
			'd_title' => $d_title,
			'd_description' => $d_description,
			'd_status' => 1,
			'd_created_at' => get_current_time(),
			'd_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_department->insertDepartment($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_department');
	}
	// Update Data from data Table
	public function updateDepartment()
	{
		$d_id = $this->input->post('d_id');
		$d_title = $this->input->post('d_title');
		$d_description = $this->input->post('d_description');
		$data = array(
			'd_id' => $d_id,
			'd_title' => $d_title,
			'd_description' => $d_description,
			'd_updated_at' => get_current_time(),
			'd_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_department->updateDepartment($d_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_department');
	}

	//Delete Data from data Table
	public function deleteDepartment()
	{
		$d_id = $this->input->get('d_id');
		$data = array(
			'd_status' => 0,
			'd_updated_at' => get_current_time(),
			'd_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_department->updateDepartment($d_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_department');
		// echo '<pre>';
		// print_r($data);
	}
	//Permanently Delete
	public function permanentlyDeleteDepartment()
	{
		$d_id = $this->input->get('d_id');
		$this->Common->delete_data('department', 'd_id', $d_id);
		set_confirmation_msg('TRUE', 'Your data has been Permanently Deleted successfully', '');
		redirect('add_department');
	}

	//Delete Data from data Table
	public function inactiveDepartment()
	{
		$d_id = $this->input->get('d_id');
		$data = array(
			'd_status' => 0,
			'd_updated_at' => get_current_time(),
			'd_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_department->updateDepartment($d_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_department');
	}

	/* ========================= Jute Sub Department ============================= */
	// add Sub Department Form
	public function addSubDepartment()
	{
		$data = $this->engine->store_nav('department', 'add_sub_department', 'Add Sub Department');
		$data['list'] = $this->M_department->getSubDepartment();
		$data['departments'] = $this->M_department->getDepartment();
		$path = 'backend/jute/department/add_sub_department';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data into datbase table
	public function insertSubDepartment()
	{
		$sd_id = $this->input->post('sd_id');
		$sd_d_id = $this->input->post('sd_d_id');
		$sd_title = $this->input->post('sd_title');
		$sd_description = $this->input->post('sd_description');
		$data = array(
			'sd_id' => $sd_id,
			'sd_d_id' => $sd_d_id,
			'sd_title' => $sd_title,
			'sd_description' => $sd_description,
			'sd_status' => 1,
			'sd_created_at' => get_current_time(),
			'sd_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_department->insertSubDepartment($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_sub_department');
	}
	// Update Data from data Table
	public function updateSubDepartment()
	{
		$sd_id = $this->input->post('sd_id');
		$sd_d_id = $this->input->post('sd_d_id');
		$sd_title = $this->input->post('sd_title');
		$sd_description = $this->input->post('sd_description');
		$data = array(
			'sd_id' => $sd_id,
			'sd_d_id' => $sd_d_id,
			'sd_title' => $sd_title,
			'sd_description' => $sd_description,
			'sd_updated_at' => get_current_time(),
			'sd_updated_by' => $this->session->userdata('currentActiveId')
		);
		// print_r($data);
		$this->M_department->updateSubDepartment($sd_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_sub_department');
	}

	//Delete Data from data Table
	public function deleteSubDepartment()
	{
		$sd_id = $this->input->get('sd_id');
		$data = array(
			'sd_status' => 0,
			'sd_updated_at' => get_current_time(),
			'sd_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_department->updateSubDepartment($sd_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_sub_department');
	}

	//Permanently Delete
	public function permanentlyDeleteSubDepartment()
	{
		$sd_id = $this->input->get('sd_id');
		$this->Common->delete_data('sub_department', 'sd_id', $sd_id);
		set_confirmation_msg('TRUE', 'Your data has been Permanently Deleted successfully', '');
		redirect('add_sub_department');
	}

	//Delete Data from data Table
	public function inactiveSubDepartment()
	{
		$sd_id = $this->input->get('sd_id');
		$data = array(
			'sd_status' => 0,
			'sd_updated_at' => get_current_time(),
			'sd_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_department->updateSubDepartment($sd_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_sub_department');
	}
}
