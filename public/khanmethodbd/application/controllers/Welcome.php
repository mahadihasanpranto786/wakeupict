<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
            $offset = $this->pagination_offset($this->perPage);
            $query_result = $this->Frontend->get_data_muli_con_order_limit_offset("poducts", ["p_status" => 0], "p_id",  $this->perPage, $offset);
            $data['recent_product'] = $query_result;
            echo $this->load->view('fontend/all_products', $data, TRUE);
        } else {
            $query_result = $this->Frontend->get_data_muli_con_order_limit_offset("poducts", ["p_status" => 0], "p_id", $this->perPage, 0);
            $data['recent_product'] = $query_result;
            $data['main_content'] = $this->load->view('fontend/index', $data, TRUE);
            $this->load->view('fontend/master', $data);
        }
    }
    function pagination_offset($par_page_data)
    {
        $offset = 0;
        if ($this->input->get("page")) {
            $offset = ($this->input->get("page") - 1) *  $par_page_data;
        }
        return $offset;
    }
    public function sms()
    {


        $user_Number = '8801737499550';
        $user_sms = "test";
        //sent_sms($user_Number,$user_sms);
        $url = 'https://api.infobip.com/sms/1/text/query?' . http_build_query(
            [
                'username' =>  'type2arif',
                'password' => '25$#%@iiiUxIIIiii(*&uuu25',
                'to' => $user_Number,
                'text' => $user_sms,
            ]
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return 'yes';
    }
}
