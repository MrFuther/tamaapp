<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devicehidn extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if($this->session->userdata('role') !== 'admin'){
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }

        // Load model yang dibutuhkan
        $this->load->model('m_devicehidn');  // Load model devicehidn
        $this->load->model('m_subdevice');  // Load model groupdevice untuk dropdown
    }

    public function index() {
        $data['user'] = $this->session->userdata();  // Menyimpan data user yang sedang login
        // Mendapatkan semua data devicehidn dari database
        $data['devicehidn'] = $this->m_devicehidn->get_all_devicehidn();
        // Mendapatkan daftar grup device, sub area, dan area untuk dropdown di form
        $data['sub_devices'] = $this->m_subdevice->get_all();

        // Load tampilan untuk masterdata/devicehidn
        $this->load->view('masterdata/devicehidn', $data);
    }

    public function save() {
        // Ambil data dari form input
        $data = [
            'device_hidn_name' => $this->input->post('device_hidn_name'),
            'jum_device_hidn' => $this->input->post('jum_device_hidn'),
            'sub_device_id' => $this->input->post('sub_device_id'),
            'created_by' => $this->session->userdata('username'),  // Assuming username is stored in session
            'created_date' => date('Y-m-d H:i:s')
        ];

        if ($this->input->post('device_hidn_id')) {
            // Update device hidn jika sudah ada
            $this->m_devicehidn->update($this->input->post('device_hidn_id'), $data);
        } else {
            // Insert device hidn baru
            $this->m_devicehidn->insert($data);
        }

        // Redirect kembali ke halaman utama
        redirect('devicehidn');
    }
    
    public function add() {
    $data['sub_devices'] = $this->m_devicehidn->get_all_sub_devices(); // Ambil data sub_device_name

    $this->load->view('devicehidn/add_devicehidn', $data);
    }

    

    public function edit($id) {
        // Ambil data berdasarkan ID
        $data['device'] = $this->m_devicehidn->get_by_id($id);

        // Ambil data lain yang diperlukan seperti dropdown
        $data['groupdevice'] = $this->m_groupdevice->get_all();
        $data['subarea'] = $this->m_subarea->get_all();

        // Tampilkan halaman edit dengan data yang sudah ada
        $this->load->view('masterdata/devicehidn', $data);
    }

    public function delete($id) {
        // Hapus device hidn berdasarkan ID
        $this->m_devicehidn->delete($id);

        // Redirect ke halaman utama setelah berhasil
        redirect('devicehidn');
    }
}
