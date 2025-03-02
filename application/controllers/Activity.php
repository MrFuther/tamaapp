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
        $this->load->library('pdf');
        $this->load->library('pagination');
    }

    public function index()
    {

        $config['base_url'] = base_url('activity/index');
        $config['total_rows'] = $this->ActivityModel->count_all_activities();
        $config['per_page'] = 10; // Number of records per page
        $config['uri_segment'] = 3;
        
       // Bootstrap 5 pagination styling
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        // Initialize pagination
        $this->pagination->initialize($config);
        
        // Get current page offset
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['title'] = 'Activity';
        $data['user'] = $this->session->userdata();
        $data['activities'] = $this->ActivityModel->get_activities_paginated($config['per_page'], $page);
        $data['users'] = $this->ActivityModel->get_all_users();
        $data['shifts'] = $this->ActivityModel->get_all_shifts();
        $data['areas'] = $this->ActivityModel->get_area_options();
        $data['group_devices'] = $this->ActivityModel->get_group_devices();
        $data['sub_devices'] = $this->ActivityModel->get_sub_devices();
        $data['devices'] = $this->ActivityModel->get_device_hidn();
        $data['pagination'] = $this->pagination->create_links();
        $data['start'] = $page + 1;
        $this->load->view('dashboard/activity', $data);
    }

    public function ajax_paginate()
    {
        // Load pagination library
        $this->load->library('pagination');
        
        // Pagination configuration (same as in index method)
        $config['base_url'] = base_url('activity/ajax_paginate');
        $config['total_rows'] = $this->ActivityModel->count_all_activities();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        // Bootstrap 5 pagination styling
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        // Initialize pagination
        $this->pagination->initialize($config);
        
        // Get current page offset
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Get activities for this page
        $activities = $this->ActivityModel->get_activities_paginated($config['per_page'], $page);
        
        // Check if this is an AJAX request
        if ($this->input->is_ajax_request()) {
            // Return JSON data for AJAX requests
            echo json_encode([
                'activities' => $activities,
                'pagination' => $this->pagination->create_links()
            ]);
        } else {
            // For direct URL access, redirect to the normal index method
            redirect('activity/index/' . $page);
        }
    }

    public function search() {
        $search_term = $this->input->get('search', TRUE);
        
        // Load pagination library
        $this->load->library('pagination');
        
        // Add search function to ActivityModel.php
        // Count results
        $config['total_rows'] = $this->ActivityModel->count_search_activities($search_term);
        $config['base_url'] = base_url('activity/search?search=' . urlencode($search_term));
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        
        // Bootstrap 5 pagination styling (same as above)
        $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        // Initialize pagination
        $this->pagination->initialize($config);
        
        // Get current page
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $offset = ($page - 1) * $config['per_page'];
        
        // Get activities
        $data['activities'] = $this->ActivityModel->search_activities($search_term, $config['per_page'], $offset);
        $data['pagination'] = $this->pagination->create_links();
        $data['search_term'] = $search_term;
        
        // Also include other required data
        $data['title'] = 'Activity Search Results';
        $data['user'] = $this->session->userdata();
        $data['users'] = $this->ActivityModel->get_all_users();
        $data['shifts'] = $this->ActivityModel->get_all_shifts();
        $data['areas'] = $this->ActivityModel->get_area_options();
        $data['group_devices'] = $this->ActivityModel->get_group_devices();
        $data['sub_devices'] = $this->ActivityModel->get_sub_devices();
        $data['devices'] = $this->ActivityModel->get_device_hidn();
        $data['start'] = $page + 1;
        
        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'activities' => $data['activities'],
                'pagination' => $data['pagination']
            ]);
        } else {
            $this->load->view('dashboard/activity', $data);
        }
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
                GROUP_CONCAT(DISTINCT ms.nama_pegawai) as personel_name
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
    
            // Get the form details to know the report_type and sub_device_id
            $form = $this->db->get_where('activity_forms', ['form_id' => $formId])->row();
            if (!$form) {
                throw new Exception('Form not found');
            }
            
            // Get the checklist questions for this form
            $questions = $this->ChecklistModel->get_checklist_questions($form->sub_device_id, $form->report_type);
            
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
            
            // Process each data item to expand tindakan JSON
            foreach ($data as &$item) {
                if (isset($item->tindakan)) {
                    $tindakan = json_decode($item->tindakan, true);
                    if ($tindakan) {
                        // Assign individual tindakan properties
                        foreach ($tindakan as $index => $value) {
                            $propName = 'tindakan' . $index;
                            $item->$propName = $value;
                        }
                    }
                    // Keep the JSON for reference
                    $item->tindakan_json = $item->tindakan;
                }
                
                // Add question details
                $item->questions = $questions;
                $item->question_count = count($questions);
            }
    
            // Return response
            echo json_encode([
                'status' => 'success',
                'data' => $data,
                'questions' => $questions,
                'question_count' => count($questions)
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

    public function get_checklist_questions() {
        $sub_device_id = $this->input->get('sub_device_id');
        $report_type = $this->input->get('report_type');
        
        if (!$sub_device_id || !$report_type) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ]);
            return;
        }
        
        $questions = $this->ChecklistModel->get_checklist_questions($sub_device_id, $report_type);
        
        echo json_encode([
            'status' => 'success',
            'data' => $questions
        ]);
    }

    // Get checklist questions for a specific form
    public function get_checklist_for_form($formId) {
        try {
            $formId = intval($formId);
            
            if ($formId <= 0) {
                throw new Exception('Invalid form ID');
            }
    
            // Add detailed logging
            log_message('debug', 'Getting checklist for form ID: ' . $formId);
    
            // First get the form details
            $this->db->select('*');
            $this->db->from('activity_forms');
            $this->db->where('form_id', $formId);
            $query = $this->db->get();
            
            log_message('debug', 'Form query SQL: ' . $this->db->last_query());
            
            if (!$query || $query->num_rows() == 0) {
                throw new Exception('Form not found with ID: ' . $formId);
            }
            
            $form = $query->row();
            log_message('debug', 'Form details found: ' . json_encode($form));
            
            // Ensure we have valid sub_device_id and report_type
            if (empty($form->sub_device_id)) {
                throw new Exception('Form has no sub_device_id');
            }
            
            if (empty($form->report_type)) {
                throw new Exception('Form has no report_type');
            }
            
            // Special handling for specific devices and daily reports
            if ($form->report_type === 'Harian' && ($form->sub_device_id == 267 || $form->sub_device_id == 269)) {
                // Load specialized questions for these devices
                $questions = $this->load_specialized_questions($form->sub_device_id);
                
                log_message('debug', 'Loaded specialized questions for device: ' . $form->sub_device_id);
                log_message('debug', 'Questions count: ' . count($questions));
                
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => 'success',
                        'data' => $questions,
                        'form' => $form,
                        'specialized' => true
                    ]));
                return;
            }
            
            // Regular processing for other devices/report types
            $this->db->select('checklist_id, question_number, question_text');
            $this->db->from('device_checklist');
            $this->db->where('sub_device_id', $form->sub_device_id);
            $this->db->where('report_type', $form->report_type);
            $this->db->order_by('question_number', 'ASC');
            $query = $this->db->get();
            
            log_message('debug', 'Questions query SQL: ' . $this->db->last_query());
            log_message('debug', 'Questions count: ' . $query->num_rows());
            
            // If no specific questions for this report type, fallback to the default ones
            if ($query->num_rows() == 0) {
                log_message('debug', 'No specific questions found, falling back to default questions');
                $this->db->select('checklist_id, question_number, question_text');
                $this->db->from('device_checklist');
                $this->db->where('sub_device_id', $form->sub_device_id);
                $this->db->order_by('question_number', 'ASC');
                $query = $this->db->get();
                
                log_message('debug', 'Fallback query SQL: ' . $this->db->last_query());
                log_message('debug', 'Fallback questions count: ' . $query->num_rows());
            }
    
            if (!$query) {
                throw new Exception('Database query failed');
            }
    
            $questions = $query->result();
            log_message('debug', 'Questions found: ' . json_encode($questions));
    
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'data' => $questions,
                    'form' => $form,
                    'specialized' => false
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

    private function load_specialized_questions($deviceId, $forDocumentation = false) {
        // Define specialized questions based on device ID
        $questions = [];
        
        if ($deviceId == 267) { // PERANGKAT RUANG RAPAT
            if ($forDocumentation) {
                // Documentation labels (for PDF)
                $questionTexts = [
                    'Memastikan Screen Motorized / Barco Video Controll',
                    'Koneksi Tampilan Screen & Proyektor / Wall Display / Internet Perkantoran',
                    'Koneksi HDMI / Dongle / Digibird',
                    'Cek perangkat Server Datapath dan Wall Display berfungsi dengan baik',
                    'Cek koneksi PC, Server Datapath, Projector dan Wall Display saling terhubung',
                    'Pastikan perangkat DigiBird Video Wall Controller dan Wall Panel berfungsi dengan baik',
                    'Pastikan perangkat monitor di meja rapat kondisi aktif',
                    'Pastikan perangkat PC operator terhubung jaringan internet dengan baik',
                    'Pastikan Proyektor, Screen Proyektor, dan kabel HDMI berfungsi dengan baik',
                    'Cek perangkat Screen Projector Motorized',
                    'Cek kondisi VGA Splitter/Amplifier',
                    'Cek HDMI Extender',
                    'Pastikan Microphone berfungsi dengan baik',
                    'Cek Sound System di ruang rapat',
                    'Pastikan terkoneksi ke jaringan wireless',
                    'Pastikan webcam berfungsi dengan baik',
                    'Cek koneksi audio output ke speaker',
                    'Cek koneksi kabel power dan pastikan tersedia steker listrik cadangan'
                ];
            } else {
                // Checklist questions (for form)
                $questionTexts = [
                    'Cek kondisi perangkat display dan perangkat pendukung terhubung dan aktif',
                    'Cek dan memastikan koneksi jaringan perangkat Mini PC Display normal',
                    'Cek Aplikasi yang berjalan di perangkat display berfungsi dengan normal',
                    'Cek perangkat Server Datapath dan Wall Display berfungsi dengan baik',
                    'Cek koneksi PC, Server Datapath, Projector dan Wall Display saling terhubung',
                    'Pastikan Perangkat Digibird Video Wall Controller dan Wall Panel berfungsi dengan baik',
                    'Pastikan perangkat monitor di meja rapat kondisi aktif',
                    'Pastikan perangkat PC operator terhubung jaringan internet dengan baik',
                    'Pastikan Proyektor, Screen Proyektor, dan Kabel HDMI berfungsi dengan baik',
                    'Cek Perangkat Screen Projector Motorized'
                ];
            }
        } elseif ($deviceId == 269) { // INFRASTRUKTUR SERVER PERKANTORAN
            if ($forDocumentation) {
                // Documentation labels (for PDF)
                $questionTexts = [
                    'Cek Kondisi Jaringan Jalur FO Antar Gedung Jaringan IT Perkantoran BSH',
                    'Cek Kondisi Jaringan IT BSH Gedung 601 T1-T2-T3',
                    'Cek Kondisi Jarigan Switch Access Gedung 601',
                    'Cek Monitoring jaringan Access Point Perkantoran BSH',
                    'Cek Penggunaan Resources Infrastruktur Server Perkantoran svt01-cgk',
                    'Cek Penggunaan Resources Infrastruktur Server Perkantoran sct02-cgk',
                    'Cek Status Temperature Server Room IT',
                    'Cek Update Server Trend Micro Deep Security',
                    'Cek Status Server Deep Discovery Inspector',
                    'Cek Update Database Kaspersky',
                    'Cek Status Server cgk-Infoblox-01',
                    'Cek Status Server cgk-Infoblox-02',
                    'Cek Monitoring Jaringan Access Point Perkantoran BSH',
                    'Cek Status Grid Manager Infoblox',
                    'Cek Status license Kaspersky',
                    'Cek Update Backup Server Atlantis (172.17.45.11)',
                    'Cek Status Local Backup Server'
                ];
            } else {
                // Checklist questions (for form)
                $questionTexts = [
                    'Cek suhu ruang server dengan aplikasi monitoring ruang server',
                    'Cek penggunaan resources infrastruktur server perkantoran',
                    'Cek update database Kaspersky',
                    'Cek update Server Trend Micro Deep Security',
                    'Monitoring Threat MAlware di Trend Micro Deep Discovery Inspector (DDI)',
                    'Cek kondisi jaringan switch access Gedung 601 melalui network monitoring system NAGVIS',
                    'Cek kondisi jaringan switch access terminal dan non terminal perkantoran di network monitoring system NAGVIS',
                    'Monitoring kondisi Wireless Controller beroperasi dan terhubung dengan selurung access point',
                    'Cek dan pastikan semua perangkat access point aktif dengan wifi monitoring system'
                ];
            }
        }
        
        // Create question objects
        foreach ($questionTexts as $i => $text) {
            $question = new stdClass();
            $question->checklist_id = $i + 1;
            $question->question_number = $i + 1;
            $question->question_text = $text;
            $questions[] = $question;
        }
        
        return $questions;
    }
    
    // Add this simple version of the compress image function
    private function compress_image($source, $destination, $quality = 50) {
        try {
            // Verify source file exists
            if (!file_exists($source)) {
                log_message('error', 'Source file does not exist: ' . $source);
                return false;
            }
            
            // Get image info
            $info = getimagesize($source);
            if (!$info) {
                log_message('error', 'Could not get image info for: ' . $source);
                return false;
            }
            
            // Create image resource based on type
            switch ($info['mime']) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($source);
                    break;
                default:
                    log_message('error', 'Unsupported image type: ' . $info['mime']);
                    return false;
            }
            
            // Check if image creation failed
            if (!$image) {
                log_message('error', 'Failed to create image resource from: ' . $source);
                return false;
            }
            
            // Save the compressed image
            $success = false;
            switch ($info['mime']) {
                case 'image/jpeg':
                    $success = imagejpeg($image, $destination, $quality);
                    break;
                case 'image/png':
                    $png_quality = 9 - round(($quality / 100) * 9); // Convert quality to PNG scale (0-9)
                    $success = imagepng($image, $destination, $png_quality);
                    break;
                case 'image/gif':
                    $success = imagegif($image, $destination);
                    break;
            }
            
            // Free memory
            imagedestroy($image);
            
            // Verify compression result
            if ($success && file_exists($destination)) {
                $original_size = filesize($source);
                $compressed_size = filesize($destination);
                log_message('debug', 'Compression: Original=' . $original_size . ' bytes, Compressed=' . $compressed_size . ' bytes');
                
                // If compressed file is larger than original, use original instead
                if ($compressed_size > $original_size) {
                    log_message('debug', 'Compressed file is larger than original, using original');
                    copy($source, $destination);
                }
                
                return true;
            } else {
                log_message('error', 'Failed to save compressed image to: ' . $destination);
                return false;
            }
            
        } catch (Exception $e) {
            log_message('error', 'Image compression error: ' . $e->getMessage());
            return false;
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
    
            // Get the form to determine the report_type and sub_device_id
            $form = $this->db->get_where('activity_forms', ['form_id' => $form_id])->row();
            if (!$form) {
                throw new Exception('Form not found');
            }
            
            // Get checklist questions
            $specialized = false;
            if ($form->report_type === 'Harian' && ($form->sub_device_id == 267 || $form->sub_device_id == 269)) {
                $questions = $this->load_specialized_questions($form->sub_device_id);
                $specialized = true;
            } else {
                $questions = $this->ChecklistModel->get_checklist_questions(
                    $form->sub_device_id, 
                    $form->report_type
                );
            }
            
            // Collect tindakan values
            $tindakan = [];
            foreach ($questions as $question) {
                $field = 'tindakan' . $question->question_number;
                if ($this->input->post($field) !== null) {
                    $tindakan[$question->question_number] = $this->input->post($field);
                }
            }
            
            // Handle file uploads
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 4048; // 4MB
            
            // Ensure upload directory exists
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }
            
            $uploadedFiles = [];
            
            // Determine photo fields based on device and report type
            $photoFields = ['foto_perangkat', 'foto_lokasi', 'foto_teknisi'];
            
            // For specialized forms, use all available photo fields
            if ($specialized) {
                // For device 267, use up to 18 photos
                if ($form->sub_device_id == 267) {
                    for ($i = 4; $i <= 18; $i++) {
                        $photoFields[] = 'foto_' . $i;
                    }
                } 
                // For device 269, use up to 17 photos
                elseif ($form->sub_device_id == 269) {
                    for ($i = 4; $i <= 17; $i++) {
                        $photoFields[] = 'foto_' . $i;
                    }
                }
            } 
            // For regular Harian forms, add fields based on question count
            elseif ($form->report_type === 'Harian') {
                for ($i = 4; $i <= count($questions); $i++) {
                    $photoFields[] = 'foto_' . $i;
                }
            }
            
            // Process each photo field
            foreach ($photoFields as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload($field)) {
                        $upload_data = $this->upload->data();
                        $source_path = $upload_data['full_path'];
                        
                        // Compress image
                        $compressed_filename = 'compressed_' . time() . '_' . $upload_data['file_name'];
                        $destination_path = $config['upload_path'] . $compressed_filename;
                        
                        $compression_success = $this->compress_image($source_path, $destination_path, 75);
                        
                        if ($compression_success) {
                            // Remove original file after compression
                            if (file_exists($source_path)) {
                                unlink($source_path);
                            }
                            
                            // Save compressed filename
                            $uploadedFiles[$field] = $compressed_filename;
                        } else {
                            // Use original file if compression fails
                            $uploadedFiles[$field] = $upload_data['file_name'];
                        }
                    } else {
                        throw new Exception($this->upload->display_errors('', ''));
                    }
                }
            }
            
            // Prepare data for database
            $data = [
                'form_id' => $form_id,
                'device_hidn_id' => $device_hidn_id,
                'jam_kegiatan' => $this->input->post('jam_kegiatan'),
                'jam_selesai' => $this->input->post('jam_selesai'),
                'tindakan' => json_encode($tindakan),
                'notes' => $this->input->post('notes') ?: 'Normal'
            ];
            
            // Add uploaded files to data
            foreach ($uploadedFiles as $field => $filename) {
                $data[$field] = $filename;
            }
            
            // Save to database
            $result = $this->db->insert('activity_form_data', $data);
            
            if ($result) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data saved successfully'
                ];
            } else {
                throw new Exception('Failed to save data to database');
            }
            
        } catch (Exception $e) {
            log_message('error', 'Add form data error: ' . $e->getMessage());
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
                    af.*,
                    ap.tanggal_kegiatan,
                    ap.kode_activity,
                    ma.area_name,
                    sk.nama_shift,
                    sk.jam_mulai,
                    sk.jam_selesai,
                    GROUP_CONCAT(DISTINCT ms.nama_pegawai) as personel_names
                ')
                ->from('activity_forms af')
                ->join('activity_pm ap', 'ap.id_activity = af.activity_id')
                ->join('ms_area ma', 'ma.area_id = af.area_id')
                ->join('shift_kerja sk', 'sk.id_shift = ap.shift_id')
                ->join('activity_personel apr', 'apr.activity_id = ap.id_activity')
                ->join('ms_account ms', 'ms.id = apr.user_id')
                ->where('af.form_id', $id)
                ->group_by('af.form_id')
                ->get()
                ->row();
    
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
            
            // Determine if this is a specialized form
            $isSpecialized = ($formDetails->report_type === 'Harian' && 
                             ($formDetails->sub_device_id == 267 || $formDetails->sub_device_id == 269));
            
            // Get checklist questions based on form type
            // For documentation, we use the documentation version of specialized questions
            if ($isSpecialized) {
                $questions = $this->load_specialized_questions($formDetails->sub_device_id, true);
            } else {
                $questions = $this->ChecklistModel->get_checklist_questions(
                    $formDetails->sub_device_id, 
                    $formDetails->report_type
                );
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
            $pdf->SetMargins(15, 10, 15);
            $pdf->SetAutoPageBreak(TRUE, 10);
            
            // For specialized daily forms, use a different layout
            if ($isSpecialized) {
                $this->generateSpecializedDailyReport($pdf, $formDetails, $formData, $questions);
            } else {
                // Original layout for non-specialized forms
                $this->generateStandardReport($pdf, $formDetails, $formData, $questions);
            }
            
            // Output PDF
            $pdf->Output('dokumentasi_pm_' . date('Y-m-d') . '.pdf', 'I');
            
        } catch (Exception $e) {
            log_message('error', 'Error generating PDF: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Failed to generate PDF: ' . $e->getMessage());
            redirect('activity');
        }
    }
    
    private function generateSpecializedDailyReport($pdf, $formDetails, $formData, $questions) {
        // Determine total photos based on device ID
        $totalPhotos = ($formDetails->sub_device_id == 267) ? 18 : 17;
        $photosPerPage = 6; // 6 photos per page as requested
        
        // Process each form data entry
        foreach ($formData as $dataIndex => $data) {
            // Calculate total pages needed for this form data
            $totalPages = ceil($totalPhotos / $photosPerPage);
            
            // Create pages for this form data entry
            for ($page = 0; $page < $totalPages; $page++) {
                // Add a new page for each set of 6 photos
                $pdf->AddPage();
                
                // Create the header table with logos
                $this->createPdfHeaderTable($pdf, $formDetails);
                
                // Calculate which photos to show on this page
                $startIndex = $page * $photosPerPage;
                $endIndex = min(($startIndex + $photosPerPage), $totalPhotos);
                
                // Define the cell dimensions
                $cellWidth = 85;  // Width of each photo cell
                $cellHeight = 60; // Height of each photo cell
                $captionHeight = 10; // Height of the caption
                
                // Add the data item header/title
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->Cell(0, 7, 'Data ' . ($dataIndex + 1) . ' - ' . $data->device_hidn_name, 0, 1, 'L');
                $pdf->Ln(2);
                
                // Position tracking for 2x3 grid (2 columns, 3 rows)
                $currentRow = 0;
                $currentCol = 0;
                $startY = $pdf->GetY();
                
                // Create photo cells in a 2x3 grid
                for ($i = $startIndex; $i < $endIndex; $i++) {
                    // Calculate position for this cell
                    $x = 15 + ($currentCol * $cellWidth);
                    $y = $startY + ($currentRow * ($cellHeight + $captionHeight));
                    
                    // Set cursor position
                    $pdf->SetXY($x, $y);
                    
                    // Determine photo field name
                    $fieldName = $i < 3 ? 
                        ['foto_perangkat', 'foto_lokasi', 'foto_teknisi'][$i] : // Use existing names for first 3
                        'foto_' . ($i + 1);
                    
                    // Draw photo cell border
                    $pdf->Cell($cellWidth, $cellHeight, '', 1, 0);
                    
                    // Add photo if available
                    if (!empty($data->$fieldName)) {
                        $imgPath = './uploads/' . $data->$fieldName;
                        if (file_exists($imgPath)) {
                            // Calculate dimensions to fit the cell
                            $imgSize = getimagesize($imgPath);
                            if ($imgSize) {
                                $imgWidth = $imgSize[0];
                                $imgHeight = $imgSize[1];
                                
                                // Calculate scaling to fit
                                $maxWidth = $cellWidth - 4; // 2px padding on each side
                                $maxHeight = $cellHeight - 4; // 2px padding on each side
                                
                                $widthRatio = $maxWidth / $imgWidth;
                                $heightRatio = $maxHeight / $imgHeight;
                                $ratio = min($widthRatio, $heightRatio);
                                
                                $newWidth = $imgWidth * $ratio;
                                $newHeight = $imgHeight * $ratio;
                                
                                // Center image in cell
                                $imageX = $x + (($cellWidth - $newWidth) / 2);
                                $imageY = $y + (($cellHeight - $newHeight) / 2);
                                
                                $pdf->Image($imgPath, $imageX, $imageY, $newWidth, $newHeight);
                            }
                        }
                    }
                    
                    // Add caption below the photo
                    $pdf->SetXY($x, $y + $cellHeight);
                    $pdf->SetFont('helvetica', '', 8);
                    
                    // Get question/caption text
                    $caption = isset($questions[$i]) ? $questions[$i]->question_text : 'Photo ' . ($i + 1);
                    
                    // Add caption with border
                    $pdf->Cell($cellWidth, $captionHeight, $caption, 1, 0, 'L');
                    
                    // Move to next cell position
                    $currentCol++;
                    if ($currentCol >= 2) {
                        $currentCol = 0;
                        $currentRow++;
                    }
                }
                
                // Adjust position for the next content
                $pdf->SetY($startY + (3 * ($cellHeight + $captionHeight)) + 10);
            }
        }
    }
    
    private function createPdfHeaderTable($pdf, $formDetails) {
        // Set font for header
        $pdf->SetFont('helvetica', 'B', 10);
        
        // Table dimensions
        $fullWidth = 180;
        $logoWidth = 40;
        $headerHeight = 25;
        
        // Create outer table border
        $pdf->Rect(15, 15, $fullWidth, $headerHeight);
        
        // Add vertical lines to create 3 columns
        $pdf->Line(15 + $logoWidth, 15, 15 + $logoWidth, 15 + $headerHeight); // After left logo
        $pdf->Line(15 + $fullWidth - $logoWidth, 15, 15 + $fullWidth - $logoWidth, 15 + $headerHeight); // Before right logo
        
        // Add logos
        $leftLogo = FCPATH . 'assets/images/logo.jpg';
        $rightLogo = FCPATH . 'assets/images/logo-ias.jpg';
        
        // Add left logo
        $pdf->Image($leftLogo, 17, 17, $logoWidth - 4, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Add right logo
        $pdf->Image($rightLogo, 15 + $fullWidth - $logoWidth + 2, 17, $logoWidth - 4, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Add title in center column
        $centerX = 15 + $logoWidth;
        $centerWidth = $fullWidth - (2 * $logoWidth);
        
        $pdf->SetXY($centerX, 17);
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell($centerWidth, 7, 'DOCUMENTATION REPORT', 0, 1, 'C');
        $pdf->SetXY($centerX, 22);
        $pdf->Cell($centerWidth, 7, 'PREVENTIVE MAINTENANCE ACTIVITY', 0, 1, 'C');
        $pdf->SetXY($centerX, 27);
        $pdf->Cell($centerWidth, 7, 'IT NON-PUBLIC SERVICE SYSTEM EQUIPMENT', 0, 1, 'C');
        
        // Reset position and font for details section
        $pdf->SetXY(15, 45);
        $pdf->SetFont('helvetica', '', 10);
        
        // Add activity information
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
        
        // Add some space after the information
        $pdf->Ln(5);
    }
    
    private function generateStandardReport($pdf, $formDetails, $formData, $questions) {
        // Add a page
        $pdf->AddPage();
        
        // Create PDF header
        $this->createPdfHeaderTable($pdf, $formDetails);
        
        // Add photos for each form data
        foreach ($formData as $index => $data) {
            $pdf->Ln(2);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(0, 7, 'Data ' . ($index + 1) . ' - ' . $data->device_hidn_name, 0, 1, 'L');
            $pdf->SetFont('helvetica', '', 10);
            
            // Determine number of photos based on report type
            $photoFields = ['foto_perangkat', 'foto_lokasi', 'foto_teknisi'];
            $photoDescriptions = [];
            
            if ($formDetails->report_type === 'Harian' && count($questions) > 3) {
                // For Harian form, add additional photo fields
                for ($i = 4; $i <= count($questions); $i++) {
                    $photoFields[] = 'foto_' . $i;
                }
                
                // Prepare descriptions for each photo based on checklist questions
                for ($i = 0; $i < count($questions); $i++) {
                    if (isset($questions[$i])) {
                        $photoDescriptions[] = $questions[$i]->question_text;
                    } else {
                        $photoDescriptions[] = 'Foto ' . ($i + 1);
                    }
                }
            } else {
                // Default descriptions for non-Harian forms
                $photoDescriptions = [
                    'Memastikan indikator access point',
                    'Lokasi Perangkat Access Point',
                    'Hasil Speed Test Internet'
                ];
            }
            
            // Photo layout settings
            $photosPerRow = 3;
            $cellWidth = 180 / $photosPerRow;
            $cellHeight = 40;
            
            // Loop through available photos
            for ($i = 0; $i < count($photoFields); $i += $photosPerRow) {
                // Starting position for this row
                $startX = $pdf->GetX();
                $startY = $pdf->GetY();
                
                // Draw boxes for photos
                for ($j = 0; $j < $photosPerRow && ($i + $j) < count($photoFields); $j++) {
                    $pdf->Cell($cellWidth, $cellHeight, '', 1, 0);
                }
                $pdf->Ln();
                
                // Reset position to add images
                $pdf->SetXY($startX, $startY);
                
                // Add images
                for ($j = 0; $j < $photosPerRow && ($i + $j) < count($photoFields); $j++) {
                    $field = $photoFields[$i + $j];
                    
                    if (!empty($data->$field)) {
                        $imgPath = './uploads/' . $data->$field;
                        if (file_exists($imgPath)) {
                            // Adjust image to fit in cell
                            $imgSize = getimagesize($imgPath);
                            if ($imgSize) {
                                $imgWidth = $imgSize[0];
                                $imgHeight = $imgSize[1];
                                
                                $margin = 2;
                                $maxWidth = $cellWidth - (2 * $margin);
                                $maxHeight = $cellHeight - (2 * $margin);
                                
                                $widthRatio = $maxWidth / $imgWidth;
                                $heightRatio = $maxHeight / $imgHeight;
                                $ratio = min($widthRatio, $heightRatio);
                                
                                $newWidth = $imgWidth * $ratio;
                                $newHeight = $imgHeight * $ratio;
                                
                                $imageX = $startX + ($j * $cellWidth) + (($cellWidth - $newWidth) / 2);
                                $imageY = $startY + (($cellHeight - $newHeight) / 2);
                                
                                $pdf->Image($imgPath, $imageX, $imageY, $newWidth, $newHeight);
                            }
                        }
                    }
                    
                    // Move to next column position
                    $pdf->SetX($startX + ($j + 1) * $cellWidth);
                }
                
                // Reset position to add labels
                $pdf->SetXY($startX, $startY + $cellHeight);
                $pdf->SetFont('helvetica', '', 8);
                
                // Add labels for each photo
                for ($j = 0; $j < $photosPerRow && ($i + $j) < count($photoFields); $j++) {
                    $description = isset($photoDescriptions[$i + $j]) ?
                        $photoDescriptions[$i + $j] : 'Foto ' . ($i + $j + 1);
                    
                    $pdf->Cell($cellWidth, 5, $description, 'LBR', 0, 'C');
                }
                $pdf->Ln();
                
                // Add device name below each photo
                $pdf->SetX($startX);
                $pdf->SetFont('helvetica', 'B', 6);
                $pdf->Ln(10); // Space for next row of photos
            }
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
                    sd.sub_device_name,
                    GROUP_CONCAT(DISTINCT ms.nama_pegawai) as personel_names
                ')
                ->from('activity_forms af')
                ->join('activity_pm ap', 'ap.id_activity = af.activity_id')
                ->join('ms_area ma', 'ma.area_id = af.area_id')
                ->join('shift_kerja sk', 'sk.id_shift = ap.shift_id')
                ->join('activity_personel apr', 'apr.activity_id = ap.id_activity')
                ->join('ms_account ms', 'ms.id = apr.user_id')
                ->join('ms_sub_device sd', 'sd.sub_device_id = af.sub_device_id') // Join with sub_device table
                ->where('af.form_id', $id)
                ->group_by('af.form_id')
                ->get()
                ->row();
            
            if (!$formDetails) {
                throw new Exception('Form details not found');
            }
    
            // Get form data with answers
            $formData = $this->db->select('
                    afd.*,
                    dh.device_hidn_name
                ')
                ->from('activity_form_data afd')
                ->join('ms_device_hidn dh', 'dh.device_hidn_id = afd.device_hidn_id')
                ->where('afd.form_id', $id)
                ->get()
                ->result();
    
            // Get checklist questions
            $questions = $this->ChecklistModel->get_checklist_questions(
                $formDetails->sub_device_id, 
                $formDetails->report_type
            );
    
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
            $pdf->Cell(40, 4, 'Tanggal', 0, 0);
            $pdf->Cell(5, 4, ':', 0, 0);
            $pdf->Cell(0, 4, date('d F Y', strtotime($formDetails->tanggal_kegiatan)), 0, 1);
    
            $pdf->Cell(40, 4, 'Lokasi', 0, 0);
            $pdf->Cell(5, 4, ':', 0, 0);
            $pdf->Cell(0, 4, $formDetails->area_name, 0, 1);

            $pdf->Cell(40, 4, 'Perangkat', 0, 0);
            $pdf->Cell(5, 4, ':', 0, 0);
            $pdf->Cell(0, 4, $formDetails->sub_device_name, 0, 1);
    
            $pdf->Cell(40, 4, 'Shift/Jam Kerja', 0, 0);
            $pdf->Cell(5, 4, ':', 0, 0);
            $pdf->Cell(0, 4, $formDetails->nama_shift . ' (' . $formDetails->jam_mulai . ' - ' . $formDetails->jam_selesai . ')', 0, 1);
    
            $pdf->Cell(40, 4, 'Personel', 0, 0);
            $pdf->Cell(5, 4, ':', 0, 0);
            $pdf->Cell(0, 4, $formDetails->personel_names, 0, 1);
    
            $pdf->Cell(40, 4, 'Jenis Report', 0, 0);
            $pdf->Cell(5, 4, ':', 0, 0);
            $pdf->Cell(0, 4, $formDetails->report_type, 0, 1);
    
            // Add checklist tables for each data entry
            foreach ($formData as $index => $data) {
                $pdf->Ln(5);
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->Cell(0, 5, 'Checklist ' . ($index + 1) . ' - ' . $data->device_hidn_name, 0, 1);
                $jam_mulai = $data->jam_kegiatan;
                $jam_selesai = $data->jam_selesai ? $data->jam_selesai : ''; // Cek jika jam_selesai ada
                $format_jam = $jam_selesai ? $jam_mulai . ' s/d ' . $jam_selesai : $jam_mulai;
                $pdf->Cell(0, 2, 'Jam Kegiatan: ' . $format_jam, 0, 1);
                
                // Table header
                $pdf->SetFont('helvetica', 'B', 8);
                $pdf->Cell(10, 5, 'No', 1, 0, 'C');
                $pdf->Cell(130, 5, 'Item Check', 1, 0, 'C');
                $pdf->Cell(20, 5, 'Status', 1, 1, 'C');
                
                // Parse tindakan JSON
                $tindakan = json_decode($data->tindakan, true) ?: [];
                
                // Table content
                $pdf->SetFont('helvetica', '', 9);
                foreach ($questions as $key => $question) {
                    $questionNumber = $question->question_number;
                    $pdf->Cell(10, 3, $questionNumber, 1, 0, 'C');
                    $pdf->Cell(130, 3, $question->question_text, 1, 0, 'L');
                    
                    // Get corresponding tindakan value
                    $tindakanValue = isset($tindakan[$questionNumber]) ? $tindakan[$questionNumber] : 'N/A';
                    $pdf->Cell(20, 3, $tindakanValue, 1, 1, 'C');
                }
                
                // // Notes section below the table
                $pdf->Ln(2);
                $pdf->SetFont('helvetica', 'I', 9);
                $pdf->Cell(20, 5, 'Catatan:', 0, 0);
                $pdf->Cell(0, 5, $data->notes, 0, 1);
            }
    
            // Signature
            $pdf->Ln(5);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Cell(90, 7, 'ANGKASA PURA INDONESIA', 0, 0, 'C');
            $pdf->Cell(90, 7, 'IAS SUPPORT', 0, 1, 'C');
    
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