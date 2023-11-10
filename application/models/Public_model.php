<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Public_model extends CI_Model
{
  public function getAccount($username)
  {
    $account = $this->db->get_where('users', ['username' => $username])->row_array();
    $e_id = $account['employee_id'];
    $query = "SELECT  employee.id AS `id`,
                      employee.name AS `name`,
                      employee.gender AS `gender`,   
                      employee.shift_id AS `shift`,
                      employee.image AS `image`,
                      employee.birth_date AS `birth_date`,
                      employee.hire_date AS `hire_date`,
                      department.id AS `department_id`
                FROM  employee
          INNER JOIN  employee_department ON employee.id = employee_department.employee_id
          INNER JOIN  department ON employee_department.department_id = department.id
               WHERE `employee`.`id` = '$e_id'";
    return $this->db->query($query)->row_array();
  }

  public function get_attendance($start, $end, $dept)
  {
    $query = "SELECT  attendance.in_time AS date,
                      attendance.shift_id AS shift,
                      employee.name AS name,
                      attendance.notes AS notes,
                      attendance.image AS image,
                      attendance.lack_of AS lack_of,
                      attendance.in_status AS in_status,
                      attendance.out_time AS out_time,
                      attendance.out_status AS out_status,
                      attendance.employee_id AS e_id,
                      shift.start,
                      shift.end
                FROM  attendance
          INNER JOIN  employee_department
                  ON  attendance.employee_id = employee_department.employee_id
          INNER JOIN  employee
                  ON  attendance.employee_id = employee.id
          INNER JOIN  shift
                  ON  employee.shift_id = shift.id
                WHERE  employee_department.department_id = '$dept'
                  AND  (DATE(FROM_UNIXTIME(in_time)) BETWEEN '$start' AND '$end')
            ORDER BY  `date` ASC";

    return $this->db->query($query)->result_array();
  }

  public function get_emp_attendance($e_id, $start, $end)
  {
    $query = "SELECT  attendance.in_time AS date,
                      attendance.shift_id AS shift,
                      employee.name AS name,
                      attendance.notes AS notes,
                      attendance.image AS image,
                      attendance.lack_of AS lack_of,
                      attendance.in_status AS in_status,
                      attendance.out_time AS out_time,
                      attendance.out_status AS out_status,
                      attendance.employee_id AS e_id,
                      attendance.latitude as latitude,
                      attendance.longtitude as longtitude,
                      attendance.location_id as location,
                      location.name as location_name,
                      shift.start,
                      shift.end
                FROM  attendance
          INNER JOIN  employee_department
                  ON  attendance.employee_id = employee_department.employee_id
          INNER JOIN  employee
                  ON  attendance.employee_id = employee.id
          INNER JOIN  shift
                  ON  employee.shift_id = shift.id
          INNER JOIN  location
                  ON  attendance.location_id = location.id
                WHERE  employee.id = '$e_id'
                  AND  (DATE(FROM_UNIXTIME(in_time)) BETWEEN '$start' AND '$end')
            ORDER BY  `date` ASC";

    return $this->db->query($query)->result_array();
  }


  public function inputAllGuruToAttendance()
  {
    // Create query to add all guru data to the attendance table every day based on created_date,
    // and check if data exist or not. If data exists, it will pass or update it. If data does not exist, it will add it.
    // created_date is used to check if data exist or not, using today's date.

    // Get the current date as a formatted string
    $currentDate = date('Y-m-d');

    // Use single quotes around $currentDate in the SQL query
    $query = "INSERT INTO attendance (employee_id, shift_id, created_date)
              SELECT employee.id, employee.shift_id, '$currentDate'
              FROM employee
              WHERE employee.id NOT IN (SELECT employee_id FROM attendance WHERE created_date = '$currentDate')";

    $this->db->query($query);
  }

  public function getAllEmployeeData($username)
  {
    // get employee id from users table
    $data = $this->db->get_where('users', ['username' => $username])->row_array();
    $e_id = $data['employee_id'];

    // Join Query
    $query = "SELECT  employee.id AS `id`,
                      employee.name AS `name`,
                      employee.gender AS `gender`,
                      employee.image AS `image`,
                      employee.birth_date AS `birth_date`,
                      employee.hire_date AS `hire_date`,
                      department.name AS `department`
                FROM  employee
          INNER JOIN  employee_department ON employee.id = employee_department.employee_id
          INNER JOIN  department ON employee_department.department_id = department.id
               WHERE `employee`.`id` = $e_id";

    return $this->db->query($query)->row_array();
  }


  public function checkMengajar($id_login, $id_mkelas)
  {

    // Query to check if the employee teaches the specified class
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_mengajar WHERE id_employee = '$id_login' AND id_mkelas = '$id_mkelas'");
    $result = $query->row();

    return ($result->count > 0);
  }


  public function getMengajarData($id_employee)
  {
    // Get employee data based on id_employee
    $sql = $this->db->query("SELECT * FROM employee WHERE id = '$id_employee'");
    $data = $sql->row_array();

    $mengajar = $this->db->query("
        SELECT * FROM tb_mengajar
        INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
        INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
        INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
        WHERE tb_mengajar.id_employee = '$id_employee'
    ");

    return $mengajar->result_array();
  }

  public function checkAttendanceForDate($id_mkelas, $date)
  {
    $sql = $this->db->query("SELECT * FROM _logabsensi WHERE id_mkelas = '$id_mkelas' AND tgl_absen = '$date'");

    $countStudents = $this->db->query("SELECT * FROM tb_siswa WHERE id_mkelas = '$id_mkelas'")->num_rows();

    return $sql->num_rows() == $countStudents;
  }


  public function createAttendanceForDate($id_employee, $id_mkelas, $date)
  {
    $id_mengajar = $this->db->query("SELECT id_mengajar FROM tb_mengajar WHERE id_employee = '$id_employee' AND id_mkelas = '$id_mkelas'")->row_array()['id_mengajar'];

    // Query to fetch all students in the class
    $students = $this->db->query("SELECT id_siswa FROM tb_siswa WHERE id_mkelas = '$id_mkelas'")->result_array();

    foreach ($students as $student) {
      $existingRecord = $this->db->query("SELECT * FROM _logabsensi WHERE id_siswa = '{$student['id_siswa']}' AND tgl_absen = '$date'")->row_array();

      if ($existingRecord) {
        // Existing record for the student and date, update id_mengajar
        $this->db->query("UPDATE _logabsensi SET id_mengajar = '$id_mengajar' WHERE id_presensi = '{$existingRecord['id_presensi']}'");
      } else {
        // No existing record for the student and date, create new record with pertemuan_ke
        $this->db->query("INSERT INTO _logabsensi (id_mengajar, id_siswa, id_mkelas, tgl_absen, pertemuan_ke) VALUES ('$id_mengajar', '{$student['id_siswa']}', '$id_mkelas', '$date', 1)");
      }
    }

    // Increment pertemuan_ke for existing records on the same day
    $this->db->query("UPDATE _logabsensi SET pertemuan_ke = pertemuan_ke + 1 WHERE id_mengajar = '$id_mengajar' AND tgl_absen = '$date'");

    redirect(base_url('Attendance/form') . '?id_mkelas=' . $id_mkelas);
  }



  public function getFormAbsensiSiswaData($id_mkelas)
  {
    $id_login = $this->session->userdata('id');
    $sql = $this->db->query("SELECT * FROM employee WHERE id = '$id_login'");
    $data = $sql->row_array();

    $currentDate = date('Y-m-d');

    $siswa = $this->db->query("
        SELECT *
        FROM tb_siswa
        INNER JOIN tb_mkelas ON tb_siswa.id_mkelas=tb_mkelas.id_mkelas
        LEFT JOIN _logabsensi ON tb_siswa.id_siswa=_logabsensi.id_siswa AND _logabsensi.tgl_absen = '$currentDate'
        WHERE tb_siswa.id_mkelas = '$id_mkelas' AND _logabsensi.id_mkelas = '$id_mkelas'");

    return $siswa->result_array();
  }

  public function getLogAbsensiData($id_employee)
  {
    $sql = $this->db->query("SELECT * FROM employee WHERE id = '$id_employee'");
    $data = $sql->row_array();

    $logAbsensi = $this->db->query("
        SELECT *
        FROM _logabsensi
        INNER JOIN tb_siswa ON _logabsensi.id_siswa=tb_siswa.id_siswa
        INNER JOIN tb_mkelas ON _logabsensi.id_mkelas=tb_mkelas.id_mkelas
        INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
        INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
        INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
        INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
        WHERE tb_mengajar.id_employee = '$id_employee'");

    return $logAbsensi->result_array();
  }

  public function get_absence_history($id_employee, $id_mkelas, $id_mapel, $start, $end)
  {
    $query = "SELECT * FROM _logabsensi
              INNER JOIN tb_siswa ON _logabsensi.id_siswa=tb_siswa.id_siswa
              INNER JOIN tb_mkelas ON _logabsensi.id_mkelas=tb_mkelas.id_mkelas
              INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
              INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
              INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
              WHERE tb_mengajar.id_employee = '$id_employee' AND tb_mengajar.id_mapel = $id_mapel AND _logabsensi.id_mkelas = '$id_mkelas' AND (DATE(tgl_absen) BETWEEN '$start' AND '$end' AND ket_absen != '')";

    return $this->db->query($query)->result_array();
  }

  public function check_parameter_absence($id_employee, $id_mkelas, $id_mapel)
  {
    //check if id_employee is exist
    $query = $this->db->query("SELECT COUNT(*) AS count FROM tb_mengajar WHERE id_employee = '$id_employee' AND id_mkelas = '$id_mkelas' AND id_mapel = '$id_mapel'");
    $result = $query->row();

    return ($result->count > 0);
  }

  public function getAllMengajarData()
  {
    $query = "SELECT * FROM tb_mengajar
              INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
              INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
              INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
              INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran";

    return $this->db->query($query)->result_array();
  }

  public function getMengajarId($id_kelas, $id_employee)
  {
    $query = "SELECT id_mengajar FROM tb_mengajar WHERE id_mkelas = '$id_kelas' AND id_employee = '$id_employee'";

    return $this->db->query($query)->row_array()['id_mengajar'];
  }
  public function get_student_report($start, $end, $mapel, $kelas)
  {

    $query = "SELECT  *
    FROM _logabsensi 
    INNER JOIN tb_siswa ON _logabsensi.id_siswa=tb_siswa.id_siswa
    INNER JOIN tb_mkelas ON _logabsensi.id_mkelas=tb_mkelas.id_mkelas
    INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
    INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
    INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
    WHERE tb_mengajar.id_mapel = '$mapel' AND tb_mengajar.id_mkelas = '$kelas' AND (DATE(tgl_absen) BETWEEN '$start' AND '$end' AND ket_absen != '')";

    return $this->db->query($query)->result_array();
  }

  public function getMengajarById($id_mengajar)
  {
    $mengajar = $this->db->query("
        SELECT * FROM tb_mengajar
        INNER JOIN employee ON tb_mengajar.id_employee=employee.id
        INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
        INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
        INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
        WHERE tb_mengajar.id_mengajar = '$id_mengajar'
    ");

    return $mengajar->row_array();
  }


}