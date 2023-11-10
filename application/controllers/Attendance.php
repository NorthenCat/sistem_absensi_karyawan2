<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_weekends();
    is_logged_in();
    is_checked_in();
    is_checked_out();
    $this->load->library('form_validation');
    $this->load->model('Public_model');
    $this->load->model('Admin_model');
  }
  public function index()
  {
    // Attendance Form
    $d['title'] = 'Attendance Form';
    $d['account'] = $this->Public_model->getAccount($this->session->userdata['username']);
    $d['location'] = $this->db->get('location')->result_array();

    //Input all guru to table attendance with default status alpha and other data is null.
    $this->Public_model->inputAllGuruToAttendance();

    // If Weekends
    if (is_weekends() == true) {
      $d['weekends'] = true;
      $this->load->view('templates/header', $d);
      $this->load->view('templates/sidebar');
      $this->load->view('templates/topbar');
      $this->load->view('attendance/index', $d); // Attendance Form Page
      $this->load->view('templates/footer');
    } else {
      $d['in'] = true;
      $d['weekends'] = false;
      // If haven't Time In Today
      if (is_checked_in() == false) {
        $d['in'] = false;

        $this->form_validation->set_rules('work_shift', 'Work Shift', 'required|trim');
        $this->form_validation->set_rules('userLocation', 'userLocation', 'required|trim');

        if ($this->form_validation->run() == false) {
          $shift = $d['account']['shift'];
          $queryShift = "SELECT * FROM `shift` WHERE `id` = $shift";
          $resultShift = $this->db->query($queryShift)->row_array();
          $startTime = $resultShift['start'];
          $endTime = $resultShift['end'];
          $d['startTime'] = $startTime;
          $d['endTime'] = $endTime;

          $this->load->view('templates/header', $d);
          $this->load->view('templates/sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('attendance/index', $d); // Attendance Form Page
          $this->load->view('templates/footer');
        } else {
          date_default_timezone_set('Asia/Jakarta');
          $shift = $d['account']['shift'];
          $queryShift = "SELECT * FROM `shift` WHERE `id` = $shift";
          $resultShift = $this->db->query($queryShift)->row_array();
          $startTime = $resultShift['start'];

          $username = $this->session->userdata['username'];
          $employee_id = $d['account']['id'];
          $department_id = $d['account']['department_id'];
          $shift_id = $this->input->post('work_shift');
          $location_id = $this->input->post('location');
          $iTime = time();
          $iTime = strtotime('-1 hour', $iTime);
          $notes = $this->input->post('notes');
          $lack = 'None';
          $userLocation = $this->input->post('userLocation');
          list($latitude, $longtitude) = explode(',', $userLocation);

          // Time In Time
          if (date('H:i:s', $iTime) <= $startTime) {
            $inStatus = 'On Time';
          } else {
            $inStatus = 'Late';
          }
          ;

          // Check Notes
          if (!$notes) {
            $lack = 'Notes';
          }

          // Config Upload
          $config['upload_path'] = './images/attendance/';
          $config['allowed_types'] = 'jpg|png|jpeg';
          $config['max_size'] = '2048';
          $config['file_name'] = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

          // Load Upload Library and Pass Config
          $this->load->library('upload', $config);

          //push to database based on currentdate
          $today = date('Y-m-d');

          if ($_FILES['image']['name']) {
            if ($this->upload->do_upload('image')) {
              $image = $this->upload->data('file_name');
              $value = [
                'username' => $username,
                'employee_id' => $employee_id,
                'department_id' => $department_id,
                'shift_id' => $shift_id,
                'location_id' => $location_id,
                'in_time' => $iTime,
                'status_absen' => 'HADIR',
                'notes' => $notes,
                'image' => $image,
                'lack_of' => $lack,
                'in_status' => $inStatus,
                'latitude' => $latitude,
                'longtitude' => $longtitude
              ];
            } else {
              $this->upload->display_errors();
            }
          } else {
            if ($lack != '') {
              $lack .= ',image';
            } else {
              $lack = 'image';
            }
            $value = [
              'username' => $username,
              'employee_id' => $employee_id,
              'department_id' => $department_id,
              'shift_id' => $shift_id,
              'location_id' => $location_id,
              'in_time' => $iTime,
              'status_absen' => 'HADIR',
              'notes' => $notes,
              'lack_of' => $lack,
              'in_status' => $inStatus,
              'latitude' => $latitude,
              'longtitude' => $longtitude
            ];
          }
          $this->_checkIn($value, $employee_id);
        }
      }
      // End of Today Time In
      // If Checked In
      else {
        if (is_checked_out() == true) {
          $d['disable'] = true;
        } else {
          $d['disable'] = false;
        }
        ;
        $this->load->view('templates/header', $d);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('attendance/index', $d); // Attendance Form Page
        $this->load->view('templates/footer');
      }
    }
  }
  // Check Time In
  private function _checkIn($value, $employee_id)
  {
    $today = date('Y-m-d');
    $data_to_update = array(
      'employee_id' => $employee_id,
      'created_date' => $today
    );

    $this->db->where($data_to_update);
    $this->db->update('attendance', $value);
    $rows = $this->db->affected_rows();
    if ($rows > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                                       Stamped attendance for today</div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                       Failed to stamp your attendance!</div>');
    }
    redirect('attendance');
  }

  // Check Time Out
  public function checkOut()
  {
    $username = $this->session->userdata['username'];
    $today = date('Y-m-d', time());
    $querySelect = "SELECT  attendance.username AS `username`,
                              attendance.employee_id AS `employee_id`,
                              attendance.shift_id AS `shift_id`,
                              attendance.in_time AS `in_time`,
                              shift.start AS `start`,
                              shift.end AS `end`
                        FROM  `attendance`
                  INNER JOIN  `shift`
                          ON  attendance.shift_id = shift.id
                       WHERE  `username` = '$username'
                         AND  FROM_UNIXTIME(`in_time`, '%Y-%m-%d') = '$today'";
    $checkOut = $this->db->query($querySelect)->row_array();

    $oTime = time();
    $oTime = strtotime('-1 hour', $oTime);

    // Time Out Time
    if (date('H:i:s', $oTime) >= $checkOut['end']) {
      $outStatus = 'Over Time';
    } else {
      $outStatus = 'Early';
    }
    ;

    $value = [
      'out_time' => $oTime,
      'out_status' => $outStatus
    ];

    $queryUpdate = "UPDATE `attendance`
                         SET `out_time` ='" . $value['out_time'] . "', `out_status` ='" . $value['out_status'] . "' WHERE  `username` = '$username' AND  FROM_UNIXTIME(`in_time`, '%Y-%m-%d') = '$today'";
    $this->db->query($queryUpdate);
    redirect('attendance');
  }

  public function history()
  {
    $d['title'] = 'Attendance History';
    $d['account'] = $this->Public_model->getAccount($this->session->userdata['username']);
    $d['e_id'] = $d['account']['id'];
    $d['data'] = $this->attendance_details_data($d['e_id']);

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('attendance/history', $d);
    $this->load->view('templates/table_footer');
  }

  public function laporan()
  {
    $d['title'] = 'Attendance laporan';
    $d['account'] = $this->Public_model->getAccount($this->session->userdata['username']);
    $d['e_id'] = $d['account']['id'];
    $d['data'] = $this->attendance_details_data($d['e_id']);

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('attendance/history', $d);
    $this->load->view('templates/table_footer');
  }
  private function attendance_details_data($e_id)
  {
    $start = $this->input->get('start');
    $end = $this->input->get('end');

    $d['attendance'] = $this->Public_model->get_emp_attendance($e_id, $start, $end);

    $d['start'] = $start;
    $d['end'] = $end;

    return $d;
  }
  public function stats()
  {
    $data['title'] = 'Absensi';
    $data['account'] = $this->Public_model->getAccount($this->session->userdata['username']);

    $data['id_employee'] = $data['account']['id'];
    // Fetch data related to mengajar
    $data['mengajar'] = $this->Public_model->getMengajarData($data['id_employee']);

    // Load views
    $this->load->view('templates/table_header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('attendance/stats', $data);
    $this->load->view('templates/table_footer');
  }

  public function form()
  {
    $d['title'] = 'Absensi';
    $d['account'] = $this->Public_model->getAccount($this->session->userdata['username']);
    $selected_id_mkelas = $this->input->get('id_mkelas');
    if (!$this->Public_model->checkMengajar($d['account']['id'], $selected_id_mkelas)) {
      redirect('attendance/stats');
    }
    $d['daftar_siswa'] = $this->Public_model->getFormAbsensiSiswaData($selected_id_mkelas);
    $d['id_mkelas'] = $selected_id_mkelas;

    $currentDate = date('Y-m-d');
    $attendanceExists = $this->Public_model->checkAttendanceForDate($selected_id_mkelas, $currentDate);

    if (!$attendanceExists) {
      $this->Public_model->createAttendanceForDate($d['account']['id'], $selected_id_mkelas, $currentDate);
    }

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('attendance/form', $d);
    $this->load->view('templates/table_footer');
  }

  public function inputAbsensi()
  {
    $account = $this->Public_model->getAccount($this->session->userdata['username']);
    $selected_id_mkelas = $this->input->get('id_mkelas');
    $id_mengajar = $this->Public_model->getMengajarId($selected_id_mkelas, $account['id']);
    $userLocation = $this->input->post('userLocation');
    list($latitude, $longtitude) = explode(',', $userLocation);
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s', strtotime('-1 hour'));

    //status notif
    $status_notif = false;


    // Get the start time from the database for the specified id_mengajar
    $jam_mulai = $this->db->get_where('tb_mengajar', ['id_mengajar' => $id_mengajar])->row_array();
    $jam_mulai = $jam_mulai['jam_mulai'];

    // Calculate the difference in minutes between currentTime and jam_mulai
    $jam_mulai_timestamp = strtotime($jam_mulai);
    $current_time_timestamp = strtotime($currentTime);
    $difference_in_minutes = ($current_time_timestamp - $jam_mulai_timestamp) / 60;
    $difference_in_minutes = round($difference_in_minutes);

    // terhitung telat jika waktu $Jam_mulai + 15 menit
    if ($difference_in_minutes > 15) {
      $difference_in_minutes = $difference_in_minutes - 15;
      if ($difference_in_minutes > 60) {
        $hours = floor($difference_in_minutes / 60);
        $minutes = $difference_in_minutes % 60;
        $statusAbsen = "Telat $hours Jam $minutes Menit";
      } else {
        $statusAbsen = "Telat $difference_in_minutes Menit";
      }
    } else if ($difference_in_minutes < 0) {
      $statusAbsen = "Terlalu Cepat";
    } else {
      $statusAbsen = "Tepat Waktu";
    }


    //check if status_notif is true in database
    foreach ($this->input->post() as $key => $value) {
      $check = $this->db->get_where('_logabsensi', ['id_siswa' => $key, 'tgl_absen' => $currentDate])->row_array();
      if (!empty($check) && $check['status_notif'] == 1) {
        $status_notif = true;
      }
    }

    // Loop through the posted data and update the database
    foreach ($this->input->post() as $key => $value) {
      // Check if the data has changed
      $check = $this->db->get_where('_logabsensi', ['id_siswa' => $key, 'tgl_absen' => $currentDate])->row_array();

      if (!empty($check) && $check['ket'] != $value) {
        // Update the database
        $this->db->query("
                UPDATE _logabsensi 
                SET ket = '$value', jam_absen = '$currentTime', ket_absen = '$statusAbsen', latitude = '$latitude', longitude='$longtitude', status_notif=1
                WHERE id_siswa = '$key' AND tgl_absen = '$currentDate'");
      }
    }

    //if status_notif is false then send notification
    if (!$status_notif) {
      $this->sendNotification($id_mengajar, $currentDate);
    }

    // Show alert before redirect
    echo "<script>alert('Attendance updated successfully.');</script>";
    // Redirect to the desired page
    echo "<script>window.location.href = 'form?id_mkelas=$selected_id_mkelas';</script>";
  }

  private function sendNotification($id_mengajar, $currentDate)
  {
    $this->load->library('session');
    $this->load->helper('url');

    //take data employee and class
    $data = $this->Public_model->getMengajarById($id_mengajar);

    // Define your API token and target here
    $token = "jrF23aZVVITDt#@kXLwY";
    $target = $data['no_hp'];

    // Define your notification message
    $message = "Terima kasih saudara " . $data['name'] . " telah melakukan absensi pada tanggal " . $currentDate . " di kelas " . $data['kelas'] . " - " . $data['nama_kelas'] . " pada mata pelajaran " . $data['mapel'] . ". Selamat Beraktivitas.";

    // Set up cURL request
    $curl = curl_init();

    curl_setopt_array(
      $curl,
      array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
          'target' => $target,
          'message' => $message,
        ),
        CURLOPT_HTTPHEADER => array(
          "Authorization: $token"
        ),
      )
    );

    $response = curl_exec($curl);

    curl_close($curl);

    // Handle the response as needed
    // For example, you can log it or return it as a response to your function
    // You may also want to check the response for success or error indicators

    return $response;
  }




  public function absence_history()
  {
    $d['title'] = 'Absensi';
    $d['account'] = $this->Public_model->getAccount($this->session->userdata['username']);

    $d['id_employee'] = $d['account']['id'];
    $d['id_mkelas'] = $this->input->get('id_mkelas');
    $d['id_mapel'] = $this->input->get('id_mapel');

    //Check Parameter
    if (!$this->Public_model->check_parameter_absence($d['id_employee'], $d['id_mkelas'], $d['id_mapel'])) {
      redirect('attendance/stats');
    }

    // Fetch data related to mengajar
    $d['mengajar'] = $this->Public_model->getMengajarData($d['id_employee']);
    $d['mapel'] = $this->db->get('tb_master_mapel')->result_array();
    $d['kelas'] = $this->db->get('tb_mkelas')->result_array();

    $d['data'] = $this->absence_history_details($d['id_employee'], $d['id_mkelas'], $d['id_mapel']);

    // Load views
    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('attendance/absence-history', $d);
    $this->load->view('templates/table_footer');
  }

  public function absence_history_details($id_employee, $id_mkelas, $id_mapel)
  {
    $start = $this->input->get('start');
    $end = $this->input->get('end');

    $d['logabsensi'] = $this->Public_model->get_absence_history($id_employee, $id_mkelas, $id_mapel, $start, $end);

    $d['start'] = $start;
    $d['end'] = $end;
    $d['kelas'] = $id_mkelas;
    $d['mapel'] = $id_mapel;

    return $d;
  }

  public function edit_history()
  {
    $account = $this->Public_model->getAccount($this->session->userdata['username']);
    $selected_id_mkelas = $this->input->get('id_mkelas');
    $id_mengajar = $this->Public_model->getMengajarId($selected_id_mkelas, $account['id']);

    $tgl_absen = $this->input->post('tgl_absen');

    foreach ($this->input->post() as $key => $value) {
      $this->db->query("
        UPDATE _logabsensi 
        SET ket = '$value'
        WHERE id_siswa = '$key' AND tgl_absen = '$tgl_absen' AND id_mengajar = '$id_mengajar'");
    }

    // Show alert before redirect
    echo "<script>alert('Attendance updated successfully.');</script>";
    // Redirect to the desired page
    // echo "<script>window.location.href = 'absence_history?id_mkelas=$selected_id_mkelas';</script>";
  }


}