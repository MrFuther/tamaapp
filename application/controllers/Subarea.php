<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subarea extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if($this->session->userdata('role') !== 'admin'){
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }
        $this->load->model('m_subarea');  // Load model subarea
        $this->load->model('m_grouparea'); // Load model grouparea untuk dropdown
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        
        // Ambil semua data sub area
        $data['subarea'] = $this->m_subarea->get_all();

        // Cek apakah id_grouparea ada di setiap sub area
        foreach ($data['subarea'] as &$sub) {
            if (!isset($sub->sub_area_id)) {
                $sub->sub_area_id = null; // Default null jika tidak ada
            }
        }

        // Ambil data group area
        $data['grouparea'] = $this->m_grouparea->get_all();
        
        // Load tampilan
        $this->load->view('masterdata/subarea', $data);
    }

    public function save() {
        // Ambil data dari form input
        $data = [
            'sub_area_name' => $this->input->post('sub_area_name'),
            'area_id' => $this->input->post('area_id'),
            'gr_area_name' => $this->input->post('gr_area_name'),
        ];

        if ($this->input->post('sub_area_id')) {
            // Update sub area
            $this->m_subarea->update($this->input->post('sub_area_id'), $data);
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
