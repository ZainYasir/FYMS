<?php
// Start session
require_once('db_connection.php');

// Check if the form is submitted for registration
if(isset($_POST['register'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $arid_no = $_POST['arid_no'];
    $class = $_POST['class'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if($password != $confirm_password) {
        echo "<script src='../java/messages.js'></script>";
        echo "<script>showMessage('Passwords do not match.');</script>";
        echo "<script>window.location.replace('../signup.htm');</script>"; // Redirect back to registration page
        exit(); // Stop further execution
    } else {
        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO student (name, arid_no, class, password) VALUES ('$name', '$arid_no', '$class', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to login section
            $_SESSION['success_message'] = "New student record created successfully. You can now login.";
            header("Location: ../login_student.htm");
            exit(); // Make sure no other output is sent
        } else {
            echo "<script src='../java/messages.js'></script>";
            echo "<script>showMessage('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            echo "<script>window.location.replace('../signup.htm');</script>"; // Redirect back to registration page
            exit(); // Stop further execution
        }
    }
}

// Check if the form is submitted for login
if(isset($_POST['login'])) {
    // Retrieve form data
    $arid_no = $_POST['arid_no'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch student data from the database
    $sql = "SELECT * FROM student WHERE arid_no='$arid_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Student exists, verify password
        $row = $result->fetch_assoc();
        if($password == $row['password']) {
            // Password is correct, start session and redirect to dashboard or any other page
            $_SESSION['arid_no'] = $arid_no;
            header("Location: ../upload_here.php");
            exit(); // Make sure no other output is sent
        } else {
            echo "<script src='../java/messages.js'></script>";
            echo "<script>showMessage('Incorrect password.');</script>";
            echo "<script>window.location.replace('../login_student.htm');</script>"; // Redirect back to login page
            exit(); // Stop further execution
        }
    } else {
        echo "<script src='../java/messages.js'></script>";
        echo "<script>showMessage('Student with the provided Arid Number doesn\'t exist.');</script>";
        echo "<script>window.location.replace('../login_student.htm');</script>"; // Redirect back to login page
        exit(); // Stop further execution
    }
}

// Close MySQL connection
$conn->close();
?>