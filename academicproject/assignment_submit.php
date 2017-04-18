<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
$assignmentName = $_POST['asn'];
$assignmentGrade = $_POST['asg'];
$studentID = $_POST['sid'];

require_once('../php/mysqli_connect.php');

  $sql = "INSERT INTO assessments(s_id, assessment_name, assessment_grade) VALUES ($studentID, '$assignmentName', $assignmentGrade)";
$dbconn->query($sql);
echo "<h4>assignment $assignmentName has been added to assignments table</h4>";
?>
</html>
