<?php
// Include database connection file
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get ARID number from the form
    $arid_number = $_POST['arid_number'];

    // Prepare and execute SQL statement to delete the student
    $sql = "DELETE FROM student  WHERE arid_no = '$arid_number'";

    if ($conn->query($sql) === TRUE) {
        // Student successfully removed
       // echo "<script>alert('Student with ARID number $arid_number removed successfully.');</script>";
       header("Location: ../coordinator.htm");
    exit();
    } else {
        // Error occurred while removing student
        echo "<script>alert('Error: Unable to remove student.');</script>";
        
    }

    // Close MySQL connection
    $conn->close();
} else {
    // If the request method is not POST, redirect to the coordinator page
    header("Location: ../coordinator.htm");
    exit();
}
?>
