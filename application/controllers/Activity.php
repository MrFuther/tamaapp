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
        $this->load->model(['ActivityModel', 'ChecklistModel']);
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
        $data['areas'] = $this->ActivityModel->get_area_options();
        $data['group_devices'] = $this->ActivityModel->get_group_devices();
        $data['sub_devices'] = $this->ActivityModel->get_sub_devices();
        $data['devices'] = $this->ActivityModel->get_device_hidn();
        $this->load->view('dashboard/activity', $data);
    }

    public function add() {
        $data = [
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

    public function get_activity_detail($id) {
        // Add error handling
        try {
            $activity = $this->ActivityModel->get_activity_detail($id);
            if ($activity) {
                $response = [
                    'status' => 'success',
                    'data' => $activity
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Activity not found'
                ];
            }
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to get activity detail'
            ];
            log_message('error', 'Activity detail error: ' . $e->getMessage());
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    
    public function get_sub_devices() {
        $devices = $this->ActivityModel->get_sub_devices();
        echo json_encode($devices);
    }
    
    public function get_areas() {
        $areas = $this->ActivityModel->get_areas();
        echo json_encode($areas);
    }
    
    public function get_activity_forms($activity_id) {
        $forms = $this->ActivityModel->get_activity_forms($activity_id);
        echo json_encode($forms);
    }
    
    public function save_form() {
        $data = $this->input->post();
        $result = $this->ActivityModel->save_form($data);
        echo json_encode(['status' => $result ? 'success' : 'error']);
    }
    
    public function delete_form($form_id) {
        $result = $this->ActivityModel->delete_form($form_id);
        echo json_encode(['status' => $result ? 'success' : 'error']);
    }

    public function printdokumentasi($id) {
        // Ambil data untuk PDF (modifikasi sesuai dengan logika aplikasi Anda)
        $activity = $this->ActivityModel->get_activity_details($id);
    
        // Membuat instance PDF baru
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BSH');
        
        // Pastikan tanggal tidak null sebelum diproses

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
        $pdf->Cell(50, 8, 'Tanggal / Bulan / Tahun:', 0, 1);
        $pdf->Cell(50, 8, 'Lokasi:', 0, 1);

        $pdf->Cell(50, 8, 'Perangkat:', 0, 1);

        $pdf->Cell(50, 8, 'Shift:', 0, 1);

        $pdf->Cell(50, 8, 'Personil:', 0, 1);

        $pdf->Ln(15);
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

        // Output the PDF
        $pdf->Output('dokumentasi_'.$activity->kode_activity.'.pdf', 'I');
    }

    public function printchecklist($activity_id) {
        // Get data
        $activity = $this->ActivityModel->get_activity_details($activity_id);
        $checklist = $this->db->select('af.*, dh.device_hidn_name')
                             ->from('activity_form af')
                             ->join('ms_device_hidn dh', 'dh.device_hidn_id = af.device_id')
                             ->where('af.activity_id', $activity_id)
                             ->get()
                             ->result();
        
        // Create new PDF document
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // Set document information
        $pdf->SetCreator('TAMA App');
        $pdf->SetAuthor('TAMA');
        
        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        
        // Add page
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 11);
        
        // Logo
        $image_file = FCPATH . 'assets/img/logo.png';
        $pdf->Image($image_file, 15, 15, 20);
        
        // Title
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 5, 'CHECKLIST PREVENTIVE MAINTENANCE', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 5, 'SIMULASI SISTEM DIGIT PADA PUBLIC COMPUTER', 0, 1, 'C');
        
        // Information table
        $pdf->SetY(40);
        $pdf->SetFont('helvetica', '', 10);
        
        $pdf->Cell(35, 5, 'Tanggal', 0);
        $pdf->Cell(5, 5, ':', 0);
        $pdf->Cell(70, 5, date('d F Y', strtotime($activity->tanggal_kegiatan)), 0);
        $pdf->Cell(35, 5, 'Shift', 0);
        $pdf->Cell(5, 5, ':', 0);
        $pdf->Cell(0, 5, $activity->nama_shift, 0, 1);
        
        $pdf->Cell(35, 5, 'Jam', 0);
        $pdf->Cell(5, 5, ':', 0);
        $pdf->Cell(0, 5, $activity->jam_mulai . ' - ' . $activity->jam_selesai, 0, 1);
        
        // Checklist items
        $pdf->SetY(60);
        $no = 1;
        foreach($checklist as $item) {
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(10, 7, $no . '.', 0, 0);
            $pdf->Cell(0, 7, 'Perangkat : ' . $item->device_hidn_name, 0, 1);
            
            $pdf->Cell(15, 7, '', 0);
            $pdf->Cell(60, 7, 'a. Cek Indicator berupa LCD Perangkat', 0, 0);
            $pdf->Cell(5, 7, '', 0);
            $pdf->Cell(10, 7, $item->indicator_check == 'OK' ? '✓' : '', 1, 0, 'C');
            $pdf->Cell(10, 7, $item->indicator_check == 'NOT OK' ? '✓' : '', 1, 1, 'C');
            
            $pdf->Cell(15, 7, '', 0);
            $pdf->Cell(60, 7, 'b. Cek tinta apabila kosong', 0, 0);
            $pdf->Cell(5, 7, '', 0);
            $pdf->Cell(10, 7, $item->ink_check == 'OK' ? '✓' : '', 1, 0, 'C');
            $pdf->Cell(10, 7, $item->ink_check == 'NOT OK' ? '✓' : '', 1, 1, 'C');

            $pdf->Cell(15, 7, '', 0);
            $pdf->Cell(60, 7, 'b. Cek tinta apabila kosong', 0, 0);
            $pdf->Cell(5, 7, '', 0);
            $pdf->Cell(10, 7, $item->color_check == 'OK' ? '✓' : '', 1, 0, 'C');
            $pdf->Cell(10, 7, $item->color_check == 'NOT OK' ? '✓' : '', 1, 1, 'C');
            
            $pdf->Cell(15, 7, '', 0);
            $pdf->Cell(60, 7, 'Catatan:', 0, 1);
            $pdf->Cell(15, 7, '', 0);
            $pdf->MultiCell(0, 7, $item->notes, 0, 'L');
            
            $pdf->Ln(1);
            $no++;
        }
        
        // Signature
        $pdf->SetY(-60);
        $pdf->Cell(95, 5, 'Mengetahui,', 0, 0, 'C');
        $pdf->Cell(95, 5, 'Pelaksana,', 0, 1, 'C');
        
        $pdf->Cell(95, 5, 'Supervisor', 0, 0, 'C');
        $pdf->Cell(95, 5, 'Teknisi', 0, 1, 'C');
        
        $pdf->Ln(15);
        
        $pdf->Cell(95, 5, '(............................)', 0, 0, 'C');
        $pdf->Cell(95, 5, '(............................)', 0, 1, 'C');
        
        // Output PDF
        $pdf->Output('checklist_'.$activity->kode_activity.'.pdf', 'I');

        header('Content-Type: applDcation/pdf');
        header('Content-Disposition: inline; filename="checklist_'.$activity_id.'.pdf"');
    }
}
?>