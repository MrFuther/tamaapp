<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ActivityModel extends CI_Model
{
    public function getAllActivities()
    {
        return $this->db->get('activities')->result_array();
    }

    public function addActivity($data)
    {
        return $this->db->insert('activities', $data);
    }

    public function deleteActivity($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('activities');
    }

    public function getLocations()
    {
    return $this->db->get('locations')->result_array();
    }

    public function getDeviceTypes()
    {
        $this->db->distinct();
        $this->db->select('device_type');
        return $this->db->get('device_info')->result_array();
    }

    public function getDevicesByType($device_type = null)
    {
        if ($device_type) {
            $this->db->where('device_type', $device_type);
        }
        return $this->db->get('device_info')->result_array();
    }

    public function getShifts()
    {
        return ['Pagi', 'Malam'];
    }

    public function getPersonnel()
    {
        return $this->db->get('shift_personnel')->result_array();
    }

    public function get_activity_by_id($id) {
        // Menulis query untuk mengambil data berdasarkan ID
        $this->db->select('*'); // Memilih semua kolom
        $this->db->from('activities'); // Tabel tempat data disimpan (sesuaikan nama tabelnya)
        $this->db->where('id', $id); // Kondisi untuk mencari berdasarkan ID

        // Menjalankan query dan mengembalikan hasilnya
        $query = $this->db->get();

        // Jika data ditemukan, mengembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Mengembalikan data dalam bentuk array
        } else {
            return null; // Jika tidak ditemukan data, mengembalikan null
        }
    }

}
