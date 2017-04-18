<!DOCTYPE html>
<html>
<head>
	<script>
		function newUser() { //Hides teacher selections, shows text boxes for new teacher
			document.getElementById("selectuser").style.display = "none";
			document.getElementById("newteacher").style.display = "block";
			document.getElementById("newteacherbutton").style.display = "none";
		}

		function newBook() { //Hides teacher selections, shows text boxes for new book
			document.getElementById("selectuser").style.display = "none";
			document.getElementById("newteacher").style.display = "none";
			document.getElementById("newteacherbutton").style.display = "none";
			document.getElementById("newbook").style.display = "block";
		}
	</script>
	<link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="academicproject.css" </link>
	<meta charset="utf-8">
	<title>APDb - Academic Progress Database</title>
</head>

<body>
	<?php
		require_once('../php/mysqli_connect.php');
		include '../navigation.php';
	?>
	<div id="bodyheader"> <!--header with home button-->
		<h1>Academic Progress Database</h1>
		<button id="back" onclick="location.href = 'index.php'" style='display: inline;'>Database Home</button>
	</div>

	<div id="selectuser" style="display: block;">
		<h3>Select Instructor</h3>
		<form action="select_and_add_students.php" method="post" style="display: inline">
			<select name="teacherselect">
				<?php
					require_once('../php/mysqli_connect.php');
					//query to populate teacher list
					$sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS tfn, last_name AS tln, id FROM teachers");
					while ($row = $sql->fetch_assoc()){
						//teacher first names, last names, and IDs are stored
						$teacherFirstName = $row['tfn'];
						$teacherLastName = $row['tln'];
						$teacherID = $row['id'];
						//Dropdown menu is populated with teacher first and last names, option values assigned teacherID
						echo "<option value='$teacherID'>$teacherFirstName $teacherLastName</option>";
					}
				?>
			</select>
		<input type="submit">	<!--form sends $teacherID to select_and_add_students.php-->
	</form>
			<p style="display: inline">OR</p>
			<button id="newteacherbutton" onclick="newUser()">Add Instructor</button> <!--makes new teacher submission visible-->
			<p style="display: inline">OR</p>
			<button id="newbookbutton" onclick="newBook()">Add Book</button><!--makes new book submission menu visible-->
			</div>

			<div id="newteacher" style="display: none"><!--new teacher submission menu-->
			    <h3>Add New Instructor</h3>
			    <form method="post" action="teacher_submit.php">
			        <input name='tfn' type="text" placeholder="first name" size="12"></input>
			        <input name='tln' type="text" placeholder="last name" size="12"></input>
			        <input type="submit"></input>
			    </form>
			</div>
			<div id="newbook" style="display: none"><!--new book submission menu-->
			    <h3>Add Book to Library</h3>
			    <form method="post" action="new_book_submit.php">
			        <input name='bkn' type="text" placeholder="book name" size="20" </input>
			        <input name='bkrl' type="text" placeholder="level" size="6" </input>
			        <input type="submit"></submit>
			    </form>
			</div>
			</body>
			</html>
