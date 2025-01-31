<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PersonelData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('MasterDataModel');
        $this->load->model('ShiftPersonelModel');
    }

    // Display the Master Data page
    public function index()
    {
        $data['title'] = 'MasterData';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->MasterDataModel->getUsers(); // Fetch personnel list
        $data['records'] = ['shifts' => $this->ShiftPersonelModel->getAllShiftPersonnel()];
        $this->load->view('dashboard/master_data', $data);
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