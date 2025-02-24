<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Pastikan hanya admin yang bisa akses
        if(!$this->session->userdata('logged_in') || 
           $this->session->userdata('role') !== 'admin') {
            die('Access Denied');
        }
        $this->load->model('UserModel');
        $this->load->helper('hash');
    }
    
    public function migrate_passwords() {
        // Backup database terlebih dahulu
        $this->backup_database();
        
        // Jalankan migrasi
        if($this->UserModel->migrate_to_sha256()) {
            echo "Migration completed successfully. Default passwords are [username]123";
        } else {
            echo "Migration failed!";
        }
    }
    
    private function backup_database() {
        $this->load->dbutil();
        $backup = $this->dbutil->backup();
        $this->load->helper('file');
        write_file('backup_'.date('Y-m-d_H-i-s').'.sql', $backup);
    }
}