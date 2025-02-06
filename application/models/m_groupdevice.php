<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_groupdevice extends CI_Model {

    private $table = 'ms_groupdevice';  // Nama tabel group device

    public function __construct() {
        parent::__construct();
    }

    // Mendapatkan semua group device
    public function get_all() {
        $this->db->select('ms_groupdevice.*, ms_subunitkerja.nama_subunit, ms_unitkerja.nama_unitkerja');
        $this->db->join('ms_subunitkerja', 'ms_groupdevice.id_subunit = ms_subunitkerja.id_subunit', 'left');
        $this->db->join('ms_unitkerja', 'ms_groupdevice.id_unitkerja = ms_unitkerja.id_unitkerja', 'left');
        $this->db->where('ms_groupdevice.is_active', 1);
        return $this->db->get($this->table)->result();  // Mengembalikan data sebagai objek
    }

    // Menyimpan data group device baru
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    // Mengupdate data group device
    public function update($id, $data) {
        $this->db->where('id_groupdevice', $id);
        return $this->db->update($this->table, $data);
    }

    // Menghapus (soft delete) group device
    public function delete($id) {
        $data = ['is_active' => 0];
        $this->db->where('id_groupdevice', $id);
        return $this->db->update($this->table, $data);
    }

    // Mendapatkan group device berdasarkan ID
    public function get_by_id($id) {
        $this->db->where('id_groupdevice', $id);
        return $this->db->get($this->table)->row();  // Mengembalikan objek
    }
}
