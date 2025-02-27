<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    // Halaman Dashboard (Dapat diakses oleh semua role)
    public function index() {
        $data['title'] = 'Dashboard';
        $user_session = $this->session->userdata();
        $username = $user_session['username']; // Asumsi session menyimpan username

        // Load model
        $this->load->model('UserModel');

        // Ambil data lengkap dari ms_account berdasarkan username
        $nama_pegawai = $this->UserModel->get_nama_pegawai_by_username($username);

        // Simpan ke dalam $data untuk digunakan di view
        $data['user'] = $nama_pegawai;
        $this->load->view('dashboard/index', $data);
    }

    // Halaman Report (Dibatasi hanya untuk admin dan supervisor)
    public function report() {
        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin', 'supervisor'])) {
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }

        $data['title'] = 'Report';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/report', $data);
    }

    // Halaman Master Data (Hanya dapat diakses oleh admin)
    public function data() {
        if ($this->session->userdata('role') !== 'admin') {
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }

        $data['title'] = 'Master Data';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/data', $data);
    }

    // Halaman Manage User (Hanya dapat diakses oleh admin)
    public function manage_user() {
        if ($this->session->userdata('role') !== 'admin') {
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }

        $data['title'] = 'Manage User';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/manage_user', $data);
    }
}
