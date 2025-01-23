<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function get_all_users() {
        // Ambil semua user dari tabel ms_account
        return $this->db->get('ms_account')->result_array();
    }

    public function add_user($data) {
        $this->db->insert('ms_account', $data);
    }

    public function update_user_role($id, $role) {
        $this->db->where('id', $id);
        $this->db->update('ms_account', ['role' => $role]);
    }
}
