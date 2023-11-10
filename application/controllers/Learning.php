<?php
defined('BASEPATH') or exit('No direct script access allowed');


require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Learning extends CI_Controller
{
  // Constructor
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Public_model');
    $this->load->model('Admin_model');

  }


  public function class ()
  {

    $d['title'] = 'Classroom';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['kelas'] = $this->db->get('tb_mkelas')->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/class/index', $d);
    $this->load->view('templates/logout');
  }

  public function t_class()
  {
    $d['title'] = 'Add Class';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['kelas'] = $this->db->get('tb_mkelas')->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/class/t_class', $d);
    $this->load->view('templates/logout');
  }

  public function addClass()
  {
    $data = [
      'kd_kelas' => $this->input->post('kode'),
      'kelas' => $this->input->post('d_class'),
      'nama_kelas' => $this->input->post('kelas')
    ];

    //check if the class is already exist or not
    $check = $this->db->get_where('tb_mkelas', ['nama_kelas' => $this->input->post('kelas'), 'kelas' => $this->input->post('d_class')])->num_rows();

    if ($check > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kelas sudah ada</div>');
      redirect('learning/class');
    } else {
      $this->db->insert('tb_mkelas', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas berhasil ditambahkan</div>');
      redirect('learning/class');
    }
  }

  public function e_class()
  {
    $d['title'] = 'Edit Class';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    //take data from db based on id
    $d['kelas'] = $this->db->get_where('tb_mkelas', ['kd_kelas' => $this->input->get('id')])->row_array();

    //if the if id is not exist, it will redirect to class page
    if (empty($d['kelas'])) {
      redirect('learning/class');
    }

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/class/e_class', $d);
    $this->load->view('templates/logout');
  }

  public function editClass()
  {
    $data = [
      'kelas' => $this->input->post('d_class'),
      'nama_kelas' => $this->input->post('kelas')
    ];

    //check if the class is already exist or not
    $check = $this->db->get_where('tb_mkelas', ['nama_kelas' => $this->input->post('kelas'), 'kelas' => $this->input->post('d_class')])->num_rows();
    if ($check > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kelas sudah ada</div>');
      redirect('learning/class');
    } else {
      $this->db->where('kd_kelas', $this->input->post('kode'));
      $this->db->update('tb_mkelas', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas berhasil diubah</div>');
      redirect('learning/class');
    }
  }
  public function delClass()
  {
    $id = $this->input->get('id');
    $this->db->delete('tb_mkelas', ['kd_kelas' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas berhasil dihapus</div>');
    redirect('learning/class');
  }

  public function schedule()
  {


    $d['title'] = 'Schedule';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['mapel'] = $this->db->query("SELECT * FROM tb_mengajar 
                            INNER JOIN employee ON tb_mengajar.id_employee=employee.id
                            INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
                            INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
                            INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester")->result_array();


    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/schedule/index', $d);
    $this->load->view('templates/logout');
  }
  public function t_sche()
  {
    $d['title'] = 'Add Schedule';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['guru'] = $this->db->get('employee')->result_array();
    $d['mapel'] = $this->db->get('tb_master_mapel')->result_array();
    $d['kelas'] = $this->db->get('tb_mkelas')->result_array();
    $d['semester'] = $this->db->get('tb_semester')->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/schedule/t_sche', $d);
    $this->load->view('templates/logout');
  }

  public function addSche()
  {
    $data = [
      'id_employee' => $this->input->post('guru'),
      'id_mapel' => $this->input->post('mapel'),
      'id_mkelas' => $this->input->post('kelas'),
      'id_semester' => $this->input->post('semester'),
      'hari' => $this->input->post('hari'),
      'jam_mulai' => $this->input->post('jam_mulai'),
      'jam_akhir' => $this->input->post('jam_akhir'),
      'kode_pelajaran' => "MPL-" . time()
    ];
    //check if the 'employee' is already teach or not
    $check = $this->db->get_where('tb_mengajar', ['id_employee' => $this->input->post('guru'), 'id_mapel' => $this->input->post('mapel'), 'id_mkelas' => $this->input->post('kelas'), 'id_semester' => $this->input->post('semester')])->num_rows();
    if ($check > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Guru sudah mengajar mata pelajaran ini di kelas ini</div>');
      redirect('learning/t_sche');
    } else {
      $this->db->insert('tb_mengajar', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal berhasil ditambahkan</div>');
      redirect('learning/schedule');
    }
  }

  public function delSche()
  {
    $id = $this->input->get('id');
    $this->db->delete('tb_mengajar', ['kode_pelajaran' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal berhasil dihapus</div>');
    redirect('learning/schedule');
  }

  public function subject()
  {
    $d['title'] = 'Mata Pelajaran';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['mapel'] = $this->db->get('tb_master_mapel')->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/subject/index', $d);
    $this->load->view('templates/logout');
  }

  public function t_sub()
  {
    $d['title'] = 'Add Subject';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['mapel'] = $this->db->get('tb_master_mapel')->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/subject/t_sub', $d);
    $this->load->view('templates/logout');
  }

  public function addSubject()
  {
    $data = [
      'kode_mapel' => $this->input->post('kode'),
      'mapel' => $this->input->post('mapel')
    ];

    //check if the subject is already exist or not
    $check = $this->db->get_where('tb_master_mapel', ['mapel' => $this->input->post('mapel')])->num_rows();
    if ($check > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mata pelajaran sudah ada</div>');
      redirect('learning/subject');
    } else {
      $this->db->insert('tb_master_mapel', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mata pelajaran berhasil ditambahkan</div>');
      redirect('learning/subject');
    }
  }

  public function e_sub()
  {
    $d['title'] = 'Edit Subject';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    //take data from db based on id
    $d['mapel'] = $this->db->get_where('tb_master_mapel', ['kode_mapel' => $this->input->get('id')])->row_array();

    //if the if id is not exist, it will redirect to subject page
    if (empty($d['mapel'])) {
      redirect('learning/subject');
    }

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/subject/e_sub', $d);
    $this->load->view('templates/logout');
  }

  public function editSub()
  {
    $data = [
      'mapel' => $this->input->post('mapel')
    ];

    //check if the subject is already exist or not
    $check = $this->db->get_where('tb_master_mapel', ['mapel' => $this->input->post('mapel')])->num_rows();
    if ($check > 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mata pelajaran sudah ada</div>');
      redirect('learning/subject');
    } else {
      $this->db->where('kode_mapel', $this->input->post('kode'));
      $this->db->update('tb_master_mapel', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mata pelajaran berhasil diubah</div>');
      redirect('learning/subject');
    }
  }

  public function delSub()
  {
    $id = $this->input->get('id');
    $this->db->delete('tb_master_mapel', ['kode_mapel' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mata pelajaran berhasil dihapus</div>');
    redirect('learning/subject');
  }

  //for ajax request 'search guru'
  public function search_guru()
  {
    $search = $this->input->post('searchTerm');

    $query = $this->db->query("SELECT employee.id as id, employee_department.id as id_depart, employee.* FROM employee INNER JOIN employee_department ON employee.id=employee_department.employee_id WHERE employee_department.department_id != 'ADM' AND employee.name LIKE '%$search%' ORDER BY name ASC limit 10");

    $rowcount = $query->num_rows();
    if ($rowcount != 0) {
      $dataSearch = array();
      //getting id from database to fill the 'id' value
      foreach ($query->result_array() as $row):
        $dataSearch[] = array(
          'id' => $row['id'],
          'text' => ucwords($row['name'])
        );
      endforeach;
    }

    echo json_encode($dataSearch);
  }
  public function students()
  {
    $d['title'] = 'Siswa';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    //take db tb_siswa and inner join with tb_mkelas
    $d['siswa'] = $this->db->query("SELECT * FROM tb_siswa")->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/students/index', $d);
    $this->load->view('templates/logout');
  }
  public function t_stud()
  {
    $d['title'] = 'Tambah Siswa';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['siswa'] = $this->db->get('tb_siswa')->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/students/t_stud', $d);
    $this->load->view('templates/logout');
  }
  public function addStud()
  {
    // Config Upload Image
    $config['upload_path'] = './images/pp/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = '2048';
    $config['file_name'] = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

    // load library upload and pass config
    $this->load->library('upload', $config);

    if ($_FILES['image']['name']) {
      if ($this->upload->do_upload('image')) {
        $image = $this->upload->data('file_name');
      }
    } else {
      $gender = $this->input->post('e_gender');
      if ($gender == 'L') {
        $image = 'male.png';
      } else if ($gender == 'P') {
        $image = 'female.png';
      }
    }

    //take data from form, and config the image file
    $data = [
      'nis' => $this->input->post('d_id'),
      'nama_siswa' => strtolower($this->input->post('e_name')),
      'tempat_lahir' => strtolower($this->input->post('tmpt')),
      'tgl_lahir' => $this->input->post('e_birth_date'),
      'jk' => $this->input->post('e_gender'),
      'alamat' => strtolower($this->input->post('alamat')),
      'foto' => $image,
    ];

    $this->db->insert('tb_siswa', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Siswa berhasil ditambahkan</div>');
    redirect('learning/students');
  }

  public function editStud()
  {
    //check if there's an image or not
    if ($_FILES['profile_image']['name']) {
      // Konfigurasi Upload Gambar
      $config['upload_path'] = './images/pp/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = '2048';
      $config['file_name'] = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);

      // Memuat library upload dan meneruskan konfigurasi
      $this->load->library('upload', $config);

      if ($this->upload->do_upload('profile_image')) {
        $image = $this->upload->data('file_name');
      }
    } else {
      $image = $this->input->post('old_image');
    }

    //take data from form, and config the image file
    $data = [
      'nama_siswa' => strtolower($this->input->post('name')),
      'tempat_lahir' => strtolower($this->input->post('tempat_lahir')),
      'tgl_lahir' => $this->input->post('tgl_lahir'),
      'alamat' => strtolower($this->input->post('alamat')),
      'foto' => $image,
    ];

    $this->db->where('nis', $this->input->post('d_id'));
    $this->db->update('tb_siswa', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Siswa berhasil diubah</div>');
    redirect('learning/students');

  }

  public function delStud()
  {
    $id = $this->input->get('id');
    $this->db->delete('tb_siswa', ['nis' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Siswa berhasil dihapus</div>');
    redirect('learning/students');
  }
  public function listSiswa()
  {
    $d['title'] = 'Daftar Siswa';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['kelas'] = $this->db->get_where('tb_mkelas', ['kd_kelas' => $this->input->get('id')])->row_array();

    //check if the if id is not exist, it will redirect to class page
    if (empty($d['kelas'])) {
      redirect('learning/class');
    }

    $d['siswa'] = $this->db->query("SELECT * FROM tb_siswa WHERE id_mkelas='" . $d['kelas']['id_mkelas'] . "'")->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/class/list', $d);
    $this->load->view('templates/logout');
  }

  public function t_list()
  {
    $d['title'] = 'Tambah Siswa';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['kelas'] = $this->db->get_where('tb_mkelas', ['kd_kelas' => $this->input->get('id')])->row_array();

    //check if the if id is not exist, it will redirect to class page
    if (empty($d['kelas'])) {
      redirect('learning/class');
    }

    $d['siswa'] = $this->db->query("SELECT * FROM tb_siswa WHERE id_mkelas=0")->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/class/t_list', $d);
    $this->load->view('templates/logout');
  }

  public function addSiswaToClass()
  {
    $kelas = $this->db->get_where('tb_mkelas', ['kd_kelas' => $this->input->get('id')])->row_array();
    //so each nis[] is selected to added to the class, create update where the id of student and add the id_mkelas
    foreach ($this->input->post('nis') as $nis) {
      $this->db->where('nis', $nis);
      $this->db->update('tb_siswa', ['id_mkelas' => $kelas['id_mkelas']]);
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Siswa berhasil ditambahkan</div>');
    redirect('learning/listSiswa?id=' . $this->input->get('id'));
  }

  public function delList()
  {
    $id = $this->input->get('id');
    //update id_mkelas to 0
    $this->db->where('nis', $id);
    $this->db->update('tb_siswa', ['id_mkelas' => 0]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Siswa berhasil dihapus</div>');
    redirect('learning/listSiswa?id=' . $this->input->get('class'));
  }
  public function t_exc()
  {
    $d['title'] = 'Tambah Siswa';
    $d['account'] = $this->Admin_model->getAdmin($this->session->userdata['username']);
    $d['siswa'] = $this->db->get('tb_siswa')->result_array();

    $this->load->view('templates/table_header', $d);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('learning/students/t_exc', $d);
    $this->load->view('templates/logout');
  }


  public function addEx()
  {
    $upload_file = $_FILES['file_excel']['name'];
    $extension = pathinfo($upload_file, PATHINFO_EXTENSION);

    if ($extension == 'csv') {
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } elseif ($extension == 'xls') {
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } else {
      $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
    $sheetdata = $spreadsheet->getActiveSheet()->toArray();
    $sheetcount = count($sheetdata);

    if ($sheetcount > 1) {
      $data = array();

      for ($i = 1; $i < $sheetcount; $i++) {
        $nis = $sheetdata[$i][1];
        $nama = $sheetdata[$i][2];
        $tmpt = $sheetdata[$i][3];
        $tgl = $sheetdata[$i][4];
        $jk = $sheetdata[$i][5];
        $alamat = $sheetdata[$i][6];

        if ($jk == 'L') {
          $image = 'male.png';
        } else if ($jk == 'P') {
          $image = 'female.png';
        }

        // Cek apakah baris memiliki data yang valid sebelum menambahkannya
        if (!empty($nis) && !empty($nama) && !empty($tmpt) && !empty($tgl) && !empty($jk) && !empty($alamat)) {
          $data[] = array(
            'foto' => $image,
            'nis' => $nis,
            'nama_siswa' => $nama,
            'tempat_lahir' => $tmpt,
            'tgl_lahir' => $tgl,
            'jk' => $jk,
            'alamat' => $alamat,
          );
        }
      }

      if (!empty($data)) { // Hanya jika ada data yang valid
        $inserdata = $this->Admin_model->insert_batch($data);
        if ($inserdata) {
          $this->session->set_flashdata('message', '<div class="alert alert-success">Successfully Added.</div>');
          redirect('learning/students');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Not uploaded. Please Try Again.</div>');
          redirect('learning/students');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">No valid data found in the Excel file.</div>');
        redirect('learning/students');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">No data found in the Excel file.</div>');
      redirect('learning/students');
    }
  }


  public function down()
  {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Template.xlsx"');
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', '#');
    $sheet->setCellValue('B1', 'NIS');
    $sheet->setCellValue('C1', 'Nama Siswa');
    $sheet->setCellValue('D1', 'Tempat Lahir');
    $sheet->setCellValue('E1', 'Tanggal Lahir');
    $sheet->setCellValue('F1', 'Jenis Kelamin');
    $sheet->setCellValue('G1', 'Alamat');
    $sheet->setCellValue('J1', 'Catatan');
    $sheet->setCellValue('J2', 'Untuk mengisi Jenis Kelamin gunakan "P" dan "L"');
    $sheet->setCellValue('J3', 'Untuk mengisi Tanggal Lahir gunakan format "TAHUN-BULAN-TANGGAL"');

    // Define the date format
    $dateFormat = 'yyyy-mm-dd';

    // Set the date format for cells in column E (from E2 to the bottom)
    $lastRow = $sheet->getHighestRow();
    $dateColumnRange = 'E2:E' . $lastRow;
    $sheet->getStyle($dateColumnRange)->getNumberFormat()->setFormatCode($dateFormat);

    $writer = new Xlsx($spreadsheet);
    $writer->save("php://output");
  }

}