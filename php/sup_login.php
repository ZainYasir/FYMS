<?php
// Start session
require_once('db_connection.php');

if(isset($_POST['login'])) {
    // Retrieve form data
    $sup_name = $_POST['sup_name'];
    $sup_password = $_POST['sup_password'];

    // Prepare SQL statement to fetch student data from the database
    $sql = "SELECT * FROM supervisor WHERE sup_name='$sup_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Student exists, verify password
        $row = $result->fetch_assoc();
        if($sup_password == $row['sup_password']) {
            // Password is correct, start session and redirect to dashboard or any other page
            $_SESSION['sup_name'] = $sup_name;
            header("Location: ../supervisor.php");
            exit(); // Make sure no other output is sent
        } else {
            // Password is incorrect
            echo "<script src='../java/messages.js'></script>";
            echo "<script>showMessage('Incorrect password.');</script>";
            echo "<script>window.location.replace('../login_supervisor.htm');</script>"; 
        }
    } else {
        // Student with the provided Arid Number doesn't exist
        echo "<script src='../java/messages.js'></script>";
        echo "<script>showMessage('Supervisor with this name Doesn't esit.');</script>";
        echo "<script>window.location.replace('../login_supervisor.htm');</script>"; 
    }
}

// Close MySQL connection
$conn->close();
?>
