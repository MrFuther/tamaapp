<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subunitkerja extends CI_Model {

    private $table = 'ms_subunitkerja';  // Nama tabel sub unit kerja

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua sub unit kerja
    public function get_all() {
        $this->db->select('ms_subunitkerja.*, ms_unitkerja.nama_unitkerja');
        $this->db->join('ms_unitkerja', 'ms_subunitkerja.id_unitkerja = ms_unitkerja.id_unitkerja', 'left');
        $this->db->where('ms_subunitkerja.is_active', 1);
        
        // Mengembalikan data sebagai objek, bukan array
        return $this->db->get($this->table)->result();  // .result() mengembalikan objek, bukan array
    }    

    // Menyimpan data sub unit kerja baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data sub unit kerja
    public function update($id, $data) {
        $this->db->where('id_subunit', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) sub unit kerja
    public function delete($id) {
        $data = ['is_active' => 0];
        $this->db->where('id_subunit', $id);
        return $this->db->update($this->table, $data);
    }

    // Mendapatkan sub unit kerja berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('id_subunit', $id);
        return $this->db->get($this->table)->row();
    }
}
