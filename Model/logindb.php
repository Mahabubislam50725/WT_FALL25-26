<?php
$host = "localhost";
$user = "root";
$pass = ""; // usually XAMPP root password is empty
$dbname = "multi-vendor e-commerce"; // exact DB name with spaces

// Create connection using mysqli
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
