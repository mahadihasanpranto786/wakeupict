<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jute_rate extends CI_Controller
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
        $this->load->model('M_grade');
        $this->load->model('M_jute_rate');
        $this->load->model('M_financial_year');
    }

    public function addJuteRate()
    {
        $data = $this->engine->store_nav('jute_rate', 'add_jute_rate', 'Add jute rate');

        $data['list'] = $this->M_jute_rate->getJuteRateByLastId();
        $data['grades'] = $this->M_grade->getJuteGrade();
        $data['areas'] = $this->M_area->getArea();
        $data['financial_years'] = $this->M_financial_year->getFinancialYear();

        $path = 'backend/setup/jute_rate/add_jute_rate';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    public function insertJuteRate()
    {
        $jrs_fy_id = $this->input->post('jrs_fy_id');
        $jrs_sl_no = $this->input->post('jrs_sl_no');

        $jrs_start_date = $this->input->post('jrs_start_date');
        $jrs_start_time = $this->input->post('jrs_start_time');

        $jrs_start_date = date("Y-m-d H:i:s", strtotime("$jrs_start_date $jrs_start_time"));

        $lastDateOfFy = $this->M_financial_year->getFinancialYearById($jrs_fy_id)->fy_end_date;
        $jrs_end_time = date("H:i:s", strtotime($jrs_start_time . " -1 minutes"));
        $jrs_end_date = date("Y-m-d H:i:s", strtotime("$lastDateOfFy $jrs_end_time"));

        //update data in jute_rate_summary table
        $foirUpdatedOldEndDate = date("Y-m-d", strtotime(date($jrs_start_date)));
        $foirUpdatedOldEndDate = date("Y-m-d H:i:s", strtotime("$foirUpdatedOldEndDate $jrs_end_time"));

        $updatedOldEndDate = array(
            'jrs_end_date' => $foirUpdatedOldEndDate,
            'jrs_activity' => 0,
            'jrs_updated_by' => $this->session->userdata('currentActiveId'),
            'jrs_updated_at' => get_current_time()
        );
        $this->M_jute_rate->updatedOldEndDate($updatedOldEndDate, $jrs_fy_id);

        // $previousStartDate = $this->M_jute_rate->gatePreviousStartDate($jrs_start_date)->jrs_start_date;
        // echo $updatedOldTransectionDate;
        // die();

        $juteRateSummaryData = array(
            'jrs_title' => 'abc',
            'jrs_sl_no' => $jrs_sl_no,
            'jrs_description' => 'abc',
            // 'jrs_date' => $jrs_date,
            'jrs_fy_id' => $jrs_fy_id,
            'jrs_start_date' => $jrs_start_date,
            'jrs_end_date' => $jrs_end_date,
            'jrs_activity' => 1,
            'jrs_status' => 1,
            'jrs_created_by' => $this->session->userdata('currentActiveId'),
            'jrs_created_at' => get_current_time(),
        );

        // echo '<pre>';
        // print_r($juteRateSummaryData);

        $jrs_id = $this->M_jute_rate->insertJuteRateSummary($juteRateSummaryData);

        //for insert data in jute_rate table
        $area = $this->M_area->getArea()->result();
        $areaCountDB = count($area);

        $areaID = $this->input->post('areaID');
        $gradeId = $this->input->post('gradeId');
        $juteRate = $this->input->post('juteRate');
        $rateCount = count($juteRate);

        // To get correct ids
        $assingAID = 1;
        $aid = $assingAID;
        $gid = 0;
        $cc = 0;

        for ($r = 0; $r < $rateCount; $r++) {
            $cc++;
            $juteRateData = array(
                'jr_jrs_id' => $jrs_id,
                'jr_ar_id' => $areaID[$aid - 1],
                'jr_j_g_id' => $gradeId[$gid],
                'jr_rate' => $juteRate[$r],
                'jr_status' => 1,
                // 'Count' => $cc
                'jr_created_by' => $this->session->userdata('currentActiveId'),
                'jr_created_at' => get_current_time(),
            );

            if ($aid < $areaCountDB) {
                $aid++;
            } else {
                $gid++;
                $aid = $assingAID;
            }

            $this->M_jute_rate->insertJuteRate($juteRateData);

            // echo '<pre>';
            // print_r($juteRateData);
        }

        //for insert data in jute_rate_moisture table
        $newM = $this->input->post('new');
        $newCount = count($newM);
        $oldM = $this->input->post('old');

        for ($m = 0; $m < $newCount; $m++) {
            $cc++;
            $juteRateMoistureData = array(
                'jr_m_jrs_id' => $jrs_id,
                'jr_m_ar_id' => $areaID[$aid - 1],
                'jr_m_new' => $newM[$m],
                'jr_m_old' => $oldM[$m],
                'jr_m_status' => 1,
                'jr_m_created_by' => $this->session->userdata('currentActiveId'),
                'jr_m_created_at' => get_current_time(),
            );

            if ($aid < $areaCountDB) {
                $aid++;
            } else {
                $aid = $assingAID;
            }

            $this->M_jute_rate->insertJuteRateMoisture($juteRateMoistureData);

            // echo '<pre>';
            // print_r($juteRateMoistureData);
        }

        //for insert data in jute_rate_smr table
        $jr_smr_per_from = $this->input->post('jr_smr_per_from');
        $jr_smr_logic_from = $this->input->post('jr_smr_logic_from');
        $jr_smr_per_till = $this->input->post('jr_smr_per_till');
        $jr_smr_logic_till = $this->input->post('jr_smr_logic_till');
        $d_rate = $this->input->post('d_rate');

        // removing server error 23.8.22
        if ($jr_smr_per_from) {
            $outTurnPerCount = count($jr_smr_per_from);
            for ($otp = 0; $otp < $outTurnPerCount; $otp++) {
                $juteRateSmrData = array(
                    'jr_smr_jrs_id' => $jrs_id,
                    'jr_smr_ar_id' => 'abc',
                    'jr_smr_j_g_id' => 'abc',
                    'jr_smr_per_from' => $jr_smr_per_from[$otp],
                    'jr_smr_logic_from' => $jr_smr_logic_from[$otp],
                    'jr_smr_per_till' => $jr_smr_per_till[$otp],
                    'jr_smr_logic_till' => $jr_smr_logic_till[$otp],
                    'jr_smr_rate' =>  $d_rate[$otp],
                    'jr_smr_status' =>  1,
                    'jr_smr_created_by' =>  $this->session->userdata('currentActiveId'),
                    'jr_smr_created_at' =>  get_current_time()
                );

                $this->M_jute_rate->insertJuteRateSmr($juteRateSmrData);

                // echo '<pre>';
                // print_r($juteRateSmrData);
            }
        }
        set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
        redirect('list_jute_rate');
    }

    public function listJuteRate()
    {
        $data = $this->engine->store_nav('jute_rate', 'list_jute_rate', 'Jute Rate Sheets');
        $data['list'] = $this->M_jute_rate->getJuteRate();
        $path = 'backend/setup/jute_rate/list_jute_rate';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    public function viewJuteRate()
    {
        $data = $this->engine->store_nav('jute_rate', 'view_jute_rate', 'Jute Rate Sheet');

        $jrs_id = $this->input->get('jrs_id');
        $data['juteRateSumaryID'] = $jrs_id;
        $data['summary'] = $this->M_jute_rate->getJuteRateByJrsId($jrs_id);
        $data['grades'] = $this->M_grade->getJuteGrade();
        $data['areas'] = $this->M_area->getArea();
        $data['deductions'] = $this->M_jute_rate->getSmrDeductionsByJrsId($jrs_id);
        $path = 'backend/setup/jute_rate/view_jute_rate';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    //Permanently Delete
    public function permanentlyDeleteJuteRate()
    {
        $jrs_id = $this->input->get('jrs_id');
        $jrs_fy_id = $this->M_jute_rate->getJuteRateByJrsId($jrs_id)->jrs_fy_id;
        $jrs_sl_no = $this->M_jute_rate->getJuteRateByJrsId($jrs_id)->jrs_sl_no;
        $update_jrs_sl_no = $jrs_sl_no - 1;

        //$this->Common->delete_data('jute_rate_summary', 'jrs_id', $jrs_id);
        $deleteData = array(
            'jrs_activity' => 0,
            'jrs_status' => 0,
            'jrs_updated_by' => $this->session->userdata('currentActiveId'),
            'jrs_updated_at' => get_current_time()
        );
        $this->M_jute_rate->deleteJuteRate($jrs_id, $deleteData);

        $delete_jute_rate_moisture = array(
            'jr_m_status' => 0,
            'jr_m_updated_by' => $this->session->userdata('currentActiveId'),
            'jr_m_updated_at' => get_current_time()
        );

        $this->Common->update_data('jute_rate_moisture', 'jr_m_jrs_id', $jrs_id, $delete_jute_rate_moisture);

        $delete_jute_rate_smr = array(
            'jr_smr_status' => 0,
            'jr_smr_updated_by' => $this->session->userdata('currentActiveId'),
            'jr_smr_updated_at' => get_current_time()
        );

        $this->Common->update_data('jute_rate_smr', 'jr_smr_jrs_id', $jrs_id, $delete_jute_rate_smr);

        $delete_jute_rate = array(
            'jr_status' => 0,
            'jr_updated_by' => $this->session->userdata('currentActiveId'),
            'jr_updated_at' => get_current_time()
        );
        $this->Common->update_data('jute_rate', 'jr_jrs_id', $jrs_id, $delete_jute_rate);


        //update data in jute_rate_summary table
        $jrs_start_date = $this->M_jute_rate->getJuteRateByJrsSlNO($update_jrs_sl_no, $jrs_fy_id)->jrs_start_date;


        $jrs_start_time = date("H:i:s", strtotime($jrs_start_date));
        $lastDateOfFy = $this->M_financial_year->getFinancialYearById($jrs_fy_id)->fy_end_date;
        $jrs_end_time = date("H:i:s", strtotime($jrs_start_time . " -1 minutes"));
        $jrs_end_date = date("Y-m-d H:i:s", strtotime("$lastDateOfFy $jrs_end_time"));

        //update data in jute_rate_summary table
        //$foirUpdatedOldEndDate = date("Y-m-d", strtotime(date($jrs_start_date) . " - 1 day"));
        //$foirUpdatedOldEndDate = date("Y-m-d H:i:s", strtotime("$foirUpdatedOldEndDate $jrs_end_time"));


        //$jrs_end_date = date("Y-m-d", strtotime(date($jrs_start_date) . " + 365 day"));

        $updatedDate = array(
            'jrs_end_date' => $jrs_end_date,
            'jrs_activity' => 1,
            'jrs_updated_by' => $this->session->userdata('currentActiveId'),
            'jrs_updated_at' => get_current_time()
        );
        $this->M_jute_rate->updateDataBySerialNo($update_jrs_sl_no, $jrs_fy_id, $updatedDate);


        set_confirmation_msg('TRUE', 'Your data has been Permanently Deleted successfully', '');
        redirect('list_jute_rate');
    }






    //Financial Year Get
    public function ajaxFinancialYear()
    {
        $jrs_start_date = date("Y-m-d", strtotime($this->input->post('jrs_start_date')));
        $valid = $this->M_jute_rate->ajaxFinancialYear($jrs_start_date);

        // print_r($valid);
        if ($valid) {
            $fy_id = $valid->fy_id;
            $last_rate_sl = $this->M_jute_rate->getJuteRateSlByFyId($valid->fy_id);
            $new_rate_sl = $last_rate_sl + 1;

            $data = array(
                'fy_id' => $fy_id,
                'new_rate_sl' => $new_rate_sl
            );
            echo json_encode($data);
        } else {
            echo "no";
        }
    }


    // Check Serial Number
    public function ajaxSerialNumberCheckForJuteRate()
    {
        $jrs_sl_no = $this->input->post('jrs_sl_no');
        $conditions = array(
            'jrs_sl_no' => $jrs_sl_no,
            'jrs_status' => 1,
        );
        $valid = $this->M_jute_rate->ajaxSerialNumberCheckForJuteRate($conditions);
        echo $valid;
    }


    //Edit Jute Rate
    public function editJuteRate()
    {
        $data = $this->engine->store_nav('jute_rate', 'view_jute_rate', 'Jute Rate Sheet');

        $jrs_id = $this->input->get('jrs_id');
        $data['juteRateSumaryID'] = $jrs_id;
        $data['summary'] = $this->M_jute_rate->getJuteRateByJrsId($jrs_id);
        $data['grades'] = $this->M_grade->getJuteGrade();
        $data['areas'] = $this->M_area->getArea();
        $data['deductions'] = $this->M_jute_rate->getSmrDeductionsByJrsId($jrs_id);
        $path = 'backend/setup/jute_rate/edit_jute_rate';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }




    //End
}
