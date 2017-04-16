<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<?php
$bookName = $_POST['bkn'];
$bookReadingLevel = $_POST['bkrl'];

$server = "localhost";
$db = "academicdb";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
  or die('Could not connect: '.mysqli_connect_error());
  $sql = "INSERT INTO books(name, reading_lvl) VALUES ('$bookName', $bookReadingLevel)";
$dbconn->query($sql);
echo "<h4>book $bookName has been added to books table</h4>";
?>
</html>
