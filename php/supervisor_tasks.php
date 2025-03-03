<?php
// Include database connection file
require_once('db_connection.php');

// Check if form is submitted with supervisor selection
if (isset($_POST['submit'])) {
    // Get selected supervisor ID
    $supervisor_id = $_POST['supervisor'];

    // Prepare SQL statement to fetch tasks for the selected supervisor
    $sql = "SELECT task_id, file_name FROM tasks WHERE sup_id = $supervisor_id";
    
    // Execute SQL query
    $result = $conn->query($sql);

    // Check if the query executed successfully
    if ($result === false) {
        echo "Error executing query: " . $conn->error;
    } else {
        // Check if there are tasks
        if ($result->num_rows > 0) {
            // Output tasks
            while ($row = $result->fetch_assoc()) {
                echo "{$row['task_id']}: {$row['file_name']}<br>";
            }
        } else {
            echo "No tasks available for this supervisor.";
        }
    }

    // Close MySQL connection
    $conn->close();
}
?>
