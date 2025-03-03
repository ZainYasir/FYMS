<?php
// Include database connection file
require_once('db_connection.php');

// Check if the form is submitted
if(isset($_POST['register'])) {
    // Retrieve form data
    $sup_id = $_POST['sup_id'];
    $sup_name = $_POST['sup_name'];
    $sup_password = $_POST['sup_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if($sup_password !== $confirm_password) {
        // Redirect back to the registration page with an error message
        echo" password doesnt match";
       // header("Location: ../signup_sup.htm?error=password_mismatch");
        exit();
    }

    // Check if supervisor with the same ID already exists
    $sql_check = "SELECT * FROM supervisor WHERE sup_id=?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param("s", $sup_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // Redirect back to the registration page with an error message
        echo" ID is taken ";
        //header("Location: ../signup_sup.htm?error=id_taken");
        exit();
    }

    // Insert new supervisor into the database
    $sql_insert = "INSERT INTO supervisor (sup_id, sup_name, sup_password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sss", $sup_id, $sup_name, $sup_password);
    $stmt->execute();

    // Redirect to login page with success message
    header("Location:../coordinator.htm");
    exit();
}

// Close MySQL connection
$conn->close();
?>
