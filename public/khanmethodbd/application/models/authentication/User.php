<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model {
    
    public function user_validation($table,$data){
        $query = $this->db->where($data)
                          ->get($table)->row();
        if ($this->db->affected_rows() > 0 ) {
            return $query;
        }else{
            return FALSE;
        }
    }

    

    public function count_data($table,$index,$data){
        $this->db->where($index, $data);
        $this->db->get($table);
        if ($this->db->affected_rows() > 0 ) {
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }

    public function count_all($table){
        
        $this->db->get($table);
        if ($this->db->affected_rows() > 0 ) {
            return $this->db->affected_rows();
        }else{
            return 0;
        }
    }


    
    
    

}


