<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in(3);
?>
<?php 
  global $conn;
  # User ID
  $userid = $_SESSION["user_id"];

  //Query
  $sql = "SELECT name,designation,department,mobile,email FROM hod_info WHERE user_id = '{$userid}'";

  # Executing query
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
  # output data of each row
    $row = mysqli_fetch_assoc($result);
  } else {
      echo "0 results";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <?php require_once("../../includes/layouts/hod_sidebar.php"); ?>
    <div id="main">
      <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
          <h1 align="center">WELCOME <?php print $_SESSION["name"]; ?> </h1>

        </div>
      </div>
      <!-- <img  align="right" src="pic.png" alt="Name" style="width:10%"><br> -->
      <div class="w3-container">
          <p>Name : <?php global $row; print($row["name"]); ?> </p><br>
          <p>Designation : <?php global $row; print($row["designation"]); ?> </p><br>
          <p>Department: <?php global $row; print(get_department_name($row["department"])); ?> </p><br>
          <p>Phone Number : <?php global $row; print($row["mobile"]); ?> </p><br>
          <p>Email id : <?php global $row; print($row["email"]); ?> </p><br>
      </div>
  </div><br>
  </body>
</html>
<?php ob_end_flush(); 
      mysqli_close($conn);
?>
