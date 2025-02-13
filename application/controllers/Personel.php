<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') !== 'admin') {
            // Jika bukan admin, arahkan ke halaman tidak memiliki izin
            show_error('You do not have permission to access this page.', 403, 'Forbidden');
        }
        
        $this->load->model('PersonelModel');
        if ($this->session->userdata('role') !== 'admin') {
            // Jika bukan admin, arahkan ke halaman khusus "Tidak Memiliki Izin"
            redirect(base_url('errors/forbidden'));
        }

    }

    public function index() {
        $data['user'] = $this->session->userdata();
        $data['personel'] = $this->PersonelModel->get_all_personel();
        $data['users'] = $this->PersonelModel->get_all_users();
        $data['shifts'] = $this->PersonelModel->get_all_shifts();
        $this->load->view('masterdata/personel', $data);
    }

    public function add() {
        $shift_id = $this->input->post('shift_id');
        $user_ids = $this->input->post('user_id'); // Array of user IDs

        if (!empty($shift_id) && !empty($user_ids)) {
            $this->PersonelModel->insert_personel($shift_id, $user_ids);
        }
        
        redirect('personel');
    }

    public function delete($id) {
        $this->PersonelModel->delete_personel($id);
        redirect('personel');
    }
}
?>
