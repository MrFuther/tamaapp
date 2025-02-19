<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subarea extends CI_Model {

    private $table = 'ms_sub_area';  // Nama tabel sub area

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua sub area
    public function get_all() {
        $this->db->select('ms_sub_area.*, ms_area.area_id'); // Ambil id_grouparea dari ms_area
        $this->db->from('ms_sub_area');
        $this->db->join('ms_area', 'ms_area.area_id = ms_sub_area.sub_area_id', 'left'); // Join dengan ms_area
        return $this->db->get()->result();
    }

    // Menyimpan data sub area baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data sub area
    public function update($id, $data) {
        $this->db->where('sub_area_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) sub area
    public function delete($id) {
        $this->db->where('sub_area_id', $id);
        return $this->db->delete($this->table);
    }

    // Mendapatkan sub area berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('sub_area_id', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}