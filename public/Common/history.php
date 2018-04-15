<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in($_SESSION["user_type"]);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>History</title>
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
    <?php 
      if($_SESSION["user_type"] == 4){
        require_once("../../includes/layouts/sidebar.php"); 
      } elseif($_SESSION["user_type"] == 3){
        require_once("../../includes/layouts/tutor_sidebar.php"); 
      } elseif($_SESSION["user_type"] == 2){
        require_once("../../includes/layouts/hod_sidebar.php"); 
      } elseif($_SESSION["user_type"] == 1){
        require_once("../../includes/layouts/principal_sidebar.php"); 
      }
    ?>
    <div id="main">
      <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <p align="right" style="float: right"> <?php print $_SESSION["name"]; ?> </p>
        <div class="w3-container">
          <h1 align="center">HISTORY </h1>
        </div>
      </div>
      <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'other_requests')" id="defaultOpen" >Student Requests</button>
        <?php if($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 1){
        print '<button class="tablinks" onclick="openCity(event, \'caution_deposit_requests\')">Caution Deposit Requests</button>';
      }
        ?>
        <?php if($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 2){
        print '<button class="tablinks" onclick="openCity(event, \'no_due_requests\')">No Due Requests</button>';
      }?>
      </div>
      <?php 
          global $conn;
          $userid = $_SESSION["user_id"];

          if($_SESSION["user_type"] == 4){
            print"<div id=\"caution_deposit_requests\" class=\"tabcontent\">
                <h3>Caution Deposit Requests</h3> ";

            // Checking for Caution Deposit Requests for Students.
            $sql = "SELECT * FROM `caution_deposit_requests` WHERE `student_id` = '{$userid}' ";
            $result = mysqli_query($conn,$sql); 
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);

              $color = get_status_color($row["status"]);

              print "<a style=\"text-decoration: none\" href=\"../student/caution_deposit_request_status.php\">
                      <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" style =\"color : ".$color.";\" >
                      <hr>
                      Caution Deposit Request Status
                      <br>Submitted On : ".$row["date"]."<br>Remarks : ".$row["remarks"]."
                      <hr>
                      </div>
                    </a>";
            }
            print "</div>";
            // Checking for No due requests for Students
            print"<div id=\"no_due_requests\" class=\"tabcontent\">
                <h3>No Due Requests</h3> ";

            $sql = "SELECT `request_no`,`date` FROM `no_due_requests` WHERE `student_id` = '{$userid}' ";
            $result = mysqli_query($conn,$sql); 
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              print "<a style=\"text-decoration: none\" href=\"../student/nodue_request.php\">
                      <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" >
                      <hr>
                      No Due Status
                      <br>Submitted On : ".$row["date"]."<br><hr>
                      </div>
                    </a>";
            } 
            print "</div>";
            // Other Requests
            $sql = "SELECT * FROM `pending_requests_other` WHERE `student_id` = '{$userid}' ";

          } elseif($_SESSION["user_type"] == 3){
            // Tutor
            $sql = "SELECT * FROM `pending_requests_other` WHERE `tutor_id` = '{$userid}' AND (`current_level` > 0 OR (`current_level` = 0 AND `status` = 2))";
          } elseif ($_SESSION["user_type"] == 2) {
              // HOD

              // Checking for No Due Requests
              print"<div id=\"no_due_requests\" class=\"tabcontent\">
                    <h3>No Due Requests</h3> ";
                    
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

              $sql = "SELECT * FROM `no_due_requests` WHERE `{$department}` != '0' ";
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

            $sql = "SELECT * FROM `pending_requests_other` WHERE `hod_id` = '{$userid}' AND (`current_level` > 1 OR (`current_level` = 1 AND `status` = 2))";
          } elseif ($_SESSION["user_type"] == 1) {
            // History for Caution Deposit
            print"<div id=\"caution_deposit_requests\" class=\"tabcontent\">
                <h3>Caution Deposit Requests</h3> ";
            // Caution Deposit requests.
            $sql = "SELECT * FROM `caution_deposit_requests` WHERE `status` != 0 ";
            $result = mysqli_query($conn,$sql); 
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
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
            }
            print "</div>";
            // Caution Deposit request ends here.

            $sql = "SELECT * FROM `pending_requests_other` WHERE  `current_level` > 2 OR (`current_level` = 2 AND `status` = 2)";
          }

          $result = mysqli_query($conn,$sql); 
          $count = mysqli_num_rows($result);

          print"<div id=\"other_requests\" class=\"tabcontent\">
                <h3>Student Requests</h3> ";

          if ($count > 0) {
          # output data of each row
            while($row = mysqli_fetch_assoc($result)){
              $student_details = get_student_details($row["student_id"]);
              $request_no = $row["request_no"];
              $category = $row["category"];

              $color = get_status_color($row["status"]);

              print "<a style=\"text-decoration: none\" href=\"other_request_status.php?request_no=".$request_no."&category=".$category."\">
                        <div class=\"w3-container w3-hover-light-gray w3-border-bottom test\" width=\"100%\" style =\"color : ".$color.";\" >"
                        .get_department_name($student_details["course"])." , ".$student_details["semester"]."
                        <br>".$student_details["name"]."<br>"
                        .$row["subject"]."<br>Submitted On : ".$row["date"]."<br>Status : ".get_status_remarks($row["status"],$row["current_level"])."
                        </div>
                      </a>";
            }
          } else {
              echo "No History";
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