<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daily_issue extends CI_Controller
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

		$this->load->model('M_daily_issue');
		$this->load->model('M_production_unit');
		$this->load->model('M_grade');
		$this->load->model('M_area');
		$this->load->model('M_financial_year');
	}
	/* =========================== Daily Jute Requisition and Issue =========================== */
	public function viewDailyRequisitionIssue()
	{
		$data = $this->engine->store_nav('daily_issue', 'view_daily_requisition_issue', 'View Requisition & Issue');

		$res_id = $this->input->get('res_id');
		$data['requisitionSummaryId'] = $res_id; //get from jute_helper 
		$data['reView'] = $this->M_daily_issue->getDailyRequisitionById($res_id);
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/view_daily_requisition_issue';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	/* =========================== Daily Jute Issue =========================== */

	// View Daily Issue Form 
	public function viewDailyIssue()
	{
		$data = $this->engine->store_nav('daily_issue', 'view_daily_issue', 'View Daily Issue');
		$iss_id = $this->input->get('iss_id');
		$data['issueSummaryId'] = $iss_id; //get from jute_helper
		$data['isValue'] = $this->M_daily_issue->getDailyIssueValue();
		$data['isSummary'] = $this->M_daily_issue->getDailyIssueSummary();
		$data['issueView'] = $this->M_daily_issue->getDailyIssueById($iss_id);
		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/view_daily_issue';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// List Daily Issue Form 
	public function listDailyIssue()
	{
		$data = $this->engine->store_nav('daily_issue', 'list_daily_issue', 'List Daily Issue');
		$data['issuesSummary'] = $this->M_daily_issue->getDailyIssueSummary();
		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/list_daily_issue';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Daily Issue Form 
	public function addDailyIssue()
	{
		$data = $this->engine->store_nav('daily_issue', 'add_daily_issue', 'Add Daily Issue');
		$res_id = $this->input->get('res_id');
		$data['requisitionSummaryId'] = $res_id; //get from jute_helper 
		$data['reValue'] = $this->M_daily_issue->getDailyRequisitionValue();
		$data['reSummary'] = $this->M_daily_issue->getDailyRequisitionSummary();
		$data['reSummaryById'] = $this->M_daily_issue->getDailyRequisitionSummaryById($res_id);
		$data['reAddIssue'] = $this->M_daily_issue->getDailyRequisitionById($res_id);
		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/add_daily_issue';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function listAddNewDailyIssue()
	{
		$data = $this->engine->store_nav('daily_issue', 'list_add_new_daily_issue', 'Add New Daily Issue');

		$data['reSummary'] = $this->db->query("SELECT * FROM requisition_summary WHERE res_id NOT IN (SELECT iss_res_id
		FROM issue_summary WHERE iss_status = 1
	   ) AND res_status = 1");

		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/list_add_new_daily_issue';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//Insert Issue
	public function insertDailyJuteIssue()
	{
		// Issue Summary
		$iss_id = $this->input->post('isv_id');
		$iss_res_id = $this->input->post('isv_res_id');
		$iss_res_sl_no = $this->input->post('isv_res_sl_no');
		$iss_res_pu_id = $this->input->post('isv_res_pu_id');
		$iss_date = $this->input->post('isv_res_date');
		$iss_date = date("Y-m-d", strtotime($iss_date));
		$iss_res_fy_id = $this->input->post('isv_res_fy_id');
		$iss_total_issue = $this->input->post('iss_total_issue');
		// $iss_total_balance = $this->input->post('iss_total_balance');
		$issueSummaryData = array(
			'iss_id' => $iss_id,
			'iss_res_id' => $iss_res_id,
			'iss_res_sl_no' => $iss_res_sl_no,
			'iss_res_pu_id' => $iss_res_pu_id,
			'iss_date' => $iss_date,
			'iss_res_fy_id' => $iss_res_fy_id,
			'iss_total_issue' => $iss_total_issue,
			//'iss_total_balance' => $iss_total_balance,
			'iss_total_balance' => 0,
			'iss_status' => 1,
			'iss_created_at' => get_current_time(),
			'iss_created_by' => $this->session->userdata('currentActiveId')
		);



		$month = date("m", strtotime($iss_date));
		$year = date("Y", strtotime($iss_date));

		$nextMonth = $month + 1;
		if ($nextMonth == 13) {
			$updateMonth = 1;
			$updateYear = $year + 1;

			$returnData = $this->Common->get_single_row_information_multi_conditional('opening_summary', ['year(ops_date) =' => $updateYear, 'month(ops_date) =' => $updateMonth, 'ops_status' => 1]);
		} else {
			$returnData = $this->Common->get_single_row_information_multi_conditional('opening_summary', ['year(ops_date) =' => $year, 'month(ops_date) =' => $nextMonth, 'ops_status' => 1]);
		}

		if ($returnData) {

			set_confirmation_msg("$returnData", '', "Sorry! You can't add this jute issue because you already added next month opening.");
			redirect('list_add_new_daily_issue');
		} else {
			$isSummaryId = $this->M_daily_issue->insertDailyIssue('issue_summary', $issueSummaryData);
		}

		// echo '<pre>';
		// print_r($issueSummaryData);
		//Issue Value
		$isv_id = $this->input->post('isv_id');
		$isv_ar_id = $this->input->post('isv_ar_id');
		$isv_j_g_id = $this->input->post('isv_j_g_id');
		$isv_issue = $this->input->post('isv_issue');
		$isv_balance = $this->input->post('isv_balance');

		//for wh & kf
		// $isv_wh = $this->input->post('wh');
		// $isv_wh_value = $this->input->post('wh_value');
		// $isv_kf = $this->input->post('kf');
		// $isv_kf_value = $this->input->post('kf_value');

		for ($i = 0; $i < count($isv_issue); $i++) {
			$issueValueData = array(
				'isv_id' => $isv_id,
				'isv_iss_id' => $isSummaryId,
				'isv_ar_id' => $isv_ar_id[$i],
				'isv_j_g_id' => $isv_j_g_id[$i],
				'isv_issue' => $isv_issue[$i],
				// 8.8.22 issue add korta gala ai input option problem kortasa, ti comment corlam
				//'isv_balance' => number_format($isv_balance[$i], 2, '.', ''),
				'isv_status' => 1,
				'isv_wh_kf_status' => 0,
				'isv_created_at' => get_current_time(),
				'isv_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_daily_issue->insertDailyIssue('issue_value', $issueValueData);
			// echo '<pre>';
			// print_r($issueValueData);
		}

		// $whValueData = array(
		// 	'isv_id' => $isv_id,
		// 	'isv_iss_id' => $isSummaryId,
		// 	'isv_ar_id' => $isv_wh,
		// 	'isv_j_g_id' => $isv_wh,
		// 	'isv_issue' => $isv_wh_value,
		// 	'isv_balance' => 0,
		// 	'isv_status' => 1,
		// 	'isv_wh_kf_status' => 1,
		// 	'isv_created_at' => get_current_time(),
		// 	'isv_created_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->M_daily_issue->insertDailyIssue('issue_value', $whValueData);

		// $kfValueData = array(
		// 	'isv_id' => $isv_id,
		// 	'isv_iss_id' => $isSummaryId,
		// 	'isv_ar_id' => $isv_kf,
		// 	'isv_j_g_id' => $isv_kf,
		// 	'isv_issue' => $isv_kf_value,
		// 	'isv_balance' => 0,
		// 	'isv_status' => 1,
		// 	'isv_wh_kf_status' => 1,
		// 	'isv_created_at' => get_current_time(),
		// 	'isv_created_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->M_daily_issue->insertDailyIssue('issue_value', $kfValueData);

		redirect('list_daily_requisition');
	}
	// Edit Daily Issue Form
	public function editDailyIssue()
	{
		$data = $this->engine->store_nav('daily_issue', 'edit_daily_issue', 'Edit Daily Issue');
		$iss_id = $this->input->get('iss_id');
		$data['issueEditView'] = $this->M_daily_issue->getDailyIssueById($iss_id);
		// $data['issueSummaryById'] = $this->M_daily_issue->getDailyIssueSummaryById($iss_id);

		$data['issueSummaryId'] = $iss_id; //get from jute_helper 
		$data['isValue'] = $this->M_daily_issue->getDailyIssueValue();
		$data['isSummary'] = $this->M_daily_issue->getDailyIssueSummary();

		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();


		// Condition in edit
		$date = $this->input->get('date');
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
			set_confirmation_msg("$returnData", '', "Sorry! You can't edit this jute issue because you already added next month opening.");
			redirect('list_daily_issue');
		} else {
			$path = 'backend/jute/daily_issue/edit_daily_issue';
		}

		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Update Issue Value and Balance
	public function updateDailyIssue()
	{
		// x_call();
		$isv_issue = $this->input->post('isv_issue');
		// $isv_balance = $this->input->post('isv_balance');
		$isv_issue_id = $this->input->post('isv_issue_id');
		for ($i = 0; $i < count($isv_issue); $i++) {
			$updateData = array(
				'isv_issue' => $isv_issue[$i],
				// 'isv_balance' => $isv_balance[$i],
				'isv_updated_at' => get_current_time(),
				'isv_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('issue_value', 'isv_id', $isv_issue_id[$i], $updateData);
		}
		// x_debug($updateData);
		$iss_id = $this->input->post('isv_id');
		$iss_total_issue = $this->input->post('iss_total_issue');
		// $iss_total_balance = $this->input->post('iss_total_balance');
		$iss_date = $this->input->post('iss_date');
		$iss_date = date("Y-m-d", strtotime($iss_date));
		$iss_res_fy_id = $this->input->post('isv_res_fy_id');
		$issueSummaryData = array(
			'iss_id' => $iss_id,
			'iss_total_issue' => $iss_total_issue,
			//'iss_total_balance' => $iss_total_balance,
			'iss_total_balance' => 0,
			'iss_date' => $iss_date,
			'iss_res_fy_id' => $iss_res_fy_id,
			'iss_updated_at' => get_current_time(),
			'iss_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_daily_issue->updateIssueSummary($iss_id, $issueSummaryData);

		// Update WH
		// $isv_wh_value = $this->input->post('wh_value');
		// $isv_wh_value_id = $this->input->post('isv_wh_value_id');
		// $UpdateWHValueData = array(
		// 	'isv_issue' => $isv_wh_value,
		// 	'isv_updated_at' => get_current_time(),
		// 	'isv_updated_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->Common->update_data('issue_value', 'isv_id', $isv_wh_value_id, $UpdateWHValueData);

		// Update KF
		// $isv_kf_value = $this->input->post('kf_value');
		// $isv_kf_value_id = $this->input->post('isv_kf_value_id');
		// $UpdateKFValueData = array(
		// 	'isv_issue' => $isv_kf_value,
		// 	'isv_updated_at' => get_current_time(),
		// 	'isv_updated_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->Common->update_data('issue_value', 'isv_id', $isv_kf_value_id, $UpdateKFValueData);

		redirect('list_daily_issue');
	}

	//Delete Issue Summary
	public function deleteIssueSummary()
	{
		$iss_id = $this->input->get('iss_id');

		$date = $this->input->get('date');
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

			set_confirmation_msg("$returnData", '', "Sorry! You can't delete this jute issue because you already added next month opening.");
		} else {
			$deleteData = array(
				'iss_status' => 0,
				'iss_updated_at' => get_current_time(),
				'iss_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_daily_issue->updateIssueSummary($iss_id, $deleteData);
			set_confirmation_msg('TRUE', 'Your data has been deleted successfully.', '');
		}

		redirect('list_daily_issue');
	}


	// Financial year For Issue
	public function ajaxFinancialYearForDailyJuteIssue()
	{
		$date = date("Y-m-d", strtotime($this->input->post('isv_res_date')));
		$valid = $this->M_daily_issue->ajaxFinancialYear($date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}
	// Financial year For Issue Edit
	public function ajaxFinancialYearForDailyJuteIssueEdit()
	{
		$date = date("Y-m-d", strtotime($this->input->post('iss_date')));
		$valid = $this->M_daily_issue->ajaxFinancialYear($date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	/* =========================== Requisition =========================== */
	public function listDailyRequisition()
	{
		$data = $this->engine->store_nav('daily_issue', 'list_daily_requisition', 'list Daily Requisition');
		$data['reSummary'] = $this->M_daily_issue->getDailyRequisitionSummary();
		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/list_daily_requisition';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	public function viewDailyRequisition()
	{
		$data = $this->engine->store_nav('daily_issue', 'view_daily_requisition', 'View Daily Requisition');
		$res_id = $this->input->get('res_id');
		$data['requisitionSummaryId'] = $res_id; //get from jute_helper 
		$data['reValue'] = $this->M_daily_issue->getDailyRequisitionValue();
		$data['reSummary'] = $this->M_daily_issue->getDailyRequisitionSummary();
		$data['reView'] = $this->M_daily_issue->getDailyRequisitionById($res_id);
		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/view_daily_requisition';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Daily Requisition Form 
	public function addDailyRequisition()
	{
		$data = $this->engine->store_nav('daily_issue', 'add_daily_requisition', 'Add Daily Requisition');
		$data['list'] = array();
		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/add_daily_requisition';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	public function insertDailyRequisition()
	{
		// Requisition Summary
		$res_id = $this->input->post('rev_id');
		$res_sl_no = $this->input->post('rev_sl_no');
		$res_pu_id = $this->input->post('rev_pu_id');
		$res_date = $this->input->post('rev_date');
		$res_date = date("Y-m-d", strtotime($res_date));
		$res_fy_id = $this->input->post('rev_fy_id');
		$res_total_requisition = $this->input->post('res_total_requisition');
		$requisitionSummaryData = array(
			'res_id' => $res_id,
			'res_sl_no' => $res_sl_no,
			'res_pu_id' => $res_pu_id,
			'res_date' => $res_date,
			'res_fy_id' => $res_fy_id,
			'res_total_requisition' => $res_total_requisition,
			'res_status' => 1,
			'res_created_at' => get_current_time(),
			'res_created_by' => $this->session->userdata('currentActiveId')
		);
		$reSummaryId = $this->M_daily_issue->insertDailyRequisition('requisition_summary', $requisitionSummaryData);
		// echo '<pre>';
		// print_r($requisitionSummaryData);
		// Requisition Value
		$rev_id = $this->input->post('rev_id');
		$rev_ar_id = $this->input->post('rev_ar_id');
		$rev_j_g_id = $this->input->post('rev_j_g_id');
		$rev_requisition = $this->input->post('rev_requisition');

		//for wh & kf
		// $rev_wh = $this->input->post('wh');
		// $rev_wh_value = $this->input->post('wh_value');
		// $rev_kf = $this->input->post('kf');
		// $rev_kf_value = $this->input->post('kf_value');

		for ($i = 0; $i < count($rev_requisition); $i++) {
			$requisitionValueData = array(
				'rev_id' => $rev_id,
				'rev_res_id' => $reSummaryId,
				'rev_ar_id' => $rev_ar_id[$i],
				'rev_j_g_id' => $rev_j_g_id[$i],
				'rev_requisition' => $rev_requisition[$i],
				'rev_status' => 1,
				'rev_wh_kf_status' => 0,
				'rev_created_at' => get_current_time(),
				'rev_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_daily_issue->insertDailyRequisition('requisition_value', $requisitionValueData);
			// echo '<pre>';
			// print_r($requisitionValueData);
		}

		// $whValueData = array(
		// 	//'rev_id' => $rev_id,
		// 	'rev_res_id' => $reSummaryId,
		// 	'rev_ar_id' => $rev_wh,
		// 	'rev_j_g_id' => $rev_wh,
		// 	'rev_requisition' => $rev_wh_value,
		// 	'rev_status' => 1,
		// 	'rev_wh_kf_status' => 1,
		// 	'rev_created_at' => get_current_time(),
		// 	'rev_created_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->M_daily_issue->insertDailyRequisition('requisition_value', $whValueData);

		// $kfValueData = array(
		// 	//'rev_id' => $rev_id,
		// 	'rev_res_id' => $reSummaryId,
		// 	'rev_ar_id' => $rev_kf,
		// 	'rev_j_g_id' => $rev_kf,
		// 	'rev_requisition' => $rev_kf_value,
		// 	'rev_status' => 1,
		// 	'rev_wh_kf_status' => 2,
		// 	'rev_created_at' => get_current_time(),
		// 	'rev_created_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->M_daily_issue->insertDailyRequisition('requisition_value', $kfValueData);

		redirect('list_daily_requisition');
	}

	// Edit Daily Requisition Form 
	public function editDailyRequisition()
	{
		$data = $this->engine->store_nav('daily_issue', 'edit_daily_requisition', 'Edit Daily Requisition');
		$res_id = $this->input->get('res_id');
		$data['reValueById'] = $this->M_daily_issue->getDailyRequisitionById($res_id);
		$data['reSummaryById'] = $this->M_daily_issue->getDailyRequisitionSummaryById($res_id);

		$data['requisitionSummaryId'] = $res_id; //get from jute_helper 
		$data['reValue'] = $this->M_daily_issue->getDailyRequisitionValue();
		$data['reSummary'] = $this->M_daily_issue->getDailyRequisitionSummary();

		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		//x_debug($data['jute_grades']->result());
		$path = 'backend/jute/daily_issue/edit_daily_requisition';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Update Requisition Data
	public function updateDailyRequisition()
	{
		// x_call();
		$rev_requisition = $this->input->post('rev_requisition');
		$rev_requisition_id = $this->input->post('rev_requisition_id');
		for ($i = 0; $i < count($rev_requisition); $i++) {
			$updateData = array(
				'rev_requisition' => $rev_requisition[$i],
				'rev_updated_at' => get_current_time(),
				'rev_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('requisition_value', 'rev_id', $rev_requisition_id[$i], $updateData);
		}

		// x_debug($updateData);
		$res_id = $this->input->post('rev_id');
		$res_total_requisition = $this->input->post('res_total_requisition');
		$res_date = $this->input->post('rev_date');
		$res_date = date("Y-m-d", strtotime($res_date));
		$res_fy_id = $this->input->post('rev_fy_id');
		$requisitionSummaryData = array(
			'res_id' => $res_id,
			'res_total_requisition' => $res_total_requisition,
			'res_date' => $res_date,
			'res_fy_id' => $res_fy_id,
			'res_updated_at' => get_current_time(),
			'res_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_daily_issue->updateRequisitionSummary($res_id, $requisitionSummaryData);


		// $rev_wh_value = $this->input->post('wh_value');
		// $rev_wh_value_id = $this->input->post('rev_wh_value_id');
		// $UpdateWHValueData = array(
		// 	'rev_requisition' => $rev_wh_value,
		// 	'rev_updated_at' => get_current_time(),
		// 	'rev_updated_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->Common->update_data('requisition_value', 'rev_id', $rev_wh_value_id, $UpdateWHValueData);


		// $rev_kf_value = $this->input->post('kf_value');
		// $rev_kf_value_id = $this->input->post('rev_kf_value_id');
		// $UpdateKFValueData = array(
		// 	'rev_requisition' => $rev_kf_value,
		// 	'rev_updated_at' => get_current_time(),
		// 	'rev_updated_by' => $this->session->userdata('currentActiveId')
		// );
		// $this->Common->update_data('requisition_value', 'rev_id', $rev_kf_value_id, $UpdateKFValueData);

		redirect('list_daily_requisition');
	}



	// Delete Requisition Summary
	public function deleteRequisitionSummary()
	{
		$res_id = $this->input->get('res_id');
		$deleteData = array(
			'res_status' => 0,
			'res_updated_at' => get_current_time(),
			'res_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_daily_issue->updateRequisitionSummary($res_id, $deleteData);

		redirect('list_daily_requisition');
	}

	// Financial year For Requisition
	public function ajaxFinancialYearForDailyJuteRequisition()
	{
		$date = date("Y-m-d", strtotime($this->input->post('rev_date')));
		$valid = $this->M_daily_issue->ajaxFinancialYear($date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	public function ajaxSerialNumberCheckForRequisition()
	{
		$rev_sl_no = $this->input->post('rev_sl_no');
		$conditions = array(
			'res_sl_no' => $rev_sl_no,
			'res_status' => 1,
		);
		$valid = $this->M_daily_issue->ajaxSerialNumberCheckForRequisition($conditions);
		echo $valid;
	}



	// Total Issued quantity
	public function totalIssuedQuantity()
	{
		$data = $this->engine->store_nav('daily_issue', 'total_issued_quantity', 'Daily Issue');

		// $iss_id = $this->input->get('iss_id');
		// $data['issueSummaryId'] = $iss_id;
		// x_debug($iss_id);

		// $data['sumDateWiseGradeValue'] = $this->M_daily_issue->sumDateWiseGradeValue();

		$data['issuesSummary'] = $this->M_daily_issue->getDailyIssueSummary();
		$data['production_units'] = $this->M_production_unit->getProductionUnit();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/daily_issue/total_issued_quantity';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}




	// Ajax Next Month Opening Jute Value Check
	// public function ajaxNextMonthOpeningValueCheck()
	// {
	// }




	//End
}
