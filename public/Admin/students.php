<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in(0);
?>
<?php 
  global $conn;
  # User ID
  $userid = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="../../stylesheets/tabs.css">
  </head>
  <body>
    <?php require_once("../../includes/layouts/admin_sidebar.php"); ?>
    <div id="main">
      <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <p align="right" style="float: right"> <?php print $_SESSION["name"]; ?> </p>
        <div class="w3-container">
          <h1 align="center">Students </h1>
        </div>
      </div>
      <!-- Tab stuff starts here -->
      <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'cse')" id="defaultOpen" >CSE</button>
        <button class="tablinks" onclick="openCity(event, 'ce')">CE</button>
        <button class="tablinks" onclick="openCity(event, 'me')">ME</button>
        <button class="tablinks" onclick="openCity(event, 'ece')">ECE</button>
        <button class="tablinks" onclick="openCity(event, 'eee')">EEE</button>
        <button class="tablinks" onclick="openCity(event, 'it')">IT</button>
      </div>
      <div id="cse" class="tabcontent">
        <h3 align="center">CSE</h3>
        <div class="tab2">
          <button class="tablinks2" onclick="openCity2(event, 'cse_s1_s2')" id="defaultOpen2" >S1-S2</button>
          <button class="tablinks2" onclick="openCity2(event, 'cse_s3_s4')">S3-S4</button>
          <button class="tablinks2" onclick="openCity2(event, 'cse_s5_s6')">S5-S6</button>
          <button class="tablinks2" onclick="openCity2(event, 'cse_s7_s8')">S7-S8</button>
        </div>
          <div id="cse_s1_s2" class="tabcontent2">
            <h3 align="center">S1-S2</h3>
            <table>

            </table>
          </div>
          <div id="cse_s3_s4" class="tabcontent2">
            <h3 align="center">S3-S4</h3>

          </div>
          <div id="cse_s5_s6" class="tabcontent2">
            <h3 align="center">S5-S6</h3>

          </div>
          <div id="cse_s7_s8" class="tabcontent2">
            <h3 align="center">S7-S8</h3>

          </div>

      </div>


      <div id="ce" class="tabcontent">
        <h3 align="center">CE</h3>

      </div>
      <div id="me" class="tabcontent">
        <h3 align="center">ME</h3>

      </div>
      <div id="ece" class="tabcontent">
        <h3 align="center">ECE</h3>

      </div>
      <div id="eee" class="tabcontent">
        <h3 align="center">EEE</h3>

      </div>
      <div id="it" class="tabcontent">
        <h3 align="center">IT</h3>

      </div>






  </div><br>

  <?php require_once("../../includes/tabs.php"); ?>
  </body>
</html>
<?php ob_end_flush(); 
      mysqli_close($conn);
?>