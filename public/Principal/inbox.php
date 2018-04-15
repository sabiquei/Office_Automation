<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in(1);
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
    <?php require_once("../../includes/layouts/principal_sidebar.php"); ?>
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
        <button class="tablinks" onclick="openCity(event, 'caution_deposit_requests')">Caution Deposit Requests</button>
      </div>

      <?php
          // To Do
          // Add a new tab mechanism for No Due requests
          // Display them in that tab
          // Redirect to it.

          global $conn;
          $userid = $_SESSION["user_id"];

          print"<div id=\"caution_deposit_requests\" class=\"tabcontent\">
                <h3>Caution Deposit Requests</h3> ";
          // Caution Deposit requests.
          $sql = "SELECT * FROM `caution_deposit_requests` WHERE `status` = 0 ";
          $result = mysqli_query($conn,$sql); 
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $student_details = get_student_details($row["student_id"]);

            $color = get_status_color($row["status"]);

            print "<a style=\"text-decoration: none\" href=\"../Principal/caution_deposit_requests.php?request_no=".$row['request_no']."\">
                    <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" tyle =\"color : ".$color.";\" >
                    Caution Deposit Request Status
                    <br>"
                    .get_department_name($student_details["course"]).
                    " , ".$student_details["semester"]."
                    <br>".$student_details["name"]."
                    <br>Submitted On : ".$row["date"]."
                    </div>
                  </a>";
          }
          print "</div>";
          // Caution Deposit request ends here.

          // Other Requests
          print"<div id=\"other_requests\" class=\"tabcontent\">
                <h3>Student Requests</h3> ";

          $sql = "SELECT * FROM `pending_requests_other` WHERE `current_level` = 2 and `status` = 0 ";
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
          // Other requests ends here.
      ?>
    </div>

  <?php require_once("../../includes/tabs.php"); ?>

  </body>
</html> 

<?php ob_end_flush(); 
      mysqli_close($conn);
?>