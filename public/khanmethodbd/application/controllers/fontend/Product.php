<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common');
        $this->load->model('Frontend');
    }

    public function category($id)
    {
        $data["categorySingle"] = $this->Common->get_data_single_multi_conditional('categories', ['c_status' => 0, 'c_id' => $id]);

        $category_product = ['p_status' => 0, 'p_category' => $id];
        $data['category_product'] = $this->Common->get_data_multi_conditional("poducts", $category_product);

        $data['category_product_count'] = $this->Common->count_data("poducts", $category_product);
        $data['title'] = $this->Common->get_data_single("categories", "c_id", $id)->c_name;
        $data['main_content'] = $this->load->view('fontend/product/category', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function details($id)
    {

        $data['product_details'] = $this->Common->get_data_single("poducts", "p_id", $id);
        $data['title'] = $data['product_details']->p_tittle;
        $data['main_content'] = $this->load->view('fontend/product/details', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function ads($id)
    {

        $table = "poducts";
        $index = "p_id";
        $identifier = $id;
        $response = $this->Common->get_single_row_information($table, $index, $identifier);
        if ($response->p_quantity > 0) {
            $data = array(
                'id'      => $response->p_id,
                'qty'     => 1,
                'price'   => $response->p_sprice,
                'pp_price'   => $response->p_pprice,
                'name'    => $response->p_tittle

            );
            $this->cart->insert($data);
        }

        $shipping = ['shipping_isdeleted' => 0, 'shipping_status' => 1];
        $data['product_details'] = $this->Common->get_data_single("poducts", "p_id", $id);
        $data['title'] = $data['product_details']->p_tittle;
        $data['shipping'] = $this->Common->get_data_multi_conditional("shipping", $shipping);
        $data['main_content'] = $this->load->view('fontend/product/ads', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }

    public function filter_search()
    {
        $from = $this->input->get('fromPrice');
        $to = $this->input->get('toPrice');
        $data["categorySingle"] = "";
        $category = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0]);
        $category_product = ['p_status' => 0];
        $data['category_product'] = $this->Common->filter_search("poducts", $category_product, $from, $to);
        $data['category_product_count'] = $this->Common->count_filter_search("poducts", $category_product, $from, $to);
        $data['title'] = 'Search';
        $data['main_content'] = $this->load->view('fontend/product/category', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }


    public function search()
    {
        $search = $this->input->get('search');
        $category = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0]);
        $category_product = ['p_status' => 0];
        $data['category_product'] = $this->Common->search("poducts", $category_product, $search);
        $data['category_product_count'] = $this->Common->count_search("poducts", $category_product, $search);
        $data['title'] = 'Search';
        $data['categorySingle'] = '';
        $data['main_content'] = $this->load->view('fontend/product/category', $data, TRUE);
        $this->load->view('fontend/master', $data);
    }
}
