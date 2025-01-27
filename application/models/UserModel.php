<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_users() {
        // Fetch all users from ms_account table
        return $this->db->get('ms_account')->result_array();
    }

    public function add_user($username, $password, $role) {
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('ms_account', $data);
    }

    public function update_role($id, $role) {
        $data = [
            'role' => $role
        ];
        $this->db->where('id', $id);
        return $this->db->update('ms_account', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('ms_account');
    }
}
