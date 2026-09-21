<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->model('M_user_control');
	}

	public function index()
	{
		$data['company_name'] = 'Welcome to Rajbari Jute Mills Ltd.';
		$data['login_tittle'] = 'Login';
		$data['login_description'] = 'Please enter your credential';
		$data['site_info'] = "";
		$this->load->view('login/login_view', $data);
	}

	public function authentication_process()
	{
		$userinformation = $this->set_login_information($this->secure_data());
		$res = $this->User->user_validation("authority", $userinformation);
		$confirm = set_confirmation_msg($res, "Login Success", "Mobile and Password not match");


		/*
		==>Security Department
			1. Head = 101
			2. Operator = 102
		==> Wait Department
			1. Head = 201
			2. Operator = 202
		==> Jute Department
			1. Head = 301
			2. Operator = 302
		==> Accounts Department
			1. Head = 401
			2. Operator = 402
		==> Production Department
			1.	Head = 501
			2.	Operator = 502
		==> Authority
			1. GM = 601
			2. Shareholder = 602 
			3. System Administrator =	603


		*/
		if ($confirm == 1) {
			// Just for one type of user access
			if ($res->a_type == 1) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('administration', 'location');
			} elseif ($res->a_type == 10) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('operator', 'location');
			} elseif ($res->a_type == 101) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('security_head', 'location');
			} elseif ($res->a_type == 102) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('security_operator', 'location');
			} elseif ($res->a_type == 201) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('weight_head', 'location');
			} elseif ($res->a_type == 202) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('weight_operator', 'location');
			} elseif ($res->a_type == 301) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('jute_head', 'location');
			} elseif ($res->a_type == 302) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('jute_operator', 'location');
			} elseif ($res->a_type == 401) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('accounts_head', 'location');
			} elseif ($res->a_type == 402) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('accounts_operator', 'location');
			} elseif ($res->a_type == 501) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('production_head', 'location');
			} elseif ($res->a_type == 502) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('production_operator', 'location');
			} elseif ($res->a_type == 601) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('gm', 'location');
			} elseif ($res->a_type == 602) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('shareholder', 'location');
			} elseif ($res->a_type == 603) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('system_administrator', 'location');
			} elseif ($res->a_type == 701) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('store_head', 'location');
			} elseif ($res->a_type == 702) {
				$this->session->set_userdata('currentActiveId', $res->a_id);
				$this->session->set_userdata('current_credential', $res->a_credential);
				$this->session->set_userdata('current_type', $res->a_type);
				$authorityId = $this->session->userdata('currentActiveId');
				redirect('store_operator', 'location');
			}
		} else {
			$this->session->set_flashdata('login_failed', 'Credential Not match');
			redirect('login', 'location');
		}
	}




	private function set_login_information($input_validation)
	{
		if ($input_validation) {
		} else {
			set_confirmation_msg("", "", "Please The Valid Data");
			redirect('Welcome', 'location');
		}
		$userinformation = array(
			'a_credential' => $this->input->post('number'),
			'a_key' => md5($this->input->post('password')),
			'a_status' => 1
		);
		return $userinformation;
	}


	private function secure_data()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('number', 'Number', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			return 0;
		} else {
			return TRUE;
		}
	}





	public function user_logout()
	{
		$this->session->unset_userdata('currentActiveId');
		$this->session->sess_destroy();
		redirect('login', 'location');
	}



	/* ================================ Forgot Password Section - Rimon ================================ */
	public function forgot_password()
	{
		$data['company_name'] = 'Welcome to Rajbari Jute Mills Ltd.';
		$data['forgot_tittle'] = 'Forgot Password';
		$data['forgot_description'] = 'Please enter your mobile number';
		$data['site_info'] = "";
		$this->load->view('login/forgot_password_view', $data);
	}


	public function forgot_password_request()
	{
		$mobile_number = $this->input->post('a_mobile');
		$forgot_password_code = $this->input->post('a_forgot_password_code');


		if (strlen($mobile_number) == 11 && (strlen($forgot_password_code) >= 1 && strlen($forgot_password_code) <= 6)) {
			$data = array(
				'a_forgot_password_code ' => $forgot_password_code,
				'a_forgot_password_status' => 1,
				'a_status' => 2,
				'a_forgot_password_request_at' => get_current_time(),
			);

			$authorityCredential = $this->M_user_control->get_data_multi_conditional('authority', ['a_credential' => $mobile_number, 'a_status' => 1, 'a_forgot_password_status' => 0])->row();
			$checkIfAlreadyRequested = $this->M_user_control->get_data_multi_conditional('authority', ['a_credential' => $mobile_number, 'a_status' => 2, 'a_forgot_password_status' => 1])->row();

			// x_debug($authorityCredential);

			if ($authorityCredential) {
				// exit();
				$id = $this->M_user_control->update_data('authority', 'a_credential', $mobile_number, $data);
				if ($id == TRUE) {
					set_confirmation_msg('TRUE', 'You have requested to authority to change your password successfully.', '');
				} else {
					set_confirmation_msg('TRUE', 'Something is wrong. Please fill up the form correctly.', '');
				}
			} elseif ($checkIfAlreadyRequested) {
				set_confirmation_msg('TRUE', 'You have already requested to setup a new password. Please be patience yet authority check your information.', '');
			} else {
				set_confirmation_msg('TRUE', 'Please recheck your mobile number.', '');
			}
		}
		redirect('forgot_password');
	}



	// End
}
