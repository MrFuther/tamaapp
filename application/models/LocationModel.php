<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LocationModel extends CI_Model
{
    public function getAllLocations()
    {
        return $this->db->get('locations')->result_array();
    }

    public function addLocation($data)
    {
        return $this->db->insert('locations', $data);
    }
}
