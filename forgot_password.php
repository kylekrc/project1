<?php
require('dbconn.php');
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';


if(isset($_POST['submit'])) {
    $input = $_POST['RollNo']; // Modified to accept both Roll No. and Email

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
        
        // Generate a random password
        $newPassword = generateRandomPassword();

        // Update the password in the database
        $updateSql = "UPDATE LMS.user SET Password='$newPassword' WHERE RollNo='{$row['RollNo']}'";
        $conn->query($updateSql);

        // Send the new password to the user's email
        sendNewPasswordEmail($row['EmailId'], $row['RollNo'], $newPassword);

        echo "<script type='text/javascript'>alert('Password reset successful. Check your email for the new password.')</script>";
    } else {
        echo "<script type='text/javascript'>alert('User not found.')</script>";
    }
}

function generateRandomPassword() {
    // Generate a random password (you can customize the length and characters)
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomPassword = substr(str_shuffle($characters), 0, 10);

    return $randomPassword;
}

function sendNewPasswordEmail($email, $rollNo, $newPassword) {
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com'; // Your email address
        $mail->Password   = 'your_email_password'; // Your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    
        //Recipient
        $mail->setFrom('your_email@gmail.com', 'Your Name');
        $mail->addAddress($email);
    
        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Library System Password Reset';
        $mail->Body    = "Your password has been reset.<br><br>Roll No.: $rollNo<br>New Password: $newPassword";
    
        $mail->send();
        echo "<script type='text/javascript'>alert('Password reset successful. Check your email for the new password.')</script>";
    } catch (Exception $e) {
        echo "<script type='text/javascript'>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <!-- Style --> 
	<link rel="stylesheet" href="css/forgot-style.css" type="text/css" media="all">

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    
</head>
<body>
    <form action="forgot_password.php" method="post" autocomplete="off">
        <h1>Forgot Password</h1>
        <p>An email will be sent to you along with your Roll No. and new generated password. 
            You can change it upon the edit settings when logged in.</p>
        <label for="rollno_email">Roll No. or Email: </label>
        <input type="text" name="RollNo" placeholder="" required=""> <br>
        <!-- <a class="bth" type="submit" name="submit" value="Submit">Reset Password</a> -->
        <button type="submit" name="submit" value="Submit">Reset Password</button>
        <!-- <a class='bth' href="login.php">Go Back</a> -->
    </form>
</body>
</html>