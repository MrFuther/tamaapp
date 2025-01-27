<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeviceModel extends CI_Model
{
    public function getDevicesByLocation($location_id)
    {
        $this->db->where('location_id', $location_id);
        return $this->db->get('device_info')->result_array();
    }

    public function addDevice($data)
    {
        return $this->db->insert('device_info', $data);
    }
}
