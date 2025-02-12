<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActivityModel extends CI_Model {

    private $table = "activity_pm";

    public function get_all_activities() {
        $this->db->select('activity_pm.id_activity, personel.id_personel, shift_kerja.nama_shift, shift_kerja.jam_mulai, shift_kerja.jam_selesai, activity_pm.tanggal_kegiatan');
        $this->db->from('activity_pm');
        $this->db->join('personel', 'activity_pm.personel_id = personel.id_personel');
        $this->db->join('shift_kerja', 'activity_pm.shift_id = shift_kerja.id_shift');
        $activities = $this->db->get()->result();
    
        // Pastikan users di-set untuk setiap aktivitas
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

    public function generate_activity_id() {
        $date = date('dmy'); // Format tanggal: 120225
        $random = rand(100, 999);
        return "ACT_".$date.$random;
    }

    public function insert_activity($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete_activity($id) {
        return $this->db->delete($this->table, ['id_activity' => $id]);
    }
}
?>
