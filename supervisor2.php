<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FYMS || Supervisor Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>
<body>
    <div class="login-wrapper">
        <div class="sup">
            <div class="sup-content">
                <div>
                    <h2>Supervisor Tasks</h2>
                    <div class="sup-box">
                        <form action="php/supervisor_tasks.php" method="post">
                            <div class="upload_box">
                                <select name="supervisor">
                                    <?php
                                    // Include database connection file
                                    require_once('php/db_connection.php');

                                    // Fetch supervisor data from the database
                                    $sql = "SELECT sup_id, sup_name FROM supervisor";
                                    $result = $conn->query($sql);

                                    // Check if there are supervisors
                                    if ($result->num_rows > 0) {
                                        // Output supervisor names as options in the dropdown
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['sup_id']}'>{$row['sup_name']}</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No supervisors found</option>";
                                    }

                                    // Close MySQL connection
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                            <input type="submit" value="Show Tasks" name="submit">
                        </form>
                    </div>
                </div>
                <div>
                    <h3>Tasks</h3>
                    <div class="sup-box">
                        <?php
                        // Check if form is submitted with supervisor selection
                        if (isset($_POST['submit'])) {
                            // Include database connection file
                            require_once('php/db_connection.php');

                            // Get selected supervisor ID
                            $supervisor_id = $_POST['supervisor'];

                            // Fetch tasks for the selected supervisor from the database
                            $sql = "SELECT task_id, file_name FROM tasks WHERE sup_id = $supervisor_id";
                            $result = $conn->query($sql);

                            // Check if there are tasks
                            if ($result->num_rows > 0) {
                                // Output tasks
                                while ($row = $result->fetch_assoc()) {
                                    echo "<p>{$row['task_id']}: {$row['file_name']}</p>";
                                }
                            } else {
                                echo "<p>No tasks available for this supervisor.</p>";
                            }

                            // Close MySQL connection
                            $conn->close();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>