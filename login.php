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
	<link rel="stylesheet" href="css/login-sty.css" type="text/css" media="all">

	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->

</head>

<body>
    
	<!-- <h1>LIBRARY MANAGEMENT SYSTEM</h1> -->

    <form action="login.php" method="post" autocomplete="off">
        <h2>LOGIN</h2>
        
        
        <label for="rollno">Roll No. : </label>
        <input type="text" Name="RollNo" placeholder="" required=""> <br>
        <label for="password">Password : </label>
        <input type="password" Name="Password" placeholder="" required="">
        <button type="submit" name="signin"; value="Sign In">Login</button>
        
        <p><a class='bth' href="forgot_password.php">Forgot Password?</a></p>
        <p>Don't have an account? <a class='reg' href="registration.php">Register</a></p>
    </form>
    


	<!-- <div class="footer w3layouts agileits">
		<p> &copy; 2024 PUP Library Management System. All Rights Reserved </a></p>
		
	</div> -->

</body>

<?php
if (isset($_POST['signin'])) {
    $input = $_POST['RollNo']; // Modified to accept both Roll No. and Email
    $password = $_POST['Password'];

    $x = null; // Initialize $x and $y
    $y = null;

    // Check if the input is an email or a Roll No.
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        // If it's an email, use it in the email field
        $sql = "SELECT * FROM LMS.user WHERE EmailId='$input'";
    } else {
        // If it's not an email, use it in the Roll No. field
        $sql = "SELECT * FROM LMS.user WHERE RollNo='$input'";
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Password'];
        $y = $row['Type'];
    }

    if (strcasecmp($x, $password) == 0 && !empty($input) && !empty($password)) {
        $_SESSION['RollNo'] = $row['RollNo'];

        if ($y == 'Admin') {
            header('location:admin/index.php');
        } else {
            header('location:student/index.php');
        }
    } else {
        echo "<script type='text/javascript'>alert('Failed to Login! Incorrect ID or Password')</script>";
    }

    // Redirect to the forgot password page
    if (isset($_POST['forgot_password'])) {
        header('location: forgot_password.php');
        exit();
    }
}
?>
