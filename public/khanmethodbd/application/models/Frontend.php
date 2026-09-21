<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Frontend extends CI_Model
{

    function get_data($orderBy, $table)
    {
        $this->db->order_by($orderBy);
        $query = $this->db->get($table);
        return $query;
    }

    function get_data_single($table, $index, $data)
    {
        $this->db->where($index, $data);
        $query = $this->db->get($table)->row();
        return $query;
    }

    function get_data_single_muli_con($table, $data)
    {
        $this->db->where($data);
        $query = $this->db->get($table)->row();
        return $query;
    }

    function get_data_muli_con_order($table, $data, $orderBy)
    {
        $this->db->where($data);
        $this->db->order_by($orderBy);
        $query = $this->db->get($table);
        return $query;
    }

    function get_data_muli_con_order_limit($table, $data, $orderBy, $limit)
    {
        $this->db->where($data);
        $this->db->order_by($orderBy, 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($table);
        return $query;
    }
    function get_data_muli_con_order_limit_offset($table, $data, $orderBy,  $limit, $offset)
    {
        $this->db->where($data);
        $this->db->order_by($orderBy, 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table);
        return $query;
    }

    function get_data_gallary($table, $index, $data)
    {
        $this->db->where($index, $data);
        $this->db->join('image_catagory', 'image_catagory.image_catagory_id = image_gallery.image_gallery_catagory_id');
        $query = $this->db->get($table);
        return $query;
    }

    function get_doctor_criteria($table, $index, $data)
    {
        $this->db->where($index, $data);
        $this->db->join('cf_criteria', 'cf_criteria.cf_criteria_id = rcf_doctor_criteria.rcf_dc_criteria_id');
        $query = $this->db->get($table);
        return $query;
    }

    function get_clinic_criteria($table, $data)
    {
        $this->db->where($data);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_criterias.rcf_cc_clinic_id');
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $query = $this->db->get($table);
        return $query;
    }

    function get_clinic_criteria_mod($id)
    {
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('rcf_cc_isdeleted', 0);
        $this->db->where('rcf_cc_criterias_id', $id);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_criterias.rcf_cc_clinic_id');
        $query = $this->db->get('rcf_clinic_criterias');
        return $query;
    }

    function get_clinic_criteria_mod_row($id)
    {
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('rcf_cc_isdeleted', 0);
        $this->db->where('rcf_cc_criterias_id', $id);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_criterias.rcf_cc_clinic_id');
        $query = $this->db->get('rcf_clinic_criterias');
        $number_of_clinic = $this->db->affected_rows();
        return $number_of_clinic;
    }

    function get_clinic_procedure($table, $data)
    {
        $this->db->where($data);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $this->db->where(['cf_clinic.cfc_isdeleted' => 0, 'cf_clinic.cfc_status' => 1]);
        $query = $this->db->get($table);
        return $query;
    }

    function get_clinic_procedure_count($table, $data)
    {
        $this->db->where($data);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $this->db->where(['cf_clinic.cfc_isdeleted' => 0, 'cf_clinic.cfc_status' => 1]);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    function get_clinic_country_procedure($table, $data, $country_id)
    {
        $this->db->where($data);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $this->db->where(['cf_clinic.cfc_countryid' => $country_id, 'cf_clinic.cfc_isdeleted' => 0, 'cf_clinic.cfc_status' => 1]);
        $query = $this->db->get($table);
        return $query;
    }

    function get_clinic_country_criteria($table, $data, $country_id)
    {
        $this->db->where($data);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_criterias.rcf_cc_clinic_id');
        $this->db->where(['cf_clinic.cfc_countryid' => $country_id, 'cf_clinic.cfc_isdeleted' => 0, 'cf_clinic.cfc_status' => 1]);
        $query = $this->db->get($table);
        return $query;
    }

    function get_clinic_country_criteria_mod($id, $country_id)
    {
        $this->db->where('cfc_countryid', $country_id);
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('rcf_cc_isdeleted', 0);
        $this->db->where('rcf_cc_criterias_id', $id);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_criterias.rcf_cc_clinic_id');
        $query = $this->db->get('rcf_clinic_criterias');
        return $query;
    }

    function get_clinic_country_criteria_mod_row($id, $country_id)
    {
        $this->db->where('cfc_countryid', $country_id);
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('rcf_cc_isdeleted', 0);
        $this->db->where('rcf_cc_criterias_id', $id);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_criterias.rcf_cc_clinic_id');
        $query = $this->db->get('rcf_clinic_criterias');
        $number_of_clinic = $this->db->affected_rows();
        return $number_of_clinic;
    }

    function get_clinic_country_procedure_mod($p_id, $country_id)
    {
        $this->db->where('rcf_cp_procedure_id', $p_id);
        $this->db->where('cfc_countryid', $country_id);
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('rcf_cp_isdeleted', 0);
        $this->db->where('rcf_cp_status', 1);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $query = $this->db->get('rcf_clinic_procedure');
        return $query;
    }

    function get_clinic_country_procedure_mod_row($p_id, $country_id)
    {
        $this->db->where('rcf_cp_procedure_id', $p_id);
        $this->db->where('cfc_countryid', $country_id);
        $this->db->where('rcf_cp_isdeleted', 0);
        $this->db->where('rcf_cp_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('cfc_status', 1);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $query = $this->db->get('rcf_clinic_procedure');
        $number_of_clinic = $this->db->affected_rows();
        return $number_of_clinic;
    }

    function get_clinic_procedure_mod($p_id)
    {
        $this->db->where('rcf_cp_procedure_id', $p_id);
        $this->db->where('rcf_cp_isdeleted', 0);
        $this->db->where('rcf_cp_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('cfc_status', 1);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $query = $this->db->get('rcf_clinic_procedure');
        return $query;
    }

    function get_clinic_procedure_mod_row($p_id)
    {
        $this->db->where('rcf_cp_procedure_id', $p_id);
        $this->db->where('rcf_cp_isdeleted', 0);
        $this->db->where('rcf_cp_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('cfc_status', 1);
        $this->db->where('rcf_cp_procedure_id', $p_id);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $query = $this->db->get('rcf_clinic_procedure');
        $number_of_clinic = $this->db->affected_rows();
        return $number_of_clinic;
    }

    function get_clinic_country_mod($country_id)
    {
        $this->db->where('cfc_countryid', $country_id);
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $query = $this->db->get('cf_clinic');
        return $query;
    }


    function get_clinic_country_mod_row($country_id)
    {
        $this->db->where('cfc_countryid', $country_id);
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $query = $this->db->get('cf_clinic');
        $number_of_clinic = $this->db->affected_rows();
        return $number_of_clinic;
    }

    function get_clinic_search_mod()
    {
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $query = $this->db->get('cf_clinic');
        return $query;
    }

    function get_doctor_search_mod()
    {
        $this->db->where('cf_doctor_status', 1);
        $this->db->where('cf_doctor_isdeleted', 0);
        $query = $this->db->get('cf_doctor');
        return $query;
    }

    function get_clinic_search_mod_row()
    {
        $this->db->where('cfc_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $query = $this->db->get('cf_clinic');
        $number_of_clinic = $this->db->affected_rows();
        return $number_of_clinic;
    }

    function get_country($table, $data)
    {
        $this->db->where($data);
        $this->db->join('cf_country', 'cf_country.cf_country_id = cf_city.cf_city_countryid');
        $query = $this->db->get($table);
        return $query;
    }

    function get_language($table, $data)
    {

        $this->db->where($data);
        $this->db->join('cf_language', 'cf_language.cfl_id = cf_services.cfs_languageid');
        $query = $this->db->get($table);
        return $query;
    }

    function get_data_by_condition($table, $index, $data)
    {
        $this->db->where($index, $data);
        $query = $this->db->get($table);
        return $query;
    }

    function get_id_by_slug($id)
    {
        $this->db->where("course_slug", $id);
        $query = $this->db->get("course");
        return $query->row()->course_id;
    }

    function get_selected_course_section($table, $index, $data)
    {
        $this->db->where($index, $data);
        $this->db->where("course_section_isdeleted", 0);
        $query = $this->db->get($table);
        return $query;
    }

    function instructor_list_single_course($data)
    {
        $this->db->where("course_instractor_c_id", $data);
        $this->db->join('instructor', 'instructor.instructor_id = course_instractor.course_instractor_i_id');
        $query = $this->db->get("course_instractor");
        return $query;
    }

    public function email_check($table, $data)
    {
        $this->db->where("course_instractor_c_id", $data);
        $this->db->where("course_section_isdeleted", 0);
        $query = $this->db->get($table);
        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
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


    function get_clinic_procedure_information($information)
    {
        $this->db->where("rcf_cp_id", $information);
        $this->db->where("cfp_status", 1);
        $this->db->where("cfp_isdeleted", 0);
        $this->db->join('cf_procedures', 'cf_procedures.cfp_id = rcf_clinic_procedure.rcf_cp_procedure_id');
        $query = $this->db->get("rcf_clinic_procedure");
        return $query->row();
    }

    function get_procedure_byclinic__information($information, $clinic_id)
    {
        $this->db->where("rcf_cp_procedure_id", $information);
        $this->db->where("rcf_cp_clinic_id", $clinic_id);
        $this->db->where("rcf_cp_isdeleted", 0);
        $this->db->where("rcf_cp_status", 1);
        $this->db->join('cf_procedures', 'cf_procedures.cfp_id = rcf_clinic_procedure.rcf_cp_procedure_id');
        $query = $this->db->get("rcf_clinic_procedure");
        return $query->row();
    }

    function get_procedure_byclinic__information_list($information, $clinic_id)
    {
        $this->db->join('cf_procedures', 'cf_procedures.cfp_id = rcf_clinic_procedure.rcf_cp_procedure_id');
        $this->db->like('cfp_name', $information);
        $this->db->where("rcf_cp_clinic_id", $clinic_id);
        $this->db->where("rcf_cp_isdeleted", 0);
        $this->db->where("rcf_cp_status", 1);
        $this->db->where("cfp_isdeleted", 0);
        $this->db->where('cfp_status', 1);

        $query = $this->db->get("rcf_clinic_procedure");
        return $query;
    }


    function load_city_by_country($table, $index, $data)
    {
        $this->db->where($index, $data);
        $this->db->where("cf_city_isdeletd", 0);
        $this->db->where("cf_city_status", 1);
        $query = $this->db->get($table);


        if ($this->db->affected_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }
    }


    function get_citeria_clinic_procedure_mod($id)
    {
        $this->db->where('rcf_cp_procedure_id', $id);
        $this->db->where('rcf_cp_isdeleted', 0);
        $this->db->where('rcf_cp_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('cfc_status', 1);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $query = $this->db->get('rcf_clinic_procedure');
        return $query;
    }

    function get_citeria_clinic_procedure_mod_row($id)
    {
        $this->db->where('rcf_cp_procedure_id', $id);
        $this->db->where('rcf_cp_isdeleted', 0);
        $this->db->where('rcf_cp_status', 1);
        $this->db->where('cfc_isdeleted', 0);
        $this->db->where('cfc_status', 1);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $query = $this->db->get('rcf_clinic_procedure');
        $number_of_clinic = $this->db->affected_rows();
        return $number_of_clinic;
    }

    /*function get_data_procedure_list($c_id,$cc_id) {
        $this->db->where('rcf_cp_status',1);
        $this->db->where('rcf_cp_isdeleted',0);
        $this->db->where('cfc_status',1);
        $this->db->where('cfc_isdeleted',0);
        $this->db->where('rcf_cp_criteria_id',$cc_id);
        $this->db->where('cfc_countryid',$c_id);
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $this->db->join('cf_clinic', 'cf_clinic.cfc_id = rcf_clinic_procedure.rcf_cp_clinic_id');
        $query=$this->db->get('rcf_clinic_procedure');
        return $query;
    }*/
}
