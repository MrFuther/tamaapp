<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subdevice extends CI_Model {

    private $table = 'ms_sub_device';  // Nama tabel sub device

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua sub device
    public function get_all() {
        return $this->db->get('ms_sub_device')->result();
    }

    // Menyimpan data sub device baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data sub device
    public function update($id, $data) {
        $this->db->where('sub_device_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) sub device
    public function delete($id) {
        $this->db->where('sub_device_id', $id);
        return $this->db->delete($this->table);
    }

    // Mendapatkan sub device berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('sub_device_id', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}