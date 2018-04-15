<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
      <button class="w3-bar-item w3-button w3-large"
      onclick="w3_close()">Close &times;</button>
      <a href="../Admin/admin_home.php" class="w3-bar-item w3-button">Home</a>
      <a href="../Admin/students.php" class="w3-bar-item w3-button">Students</a>
      <a href="../Admin/teachers.php" class="w3-bar-item w3-button">Teachers</a>
      <a href="../Admin/hod.php" class="w3-bar-item w3-button">HOD</a>
      <a href="../Admin/principal.php" class="w3-bar-item w3-button">Principal</a>
      <a href="../common/verify.php" class="w3-bar-item w3-button">Account Verification</a>
      <a href="../common/logout.php" class="w3-bar-item w3-button">Logout</a>
</div>

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