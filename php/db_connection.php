<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Assuming your MySQL username is "root"
$password = ""; // Assuming your MySQL password is empty
$database = "fyms_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
