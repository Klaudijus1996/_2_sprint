<?php declare(strict_types = 1); include('data.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/upd_staff_form.css">
    <title>Staff and Projects</title>
</head>
<body>
    <main>
        <div class="navbar">
            <nav>
                <a href="admin_staff.php">Darbuotojai</a>
                <a href="admin_projects.php">Projektai</a>
                <a href="admin_SP.php">Darbuotoju ir projektu lentele</a>
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
                                <th>Actions</th>
                            </tr>
                                ";
                    while($row = mysqli_fetch_assoc($result)) {
                        ob_start();
                        $projectID = $row['projectid'];
                        $staffNames = $row['fullname'] != NULL ? $row['fullname'] : "Undecided"; 
                        $projectName = $row['project_name'];
                        $projectDeadline = $row['deadline'];
                        $assign_person_edit = "<form style='width: fit-content; display: inline;' action='' method='get'>
                                                    <input class='edit base-btn' type='submit' value='Assign'>
                                                    <input type='hidden' name='sp_edit' value='$projectID,$projectName'>
                                                </form>";
                        echo "
                        <tr>
                            <td>$projectID</td>
                            <td>$staffNames</td>
                            <td>$projectName</td>
                            <td>$projectDeadline</td>
                            <td>$assign_person_edit</td>
                        </tr>
                        ";
                    }
                    echo "</table>";
                    echo "
                        <form style='display: inline-block' action='' method='get'>
                            <input class='add-staff base-btn' type='submit' name='create_project' value='Create New Project'>
                        </form>
                        ";
                    $link = $_SERVER['REQUEST_URI'];
                    $currentFile = substr($link, strripos($link, '/')+1);
                    include('add_project.php');
                    $projectID_and_name = $_GET['sp_edit'];
                    if (isset($projectID_and_name)) {
                        $project_id  = substr($projectID_and_name, 0, stripos($projectID_and_name, ','));
                        $project_name = substr($projectID_and_name, stripos($projectID_and_name, ',')+1);
                        // echo "<h4>Assign projects<h4>";
                        $sql = "SELECT GROUP_CONCAT(CONCAT_WS(' ', first_name, last_name)) as fullname FROM esybes_ir_rysiai.staff
                        GROUP BY staff.staffid;";
                        $result = mysqli_query($conn, $sql);
                        echo "
                            <form style='display: inline-grid; margin-left: 20px;' action='' method='post'>
                                <label style='color: #dddddd' for='names'>Assign project $project_name to: </label>
                                <select style='padding: 3px 0;' name='names' id='names'>";
                        while($row = mysqli_fetch_assoc($result)) {
                            $staffNames = $row['fullname'] != NULL ? $row['fullname'] : "Undecided";
                                        echo "<option value='$staffNames'>$staffNames</option>";
                                    }
                                    echo "</select>
                                    <br>
                                    <input style='width: fit-content; margin-bottom: 5px;' class='edit base-btn' type='submit' value='Submit'>
                                    <a class='back base-btn' href='admin_SP.php'>Back</a>
                                    </form>
                                    ";
                                    $names = $_POST['names'];
                                        if (isset($names)) {
                                            $fname = substr($names, 0, stripos($names, ' '));
                                            $lname = substr($names, strlen($fname)+1);
                                    $sql = "UPDATE esybes_ir_rysiai.staff SET ProjectID='$project_id' WHERE esybes_ir_rysiai.staff.first_name='$fname' and esybes_ir_rysiai.staff.last_name='$lname'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "Staff data updated succesfully.";
                                        ob_end_flush();
                                        header("Location: admin_SP.php");
                                    
                                        } else {
                                            echo "Error updating record: " . mysqli_error($conn);
                                        }
                                }
                    }
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