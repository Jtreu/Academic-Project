<!DOCTYPE html>
<html>


<head>
	<style>
		#bodyheader {
			background-color: #1abc9c;
			padding: 6px;
			margin:0px;
			margin-bottom: 10px;
		}

		h1 {
			color: white;
			margin: 3px;
		}

		tr,
		td {
			border: 1px solid #D6DBE8;
		}
		table {

		border-collapse: collapse;
		}

		table,
		tr,
		td,
		th {
			padding: 7px;
		}

		tr:nth-child(even) {
			background: #3498db;
		}

		tr:nth-child(odd) {
			background: #2980b9;
		}

		th {
			background: #34495e;
			text-align: center;
		}

		body {
			background-color: #21252B;
			color: white;
			font-family: 'Inconsolata', monospace;
			margin: 0px;
		}
	</style>
	<meta charset="utf-8">
	<title>Academic Project</title>
	<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet"></link>
	<!--<link rel="stylesheet" href="academicproject.css"></link>-->
</head>

<body>

	<div id="bodyheader">
		<h1>Reading Progress Database</h1>
	</div>
	<div id="studentSelect">

<!--Select list is now populated from actor database "sakila"-->
<label>Student</label>
<form action="mysql.php" method="post" style = "display: inline">
<select name="studentselect">
<?php
$server = "localhost"; //my local WAMP server, IP address is 153.91.173.160
$db = "sakila"; //change out db to ours obviously
$user = "root";
$password = "";//please don't rape my db
$dbconn = mysqli_connect($server, $user, $password, $db)
    or die('Could not connect: '.mysqli_connect_error());
$sql = mysqli_query($dbconn, "SELECT first_name, last_name FROM actor");
while ($row = $sql->fetch_assoc()){
echo "<option value=\"" . $row['first_name']. " " . $row['last_name']."\">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
}

?>
</select>
<input type="submit" name = "submit" onclick="">
</form>
	</div>

	<div id="addScore" style="display: none">
		<input type="text" id="scoreInput"></input>
		<button onclick="addScore()">Add score</button>
	</div>

	<!-- php will generate this table, only shown for css styling-->
	<div id="table" style="display: none">
		<table id="studenttable">
			<thead id="tableHeader"></thead>

			<tbody>
				<tr>
					<th>column1</th>
					<th>column2</th>
				</tr>
				<tr>
					<td>c1r1</td>
					<td>c2r1</td>
				</tr>
				<tr>
					<td>c1r2</td>
					<td>c2r2</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id = "pp"></div>
	<!-- ########################################################## -->
	<button id="back" onclick="back()" style="display: none">Select Different Student</button>

</body>

</html>
<script>
	function viewTable() {
		document.getElementById("table").style.display = "block";
		document.getElementById("addScore").style.display = "block";
		document.getElementById("studentSelect").style.display = "none";
		var e = document.getElementById("studentSelectName");
		var studentName = e.options[e.selectedIndex].text;
		document.getElementById("tableHeader").innerHTML = studentName;
		document.getElementById("back").style.display = "block";


	}

	function addScore() {
		var score = document.getElementById("scoreInput").value;
		var today = new Date();
		var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
		var table = document.getElementById("studenttable");
		var row = table.insertRow(1);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		cell1.innerHTML = date;
		cell2.innerHTML = score;
		document.getElementById("scoreInput").value = "";

	}

	function back() {
		document.getElementById("table").style.display = "none";
		document.getElementById("addScore").style.display = "none";
		document.getElementById("studentSelect").style.display = "block";
		document.getElementById("back").style.display = "none";
	}
</script>
