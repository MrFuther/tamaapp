<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    // Halaman Master Report
    public function index() {
        $data['title'] = 'MasterReport';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/report', $data);
    }
}
?>
