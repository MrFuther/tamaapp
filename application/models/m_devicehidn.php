<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_devicehidn extends CI_Model {

    public function get_all_devicehidn() {
        $this->db->select('d.*, s.sub_device_id');
        $this->db->from('ms_device_hidn d');
        $this->db->join('ms_sub_device s', 'd.sub_device_name = s.sub_device_name', 'left');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('ms_device_hidn', ['device_hidn_id' => $id])->row();  // Ambil data berdasarkan ID dari ms_device_hidn
    }

    public function insert($data) {
        $this->db->insert('ms_device_hidn', $data);  // Insert data baru ke ms_device_hidn
    }

    public function get_all_names() {
        $this->db->select('sub_device_name');  // Pilih hanya kolom sub_device_name
        return $this->db->get($this->table)->result();  // Mengembalikan hasil sebagai objek
    }
      
    public function update($id, $data) {
        $this->db->where('device_hidn_id', $id);
        $this->db->update('ms_device_hidn', $data);  // Update data pada ms_device_hidn berdasarkan ID
    }

    public function delete($id) {
        $this->db->where('device_hidn_id', $id);
        $this->db->delete('ms_device_hidn');  // Hapus data berdasarkan ID di ms_device_hidn
    }
}
