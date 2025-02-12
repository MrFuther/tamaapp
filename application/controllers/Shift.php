<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('ShiftModel');
        if ($this->session->userdata('role') !== 'admin') {
            // Jika bukan admin, arahkan ke halaman khusus "Tidak Memiliki Izin"
            redirect(base_url('errors/forbidden'));
        }

    }

    public function index() {
        $data['user'] = $this->session->userdata();
        $data['shifts'] = $this->ShiftModel->get_all_shifts();
        $this->load->view('masterdata/shift', $data);
    }

    public function add() {
        $data = [
            'nama_shift' => $this->input->post('nama_shift'),
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai')
        ];
        $this->ShiftModel->insert_shift($data);
        redirect('shift');
    }

    public function edit($id) {
        $data['shift'] = $this->ShiftModel->get_shift_by_id($id);
        $this->load->view('shift/edit', $data);
    }

    public function update() {
        $id = $this->input->post('id_shift');
        $data = [
            'nama_shift' => $this->input->post('nama_shift'),
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai')
        ];
        $this->ShiftModel->update_shift($id, $data);
        redirect('shift');
    }

    public function delete($id) {
        $this->ShiftModel->delete_shift($id);
        redirect('shift');
    }
}
?>
