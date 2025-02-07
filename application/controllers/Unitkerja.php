<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unitkerja extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('m_unitkerja');  // Load model
        $this->load->library('form_validation');  // Load form validation library
    }

    // Menampilkan semua unit kerja
    public function index() {
        $data['user'] = $this->session->userdata();
        $data['unitkerja'] = $this->m_unitkerja->get_all();
        $this->load->view('masterdata/unit_kerja', $data);
    }

    public function save() {
        // Ambil data dari form input
        $data = [
            'unit_name' => $this->input->post('unit_name'),
            'inisial_unit' => $this->input->post('inisial_unit')
        ];

        if ($this->input->post('unit_id')) {
            // Update unit kerja
            $this->m_unitkerja->update($this->input->post('unit_id'), $data);
        } else {
            // Insert unit kerja baru
            $this->m_unitkerja->insert($data);
        }

        // Redirect ke halaman utama
        redirect('unitkerja');
    }

    public function delete($id) {
        // Hapus unit kerja (soft delete)
        $this->m_unitkerja->delete($id);
        // Redirect ke halaman utama setelah berhasil
        redirect('unitkerja');
    }
}
