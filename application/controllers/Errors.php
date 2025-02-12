<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    public function forbidden() {
        $this->output->set_status_header(403); // Set status header ke 403 Forbidden
        $this->load->view('errors/custom_forbidden'); // Load halaman forbidden
    }
}
?>
