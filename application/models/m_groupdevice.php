<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_groupdevice extends CI_Model {

    private $table = 'ms_groupdevices';  // Nama tabel group device

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua group device
    public function get_all() {
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data group device baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data group device
    public function update($id, $data) {
        $this->db->where('pek_unit_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) group device
    public function delete($id) {
        $this->db->where('pek_unit_id', $id);
        return $this->db->delete($this->table);
    }

    // Mendapatkan group device berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('pek_unit_id', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}
