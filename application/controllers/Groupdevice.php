<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupdevice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if($this->session->userdata('role') !== 'admin'){
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }
        $this->load->model('m_groupdevice');  // Load model groupdevice
        $this->load->model('m_subunitkerja');  // Load model subunitkerja untuk dropdown
        $this->load->model('m_unitkerja'); // Load model unitkerja untuk dropdown
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        // Mendapatkan semua group device dari database
        $data['groupdevice'] = $this->m_groupdevice->get_all();
        // Mendapatkan daftar sub unit kerja untuk dropdown di form
        $data['subunitkerja'] = $this->m_subunitkerja->get_all();
        $data['unitkerja'] = $this->m_unitkerja->get_all();
        // Load tampilan
        $this->load->view('masterdata/groupdevice', $data);
    }

    public function save() {
        // Dapatkan nama subunit dan inisial unit dari model berdasarkan ID
        $subunit = $this->m_subunitkerja->get_by_id($this->input->post('id_subunit'));
        $unit = $this->m_unitkerja->get_by_id($this->input->post('id_unitkerja'));
        
        // Ambil data dari form input dan sesuaikan dengan struktur database
        $data = [
            'pek_unit_name' => $this->input->post('nama_pekerjaanunit'),
            'subunit_pek_name' => $subunit->subunit_pek_name,
            'inisial_unit_kerja' => $unit->inisial_unit,
            'created_by' => $this->session->userdata('username'),
            'created_date' => date('Y-m-d H:i:s')
        ];
    
        if ($this->input->post('pek_unit_id')) {
            // Update: tambahkan updated_by dan updated_date
            $data['updated_by'] = $this->session->userdata('username');
            $data['updated_date'] = date('Y-m-d H:i:s');
            $this->m_groupdevice->update($this->input->post('pek_unit_id'), $data);
        } else {
            // Insert group device baru
            $this->m_groupdevice->insert($data);
        }
    
        // Redirect ke halaman utama
        redirect('groupdevice');
    }

    public function delete($id) {
        // Hapus group device (soft delete)
        $this->m_groupdevice->delete($id);
        // Redirect ke halaman utama setelah berhasil
        redirect('groupdevice');
    }
}