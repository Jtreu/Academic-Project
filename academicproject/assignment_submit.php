<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
$assignmentName = $_POST['asn'];
$assignmentGrade = $_POST['asg'];
$studentID = $_POST['sid'];

$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());
  $sql = "INSERT INTO assessments(s_id, assessment_name, assessment_grade) VALUES ($studentID, '$assignmentName', $assignmentGrade)";
$dbconn->query($sql);
echo "<h4>assignment $assignmentName has been added to assignments table</h4>";
?>
</html>
