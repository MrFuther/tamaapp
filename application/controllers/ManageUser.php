<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        if ($this->session->userdata('role') !== 'admin') {
            redirect(base_url('forbidden'));
        }
        $this->load->model('UserModel');
    }

    public function index() {
        $data['title'] = 'MasterReport';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->UserModel->get_users();
        $data['units'] = $this->UserModel->get_units(); // Fetch unit kerja

        $this->load->view('dashboard/manage_user', $data);
    }

    public function add_user() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $unit_id = $this->input->post('unit_id');

        $this->UserModel->add_user($username, $password, $role, $unit_id);

        redirect('ManageUser/index');
    }

    public function update_role($id) {
        $role = $this->input->post('role');
        $unit_id = $this->input->post('unit_id');
        

        $this->UserModel->update_user($id, $role, $unit_id);

        redirect('ManageUser/index');
    }

    public function delete_user($id) {
        // Handle deleting a user
        $this->UserModel->delete_user($id);

        redirect('ManageUser/index');
    }
}
