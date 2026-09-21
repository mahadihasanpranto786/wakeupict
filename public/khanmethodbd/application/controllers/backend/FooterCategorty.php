<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FooterCategorty extends CI_Controller
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
        $data['sub_nav'] = 'footer_category';
        $data['tittle'] = "Dashboard || Footer Category";
        $home = ['footer_isdeleted' => 0];
        $data['footer_category'] = $this->Common->get_data_multi_conditional("footer_category", $home);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/footer_category/index', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }

    public function create_footer_category()
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'footer_category';
        $data['tittle'] = "Dashboard || Footer Category";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/footer_category/create', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }


    public function check_available_footer_category()
    {
        $category = $this->input->post('category');
        $data = $this->Common->is__check_where_data_available(["footer_category" => $category, "footer_isdeleted" => 0], "footer_category");
        echo $data;
    }

    public function footer_category_store()
    {
        $sliderinformation = array(
            'footer_title' => $this->input->post('title'),
            'footer_category' => $this->input->post('category'),
            'footer_status' => 1,
            'footer_isdeleted' => 0,
            'footer_created_by' => $this->session->userdata('currentActiveId'),
        );

        $res = $this->Common->set_data("footer_category", $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/FooterCategorty', 'location');
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

    public function footer_category_edit($id)
    {
        $data['main_nav'] = 'appearance';
        $data['sub_nav'] = 'footer_category';
        $data['tittle'] = "Dashboard || Footer Category";
        $data['categories_list'] = $this->Common->get_data_multi_conditional('categories', ['c_status' => 0, 'c_parent' => 0]);
        $data['footer_category'] = $this->Common->get_data_single("footer_category", "footer_id", $id);
        $data['side_menu'] = $this->load->view('backend/admin_view/side_menu', $data, TRUE);
        $data['main_content'] = $this->load->view('backend/admin_view/footer_category/edit', $data, TRUE);
        $this->load->view('backend/admin_view/admin_layout', $data);
    }


    public function check_update_available_footer_category()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $data = $this->Common->is__check_where_data_available(["footer_id !=" => $id, "footer_category" => $category, "footer_isdeleted" => 0], "footer_category");
        echo $data;
    }

    public function footer_category_update()
    {
        $id = $this->input->post('id');

        $sliderinformation = [
            'footer_title' => $this->input->post('title'),
            'footer_category' => $this->input->post('category'),
            'footer_status' => $this->input->post('status'),
            'footer_isdeleted' => 0,
            'footer_created_by' => $this->session->userdata('currentActiveId'),
        ];

        $res = $this->Common->update_data("footer_category", "footer_id", $id, $sliderinformation);

        $this->set_confirmation_msg($res, "Store in System", "Error Occure");

        redirect('backend/FooterCategorty', 'location');
    }

    public function footer_category_delete($identifier)
    {
        $update_information = array(
            'footer_isdeleted' => 1
        );
        $res = $this->Common->update_data("footer_category", "footer_id", $identifier, $update_information);
        $this->set_confirmation_msg($res, "System Updated", "Error Occure");

        redirect('backend/FooterCategorty', 'location');
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
