<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActivityModel extends CI_Model {

    private $table = "activity_pm";

    public function get_all_activities() {
        $this->db->select('activity_pm.id_activity, activity_pm.kode_activity, personel.id_personel, shift_kerja.nama_shift, shift_kerja.jam_mulai, shift_kerja.jam_selesai, activity_pm.tanggal_kegiatan');
        $this->db->from('activity_pm');
        $this->db->join('personel', 'activity_pm.personel_id = personel.id_personel');
        $this->db->join('shift_kerja', 'activity_pm.shift_id = shift_kerja.id_shift');
        $activities = $this->db->get()->result();
    
        foreach ($activities as $activity) {
            $activity->users = $this->get_users_by_personel($activity->id_personel) ?: [];
        }
    
        return $activities;
    }
    

    public function get_all_personel() {
        $this->db->select('personel.id_personel, GROUP_CONCAT(ms_account.username SEPARATOR ", ") as usernames');
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
        $this->db->select('ms_account.username');
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
        return $this->db->delete($this->table, ['id_activity' => $id]);
    }
    
    public function get_activity_details($activity_id) {
        $this->db->select('activity_pm.id_activity, activity_pm.kode_activity, personel.id_personel, shift_kerja.nama_shift, shift_kerja.jam_mulai, shift_kerja.jam_selesai, activity_pm.tanggal_kegiatan');
        $this->db->from('activity_pm');
        $this->db->join('personel', 'activity_pm.personel_id = personel.id_personel');
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
    
    public function get_areas() {
        return $this->db->get('ms_area')->result();
    }
    
    public function get_activity_forms($activity_id) {
        $this->db->select('f.*, sd.sub_device_name, a.area_name');
        $this->db->from('activity_forms f');
        $this->db->join('ms_sub_device sd', 'sd.sub_device_id = f.sub_device_id');
        $this->db->join('ms_area a', 'a.area_id = f.area_id');
        $this->db->where('f.activity_id', $activity_id);
        return $this->db->get()->result();
    }
    
    public function save_form($data) {
        return $this->db->insert('activity_forms', $data);
    }
    
    public function delete_form($form_id) {
        return $this->db->delete('activity_forms', ['form_id' => $form_id]);
    }
}
?>
