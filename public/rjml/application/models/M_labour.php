<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class M_labour extends CI_model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/* ======================= Labour-> Attendance =========================== */
	//Insert data into database
	public function insertLabourAttendance($data)
	{
		$this->db->insert('labour_attendance', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	//Get data from database
	public function getLabourAttendance()
	{
		$this->db->where('l_a_status', 1);
		$this->db->order_by('l_a_labour_id', 'asc');
		$query = $this->db->get('labour_attendance');
		return $query;
	}
	// Get Rate By Labour Id
	public function getHourlyRateByLabourId($labour_id)
	{
		$this->db->where('lhr_status', 1);
		$this->db->where('lhr_l_id', $labour_id);
		$query = $this->db->get('labour_hourly_rate');
		return $query->row();
	}

	//Get Labour Daily Data
	public function getLabourDailyData($date, $labourId)
	{
		$this->db->where('l_a_status', 1);
		$this->db->where('l_a_attendance_status', 1);
		$this->db->where('l_a_date', $date);
		$this->db->where('l_a_labour_id', $labourId);
		$query = $this->db->get('labour_attendance');
		return $query->row();
	}
	//Get data from database by ID
	// public function getLabourAttendanceById($l_a_id)
	// {
	// 	$this->db->where('l_a_id', $l_a_id);
	// 	$query = $this->db->get('labour_attendance');
	// 	return $query->row();
	// }
	//Update data from database
	// public function updateLabourAttendance($l_a_id, $data)
	// {
	// 	$this->db->where('l_a_id', $l_a_id);
	// 	$this->db->update('labour_attendance', $data);
	// }

	public function fetch_labour($l_sd_id)
	{
		$this->db->where('l_sd_id', $l_sd_id);
		$this->db->order_by("l_name", "ASC");
		$query = $this->db->get("labour");
		$output = '';

		foreach ($query->result() as $row)
			$output .= '<tr><td class="align-middle"><input type="hidden" name="l_a_labour_id[]" value="' . $row->l_id . '">' . $row->l_name . '</td>
			<td class="align-middle"><input type="hidden" name="l_a_l_card_no[]">' . $row->l_card_no . '</td>
			<td><input type="number" name="l_a_shift_a[]" class="form-control" id="exampleInputEmail1" placeholder="Shift-A Hour"></td>
			<td><input type="number" name="l_a_shift_b[]" class="form-control" id="exampleInputEmail1" placeholder="Shift-B Hour"></td>
			<td><input type="number" name="l_a_shift_c[]" class="form-control" id="exampleInputEmail1" placeholder="Shift-C Hour"></td>
			<td><input type="number" name="l_a_holiday_hour[]" class="form-control" id="exampleInputEmail1" placeholder="Holiday Hour"></td>
			<td><input type="number" name="l_a_arrear_hour[]" class="form-control" id="exampleInputEmail1" placeholder="Arrear Hour"></td>
			<td class="align-middle">
			<div class="row">
				<div class="form-group col-sm-12">
					<select type="text" name="l_a_attendance_status[]" class="form-control select2" style="width: 100%;">
						<option>Please Select</option>
						<option value="0">Absent</option>
						<option value="1" selected>Present</option>
					</select>
				</div>
			</div>
			</td>
		</tr>';
		return $output;
	}

	/* =========================== Labour-> Rate Per Hour =========================== */
	//Insert data into database
	public function insertLabourBonus($data)
	{
		$this->db->insert('labour_bonus', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	//Get data from database
	public function getLabourBonus()
	{
		$this->db->where('lb_status', 1);
		$query = $this->db->get('labour_bonus');
		return $query;
	}
	//Get data from database by ID
	public function getLabourBonusById($lb_id)
	{
		$this->db->where('lb_id', $lb_id);
		$query = $this->db->get('labour_bonus');
		return $query->row();
	}
	//Update data from database
	public function updateLabourBonus($lb_id, $data)
	{
		$this->db->where('lb_id', $lb_id);
		$this->db->update('labour_bonus', $data);
	}

	/* =========================== Labour-> Rate Per Hour =========================== */
	//Insert data into database
	public function insertHourlyRate($data)
	{
		$this->db->insert('labour_hourly_rate', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	//Get data from database
	public function getHourlyRate()
	{
		$this->db->where('lhr_status', 1);
		$query = $this->db->get('labour_hourly_rate');
		return $query;
	}
	// Get Sub Department By Labour Id
	public function getSubDepartmentByLabourId($labour_iid)
	{
		$this->db->where('sd_status', 1);
		$this->db->where('sd_id', $labour_iid);
		$query = $this->db->get('sub_department');
		return $query->row();
	}
	//Get data from database by ID
	public function getHourlyRateById($lhr_id)
	{
		$this->db->where('lhr_id', $lhr_id);
		$query = $this->db->get('labour_hourly_rate');
		return $query->row();
	}
	//Update data from database
	public function updateHourlyRate($lhr_id, $data)
	{
		$this->db->where('lhr_id', $lhr_id);
		$this->db->update('labour_hourly_rate', $data);
	}
	/* ======================= Labour-> Labour Information =========================== */
	//Insert data into database
	public function insertLabour($data)
	{
		$this->db->insert('labour', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	//Get data from database
	public function getLabour()
	{
		$this->db->where('l_status', 1);
		$query = $this->db->get('labour');
		return $query;
	}
	//Get data from database by ID
	public function getLabourById($l_id)
	{
		$this->db->where('l_id', $l_id);
		$query = $this->db->get('labour');
		return $query->row();
	}
	//Update data from database
	public function updateLabour($l_id, $data)
	{
		$this->db->where('l_id', $l_id);
		$this->db->update('labour', $data);
	}
	//Get Sub Department For Cascading/Dependent Dropdown 
	public function fetch_sub_department($sd_d_id)
	{
		$this->db->where('sd_d_id', $sd_d_id);
		$this->db->order_by("sd_title", "ASC");
		$query = $this->db->get("sub_department");
		$output = '<option value="">Select Sub Department</option>';
		foreach ($query->result() as $row)
			$output .= '<option value="' . $row->sd_id . '">' . $row->sd_title . '</option>';
		return $output;
	}

	/* =========================== Labour-> Labour Designation =========================== */
	//Insert data into database
	public function insertLabourDesignation($data)
	{
		$this->db->insert('labour_designation', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	//Get data from database
	public function getLabourDesignation()
	{
		$this->db->where('l_d_status', 1);
		$query = $this->db->get('labour_designation');
		return $query;
	}
	//Get data from database by ID
	public function getLabourDesignationById($l_d_id)
	{
		$this->db->where('l_d_id', $l_d_id);
		$query = $this->db->get('labour_designation');
		return $query->row();
	}
	//Update data from database
	public function updateLabourDesignation($l_d_id, $data)
	{
		$this->db->where('l_d_id', $l_d_id);
		$this->db->update('labour_designation', $data);
	}
	/* =========================== Labour-> Jute Processing Category =========================== */
	//Insert data into database
	public function insertJuteProcessingCategory($data)
	{
		$this->db->insert('jute_processing_category', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	//Get data from database
	public function getJuteProcessingCategory()
	{
		$this->db->where('jpc_status', 1);
		$query = $this->db->get('jute_processing_category');
		return $query;
	}
	//Get data from database by ID
	public function getJuteProcessingCategoryById($jpc_id)
	{
		$this->db->where('jpc_id', $jpc_id);
		$query = $this->db->get('jute_processing_category');
		return $query->row();
	}
	//Update data from database
	public function updateJuteProcessingCategory($jpc_id, $data)
	{
		$this->db->where('jpc_id', $jpc_id);
		$this->db->update('jute_processing_category', $data);
	}
	/* ======================= Labour-> Jute Processing Sub Category =========================== */
	//Insert data into database
	public function insertJuteProcessingSubCategory($data)
	{
		$this->db->insert('jute_processing_sub_category', $data);
		$returnValue = $this->db->insert_id();
		return $returnValue;
	}
	//Get data from database
	public function getJuteProcessingSubCategory()
	{
		$this->db->where('jpsc_status', 1);
		$query = $this->db->get('jute_processing_sub_category');
		return $query;
	}
	//Get data from database by ID
	public function getJuteProcessingSubCategoryById($jpsc_id)
	{
		$this->db->where('jpsc_id', $jpsc_id);
		$query = $this->db->get('jute_processing_sub_category');
		return $query->row();
	}
	//Update data from database
	public function updateJuteProcessingSubCategory($jpsc_id, $data)
	{
		$this->db->where('jpsc_id', $jpsc_id);
		$this->db->update('jute_processing_sub_category', $data);
	}
}
