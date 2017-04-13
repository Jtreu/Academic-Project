<?php
// turn off error reporting
error_reporting(0);
// Get a connection for the database
require_once('mysqli_connect.php');

// Create a query for the database
$query = "SELECT column_name FROM table_name";

// Get a response from the database by sending the connection
// and the query
// The '$dbc' variable is imported from 'mysqli_connect.php'
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response){
  /* ***************************************EXAMPLE*************************************** */
  /* In this statement, we're retrieving a variable POSTed to this file from
     another html file's form submission and setting 'postedValue' equal to that variable */
  // (if you don't know what html forms are, be sure to look it up)
  if(!empty($postedValue = $_GET['posted_variable_name'])) {

    // in this statement we're updating a column name' with a value if that' column is equal to '$postedValue'
  	$queryName = "UPDATE `table_name` SET `column_name` = 'some value' WHERE `table_name`.`column_name` = '".$postedValue."'";

    // query the database, and IF nothing went wrong display a success MessageFormatter
    // ELSE something went wrong and you need to send the error signal.
  	if ($dbc->query($queryName) === TRUE) {
  	    echo "Record updated successfully";
  	} else {
  	    echo "Error updating record: " . $dbc->error;
  	}
  }

  // mysqli_fetch_array will return a row of data from the query
  // until no further data is available
  while($row = mysqli_fetch_array($response)){

    /* ***************************************EXAMPLE*************************************** */
    // this example statement will echo every value of a specified column name
    // into a <span> tag on the webpage.
    // output would look something like this depending on how many rows in your table:
    /*    some value
          some other value
          some other value
          some other value
    */
    echo '<span>' . $row['column_name'] . '</span">' . '<br/>';

    /* ***************************************EXAMPLE*************************************** */
    /* In this example we're checking to see if the current row's specified column
       is not NULL, and if it is not we'll echo a span tag carrying that column's value
       ELSE we print the word 'NULL' in a span tag*/
    if(is_null($row['column_name']) == false) {
    	echo '<span>' . $row['column_name'] . '</span>';
    } else if(is_null($row['column_name']) == true) {
    	echo '<span>' . 'NULL' . '</span>'
    }
  }
} else {

  // If you reach this section, it means you didn't get a response back from the database
  echo "Couldn't issue database query<br />";

  // post an error on the page
  echo mysqli_error($dbc);

}

// Close connection to the database
mysqli_close($dbc);

?>
