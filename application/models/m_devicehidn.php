<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_devicehidn extends CI_Model {

    public function get_all_devicehidn() {
        return $this->db->get('ms_device_hidn')->result(); // Mengambil semua data dari ms_device_hidn
    }

    public function get_by_id($id) {
        return $this->db->get_where('ms_device_hidn', ['device_hidn_id' => $id])->row();  // Ambil data berdasarkan ID dari ms_device_hidn
    }

    public function insert($data) {
        $this->db->insert('ms_device_hidn', $data);  // Insert data baru ke ms_device_hidn
    }

    public function get_all_sub_devices() {
        $query = $this->db->get('ms_sub_device')->result();
        print_r($query); // Debug
        exit;
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
