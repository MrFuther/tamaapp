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
        $data['users'] = $this->ActivityModel->get_all_users();
        $data['shifts'] = $this->ActivityModel->get_all_shifts();
        $data['areas'] = $this->ActivityModel->get_area_options();
        $data['group_devices'] = $this->ActivityModel->get_group_devices();
        $data['sub_devices'] = $this->ActivityModel->get_sub_devices();
        $data['devices'] = $this->ActivityModel->get_device_hidn();
        $this->load->view('dashboard/activity', $data);
    }

    public function add() {
        try {
            // Generate kode activity
            $kode_activity = $this->ActivityModel->generate_activity_code();
            
            // Data untuk activity_pm
            $data = [
                'shift_id' => $this->input->post('shift_id'),
                'tanggal_kegiatan' => $this->input->post('tanggal_kegiatan'),
                'kode_activity' => $kode_activity
            ];
    
            // Start transaction
            $this->db->trans_start();
    
            // Insert ke activity_pm
            $this->db->insert('activity_pm', $data);
            $activity_id = $this->db->insert_id();
    
            // Insert multiple users
            $user_ids = $this->input->post('personel_ids');
            if (!empty($user_ids)) {
                foreach ($user_ids as $user_id) {
                    $this->db->insert('activity_personel', [
                        'activity_id' => $activity_id,
                        'user_id' => $user_id
                    ]);
                }
            }
    
            // Complete transaction
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Failed to save activity');
            }
    
            redirect('activity');
    
        } catch (Exception $e) {
            log_message('error', 'Add activity error: ' . $e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('activity');
        }
    }

    public function delete($id) {
        $this->ActivityModel->delete_activity($id);
        redirect('activity');
    }     

    public function get_activity_detail($id) {
        header('Content-Type: application/json'); // Tambahkan header JSON
        
        try {
            if (!$id) {
                throw new Exception('Activity ID is required');
            }
    
            $this->db->select('
                a.*,
                s.nama_shift,
                s.jam_mulai,
                s.jam_selesai,
                GROUP_CONCAT(DISTINCT ms.username) as personel_name
            ');
            $this->db->from('activity_pm a');
            $this->db->join('shift_kerja s', 's.id_shift = a.shift_id');
            $this->db->join('activity_personel ap', 'ap.activity_id = a.id_activity', 'left');
            $this->db->join('ms_account ms', 'ms.id = ap.user_id', 'left');
            $this->db->where('a.id_activity', $id);
            $this->db->group_by('a.id_activity');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                $result = $query->row();
                // Format the date and time
                $result->formatted_date = date('d/m/Y', strtotime($result->tanggal_kegiatan));
                $result->shift_time = date('H:i', strtotime($result->jam_mulai)) . ' - ' . 
                                    date('H:i', strtotime($result->jam_selesai));
                
                echo json_encode([
                    'status' => 'success',
                    'data' => $result
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Activity not found'
                ]);
            }
        } catch (Exception $e) {
            log_message('error', 'Error in get_activity_detail: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
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
        try {
            // Validasi input
            if (!$formId) {
                throw new Exception('Form ID is required');
            }
    
            // Query data
            $this->db->select('afd.*, dh.device_hidn_name')
                     ->from('activity_form_data afd')
                     ->join('ms_device_hidn dh', 'dh.device_hidn_id = afd.device_hidn_id')
                     ->where('afd.form_id', $formId);
            
            $query = $this->db->get();
            
            // Log query untuk debugging
            log_message('debug', 'Form Data Query: ' . $this->db->last_query());
            
            if (!$query) {
                throw new Exception('Database error: ' . $this->db->error()['message']);
            }
    
            $data = $query->result();
    
            // Return response
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
    
        } catch (Exception $e) {
            log_message('error', 'Error in get_form_data: ' . $e->getMessage());
            
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
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
        try {
            // Get form details first
            $formDetails = $this->db->select('
                    ap.id_activity,
                    ap.kode_activity,
                    ap.tanggal_kegiatan,
                    sk.nama_shift,
                    sk.jam_mulai,
                    sk.jam_selesai,
                    GROUP_CONCAT(DISTINCT ms.username) as usernames
                ')
                ->from('activity_pm ap')
                ->join('shift_kerja sk', 'sk.id_shift = ap.shift_id')
                ->join('activity_personel apr', 'apr.activity_id = ap.id_activity', 'left')
                ->join('ms_account ms', 'ms.id = apr.user_id', 'left')
                ->group_by('ap.id_activity')
                ->order_by('ap.tanggal_kegiatan', 'DESC')
                ->get()->result();

            if (!$formDetails) {
                throw new Exception('Form data not found');
            }
    
            // Get form data (photos and details)
            $formData = $this->db->select('afd.*, dh.device_hidn_name')
                ->from('activity_form_data afd')
                ->join('ms_device_hidn dh', 'dh.device_hidn_id = afd.device_hidn_id')
                ->where('afd.form_id', $id)
                ->get()
                ->result();
    
            if (empty($formData)) {
                throw new Exception('No form data found');
            }
    
            // Create new PDF instance
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // Set document information
            $pdf->SetCreator('ITNP');
            $pdf->SetAuthor('ITNP');
            $pdf->SetTitle('Dokumentasi Preventive Maintenance');
            
            // Remove default header/footer
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            
            // Set margins
            $pdf->SetMargins(15, 30, 15);
            
            // Add a page
            $pdf->AddPage();
            
            // Set font
            $pdf->SetFont('helvetica', 'B', 12);
            
            // Add Header Content
            // Logo kiri
            $image_file_left = FCPATH . 'assets/images/logo.jpg';
            $pdf->Image($image_file_left, 15, 7, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            
            // Buat rectangle untuk header
            $pdf->Rect(15, 7, 180, 0);
            $pdf->Rect(15, 27, 180, 0);
            $pdf->Rect(15, 7, 0, 20);
            $pdf->Rect(55, 7, 0, 20);
            $pdf->Rect(155, 7, 0, 20);
            $pdf->Rect(195, 7, 0, 20);

            // Logo kanan
            $image_file_right = FCPATH . 'assets/images/logo-ias.jpg';
            $pdf->Image($image_file_right, 163, 8, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            // Title untuk dokumen
            $pdf->SetY(7);
            $pdf->Cell(0, 5, 'DOCUMENTATION REPORT', 0, 1, 'C');
            $pdf->Cell(0, 5, 'PREVENTIVE MAINTENANCE ACTIVITY', 0, 1, 'C');
            $pdf->Cell(0, 5, 'IT NON-PUBLIC SERVICE SYSTEM EQUIPMENT', 0, 1, 'C');
            
            // Berikan jarak setelah header
            $pdf->Ln(5);

            // Lanjutkan dengan informasi detail
            $pdf->SetFont('helvetica', '', 10);
            
            // Information table
            $pdf->Ln(5);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Cell(40, 7, 'Tanggal', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, date('d F Y', strtotime($formDetails->tanggal_kegiatan)), 0, 1);
            
            $pdf->Cell(40, 7, 'Lokasi', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, $formDetails->area_name, 0, 1);
            
            $pdf->Cell(40, 7, 'Shift', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, $formDetails->nama_shift . ' (' . $formDetails->jam_mulai . ' - ' . $formDetails->jam_selesai . ')', 0, 1);
            
            $pdf->Cell(40, 7, 'Personil', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, $formDetails->personel_names, 0, 1);
            
            // Add photos for each form data
            foreach ($formData as $index => $data) {
                $pdf->Ln(2);
                
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->Cell(0, 7, 'Data ' . ($index + 1) . ' - ' . $data->device_hidn_name, 0, 1, 'L');
                $pdf->SetFont('helvetica', '', 10);

                // Second row - Photos
                $photoHeight = 35;
                
                // Foto Perangkat
                if (file_exists('./uploads/' . $data->foto_perangkat)) {
                    $pdf->Image('./uploads/' . $data->foto_perangkat, $pdf->GetX() + 1, $pdf->GetY() + 1, 58);
                }
                $pdf->Cell(60, $photoHeight, '', 1, 0);
                
                // Foto Lokasi
                if (file_exists('./uploads/' . $data->foto_lokasi)) {
                    $pdf->Image('./uploads/' . $data->foto_lokasi, $pdf->GetX() + 1, $pdf->GetY() + 1, 58);
                }
                $pdf->Cell(60, $photoHeight, '', 1, 0);
                
                // Foto Teknisi
                if (file_exists('./uploads/' . $data->foto_teknisi)) {
                    $pdf->Image('./uploads/' . $data->foto_teknisi, $pdf->GetX() + 1, $pdf->GetY() + 1, 58);
                }
                $pdf->Cell(60, $photoHeight, '', 1, 1);
                
                // Descriptions with device name
                $pdf->SetFont('helvetica', '', 8);
                $pdf->Cell(60, 10, "Memastikan indikator access\npoint(" . $data->device_hidn_name . ")", 1, 0, 'C');
                $pdf->Cell(60, 10, "Lokasi Perangkat Access Point\n(" . $data->device_hidn_name . ")", 1, 0, 'C');
                $pdf->Cell(60, 10, "Hasil Speed Test Internet\n(" . $data->device_hidn_name . ")", 1, 1, 'C');
            }
            
            // Output PDF
            $pdf->Output('dokumentasi_pm_' . date('Y-m-d') . '.pdf', 'I');
            
        } catch (Exception $e) {
            log_message('error', 'Error generating PDF: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Failed to generate PDF: ' . $e->getMessage());
            redirect('activity');
        }
    }

    public function printchecklist($id) {
        try {
            // Get main form details first
            $formDetails = $this->db->select('
                    af.*,
                    ap.tanggal_kegiatan,
                    ap.kode_activity,
                    ma.area_name,
                    sk.nama_shift,
                    sk.jam_mulai,
                    sk.jam_selesai,
                    GROUP_CONCAT(ms.username) as personel_names
                ')
                ->from('activity_forms af')
                ->join('activity_pm ap', 'ap.id_activity = af.activity_id')
                ->join('ms_area ma', 'ma.area_id = af.area_id')
                ->join('shift_kerja sk', 'sk.id_shift = ap.shift_id')
                ->join('personel p', 'p.id_personel = ap.personel_id')
                ->join('personel_user pu', 'pu.personel_id = p.id_personel')
                ->join('ms_account ms', 'ms.id = pu.user_id')
                ->where('af.form_id', $id)
                ->group_by('af.form_id')
                ->get()
                ->row();
    
            if (!$formDetails) {
                throw new Exception('Form details not found');
            }
    
            // Get form data with checklist answers
            $formData = $this->db->select('
                    afd.*,
                    dh.device_hidn_name
                ')
                ->from('activity_form_data afd')
                ->join('ms_device_hidn dh', 'dh.device_hidn_id = afd.device_hidn_id')
                ->where('afd.form_id', $id)
                ->get()
                ->result();
    
            if (empty($formData)) {
                throw new Exception('No form data found');
            }
    
            // Get checklist questions for the sub device
            $questions = $this->db->select('*')
                ->from('device_checklist')
                ->where('sub_device_id', $formDetails->sub_device_id)
                ->order_by('question_number', 'ASC')
                ->get()
                ->result();
    
            if (empty($questions)) {
                throw new Exception('No checklist questions found');
            }
    
            // Create PDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(15, 30, 15);
            
            // Add page
            $pdf->AddPage();
            
            // Add Header Content
            // Logo kiri
            $image_file_left = FCPATH . 'assets/images/logo.jpg';
            $pdf->Image($image_file_left, 15, 7, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            
            // Buat rectangle untuk header
            $pdf->Rect(15, 7, 180, 0);
            $pdf->Rect(15, 27, 180, 0);
            $pdf->Rect(15, 7, 0, 20);
            $pdf->Rect(55, 7, 0, 20);
            $pdf->Rect(155, 7, 0, 20);
            $pdf->Rect(195, 7, 0, 20);

            // Logo kanan
            $image_file_right = FCPATH . 'assets/images/logo-ias.jpg';
            $pdf->Image($image_file_right, 163, 8, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            // Title untuk dokumen
            $pdf->SetY(7);
            $pdf->Cell(0, 5, 'CHECKLIST REPORT', 0, 1, 'C');
            $pdf->Cell(0, 5, 'PREVENTIVE MAINTENANCE ACTIVITY', 0, 1, 'C');
            $pdf->Cell(0, 5, 'IT NON-PUBLIC SERVICE SYSTEM EQUIPMENT', 0, 1, 'C');
            
            // Information
            $pdf->Ln(5);
            $pdf->SetFont('helvetica', 'B', 10);
            
            // Basic information
            $pdf->Cell(40, 7, 'Tanggal', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, date('d F Y', strtotime($formDetails->tanggal_kegiatan)), 0, 1);
            
            $pdf->Cell(40, 7, 'Lokasi', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, $formDetails->area_name, 0, 1);
    
            $pdf->Cell(40, 7, 'Shift/Jam Kerja', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, $formDetails->nama_shift . ' (' . $formDetails->jam_mulai . ' - ' . $formDetails->jam_selesai . ')', 0, 1);
    
            $pdf->Cell(40, 7, 'Personel', 0, 0);
            $pdf->Cell(5, 7, ':', 0, 0);
            $pdf->Cell(0, 7, $formDetails->personel_names, 0, 1);
            
            // Add checklist tables for each data entry
            foreach ($formData as $index => $data) {
                $pdf->Ln(5);
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->Cell(0, 7, 'Checklist ' . ($index + 1) . ' - ' . $data->device_hidn_name, 0, 1);
                $pdf->Cell(0, 7, 'Jam Kegiatan: ' . $data->jam_kegiatan, 0, 1);
                
                // Table header
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->Cell(10, 7, 'No', 1, 0, 'C');
                $pdf->Cell(100, 7, 'Item Check', 1, 0, 'C');
                $pdf->Cell(30, 7, 'Status', 1, 0, 'C');
                $pdf->Cell(40, 7, 'Keterangan', 1, 1, 'C');
                
                // Table content
                $pdf->SetFont('helvetica', '', 10);
                foreach ($questions as $key => $question) {
                    $pdf->Cell(10, 7, ($key + 1), 1, 0, 'C');
                    $pdf->Cell(100, 7, $question->question_text, 1, 0, 'L');
                    
                    // Get corresponding tindakan based on question number
                    $tindakan = 'tindakan' . ($key + 1);
                    $pdf->Cell(30, 7, $data->$tindakan, 1, 0, 'C');
                    
                    // Notes for each item
                    $pdf->Cell(40, 7, $data->notes, 1, 1, 'L');
                }
            }
            
            // Signature
            $pdf->Ln(5);
            $pdf->Cell(90, 7, 'Pelaksana,', 0, 0, 'C');
            $pdf->Cell(90, 7, 'Supervisor,', 0, 1, 'C');
            
            $pdf->Ln(12);
            $pdf->Cell(90, 7, '(.............................)', 0, 0, 'C');
            $pdf->Cell(90, 7, '(.............................)', 0, 1, 'C');
            
            // Output PDF
            $pdf->Output('checklist_pm_' . date('Y-m-d') . '.pdf', 'I');
            
        } catch (Exception $e) {
            log_message('error', 'Error generating checklist PDF: ' . $e->getMessage());
            // Jangan kirim output apapun sebelum redirect
            redirect('activity');
        }
    }
}
?>