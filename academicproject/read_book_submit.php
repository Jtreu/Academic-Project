<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
require_once('../php/mysqli_connect.php');
include '../navigation.php';

$studentID = $_POST['sid'];
$bookID = $_POST['bookselect'];

  $sql = "INSERT INTO books_read(s_id, b_id) VALUES ('$studentID', '$bookID')";
$dbconn->query($sql);
echo "<h4>book with ID '$bookID' has been added to read table</h4>";
?>
</html>
