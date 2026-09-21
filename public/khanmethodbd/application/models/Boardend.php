<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Boardend extends CI_Model
{

    public function get_invoice_list($table, $index, $data)
    {
        $this->db->where($index, $data);
        $this->db->order_by("i_id", "desc");
        $query = $this->db->get($table);

        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function get_vendor_invoice_list($data)
    {
        $this->db->where($data);
        $this->db->join('oder_products', 'oder_products.invoice_id = invoice.i_id');
        $this->db->group_by('oder_products.invoice_id');
        $query = $this->db->get("invoice");
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function get_invoice_list_user($table, $data)
    {
        $this->db->where($data);
        $this->db->order_by("i_id desc");
        $query = $this->db->get($table);


        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function today_income($today_date)
    {
        $this->db->select_sum('i_total_profit');
        $this->db->where('i_update_at', $today_date);
        $this->db->where('i_status', 1);
        $query = $this->db->get('invoice')->row();;
        return $query->i_total_profit;
    }

    public function total_income()
    {
        $this->db->select_sum('i_total_profit');
        $this->db->where('i_status', 1);
        $query = $this->db->get('invoice')->row();
        return $query->i_total_profit;
    }

    public function order_report($report)
    {
        $table = "invoice";
        if ($report) {
            $this->db->where($report);
            $query = $this->db->get($table);
            return $query;
        } else {
            $query = $this->db->get($table);
            return $query;
        }
    }

    public function product_report($report)
    {
        $table = "oder_products";
        $this->db->where($report);
        $query = $this->db->get($table);
        return $query;
        // if ($report) {

        //     $query = $this->db->get_where($table, $report);

        //     return $query;
        // } else {
        //     $query = $this->db->get($table);
        //     return $query;
        // }
    }

    public function sales_of_a_day($a_day)
    {
        $this->db->select_sum('i_totalcost');
        $this->db->where('i_createdat', $a_day);
        $query = $this->db->get('invoice')->row();;
        return $query->i_totalcost;
    }

    public function sales_of_a_condition($a_day)
    {
        $this->db->select_sum('i_totalcost');
        $this->db->where('i_createdat>', $a_day);
        $query = $this->db->get('invoice')->row();;
        return $query->i_totalcost;
    }
    public function sales_total_of_vendor()
    {
        $this->db->where(['oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId')]);
        $this->db->join('oder_products', 'oder_products.invoice_id = invoice.i_id');
        $query = $this->db->get('invoice');
        $price = 0;
        if ($query) {
            foreach ($query->result() as $query) {
                $price = $price + ($query->p_quantity * $query->p_sprice);
            }
        }
        return $price;
    }

    public function sales_of_a_day_vendor($a_day)
    {
        $this->db->where('i_createdat', $a_day);
        $this->db->where(['oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId')]);
        $this->db->join('oder_products', 'oder_products.invoice_id = invoice.i_id');
        $query = $this->db->get('invoice');
        $price = 0;
        if ($query) {
            foreach ($query->result() as $query) {
                $price = $price + ($query->p_quantity * $query->p_sprice);
            }
        }
        return $price;
    }
    public function sales_of_a_day_vendor_condition($a_day)
    {
        $this->db->where('i_createdat>', $a_day);
        $this->db->where(['oder_products.o_createdby' => $this->session->userdata('currentActiveVendorId')]);
        $this->db->join('oder_products', 'oder_products.invoice_id = invoice.i_id');
        $query = $this->db->get('invoice');
        $price = 0;
        if ($query) {
            foreach ($query->result() as $query) {
                $price = $price + ($query->p_quantity * $query->p_sprice);
            }
        }
        return $price;
    }

    public function order_count($data)
    {
        $this->db->where($data);
        $this->db->join('oder_products', 'oder_products.invoice_id = invoice.i_id');
        $query = $this->db->get('invoice');
        $quantity = 0;
        if ($query) {
            foreach ($query->result() as $query) {
                $quantity = $quantity + ($query->p_quantity);
            }
        }
        return $quantity;
    }
    public function profit_of_a_day($a_day)
    {
        $this->db->select_sum('i_total_profit');
        $this->db->where('i_update_at', $a_day);
        $query = $this->db->get('invoice')->row();;
        return $query->i_total_profit;
    }

    public function profit_of_a_condition($a_day)
    {
        $this->db->select_sum('i_total_profit');
        $this->db->where('i_update_at>', $a_day);
        $query = $this->db->get('invoice')->row();;
        return $query->i_total_profit;
    }


    public function total_withdrawal($data)
    {
        $this->db->select_sum('amount');
        $this->db->where($data);
        $query = $this->db->get('withdrawals')->row();;
        return $query->amount;
    }
    public function orderSummary()
    {
        $sql = $this->db->query("SELECT
        count(case when (i_status) = 1 then 1 END) as complete,
        count(case when (i_status) =5 then 1 END) as pending,
        count(case when (i_status) = 2 then 1 END) as cencel FROM `invoice`");
        return  $sql;
    }
}
