<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_unitkerja extends CI_Model {
    private $table = 'ms_unit_kerja';
    
    public function __construct() {
        parent::__construct();
    }
    
    // Mendapatkan semua unit kerja
    public function get_all() {
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data unit kerja baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data unit kerja
    public function update($id, $data) {
        $this->db->where('unit_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) unit kerja
    public function delete($id) {
        $this->db->where('unit_id', $id);
        return $this->db->delete($this->table);
    }

    // Mendapatkan unit kerja berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('unit_id', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}