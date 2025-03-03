<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FYMS || Supervisor Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Css/supervisor.css">
    <link rel="stylesheet" href="Css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>
<body>
    <div class="sup-wrapper">  
         <div class="sup">
            <a href="index.htm"><img class="nav" src="pics/home2.png" alt="about image"></a>
                <div class="sup-content">
                <div>
                    <h1 class="sup-head">Supervisor Portal</h1>
                    <p class="para">List of uploaded projects</p>
                    <div>     
                        <div class="sup-box">
                            <?php
                            // Include database connection file
                            require_once('php/db_connection.php');
                            // Check if form is submitted for accepting or rejecting tasks
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (isset($_POST['accept']) || isset($_POST['reject'])) {
                                    // Get the task ID and the action (accept or reject)
                                    $task_id = $_POST['task_id'];
                                    $action = isset($_POST['accept']) ? 'Accepted' : 'Rejected';
                                    // Update the task status in the database
                                    $sql_update = "UPDATE tasks SET status = '$action' WHERE task_id = $task_id";
                                    $conn->query($sql_update);
                                    // Redirect to the same page to avoid resubmission
                                    header("Location: ".$_SERVER['PHP_SELF']);
                                    exit();
                                }
                            }
                            // Fetch all tasks from the database
                            $sql = "SELECT task_id , file_name, status, arid_no  FROM tasks";
                            $result = $conn->query($sql);
                            // Check if there are tasks
                            if ($result->num_rows > 0) {
                                // Output tasks
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div>";
                                    echo "<hr class='line'>";
                                  // echo "<p class='line'>____________________________________</p>";
                                    echo "<p class='sup-task'>{$row['task_id']}) {$row['arid_no']} : {$row['file_name']}</p>";
                                    echo "<p class='sts'>{$row['status']}</p>";
                                    echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                                    echo "<input type='hidden' name='task_id' value='{$row['task_id']}'>";
                                    echo "<button class='sup-accpt' type='submit'  name='accept'>Accept</button> ";
                                    echo "<button class='sup-rej' type='submit' name='reject'>Reject</button>";
                                    // Add a download button to download the task file
                                    echo "<a href='php/download.php?task_id={$row['task_id']}'><button class='sup-down'  type='button'><img class='sup-down-img'src='pics/download.png' alt='about image'></button></a>";
                                    
                                    echo "</form>";
                                   echo "</div>";
                                }
                            } else {
                                echo "<p>No tasks available.</p>";
                            }

                            // Close MySQL connection
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
