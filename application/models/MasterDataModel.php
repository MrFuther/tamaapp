<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterDataModel extends CI_Model
{
    // Fetch all users (for personnel selection)
    public function getUsers()
    {
        return $this->db->get('ms_account')->result_array();
    }

    // -------------------- LOCATIONS --------------------

    /**
     * Get all locations
     */
    public function getAllLocations()
    {
        return $this->db->get('locations')->result_array();
    }

    /**
     * Add a new location
     */
    public function addLocation($data)
    {
        return $this->db->insert('locations', $data);
    }

    /**
     * Delete a location by ID
     */
    public function deleteLocation($location_id)
    {
        $this->db->where('id', $location_id);
        return $this->db->delete('locations');
    }

    // -------------------- DEVICE INFO --------------------

    /**
     * Get all devices by location ID
     */
    public function getDevicesByLocation($location_id)
    {
        $this->db->where('location_id', $location_id);
        return $this->db->get('device_info')->result_array();
    }

    public function getAllDevices()
    {
    return $this->db->get('device_info')->result_array(); // Ambil semua data dari tabel device_info
    }

    /**
     * Add a new device
     */
    public function addDevice($data)
    {
        return $this->db->insert('device_info', $data);
    }

    /**
     * Delete a device by ID
     */
    public function deleteDevice($device_id)
    {
        $this->db->where('id', $device_id);
        return $this->db->delete('device_info');
    }

    // -------------------- SHIFT & PERSONNEL --------------------

    /**
     * Get all shifts and personnel by location ID
     */
    public function getShiftsByLocation($location_id)
    {
        $this->db->where('location_id', $location_id);
        return $this->db->get('shift_personnel')->result_array();
    }

    /**
     * Add shift and personnel
     */
    public function addShiftPersonnel($data)
    {
        return $this->db->insert('shift_personnel', $data);
    }

    /**
     * Delete shift and personnel by ID
     */
    public function deleteShiftPersonnel($shift_id)
    {
        $this->db->where('id', $shift_id);
        return $this->db->delete('shift_personnel');
    }
}
