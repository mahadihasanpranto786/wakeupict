<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Khamal extends CI_Controller
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

		$this->load->model('M_khamal');
		$this->load->model('M_godown');
		$this->load->model('M_grade');
		$this->load->model('M_jute_entry');
		$this->load->model('M_area');
		$this->load->model('M_financial_year');
	}
	// Add Khamal Form 
	public function addKhamal()
	{
		$data = $this->engine->store_nav('khamal', 'add_khamal', 'Add Khamal');
		$data['list'] = $this->M_khamal->getKhamal();
		$data['godowns'] = $this->M_godown->getGodown();
		$data['areas'] = $this->M_area->getArea();
		$path = 'backend/jute/khamal/add_khamal';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertKhamal()
	{
		$kh_id = $this->input->post('kh_id');
		$kh_g_id = $this->input->post('kh_g_id');
		$kh_title = $this->input->post('kh_title');
		$kh_ar_id = $this->input->post('kh_ar_id');
		$kh_used = $this->input->post('kh_used');
		$kh_description = $this->input->post('kh_description');
		$data = array(
			'kh_id' => $kh_id,
			'kh_g_id' => $kh_g_id,
			'kh_title' => $kh_title,
			'kh_ar_id' => $kh_ar_id,
			'kh_used' => $kh_used,
			'kh_description' => $kh_description,
			'kh_status' => 1,
			'kh_created_at' => get_current_time(),
			'kh_created_by' => $this->session->userdata('currentActiveId')
		);

		$id = $this->M_khamal->insertKhamal($data);
		if ($id) {
			set_confirmation_msg('True', 'Your Data has been Deduction successfully.', '');
		} else {
			set_confirmation_msg('False', '', 'Something wrong happened.');
		}
		redirect('add_khamal');
	}
	// Update Data from data Table
	public function updateKhamal()
	{
		$kh_id = $this->input->post('kh_id');
		$kh_g_id = $this->input->post('kh_g_id');
		$kh_title = $this->input->post('kh_title');
		$kh_ar_id = $this->input->post('kh_ar_id');
		$kh_description = $this->input->post('kh_description');
		$data = array(
			'kh_id' => $kh_id,
			'kh_g_id' => $kh_g_id,
			'kh_title' => $kh_title,
			'kh_ar_id' => $kh_ar_id,
			'kh_description' => $kh_description,
			'kh_updated_at' => get_current_time(),
			'kh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateKhamal($kh_id, $data);
		set_confirmation_msg('True', 'Your data has been Updated successfully', '');
		redirect('add_khamal');
	}

	//Delete Data from data Table
	public function deleteKhamal()
	{
		$kh_id = $this->input->get('kh_id');
		$data = array(
			'kh_status' => 0,
			'kh_updated_at' => get_current_time(),
			'kh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateKhamal($kh_id, $data);
		// set_confirmation_msg('True', 'Your data has been Deleted successfully', '');
		redirect('add_khamal');
	}
	//Delete Data from data Table
	public function inactiveKhamal()
	{
		$kh_id = $this->input->get('kh_id');
		$data = array(
			'kh_status' => 0,
			'kh_updated_at' => get_current_time(),
			'kh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateKhamal($kh_id, $data);
		set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
		redirect('add_khamal');
	}


	public function ajaxKhamalDuplicateNameAlert()
	{
		$ajaxKhamalDuplicateNameAlert = $this->input->post('khamalNameWarning');
		$valid = $this->M_khamal->ajaxKhamalDuplicateNameCheck($ajaxKhamalDuplicateNameAlert);
		if ($valid) {
			echo $valid->kh_title;
		} else {
			echo 'no';
		}
	}

	/* ========================== Unassorted Controller ============================= */
	/* ========================== Unassorted Added Controller ============================= */

	public function listUnassortedOutTurnReport()
	{
		$data = $this->engine->store_nav('khamal', 'list_unassorted_added', 'Unassorted Out Turn Report');

		// Start Pagination
		$search_text = $this->input->get('search');
		$per_page_data = 50;
		$offset = pagination_offset(2, $per_page_data);
		$url = "list_unassorted_out_turn_report";
		$data["serial"] = serial_number_per_page(2, $per_page_data);
		$data['lists'] = $this->M_jute_entry->getPurchaseApproveJuteOutTurnSummaryByLimit($per_page_data, $offset, $search_text);
		$total_row = $this->M_jute_entry->get_out_turn_count($search_text);
		$data["total_rows"] = $total_row;
		$data['search'] = $search_text;
		set_pagination($total_row, $url, $per_page_data);
		// End Pagination

		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/list_unassorted_out_turn_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Add Unassorted Added
	public function addUnAssortedAdded()
	{
		$data = $this->engine->store_nav('khamal', 'add_unassorted_added', 'Add Unassorted Added');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();

		$ot_id = $this->input->get('ot_id');
		$data['getJuteOutTurnSummary'] = $this->M_jute_entry->getJuteOutTurnSummaryById($ot_id);
		$data['jpis_ot_mds_after_deduction'] = $this->M_jute_entry->getPurchaseInvoiceSummaryByOutTurnId($ot_id)->jpis_ot_mds_after_deduction;
		$data['list'] = $this->M_jute_entry->getJuteOutTurnSummary();

		$path = 'backend/jute/khamal/add_unassorted_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Unassorted Added
	public function listUnAssortedAdded()
	{
		$data = $this->engine->store_nav('khamal', 'list_unassorted_added', 'List Unassorted Added');
		$data['unaaddedSummary'] = $this->M_khamal->getUnassortedAddedSummary();
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/list_unassorted_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Edit
	public function editUnAssortedAdded()
	{
		$data = $this->engine->store_nav('khamal', 'edit_unassorted_added', 'Edit Unassorted Added');
		$ot_id = $this->input->get('kh_ua_a_s_ot_id');
		$kh_ua_a_s_id = $this->input->get('kh_ua_a_s_id');
		$data['editUnassortedAddView'] = $this->M_khamal->getUnassortedAddedById($kh_ua_a_s_id);
		$data['unAssortedAddedSummaryId'] = $kh_ua_a_s_id;

		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['jpis_ot_mds_after_deduction'] = $this->M_jute_entry->getPurchaseInvoiceSummaryByOutTurnId($ot_id)->jpis_ot_mds_after_deduction;
		$path = 'backend/jute/khamal/edit_unassorted_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data into database table
	public function insertUnAssortedAdded()
	{
		//Un Assorted Summary
		$kh_ua_a_s_id = $this->input->post('kh_ua_a_v_id');
		$kh_ua_a_s_ot_id = $this->input->post('kh_ua_a_v_ot_id');
		$kh_ua_a_s_en_date = $this->input->post('kh_ua_a_v_en_date');
		//$kh_ua_a_s_en_date = date("Y-m-d", strtotime($kh_ua_a_s_en_date));
		$kh_ua_a_s_fy_id = $this->input->post('kh_ua_a_v_fy_id');
		$kh_ua_a_s_area = $this->input->post('kh_ua_a_s_area');
		$kh_ua_a_s_kh_id = $this->input->post('kh_ua_a_v_kh_id');
		$kh_ua_a_s_ot_rec_bojha_no = $this->input->post('kh_ua_a_v_ot_rec_bojha_no');
		$kh_ua_a_s_net_weight = $this->input->post('kh_ua_a_v_net_weight');
		$kh_ua_a_s_total = $this->input->post('kh_ua_a_v_total');
		$kh_ua_a_s_comments = $this->input->post('kh_ua_a_v_comments');
		$ot_id = $this->input->post('ot_id');
		$unassortedSummaryData =  array(
			'kh_ua_a_s_id' => $kh_ua_a_s_id,
			'kh_ua_a_s_ot_id' => $kh_ua_a_s_ot_id,
			'kh_ua_a_s_en_date' => $kh_ua_a_s_en_date,
			'kh_ua_a_s_fy_id' => $kh_ua_a_s_fy_id,
			'kh_ua_a_s_area' => $kh_ua_a_s_area,
			'kh_ua_a_s_kh_id' => $kh_ua_a_s_kh_id,
			'kh_ua_a_s_ot_rec_bojha_no' => $kh_ua_a_s_ot_rec_bojha_no,
			'kh_ua_a_s_net_weight' => $kh_ua_a_s_net_weight,
			'kh_ua_a_s_total' => number_format($kh_ua_a_s_total, 2, '.', ''),
			'kh_ua_a_s_comments' => $kh_ua_a_s_comments,
			'kh_ua_a_s_status' => 1,
			'kh_ua_a_s_created_at' => get_current_time(),
			'kh_ua_a_s_created_by' => $this->session->userdata('currentActiveId')
		);
		$unassortedSummaryId = $this->M_khamal->insertUnAssortedAddedData('khamal_unassorted_added_summary', $unassortedSummaryData);
		//Unassorted Value
		$kh_ua_a_v_id = $this->input->post('kh_ua_a_v_id');
		$kh_ua_a_v_j_g_id = $this->input->post('kh_ua_a_v_j_g_id');
		$kh_ua_a_v_value = $this->input->post('kh_ua_a_v_value');

		for ($i = 0; $i < count($kh_ua_a_v_value); $i++) {
			$unassortedValueData = array(
				'kh_ua_a_v_id' => $kh_ua_a_v_id,
				'kh_ua_a_v_s_id' => $unassortedSummaryId,
				'kh_ua_a_v_j_g_id' => $kh_ua_a_v_j_g_id[$i],
				'kh_ua_a_v_value' => number_format($kh_ua_a_v_value[$i], 2, '.', ''),
				'kh_ua_a_v_status' => 1,
				'kh_ua_a_v_created_at' => get_current_time(),
				'kh_ua_a_v_created_by' => $this->session->userdata('currentActiveId')
			);
			$this->M_khamal->insertUnAssortedAddedData('khamal_unassorted_added_value', $unassortedValueData);
		}

		$approveData = array(
			'ot_khamal_status' => 1,
		);
		$this->M_jute_entry->updateWithCondition($ot_id, $approveData);

		redirect('list_unassorted_added');
	}


	//Update Function
	public function updateUnAssortedAdded()
	{
		//Unassorted Value
		$kh_ua_a_v_value = $this->input->post('kh_ua_a_v_value');
		$kh_ua_a_v_value_id = $this->input->post('kh_ua_a_v_value_id');

		for ($i = 0; $i < count($kh_ua_a_v_value); $i++) {
			$updateData = array(
				'kh_ua_a_v_value' => number_format($kh_ua_a_v_value[$i], 2, '.', ''),
				'kh_ua_a_v_updated_at' => get_current_time(),
				'kh_ua_a_v_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('khamal_unassorted_added_value', 'kh_ua_a_v_id', $kh_ua_a_v_value_id[$i], $updateData);
		}
		//Un Assorted Summary
		$kh_ua_a_s_id = $this->input->post('kh_ua_a_v_id');
		$kh_ua_a_s_ot_lot_no = $this->input->post('kh_ua_a_v_ot_lot_no');
		$kh_ua_a_s_area = $this->input->post('kh_ua_a_s_area');
		// $kh_ua_a_s_kh_id = $this->input->post('kh_ua_a_v_kh_id');
		$kh_ua_a_s_ot_rec_bojha_no = $this->input->post('kh_ua_a_v_ot_rec_bojha_no');
		$kh_ua_a_s_ot_rec_mds = $this->input->post('kh_ua_a_v_ot_rec_mds');
		$kh_ua_a_s_avg = $this->input->post('kh_ua_a_v_avg');
		$kh_ua_a_s_net_weight = $this->input->post('kh_ua_a_v_net_weight');
		$kh_ua_a_s_total = $this->input->post('kh_ua_a_v_total');
		$kh_ua_a_s_comments = $this->input->post('kh_ua_a_v_comments');
		$unassortedSummaryData =  array(
			'kh_ua_a_s_id' => $kh_ua_a_s_id,
			'kh_ua_a_s_area' => $kh_ua_a_s_area,
			'kh_ua_a_s_ot_lot_no' => $kh_ua_a_s_ot_lot_no,
			// 'kh_ua_a_s_kh_id' => $kh_ua_a_s_kh_id,
			'kh_ua_a_s_ot_rec_bojha_no' => $kh_ua_a_s_ot_rec_bojha_no,
			'kh_ua_a_s_ot_rec_mds' => $kh_ua_a_s_ot_rec_mds,
			'kh_ua_a_s_avg' => $kh_ua_a_s_avg,
			'kh_ua_a_s_net_weight' => $kh_ua_a_s_net_weight,
			'kh_ua_a_s_total' => number_format($kh_ua_a_s_total, 2, '.', ''),
			'kh_ua_a_s_comments' => $kh_ua_a_s_comments,
			'kh_ua_a_s_updated_at' => get_current_time(),
			'kh_ua_a_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateUnAssortedAddedSummaryData($kh_ua_a_s_id, $unassortedSummaryData);
		redirect('list_unassorted_added');
	}

	// Delete Data From database table
	public function deleteUnAssortedAdded()
	{
		$kh_ua_a_s_id = $this->input->get('kh_ua_a_s_id');
		$ot_id = $this->M_khamal->getUnassortedAddedById($kh_ua_a_s_id)->kh_ua_a_s_ot_id;
		$unassortedSummaryData =  array(
			'kh_ua_a_s_status' => 0,
			'kh_ua_a_s_updated_at' => get_current_time(),
			'kh_ua_a_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateUnAssortedAddedSummaryData($kh_ua_a_s_id, $unassortedSummaryData);

		$unassortedValueData =  array(
			'kh_ua_a_v_status' => 0,
			'kh_ua_a_v_updated_at' => get_current_time(),
			'kh_ua_a_v_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_unassorted_added_value', 'kh_ua_a_v_s_id', $kh_ua_a_s_id, $unassortedValueData);

		$approveData = array(
			'ot_khamal_status' => 0,
		);
		$this->M_jute_entry->updateWithCondition($ot_id, $approveData);
		redirect('list_unassorted_added');
	}

	// Data jaba na but list a thakba
	public function insertNotUnAssortedAdded()
	{
		$ot_id = $this->input->get('ot_id');
		$ot_en_date = $this->M_jute_entry->getJuteOutTurnSummaryById($ot_id)->ot_en_date;
		$unassortedSummaryData =  array(
			'kh_ua_a_s_ot_id' => $ot_id,
			'kh_ua_a_s_en_date' => $ot_en_date,
			'kh_ua_a_s_status' => 2,
			'kh_ua_a_s_created_at' => get_current_time(),
			'kh_ua_a_s_created_by' => $this->session->userdata('currentActiveId')
		);
		$unassortedSummaryId = $this->M_khamal->insertUnAssortedAddedData('khamal_unassorted_added_summary', $unassortedSummaryData);

		$approveData = array(
			'ot_khamal_status' => 1,
		);
		$this->M_jute_entry->updateWithCondition($ot_id, $approveData);

		redirect($_SERVER['HTTP_REFERER']);
	}

	/* ========================== Unassorted Deduction Controller ============================= */
	// Add Unassorted Deduction
	public function addUnAssortedDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'list_unassorted_deduction', 'Add Unassorted Deduction');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/add_unassorted_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Unassorted Deduction
	public function listUnAssortedDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'list_unassorted_deduction', 'List Unassorted Deduction');
		$data['unaDeductionSummary'] = $this->M_khamal->getUnassortedDeductionSummary();
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/list_unassorted_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Edit
	public function editUnAssortedDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'edit_unassorted_deduction', 'Edit Unassorted Deduction');
		$kh_ua_d_s_id = $this->input->get('kh_ua_d_s_id');
		$data['editUnassortedDeView'] = $this->M_khamal->getUnassortedDeductionById($kh_ua_d_s_id);

		$data['unAssortedDeductionSummaryId'] = $kh_ua_d_s_id;
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/edit_unassorted_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertUnAssortedDeduction()
	{
		//$xx = $this->input->post();
		//x_debug($xx);



		//Un Assorted Summary
		$kh_ua_d_s_id = $this->input->post('kh_ua_d_v_id');
		$kh_ua_d_s_date = $this->input->post('kh_ua_d_v_date');
		$kh_ua_d_s_date = date("Y-m-d", strtotime($kh_ua_d_s_date));
		$kh_ua_d_s_fy_id = $this->input->post('kh_ua_d_v_fy_id');
		$kh_ua_d_s_kh_id = $this->input->post('kh_ua_d_v_kh_id');
		$kh_ua_d_s_bojha_no = $this->input->post('kh_ua_d_v_bojha_no');
		$kh_ua_d_s_avg_weight = $this->input->post('kh_ua_d_v_avg_weight');
		$kh_ua_d_s_total = $this->input->post('kh_ua_d_v_total');
		$kh_ua_d_s_comments = $this->input->post('kh_ua_d_v_comments');

		for ($i = 0; $i < count($kh_ua_d_s_kh_id); $i++) {
			$unassortedDeSummaryData =  array(
				'kh_ua_d_s_id' => $kh_ua_d_s_id,
				'kh_ua_d_s_date' => $kh_ua_d_s_date,
				'kh_ua_d_s_fy_id' => $kh_ua_d_s_fy_id,
				'kh_ua_d_s_kh_id' => $kh_ua_d_s_kh_id[$i],
				'kh_ua_d_s_bojha_no' => $kh_ua_d_s_bojha_no[$i],
				'kh_ua_d_s_avg_weight' => $kh_ua_d_s_avg_weight[$i],
				'kh_ua_d_s_total' => number_format($kh_ua_d_s_total[$i], 2, '.', ''),
				'kh_ua_d_s_comments' => $kh_ua_d_s_comments[$i],
				'kh_ua_d_s_status' => 1,
				'kh_ua_d_s_created_at' => get_current_time(),
				'kh_ua_d_s_created_by' => $this->session->userdata('currentActiveId')
			);
			$unassortedDeSummaryId[] = $this->M_khamal->insertUnAssortedDeductionData('khamal_unassorted_deduction_summary', $unassortedDeSummaryData);
		}

		// Value
		$jute_grades = $this->M_grade->getJuteGrade();
		$tGradeCount = count($jute_grades->result());

		$kh_ua_d_v_id = $this->input->post('kh_ua_d_v_id');
		$kh_ua_d_v_kh_id = $this->input->post('kh_ua_d_v_kh_id');
		$kh_ua_d_v_bojha_no = $this->input->post('kh_ua_d_v_bojha_no');
		$kh_ua_d_v_j_g_id = $this->input->post('kh_ua_d_v_j_g_id');
		$kh_ua_d_v_value = $this->input->post('kh_ua_d_v_value');

		$q = 0;
		for ($i = 0; $i < count($unassortedDeSummaryId); $i++) {
			$kamal_s = $unassortedDeSummaryId[$i];
			$trigar = 0;
			for ($k = $q; $k < count($kh_ua_d_v_j_g_id); $k++) {
				$trigar++;

				$unassortedValueData = array(
					'kh_ua_d_v_id' => $kh_ua_d_v_id,
					'kh_ua_d_v_s_id' => $kamal_s,
					'kh_ua_d_v_kh_id' => $kh_ua_d_v_kh_id[$i],
					'kh_ua_d_v_bojha_no' => $kh_ua_d_v_bojha_no[$i],
					'kh_ua_d_v_j_g_id' => $kh_ua_d_v_j_g_id[$k],
					'kh_ua_d_v_value' => $kh_ua_d_v_value[$k],
					'kh_ua_d_v_status' => 1,
					'kh_ua_d_v_created_at' => get_current_time(),
					'kh_ua_d_v_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertUnAssortedDeductionData('khamal_unassorted_deduction_value', $unassortedValueData);

				if ($trigar == $tGradeCount) {
					break;
				}
			}

			$q += $tGradeCount;
		}
		set_confirmation_msg("TRUE", 'Your data has been inserted successfully.', '');
		redirect('list_unassorted_deduction');
	}
	//Update Function
	public function updateUnAssortedDeduction()
	{
		//Unassorted Value
		$kh_ua_d_v_kh_id = $this->input->post('kh_ua_d_v_kh_id');
		$kh_ua_d_v_bojha_no = $this->input->post('kh_ua_d_v_bojha_no');
		$kh_ua_d_v_value = $this->input->post('kh_ua_d_v_value');
		$kh_ua_d_v_value_id = $this->input->post('kh_ua_d_v_value_id');

		for ($i = 0; $i < count($kh_ua_d_v_value); $i++) {
			$updateData = array(
				'kh_ua_d_v_kh_id' => $kh_ua_d_v_kh_id,
				'kh_ua_d_v_bojha_no' => $kh_ua_d_v_bojha_no,
				'kh_ua_d_v_value' => $kh_ua_d_v_value[$i],
				'kh_ua_d_v_updated_at' => get_current_time(),
				'kh_ua_d_v_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('khamal_unassorted_deduction_value', 'kh_ua_d_v_id', $kh_ua_d_v_value_id[$i], $updateData);
		}
		//Un Assorted Summary
		$kh_ua_d_s_id = $this->input->post('kh_ua_d_v_id');
		$kh_ua_d_s_date = $this->input->post('kh_ua_d_v_date');
		$kh_ua_d_s_date = date("Y-m-d", strtotime($kh_ua_d_s_date));
		$kh_ua_d_s_fy_id = $this->input->post('kh_ua_d_v_fy_id');
		$kh_ua_d_s_kh_id = $this->input->post('kh_ua_d_v_kh_id');
		$kh_ua_d_s_bojha_no = $this->input->post('kh_ua_d_v_bojha_no');
		$kh_ua_d_s_avg_weight = $this->input->post('kh_ua_d_v_avg_weight');
		$kh_ua_d_s_total = $this->input->post('kh_ua_d_v_total');
		$kh_ua_d_s_comments = $this->input->post('kh_ua_d_v_comments');
		$unassortedDeSummaryData =  array(
			'kh_ua_d_s_id' => $kh_ua_d_s_id,
			'kh_ua_d_s_date' => $kh_ua_d_s_date,
			'kh_ua_d_s_fy_id' => $kh_ua_d_s_fy_id,
			'kh_ua_d_s_kh_id' => $kh_ua_d_s_kh_id,
			'kh_ua_d_s_bojha_no' => $kh_ua_d_s_bojha_no,
			'kh_ua_d_s_avg_weight' => $kh_ua_d_s_avg_weight,
			'kh_ua_d_s_total' => number_format($kh_ua_d_s_total, 2, '.', ''),
			'kh_ua_d_s_comments' => $kh_ua_d_s_comments,
			'kh_ua_d_s_updated_at' => get_current_time(),
			'kh_ua_d_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateUnAssortedDeductionSummaryData($kh_ua_d_s_id, $unassortedDeSummaryData);
		redirect('list_unassorted_deduction');
	}
	// Delete Data From database table
	public function deleteUnAssortedDeduction()
	{
		$kh_ua_d_s_id = $this->input->get('kh_ua_d_s_id');
		$unassortedDeSummaryData =  array(
			'kh_ua_d_s_status' => 0,
			'kh_ua_d_s_updated_at' => get_current_time(),
			'kh_ua_d_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateUnAssortedDeductionSummaryData($kh_ua_d_s_id, $unassortedDeSummaryData);

		$unassortedDeValueData =  array(
			'kh_ua_d_v_status' => 0,
			'kh_ua_d_v_updated_at' => get_current_time(),
			'kh_ua_d_v_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_unassorted_deduction_value', 'kh_ua_d_v_s_id', $kh_ua_d_s_id, $unassortedDeValueData);

		redirect('list_unassorted_deduction');
	}

	// Financial year
	public function ajaxFinancialYearForUnassortedDeduction()
	{
		$date = date("Y-m-d", strtotime($this->input->post('kh_ua_d_v_date')));
		$valid = $this->M_khamal->ajaxFinancialYear($date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	/* ========================== Assorted Uncut Added Controller ============================= */
	// Add assorted Uncut Added
	public function addAssortedUncutAdded()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_uncut_added', 'Add Assorted Uncut Added');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/add_assorted_uncut_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Unassorted Added
	public function listAssortedUncutAdded()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_uncut_added', 'List Assorted Uncut Added');
		$data['assortedUncutAddedSummary'] = $this->M_khamal->getAssortedUncutAddedSummary();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/list_assorted_uncut_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Edit
	public function editAssortedUncutAdded()
	{
		$data = $this->engine->store_nav('khamal', 'edit_assorted_uncut_added', 'Edit Assorted Uncut Added');
		$kh_auc_a_s_id = $this->input->get('kh_auc_a_s_id');
		$data['editAssortedUncutAddedView'] = $this->M_khamal->getAssortedUncutAddedById($kh_auc_a_s_id);
		$data['AssortedUncutAddedSummaryId'] = $kh_auc_a_s_id;
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/edit_assorted_uncut_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data into database table
	public function insertAssortedUncutAdded()
	{
		//Un Assorted Summary
		$kh_auc_a_s_id = $this->input->post('kh_auc_a_v_id');
		$kh_auc_a_s_date = $this->input->post('kh_auc_a_v_date');
		$kh_auc_a_s_date = date("Y-m-d", strtotime($kh_auc_a_s_date));
		$kh_auc_a_s_fy_id = $this->input->post('kh_auc_a_v_fy_id');
		$kh_auc_a_s_kh_id = $this->input->post('kh_auc_a_v_kh_id');
		$kh_auc_a_s_bojha_no = $this->input->post('kh_auc_a_v_bojha_no');
		$kh_auc_a_s_avg_weight = $this->input->post('kh_auc_a_v_avg_weight');
		$kh_auc_a_s_total = $this->input->post('kh_auc_a_v_total');
		$kh_auc_a_s_comments = $this->input->post('kh_auc_a_v_comments');

		for ($i = 0; $i < count($kh_auc_a_s_kh_id); $i++) {
			$assortedUncutAddedSummaryData =  array(
				'kh_auc_a_s_id' => $kh_auc_a_s_id,
				'kh_auc_a_s_date' => $kh_auc_a_s_date,
				'kh_auc_a_s_fy_id' => $kh_auc_a_s_fy_id,
				'kh_auc_a_s_kh_id' => $kh_auc_a_s_kh_id[$i],
				'kh_auc_a_s_bojha_no' => $kh_auc_a_s_bojha_no[$i],
				'kh_auc_a_s_avg_weight' => $kh_auc_a_s_avg_weight[$i],
				'kh_auc_a_s_total' => number_format($kh_auc_a_s_total[$i], 2, '.', ''),
				'kh_auc_a_s_comments' => $kh_auc_a_s_comments[$i],
				'kh_auc_a_s_status' => 1,
				'kh_auc_a_s_created_at' => get_current_time(),
				'kh_auc_a_s_created_by' => $this->session->userdata('currentActiveId')
			);
			$assortedUncutAddedSummaryId[] = $this->M_khamal->insertAssortedUncutAddedData('khamal_assorted_uncut_added_summary', $assortedUncutAddedSummaryData);
		}
		// Value
		$jute_grades = $this->M_grade->getJuteGrade();
		$tGradeCount = count($jute_grades->result());

		$kh_auc_a_v_id = $this->input->post('kh_auc_a_v_id');
		$kh_auc_a_v_kh_id = $this->input->post('kh_auc_a_v_kh_id');
		$kh_auc_a_v_bojha_no = $this->input->post('kh_auc_a_v_bojha_no');
		$kh_auc_a_v_j_g_id = $this->input->post('kh_auc_a_v_j_g_id');
		$kh_auc_a_v_value = $this->input->post('kh_auc_a_v_value');

		$q = 0;
		for ($i = 0; $i < count($assortedUncutAddedSummaryId); $i++) {
			$kamal_s = $assortedUncutAddedSummaryId[$i];
			$trigar = 0;
			for ($k = $q; $k < count($kh_auc_a_v_j_g_id); $k++) {
				$trigar++;

				$assortedUncutAddedValueData = array(
					'kh_auc_a_v_id' => $kh_auc_a_v_id,
					'kh_auc_a_v_s_id' => $kamal_s,
					'kh_auc_a_v_kh_id' => $kh_auc_a_v_kh_id[$i],
					'kh_auc_a_v_bojha_no' => $kh_auc_a_v_bojha_no[$i],
					'kh_auc_a_v_j_g_id' => $kh_auc_a_v_j_g_id[$k],
					'kh_auc_a_v_value' => $kh_auc_a_v_value[$k],
					'kh_auc_a_v_status' => 1,
					'kh_auc_a_v_created_at' => get_current_time(),
					'kh_auc_a_v_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertAssortedUncutAddedData('khamal_assorted_uncut_added_value', $assortedUncutAddedValueData);
				if ($trigar == $tGradeCount) {
					break;
				}
			}

			$q += $tGradeCount;
		}
		set_confirmation_msg("TRUE", 'Your data has been inserted successfully.', '');
		redirect('list_assorted_uncut_added');
	}
	//Update Function
	public function updateAssortedUncutAdded()
	{
		//Unassorted Value
		$kh_auc_a_v_kh_id = $this->input->post('kh_auc_a_v_kh_id');
		$kh_auc_a_v_bojha_no = $this->input->post('kh_auc_a_v_bojha_no');
		$kh_auc_a_v_value = $this->input->post('kh_auc_a_v_value');
		$kh_auc_a_v_value_id = $this->input->post('kh_auc_a_v_value_id');

		for ($i = 0; $i < count($kh_auc_a_v_value); $i++) {
			$updateData = array(
				'kh_auc_a_v_kh_id' => $kh_auc_a_v_kh_id,
				'kh_auc_a_v_bojha_no' => $kh_auc_a_v_bojha_no,
				'kh_auc_a_v_value' => $kh_auc_a_v_value[$i],
				'kh_auc_a_v_updated_at' => get_current_time(),
				'kh_auc_a_v_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('khamal_assorted_uncut_added_value', 'kh_auc_a_v_id', $kh_auc_a_v_value_id[$i], $updateData);
		}
		//Un Assorted Summary
		$kh_auc_a_s_id = $this->input->post('kh_auc_a_v_id');
		$kh_auc_a_s_date = $this->input->post('kh_auc_a_v_date');
		$kh_auc_a_s_date = date("Y-m-d", strtotime($kh_auc_a_s_date));
		$kh_auc_a_s_fy_id = $this->input->post('kh_auc_a_v_fy_id');
		$kh_auc_a_s_kh_id = $this->input->post('kh_auc_a_v_kh_id');
		$kh_auc_a_s_bojha_no = $this->input->post('kh_auc_a_v_bojha_no');
		$kh_auc_a_s_avg_weight = $this->input->post('kh_auc_a_v_avg_weight');
		$kh_auc_a_s_total = $this->input->post('kh_auc_a_v_total');
		$kh_auc_a_s_comments = $this->input->post('kh_auc_a_v_comments');
		$assortedUncutAddedSummaryData =  array(
			'kh_auc_a_s_id' => $kh_auc_a_s_id,
			'kh_auc_a_s_date' => $kh_auc_a_s_date,
			'kh_auc_a_s_fy_id' => $kh_auc_a_s_fy_id,
			'kh_auc_a_s_kh_id' => $kh_auc_a_s_kh_id,
			'kh_auc_a_s_bojha_no' => $kh_auc_a_s_bojha_no,
			'kh_auc_a_s_avg_weight' => $kh_auc_a_s_avg_weight,
			'kh_auc_a_s_total' => number_format($kh_auc_a_s_total, 2, '.', ''),
			'kh_auc_a_s_comments' => $kh_auc_a_s_comments,
			'kh_auc_a_s_updated_at' => get_current_time(),
			'kh_auc_a_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedUncutAddedSummaryData($kh_auc_a_s_id, $assortedUncutAddedSummaryData);
		redirect('list_assorted_uncut_added');
	}
	// Delete Data From database table
	public function deleteAssortedUncutAdded()
	{
		$kh_auc_a_s_id = $this->input->get('kh_auc_a_s_id');

		// Delete Summary Data
		$assortedUncutAddedSummaryData =  array(
			'kh_auc_a_s_status' => 0,
			'kh_auc_a_s_updated_at' => get_current_time(),
			'kh_auc_a_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedUncutAddedSummaryData($kh_auc_a_s_id, $assortedUncutAddedSummaryData);

		// Delete Value Data
		$assortedUncutAddedValueData =  array(
			'kh_auc_a_v_status' => 0,
			'kh_auc_a_v_updated_at' => get_current_time(),
			'kh_auc_a_v_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_assorted_uncut_added_value', 'kh_auc_a_v_s_id', $kh_auc_a_s_id, $assortedUncutAddedValueData);

		redirect('list_assorted_uncut_added');
	}

	// Financial year
	public function ajaxFinancialYearForAssortedUnCutAdded()
	{
		$date = date("Y-m-d", strtotime($this->input->post('kh_auc_a_v_date')));
		$valid = $this->M_khamal->ajaxFinancialYear($date);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}




	/* ========================== Assorted Uncut Deduction Controller ============================= */
	// Add assorted Uncut Added
	public function addAssortedUncutDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_uncut_deduction', 'Add Assorted Uncut Deduction');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/add_assorted_uncut_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Unassorted Added
	public function listAssortedUncutDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_uncut_deduction', 'List Assorted Uncut Deduction');
		$data['assortedUncutDeductionSummary'] = $this->M_khamal->getAssortedUncutDeductionSummary();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/list_assorted_uncut_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Edit
	public function editAssortedUncutDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'edit_assorted_uncut_deduction', 'Edit Assorted Uncut Deduction');
		$kh_auc_d_s_id = $this->input->get('kh_auc_d_s_id');
		$data['editAssortedUncutDeductionView'] = $this->M_khamal->getAssortedUncutDeductionById($kh_auc_d_s_id);

		$data['assortedUncutDeductionSummaryId'] = $kh_auc_d_s_id;
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/edit_assorted_uncut_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data into database table
	public function insertAssortedUncutDeduction()
	{
		//Summary
		$kh_auc_d_s_id = $this->input->post('kh_auc_d_v_id');
		$kh_auc_d_s_date = $this->input->post('kh_auc_d_v_date');
		$kh_auc_d_s_date = date("Y-m-d", strtotime($kh_auc_d_s_date));
		$kh_auc_d_s_fy_id = $this->input->post('kh_auc_d_v_fy_id');
		$kh_auc_d_s_kh_id = $this->input->post('kh_auc_d_v_kh_id');
		$kh_auc_d_s_bojha_no = $this->input->post('kh_auc_d_v_bojha_no');
		$kh_auc_d_s_avg_weight = $this->input->post('kh_auc_d_v_avg_weight');
		$kh_auc_d_s_total = $this->input->post('kh_auc_d_v_total');
		$kh_auc_d_s_comments = $this->input->post('kh_auc_d_v_comments');

		for ($i = 0; $i < count($kh_auc_d_s_kh_id); $i++) {
			$assortedUncutDeductionSummaryData =  array(
				'kh_auc_d_s_id' => $kh_auc_d_s_id,
				'kh_auc_d_s_date' => $kh_auc_d_s_date,
				'kh_auc_d_s_fy_id' => $kh_auc_d_s_fy_id,
				'kh_auc_d_s_kh_id' => $kh_auc_d_s_kh_id[$i],
				'kh_auc_d_s_bojha_no' => $kh_auc_d_s_bojha_no[$i],
				'kh_auc_d_s_avg_weight' => $kh_auc_d_s_avg_weight[$i],
				'kh_auc_d_s_total' => number_format($kh_auc_d_s_total[$i], 2, '.', ''),
				'kh_auc_d_s_comments' => $kh_auc_d_s_comments[$i],
				'kh_auc_d_s_status' => 1,
				'kh_auc_d_s_created_at' => get_current_time(),
				'kh_auc_d_s_created_by' => $this->session->userdata('currentActiveId')
			);
			$assortedUncutDeSummaryId[] = $this->M_khamal->insertAssortedUncutDeductionData('khamal_assorted_uncut_deduction_summary', $assortedUncutDeductionSummaryData);
		}

		// Value
		$jute_grades = $this->M_grade->getJuteGrade();
		$tGradeCount = count($jute_grades->result());

		$kh_auc_d_v_id = $this->input->post('kh_auc_d_v_id');
		$kh_auc_d_v_kh_id = $this->input->post('kh_auc_d_v_kh_id');
		$kh_auc_d_v_bojha_no = $this->input->post('kh_auc_d_v_bojha_no');
		$kh_auc_d_v_j_g_id = $this->input->post('kh_auc_d_v_j_g_id');
		$kh_auc_d_v_value = $this->input->post('kh_auc_d_v_value');

		$q = 0;
		for ($i = 0; $i < count($assortedUncutDeSummaryId); $i++) {
			$summaryId = $assortedUncutDeSummaryId[$i];
			$trigar = 0;

			for ($k = $q; $k < count($kh_auc_d_v_j_g_id); $k++) {
				$trigar++;
				$assortedUncuDeValueData = array(
					'kh_auc_d_v_id' => $kh_auc_d_v_id,
					'kh_auc_d_v_s_id' => $summaryId,
					'kh_auc_d_v_kh_id' => $kh_auc_d_v_kh_id[$i],
					'kh_auc_d_v_bojha_no' => $kh_auc_d_v_bojha_no[$i],
					'kh_auc_d_v_j_g_id' => $kh_auc_d_v_j_g_id[$k],
					'kh_auc_d_v_value' => $kh_auc_d_v_value[$k],
					'kh_auc_d_v_status' => 1,
					'kh_auc_d_v_created_at' => get_current_time(),
					'kh_auc_d_v_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertAssortedUncutDeductionData('khamal_assorted_uncut_deduction_value', $assortedUncuDeValueData);
				if ($trigar == $tGradeCount) {
					break;
				}
			}

			$q += $tGradeCount;
		}

		set_confirmation_msg($assortedUncutDeSummaryId, 'Your data has been added successfully.', 'Something is wrong.');
		redirect('list_assorted_uncut_deduction');
	}
	//Update Function
	public function updateAssortedUncutDeduction()
	{
		//Unassorted Value
		$kh_auc_d_v_kh_id = $this->input->post('kh_auc_d_v_kh_id');
		$kh_auc_d_v_bojha_no = $this->input->post('kh_auc_d_v_bojha_no');
		$kh_auc_d_v_value = $this->input->post('kh_auc_d_v_value');
		$kh_auc_d_v_value_id = $this->input->post('kh_auc_d_v_value_id');

		for ($i = 0; $i < count($kh_auc_d_v_value); $i++) {
			$updateData = array(
				'kh_auc_d_v_kh_id' => $kh_auc_d_v_kh_id,
				'kh_auc_d_v_bojha_no' => $kh_auc_d_v_bojha_no,
				'kh_auc_d_v_value' => $kh_auc_d_v_value[$i],
				'kh_auc_d_v_updated_at' => get_current_time(),
				'kh_auc_d_v_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('khamal_assorted_uncut_deduction_value', 'kh_auc_d_v_id', $kh_auc_d_v_value_id[$i], $updateData);
		}
		//Un Assorted Summary
		$kh_auc_d_s_id = $this->input->post('kh_auc_d_v_id');
		$kh_auc_d_s_date = $this->input->post('kh_auc_d_v_date');
		$kh_auc_d_s_date = date("Y-m-d", strtotime($kh_auc_d_s_date));
		$kh_auc_d_s_fy_id = $this->input->post('kh_auc_d_v_fy_id');
		$kh_auc_d_s_kh_id = $this->input->post('kh_auc_d_v_kh_id');
		$kh_auc_d_s_bojha_no = $this->input->post('kh_auc_d_v_bojha_no');
		$kh_auc_d_s_avg_weight = $this->input->post('kh_auc_d_v_avg_weight');
		$kh_auc_d_s_total = $this->input->post('kh_auc_d_v_total');
		$kh_auc_d_s_comments = $this->input->post('kh_auc_d_v_comments');
		$assortedSummaryData =  array(
			'kh_auc_d_s_id' => $kh_auc_d_s_id,
			'kh_auc_d_s_date' => $kh_auc_d_s_date,
			'kh_auc_d_s_fy_id' => $kh_auc_d_s_fy_id,
			'kh_auc_d_s_kh_id' => $kh_auc_d_s_kh_id,
			'kh_auc_d_s_bojha_no' => $kh_auc_d_s_bojha_no,
			'kh_auc_d_s_avg_weight' => $kh_auc_d_s_avg_weight,
			'kh_auc_d_s_total' => number_format($kh_auc_d_s_total, 2, '.', ''),
			'kh_auc_d_s_comments' => $kh_auc_d_s_comments,
			'kh_auc_d_s_updated_at' => get_current_time(),
			'kh_auc_d_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedUncutDeductionSummaryData($kh_auc_d_s_id, $assortedSummaryData);

		set_confirmation_msg("TRUE", 'Your data has been updated successfully.', 'Something is wrong.');
		redirect('list_assorted_uncut_deduction');
	}

	// Delete Data From database table
	public function deleteAssortedUncutDeduction()
	{
		$kh_auc_d_s_id = $this->input->get('kh_auc_d_s_id');
		$assortedUncutDeSummaryData =  array(
			'kh_auc_d_s_status' => 0,
			'kh_auc_d_s_updated_at' => get_current_time(),
			'kh_auc_d_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedUncutDeductionSummaryData($kh_auc_d_s_id, $assortedUncutDeSummaryData);

		// Delete Value Data
		$assortedUncutAddedValueData =  array(
			'kh_auc_d_v_status' => 0,
			'kh_auc_d_v_updated_at' => get_current_time(),
			'kh_auc_d_v_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_assorted_uncut_deduction_value', 'kh_auc_d_v_s_id', $kh_auc_d_s_id, $assortedUncutAddedValueData);
		redirect('list_assorted_uncut_deduction');
	}


	// Financial year
	public function ajaxFinancialYearForAssortedUnCutDeduction()
	{
		$date = date("Y-m-d", strtotime($this->input->post('kh_auc_d_v_date')));
		$valid = $this->M_khamal->ajaxFinancialYear($date);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}


	/* ========================== Assorted Uncut Added Controller ============================= */
	// Add assorted Uncut Added
	public function addAssortedCutAdded()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_cut_added', 'Add Assorted Cut Added');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/add_assorted_cut_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Unassorted Added
	public function listAssortedCutAdded()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_cut_added', 'List Assorted Uncut Added');
		$data['assortedCutAddedSummary'] = $this->M_khamal->getAssortedCutAddedSummary();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/list_assorted_cut_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Edit
	public function editAssortedCutAdded()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_cut_added', 'Edit Assorted Uncut Added');
		$kh_ac_a_s_id = $this->input->get('kh_ac_a_s_id');
		$data['editAssortedCutAddedView'] = $this->M_khamal->getAssortedCutAddedById($kh_ac_a_s_id);

		$data['assortedCutAddedSummaryId'] = $kh_ac_a_s_id;
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/edit_assorted_cut_added';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data into database table
	public function insertAssortedCutAdded()
	{
		//Summary
		$kh_ac_a_s_id = $this->input->post('kh_ac_a_v_id');
		$kh_ac_a_s_date = $this->input->post('kh_ac_a_v_date');
		$kh_ac_a_s_date = date("Y-m-d", strtotime($kh_ac_a_s_date));
		$kh_ac_a_s_fy_id = $this->input->post('kh_ac_a_v_fy_id');
		$kh_ac_a_s_kh_id = $this->input->post('kh_ac_a_v_kh_id');
		$kh_ac_a_s_bojha_no = $this->input->post('kh_ac_a_v_bojha_no');
		$kh_ac_a_s_avg_weight = $this->input->post('kh_ac_a_v_avg_weight');
		$kh_ac_a_s_total = $this->input->post('kh_ac_a_v_total');
		$kh_ac_a_s_comments = $this->input->post('kh_ac_a_v_comments');

		for ($i = 0; $i < count($kh_ac_a_s_kh_id); $i++) {
			$assortedCutAddedSummaryData =  array(
				'kh_ac_a_s_id' => $kh_ac_a_s_id,
				'kh_ac_a_s_date' => $kh_ac_a_s_date,
				'kh_ac_a_s_fy_id' => $kh_ac_a_s_fy_id,
				'kh_ac_a_s_kh_id' => $kh_ac_a_s_kh_id[$i],
				'kh_ac_a_s_bojha_no' => $kh_ac_a_s_bojha_no[$i],
				'kh_ac_a_s_avg_weight' => $kh_ac_a_s_avg_weight[$i],
				'kh_ac_a_s_total' => number_format($kh_ac_a_s_total[$i], 2, '.', ''),
				'kh_ac_a_s_comments' => $kh_ac_a_s_comments[$i],
				'kh_ac_a_s_status' => 1,
				'kh_ac_a_s_created_at' => get_current_time(),
				'kh_ac_a_s_created_by' => $this->session->userdata('currentActiveId')
			);
			$assortedCutAddedSummaryId[] = $this->M_khamal->insertAssortedCutAddedData('khamal_assorted_cut_added_summary', $assortedCutAddedSummaryData);
		}

		// Value
		$jute_grades = $this->M_grade->getJuteGrade();
		$tGradeCount = count($jute_grades->result());

		$kh_ac_a_v_id = $this->input->post('kh_ac_a_v_id');
		$kh_ac_a_v_kh_id = $this->input->post('kh_ac_a_v_kh_id');
		$kh_ac_a_v_bojha_no = $this->input->post('kh_ac_a_v_bojha_no');
		$kh_ac_a_v_j_g_id = $this->input->post('kh_ac_a_v_j_g_id');
		$kh_ac_a_v_value = $this->input->post('kh_ac_a_v_value');

		$q = 0;
		for ($i = 0; $i < count($assortedCutAddedSummaryId); $i++) {
			$summaryId = $assortedCutAddedSummaryId[$i];
			$trigar = 0;

			for ($k = $q; $k < count($kh_ac_a_v_j_g_id); $k++) {
				$trigar++;

				$assortedCutAddedValueData = array(
					'kh_ac_a_v_id' => $kh_ac_a_v_id,
					'kh_ac_a_v_s_id' => $summaryId,
					'kh_ac_a_v_kh_id' => $kh_ac_a_v_kh_id[$i],
					'kh_ac_a_v_bojha_no' => $kh_ac_a_v_bojha_no[$i],
					'kh_ac_a_v_j_g_id' => $kh_ac_a_v_j_g_id[$k],
					'kh_ac_a_v_value' => $kh_ac_a_v_value[$k],
					'kh_ac_a_v_status' => 1,
					'kh_ac_a_v_created_at' => get_current_time(),
					'kh_ac_a_v_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertAssortedCutAddedData('khamal_assorted_cut_added_value', $assortedCutAddedValueData);
				if ($trigar == $tGradeCount) {
					break;
				}
			}

			$q += $tGradeCount;
		}

		set_confirmation_msg($assortedCutAddedSummaryId, 'Your data has been added successfully.', 'Something is wrong.');
		redirect('list_assorted_cut_added');
	}
	//Update Function
	public function updateAssortedCutAdded()
	{
		$kh_ac_a_v_kh_id = $this->input->post('kh_ac_a_v_kh_id');
		$kh_ac_a_v_bojha_no = $this->input->post('kh_ac_a_v_bojha_no');
		$kh_ac_a_v_value = $this->input->post('kh_ac_a_v_value');
		$kh_ac_a_v_value_id = $this->input->post('kh_ac_a_v_value_id');

		for ($i = 0; $i < count($kh_ac_a_v_value); $i++) {
			$updateData = array(
				'kh_ac_a_v_kh_id' => $kh_ac_a_v_kh_id,
				'kh_ac_a_v_bojha_no' => $kh_ac_a_v_bojha_no,
				'kh_ac_a_v_value' => $kh_ac_a_v_value[$i],
				'kh_ac_a_v_updated_at' => get_current_time(),
				'kh_ac_a_v_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('khamal_assorted_cut_added_value', 'kh_ac_a_v_id', $kh_ac_a_v_value_id[$i], $updateData);
		}
		//Un Assorted Summary
		$kh_ac_a_s_id = $this->input->post('kh_ac_a_v_id');
		$kh_ac_a_s_date = $this->input->post('kh_ac_a_v_date');
		$kh_ac_a_s_date = date("Y-m-d", strtotime($kh_ac_a_s_date));
		$kh_ac_a_s_fy_id = $this->input->post('kh_ac_a_v_fy_id');
		$kh_ac_a_s_kh_id = $this->input->post('kh_ac_a_v_kh_id');
		$kh_ac_a_s_bojha_no = $this->input->post('kh_ac_a_v_bojha_no');
		$kh_ac_a_s_avg_weight = $this->input->post('kh_ac_a_v_avg_weight');
		$kh_ac_a_s_total = $this->input->post('kh_ac_a_v_total');
		$kh_ac_a_s_comments = $this->input->post('kh_ac_a_v_comments');
		$assortedCutAddedSummaryData =  array(
			'kh_ac_a_s_id' => $kh_ac_a_s_id,
			'kh_ac_a_s_date' => $kh_ac_a_s_date,
			'kh_ac_a_s_fy_id' => $kh_ac_a_s_fy_id,
			'kh_ac_a_s_kh_id' => $kh_ac_a_s_kh_id,
			'kh_ac_a_s_bojha_no' => $kh_ac_a_s_bojha_no,
			'kh_ac_a_s_avg_weight' => $kh_ac_a_s_avg_weight,
			'kh_ac_a_s_total' => number_format($kh_ac_a_s_total, 2, '.', ''),
			'kh_ac_a_s_comments' => $kh_ac_a_s_comments,
			'kh_ac_a_s_updated_at' => get_current_time(),
			'kh_ac_a_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedCutAddedSummaryData($kh_ac_a_s_id, $assortedCutAddedSummaryData);
		redirect('list_assorted_cut_added');
	}
	// Delete Data From database table
	public function deleteAssortedCutAdded()
	{
		$kh_ac_a_s_id = $this->input->get('kh_ac_a_s_id');
		$deleteSummaryData =  array(
			'kh_ac_a_s_status' => 0,
			'kh_ac_a_s_updated_at' => get_current_time(),
			'kh_ac_a_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedCutAddedSummaryData($kh_ac_a_s_id, $deleteSummaryData);

		// Delete Value Data
		$deleteValueData =  array(
			'kh_ac_a_v_status' => 0,
			'kh_ac_a_v_updated_at' => get_current_time(),
			'kh_ac_a_v_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_assorted_cut_added_value', 'kh_ac_a_v_s_id', $kh_ac_a_s_id, $deleteValueData);

		redirect('list_assorted_cut_added');
	}

	// Financial year
	public function ajaxFinancialYearForAssortedCutAdded()
	{
		$date = date("Y-m-d", strtotime($this->input->post('kh_ac_a_v_date')));
		$valid = $this->M_khamal->ajaxFinancialYear($date);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	/* ========================== Assorted Uncut Added Controller ============================= */
	// Add assorted Uncut Added
	public function addAssortedCutDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_cut_deduction', 'Add Assorted Cut Deduction');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/add_assorted_cut_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Add Unassorted Added
	public function listAssortedCutDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_cut_deduction', 'List Assorted Cut Deduction');
		$data['assortedCutDeductionSummary'] = $this->M_khamal->getAssortedCutDeductionSummary();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/list_assorted_cut_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Edit
	public function editAssortedCutDeduction()
	{
		$data = $this->engine->store_nav('khamal', 'list_assorted_cut_deduction', 'Edit Assorted Cut Deduction');
		$kh_ac_d_s_id = $this->input->get('kh_ac_d_s_id');
		$data['editAssortedCutDeductionView'] = $this->M_khamal->getAssortedCutDeductionById($kh_ac_d_s_id);

		$data['assortedCutDeductionSummaryId'] = $kh_ac_d_s_id;
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/edit_assorted_cut_deduction';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Insert Data into database table
	public function insertAssortedCutDeduction()
	{
		//Summary
		$kh_ac_d_s_id = $this->input->post('kh_ac_d_v_id');
		$kh_ac_d_s_date = $this->input->post('kh_ac_d_v_date');
		$kh_ac_d_s_date = date("Y-m-d", strtotime($kh_ac_d_s_date));
		$kh_ac_d_s_fy_id = $this->input->post('kh_ac_d_v_fy_id');
		$kh_ac_d_s_kh_id = $this->input->post('kh_ac_d_v_kh_id');
		$kh_ac_d_s_bojha_no = $this->input->post('kh_ac_d_v_bojha_no');
		$kh_ac_d_s_avg_weight = $this->input->post('kh_ac_d_v_avg_weight');
		$kh_ac_d_s_total = $this->input->post('kh_ac_d_v_total');
		$kh_ac_d_s_comments = $this->input->post('kh_ac_d_v_comments');

		for ($i = 0; $i < count($kh_ac_d_s_kh_id); $i++) {
			$assortedCutDeductionSummaryData =  array(
				'kh_ac_d_s_id' => $kh_ac_d_s_id,
				'kh_ac_d_s_date' => $kh_ac_d_s_date,
				'kh_ac_d_s_fy_id' => $kh_ac_d_s_fy_id,
				'kh_ac_d_s_kh_id' => $kh_ac_d_s_kh_id[$i],
				'kh_ac_d_s_bojha_no' => $kh_ac_d_s_bojha_no[$i],
				'kh_ac_d_s_avg_weight' => $kh_ac_d_s_avg_weight[$i],
				'kh_ac_d_s_total' => number_format($kh_ac_d_s_total[$i], 2, '.', ''),
				'kh_ac_d_s_comments' => $kh_ac_d_s_comments[$i],
				'kh_ac_d_s_status' => 1,
				'kh_ac_d_s_created_at' => get_current_time(),
				'kh_ac_d_s_created_by' => $this->session->userdata('currentActiveId')
			);
			$assortedCutDeductionSummaryId[] = $this->M_khamal->insertAssortedCutDeductionData('khamal_assorted_cut_deduction_summary', $assortedCutDeductionSummaryData);
		}

		// Value
		$jute_grades = $this->M_grade->getJuteGrade();
		$tGradeCount = count($jute_grades->result());

		$kh_ac_d_v_id = $this->input->post('kh_ac_d_v_id');
		$kh_ac_d_v_kh_id = $this->input->post('kh_ac_d_v_kh_id');
		$kh_ac_d_v_bojha_no = $this->input->post('kh_ac_d_v_bojha_no');
		$kh_ac_d_v_j_g_id = $this->input->post('kh_ac_d_v_j_g_id');
		$kh_ac_d_v_value = $this->input->post('kh_ac_d_v_value');

		$q = 0;
		for ($i = 0; $i < count($assortedCutDeductionSummaryId); $i++) {
			$summaryId = $assortedCutDeductionSummaryId[$i];
			$trigar = 0;

			for ($k = $q; $k < count($kh_ac_d_v_j_g_id); $k++) {
				$trigar++;
				$assortedCutDeductionValueData = array(
					'kh_ac_d_v_id' => $kh_ac_d_v_id,
					'kh_ac_d_v_s_id' => $summaryId,
					'kh_ac_d_v_kh_id' => $kh_ac_d_v_kh_id[$i],
					'kh_ac_d_v_bojha_no' => $kh_ac_d_v_bojha_no[$i],
					'kh_ac_d_v_j_g_id' => $kh_ac_d_v_j_g_id[$k],
					'kh_ac_d_v_value' => $kh_ac_d_v_value[$k],
					'kh_ac_d_v_status' => 1,
					'kh_ac_d_v_created_at' => get_current_time(),
					'kh_ac_d_v_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertAssortedCutDeductionData('khamal_assorted_cut_deduction_value', $assortedCutDeductionValueData);
				if ($trigar == $tGradeCount) {
					break;
				}
			}

			$q += $tGradeCount;
		}

		set_confirmation_msg($assortedCutDeductionSummaryId, 'Your data has been added successfully.', 'Something is wrong.');
		redirect('list_assorted_cut_deduction');
	}
	//Update Function
	public function updateAssortedCutDeduction()
	{
		$kh_ac_d_v_kh_id = $this->input->post('kh_ac_d_v_kh_id');
		$kh_ac_d_v_bojha_no = $this->input->post('kh_ac_d_v_bojha_no');
		$kh_ac_d_v_value = $this->input->post('kh_ac_d_v_value');
		$kh_ac_d_v_value_id = $this->input->post('kh_ac_d_v_value_id');

		for ($i = 0; $i < count($kh_ac_d_v_value); $i++) {
			$updateData = array(
				'kh_ac_d_v_kh_id' => $kh_ac_d_v_kh_id,
				'kh_ac_d_v_bojha_no' => $kh_ac_d_v_bojha_no,
				'kh_ac_d_v_value' => $kh_ac_d_v_value[$i],
				'kh_ac_d_v_updated_at' => get_current_time(),
				'kh_ac_d_v_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('khamal_assorted_cut_deduction_value', 'kh_ac_d_v_id', $kh_ac_d_v_value_id[$i], $updateData);
		}
		$kh_ac_d_s_id = $this->input->post('kh_ac_d_v_id');
		$kh_ac_d_s_date = $this->input->post('kh_ac_d_v_date');
		$kh_ac_d_s_date = date("Y-m-d", strtotime($kh_ac_d_s_date));
		$kh_ac_d_s_fy_id = $this->input->post('kh_ac_d_v_fy_id');
		$kh_ac_d_s_kh_id = $this->input->post('kh_ac_d_v_kh_id');
		$kh_ac_d_s_bojha_no = $this->input->post('kh_ac_d_v_bojha_no');
		$kh_ac_d_s_avg_weight = $this->input->post('kh_ac_d_v_avg_weight');
		$kh_ac_d_s_total = $this->input->post('kh_ac_d_v_total');
		$kh_ac_d_s_comments = $this->input->post('kh_ac_d_v_comments');
		$assortedCutDeductionSummaryData =  array(
			'kh_ac_d_s_id' => $kh_ac_d_s_id,
			'kh_ac_d_s_date' => $kh_ac_d_s_date,
			'kh_ac_d_s_fy_id' => $kh_ac_d_s_fy_id,
			'kh_ac_d_s_kh_id' => $kh_ac_d_s_kh_id,
			'kh_ac_d_s_bojha_no' => $kh_ac_d_s_bojha_no,
			'kh_ac_d_s_avg_weight' => $kh_ac_d_s_avg_weight,
			'kh_ac_d_s_total' => number_format($kh_ac_d_s_total, 2, '.', ''),
			'kh_ac_d_s_comments' => $kh_ac_d_s_comments,
			'kh_ac_d_s_updated_at' => get_current_time(),
			'kh_ac_d_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedCutDeductionSummaryData($kh_ac_d_s_id, $assortedCutDeductionSummaryData);


		redirect('list_assorted_cut_deduction');
	}

	// Delete Data From database table
	public function deleteAssortedCutDeduction()
	{
		$kh_ac_d_s_id = $this->input->get('kh_ac_d_s_id');
		$assortedCutDeductionSummaryData =  array(
			'kh_ac_d_s_status' => 0,
			'kh_ac_d_s_updated_at' => get_current_time(),
			'kh_ac_d_s_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_khamal->updateAssortedCutDeductionSummaryData($kh_ac_d_s_id, $assortedCutDeductionSummaryData);

		// Delete Value Data
		$deleteValueData =  array(
			'kh_ac_d_v_status' => 0,
			'kh_ac_d_v_updated_at' => get_current_time(),
			'kh_ac_d_v_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_assorted_cut_deduction_value', 'kh_ac_d_v_s_id', $kh_ac_d_s_id, $deleteValueData);

		redirect('list_assorted_cut_deduction');
	}


	// Financial year
	public function ajaxFinancialYearForAssortedCutDeduction()
	{
		$date = date("Y-m-d", strtotime($this->input->post('kh_ac_d_v_date')));
		$valid = $this->M_khamal->ajaxFinancialYear($date);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	/* =================== Khamal Final Stock =================== */

	public function khamalFinalStockOld()
	{
		$data = $this->engine->store_nav('khamal', 'khamal_final_stock', 'Khamal Final Stock Old');

		$year = $this->input->post("yearName");
		$month = $this->input->post("monthName");

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

		//-----------------------------
		$data['filter_year'] = $y;
		$data['filter_month'] = $m;
		$data['year'] = $year;
		$data['month'] = $month;
		$data["date"] = date("Y-m-d", strtotime($this->input->post("searchDate")));
		//---------------------------

		// amar dorkar silo
		$data['godowns'] = $this->M_godown->getGodown();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['runningStockSummary'] = $this->Common->get_data('khamal_running_stock_summary');


		$path = 'backend/jute/khamal/khamal_final_stock_old';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function khamalFinalStock()
	{
		$data = $this->engine->store_nav('khamal', 'khamal_final_stock', 'Khamal Final Stock');

		$year = $this->input->post("yearName");
		$month = $this->input->post("monthName");

		if (!$year) {
			$year = year();
		}

		if (!$month) {
			$month = month();
		}

		//-----------------------------
		//$data['filter_year'] = $y;
		//$data['filter_month'] = $m;
		$data['y'] = $year;
		$data['m'] = $month;
		$data["date"] = date("Y-m-d", strtotime($this->input->post("searchDate")));
		//---------------------------

		// amar dorkar silo
		$data['godowns'] = $this->M_godown->getGodown();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		//echo $month;
		$data['runningStockSummary'] = $this->M_khamal->getMonthlyKhamalRunningStockSummary($year, $month);
		//x_debug($data['runningStockSummary']->result());

		$path = 'backend/jute/khamal/khamal_final_stock';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}






	/* =================== Khamal Opening Balance =================== */

	public function addOpeningKhamal()
	{
		$data = $this->engine->store_nav('khamal', 'list_opening_khamal', 'Add Opening Khamal');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/add_opening_khamal';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	public function listOpeningKhamal()
	{
		$data = $this->engine->store_nav('khamal', 'list_opening_khamal', 'List Opening Khamal');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['opSummary'] = $this->Common->get_data_multi_conditional('opening_khamal_summary', ['opskh_status' => 1]);
		$path = 'backend/jute/khamal/list_opening_khamal';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function insertOpeningKhamal()
	{
		$kamals = $this->input->post('opvkh_kh_id');
		$opskh_kh_id = $kamals;
		$opskh_date = $this->input->post('opvkh_date');
		$opskh_date = date("Y-m-d", strtotime($opskh_date));
		$opskh_fy_id = $this->input->post('opvkh_fy_id');
		$opskh_bojha = $this->input->post('opvkh_bojha');
		$opskh_total = $this->input->post('opvkh_total');




		if (count(array_unique($kamals)) < count($kamals)) {
			set_confirmation_msg("", '', 'You have entered duplicate khamal.');
			redirect('add_opening_khamal');
		} else {


			for ($i = 0; $i < count($opskh_kh_id); $i++) {
				$summaryData = array(
					'opskh_kh_id' => $opskh_kh_id[$i],
					'opskh_date' => $opskh_date,
					'opskh_fy_id' => $opskh_fy_id,
					'opskh_bojha' => $opskh_bojha[$i],
					'opskh_total' => number_format($opskh_total[$i], 2, '.', ''),
					'opskh_status' => 1,
					'opskh_created_at' => get_current_time(),
					'opskh_created_by' => $this->session->userdata('currentActiveId')
				);
				$opsSummaryId[] = $this->M_khamal->insertData('opening_khamal_summary', $summaryData);
			}

			$jute_grades = $this->M_grade->getJuteGrade();
			$tGradeCount = count($jute_grades->result());
			$opvkh_kf = $this->input->post('opvkh_kf');
			$opvkh_wh = $this->input->post('opvkh_wh');

			$grades = $this->input->post('opvkh_j_g_id');
			$opvkh_value = $this->input->post('opvkh_value');
			$q = 0;
			for ($i = 0; $i < count($opsSummaryId); $i++) {
				$kamal = $opsSummaryId[$i];
				$trigar = 0;
				// echo '<br>';
				//echo $kamal;
				for ($k = $q; $k < count($grades); $k++) {
					//echo $kamal;
					// echo ':';
					//echo $grades[$k];
					// echo ':';
					//echo $opvkh_value[$k];
					// echo '<br>';
					$trigar++;

					$ValueData = array(
						'opvkh_opskh_id' => $kamal,
						'opvkh_j_g_id' => $grades[$k],
						'opvkh_value' => $opvkh_value[$k],
						'opvkh_status' => 1,
						'opvkh_wh_kf_status' => 0,
						'opvkh_created_at' => get_current_time(),
						'opvkh_created_by' => $this->session->userdata('currentActiveId')
					);
					$this->M_khamal->insertData('opening_khamal_value', $ValueData);

					if ($trigar == $tGradeCount) {
						break;
					}
				}

				$kfValueData = array(
					'opvkh_opskh_id' => $opsSummaryId[$i],
					'opvkh_value' => $opvkh_kf[$i],
					'opvkh_j_g_id' => "kf",
					'opvkh_status' => 1,
					'opvkh_wh_kf_status' => 2,
					'opvkh_created_at' => get_current_time(),
					'opvkh_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertData('opening_khamal_value', $kfValueData);

				$whValueData = array(
					'opvkh_opskh_id' => $opsSummaryId[$i],
					'opvkh_value' => $opvkh_wh[$i],
					'opvkh_j_g_id' => "wh",
					'opvkh_status' => 1,
					'opvkh_wh_kf_status' => 1,
					'opvkh_created_at' => get_current_time(),
					'opvkh_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertData('opening_khamal_value', $whValueData);
				$q += $tGradeCount;
			}


			set_confirmation_msg("TRUE", 'Your data has been inserted successfully.', '');
			redirect('list_opening_khamal');
		}
	}


	public function editOpeningKhamal()
	{
		$data = $this->engine->store_nav('khamal', 'list_opening_khamal', 'List Opening Khamal');
		$opskh_id = $this->input->get('opskh_id');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['openingKhamalSummary'] = $this->Common->get_single_row_information('opening_khamal_summary', 'opskh_id', $opskh_id);
		$path = 'backend/jute/khamal/edit_opening_khamal';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	public function updateOpeningKhamal()
	{
		$opvkh_id = $this->input->post('opvkh_id');
		$opvkh_value = $this->input->post('opvkh_value');
		$opvkh_value_id = $this->input->post('opvkh_value_id');

		for ($i = 0; $i < count($opvkh_value); $i++) {
			$updateData = array(
				'opvkh_value' => $opvkh_value[$i],
				'opvkh_updated_at' => get_current_time(),
				'opvkh_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('opening_khamal_value', 'opvkh_id', $opvkh_value_id[$i], $updateData);
		}

		$opvkh_kh_id = $this->input->post('opvkh_kh_id');
		$opskh_date = $this->input->post('opvkh_date');
		$opskh_date = date("Y-m-d", strtotime($opskh_date));
		$opskh_fy_id = $this->input->post('opvkh_fy_id');
		$opskh_bojha = $this->input->post('opvkh_bojha');
		$opskh_total = $this->input->post('opvkh_total');

		$updateData = array(
			'opskh_kh_id' => $opvkh_kh_id,
			'opskh_date' => $opskh_date,
			'opskh_fy_id' => $opskh_fy_id,
			'opskh_bojha' => $opskh_bojha,
			'opskh_total' => number_format($opskh_total, 2, '.', ''),
			'opskh_updated_at' => get_current_time(),
			'opskh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_khamal_summary', 'opskh_id', $opvkh_id, $updateData);

		$opvkh_kf_id = $this->input->post('opvkh_kf_id');
		$opvkh_kf = $this->input->post('opvkh_kf');
		$kfValueData = array(
			'opvkh_value' => $opvkh_kf,
			'opvkh_j_g_id' => "kf",
			'opvkh_updated_at' => get_current_time(),
			'opvkh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_khamal_value', 'opvkh_id', $opvkh_kf_id, $kfValueData);

		$opvkh_wh_id = $this->input->post('opvkh_wh_id');
		$opvkh_wh = $this->input->post('opvkh_wh');
		$whValueData = array(
			'opvkh_value' => $opvkh_wh,
			'opvkh_j_g_id' => "wh",
			'opvkh_updated_at' => get_current_time(),
			'opvkh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_khamal_value', 'opvkh_id', $opvkh_wh_id, $whValueData);

		set_confirmation_msg("TRUE", 'Your data has been updated successfully.', '');
		redirect('list_opening_khamal');
	}

	public function deleteOpeningKhamal()
	{
		$opskh_id = $this->input->get('opskh_id');
		// Summary
		$updateData = array(
			'opskh_status' => 0,
			'opskh_updated_at' => get_current_time(),
			'opskh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_khamal_summary', 'opskh_id', $opskh_id, $updateData);
		// Value
		$updateValueData = array(
			'opvkh_status' => 0,
			'opvkh_updated_at' => get_current_time(),
			'opvkh_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('opening_khamal_value', 'opvkh_opskh_id', $opskh_id, $updateValueData);
		redirect('list_opening_khamal');
	}


	// Financial year
	public function ajaxFinancialYearForOpeningKhamal()
	{
		$opvkh_date = date("Y-m-d", strtotime($this->input->post('opvkh_date')));
		$valid = $this->M_khamal->ajaxFinancialYear($opvkh_date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}



	//Year Check
	public function ajaxOpeningKhamalYearCheck()
	{
		$y = date("Y", strtotime($this->input->post('date')));
		$true = $this->M_khamal->ajaxFindYearOpeningKhamal($y);
		if ($true) {
			echo $true->opskh_date;
		} else {
			echo "no";
		}
	}

	//Alert for get Used 
	public function ajaxUsedByKhamalId()
	{
		$opvkh_kh_id = $this->input->post('opvkh_kh_id');

		$conditions = array(
			'kh_id' => $opvkh_kh_id,
			'kh_status' => 1
		);
		$used = $this->M_khamal->getKhamalByConditions($conditions)->kh_used;
		echo $used;
	}

	/* ================== Check Opening Khamal Data Financial Year Wise ================== */
	public function ajaxFinancialYearWiseOpeningKhamalCheck()
	{
		$testIdKhamal = $this->input->post('testKhamalFYId');



		$valid = $this->M_khamal->ajaxMFinancialYearWiseOpeningKhamalCheck($testIdKhamal);
		if ($valid) {
			echo $valid->opskh_fy_id;
		} else {
			echo "no";
		}
	}


	/* =================== Khamal Running Stock =================== */

	public function addKhamalRunningStock()
	{
		$data = $this->engine->store_nav('khamal', 'list_khamal_running_stock', 'Add Khamal Running Stock');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/khamal/add_khamal_running_stock';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	public function listKhamalRunningStock()
	{
		$data = $this->engine->store_nav('khamal', 'list_khamal_running_stock', 'List Khamal Running Stock');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['runningStockSummary'] = $this->Common->get_data_multi_conditional('khamal_running_stock_summary', ['khrss_status' => 1]);
		$path = 'backend/jute/khamal/list_khamal_running_stock';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function insertKhamalRunningStock()
	{
		$kamals = $this->input->post('khrsv_kh_id');
		$khrss_kh_id = $kamals;

		$khrss_date = $this->input->post('khrsv_date');
		$khrss_date = date("Y-m-d", strtotime($khrss_date));
		$khrss_fy_id = $this->input->post('khrsv_fy_id');
		$khrss_description = $this->input->post('khrsv_description');
		$khrss_bojha = $this->input->post('khrsv_bojha');
		$khrss_used = $this->input->post('khrsv_used');
		$khrss_total = $this->input->post('khrsv_total');

		$year = date("Y", strtotime($khrss_date));
		$month = date("m", strtotime($khrss_date));



		foreach ($kamals as $value) {
			if ($value != null) {
				$checkExistingData = $this->Common->get_single_row_information_multi_conditional('khamal_running_stock_summary', ['khrss_kh_id' => $value, 'YEAR(khrss_date)' => $year, 'MONTH(khrss_date)' => $month, 'khrss_status' => 1]);
				if ($checkExistingData) {
					set_confirmation_msg("", '', 'You have already entered this month Running Stock. Please enter valid month.');
					redirect('add_khamal_running_stock');
				}
			}
		}

		$newArray = [];
		foreach ($khrss_kh_id as $value) {
			if ($value != null) {
				array_push($newArray, $value);
			}
		}
		// x_debug(count($newArray));
		// x_debug(count(array_unique($newArray)));

		// x_debug($newArray);


		if (count(array_unique($newArray)) < count($newArray)) {
			set_confirmation_msg("", '', 'You have entered duplicate khamal.');
			redirect('add_khamal_running_stock');
		} else {
			for ($i = 0; $i < count($khrss_kh_id); $i++) {
				$summaryData = array(
					'khrss_kh_id' => $khrss_kh_id[$i],
					'khrss_date' => $khrss_date,
					'khrss_fy_id' => $khrss_fy_id,
					'khrss_description' => $khrss_description[$i],
					'khrss_bojha' => $khrss_bojha[$i],
					'khrss_used' => $khrss_used[$i],
					'khrss_total' => number_format($khrss_total[$i], 2, '.', ''),
					'khrss_status' => 1,
					'khrss_created_at' => get_current_time(),
					'khrss_created_by' => $this->session->userdata('currentActiveId')
				);
				$khrsSummaryId[] = $this->M_khamal->insertData('khamal_running_stock_summary', $summaryData);
			}

			$jute_grades = $this->M_grade->getJuteGrade();
			$tGradeCount = count($jute_grades->result());
			$khrsv_kf = $this->input->post('khrsv_kf');
			$khrsv_wh = $this->input->post('khrsv_wh');

			$grades = $this->input->post('khrsv_j_g_id');
			$khrsv_value = $this->input->post('khrsv_value');
			$q = 0;
			for ($i = 0; $i < count($khrsSummaryId); $i++) {
				$kamal = $khrsSummaryId[$i];
				$trigar = 0;
				// echo '<br>';
				//echo $kamal;
				for ($k = $q; $k < count($grades); $k++) {
					//echo $kamal;
					// echo ':';
					//echo $grades[$k];
					// echo ':';
					//echo $khrsv_value[$k];
					// echo '<br>';
					$trigar++;


					$ValueData = array(
						'khrsv_khrss_id' => $kamal,
						'khrsv_j_g_id' => $grades[$k],
						'khrsv_value' => $khrsv_value[$k],
						'khrsv_status' => 1,
						'khrsv_wh_kf_status' => 0,
						'khrsv_created_at' => get_current_time(),
						'khrsv_created_by' => $this->session->userdata('currentActiveId')
					);
					$this->M_khamal->insertData('khamal_running_stock_value', $ValueData);

					if ($trigar == $tGradeCount) {
						break;
					}
				}

				$kfValueData = array(
					'khrsv_khrss_id' => $khrsSummaryId[$i],
					'khrsv_value' => $khrsv_kf[$i],
					'khrsv_j_g_id' => "kf",
					'khrsv_status' => 1,
					'khrsv_wh_kf_status' => 2,
					'khrsv_created_at' => get_current_time(),
					'khrsv_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertData('khamal_running_stock_value', $kfValueData);

				$whValueData = array(
					'khrsv_khrss_id' => $khrsSummaryId[$i],
					'khrsv_value' => $khrsv_wh[$i],
					'khrsv_j_g_id' => "wh",
					'khrsv_status' => 1,
					'khrsv_wh_kf_status' => 1,
					'khrsv_created_at' => get_current_time(),
					'khrsv_created_by' => $this->session->userdata('currentActiveId')
				);
				$this->M_khamal->insertData('khamal_running_stock_value', $whValueData);
				$q += $tGradeCount;
			}
			redirect('list_khamal_running_stock');
		}
	}


	// Update Khamal Running Stock
	public function editKhamalRunningStock()
	{
		$data = $this->engine->store_nav('khamal', 'list_khamal_running_stock', 'Edit Khamal Running Stock');
		$khrss_id = $this->input->get('khrss_id');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['runningStockSummaryInEdit'] = $this->Common->get_single_row_information('khamal_running_stock_summary', 'khrss_id', $khrss_id);
		$path = 'backend/jute/khamal/edit_khamal_running_stock';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function updateKhamalRunningStock()
	{
		$khrsv_id = $this->input->post('khrsv_id');
		$khrsv_value = $this->input->post('khrsv_value');
		$khrsv_value_id = $this->input->post('khrsv_value_id');

		for ($i = 0; $i < count($khrsv_value); $i++) {
			$updateData = array(
				'khrsv_value' => $khrsv_value[$i],
				'khrsv_updated_at' => get_current_time(),
				'khrsv_updated_by' => $this->session->userdata('currentActiveId')
			);
			$this->Common->update_data('khamal_running_stock_value', 'khrsv_id', $khrsv_value_id[$i], $updateData);
		}

		$khrsv_kh_id = $this->input->post('khrsv_kh_id');
		$khrss_date = $this->input->post('khrsv_date');
		$khrss_date = date("Y-m-d", strtotime($khrss_date));
		$khrss_fy_id = $this->input->post('khrsv_fy_id');
		$khrss_description = $this->input->post('khrsv_description');
		$khrss_used = $this->input->post('khrsv_used');
		$khrss_bojha = $this->input->post('khrsv_bojha');
		$khrss_total = $this->input->post('khrsv_total');

		$updateData = array(
			'khrss_kh_id' => $khrsv_kh_id,
			'khrss_date' => $khrss_date,
			'khrss_fy_id' => $khrss_fy_id,
			'khrss_description' => $khrss_description,
			'khrss_used' => $khrss_used,
			'khrss_bojha' => $khrss_bojha,
			'khrss_total' => number_format($khrss_total, 2, '.', ''),
			'khrss_updated_at' => get_current_time(),
			'khrss_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_running_stock_summary', 'khrss_id', $khrsv_id, $updateData);

		$khrsv_kf_id = $this->input->post('khrsv_kf_id');
		$khrsv_kf = $this->input->post('khrsv_kf');
		$kfValueData = array(
			'khrsv_value' => $khrsv_kf,
			'khrsv_j_g_id' => "kf",
			'khrsv_updated_at' => get_current_time(),
			'khrsv_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_running_stock_value', 'khrsv_id', $khrsv_kf_id, $kfValueData);

		$khrsv_wh_id = $this->input->post('khrsv_wh_id');
		$khrsv_wh = $this->input->post('khrsv_wh');
		$whValueData = array(
			'khrsv_value' => $khrsv_wh,
			'khrsv_j_g_id' => "wh",
			'khrsv_updated_at' => get_current_time(),
			'khrsv_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_running_stock_value', 'khrsv_id', $khrsv_wh_id, $whValueData);
		redirect('list_khamal_running_stock');
	}

	public function deleteKhamalRunningStock()
	{
		$khrss_id = $this->input->get('khrss_id');
		$updateData = array(
			'khrss_status' => 0,
			'khrss_updated_at' => get_current_time(),
			'khrss_updated_by' => $this->session->userdata('currentActiveId')
		);
		$this->Common->update_data('khamal_running_stock_summary', 'khrss_id', $khrss_id, $updateData);
		redirect('list_khamal_running_stock');
	}


	// Financial year Running Stock
	public function ajaxFinancialYearKhamalRunningStock()
	{
		$khrsv_date = date("Y-m-d", strtotime($this->input->post('khrsv_date')));
		$valid = $this->M_khamal->ajaxFinancialYearKhamalRunningStock($khrsv_date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	//Financial Year Get
	public function ajaxMonthYearKhamalRunningStock()
	{
		$m = date("m", strtotime($this->input->post('date')));
		$y = date("Y", strtotime($this->input->post('date')));
		$true = $this->M_khamal->ajaxFindMonth($m, $y);
		if ($true) {
			echo $true->khrss_date;
		} else {
			echo "no";
		}
	}






	/* ========================== Unassorted Uncut Added/deduction, Cut Added/Deduction Previous Grade Value Check - Rimon ============================= */

	public function getPreviousAssortedUncutAddedValueByKhamalId()
	{
		$khamal_id = $this->input->post('khamal_id');
		$data = array(
			'kh_auc_a_v_kh_id' => $khamal_id,
			'kh_auc_a_v_status' => 1
		);
		$getData = $this->M_khamal->getPreviousInsertedValueTest('khamal_assorted_uncut_added_value', $data);
		if ($getData) {

			$data['previous_data'] = $getData;
			echo json_encode($data);
		} else {
			$data['previous_data'] = "";
			echo json_encode($data);
		}
	}

	public function getPreviousAssortedUncutDeductionValueByKhamalId()
	{
		$khamal_id = $this->input->post('khamal_id');
		$data = array(
			'kh_auc_d_v_kh_id' => $khamal_id,
			'kh_auc_d_v_status' => 1
		);
		$getData = $this->M_khamal->getPreviousInsertedValueTest('khamal_assorted_uncut_deduction_value', $data);
		if ($getData) {

			$data['previous_data'] = $getData;
			echo json_encode($data);
		} else {
			$data['previous_data'] = "";
			echo json_encode($data);
		}
	}

	public function getPreviousAssortedCutAddedValueByKhamalId()
	{
		$khamal_id = $this->input->post('khamal_id');
		$data = array(
			'kh_ac_a_v_kh_id' => $khamal_id,
			'kh_ac_a_v_status' => 1
		);
		$getData = $this->M_khamal->getPreviousInsertedValueTest('khamal_assorted_cut_added_value', $data);
		if ($getData) {

			$data['previous_data'] = $getData;
			echo json_encode($data);
		} else {
			$data['previous_data'] = "";
			echo json_encode($data);
		}
	}

	public function getPreviousAssortedCutDeductionValueByKhamalId()
	{
		$khamal_id = $this->input->post('khamal_id');
		$data = array(
			'kh_ac_d_v_kh_id' => $khamal_id,
			'kh_ac_d_v_status' => 1
		);
		$getData = $this->M_khamal->getPreviousInsertedValueTest('khamal_assorted_cut_deduction_value', $data);
		if ($getData) {

			$data['previous_data'] = $getData;
			echo json_encode($data);
		} else {
			$data['previous_data'] = "";
			echo json_encode($data);
		}
	}

	//10.04.23
	// daily_jute_khamal_report
	public function dailyJuteKhamalReport()
	{
		$data = $this->engine->store_nav('khamal', 'daily_jute_khamal_report', 'Daily Jute Khamal Report');
		$kh_ac_a_v_date = $this->input->post('kh_ac_a_v_date');

		if ($kh_ac_a_v_date == '') {
			$kh_ac_a_v_date = get_current_time_time();
			//x_debug($kh_ac_a_v_date);
		}
		$kh_ac_a_v_date = date("Y-m-d", strtotime($kh_ac_a_v_date));
		//x_debug($kh_ac_a_v_date);


		$data_f = array(
			'date(kh_ua_a_s_en_date)' => $kh_ac_a_v_date,
			'kh_ua_a_s_status' => 1
		);

		// 	public function getUnassortedDeductionSummary()
		// {
		// 	$this->db->order_by("kh_ua_d_s_date", "asc");
		// 	$this->db->where('kh_ua_d_s_status', 1);
		// 	$query = $this->db->get("khamal_unassorted_deduction_summary");
		// 	return $query;

		// }

		// 	public function getAssortedUncutAddedSummary()
		// {
		// 	$this->db->order_by("kh_auc_a_s_date", "desc");
		// 	$this->db->where('kh_auc_a_s_status', 1);
		// 	$query = $this->db->get("khamal_assorted_uncut_added_summary");
		// 	return $query;
		// }

		// public function getAssortedUncutDeductionSummary()
		// {
		// 	$this->db->order_by("kh_auc_d_s_date", "desc");
		// 	$this->db->where('kh_auc_d_s_status', 1);
		// 	$query = $this->db->get("khamal_assorted_uncut_deduction_summary");
		// 	return $query;
		// }

		// public function getAssortedCutAddedSummary()
		// {
		// 	$this->db->order_by("kh_ac_a_s_date", "desc");
		// 	$this->db->where('kh_ac_a_s_status', 1);
		// 	$query = $this->db->get("khamal_assorted_cut_added_summary");
		// 	return $query;
		// }

		// public function getAssortedCutDeductionSummary()
		// {
		// 	$this->db->order_by("kh_ac_d_s_date", "desc");
		// 	$this->db->where('kh_ac_d_s_status', 1);
		// 	$query = $this->db->get("khamal_assorted_cut_deduction_summary");
		// 	return $query;
		// }


		$data['unaaddedSummary'] = $this->Common->get_data_multi_conditional("khamal_unassorted_added_summary", $data_f);
		$data['unaDeductionSummary'] = $this->M_khamal->getUnassortedDeductionSummary();
		$data['assortedUncutAddedSummary'] = $this->M_khamal->getAssortedUncutAddedSummary();
		$data['assortedUncutDeductionSummary'] = $this->M_khamal->getAssortedUncutDeductionSummary();
		$data['assortedCutAddedSummary'] = $this->M_khamal->getAssortedCutAddedSummary();
		$data['assortedCutDeductionSummary'] = $this->M_khamal->getAssortedCutDeductionSummary();

		//x_debug($data['unaaddedSummary']->result());
		//$data['unaaddedSummary'] = $this->M_khamal->getUnassortedAddedSummary();
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['kh_ac_a_v_date'] = $kh_ac_a_v_date;
		$path = 'backend/jute/khamal/daily_jute_khamal_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	// End 
}
