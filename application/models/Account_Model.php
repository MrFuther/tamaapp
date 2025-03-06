<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    private $table = 'ms_account';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_account_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    
    public function get_account_by_username($username) {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }
    
    public function verify_password($stored_password, $input_password) {
        // Using the same hashing method as in UserModel
        $hashed_input = $this->create_secure_hash($input_password);
        return ($hashed_input === $stored_password);
    }
    
    public function update_password($id, $password) {
        // Menggunakan SHA-256 secara langsung sesuai dengan metode yang digunakan di aplikasi Anda
        $hashed_password = hash('sha256', $password);
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['password' => $hashed_password]);
    }
    
    public function update_password_hash($id, $hashed_password) {
        // Langsung menggunakan hash yang sudah disiapkan (tidak perlu hashing lagi)
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['password' => $hashed_password]);
    }

    public function update_signature($id, $signature) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['signature' => $signature]);
    }
    
    public function get_signature($id) {
        $this->db->select('signature');
        $query = $this->db->get_where($this->table, ['id' => $id]);
        $result = $query->row();
        return $result ? $result->signature : null;
    }
    
    // Create secure hash - duplicated from the helper function used in UserModel
    private function create_secure_hash($password) {
        // This should match the createSecureHash function used elsewhere
        return hash('sha256', $password);
    }
    
    // Get all account data with unit information
    public function get_all_accounts() {
        $this->db->select($this->table.'.*, ms_unit_kerja.unit_name');
        $this->db->from($this->table);
        $this->db->join('ms_unit_kerja', $this->table.'.unit_id = ms_unit_kerja.unit_id', 'left');
        return $this->db->get()->result();
    }
    
    // Update account information
    public function update_account($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
}