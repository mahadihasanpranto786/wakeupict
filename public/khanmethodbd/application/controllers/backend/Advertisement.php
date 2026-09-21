<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Advertisement extends CI_Controller
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
        $data['sub_nav'] = 'advertisement';
        $data['tittle'] = "Dashboard || Advertisement";
        $advertisement = ['ad_isdeleted' => 0];
        $data['advertisement_list'] = $this->Common->get_data_multi_conditional("addvertisement", $advertisement);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/add/index', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function create_slider()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'add';
        $data['tittle'] = "Dashboard || Advertisement";
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

    public function advertisement_edit($id)
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'add';
        $data['tittle'] = "Dashboard || Advertisement";
        $data['advertisement_list'] = $this->Common->get_data_single("addvertisement", "ad_id", $id);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/add/edit_advertisement', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function advertisement_update()
    {
        $id = $this->input->post('id');
        $upload_image = $this->Common->get_single_row_information("addvertisement", "ad_id", $id)->ad_image;

        $config['upload_path'] = './assets/storefront/advertisement/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('add_image')) {
            $upload_image = $upload_image;
        } else {
            $upload_image =  $this->upload->data('file_name');
        }
        $advertisementinformation = [
            'ad_image' => $upload_image,
            'ad_title1' => $this->input->post('title1'),
            'ad_title2' => $this->input->post('title2'),
            'ad_link' => $this->input->post('link'),
            'ad_status' => $this->input->post('status'),
            'ad_isdeleted' => 0,
            'ad_created_by' => $this->session->userdata('currentActiveId'),
        ];

        $res = $this->Common->update_data("addvertisement", "ad_id", $id, $advertisementinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Advertisement', 'location');
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
