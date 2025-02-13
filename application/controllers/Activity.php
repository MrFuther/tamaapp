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
        $data['areas'] = $this->ActivityModel->get_area_options();
        $data['group_devices'] = $this->ActivityModel->get_group_devices();
        $data['sub_devices'] = $this->ActivityModel->get_sub_devices();
        $data['devices'] = $this->ActivityModel->get_device_hidn();
        foreach ($data['activities'] as $activity) {
            $activity->documentation = $this->ActivityModel->get_documentation($activity->id_activity);
        }
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
    
    public function save_documentation() {
        // Ambil data dari form
        $laporan = $this->input->post('laporan');
        $area = $this->input->post('area');
        $group_device = $this->input->post('group_device');
        $sub_device = $this->input->post('sub_device');
        $device = $this->input->post('device');
        $activity_id = $this->input->post('activity_id');  // ID Aktivitas
    
        // Simpan data dokumentasi ke database
        $data = [
            'id_activity' => $activity_id,
            'laporan' => $laporan,
            'area_id' => $area,
            'group_device_id' => $group_device,
            'sub_device_id' => $sub_device,
            'device_id' => $device
        ];
    
        $this->db->insert('documentation', $data);
    
        // Redirect atau tampilkan pesan sukses
        redirect('activity'); // Ganti dengan URL yang sesuai
    }
    
    public function upload_photos() {
        // Pastikan folder upload ada
        if (!is_dir('./uploads/documentation/')) {
            mkdir('./uploads/documentation/', 0777, true);
        }
    
        $id_documentation = $this->input->post('documentation_id');
        $description = $this->input->post('description');
        
        $config['upload_path'] = './uploads/documentation/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
    
        $this->load->library('upload', $config);
        
        // Array untuk menyimpan nama file yang diupload
        $uploaded_files = [];
        
        // Upload foto perangkat
        if (!empty($_FILES['foto_perangkat']['name'])) {
            $_FILES['file']['name'] = $_FILES['foto_perangkat']['name'];
            $_FILES['file']['type'] = $_FILES['foto_perangkat']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_perangkat']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_perangkat']['error'];
            $_FILES['file']['size'] = $_FILES['foto_perangkat']['size'];
    
            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $uploaded_files['foto_perangkat'] = 'uploads/documentation/' . $upload_data['file_name'];
            }
        }
        
        // Upload foto lokasi
        if (!empty($_FILES['foto_lokasi']['name'])) {
            $_FILES['file']['name'] = $_FILES['foto_lokasi']['name'];
            $_FILES['file']['type'] = $_FILES['foto_lokasi']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_lokasi']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_lokasi']['error'];
            $_FILES['file']['size'] = $_FILES['foto_lokasi']['size'];
    
            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $uploaded_files['foto_lokasi'] = 'uploads/documentation/' . $upload_data['file_name'];
            }
        }
        
        // Upload foto teknisi
        if (!empty($_FILES['foto_teknisi']['name'])) {
            $_FILES['file']['name'] = $_FILES['foto_teknisi']['name'];
            $_FILES['file']['type'] = $_FILES['foto_teknisi']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['foto_teknisi']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['foto_teknisi']['error'];
            $_FILES['file']['size'] = $_FILES['foto_teknisi']['size'];
    
            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $uploaded_files['foto_teknisi'] = 'uploads/documentation/' . $upload_data['file_name'];
            }
        }
        
        // Jika semua foto berhasil diupload
        if (count($uploaded_files) === 3) {
            $photo_data = [
                'id_documentation' => $id_documentation,
                'foto_perangkat' => $uploaded_files['foto_perangkat'],
                'foto_lokasi' => $uploaded_files['foto_lokasi'],
                'foto_teknisi' => $uploaded_files['foto_teknisi'],
                'description' => $description
            ];
            
            if ($this->ActivityModel->add_documentation_photo($photo_data)) {
                $this->session->set_flashdata('message', 'Foto dokumentasi berhasil diupload');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data foto ke database');
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupload beberapa foto');
        }
        
        redirect('activity');
    }
    
    public function get_photos($documentation_id) {
        $photos = $this->db->get_where('documentation_photos', 
            ['id_documentation' => $documentation_id])->result();
        echo json_encode(['photos' => $photos]);
    }
    
    public function delete_photo($photo_id) {
        $result = $this->ActivityModel->delete_documentation_photo($photo_id);
        echo json_encode(['success' => $result]);
    }
    
    public function get_documentation_details($activity_id) {
        $documentation = $this->ActivityModel->get_documentation($activity_id);
        $photos = $this->ActivityModel->get_documentation_photos($documentation->id_documentation);
        echo json_encode([
            'documentation' => $documentation,
            'photos' => $photos
        ]);
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
?>
