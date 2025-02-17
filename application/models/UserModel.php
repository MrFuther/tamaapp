<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_users() {
        // Fetch all users with their unit kerja
        $this->db->select('ms_account.*, ms_unit_kerja.unit_name');
        $this->db->from('ms_account');
        $this->db->join('ms_unit_kerja', 'ms_account.unit_id = ms_unit_kerja.unit_id', 'left');
        return $this->db->get()->result_array();
    }

    public function get_units() {
        // Fetch all unit kerja
        return $this->db->get('ms_unit_kerja')->result_array();
    }

    public function add_user($username, $password, $role, $unit_id) {
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'unit_id' => $unit_id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('ms_account', $data);
    }

    public function update_user($id, $role, $unit_id) {
        $data = [
            'role' => $role,
            'unit_id' => $unit_id
        ];
        $this->db->where('id', $id);
        return $this->db->update('ms_account', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('ms_account');
    }
}
