<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('ActivityModel');
        $this->load->model('MasterDataModel');
        $this->load->library('upload'); // Load library untuk upload file
    }

    public function index()
    {
        $data['title'] = 'Activity';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->MasterDataModel->getUsers(); // Fetch personnel list
        $data['activities'] = $this->ActivityModel->getAllActivities();
        $data['locations'] = $this->ActivityModel->getLocations();
        $data['devices'] = $this->ActivityModel->getDevicesByType();
        $data['device_types'] = $this->ActivityModel->getDeviceTypes();
        $data['shifts'] = $this->ActivityModel->getShifts();
        $data['personnel'] = $this->ActivityModel->getPersonnel();
        $this->load->view('dashboard/activity', $data);
    }

    public function add()
    {
        $input = $this->input->post();

        // Validasi input
        if (!isset($input['device']) || empty($input['device'])) {
            echo json_encode(['status' => 'error', 'message' => 'Device is required']);
            return;
        }

        if (!isset($input['shift']) || empty($input['shift'])) {
            echo json_encode(['status' => 'error', 'message' => 'Shift is required']);
            return;
        }

        // Upload foto perangkat, lokasi, teknisi
        $foto_perangkat = $this->_uploadFile('devicePhoto');
        $foto_lokasi = $this->_uploadFile('locationPhoto');
        $foto_teknisi = $this->_uploadFile('personnelPhoto');

        // Simpan data ke database
        $data = [
            'tanggal' => $input['tanggal'],
            'lokasi' => $input['lokasi'],
            'device' => $input['device'],
            'shift' => $input['shift'],
            'personil' => implode(', ', $input['personnel']),
            'foto_perangkat' => $foto_perangkat,
            'foto_lokasi' => $foto_lokasi,
            'foto_teknisi' => $foto_teknisi,
        ];

        $this->ActivityModel->addActivity($data);
        redirect('activity');
    }

    public function delete($id)
    {
        $this->ActivityModel->deleteActivity($id);
        redirect('activity');
    }

    public function getDevicesByType()
    {
    $device_type = $this->input->get('device_type');
    $devices = $this->ActivityModel->getDevicesByType($device_type);
    echo json_encode($devices);
    }

    private function _uploadFile($fieldName)
    {
        if (!empty($_FILES[$fieldName]['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = uniqid() . '_' . $_FILES[$fieldName]['name'];

            $this->upload->initialize($config);

            if ($this->upload->do_upload($fieldName)) {
                return $this->upload->data('file_name');
            }
        }
        return null;
    }

}
