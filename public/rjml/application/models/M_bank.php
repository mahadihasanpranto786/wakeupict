<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_bank extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        $returnValue = $this->db->insert_id();
        return $returnValue;
    }

    public function getBank()
    {
        $this->db->order_by('b_title', "ASC");
        $this->db->where('b_status', 1);
        $query = $this->db->get('bank');
        return $query;
    }

    public function getBankById($b_id)
    {
        $this->db->where('b_id', $b_id);
        $query = $this->db->get('bank');
        return $query->row();
    }

    public function updateData($b_id, $data)
    {
        $this->db->where('b_id', $b_id);
        $this->db->update('bank', $data);
    }

    // Branch

    public function getBankBranchById($bb_id)
    {
        $this->db->where('bb_id', $bb_id);
        $this->db->where('bb_status', 1);
        $query = $this->db->get('bank_branch');
        return $query->row();
    }

    public function getBankBranchForDropdown($id, $ab_brance)
    {
        $this->db->where('bb_b_id', $id);
        $this->db->where('bb_status', 1);
        $this->db->order_by('bb_title', "ASC");
        $bank_branch = $this->db->get('bank_branch');
        $result = '<option value="">Select Branch</option>';
        if ($bank_branch) {
            foreach ($bank_branch->result() as $branch) {

                if ($branch->bb_id == $ab_brance) {
                    $is_selected = "selected";
                } else {
                    $is_selected = "";
                }
                $result .= '<option ' . "$is_selected" . '  value="' . $branch->bb_id . '">' . $branch->bb_title . '</option>';
            }
        }
        return $result;
    }

    // public function getBankBranchForDropdownEdit($id)
    // {
    //     $this->db->where('bb_b_id', $id);
    //     $this->db->where('bb_status', 1);
    //     $this->db->order_by('bb_title', "ASC");
    //     $bank_branch = $this->db->get('bank_branch');
    //     $result = '<option value="">Select Branch</option>';
    //     if ($bank_branch) {
    //         foreach ($bank_branch->result() as $branch)
    //             $result .= '<option value="' . $branch->bb_id . '">' . $branch->bb_title . '</option>';
    //         return $result;
    //     }
    // }

    // Get Bank Deposit Account Honour Id
    public function getBankDepositByAccountHonourId($id)
    {
        $this->db->where('bd_status', 1);
        $this->db->where('bd_bacc_id', $id);
        $query = $this->db->get('bank_deposit');
        return $query;
    }
    // Get Bank Withdraw Account Honour Id
    public function getBankWithdrawByAccountHonourId($id)
    {
        $this->db->where('bw_status', 1);
        $this->db->where('bw_bacc_id', $id);
        $query = $this->db->get('bank_withdraw');
        return $query;
    }


    // End
}
