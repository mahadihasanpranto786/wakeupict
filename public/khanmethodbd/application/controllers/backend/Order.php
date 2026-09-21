<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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


    public function create_order()
    {
        $data['main_nav'] = 'order';
        $data['sub_nav'] = 'create_order';
        $data['tittle'] = "dashboard";
        $data['products_list'] = $this->Common->get_data_single_conditional('poducts', 'p_status', '0');
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/order/create_order', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function genarate_invoice()
    {
        $profit = 0;
        $cardData = $this->cart->contents();
        foreach ($cardData as $card) {
            $profit += ($card['price'] - $card['pp_price']) * $card['qty'];
        }




        $information_store = $this->input->post();

        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));
        $information_store['i_createdby'] = $this->session->userdata('currentActiveId');
        $information_store['i_status'] = 0;
        $information_store['i_createdat'] = $newDate;
        $information_store['i_totalcost'] = $this->total_cost() - $information_store['i_discount'];
        $information_store['i_total_profit'] = $profit - $information_store['i_discount'];
        $res = $this->Common->set_data('invoice', $information_store);
        $invoice_number = $res + 1000;
        $customer_mobile = $information_store['i_mobile'];

        $cardData = $this->cart->contents();
        foreach ($cardData as $card) {
            $response = $this->Common->get_single_row_information('poducts', 'p_id', $card['id']);
            $order_store['invoice_id'] = $res;
            $order_store['p_tittle'] = $card['name'];
            $order_store['p_description'] = $response->p_description;
            $order_store['p_quantity'] = $card['qty'];
            $order_store['p_imagepath'] = $response->p_imagepath;
            $order_store['p_pprice'] = $response->p_pprice;
            $order_store['p_sprice'] = $card['price'];
            $order_store['o_status'] = 0;
            $order_store['o_createdat'] = $newDate;
            $order_store['o_createdby'] = $response->p_createdby;
            $order_store['product_id'] = $card['id'];

            $this->Common->set_data('oder_products', $order_store);

            $update_identifier = $card['id'];
            $table = "poducts";
            $index = "p_id";
            $update_product_quantity['p_quantity'] = $response->p_quantity - $card['qty'];
            $this->Common->update_data($table, $index, $update_identifier, $update_product_quantity);
        }
        $this->backend->set_confirmation_msg("TRUE", "Invoice Created successfully.", "Fail to Created successfully.");
        $this->cart->destroy();

        redirect('create_order', 'location');
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
        $data['invoice_list'] = $this->Boardend->get_invoice_list('invoice', 'i_status', $status);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/order/order_list', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function invoice($identifier = null)
    {
        $default_invoice = 'backend/admin_view/order/invoice_template/clasic_invoice';
        $company_info = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        if ($company_info->invoice_style_id == 2) {
            $default_invoice = 'backend/admin_view/order/invoice_template/dom_invoice';
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


        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view($default_invoice, $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function print_invoice($identifier = null)
    {
        $company_info = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        $default_invoice = 'backend/admin_view/order/invoice_template/clasic_print_invoice';
        if ($company_info->invoice_style_id == 2) {
            $default_invoice = 'backend/admin_view/order/invoice_template/herican';
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

    public function print_all($identifier = null)
    {
        $company_info = $this->Common->get_single_row_information('settings', 's_companyid', 1);
        $data['company_name'] = $company_info->s_companyname;
        $data['company_logo'] = $company_info->s_invoice_logo;
        $data['company_address'] = $company_info->s_companyaddress;

        $data['tandc'] = $company_info->s_tandc;
        $data['main_nav'] = 'order';
        $data['sub_nav'] = '';

        $data['tittle'] = "dashboard";
        $data['status'] = $identifier;
        $data['invoice_list'] = $this->Common->get_data_single_conditional('invoice', 'i_status', $identifier);
        $this->load->view('backend/admin_view/order/invoice_template/herican_all', $data);
    }

    public function complete_invoice($identifier = null)
    {
        $product_information['o_status'] = 1;

        $this->Common->update_data('oder_products', 'invoice_id', $identifier, $product_information);
        $information_store['i_status'] = 1;
        $information_store['i_update_at'] = date("Y-m-d", strtotime(date("Y/m/d")));
        $this->Common->update_data('invoice', 'i_id', $identifier, $information_store);
        redirect('invoice_list/1', 'location');
    }

    public function confirm_shipped($identifier = null)
    {
        $product_information['o_status'] = 5;
        $this->Common->update_data('oder_products', 'invoice_id', $identifier, $product_information);
        $information_store['i_status'] = 5;
        $this->Common->update_data('invoice', 'i_id', $identifier, $information_store);

        $response = $this->Common->get_single_row_information('invoice', 'i_id', $identifier);

        $customer_name = $response->i_name;
        $invoice_number = $identifier + 1000;
        $msg = "Hi $customer_name,
        Item(s) from your order $invoice_number are on its way to you. Thanks from heriken.com";
        $customer_mobile = "88" . $response->i_mobile;
        $this->backend->sent_sms($customer_mobile, $msg);
        redirect('invoice_list/5', 'location');
    }


    public function invoice_confirm($identifier = null)
    {
        $product_information['o_status'] = 6;
        $this->Common->update_data('oder_products', 'invoice_id', $identifier, $product_information);
        $information_store['i_status'] = 6;

        $this->Common->update_data('invoice', 'i_id', $identifier, $information_store);

        $response = $this->Common->get_single_row_information('invoice', 'i_id', $identifier);
        $invoice_number = $identifier + 1000;
        $customer_name = $response->i_name;
        $total_cost = $response->i_totalcost - $response->i_payment + $response->i_shipping_cost;
        $msg = "Hi, $customer_name Your Order Number: $invoice_number has been Confirmed. Total Amount is  $total_cost BDT.Thanks From Heriken.com";
        $customer_mobile = "88" . $response->i_mobile;
        $this->backend->sent_sms($customer_mobile, $msg);
        redirect('invoice_list/6', 'location');
    }

    public function cancel_invoice($identifier = null)
    {
        $product_information['o_status'] = 2;
        $this->Common->update_data('oder_products', 'invoice_id', $identifier, $product_information);
        $information_store['i_status'] = 2;

        $this->Common->update_data('invoice', 'i_id', $identifier, $information_store);
        $product_list = $this->Common->get_data_single_conditional('oder_products', 'invoice_id', $identifier);
        if ($product_list) {
            foreach ($product_list->result() as $row) {
                $response = $this->Common->get_single_row_information('poducts', 'p_id', $row->product_id);
                $update_identifier = $row->product_id;
                $table = "poducts";
                $index = "p_id";
                $update_product_quantity['p_quantity'] = $response->p_quantity + $row->p_quantity;
                $res = $this->Common->update_data($table, $index, $update_identifier, $update_product_quantity);
            }
        }
        $this->Common->update_data('invoice', 'i_id', $identifier, ["i_totalcost" => 0, "i_shipping_cost" => 0, "i_total_profit" => 0]);
        redirect('invoice_list/2', 'location');
    }



    private function total_cost()
    {
        $total = 0;
        $cardData = $this->cart->contents();
        foreach ($cardData as $card) {
            $total += $card['price'] * $card['qty'];
        }
        return $total;
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
        redirect('backend/Login', 'location');
    }
}
