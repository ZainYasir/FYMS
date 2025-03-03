<?php
// Include database connection file
require_once('db_connection.php');

// Check if task ID is provided in the URL
if (isset($_GET['task_id'])) {
    // Sanitize the task ID
    $task_id = $_GET['task_id'];

    // Fetch the file path from the database based on the task ID
    $sql = "SELECT file_name FROM tasks WHERE task_id = $task_id";
    $result = $conn->query($sql);

    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Get the file path
            $row = $result->fetch_assoc();
            $file_path = $row['file_name'];

            // Set headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            // Read the file and output its contents
            readfile($file_path);
            exit;
        } else {
            // Task ID found in the database, but no matching task found
            echo "Task not found.";
        }
    } else {
        // Query failed
        echo "Error: " . $conn->error;
    }
} else {
    // Task ID not provided
    echo "Task ID not provided.";
}

// Close MySQL connection
$conn->close();
?>
