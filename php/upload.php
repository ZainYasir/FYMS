<?php
// Include database connection file
require_once('db_connection.php');

// Check if the form is submitted for upload
if(isset($_POST['submit'])) {
    // Retrieve form data
    $arid_no = $_POST['arid_no']; // Retrieve ARID number
    $supervisor_id = $_POST['supervisor'];

    // File upload process goes here...

    // Get file name and other relevant information
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];

    // Move uploaded file to desired directory (adjust the directory path as needed)
    move_uploaded_file($file_tmp, "uploads/" . $file_name);

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO tasks (file_name, sup_id, arid_no) VALUES ('$file_name', '$supervisor_id', '$arid_no')";

    if ($conn->query($sql) === TRUE) {
        // Task uploaded successfully
        // Redirect to a success page or display a success message
        echo "<script src='../java/messages.js'></script>";
            echo "<script>showMessage('Uploaded.');</script>";
           // echo "<script>window.location.replace('.../upload_here.php');</script>";
           header("Location: ../upload_here.php");
        exit(); // Stop further execution
    } else {
        // Error in task upload
        // You can handle the error appropriately (e.g., display an error message)
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close MySQL connection
$conn->close();
?>
