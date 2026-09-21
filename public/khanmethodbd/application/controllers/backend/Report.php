<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Backend');
        if ($this->session->userdata('currentActiveId')) {
        } else {
            $this->session->set_flashdata('login_failed', 'Link is broken');
            redirect('backend/Login');
        }
    }

    public function order_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'order_report';
        $data['tittle'] = "dashboard";
        $data['total_rows'] = 0;
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $data['report_data'] = "";
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/report/order_report', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function genarate_order_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'order_report';
        $data['tittle'] = "dashboard";
        $requst_type = $this->input->get('requst_type');
        $f_date = $this->input->get('f_date');
        $t_date = $this->input->get('t_date');

        $par_page_data = 5;
        $offset = pagination_offset(4, $par_page_data);
        $url = "backend/Report/genarate_order_report";
        $data["serial"] = serial_number_par_page(4, $par_page_data);
        if ($requst_type) {
            $report['i_status'] = $requst_type;
        }
        if ($f_date) {
            $f_date = date("Y-m-d", strtotime($this->input->get('f_date')));
            $report['DATE(i_createdat) >='] = $f_date;
        }
        if ($t_date) {
            $t_date = date("Y-m-d", strtotime($this->input->get('t_date')));
            $report['DATE(i_createdat) <='] = $t_date;
        }
        if (empty($report)) {
            $report = '';
        }


        $total_rows = $this->Common->get_multi_cond_data_count_mod("invoice", $report);
        $data['total_rows'] = $total_rows;
        set_pagination($total_rows, $url, $par_page_data);

        $data['report_data'] = $this->Common->get_multi_cond_data_limit_mod("invoice",  $par_page_data, $offset, $report);

        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/report/order_report', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function product_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'product_report';
        $data['tittle'] = "dashboard";
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $data['report_data'] = "";
        $data['products_list'] = $this->Common->get_data_single_conditional('poducts', 'p_status', '0');
        $data['total_rows'] = 0;
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/report/product_report', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function genarate_product_report()
    {
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'product_report';
        $data['tittle'] = "dashboard";
        $data['products_list'] = $this->Common->get_data_single_conditional('poducts', 'p_status', '0');
        $product_id = $this->input->get('product_id');
        $requst_type = $this->input->get('requst_type');
        $f_date = $this->input->get('f_date');
        $t_date = $this->input->get('t_date');
        $par_page_data = 10;
        $offset = pagination_offset(4, $par_page_data);
        $url = "backend/Report/genarate_product_report";
        $data["serial"] = serial_number_par_page(4, $par_page_data);
        if ($product_id) {
            $report['product_id'] = $product_id;
        }
        if ($requst_type) {
            $report['o_status'] = $requst_type;
        }
        if ($f_date) {
            $f_date = date("Y-m-d", strtotime($this->input->get('f_date')));
            $report['DATE(o_createdat) >='] = $f_date;
        }
        if ($t_date) {
            $t_date = date("Y-m-d", strtotime($this->input->get('t_date')));
            $report['DATE(o_createdat) <='] = $t_date;
        }
        if (empty($report)) {
            $report = '';
        }
        $total_rows = $this->Common->get_multi_cond_data_count_mod("oder_products", $report);
        $data['report_data'] = $this->Common->get_multi_cond_data_limit_mod("oder_products",  $par_page_data, $offset, $report);
        $data['total_rows'] = $total_rows;
        set_pagination($total_rows, $url, $par_page_data);
        // print_r($report);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/report/product_report', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    // late updated
    public function sales_report()
    {
        $this->session->unset_userdata('first_date');
        $this->session->unset_userdata('end_date');
        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'sales_report';
        $data['tittle'] = "dashboard";
        $par_page_data = 5;
        $offset = pagination_offset(4, $par_page_data);
        $url = "backend/Report/sales_report";
        $data["serial"] = serial_number_par_page(4, $par_page_data);
        $report = array(
            'i_status' => 1
        );
        $total_rows = $this->Common->get_multi_cond_data_count_mod("invoice", $report);
        $data['total_rows'] = $total_rows;
        set_pagination($total_rows, $url, $par_page_data);

        $data['report_data'] = $this->Common->get_multi_cond_data_limit_mod("invoice",  $par_page_data, $offset, $report);
        $sumInvoice_count = $this->Common->order_report_mod_sum($report, $par_page_data, $offset)->result();
        if (isset($sumInvoice_count[0]->i_totalcost) && isset($sumInvoice_count[0]->AllCountData)) {
            $this->session->set_userdata('invoiceCastSum', $sumInvoice_count[0]->i_totalcost);
            $this->session->set_userdata('invoiceCount', $sumInvoice_count[0]->AllCountData);
        }
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/report/sales_report', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }
    public function genarate_sales_report()
    {

        $data['main_nav'] = 'Reporting';
        $data['sub_nav'] = 'sales_report';
        $data['tittle'] = "dashboard";
        $par_page_data = 5;
        $offset = pagination_offset(4, $par_page_data);
        $url = "backend/Report/genarate_sales_report";
        $data["serial"] = serial_number_par_page(4, $par_page_data);
        $report = array(
            'i_status' => 1
        );
        $total_rows = $this->Common->get_multi_cond_data_count_mod("invoice", $report);
        $data['total_rows'] = $total_rows;
        set_pagination($total_rows, $url, $par_page_data);

        $data['report_data'] = $this->Common->get_multi_cond_data_limit_mod("invoice",  $par_page_data, $offset, $report);

        // Search Data
        $f_date = $this->input->post('f_date');
        $t_date = $this->input->post('t_date');
        if ($f_date) {
            if ($t_date) {
                $f_date = date("Y-m-d", strtotime($f_date));
                $this->session->set_userdata('first_date', $f_date);
                $t_date = date("Y-m-d", strtotime($t_date));
                $this->session->set_userdata('end_date', $t_date);
                $report = array(
                    'i_status' => 1,
                    'DATE(i_createdat) >=' => $f_date,
                    'DATE(i_createdat) <=' => $t_date,
                );
                $data['report_data'] = $this->Common->get_multi_cond_data_limit_mod("invoice",  $par_page_data, $offset, $report);
                $total_rows = $this->Common->get_multi_cond_data_count_mod("invoice", $report);
                $data['total_rows'] = $total_rows;
                set_pagination($total_rows, $url, $par_page_data);
            }
        }
        $sumInvoice_count = $this->Common->order_report_mod_sum($report, $par_page_data, $offset)->result();
        if (isset($sumInvoice_count[0]->i_totalcost) && isset($sumInvoice_count[0]->AllCountData)) {
            $this->session->set_userdata('invoiceCastSum', $sumInvoice_count[0]->i_totalcost);
            $this->session->set_userdata('invoiceCount', $sumInvoice_count[0]->AllCountData);
        }
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/report/sales_report', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }
}
