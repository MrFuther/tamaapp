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
        $this->load->model('MasterDataModel');
        $this->load->model('AreaModel');
        $this->load->library('upload'); // Load library untuk upload file
        $this->load->library('tcpdf');
    }

    public function index()
    {
        $data['title'] = 'Activity';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->MasterDataModel->getUsers(); // Fetch personnel list
        $data['activities'] = $this->ActivityModel->getAllActivities();
        $data['locations'] = $this->ActivityModel->getLocations();
        $data['devices'] = $this->ActivityModel->getDevicesByType();
        $data['device_types'] = $this->ActivityModel->getDeviceTypes();
        $data['shifts'] = $this->ActivityModel->getShifts();
        $data['personnel'] = $this->ActivityModel->getPersonnel();
        $data['group_areas'] = $this->AreaModel->getAllGroupAreas();
        $this->load->view('dashboard/activity', $data);
    }

    public function add()
    {
        $input = $this->input->post();

        // Validasi input
        if (!isset($input['device']) || empty($input['device'])) {
            echo json_encode(['status' => 'error', 'message' => 'Device is required']);
            return;
        }

        if (!isset($input['shift']) || empty($input['shift'])) {
            echo json_encode(['status' => 'error', 'message' => 'Shift is required']);
            return;
        }

        // Upload foto perangkat, lokasi, teknisi
        $foto_perangkat = $this->_uploadFile('devicePhoto');
        $foto_lokasi = $this->_uploadFile('locationPhoto');
        $foto_teknisi = $this->_uploadFile('personnelPhoto');

        // Simpan data ke database
        $data = [
            'tanggal' => $input['tanggal'],
            'group_area' => $input['group_area'], // Menyimpan Group Area
            'sub_area' => implode(',', $input['sub_area']), // Menggabungkan sub_area menjadi string
            'device' => $input['device'],
            'shift' => $input['shift'],
            'personil' => implode(', ', $input['personnel']),
            'foto_perangkat' => $foto_perangkat,
            'foto_lokasi' => $foto_lokasi,
            'foto_teknisi' => $foto_teknisi,
        ];

        $this->ActivityModel->addActivity($data);
        redirect('activity');
    }

    public function delete($id)
    {
        $this->ActivityModel->deleteActivity($id);
        redirect('activity');
    }

    public function getDevicesByType()
    {
    $device_type = $this->input->get('device_type');
    $devices = $this->ActivityModel->getDevicesByType($device_type);
    echo json_encode($devices);
    }
    
    
    // Method untuk mendapatkan semua grup area
    public function get_group_areas() {
        $group_areas = $this->AreaModel->getAllGroupAreas(); // Implementasikan method ini di model Anda
        echo json_encode($group_areas);
    }

    // Method untuk mendapatkan sub-area berdasarkan grup area
    public function get_sub_areas() {
        $group_id = $this->input->post('group_id');
        $sub_areas = $this->AreaModel->getSubAreasByGroup($group_id); // Menggunakan method yang sudah Anda buat
        echo json_encode($sub_areas);
    }

    public function get_activity_data($activityId)
    {
        // Mengambil data aktivitas dan dokumentasi
        $activity = $this->ActivityModel->get_activity_by_id($activityId);
        $documentation = $this->ActivityModel->get_documentation_by_activity($activityId);

        // Mengembalikan data dalam format JSON
        echo json_encode([
            'activity' => $activity,
            'documentation' => $documentation
        ]);
    }

    public function add_documentation()
    {
        // Cek apakah ada file foto yang diupload
        if (empty($_FILES['newPhotos']['name'][0])) {
            echo json_encode(['status' => 'error', 'message' => 'Minimal 3 foto harus diunggah.']);
            return;
        }

        // Menyiapkan array untuk menyimpan nama file foto yang diupload
        $newPhotos = [];

        // Upload foto satu per satu
        for ($i = 0; $i < count($_FILES['newPhotos']['name']); $i++) {
            $_FILES['file']['name'] = $_FILES['newPhotos']['name'][$i];
            $_FILES['file']['type'] = $_FILES['newPhotos']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['newPhotos']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['newPhotos']['error'][$i];
            $_FILES['file']['size'] = $_FILES['newPhotos']['size'][$i];

            // Mengatur konfigurasi upload
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                // Menyimpan nama file yang berhasil diupload
                $newPhotos[] = $this->upload->data('file_name');
            }
        }

        // Validasi apakah 3 foto sudah diupload
        if (count($newPhotos) < 3) {
            echo json_encode(['status' => 'error', 'message' => 'Minimal 3 foto harus diunggah.']);
            return;
        }

        // Simpan data dokumentasi ke dalam database
        $documentationData = [
            'activity_id' => $this->input->post('activity_id'), // ID aktivitas terkait
            'photo1' => $newPhotos[0],
            'photo2' => $newPhotos[1],
            'photo3' => $newPhotos[2],
        ];

        // Menyimpan dokumentasi ke dalam tabel
        $this->db->insert('documentation', $documentationData);

        // Mengembalikan respons sukses
        echo json_encode(['status' => 'success', 'message' => 'Dokumentasi berhasil ditambahkan.']);
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
<<<<<<< HEAD
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
=======
        $pdf->Cell(60, 40, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 1, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 1, 'C');
        $pdf->ln(5);
        $pdf->Cell(60, 10, 'Foto Perangkat', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Lokasi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Teknisi', 1, 1, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 1, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 1, 'C');
        $pdf->ln(5);
        $pdf->Cell(60, 10, 'Foto Perangkat', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Lokasi', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Foto Teknisi', 1, 1, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 0, 'C');
        $pdf->Cell(60, 40, 'Foto', 1, 1, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 0, 'C');
        $pdf->Cell(60, 12, 'Deskripsi', 1, 1, 'C');
>>>>>>> 5c5a891966cd9ab1e089e11d23c7e6c2f4c3044b
        // Add images

        // Generate filename
        $filename = 'form_pm_' . (!empty($activity['tanggal']) ? date('Ymd', strtotime($activity['tanggal'])) : 'undated');
        
        // Output the PDF
        $pdf->Output($filename . '.pdf', 'I');
    }

    private function _uploadFile($fieldName)
    {
        if (!empty($_FILES[$fieldName]['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = uniqid() . '_' . $_FILES[$fieldName]['name'];

            $this->upload->initialize($config);

            if ($this->upload->do_upload($fieldName)) {
                return $this->upload->data('file_name');
            }
        }
        return null;
    }

}
