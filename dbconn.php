<?php
// session_start();
// $dbservername = "localhost";
// $dbusername = "root";
// $dbpassword = "";

// $conn = mysqli_connect($dbservername, $dbusername, $dbpassword);

// if (!$conn) {
//     echo "Connected unsuccessfully";
//     die("Connection failed: " . mysqli_connect_error());
// }


session_start();
$dbservername = "sql307.infinityfree.com";
$dbusername = "if0_35983753";
$dbpassword = "GnJkxF0G1eyAY";
$dbname = "if0_35983753_lms";
// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
    echo "Connected unsuccessfully";
    die("Connection failed: " . mysqli_connect_error());
}
?>

