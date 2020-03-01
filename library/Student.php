<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/database.php');
?>

<?php
class Student{
    private $db;
    function __construct(){
      $this->db = new Database();
    }
    public function getStudents(){
      $query = "SELECT * FROM tbl_student";
      $result = $this->db->select($query);
      return $result;
    }

    public function insertStudent($name, $roll){
      $name = mysqli_real_escape_string($this->db->link, $name);
      $roll = mysqli_real_escape_string($this->db->link, $roll);
      if (empty($name) || empty($roll)) {
        $msg = "<div class='alert alert-danger'><strong> ERROR! Field must not be empty!</div>";
        return $msg;
      }else{
        $stu_query = "INSERT INTO tbl_student(name, roll) VALUES('$name', '$roll')";
        $stu_insert = $this->db->insert($stu_query);

        $att_query = "INSERT INTO tbl_attendance(roll) VALUES('$roll')";
        $att_insert = $this->db->insert($att_query);

        if($stu_insert) {
          $msg = "<div class='alert alert-success'><strong> Data inserted successfully! </div>";
          return $msg;
        }else {
          $msg = "<div class='alert alert-danger'><strong> Failed to insert data! </div>";
          return $msg;
        }
      }
    }

public function insertAttendance($cur_date, $attend = array()) {
  $query = "SELECT DISTINCT att_time FROM tbl_attendance";
  $getdata = $this->db->select($query);
  while ($result = $getdata->fetch_assoc()) {
    $db_date = $result['att_time'];
    if ($cur_date == $db_date) {
      $msg = "<div class='alert alert-danger'><strong> Attendance already taken! </div>";
      return $msg;
    }
  }
  foreach ($attend as $atn_key => $atn_value) {
    if ($atn_value == 'present') {
      $stu_query = "INSERT INTO tbl_attendance(roll, attend, att_time) VALUES ('$atn_key','present',now())";
      $data_insert = $this->db->insert($stu_query);
    }elseif($atn_value = "absent") {
      $stu_query = "INSERT INTO tbl_attendance(roll, attend, att_time) VALUES ('$atn_key','absent',now())";
      $data_insert = $this->db->insert($stu_query);
    }
  }

  if($data_insert) {
    $msg = "<div class='alert alert-success'><strong> Attendance taken successfully! </div>";
    return $msg;
  }else {
    $msg = "<div class='alert alert-danger'><strong> Attendance is already taken today! </div>";
    return $msg;
  }
}
public function getDateList(){
  $query = "SELECT DISTINCT att_time FROM tbl_attendance";
  $result = $this->db->select($query);
  return $result;
}

public function getAllData($dt){
  $query = "SELECT tbl_student.name, tbl_attendance.*
  FROM tbl_student
  INNER JOIN tbl_attendance
  ON tbl_student.roll = tbl_attendance.roll
  WHERE att_time = '$dt'";
  $result = $this->db->select($query);
  return $result;
}



}



?>
