<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AreaModel extends CI_Model {

public function __construct() {
    parent::__construct();
    $this->load->database();
}

// Method untuk mendapatkan semua grup area
public function getAllGroupAreas() {
    $this->db->select('id_grouparea AS id, nama_grouparea AS name');
    $this->db->from('ms_grouparea');
    $query = $this->db->get();

    return $query->result_array();
}

// Method untuk mendapatkan sub-area berdasarkan group area
public function getSubAreasByGroup($group_id) {
    $this->db->select('id_subgrouparea AS id, nama_subarea AS name');
    $this->db->from('ms_subgrouparea');
    $this->db->where('id_grouparea', $group_id);
    $query = $this->db->get();

    return $query->result_array();
}
}