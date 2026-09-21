<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feature extends CI_Controller
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

    public function index()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'feature';
        $data['tittle'] = "Dashboard || Feature";
        $feature = ['feature_isdeleted' => 0];
        $data['feature_list'] = $this->Common->get_data_multi_conditional("feature", $feature);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/feature/index', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function create_slider()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'feature';
        $data['tittle'] = "Dashboard || Feature";
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/slider/create_slider', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function slider_store()
    {
        $advertisementinformation = array(
            'slider_image' => $this->slider_imgae_upload(),
            'slider_title' => $this->input->post('title'),
            'slider_type' => $this->input->post('type'),
            'slider_status' => 1,
            'advertisement_isdeleted' => 0,
            'slider_created_by' => $this->session->userdata('currentActiveId'),
        );

        $res = $this->Common->set_data("add", $advertisementinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Slider', 'location');
    }

    public function slider_imgae_upload()
    {
        $config['upload_path'] = './assets/storefront/advertisement/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('add_image')) {
            $error = array('error' => $this->upload->display_errors());
            echo "<script>alert('image does not supported ')</script>";
        } else {
            return $this->upload->data('file_name');
        }
    }

    public function feature_edit($id)
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'feature';
        $data['tittle'] = "Dashboard || Feature";
        $data['feature_list'] = $this->Common->get_data_single("feature", "feature_id", $id);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/feature/edit_feature', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function feature_update()
    {
        $id = $this->input->post('id');

        $featureinformation = [
            'feature_icone' => $this->input->post('icone'),
            'feature_title1' => $this->input->post('title1'),
            'feature_title2' => $this->input->post('title2'),
            'feature_status' => $this->input->post('status'),
            'feature_isdeleted' => 0,
            'feature_created_by' => $this->session->userdata('currentActiveId'),
        ];

        $res = $this->Common->update_data("feature", "feature_id", $id, $featureinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Feature', 'location');
    }

    public function slider_delete($identifier)
    {
        $update_information = array(
            'advertisement_isdeleted' => 1
        );
        $res = $this->Common->update_data("add", "slider_id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");
        redirect('backend/Slider', 'location');
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
