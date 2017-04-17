<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
  require_once('../php/mysqli_connect.php');
  include '../navigation.php';

 $teacherFirstName = $_POST['tfn'];
 $teacherLastName = $_POST['tln'];

$sql = "INSERT INTO teachers(first_name, last_name) VALUES ('$teacherFirstName', '$teacherLastName')";
$dbconn->query($sql);

echo "<h4>'$teacherFirstName $teacherLastName' has been added to teacher table</h4>";
?>
</html>
