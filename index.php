<?php
  include 'inc/header.php';
  include 'library/Student.php';
?>

<script type="text/javascript">
  $(document).ready(function(){
    $("form").submit(function(){
      var roll = true;
      $(':radio').each(function(){
        name = $(this).attr('name');
        if(roll && !$(':radio[name="' + name + '"]:checked').length){
          // alert(name + "Roll Missing!");
          $('.alert').show();
          roll = false;
        }
      });
      return roll;
    })
  })
</script>
<?php
error_reporting(0);
  $stu = new Student();
  $cur_date = date('Y-m-d');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attend = $_POST['attend'];
    $insertattend = $stu->insertAttendance($cur_date, $attend);
  }
?>
<?php
  if (isset($insertattend)) {
    echo $insertattend;
  }
?>
<div class='alert alert-danger' style="display: none"><strong>ERROR!</strong> Student roll missing.</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h2>
      <a class="btn btn-success" href="add.php">Add Student/Employee</a>
      <a class="btn btn-info pull-right" href="date_view.php">View All</a>
    </h2>
  </div>
  <div class="panel-body">
    <div class="well text-center" style="font-size: 20px">
      <strong>Date: <?php $cur_date = date('Y-m-d'); echo $cur_date; ?></strong>
    </div>
    <form class="" method="post">
      <table class="table table-striped">
        <tr>
          <th width="25%">Serial</th>
          <th width="25%">Student/Employee Name</th>
          <th width="25%">Student ID</th>
          <th width="25%">Attendance</th>
        </tr>
      <?php
        $get_student = $stu->getStudents();
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
            <input type="radio" name="attend[<td><?php echo $value['roll'] ?></td>]" value="present">P
            <input type="radio" name="attend[<td><?php echo $value['roll'] ?></td>]" value="absent">A
          </td>
        </tr>

    <?php } } ?>

        <tr>
          <td colspan="4">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include 'inc/footer.php'; ?>
