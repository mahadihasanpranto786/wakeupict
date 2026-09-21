<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Entry extends CI_Controller
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

		$this->load->model('M_supplier');
		$this->load->model('M_mokam');
		$this->load->model('M_financial_year');
		$this->load->model('M_jute_entry');
		$this->load->model('M_area');
		$this->load->model('M_grade');
		$this->load->model('M_jute_rate');
		$this->load->model('M_godown');
	}

	// Add Entry Form
	public function addEntry()
	{
		$data = $this->engine->store_nav('entry', 'add_entry', 'Add Entry');
		$sup_t_id = 1; // Supplier type [1= Jute]
		$data['suppliers'] = $this->M_supplier->getSupplierbySupplierType($sup_t_id);
		$data['mokams'] = $this->M_mokam->getMokam();
		$data['financial_years'] = $this->M_financial_year->getFinancialYear();
		$data['entrys'] = $this->M_jute_entry->getJuteEntry();
		$path = 'backend/jute/entry/add_entry';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	// add Entry Form
	public function insertJuteEntry()
	{

		$en_fy_id = $this->input->post('en_fy_id');

		$en_date = $this->input->post('en_date');
		$en_time = $this->input->post('en_time');
		//redesign the date for database
		//$en_date = date("Y-m-d", strtotime($en_date));
		$en_date = date("Y-m-d H:i:s", strtotime("$en_date $en_time"));

		$en_lot_no = $this->input->post('en_lot_no');
		$en_s_id = $this->input->post('en_s_id');
		$en_mo_id = $this->input->post('en_mo_id');
		$en_jute_variety = $this->input->post('en_jute_variety');
		$en_chalan_no = $this->input->post('en_chalan_no');
		$en_truck_no = $this->input->post('en_truck_no');
		$en_td_name = $this->input->post('en_td_name');
		$en_bojha_bale = $this->input->post('en_bojha_bale');
		$en_bojha_weight = $this->input->post('en_bojha_weight');
		$en_net_weight = $this->input->post('en_net_weight');
		$en_net_mds = $this->input->post('en_net_mds');

		$data = array(
			'en_fy_id' => $en_fy_id,
			'en_date' => $en_date,
			'en_lot_no' => $en_lot_no,
			'en_s_id' => $en_s_id,
			'en_mo_id' => $en_mo_id,
			'en_jute_variety' => $en_jute_variety,
			'en_chalan_no' => $en_chalan_no,
			'en_truck_no' => $en_truck_no,
			'en_td_name' => $en_td_name,
			'en_bojha_bale' => $en_bojha_bale,
			'en_bojha_weight' => $en_bojha_weight,
			'en_net_weight' => number_format($en_net_weight, 3, '.', ''),
			'en_net_mds' => number_format($en_net_mds, 3, '.', ''),
			'en_status' => 1,
			'en_out_turn_status' => 1,
			'en_jri_status' => 0,
			'en_created_at' => get_current_time(),
			'en_created_by' => $this->session->userdata('currentActiveId'),
		);

		// echo '<pre>';
		// print_r($data);

		$id = $this->M_jute_entry->insertJuteEntry($data);
		if ($id) {
			set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
		} else {
			set_confirmation_msg('False', '', 'Some thing worng happend.');
		}
		redirect('list_jute_entry');
	}

	// List Entry Form
	public function listJuteEntry()
	{
		$data = $this->engine->store_nav('entry', 'list_jute_entry', 'List Entry');
		// Pagination
		// Search
		$search_text = $this->input->get('search');

		$per_page_data = 50;
		$offset = pagination_offset(2, $per_page_data);

		$url = "list_jute_entry";
		$data["serial"] = serial_number_per_page(2, $per_page_data);

		$data['entrys'] = $this->M_jute_entry->getJuteEntryByLimit($per_page_data, $offset, $search_text);
		$total_row = $this->M_jute_entry->get_count($search_text);
		$data["total_rows"] = $total_row;
		$data['search'] = $search_text;
		set_pagination($total_row, $url, $per_page_data);

		//text ar outhes character remove korar por associative array banici
		$enIdAndLotNO = [];
		foreach ($data['entrys']->result() as $entry) {
			$lotNoAfterRemovingStr = (int)$entry->en_lot_no;
			$enIdAndLotNO[$entry->en_id] = $lotNoAfterRemovingStr;
		}

		//  associative array Descending korlam
		arsort($enIdAndLotNO);

		// entry id bar Korlam
		$descendingEntryId = [];
		foreach ($enIdAndLotNO as $x => $x_value) {
			array_push($descendingEntryId, $x);
		}
		$data['entry_ides'] = $descendingEntryId;
		$path = 'backend/jute/entry/list_jute_entry';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Edit view form
	public function editJuteEntry()
	{
		$data = $this->engine->store_nav('entry', 'edit_jute_entry', 'Update Jute Entry');
		$en_id = $this->input->get('en_id');
		$data['jEntry'] = $this->M_jute_entry->getJuteEntryById($en_id);
		$sup_t_id = 1; // Supplier type [1= Jute]
		$data['suppliers'] = $this->M_supplier->getSupplierbySupplierType($sup_t_id);
		$data['mokams'] = $this->M_mokam->getMokam();
		$data['financial_years'] = $this->M_financial_year->getFinancialYear();
		$path = 'backend/jute/entry/edit_jute_entry';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//Update Entry
	public function updateJuteEntry()
	{
		$en_id = $this->input->post('en_id');
		$en_fy_id = $this->input->post('en_fy_id');

		$en_date = $this->input->post('en_date');
		$en_time = $this->input->post('en_time');
		//redesign the date for database
		//$en_date = date("Y-m-d", strtotime($en_date));
		$en_date = date("Y-m-d H:i:s", strtotime("$en_date $en_time"));

		$en_lot_no = $this->input->post('en_lot_no');
		$en_s_id = $this->input->post('en_s_id');
		$en_mo_id = $this->input->post('en_mo_id');
		$en_jute_variety = $this->input->post('en_jute_variety');
		$en_chalan_no = $this->input->post('en_chalan_no');
		$en_truck_no = $this->input->post('en_truck_no');
		$en_td_name = $this->input->post('en_td_name');
		$en_bojha_bale = $this->input->post('en_bojha_bale');
		$en_bojha_weight = $this->input->post('en_bojha_weight');
		$en_net_weight = $this->input->post('en_net_weight');
		$en_net_mds = $this->input->post('en_net_mds');

		$data = array(
			'en_id' => $en_id,
			'en_fy_id' => $en_fy_id,
			'en_date' => $en_date,
			'en_lot_no' => $en_lot_no,
			'en_s_id' => $en_s_id,
			'en_mo_id' => $en_mo_id,
			'en_jute_variety' => $en_jute_variety,
			'en_chalan_no' => $en_chalan_no,
			'en_truck_no' => $en_truck_no,
			'en_td_name' => $en_td_name,
			'en_bojha_bale' => $en_bojha_bale,
			'en_bojha_weight' => $en_bojha_weight,
			'en_net_weight' => number_format($en_net_weight, 3, '.', ''),
			'en_net_mds' => number_format($en_net_mds, 3, '.', ''),
			'en_updated_at' => get_current_time(),
			'en_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_jute_entry->updateJuteEntryTable($en_id, $data);
		redirect('list_jute_entry');
	}

	// Delete Data 
	public function deleteJuteEntry()
	{
		$en_id = $this->input->get('en_id');
		$data = array(
			'en_status' => 0,
			'en_updated_at' => get_current_time(),
			'en_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_jute_entry->updateJuteEntryTable($en_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Deleted succesfully', '');
		redirect($_SERVER['HTTP_REFERER']);
	}

	//Permanently Delete
	public function permanentlyDeleteJuteEntry()
	{
		$en_id = $this->input->get('en_id');
		$this->Common->delete_data('jute_entry', 'en_id', $en_id);
		redirect('list_jute_entry');
	}

	/* ======================== Return Jute Module ======================== */
	public function listJuteReturnInfo()
	{
		$data = $this->engine->store_nav('entry', 'list_jute_return_info', 'jute_return_info');
		$data['list'] = $this->M_jute_entry->getJuteReturnInfo();
		$path = 'backend/jute/entry/list_jute_return_info';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// List Entry Form
	public function insertJuteReturnInfo()
	{
		$jri_date = $this->input->post('jri_date');
		$jri_date = date("Y-m-d", strtotime($jri_date));
		$jri_return_by = $this->input->post('jri_return_by');
		$jri_reason = $this->input->post('jri_reason');
		$jri_en_id = $this->input->post('jri_en_id');

		$data = array(
			'jri_date' => $jri_date,
			'jri_return_by' => $jri_return_by,
			'jri_reason' => $jri_reason,
			'jri_en_id' => $jri_en_id,
			'jri_status' => 1,
			'jri_created_at' => get_current_time(),
			'jri_created_by' => $this->session->userdata('currentActiveId')
		);
		$this->M_jute_entry->insertData('jute_return_info', $data);

		//Update Entry Table
		$this->M_jute_entry->getJuteEntryById($jri_en_id)->en_jri_status;
		// x_debug($en_jri_status);
		$Update = array(
			'en_jri_status' => 1,
		);
		$this->M_jute_entry->updateJuteEntryTable($jri_en_id, $Update);

		redirect('list_jute_entry');
	}
	//Approve after return 
	public function approveJuteReturn()
	{
		$jri_id = $this->input->get('jri_id');
		$got_en_id = $this->M_jute_entry->getJuteReturnInfoById($jri_id)->jri_en_id;
		$data = array(
			'jri_status' => 2,
			'jri_updated_at' => get_current_time(),
			'jri_updated_by' => $this->session->userdata('currentActiveId')
		);
		//Update Entry Table status
		$this->M_jute_entry->approveJuteReturnInfo($jri_id, $data);
		$update = array(
			'en_jri_status' => 2
		);
		$this->M_jute_entry->updateJuteEntryTable($got_en_id, $update);
		redirect('list_jute_return_info');
	}
	//Jute Return revert if return is not need
	public function revertJuteReturn()
	{
		$jri_id = $this->input->get('jri_id');
		$got_en_id = $this->M_jute_entry->getJuteReturnInfoById($jri_id)->jri_en_id;
		$data = array(
			'jri_status' => 0,
			'jri_updated_at' => get_current_time(),
			'jri_updated_by' => $this->session->userdata('currentActiveId')
		);
		//Update Entry Table status
		$this->M_jute_entry->approveJuteReturnInfo($jri_id, $data);
		$update = array(
			'en_jri_status' => 0
		);
		$this->M_jute_entry->updateJuteEntryTable($got_en_id, $update);
		redirect('list_jute_return_info');
	}


	/* ======================== Out Turn Module ======================== */
	// Add Out Turn Report Form
	public function addOutTurnReport()
	{
		$data = $this->engine->store_nav('entry', 'add_out_turn_report', 'Add Out Turn Report');
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$data['financial_years'] = $this->M_financial_year->getFinancialYear();

		$table = "jute_entry";
		$conditions = array(
			'en_out_turn_status' => 1,
			'en_jri_status' => 0,
			//'en_fy_id' => $en_fy_id,
			'en_status' => 1,
		);
		$data['entrees'] = $this->M_jute_entry->get_data_multi_conditional($table, $conditions);
		//text ar outhes character remove korar por associative array banici
		$enIdAndLotNO = [];
		foreach ($data['entrees']->result() as $entry) {
			$lotNoAfterRemovingStr = (int)$entry->en_lot_no;
			$enIdAndLotNO[$entry->en_id] = $lotNoAfterRemovingStr;
		}

		//  associative array ass korlam
		asort($enIdAndLotNO);

		// entry id bar Korlam
		$descendingEntryId = [];
		foreach ($enIdAndLotNO as $x => $x_value) {
			array_push($descendingEntryId, $x);
		}
		$data['entry_ides'] = $descendingEntryId;
		$path = 'backend/jute/entry/add_out_turn_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function ajaxAreaId()
	{
		$ot_en_id = $this->input->post('ot_en_id');
		$entryInfo = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id);
		$en_date = date("d-m-Y H:i:s", strtotime($entryInfo->en_date));
		$en_datetime = date("d-m-Y H:i:s A", strtotime($entryInfo->en_date));
		$en_mo_id = $entryInfo->en_mo_id;
		$en_jute_variety = $entryInfo->en_jute_variety;
		//echo $en_mo_id;
		if ($entryInfo->en_jute_variety == 'Knaf') {
			$mo_ar_id = 4;
		} elseif ($entryInfo->en_jute_variety == 'White') {
			$mo_ar_id = 5;
		} else {
			$mo_ar_id = $this->M_mokam->getMokamById($en_mo_id)->mo_ar_id;
		}
		//echo $mo_ar_id;
		$data = array(
			'mo_ar_id' => $mo_ar_id,
			'en_date' => $en_date,
			'en_datetime' => $en_datetime,
			'en_jute_variety' => $en_jute_variety
		);
		echo json_encode($data);
	}

	public function insertOutTurnReport()
	{
		$ot_en_id = $this->input->post('ot_en_id');

		// For Invoice Serial Number - Rimon
		$selectLastSL = $this->M_jute_entry->get_data_with_limit_order_by_for_last_number('jute_purchase_invoice_summary', 1, 'jpis_id', 'DESC', ['jpis_status' => 1]);
		if ($selectLastSL) {
			$selectLastSL = $selectLastSL->jpis_invoice_sl;
			$createNextSerialNo = $selectLastSL + 1;
		} else {
			$createNextSerialNo = 1;
		}

		$en_jute_variety = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_jute_variety;
		if ($en_jute_variety == 'Normal' || $en_jute_variety == 'Knaf' || $en_jute_variety == 'White') {
			$ot_bill_type = 1;
		} else {
			$ot_bill_type = 0;
		}

		//supplier id
		$ot_en_s_id = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_s_id;
		$ot_en_chalan_no = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_chalan_no;
		$ot_en_mo_id = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_mo_id;
		$ot_en_lot_no = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_lot_no;
		$ot_en_en_fy_id = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_fy_id;

		$ot_ass_date = $this->input->post('ot_ass_date');
		$ot_ass_date = date("Y-m-d", strtotime($ot_ass_date));

		$ot_ar_id = $this->input->post('ot_ar_id');
		$ot_rec_bojha = $this->input->post('ot_rec_bojha');
		$ot_jute_type = $this->input->post('ot_jute_type');
		$ot_moisture = $this->input->post('ot_moisture');
		$ot_net_weight = $this->input->post('ot_net_weight');
		$ot_kgs = $this->input->post('ot_kgs');
		$ot_mds = $this->input->post('ot_mds');

		//Get entry date frome jute entry table
		$entryDate = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_date;
		// echo '<br>';
		// echo 'Entry Date: ' . $entryDate;

		//Get summary_table_id
		$jute_rate_summary_table_id = $this->M_jute_entry->getJuteRateSummaryByEntryDate($entryDate)->jrs_id;
		// echo '<br>';
		// echo 'summary_table_id: ' . $jute_rate_summary_table_id;

		// কাটিং %, কাটিং রেট এবং ব্যাড প্রভিশন ড়ায়নামিকলি ক্যালকুলেশন
		$formattedEntryDate = date("Y-m-d", strtotime($entryDate));
		$juteCalculationHelperData = $this->M_godown->getJuteCalculationHelperByEntryDate($formattedEntryDate);

		$mds = $ot_mds;

		//for insert data in out_turn_summary table
		$outTurnSummaryData = array(
			'ot_fy_id' => $ot_en_en_fy_id,
			'ot_lot_no' => $ot_en_lot_no,
			'ot_en_id' => $ot_en_id,
			'ot_en_s_id' => $ot_en_s_id,
			'ot_en_chalan_no' => $ot_en_chalan_no,
			'ot_en_mo_id' => $ot_en_mo_id,
			'ot_en_date' => $entryDate,
			'ot_ass_date' => $ot_ass_date,
			'ot_ar_id' => $ot_ar_id,
			'ot_rec_bojha' => number_format($ot_rec_bojha, 3, '.', ''),
			'ot_jute_type' => $ot_jute_type,
			'ot_moisture' => $ot_moisture,
			'ot_net_weight' => number_format($ot_net_weight, 3, '.', ''),
			'ot_kgs' => number_format($ot_kgs, 3, '.', ''),
			'ot_mds' => number_format($ot_mds, 3, '.', ''),
			'ot_status' => 1,
			'ot_bill_type' => $ot_bill_type,
			'ot_created_at' => get_current_time(),
			'ot_created_by' => $this->session->userdata('currentActiveId'),
		);
		$ot_id = $this->M_jute_entry->insertOutTurnSummary($outTurnSummaryData);

		// Update en_out_turn_status column in  jute_entry table
		$data = array(
			'en_out_turn_status' => 0,
		);
		$this->M_jute_entry->updateJuteEntryTable($ot_en_id, $data);

		//$ot_id = 1;

		/* আউট টান ফর্ম থেকে যে ডাটা পাইছি সেইটার সামারি (কোন ইশু নাই)*/
		// echo '<pre>';
		// print_r($outTurnSummaryData);

		//for insert data in out_turn_percentage table
		$gradeId = $this->input->post('gradeId');
		$outTurnPer = $this->input->post('outTurnPer');
		$outTurnCount = count($outTurnPer);

		for ($p = 0; $p < $outTurnCount; $p++) {
			$outTurnPerData = array(
				'otp_ot_id' => $ot_id,
				'otp_j_g_id' => $gradeId[$p],
				'otp_percentage' => $outTurnPer[$p],
				'otp_status' => 1,
				'otp_created_at' => get_current_time(),
				'otp_created_by' => $this->session->userdata('currentActiveId'),
			);
			$this->M_jute_entry->insertOutTurnPer($outTurnPerData);

			/* আউট টান ফর্ম থেকে গ্রেড অনুযায়ি যে ডাটা ঢুকবে (কোন ইশু নাই)*/
			//echo '<pre>';
			//print_r($outTurnPerData);
		}

		if ($en_jute_variety == 'Normal' || $en_jute_variety == 'Knaf' || $en_jute_variety == 'White') {

			//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু যেটা ডাটাবেজ হতে  আসবে

			$jute_rate_moisture = $this->M_jute_entry->jute_rate_moisture($jute_rate_summary_table_id, $ot_ar_id);

			$juteRateMoisture = 0;
			if ($ot_jute_type == 'new') {
				$juteRateMoisture = $jute_rate_moisture->jr_m_new;
			} else {
				$juteRateMoisture = $jute_rate_moisture->jr_m_old;
			}
			//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু
			$acceptableMoisture = $juteRateMoisture;

			$moistureVarification = $this->moistureVarification($ot_moisture, $acceptableMoisture);
			// echo '<br>';
			// echo 'moistu reVarification: ' . $moistureVarification;

			//Get juteRate
			$juteRate = $this->M_jute_entry->getJuteRateById($jute_rate_summary_table_id);
			// echo '<br>' . 'juteRate:';
			// echo '<pre>';

			/* জুট রেট সামারি টেবিল ‍অনুয়ায়ি জুট রেট টেবিল থেকে গ্রেড অনুযায়ী রেট ডাট */
			// print_r($juteRate);

			//Get Moisture
			$juteMoisture = $this->M_jute_entry->getJuteMoistureById($jute_rate_summary_table_id);
			// echo '<br>' . 'juteMoisture:';
			// echo '<pre>';
			// print_r($juteMoisture);

			//Get juteSmr
			$juteSmr = $this->M_jute_entry->getJuteSmrById($jute_rate_summary_table_id);
			// echo '<br>' . 'juteSmr:';
			// echo '<pre>';
			// print_r($juteSmr);

			$totalJuteCost = 0;
			for ($p = 0; $p < $outTurnCount; $p++) {
				//Murad & remon 20.09.22
				// SMR এর % বেশি হলে রেট কমে যাবে তাই এই ক্যালকুলেশন করা
				if ($gradeId[$p] == '5') {
					$smr = $this->M_jute_entry->getSmrRate($outTurnPer[$p], $jute_rate_summary_table_id);
					if ($smr == 0) {
						$smr = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
					}
					$juteRate = $smr;
				} else {
					$juteRate = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
				}
				//aga silo
				//$juteRate = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);

				$totalJuteCost += $this->juteRate(
					$this->juteQuantity(
						$this->modCalculation(
							$moistureVarification,
							$mds
						),
						$outTurnPer[$p]
					),
					$juteRate
				);
			}

			//for insert data in jute_purchase_invoice_summary table
			$jutePurchaseInvoiceSummaryData = array(
				'jpis_invoice_sl' => $createNextSerialNo,
				'jpis_fy_id' => $ot_en_en_fy_id,
				'jpis_jrs_id' => $jute_rate_summary_table_id,
				'jpis_contract_sheet_no' => 0,
				'jpis_ot_id' => $ot_id,
				'jpis_ot_en_s_id' => $ot_en_s_id,
				'jpis_ot_en_chalan_no' => $ot_en_chalan_no,
				'jpis_ot_en_mo_id' => $ot_en_mo_id,
				'jpis_ot_en_date' => $entryDate,
				'jpis_ot_lot_no' => $ot_en_lot_no,
				'jpis_ot_rec_bojha' => $ot_rec_bojha,
				'jpis_ot_kgs' => number_format($ot_kgs, 3, '.', ''),
				'jpis_ot_mds' => number_format($ot_mds, 3, '.', ''),
				'jpis_extra_moisture' => $moistureVarification,
				'jpis_ot_mds_after_deduction' => number_format($this->modCalculation($moistureVarification, $mds), 3, '.', ''),
				'jpis_total' => number_format($totalJuteCost, 3, '.', ''),
				'jpis_discount' => 0,
				'jpis_grand_total' => number_format($totalJuteCost, 3, '.', ''),
				'jpis_status' => 1,
				'jpis_bill_type' => 1,
				'jpis_jch_id' => $juteCalculationHelperData->jch_id,
				'jpis_created_by' => $this->session->userdata('currentActiveId'),
				'jpis_created_at' => get_current_time(),
			);
			// echo 'jute_purchase_invoice_summary';
			// echo '<pre>';
			// print_r($jutePurchaseInvoiceSummaryData);

			$jpis_id = $this->M_jute_entry->insertJutePurchaseInvoiceSummaryData($jutePurchaseInvoiceSummaryData);
			// $jpis_id = 1;

			//echo 'for insert data in jute_purchase_invoice_value table';
			for ($p = 0; $p < $outTurnCount; $p++) {

				// SMR এর % বেশি হলে রেট কমে যাবে তাই এই ক্যালকুলেশন করা
				if ($gradeId[$p] == '5') {
					$smr = $this->M_jute_entry->getSmrRate($outTurnPer[$p], $jute_rate_summary_table_id);
					//echo 'SMR:' . $juteRateCalculate;
					if ($smr == 0) {
						$smr = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
					}
					$juteRateCalculate = $smr;

					//exit();
				} else {
					$juteRateCalculate = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
					//echo 'rate:' . $juteRateCalculate;
					//exit();
				}

				// কাটিং %, কাটিং রেট এবং ব্যাড প্রভিশন ড়ায়নামিকলি ক্যালকুলেশন
				if ($gradeId[$p] == '1' or $gradeId[$p] == "2" or $gradeId[$p] == "3" or $gradeId[$p] == "4") {
					//---
					$jpiv_weight_mds = $this->juteQuantity(
						$this->modCalculation(
							$moistureVarification,
							$mds
						),
						$outTurnPer[$p]
					);
					$jpiv_after_cutting_mds = $jpiv_weight_mds - ($jpiv_weight_mds * $juteCalculationHelperData->jch_cutting_percentage / 100);
					$jpiv_cutting_mds = $jpiv_weight_mds * $juteCalculationHelperData->jch_cutting_percentage / 100;
					$jpiv_cutting_amount = $jpiv_cutting_mds * $juteCalculationHelperData->jch_cutting_rate;

					//--
					$jpiv_amount = $this->juteRate(
						$this->juteQuantity(
							$this->modCalculation(
								$moistureVarification,
								$mds
							),
							$outTurnPer[$p]
						),
						$juteRateCalculate
					);
					$jpiv_amount_with_bad_pro = $jpiv_amount + ($jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100);
					$jpiv_bad_pro_amount = $jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100;
				} else {
					$jpiv_after_cutting_mds = 0;
					$jpiv_cutting_mds = 0;
					$jpiv_cutting_amount = 0;
					//--
					$jpiv_amount = $this->juteRate(
						$this->juteQuantity(
							$this->modCalculation(
								$moistureVarification,
								$mds
							),
							$outTurnPer[$p]
						),
						$juteRateCalculate
					);
					$jpiv_amount_with_bad_pro = $jpiv_amount + ($jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100);
					$jpiv_bad_pro_amount = $jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100;
				}

				//for insert data in jute_purchase_invoice_value table
				$jutePurchaseInvoiceValueData = array(
					'jpiv_fy_id' => $ot_en_en_fy_id,
					'jpiv_jpis_id' => $jpis_id,
					'jpiv_j_g_id' => $gradeId[$p],
					'jpiv_percentage' => $outTurnPer[$p],
					'jpiv_unit_price' => $juteRateCalculate,
					'jpiv_weight_mds' =>
					number_format($this->juteQuantity(
						$this->modCalculation(
							$moistureVarification,
							$mds
						),
						$outTurnPer[$p]
					), 3, '.', ''),
					'jpiv_amount' => number_format($jpiv_amount = $this->juteRate(
						$this->juteQuantity(
							$this->modCalculation(
								$moistureVarification,
								$mds
							),
							$outTurnPer[$p]
						),
						$juteRateCalculate
					), 3, '.', ''),
					'jpiv_jrs_id' => $jute_rate_summary_table_id,
					'jpiv_status' => 1,
					'jpiv_after_cutting_mds' => number_format($jpiv_after_cutting_mds, 3, '.', ''),
					'jpiv_cutting_mds' => number_format($jpiv_cutting_mds, 3, '.', ''),
					'jpiv_cutting_amount' => number_format($jpiv_cutting_amount, 3, '.', ''),
					'jpiv_amount_with_bad_pro' => number_format($jpiv_amount_with_bad_pro, 3, '.', ''),
					'jpiv_bad_pro_amount' => number_format($jpiv_bad_pro_amount, 3, '.', ''),
					'jpiv_amount_with_bad_pro_after_cutting_amount' => number_format($jpiv_amount_with_bad_pro - $jpiv_cutting_amount, 3, '.', ''),
					'jpiv_created_by' => $this->session->userdata('currentActiveId'),
					'jpiv_created_at' => get_current_time(),
				);
				//echo '<pre>';
				//print_r($jutePurchaseInvoiceValueData);

				$this->M_jute_entry->insertJutePurchaseInvoiceValueData($jutePurchaseInvoiceValueData);
			}
		}

		//die();
		//x_debug($totalJuteCost);

		//echo 'CHup APAPAP';
		//redirect('list_out_turn_report');
		redirect('list_monthly_out_turn_report');
	}

	public function updateOutTurnReport()
	{


		$ot_id = $this->input->post('ot_id');
		$ot_en_id = $this->Common->get_single_row_information('out_turn_summary', 'ot_id', $ot_id)->ot_en_id;


		$en_jute_variety = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_jute_variety;
		// x_debug($en_jute_variety);
		if ($en_jute_variety == 'Normal' || $en_jute_variety == 'Knaf' || $en_jute_variety == 'White') {
			$ot_bill_type = 1;
		} else {
			$ot_bill_type = 0;
		}

		//supplier id
		$ot_en_s_id = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_s_id;
		$ot_en_chalan_no = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_chalan_no;
		$ot_en_mo_id = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_mo_id;
		$ot_en_lot_no = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_lot_no;
		$ot_en_en_fy_id = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_fy_id;





		$ot_ass_date = $this->input->post('ot_ass_date');
		$ot_ass_date = date("Y-m-d", strtotime($ot_ass_date));

		$ot_ar_id = $this->input->post('ot_ar_id');
		$ot_rec_bojha = $this->input->post('ot_rec_bojha');
		$ot_jute_type = $this->input->post('ot_jute_type');
		$ot_moisture = $this->input->post('ot_moisture');
		$ot_net_weight = $this->input->post('ot_net_weight');
		$ot_kgs = $this->input->post('ot_kgs');
		$ot_mds = $this->input->post('ot_mds');

		//Get entry date frome jute entry table
		$entryDate = $this->M_jute_entry->getEntryInfoByEnID($ot_en_id)->en_date;
		// x_debug($entryDate);
		// echo '<br>';
		// echo 'Entry Date: ' . $entryDate;

		//Get summary_table_id
		$jute_rate_summary_table_id = $this->M_jute_entry->getJuteRateSummaryByEntryDate($entryDate)->jrs_id;
		// echo '<br>';
		// echo 'summary_table_id: ' . $jute_rate_summary_table_id;

		// কাটিং %, কাটিং রেট এবং ব্যাড প্রভিশন ড়ায়নামিকলি ক্যালকুলেশন
		$formattedEntryDate = date("Y-m-d", strtotime($entryDate));
		$juteCalculationHelperData = $this->M_godown->getJuteCalculationHelperByEntryDate($formattedEntryDate);

		$mds = $ot_mds;

		//for insert data in out_turn_summary table
		$outTurnSummaryData = array(
			'ot_fy_id' => $ot_en_en_fy_id,
			// 'ot_lot_no' => $ot_en_lot_no,
			// 'ot_en_id' => $ot_en_id,
			// 'ot_en_s_id' => $ot_en_s_id,
			// 'ot_en_chalan_no' => $ot_en_chalan_no,
			// 'ot_en_mo_id' => $ot_en_mo_id,
			// 'ot_en_date' => $entryDate,
			'ot_ass_date' => $ot_ass_date,
			'ot_ar_id' => $ot_ar_id,
			'ot_rec_bojha' => $ot_rec_bojha,
			'ot_jute_type' => $ot_jute_type,
			'ot_moisture' => $ot_moisture,
			'ot_net_weight' => number_format($ot_net_weight, 3, '.', ''),
			'ot_kgs' => number_format($ot_kgs, 3, '.', ''),
			'ot_mds' => number_format($ot_mds, 3, '.', ''),
			// 'ot_status' => 1,
			'ot_bill_type' => $ot_bill_type,
			'ot_updated_at' => get_current_time(),
			'ot_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->Common->update_data('out_turn_summary', 'ot_id', $ot_id, $outTurnSummaryData);


		// Update en_out_turn_status column in  jute_entry table
		$data = array(
			'en_out_turn_status' => 0,
		);
		$this->M_jute_entry->updateJuteEntryTable($ot_en_id, $data);

		//$ot_id = 1;

		/* আউট টান ফর্ম থেকে যে ডাটা পাইছি সেইটার সামারি (কোন ইশু নাই)*/
		// echo '<pre>';
		// print_r($outTurnSummaryData);

		//for insert data in out_turn_percentage table


		$gradeId = $this->input->post('gradeId');
		$outTurnPer = $this->input->post('outTurnPer');
		$out_turn_per_value_id = $this->input->post('outTurnPerId');
		$outTurnCount = count($outTurnPer);

		for ($p = 0; $p < $outTurnCount; $p++) {
			$updateOutTurnPerData = array(
				// 'otp_ot_id' => $ot_id,
				// 'otp_j_g_id' => $gradeId[$p],
				'otp_percentage' => $outTurnPer[$p],
				// 'otp_status' => 1,
				'otp_updated_at' => get_current_time(),
				'otp_updated_by' => $this->session->userdata('currentActiveId'),
			);
			$this->Common->update_data('out_turn_percentage', 'otp_id', $out_turn_per_value_id[$p], $updateOutTurnPerData);

			/* আউট টান ফর্ম থেকে গ্রেড অনুযায়ি যে ডাটা ঢুকবে (কোন ইশু নাই)*/
			//echo '<pre>';
			//print_r($outTurnPerData);
		}





		if ($en_jute_variety == 'Normal' || $en_jute_variety == 'Knaf' || $en_jute_variety == 'White') {


			//Get Purchase info By out turn Id
			$arrayConditionalData = array(
				'jpis_ot_id' => $ot_id,
				'jpis_status' => 1
			);

			$jpis_iid = $this->Common->get_single_row_information_multi_conditional('jute_purchase_invoice_summary', $arrayConditionalData)->jpis_id;
			$updatePurchaseInvoiceSummaryPreviousData = array(
				'jpis_status' => 0
			);
			$this->Common->update_data('jute_purchase_invoice_summary', 'jpis_id', $jpis_iid, $updatePurchaseInvoiceSummaryPreviousData);


			/* Update Invoice Serial Number -> Rimon */
			$deletedData = array(
				'jpis_ot_id' => $ot_id,
				'jpis_status' => 0
			);
			$jpis_iiiiiid = $this->Common->get_single_row_information_multi_conditional('jute_purchase_invoice_summary', $deletedData)->jpis_invoice_sl;
			if ($jpis_iiiiiid) {
				$UpdateThisInvoiceSlNo = $jpis_iiiiiid;
			} else {
				$jpis_iiiiiid = $this->M_jute_entry->getLastJutePurchaseInvoiceSerialNumber()->jpis_invoice_sl;
				$UpdateThisInvoiceSlNo = $jpis_iiiiiid + 1;
			}

			/* /* Update Invoice Serial Number -> Rimon */



			//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু যেটা ডাটাবেজ হতে  আসবে

			$jute_rate_moisture = $this->M_jute_entry->jute_rate_moisture($jute_rate_summary_table_id, $ot_ar_id);

			$juteRateMoisture = 0;
			if ($ot_jute_type == 'new') {
				$juteRateMoisture = $jute_rate_moisture->jr_m_new;
			} else {
				$juteRateMoisture = $jute_rate_moisture->jr_m_old;
			}
			//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু
			$acceptableMoisture = $juteRateMoisture;

			$moistureVarification = $this->moistureVarification($ot_moisture, $acceptableMoisture);
			// echo '<br>';
			// echo 'moistu reVarification: ' . $moistureVarification;

			//Get juteRate
			$juteRate = $this->M_jute_entry->getJuteRateById($jute_rate_summary_table_id);
			// echo '<br>' . 'juteRate:';
			// echo '<pre>';

			/* জুট রেট সামারি টেবিল ‍অনুয়ায়ি জুট রেট টেবিল থেকে গ্রেড অনুযায়ী রেট ডাট */
			// print_r($juteRate);

			//Get Moisture
			$juteMoisture = $this->M_jute_entry->getJuteMoistureById($jute_rate_summary_table_id);
			// echo '<br>' . 'juteMoisture:';
			// echo '<pre>';
			// print_r($juteMoisture);

			//Get juteSmr
			$juteSmr = $this->M_jute_entry->getJuteSmrById($jute_rate_summary_table_id);
			// echo '<br>' . 'juteSmr:';
			// echo '<pre>';
			// print_r($juteSmr);

			$totalJuteCost = 0;
			for ($p = 0; $p < $outTurnCount; $p++) {
				//Murad & remon 20.09.22
				// SMR এর % বেশি হলে রেট কমে যাবে তাই এই ক্যালকুলেশন করা
				if ($gradeId[$p] == '5') {
					$smr = $this->M_jute_entry->getSmrRate($outTurnPer[$p], $jute_rate_summary_table_id);
					if ($smr == 0) {
						$smr = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
					}
					$juteRate = $smr;
				} else {
					$juteRate = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
				}
				//aga silo
				//$juteRate = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
				$totalJuteCost += $this->juteRate(
					$this->juteQuantity(
						$this->modCalculation(
							$moistureVarification,
							$mds
						),
						$outTurnPer[$p]
					),
					$juteRate
				);
			}

			//for insert data in jute_purchase_invoice_summary table
			$jutePurchaseInvoiceSummaryData = array(
				'jpis_invoice_sl' => $UpdateThisInvoiceSlNo,
				'jpis_fy_id' => $ot_en_en_fy_id,
				'jpis_jrs_id' => $jute_rate_summary_table_id,
				'jpis_contract_sheet_no' => 0,
				'jpis_ot_id' => $ot_id,
				'jpis_ot_en_s_id' => $ot_en_s_id,
				'jpis_ot_en_chalan_no' => $ot_en_chalan_no,
				'jpis_ot_en_mo_id' => $ot_en_mo_id,
				'jpis_ot_en_date' => $entryDate,
				'jpis_ot_lot_no' => $ot_en_lot_no,
				'jpis_ot_rec_bojha' => $ot_rec_bojha,
				'jpis_ot_kgs' => number_format($ot_kgs, 3, '.', ''),
				'jpis_ot_mds' => number_format($ot_mds, 3, '.', ''),
				'jpis_extra_moisture' => $moistureVarification,
				'jpis_ot_mds_after_deduction' => number_format($this->modCalculation($moistureVarification, $mds), 3, '.', ''),
				'jpis_total' => number_format($totalJuteCost, 3, '.', ''),
				'jpis_discount' => 0,
				'jpis_grand_total' => number_format($totalJuteCost, 3, '.', ''),
				'jpis_status' => 1,
				'jpis_bill_type' => 1,
				'jpis_jch_id' => $juteCalculationHelperData->jch_id,
				'jpis_created_by' => $this->session->userdata('currentActiveId'),
				'jpis_created_at' => get_current_time(),
			);

			// echo 'jute_purchase_invoice_summary';
			// echo '<pre>';
			// print_r($jutePurchaseInvoiceSummaryData);
			$jpis_id = $this->M_jute_entry->insertJutePurchaseInvoiceSummaryData($jutePurchaseInvoiceSummaryData);


			// $jpis_id = $this->Common->update_data('jute_purchase_invoice_summary', 'jpis_ot_id', $ot_id, $jutePurchaseInvoiceSummaryData);
			// $jpis_id = 1;

			//echo 'for insert data in jute_purchase_invoice_value table';
			for ($p = 0; $p < $outTurnCount; $p++) {

				// SMR এর % বেশি হলে রেট কমে যাবে তাই এই ক্যালকুলেশন করা
				if ($gradeId[$p] == '5') {
					$smr = $this->M_jute_entry->getSmrRate($outTurnPer[$p], $jute_rate_summary_table_id);
					//echo 'SMR:' . $juteRateCalculate;
					if ($smr == 0) {
						$smr = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
					}
					$juteRateCalculate = $smr;

					//exit();
				} else {
					$juteRateCalculate = $this->juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId[$p]);
					//echo 'rate:' . $juteRateCalculate;
					//exit();
				}

				// কাটিং %, কাটিং রেট এবং ব্যাড প্রভিশন ড়ায়নামিকলি ক্যালকুলেশন
				if ($gradeId[$p] == '1' or $gradeId[$p] == "2" or $gradeId[$p] == "3" or $gradeId[$p] == "4") {
					//---
					$jpiv_weight_mds = $this->juteQuantity(
						$this->modCalculation(
							$moistureVarification,
							$mds
						),
						$outTurnPer[$p]
					);
					$jpiv_after_cutting_mds = $jpiv_weight_mds - ($jpiv_weight_mds * $juteCalculationHelperData->jch_cutting_percentage / 100);
					$jpiv_cutting_mds = $jpiv_weight_mds * $juteCalculationHelperData->jch_cutting_percentage / 100;
					$jpiv_cutting_amount = $jpiv_cutting_mds * $juteCalculationHelperData->jch_cutting_rate;

					//--
					$jpiv_amount = $this->juteRate(
						$this->juteQuantity(
							$this->modCalculation(
								$moistureVarification,
								$mds
							),
							$outTurnPer[$p]
						),
						$juteRateCalculate
					);
					$jpiv_amount_with_bad_pro = $jpiv_amount + ($jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100);
					$jpiv_bad_pro_amount = $jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100;
				} else {
					$jpiv_after_cutting_mds = 0;
					$jpiv_cutting_mds = 0;
					$jpiv_cutting_amount = 0;
					//--
					$jpiv_amount = $this->juteRate(
						$this->juteQuantity(
							$this->modCalculation(
								$moistureVarification,
								$mds
							),
							$outTurnPer[$p]
						),
						$juteRateCalculate
					);
					$jpiv_amount_with_bad_pro = $jpiv_amount + ($jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100);
					$jpiv_bad_pro_amount = $jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100;
				}

				//for insert data in jute_purchase_invoice_value table
				$jutePurchaseInvoiceValueData = array(
					'jpiv_fy_id' => $ot_en_en_fy_id,
					'jpiv_jpis_id' => $jpis_id,
					'jpiv_j_g_id' => $gradeId[$p],
					'jpiv_percentage' => $outTurnPer[$p],
					'jpiv_unit_price' => number_format($juteRateCalculate, 3, '.', ''),
					'jpiv_weight_mds' =>
					number_format($this->juteQuantity(
						$this->modCalculation(
							$moistureVarification,
							$mds
						),
						$outTurnPer[$p]
					), 3, '.', ''),
					'jpiv_amount' => number_format($jpiv_amount = $this->juteRate(
						$this->juteQuantity(
							$this->modCalculation(
								$moistureVarification,
								$mds
							),
							$outTurnPer[$p]
						),
						$juteRateCalculate
					), 3, '.', ''),
					'jpiv_jrs_id' => $jute_rate_summary_table_id,
					'jpiv_status' => 1,
					'jpiv_after_cutting_mds' => number_format($jpiv_after_cutting_mds, 3, '.', ''),
					'jpiv_cutting_mds' => number_format($jpiv_cutting_mds, 3, '.', ''),
					'jpiv_cutting_amount' => number_format($jpiv_cutting_amount, 3, '.', ''),
					'jpiv_amount_with_bad_pro' => number_format($jpiv_amount_with_bad_pro, 3, '.', ''),
					'jpiv_bad_pro_amount' => number_format($jpiv_bad_pro_amount, 3, '.', ''),
					'jpiv_amount_with_bad_pro_after_cutting_amount' => number_format($jpiv_amount_with_bad_pro - $jpiv_cutting_amount, 3, '.', ''),
					'jpiv_created_by' => $this->session->userdata('currentActiveId'),
					'jpiv_created_at' => get_current_time(),
				);
				//echo '<pre>';
				//print_r($jutePurchaseInvoiceValueData);
				$this->M_jute_entry->insertJutePurchaseInvoiceValueData($jutePurchaseInvoiceValueData);
				// $this->Common->update_data('jute_purchase_invoice_value', 'jpiv_id', $jpis_id, $jutePurchaseInvoiceValueData);
			}
		}



		redirect('list_monthly_out_turn_report');
	}

	// private function calculateOuterTurnCost($moistureVarification, $mds, $juteType, $jutePersentage, $juteRate)
	// {
	//     if ($moistureVarification) {
	//         $mds = $mds - ($mds * $moistureVarification) / 100;
	//         $objectQuantity = $mds * $jutePersentage / 100;
	//         return $objectQuantity * $juteRate;
	//     } else {
	//         return $mds * $juteRate;
	//     }
	// }

	private function modCalculation($moistureVarification, $mds)
	{
		if ($moistureVarification) {
			$mds = $mds - ($mds * $moistureVarification) / 100;
		}
		return $mds;
	}

	private function juteQuantity($mds, $jutePersentage)
	{
		// out turn per na dila ba faka dila error marto ti ai kaj korsi
		if (!$jutePersentage) {
			$jutePersentage = 0;
		}
		return ($mds * $jutePersentage) / 100;
	}

	private function juteRate($juteQuantity, $juteRate)
	{
		return $juteQuantity * $juteRate;
	}

	private function moistureVarification($ot_moisture, $acceptableMoisture)
	{
		return $ot_moisture > $acceptableMoisture ? $ot_moisture - $acceptableMoisture : false;
	}

	private function juteRateCalculate($jute_rate_summary_table_id, $ot_ar_id, $gradeId)
	{
		$getJuteRate = $this->M_jute_entry->getJuteRate($jute_rate_summary_table_id, $ot_ar_id, $gradeId);
		//return $getJuteRate->jr_rate; //aga ilo
		return $getJuteRate;
	}

	private function calculateGradeWiseJuteMdsQuantity($gradeId, $mds, $outTurnPer)
	{
		if ($gradeId) {
			$GradeWiseJuteMdsQuantity = ($mds * $outTurnPer) / 100;
			return $GradeWiseJuteMdsQuantity;
		} else {
			echo 'False';
		}
	}

	// private function calculateGradeWiseJuteAmount($gradeId, $juteRateCalculate, $calculateGradeWiseJuteMdsQuantity)
	// {
	//     if ($gradeId) {
	//         $calculateGradeWiseJuteMdsQuantity = ($juteRateCalculate * $calculateGradeWiseJuteMdsQuantity);
	//         return $calculateGradeWiseJuteMdsQuantity;
	//     } else {
	//         echo 'False';
	//     }
	// }


	//Month Wise Jute Calculation Helper Check
	public function ajaxMonthlyJuteCalculationHelperCheck()
	{
		$date = date("Y-m-d", strtotime($this->input->post('date')));
		$true = $this->M_jute_entry->ajaxFindMonthlyJuteCalculationHelperCheck($date);
		if ($true) {
			echo $true->jch_id;
		} else {
			echo "no";
		}
	}

	//Jute Rate Check
	public function ajaxJuteRateCheck()
	{
		$date = date("Y-m-d H:i:s", strtotime($this->input->post('date')));
		$true = $this->M_jute_entry->ajaxFindJuteRateByDate($date);
		if ($true) {
			echo $true->jrs_id;
		} else {
			echo "no";
		}
	}

	// List Out Turn Report Form
	public function listMonthlyOutTurnReport()
	{
		$data = $this->engine->store_nav('entry', 'list_monthly_out_turn_report', 'Monthly Out Turn Report');
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
		$data['list'] = $this->M_jute_entry->getMonthlyJuteOutTurnSummary($m, $y);
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['jute_rates'] = $this->M_jute_rate->getJuteRate();
		$data['m'] = $m;
		$data['y'] = $y;
		$path = 'backend/jute/entry/list_out_turn_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// List Out Turn Report Form
	public function listOutTurnReport()
	{
		$data = $this->engine->store_nav('entry', 'list_out_turn_report', 'List Out Turn Report');
		$data['list'] = $this->M_jute_entry->getJuteOutTurnSummary();
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['jute_rates'] = $this->M_jute_rate->getJuteRate();
		$data['m'] = "";
		$path = 'backend/jute/entry/list_out_turn_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	// Edit Out Turn Report Form
	public function editOutTurnReport()
	{
		$data = $this->engine->store_nav('entry', 'edit_out_turn_report', 'Edit Out Turn Report');
		$ot_id = $this->input->get('ot_id');
		$data['list'] = $this->M_jute_entry->getJuteOutTurnSummary();
		$data['singleRowData'] = $this->Common->get_single_row_information('out_turn_summary', 'ot_id', $ot_id);
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['areas'] = $this->M_area->getArea();
		$data['jute_rates'] = $this->M_jute_rate->getJuteRate();
		$path = 'backend/jute/entry/edit_out_turn_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}





	// Add Contract Invoice Form
	public function addContractInvoice()
	{
		$data = $this->engine->store_nav('entry', 'add_invoice', 'Add Invoice');
		//resive data from modal form (list_out_turn_report.php)
		$bill_type = $this->input->post('bill_type');
		$jute_rate_summary_table_id = $this->input->post('jute_rate_summary_table_id');
		$contract_sl_no = $this->input->post('contract_sl_no');
		$ot_id = $this->input->post('ot_id');

		//get data from database
		//$data['invoice_s'] = $this->M_jute_entry->getInvoiceSummaryById($jpis_id);
		$outTurnReport = $this->M_jute_entry->getJuteOutTurnSummaryById($ot_id);
		$data['outTurnReport'] = $this->M_jute_entry->getJuteOutTurnSummaryById($ot_id);
		$data['grades'] = $this->M_grade->getJuteGrade();

		// Jute WH and KF hoila acceptable moistur ber korar jonno akta area id lagba ti
		$ot_en_mo_id = $outTurnReport->ot_en_mo_id;
		$en_area_id_by_mokam = $this->M_mokam->getAreaByMokamIs($ot_en_mo_id)->mo_ar_id;


		if (is_numeric($outTurnReport->ot_ar_id)) {
			$n_ar_id = $outTurnReport->ot_ar_id;
		} else {
			$n_ar_id = $en_area_id_by_mokam;
		}

		//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু যেটা ডাটাবেজ হতে  আসবে

		$jute_rate_moisture = $this->M_jute_entry->jute_rate_moisture($jute_rate_summary_table_id, $n_ar_id);

		$juteRateMoisture = 0;
		if ($outTurnReport->ot_jute_type == 'new') {
			$juteRateMoisture = $jute_rate_moisture->jr_m_new;
		} else {
			$juteRateMoisture = $jute_rate_moisture->jr_m_old;
		}
		//Moisture এক্সেপ্টেবল ভ্যালু
		$acceptableMoisture = $juteRateMoisture;

		$moistureVarification = $this->moistureVarification($outTurnReport->ot_moisture, $acceptableMoisture);
		//echo '<br>';
		//echo 'moistureVarification: ' . $moistureVarification;

		$data['bill_type'] = $bill_type;
		$data['jute_rate_summary_table_id'] = $jute_rate_summary_table_id;
		$data['contract_sl_no'] = $contract_sl_no;
		$data['acceptableMoisture'] = $acceptableMoisture;
		$data['ot_id'] = $ot_id;

		$path = 'backend/jute/entry/add_contract_invoice';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Contract Invoice Form data

	public function insertContractInvoice()
	{
		// $post = $this->input->post();
		// echo '<pre>';
		// print_r($post);
		$bill_type = $this->input->post('bill_type');
		$jute_rate_summary_table_id = $this->input->post('jute_rate_summary_table_id');
		if (empty($jute_rate_summary_table_id)) {
			$jute_rate_summary_table_id = 0;
		}
		$contract_sl_no = $this->input->post('contract_sl_no');
		if (empty($contract_sl_no)) {
			$contract_sl_no = 0;
		}
		$ot_id = $this->input->post('ot_id');
		$extra_moisture = $this->input->post('extra_moisture');
		$mds_after_moisture_deduction = $this->input->post('mds_after_moisture_deduction');
		$total_amount = $this->input->post('total_amount');

		$outTurnReport = $this->M_jute_entry->getJuteOutTurnSummaryById($ot_id);

		// echo '<pre>';
		// print_r($outTurnReport);

		//Get previous normal invoice id That created when add oute turn report
		$jute_purchase_invoice_summary_table_data = $this->M_jute_entry->getJutePurchaseInvoiceSummaryTableId($outTurnReport->ot_fy_id, $outTurnReport->ot_lot_no);
		// echo $jute_purchase_invoice_summary_table_data;
		// die();
		if (!empty($jute_purchase_invoice_summary_table_data)) {
			$jute_purchase_invoice_summary_table_id = $jute_purchase_invoice_summary_table_data->jpis_id;
			// echo $jute_purchase_invoice_summary_table_id;
			// die();
			$data = array(
				'jpis_status' => 0,
			);
			$this->M_jute_entry->updateJutePurchaseInvoiceSummaryTable($jute_purchase_invoice_summary_table_id, $data);
		}

		//update data on Out turn Summary Table
		$data = array(
			'ot_bill_type' => $bill_type,
		);
		$this->M_jute_entry->updateOtBillType($ot_id, $data);

		$formattedEntryDate = date("Y-m-d", strtotime($outTurnReport->ot_en_date));
		$juteCalculationHelperData = $this->M_godown->getJuteCalculationHelperByEntryDate($formattedEntryDate);

		/* ======= Update Invoice Serial Number -> Rimon ======= */
		// $getLastSerialData = array(
		// 	'jpis_ot_id' => $ot_id,
		// 	'jpis_status' => 1
		// );
		$jpis_iiiiiid = $this->M_jute_entry->getLastJutePurchaseInvoiceSerialNumber()->jpis_invoice_sl;
		$UpdateThisInvoiceSlNo = $jpis_iiiiiid + 1;
		/* ======= /. Update Invoice Serial Number -> Rimon ======= */

		//for insert data in jute_purchase_invoice_summary table
		$jutePurchaseInvoiceSummaryData = array(
			'jpis_invoice_sl' => $UpdateThisInvoiceSlNo,
			'jpis_fy_id' => $outTurnReport->ot_fy_id,
			'jpis_ot_lot_no' => $outTurnReport->ot_lot_no,
			'jpis_jrs_id' => $jute_rate_summary_table_id,
			'jpis_contract_sheet_no' => $contract_sl_no,
			'jpis_ot_id' => $outTurnReport->ot_id,
			'jpis_ot_en_s_id' => $outTurnReport->ot_en_s_id,
			'jpis_ot_en_chalan_no' => $outTurnReport->ot_en_chalan_no,
			'jpis_ot_en_mo_id' => $outTurnReport->ot_en_mo_id,
			'jpis_ot_en_date' => $outTurnReport->ot_en_date,
			'jpis_ot_rec_bojha' => $outTurnReport->ot_rec_bojha,
			'jpis_ot_kgs' => number_format($outTurnReport->ot_kgs, 3, '.', ''),
			'jpis_ot_mds' => number_format($outTurnReport->ot_mds, 3, '.', ''),
			'jpis_extra_moisture' => $extra_moisture,
			'jpis_ot_mds_after_deduction' => number_format($mds_after_moisture_deduction, 3, '.', ''),
			'jpis_total' => number_format($total_amount, 3, '.', ''),
			'jpis_discount' => 0,
			'jpis_grand_total' => number_format($total_amount, 3, '.', ''),
			'jpis_status' => 1,
			'jpis_bill_type' => $bill_type,
			'jpis_jch_id' => $juteCalculationHelperData->jch_id,
			'jpis_created_by' => $this->session->userdata('currentActiveId'),
			'jpis_created_at' => get_current_time(),
		);
		// echo 'jute_purchase_invoice_summary';
		// echo '<pre>';
		// print_r($jutePurchaseInvoiceSummaryData);

		$jpis_id = $this->M_jute_entry->insertJutePurchaseInvoiceSummaryData($jutePurchaseInvoiceSummaryData);

		// $jpis_id = 1;

		//for insert data in out_turn_percentage table
		$gradeId = $this->input->post('gradeId');
		$outTurnPer = $this->input->post('outTurnPer');
		//to work on for loop
		$outTurnCount = count($outTurnPer);
		$grade_wise_rate = $this->input->post('grade_wise_rate');
		$grade_wise_mds = $this->input->post('grade_wise_mds');
		$grade_wise_amount = $this->input->post('grade_wise_amount');
		$mds_wise_rate = $this->input->post('mds_wise_rate');





		// Start -> Rimon

		// কাটিং %, কাটিং রেট এবং ব্যাড প্রভিশন ড়ায়নামিকলি ক্যালকুলেশন		

		$mds = $outTurnReport->ot_mds;

		//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু যেটা ডাটাবেজ হতে  আসবে

		$jute_rate_moisture = $this->M_jute_entry->jute_rate_moisture($jute_rate_summary_table_id, $outTurnReport->ot_ar_id);

		if ($jute_rate_moisture) {
			if ($outTurnReport->ot_jute_type == 'new') {
				$juteRateMoisture = $jute_rate_moisture->jr_m_new;
			} else {
				$juteRateMoisture = $jute_rate_moisture->jr_m_old;
			}
		} else {
			$juteRateMoisture = 0;
		}
		//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু
		$acceptableMoisture = $juteRateMoisture;

		$moistureVarification = $this->moistureVarification($outTurnReport->ot_moisture, $acceptableMoisture);
		// echo '<br>';
		// echo 'moistu reVarification: ' . $moistureVarification;

		//Get juteRate
		$juteRate = $this->M_jute_entry->getJuteRateById($jute_rate_summary_table_id);


		$totalJuteCost = 0;
		for ($p = 0; $p < $outTurnCount; $p++) {
			$juteRate = $this->juteRateCalculate($jute_rate_summary_table_id, $outTurnReport->ot_ar_id, $gradeId[$p]);
			$totalJuteCost += $this->juteRate(
				$this->juteQuantity(
					$this->modCalculation(
						$moistureVarification,
						$mds
					),
					$outTurnPer[$p]
				),
				$juteRate
			);
		}


		for ($p = 0; $p < $outTurnCount; $p++) {
			if ($mds_wise_rate) {
				$juteRate = $mds_wise_rate;
			} else {
				$juteRate = $grade_wise_rate[$p];
			}






			// SMR এর % বেশি হলে রেট কমে যাবে তাই এই ক্যালকুলেশন করা
			if ($gradeId[$p] == '5') {
				$smr = $this->M_jute_entry->getSmrRate($outTurnPer[$p], $jute_rate_summary_table_id);
				//echo 'SMR:' . $juteRateCalculate;
				if ($smr == 0) {
					$smr = $this->juteRateCalculate($jute_rate_summary_table_id, $outTurnReport->ot_ar_id, $gradeId[$p]);
				}
				$juteRateCalculate = $smr;

				//exit();
			} else {
				$juteRateCalculate = $this->juteRateCalculate($jute_rate_summary_table_id, $outTurnReport->ot_ar_id, $gradeId[$p]);
				// echo 'rate:' . $juteRateCalculate;
				// exit();
			}

			// কাটিং %, কাটিং রেট এবং ব্যাড প্রভিশন ড়ায়নামিকলি ক্যালকুলেশন
			if ($gradeId[$p] == '1' or $gradeId[$p] == "2" or $gradeId[$p] == "3" or $gradeId[$p] == "4") {
				//---
				$jpiv_weight_mds = $grade_wise_mds[$p];
				$jpiv_after_cutting_mds = $jpiv_weight_mds - ($jpiv_weight_mds * $juteCalculationHelperData->jch_cutting_percentage / 100);
				$jpiv_cutting_mds = $jpiv_weight_mds * $juteCalculationHelperData->jch_cutting_percentage / 100;
				$jpiv_cutting_amount = $jpiv_cutting_mds * $juteCalculationHelperData->jch_cutting_rate;
				$jpiv_amount = $grade_wise_amount[$p];
				$jpiv_amount_with_bad_pro = $jpiv_amount + ($jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100);
				$jpiv_bad_pro_amount = $jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100;
			} else {
				$jpiv_after_cutting_mds = 0;
				$jpiv_cutting_mds = 0;
				$jpiv_cutting_amount = 0;
				$jpiv_amount = $grade_wise_amount[$p];
				$jpiv_amount_with_bad_pro = $jpiv_amount + ($jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100);
				$jpiv_bad_pro_amount = $jpiv_amount * $juteCalculationHelperData->jch_bad_provision_percentage / 100;
			}



			// End -> Rimon







			//for insert data in jute_purchase_invoice_value table
			$jutePurchaseInvoiceValueData = array(
				'jpiv_fy_id' => $outTurnReport->ot_fy_id,
				'jpiv_jpis_id' => $jpis_id,
				'jpiv_j_g_id' => $gradeId[$p],
				'jpiv_percentage' => $outTurnPer[$p],

				'jpiv_unit_price' => $grade_wise_rate[$p],
				// 'jpiv_unit_price' => $juteRateCalculate,
				// 'jpiv_weight_mds' => $this->juteQuantity(
				// 	$this->modCalculation(
				// 		$moistureVarification,
				// 		$mds
				// 	),
				// 	$outTurnPer[$p]
				// ),
				'jpiv_amount' => number_format($grade_wise_amount[$p], 3, '.', ''),
				// 'jpiv_amount' => $jpiv_amount = $this->juteRate(
				// 	$this->juteQuantity(
				// 		$this->modCalculation(
				// 			$moistureVarification,
				// 			$mds
				// 		),
				// 		$outTurnPer[$p]
				// 	),
				// 	$juteRateCalculate
				// ),

				'jpiv_weight_mds' => number_format($grade_wise_mds[$p], 3, '.', ''),

				'jpiv_jrs_id' => $jute_rate_summary_table_id,
				'jpiv_status' => 1,


				'jpiv_after_cutting_mds' => number_format($jpiv_after_cutting_mds, 3, '.', ''),
				'jpiv_cutting_mds' => number_format($jpiv_cutting_mds, 3, '.', ''),
				'jpiv_cutting_amount' => number_format($jpiv_cutting_amount, 3, '.', ''),
				'jpiv_amount_with_bad_pro' => number_format($jpiv_amount_with_bad_pro, 3, '.', ''),
				'jpiv_bad_pro_amount' => number_format($jpiv_bad_pro_amount, 3, '.', ''),
				'jpiv_amount_with_bad_pro_after_cutting_amount' => number_format($jpiv_amount_with_bad_pro - $jpiv_cutting_amount, 3, '.', ''),



				'jpiv_created_by' => $this->session->userdata('currentActiveId'),
				'jpiv_created_at' => get_current_time(),
			);
			//print_r($jutePurchaseInvoiceValueData);
			$this->M_jute_entry->insertJutePurchaseInvoiceValueData($jutePurchaseInvoiceValueData);
			// x_debug($jutePurchaseInvoiceValueData);
		}
		redirect('list_monthly_out_turn_report');
	}

	//Add Invoice view for Cutting and TW
	public function addInvoice()
	{
		$data = $this->engine->store_nav('entry', 'add_invoice', 'Add Invoice');
		//resive data from modal form (list_out_turn_report.php)
		//$bill_type = $this->input->post('bill_type');
		//$jute_rate_summary_table_id = $this->input->post('jute_rate_summary_table_id');
		//$contract_sl_no = $this->input->post('contract_sl_no');
		$ot_id = $this->input->get('ot_id');

		//get data from database
		//$data['invoice_s'] = $this->M_jute_entry->getInvoiceSummaryById($jpis_id);
		//$outTurnReport = $this->M_jute_entry->getJuteOutTurnSummaryById($ot_id);
		$data['outTurnReport'] = $this->M_jute_entry->getJuteOutTurnSummaryById($ot_id);
		$data['grades'] = $this->M_grade->getJuteGrade();

		//Moisture ভেলু যেটএক্সেপ্টেবল ভ্যালু যেটা ডাটাবেজ হতে  আসবে

		//$jute_rate_moisture = $this->M_jute_entry->jute_rate_moisture($jute_rate_summary_table_id, $outTurnReport->ot_ar_id);

		//$juteRateMoisture = 0;
		//if ($outTurnReport->ot_jute_type == 'new') {
		//$juteRateMoisture = $jute_rate_moisture->jr_m_new;
		//} else {
		//$juteRateMoisture = $jute_rate_moisture->jr_m_old;
		//}
		//Moisture এক্সেপ্টেবল ভ্যালু
		//$acceptableMoisture = $juteRateMoisture;

		//$moistureVarification = $this->moistureVarification($outTurnReport->ot_moisture, $acceptableMoisture);
		//echo '<br>';
		//echo 'moistureVarification: ' . $moistureVarification;

		//$data['bill_type'] = $bill_type;
		//$data['jute_rate_summary_table_id'] = $jute_rate_summary_table_id;
		//$data['contract_sl_no'] = $contract_sl_no;
		//$data['acceptableMoisture'] = $acceptableMoisture;
		$data['ot_id'] = $ot_id;

		$path = 'backend/jute/entry/add_invoice_others';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//List All Invoice
	public function listPurchase()
	{
		$data = $this->engine->store_nav('entry', 'list_purchase', 'List Purchase');
		$data['list'] = $this->M_jute_entry->getInvoiceSummary();
		$path = 'backend/jute/entry/list_purchase';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//List Coming Invoice
	public function listComingPurchase()
	{
		$data = $this->engine->store_nav('invoice_status', 'list_coming_purchase', 'List Coming Purchase');

		$userId = $this->session->userdata('currentActiveId');
		$purchaseInvoiceApproveInfoByUser = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_user_id' => $userId, 'iajp_status' => 1]);

		if ($purchaseInvoiceApproveInfoByUser) {
			if ($purchaseInvoiceApproveInfoByUser->iajp_approval_status > 1) {
				$previousNumber = (int)$purchaseInvoiceApproveInfoByUser->iajp_approval_status - 1;
				$data['list'] = $this->db->query("SELECT * FROM jute_purchase_invoice_summary WHERE jpis_id NOT IN (SELECT iar_invoice_id
				FROM invoice_approval_return WHERE iar_invoice_type = 1 AND iar_status = 1
			   ) AND jpis_user_serially_approval_status < $purchaseInvoiceApproveInfoByUser->iajp_approval_status AND jpis_user_serially_approval_status != $previousNumber AND jpis_approve_status = 0 AND jpis_status = 1");
			}
		}

		$path = 'backend/jute/entry/list_coming_purchase';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//List New Invoice
	public function listNewPurchase()
	{
		$data = $this->engine->store_nav('invoice_status', 'list_new_purchase', 'List New Purchase');

		$userId = $this->session->userdata('currentActiveId');
		$purchaseInvoiceApproveInfoByUser = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_user_id' => $userId, 'iajp_status' => 1]);
		if ($purchaseInvoiceApproveInfoByUser) {

			$serialMax = (int)$purchaseInvoiceApproveInfoByUser->iajp_approval_status - 1;

			$data['list'] = $this->db->query("SELECT * FROM jute_purchase_invoice_summary WHERE jpis_id NOT IN (SELECT iar_invoice_id
					  FROM invoice_approval_return WHERE  iar_invoice_type = 1 AND iar_status = 1
					 ) AND jpis_user_serially_approval_status = $serialMax AND jpis_approve_status = 0 AND jpis_status = 1");
		} else {

			$data['list'] = $this->db->query("SELECT * FROM jute_purchase_invoice_summary WHERE jpis_id NOT IN (SELECT iar_invoice_id
					  FROM invoice_approval_return WHERE  iar_invoice_type = 1 AND iar_status = 1
					 ) AND jpis_user_serially_approval_status = 0 AND jpis_approve_status = 0 AND jpis_status = 1");
		}

		$path = 'backend/jute/entry/list_new_purchase';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//List Processing Invoice
	public function listProcessingPurchase()
	{
		$data = $this->engine->store_nav('invoice_status', 'list_processing_purchase', 'List Processing Purchase');


		$userId = $this->session->userdata('currentActiveId');
		$purchaseInvoiceApproveInfoByUser = $this->Common->get_single_row_information_multi_conditional('invoice_approver_jute_purchase', ['iajp_user_id' => $userId, 'iajp_status' => 1]);

		if ($purchaseInvoiceApproveInfoByUser) {
			if ($purchaseInvoiceApproveInfoByUser->iajp_user_id == $userId) {
				$data['list'] = $this->Common->get_data_multi_conditional('jute_purchase_invoice_summary', ['jpis_user_serially_approval_status >= ' => $purchaseInvoiceApproveInfoByUser->iajp_approval_status, 'jpis_approve_status' => 0, 'jpis_status' => 1]);
			}
		} else {
			$data['list'] = $this->Common->get_data_multi_conditional('jute_purchase_invoice_summary', ['jpis_user_serially_approval_status > ' => 0, 'jpis_approve_status' => 0, 'jpis_status' => 1]);
		}
		$path = 'backend/jute/entry/list_processing_purchase';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//List Returned Invoice
	public function listReturnedPurchase()
	{
		$data = $this->engine->store_nav('invoice_status', 'list_returned_purchase', 'List Returned Purchase');
		$data['list'] = $this->db->query("SELECT * FROM jute_purchase_invoice_summary INNER JOIN invoice_approval_return ON iar_invoice_id = jpis_id  WHERE iar_invoice_type = 1 AND iar_status = 1 AND jpis_status = 1");
		$path = 'backend/jute/entry/list_returned_purchase';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//List Approved Invoice
	public function listApprovedPurchase()
	{
		$data = $this->engine->store_nav('invoice_status', 'list_approved_purchase', 'List Approved Purchase');
		$data['list'] = $this->Common->get_data_multi_conditional('jute_purchase_invoice_summary', ['jpis_approve_status' => 1, 'jpis_status' => 1]);
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/entry/list_approved_purchase';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// view Invoice view Form
	public function viewPurchaseInvoice()
	{
		$jpis_id = $this->input->get('jpis_id');
		$data = $this->engine->store_nav('entry', 'view_invoice', 'View invoice');
		$data['invoice_s'] = $this->M_jute_entry->getInvoiceSummaryById($jpis_id);
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/jute/entry/view_invoice';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function approveInvoice()
	{
		$jpis_id = $this->input->get('jpis_id');

		// approve status change - Rimon 04.10.22
		$iajp_approval_status = $this->input->get('iajp_approval_status');
		$user_id = $this->input->get('user_id');

		// Find Max Status 'invoice_approver_jute_purchase' table
		$getMaxStatus = $this->Common->get_single_row_information_multi_conditional_max_value('invoice_approver_jute_purchase', ['iajp_status' => 1], 'iajp_approval_status')->iajp_approval_status;
		// x_debug($getMaxStatus);



		$s_id = $this->M_jute_entry->getInvoiceSummaryById($jpis_id)->jpis_ot_en_s_id;
		$ot_id = $this->M_jute_entry->getInvoiceSummaryById($jpis_id)->jpis_ot_id;
		$jpis_grand_total = $this->M_jute_entry->getInvoiceSummaryById($jpis_id)->jpis_grand_total;
		$s_payable = $this->M_supplier->getSupplierById($s_id)->s_payable + $jpis_grand_total; //Added previous payable + new payable
		$s_due = $this->M_supplier->getSupplierById($s_id)->s_due + $jpis_grand_total; //Added previous due + new due
		// echo $s_id;
		// echo "<br>";
		// echo $s_payable;
		// echo "<br>";
		// echo $s_due;
		// echo "<br>";
		// echo $jpis_grand_total;
		// echo "<br>";
		// die();



		$approveData = array(
			'ias_invioce_id' => $jpis_id,
			'ias_user_id' => $user_id,
			'ias_approval_status' => $iajp_approval_status,
			'ias_invoice_type' => 1,
			'ias_status' => 1,
			'ias_created_at' => get_current_time(),
			'ias_created_by' => $this->session->userdata('currentActiveId'),
		);
		$this->Common->set_data('invoice_approval_status', $approveData);


		// Serial Wise User Approval Data Insert
		$data = array(
			'jpis_user_serially_approval_status' => $iajp_approval_status,
		);
		$this->M_jute_entry->approveInvoiceStatus($jpis_id, $data);



		// When last authority approve the invoice then status changed.
		if ($iajp_approval_status == $getMaxStatus) {

			//update data in jute_purchase_invoice_summary table
			$data = array(
				'jpis_approve_status' => 1,
				//'jpiv_jpis_id' => $invoiceSumaryId
			);
			$this->M_jute_entry->approveInvoiceStatus($jpis_id, $data);

			//update data in out_turn_summary table
			$approveData = array(
				'ot_jpis_approve_status' => 1,
				//'jpiv_jpis_id' => $invoiceSumaryId
			);
			$this->M_jute_entry->updateWithCondition($ot_id, $approveData);

			//update supplire account in  supplire table
			$accountUpdate = array(
				's_payable' => $s_payable,
				's_due' => $s_due
			);
			$this->M_supplier->updateSupplier($s_id, $accountUpdate);
		}




		redirect('list_new_purchase');
	}

	// If Invoice is something wrong user can return the invoice with reason
	public function insertJutePurchaseInvoiceApprovalReturn()
	{
		$iar_user_id = $this->input->post('iar_user_id');
		$iar_invoice_id = $this->input->post('iar_invoice_id');
		$iar_return_reason = $this->input->post('iar_return_reason');

		$ot_id = $this->M_jute_entry->getInvoiceSummaryById($iar_invoice_id)->jpis_ot_id;



		// If jute variety is 'Cutting' or 'TW', change bill type
		$outturnById = $this->Common->get_single_row_information_multi_conditional('out_turn_summary', ['ot_id' => $ot_id]);
		$entryById = $this->Common->get_single_row_information_multi_conditional('jute_entry', ['en_id' => $outturnById->ot_en_id]);


		if ($entryById->en_jute_variety == 'Cutting' || $entryById->en_jute_variety == 'TW') {
			$changeOutTurnBillType = array(
				'ot_bill_type' => 0,
				'ot_updated_at' => get_current_time(),
				'ot_updated_by' => $this->session->userdata('currentActiveId'),
			);
			$this->Common->update_data_multi_conditional('out_turn_summary', ['ot_id' => $ot_id], $changeOutTurnBillType);
		}


		// Invoiec Approve return
		$returnApprovalData = array(
			'iar_user_id' => $iar_user_id,
			'iar_invoice_id' => $iar_invoice_id,
			'iar_return_reason' => $iar_return_reason,
			'iar_invoice_type' => 1,
			'iar_status' => 1,
			'iar_created_at' => get_current_time(),
			'iar_created_by' => $this->session->userdata('currentActiveId'),
		);
		$this->Common->set_data('invoice_approval_return', $returnApprovalData);

		//update data in jute_purchase_invoice_summary table
		$data = array(
			'jpis_approve_status' => 0,
			'jpis_user_serially_approval_status' => 0,
		);
		$this->M_jute_entry->approveInvoiceStatus($iar_invoice_id, $data);

		//update data in out_turn_summary table
		$approveData = array(
			'ot_jpis_approve_status' => 0,
		);
		$this->M_jute_entry->updateWithCondition($ot_id, $approveData);

		// Update approval status data

		$data = array(
			'ias_status' => 0,
			'ias_updated_at' => get_current_time(),
			'ias_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->Common->update_data_multi_conditional('invoice_approval_status', ['ias_invioce_id' => $iar_invoice_id, 'ias_invoice_type' => 1], $data);

		redirect('list_returned_purchase');
	}

	// Jute purchase invoice return information
	public function getJutePurchaseInvoiceReturnInformation()
	{
		$invoice_id = $this->input->post('invoice_id');
		$invoice_type = $this->input->post('invoice_type');
		$jutePurchaseInvoiceReturnInformation = $this->Common->get_data_multi_conditional('invoice_approval_return', ['iar_invoice_id' => $invoice_id, 'iar_invoice_type' => $invoice_type, 'iar_status' => 1]);
		if ($jutePurchaseInvoiceReturnInformation) {
			$data['jutePurchaseInvoiceReturnInformation'] =  $jutePurchaseInvoiceReturnInformation->result();
		}
		echo json_encode($data);
	}







	// List supplier_report.php
	public function supplierReport()
	{
		$data = $this->engine->store_nav('entry', 'supplier_report', 'Supplier Report');
		$data['list'] = $this->M_supplier->getSupplier();
		$path = 'backend/jute/entry/supplier_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// AjaxCall For Suplier Party Chalan
	public function ajaxSuplierPartyChalan()
	{
		$supplierId = $this->input->post('supplierId');
		$en_fy_id = $this->input->post('en_fy_id');
		$conditions = array(
			'en_s_id' => $supplierId,
			'en_fy_id' => $en_fy_id,
			'en_status' => 1,
		);

		$suplierReport = $this->M_jute_entry->ajaxSuplierPartyChalan($conditions);

		if ($suplierReport) {
			$value = current($suplierReport->result())->en_chalan_no;
			$value = $value + 1;
		} else {
			$value = 1;
		}
		echo $value;
	}

	public function ajaxAreaByMokamId()
	{
		$mokamId = $this->input->post('mokamId');

		$conditions = array(
			'mo_id' => $mokamId,
			'mo_status' => 1
		);
		$areaId = $this->M_mokam->getMokamByConditions($conditions)->mo_ar_id;

		echo $areaId;
	}

	// AjaxCall For ajaxMillLotNoCheck from entry table
	public function ajaxMillLotNoCheckForEntry()
	{
		$millLotNo = $this->input->post('millLotNo');
		$en_fy_id = $this->input->post('en_fy_id');
		$conditions = array(
			'en_lot_no' => $millLotNo,
			'en_fy_id' => $en_fy_id,
			'en_status' => 1,
		);
		$valid = $this->M_jute_entry->ajaxMillLotNoCheckForEntry($conditions);
		echo $valid;
	}

	public function ajaxFinancialYear()
	{
		$enDate = date("Y-m-d", strtotime($this->input->post('enDate')));
		// $conditions = array(
		// 	'en_lot_no' => $millLotNo,
		// 	'en_fy_id' => $en_fy_id,
		// 	'en_status' => 1,
		// );
		$valid = $this->M_jute_entry->ajaxFinancialYear($enDate);
		//x_debug($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}

	public function ajaxLastLotNo()
	{

		$en_jute_variety = $this->input->post('en_jute_variety');
		$en_fy_id = $this->input->post('en_fy_id');

		$conditions = array(
			//'en_jute_variety' => $en_jute_variety,
			'en_fy_id' => $en_fy_id,
			'en_status' => 1
		);
		//x_debug($conditions);
		$lastLotNo = $this->M_jute_entry->getAjaxLastLotNo($conditions);


		//$suplierReport = $this->M_jute_entry->ajaxSuplierPartyChalan($conditions);

		if ($lastLotNo) {
			$value = current($lastLotNo->result())->en_lot_no;
			//$value = $value + 1;
		} else {
			$value = "Empty";
		}
		echo "Last Entered Lot No: " . $value;
	}


	//Murad 24.09.22 // List Out mismatch area
	public function listMismatchArea()
	{
		$data = $this->engine->store_nav('entry', 'list_mismatch_area', 'List Mismatch Area');
		$data['list'] = $this->M_jute_entry->getJuteOutTurnSummary();
		$data['grades'] = $this->M_grade->getJuteGrade();
		$data['jute_rates'] = $this->M_jute_rate->getJuteRate();
		$path = 'backend/jute/entry/list_mismatch_area';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//
	public function getJuteRateSheetByFyId()
	{
		$fy_id = $this->input->post('fy_id');
		$data['jute_rates'] = $this->M_jute_rate->getJuteRateSheetByFyIdForContractBill($fy_id);
		echo json_encode($data);
	}

	// Count all Gari NO by entry Info
	public function entryChalanCount()
	{
		$data = $this->engine->store_nav('entry', 'entryChalanCount', 'List Entry');

		$data['entrys'] = $this->M_jute_entry->getChalanJuteEntry();
		//x_debug($data['entrys']);
		$path = 'backend/jute/entry/entry_chalan_count';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	// bill delete after full Approve
	public function approvedBillReturn()
	{
		$iar_user_id = $this->input->post('iar_user_id');
		$iar_invoice_id = $this->input->post('iar_invoice_id');
		$iar_return_reason = $this->input->post('iar_return_reason');
		$jpis_grand_total = $this->input->post('jpis_grand_total');
		$jpis_ot_en_s_id = $this->input->post('jpis_ot_en_s_id');

		$ot_id = $this->M_jute_entry->getInvoiceSummaryById($iar_invoice_id)->jpis_ot_id;

		$supplierInfo = $this->Common->get_single_row_information_multi_conditional('supplier', ['s_id' => $jpis_ot_en_s_id]);
		$s_payable = $supplierInfo->s_payable;
		$n_s_payable = $s_payable - $jpis_grand_total;
		$s_due = $supplierInfo->s_due;
		$n_s_due = $s_due - $jpis_grand_total;

		$updateSupplierInfo = array(
			's_payable' => $n_s_payable,
			's_due' => $n_s_due,
			's_updated_at' => get_current_time(),
			's_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->Common->update_data_multi_conditional('supplier', ['s_id' => $jpis_ot_en_s_id], $updateSupplierInfo);



		// If jute variety is 'Cutting' or 'TW', change bill type
		$outturnById = $this->Common->get_single_row_information_multi_conditional('out_turn_summary', ['ot_id' => $ot_id]);
		$entryById = $this->Common->get_single_row_information_multi_conditional('jute_entry', ['en_id' => $outturnById->ot_en_id]);


		if ($entryById->en_jute_variety == 'Cutting' || $entryById->en_jute_variety == 'TW') {
			$changeOutTurnBillType = array(
				'ot_bill_type' => 0,
				'ot_updated_at' => get_current_time(),
				'ot_updated_by' => $this->session->userdata('currentActiveId'),
			);
			$this->Common->update_data_multi_conditional('out_turn_summary', ['ot_id' => $ot_id], $changeOutTurnBillType);
		}


		// Invoiec Approve return
		$returnApprovalData = array(
			'iar_user_id' => $iar_user_id,
			'iar_invoice_id' => $iar_invoice_id,
			'iar_return_reason' => $iar_return_reason,
			'iar_invoice_type' => 1,
			'iar_status' => 1,
			'iar_created_at' => get_current_time(),
			'iar_created_by' => $this->session->userdata('currentActiveId'),
		);
		$this->Common->set_data('invoice_approval_return', $returnApprovalData);

		//update data in jute_purchase_invoice_summary table
		$data = array(
			'jpis_approve_status' => 0,
			'jpis_user_serially_approval_status' => 0,
		);
		$this->M_jute_entry->approveInvoiceStatus($iar_invoice_id, $data);

		//update data in out_turn_summary table
		$approveData = array(
			'ot_jpis_approve_status' => 0,
		);
		$this->M_jute_entry->updateWithCondition($ot_id, $approveData);

		// Update approval status data

		$data = array(
			'ias_status' => 0,
			'ias_updated_at' => get_current_time(),
			'ias_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->Common->update_data_multi_conditional('invoice_approval_status', ['ias_invioce_id' => $iar_invoice_id, 'ias_invoice_type' => 1], $data);

		redirect('list_returned_purchase');
	}


	//
	// Delete out Turn report 
	public function deleteOutTurn()
	{
		$ot_id = $this->input->get('ot_id');
		$ot_en_id = $this->input->get('ot_en_id');

		$deleteOutTurn = array(
			'ot_status' => 0,  //0 = done and 1 = not done
			'ot_updated_at' => get_current_time(),
			'ot_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_jute_entry->updateWithCondition($ot_id, $deleteOutTurn);

		$out_turn_percentage = array(
			'otp_status' => 0,
		);
		$this->Common->update_data_multi_conditional('out_turn_percentage', ['otp_ot_id' => $ot_id], $out_turn_percentage);

		$jute_purchase_invoice_summary = array(
			'jpis_status' => 0,
		);
		$this->Common->update_data_multi_conditional('jute_purchase_invoice_summary', ['jpis_ot_id' => $ot_id], $jute_purchase_invoice_summary);

		$data = array(
			'en_out_turn_status' => 1,  //0 = done and 1 = not done
			'en_updated_at' => get_current_time(),
			'en_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_jute_entry->updateJuteEntryTable($ot_en_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Deleted succesfully', '');
		redirect('list_out_turn_report');
	}
}
