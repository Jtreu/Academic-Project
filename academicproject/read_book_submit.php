<html>
<head>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>
    var student_selected_option_value = 0;
    var book_selected_option_value = 0;
    $(function(ready) {
      // everything here will be executed once index.html has finished loading, so at the start when the user is yet to do anything.
      $("#studentSelect").change(function() {
        $('#studentSelect').trigger('studentChanged');
        student_selected_option_value=$("#studentSelect option:selected").val(); //get the value of the current selected option.
        /*
        var selected_option_value=$("#studentSelect option:selected").val(); //get the value of the current selected option.
        $.post("../php/scripts/read_book_submit_script.php", {option_value: selected_option_value},
            function(data){ // this will be executed once the `read_book_submit_script` ends its execution, `data` contains
                            // everything said script echoed.
                 $("#showtext").html(data);
                 alert(data); //just to see what it returns
            }
        );
        */
      });

      $("#bookSelect").change(function() {
        $("#submitBtn").show();
        book_selected_option_value=$("#bookSelect option:selected").val(); //get the value of the current selected option.
      });

      // submit event handler
      $("#submitBtn").on('click', function() {
        // alert("submit button clicked");

        $.post("../php/scripts/read_book_submit_script.php", {sid: student_selected_option_value, bid: book_selected_option_value},
            function(data){ // this will be executed once the `read_book_submit_script` ends its execution, `data` contains
                            // everything said script echoed.
                 $("#usermessage").html(data);
                 // alert(data); //just to see what it returns
            }
        );
      });

    });
  </script>
</head>
<body>
<?php
session_start();
require_once('../php/mysqli_connect.php');
include '../navigation.php';

$required = array('sid', 'bookselect');

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
    // echo "$field did not post<br/>";
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $studentID = $_POST['sid'];
  $bookID = $_POST['bookselect'];
} else {
  $studentID = $_SESSION["studentid"];
}

/* Testing code to make sure that studentID and bookID were posted correctly */

if($error) {
?>
  <div id=#wrapper>
    <label for="studentSelect">
    <select id="studentSelect" name="sid">
      <option value="NULL">Select student...</option>
      <?php
        require_once('../php/mysqli_connect.php');
        //query to populate teacher list
        $sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS sfn, last_name AS sln, id FROM students");
        while ($row = $sql->fetch_assoc()){
          //teacher first names, last names, and IDs are stored
          $studentFirstName = $row['sfn'];
          $studentLastName = $row['sln'];
          $studentID = $row['id'];
          //Dropdown menu is populated with student first and last names, option values assigned studentID
          echo "<option name='studentID' value='$studentID'>$studentFirstName $studentLastName</option>";
        }
      ?>
      </select>

      <!-- Only shows when a student is selected -->
      <script>
        // event handler
        $("#studentSelect").on('studentChanged', function() {
            $("#bookSelect").show();
        });
      </script>
      <label for="bookSelect">
      <select hidden id="bookSelect" name="bookselect">
        <option>Select Book...</option>
        <?php
          require_once('../php/mysqli_connect.php');
          //query to populate teacher list
          $sql = mysqli_query($dbconn, "SELECT DISTINCT name AS bkn, id FROM books");
          while ($row = $sql->fetch_assoc()){
            //teacher first names, last names, and IDs are stored
            $bookName = $row['bkn'];
            $bookID = $row['id'];
            //Dropdown menu is populated with student first and last names, option values assigned studentID
            echo "<option name='bookName' value='$bookID'>$bookName</option>";
          }
        ?>
        </select>
        <button hidden id="submitBtn" type="submit">Submit</button>	<!--posted using jquery-->

        <div id="usermessage"></div>
    </div>
<?php
} else {
  ?>
  <script>
    /* We don't want to show these select boxes if they came from the student_details page */
    $('#studentSelect').hide();
    $('bookSelect').hide();
    )
  </script>
  <?php
  require_once('../php/mysqli_connect.php');
  //query to populate teacher list
  $sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS sfn, last_name AS sln FROM students WHERE id = $studentID");

  while ($row = $sql->fetch_assoc()){
    //teacher first names, last names, and IDs are stored
    $studentFirstName = $row['sfn'];
    $studentLastName = $row['sln'];
  }
    $sql = "INSERT INTO books_read(s_id, b_id) VALUES ('$studentID', '$bookID')";
    $dbconn->query($sql);

    // Get the book name
    $sql  = mysqli_query($dbconn, "SELECT DISTINCT name AS bkn FROM books WHERE id = $bookID");

    while( $row = $sql->fetch_assoc()) {
      $bookName = $row['bkn'];
    }

    echo "<div class='checkok'>";
    echo "<span>Alright, $studentFirstName $studentLastName has read '$bookName'!</span>";
    echo "<a href='student_details.php'>Return to student details</a>";
    echo "</div>";
}
?>
</body>
</html>

<style>
  #wrapper {
    display:inline-block;
  }

  .checkok {
    display: block;
    width: 100%;
  }
  .checkok a {
    margin-top: 100px;
    display:block;
    border: 3px solid grey;
    background-color: inherit;
    color: black;
    text-decoration: none;
    font-size: 1.25em;
    width: 25%;
    margin-left: 40%;
    border: 3px solid rgb(116, 171, 201);
    color: white;
    text-align: center;
    padding: 5px 5px 5px 5px;
  }

  .checkok a:hover {
    background-color:#2F333E;
    font-size: 1.50em;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
  }

  span {
    display:block;
    color: white;
    font-size: 1.75em;
    margin: auto;
    border: 3px solid green;
    padding: 10px;
    background-color: green;
    text-align: center;
  }
</style>
