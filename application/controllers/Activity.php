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

    public function save_checklist() {
        // Ambil data dari form
        $data = [
            'activity_id' => $this->input->post('activity_id'),
            'device_id' => $this->input->post('device'),
            'kegiatan' => $this->input->post('kegiatan_1'), // Menyimpan kegiatan yang dipilih
            'status' => $this->input->post('status_1'), // Menyimpan status kegiatan
            'catatan' => $this->input->post('catatan')
        ];

        // Simpan data ke tabel checklist
        $this->ActivityModel->save_checklist($data);

        // Redirect atau tampilkan pesan sukses
        $this->session->set_flashdata('message', 'Data checklist berhasil disimpan');
        redirect('activity');  // Redirect kembali ke halaman aktivitas
    }    
    
    public function get_checklist($activity_id) {
        // Ambil data checklist yang sudah ada berdasarkan activity_id
        $data['checklist'] = $this->db->get_where('checklist', ['activity_id' => $activity_id])->row();
        
        // Ambil data perangkat dari ms_device_hidn
        $data['devices'] = $this->db->get('ms_device_hidn')->result();
    
        // Kirim data ke view
        $this->load->view('dashboard/activity', $data);
    }
    
    public function get_kegiatan_per_device() {
        $device_id = $this->input->post('device_id');  // Mendapatkan device_id dari request AJAX
        $kegiatan = $this->ActivityModel->get_kegiatan_per_device($device_id);  // Mengambil kegiatan berdasarkan perangkat

        // Generate HTML untuk pertanyaan kegiatan
        $output = '';
        foreach ($kegiatan as $k) {
            $output .= '<div class="mb-3">';
            $output .= '<label for="kegiatan_' . $k->id_kegiatan . '" class="form-label">' . $k->nama_kegiatan . '</label>';
            $output .= '<input type="radio" name="kegiatan_' . $k->id_kegiatan . '" value="OK" required> OK';
            $output .= '<input type="radio" name="kegiatan_' . $k->id_kegiatan . '" value="NOT OK"> NOT OK';
            $output .= '</div>';
        }
        echo $output;  // Mengirimkan HTML yang sudah di-generate kembali ke view
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

    public function show_documentation($activity_id) {
        // Ambil data aktivitas yang dipilih
        $data['activity'] = $this->ActivityModel->get_activity_details($activity_id);
        
        // Ambil data dokumentasi berdasarkan activity_id
        $data['documentation'] = $this->ActivityModel->get_documentation_by_activity($activity_id);
        
        // Ambil data lainnya untuk form select
        $data['areas'] = $this->ActivityModel->get_area_options();
        $data['group_devices'] = $this->ActivityModel->get_group_devices();
        $data['sub_devices'] = $this->ActivityModel->get_sub_devices();
        $data['devices'] = $this->ActivityModel->get_device_hidn();
    
        // Tampilkan modal dengan data yang sudah diambil
        $this->load->view('dashboard/activity', $data);
    }    
    
    public function show_documentation_photos($activity_id) {
        // Ambil data aktivitas yang dipilih
        $data['activity'] = $this->ActivityModel->get_activity_details($activity_id);
        
        // Ambil data dokumentasi terkait activity_id
        $data['documentation'] = $this->ActivityModel->get_documentation_by_activity($activity_id);
    
        // Ambil data foto dokumentasi
        $data['documentation_photos'] = $this->ActivityModel->get_photos_by_activity($activity_id);
    
        // Ambil data lainnya untuk form select
        $data['areas'] = $this->ActivityModel->get_area_options();
        $data['group_devices'] = $this->ActivityModel->get_group_devices();
        $data['sub_devices'] = $this->ActivityModel->get_sub_devices();
        $data['devices'] = $this->ActivityModel->get_device_hidn();
    
        // Tampilkan modal dengan data yang sudah diambil
        $this->load->view('activity', $data);
    }
    
    public function save_documentation_photos() {
        var_dump($_POST);
        exit();
        $id_documentation = $this->input->post('id_documentation');
        $description = $this->input->post('description');
    
        // Atur konfigurasi upload untuk setiap foto
        $config['upload_path'] = '/uploads/documentation/';
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size'] = 2048;  // 2MB max size
        $this->load->library('upload', $config);
    
        // Data untuk foto
        $photos = [
            'foto_perangkat' => '',
            'foto_lokasi' => '',
            'foto_teknisi' => ''
        ];
    
        // Proses upload foto
        foreach ($photos as $key => $value) {
            if ($_FILES[$key]['name']) {
                if ($this->upload->do_upload($key)) {
                    $file_data = $this->upload->data();
                    $photos[$key] = 'uploads/documentation/' . $file_data['file_name'];
                } else {
                    $photos[$key] = NULL; // Jika gagal upload, set foto sebagai NULL
                }
            }
        }
    
        // Simpan data foto ke database
        $data = [
            'id_documentation' => $id_documentation,
            'foto_perangkat' => $photos['foto_perangkat'],
            'foto_lokasi' => $photos['foto_lokasi'],
            'foto_teknisi' => $photos['foto_teknisi'],
            'description' => $description
        ];
    
        // Insert atau Update ke tabel documentation_photos
        $existing_photos = $this->db->get_where('documentation_photos', ['id_documentation' => $id_documentation])->row();
    
        if ($existing_photos) {
            // Jika ada, lakukan update
            $this->db->where('id_documentation', $id_documentation);
            $this->db->update('documentation_photos', $data);
            $this->session->set_flashdata('message', 'Foto berhasil diperbarui');
        } else {
            // Jika tidak ada, lakukan insert
            $this->db->insert('documentation_photos', $data);
            $this->session->set_flashdata('message', 'Foto berhasil disimpan');
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