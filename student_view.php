<?php
  include 'inc/header.php';
  include 'library/Student.php';
?>

<?php
//error_reporting(0);
  $stu = new Student();
  $dt = $_GET['dt'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$attend = $_POST['attend'];
    //$updateattend = $stu->insertAttendance($cur_date, $attend);
  }
?>
<?php
  if (isset($updateattend)) {
    echo $updateattend;
  }
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2>
      <a class="btn btn-success" href="add.php">Add Student/Employee</a>
      <a class="btn btn-info pull-right" href="date_view.php">Back</a>
    </h2>
  </div>
  <div class="panel-body">
    <form class="" method="post">
      <table class="table table-striped">
        <tr>
          <th width="25%">Serial</th>
          <th width="25%">Student/Employee Name</th>
          <th width="25%">Student ID</th>
          <th width="25%">Attendance</th>
        </tr>
      <?php
        $get_student = $stu->getAllData($dt);
        if ($get_student){
          $i = 0;
          while ($value = $get_student->fetch_assoc()) {
            $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $value['name'] ?></td>
        <td><?php echo $value['roll'] ?></td>
        <td>
          <input type="radio" name="attend[<td><?php echo $value['roll'] ?></td>]" value="present" <?php if($value['attend'] == "present") {echo "checked";} ?>>P
          <input type="radio" name="attend[<td><?php echo $value['roll'] ?></td>]" value="absent" <?php if($value['attend'] == "absent") {echo "checked";} ?>>A
        </td>
      </tr>
    <?php } } ?>
      </table>
    </form>
  </div>
</div>
<?php include 'inc/footer.php'; ?>
