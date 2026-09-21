<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_control extends CI_Controller
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

		$this->load->model('M_user_control');
	}
	public function addNewUser()
	{
		$data = $this->engine->store_nav('user_control', 'add_new_user', 'Create New User');
		$where = "a_status = '1' OR a_status = '2'";
		$data['authority_list'] = $this->M_user_control->get_data_multi_conditional('authority', $where)->result();
		$data['authority_list_with_distinct'] = $this->M_user_control->get_data_multi_conditional_distinct('authority', ['a_status' => 1], 'a_type')->result();
		$path = 'backend/setup/user_control/add_new_user';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}


	// Insert User
	public function insertUser()
	{
		$a_name = $this->input->post('a_name');
		$a_type = $this->input->post('a_type');
		$a_email = $this->input->post('a_email');
		$a_address = $this->input->post('a_address');
		$a_mobile = $this->input->post('a_mobile');
		$a_key = $this->input->post('a_key');
		$a_img = $this->engine->image_upload_mod('a_img', './assets/uploads/users/', '');

		if ($a_img) {
			$a_img = $a_img;
		} else {
			$a_img = 'user_dummy.jpg';
		}


		if (strlen($a_mobile) == 11 && (strlen($a_key) >= 1 && strlen($a_key) <= 6)) {
			$data = array(
				'a_name' => $a_name,
				'a_email' => $a_email,
				'a_address' => $a_address,
				'a_img' => $a_img,
				'a_key' => md5($a_key),
				'a_password' => $a_key,
				'a_credential' => $a_mobile,
				'a_type' => $a_type,
				'a_status' => 1,
				'a_created_at' => get_current_time(),
				'a_created_by' => $this->session->userdata('currentActiveId'),
			);
			$authorityCredential = $this->M_user_control->get_data_multi_conditional_where_in('authority', ['a_credential' => $a_mobile], 'a_status', '1,2')->row();


			if (!empty($authorityCredential)) {
				set_confirmation_msg('TRUE', 'This mobile number already in use. Please enter another number.', '');
			} elseif ($a_email) {
				$checkEmail = $this->M_user_control->get_data_multi_conditional_where_in('authority', ['a_email' => $a_email], 'a_status', '1,2')->row();
				if ($checkEmail) {
					set_confirmation_msg($checkEmail, 'This email address already in use. Please enter another email.', '');
				} else {
					$id = $this->M_user_control->insertData('authority', $data);
					set_confirmation_msg($id, 'Your data has been updated successfully.', '');
				}
			} else {
				$id = $this->M_user_control->insertData('authority', $data);
				set_confirmation_msg($id, 'Your data has been added successfully.', '');
			}
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please fill up the form correctly.', '');
		}

		redirect('add_new_user');
	}


	// Update User
	public function updateUser()
	{
		$a_id = $this->input->post('a_id');
		$a_name = $this->input->post('a_name');
		$a_type = $this->input->post('a_type');
		$a_email = $this->input->post('a_email');
		$a_address = $this->input->post('a_address');
		$a_mobile = $this->input->post('a_mobile');
		$a_key = $this->input->post('a_key');
		$a_img = $this->engine->image_upload_mod('a_img', './assets/uploads/users/', '');
		$hidden_img = $this->input->post('hidden_img');

		if ($a_img) {
			$a_img = $a_img;
		} elseif ($hidden_img) {
			$a_img = $hidden_img;
		} else {
			$a_img = 'user_dummy.jpg';
		}


		if (strlen($a_mobile) == 11 && (strlen($a_key) >= 1 && strlen($a_key) <= 6)) {
			$data = array(
				'a_name' => $a_name,
				'a_email' => $a_email,
				'a_address' => $a_address,
				'a_img' => $a_img,
				'a_key' => md5($a_key),
				'a_password' => $a_key,
				'a_credential' => $a_mobile,
				'a_type' => $a_type,
				'a_updated_at' => get_current_time(),
				'a_updated_by' => $this->session->userdata('currentActiveId'),
			);

			$authorityCredential = $this->M_user_control->get_data_multi_conditional_where_in('authority', ['a_credential' => $a_mobile, 'a_id !=' => $a_id], 'a_status', '1,2')->row();


			if ($authorityCredential) {
				set_confirmation_msg('TRUE', 'This mobile number already in use. Please enter another number.', '');
			} elseif ($a_email) {
				$checkEmail = $this->M_user_control->get_data_multi_conditional_where_in('authority', ['a_email' => $a_email, 'a_id !=' => $a_id], 'a_status', '1,2')->row();
				if ($checkEmail) {
					set_confirmation_msg($checkEmail, 'This email address already in use. Please enter another email.', '');
				} else {
					$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
					set_confirmation_msg($id, 'Your data has been updated successfully.', '');
				}
			} else {
				$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
				set_confirmation_msg($id, 'Your data has been updated successfully.', '');
			}
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please fill up the form correctly.', '');
		}

		redirect('add_new_user');
	}

	// Delete User
	public function deleteUser()
	{
		$a_id = $this->input->get('a_id');
		$data = array(
			'a_status' => 0,
			'a_updated_at' => get_current_time(),
			'a_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
		if ($id == TRUE) {
			set_confirmation_msg('TRUE', 'Your data has been deleted successfully.', '');
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please try again later.', '');
		}

		redirect('add_new_user');
	}

	// Inactive User
	public function InactiveUser()
	{
		$a_id = $this->input->get('a_id');
		$data = array(
			'a_status' => 2,
			'a_updated_at' => get_current_time(),
			'a_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
		if ($id == TRUE) {
			set_confirmation_msg('TRUE', 'Your data has been inactivated successfully.', '');
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please try again later.', '');
		}

		redirect('add_new_user');
	}

	// Active User
	public function activeUser()
	{
		$a_id = $this->input->get('a_id');
		$data = array(
			'a_status' => 1,
			'a_updated_at' => get_current_time(),
			'a_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
		if ($id == TRUE) {
			set_confirmation_msg('TRUE', 'Your data has been activated successfully.', '');
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please try again later.', '');
		}

		redirect('add_new_user');
	}



	// Forgot Password Request
	public function addForgotPasswordView()
	{
		$data = $this->engine->store_nav('user_control', 'add_forgot_password_request', 'Forgot Password Request View');
		$data['authority_list'] = $this->M_user_control->get_data_multi_conditional('authority', ['a_status' => 2, 'a_forgot_password_status' => 1])->result();
		$path = 'backend/setup/user_control/add_forgot_password_request';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	public function approveForgotPasswordRequest()
	{
		$a_id = $this->input->get('a_id');
		$a_forgot_password_code = $this->input->get('a_forgot_password_code');
		$data = array(
			'a_key' => md5($a_forgot_password_code),
			'a_password' => $a_forgot_password_code,
			'a_forgot_password_status' => 0,
			'a_status' => 1,
			'a_updated_at' => get_current_time(),
			'a_updated_by' => $this->session->userdata('currentActiveId'),
		);
		$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
		if ($id == TRUE) {
			set_confirmation_msg('TRUE', 'Your have approved new password successfully.', '');
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please try again later.', '');
		}

		redirect('add_forgot_password_request');
	}



	/* ============================== All user profile changes ============================== */
	// Profile
	public function addUserProfile()
	{
		$data = $this->engine->store_nav('user_profile', 'add_user_profile', 'Create New User');
		$userId = $this->session->userdata('currentActiveId');
		$data['userInformation'] = $this->Common->get_single_row_information_multi_conditional('authority', ['a_status' => 1, 'a_id' => $userId]);
		$path = 'backend/setup/user_control/add_user_profile';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}

	// Update User profile
	public function updateUserProfileInformation()
	{
		$a_id = $this->input->post('a_id');
		$a_name = $this->input->post('a_name');
		$a_email = $this->input->post('a_email');
		$a_address = $this->input->post('a_address');
		$a_mobile = $this->input->post('a_mobile');
		$a_img = $this->engine->image_upload_mod('a_img', './assets/uploads/users/', '');
		$hidden_img = $this->input->post('hidden_img');

		if ($a_img) {
			$a_img = $a_img;
		} elseif ($hidden_img) {
			$a_img = $hidden_img;
		} else {
			$a_img = 'user_dummy.jpg';
		}


		if (strlen($a_mobile) == 11) {
			$data = array(
				'a_name' => $a_name,
				'a_email' => $a_email,
				'a_address' => $a_address,
				'a_img' => $a_img,
				'a_credential' => $a_mobile,
				'a_updated_at' => get_current_time(),
				'a_updated_by' => $this->session->userdata('currentActiveId'),
			);

			$authorityCredential = $this->M_user_control->get_data_multi_conditional_where_in('authority', ['a_credential' => $a_mobile, 'a_id !=' => $a_id], 'a_status', '1,2')->row();


			if ($authorityCredential) {
				set_confirmation_msg('TRUE', 'This mobile number already in use. Please enter another number.', '');
			} elseif ($a_email) {
				$checkEmail = $this->M_user_control->get_data_multi_conditional_where_in('authority', ['a_email' => $a_email, 'a_id !=' => $a_id], 'a_status', '1,2')->row();
				if ($checkEmail) {
					set_confirmation_msg('TRUE', 'This email address already in use. Please enter another email.', '');
				} else {
					$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
					set_confirmation_msg($id, 'Your data has been updated successfully.', 'Something is wrong. Please fill up the form correctly.');
				}
			} else {
				$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
				set_confirmation_msg($id, 'Your data has been updated successfully.', 'Something is wrong. Please fill up the form correctly.');
			}
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please fill up the form correctly.', '');
		}

		redirect('add_user_profile');
	}




	// Update User
	public function updateUserProfilePassword()
	{
		$a_id = $this->input->post('a_id');
		$a_key = $this->input->post('a_key');


		if ((strlen($a_key) >= 1 && strlen($a_key) <= 6)) {
			$data = array(
				'a_key' => md5($a_key),
				'a_password' => $a_key,
				'a_updated_at' => get_current_time(),
				'a_updated_by' => $this->session->userdata('currentActiveId'),
			);

			$id = $this->M_user_control->update_data('authority', 'a_id', $a_id, $data);
			if ($id == TRUE) {
				set_confirmation_msg('TRUE', 'Your data has been updated successfully.', '');
			} else {
				set_confirmation_msg('TRUE', 'Something is wrong. Please fill up the form correctly.', '');
			}
		} else {
			set_confirmation_msg('TRUE', 'Something is wrong. Please fill up the form correctly.', '');
		}

		redirect('add_user_profile');
	}



	/* ============================== Invoice Approval Control ============================== */
	// invoice approval page view
	public function addJutePurchaseInvoiceApproval()
	{
		$data = $this->engine->store_nav('user_control', 'add_invoice_approval', 'Invoice Approval');
		$data['invoice_approval_jute_purchase_list'] = $this->M_user_control->getJutePurchaseInvoiceApprovalData('invoice_approver_jute_purchase', ['iajp_status' => 1], 'iajp_approval_status', 'ASC')->result();
		$data['authority_list'] = $this->M_user_control->get_data_multi_conditional('authority', ['a_status' => 1])->result();
		$path = 'backend/setup/user_control/add_invoice_approval';
		$this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
	}
	// invoice approval insert
	public function insertJutePurchaseInvoiceApproval()
	{
		$ia_user_id = $this->input->post('iajp_user_id');
		$invoiceApprovalInfo = $this->Common->get_single_row_information_multi_conditional_max_value('invoice_approver_jute_purchase', ['iajp_status' => 1], 'iajp_approval_status');
		if ($invoiceApprovalInfo) {
			$serialNumber = $invoiceApprovalInfo->iajp_approval_status;
			$statusSerialNumber = $serialNumber + 1;
		} else {
			$statusSerialNumber = 1;
		}
		$data = array(
			'iajp_user_id' => $ia_user_id,
			'iajp_approval_status' => $statusSerialNumber,
			'iajp_status' => 1,
			'iajp_created_at' => get_current_time(),
			'iajp_created_by' => $this->session->userdata('currentActiveId'),
		);
		$id = $this->M_user_control->insertData('invoice_approver_jute_purchase', $data);

		set_confirmation_msg($id, 'Your data has been added successfully.', 'Something is wrong.');

		redirect('add_invoice_approval');
	}

	// invoice approval insert
	public function updateJutePurchaseInvoiceApproval()
	{
		$iajp_user_id = $this->input->post('iajp_user_id');

		for ($i = 0; $i < count($iajp_user_id); $i++) {
			$ii = $i + 1;
			$data = array(
				'iajp_approval_status' => $ii,
				'iajp_updated_at' => get_current_time(),
				'iajp_updated_by' => $this->session->userdata('currentActiveId'),
			);
			$id = $this->M_user_control->update_data('invoice_approver_jute_purchase', 'iajp_user_id', $iajp_user_id[$i], $data);

			// x_debug($iajp_user_id);
		}
		set_confirmation_msg($id, 'Your data has been updated successfully.', 'Something is wrong.');

		redirect('add_invoice_approval');
	}

	public function deleteJutePurchaseInvoiceApproval()
	{

		$id = $this->input->get('iajp_id');
		// Delete
		// $deleteData = array(
		// 	'iajp_status' => 0,
		// 	'iajp_updated_at' => get_current_time(),
		// 	'iajp_updated_by' => $this->session->userdata('currentActiveId'),
		// );
		$this->Common->delete_data('invoice_approver_jute_purchase', 'iajp_id', $id);

		// Sort
		$iajp_user_id = [];
		$datas = $this->M_user_control->get_data_multi_conditional('invoice_approver_jute_purchase', ['iajp_status' => 1])->result();
		foreach ($datas  as  $value) {
			array_push($iajp_user_id, $value->iajp_user_id);
		}

		for ($i = 0; $i < count($iajp_user_id); $i++) {
			$ii = $i + 1;
			$data = array(
				'iajp_approval_status' => $ii,
				'iajp_updated_at' => get_current_time(),
				'iajp_updated_by' => $this->session->userdata('currentActiveId'),
			);
			$this->M_user_control->update_data('invoice_approver_jute_purchase', 'iajp_user_id', $iajp_user_id[$i], $data);
		}
		set_confirmation_msg('TRUE', 'Your data has been deleted and sorted after deleted successfully.', 'Something is wrong.');

		redirect('add_invoice_approval');
	}




	// End
}
