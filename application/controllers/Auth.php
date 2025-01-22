<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Cek apakah user terdaftar
            $user_exists = $this->Auth_model->check_user_exists($username);
            
            if(!$user_exists) {
                $response = array(
                    'status' => 'error',
                    'message' => 'User is not registered. Please contact administrator'
                );
                echo json_encode($response);
                return;
            }

            // Cek login
            $user = $this->Auth_model->check_login($username, $password);

            if($user) {
                $data = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($data);
                
                $response = array(
                    'status' => 'success',
                    'message' => 'Login successful'
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Password wrong!'
                );
                echo json_encode($response);
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}