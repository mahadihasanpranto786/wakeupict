<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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

		$this->load->model('M_supplier');
		$this->load->model('M_purchase');
		$this->load->model('M_bank');
		$this->load->model('M_financial_year');
		$this->load->model('M_grade');
		$this->load->model('M_jute_report');
	}

	//Add form for Supplier Type
	public function supplierType()
	{
		$data = $this->engine->store_nav('supplier', 'supplier_type', 'Supplier Type');
		$data['list'] = $this->M_supplier->getSupplierType();
		$path = 'backend/setup/supplier/supplier_type';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Insert Data in suplier_type table
	public function insertSupplierType()
	{
		$sup_t_title = $this->input->post('sup_t_title');
		$sup_t_description = $this->input->post('sup_t_description');
		$data = array(
			// 'sup_t_id' => $sup_t_id,
			'sup_t_title' => $sup_t_title,
			'sup_t_description' => $sup_t_description,
			'sup_t_status' => 1,
			'sup_t_created_at' => get_current_time(),
			'sup_t_created_by' => $this->session->userdata('currentActiveId'),
		);

		$id = $this->M_supplier->insertSupplierType($data);
		if ($id) {
			set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
		} else {
			set_confirmation_msg('False', '', 'Some thing worng happend.');
		}

		redirect('supplier_type');
	}

	// edit From view for SupplierType
	public function editSupplierTypeByJason()
	{
		$sup_t_id = $this->input->get('id');
		$data['supplier_type'] = $this->M_supplier->getSupplierTypeById($sup_t_id);
		echo json_encode($data);
	}

	// Update Data in supplier_type table
	public function updateSupplierType()
	{
		$sup_t_id = $this->input->post('sup_t_id');
		$sup_t_title = $this->input->post('sup_t_title');
		$sup_t_description = $this->input->post('sup_t_description');
		$data = array(
			'sup_t_id' => $sup_t_id,
			'sup_t_title' => $sup_t_title,
			'sup_t_description' => $sup_t_description,
			'sup_t_status' => 1,
			'sup_t_updated_at' => get_current_time(),
			'sup_t_updated_by' => $this->session->userdata('currentActiveId'),
		);

		$this->M_supplier->updateSupplierType($sup_t_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Updated succesfully', '');
		redirect('supplier_type');
	}

	// Delete Data in supplier_type table
	public function deleteSupplierType()
	{
		$sup_t_id = $this->input->get('sup_t_id');
		$data = array(
			'sup_t_status' => 0,
			'sup_t_updated_at' => get_current_time(),
			'sup_t_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->updateSupplierType($sup_t_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Deleted succesfully', '');
		redirect('supplier_type');
	}
	//permanently Delete
	public function permanentlyDeleteSupplierType()
	{
		$sup_t_id = $this->input->get('sup_t_id');
		$this->Common->delete_data('supplier_type', 'sup_t_id', $sup_t_id);
		redirect('supplier_type');
	}

	// inactive Data in supplier_type table
	public function inactiveSupplierType()
	{
		$sup_t_id = $this->input->get('sup_t_id');
		$data = array(
			'sup_t_status' => 0,
			'sup_t_updated_at' => get_current_time(),
			'sup_t_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->updateSupplierType($sup_t_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Inactive succesfully', '');
		redirect('supplier_type');
	}

	/* ======================== Supplier ====================== */
	//Add form for Supplier
	public function addSupplier()
	{
		$data = $this->engine->store_nav('supplier', 'add_supplier', 'Add Supplier');
		$data['supplier_type'] = $this->M_supplier->getSupplierType();
		$data['banks'] = $this->M_bank->getBank();
		$path = 'backend/setup/supplier/add_supplier';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	//Ajax get branch by bank 
	function getBankBranch()
	{
		$branch_id = $this->input->post("branch_id");
		$ab_brance = $this->input->post("ab_brance");
		if ($branch_id) {
			echo $this->M_bank->getBankBranchForDropdown($branch_id, $ab_brance);
		}
	}

	// Insert Data in Suplier table
	public function insertSupplier()
	{
		$s_title = $this->input->post('s_title');
		$s_sup_t_id = $this->input->post('s_sup_t_id');
		$s_email = $this->input->post('s_email');
		//$s_password = $this->input->post('s_password');
		$s_address = $this->input->post('s_address');
		$s_phone = $this->input->post('s_phone');
		$s_licence_no = $this->input->post('s_licence_no');
		$s_b_id = $this->input->post('s_b_id');
		$s_bb_id = $this->input->post('s_bb_id');
		$s_ac_name = $this->input->post('s_ac_name');
		$s_ac_number = $this->input->post('s_ac_number');
		$s_initial_due_balance = $this->input->post('s_initial_due_balance');

		$config = array(
			'file_name' => $_FILES['s_img']['name'],
			'upload_path' => "./assets/uploads/supplier/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => false,
			'max_size' => "204800000", // can be set to particular fil
			'max_height' => "4000",
			'max_width' => "6000",
		);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('s_img')) {
			$path = $this->upload->data();
			$s_img = "assets/uploads/supplier/" . $path['file_name'];

			$data = array(
				's_title' => $s_title,
				's_sup_t_id' => $s_sup_t_id,
				's_email' => $s_email,
				//random generate korba
				's_password' => 12345,
				's_address' => $s_address,
				's_phone' => $s_phone,
				's_licence_no' => $s_licence_no,
				's_b_id' => $s_b_id,
				's_bb_id' => $s_bb_id,
				's_ac_name' => $s_ac_name,
				's_ac_number' => $s_ac_number,
				's_initial_due_balance' => $s_initial_due_balance,
				's_payable' => $s_initial_due_balance,
				's_due' => $s_initial_due_balance,
				's_img' => $s_img,
				's_status' => 1,
				's_created_at' => get_current_time(),
				's_created_by' => $this->session->userdata('currentActiveId'),
			);
		} else {
			$data = array(
				's_title' => $s_title,
				's_sup_t_id' => $s_sup_t_id,
				's_email' => $s_email,
				's_password' => 12345,
				's_address' => $s_address,
				's_phone' => $s_phone,
				's_licence_no' => $s_licence_no,
				's_b_id' => $s_b_id,
				's_bb_id' => $s_bb_id,
				's_ac_name' => $s_ac_name,
				's_ac_number' => $s_ac_number,
				's_initial_due_balance' => $s_initial_due_balance,
				's_payable' => $s_initial_due_balance,
				's_due' => $s_initial_due_balance,
				's_status' => 1,
				's_created_at' => get_current_time(),
				's_created_by' => $this->session->userdata('currentActiveId'),
			);
		}
		$id = $this->M_supplier->insertSupplier($data);
		if ($id) {
			set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
		} else {
			set_confirmation_msg('False', '', 'Some thing worng happend.');
		}
		// echo "<pre>";
		// print_r($data);
		redirect('jute_supplier_report');
	}

	//Supplier List
	public function listSupplier()
	{
		$data = $this->engine->store_nav('supplier', 'list_supplier', 'Supplier List');
		$data['list'] = $this->M_supplier->getSupplier();
		$data['supplier_type'] = $this->M_supplier->getSupplierType();
		$data['banks'] = $this->M_bank->getBank();
		$path = 'backend/setup/supplier/list_supplier';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Delete Data in supplier table
	public function deleteSupplier()
	{
		$s_id = $this->input->get('s_id');
		$data = array(
			's_status' => 0,
			's_updated_at' => get_current_time(),
			's_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->updateSupplier($s_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Deleted succesfully', '');
		redirect('list_supplier');
	}
	//Permanently Delete
	public function permanentlyDeleteSupplier()
	{
		$s_id = $this->input->get('s_id');
		$this->Common->delete_data('supplier', 's_id', $s_id);
		redirect('list_supplier');
	}

	// inactive Data in supplier table
	public function inactiveSupplier()
	{
		$s_id = $this->input->get('s_id');
		$data = array(
			's_status' => 0,
			's_updated_at' => get_current_time(),
			's_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->updateSupplier($s_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Inactive succesfully', '');
		redirect('jute_supplier_report');
	}
	// Update Supplier
	public function updateSupplier()
	{
		$s_id = $this->input->post('s_id');
		$s_title = $this->input->post('s_title');
		$s_sup_t_id = $this->input->post('s_sup_t_id');
		$s_email = $this->input->post('s_email');
		$s_address = $this->input->post('s_address');
		$s_phone = $this->input->post('s_phone');
		$s_licence_no = $this->input->post('s_licence_no');
		$s_b_id = $this->input->post('s_b_id');
		$s_bb_id = $this->input->post('s_bb_id');
		$s_ac_name = $this->input->post('s_ac_name');
		$s_ac_number = $this->input->post('s_ac_number');
		// $s_initial_due_balance = $this->input->post('s_initial_due_balance');
		// $s_img = $this->input->post('s_img');

		$config = array(
			'file_name' => $_FILES['s_img']['name'],
			'upload_path' => "./assets/uploads/supplier/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => false,
			'max_size' => "204800000", // can be set to particular fil
			'max_height' => "4000",
			'max_width' => "6000",
		);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('s_img')) {
			$path = $this->upload->data();
			$s_img = "assets/uploads/supplier/" . $path['file_name'];

			$data = array(
				's_title' => $s_title,
				's_sup_t_id' => $s_sup_t_id,
				's_email' => $s_email,
				's_password' => 12345,
				's_address' => $s_address,
				's_phone' => $s_phone,
				's_licence_no' => $s_licence_no,
				's_b_id' => $s_b_id,
				's_bb_id' => $s_bb_id,
				's_ac_name' => $s_ac_name,
				's_ac_number' => $s_ac_number,
				// 's_initial_due_balance' => $s_initial_due_balance,
				// 's_payable' => $s_initial_due_balance,
				// 's_due' => $s_initial_due_balance,
				's_img' => $s_img,
				's_updated_at' => get_current_time(),
				's_updated_by' => $this->session->userdata('currentActiveId'),
			);
		} else {
			$data = array(
				's_title' => $s_title,
				's_sup_t_id' => $s_sup_t_id,
				's_email' => $s_email,
				's_password' => 12345,
				's_address' => $s_address,
				's_phone' => $s_phone,
				's_licence_no' => $s_licence_no,
				's_b_id' => $s_b_id,
				's_bb_id' => $s_bb_id,
				's_ac_name' => $s_ac_name,
				's_ac_number' => $s_ac_number,
				// 's_initial_due_balance' => $s_initial_due_balance,
				// 's_payable' => $s_initial_due_balance,
				// 's_due' => $s_initial_due_balance,
				's_updated_at' => get_current_time(),
				's_updated_by' => $this->session->userdata('currentActiveId'),
			);
		}
		$this->M_supplier->updateSupplier($s_id, $data);
		set_confirmation_msg('TRUE', 'Your Data has beed Updated succesfully', '');
		redirect('jute_supplier_report');
		// echo "<pre>";
		// print_r($data);
	}

	/* =============================== Jute Supplier Payment ============================== */

	//all supplier list and payment
	public function juteSupplierReport()
	{
		$data = $this->engine->store_nav('supplier', 'jute_supplier_report', 'Jute Supplier Report');
		$sup_t_id = 1;  //Jute Supplier
		$data['list'] = $this->M_supplier->getSupplierbySupplierType($sup_t_id);
		$data['supplier_type'] = $this->M_supplier->getSupplierType();
		$data['banks'] = $this->M_bank->getBank();
		$path = 'backend/setup/supplier/jute_supplier_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// Supplier Analysis
	public function juteSupplierAnalysis()
	{
		$data = $this->engine->store_nav('supplier', 'jute_supplier_analysis', 'Jute Supplier Analysis');
		$s_id = $this->input->get('s_id');
		$data['supplierById'] = $this->M_supplier->getSupplierById($s_id);
		$data['grades'] = $this->M_grade->getJuteGrade();
		$path = 'backend/setup/supplier/jute_supplier_analysis';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//add payment
	public function insertSupplierPayment()
	{
		$sp_id = $this->input->post('sp_id');
		$sp_s_id = $this->input->post('sp_s_id');
		$sp_reference = $this->input->post('sp_reference');
		$sp_amount = $this->input->post('sp_amount');
		$sp_paid_by = $this->input->post('sp_paid_by');
		$sp_cheque_no = $this->input->post('sp_cheque_no');
		$sp_note = $this->input->post('sp_note');
		$sp_date = $this->input->post('sp_date');
		$sp_date = date("Y-m-d", strtotime($sp_date));
		$sp_fy_id = $this->input->post('sp_fy_id');

		$data = array(
			'sp_id' => $sp_id,
			'sp_s_id' => $sp_s_id,
			'sp_reference' => $sp_reference,
			'sp_amount' => $sp_amount,
			'sp_paid_by' => $sp_paid_by,
			'sp_cheque_no' => $sp_cheque_no,
			'sp_date' => $sp_date,
			'sp_fy_id' => $sp_fy_id,
			'sp_note' => $sp_note,
			'sp_status' => 1,
			'sp_created_at' => get_current_time(),
			'sp_created_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->insertSupplierPayment($data);

		//update payment in supplier table
		$s_paid = $this->M_supplier->getSupplierById($sp_s_id)->s_paid + $sp_amount; //Added previous payment + new payment
		$s_due = $this->M_supplier->getSupplierById($sp_s_id)->s_due - $sp_amount; //Added previous due - new payment

		$accountUpdate = array(
			's_paid' => $s_paid,
			's_due' => $s_due
		);
		$this->M_supplier->updateSupplier($sp_s_id, $accountUpdate); //update supplier table

		//redirect('jute_supplier_report');
		redirect('/setup/Supplier/juteSupplierLedger?s_id=' . $sp_s_id);
	}

	// Multi Supplier Payment Add View 
	public function addMultiPayment()
	{
		// $data = $this->engine->store_nav('supplier', 'add_supplier', 'Add Supplier');
		// $data['suppliers'] = $this->M_supplier->getSupplier();
		// $data['supplier_type'] = $this->M_supplier->getSupplierType();
		// $data['banks'] = $this->M_bank->getBank();
		// $path = 'backend/setup/supplier/add_multi_supplier_payment';
		// $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
		$data = $this->engine->store_nav('supplier', 'add_multi_payment', 'Add Multi Supplier Payment');
		$data['khamals'] = $this->M_khamal->getKhamal();
		$data['jute_grades'] = $this->M_grade->getJuteGrade();
		$data['suppliers'] = $this->M_supplier->getSupplier();
		$path = 'backend/setup/supplier/add_multi_supplier_payment';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Multi Supplier Payment Add View 
	public function clone_data()
	{
		$data['rowCount'] = $this->input->post('rowCount');
		$data['suppliers'] = $this->M_supplier->getSupplier();
		$path = 'backend/setup/supplier/clone_data';
		$this->load->view($path, $data);
	}

	// Multi Supplier Payment Add View 
	public function get_supplier_id_json()
	{
		$supplier_id = $this->input->post('supplier_id');
		$supplierInfo = $this->M_supplier->getSupplierById($supplier_id);
		$bankInfo = $this->M_bank->getBankById($supplierInfo->s_b_id);
		$branchInfo = $this->M_bank->getBankBranchById($supplierInfo->s_bb_id);
		// $this->load->view($path, $data);
		echo json_encode(array($supplierInfo, $bankInfo, $branchInfo));
	}

	//Insert Multi payment
	public function insertMultiSupplierPayment()
	{
		// $sp_id = $this->input->post();
		// x_debug($sp_id);

		$sp_s_id = $this->input->post('sp_s_id');
		$sp_reference = $this->input->post('sp_reference');
		$sp_amount = $this->input->post('sp_amount');
		$sp_paid_by = $this->input->post('sp_paid_by');
		//$sp_cheque_no = $this->input->post('sp_cheque_no');
		//$sp_cheque_no = '01';
		//$sp_note = 'ff';
		$sp_date = $this->input->post('sp_date');
		$sp_date = date("Y-m-d", strtotime($sp_date));
		$sp_fy_id = $this->input->post('sp_fy_id');

		for ($i = 0; $i < count($sp_s_id); $i++) {
			$data = array(
				'sp_s_id' => $sp_s_id[$i],
				'sp_reference' => $sp_reference[$i],
				'sp_amount' => str_replace(',', '', $sp_amount[$i]),
				'sp_paid_by' => $sp_paid_by[$i],
				//'sp_cheque_no' => $sp_cheque_no[$i],
				'sp_date' => $sp_date,
				'sp_fy_id' => $sp_fy_id,
				//'sp_note' => $sp_note[$i],
				'sp_status' => 1,
				'sp_created_at' => get_current_time(),
				'sp_created_by' => $this->session->userdata('currentActiveId'),
			);
			$this->M_supplier->insertSupplierPayment($data);

			//update payment in supplier table
			$s_paid = $this->M_supplier->getSupplierById($sp_s_id[$i])->s_paid + str_replace(',', '', $sp_amount[$i]); //Added previous payment + new payment
			$s_due = $this->M_supplier->getSupplierById($sp_s_id[$i])->s_due - str_replace(',', '', $sp_amount[$i]); //Added previous due - new payment

			$accountUpdate = array(
				's_paid' => $s_paid,
				's_due' => $s_due
			);
			$this->M_supplier->updateSupplier($sp_s_id[$i], $accountUpdate); //update supplier table
		}
		redirect('daily_payment_report');
		//redirect('/setup/Supplier/juteSupplierLedger?s_id=' . $sp_s_id);
	}

	//View jute_supplier_daily_payment_list
	public function dailyPaymentReport()
	{
		$data = $this->engine->store_nav('supplier', 'daily_payment_report', 'Jute Supplier Payment Report');

		$s_id = $this->input->get('s_id');

		$data['sPurchases'] = $this->M_purchase->getPurchaseSummaryBySupplierId($s_id);
		$data['sPayments'] = $this->M_supplier->getSupplierPaymentGrandTotal();
		// x_debug($data['sPayments']->result());
		$allPayments = $this->M_supplier->getSupplierPayment();
		$data['supplierById'] = $this->M_supplier->getSupplierById($s_id);


		//$dattt[] = array_unique($data['allPayments']);
		//x_debug($dattt[]);
		// $data['supplier_id'] = $s_id;
		// $data['list'] = $this->M_supplier->getSupplierPayment();
		// $data['list'] = $this->M_supplier->getSupplier();
		// $data['sPayments'] = $this->M_supplier->getSupplierPaymentBySupplierId($s_id);

		// $data['spView'] = $this->M_supplier->getSupplierPaymentById($sp_id);
		$path = 'backend/setup/supplier/jute_supplier_daily_payment_report';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//View Supplier Payment
	public function juteSupplierPaymentByDate()
	{
		$data = $this->engine->store_nav('supplier', 'daily_payment_report', 'Payment by Date');
		$sp_date = $this->input->get('date');
		$data['sPayments'] = $this->M_supplier->juteSupplierPaymentByDate($sp_date);
		$data['sp_date'] = $sp_date;
		$path = 'backend/setup/supplier/jute_supplier_payment_by_date';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//All Payment
	public function listAllPayment()
	{
		$data = $this->engine->store_nav('supplier', 'jute_supplier_report', 'listAllPayment');
		$s_id = $this->input->get('s_id');
		$data['list'] = $this->M_supplier->getSupplierPayment();
		// $data['list'] = $this->M_supplier->getSupplier();
		$data['supplierById'] = $this->M_supplier->getSupplierById($s_id);
		$path = 'backend/setup/supplier/list_all_payment';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//View Supplier Payment
	public function viewSupplierWisePayment()
	{
		$data = $this->engine->store_nav('supplier', 'view_supplier_payment', 'viewSupplierWisePayment');
		$s_id = $this->input->get('s_id');
		$sp_id = $this->input->get('sp_id');
		$data['supplier_id'] = $s_id;
		$data['list'] = $this->M_supplier->getSupplierPayment();
		$data['list'] = $this->M_supplier->getSupplier();
		$data['sPayments'] = $this->M_supplier->getSupplierPaymentBySupplierId($s_id);
		$data['supplierById'] = $this->M_supplier->getSupplierById($s_id);
		$data['spView'] = $this->M_supplier->getSupplierPaymentById($sp_id);
		$path = 'backend/setup/supplier/jute_supplier_wise_payment';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	//Update Supplier Payment
	public function updateSupplierPayment()
	{
		$sp_s_id = $this->input->post('sp_s_id');
		$previous_amount = $this->input->post('previous_amount');
		$sp_id = $this->input->post('sp_id');
		$sp_reference = $this->input->post('sp_reference');
		$sp_amount = $this->input->post('sp_amount');
		$sp_paid_by = $this->input->post('sp_paid_by');
		$sp_cheque_no = $this->input->post('sp_cheque_no');
		$sp_note = $this->input->post('sp_note');
		$sp_date = $this->input->post('sp_date');
		$sp_date = date("Y-m-d", strtotime($sp_date));
		$sp_fy_id = $this->input->post('sp_fy_id');

		$data = array(
			'sp_id' => $sp_id,
			'sp_reference' => $sp_reference,
			'sp_amount' => $sp_amount,
			'sp_paid_by' => $sp_paid_by,
			'sp_cheque_no' => $sp_cheque_no,
			'sp_date' => $sp_date,
			'sp_fy_id' => $sp_fy_id,
			'sp_note' => $sp_note,
			'sp_updated_at' => get_current_time(),
			'sp_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->updateSupplierPayment($sp_id, $data);
		$pre_paid = $this->M_supplier->getSupplierById($sp_s_id)->s_paid - $previous_amount; //previous payment - new payment
		$pre_due = $this->M_supplier->getSupplierById($sp_s_id)->s_due + $previous_amount; //previous due + new payment
		$x = $pre_paid + $sp_amount;
		$y = $pre_due - $sp_amount;

		$accountUpdate = array(
			's_paid' => $x,
			's_due' => $y
		);
		$this->M_supplier->updateSupplier($sp_s_id, $accountUpdate); //update supplier table
		redirect("view_supplier_wise_payment?s_id=$sp_s_id");
	}

	//Delete Supplier Payment
	public function deleteSupplierPayment()
	{
		$sp_id = $this->input->get('sp_id');
		$sp_s_id = $this->input->get('sp_s_id');

		$paymentAmountById = $this->Common->get_single_row_information('supplier_payment', 'sp_id', $sp_id);

		$pre_paid = $this->M_supplier->getSupplierById($sp_s_id)->s_paid; //previous payment - new payment
		$pre_due = $this->M_supplier->getSupplierById($sp_s_id)->s_due; //previous due + new payment

		$x = $pre_paid - $paymentAmountById->sp_amount;
		$y = $pre_due + $paymentAmountById->sp_amount;

		$accountUpdate = array(
			's_paid' => $x,
			's_due' => $y
		);
		$this->M_supplier->updateSupplier($sp_s_id, $accountUpdate); //update supplier table

		$data = array(
			'sp_id' => $sp_id,
			'sp_status' => 0,
			'sp_updated_at' => get_current_time(),
			'sp_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->updateSupplierPayment($sp_id, $data);

		redirect("view_supplier_wise_payment?s_id=$sp_s_id");
	}

	//View jute_supplier_ledger
	public function juteSupplierLedger()
	{
		$data = $this->engine->store_nav('supplier', 'view_supplier_payment', 'Jute Supplier Report');

		$s_id = $this->input->get('s_id');

		$data['sPurchases'] = $this->M_purchase->getPurchaseSummaryBySupplierId($s_id);
		$data['sPayments'] = $this->M_supplier->getSupplierPaymentBySupplierId($s_id);
		$data['supplierById'] = $this->M_supplier->getSupplierById($s_id);

		// $data['supplier_id'] = $s_id;
		// $data['list'] = $this->M_supplier->getSupplierPayment();
		// $data['list'] = $this->M_supplier->getSupplier();
		// $data['sPayments'] = $this->M_supplier->getSupplierPaymentBySupplierId($s_id);

		// $data['spView'] = $this->M_supplier->getSupplierPaymentById($sp_id);
		$path = 'backend/setup/supplier/jute_supplier_ledger';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function juteSupplierPaymentCalculator()
	{
		$data = $this->engine->store_nav('supplier', 'jute_supplier_approx_payment_calculator', 'Approx Payment Calculator');
		$sup_t_id = 1;  //Jute Supplier
		$data['list'] = $this->M_supplier->getSupplierbySupplierType($sup_t_id);

		$data['counts'] = $this->db->count_all_results('supplier');

		$data['query'] = $this->M_supplier->getTotalDueBalance();

		$data['dueSupplierQuantity'] = $this->M_supplier->getDueSupplierQuantity();
		// x_debug($data['dueSupplierQuantity']);

		$abc = $this->input->post('distribute_percentage');
		// x_debug($mm);

		if ($abc == "") {
			$data['dPercentage'] = 0;
		} else {
			$data['dPercentage'] = $abc;
		}


		$Amount = $this->input->post('distribute_amount');
		// x_debug($Amount);
		$data['dAmount'] = $Amount;

		$path = 'backend/setup/supplier/jute_supplier_approx_payment_calculator';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}




	//Insert Approx Due payment 
	public function insertApproxSupplierPayment()
	{

		$sp_id = $this->input->post('sp_id');
		$sp_s_id = $this->input->post('sp_s_id');
		$sp_reference = $this->input->post('sp_reference');
		$sp_amount = $this->input->post('sp_amount');
		$sp_paid_by = $this->input->post('sp_paid_by');
		$sp_cheque_no = $this->input->post('sp_cheque_no');
		$sp_note = $this->input->post('sp_note');
		$sp_date = $this->input->post('sp_date');
		$sp_date = date("Y-m-d", strtotime($sp_date));
		$sp_fy_id = $this->input->post('sp_fy_id');

		$data = array(
			'sp_id' => $sp_id,
			'sp_s_id' => $sp_s_id,
			'sp_reference' => $sp_reference,
			'sp_amount' => $sp_amount,
			'sp_paid_by' => $sp_paid_by,
			'sp_cheque_no' => $sp_cheque_no,
			'sp_date' => $sp_date,
			'sp_fy_id' => $sp_fy_id,
			'sp_note' => $sp_note,
			'sp_status' => 1,
			'sp_created_at' => get_current_time(),
			'sp_created_by' => $this->session->userdata('currentActiveId'),
		);
		$this->M_supplier->insertSupplierPayment($data);

		//update payment in supplier table
		$s_paid = $this->M_supplier->getSupplierById($sp_s_id)->s_paid + $sp_amount; //Added previous payment + new payment
		$s_due = $this->M_supplier->getSupplierById($sp_s_id)->s_due - $sp_amount; //Added previous due - new payment

		$accountUpdate = array(
			's_paid' => $s_paid,
			's_due' => $s_due
		);
		$this->M_supplier->updateSupplier($sp_s_id, $accountUpdate); //update supplier table

		redirect('list_approx_supplier_payment');
	}


	// Financial year
	public function ajaxFinancialYearForSupplierPayment()
	{
		$date = date("Y-m-d", strtotime($this->input->post('sp_date')));
		$valid = $this->M_khamal->ajaxFinancialYear($date);
		// print_r($valid);
		if ($valid) {
			echo $valid->fy_id;
		} else {
			echo "no";
		}
	}







	//End of controller
}
