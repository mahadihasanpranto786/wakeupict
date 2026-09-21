<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
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

        $this->load->model('M_client');
        $this->load->model('M_area');
        $this->load->model('M_grade');
        $this->load->model('M_financial_year');
    }

    //Add form for Client Type
    public function clientType()
    {
        $data = $this->engine->store_nav('client', 'client_type', 'Client Type');
        $data['list'] = $this->M_client->getClientType();
        $path = 'backend/setup/client/client_type';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    // Insert Client Type 
    public function insertClientType()
    {
        $ct_title = $this->input->post('ct_title');
        $ct_description = $this->input->post('ct_description');
        $data = array(
            'ct_title' => $ct_title,
            'ct_description' => $ct_description,
            'ct_status' => 1,
            'ct_created_at' => get_current_time(),
            'ct_created_by' => $this->session->userdata('currentActiveId'),
        );

        $id = $this->M_client->insertClientType($data);
        if ($id) {
            set_confirmation_msg('TRUE', 'Your Data has beed added succesfully', '');
        } else {
            set_confirmation_msg('False', '', 'Some thing worng happend.');
        }
        redirect('client_type');
    }


    // edit From view for Client Type
    public function editClientTypeByJason()
    {
        $ct_id = $this->input->get('id');
        $data['client_type'] = $this->M_client->getClientTypeById($ct_id);
        echo json_encode($data);
    }

    // Update Data in client_type table
    public function updateClientType()
    {
        $ct_id = $this->input->post('ct_id');
        $ct_title = $this->input->post('ct_title');
        $ct_description = $this->input->post('ct_description');
        $data = array(
            'ct_id' => $ct_id,
            'ct_title' => $ct_title,
            'ct_description' => $ct_description,
            'ct_updated_at' => get_current_time(),
            'ct_updated_by' => $this->session->userdata('currentActiveId'),
        );

        $this->M_client->updateClientType($ct_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Updated successfully', '');
        redirect('client_type');
    }

    // Delete Data in client_type table
    public function deleteClientType()
    {
        $ct_id = $this->input->get('ct_id');
        $data = array(
            'ct_status' => 0,
            'ct_updated_at' => get_current_time(),
            'ct_updated_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_client->updateClientType($ct_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Deleted successfully', '');
        redirect('client_type');
    }
    //Permanently Delete
    public function permanentlyDeleteClientType()
    {
        $ct_id = $this->input->get('ct_id');
        $this->Common->delete_data('client_type', 'ct_id', $ct_id);
        redirect('client_type');
    }

    // inactive Data in client_type table
    public function inactiveClientType()
    {
        $ct_id = $this->input->get('ct_id');
        $data = array(
            'ct_status' => 0,
            'ct_updated_at' => get_current_time(),
            'ct_updated_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_client->updateClientType($ct_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Inactive successfully', '');
        redirect('client_type');
    }

    // Jute Client Form
    public function addClient()
    {
        $data = $this->engine->store_nav('client', 'add_client', 'Add Client Information');
        $data['client_types'] = $this->M_client->getClientType();
        $data['list'] = $this->M_client->getClient();
        $path = 'backend/setup/client/add_client';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }


    public function insertClient()
    {
        $c_title = $this->input->post('c_title');
        $c_ct_id = $this->input->post('c_ct_id');
        $c_email = $this->input->post('c_email');
        $c_address = $this->input->post('c_address');
        $c_phone = $this->input->post('c_phone');
        $c_licence_no = $this->input->post('c_licence_no');
        $c_initial_due_balance = $this->input->post('c_initial_due_balance');

        $config = array(
            'file_name' => $_FILES['c_img']['name'],
            'upload_path' => "./assets/uploads/client/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => false,
            'max_size' => "204800000", // can be set to particular fil
            'max_height' => "4000",
            'max_width' => "6000",
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('c_img')) {
            $path = $this->upload->data();
            $c_img = "assets/uploads/client/" . $path['file_name'];

            $data = array(
                'c_title' => $c_title,
                'c_ct_id' => $c_ct_id,
                'c_email' => $c_email,
                'c_address' => $c_address,
                'c_phone' => $c_phone,
                'c_licence_no' => $c_licence_no,
                'c_initial_due_balance' => $c_initial_due_balance,
                'c_payable' => $c_initial_due_balance,
                'c_due' => $c_initial_due_balance,
                'c_img' => $c_img,
                'c_status' => 1,
                'c_created_at' => get_current_time(),
                'c_created_by' => $this->session->userdata('currentActiveId'),
            );
        } else {
            $data = array(
                'c_title' => $c_title,
                'c_ct_id' => $c_ct_id,
                'c_email' => $c_email,
                'c_address' => $c_address,
                'c_phone' => $c_phone,
                'c_licence_no' => $c_licence_no,
                'c_initial_due_balance' => $c_initial_due_balance,
                'c_payable' => $c_initial_due_balance,
                'c_due' => $c_initial_due_balance,
                'c_status' => 1,
                'c_created_at' => get_current_time(),
                'c_created_by' => $this->session->userdata('currentActiveId'),
            );
        }
        $id = $this->M_client->insertClient($data);
        if ($id) {
            set_confirmation_msg('TRUE', 'Your Data has been added successfully', '');
        } else {
            set_confirmation_msg('False', '', 'Something wrong happened.');
        }
        // echo "<pre>";
        // print_r($data);
        redirect('jute_client_report');
    }

    // Update 
    public function updateClient()
    {
        $c_id = $this->input->post('c_id');
        $c_title = $this->input->post('c_title');
        $c_ct_id = $this->input->post('c_ct_id');
        $c_email = $this->input->post('c_email');
        $c_address = $this->input->post('c_address');
        $c_phone = $this->input->post('c_phone');
        $c_licence_no = $this->input->post('c_licence_no');
        // $c_initial_due_balance = $this->input->post('c_initial_due_balance');

        $config = array(
            'file_name' => $_FILES['c_img']['name'],
            'upload_path' => "./assets/uploads/client/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => false,
            'max_size' => "204800000", // can be set to particular fil
            'max_height' => "4000",
            'max_width' => "6000",
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('c_img')) {
            $path = $this->upload->data();
            $c_img = "assets/uploads/client/" . $path['file_name'];

            $data = array(
                'c_title' => $c_title,
                'c_ct_id' => $c_ct_id,
                'c_email' => $c_email,
                'c_address' => $c_address,
                'c_phone' => $c_phone,
                'c_licence_no' => $c_licence_no,
                // 'c_initial_due_balance' => $c_initial_due_balance,
                // 'c_payable' => $c_initial_due_balance,
                // 'c_due' => $c_initial_due_balance,
                'c_img' => $c_img,
                'c_updated_at' => get_current_time(),
                'c_updated_by' => $this->session->userdata('currentActiveId'),
            );
        } else {
            $data = array(
                'c_title' => $c_title,
                'c_ct_id' => $c_ct_id,
                'c_email' => $c_email,
                'c_address' => $c_address,
                'c_phone' => $c_phone,
                'c_licence_no' => $c_licence_no,
                // 'c_initial_due_balance' => $c_initial_due_balance,
                // 'c_payable' => $c_initial_due_balance,
                // 'c_due' => $c_initial_due_balance,
                'c_updated_at' => get_current_time(),
                'c_updated_by' => $this->session->userdata('currentActiveId'),
            );
        }
        $this->M_client->updateClient($c_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Updated successfully', '');
        redirect('jute_client_report');
    }
    // Delete Client 
    public function deleteClient()
    {
        $c_id = $this->input->get('c_id');
        $data = array(
            'c_status' => 0,
            'c_updated_at' => get_current_time(),
            'c_updated_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_client->updateClient($c_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Deleted successfully', '');
        redirect('add_client');
    }
    //Permanently Delete
    public function permanentlyDeleteClient()
    {
        $c_id = $this->input->get('c_id');
        $this->Common->delete_data('client', 'c_id', $c_id);
        redirect('add_client');
    }

    // Jute Client Form
    public function juteClientReport()
    {
        $data = $this->engine->store_nav('client', 'jute_client_report', 'Jute Client Report');
        $data['client_types'] = $this->M_client->getClientType();
        $data['list'] = $this->M_client->getClient();
        $path = 'backend/setup/client/jute_client_report';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    // Jute Client Payment
    public function listAllPayment()
    {
        $data = $this->engine->store_nav('client', 'list_all_payment', 'All Payment List');
        $data['client_types'] = $this->M_client->getClientType();
        $data['list'] = $this->M_client->getClient();
        $data['list'] = $this->M_client->getClientPayment();
        $path = 'backend/setup/client/list_all_payment';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    // Client Payment
    public function insertClientPayment()
    {
        $cp_id = $this->input->post('cp_id');
        $cp_c_id = $this->input->post('cp_c_id');
        $cp_reference = $this->input->post('cp_reference');
        $cp_amount = $this->input->post('cp_amount');
        $cp_paid_by = $this->input->post('cp_paid_by');
        $cp_cheque_no = $this->input->post('cp_cheque_no');
        $cp_note = $this->input->post('cp_note');
        $cp_date = $this->input->post('cp_date');
        $cp_date = date("Y-m-d", strtotime($cp_date));
        $cp_fy_id = $this->input->post('cp_fy_id');

        $data = array(
            'cp_id' => $cp_id,
            'cp_c_id' => $cp_c_id,
            'cp_reference' => $cp_reference,
            'cp_amount' => $cp_amount,
            'cp_paid_by' => $cp_paid_by,
            'cp_cheque_no' => $cp_cheque_no,
            'cp_date' => $cp_date,
            'cp_fy_id' => $cp_fy_id,
            'cp_note' => $cp_note,
            'cp_status' => 1,
            'cp_created_at' => get_current_time(),
            'cp_created_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_client->insertClientPayment($data);

        //Update client payment in client table
        // $c_id = $this->input->get('c_id');

        // $c_id = $this->M_client->getClientById($c_id)->c_paid;
        $c_paid = $this->M_client->getClientById($cp_c_id)->c_paid + $cp_amount;
        $c_due = $this->M_client->getClientById($cp_c_id)->c_due - $cp_amount;

        $clientPaymentUpdate = array(
            'c_paid' => $c_paid,
            'c_due' => $c_due,
        );
        $this->M_client->updateClient($cp_c_id, $clientPaymentUpdate);


        redirect('jute_client_report');
    }

    // Client Client update
    public function updateClientPayment()
    {
        $cp_c_id = $this->input->post('cp_c_id');
        $previous_amount = $this->input->post('previous_amount');
        $cp_id = $this->input->post('cp_id');
        $cp_reference = $this->input->post('cp_reference');
        $cp_amount = $this->input->post('cp_amount');
        $cp_paid_by = $this->input->post('cp_paid_by');
        $cp_cheque_no = $this->input->post('cp_cheque_no');
        $cp_note = $this->input->post('cp_note');
        $cp_date = $this->input->post('cp_date');
        $cp_date = date("Y-m-d", strtotime($cp_date));
        $cp_fy_id = $this->input->post('cp_fy_id');

        $data = array(
            'cp_id' => $cp_id,
            'cp_reference' => $cp_reference,
            'cp_amount' => $cp_amount,
            'cp_paid_by' => $cp_paid_by,
            'cp_cheque_no' => $cp_cheque_no,
            'cp_date' => $cp_date,
            'cp_fy_id' => $cp_fy_id,
            'cp_note' => $cp_note,
            'cp_updated_at' => get_current_time(),
            'cp_updated_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_client->updateClientPayment($cp_id, $data);
        $pre_paid = $this->M_client->getClientById($cp_c_id)->c_paid - $previous_amount;
        $pre_due = $this->M_client->getClientById($cp_c_id)->c_due + $previous_amount;
        $x = $pre_paid + $cp_amount;
        $y = $pre_due - $cp_amount;

        $accountUpdate = array(
            'c_paid' => $x,
            'c_due' => $y
        );
        $this->M_client->updateClient($cp_c_id, $accountUpdate);
        redirect("jute_client_wise_payment?c_id=$cp_c_id");
    }

    //Delete Client Payment
    public function deleteClientPayment()
    {
        $cp_id = $this->input->get('cp_id');
        $data = array(
            'cp_id' => $cp_id,
            'cp_status' => 0,
            'cp_updated_at' => get_current_time(),
            'cp_updated_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_client->updateClientPayment($cp_id, $data);
        redirect('list_all_payment');
    }
    // Jute client wise payment
    public function juteClientWisePayment()
    {
        $data = $this->engine->store_nav('client', 'jute_client_wise_payment', 'Jute Client Wise Payment');
        $c_id = $this->input->get('c_id');
        // $cp_id = $this->input->get('cp_id');
        $data['client_types'] = $this->M_client->getClientType();
        $data['list'] = $this->M_client->getClient();
        $data['clientById'] = $this->M_client->getClientById($c_id);
        $data['cPayments'] = $this->M_client->getClientPaymentByClientId($c_id);
        $path = 'backend/setup/client/jute_client_wise_payment';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    //jute client Ledger
    public function juteClientLedger()
    {
        $data = $this->engine->store_nav('client', 'jute_client_ledger', 'Jute Client Ledger');

        // $jss_id = $this->input->get('jss_id');
        // $data['jsSummaryId'] = $jss_id;
        // $data['soldById'] = $this->M_client->getJuteSellById($jss_id);

        $c_id = $this->input->get('c_id');

        $data['cPurchases'] = $this->M_client->getJuteSellSummaryByClientIdAfterApproved($c_id);


        $cp_id = $this->input->get('cp_id');
        $data['client_types'] = $this->M_client->getClientType();
        $data['list'] = $this->M_client->getClient();
        $data['clientById'] = $this->M_client->getClientById($c_id);
        $data['cpView'] = $this->M_client->getClientPaymentById($cp_id);
        $data['cPayments'] = $this->M_client->getClientPaymentByClientId($c_id);
        $path = 'backend/setup/client/jute_client_ledger';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }



    // Financial year
    public function ajaxFinancialYearForClientPayment()
    {
        $date = date("Y-m-d", strtotime($this->input->post('cp_date')));
        $valid = $this->M_khamal->ajaxFinancialYear($date);
        // print_r($valid);
        if ($valid) {
            echo $valid->fy_id;
        } else {
            echo "no";
        }
    }


    /* ============================== Jute Sell Module ============================== */
    // Add Jute Sell
    public function addJuteSell()
    {
        $data = $this->engine->store_nav('jute_sell', 'add_jute_sell', 'Jute Sell');
        // $data['client_types'] = $this->M_client->getClientType();
        // $data['list'] = $this->M_client->getClient();
        $data['areas'] = $this->M_area->getArea();
        $data['jute_grades'] = $this->M_grade->getJuteGrade();
        $data['f_years'] = $this->M_financial_year->getFinancialYear();
        $data['clients'] = $this->M_client->getClient();
        $path = 'backend/setup/client/add_jute_sell';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    // List Jute Sell
    public function listJuteSell()
    {
        $data = $this->engine->store_nav('jute_sell', 'list_jute_sell', 'Jute Sell');
        // $c_id = $this->input->get('c_id');
        $data['list'] = $this->M_client->getJuteSell();
        $data['areas'] = $this->M_area->getArea();
        $data['jute_grades'] = $this->M_grade->getJuteGrade();
        $data['f_years'] = $this->M_financial_year->getFinancialYear();
        $data['clients'] = $this->M_client->getClient();
        $path = 'backend/setup/client/list_jute_sell';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    // View Jute Sell
    public function viewJuteSellInvoice()
    {
        $data = $this->engine->store_nav('jute_sell', 'view_jute_sell_invoice', 'Jute Sell');
        $jss_id = $this->input->get('jss_id');
        $data['jsSummaryId'] = $jss_id;
        $data['soldById'] = $this->M_client->getJuteSellById($jss_id);
        $data['jute_grades'] = $this->M_grade->getJuteGrade();
        $path = 'backend/setup/client/view_jute_sell_invoice';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    //Edit jute sell
    public function editJuteSell()
    {
        $data = $this->engine->store_nav('jute_sell', 'edit_jute_sell', 'Update Jute Sell');
        $jss_id = $this->input->get('jss_id');
        $data['jsSummaryId'] = $jss_id;
        $data['editJS'] = $this->M_client->getJuteSellById($jss_id);
        $data['jute_grades'] = $this->M_grade->getJuteGrade();
        $data['areas'] = $this->M_area->getArea();
        $data['clients'] = $this->M_client->getClient();
        $data['f_years'] = $this->M_financial_year->getFinancialYear();
        $path = 'backend/setup/client/edit_jute_sell';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    public function insertJuteSell()
    {
        // Jute Sell Summary
        $jss_id = $this->input->post('jsv_id');
        $jss_c_id = $this->input->post('jsv_c_id');
        $jss_fy_id = $this->input->post('jsv_fy_id');
        $jss_jute_variety = $this->input->post('jsv_jute_variety');
        $jss_date = $this->input->post('jsv_date');
        $jss_date = date("Y-m-d", strtotime($jss_date));
        $jss_ar_id = $this->input->post('jsv_ar_id');
        $jss_total_weight = $this->input->post('jsv_total_weight');
        $jss_total_amount = $this->input->post('jsv_total_amount');
        $juteSellSummaryData = array(
            'jss_id' => $jss_id,
            'jss_c_id' => $jss_c_id,
            'jss_fy_id' => $jss_fy_id,
            'jss_jute_variety' => $jss_jute_variety,
            'jss_date' => $jss_date,
            'jss_ar_id' => $jss_ar_id,
            'jss_total_weight' => $jss_total_weight,
            'jss_total_amount' => number_format($jss_total_amount, 2, '.', ''),
            'jss_status' => 1,
            'jss_approve_status' => 0,
            'jss_created_at' => get_current_time(),
            'jss_created_by' => $this->session->userdata('currentActiveId')
        );
        $jsSummaryId = $this->M_client->insertJuteSell('jute_sell_summary', $juteSellSummaryData);
        // echo '<pre>';
        // print_r($juteSellSummaryData);
        // Jute Sell Value
        $jsv_id = $this->input->post('jsv_id');
        $jsv_j_g_id = $this->input->post('jsv_j_g_id');
        $jsv_weight = $this->input->post('jsv_weight');
        $jsv_rate = $this->input->post('jsv_rate');
        $jsv_amount = $this->input->post('jsv_amount');

        for ($i = 0; $i < count($jsv_weight); $i++) {
            $jsValueData = array(
                'jsv_id' => $jsv_id,
                'jsv_jss_id' => $jsSummaryId,
                'jsv_j_g_id' => $jsv_j_g_id[$i],
                'jsv_weight' => $jsv_weight[$i],
                'jsv_rate' => $jsv_rate[$i],
                'jsv_amount' => $jsv_amount[$i],
                'jsv_status' => 1,
                'jsv_created_at' => get_current_time(),
                'jsv_created_by' => $this->session->userdata('currentActiveId')
            );
            $this->M_client->insertJuteSell('jute_sell_value', $jsValueData);
            // echo '<pre>';
            // print_r($jsValueData);
        }
        redirect('list_jute_sell');
    }

    //Update Value
    public function updateJuteSell()
    {

        $jsv_weight = $this->input->post('jsv_weight');
        $jsv_rate = $this->input->post('jsv_rate');
        $jsv_amount = $this->input->post('jsv_amount');
        $jsv_value_id = $this->input->post('jsv_value_id');

        for ($i = 0; $i < count($jsv_weight); $i++) {
            $updateData = array(
                'jsv_weight' => $jsv_weight[$i],
                'jsv_rate' => $jsv_rate[$i],
                'jsv_amount' => $jsv_amount[$i],
                'jsv_updated_at' => get_current_time(),
                'jsv_updated_by' => $this->session->userdata('currentActiveId')
            );
            $this->Common->update_data('jute_sell_value', 'jsv_id', $jsv_value_id[$i], $updateData);
        }
        // Jute Sell Summary
        $jss_id = $this->input->post('jsv_id');
        $jss_c_id = $this->input->post('jsv_c_id');
        $jss_fy_id = $this->input->post('jsv_fy_id');
        $jss_jute_variety = $this->input->post('jsv_jute_variety');
        $jss_date = $this->input->post('jsv_date');
        $jss_date = date("Y-m-d", strtotime($jss_date));
        $jss_ar_id = $this->input->post('jsv_ar_id');
        $jss_total_weight = $this->input->post('jsv_total_weight');
        $jss_total_amount = $this->input->post('jsv_total_amount');
        $updateJSSummaryData = array(
            'jss_id' => $jss_id,
            'jss_c_id' => $jss_c_id,
            'jss_fy_id' => $jss_fy_id,
            'jss_jute_variety' => $jss_jute_variety,
            'jss_date' => $jss_date,
            'jss_ar_id' => $jss_ar_id,
            'jss_total_weight' => $jss_total_weight,
            'jss_total_amount' => number_format($jss_total_amount, 2, '.', ''),
            'jss_updated_at' => get_current_time(),
            'jss_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_client->updateJuteSellSummary($jss_id, $updateJSSummaryData);
        redirect('list_jute_sell');
    }

    //Delete Function
    public function deleteJuteSellSummary()
    {
        $jss_id = $this->input->get('jss_id');
        $deleteJSSummaryData = array(
            'jss_status' => 0,
            'jss_updated_at' => get_current_time(),
            'jss_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_client->updateJuteSellSummary($jss_id, $deleteJSSummaryData);
        redirect('list_jute_sell');
    }

    // Financial year
    public function ajaxFinancialYearForJuteSell()
    {
        $date = date("Y-m-d", strtotime($this->input->post('jsv_date')));
        $valid = $this->M_khamal->ajaxFinancialYear($date);
        // print_r($valid);
        if ($valid) {
            echo $valid->fy_id;
        } else {
            echo "no";
        }
    }

    public function approveJuteSellInvoice()
    {
        $jss_id = $this->input->get('jss_id');

        $c_id = $this->M_client->getJuteSellById($jss_id)->jss_c_id;
        $jss_total_amount = $this->M_client->getJuteSellById($jss_id)->jss_total_amount;
        $c_payable = $this->M_client->getClientById($c_id)->c_payable + $jss_total_amount;
        $c_due = $this->M_client->getClientById($c_id)->c_due + $jss_total_amount;


        $approveJSSummaryData = array(
            'jss_approve_status' => 1,
            'jss_updated_at' => get_current_time(),
            'jss_updated_by' => $this->session->userdata('currentActiveId')
        );
        $this->M_client->updateJuteSellSummary($jss_id, $approveJSSummaryData);

        //Payable amount and paid amount and due amount update.
        $clientAccountUpdate = array(
            'c_payable' => $c_payable,
            'c_due' => $c_due
        );
        $this->M_client->updateClient($c_id, $clientAccountUpdate);

        redirect('jute_client_report');
    }




    // Jute Sale Report
    public function totalJuteSaleQuantity()
    {
        $data = $this->engine->store_nav('jute_sell', 'total_jute_sale_quantity', 'Total Jute Sale Quantity');
        $data['list'] = $this->M_client->getJuteSellForTotalQuantity();
        $data['grades'] = $this->M_grade->getJuteGrade();
        $path = 'backend/setup/client/total_jute_sale_quantity';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }






    //End 
}
