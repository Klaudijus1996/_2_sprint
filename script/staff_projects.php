<?php declare(strict_types = 1); include('data.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Staff and Projects</title>
</head>
<body>
    <main>
        <div class="navbar">
            <nav>
                <a href="staff.php">Darbuotojai</a>
                <a href="projects.php">Projektai</a>
                <a href="staff_projects.php">Darbuotoju ir projektu lentele</a>
                <p>projektu valdymo sistema</p>
            </nav>
        </div>
        <div class="container">
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "mysql";
                $dbname = 'esybes_ir_rysiai';

                $conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection
                
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // echo "Connected successfully<br>";
                # Staff Table :: Start ::
                $sql = "SELECT projects.projectid, GROUP_CONCAT(CONCAT_WS(' ', first_name, last_name)) as fullname, project_name, deadline FROM esybes_ir_rysiai.projects
                left join staff on projects.projectid = staff.projectid
                GROUP BY projects.ProjectID;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                        echo "
                        <table>
                            <tr>
                                <th>Project ID</th>
                                <th>People assigned to project</th>
                                <th>Project Name</th>
                                <th>Deadline</th>
                            </tr>
                                ";
                    while($row = mysqli_fetch_assoc($result)) {
                        $projectID = $row['projectid'];
                        $staffNames = $row['fullname'] != NULL ? $row['fullname'] : "Undecided"; 
                        $projectName = $row['project_name'];
                        $projectDeadline = $row['deadline'];
                        echo "
                        <tr>
                            <td>$projectID</td>
                            <td>$staffNames</td>
                            <td>$projectName</td>
                            <td>$projectDeadline</td>
                        </tr>
                        ";
                    }
                    echo "</table>";
                } else {
                    echo "ERROR: staff table not found!";
                }
                # Staff Table :: END ::
                mysqli_close($conn);
            ?>
            <?php require_once('logout.php') ?>
        </div>
        <footer>
            &#169; <?php echo date("Y-m-d"); ?>
        </footer>
    </main>
</body>
</html>