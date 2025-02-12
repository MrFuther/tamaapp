<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonelModel extends CI_Model {

    private $table = "personel";
    private $relation_table = "personel_user";

    public function get_all_personel() {
        $this->db->select('personel.id_personel, shift_kerja.nama_shift, shift_kerja.jam_mulai, shift_kerja.jam_selesai');
        $this->db->from($this->table);
        $this->db->join('shift_kerja', 'personel.shift_id = shift_kerja.id_shift');
        $personel_data = $this->db->get()->result();

        foreach ($personel_data as $p) {
            $p->users = $this->get_users_by_personel($p->id_personel);
        }
        return $personel_data;
    }

    public function get_users_by_personel($personel_id) {
        $this->db->select('ms_account.username');
        $this->db->from($this->relation_table);
        $this->db->join('ms_account', 'personel_user.user_id = ms_account.id');
        $this->db->where('personel_user.personel_id', $personel_id);
        return $this->db->get()->result();
    }

    public function get_all_users() {
        return $this->db->get('ms_account')->result();
    }

    public function get_all_shifts() {
        return $this->db->get('shift_kerja')->result();
    }

    public function insert_personel($shift_id, $user_ids) {
        $this->db->insert($this->table, ['shift_id' => $shift_id]);
        $personel_id = $this->db->insert_id();

        foreach ($user_ids as $user_id) {
            $this->db->insert($this->relation_table, [
                'personel_id' => $personel_id,
                'user_id' => $user_id
            ]);
        }
        return true;
    }

    public function delete_personel($id) {
        $this->db->delete($this->relation_table, ['personel_id' => $id]);
        return $this->db->delete($this->table, ['id_personel' => $id]);
    }
}
?>
