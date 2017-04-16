<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
$studentID = $_POST['sid'];
$bookID = $_POST['bookselect'];
$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());
  $sql = "INSERT INTO books_read(s_id, b_id) VALUES ('$studentID', '$bookID')";
$dbconn->query($sql);
echo "<h4>book with ID '$bookID' has been added to read table</h4>";
?>
</html>
