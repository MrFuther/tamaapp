<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_grouparea extends CI_Model {

    private $table = 'ms_grouparea';  // Nama tabel group area

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua group area
    public function get_all() {
        $this->db->where('is_active', 1);  // Memastikan hanya yang aktif yang ditampilkan
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data group area baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data group area
    public function update($id, $data) {
        $this->db->where('id_grouparea', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) group area
    public function delete($id) {
        $data = ['is_active' => 0];
        $this->db->where('id_grouparea', $id);
        return $this->db->update($this->table, $data);
    }

    // Mendapatkan group area berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('id_grouparea', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}
