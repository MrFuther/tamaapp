<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subdevice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if($this->session->userdata('role') !== 'admin'){
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }
        $this->load->model('m_subdevice');  // Load model subdevice
        $this->load->model('m_groupdevice');  // Load model groupdevice untuk dropdown
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        // Mendapatkan semua sub device dari database
        $data['subdevice'] = $this->m_subdevice->get_all();
        // Mendapatkan daftar group device untuk dropdown di form
        $data['groupdevice'] = $this->m_groupdevice->get_all();
        // Load tampilan
        $this->load->view('masterdata/subdevice', $data);
    }

    public function save() {
        // Tambahkan created_by dan created_date
        $data = [
            'sub_device_name' => $this->input->post('sub_device_name'),
            'pek_unit_name' => $this->input->post('pek_unit_name'),
            'created_by' => $this->session->userdata('username'),
            'created_date' => date('Y-m-d H:i:s')
        ];
    
        if ($this->input->post('sub_device_id')) {
            // Update: tambahkan updated_by dan updated_date
            $data['updated_by'] = $this->session->userdata('username');
            $data['updated_date'] = date('Y-m-d H:i:s');
            $this->m_subdevice->update($this->input->post('sub_device_id'), $data);
        } else {
            // Insert baru
            $this->m_subdevice->insert($data);
        }
    
        redirect('subdevice');
    }

    public function delete($id) {
        // Hapus sub device (soft delete)
        $this->m_subdevice->delete($id);
        // Redirect ke halaman utama setelah berhasil
        redirect('subdevice');
    }
}
