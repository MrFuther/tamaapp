<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChecklistModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get checklist questions based on sub_device_id and report_type
     * 
     * @param int $sub_device_id The ID of the sub device
     * @param string $report_type The report type (Harian, Mingguan, Bulanan)
     * @return array Array of checklist questions
     */
    
    public function get_checklist_questions($sub_device_id, $report_type) {
        $this->db->select('*');
        $this->db->from('device_checklist');
        $this->db->where('sub_device_id', $sub_device_id);
        $this->db->where('report_type', $report_type);
        $this->db->order_by('question_number', 'ASC');
        
        $query = $this->db->get();
        
        if (!$query) {
            log_message('error', 'Database error in get_checklist_questions: ' . $this->db->error()['message']);
            return [];
        }
        
        return $query->result();
    }

    /**
     * Count checklist questions for a specific sub_device and report_type
     * 
     * @param int $sub_device_id The ID of the sub device
     * @param string $report_type The report type (Harian, Mingguan, Bulanan)
     * @return int Number of questions
     */
    public function count_checklist_questions($sub_device_id, $report_type) {
        $this->db->where('sub_device_id', $sub_device_id);
        $this->db->where('report_type', $report_type);
        return $this->db->count_all_results('device_checklist');
    }
    
    /**
     * Get device details including the number of questions for different report types
     * 
     * @param int $sub_device_id The ID of the sub device
     * @return object Device details
     */
    public function get_device_with_question_counts($sub_device_id) {
        $device = $this->db->get_where('ms_sub_device', ['sub_device_id' => $sub_device_id])->row();
        
        if ($device) {
            $device->harian_count = $this->count_checklist_questions($sub_device_id, 'Harian');
            $device->mingguan_count = $this->count_checklist_questions($sub_device_id, 'Mingguan');
            $device->bulanan_count = $this->count_checklist_questions($sub_device_id, 'Bulanan');
        }
        
        return $device;
    }

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