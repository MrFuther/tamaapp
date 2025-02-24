<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    public function check_user_exists($username) {
        $query = $this->db->get_where('ms_account', array('username' => $username));
        return $query->num_rows() > 0;
    }
    
    public function check_login($username, $password) {
        $query = $this->db->get_where('ms_account', array('username' => $username));
        $user = $query->row();
        
        if($user) {
            // Ganti ke verifikasi SHA256
            if(verifyPassword($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
}