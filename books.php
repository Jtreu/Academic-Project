<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
  <?php include("navigation.php"); ?>
</body>
<?php
$selectedBook = $_POST['bookselect'];
$studentID = $_POST['sid'];
$bookID = $_POST['bid'];

/* dbconn is referenced from this file */
require_once('php/mysqli_connect.php');

  $sql = "INSERT INTO books_read(s_id, b_id) VALUES ('$studentID', '$bookID')";
$dbconn->query($sql);
echo "<h4>'$selectedBook' has been added to read table</h4 \n<h4>(s_id and b_id are inserted to books_read table but for some reason this isn't reflected in the html table)</h4>";
?>
</html>
