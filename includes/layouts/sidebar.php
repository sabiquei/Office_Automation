<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>

  <a href="stuhomepage.php" class="w3-bar-item w3-button">Home</a>
  <a href="profile.php" class="w3-bar-item w3-button">Profile</a>
  <a href="tuthod.php" class="w3-bar-item w3-button">Tutor & HOD</a>
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