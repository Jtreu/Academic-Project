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
  <div id = "bodyheader">
  <!--Select statement from database includes all columns for specified username -->
  <?php
$teacherID = $_POST['teacherselect'];

$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());
  $sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS tfn, last_name AS tln FROM teachers WHERE teachers.id = $teacherID");
while ($row = $sql->fetch_assoc()){
  $teacherFirstName = $row['tfn'];
  $teacherLastName = $row['tln'];
}


echo "<h1>$teacherFirstName $teacherLastName</h1>";
echo "<button id=\"back\" onclick=\"location.href = 'academicproject.php';\" style='display: inline'>Database Home</button>";
echo "</div>";
?>

<div id="selectstudent">
<h3>Select Existing Student</h3>
<form action="mysql.php" method="post" style = "display: inline">
<select name="studentselect">
<?php
// Connecting, selecting database
$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
    or die('Could not connect: '.mysqli_connect_error());

$query = "SELECT students.first_name AS sfn, students.id AS sid, teachers.id AS tid, students.last_name AS sln FROM students, teachers WHERE teachers.id = students.teacher_id";
$result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
  // Printing results in HTML
  while ($row = $result->fetch_assoc()){
    $studentFirstName = $row['sfn'];
    $studentLastName = $row['sln'];
    $studentID = $row['sid'];
    echo "<option value='$studentID'>$studentFirstName $studentLastName</option>";
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
  <h3>Add New Student Under <?php echo "$teacherFirstName $teacherLastName";?></h3>
<form method="post" action ="student.php"style = "display: block">
<input type = "hidden" name = "tid" value = "<?php echo $teacherID;?>">
<input type = "hidden" name = "tfn" value = "<?php echo $teacherFirstName;?>">
<input type = "hidden" name = "tln" value = "<?php echo $teacherLastName;?>">
<input type = "hidden" name = "sid" value = "<?php echo $studentID;?>">
<input type = "text" name = "grl" placeholder = "goal" size = "4"></input>
<input type="text" name ="sfn"placeholder = "first name" size = "12"></input>
<input type="text" name ="sln"placeholder = "last name" size = "12"></input>
<input type="submit" name = "nssubmit"></input>
</form>
</div>
</body>
</html>
