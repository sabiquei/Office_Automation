<!DOCTYPE html>
<html>
<title>STUDENTPROFILE.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
  <a href="#" class="w3-bar-item w3-button">Inbox</a>
  <a href="stuhomepage.html" class="w3-bar-item w3-button">Home</a>
  <a href="profile.html" class="w3-bar-item w3-button">Profile</a>
  <a href="marklist.html" class="w3-bar-item w3-button">Marklist</a>
  <a href="tuthod.html" class="w3-bar-item w3-button">Tutor & HOD</a>
  <a href="log.html" class="w3-bar-item w3-button">Logout</a>
</div>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1 align="center">TUTOR AND HOD</h1>
	<h2 align="RIGHT">WELCOME NAME</h2>
  </div>
</div>
<div class="w3-container">
<h3 font-family="san-serif" align="left"><b>TUTOR</b></h3><br><br>
<p>Name :</p><br>
<p>Designation:</p><br>
<p>Phone Number :</p><br>
<p>Email ID :</p><br>
</DIV>


<div class="w3-container">
<h3 font-family="san-serif" align="left"><b>HOD</b></h3><br><br>
<p>Name :</p><br>
<p>Designation:</p><br>
<p>Phone Number :</p><br>
<p>Email ID :</p><br>
</div>

<br>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "15%";
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
