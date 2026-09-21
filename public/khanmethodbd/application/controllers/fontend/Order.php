<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /* if (!isset($this->session->userdata['user_id'])) {
            redirect('fontend/Login');
        } */
        $this->load->model('Common');
        $this->load->model('Frontend');
    }

    public function cart()
    {

        $data['title'] = 'Cart';
        $data['main_content'] = $this->load->view('fontend/order/cart', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function checkout()
    {
        $data['title'] = 'Checkout';
        $shipping = ['shipping_isdeleted' => 0, 'shipping_status' => 1];
        $data['shipping'] = $this->Common->get_data_multi_conditional("shipping", $shipping);
        $data['main_content'] = $this->load->view('fontend/order/checkout', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function complete_order()
    {
        $data['title'] = 'Complete order';
        $data['main_content'] = $this->load->view('fontend/order/complete-order', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function order_store()
    {
        $profit = 0;
        $cardData = $this->cart->contents();
        foreach ($cardData as $card) {
            $profit += ($card['price'] - $card['pp_price']) * $card['qty'];
        }

        $information_store = $this->input->post();

        $shipping_cost = $this->input->post('i_shipping_cost');
        $newDate = date("Y-m-d", strtotime(date("Y/m/d")));

        $userinformation = array(
            'u_first_name' => $information_store["f_name"],
            'u_last_name' => "",
            'u_phone' => $information_store["phone"],
            'u_email' => $information_store["phone"],
            'u_address' => $information_store["i_address"],
            'u_password' =>  $information_store["phone"],
            'u_status' => 1
        );
        $res = $this->User->user_validation("user", ["u_phone" => $this->input->post('phone')]);
        if (empty($res)) {
            $this->Common->set_data('user', $userinformation);
            $user_id =  $this->db->query("SELECT * FROM user ORDER BY u_id DESC LIMIT 1")->result()[0]->u_id;
        } else {
            $user_id = $res->u_id;
        }


        $information_store_invoice['i_name'] = $this->input->post("f_name");
        $information_store_invoice['i_mobile'] = $this->input->post('phone');
        $information_store_invoice['i_discount'] = 0;
        $information_store_invoice['i_payment'] = 0;
        $information_store_invoice['i_status'] = 5;
        $information_store_invoice['i_type'] = 1;
        $information_store_invoice['i_district'] = $this->input->post("i_district");
        $information_store_invoice['i_thana'] = $this->input->post("i_thana");
        $information_store_invoice['i_address'] = $this->input->post("i_address");
        $information_store_invoice['i_user_id'] = $user_id;
        $information_store_invoice['i_address'] = $this->input->post("i_address");
        $information_store_invoice['i_createdat'] = $newDate;
        $information_store_invoice['i_createdby'] = $user_id;
        $information_store_invoice['i_shipping_cost'] = $shipping_cost;
        $information_store_invoice['i_totalcost'] = $this->cart->total();
        $information_store_invoice['i_total_profit'] = $profit;
        $information_store_invoice['i_update_at'] = '0';

        $res = $this->Common->set_data('invoice', $information_store_invoice);
        $invoice_number = $res + 1000;
        $this->session->set_userdata('invoice_number', $invoice_number);

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
        $this->set_confirmation_msg("TRUE", "Invoice Created successfully.", "Fail to Created successfully.");
        $this->cart->destroy();

        redirect('fontend/Order/complete_order', 'location');
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
}
