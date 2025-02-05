<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grouparea extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('m_grouparea');  // Load model grouparea
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        // Mendapatkan semua group area dari database
        $data['grouparea'] = $this->m_grouparea->get_all();
        // Load tampilan
        $this->load->view('masterdata/grouparea', $data);
    }

    public function save() {
        // Ambil data dari form input
        $data = [
            'nama_grouparea' => $this->input->post('nama_grouparea')
        ];

        if ($this->input->post('id_grouparea')) {
            // Update group area
            $this->m_grouparea->update($this->input->post('id_grouparea'), $data);
        } else {
            // Insert group area baru
            $this->m_grouparea->insert($data);
        }

        // Redirect ke halaman utama
        redirect('grouparea');
    }

    public function delete($id) {
        // Hapus group area (soft delete)
        $this->m_grouparea->delete($id);
        // Redirect ke halaman utama setelah berhasil
        redirect('grouparea');
    }
}
