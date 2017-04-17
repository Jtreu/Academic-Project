<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
  require_once('../php/mysqli_connect.php');
  include '../navigation.php';

echo $studentFirstName = $_POST['sfn'];
echo $studentLastName = $_POST['sln'];
echo $teacherID = $_POST['tid'];
echo $teacherFirstName = $_POST['tfn'];
echo $teacherLastName = $_POST['tln'];
echo $goalReadingLevel = $_POST['grl'];
echo $startingReadingLevel = $_POST['srl'];

  $sql = "INSERT INTO students(first_name, last_name, starting_reading_lvl, current_reading_lvl, goal_reading_lvl, teacher_id)
   VALUES ('$studentFirstName', '$studentLastName', $startingReadingLevel, $startingReadingLevel, $goalReadingLevel, $teacherID)";
$dbconn->query($sql);


	$sql = mysqli_query($dbconn, "SELECT students.id AS sid FROM students WHERE students.first_name = '$studentFirstName' AND students.last_name = '$studentLastName'");
  while ($row = $sql->fetch_assoc()){
    $studentID = $row['sid'];
   }

$sql = "INSERT INTO students_under_teacher(t_id, s_id) VALUES($teacherID, $studentID)";
$dbconn->query($sql);
echo "<h4>'$studentFirstName $studentLastName' has been added to student table</h4>";
?>
</html>
