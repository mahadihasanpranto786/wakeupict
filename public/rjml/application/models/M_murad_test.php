<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_murad_test extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertTest($data)
    {
        $this->db->insert('murad_test_table', $data);
        $returnValue = $this->db->insert_id();
        return $returnValue;
    }

    public function getTest()
    {
        //$this->db->where('ar_status', 1);
        $query = $this->db->get('murad_test_table');
        return $query;
    }

    public function getTestById($jr_id)
    {
        $this->db->where('jr_id', $jr_id);
        $query = $this->db->get('murad_test_table');
        return $query->row();
    }

    public function updateTest($jr_id, $data)
    {
        $this->db->where('jr_id', $jr_id);
        $this->db->update('murad_test_table', $data);
    }
}
