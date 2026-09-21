<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grade extends CI_Controller
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

        $this->load->model('M_grade');
    }

    public function addJuteGrade()
    {
        $current_user_type = $this->session->userdata('current_type');
        $buttonSeePeople = array(601, 602, 603);
        if (in_array($current_user_type, $buttonSeePeople)) {
            $data = $this->engine->store_nav('setup', 'add_jute_grade', 'Add Jute Grade');
        } else {
            $data = $this->engine->store_nav('grade', 'add_jute_grade', 'Add Jute Grade');
        }
        $data['list'] = $this->M_grade->getJuteGrade();
        $path = 'backend/setup/grade/add_jute_grade';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    // Insert Data in database table
    public function insertJuteGrade()
    {
        $j_g_title = $this->input->post('j_g_title');
        $j_g_description = $this->input->post('j_g_description');
        $data = array(
            'j_g_title' => $j_g_title,
            'j_g_description' => $j_g_description,
            'j_g_status' => 1,
            'j_g_created_at' => get_current_time(),
            'j_g_created_by' => $this->session->userdata('currentActiveId')
        );

        $id = $this->M_grade->insertJuteGrade($data);
        if ($id) {
            set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
        } else {
            set_confirmation_msg('False', '', 'Some thing worng happend.');
        }

        redirect('add_jute_grade');
    }

    // edit From view for JuteGrade
    function editJuteGradeByJason()
    {
        $j_g_id = $this->input->get('id');
        $data['jute_grade'] = $this->M_grade->getJuteGradeById($j_g_id);
        echo json_encode($data);
    }

    // Update Data in database table
    public function updateJuteGrade()
    {
        $j_g_id = $this->input->post('j_g_id');
        $j_g_title = $this->input->post('j_g_title');
        $j_g_description = $this->input->post('j_g_description');
        $data = array(
            'j_g_id' => $j_g_id,
            'j_g_title' => $j_g_title,
            'j_g_status' => 1,
            'j_g_description' => $j_g_description,
            'j_g_updated_at' => get_current_time(),
            'j_g_updated_by' => $this->session->userdata('currentActiveId')
        );

        $this->M_grade->updateJuteGrade($j_g_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has beed Updated succesfully', '');
        redirect('add_jute_grade');
    }

    // Delete Data in database table
    public function deleteJuteGrade()
    {
        $j_g_id = $this->input->get('j_g_id');
        $data = array(
            'j_g_status' => 0,
            'j_g_updated_at' => get_current_time(),
            'j_g_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_grade->updateJuteGrade($j_g_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has beed Deleted succesfully', '');
        redirect('add_jute_grade');
    }

    //Permanently Delete
    public function permanentlyDeleteJuteGrade()
    {
        $j_g_id = $this->input->get('j_g_id');
        $this->Common->delete_data('jute_grade', 'j_g_id', $j_g_id);
        set_confirmation_msg('TRUE', 'Your data has been Permanently Deleted successfully', '');
        redirect('add_jute_grade');
    }

    // Delete Data in database table
    public function inactiveJuteGrade()
    {
        $j_g_id = $this->input->get('j_g_id');
        $data = array(
            'j_g_status' => 0,
            'j_g_updated_at' => get_current_time(),
            'j_g_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_grade->updateJuteGrade($j_g_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has beed Inactive succesfully', '');
        redirect('add_jute_grade');
    }
}
