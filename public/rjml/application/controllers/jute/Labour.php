<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Labour extends CI_Controller
{
	private $main_layout = '';
	private $side_menu = '';


	public function __construct()
	{
		parent::__construct();
		$this->main_layout = 'backend/master_layout';
		$this->side_menu = 'backend/authority/operator/side_menu';
		$this->load->model('M_labour');
		$this->load->model('M_department');
	}

	/* ======================= Labour Attendance =========================== */
	// List Labour Attendance View Form 
	public function listLabourAttendance()
	{
		$data = $this->engine->store_nav('labour', 'list_labour_attendance', 'List Labour Attendance');
		$data['labours'] = $this->M_labour->getLabour();
		$data['labour_bonus'] = $this->M_labour->getLabourBonus();
		$data['list'] = $this->M_labour->getLabourAttendance();
		$data['hourly_rate'] = $this->M_labour->getHourlyRate();
		$data['departments'] = $this->M_department->getDepartment();
		$data['sub_departments'] = $this->M_department->getSubDepartment();
		//Search By Date
		$date = $this->input->post('search_date');
		if ($date) {
			$data['date'] = $date;
		} else {
			$data['date'] = date('Y-m-d');
		}
		// $data['labour_designations'] = $this->M_labour->getLabourDesignation();
		$path = 'backend/jute/labour/list_labour_attendance';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// add Labour Attendance View Form 
	public function addLabourAttendance()
	{
		$data = $this->engine->store_nav('labour', 'add_labour_attendance', 'Add Labour Attendance');
		// $data['list'] = $this->M_labour->getLabourAttendance();
		$data['labours'] = $this->M_labour->getLabour();
		$data['departments'] = $this->M_department->getDepartment();
		$data['sub_departments'] = $this->M_department->getSubDepartment();
		// $data['labour_designations'] = $this->M_labour->getLabourDesignation();
		$path = 'backend/jute/labour/add_labour_attendance';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//Fetch Labour
	public function fetch_labour()
	{
		if ($this->input->post('labour_id')) {
			echo $this->M_labour->fetch_labour($this->input->post('labour_id'));
		}
	}
	//Fetch Hourly Rate
	public function getHourlyRateByLabourId()
	{
		if ($this->input->post('lhr_id')) {
			echo $this->M_labour->getHourlyRateByLabourId($this->input->post('lhr_id'));
		}
	}
	public function searchByDate()
	{
		$date = $this->input->post('searchdate');
	}
	// Insert Data into database table
	public function insertLabourAttendance()
	{
		$l_a_id = $this->input->post('l_a_id');
		$l_a_d_id = $this->input->post('l_a_d_id');
		$l_a_sd_id = $this->input->post('l_a_sd_id');
		$l_a_date = $this->input->post('l_a_date');
		$l_a_unit = $this->input->post('l_a_unit');
		$l_a_permanent_shift = $this->input->post('l_a_permanent_shift');
		$l_a_running_shift = $this->input->post('l_a_running_shift');
		$l_a_running_day = $this->input->post('l_a_running_day');
		$l_a_labour_id = $this->input->post('l_a_labour_id');
		$l_a_shift_a = $this->input->post('l_a_shift_a');
		$l_a_shift_b = $this->input->post('l_a_shift_b');
		$l_a_shift_c = $this->input->post('l_a_shift_c');
		$l_a_holiday_hour = $this->input->post('l_a_holiday_hour');
		$l_a_arrear_hour = $this->input->post('l_a_arrear_hour');
		$l_a_attendance_status = $this->input->post('l_a_attendance_status');
		for ($i = 0; $i < count($l_a_labour_id); $i++) {
			$data[] = array(
				'l_a_id' => $l_a_id,
				'l_a_d_id' => $l_a_d_id,
				'l_a_sd_id' => $l_a_sd_id,
				'l_a_date' => $l_a_date,
				'l_a_unit' => $l_a_unit,
				'l_a_permanent_shift' => $l_a_permanent_shift,
				'l_a_running_shift' => $l_a_running_shift,
				'l_a_running_day' => $l_a_running_day,
				'l_a_labour_id' => $l_a_labour_id[$i],
				'l_a_shift_a' => $l_a_shift_a[$i],
				'l_a_shift_b' => $l_a_shift_b[$i],
				'l_a_shift_c' => $l_a_shift_c[$i],
				'l_a_holiday_hour' => $l_a_holiday_hour[$i],
				'l_a_arrear_hour' => $l_a_arrear_hour[$i],
				'l_a_attendance_status' => $l_a_attendance_status[$i],
				'l_a_status' => 1,
				'l_a_created_at' => get_current_time(),
				'l_a_created_by' => $this->session->userdata('currentActiveId')
			);
		}
		//using foreach loop for insert multiple row 
		foreach ($data as $row) {
			$id = $this->M_labour->insertLabourAttendance($row);
		}
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('list_labour_attendance');
		// echo '<pre>';
		// print_r($data);
	}

	/* ======================== Add Labour Designation Form ======================== */
	public function addLabourBonus()
	{
		$data = $this->engine->store_nav('labour', 'add_labour_bonus', 'Labour Bonus');
		$data['list'] = $this->M_labour->getLabourBonus();
		$path = 'backend/jute/labour/add_labour_bonus';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertLabourBonus()
	{
		$lb_id = $this->input->post('lb_id');
		$lb_6days_attendance_bonus = $this->input->post('lb_6days_attendance_bonus');
		$lb_7days_attendance_bonus = $this->input->post('lb_7days_attendance_bonus');
		$lb_night_allowance = $this->input->post('lb_night_allowance');
		$lb_travel_allowance = $this->input->post('lb_travel_allowance');
		$lb_welfare_amount = $this->input->post('lb_welfare_amount');
		$previous = $this->db->order_by('lb_id', "desc")->limit(1)->get('labour_bonus')->row();
		$update_row_status = array(
			'lb_status' => 0,
			'lb_updated_at' => get_current_time(),
			'lb_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabourBonus($previous->lb_id, $update_row_status);
		$data = array(
			'lb_id' => $lb_id,
			'lb_6days_attendance_bonus' => $lb_6days_attendance_bonus,
			'lb_7days_attendance_bonus' => $lb_7days_attendance_bonus,
			'lb_night_allowance' => $lb_night_allowance,
			'lb_travel_allowance' => $lb_travel_allowance,
			'lb_welfare_amount' => $lb_welfare_amount,
			'lb_status' => 1,
			'lb_created_at' => get_current_time(),
			'lb_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_labour->insertLabourBonus($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_labour_bonus');
	}
	// Update Data from data Table
	public function updateLabourBonus()
	{
		$lb_id = $this->input->post('lb_id');
		$lb_6days_attendance_bonus = $this->input->post('lb_6days_attendance_bonus');
		$lb_7days_attendance_bonus = $this->input->post('lb_7days_attendance_bonus');
		$lb_night_allowance = $this->input->post('lb_night_allowance');
		$lb_travel_allowance = $this->input->post('lb_travel_allowance');
		$lb_welfare_amount = $this->input->post('lb_welfare_amount');
		$disableLBPreviousId = $this->db->order_by('lb_id', "desc")->limit(1)->get('labour_bonus')->row();
		$update_row_status = array(
			'lb_status' => 0,
			'lb_updated_at' => get_current_time(),
			'lb_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabourBonus($disableLBPreviousId->lb_id, $update_row_status);
		$data = array(
			'lb_id' => $lb_id,
			'lb_6days_attendance_bonus' => $lb_6days_attendance_bonus,
			'lb_7days_attendance_bonus' => $lb_7days_attendance_bonus,
			'lb_night_allowance' => $lb_night_allowance,
			'lb_travel_allowance' => $lb_travel_allowance,
			'lb_welfare_amount' => $lb_welfare_amount,
			'lb_status' => 1,
			'lb_created_at' => get_current_time(),
			'lb_created_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->insertLabourBonus($data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_labour_bonus');
	}
	//Delete Data from data Table
	public function deleteLabourBonus()
	{
		$lb_id = $this->input->get('lb_id');
		$data = array(
			'lb_status' => 0,
			'lb_updated_at' => get_current_time(),
			'lb_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabourBonus($lb_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_labour_bonus');
	}
	/* ========================= Rate Per Hour ========================= */
	public function addHourlyRate()
	{
		$data = $this->engine->store_nav('labour', 'add_hourly_rate', 'Add Hourly Rate');
		$data['list'] = $this->M_labour->getHourlyRate();
		$data['labours'] = $this->M_labour->getLabour();
		$data['departments'] = $this->M_department->getDepartment();
		$data['sub_departments'] = $this->M_department->getSubDepartment();
		$path = 'backend/jute/labour/add_hourly_rate';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertHourlyRate()
	{
		$hr_id = $this->input->post('lhr_id');
		$hr_l_id = $this->input->post('lhr_l_id');
		$hr_hourly_rate = $this->input->post('lhr_hourly_rate');
		$data = array(
			'lhr_id' => $hr_id,
			'lhr_l_id' => $hr_l_id,
			'lhr_hourly_rate' => $hr_hourly_rate,
			'lhr_status' => 1,
			'lhr_created_at' => get_current_time(),
			'lhr_created_by' => $this->session->userdata('currentActiveId')
		);
		$id = $this->M_labour->insertHourlyRate($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_labour_hourly_rate');
		// echo "<pre>";
		// print_r($data);
	}
	// Update Data from data Table
	public function updateHourlyRate()
	{
		$lhr_id = $this->input->post('lhr_id');
		$lhr_l_id = $this->input->post('lhr_l_id');
		$lhr_hourly_rate = $this->input->post('lhr_hourly_rate');
		$data = array(
			'lhr_id' => $lhr_id,
			'lhr_l_id' => $lhr_l_id,
			'lhr_hourly_rate' => $lhr_hourly_rate,
			'lhr_updated_at' => get_current_time(),
			'lhr_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateHourlyRate($lhr_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_labour_hourly_rate');
	}
	//Delete Data from data Table
	public function deleteHourlyRate()
	{
		$lhr_id = $this->input->get('lhr_id');
		$data = array(
			'lhr_status' => 0,
			'lhr_updated_at' => get_current_time(),
			'lhr_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateHourlyRate($lhr_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_labour_hourly_rate');
	}
	//Delete Data from data Table
	public function inactiveHourlyRate()
	{
		$lhr_id = $this->input->get('lhr_id');
		$data = array(
			'lhr_status' => 0,
			'lhr_updated_at' => get_current_time(),
			'lhr_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateHourlyRate($lhr_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_labour_hourly_rate');
	}
	/* ========================= Labour Information ========================= */
	// add Labour View Form 
	public function addLabour()
	{
		$data = $this->engine->store_nav('labour', 'add_labour', 'Add Labour');
		$data['list'] = $this->M_labour->getLabour();
		$data['departments'] = $this->M_department->getDepartment();
		$data['sub_departments'] = $this->M_department->getSubDepartment();
		$data['labour_designations'] = $this->M_labour->getLabourDesignation();
		$path = 'backend/jute/labour/add_labour';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//List Labour
	public function listLabour()
	{
		$data = $this->engine->store_nav('labour', 'list_labour', 'List Labour');
		$data['list'] = $this->M_labour->getLabour();
		$data['departments'] = $this->M_department->getDepartment();
		$data['sub_departments'] = $this->M_department->getSubDepartment();
		$data['labour_designations'] = $this->M_labour->getLabourDesignation();
		$path = 'backend/jute/labour/list_labour';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// View Labour 
	public function viewLabour()
	{
		$data = $this->engine->store_nav('labour', 'view_labour', 'View Labour');
		$l_id = $this->input->get('l_id');
		$data['list'] = $this->M_labour->getLabour();
		$data['labour'] = $this->M_labour->getLabourById($l_id);
		$data['departments'] = $this->M_department->getDepartment();
		$data['sub_departments'] = $this->M_department->getSubDepartment();
		$data['labour_designations'] = $this->M_labour->getLabourDesignation();
		$path = 'backend/jute/labour/view_labour';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//Edit Labour
	public function editLabour()
	{
		$data = $this->engine->store_nav('labour', 'edit_labour', 'Update Labour');
		$l_id = $this->input->get('l_id');
		$data['labour'] = $this->M_labour->getLabourById($l_id);
		$data['departments'] = $this->M_department->getDepartment();
		$data['sub_departments'] = $this->M_department->getSubDepartment();
		$data['labour_designations'] = $this->M_labour->getLabourDesignation();
		$path = 'backend/jute/labour/edit_labour';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//Fetch Sub Department
	function fetch_sub_department()
	{
		if ($this->input->post('sub_department_id')) {
			echo $this->M_labour->fetch_sub_department($this->input->post('sub_department_id'));
		}
	}
	// Insert Data into database table
	public function insertLabour()
	{
		$l_id = $this->input->post('l_id');
		$l_name = $this->input->post('l_name');
		$l_card_no = $this->input->post('l_card_no');
		$l_quarter = $this->input->post('l_quarter');
		$l_l_d_id = $this->input->post('l_l_d_id');
		$l_joining_date = $this->input->post('l_joining_date');
		$l_nid_no = $this->input->post('l_nid_no');
		$l_d_id = $this->input->post('l_d_id');
		$l_sd_id = $this->input->post('l_sd_id');
		$l_address = $this->input->post('l_address');
		$l_date_of_birth = $this->input->post('l_date_of_birth');
		$l_mobile_no = $this->input->post('l_mobile_no');
		$l_wallet_no = $this->input->post('l_wallet_no');
		$l_father_name = $this->input->post('l_father_name');
		$l_mother_name = $this->input->post('l_mother_name');
		$l_post_code = $this->input->post('l_post_code');
		$data = array(
			'l_id' => $l_id,
			'l_name' => $l_name,
			'l_card_no' => $l_card_no,
			'l_quarter' => $l_quarter,
			'l_l_d_id' => $l_l_d_id,
			'l_joining_date' => $l_joining_date,
			'l_nid_no' => $l_nid_no,
			'l_d_id' => $l_d_id,
			'l_sd_id' => $l_sd_id,
			'l_address' => $l_address,
			'l_date_of_birth' => $l_date_of_birth,
			'l_mobile_no' => $l_mobile_no,
			'l_wallet_no' => $l_wallet_no,
			'l_father_name' => $l_father_name,
			'l_mother_name' => $l_mother_name,
			'l_post_code' => $l_post_code,
			'l_status' => 1,
			'l_created_at' => get_current_time(),
			'l_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_labour->insertLabour($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('list_labour');
	}
	// Update Data from data Table
	public function updateLabour()
	{
		$l_id = $this->input->post('l_id');
		$l_name = $this->input->post('l_name');
		$l_card_no = $this->input->post('l_card_no');
		$l_quarter = $this->input->post('l_quarter');
		$l_l_d_id = $this->input->post('l_l_d_id');
		$l_joining_date = $this->input->post('l_joining_date');
		$l_nid_no = $this->input->post('l_nid_no');
		$l_d_id = $this->input->post('l_d_id');
		$l_sd_id = $this->input->post('l_sd_id');
		$l_address = $this->input->post('l_address');
		$l_date_of_birth = $this->input->post('l_date_of_birth');
		$l_mobile_no = $this->input->post('l_mobile_no');
		$l_wallet_no = $this->input->post('l_wallet_no');
		$l_father_name = $this->input->post('l_father_name');
		$l_mother_name = $this->input->post('l_mother_name');
		$l_post_code = $this->input->post('l_post_code');
		$data = array(
			'l_id' => $l_id,
			'l_name' => $l_name,
			'l_card_no' => $l_card_no,
			'l_quarter' => $l_quarter,
			'l_l_d_id' => $l_l_d_id,
			'l_joining_date' => $l_joining_date,
			'l_nid_no' => $l_nid_no,
			'l_d_id' => $l_d_id,
			'l_sd_id' => $l_sd_id,
			'l_address' => $l_address,
			'l_date_of_birth' => $l_date_of_birth,
			'l_mobile_no' => $l_mobile_no,
			'l_wallet_no' => $l_wallet_no,
			'l_father_name' => $l_father_name,
			'l_mother_name' => $l_mother_name,
			'l_post_code' => $l_post_code,
			'l_updated_at' => get_current_time(),
			'l_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabour($l_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('list_labour');
		// echo '<pre>';
		// print_r($data);
	}
	//Delete Data from data Table
	public function deleteLabour()
	{
		$l_id = $this->input->get('l_id');
		$data = array(
			'l_status' => 0,
			'l_updated_at' => get_current_time(),
			'l_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabour($l_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('list_labour');
	}
	//Delete Data from data Table
	public function inactiveLabour()
	{
		$l_id = $this->input->get('l_id');
		$data = array(
			'l_status' => 0,
			'l_updated_at' => get_current_time(),
			'l_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabour($l_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('list_labour');
	}

	/* ======================== Add Labour Designation Form ======================== */
	public function addLabourDesignation()
	{
		$data = $this->engine->store_nav('labour', 'add_labour_designation', 'Add Labour');
		$data['list'] = $this->M_labour->getLabourDesignation();
		$path = 'backend/jute/labour/add_labour_designation';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertLabourDesignation()
	{
		$l_d_id = $this->input->post('l_d_id');
		$l_d_title = $this->input->post('l_d_title');
		$l_d_description = $this->input->post('l_d_description');
		$data = array(
			'l_d_id' => $l_d_id,
			'l_d_title' => $l_d_title,
			'l_d_description' => $l_d_description,
			'l_d_status' => 1,
			'l_d_created_at' => get_current_time(),
			'l_d_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_labour->insertLabourDesignation($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_labour_designation');
	}
	// Update Data from data Table
	public function updateLabourDesignation()
	{
		$l_d_id = $this->input->post('l_d_id');
		$l_d_title = $this->input->post('l_d_title');
		$l_d_description = $this->input->post('l_d_description');
		$data = array(
			'l_d_id' => $l_d_id,
			'l_d_title' => $l_d_title,
			'l_d_description' => $l_d_description,
			'l_d_updated_at' => get_current_time(),
			'l_d_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabourDesignation($l_d_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_labour_designation');
	}
	//Delete Data from data Table
	public function deleteLabourDesignation()
	{
		$l_d_id = $this->input->get('l_d_id');
		$data = array(
			'l_d_status' => 0,
			'l_d_updated_at' => get_current_time(),
			'l_d_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabourDesignation($l_d_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_labour_designation');
	}
	//Delete Data from data Table
	public function inactiveLabourDesignation()
	{
		$l_d_id = $this->input->get('l_d_id');
		$data = array(
			'l_d_status' => 0,
			'l_d_updated_at' => get_current_time(),
			'l_d_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateLabourDesignation($l_d_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_labour_designation');
	}

	/* ========================== add Jute Processing Category ======================== */
	// add Jute Processing Category Form 
	public function addJuteProcessingCategory()
	{
		$data = $this->engine->store_nav('labour', 'add_jute_processing_category', 'Add Jute Processing Category');
		$data['list'] = $this->M_labour->getJuteProcessingCategory();
		$path = 'backend/jute/labour/add_jute_processing_category';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertJuteProcessingCategory()
	{
		$jpc_id = $this->input->post('jpc_id');
		$jpc_title = $this->input->post('jpc_title');
		$jpc_description = $this->input->post('jpc_description');
		$data = array(
			'jpc_id' => $jpc_id,
			'jpc_title' => $jpc_title,
			'jpc_description' => $jpc_description,
			'jpc_status' => 1,
			'jpc_created_at' => get_current_time(),
			'jpc_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_labour->insertJuteProcessingCategory($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_jute_processing_category');
	}
	// Update Data from data Table
	public function updateJuteProcessingCategory()
	{
		$jpc_id = $this->input->post('jpc_id');
		$jpc_title = $this->input->post('jpc_title');
		$jpc_description = $this->input->post('jpc_description');
		$data = array(
			'jpc_id' => $jpc_id,
			'jpc_title' => $jpc_title,
			'jpc_description' => $jpc_description,
			'jpc_updated_at' => get_current_time(),
			'jpc_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateJuteProcessingCategory($jpc_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_jute_processing_category');
	}
	//Delete Data from data Table
	public function deleteJuteProcessingCategory()
	{
		$jpc_id = $this->input->get('jpc_id');
		$data = array(
			'jpc_status' => 0,
			'jpc_updated_at' => get_current_time(),
			'jpc_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateJuteProcessingCategory($jpc_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_jute_processing_category');
	}
	//Delete Data from data Table
	public function inactiveJuteProcessingCategory()
	{
		$jpc_id = $this->input->get('jpc_id');
		$data = array(
			'jpc_status' => 0,
			'jpc_updated_at' => get_current_time(),
			'jpc_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateJuteProcessingCategory($jpc_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_jute_processing_category');
	}

	/* ======================= Jute Sub Category ========================= */
	// add Jute Processing Subcategory Form 
	public function addJuteProcessingSubCategory()
	{
		$data = $this->engine->store_nav('labour', 'add_jute_processing_subcategory', 'Add Jute Processing Subcategory');
		$data['list'] = $this->M_labour->getJuteProcessingSubCategory();
		$data['jute_processing_categories'] = $this->M_labour->getJuteProcessingCategory();
		$path = 'backend/jute/labour/add_jute_processing_subcategory';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data into database table
	public function insertJuteProcessingSubCategory()
	{
		$jpsc_id = $this->input->post('jpsc_id');
		$jpsc_title = $this->input->post('jpsc_title');
		$jpsc_jpc_id = $this->input->post('jpsc_jpc_id');
		$jpsc_rate = $this->input->post('jpsc_rate');
		$data = array(
			'jpsc_id' => $jpsc_id,
			'jpsc_jpc_id' => $jpsc_jpc_id,
			'jpsc_title' => $jpsc_title,
			'jpsc_rate' => $jpsc_rate,
			'jpsc_status' => 1,
			'jpsc_created_at' => get_current_time(),
			'jpsc_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_labour->insertJuteProcessingSubCategory($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_jute_processing_subcategory');
	}
	// Update Data from data Table
	public function updateJuteProcessingSubCategory()
	{
		$jpsc_id = $this->input->post('jpsc_id');
		$jpsc_jpc_id = $this->input->post('jpsc_jpc_id');
		$jpsc_title = $this->input->post('jpsc_title');
		$jpsc_rate = $this->input->post('jpsc_rate');
		$data = array(
			'jpsc_id' => $jpsc_id,
			'jpsc_jpc_id' => $jpsc_jpc_id,
			'jpsc_title' => $jpsc_title,
			'jpsc_rate' => $jpsc_rate,
			'jpsc_updated_at' => get_current_time(),
			'jpsc_updated_by' => $this->session->userdata('currentActiveId')
		);
		// print_r($data);
		$this->M_labour->updateJuteProcessingSubCategory($jpsc_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_jute_processing_subcategory');
	}

	//Delete Data from data Table
	public function deleteJuteProcessingSubCategory()
	{
		$jpsc_id = $this->input->get('jpsc_id');
		$data = array(
			'jpsc_status' => 0,
			'jpsc_updated_at' => get_current_time(),
			'jpsc_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateJuteProcessingSubCategory($jpsc_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_jute_processing_subcategory');
	}
	//Delete Data from data Table
	public function inactiveJuteProcessingSubCategory()
	{
		$jpsc_id = $this->input->get('jpsc_id');
		$data = array(
			'jpsc_status' => 0,
			'jpsc_updated_at' => get_current_time(),
			'jpsc_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_labour->updateJuteProcessingSubCategory($jpsc_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_jute_processing_subcategory');
	}
}
