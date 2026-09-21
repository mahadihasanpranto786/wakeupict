<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mokam extends CI_Controller
{
    private $main_layout = '';
    private $side_menu = '';


    public function __construct()
    {
        parent::__construct();
        $this->main_layout = 'backend/master_layout';

        $current_user_type = $this->session->userdata('current_type');
        if ($current_user_type == 1) {
            $this->side_menu = 'backend/authority/administration/side_menu';
        } elseif ($current_user_type == 10) {
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

        $this->load->model('M_area');
        $this->load->model('M_mokam');
    }

    // Add New From view for Mokam
    public function addMokam()
    {
        $data = $this->engine->store_nav('setup', 'add_mokam', 'Add Mokam');
        $data['areas'] = $this->M_area->getAreaLimited();
        $data['list'] = $this->M_mokam->getMokam();
        $path = 'backend/setup/mokam/add_mokam';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    // Insert Data in database table
    public function insertMokam()
    {
        $mo_title = $this->input->post('mo_title');
        $mo_ar_id = $this->input->post('mo_ar_id');
        $data = array(
            'mo_title' => $mo_title,
            'mo_ar_id' => $mo_ar_id,
            'mo_status' => 1,
            'mo_created_at' => get_current_time(),
            'mo_created_by' => $this->session->userdata('currentActiveId')
        );

        $id = $this->M_mokam->insertMokam($data);
        if ($id) {
            set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
        } else {
            set_confirmation_msg('False', '', 'Some thing worng happend.');
        }

        redirect('add_mokam');
    }

    // edit From view for Mokam
    function editMokamByJason()
    {
        $mo_id = $this->input->get('id');
        $data['mokam'] = $this->M_mokam->getMokamById($mo_id);
        echo json_encode($data);
    }

    // Update Data in database table
    public function updateMokam()
    {
        $mo_id = $this->input->post('mo_id');
        $mo_title = $this->input->post('mo_title');
        $mo_ar_id = $this->input->post('mo_ar_id');
        $data = array(
            'mo_id' => $mo_id,
            'mo_title' => $mo_title,
            'mo_status' => 1,
            'mo_ar_id' => $mo_ar_id,
            'mo_updated_at' => get_current_time(),
            'mo_updated_by' => $this->session->userdata('currentActiveId')
        );

        $this->M_mokam->updateMokam($mo_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has beed Updated succesfully', '');
        redirect('add_mokam');
    }

    // Delete Data in database table
    public function deleteMokam()
    {
        $mo_id = $this->input->get('mo_id');
        $data = array(
            'mo_status' => 0,
            'mo_updated_at' => get_current_time(),
            'mo_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_mokam->updateMokam($mo_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has beed Deleted succesfully', '');
        redirect('add_mokam');
    }

    //Permanently Delete
    public function permanentlyDeleteMokam()
    {
        $mo_id = $this->input->get('mo_id');
        $this->Common->delete_data('mokam', 'mo_id', $mo_id);
        set_confirmation_msg('TRUE', 'Your data has been Permanently Deleted successfully', '');
        redirect('add_mokam');
    }

    // Delete Data in database table
    public function inactiveMokam()
    {
        $mo_id = $this->input->get('mo_id');
        $data = array(
            'mo_status' => 0,
            'mo_updated_at' => get_current_time(),
            'mo_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_mokam->updateMokam($mo_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has beed Inactive succesfully', '');
        redirect('add_mokam');
    }
}
