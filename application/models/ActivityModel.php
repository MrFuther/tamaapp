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
    
    public function get_activity_details($activity_id) {
        $this->db->select('activity_pm.id_activity, personel.id_personel, shift_kerja.nama_shift, shift_kerja.jam_mulai, shift_kerja.jam_selesai, activity_pm.tanggal_kegiatan');
        $this->db->from('activity_pm');
        $this->db->join('personel', 'activity_pm.personel_id = personel.id_personel');
        $this->db->join('shift_kerja', 'activity_pm.shift_id = shift_kerja.id_shift');
        $this->db->where('activity_pm.id_activity', $activity_id);
        return $this->db->get()->row(); // Mengambil satu aktivitas berdasarkan ID
    }
    
    public function get_documentation_by_activity($activity_id) {
        $this->db->select('*');
        $this->db->from('documentation');
        $this->db->where('id_activity', $activity_id);
        return $this->db->get()->row();  // Mengambil satu data dokumentasi berdasarkan ID aktivitas
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
    
    public function get_documentation($activity_id) {
        $this->db->select('documentation.*, 
                          ms_area.area_name,
                          ms_groupdevices.pek_unit_name,
                          ms_sub_device.sub_device_name,
                          ms_device_hidn.device_hidn_name');
        $this->db->from('documentation');
        $this->db->join('ms_area', 'documentation.area_id = ms_area.area_id');
        $this->db->join('ms_groupdevices', 'documentation.group_device_id = ms_groupdevices.pek_unit_id');
        $this->db->join('ms_sub_device', 'documentation.sub_device_id = ms_sub_device.sub_device_id');
        $this->db->join('ms_device_hidn', 'documentation.device_id = ms_device_hidn.device_hidn_id');
        $this->db->where('documentation.id_activity', $activity_id);
        return $this->db->get()->row();
    }

    // Method untuk foto dokumentasi
    public function get_documentation_photos($documentation_id) {
        return $this->db->get_where('documentation_photos', 
            ['id_documentation' => $documentation_id])->result();
    }

    // Method untuk menambah foto
    public function add_documentation_photo($data) {
        return $this->db->insert('documentation_photos', $data);
    }

    // Method untuk menghapus foto
    public function delete_documentation_photo($photo_id) {
        $photo = $this->get_photo_by_id($photo_id);
        if ($photo) {
            // Hapus file fisik
            if (file_exists('./' . $photo->file_path)) {
                unlink('./' . $photo->file_path);
            }
            // Hapus record dari database
            return $this->db->delete('documentation_photos', ['id_photo' => $photo_id]);
        }
        return false;
    }

    // Method untuk mendapatkan detail foto
    public function get_photo_by_id($photo_id) {
        return $this->db->get_where('documentation_photos', 
            ['id_photo' => $photo_id])->row();
    }

    // Method untuk mengupdate deskripsi foto
    public function update_photo_description($photo_id, $description) {
        return $this->db->update('documentation_photos', 
            ['description' => $description], 
            ['id_photo' => $photo_id]);
    }

    // Method untuk menghitung jumlah foto per dokumentasi
    public function count_documentation_photos($documentation_id) {
        return $this->db->where('id_documentation', $documentation_id)
                        ->count_all_results('documentation_photos');
    }

    // Method untuk mendapatkan semua foto untuk export PDF
    public function get_photos_for_pdf($activity_id) {
        $this->db->select('documentation_photos.*');
        $this->db->from('documentation_photos');
        $this->db->join('documentation', 'documentation_photos.id_documentation = documentation.id_documentation');
        $this->db->where('documentation.id_activity', $activity_id);
        $this->db->order_by('documentation_photos.created_at', 'ASC');
        return $this->db->get()->result();
    }
}
?>
