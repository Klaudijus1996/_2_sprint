<?php declare(strict_types = 1); include('data.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/upd_staff_form.css">
    <title>Projects</title>
</head>
<body>
    <main>
        <div class="navbar">
            <nav>
                <a href="staff.php">Darbuotojai</a>
                <a href="projects.php">Projektai</a>
                <a href="staff_projects.php">Darbuotoju ir projektu lentele</a>
                <a href="admin_staff.php">Admin</a>
                <a href="admin_projects.php">Admin P</a>
                <a href="admin_SP.php">Admin SP</a>
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
                # Projects Table :: START ::
                $sql = "SELECT projectid, project_name, deadline FROM projects";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "
                        <table>
                            <tr>
                                <th>Project ID</th>
                                <th>Project Name</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                                ";
                    while($row = mysqli_fetch_assoc($result)) {
                        ob_start();
                        $projectID = $row['projectid'];
                        $projectName = $row['project_name'];
                        $projectDeadline = $row['deadline'];
                        $upd_projects_btn = "<form style='width: fit-content; display: inline;' action='' method='get'>
                                            <input class='edit base-btn' type='submit' value='Edit'>
                                            <input type='hidden' name='upd-projects-btn' value='$projectID'>
                                        </form>";
                        $del_projects_btn = "<form style='width: fit-content; display: inline;' action='' method='get'>
                                            <input class='del base-btn' type='submit' value='Del'>
                                            <input type='hidden' name='del-projects-btn' value='$projectID'>
                                        </form>";
                        echo "
                        <tr>
                            <td>$projectID</td>
                            <td>$projectName</td>
                            <td>$projectDeadline</td>
                            <td>$upd_projects_btn $del_projects_btn</td>
                        </tr>
                        ";
                    }
                    echo "</table>";
                    echo "
                        <form action='' method='get'>
                            <input class='add-staff base-btn' type='submit' name='create_project' value='Create New'>
                        </form>
                        ";
                } else {
                    echo "ERROR: projects table not found!";
                }
                $link = $_SERVER['REQUEST_URI'];
                $currentFile = substr($link, strripos($link, '/')+1);
                require_once('logout.php');
                include_once('add_project.php');
                include_once('del_project_data.php');
                include_once('edit_project_data.php');
                # Projects Table :: END ::
                // mysqli_close($conn);
            ?>
        </div>
        <footer>
            &#169; <?php echo date("Y-m-d"); ?>
        </footer>
    </main>
</body>
</html>