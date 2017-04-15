<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
echo $studentID=14;
echo $studentFirstName = $_POST['sfn'];
echo $studentLastName = $_POST['sln'];
echo $teacherID = $_POST['tid'];

$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());
  $sql = "INSERT INTO students(id, teacher_id, first_name, last_name) VALUES ('$studentID', '$teacherID', '$studentFirstName', '$studentLastName')";
$dbconn->query($sql);
echo "<h4>'$studentFirstName $studentLastName' has been added to student table</h4>";
?>
</html>
