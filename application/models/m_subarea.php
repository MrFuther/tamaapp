<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subarea extends CI_Model {

    private $table = 'ms_subgrouparea';  // Nama tabel sub area

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua sub area
    public function get_all() {
        $this->db->select('ms_subgrouparea.*, ms_grouparea.nama_grouparea');
        $this->db->join('ms_grouparea', 'ms_subgrouparea.id_grouparea = ms_grouparea.id_grouparea', 'left');
        $this->db->where('ms_subgrouparea.is_active', 1);
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data sub area baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data sub area
    public function update($id, $data) {
        $this->db->where('id_subgrouparea', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) sub area
    public function delete($id) {
        $data = ['is_active' => 0];
        $this->db->where('id_subgrouparea', $id);
        return $this->db->update($this->table, $data);
    }

    // Mendapatkan sub area berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('id_subgrouparea', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}
