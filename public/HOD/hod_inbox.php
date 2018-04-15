<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in(2);
?>
<?php
  global $conn;
  # User ID
  $userid = $_SESSION["user_id"];

  //Query
  $sql = "SELECT department FROM hod_info WHERE user_id = '{$userid}' LIMIT 1";

  # Executing query
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
  # output data of each row
    $row = mysqli_fetch_assoc($result);
    $department = $row["department"];
  } else {
      echo "0 results";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Inbox</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif;}

    .w3-bar-block .w3-bar-item{padding:16px}
    </style>
    <link rel="stylesheet" type="text/css" href="../../stylesheets/tabs.css">
  </head>
  <body>
    <?php require_once("../../includes/layouts/hod_sidebar.php"); ?>
    <div id="main">
      <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <p align="right" style="float: right"> <?php print $_SESSION["name"]; ?> </p>
        <div class="w3-container">
          <h1 align="center">INBOX </h1>
        </div>
      </div>

      <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'other_requests')" id="defaultOpen" >Student Requests</button>
        <button class="tablinks" onclick="openCity(event, 'no_due_requests')">No Due Requests</button>
      </div>
      
      <?php 
          global $conn;
          global $department;
          $userid = $_SESSION["user_id"];

          // Checking for No Due Requests
          print"<div id=\"no_due_requests\" class=\"tabcontent\">
                <h3>No Due Requests</h3> ";

          $sql = "SELECT * FROM `no_due_requests` WHERE `{$department}` = '0' ";
          $result = mysqli_query($conn,$sql); 
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
              
              $student = get_student_details($row["student_id"]);

              print "<a style=\"text-decoration: none\" href=\"../HOD/nodue_request.php?request_no=".$row["request_no"]."\">
                      <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" >
                      ".$student["name"]."<br>".get_department_name($student["course"])." , ".$student["semester"]."
                      <br>No Due Request
                      <br>
                      </div>
                    </a>"; 
            }
          } else {
            print "No Requests.";
          } 
          print "</div>";
          // End of No Due Requests

          print"<div id=\"other_requests\" class=\"tabcontent\">
                <h3>Student Requests</h3> ";

          $sql = "SELECT * FROM `pending_requests_other` WHERE `hod_id` = '{$userid}' and `current_level` = 1 and `status` = 0 ";
          $result = mysqli_query($conn,$sql);

          $count = mysqli_num_rows($result);

          if ($count > 0) {
          # output data of each row
            while($row = mysqli_fetch_assoc($result)){
              $student_details = get_student_details($row["student_id"]);
              $request_no = $row["request_no"];
              $category = $row["category"];
              print "<a style=\"text-decoration: none\" href=\"other_request.php?request_no=".$request_no."&category=".$category."\"><div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\">"
                        .get_department_name($student_details["course"])." , ".$student_details["semester"]."
                        <br>".$student_details["name"]."<br>"
                        .$row["subject"]."<br>".$row["date"]."
                      </div></a>";
            }
          } else {
              echo "No requests";
          }
          print "</div>";
      ?>
    </div>
    <?php require_once("../../includes/tabs.php"); ?>
  </body>
</html> 

<?php ob_end_flush(); 
      mysqli_close($conn);
?>