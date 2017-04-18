<?php
    require_once('../mysqli_connect.php');

    $studentID = $_POST['sid'];
    $bookID = $_POST['bid'];

    $query = "SELECT DISTINCT s.first_name, s.last_name, b.name FROM books b, students s WHERE b.id = '$bookID' AND s.id = '$studentID'";
    $response = @mysqli_query($dbconn, $query);
    // Get the first row (in this case you'll only get one row)
    $row = mysqli_fetch_array($response, MYSQL_NUM);
    // Get the first column (you should only have one column anyway) and put it into your variable
    $studentFirstName = $row[0];
    $studentLastName = $row[1];
    $bookName = $row[2];

    $sql = "INSERT INTO books_read(s_id, b_id) VALUES ('$studentID', '$bookID')";
    $dbconn->query($sql);
    echo "<h4>book with ID '$bookID' attributed to student ID '$studentID' has been added to the books_read table</h4>";
    echo "<h5> Alright, $studentFirstName $studentLastName has read '$bookName'!</h5>";
?>
