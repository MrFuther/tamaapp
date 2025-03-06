<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUser extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        // Tambahkan pengecekan session dan load model/helper
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Load model dan helper
        $this->load->model('UserModel');
        $this->load->helper('hash');
        $this->load->library('session');
        $this->load->library('input');
    }

    public function index() {
        // Pastikan user adalah admin
        if ($this->session->userdata('role') !== 'admin') {
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }

        $data['title'] = 'Manage Users';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->UserModel->get_users();
        $data['units'] = $this->UserModel->get_units();

        $this->load->view('dashboard/manage_user', $data);
    }

    public function add_user() {
        // Validasi input
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[ms_account.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan error
            $this->session->set_flashdata('error', validation_errors());
            redirect('ManageUser');
        }

        // Ambil data dari form
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $unit_id = $this->input->post('unit_id');
        $nama_pegawai = $this->input->post('nama_pegawai') ?? '';

        // Proses tambah user
        $result = $this->UserModel->add_user($username, $password, $role, $unit_id, $nama_pegawai);

        if ($result) {
            $this->session->set_flashdata('success', 'User berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan user');
        }

        redirect('ManageUser');
    }

    public function update_role($id) {
        // Validasi input
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('role', 'Role', 'trim|required');
        $this->form_validation->set_rules('unit_id', 'Unit', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('ManageUser');
        }

        $role = $this->input->post('role');
        $unit_id = $this->input->post('unit_id');
        $nama_pegawai = $this->input->post('nama_pegawai') ?? '';

        $result = $this->UserModel->update_user($id, $role, $unit_id, $nama_pegawai);

        if ($result) {
            $this->session->set_flashdata('success', 'Role berhasil diupdate');
        } else {
            $this->session->set_flashdata('error', 'Gagal update role');
        }

        redirect('ManageUser');
    }

    public function delete_user($id) {
        $result = $this->UserModel->delete_user($id);

        if ($result) {
            $this->session->set_flashdata('success', 'User berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user');
        }

        redirect('ManageUser');
    }
}