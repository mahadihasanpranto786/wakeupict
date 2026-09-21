<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserView extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Backend');
        if ($this->session->userdata('user_id')) {
        } else {
            $this->session->set_flashdata('login_failed', 'Link is broken');
            redirect('fontend/Login');
        }
    }

    public function index()
    {
        $default_page = 'user/dashboard';
        $data['main_nav'] = 'dashboard';
        $data['sub_nav'] = '';
        $data['tittle'] = "dashboard";
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $data['side_menu'] = $this->load->view('user/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view($default_page, $data, TRUE);
        $this->load->view('user/user_layout', $data);
    }

    public function change_profile()
    {
        $data['user_info'] = $this->Common->get_single_row_information('user', 'u_id', $this->session->userdata('user_id'));
        $data['main_nav'] = 'settings';
        $data['sub_nav'] = '';
        $data['tittle'] = "change_profile";

        $data['side_menu'] = $this->load->view('user/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('user/change_profile', $data, TRUE);
        $this->load->view('user/user_layout', $data);
    }

    public function invoice_list($status = null)
    {
        $data['status'] = $status;
        $data['main_nav'] = 'order';
        $data['sub_nav'] = '';
        if ($status == 0) {
            $data['sub_nav'] = 'process_order';
        } elseif ($status == 1) {
            $data['sub_nav'] = 'complete_order';
        } elseif ($status == 2) {
            $data['sub_nav'] = 'cancle_order';
        } elseif ($status == 5) {
            $data['sub_nav'] = 'shipped_order';
        } elseif ($status == 6) {
            $data['sub_nav'] = 'confirm_order';
        }

        $data['tittle'] = "dashboard";
        $data['invoice_list'] = $this->Boardend->get_invoice_list_user('invoice', ['i_status' => $status, 'i_user_id' => $this->session->userdata('user_id')]);
        $data['side_menu'] = $this->load->view('user/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('user/order/order_list', $data, TRUE);
        $this->load->view('user/user_layout', $data);
    }


    public function invoice_view($identifier = null)
    {
        $default_invoice = 'user/order/invoice_template/clasic_invoice';
        $company_info = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        if ($company_info->invoice_style_id == 2) {
            $default_invoice = 'user/order/invoice_template/dom_invoice';
        }
        $data['company_name'] = $company_info->s_companyname;
        $data['company_logo'] = $company_info->s_invoice_logo;
        $data['company_address'] = $company_info->s_companyaddress;

        $data['tandc'] = $company_info->s_tandc;
        $data['main_nav'] = 'order';
        $data['sub_nav'] = '';

        $data['tittle'] = "Invoice";
        $data['invoice_information'] = $this->Common->get_single_row_information('invoice', 'i_id', $identifier);
        $data['product_list'] = $this->Common->get_data_single_conditional('oder_products', 'invoice_id', $identifier);

        $data['side_menu'] = $this->load->view('user/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view($default_invoice, $data, TRUE);
        $this->load->view('user/user_layout', $data);
    }

    public function print_invoice($identifier = null)
    {
        $company_info = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        $default_invoice = 'user/order/invoice_template/clasic_print_invoice';
        if ($company_info->invoice_style_id == 2) {
            $default_invoice = 'user/order/invoice_template/herican';
        }
        $data['company_name'] = $company_info->s_companyname;
        $data['company_logo'] = $company_info->s_invoice_logo;
        $data['company_address'] = $company_info->s_companyaddress;

        $data['tandc'] = $company_info->s_tandc;
        $data['main_nav'] = 'order';
        $data['sub_nav'] = '';

        $data['tittle'] = "Print Invoice";
        $data['invoice_information'] = $this->Common->get_single_row_information('invoice', 'i_id', $identifier);
        $data['product_list'] = $this->Common->get_data_single_conditional('oder_products', 'invoice_id', $identifier);

        $this->load->view($default_invoice, $data);
    }

    public function profile_updated()
    {
        $information = array(
            'u_first_name' => $this->input->post('fname'),
            'u_last_name' => $this->input->post('lname'),
            'u_password' => $this->input->post('password'),
            'u_phone' => $this->input->post('phone'),
            'u_address' => $this->input->post('address')
        );
        $res = $this->Common->update_data('user', 'u_id', $this->session->userdata('user_id'), $information);
        $this->backend->set_confirmation_msg($res, "Information Updated successfully.", "Fail to Updated  information.");
        redirect('user/change_profile', 'location');
    }

    private function x_debug($data)
    {
        print_r($data);
        echo "<br>";
        exit();
    }


    public function imgae_upload()
    {
        $config['upload_path'] = './assets/products';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image_path')) {
            $error = array('error' => $this->upload->display_errors());

            // echo "<script>alert('image does not supported ')</script>";
            return "demo.jpg";
        } else {
            return $this->upload->data('file_name');
        }
    }

    public function c_imgae_upload()
    {
        $config['upload_path'] = './assets/storefront/public/images';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('c_image_path')) {
            $error = array('error' => $this->upload->display_errors());

            // echo "<script>alert('image does not supported ')</script>";
            return "demo.jpg";
        } else {
            return $this->upload->data('file_name');
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

    public function user_logout()
    {
        $this->session->unset_userdata('currentActiveId');
        $this->session->sess_destroy();
        redirect('fontend/Login', 'location');
    }
}
