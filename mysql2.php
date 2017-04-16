<html>
<head>
  <script>
  function newStudent() {
  document.getElementById("selectstudent").style.display = "none";
  document.getElementById("addnewstudent").style.display = "block";
  }
  </script>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
  <?php include("navigation.php"); ?>
  <div id = "bodyheader">
  <!--Select statement from database includes all columns for specified username -->
  <?php
$selectedTeacher = $_POST['teacherselect'];
$selectedTeacher= preg_split("/[\s,]+/", $selectedTeacher);
echo "<h1>$selectedTeacher[0] $selectedTeacher[1]</h1>";
echo "<button id=\"back\" onclick=\"location.href = 'academicproject.php';\" style='display: inline'>Database Home</button>";
echo "</div>";
?>

<div id="selectstudent">
<h3>Select Existing Student</h3>
<form action="mysql.php" method="post" style = "display: inline">
<select name="studentselect">
<?php

/* dbconn is referenced from this file */
require_once('php/mysqli_connect.php');

$query = "SELECT students.first_name AS sfn, teachers.id AS tid, students.last_name AS sln FROM students, teachers WHERE teachers.id = students.teacher_id";

$result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
  // Printing results in HTML
  while ($row = $result->fetch_assoc()){
    echo "<option value=\"" . $row['sfn']. " " . $row['sln']."\">" . $row['sfn'] . " " . $row['sln'] . "</option>";
    $teacherID = $row['tid'];
  }
  // Free resultset
  mysqli_free_result($result);

  // Closing connection
  mysqli_close($dbconn);
  ?>
</select>
<input type="submit" name = "ssubmit" id = "bigbutton"></input>
</form>
<p style = "display: inline">OR</p>
<button onclick = "newStudent()" id = "studentselectbutton">Add New Student</button>
</div>

<div id = "addnewstudent" style = "display: none">
  <h3>Add New Student Under <?php echo "$selectedTeacher[0] $selectedTeacher[1]";?></h3>
<form method="post" action ="student.php"style = "display: block">
  <input type = "hidden" name = "tid" value = "<?php echo $teacherID;?>">
<input type="text" name ="sfn"placeholder = "first name" size = "12"></input>
<input type="text" name ="sln"placeholder = "last name" size = "12"></input>
<input type="submit" name = "nssubmit"></input><!--replace with submit button, post method-->
</form>
</div>
</body>
</html>
