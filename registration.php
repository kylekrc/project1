<?php
require('dbconn.php');
?>


<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>Library Management System </title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

	<!-- Style --> 
	<link rel="stylesheet" href="css/reg-sty.css" type="text/css" media="all">

	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>

	<!-- <h1>LIBRARY MANAGEMENT SYSTEM</h1> -->

    <form action="registration.php" method="post" autocomplete="off">
        <h2>REGISTRATION</h2>
				
        <label for="name">Name: </label>
        <input type="text" Name="Name" placeholder="" required> <br>
		<label for="name">Email: </label>
		<input type="text" Name="Email" placeholder="" required> <br>
        <label for="pass">Password: </label>
        <input type="password" Name="Password" placeholder="" required> <br>
        <label for="phone-num">Phone Number: </label>
		<input type="text" Name="PhoneNumber" placeholder="" required>
        <!-- <label for="rollnum">Roll No.: </label>
		<input type="text" Name="RollNo" placeholder="" required=""> -->

        <label for="dob_day">Category: </label>
        <select name="Category" id="Category">
            <option value="GEN">General</option>
            <option value="STU">Student</option>
            <option value="PRF">Prof</option>	
		</select> <br>

        
        <button class="submit" type="submit" name="signup" value="Sign Up">Submit</button>
        
		<p>By creating an account, you agree to our <a class="underline" href="terms.php">Terms</a></p>
        <p>Already have an account? <a class="log" href="login.php">Login</a></p>
        
    </form>

	<!-- <div class="footer w3layouts agileits">
		<p> &copy; 2024 PUP Library Management System. All Rights Reserved </a></p>
		
	</div> -->



<?php

// Function to generate Roll No.
function generateRollNo($category) {
    $prefix = "B-";
    $numbers = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); // Random 6-digit number
    return $prefix . $numbers . $category; }


if(isset($_POST['signup'])) {
	$name = $_POST['Name'];
	$email = $_POST['Email'];
	$password = $_POST['Password'];
	$mobno = $_POST['PhoneNumber'];
	$rollno = $_POST['RollNo'];
	$category = $_POST['Category'];
	$type = 'Student';

    // Generate Roll No. based on category
    $rollno = generateRollNo($category);

    // Check if Roll No. already exists
    $checkSql = "SELECT * FROM LMS.user WHERE RollNo='$rollno'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "<script type='text/javascript'>alert('Roll No. already exists')</script>";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO LMS.user (Name, Type, Category, RollNo, EmailId, MobNo, Password) VALUES ('$name', '$type', '$category', '$rollno', '$email', '$mobno', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Registration Successful. Your Roll No.: $rollno')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "')</script>";
        }
    }
}

?>