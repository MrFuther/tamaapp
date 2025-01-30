<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('MasterDataModel');
        $this->load->model('LocationModel');
        $this->load->model('DeviceModel');
        $this->load->model('ShiftPersonelModel');
    }

    // Display the Master Data page
    public function index()
    {
        $data['title'] = 'MasterData';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->MasterDataModel->getUsers(); // Fetch personnel list
        $data['locations'] = $this->LocationModel->getAllLocations();
        $data['records'] = [
            'devices' => $this->DeviceModel->getDevicesByLocation(null), // Fetch all devices
            'shifts' => $this->ShiftPersonelModel->getAllShiftPersonnel()      // Fetch all shifts
            ];
        $this->load->view('dashboard/master_data', $data);
    }

    // Add a new record
    public function addLocation()
    {
        $input = $this->input->post();
        $this->LocationModel->addLocation(['location_name' => $input['location_name']]);
        redirect('MasterData');
    }

    public function addDevice()
    {
        $input = $this->input->post();
        $this->DeviceModel->addDevice([
            'location_id' => $input['location_id'],
            'device_type' => $input['device_type'],
            'device_id' => $input['device_id'],
        ]);
        redirect('MasterData');
    }

    public function addShiftPersonnel()
    {
        $input = $this->input->post();
        $this->ShiftPersonelModel->addShiftPersonnel([
            'shift' => $input['shift'],
            'personnel' => implode(',', $input['personnel']) // Convert personnel array to string
        ]);
        redirect('MasterData');
    }
}
