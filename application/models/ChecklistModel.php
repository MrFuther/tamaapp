<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChecklistModel extends CI_Model {
    
    public function save_form($data) {
        $form_data = [
            'activity_id' => $data['activity_id'],
            'area_id' => $data['area_id'],
            'report_type' => $data['report_type'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('activity_form', $form_data);
        return $this->db->insert_id();
    }

    public function save_checklist($data) {
        $this->db->trans_start();
        
        foreach($data['device_ids'] as $key => $device_id) {
            if(!empty($device_id)) {
                $checklist_data = [
                    'form_id' => $data['form_id'],
                    'device_id' => $device_id,
                    'indicator_check' => $data['indicator_check'][$key],
                    'ink_check' => $data['ink_check'][$key],
                    'color_check' => $data['color_check'][$key],
                    'notes' => $data['notes'][$key],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('activity_checklist', $checklist_data);
            }
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_form_by_activity($activity_id) {
        $this->db->select('*');
        $this->db->from('activity_form');
        $this->db->where('activity_id', $activity_id);
        $query = $this->db->get();
        
        return $query->row();
    }
}