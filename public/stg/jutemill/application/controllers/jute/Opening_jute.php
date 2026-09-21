<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opening_jute extends CI_Controller
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

		$this->load->model('M_grade');
		$this->load->model('M_opening_jute');
		$this->load->model('M_financial_year');
	}

	// Opening Jute add Form 
	public function addOpeningJute()
	{
		$data = $this->engine->store_nav('opening_jute', 'add_opening_jute', 'Add Opening Jute');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/opening_jute/add_opening_jute';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//data will come from Godown Report Page
	public function insertOpeningJute()
	{
		// echo "hello";
		// $post = $this->input->post();
		// x_debug($post);

		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$nextMonth = $month + 1;
		if ($nextMonth == 13) {
			$nextMonth = 1;
			$year = $year + 1;
		}
		$nextMonthYear = $year . "-" . $nextMonth;
		$nextMonthYear = date("Y-m-d", strtotime($nextMonthYear));

		$opening_date = $nextMonthYear;
		$fy_info = $this->M_opening_jute->ajaxFinancialYear($nextMonthYear);
		$opening_fy_id = $fy_info->fy_id;

		$opening_date = date("Y-m-d", strtotime($opening_date));

		$idForUpdate = $this->input->post('idForUpdate');
		if ($idForUpdate) {
			$opv_value_id = $this->input->post('opv_value_id');
			$opening_mds = $this->input->post('opening_mds');
			$opening_ave = $this->input->post('opening_ave');
			$opening_amount = $this->input->post('opening_amount');

			for ($i = 0; $i < count($opening_mds); $i++) {
				$updateData = array(
					'opv_mds' => $opening_mds[$i],
					'opv_ave' => $opening_ave[$i],
					'opv_amount' => $opening_amount[$i],
					'opv_updated_at' => get_current_time(),
					'opv_updated_by' => $this->session->userdata('currentActiveId')
				);
				$this->Common->update_data('opening_value', 'opv_id', $opv_value_id[$i], $updateData);
			}

			$ops_id = $idForUpdate;
			$opening_date = $opening_date;
			$opening_fy_id = $opening_fy_id;
			$opening_mds_total = $this->input->post('opening_mds_total');
			$opening_ave_total = $this->input->post('opening_ave_total');
			$opening_amount_total = $this->input->post('opening_amount_total');

			$updateData = array(
				'ops_date' => $opening_date,
				'ops_fy_id' => $opening_fy_id,
				'ops_mds_total' => $opening_mds_total,
				'ops_ave_total' => $opening_ave_total,
				'ops_amount_total' => number_format($opening_amount_total, 2, '.', ''),
				'ops_updated_at' => get_current_time(),
				'ops_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('opening_summary', 'ops_id', $ops_id, $updateData);

			$opv_kf_id = $this->input->post('opv_kf_id');
			$opening_mds_kf = $this->input->post('opening_mds_kf');
			$opening_ave_kf = $this->input->post('opening_ave_kf');
			$opening_amount_kf = $this->input->post('opening_amount_kf');
			$kfValueData = array(
				'opv_mds' => $opening_mds_kf,
				'opv_ave' => $opening_ave_kf,
				'opv_amount' => $opening_amount_kf,
				'opv_j_g_id' => "kf",
				'opv_updated_at' => get_current_time(),
				'opv_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('opening_value', 'opv_id', $opv_kf_id, $kfValueData);

			$opv_wh_id = $this->input->post('opv_wh_id');
			$opening_mds_wh = $this->input->post('opening_mds_wh');
			$opening_ave_wh = $this->input->post('opening_ave_wh');
			$opening_amount_wh = $this->input->post('opening_amount_wh');
			$whValueData = array(
				'opv_mds' => $opening_mds_wh,
				'opv_ave' => $opening_ave_wh,
				'opv_amount' => $opening_amount_wh,
				'opv_j_g_id' => "wh",
				'opv_updated_at' => get_current_time(),
				'opv_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('opening_value', 'opv_id', $opv_wh_id, $whValueData);
		} else {
			$opening_mds_total = $this->input->post('opening_mds_total');
			$opening_ave_total = $this->input->post('opening_ave_total');
			$opening_amount_total = $this->input->post('opening_amount_total');

			$openingSummaryData = array(
				'ops_date' => $opening_date,
				'ops_fy_id' => $opening_fy_id,
				'ops_mds_total' => $opening_mds_total,
				'ops_ave_total' => $opening_ave_total,
				'ops_amount_total' => number_format($opening_amount_total, 2, '.', ''),
				'ops_status' => 1,
				'ops_created_at' => get_current_time(),
				'ops_created_by' => $this->session->userdata('currentActiveId')
			);

			$isOpeningId = $this->M_opening_jute->insertDataWithTableName('opening_summary', $openingSummaryData);


			// Value Table
			$opening_j_g_id = $this->input->post('opening_j_g_id');
			$opening_mds = $this->input->post('opening_mds');
			$opening_ave = $this->input->post('opening_ave');
			$opening_amount = $this->input->post('opening_amount');
			$opening_mds_kf = $this->input->post('opening_mds_kf');
			$opening_mds_wh = $this->input->post('opening_mds_wh');
			$opening_ave_kf = $this->input->post('opening_ave_kf');
			$opening_ave_wh = $this->input->post('opening_ave_wh');
			$opening_amount_kf = $this->input->post('opening_amount_kf');
			$opening_amount_wh = $this->input->post('opening_amount_wh');


			for ($i = 0; $i < count($opening_mds); $i++) {
				$openingValueData = array(
					'opv_ops_id' => $isOpeningId,
					'opv_j_g_id' => $opening_j_g_id[$i],
					'opv_mds' => $opening_mds[$i],
					'opv_ave' => $opening_ave[$i],
					'opv_amount' => $opening_amount[$i],
					'opv_status' => 1,
					'opv_wh_kf_status' => 0,
					'opv_created_at' => get_current_time(),
					'opv_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_opening_jute->insertDataWithTableName('opening_value', $openingValueData);
			}

			$openingValueDataKf = array(
				'opv_ops_id' => $isOpeningId,
				'opv_j_g_id' => 'kf',
				'opv_mds' => $opening_mds_kf,
				'opv_ave' => $opening_ave_kf,
				'opv_amount' => $opening_amount_kf,
				'opv_status' => 1,
				'opv_wh_kf_status' => 1,
				'opv_created_at' => get_current_time(),
				'opv_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_opening_jute->insertDataWithTableName('opening_value', $openingValueDataKf);

			$openingValueDataWh = array(
				'opv_ops_id' => $isOpeningId,
				'opv_j_g_id' => 'wh',
				'opv_mds' => $opening_mds_wh,
				'opv_ave' => $opening_ave_wh,
				'opv_amount' => $opening_amount_wh,
				'opv_status' => 1,
				'opv_wh_kf_status' => 2,
				'opv_created_at' => get_current_time(),
				'opv_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_opening_jute->insertDataWithTableName('opening_value', $openingValueDataWh);
		}
		redirect('list_opening_jute');
	}

	public function updateOpeningJute()
	{
		// $ffff = $this->input->post();
		// x_debug($ffff);
		$opv_value_id = $this->input->post('opv_value_id');
		$opening_mds = $this->input->post('opening_mds');
		$opening_ave = $this->input->post('opening_ave');
		$opening_amount = $this->input->post('opening_amount');
		$opv_value_id = $this->input->post('opv_value_id');

		for ($i = 0; $i < count($opening_mds); $i++) {
			$updateData = array(
				'opv_mds' => $opening_mds[$i],
				'opv_ave' => $opening_ave[$i],
				'opv_amount' => $opening_amount[$i],
				'opv_updated_at' => get_current_time(),
				'opv_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('opening_value', 'opv_id', $opv_value_id[$i], $updateData);
		}

		$ops_id = $this->input->post('ops_id');
		$opening_date = $this->input->post('opening_date');
		$opening_date = date("Y-m-d", strtotime($opening_date));
		$opening_fy_id = $this->input->post('opening_fy_id');
		$opening_mds_total = $this->input->post('opening_mds_total');
		$opening_ave_total = $this->input->post('opening_ave_total');
		$opening_amount_total = $this->input->post('opening_amount_total');

		$updateData = array(
			'ops_date' => $opening_date,
			'ops_fy_id' => $opening_fy_id,
			'ops_mds_total' => $opening_mds_total,
			'ops_ave_total' => $opening_ave_total,
			'ops_amount_total' => number_format($opening_amount_total, 2, '.', ''),
			'ops_created_at' => get_current_time(),
			'ops_created_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_summary', 'ops_id', $ops_id, $updateData);

		$opv_kf_id = $this->input->post('opv_kf_id');
		$opening_mds_kf = $this->input->post('opening_mds_kf');
		$opening_ave_kf = $this->input->post('opening_ave_kf');
		$opening_amount_kf = $this->input->post('opening_amount_kf');
		$kfValueData = array(
			'opv_mds' => $opening_mds_kf,
			'opv_ave' => $opening_ave_kf,
			'opv_amount' => $opening_amount_kf,
			'opv_j_g_id' => "kf",
			'opv_updated_at' => get_current_time(),
			'opv_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_value', 'opv_id', $opv_kf_id, $kfValueData);

		$opv_wh_id = $this->input->post('opv_wh_id');
		$opening_mds_wh = $this->input->post('opening_mds_wh');
		$opening_ave_wh = $this->input->post('opening_ave_wh');
		$opening_amount_wh = $this->input->post('opening_amount_wh');
		$whValueData = array(
			'opv_mds' => $opening_mds_wh,
			'opv_ave' => $opening_ave_wh,
			'opv_amount' => $opening_amount_wh,
			'opv_j_g_id' => "wh",
			'opv_updated_at' => get_current_time(),
			'opv_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_value', 'opv_id', $opv_wh_id, $whValueData);

		redirect('list_opening_jute');
	}




	// Opening Jute View Form 
	public function listOpeningJute()
	{
		$data = $this->engine->store_nav('opening_jute', 'list_opening_jute', 'View Opening Jute');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['list'] = $this->M_opening_jute->getOpeningJuteSummary();
		$path = 'backend/jute/opening_jute/list_opening_jute';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}



	//Financial Year Get
	public function ajaxFinancialYear()
	{
		$opening_date = date("Y-m-d", strtotime($this->input->post('opening_date')));
		$valid = $this->M_opening_jute->ajaxFinancialYear($opening_date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}
	//Check Month
	public function ajaxMonthYear()
	{
		$m = date("m", strtotime($this->input->post('date')));
		$y = date("Y", strtotime($this->input->post('date')));
		$true = $this->M_opening_jute->ajaxFindMonth($m, $y);
		if ($true) {
			echo $true->ops_date;
		} else {
			echo "no";
		}
	}



	public function ajaxFinancialYearWiseOpeningCheck()
	{
		$testId = $this->input->post('testId');
		$valid = $this->M_opening_jute->ajaxMFinancialYearWiseOpeningCheck($testId);
		if ($valid) {
			echo $valid->ops_fy_id;
		} else {
			echo "no";
		}
	}

	//To show Submit Closing Button in Godown Report page
	public function ajaxButtonAvailabilityCheck()
	{
		$month = $this->input->post('month');
		$year = $this->input->post('year');
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
			echo json_encode($data);
		} elseif ($monthYear < $currentDate && $openingValue && $fy_info && $nextMonthOpeningValue && empty($afterNextMonthOpeningValue)) {
			$data['button'] = 'update';
			$data['openingSummaryId'] = $nextMonthOpeningValue->ops_id;
			//echo 'update';
			echo json_encode($data);
		} else {
			$data['hhhh'] = 'heee';
			echo json_encode($data);
		}
	}





	//End
}
