<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
  <?php include '../navigation.php'; ?>
  <div id = "bodyheader">
  <?php
    require_once('../php/mysqli_connect.php');

    $studentID = $_POST['studentselect']; //stores studentID from select_and_add_students.php student select form

      //query to find student first and last name
    $sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS sfn, last_name AS sln FROM students WHERE students.id = $studentID");
    while ($row = $sql->fetch_assoc()){
      $studentFirstName = $row['sfn']; //store student names in variables
      $studentLastName = $row['sln'];
    }
    echo "<h1>$studentFirstName $studentLastName</h1>"; //display student name in header
    //header home button
    echo "<button id=\"back\" onclick=\"location.href = 'index.php';\" style='display: inline'>Database Home</button>";
    echo "</div>";
    $server = "localhost";
    $db = "academicdb";
    $user = "root";
    $password = "";
    $dbconn = mysqli_connect($server, $user, $password, $db)
      or die('Could not connect: '.mysqli_connect_error());
      //query to find all current student info
    $query = "SELECT teachers.first_name AS tfn, teachers.last_name AS tln, students.id AS sid, students.first_name AS sfn, students.last_name AS sln, students.starting_reading_lvl AS srl, students.current_reading_lvl AS crl, students.goal_reading_lvl AS grl, books.name AS bkn, books.reading_lvl AS bkrl, books_read.b_id AS bid FROM teachers, students, books, books_read WHERE students.first_name = '$studentFirstName' AND students.last_name = '$studentLastName' AND teachers.id = students.teacher_id AND books_read.s_id = students.id AND books.id = books_read.b_id";
    //Does not work for students with no books, needs fix
///////////////////////////////////////////////////////////
    //Query without books
    /*$query = "SELECT teachers.first_name AS tfn, teachers.last_name AS tln, students.id AS sid, students.first_name AS sfn, students.last_name AS sln, students.starting_reading_lvl AS srl, students.current_reading_lvl AS crl, students.goal_reading_lvl AS grl FROM teachers, students WHERE students.first_name = '$studentFirstName' AND students.last_name = '$studentLastName' AND teachers.id = students.teacher_id";
    */

    $result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
    $column = array();
    while ($row = mysqli_fetch_assoc($result)) {
    //stores all data in variables
      $studentFirstName = $row['sfn'];
      $studentLastName = $row['sln'];
      $teacherFirstName = $row['tfn'];
      $teacherLastName = $row['tln'];
      $studentID = $row['sid'];
      $currentReadingLevel = $row['crl'];
      $goalReadingLevel = $row['grl'];
      $startingReadingLevel = $row['srl'];
      $bookName[] = $row['bkn'];
      $bookReadingLevel[] = $row['bkrl'];
      $bookID = $row['bid'];
    }

//creates table of student info
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
  mysqli_free_result($result);
  mysqli_close($dbconn);
  ?>

  <p>Add book</p> <!--add book to student read list-->
  <form action="read_book_submit.php" method="post" style = "display: inline"><!--submit form to read_book_submit.php-->
    <input type = "hidden" name = "sid" value = "<?php echo $studentID;?>"> <!--send studentID to read_book_submit-->
      <select name="bookselect" style = "width: 60%;">
      <?php
      //connect to database
        $server = "localhost";
        $db = "academicdb";
        $user = "root";
        $password = "";
        $dbconn = mysqli_connect($server, $user, $password, $db)
          or die('Could not connect: '.mysqli_connect_error());
          //query to find all books
        $sql = mysqli_query($dbconn, "SELECT books.name AS bkn, books.id AS bid FROM books");
        while ($row = $sql->fetch_assoc()){
          $bookID = $row['bid'];//storing bookID and book name
          $bookName = $row['bkn'];
          //populating dropdown menu with book titles, option value assigned bookID variable
          echo "<option value='$bookID'>$bookName</option>";
        }
      ?>
    </select>
  <input type="submit"name = "tsubmit"><!--form is sent to read_books.php-->
</form>
</div>
<div id = "rightdiv" style = "float: left; width: 400px; height: 100%;"><!--new assignment submission form-->
  <form method="post" action = "assignment_submit.php"style = "display: inline"><!--form sent to assignment_submit.php-->
    <input name = "asn" type="text" placeholder = "assessment name" id="assessment_name" size = "30"></input><!--assignment name-->
    <input name = "asg" type="text" placeholder = "grade" id="assessment_grade" size = "5"></input><!--grade-->
    <input type = "hidden" name = "sid" value = "<?php echo $studentID;?>"><!--hidden values also sent-->
    <input type="Submit"></input><!--form sent to read_books.php-->
  </form>
  <?php
  //query for populating assignmen table with entries
    $query = "SELECT assessments.assessment_name AS an, assessments.assessment_grade AS ag FROM assessments WHERE assessments.s_id = '$studentID'";
    $result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
    // Printing results in HTML
    echo "<table><tr><th colspan = '2'>Assignments</td></tr><tr><td>Assessment Name</th><td>Grade</td></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>";
      echo $assessmentName = $row['an']; //each row is an assignment and its grade
      echo "</td><td>";
      echo $assessmentGrade = $row['ag'];
      echo "</td></tr>";
    }
    echo "</table>";
  ?>
  </div>
</body>
</html>
