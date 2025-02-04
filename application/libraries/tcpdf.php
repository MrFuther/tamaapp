<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('tcpdf/tcpdf.php');

class Pdf extends TCPDF {
    public function __construct() {
        parent::__construct();
    }

    // Header function
    public function Header() {
        // Logo
        $image_file_left = FCPATH . 'assets/images/logo.jpg';
        $this->Image($image_file_left, 15, 7, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Rect(15, 7, 180, 0);
        $this->Rect(15, 27, 180, 0);
        $this->Rect(15, 7, 0, 20);
        $this->Rect(55, 7, 0, 20);
        $this->Rect(155, 7, 0, 20);
        $this->Rect(195, 7, 0, 20);

        // Logo kanan
        $image_file_right = FCPATH . 'assets/images/logo-ias.jpg'; // Ganti dengan path logo kanan
        $this->Image($image_file_right, 163, 8, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        // Set font
        $this->SetFont('helvetica', 'B', 11);
        
        // Title untuk dokumen
        $this->Ln(2); // Menambahkan jarak antar header
        $this->Cell(0, 5, 'DOCUMENTATION REPORT', 0, 1, 'C'); // Teks Judul Utama
        $this->Cell(0, 5, 'PREVENTIVE MAINTENANCE ACTIVITY', 0, 1, 'C'); // Teks Subjudul
        $this->Cell(0, 5, 'IT NON-PUBLIC SERVICE SYSTEM EQUIPMENT', 0, 1, 'C'); // Teks Subjudul Lain
        $this->Ln(5); // Memberikan jarak setelah judul
    }
}