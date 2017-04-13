<html>
<head><style>
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
</style></head>
<body>
  <?php
$selectedStudent = $_POST['studentselect'];
$selectedStudent = preg_split("/[\s,]+/", $selectedStudent);
echo "<h1>$selectedStudent[0] $selectedStudent[1]</h1>";

// Connecting, selecting database
$server = "localhost";
$db = "sakila";
$user = "root";
$password = "";
$dbconn = mysqli_connect($server, $user, $password, $db)
    or die('Could not connect: '.mysqli_connect_error());


// Performing SQL query
$query = "SELECT * FROM actor WHERE first_name = '$selectedStudent[0]' AND last_name = '$selectedStudent[1]'";
$result = $dbconn->query($query) or die('Query failed: ' . mysqli_error());

// Printing results in HTML
echo "<table>\n";

while ($line = $result->fetch_assoc()) {

    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
mysqli_free_result($result);

// Closing connection
mysqli_close($dbconn);
?>

</body>
</html>
