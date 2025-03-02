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
    }

    public function index() {
        $data['user'] = $this->session->userdata();
        // Mendapatkan semua data devicehidn dari database
        $data['devicehidn'] = $this->m_devicehidn->get_all_devicehidn();
        
        // Mendapatkan daftar untuk dropdown di form
        $data['sub_devices'] = $this->m_devicehidn->get_all_sub_devices();
        $data['groupdevices'] = $this->m_devicehidn->get_all_groupdevices();
        $data['areas'] = $this->m_devicehidn->get_all_areas();
        $data['sub_areas'] = $this->m_devicehidn->get_all_sub_areas();

        // Load tampilan untuk masterdata/devicehidn
        $this->load->view('masterdata/devicehidn', $data);
    }

    public function save() {
        // Ambil data dari form input
        $device_hidn_name = $this->input->post('device_hidn_name');
        $jum_device_hidn = $this->input->post('jum_device_hidn');
        $sub_device_id = $this->input->post('sub_device_id');
        $pek_unit_id = $this->input->post('pek_unit_id');
        $area_id = $this->input->post('area_id');
        $sub_area_id = $this->input->post('sub_area_id');
        
        // Debug - log data yang diterima dari form
        log_message('debug', 'Form data received: ' . json_encode($_POST));
        
        // Ambil data dari tabel terkait berdasarkan ID
        $sub_device = $this->m_devicehidn->get_sub_device_by_id($sub_device_id);
        $pek_unit = $this->m_devicehidn->get_groupdevice_by_id($pek_unit_id);
        $area = $this->m_devicehidn->get_area_by_id($area_id);
        $sub_area = $this->m_devicehidn->get_sub_area_by_id($sub_area_id);
        
        // Debug - log data dari database
        log_message('debug', 'Sub device: ' . json_encode($sub_device));
        log_message('debug', 'Pek unit: ' . json_encode($pek_unit));
        log_message('debug', 'Area: ' . json_encode($area));
        log_message('debug', 'Sub area: ' . json_encode($sub_area));
        
        // Siapkan data untuk disimpan ke database
        $data = [
            'device_hidn_name' => $device_hidn_name,
            'jum_device_hidn' => $jum_device_hidn,
            'created_by' => $this->session->userdata('username'),
            'created_date' => date('Y-m-d H:i:s')
        ];
        
        // Tambahkan data relasi
        if ($sub_device) {
            $data['sub_device_name'] = $sub_device->sub_device_name;
        }
        
        if ($pek_unit) {
            $data['pek_unit_name'] = $pek_unit->pek_unit_name;
        } else if ($sub_device && isset($sub_device->pek_unit_name)) {
            // Jika pek_unit_id tidak dipilih tapi sub_device memiliki pek_unit_name
            $data['pek_unit_name'] = $sub_device->pek_unit_name;
        }
        
        // Pastikan data area dan sub_area diisi
        if ($area) {
            $data['area_name'] = $area->area_name;
        }
        
        if ($sub_area) {
            $data['sub_area_name'] = $sub_area->sub_area_name;
            
            // Jika area belum terisi tapi sub_area memiliki gr_area_name, gunakan itu
            if (empty($data['area_name']) && isset($sub_area->gr_area_name)) {
                $data['area_name'] = $sub_area->gr_area_name;
            }
        }
        
        // Debug - log data yang akan disimpan
        log_message('debug', 'Data to be saved: ' . json_encode($data));
        
        $device_hidn_id = $this->input->post('device_hidn_id');
        if ($device_hidn_id) {
            // Update data jika ID ada
            $data['updated_by'] = $this->session->userdata('username');
            $data['updated_date'] = date('Y-m-d H:i:s');
            $result = $this->m_devicehidn->update($device_hidn_id, $data);
            $this->session->set_flashdata('success', 'Device HIDN berhasil diperbarui');
            
            // Debug - log hasil update
            log_message('debug', 'Update result: ' . $result);
        } else {
            // Insert data baru
            $result = $this->m_devicehidn->insert($data);
            $this->session->set_flashdata('success', 'Device HIDN berhasil ditambahkan');
            
            // Debug - log hasil insert
            log_message('debug', 'Insert result: ' . $result);
        }
    
        // Redirect kembali ke halaman utama
        redirect('devicehidn');
    }
    
    public function edit($id) {
        // Ambil data berdasarkan ID
        $data['device'] = $this->m_devicehidn->get_by_id($id);
        
        // Jika data tidak ditemukan, tampilkan error
        if (!$data['device']) {
            show_error('Device not found', 404, 'Not Found');
        }
        
        // Ambil data untuk dropdown
        $data['sub_devices'] = $this->m_devicehidn->get_all_sub_devices();
        $data['groupdevices'] = $this->m_devicehidn->get_all_groupdevices();
        $data['areas'] = $this->m_devicehidn->get_all_areas();
        $data['sub_areas'] = $this->m_devicehidn->get_all_sub_areas();
        
        // Tampilkan halaman edit dengan data yang sudah ada
        $this->load->view('masterdata/edit_devicehidn', $data);
    }

    public function delete($id) {
        // Cek apakah data ada
        $device = $this->m_devicehidn->get_by_id($id);
        if (!$device) {
            $this->session->set_flashdata('error', 'Device HIDN tidak ditemukan');
            redirect('devicehidn');
        }
        
        // Hapus device hidn berdasarkan ID
        $result = $this->m_devicehidn->delete($id);
        
        if ($result) {
            $this->session->set_flashdata('success', 'Device HIDN berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus Device HIDN');
        }

        // Redirect ke halaman utama setelah berhasil
        redirect('devicehidn');
    }
    
    // AJAX endpoint untuk mendapatkan sub devices berdasarkan pek_unit_id
    public function get_sub_devices_by_pek_unit() {
        $pek_unit_id = $this->input->post('pek_unit_id');
        $pek_unit = $this->m_devicehidn->get_groupdevice_by_id($pek_unit_id);
        
        if (!$pek_unit) {
            echo json_encode([]);
            return;
        }
        
        $sub_devices = $this->m_devicehidn->get_sub_devices_by_pek_unit($pek_unit->pek_unit_name);
        echo json_encode($sub_devices);
    }
    
    // AJAX endpoint untuk mendapatkan sub areas berdasarkan area_id
    public function get_sub_areas_by_area() {
        $area_id = $this->input->post('area_id');
        $area = $this->m_devicehidn->get_area_by_id($area_id);
        
        if (!$area) {
            echo json_encode([]);
            return;
        }
        
        $sub_areas = $this->m_devicehidn->get_sub_areas_by_area($area->area_name);
        echo json_encode($sub_areas);
    }
    
    // AJAX endpoint untuk mendapatkan device berdasarkan ID dalam format JSON
    public function get_by_id($id) {
        // Ambil data device hidn dari database
        $device = $this->m_devicehidn->get_by_id($id);
        
        if (!$device) {
            echo json_encode(['error' => 'Device not found']);
            return;
        }
        
        // Ambil ID relasi jika diperlukan
        $sub_device_id = null;
        $pek_unit_id = null;
        $area_id = null;
        $sub_area_id = null;
        
        // Cari sub device ID berdasarkan nama
        if ($device->sub_device_name) {
            $this->db->select('sub_device_id');
            $this->db->where('sub_device_name', $device->sub_device_name);
            $sub_device_result = $this->db->get('ms_sub_device')->row();
            if ($sub_device_result) {
                $sub_device_id = $sub_device_result->sub_device_id;
            }
        }
        
        // Cari pek unit ID berdasarkan nama
        if ($device->pek_unit_name) {
            $this->db->select('pek_unit_id');
            $this->db->where('pek_unit_name', $device->pek_unit_name);
            $pek_unit_result = $this->db->get('ms_groupdevices')->row();
            if ($pek_unit_result) {
                $pek_unit_id = $pek_unit_result->pek_unit_id;
            }
        }
        
        // Cari area ID berdasarkan nama
        if ($device->area_name) {
            $this->db->select('area_id');
            $this->db->where('area_name', $device->area_name);
            $area_result = $this->db->get('ms_area')->row();
            if ($area_result) {
                $area_id = $area_result->area_id;
            }
        }
        
        // Cari sub area ID berdasarkan nama
        if ($device->sub_area_name) {
            $this->db->select('sub_area_id');
            $this->db->where('sub_area_name', $device->sub_area_name);
            $sub_area_result = $this->db->get('ms_sub_area')->row();
            if ($sub_area_result) {
                $sub_area_id = $sub_area_result->sub_area_id;
            }
        }
        
        // Tambahkan ID relasi ke objek device
        $device->sub_device_id = $sub_device_id;
        $device->pek_unit_id = $pek_unit_id;
        $device->area_id = $area_id;
        $device->sub_area_id = $sub_area_id;
        
        // Kembalikan data dalam format JSON
        echo json_encode($device);
    }
}