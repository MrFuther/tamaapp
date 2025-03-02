<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_devicehidn extends CI_Model {

    public function get_all_devicehidn() {
        $this->db->select('d.*, s.sub_device_id, g.pek_unit_id, sa.sub_area_id, a.area_id');  // Pilih kolom yang akan diambil
        $this->db->from('ms_device_hidn d');  // Pilih tabel yang akan diambil
        $this->db->join('ms_sub_device s', 'd.sub_device_name = s.sub_device_name', 'left');  // Gabungkan tabel ms_device_hidn dengan ms_sub_device
        $this->db->join('ms_groupdevices g', 'd.pek_unit_name = g.pek_unit_name', 'left');  // Gabungkan dengan ms_groupdevices
        $this->db->join('ms_sub_area sa', 'd.sub_area_name = sa.sub_area_name', 'left');  // Gabungkan dengan ms_sub_area
        $this->db->join('ms_area a', 'd.area_name = a.area_name', 'left');  // Gabungkan dengan ms_area
        return $this->db->get()->result(); // Mengambil semua data dari ms_device_hidn
    }

    public function get_by_id($id) {
        return $this->db->get_where('ms_device_hidn', ['device_hidn_id' => $id])->row();  // Ambil data berdasarkan ID dari ms_device_hidn
    }

    public function insert($data) {
        $this->db->insert('ms_device_hidn', $data);  // Insert data baru ke ms_device_hidn
        return $this->db->insert_id(); // Mengembalikan ID yang baru saja dimasukkan
    }
    
    // Tambahkan method untuk mengambil semua sub devices
    public function get_all_sub_devices() {
        return $this->db->get('ms_sub_device')->result();  // Mengambil semua data dari ms_sub_device
    }
    
    // Method untuk mengambil semua group devices
    public function get_all_groupdevices() {
        return $this->db->get('ms_groupdevices')->result();  // Mengambil semua data dari ms_groupdevices
    }
    
    // Method untuk mengambil semua area
    public function get_all_areas() {
        return $this->db->get('ms_area')->result();  // Mengambil semua data dari ms_area
    }
    
    // Method untuk mengambil semua sub area
    public function get_all_sub_areas() {
        return $this->db->get('ms_sub_area')->result();  // Mengambil semua data dari ms_sub_area
    }
    
    // Method untuk mengambil sub area berdasarkan area_name
    public function get_sub_areas_by_area($area_name) {
        return $this->db->get_where('ms_sub_area', ['gr_area_name' => $area_name])->result();
    }
      
    public function update($id, $data) {
        $this->db->where('device_hidn_id', $id);
        $this->db->update('ms_device_hidn', $data);  // Update data pada ms_device_hidn berdasarkan ID
        return $this->db->affected_rows(); // Mengembalikan jumlah baris yang terpengaruh
    }

    public function delete($id) {
        $this->db->where('device_hidn_id', $id);
        $this->db->delete('ms_device_hidn');  // Hapus data berdasarkan ID di ms_device_hidn
        return $this->db->affected_rows(); // Mengembalikan jumlah baris yang terpengaruh
    }
    
    // Mengambil data sub_device berdasarkan ID
    public function get_sub_device_by_id($id) {
        return $this->db->get_where('ms_sub_device', ['sub_device_id' => $id])->row();
    }
    
    // Mengambil data group_device berdasarkan ID
    public function get_groupdevice_by_id($id) {
        return $this->db->get_where('ms_groupdevices', ['pek_unit_id' => $id])->row();
    }
    
    // Mengambil data area berdasarkan ID
    public function get_area_by_id($id) {
        if (empty($id)) {
            return null;
        }
        $result = $this->db->get_where('ms_area', ['area_id' => $id])->row();
        log_message('debug', 'get_area_by_id - area_id: ' . $id . ', result: ' . json_encode($result));
        return $result;
    }
    
    // Mengambil data sub_area berdasarkan ID
    public function get_sub_area_by_id($id) {
        if (empty($id)) {
            return null;
        }
        $result = $this->db->get_where('ms_sub_area', ['sub_area_id' => $id])->row();
        log_message('debug', 'get_sub_area_by_id - sub_area_id: ' . $id . ', result: ' . json_encode($result));
        return $result;
    }
    
    // Mengambil data sub_device berdasarkan pek_unit_name
    public function get_sub_devices_by_pek_unit($pek_unit_name) {
        return $this->db->get_where('ms_sub_device', ['pek_unit_name' => $pek_unit_name])->result();
    }
}