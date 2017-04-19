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
include '../navigation.php';

$sql = "INSERT INTO assessments(s_id, assessment_name, assessment_grade) VALUES ($studentID, '$assignmentName', $assignmentGrade)";
$dbconn->query($sql);

echo "<div class='checkok'>";
echo "<span>Alright, Assignment '$assignmentName' has been addded to the assignments table with a score of $assignmentGrade!</span>";
echo "<a href='student_details.php'>Return to student details</a>";
echo "</div>";
?>
</html>

<style>
.checkok {
  display: block;
  width: 100%;
}
.checkok a {
  margin-top: 100px;
  display:block;
  border: 3px solid grey;
  background-color: inherit;
  color: black;
  text-decoration: none;
  font-size: 1.25em;
  width: 25%;
  margin-left: 40%;
  border: 3px solid rgb(116, 171, 201);
  color: white;
  text-align: center;
  padding: 5px 5px 5px 5px;
}

.checkok a:hover {
  background-color:#2F333E;
  font-size: 1.50em;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
}

span {
  display:block;
  color: white;
  font-size: 1.75em;
  margin: auto;
  border: 3px solid green;
  padding: 10px;
  background-color: green;
  text-align: center;
}
</style>
