<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Common extends CI_Model
{

    public function set_data($table, $data)
    {
        $this->db->trans_start();
        $this->db->insert($table, $data);
        $returnValue = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return $returnValue;
        }
    }

    public function get_data($table)
    {
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function get_data_multi_conditional($table, $data)
    {
        $this->db->where($data);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function filter_search($table, $data, $from, $to)
    {
        $this->db->where($data);
        $this->db->where('p_sprice>', $from);
        $this->db->where('p_sprice<', $to);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function search($table, $data, $search)
    {
        $this->db->where($data);
        $this->db->like('p_tittle', $search);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function count_search($table, $data, $search)
    {
        //$this->db->count($sum);
        $this->db->where($data);
        $this->db->like('p_tittle', $search);
        $query = $this->db->get($table);
        return $this->db->affected_rows();
    }

    public function count_filter_search($table, $data, $from, $to)
    {
        //$this->db->count($sum);
        $this->db->where($data);
        $this->db->where('p_sprice>', $from);
        $this->db->where('p_sprice<', $to);
        $query = $this->db->get($table);
        return $this->db->affected_rows();
    }

    public function getProductList($information)
    {

        $this->db->like('p_tittle', $information);
        $this->db->where("p_status", 0);

        $query = $this->db->get("poducts");


        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return 0;
        }
    }

    public function count_data($table, $data)
    {
        //$this->db->count($sum);
        $this->db->where($data);
        $query = $this->db->get($table);;
        return $this->db->affected_rows();
    }

    public function category($table)
    {
        //$this->db->where($data);
        $this->db->where('c_parent' == 0);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function get_data_single_conditional($table, $index, $data)
    {
        $this->db->where($index, $data);
        $query = $this->db->get($table);
        return $query;
    }
    public function get_data_single_multi_conditional($table, $data)
    {
        $this->db->where($data);
        $query = $this->db->get($table)->row();
        return $query;
    }

    function get_data_single($table, $index, $data)
    {
        $this->db->where($index, $data);
        $query = $this->db->get($table)->row();
        return $query;
    }


    public function get_single_row_information($table, $index, $data)
    {
        $this->db->where($index, $data);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_single_row_information_multi_conditon($table, $data)
    {

        $this->db->where($data);
        $query = $this->db->get($table);


        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }



    function delete_data($table, $index, $data)
    {
        $this->db->where($index, $data);
        $this->db->delete($table);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function update_data($table, $index, $identifier, $data)
    {
        $this->db->where($index, $identifier);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function count_fact($table, $index, $data)
    {
        $this->db->where($index, $data);
        $query = $this->db->get($table);


        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }



    public function table_count($table)
    {

        $query = $this->db->get($table);


        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    function is__check_where_data_available($data, $table)
    {
        $this->db->where($data);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_multi_data_limit_mod($table,  $limit, $offset, $group_by, $data)
    {
        $this->db->where($data);
        $this->db->group_by($group_by);
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }

    public function get_multi_condition_count_mod($table, $group_by, $data)
    {
        $this->db->where($data);
        $this->db->group_by($group_by);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }

    public function get_multi_cond_data_limit_mod($table,  $limit, $offset, $data)
    {
        if ($data) {
            $this->db->where($data);
            $this->db->limit($limit, $offset);
            $query = $this->db->get($table);
            if ($this->db->affected_rows() > 0) {
                return $query;
            } else {
                return FALSE;
            }
        } else {
            $this->db->limit($limit, $offset);
            $query = $this->db->get($table);
            if ($this->db->affected_rows() > 0) {
                return $query;
            } else {
                return FALSE;
            }
        }
    }

    public function get_multi_cond_data_count_mod($table, $data)
    {
        if ($data) {
            $this->db->where($data);
            $query = $this->db->get($table);
            if ($this->db->affected_rows() > 0) {
                return $this->db->affected_rows();
            } else {
                return 0;
            }
        } else {
            $query = $this->db->get($table);
            if ($this->db->affected_rows() > 0) {
                return $this->db->affected_rows();
            } else {
                return 0;
            }
        }
    }
    public function get_multi_data_limit_like_mod($table,  $limit, $offset, $title, $title_val, $data, $group_by)
    {
        $this->db->where($data);
        $this->db->group_by($group_by);
        $this->db->limit($limit, $offset);
        $this->db->like($title, $title_val, 'both');
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }
    public function get_multi_data_like_count_mod($table, $title, $title_val, $data, $group_by)
    {
        $this->db->where($data);
        $this->db->group_by($group_by);
        $this->db->like($title, $title_val, 'both');
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
    }
    public function order_report_mod_sum($report, $limit, $offset)
    {
        $table = "invoice";
        if ($report) {
            $this->db->select_sum("i_totalcost");
            $this->db->select("count(i_id) as AllCountData");
            $this->db->where($report);
            $this->db->limit($limit, $offset);
            $query = $this->db->get($table);
            return $query;
        } else {
            $this->db->select_sum("i_totalcost");
            $this->db->select("count(i_id)");
            $this->db->limit($limit, $offset);
            $query = $this->db->get($table);
            return $query;
        }
    }
}
