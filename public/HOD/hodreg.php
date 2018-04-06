<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 50%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

h1 { 
    display: block;
    font-size: 2em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

h2 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

h3 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

h4 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
	}

h5 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
	
/* Set a style for all buttons */
button {

    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 50%;
    opacity: 0.8;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: center;
  width: 30%;
}

.container {
  width: 800px;
  clear: both;
}

.container input {
  width: 100%;
  clear: both;
}
/* Add padding to container elements */
.container {
	
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

<form action="/action_page.php" style="border:1px solid #ccc">
  <div class="container"align="left">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
	<h2> Personal Details</h2>
	 <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required>
	<br><br>
	
	<label for="designation"><b>Designation</b></label>
    <input type="text" placeholder="Designation" name="designation" required>
	<br><br>
    
	 <label for="semester"><b>Semester</b></label>
    <input type="text" placeholder="semester" name="semester" required>
	<br><br>
	
	<label for="dept"><b>Department</b></label>
    <input type="text" placeholder="Dept" name="dept" required>
	<br><br>
	
	<label for="ph"><b>Phone Number</b></label>
    <input type="text" placeholder="phonenumber" name="ph" required>
	
	 <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
	<br><br>
	
	 
	
	<h5 >UserID and Password</h5>
	<br><br>
	<label for="UserID"><b>UserID</b></label>
    <input type="password" placeholder="Enter UserID" name="UserID" required>
	<br><br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
	<br><br>
    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
	<br><br>
	
	<label for="Photo"><b>Attach a photo</b></label>
	<input type="file" name="filetoupload" id="filetoupload"><br><br>
	
	<label for="Signature"><b>Attach a signature</b></label> 
	<input type="file" name="filupload" id="filupload">
	
	<br><br>
	<b>DECLARATION</b>
	<input type="checkbox" name="declrtn" >I do hereby declare that the information is correct and complete to the best of my knowledge and belief<br><br>
    
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
	<br><br>
    <div class="clearfix" align="center">
      <button type="button" class="cancelbtn" align="center">Cancel</button><br><br>
      <button type="submit" class="signupbtn" align="center">Sign Up</button>
    </div>
  </div>
</form>

</body>
</html>

