<?php
require('dbconn.php');
?>


<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>Library Management System </title>

	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	

	<!-- Style --> 
	<link rel="stylesheet" href="css/login1.css" type="text/css" media="all">

	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->

</head>

<body>
    
	


	<!-- <div class="footer w3layouts agileits">
		<p> &copy; 2024 PUP Library Management System. All Rights Reserved </a></p>
		
	</div> -->

</body>

<?php
if(isset($_POST['signup'])) {
	$name = $_POST['Name'];
	$email = $_POST['Email'];
	$password = $_POST['Password'];
	$mobno = $_POST['PhoneNumber'];
	$rollno = $_POST['RollNo'];
	$category = $_POST['Category'];
	$type = 'Student';

	if (preg_match('/^[a-zA-Z0-9]+$/', $rollno)) {
		$sql = "insert into LMS.user (Name,Type,Category,RollNo,EmailId,MobNo,Password) values ('$name','$type','$category','$rollno','$email','$mobno','$password')";

		if ($conn->query($sql) === TRUE) {
			echo "<script type='text/javascript'>alert('Registration Successful')</script>";
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
			echo "<script type='text/javascript'>alert('User Exists')</script>";
		}
	} else {
		echo "<script type='text/javascript'>alert('Invalid characters! (Roll Number)')</script>";
		// echo "<script type='text/javascript'>alert('Roll Number can only contain alphanumeric characters')</script>";
	}
}

?>
