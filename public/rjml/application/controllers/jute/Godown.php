<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Godown extends CI_Controller
{
	private $main_layout = '';
	private $side_menu = '';

	public function __construct()
	{
		parent::__construct();
		$this->main_layout = 'backend/master_layout';

		$current_user_type = $this->session->userdata('current_type');
		if ($current_user_type == 10) {
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

		$this->load->model('M_godown');
		$this->load->model('M_grade');
		$this->load->model('M_opening_jute');
		$this->load->model('M_financial_year');
	}

	// Add Godown Form
	public function addGodown()
	{
		$data = $this->engine->store_nav('khamal', 'add_godown', 'Add Godown');
		$data['list'] = $this->M_godown->getGodown();
		$path = 'backend/jute/godown/add_godown';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertGodown()
	{
		$g_id = $this->input->post('g_id');
		$g_title = $this->input->post('g_title');
		$g_description = $this->input->post('g_description');
		$data = array(
			'g_id' => $g_id,
			'g_title' => $g_title,
			'g_description' => $g_description,
			'g_status' => 1,
			'g_created_at' => get_current_time(),
			'g_created_by' => $this->session->userdata('currentActiveId'),
		);

		$id = $this->M_godown->insertGodown($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been added successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_godown');
	}
	// Update Data from data Table
	public function updateGodown()
	{
		$g_id = $this->input->post('g_id');
		$g_title = $this->input->post('g_title');
		$g_description = $this->input->post('g_description');
		$data = array(
			'g_id' => $g_id,
			'g_title' => $g_title,
			'g_description' => $g_description,
			'g_updated_at' => get_current_time(),
			'g_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_godown->updateGodown($g_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_godown');
	}

	//Delete Data from data Table
	public function deleteGodown()
	{
		$g_id = $this->input->get('g_id');
		$data = array(
			'g_status' => 0,
			'g_updated_at' => get_current_time(),
			'g_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_godown->updateGodown($g_id, $data);
		set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_godown');
	}
	//Delete Data from data Table
	public function inactiveGodown()
	{
		$g_id = $this->input->get('g_id');
		$data = array(
			'g_status' => 0,
			'g_updated_at' => get_current_time(),
			'g_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_godown->updateGodown($g_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_godown');
	}

	public function ajaxGodownDuplicateNameAlert()
	{
		$ajaxGodownDuplicateNameAlert = $this->input->post('godownNameWarning');
		$valid = $this->M_godown->ajaxGodownDuplicateNameCheck($ajaxGodownDuplicateNameAlert);
		if ($valid) {
			echo $valid->g_title;
		} else {
			echo 'no';
		}
	}

	/* ======================== Godown Reports  ======================== */
	// Godown Reports Form
	public function cleanx($string)
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	//Show Data under godown_reports.php file
	public function godownReportsOld()
	{
		$data = $this->engine->store_nav('godown', 'godown_reports_old', 'Godown Reports Old');

		$grade = $this->M_grade->getJuteGrade();

		/* Start Dynamic sql */
		$pp = 'SELECT ';
		$ll = 0;
		//echo $pp . "<br>";
		foreach ($grade->result() as $key => $value) {
			$ll++;
			$pp = $pp . "SUM(case jpiv_j_g_id when '$value->j_g_id' then jpiv_weight_mds else 0 end) as $value->j_g_title";
			//echo $pp . "<br>";

			//$all < 8 এইখোনে 8 হল গ্রেড আডি
			if ($ll < 8) {
				$pp = $pp . ',';
			}
			//echo $pp . 3 . "<br>";
		}
		$pp = $pp . ' FROM jute_purchase_invoice_value ';
		//echo $pp . "<br>";
		// echo "hi" . "<br>";
		// die();
		/* End Dynamic sql */

		/* Ai SQL ta ka upara dinamic kora hoisa
        $sql = "SELECT
        SUM(case jpiv_j_g_id when '1' then jpiv_weight_mds else 0 end) as d1,
        SUM(case jpiv_j_g_id when '2' then jpiv_weight_mds else 0 end) as d2,
        SUM(case jpiv_j_g_id when '3' then jpiv_weight_mds else 0 end) as d3,
        SUM(case jpiv_j_g_id when '4' then jpiv_weight_mds else 0 end) as milc,
        SUM(case jpiv_j_g_id when '5' then jpiv_weight_mds else 0 end) as smr
        FROM jute_purchase_invoice_value";
         */

		$Opening_Quantity_Monds = $this->M_godown->sql_excute($pp)->result()[0];
		$p = $this->M_godown->sql_excute($pp)->result()[0];
		$me = array();
		array_push($me, $Opening_Quantity_Monds, $p);
		$data['me'] = $me;
		$data['amiloop'] = $this->M_godown->sql_excute($pp)->result()[0];

		//x_debug($data['me']);
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['list'] = array();
		$path = 'backend/jute/godown/godown_reports_old';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function godownReportsResentOld()
	{
		$data = $this->engine->store_nav('godown', 'godown_reports', 'Godown Reports');

		$data['grades'] = $this->M_grade->getJuteGrade();

		$path = 'backend/jute/godown/godownReportsResentOld';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	public function godownReports()
	{
		$data = $this->engine->store_nav('godown', 'godown_reports', 'Godown Reports');
		$year = $this->input->post("y");
		$month = $this->input->post("m");

		if (!$year) {
			$y = year();
		} else {
			$y = $year;
		}
		if (!$month) {
			$m = month();
		} else {
			$m = $month;
		}

		$data['helperCall'] = $this->ajaxButtonAvailabilityCheck($m, $y);
		//x_debug($data['helperCall']);
		$sql = "SELECT * FROM financial_year WHERE " . $y . $m . " BETWEEN DATE_FORMAT(`fy_start_date`,'%Y%m') AND  DATE_FORMAT(`fy_end_date`,'%Y%m')";
		$fy_id = $this->db->query($sql)->row();

		if ($fy_id) {
			$fy_id = $fy_id->fy_id;
		} else {
			$fy_id = 0;
		}

		$data['fy_id'] = $fy_id;
		$data['m'] = $m;
		$data['y'] = $y;
		$data['grades'] = $this->M_grade->getJuteGrade();

		$path = 'backend/jute/godown/godown_reports';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Factory Reports Form
	public function factoryReports()
	{
		$data = $this->engine->store_nav('godown', 'factory_reports', 'Factory Reports');
		$data['list'] = array();
		$path = 'backend/jute/godown/factory_reports';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Opening Jute add Form
	public function addOpeningJute()
	{
		$data = $this->engine->store_nav('godown', 'add_opening_jute', 'Add Opening Jute');
		$data['list'] = array();
		$path = 'backend/jute/godown/add_opening_jute';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Opening Jute View Form
	public function listOpeningJute()
	{
		$data = $this->engine->store_nav('godown', 'list_opening_jute', 'Opening Jute');
		$data['list'] = array();
		$path = 'backend/jute/godown/list_opening_jute';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}




	/* ======================== Jute Calculation Helper  ======================== */
	public function addJuteCalculationHelper()
	{
		$data = $this->engine->store_nav('godown', 'add_jute_calculation_helper', 'Jute Calculation Helper');
		$data['financial_years'] = $this->Common->get_data_multi_conditional('financial_year', ['fy_status' => 1]);
		$data['list'] = $this->M_godown->getJuteCalculationHelper();
		$path = 'backend/jute/godown/add_jute_calculation_helper';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	public function insertJuteCalculationHelper()
	{
		$jch_month = $this->input->post('jch_month');
		$jch_year = $this->input->post('jch_year');
		$jch_cutting_rate = $this->input->post('jch_cutting_rate');
		$jch_bad_provision_percentage = $this->input->post('jch_bad_provision_percentage');
		$jch_cutting_percentage = $this->input->post('jch_cutting_percentage');


		$startYearMonth = $jch_year . "-" . $jch_month;

		$jch_start_date = date('Y-m-01', strtotime($startYearMonth));
		$jch_end_date = date('Y-m-t', strtotime($startYearMonth));


		$juteCalculationCheckCurrentMonth = $this->M_godown->juteCalculationHelperYearMonthCheck($jch_start_date, $jch_end_date);


		$valid = $this->M_godown->ajaxFinancialYear($jch_start_date);

		$financial = date("Y-m", strtotime($valid->fy_start_date));

		$first_month_first_date = date('Y-m-01', strtotime($financial));
		$first_month_last_date = date('Y-m-t', strtotime($financial));

		//x_debug($end_p);

		$financialYearStartMonth = $this->M_godown->juteCalculationHelperYearMonthCheck($first_month_first_date, $first_month_last_date);


		$getPreviousMonth = date('Y-m', strtotime('-1 months', strtotime($startYearMonth)));

		$previous_start_date = date('Y-m-01', strtotime($getPreviousMonth));
		$previous_end_date = date('Y-m-t', strtotime($getPreviousMonth));

		//x_debug($previous_end_date);

		$previousMonthValueCheck = $this->M_godown->juteCalculationHelperYearMonthCheck($previous_start_date, $previous_end_date);


		$data = array(
			'jch_start_date' => $jch_start_date,
			'jch_end_date' => $jch_end_date,
			'jch_fy_id' => $valid->fy_id,
			'jch_cutting_rate' => $jch_cutting_rate,
			'jch_bad_provision_percentage' => $jch_bad_provision_percentage,
			'jch_cutting_percentage' => $jch_cutting_percentage,
			'jch_status' => 1,
			'jch_created_at' => get_current_time(),
			'jch_created_by' => $this->session->userdata('currentActiveId'),
		);

		if ($juteCalculationCheckCurrentMonth) {
			set_confirmation_msg('TRUE', 'You have already added this year & month value.', '');
		} else {
			if ($financialYearStartMonth) {
				if ($previousMonthValueCheck) {
					set_confirmation_msg('TRUE', 'Data Added', '');

					$this->M_godown->insertData('jute_calculation_helper', $data);
					set_confirmation_msg('TRUE', 'Your data has been added successfully.', '');
				} else {
					set_confirmation_msg('TRUE', 'Please enter previous months value.', '');
				}
			} else {
				if ($jch_start_date == $first_month_first_date) {
					$this->M_godown->insertData('jute_calculation_helper', $data);
					set_confirmation_msg('TRUE', 'Your data has been added successfully.', '');
				} else {
					set_confirmation_msg('TRUE', 'Please enter first month of this financial year.', '');
				}
			}
		}

		redirect('add_jute_calculation_helper');
	}


	// public function updateJuteCalculationHelper()
	// {
	//     $jch_id = $this->input->post('jch_id');
	//     $jch_date = $this->input->post('jch_date_for_edit');
	//     $jch_date = date("Y-m-d", strtotime($jch_date));
	//     $jch_fy_id = $this->input->post('jch_fy_id');
	//     $jch_cutting_rate = $this->input->post('jch_cutting_rate');
	//     $jch_bad_provision_percentage = $this->input->post('jch_bad_provision_percentage');
	//     $jch_cutting_percentage = $this->input->post('jch_cutting_percentage');
	//     $data = array(
	//         'jch_id' => $jch_id,
	//         'jch_date' => $jch_date,
	//         'jch_fy_id' => $jch_fy_id,
	//         'jch_cutting_rate' => $jch_cutting_rate,
	//         'jch_bad_provision_percentage' => $jch_bad_provision_percentage,
	//         'jch_cutting_percentage' => $jch_cutting_percentage,
	//         'jch_updated_at' => get_current_time(),
	//         'jch_updated_by' => $this->session->userdata('currentActiveId')
	//     );
	//     $this->M_godown->updateJuteCalculationHelper($jch_id, $data);

	//     redirect('add_jute_calculation_helper');
	// }

	// public function deleteJuteCalculationHelper()
	// {
	//     $jch_id = $this->input->get('jch_id');
	//     // x_debug($jch_id);
	//     $data = array(
	//         'jch_status' => 0,
	//         'jch_updated_at' => get_current_time(),
	//         'jch_updated_by' => $this->session->userdata('currentActiveId')
	//     );
	//     $this->M_godown->updateJuteCalculationHelper($jch_id, $data);

	//     redirect('add_jute_calculation_helper');
	// }


	//Permanently Delete
	public function permanentlyDeleteJuteCalculationHelper()
	{
		$jch_id = $this->input->get('jch_id');
		$this->Common->delete_data('jute_calculation_helper', 'jch_id', $jch_id);
		redirect('add_jute_calculation_helper');
	}

	//Financial Year Get for jute calculation helper
	public function ajaxFinancialYear()
	{
		$jch_date = $this->input->post('jch_start_date');
		$jch_start_date = date('Y-m-01', strtotime($jch_date));
		$valid = $this->M_godown->ajaxFinancialYear($jch_start_date);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	//Financial Year Get for godown report
	public function ajaxJuteCalculationHelperExistingValueCheck()
	{
		$jch_date = $this->input->post('jch_start_date');
		$jch_start_date = date('Y-m-01', strtotime($jch_date));
		$jch_end_date = date('Y-m-t', strtotime($jch_date));
		$valid = $this->M_godown->juteCalculationHelperYearMonthCheck($jch_start_date, $jch_end_date);
		if ($valid) {
			echo $valid->jch_id;
		}
	}


	//Financial Year Get for godown report
	public function ajaxFinancialYearCheckMonthYearForFilter()
	{
		$catching_date = date("Y-m-d", strtotime($this->input->post('catching_date')));
		$valid = $this->M_godown->ajaxFinancialYear($catching_date);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}



	// Redundend Method, from Opening_jute [Helping function To send opening summary id under godown report to update opening value]

	public function ajaxButtonAvailabilityCheck($month, $year)
	{

		$monthYear = $year . "-" . $month;
		$currentDate = date('Y-m');
		$openingValue = $this->M_opening_jute->getOpeningJuteByMonth($month, $year);

		$nextMonth = $month + 1;
		if ($nextMonth == 13) {
			$nextMonth = 1;
			$year = $year + 1;
		}
		$nextMonthYear = $year . "-" . $nextMonth;
		$nextMonthYear = date("Y-m-d", strtotime($nextMonthYear));

		$fy_info = $this->M_opening_jute->ajaxFinancialYear($nextMonthYear);

		$nextMonthOpeningValue = $this->M_opening_jute->getOpeningJuteByMonth($nextMonth, $year);

		$afterNextMonth = $nextMonth + 1;
		if ($afterNextMonth == 13) {
			$afterNextMonth = 1;
			$year = $year + 1;
		}
		$afterNextMonthOpeningValue = $this->M_opening_jute->getOpeningJuteByMonth($afterNextMonth, $year);



		if ($monthYear < $currentDate && $openingValue && $fy_info && empty($nextMonthOpeningValue)) {
			$data['button'] = 'add';
			return 0;
		} elseif ($monthYear < $currentDate && $openingValue && $fy_info && $nextMonthOpeningValue && empty($afterNextMonthOpeningValue)) {
			$data['button'] = 'update';
			$data['openingSummaryId'] = $nextMonthOpeningValue->ops_id;
			//echo 'update';
			return ($nextMonthOpeningValue->ops_id);
		} else {
			$data['hhhh'] = 'heee';
			return 0;
		}
	}









	//End
}
