<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DeviceData extends CI_Controller
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
    }

    // Display the Master Data page
    public function index()
    {
        $data['title'] = 'DeviceData';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->MasterDataModel->getUsers(); // Fetch personnel list
        $data['devices'] = $this->MasterDataModel->getAllDevices();
        $data['locations'] = $this->LocationModel->getAllLocations();
        $this->load->view('device_data', $data);
    }

    public function addDevice()
    {
        $input = $this->input->post();
        $this->DeviceModel->addDevice([
            'location_id' => $input['location_id'],
            'device_type' => $input['device_type'],
            'device_id' => $input['device_id'],
        ]);
        redirect('DeviceData');
    }
}
