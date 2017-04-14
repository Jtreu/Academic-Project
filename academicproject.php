<!DOCTYPE html>
<html>


<head>
	  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
		<link rel="stylesheet" href="academicproject.css" </link>

	<meta charset="utf-8">
	<title>Academic Project</title>
	<!--<link rel="stylesheet" href="academicproject.css"></link>-->
</head>

<body>

	<div id="bodyheader">
		<h1>Reading Progress Database</h1>
	</div>
	<div id="studentSelect">

<!--Select list is now populated from actor database "sakila"-->
<form action="mysql.php" method="post" style = "display: inline">
	<select name="studentselect">
	<?php
	$server = "localhost"; // my local WAMP server, IP address is 153.91.173.160
	$db = "sakila"; // change out db to ours obviously
	$user = "root";
	$password = "";// please don't rape my db
	$dbconn = mysqli_connect($server, $user, $password, $db)
	    or die('Could not connect: '.mysqli_connect_error());
	$sql = mysqli_query($dbconn, "SELECT first_name, last_name FROM actor");
	while ($row = $sql->fetch_assoc()){
	echo "<option value=\"" . $row['first_name']. " " . $row['last_name']."\">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
	}

	?>
	</select>
	<input type="submit" name = "submit" id = "bigbutton">
</form>
	</div>



	<!-- ########################################################## -->

</body>

</html>
<script>

</script>
