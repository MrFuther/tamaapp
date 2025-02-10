<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subunitkerja extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('m_subunitkerja');  // Load model subunitkerja
        $this->load->model('m_unitkerja');     // Load model unitkerja untuk menampilkan unit kerja
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        // Mendapatkan semua sub unit kerja dari database
        $data['subunitkerja'] = $this->m_subunitkerja->get_all();
        // Mendapatkan daftar unit kerja untuk dropdown di form
        $data['unitkerja'] = $this->m_unitkerja->get_all();
        // Load tampilan
        $this->load->view('masterdata/subunitkerja', $data);
    }

    public function save() {
        // Ambil data dari form input
        $data = [
            'subunit_pek_name' => $this->input->post('subunit_pek_name'),
            'unit_id' => $this->input->post('unit_id'),
            'initial_unit_kerja' => $this->input->post('initial_unit_kerja')
        ];

        if ($this->input->post('subunit_id')) {
            // Update sub unit kerja   
            $this->m_subunitkerja->update($this->input->post('id_subunit'), $data);
        } else {
            // Insert sub unit kerja baru
            $this->m_subunitkerja->insert($data);
        }

        // Redirect ke halaman utama
        redirect('subunitkerja');
    }

    public function delete($id) {
        // Hapus sub unit kerja (soft delete)
        $this->m_subunitkerja->delete($id);
        // Redirect ke halaman utama setelah berhasil
        redirect('subunitkerja');
    }
}
