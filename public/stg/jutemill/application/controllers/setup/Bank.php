<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
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

        $this->load->model('M_bank');
    }

    //Add form for Bank
    public function addBank()
    {
        $data = $this->engine->store_nav('bank', 'add_bank', 'Bank Info');
        $data['list'] = $this->M_bank->getBank();
        $path = 'backend/setup/bank/add_bank';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    // Insert Data in Bank table
    public function insertBank()
    {
        $b_title = $this->input->post('b_title');
        $b_description = $this->input->post('b_description');
        $data = array(
            'b_title' => $b_title,
            'b_description' => $b_description,
            'b_status' => 1,
            'b_created_at' => get_current_time(),
            'b_created_by' => $this->session->userdata('currentActiveId'),
        );

        $id = $this->M_bank->insertData('bank', $data);
        if ($id) {
            set_confirmation_msg('TRUE', 'Your Data has been added successfully', '');
        } else {
            set_confirmation_msg('False', '', 'Some thing wrong happened.');
        }

        redirect('add_bank');
    }

    // edit By Jason
    public function editBankByJason()
    {
        $b_id = $this->input->get('id');
        $data['bank'] = $this->M_bank->getBankById($b_id);
        echo json_encode($data);
    }


    // Update Data in table
    public function updateBank()
    {
        $b_id = $this->input->post('b_id');
        $b_title = $this->input->post('b_title');
        $b_description = $this->input->post('b_description');
        $data = array(
            'b_id' => $b_id,
            'b_title' => $b_title,
            'b_description' => $b_description,
            'b_status' => 1,
            'b_updated_at' => get_current_time(),
            'b_updated_by' => $this->session->userdata('currentActiveId'),
        );

        $this->M_bank->updateData($b_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Updated successfully', '');
        redirect('add_bank');
    }

    // Delete Data from table
    public function deleteBank()
    {
        $b_id = $this->input->get('b_id');
        $data = array(
            'b_status' => 0,
            'b_updated_at' => get_current_time(),
            'b_updated_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_bank->updateData($b_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Deleted successfully', '');
        redirect('add_bank');
    }

    //permanently Delete
    public function permanentlyDeleteBank()
    {
        $b_id = $this->input->get('b_id');
        $this->Common->delete_data('bank', 'b_id', $b_id);
        redirect('add_bank');
    }



    /* ============================ Brance of Bank ============================ */
    //Add 
    public function addBankBranch()
    {
        // x_call();
        $data = $this->engine->store_nav('bank', 'add_bank_branch', 'Bank Branch');
        $data['banks'] = $this->M_bank->getBank();
        $data['branch'] = $this->Common->get_data('bank_branch');
        // x_debug($data['branch']);
        $path = 'backend/setup/bank/add_bank_branch';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    // Insert Data in Bank table
    public function insertBankBranch()
    {
        $bb_title = $this->input->post('bb_title');
        $bb_b_id = $this->input->post('bb_b_id');
        $bb_address = $this->input->post('bb_address');
        $data = array(
            'bb_title' => $bb_title,
            'bb_b_id' => $bb_b_id,
            'bb_address' => $bb_address,
            'bb_status' => 1,
            'bb_created_at' => get_current_time(),
            'bb_created_by' => $this->session->userdata('currentActiveId'),
        );
        $id = $this->M_bank->insertData('bank_branch', $data);
        if ($id) {
            set_confirmation_msg('TRUE', 'Your Data has been added successfully', '');
        } else {
            set_confirmation_msg('False', '', 'Some thing wrong happened.');
        }
        redirect('add_bank_branch');
    }

    // edit By Jason
    public function editBankBranchByJason()
    {
        $bb_id = $this->input->get('id');
        $data['branch'] = $this->M_bank->getBankBranchById($bb_id);
        echo json_encode($data);
    }


    // Update Data in table
    public function updateBankBranch()
    {
        $bb_id = $this->input->post('bb_id');
        $bb_title = $this->input->post('bb_title');
        $bb_b_id = $this->input->post('bb_b_id');
        $bb_address = $this->input->post('bb_address');
        $data = array(
            'bb_title' => $bb_title,
            'bb_b_id' => $bb_b_id,
            'bb_address' => $bb_address,
            'bb_status' => 1,
            'bb_updated_at' => get_current_time(),
            'bb_updated_by' => $this->session->userdata('currentActiveId'),
        );

        $this->Common->update_data('bank_branch', 'bb_id', $bb_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Updated successfully', '');
        redirect('add_bank_branch');
    }

    // Delete Data from table
    public function deleteBankBranch()
    {
        $bb_id = $this->input->get('bb_id');
        $data = array(
            'bb_status' => 0,
            'bb_updated_at' => get_current_time(),
            'bb_updated_by' => $this->session->userdata('currentActiveId'),
        );
        $this->Common->update_data('bank_branch', 'bb_id', $bb_id, $data);
        set_confirmation_msg('TRUE', 'Your Data has been Deleted successfully', '');
        redirect('add_bank_branch');
    }

    //permanently Delete
    public function permanentlyDeleteBankBranch()
    {
        $bb_id = $this->input->get('bb_id');
        $this->Common->delete_data('bank_branch', 'bb_id', $bb_id);
        redirect('add_bank_branch');
    }


    /* ============================ Bank Account Info ============================ */
    //Add 
    public function addBankAccountInfo()
    {
        $data = $this->engine->store_nav('bank', 'add_bank_account_info', 'Bank Account Info');
        $data['banks'] = $this->M_bank->getBank();
        $data['bank_branch'] = $this->Common->get_data_multi_conditional('bank_branch', ['bb_status' => 1]);
        $path = 'backend/setup/bank/add_bank_account_info';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    public function listBankAccountInfo()
    {
        $data = $this->engine->store_nav('bank', 'list_bank_account_info', 'Bank Account Info');
        $data['bank_account_info'] = $this->Common->get_data_multi_conditional('bank_account_info', ['bacc_status' => 1]);
        $path = 'backend/setup/bank/list_bank_account_info';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    //Ajax get branch by bank 
    function getBankBranch()
    {
        if ($this->input->post('branch_id')) {
            echo $this->M_bank->getBankBranchForDropdown($this->input->post('branch_id'));
        }
    }
    //Insert
    public function insertBankAccountInfo()
    {
        $bacc_b_id = $this->input->post('bacc_b_id');
        $bacc_bb_id = $this->input->post('bacc_bb_id');
        $bacc_bank_address = $this->input->post('bacc_bank_address');
        $bacc_name = $this->input->post('bacc_name');
        $bacc_number = $this->input->post('bacc_number');
        $bacc_type = $this->input->post('bacc_type');
        $bacc_balance = $this->input->post('bacc_balance');
        $bacc_cp_name = $this->input->post('bacc_cp_name');
        $bacc_cp_mobile = $this->input->post('bacc_cp_mobile');
        $bacc_cp_post = $this->input->post('bacc_cp_post');
        $data = array(
            'bacc_b_id' => $bacc_b_id,
            'bacc_bb_id' => $bacc_bb_id,
            'bacc_bank_address' => $bacc_bank_address,
            'bacc_name' => $bacc_name,
            'bacc_number' => $bacc_number,
            'bacc_type' => $bacc_type,
            'bacc_opening_balance' => $bacc_balance,
            'bacc_balance' => $bacc_balance,
            'bacc_customerID' => rand(10000000, 99999999),
            'bacc_cp_name' => $bacc_cp_name,
            'bacc_cp_mobile' => $bacc_cp_mobile,
            'bacc_cp_post' => $bacc_cp_post,
            'bacc_status' => 1,
            'bacc_created_at' => get_current_time(),
            'bacc_created_by' => $this->session->userdata('currentActiveId'),
        );
        $id = $this->M_bank->insertData('bank_account_info', $data);
        if ($id) {
            set_confirmation_msg('TRUE', 'Your Data has been added successfully', '');
        } else {
            set_confirmation_msg('False', '', 'Some thing wrong happened.');
        }
        redirect('list_bank_account_info');
    }

    //permanently Delete Account
    public function permanentlyDeleteBankAccountInfo()
    {
        $bacc_id = $this->input->get('bacc_id');
        $this->Common->delete_data('bank_account_info', 'bacc_id', $bacc_id);
        redirect('list_bank_account_info');
    }


    /* ============================ Bank Deposit ============================ */
    public function addBankDeposit()
    {
        $data = $this->engine->store_nav('bank', 'add_bank_deposit', 'Bank Deposit');
        $data['bank_account_info'] = $this->Common->get_data_multi_conditional('bank_account_info', ['bacc_status' => 1]);
        $path = 'backend/setup/bank/add_bank_deposit';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }
    public function viewBankDepositAccountWise()
    {
        $data = $this->engine->store_nav('bank', 'view_bank_deposit_account_wise', 'View Bank Deposit');
        $bacc_id = $this->input->get('bacc_id');
        $data['depositById'] = $this->Common->get_single_row_information('bank_account_info', 'bacc_id', $bacc_id);
        $data['bankDeposits'] = $this->M_bank->getBankDepositByAccountHonourId($bacc_id);
        $path = 'backend/setup/bank/view_bank_deposit_account_wise';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    //add Deposit
    public function insertBankDeposit()
    {
        $bd_bacc_id = $this->input->post('bd_bacc_id');
        $bd_reference = $this->input->post('bd_reference');
        $bd_amount = $this->input->post('bd_amount');
        $bd_deposit_by = $this->input->post('bd_deposit_by');
        $bd_cheque_no = $this->input->post('bd_cheque_no');
        $bd_note = $this->input->post('bd_note');
        $bd_date = $this->input->post('bd_date');
        $bd_date = date("Y-m-d", strtotime($bd_date));

        //update Account Balance
        $bacc_balance = $this->Common->get_single_row_information('bank_account_info', 'bacc_id', $bd_bacc_id)->bacc_balance + $bd_amount; // Present Balance + New Deposit
        $bacc_credit_balance = $this->Common->get_single_row_information('bank_account_info', 'bacc_id', $bd_bacc_id)->bacc_credit_balance + $bd_amount; // Present Balance + New Deposit

        $data = array(
            'bd_bacc_id' => $bd_bacc_id,
            'bd_reference' => $bd_reference,
            'bd_amount' => $bd_amount,
            'bd_available_balance' => $bacc_balance,
            'bd_deposit_by' => $bd_deposit_by,
            'bd_cheque_no' => $bd_cheque_no,
            'bd_date' => $bd_date,
            'bd_note' => $bd_note,
            'bd_status' => 1,
            'bd_created_at' => get_current_time(),
            'bd_created_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_bank->insertData('bank_deposit', $data);

        $accountUpdate = array(
            'bacc_balance' => $bacc_balance,
            'bacc_credit_balance' => $bacc_credit_balance
        );
        $this->Common->update_data('bank_account_info', 'bacc_id', $bd_bacc_id, $accountUpdate); // Update Table
        redirect('add_bank_deposit');
    }

    /* ============================ Bank Withdraw ============================ */
    public function viewBankWithdrawAccountWise()
    {
        $data = $this->engine->store_nav('bank', 'view_bank_withdraw_account_wise', 'View Bank Withdraw');
        $bacc_id = $this->input->get('bacc_id');
        $data['withdrawById'] = $this->Common->get_single_row_information('bank_account_info', 'bacc_id', $bacc_id);
        $data['bankWithdraws'] = $this->M_bank->getBankWithdrawByAccountHonourId($bacc_id);
        $path = 'backend/setup/bank/view_bank_withdraw_account_wise';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }

    public function insertBankWithdrawBalance()
    {
        $bw_bacc_id = $this->input->post('bw_bacc_id');
        $bw_reference = $this->input->post('bw_reference');
        $bw_amount = $this->input->post('bw_amount');
        $bw_withdraw_by = $this->input->post('bw_withdraw_by');
        $bw_cheque_no = $this->input->post('bw_cheque_no');
        $bw_note = $this->input->post('bw_note');
        $bw_date = $this->input->post('bw_date');
        $bw_date = date("Y-m-d", strtotime($bw_date));

        //update Account Balance
        $bacc_balance = $this->Common->get_single_row_information('bank_account_info', 'bacc_id', $bw_bacc_id)->bacc_balance - $bw_amount; // Main Balance - New Withdraw Balance
        $bacc_debit_balance = $this->Common->get_single_row_information('bank_account_info', 'bacc_id', $bw_bacc_id)->bacc_debit_balance + $bw_amount; // Total debit Balance + New Withdraw Balance

        $data = array(
            'bw_bacc_id' => $bw_bacc_id,
            'bw_reference' => $bw_reference,
            'bw_amount' => $bw_amount,
            'bw_available_balance' => $bacc_balance,
            'bw_withdraw_by' => $bw_withdraw_by,
            'bw_cheque_no' => $bw_cheque_no,
            'bw_date' => $bw_date,
            'bw_note' => $bw_note,
            'bw_status' => 1,
            'bw_created_at' => get_current_time(),
            'bw_created_by' => $this->session->userdata('currentActiveId'),
        );
        $this->M_bank->insertData('bank_withdraw', $data);

        $accountUpdate = array(
            'bacc_balance' => $bacc_balance,
            'bacc_debit_balance' => $bacc_debit_balance
        );
        $this->Common->update_data('bank_account_info', 'bacc_id', $bw_bacc_id, $accountUpdate); // Update Table
        redirect('add_bank_deposit');
    }



    /* ============================ Bank Ledger ============================ */
    public function viewBankAccountLedger()
    {
        $data = $this->engine->store_nav('bank', 'view_bank_account_ledger', 'Account Ledger');
        $bacc_id = $this->input->get('bacc_id');
        $data['bankInfo'] = $this->Common->get_single_row_information('bank_account_info', 'bacc_id', $bacc_id);
        $data['bankDeposits'] = $this->M_bank->getBankDepositByAccountHonourId($bacc_id);
        $data['bankWithdraws'] = $this->M_bank->getBankWithdrawByAccountHonourId($bacc_id);
        $path = 'backend/setup/bank/view_bank_account_ledger';
        $this->engine->render_view($data, $path, $this->side_menu, $this->main_layout);
    }





    //End
}
