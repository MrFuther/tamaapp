<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_unitkerja extends CI_Model {
    private $table = 'ms_unitkerja';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Get all data
    public function get_all() {
        $this->db->where('is_active', 1);
        return $this->db->get($this->table)->result();
    }
    
    // Get by ID
    public function get_by_id($id) {
        $this->db->where('id_unitkerja', $id);
        $this->db->where('is_active', 1);
        return $this->db->get($this->table)->row();
    }
    
    // Insert data
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
    
    // Update data
    public function update($id, $data) {
        $this->db->where('id_unitkerja', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Soft delete
    public function delete($id) {
        $data = array('is_active' => 0);
        $this->db->where('id_unitkerja', $id);
        return $this->db->update($this->table, $data);
    }
}