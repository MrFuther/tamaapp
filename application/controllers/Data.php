<<<<<<< HEAD
=======

>>>>>>> efc98844275284b14991ebd4e1960e01f4374984
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    // Halaman Master Data
    public function index() {
        $data['title'] = 'MasterData';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/data', $data);
    }
}
?>
