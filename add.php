<?php
  include 'inc/header.php';
  include 'library/Student.php';
?>

<?php
  $stu = new Student();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $insertdata = $stu->insertStudent($name, $roll);
  }
?>

<?php
  if (isset($insertdata)) {
    echo $insertdata;
  }
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h2>
      <a class="btn btn-success" href="add.php">Add Student/Employee</a>
      <a class="btn btn-info pull-right" href="index.php">Back</a>
    </h2>
  </div>
  <div class="panel-body">
    <form class="" method="post">
      <div class="form-group">
        <label for="name">Student/Employee Name</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      <div class="form-group">
        <label for="roll">ID</label>
        <input type="text" class="form-control" name="roll" id="roll">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" value="Add Student/Employee">
      </div>
    </form>
  </div>
</div>
<?php include 'inc/footer.php'; ?>
