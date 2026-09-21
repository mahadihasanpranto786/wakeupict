<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VendorReport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Backend');
        if ($this->session->userdata('currentActiveVendorId')) { } else {
            $this->session->set_flashdata('login_failed', 'Link is broken');
            redirect('backend/Login');
        }
    }

    public function order_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'order_report';
        $data['tittle'] = "dashboard";
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $data['report_data']="";
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/report/order_report', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    public function genarate_order_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'order_report';
        $data['tittle'] = "dashboard";
        $requst_type = $this->input->post('requst_type');
        $f_date = $this->input->post('f_date');
        $t_date = $this->input->post('t_date');
        $report = "";
        if ($requst_type) {
            if($requst_type==3){
                $requst_type=0;
            }
            $report['i_status'] = $requst_type;
        }
        if ($f_date) {
            $report['i_createdat>='] = $f_date;
        }
        if ($t_date) {
            $report['i_createdat<='] = $t_date;
        }
        
        $data['report_data']=$this->Boardend->order_report($report);
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/report/order_report', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }
    
    public function product_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'product_report';
        $data['tittle'] = "dashboard";
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $data['report_data'] = "";
        $data['products_list'] = $this->Common->get_data_single_conditional('poducts', 'p_status', '0');
        
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/report/product_report', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    public function genarate_product_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'product_report';
        $data['tittle'] = "dashboard";
        $product_id = $this->input->post('product_id');
        $f_date = $this->input->post('f_date');
        $t_date = $this->input->post('t_date');
        $report = "";
        $requst_type = $this->input->post('requst_type');
        if ($requst_type) {
            if ($requst_type == 3) {
                $requst_type = 0;
            }
            $report['o_status'] = $requst_type;
        }
        if ($product_id) {
            $report['product_id'] = $product_id;
        }
        else{
            redirect('product_report', 'location');
        }
        if ($f_date) {
            $report['o_createdat>='] = $f_date;
        }
        if ($t_date) {
            $report['o_createdat<='] = $t_date;
        }
        $data['products_list'] = $this->Common->get_data_single_conditional('poducts', 'p_status', '0');
        
        $data['report_data'] = $this->Boardend->product_report($report);
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/report/product_report', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    // late updated
    public function genarate_sales_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'sales_report';
        $data['tittle'] = "dashboard";
        $requst_type = '1';
        
        $f_date = $this->input->post('f_date');
        $t_date = $this->input->post('t_date');
        $report = "";
        $report['i_status'] = $requst_type;
        if ($f_date) {
            $report['i_createdat>='] = $f_date;
        }
        if ($t_date) {
            $report['i_createdat<='] = $t_date;
        }
        
        $data['report_data']=$this->Boardend->order_report($report);
        $data['side_menu'] = $this->load->view('backend/vendor_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/vendor_view/report/sales_report', $data, TRUE);
        $this->load->view('backend/vendor_view/vendor_layout', $data);
    }

    
}
