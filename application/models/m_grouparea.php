<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_grouparea extends CI_Model {

    private $table = 'ms_area';  // Nama tabel group area

    public function __construct() {
        parent::__construct();
    }

     // Mendapatkan semua area
     public function get_all() {
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data area baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data area
    public function update($id, $data) {
        $this->db->where('area_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) area
    public function delete($id) {
        $this->db->where('area_id', $id);
        return $this->db->delete($this->table);
    }

    // Mendapatkan area berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('area_id', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}
