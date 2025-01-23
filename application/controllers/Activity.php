// application/controllers/Activity.php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    // Halaman Activity Module
    public function index() {
        $data['title'] = 'Activity';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/activity', $data);
    }
}
?>
