<!DOCTYPE html>
<html>
<head>
	<script>
	function newUser() {
	document.getElementById("selectuser").style.display = "none";
	document.getElementById("newteacher").style.display = "block";
	document.getElementById("newteacherbutton").style.display = "none";
	}
	</script>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="academicproject.css" </link>
	<meta charset="utf-8">
	<title>Academic Project</title>
</head>
<body>
	<?php include("navigation.php"); ?>
	<div id="bodyheader">
		<h1>Academic Progress Database</h1>
		<button id="back" onclick="location.href = 'academicproject.php'" style='display: inline;'>Database Home</button>

	</div>

	<div id = "selectuser" style = "display: block;">
		<h3>Select Instructor</h3>
		<form action="mysql2.php" method="post" style = "display: inline">
			<select name="teacherselect">
				<?php
				/* dbconn is referenced from this file */
				require_once('php/mysqli_connect.php');

					$sql = mysqli_query($dbconn, "SELECT first_name, last_name FROM teachers");
				while ($row = $sql->fetch_assoc()){
					echo "<option value=\"" . $row['first_name']. " " . $row['last_name']."\">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
				}
				?>
			</select>
		<input type="submit" name = "tsubmit" id = "bigbutton">
	</form>
	<p style = "display: inline">OR</p>
	<button  id = "newteacherbutton" onclick="newUser()">Add New Instructor</button>
</div>

<div id = "newteacher" style = "display: none">
	<h3>Add New Instructor</h3>
	<form  method="post" action = "teachers.php">
	<input type="text" placeholder = "first name" size = "12"></input>
	<input type="text" placeholder = "last name" size = "12"></input>
	<input type = "submit"></input>
	</form>
</div>
</body>
</html>
