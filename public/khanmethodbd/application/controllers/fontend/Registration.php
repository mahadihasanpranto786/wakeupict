<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function index()
    {
        $data['company_info'] = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        $data['site_info'] = "";
        // $this->load->view('fontend/registration', $data);

        $data['title'] = 'Register ';
        $data['main_content'] = $this->load->view('fontend/registration', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function store()
    {
        $user = $this->Common->get_data_multi_conditional("user", ['u_email' => $this->input->post('email')]);

        if ($user) {
            $this->set_confirmation_msg(FALSE, "Store in System", "This email is already exists");

            redirect('fontend/Registration', 'location');
        } elseif (strlen($this->input->post('password')) >= 6) {
            $information = array(
                'u_first_name' => $this->input->post('fname'),
                'u_last_name' => $this->input->post('lname'),
                'u_email' => $this->input->post('email'),
                'u_password' => $this->input->post('password'),
                'u_phone' => $this->input->post('phone'),
                'u_address' => $this->input->post('address'),
                'u_status' => 1,
                'u_isdeleted' => 0,
            );
            $res = $this->Common->set_data("user", $information);
            $this->set_confirmation_msg($res, "Registered", "Error Occure");
            redirect('fontend/Registration', 'location');
        } else {

            $this->set_confirmation_msg(2, "Error Occure", "Password minimum 6 characters");
            redirect('fontend/Registration', 'location');
        }
    }

    private function set_confirmation_msg($data, $true_msg, $false_msg)
    {
        $confirm = 0;
        if ($data == FALSE) {
            $this->session->set_flashdata('error', $false_msg);
        } elseif ($data == 2) {
            $this->session->set_flashdata('passAlert', $false_msg);
            $confirm = 1;
        } else {
            $this->session->set_flashdata('success', $true_msg);
            $confirm = 1;
        }
        return $confirm;
    }
}
