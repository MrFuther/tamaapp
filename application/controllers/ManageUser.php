<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('UserModel'); // Load the User model
    }

    public function index() {
        // Get users from the database
        $data['title'] = 'MasterReport';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->UserModel->get_users();
        // Load the view
        $this->load->view('dashboard/manage_user', $data);
    }

    public function add_user() {
        // Handle adding a user
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        
        $this->UserModel->add_user($username, $password, $role);
        
        redirect('ManageUser/index');
    }

    public function update_role($id) {
        // Handle updating user role
        $role = $this->input->post('role');
        $this->UserModel->update_role($id, $role);

        redirect('ManageUser/index');
    }

    public function delete_user($id) {
        // Handle deleting a user
        $this->UserModel->delete_user($id);

        redirect('ManageUser/index');
    }
}
