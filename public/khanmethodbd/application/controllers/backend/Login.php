<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }
    private $main_layout = 'fontend/master';


    public function index()
    {
        $data['site_info'] = "";
        $general_settings = ['s_id' => 1];
        $general_settings_list = get_data_single_muli_con("settings", $general_settings);
        $data['title'] = $general_settings_list->s_companyname;
        $data['company_info'] = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        $data['main_content'] = $this->load->view("backend/login/login_view", $data, TRUE);
        $this->load->view($this->main_layout, $data);
    }
    public function authentication_process()
    {
        $userinformation = $this->set_login_information($this->secure_data());
        $res = $this->User->user_validation("authority", $userinformation);
        $confirm = $this->set_confirmation_msg($res, "Login Success", "Email and Password not match");

        if ($confirm == 1) {
            if ($res->authority_type == 1) {
                $this->session->set_userdata('currentActiveId', $res->authority_id);
                $this->session->set_userdata('current_name', $res->authority_name);
                $this->session->set_userdata('current_email', $res->authority_email);
                redirect('dashboard', 'location');
            }
            if ($res->authority_type == 2) {
                $this->session->set_userdata('currentActiveVendorId', $res->authority_id);
                $this->session->set_userdata('current_vendor_name', $res->authority_name);
                $this->session->set_userdata('current_vendor_email', $res->authority_email);
                redirect('vendor/dashboard', 'location');
            }
        } else {
            redirect('login', 'location');
        }
    }


    private function set_login_information($input_validation)
    {
        if ($input_validation) {
        } else {
            $this->set_confirmation_msg("", "", "Please The Valid Data");
            redirect('Welcome', 'location');
        }
        $userinformation = array(
            'authority_email' => $this->input->post('email'),
            'authority_password' => md5($this->input->post('password')),
            'authority_isdeleted' => 0
        );
        return $userinformation;
    }


    private function secure_data()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            return 0;
        } else {

            return TRUE;
        }
    }

    private function set_confirmation_msg($data, $true_msg, $false_msg)
    {
        $confirm = 0;
        if ($data == FALSE) {
            $this->session->set_flashdata('error', $false_msg);
        } else {
            $this->session->set_flashdata('success', $true_msg);
            $confirm = 1;
        }
        return $confirm;
    }

    private function x_debug($data)
    {
        print_r($data);
        echo "<br>";
        exit();
    }
}
