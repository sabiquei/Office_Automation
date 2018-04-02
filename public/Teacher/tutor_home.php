<?php 
    require_once("../../includes/session.php");
    ob_start(); 
    require_once("../../includes/connect.php");
    require_once("../../includes/functions.php"); 
    confirm_logged_in();
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Teacher Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
      <button class="w3-bar-item w3-button w3-large"
      onclick="w3_close()">Close &times;</button>
      <a href="#" class="w3-bar-item w3-button">Inbox</a>
      <a href="tuthomepage.html" class="w3-bar-item w3-button">Home</a>
      <a href="#" class="w3-bar-item w3-button">Approved</a>
      <a href="#" class="w3-bar-item w3-button">Declined</a>
      <a href="../student/logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
    <?php 
          global $conn;
          # User ID
          $userid = $_SESSION["user_id"];

          $sql = "SELECT name,designation,semester,department,mobile,email FROM tutor_info WHERE user_id = '{$userid}'";

          # Executing query
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
          # output data of each row
            $row = mysqli_fetch_assoc($result);
          } else {
              echo "0 results";
          }
    ?>
    <div id="main">
      <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
          <h1 align="center">WELCOME <?php print $_SESSION["name"]; ?> </h1>
        </div>
      </div>
      <img  align="right" src="pic.png" alt="Name" style="width:10%"><br>
      <div class="w3-container">
        <p>Name : <?php global $row; print($row["name"]); ?> </p><br>
        <p>Designation : <?php global $row; print($row["designation"]); ?> </p><br>
        <p>Semester : <?php global $row; print($row["semester"]); ?> </p><br>
        <p>Department: <?php global $row; print(get_department_name($row["department"])); ?> </p><br>
        <p>Phone Number : <?php global $row; print($row["mobile"]); ?> </p><br>
        <p>Email id : <?php global $row; print($row["email"]); ?> </p><br>
      </div>
    </div>
    <br>
    <script>
      function w3_open() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("mySidebar").style.width = "25%";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
      }
      function w3_close() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
      }
    </script>
  </body>
</html>
<?php ob_end_flush(); 
      mysqli_close($conn);
?>