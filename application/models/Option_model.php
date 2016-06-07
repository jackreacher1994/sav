<?php
Class Option_model extends CI_Model
{

    function get_option($oid)
    {
        $this->db->where('oid', $oid);
        $query = $this->db->get('savsoft_options');
        return $query->row_array();


    }

}