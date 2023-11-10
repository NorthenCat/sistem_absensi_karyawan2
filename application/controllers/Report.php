<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Public_model');
    $this->load->model('Admin_model');
  }
  public function index()
  {
    $d['title'] = 'Report';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['department'] = $this->db->get('department')->result_array();
    $d['start'] = $this->input->get('start');
    $d['end'] = $this->input->get('end');
    $d['dept_code'] = $this->input->get('dept');
    $d['attendance'] = $this->_attendanceDetails($d['start'], $d['end'], $d['dept_code']);

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('report/index', $d);
    $this->load->view('templates/table_footer');
  }
  private function _attendanceDetails($start, $end, $dept)
  {
    if ($start == '' || $end == '') {
      return false;
    } else {
      return $this->Public_model->get_attendance($start, $end, $dept);
    }
  }
  public function print($start, $end, $dept)
  {
    $d['start'] = $start;
    $d['end'] = $end;
    $d['attendance'] = $this->Public_model->get_attendance($start, $end, $dept);
    $d['dept'] = $dept;

    $this->load->view('report/print', $d);
  }

  public function student_report()
  {
    $data['title'] = 'Absensi';
    $data['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $data['mapel'] = $this->db->get('tb_master_mapel')->result_array();
    $data['kelas'] = $this->db->get('tb_mkelas')->result_array();

    $data['data'] = $this->absense_history_details();

    // Load views
    $this->load->view('templates/table_header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('report/student', $data);
    $this->load->view('templates/table_footer');
  }

  private function absense_history_details()
  {
    $start = $this->input->get('start');
    $end = $this->input->get('end');
    $mapel = $this->input->get('mapel');
    $kelas = $this->input->get('kelas');

    $d['attendance'] = $this->Public_model->get_student_report($start, $end, $mapel, $kelas);

    $d['start'] = $start;
    $d['end'] = $end;
    $d['mapel'] = $mapel;
    $d['kelas'] = $kelas;

    return $d;
  }

  public function print_student($start, $end, $mapel, $kelas)
  {
    $d['start'] = $start;
    $d['end'] = $end;
    $d['mapel'] = $this->db->get_where('tb_master_mapel', ['id_mapel' => $mapel])->row_array()['mapel'];
    $d['kelas'] = $this->db->get_where('tb_mkelas', ['id_mkelas' => $kelas])->row_array();
    $d['attendance'] = $this->Public_model->get_student_report($start, $end, $mapel, $kelas);

    $this->load->view('report/print_student', $d);
  }

  public function edit_history_student()
  {
    $account = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $id_mkelas = $this->input->get('kelas');
    $id_mapel = $this->input->get('mapel');
    $start = $this->input->get('start');
    $end = $this->input->get('end');
    $tgl_absen = $this->input->post('tgl_absen');

    $attendance_status = $this->input->post('attendance_status');

    foreach ($attendance_status as $key => $value) {
      // Check if the data has changed
      $check = $this->db->get_where('_logabsensi', ['id_presensi' => $key])->row_array();

      if (!empty($check) && $check['ket'] != $value) {
        echo "<script>console.log('Key Objects: " . $key . "' );</script>";
        echo "<script>console.log('Value Objects: " . $value . "' );</script>";
        $this->db->query("UPDATE _logabsensi SET ket = '$value' WHERE id_presensi = '$key'");
      }
    }

    redirect('report/student_report?start=' . $start . '&end=' . $end . '&mapel=' . $id_mapel . '&kelas=' . $id_mkelas);
  }

}