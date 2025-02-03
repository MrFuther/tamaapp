<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LocationData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('MasterDataModel');
        $this->load->model('LocationModel');
    }

    // Display the Master Data page
    public function index()
    {
        $data['title'] = 'LocationData';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->MasterDataModel->getUsers(); // Fetch personnel list
        $data['locations'] = $this->LocationModel->getAllLocations();
        $this->load->view('location_data', $data);
    }

    // Add a new record
    public function addLocation()
    {
        $input = $this->input->post();
        $this->LocationModel->addLocation(['location_name' => $input['location_name']]);
        redirect('LocationData');
    }
}
