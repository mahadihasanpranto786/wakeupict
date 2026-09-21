<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Production_unit extends CI_Controller
{
    private $main_layout = '';
    private $side_menu = '';

    public function __construct()
    {
        parent::__construct();
        $this->main_layout = 'backend/master_layout';

        $current_user_type = $this->session->userdata('current_type');
        if ($current_user_type == 10) {
            $this->side_menu = 'backend/authority/operator/side_menu';
        } elseif ($current_user_type == 101) {
            $this->side_menu = 'backend/authority/security_head/side_menu';
        } elseif ($current_user_type == 102) {
            $this->side_menu = 'backend/authority/security_operator/side_menu';
        } elseif ($current_user_type == 201) {
            $this->side_menu = 'backend/authority/weight_head/side_menu';
        } elseif ($current_user_type == 202) {
            $this->side_menu = 'backend/authority/weight_operator/side_menu';
        } elseif ($current_user_type == 301) {
            $this->side_menu = 'backend/authority/jute_head/side_menu';
        } elseif ($current_user_type == 302) {
            $this->side_menu = 'backend/authority/jute_operator/side_menu';
        } elseif ($current_user_type == 401) {
            $this->side_menu = 'backend/authority/accounts_head/side_menu';
        } elseif ($current_user_type == 402) {
            $this->side_menu = 'backend/authority/accounts_operator/side_menu';
        } elseif ($current_user_type == 501) {
            $this->side_menu = 'backend/authority/production_head/side_menu';
        } elseif ($current_user_type == 502) {
            $this->side_menu = 'backend/authority/production_operator/side_menu';
        } elseif ($current_user_type == 601) {
            $this->side_menu = 'backend/authority/gm/side_menu';
        } elseif ($current_user_type == 602) {
            $this->side_menu = 'backend/authority/shareholder/side_menu';
        } elseif ($current_user_type == 603) {
            $this->side_menu = 'backend/authority/system_administrator/side_menu';
        } else {
            $this->session->set_flashdata('login_failed', 'Credential Not match');
            redirect('login', 'location');
        }

        $this->load->model('M_production_unit');
    }
    public function addProductionUnit()
    {
        $data = $this->engine->store_nav('production_unit', 'add_production_unit', 'Add Unit');
        $data['list'] = $this->M_production_unit->getProductionUnit();
        $path = 'backend/jute/production_unit/add_production_unit';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    // Insert Data into database table
    public function insertProductionUnit()
    {
        $pu_id = $this->input->post('pu_id');
        $pu_title = $this->input->post('pu_title');
        $pu_description = $this->input->post('pu_description');
        $data = array(
            'pu_id' => $pu_id,
            'pu_title' => $pu_title,
            'pu_description' => $pu_description,
            'pu_status' => 1,
            'pu_created_at' => get_current_time(),
            'pu_created_by' => $this->session->userdata('currentActiveId')
        );
        $id = $this->M_production_unit->insertProductionUnit($data);
        if ($id) {
            set_confirmation_msg('True', 'Your Data has been added successfully.', '');
        } else {
            set_confirmation_msg('False', '', 'Something wrong happened.');
        }
        redirect('add_production_unit');
    }
    // Update Data from data Table
    public function updateProductionUnit()
    {
        $pu_id = $this->input->post('pu_id');
        $pu_title = $this->input->post('pu_title');
        $pu_description = $this->input->post('pu_description');
        $data = array(
            'pu_id' => $pu_id,
            'pu_title' => $pu_title,
            'pu_description' => $pu_description,
            'pu_created_at' => get_current_time(),
            'pu_created_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_production_unit->updateProductionUnit($pu_id, $data);
        set_confirmation_msg('True', 'Your data has been Updated successfully', '');
        redirect('add_production_unit');
    }
    // Delete Data from data Table
    public function deleteProductionUnit()
    {
        $pu_id = $this->input->get('pu_id');
        $data = array(
            'pu_status' => 0,
            'pu_updated_at' => get_current_time(),
            'pu_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_production_unit->updateProductionUnit($pu_id, $data);
        set_confirmation_msg('True', 'Your data has been Updated successfully', '');
        redirect('add_production_unit');
    }
    // Inactive Data from data Table
    public function inactiveProductionUnit()
    {
        $pu_id = $this->input->get('pu_id');
        $data = array(
            'pu_status' => 0,
            'pu_updated_at' => get_current_time(),
            'pu_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_production_unit->updateProductionUnit($pu_id, $data);
        set_confirmation_msg('True', 'Your data has been Inactivated successfully', '');
        redirect('add_production_unit');
    }
}
