<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FYMS || Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Css/upload.css">
    <link rel="stylesheet" href="Css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>
<body>
    <div class="upload-wrapper">
        <div class="upload">
        <a href="index.htm"><img class="nav" src="pics/home2.png" alt="about image"></a>
            <div class="upload-content">
                <div>
                    
                    <h1 class="upload-head">Upload Portal</h1>
                    </br>
                    <p class="upload-txt">Students can upload tasks, which can be in the form of documents or PDF files, by selecting the file from their device and entering their ARID number. Additionally, they can select their supervisor from a dropdown list. This process allows students to easily submit their assignments and projects to their designated supervisors for review and feedback. The file upload feature supports various file formats, including  Word documents and PDF files, making it convenient for students to upload their work in the format they prefer. Once the file is uploaded and the supervisor is selected, the student can submit the task, which will be stored in the system for future reference.</p>
                   </br>
                    <form action="php/upload.php" method="post" enctype="multipart/form-data">
                        <div class="upload-box">
                            <input type="file" name="file" id="file"><br><br>
                        </div>
                        <div class="upload-box">
                            <!-- Input field for ARID number -->
                            <input type="text" name="arid_no" placeholder="Enter arid number (00-arid-000)">
                        </div>  
                        <p class="upload-sup">SELECT SUPERVISOR</p>
                            <select name="supervisor" class="upload-slt">
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
                        </br></br>
                        <input type="submit" class="upload_btn" value="Upload Task" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
