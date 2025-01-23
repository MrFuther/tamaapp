<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/index', $data);
    }

    // Master Report
    public function report() {
        $data['title'] = 'Report';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/report', $data);
    }

    // Master Data
    public function data() {
        $data['title'] = 'Data';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/data', $data);
    }

    // Manage User
    public function manage_user() {
        $data['title'] = 'Manage User';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/manage_user', $data);
    }
}