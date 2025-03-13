<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActivityModel extends CI_Model {

    private $table = "activity_pm";

    public function get_all_activities() {
        $this->db->select('
            ap.id_activity,
            ap.kode_activity,
            ap.tanggal_kegiatan,
            sk.nama_shift,
            sk.jam_mulai,
            sk.jam_selesai,
            GROUP_CONCAT(DISTINCT ms.nama_pegawai SEPARATOR ", ") as usernames
        ');
        $this->db->from('activity_pm ap');
        $this->db->join('shift_kerja sk', 'sk.id_shift = ap.shift_id');
        $this->db->join('activity_personel apr', 'apr.activity_id = ap.id_activity', 'left');
        $this->db->join('ms_account ms', 'ms.id = apr.user_id', 'left');
        $this->db->group_by('ap.id_activity, ap.kode_activity, ap.tanggal_kegiatan, sk.nama_shift, sk.jam_mulai, sk.jam_selesai');
        $this->db->order_by('ap.tanggal_kegiatan', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_all_users() {
        return $this->db->select('id, nama_pegawai')
                        ->from('ms_account')
                        ->get()
                        ->result();
    }

    public function get_all_personel() {
        $this->db->select('personel.id_personel, GROUP_CONCAT(ms_account.nama_pegawai SEPARATOR ", ") as nama_pegawai');
        $this->db->from('personel');
        $this->db->join('personel_user', 'personel.id_personel = personel_user.personel_id');
        $this->db->join('ms_account', 'personel_user.user_id = ms_account.id');
        $this->db->group_by('personel.id_personel');
        return $this->db->get()->result();
    }
    

    public function get_all_shifts() {
        return $this->db->get('shift_kerja')->result();
    }

    public function get_users_by_personel($personel_id) {
        $this->db->select('ms_account.nama_pegawai');
        $this->db->from('personel_user');
        $this->db->join('ms_account', 'personel_user.user_id = ms_account.id');
        $this->db->where('personel_user.personel_id', $personel_id);
        return $this->db->get()->result();
    }

    public function generate_activity_code() {
        $date = date('dmy'); // Format tanggal: 120225
        $random = rand(100, 999);
        return "ACT_".$date.$random;
    }

    public function insert_activity($data) {
        // Generate kode activity
        $data['kode_activity'] = $this->generate_activity_code();
        return $this->db->insert($this->table, $data);
    }

    public function delete_activity($id) {
        // Begin transaction
        $this->db->trans_begin();
        
        try {
            // First get all form IDs associated with this activity
            $this->db->select('form_id');
            $this->db->from('activity_forms');
            $this->db->where('activity_id', $id);
            $query = $this->db->get();
            $forms = $query->result();
            
            // Delete all form data records associated with these forms
            if (!empty($forms)) {
                $form_ids = array_map(function($form) {
                    return $form->form_id;
                }, $forms);
                
                $this->db->where_in('form_id', $form_ids);
                $this->db->delete('activity_form_data');
            }
            
            // Now delete the forms
            $this->db->delete('activity_forms', ['activity_id' => $id]);
            
            // Then delete the personnel assignments
            $this->db->delete('activity_personel', ['activity_id' => $id]);
            
            // Finally delete the activity itself
            $this->db->delete($this->table, ['id_activity' => $id]);
            
            // Commit the transaction
            $this->db->trans_commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction on error
            $this->db->trans_rollback();
            log_message('error', 'Delete activity failed: ' . $e->getMessage());
            return false;
        }
    }
    
    public function get_activity_details($activity_id) {
        $this->db->select('activity_pm.id_activity, activity_pm.kode_activity, activity_personel.id, shift_kerja.nama_shift, shift_kerja.jam_mulai, shift_kerja.jam_selesai, activity_pm.tanggal_kegiatan');
        $this->db->from('activity_pm');
        $this->db->join('activity_personel', 'activity_pm.id_activity = activity_personel.id');
        $this->db->join('shift_kerja', 'activity_pm.shift_id = shift_kerja.id_shift');
        $this->db->where('activity_pm.id_activity', $activity_id);
        return $this->db->get()->row();
    }

    public function get_area_options() {
        return $this->db->get('ms_area')->result(); // Mengambil data area
    }
    
    public function get_group_devices() {
        return $this->db->get('ms_groupdevices')->result(); // Mengambil grup perangkat
    }
    
    public function get_sub_devices() {
        return $this->db->get('ms_sub_device')->result(); // Mengambil sub perangkat
    }
    
    public function get_device_hidn() {
        return $this->db->get('ms_device_hidn')->result(); // Mengambil perangkat
    }

    public function get_devices() {
        $query = $this->db->get('ms_device_hidn');  // Mengambil data perangkat dari tabel `ms_device_hidn`
        return $query->result();  // Mengembalikan hasil sebagai array
    }

    public function get_activities() {
        $this->db->select('
            a.*,
            s.nama_shift,
            CONCAT("Personel ID: ", p.id_personel) as personel_name
        ');
        $this->db->from('activity_pm a');
        $this->db->join('shift_kerja s', 's.id_shift = a.shift_id');
        $this->db->join('personel p', 'p.id_personel = a.personel_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_activity_detail($id) {
        $this->db->select('
            a.*,
            s.nama_shift,
            s.jam_mulai,
            s.jam_selesai,
            CONCAT("Personel ID: ", p.id_personel) as personel_name
        ');
        $this->db->from('activity_pm a');
        $this->db->join('shift_kerja s', 's.id_shift = a.shift_id');
        $this->db->join('personel p', 'p.id_personel = a.personel_id', 'left');
        $this->db->where('a.id_activity', $id);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            // Format the date and time
            $result->formatted_date = date('d/m/Y', strtotime($result->tanggal_kegiatan));
            $result->shift_time = date('H:i', strtotime($result->jam_mulai)) . ' - ' . 
                                date('H:i', strtotime($result->jam_selesai));
            return $result;
        }
        return null;
    }

    public function get_activity_users($activity_id) {
        return $this->db->select('ms.id, ms.nama_pegawai')
            ->from('activity_personel ap')
            ->join('ms_account ms', 'ms.id = ap.user_id')
            ->where('ap.activity_id', $activity_id)
            ->get()
            ->result();
    }
    
    public function get_areas() {
        return $this->db->get('ms_area')->result();
    }
    
    public function get_activity_forms($activity_id) {
        $this->db->select('af.form_id, af.activity_id, af.sub_device_id, af.report_type, 
                         af.is_approved_ap, af.is_approved_ias, 
                         af.approved_by_ap, af.approved_by_ias, 
                         sd.sub_device_name');
        $this->db->from('activity_forms af');
        $this->db->join('ms_sub_device sd', 'sd.sub_device_id = af.sub_device_id');
        $this->db->where('af.activity_id', $activity_id);
        
        $forms = $this->db->get()->result();
        
        // Ambil data area untuk setiap form
        foreach ($forms as &$form) {
            $form->areas = $this->get_form_areas($form->form_id);
            
            // Gabungkan nama area menjadi satu string
            $area_names = array_map(function($area) {
                return $area->area_name;
            }, $form->areas);
            
            $form->area_names = implode(', ', $area_names);
        }
        
        return $forms;
    }

    public function get_all_devices() {
        $query = $this->db->select('device_hidn_id, device_hidn_name')
                          ->from('ms_device_hidn')
                          ->get();
                          
        if (!$query) {
            throw new Exception('Database error: ' . $this->db->error()['message']);
        }
        
        return $query->result();
    }
    
    public function save_form_areas($form_id, $area_ids) {
        // Hapus data area yang ada terlebih dahulu
        $this->db->delete('activity_form_areas', ['form_id' => $form_id]);
        
        // Insert data area baru
        foreach ($area_ids as $area_id) {
            $this->db->insert('activity_form_areas', [
                'form_id' => $form_id,
                'area_id' => $area_id
            ]);
        }
        
        return true;
    }
    
    public function get_form_areas($form_id) {
        $this->db->select('afa.area_id, a.area_name');
        $this->db->from('activity_form_areas afa');
        $this->db->join('ms_area a', 'a.area_id = afa.area_id');
        $this->db->where('afa.form_id', $form_id);
        
        return $this->db->get()->result();
    }
    
    public function delete_form($form_id) {
        return $this->db->delete('activity_forms', ['form_id' => $form_id]);
    }

    public function get_activities_paginated($limit, $offset) {
        $this->db->select('
            ap.id_activity,
            ap.kode_activity,
            ap.tanggal_kegiatan,
            sk.nama_shift,
            sk.jam_mulai,
            sk.jam_selesai,
            GROUP_CONCAT(DISTINCT ms.nama_pegawai SEPARATOR ", ") as usernames
        ');
        $this->db->from('activity_pm ap');
        $this->db->join('shift_kerja sk', 'sk.id_shift = ap.shift_id');
        $this->db->join('activity_personel apr', 'apr.activity_id = ap.id_activity', 'left');
        $this->db->join('ms_account ms', 'ms.id = apr.user_id', 'left');
        $this->db->group_by('ap.id_activity, ap.kode_activity, ap.tanggal_kegiatan, sk.nama_shift, sk.jam_mulai, sk.jam_selesai');
        $this->db->order_by('ap.tanggal_kegiatan', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all_activities() {
        // We need to count the distinct activities since we're using GROUP BY in the main query
        $this->db->select('COUNT(DISTINCT ap.id_activity) as count');
        $this->db->from('activity_pm ap');
        $query = $this->db->get();
        $result = $query->row();
        return $result->count;
    }

    public function search_activities($search_term, $limit, $offset) {
        $this->db->select('
            ap.id_activity,
            ap.kode_activity,
            ap.tanggal_kegiatan,
            sk.nama_shift,
            sk.jam_mulai,
            sk.jam_selesai,
            GROUP_CONCAT(DISTINCT ms.nama_pegawai SEPARATOR ", ") as usernames
        ');
        $this->db->from('activity_pm ap');
        $this->db->join('shift_kerja sk', 'sk.id_shift = ap.shift_id');
        $this->db->join('activity_personel apr', 'apr.activity_id = ap.id_activity', 'left');
        $this->db->join('ms_account ms', 'ms.id = apr.user_id', 'left');
        
        // Apply search conditions
        $this->db->group_start();
        $this->db->like('ap.kode_activity', $search_term);
        $this->db->or_like('ap.tanggal_kegiatan', $search_term);
        $this->db->or_like('sk.nama_shift', $search_term);
        $this->db->or_like('ms.nama_pegawai', $search_term);
        $this->db->group_end();
        
        $this->db->group_by('ap.id_activity, ap.kode_activity, ap.tanggal_kegiatan, sk.nama_shift, sk.jam_mulai, sk.jam_selesai');
        $this->db->order_by('ap.tanggal_kegiatan', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function count_search_activities($search_term) {
        $this->db->select('COUNT(DISTINCT ap.id_activity) as count');
        $this->db->from('activity_pm ap');
        $this->db->join('shift_kerja sk', 'sk.id_shift = ap.shift_id');
        $this->db->join('activity_personel apr', 'apr.activity_id = ap.id_activity', 'left');
        $this->db->join('ms_account ms', 'ms.id = apr.user_id', 'left');
        
        // Apply search conditions
        $this->db->group_start();
        $this->db->like('ap.kode_activity', $search_term);
        $this->db->or_like('ap.tanggal_kegiatan', $search_term);
        $this->db->or_like('sk.nama_shift', $search_term);
        $this->db->or_like('ms.nama_pegawai', $search_term);
        $this->db->group_end();
        
        $query = $this->db->get();
        $result = $query->row();
        return $result->count;
    }

    public function approve_form($form_id, $user_id, $signature_type = 'ap') {
        // Check if the form exists
        $form = $this->db->get_where('activity_forms', ['form_id' => $form_id])->row();
        if (!$form) {
            return false;
        }
        
        // Determine which field to update based on signature type
        $field_to_update = ($signature_type == 'ap') ? 'approved_by_ap' : 'approved_by_ias';
        $is_approved_field = ($signature_type == 'ap') ? 'is_approved_ap' : 'is_approved_ias';
        
        // Update the form with the approval
        $this->db->where('form_id', $form_id);
        return $this->db->update('activity_forms', [
            $field_to_update => $user_id,
            $is_approved_field => 1,
            'approval_date_' . $signature_type => date('Y-m-d H:i:s')
        ]);
    }
    
    public function get_form_approval_status($form_id) {
        $this->db->select('af.*, ap_user.nama_pegawai as ap_approver_name, ias_user.nama_pegawai as ias_approver_name, ap_user.signature as ap_signature, ias_user.signature as ias_signature')
                ->from('activity_forms af')
                ->join('ms_account ap_user', 'ap_user.id = af.approved_by_ap', 'left')
                ->join('ms_account ias_user', 'ias_user.id = af.approved_by_ias', 'left')
                ->where('af.form_id', $form_id);
        
        return $this->db->get()->row();
    }
}
?>
