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
            // Tambahkan log untuk debugging
            error_log('Stored Hash: ' . $user->password);
            error_log('Input Password: ' . $password);
            $verify = password_verify($password, $user->password);
            error_log('Password Verify Result: ' . ($verify ? 'true' : 'false'));
            
            if($verify) {
                return $user;
            }
        }
        return false;
    }
}