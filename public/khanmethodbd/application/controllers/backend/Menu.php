<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Menu extends CI_Controller
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
        $data['sub_nav'] = 'menu';
        $data['tittle'] = "Dashboard || Home Menu";
        $menu = ['menu_isdeleted' => 0];
        $data['menu_list'] = $this->Common->get_data_multi_conditional("menu", $menu);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/menu/index', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function create_menu()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'menu';
        $data['tittle'] = "Dashboard || Home Menu";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/menu/create', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function check_available_menu()
    {
        $category = $this->input->post('category');
        $data = $this->Common->is__check_where_data_available(["menu_category" => $category, "menu_isdeleted" => 0], "menu");
        echo $data;
    }

    public function menu_store()
    {
        $sliderinformation = array(
            'menu_category' => $this->input->post('category'),
            'menu_status' => 1,
            'menu_isdeleted' => 0,
            'menu_created_by' => $this->session->userdata('currentActiveId'),
        );

        $res = $this->Common->set_data("menu", $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/menu', 'location');
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

    public function menu_edit($id)
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'menu';
        $data['tittle'] = "Dashboard || Home Menu";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['menu'] = $this->Common->get_data_single("menu", "menu_id", $id);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/menu/edit', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function check_update_available_menu()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $data = $this->Common->is__check_where_data_available(["menu_id !=" => $id, "menu_category" => $category, "menu_isdeleted" => 0], "menu");
        echo $data;
    }

    public function menu_update()
    {
        $id = $this->input->post('id');

        $sliderinformation = [
            'menu_category' => $this->input->post('category'),
            'menu_status' => $this->input->post('status'),
            'menu_isdeleted' => 0,
            'menu_created_by' => $this->session->userdata('currentActiveId'),
        ];

        $res = $this->Common->update_data("menu", "menu_id", $id, $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/Menu', 'location');
    }

    public function menu_delete($identifier)
    {
        $update_information = array(
            'menu_isdeleted' => 1
        );
        $res = $this->Common->update_data("menu", "menu_id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");

        redirect('backend/Menu', 'location');
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
