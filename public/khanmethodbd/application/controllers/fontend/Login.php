<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $data['company_info'] = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        $data['site_info'] = "";
        $data['title'] = 'Login ';
        $data['main_content'] = $this->load->view('fontend/login', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function check_login()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $input_check = 100;
        if ($this->form_validation->run() === FALSE) {
            $input_check = 0;
        } else {

            $userinformation = array(
                'u_email' => $this->input->post('email'),
                'u_password' => $this->input->post('password'),
                'u_status' => 1
            );
            $res = $this->User->user_validation("user", $userinformation);
            if ($res == FALSE) {
                $input_check = 1;
            } else {
                $this->session->set_userdata('user_id', $res->u_id);
                $this->session->set_userdata('user_name', "$res->u_first_name $res->u_last_name");
                $this->session->set_userdata('user_phone', $res->u_phone);
                $this->session->set_userdata('user_email', $res->u_email);
                redirect('/', 'location');
            }
        }
        if ($input_check == 0) {
            $this->session->set_flashdata('error', "Please Insert Your Email And Password");
        } elseif ($input_check == 1) {
            $this->session->set_flashdata('error', "Email and Password Not Match");
        } else {
            $this->session->set_flashdata('error', "Unknown Error Occuer");
        }

        redirect('sign_in', 'location');
    }
}
