<html>
<head>
  <script>
  function newStudent() { //Hides student selections, shows text boxes for new student
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
$teacherID = $_POST['teacherselect']; //stores teacherID from index.php teacher select form
//connecting to database
$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());
  //query to find teacher first and last name
  $sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS tfn, last_name AS tln FROM teachers WHERE teachers.id = $teacherID");
while ($row = $sql->fetch_assoc()){
  $teacherFirstName = $row['tfn']; //store teacher names in variables
  $teacherLastName = $row['tln'];
}

//display teacher name in header
echo "<h1>$teacherFirstName $teacherLastName</h1>";
//header home button
echo "<button id=\"back\" onclick=\"location.href = 'index.php';\" style='display: inline'>Database Home</button>";
echo "</div>";
?>
<!--Dropdown menu for selecting students to edit-->
<div id="selectstudent">
<h3>Select Student</h3>
<form action="student_details.php" method="post" style = "display: inline">
<select name="studentselect">
<?php
//connecting to database
$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
    or die('Could not connect: '.mysqli_connect_error());
//query to populate student dropdown menu
$query = "SELECT DISTINCT students.first_name AS sfn, students.last_name AS sln, students.id AS sid FROM students, teachers WHERE $teacherID = students.teacher_id";
$result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
  while ($row = $result->fetch_assoc()){
    //storing student first name, last name, and studentID
    $studentFirstName = $row['sfn'];
    $studentLastName = $row['sln'];
    $studentID = $row['sid'];
    //Dropdown menu is populated with student first and last names, option values assigned studentID
    echo "<option value='$studentID'>$studentFirstName $studentLastName</option>";
  }
  mysqli_free_result($result);
  mysqli_close($dbconn);
  ?>
</select>
<input type="submit" name = "ssubmit" id = "bigbutton"></input><!--form sends $studentID to student_details.php-->
</form>

<p style = "display: inline">OR</p>
<button onclick = "newStudent()" id = "studentselectbutton">Add New Student</button>
</div>
<div id = "addnewstudent" style = "display: none"> <!-- New student submission form -->
  <h3>Add New Student Under <?php echo "$teacherFirstName $teacherLastName";?></h3>
<form method="post" action ="student_submit.php"style = "display: block">
<input type="text" name ="sfn"placeholder = "first name" size = "10"></input><!--first name-->
<input type="text" name ="sln"placeholder = "last name" size = "10"></input><!--last name-->
<input type = "text" name = "srl" placeholder = "level" size = "3"></input><!---reading level-->
<input type = "text" name = "grl" placeholder = "goal" size = "3"></input><!--goal level-->
<input type = "hidden" name = "tid" value = "<?php echo $teacherID;?>"> <!--hidden values: teacherID, teacher first and last name-->
<input type = "hidden" name = "tfn" value = "<?php echo $teacherFirstName;?>">
<input type = "hidden" name = "tln" value = "<?php echo $teacherLastName;?>">
<input type="submit" name = "nssubmit"></input>
</form>
</div>
</body>
</html>