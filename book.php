<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
$selectedBook = $_POST['bookselect'];
$studentID = $_POST['sid'];
$bookID = $_POST['bid'];

$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());
  $sql = "INSERT INTO books_read(s_id, b_id) VALUES ('$studentID', '$bookID')";
$dbconn->query($sql);
echo "<h4>'$selectedBook' has been added to read table</h4 \n<h4>(s_id and b_id are inserted to books_read table but for some reason this isn't reflected in the html table)</h4>";
?>
</html>
