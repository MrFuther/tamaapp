<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AreaModel extends CI_Model {

public function __construct() {
    parent::__construct();
    $this->load->database();
}

// Method untuk mendapatkan semua grup area
public function getAllGroupAreas() {
    $this->db->select('area_id AS id, area_name AS name');
    $this->db->from('ms_area');
    $query = $this->db->get();

    return $query->result_array();
}

// Method untuk mendapatkan sub-area berdasarkan group area
public function getSubAreasByGroup($area_id) {
    $this->db->select('sub_area_id AS id, sub_area_name AS name');
    $this->db->from('ms_sub_area');
    $this->db->where('gr_area_name', $area_id);
    $query = $this->db->get();

    return $query->result_array();
}
}