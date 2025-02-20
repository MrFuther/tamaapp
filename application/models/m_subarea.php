<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subarea extends CI_Model {

    private $table = 'ms_sub_area';

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function insert($data) {
        $data['created_by'] = $this->session->userdata('username');
        $data['created_date'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $data['updated_by'] = $this->session->userdata('username');
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->where('sub_area_id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('sub_area_id', $id);
        return $this->db->delete($this->table);
    }

    public function get_by_id($id) {
        $this->db->where('sub_area_id', $id);
        return $this->db->get($this->table)->row();
    }
}