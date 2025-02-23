<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subunitkerja extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if($this->session->userdata('role') !== 'admin'){
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
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
        // Dapatkan data unit kerja untuk mendapatkan inisial unit
        $unit = $this->m_unitkerja->get_by_id($this->input->post('id_unitkerja'));
        
        // Ambil data dari form input dan sesuaikan dengan struktur database
        $data = [
            'subunit_pek_name' => $this->input->post('nama_subunit'),
            'inisial_unit_kerja' => $unit->inisial_unit,
            'created_by' => $this->session->userdata('username'),
            'created_date' => date('Y-m-d H:i:s')
        ];
    
        if ($this->input->post('subunit_id')) {
            // Update: tambahkan updated_by dan updated_date
            $data['updated_by'] = $this->session->userdata('username');
            $data['updated_date'] = date('Y-m-d H:i:s');
            $this->m_subunitkerja->update($this->input->post('subunit_id'), $data);
        } else {
            // Insert sub unit kerja baru
            $this->m_subunitkerja->insert($data);
        }
    
        $this->session->set_flashdata('success', 'Data berhasil disimpan');
        redirect('subunitkerja');
    }

    public function delete($id) {
        // Hapus sub unit kerja (soft delete)
        $this->m_subunitkerja->delete($id);
        // Redirect ke halaman utama setelah berhasil
        redirect('subunitkerja');
    }
}
