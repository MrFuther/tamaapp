<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subunitkerja extends CI_Model {

    private $table = 'ms_subunit';  // Nama tabel sub unit kerja

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua sub unit
    public function get_all() {
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data sub unit baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data sub unit
    public function update($id, $data) {
        $this->db->where('subunit_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) sub unit
    public function delete($id) {
        $data = ['is_active' => 0];
        $this->db->where('subunit_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Mendapatkan sub unit berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('subunit_id', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
} 
