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

    public function get_activity_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('activities')->row_array();  // Menggunakan row_array() untuk mendapatkan satu hasil
    }

    // Fungsi untuk mendapatkan dokumentasi berdasarkan ID aktivitas
    public function get_documentation_by_activity($activity_id)
    {
        $this->db->where('activity_id', $activity_id);
        return $this->db->get('documentation')->result_array();
    }

    public function add_documentation($data)
    {
        // Menyimpan dokumentasi ke dalam database
        return $this->db->insert('documentation', $data);
    }

    public function getSubAreasByGroup($group_id) {
        // Mengambil sub-area berdasarkan group area
        $this->db->select('sub_area_id AS id, sub_area_name AS name');
        $this->db->from('ms_sub_area');
        $this->db->where('area_id', $group_id);
        $query = $this->db->get();

        // Mengembalikan hasil sebagai array
        return $query->result_array();
    }
}
