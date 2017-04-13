<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

</head>
<body>
  <!--Select statement from database includes all columns for specified username -->
  <?php
$selectedStudent = $_POST['studentselect'];
$selectedStudent = preg_split("/[\s,]+/", $selectedStudent);
echo "<h1>$selectedStudent[0] $selectedStudent[1]</h1>";
echo "<button id=\"back\" onclick=\"location.href = 'academicproject.php';\" style='display: block'>Select Different Student</button>";
// Connecting, selecting database
$server = "localhost";
$db = "sakila";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
    or die('Could not connect: '.mysqli_connect_error());


// Performing SQL query
$query = "SELECT * FROM actor WHERE first_name = '$selectedStudent[0]' AND last_name = '$selectedStudent[1]'";
$result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());

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
<!--Need to add database insert functionality here-->
	<div id="addScore" style="display: block">
    <form method="post" style = "display: inline">
		<input type="text" id="scoreInput"></input>
		<button onclick="addScore()">Add score</button>
	</div>

</body>
</html>
