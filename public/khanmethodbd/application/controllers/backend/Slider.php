<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
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
        $data['sub_nav'] = 'slider';
        $data['tittle'] = "Dashboard || Slider";
        $slider = ['slider_isdeleted' => 0];
        $data['slider_list'] = $this->Common->get_data_multi_conditional("slider", $slider);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/slider/slider_list', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function create_slider()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'slider';
        $data['tittle'] = "Dashboard || Slider";
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/slider/create_slider', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function slider_store()
    {
        $sliderinformation = array(
            'slider_image' => $this->slider_imgae_upload(),
            'slider_title' => $this->input->post('title'),
            'slider_type' => $this->input->post('type'),
            'slider_status' => 1,
            'slider_isdeleted' => 0,
            'slider_created_by' => $this->session->userdata('currentActiveId'),
        );

        $res = $this->Common->set_data("slider", $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Slider', 'location');
    }

    public function slider_imgae_upload()
    {
        $config['upload_path'] = './assets/storefront/slider/';
        $config['allowed_types'] = '*';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('slider_image')) {
            $error = array('error' => $this->upload->display_errors());
            echo "<script>alert('image does not supported ')</script>";
        } else {
            return $this->upload->data('file_name');
        }
    }

    public function slider_edit($id)
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'slider';
        $data['tittle'] = "Dashboard || Slider";
        $data['slider_list'] = $this->Common->get_data_single("slider", "slider_id", $id);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/slider/edit_slider', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function slider_update()
    {

        $id = $this->input->post('id');
        $upload_image = $this->Common->get_single_row_information("slider", "slider_id", $id)->slider_image;
        $temp_image = $this->slider_imgae_upload();
        if ($temp_image) {
            $upload_image = $temp_image;
        }
        $sliderinformation = [
            'slider_image' => $upload_image,
            'slider_title' => $this->input->post('title'),
            'slider_type' => $this->input->post('type'),
            'slider_status' => $this->input->post('status'),
            'slider_isdeleted' => 0,
            'slider_created_by' => $this->session->userdata('currentActiveId'),
        ];

        $res = $this->Common->update_data("slider", "slider_id", $id, $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Slider', 'location');
    }

    public function slider_delete($identifier)
    {
        $update_information = array(
            'slider_isdeleted' => 1
        );
        $res = $this->Common->update_data("slider", "slider_id", $identifier, $update_information);
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
