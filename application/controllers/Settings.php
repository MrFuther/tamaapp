<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models
        $this->load->model('Account_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('hash_helper');
        $this->load->helper('url');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Pengaturan Akun';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->Account_model->get_account_by_id($this->session->userdata('user_id'));
        
        $this->load->view('dashboard/settings', $data);
    }
    
    public function update_password() {
        // Validation rules
        $this->form_validation->set_rules('current_password', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|trim|matches[new_password]');
        
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, return to settings page with errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('settings');
        } else {
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            
            // Verify current password
            $user = $this->Account_model->get_account_by_id($user_id);
            
            // Menggunakan verifyPassword() dari helper
            if (!verifyPassword($current_password, $user->password)) {
                $this->session->set_flashdata('error', 'Password lama tidak sesuai!');
                redirect('settings');
            }
            
            // Update password dengan menggunakan createSecureHash() dari helper
            $hashed_password = createSecureHash($new_password);
            $result = $this->Account_model->update_password_hash($user_id, $hashed_password);
            
            if ($result) {
                $this->session->set_flashdata('success', 'Password berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui password. Silakan coba lagi.');
            }
            
            redirect('settings');
        }
    }
    
    public function update_signature() {
        // Configure upload
        $config['upload_path'] = './uploads/signatures/';
        $config['allowed_types'] = 'png';
        $config['max_size'] = 2048; // 2MB
        
        // Create directory with proper permissions if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }
        
        // Ensure the directory is writable
        if (!is_writable($config['upload_path'])) {
            chmod($config['upload_path'], 0755);
        }
        
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('signature')) {
            // Upload failed
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('settings');
        } else {
            // Upload successful
            $upload_data = $this->upload->data();
            $signature_file_path = $upload_data['full_path'];
            
            // Read the file content as binary data
            $signature_binary = file_get_contents($signature_file_path);
            
            // Get current user
            $user_id = $this->session->userdata('user_id');
            
            // Update signature in database
            $result = $this->Account_model->update_signature($user_id, $signature_binary);
            
            // Remove temporary file
            if (file_exists($signature_file_path)) {
                unlink($signature_file_path);
            }
            
            if ($result) {
                $this->session->set_flashdata('success', 'Tanda tangan berhasil diperbarui!');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui tanda tangan. Silakan coba lagi.');
            }
        }
        
        redirect('settings');
    }
    
    // Method to display signature image directly (for use in other parts of the application)
    public function get_signature($id = null) {
        // If no ID is provided, use the currently logged-in user's ID
        if (is_null($id)) {
            $id = $this->session->userdata('user_id');
        }
        
        // Check permission - users should only be able to see their own or have admin access
        if ($id != $this->session->userdata('user_id') && $this->session->userdata('role') != 'admin') {
            show_error('Unauthorized access', 403);
        }
        
        $signature = $this->Account_model->get_signature($id);
        
        if (empty($signature)) {
            show_404('Signature not found');
        }
        
        // Output the image
        header('Content-Type: image/png');
        echo $signature;
        exit;
    }

    public function check_signature() {
        // Set JSON response header
        header('Content-Type: application/json');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['has_signature' => false, 'message' => 'User not logged in']);
            return;
        }
        
        // Get current user ID
        $user_id = $this->session->userdata('user_id');
        
        // Get signature
        $signature = $this->Account_model->get_signature($user_id);
        
        // Return response
        echo json_encode([
            'has_signature' => !empty($signature),
            'message' => !empty($signature) ? 'Signature found' : 'No signature found'
        ]);
    }
}