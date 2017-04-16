<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
 $teacherFirstName = $_POST['tfn'];
 $teacherLastName = $_POST['tln'];

$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());

$sql = "INSERT INTO teachers(first_name, last_name) VALUES ('$teacherFirstName', '$teacherLastName')";
$dbconn->query($sql);

echo "<h4>'$teacherFirstName $teacherLastName' has been added to teacher table</h4>";
?>
</html>
