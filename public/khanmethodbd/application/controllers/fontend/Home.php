<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $perPage = 20;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common');
        $this->load->model('Frontend');
    }


    public function index()
    {
        $general_settings = ['s_id' => 1];
        $general_settings_list = get_data_single_muli_con("settings", $general_settings);
        $data['title'] = $general_settings_list->s_companyname;
        $slider = ['slider_isdeleted' => 0, 'slider_status' => 1, 'slider_type' => 1];
        $data['main_slider'] = $this->Common->get_data_multi_conditional("slider", $slider);
        $data['slider_banner1'] = $this->Frontend->get_data_single_muli_con("addvertisement", ['ad_isdeleted' => 0, 'ad_status' => 1, 'ad_type' => 'slider banner 1']);
        $data['slider_banner2'] = $this->Frontend->get_data_single_muli_con("addvertisement", ['ad_isdeleted' => 0, 'ad_status' => 1, 'ad_type' => 'slider banner 2']);
        $data['pinned_products'] = $this->Common->get_data_multi_conditional('poducts', ['p_status' => 0, 'p_spin' => 1]);
        $data['middle_banner'] = $this->Frontend->get_data_single_muli_con("addvertisement", ['ad_isdeleted' => 0, 'ad_status' => 1, 'ad_type' => 'middle banner']);
        $data["parPageProduct"] =  $this->perPage;
        if (!empty($this->input->get("page"))) {
            $offset = (int)$this->input->get("page") * $this->perPage;
            $query_result = $this->Frontend->get_data_muli_con_order_limit_offset("poducts", ["p_status" => 0], "p_id", $offset, $this->perPage);
            $data['recent_product'] = $query_result;
            echo $this->load->view('fontend/all_products', $data, TRUE);
        } else {
            $query_result = $this->Frontend->get_data_muli_con_order_limit_offset("poducts", ["p_status" => 0], "p_id", 20, $this->perPage);
            $data['recent_product'] = $query_result;
            $data['main_content'] = $this->load->view('fontend/index', $data, TRUE);
            $this->load->view('fontend/master', $data);
        }
    }
}
