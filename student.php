<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
  <?php include("navigation.php"); ?>
</body>
<?php
echo $studentID=14;
echo $studentFirstName = $_POST['sfn'];
echo $studentLastName = $_POST['sln'];
echo $teacherID = $_POST['tid'];

/* dbconn is referenced from this file */
require_once('php/mysqli_connect.php');

  $sql = "INSERT INTO students(id, teacher_id, first_name, last_name) VALUES ('$studentID', '$teacherID', '$studentFirstName', '$studentLastName')";
$dbconn->query($sql);
echo "<h4>'$studentFirstName $studentLastName' has been added to student table</h4>";
?>
</html>
