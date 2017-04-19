<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
require_once('../php/mysqli_connect.php');
include '../navigation.php';

$bookName = $_POST['bkn'];
$bookReadingLevel = $_POST['bkrl'];

if(isset($bookName) && isset($bookReadingLevel)) {
  $sql = "INSERT INTO books(name, reading_lvl) VALUES ('$bookName', $bookReadingLevel)";
  $dbconn->query($sql);
  echo "<h4>book $bookName has been added to books table</h4>";
} else {
   echo "<span>Please return to the home page and fill submit values before returning here</span>";
}

?>
</html>
