<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('ActivityModel');
        $this->load->library('upload'); // Load library untuk upload file
        $this->load->library('tcpdf');
    }

    public function index()
    {
        $data['title'] = 'Activity';
        $data['user'] = $this->session->userdata();
        $data['activities'] = $this->ActivityModel->get_all_activities();
        $data['personel'] = $this->ActivityModel->get_all_personel();
        $data['shifts'] = $this->ActivityModel->get_all_shifts();
        $this->load->view('dashboard/activity', $data);
    }

    public function add() {
        $id_activity = $this->ActivityModel->generate_activity_id();
        $data = [
            'id_activity' => $id_activity,
            'personel_id' => $this->input->post('personel_id'),
            'shift_id' => $this->input->post('shift_id'),
            'tanggal_kegiatan' => $this->input->post('tanggal_kegiatan')
        ];

        $this->ActivityModel->insert_activity($data);
        redirect('activity');
    }

    public function delete($id) {
        $this->ActivityModel->delete_activity($id);
        redirect('activity');
    }

    public function print_pdf($id) {
        // Ambil data untuk PDF (modifikasi sesuai dengan logika aplikasi Anda)
        $activity = $this->ActivityModel->get_activity_by_id($id);
    
        // Membuat instance PDF baru
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BSH');
        
        // Pastikan tanggal tidak null sebelum diproses
        $doc_date = !empty($activity['tanggal']) ? date('d/m/Y', strtotime($activity['tanggal'])) : 'N/A';
        $pdf->SetTitle('Form PM - ' . $doc_date);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 11);

        // Add content from database
        $pdf->Ln(3);
        $pdf->Cell(50, 8, 'Tanggal / Bulan / Tahun:', 0, 0);
        $pdf->Cell(0, 8, $doc_date, 0, 1);
        $pdf->Cell(50, 8, 'Lokasi:', 0, 0);
        $pdf->Cell(0, 8, !empty($activity['lokasi']) ? $activity['lokasi'] : 'N/A', 0, 1);

        $pdf->Cell(50, 8, 'Perangkat:', 0, 0);
        $pdf->Cell(0, 8, !empty($activity['device']) ? $activity['device'] : 'N/A', 0, 1);

        $pdf->Cell(50, 8, 'Shift:', 0, 0);
        $pdf->Cell(0, 8, !empty($activity['shift']) ? $activity['shift'] : 'N/A', 0, 1);

        $pdf->Cell(50, 8, 'Personil:', 0, 0);
        $pdf->Cell(0, 8, !empty($activity['personil']) ? $activity['personil'] : 'N/A', 0, 1);

        $pdf->Ln(5);
        $pdf->Cell(60, 10, 'Foto Perangkat', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Lokasi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Teknisi', 1, 1, 'C');
        $pdf->Cell(60, 30, 'Foto1', 1, 0, 'C');
        $pdf->Cell(60, 30, 'Foto2', 1, 0, 'C');
        $pdf->Cell(60, 30, 'Foto3', 1, 1, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 1, 'C');

        $pdf->Ln(10);
        
        $pdf->Cell(60, 10, 'Foto Perangkat', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Lokasi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Teknisi', 1, 1, 'C');
        $pdf->Cell(60, 30, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 30, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 30, 'Foto', 1, 1, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 1, 'C');

        $pdf->Ln(10);
        
        $pdf->Cell(60, 10, 'Foto Perangkat', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Lokasi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Teknisi', 1, 1, 'C');
        $pdf->Cell(60, 30, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 30, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 30, 'Foto', 1, 1, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Deskripsi', 1, 1, 'C');
        // Add images

        // Generate filename
        $filename = 'form_pm_' . (!empty($activity['tanggal']) ? date('Ymd', strtotime($activity['tanggal'])) : 'undated');
        
        // Output the PDF
        $pdf->Output($filename . '.pdf', 'I');
    }
}
