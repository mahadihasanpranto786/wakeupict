<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_jute_rate extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertJuteRateSummary($jute_rate_summary)
    {
        $this->db->insert('jute_rate_summary', $jute_rate_summary);
        $returnValue = $this->db->insert_id();
        return $returnValue;
    }

    public function insertJuteRate($juteRateData)
    {

        $this->db->insert('jute_rate', $juteRateData);
        $returnValue = $this->db->insert_id();
        return $returnValue;
    }

    public function insertJuteRateMoisture($juteRateMoistureData)
    {

        $this->db->insert('jute_rate_moisture', $juteRateMoistureData);
        $returnValue = $this->db->insert_id();
        return $returnValue;
    }

    public function insertJuteRateSmr($juteRateSmrData)
    {

        $this->db->insert('jute_rate_smr', $juteRateSmrData);
        $returnValue = $this->db->insert_id();
        return $returnValue;
    }

    public function getJuteRate()
    {
        $this->db->where('jrs_status', 1);
        $this->db->order_by("jrs_sl_no", "desc");
        $query = $this->db->get('jute_rate_summary');
        return $query;
    }


    //show last jute rate sheet under add form
    public function getJuteRateByLastId()
    {
        $this->db->where('jrs_status', 1);
        $this->db->order_by("jrs_id", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('jute_rate_summary');
        return $query->row();
    }

    public function getJuteRateByJrsId($jrs_id)
    {
        $this->db->where('jrs_id', $jrs_id);
        $query = $this->db->get('jute_rate_summary');
        if ($this->db->affected_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    public function updatedOldEndDate($updatedOldEndDate, $jrs_fy_id)
    {
        $this->db->where('jrs_status', 1);
        $this->db->where('jrs_activity', 1);
        $this->db->where('jrs_fy_id', $jrs_fy_id);
        $this->db->update('jute_rate_summary', $updatedOldEndDate);
    }

    public function getSingleJuteRate($data)
    {
        $this->db->where($data);
        $query = $this->db->get('jute_rate');
        if ($this->db->affected_rows() > 0) {
            return $query->row()->jr_rate;
        } else {
            return 0;
        }
    }

    public function getSingleJuteMoistureNew($data)
    {
        $this->db->where($data);
        $query = $this->db->get('jute_rate_moisture');
        if ($this->db->affected_rows() > 0) {
            return $query->row()->jr_m_new;
        } else {
            return 0;
        }
    }

    public function getSingleJuteMoistureOld($data)
    {
        $this->db->where($data);
        $query = $this->db->get('jute_rate_moisture');
        if ($this->db->affected_rows() > 0) {
            return $query->row()->jr_m_old;
        } else {
            return 0;
        }
    }

    public function getSmrDeductionsByJrsId($jrs_id)
    {
        $this->db->where('jr_smr_jrs_id', $jrs_id);
        $query = $this->db->get('jute_rate_smr');
        return $query;
    }


    //get financial Year id
    public function ajaxFinancialYear($jrs_start_date)
    {
        $this->db->where('fy_status', 1);
        $this->db->where('fy_start_date <=', $jrs_start_date);
        $this->db->where('fy_end_date >=', $jrs_start_date);
        $query = $this->db->get('financial_year');
        return $query->row();
    }

    // Check Serial Number
    public function ajaxSerialNumberCheckForJuteRate($conditions)
    {
        $this->db->where($conditions);
        $this->db->get('jute_rate_summary');
        return $this->db->affected_rows();
    }

    public function totalJuteRateWIse($id)
    {
        $sql = $this->db->query("SELECT SUM(jpis_grand_total) AS total_sum FROM jute_purchase_invoice_summary WHERE jpis_status = 1 AND jpis_approve_status = 1 AND jpis_jrs_id = $id ");
        return $sql->row()->total_sum;
    }


    //13.09.22 by murad after delete update
    public function updateDataBySerialNo($jrs_sl_no, $jrs_fy_id, $updatedOldEndDate)
    {
        $this->db->where('jrs_status', 1);
        $this->db->where('jrs_sl_no', $jrs_sl_no);
        $this->db->where('jrs_fy_id', $jrs_fy_id);
        $this->db->update('jute_rate_summary', $updatedOldEndDate);
    }

    public function getJuteRateByJrsSlNO($jrs_sl_no, $jrs_fy_id)
    {
        $this->db->where('jrs_status', 1);
        $this->db->where('jrs_sl_no', $jrs_sl_no);
        $this->db->where('jrs_fy_id', $jrs_fy_id);
        $query = $this->db->get('jute_rate_summary');
        if ($this->db->affected_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    //To auto populate jute rate on add jute rate form
    public function getJuteRateSlByFyId($fy_id)
    {
        $this->db->where('jrs_status', 1);
        $this->db->where('jrs_fy_id', $fy_id);
        $this->db->order_by("jrs_id", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('jute_rate_summary');
        if ($this->db->affected_rows() > 0) {
            return $query->row()->jrs_sl_no;
        } else {
            return 0;
        }
    }


    public function deleteJuteRate($jrs_id, $deleteData)
    {
        $this->db->where('jrs_id', $jrs_id);
        $this->db->update('jute_rate_summary', $deleteData);
    }

    public function getJuteRateSheetByFyIdForContractBill($fy_id)
    {
        $this->db->where('jrs_status', 1);
        $this->db->where('jrs_fy_id', $fy_id);
        $this->db->order_by("jrs_id", "DESC");
        $query = $this->db->get('jute_rate_summary');
        if ($this->db->affected_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }



    //End
}
