<?php
defined('BASEPATH') or exit('No direct script access allowed');
class HomeCategorty extends CI_Controller
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
        $data['sub_nav'] = 'home_category';
        $data['tittle'] = "Dashboard || Home Category";
        $home = ['home_isdeleted' => 0];
        $data['home_category'] = $this->Common->get_data_multi_conditional("home_category", $home);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/home_category/index', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function create_home_category()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'home_category';
        $data['tittle'] = "Dashboard || Home Category";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/home_category/create', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function check_available_home_category()
    {
        $category = $this->input->post('category');
        $data = $this->Common->is__check_where_data_available(["home_category" => $category, "home_isdeleted" => 0], "home_category");
        echo $data;
    }

    public function home_category_store()
    {
        $sliderinformation = array(
            'home_title' => $this->input->post('title'),
            'home_category' => $this->input->post('category'),
            'home_status' => 1,
            'home_isdeleted' => 0,
            'home_created_by' => $this->session->userdata('currentActiveId'),
        );

        $res = $this->Common->set_data("home_category", $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/HomeCategorty', 'location');
    }

    public function slider_imgae_upload()
    {
        $config['upload_path'] = './assets/storefront/slider/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('slider_image')) {
            $error = array('error' => $this->upload->display_errors());
            echo "<script>alert('image does not supported ')</script>";
        } else {
            return $this->upload->data('file_name');
        }
    }

    public function home_category_edit($id)
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'home_category';
        $data['tittle'] = "Dashboard || Home Category";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['home_category'] = $this->Common->get_data_single("home_category", "home_id", $id);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/home_category/edit', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }


    public function check_update_available_home_category()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $data = $this->Common->is__check_where_data_available(["home_id !=" => $id, "home_category" => $category, "home_isdeleted" => 0], "home_category");
        echo $data;
    }

    public function home_category_update()
    {
        $id = $this->input->post('id');

        $sliderinformation = [
            'home_title' => $this->input->post('title'),
            'home_category' => $this->input->post('category'),
            'home_status' => $this->input->post('status'),
            'home_isdeleted' => 0,
            'home_created_by' => $this->session->userdata('currentActiveId'),
        ];

        $res = $this->Common->update_data("home_category", "home_id", $id, $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/HomeCategorty', 'location');
    }

    public function home_category_delete($identifier)
    {
        $update_information = array(
            'home_isdeleted' => 1
        );
        $res = $this->Common->update_data("home_category", "home_id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");

        redirect('backend/HomeCategorty', 'location');
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
