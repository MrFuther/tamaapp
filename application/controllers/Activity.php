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
        try {
            $forms = $this->ActivityModel->get_activity_forms($activity_id);
            echo json_encode($forms);
        } catch (Exception $e) {
            log_message('error', 'Error getting activity forms: ' . $e->getMessage());
            echo json_encode([]);
        }
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

    public function get_form_data($formId) {
        $this->db->select('afd.*, dh.device_hidn_name')
                 ->from('activity_form_data afd')
                 ->join('ms_device_hidn dh', 'dh.device_hidn_id = afd.device_hidn_id')
                 ->where('afd.form_id', $formId);
                 
        $data = $this->db->get()->result();
        
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }
    
    public function get_all_device_hidn() {
        try {
            // Gunakan model untuk mengambil data
            $devices = $this->ActivityModel->get_all_devices();
            
            echo json_encode([
                'status' => 'success',
                'data' => $devices
            ]);
        } catch (Exception $e) {
            log_message('error', 'Error fetching devices: ' . $e->getMessage());
            
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    // Get checklist questions for a specific form
    public function get_checklist_for_form($formId) {
        try {
            $formId = intval($formId);
            
            if ($formId <= 0) {
                throw new Exception('Invalid form ID');
            }

            // First get the sub_device_id from the form
            $form = $this->db->get_where('activity_forms', ['form_id' => $formId])->row();
            
            if (!$form) {
                throw new Exception('Form not found');
            }

            // Then get the checklist questions for this sub_device_id
            $this->db->select('checklist_id, question_number, question_text');
            $this->db->where('sub_device_id', $form->sub_device_id);
            $this->db->order_by('question_number', 'ASC');
            $query = $this->db->get('device_checklist');

            if (!$query) {
                throw new Exception('Database query failed');
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'data' => $query->result()
                ]));

        } catch (Exception $e) {
            log_message('error', 'Get checklist for form error: ' . $e->getMessage());
            
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]));
        }
    }
    
    // Di Activity.php controller
    public function add_form_data() {
        try {
            // Validate input
            $form_id = $this->input->post('form_id');
            $device_hidn_id = $this->input->post('device_hidn_id');
            
            if (!$form_id || !$device_hidn_id) {
                throw new Exception('Missing required fields');
            }

            // Handle file uploads
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            
            $uploadedFiles = [];
            $uploadFields = ['foto_perangkat', 'foto_lokasi', 'foto_teknisi'];
            
            foreach ($uploadFields as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload($field)) {
                        $uploadedFiles[$field] = $this->upload->data('file_name');
                    } else {
                        throw new Exception($this->upload->display_errors('', ''));
                    }
                }
            }
            
            // Prepare data
            $data = [
                'form_id' => $form_id,
                'device_hidn_id' => $device_hidn_id,
                'jam_kegiatan' => $this->input->post('jam_kegiatan'),
                'tindakan1' => $this->input->post('tindakan1'),
                'tindakan2' => $this->input->post('tindakan2'),
                'tindakan3' => $this->input->post('tindakan3'),
                'notes' => $this->input->post('notes') ?: 'Normal'
            ];

            // Add uploaded files to data
            foreach ($uploadedFiles as $field => $filename) {
                $data[$field] = $filename;
            }
            
            // Save to database
            $this->db->insert('activity_form_data', $data);
            
            if ($this->db->affected_rows() > 0) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data saved successfully'
                ];
            } else {
                throw new Exception('Failed to save data to database');
            }
            
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    public function delete_form_data($formDataId) {
        try {
            // Get file names before deleting
            $files = $this->db->select('foto_perangkat, foto_lokasi, foto_teknisi')
                             ->where('form_data_id', $formDataId)
                             ->get('activity_form_data')
                             ->row();
            
            // Delete files from uploads directory
            if ($files) {
                foreach (['foto_perangkat', 'foto_lokasi', 'foto_teknisi'] as $field) {
                    if (!empty($files->$field)) {
                        $file_path = './uploads/' . $files->$field;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                }
            }
            
            // Delete record from database
            $this->db->where('form_data_id', $formDataId)
                     ->delete('activity_form_data');
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data deleted successfully'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    
    // Validate time within shift
    private function validate_time_within_shift($activity_id, $jam_kegiatan) {
        $shift = $this->db->select('sk.jam_mulai, sk.jam_selesai')
                          ->from('activity_pm ap')
                          ->join('shift_kerja sk', 'sk.id_shift = ap.shift_id')
                          ->where('ap.id_activity', $activity_id)
                          ->get()
                          ->row();
        
        if (!$shift) {
            return false;
        }
    
        $jam_kegiatan_time = strtotime($jam_kegiatan);
        $jam_mulai_time = strtotime($shift->jam_mulai);
        $jam_selesai_time = strtotime($shift->jam_selesai);
    
        // Handle shifts that cross midnight
        if ($jam_selesai_time < $jam_mulai_time) {
            $jam_selesai_time += 86400; // Add 24 hours
            if ($jam_kegiatan_time < $jam_mulai_time) {
                $jam_kegiatan_time += 86400;
            }
        }
    
        return ($jam_kegiatan_time >= $jam_mulai_time && $jam_kegiatan_time <= $jam_selesai_time);
    }
    
    // Get activity details for validating shift time
    public function get_activity_by_form($formId) {
        return $this->db->select('ap.id_activity, ap.shift_id, sk.jam_mulai, sk.jam_selesai')
                        ->from('activity_forms af')
                        ->join('activity_pm ap', 'ap.id_activity = af.activity_id')
                        ->join('shift_kerja sk', 'sk.id_shift = ap.shift_id')
                        ->where('af.form_id', $formId)
                        ->get()
                        ->row();
    }
    
    // Validate and get device hidden details
    public function validate_device_hidden($deviceHidnId, $subDeviceId) {
        $device = $this->db->where('device_hidn_id', $deviceHidnId)
                           ->where('sub_device_name', $subDeviceId == 263 ? 'Switch Access' : 'Access Point')
                           ->get('ms_device_hidn')
                           ->row();
        
        return !empty($device);
    }
    
    // Get checklist questions count
    public function get_checklist_count($deviceHidnId) {
        return $this->db->where('device_hidn_id', $deviceHidnId)
                        ->count_all_results('device_checklist');
    }
    
    // Method to handle form data validation
    private function validate_form_data($formId, $data) {
        // Check maximum entries
        $existingCount = $this->db->where('form_id', $formId)
                                 ->count_all_results('activity_form_data');
        if ($existingCount >= 4) {
            return [
                'valid' => false,
                'message' => 'Maximum number of entries (4) has been reached'
            ];
        }
    
        // Get activity details
        $activity = $this->get_activity_by_form($formId);
        if (!$activity) {
            return [
                'valid' => false,
                'message' => 'Invalid activity form'
            ];
        }
    
        // Validate time within shift
        if (!$this->validate_time_within_shift($activity->id_activity, $data['jam_kegiatan'])) {
            return [
                'valid' => false,
                'message' => 'Time must be within shift hours'
            ];
        }
    
        // Validate device hidden
        if (!$this->validate_device_hidden($data['device_hidn_id'], $data['sub_device_id'])) {
            return [
                'valid' => false,
                'message' => 'Invalid device selection'
            ];
        }
    
        // Validate checklist answers count matches questions
        $checklistCount = $this->get_checklist_count($data['device_hidn_id']);
        if ($checklistCount != 3) { // Assuming we always need exactly 3 tindakan
            return [
                'valid' => false,
                'message' => 'Invalid number of checklist responses'
            ];
        }
    
        return ['valid' => true];
    }
    
    // Method to create upload directory if it doesn't exist
    private function ensure_upload_directory() {
        $upload_path = './uploads/';
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        return $upload_path;
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