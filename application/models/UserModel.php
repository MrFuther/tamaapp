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
            'password' => createSecureHash($password), // Ganti ke SHA256
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

    public function migrate_to_sha256() {
        // 1. Ambil semua user
        $users = $this->db->get('ms_account')->result();
        
        // 2. Update password untuk setiap user
        foreach($users as $user) {
            // Set password sementara (misalnya: username123)
            $temp_password = $user->username . "123";
            
            // Hash password dengan SHA256
            $new_hash = createSecureHash($temp_password);
            
            // Update password di database
            $this->db->where('id', $user->id);
            $this->db->update('ms_account', ['password' => $new_hash]);
            
            // Log perubahan
            log_message('info', 'Migrated password for user: ' . $user->username);
        }
        
        return true;
    }
}
