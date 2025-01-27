<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShiftPersonelModel extends CI_Model
{
    /**
     * Get all shift and personnel data
     */
    public function getAllShiftPersonnel()
    {
        return $this->db->get('shift_personnel')->result_array();
    }

    /**
     * Add shift and personnel data
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
