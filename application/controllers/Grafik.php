<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends CI_Controller {

    public function index() {
        // Data yang akan ditampilkan di grafik
        $data['chartData'] = json_encode([
            'labels' => ['Januari', 'Februari', 'Maret', 'April'],
            'datasets' => [
                [
                    'label' => 'Penjualan',
                    'data' => [65, 59, 80, 81],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1
                ]
            ]
        ]);

        // Tampilkan view
        $this->load->view('grafik_view', $data);
    }
}
