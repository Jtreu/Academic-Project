<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
  <?php include("navigation.php"); ?>
  <div id = "bodyheader">
  <?php
$selectedStudent = $_POST['studentselect'];
$selectedStudent = preg_split("/[\s,]+/", $selectedStudent);
echo "<h1>$selectedStudent[0] $selectedStudent[1]</h1>";
echo "<button id=\"back\" onclick=\"location.href = 'academicproject.php';\" style='display: inline'>Database Home</button>";
echo "</div>";

/* dbconn is referenced from this file */
require_once('php/mysqli_connect.php');

// Performing SQL query
//display Teacher, current reading level, target reading level, starting rl, books read, book reading level
$query = "SELECT teachers.first_name AS tfn, teachers.last_name AS tln, students.id AS sid, students.first_name AS sfn, students.last_name AS sln, students.starting_reading_lvl AS srl, students.current_reading_lvl AS crl,students.goal_reading_lvl AS grl, books.name AS bkn, books.reading_lvl AS bkrl, books_read.b_id AS bid FROM teachers, students, books, books_read WHERE students.first_name = '$selectedStudent[0]' AND students.last_name = '$selectedStudent[1]' AND teachers.id = students.teacher_id AND books_read.s_id = students.id AND books.id = books_read.b_id";

$result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
  // Printing results in HTML
  $column = array();

  while ($row = mysqli_fetch_assoc($result)) {
      $studentFirstName = $row['sfn'];
      $studentLastName = $row['sln'];
      $teacherFirstName = $row['tfn'];
      $studentID = $row['sid'];
      $teacherLastName = $row['tln'];
      $currentReadingLevel = $row['crl'];
      $goalReadingLevel = $row['grl'];
      $startingReadingLevel = $row['srl'];
      $bookName[] = $row['bkn'];
      $bookReadingLevel[] = $row['bkrl'];
      $bookID = $row['bid'];
}


echo "<div style = 'float:left; width: 400px; height: 100%;'><table><th colspan = '2'>Student Info</th><tr><td>Teacher</td><td>$teacherFirstName $teacherLastName</td></tr><tr><td>Starting Reading Level</td><td>$startingReadingLevel</td></tr><tr><td>GoalReading Level</td><td>$goalReadingLevel</td></tr><tr><td>Current Reading Level</td><td>$currentReadingLevel</td></tr></table>";

echo "<table>\n";
echo "<tr><th colspan = '2'>Books Read</th></tr>";
echo "\t<tr>\n";
    echo "\t\t<td>Book Name</td>\n";
    echo "\t\t<td>Reading Level</td>\n";
    echo "\t</tr>\n";
    echo "\t<tr>\n";
    foreach (array_combine($bookName, $bookReadingLevel) as $bookName => $bookReadingLevel) {
       echo "\t\t<td>$bookName</td>\n";
       echo "\t\t<td>$bookReadingLevel</td>\n";
       echo "\t</tr>\n";
      }
echo "</table>\n";
  // Free resultset
  mysqli_free_result($result);
  // Closing connection
  mysqli_close($dbconn);
  ?>
<p>Add book</p>

  <form action="book.php" method="post" style = "display: inline">
  <input type = "hidden" name = "sid" value = "<?php echo $studentID;?>">
    <input type = "hidden" name = "bid" value = "<?php echo $bookID;?>">
    <select name="bookselect">
      <?php
      /* dbconn is referenced from this file */
      require_once('php/mysqli_connect.php');

        $sql = mysqli_query($dbconn, "SELECT books.name AS bkn, students.id AS sid FROM books, students WHERE students.first_name = '$studentFirstName' AND students.last_name = '$studentLastName'");
      while ($row = $sql->fetch_assoc()){
          echo "<option value=\"" . $row['bkn']. " \">" . $row['bkn']. " </option>";
        }
?>
    </select>
  <input type="submit"name = "tsubmit" id = "bigbutton">
</form>
  </div>
  <div id = "rightdiv" style = "float: left; width: 400px; height: 100%;">
    <form method="post" action = "assignments.php"style = "display: inline">
    <input type="text" placeholder = "assessment name" id="assessment_name" size = "30"></input>
    <input type="text" placeholder = "grade" id="assessment_grade" size = "5"></input>
    <input type="Submit"></input>
    </form>
  <?php

  $query = "SELECT assessments.assessment_name AS an, assessments.assessment_grade AS ag FROM assessments WHERE assessments.s_id = '$studentID'";

  $result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
    // Printing results in HTML
    echo "<table><tr><th colspan = '2'>Assignments</td></tr><tr><td>Assessment Name</th><td>Grade</td></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>";
      echo $assessmentName = $row['an'];
      echo "</td><td>";
      echo $assessmentGrade = $row['ag'];
      echo "</td></tr>";
  }
  echo "</table>";
?>

  </div>


</body>
</html>
