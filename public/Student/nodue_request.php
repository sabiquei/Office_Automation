<?php require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in(4);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>No Due Request Status</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        	height:60px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color:#b2d8d8 ;
            color:black ;
        }

        /* The container */
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #66b2b2;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #66b2b2;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #004c4c;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
  </head>
  <body>
    <?php require_once("../../includes/layouts/sidebar.php"); ?>
    <?php 
        // Get No due details for the selected student
        $sql = "SELECT * FROM `no_due_requests`where `student_id` = '{$_SESSION["user_id"]}' LIMIT 1 ";
        $result = mysqli_query($conn,$sql); 
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
        } else {
            print "Error";
        }
     ?>
      <div id="main">
        <div class="w3-teal">
          <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
          <div class="w3-container">
            <h2 align="center">NON-LIABILITY REQUEST</h2>
          </div>
        </div>
      </div>
      <table>
        <tr>
          <th>Sl No</th>
      	<th>Status</th>
          <th>Department/Section</th>
          <th>Remarks</th>
          <th style="width: 10%">Request Again</th>
        </tr>
        <tr>
          <td>1</td>
      	<td><label class="container"><input type="checkbox" <?php global $row; if($row["415"] == 1) echo "checked"; ?> disabled>
        <span class="checkmark"></span></label></td>
          <td>Computer Science and Engineering</td>
          <td><?php global $row; echo $row["415_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["415"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=415\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
        <tr>
          <td>2</td>
      	<td><label class="container"><input type="checkbox" <?php global $row; if($row["411"] == 1) echo "checked"; ?> disabled>
        <span class="checkmark"></span></label></td>
          <td>Electronics and Communication</td>
          <td><?php global $row; echo $row["411_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["411"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=411\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
            </td>
        </tr>
        <tr>
          <td>3</td>
      	<td><label class="container"><input type="checkbox" <?php global $row; if($row["412"] == 1) echo "checked"; ?> disabled>
        <span class="checkmark"></span></label></td>
          <td>Electrical and Electronics Engineering</td>
          <td><?php global $row; echo $row["412_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["412"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=412\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
        <tr>
          <td>4</td>
      	<td><label class="container"><input type="checkbox" <?php global $row; if($row["416"] == 1) echo "checked"; ?> disabled>
        <span class="checkmark"></span></label></td>
          <td>Information Technology</td>
          <td><?php global $row; echo $row["416_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["416"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=416\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>5</td>
      	<td><label class="container"><input type="checkbox" <?php global $row; if($row["403"] == 1) echo "checked"; ?> disabled>
        <span class="checkmark"></span></label></td>
          <td>Mechanical Engineering</td>
          <td><?php global $row; echo $row["403_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["403"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=403\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>6</td>
      	<td><label class="container"><input type="checkbox" <?php global $row; if($row["401"] == 1) echo "checked"; ?> disabled>
        <span class="checkmark"></span></label></td>
          <td>Civil Engineering</td>
          <td><?php global $row; echo $row["401_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["401"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=401\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
        <tr>
          <td>7</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>Department of Applied Science(DASH)</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=415\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>8</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>Computer Centre</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>9</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>Central Library</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>10</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>Alumini Association</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>11</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>PTA / College Bus</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>12</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>Office(Identity Card)</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>13</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>CGPC / JobFair</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>14</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>Sports</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
         <tr>
          <td>15</td>
      	<td><label class="container"><input type="checkbox" checked disabled>
        <span class="checkmark"></span></label></td>
          <td>Hostel</td>
          <td><?php global $row; echo $row["other_remarks"]; ?></td>
          <td>
            <?php
              global $row; 
              if($row["other_status"] == 2) {
                echo"
                <a style=\"text-decoration: none;\" href=\"nodue_resubmit.php?department_id=\">
                <button class=\"w3-button w3-teal w3-round-large\" >Re Submit</button></a>
                ";
              } else {
                echo "----";
              }
            ?>
          </td>
        </tr>
      </table><br><br><br>
    <!-- <div class="container" align="center">
      <button type ="submit" name ="submit" class="w3-button w3-teal w3-round-large" >Send </button><br><br>
    </div> -->
  </body>
</html>
<?php ob_end_flush(); 
      mysqli_close($conn);
?>
