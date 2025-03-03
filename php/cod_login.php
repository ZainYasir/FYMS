<?php
// Start session
require_once('db_connection.php');

if(isset($_POST['login'])) {
    // Retrieve form data
    $cod_name = $_POST['cod_name'];
    $cod_password = $_POST['cod_password'];

    // Prepare SQL statement to fetch student data from the database
    $sql = "SELECT * FROM coordinator WHERE cod_name='$cod_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Student exists, verify password
        $row = $result->fetch_assoc();
        if($cod_password == $row['cod_password']) {
            // Password is correct, start session and redirect to dashboard or any other page
            $_SESSION['cod_name'] = $cod_name;
            header("Location: ../coordinator.htm");
            exit(); // Make sure no other output is sent
        } else {
            // Password is incorrect
            echo "<script src='../java/messages.js'></script>";
            echo "<script>showMessage('Incorecct passwrord.');</script>";
            echo "<script>window.location.replace('../login_coordinator.htm');</script>";
        }
    } else {
        // Student with the provided Arid Number doesn't exist
        echo "<script src='../java/messages.js'></script>";
            echo "<script>showMessage('Coordinator wth this name doesn't exist.');</script>";
            echo "<script>window.location.replace('../login_coordinator.htm');</script>"; 
    }
}

// Close MySQL connection
$conn->close();
?>
