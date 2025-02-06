<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subarea extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('m_subarea');  // Load model subarea
        $this->load->model('m_grouparea'); // Load model grouparea untuk dropdown
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        // Mendapatkan semua sub area dari database
        $data['subarea'] = $this->m_subarea->get_all();
        // Mendapatkan daftar group area untuk dropdown di form
        $data['grouparea'] = $this->m_grouparea->get_all();
        // Load tampilan
        $this->load->view('masterdata/subarea', $data);
    }

    public function save() {
        // Ambil data dari form input
        $data = [
            'nama_subarea' => $this->input->post('nama_subarea'),
            'id_grouparea' => $this->input->post('id_grouparea')
        ];

        if ($this->input->post('id_subgrouparea')) {
            // Update sub area
            $this->m_subarea->update($this->input->post('id_subgrouparea'), $data);
        } else {
            // Insert sub area baru
            $this->m_subarea->insert($data);
        }

        // Redirect ke halaman utama
        redirect('subarea');
    }

    public function delete($id) {
        // Hapus sub area (soft delete)
        $this->m_subarea->delete($id);
        // Redirect ke halaman utama setelah berhasil
        redirect('subarea');
    }
}
