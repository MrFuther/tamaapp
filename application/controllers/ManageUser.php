// application/controllers/ManageUser.php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageUser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    // Halaman Manage User
    public function index() {
        $data['title'] = 'Manage User';
        $data['user'] = $this->session->userdata();
        $this->load->view('dashboard/manage_user', $data);
    }
}
?>
