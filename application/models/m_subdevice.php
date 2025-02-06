<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_subdevice extends CI_Model {

    private $table = 'ms_subgroupdevice';  // Nama tabel sub device

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua sub device
    public function get_all() {
        $this->db->select('ms_subgroupdevice.*, ms_groupdevice.nama_pekerjaanunit');
        $this->db->join('ms_groupdevice', 'ms_subgroupdevice.id_groupdevice = ms_groupdevice.id_groupdevice', 'left');
        $this->db->where('ms_subgroupdevice.is_active', 1);
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data sub device baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data sub device
    public function update($id, $data) {
        $this->db->where('id_subgroupdevice', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) sub device
    public function delete($id) {
        $data = ['is_active' => 0];
        $this->db->where('id_subgroupdevice', $id);
        return $this->db->update($this->table, $data);
    }

    // Mendapatkan sub device berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('id_subgroupdevice', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}
