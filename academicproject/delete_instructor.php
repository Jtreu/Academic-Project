<html>
<head>
  <script>
  function newStudent() { //Hides student selections, shows text boxes for new student
  document.getElementById("selectstudent").style.display = "none";
  document.getElementById("addnewstudent").style.display = "block";
  }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="academicproject.css" </link>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
  <?php
    include '../navigation.php';
    session_start();
  ?>
  <div id = "bodyheader">
  <!--Select statement from database includes all columns for specified username -->
  <?php
    require_once('../php/mysqli_connect.php');

    $required = array('teacherselect');

    // Loop over field names, make sure each one exists and is not empty
    $error = false;
    foreach($required as $field) {
      if (empty($_POST[$field])) {
        $error = true;
      }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $teacherID = $_POST['teacherselect']; //stores studentID from select_and_add_students.php student select form
      $_SESSION["teacherid"] = $teacherID;
    } else {
      $teacherID = $_SESSION["teacherid"];
    }

    if($error) {
    ?>
      <form action="delete_instructor.php" method="post" style="display: inline">
        <select name="teacherselect">
          <?php
            require_once('../php/mysqli_connect.php');
            //query to populate teacher list
            $sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS tfn, last_name AS tln, id FROM teachers");
            while ($row = $sql->fetch_assoc()){
              //teacher first names, last names, and IDs are stored
              $teacherFirstName = $row['tfn'];
              $teacherLastName = $row['tln'];
              $teacherID = $row['id'];
              //Dropdown menu is populated with teacher first and last names, option values assigned teacherID
              echo "<option value='$teacherID'>$teacherFirstName $teacherLastName</option>";
            }
          ?>
        </select>
      <input type="submit">	<!--form sends $teacherID to select_and_add_students.php-->
    <?php
    } else {
      //query to find teacher first and last name
      $sql = mysqli_query($dbconn, "SELECT DISTINCT first_name AS tfn, last_name AS tln FROM teachers WHERE teachers.id = $teacherID");
      while ($row = $sql->fetch_assoc()){
        $teacherFirstName = $row['tfn']; //store teacher names in variables
        $teacherLastName = $row['tln'];
      }
    }

    //display teacher name in header
    echo "<h1>$teacherFirstName $teacherLastName</h1>";
    //header home button
    echo "<button id=\"back\" onclick=\"location.href = 'index.php';\" style='display: inline'>Database Home</button>";
    echo "</div>";
  ?>
<!--Dropdown menu for selecting students to edit-->

</body>
</html>

<style>
  #studentdetailsform {
    display:none;
  }
</style>
