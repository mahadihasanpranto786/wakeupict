<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adjustment extends CI_Controller
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

		$this->load->model('M_grade');
		$this->load->model('M_adjustment');
		$this->load->model('M_financial_year');
	}

	// Add Adjustment form
	public function addAdjustment()
	{
		$data = $this->engine->store_nav('adjustment', 'add_adjustment', 'Add Adjustment');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/setup/adjustment/add_adjustment';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// List Adjustment form
	public function listAdjustment()
	{
		$data = $this->engine->store_nav('adjustment', 'list_adjustment', 'List Adjustment');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['list'] = $this->M_adjustment->getAdjustmentSummary();
		$path = 'backend/setup/adjustment/list_adjustment';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Edit Adjustment Form
	public function editAdjustment()
	{
		$data = $this->engine->store_nav('adjustment', 'edit_adjustment', 'update Adjustment');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$adjs_id = $this->input->get('adjs_id');

		$date = $this->input->get('adjs_date');
		// x_debug($date);
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));

		$nextMonth = $month + 1;
		if ($nextMonth == 13) {
			$updateMonth = 1;
			$updateYear = $year + 1;

			$returnData = $this->Common->get_single_row_information_multi_conditional('opening_summary', ['year(ops_date) =' => $updateYear, 'month(ops_date) =' => $updateMonth, 'ops_status' => 1]);
		} else {
			$returnData = $this->Common->get_single_row_information_multi_conditional('opening_summary', ['year(ops_date) =' => $year, 'month(ops_date) =' => $nextMonth, 'ops_status' => 1]);
		}

		if ($returnData) {
			set_confirmation_msg("$returnData", '', "Sorry! You can't update this item because you have already added next month opening.");

			redirect('list_adjustment');
		} else {
			$data['singleData'] = $this->Common->get_single_row_information('adjustment_summary', 'adjs_id', $adjs_id);

			$path = 'backend/setup/adjustment/edit_adjustment';
		}

		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Adjustment
	public function insertAdjustment()
	{
		// Summary table
		$adj_date = $this->input->post('adjv_date');
		$adjs_fy_id = $this->input->post('adjv_fy_id');
		$adj_date = date("Y-m-d", strtotime($adj_date));
		$adj_total = $this->input->post('adjv_total');


		$currentYearMonth = date("Y-m", strtotime($adj_date));

		$y = date("Y", strtotime($adj_date));
		$m = date("m", strtotime($adj_date));

		$currentMonthAdjustmentCheck = $this->M_adjustment->ajaxFindMonth($m, $y);


		$financialYear = $this->M_adjustment->ajaxFinancialYear($adj_date);

		$financial = date("Y-m", strtotime($financialYear->fy_start_date));

		$financial_first_month = date("m", strtotime($financial));
		$financial_first_year = date("Y", strtotime($financial));

		$financialYearStartMonth = $this->M_adjustment->ajaxFindMonth($financial_first_month, $financial_first_year);

		$generatePreviousMonth = date('Y-m', strtotime('-1 months', strtotime($adj_date)));

		$previousMonth = date('m', strtotime($generatePreviousMonth));
		$previousYear = date('Y', strtotime($generatePreviousMonth));

		$previousMonthValueCheck = $this->M_adjustment->ajaxFindMonth($previousMonth, $previousYear);

		$currentMonthAdjustmentCheck = $this->M_adjustment->ajaxFindMonth($m, $y);



		$summaryData = array(
			'adjs_date' => $adj_date,
			'adjs_fy_id' => $adjs_fy_id,
			'adjs_total' => number_format($adj_total, 2, '.', ''),
			'adjs_status' => 1,
			'adjs_created_at' => get_current_time(),
			'adjs_created_by' => $this->session->userdata('currentActiveId')
		);



		if ($currentMonthAdjustmentCheck) {
			set_confirmation_msg('TRUE', 'You have already added this year & month value.', '');
		} else {
			if ($financialYearStartMonth) {
				if ($previousMonthValueCheck) {
					$adjSummaryId = $this->M_adjustment->insertData('adjustment_summary', $summaryData);

					set_confirmation_msg('TRUE', 'Your data has been added successfully.', '');
				} else {
					set_confirmation_msg('TRUE', 'Please enter previous months value.', '');
				}
			} else {
				if ($currentYearMonth == $financial) {
					$adjSummaryId = $this->M_adjustment->insertData('adjustment_summary', $summaryData);
					set_confirmation_msg('TRUE', 'Your data has been added successfully.', '');
				} else {
					set_confirmation_msg('TRUE', 'Please enter first month of this financial year.', '');
				}
			}
		}



		// Value Table
		$adjv_kf = $this->input->post('adjv_kf');
		$adjv_wh = $this->input->post('adjv_wh');
		$adjv_j_g_id = $this->input->post('adjv_j_g_id');
		$adjv_value = $this->input->post('adjv_value');

		if ($adjSummaryId) {

			for ($i = 0; $i < count($adjv_value); $i++) {
				$ValueData = array(
					'adjv_adjs_id' => $adjSummaryId,
					'adjv_j_g_id' => $adjv_j_g_id[$i],
					'adjv_value' => $adjv_value[$i],
					'adjv_status' => 1,
					'adjv_wh_kf_status' => 0,
					'adjv_created_at' => get_current_time(),
					'adjv_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_adjustment->insertData('adjustment_value', $ValueData);
			}

			$AdjValueDataKf = array(
				'adjv_adjs_id' => $adjSummaryId,
				'adjv_j_g_id' => 'kf',
				'adjv_value' => $adjv_kf,
				'adjv_status' => 1,
				'adjv_wh_kf_status' => 1,
				'adjv_created_at' => get_current_time(),
				'adjv_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_adjustment->insertData('adjustment_value', $AdjValueDataKf);


			$adjValueDataWh = array(
				'adjv_adjs_id' => $adjSummaryId,
				'adjv_j_g_id' => 'wh',
				'adjv_value' => $adjv_wh,
				'adjv_status' => 1,
				'adjv_wh_kf_status' => 2,
				'adjv_created_at' => get_current_time(),
				'adjv_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_adjustment->insertData('adjustment_value', $adjValueDataWh);
		} else {
			set_confirmation_msg('TRUE', '', 'Something is wrong.');
		}



		redirect('list_adjustment');
	}





	// Insert Adjustment
	public function updateAdjustment()
	{
		// Summary table
		$adj_date = $this->input->post('adjv_date');
		$adj_date = date("Y-m-d", strtotime($adj_date));
		$adjs_fy_id = $this->input->post('adjv_fy_id');
		$adj_total = $this->input->post('adjv_total');

		// Value Table
		$adjs_id = $this->input->post('adjs_id');
		$adjv_value = $this->input->post('adjv_value');
		$adjv_value_id = $this->input->post('adjv_value_id');

		$SummaryData = array(
			'adjs_date' => $adj_date,
			'adjs_fy_id' => $adjs_fy_id,
			'adjs_total' => number_format($adj_total, 2, '.', ''),
			'adjs_updated_at' => get_current_time(),
			'adjs_updated_by' => $this->session->userdata('currentActiveId')
		);


		$adjv_kf_id = $this->input->post('adjv_kf_id');
		$adjv_kf = $this->input->post('adjv_kf');
		$AdjValueDataKf = array(
			'adjv_value' => $adjv_kf,
			'adjv_updated_at' => get_current_time(),
			'adjv_updated_by' => $this->session->userdata('currentActiveId')
		);


		$adjv_wh_id = $this->input->post('adjv_wh_id');
		$adjv_wh = $this->input->post('adjv_wh');
		$adjValueDataWh = array(
			'adjv_value' => $adjv_wh,
			'adjv_created_at' => get_current_time(),
			'adjv_created_by' => $this->session->userdata('currentActiveId')
		);


		$generatePreviousMonth = date('Y-m', strtotime('-1 months', strtotime($adj_date)));

		$previousMonth = date('m', strtotime($generatePreviousMonth));
		$previousYear = date('Y', strtotime($generatePreviousMonth));

		$previousMonthValueCheck = $this->M_adjustment->ajaxFindMonth($previousMonth, $previousYear);


		if ($previousMonthValueCheck) {

			for ($i = 0; $i < count($adjv_value); $i++) {
				$ValueData = array(
					'adjv_value' => $adjv_value[$i],
					'adjv_updated_at' => get_current_time(),
					'adjv_updated_by' => $this->session->userdata('currentActiveId')
				);
				$this->Common->update_data('adjustment_value', 'adjv_id',  $adjv_value_id[$i],  $ValueData);
			}

			$this->Common->update_data('adjustment_summary', 'adjs_id',  $adjs_id, $SummaryData);
			$this->Common->update_data('adjustment_value', 'adjv_id',  $adjv_kf_id, $AdjValueDataKf);
			$this->Common->update_data('adjustment_value', 'adjv_id',  $adjv_wh_id, $adjValueDataWh);

			set_confirmation_msg('TRUE', 'Your data has been updated successfully.', '');
		} else {
			set_confirmation_msg('TRUE', 'Please enter previous months value.', '');
		}


		redirect('list_adjustment');
	}





	// Delete
	public function deleteAdjustment()
	{
		$adjs_id = $this->input->get('adjs_id');

		$date = $this->input->get('adjs_date');

		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));

		$nextMonth = $month + 1;
		if ($nextMonth == 13) {
			$updateMonth = 1;
			$updateYear = $year + 1;

			$returnData = $this->Common->get_single_row_information_multi_conditional('opening_summary', ['year(ops_date) =' => $updateYear, 'month(ops_date) =' => $updateMonth, 'ops_status' => 1]);
		} else {
			$returnData = $this->Common->get_single_row_information_multi_conditional('opening_summary', ['year(ops_date) =' => $year, 'month(ops_date) =' => $nextMonth, 'ops_status' => 1]);
		}

		if ($returnData) {

			set_confirmation_msg("$returnData", '', "Sorry! You can't delete this item because you have already added next month opening.");
		} else {
			$summaryData = array(
				'adjs_status' => 0,
				'adjs_updated_at' => get_current_time(),
				'adjs_updated_by' => $this->session->userdata('currentActiveId')
			);

			$this->Common->update_data('adjustment_summary', 'adjs_id',  $adjs_id, $summaryData);

			$valueData = array(
				'adjv_status' => 0,
				'adjv_updated_at' => get_current_time(),
				'adjv_updated_by' => $this->session->userdata('currentActiveId')
			);

			$this->Common->update_data('adjustment_value', 'adjv_adjs_id',  $adjs_id, $valueData);

			set_confirmation_msg('TRUE', 'Your data has been deleted successfully.', '');
		}





		redirect('list_adjustment');
	}




	//Financial Year Get
	public function ajaxFinancialYear()
	{
		$adjv_date = date("Y-m-d", strtotime($this->input->post('adjv_date')));
		$valid = $this->M_adjustment->ajaxFinancialYear($adjv_date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}
	//Year Month Check
	public function ajaxMonthYear()
	{
		$m = date("m", strtotime($this->input->post('date')));
		$y = date("Y", strtotime($this->input->post('date')));
		$true = $this->M_adjustment->ajaxFindMonth($m, $y);
		if ($true) {
			echo $true->adjs_date;
		} else {
			echo "no";
		}
	}

	//Check Month
	// public function ajaxMonthYear()
	// {
	//     $m = date("m", strtotime($this->input->post('date')));
	//     $y = date("Y", strtotime($this->input->post('date')));
	//     $true = $this->M_adjustment->ajaxFindMonth($m, $y);
	//     if ($true) {
	//         echo $true->adjs_date;
	//     } else {
	//         echo "no";
	//     }
	// }




	//End
}
