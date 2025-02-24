<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('hash');
        $this->load->helper('url');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Cek apakah user terdaftar
            if (!$this->Auth_model->check_user_exists($username)) {
                $response = array(
                    'status' => 'error',
                    'message' => 'User is not registered. Please contact administrator'
                );
                log_message('error', 'Login failed: User does not exist');
                echo json_encode($response);
                return;
            }

            // Cek login
            $user = $this->Auth_model->check_login($username, $password);

            if ($user) {
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
                log_message('info', 'User logged in: ' . $username . ', Role: ' . $user->role);
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Password is incorrect'
                );
                log_message('error', 'Login failed: Incorrect password for username ' . $username);
                echo json_encode($response);
            }
        }
    }

    public function logout() {
        $username = $this->session->userdata('username');
        $this->session->sess_destroy();
        log_message('info', 'User logged out: ' . $username);
        redirect('auth');
    }
}
