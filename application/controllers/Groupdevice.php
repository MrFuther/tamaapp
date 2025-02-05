<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupdevice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('m_groupdevice');  // Load model groupdevice
        $this->load->model('m_subunitkerja');  // Load model subunitkerja untuk dropdown
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        // Mendapatkan semua group device dari database
        $data['groupdevice'] = $this->m_groupdevice->get_all();
        // Mendapatkan daftar sub unit kerja untuk dropdown di form
        $data['subunitkerja'] = $this->m_subunitkerja->get_all();
        // Load tampilan
        $this->load->view('masterdata/groupdevice', $data);
    }

    public function save() {
        // Ambil data dari form input
        $data = [
            'nama_pekerjaanunit' => $this->input->post('nama_pekerjaanunit'),
            'id_subunit' => $this->input->post('id_subunit')
        ];

        if ($this->input->post('id_groupdevice')) {
            // Update group device
            $this->m_groupdevice->update($this->input->post('id_groupdevice'), $data);
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
