<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
  <div id = "studentbooks">
  <!--Select statement from database includes all columns for specified username -->
  <?php
$selectedStudent = $_POST['studentselect'];
$selectedStudent = preg_split("/[\s,]+/", $selectedStudent);
echo "<h1>$selectedStudent[0] $selectedStudent[1]</h1>";
echo "<button id=\"back\" onclick=\"location.href = 'academicproject.php';\" style='display: inline'>Select Different Student</button>";
echo "</div>";
// Connecting, selecting database
$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
    or die('Could not connect: '.mysqli_connect_error());
// Performing SQL query
$query = "SELECT * FROM students WHERE first_name = '$selectedStudent[0]' AND last_name = '$selectedStudent[1]'";
$result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());
?>

<!--Need to add database insert functionality here-->
	<div id="addBook" style="display: block">
    <form method="post" style = "display: inline">
		<input type="text" placeholder = "book name" id="bookInput" size = "30"></input>
    <input type="text" placeholder = "level" id="reading_lvlInput" size = "5"></input>
		<button onclick="" >Submit</button> <!--replace with submit button, post method-->
	</div>

  <div id="addAssessment" style="display: block">
    <form method="post" style = "display: inline">
		<input type="text" placeholder = "assessment name" id="assessment_name" size = "30"></input>
    <input type="text" placeholder = "grade" id="assessment_grade" size = "5"></input>
		<button onclick="" >Submit</button><!--replace with submit button, post method-->
	</div>
  <?php
  // Printing results in HTML
  echo "<table>\n";

  while ($line = $result->fetch_assoc()) {

      echo "\t<tr>\n";
      foreach ($line as $col_value) {
          echo "\t\t<td>$col_value</td>\n";
      }
      echo "\t</tr>\n";
  }
  echo "</table>\n";

  // Free resultset
  mysqli_free_result($result);

  // Closing connection
  mysqli_close($dbconn);
  ?>
</body>
</html>
